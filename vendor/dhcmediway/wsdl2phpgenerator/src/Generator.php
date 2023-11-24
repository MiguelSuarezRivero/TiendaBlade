<?php
/**
 * @package Wsdl2PhpGenerator
 */

namespace Wsdl2PhpGenerator;

use \Exception;
use Psr\Log\LoggerInterface;
use Wsdl2PhpGenerator\Filter\FilterFactory;
use Wsdl2PhpGenerator\Xml\WsdlDocument;

/**
 * Class that contains functionality for generating classes from a wsdl file
 *
 * @package Wsdl2PhpGenerator
 * @author Fredrik Wallgren <fredrik.wallgren@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Generator implements GeneratorInterface
{

    /**
     * @var WsdlDocument
     */
    protected $wsdl;

    /**
     * @var Service
     */
    protected $service;

    /**
     * An array of Type objects that represents the types in the service
     *
     * @var Type[]
     */
    protected $types = array();

    /**
     * An array of Method objects
     *
     * @var Method[]
     */
    protected $methods = array();

    /**
     * An array of Location objects
     *
     * @var Location[]
     */
    protected $locations = array();

    /**
     * An array of Method key
     */
    protected $methodKeys = array();

    /**
     * This is the object that holds the current config
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Construct the generator
     */
    public function __construct()
    {
        $this->service = null;
        $this->types = array();
    }

    /**
     * Generates php source code from a wsdl file
     *
     * @param ConfigInterface $config The config to use for generation
     * @param bool $parseOnly
     * @param bool $isReturnInstance
     */
    public function generate(ConfigInterface $config, $parseOnly = false, $isReturnInstance = false)
    {
        $this->config = $config;

        $this->log('Starting generation');

        // Warn users who have disabled SOAP_SINGLE_ELEMENT_ARRAYS.
        // Note that this can be
        $options = $this->config->get('soapClientOptions');
        if (empty($options['features']) ||
            (($options['features'] & SOAP_SINGLE_ELEMENT_ARRAYS) != SOAP_SINGLE_ELEMENT_ARRAYS)) {
            $message = array('SoapClient option feature SOAP_SINGLE_ELEMENT_ARRAYS is not set.',
                'This is not recommended as data types in DocBlocks for array properties will not be ',
                'valid if the array only contains a single value.');
            $this->log(implode(PHP_EOL, $message), 'warning');
        }

        $wsdl = $this->config->get('inputFile');
        $outputDir = $this->config->get('outputDir');
        $outputFile = $this->config->get('outputFile');
        $this->config->set('outputPath', $outputDir . '/' . $outputFile);

        if (is_array($wsdl)) {
            foreach ($wsdl as $ws) {
                $this->load($ws,$isReturnInstance);
            }
        } else {
            $this->load($wsdl,$isReturnInstance);
        }

        if ($parseOnly) {
            $this->setLocations($wsdl);
            return;
        }

        $this->savePhp();
        $this->saveWsdl($wsdl);
        $this->log('Generation complete', 'info');
    }

    /**
     * Load the wsdl file into php
     */
    protected function load($wsdl,$isReturnInstance)
    {
        $this->log('Loading the WSDL');

        $this->wsdl = new WsdlDocument($this->config, $wsdl);

        $this->types = array();

        $this->loadTypes();
        $this->loadService($isReturnInstance);
        $this->loadMethods();
    }

    /**
     * Loads the service class
     */
    protected function loadService($isReturnInstance)
    {
        $service = $this->wsdl->getService();
        $this->log('Starting to load service ' . $service->getName());

        $this->service = new Service($this->config, $service->getName(), $this->types, $service->getDocumentation());

        $requestTypes = [];
        foreach ($this->wsdl->getOperations() as $function) {
            $this->log('Loading function ' . $function->getName());

            $operation = new Operation($function->getName(), $function->getParams(), $function->getDocumentation(),$function->getReturns());

            $name = $operation->getName();
            $params = $operation->getParams();
            $paramsIn = '';
            $paramsOut = '';
            // 如果请求参数没有type
            if (!array_key_exists($operation->getParamStringNoTypeHints(), $params)) {
                $paramsIn = [$operation->getParamStringNoTypeHints()];
                $paramsOut = [$operation->getReturns()];
                $request = $operation->getName();
                $returns = $function->getReturns();
            } else {
                $request = $operation->getParams()[$operation->getParamStringNoTypeHints()];
                $returns = $function->getReturns();
                // 不返回实例
                if(!$isReturnInstance){
                    $operation->setReturns('\stdClass');
                    $requestTypes[] = $request;
                }
            }
            $this->methodKeys[$name] = ['soapIn' => $request, 'soapOut' => $returns,
                'paramsIn'=>$paramsIn,'paramsOut'=>$paramsOut];
            $this->service->addOperation($operation);
        }
        $types = $this->service->getKeepTypes($requestTypes);
        $this->service->setTypes($types);

        $this->log('Done loading service ' . $service->getName());
    }

    /**
     * Loads all type classes
     */
    protected function loadTypes()
    {
        $this->log('Loading types');

        $types = $this->wsdl->getTypes();

        foreach ($types as $typeNode) {
            $type = null;

            if ($typeNode->isComplex()) {
                if ($typeNode->isArray()) {
                    $type = new ArrayType($this->config, $typeNode->getName());
                } else {
                    $type = new ComplexType($this->config, $typeNode->getName());
                }

                $this->log('Loading type ' . $type->getPhpIdentifier());

                $type->setAbstract($typeNode->isAbstract());

                foreach ($typeNode->getParts() as $name => $typeName) {
                    // There are 2 ways a wsdl can indicate that a field accepts the null value -
                    // by setting the "nillable" attribute to "true" or by setting the "minOccurs" attribute to "0".
                    // See http://www.ibm.com/developerworks/webservices/library/ws-tip-null/index.html
                    if($typeNode->isElementNillable($name)){
                        $nullable = false;
                    }else{
                        $nullable = $typeNode->getElementMinOccurs($name) === 0;
                    }
                    $type->addMember($typeName, $name, $nullable);
                }

            } elseif ($enumValues = $typeNode->getEnumerations()) {
                $type = new Enum($this->config, $typeNode->getName(), $typeNode->getRestriction());
                array_walk($enumValues, function ($value) use ($type) {
                    $type->addValue($value);
                });
            } elseif ($pattern = $typeNode->getPattern()) {
                $type = new Pattern($this->config, $typeNode->getName(), $typeNode->getRestriction());
                $type->setValue($pattern);
            }

            if ($type != null) {
                $already_registered = false;
                if ($this->config->get('sharedTypes')) {
                    foreach ($this->types as $registered_types) {
                        if ($registered_types->getIdentifier() == $type->getIdentifier()) {
                            $already_registered = true;
                            break;
                        }
                    }
                }
                if (!$already_registered) {
                    $this->types[$typeNode->getName()] = $type;
                }
            }
        }

        // Loop through all types again to setup class inheritance.
        // We can only do this once all types have been loaded. Otherwise we risk referencing types which have not been
        // loaded yet.
        foreach ($types as $type) {
            if (($baseType = $type->getBase()) && isset($this->types[$baseType]) && $this->types[$baseType] instanceof ComplexType) {
                $this->types[$type->getName()]->setBaseType($this->types[$baseType]);
            }
        }

        $this->log('Done loading types');
    }

    /**
     * Save all the loaded classes to the configured output dir
     *
     * @throws Exception If no service is loaded
     */
    protected function savePhp()
    {
        $factory = new FilterFactory();
        $filter = $factory->create($this->config);
        $filteredService = $filter->filter($this->service);
        $service = $filteredService->getClass();
        $filteredTypes = $filteredService->getTypes();
        if ($service == null) {
            throw new Exception('No service loaded');
        }

        $output = new OutputManager($this->config);

        // Generate all type classes
        $types = array();
        foreach ($filteredTypes as $type) {
            $class = $type->getClass();
            if ($class != null) {
                $types[] = $class;
            }
        }

        $output->save($service, $types);
    }

    /**
     * Logs a message.
     *
     * @param string $message The message to log
     * @param string $level
     */
    protected function log($message, $level = 'notice')
    {
        if (isset($this->logger)) {
            $this->logger->log($level, $message);
        }
    }

    /**
     * @inherit
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Method[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return null|Service
     */
    public function getService()
    {
        return $this->service;
    }

    public function getDefinition()
    {
        return [
            'methods' => $this->getMethods(),
            'locations' => $this->getLocations(),
            'service' => $this->service->getIdentifier(),
        ];
    }

    /**
     * @return mixed
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * 列出可能的location
     *
     * @param $wsdl
     */
    public function setLocations($wsdl)
    {
        $data = @file_get_contents($wsdl);
        $urls = [];
        if ($data) {
            preg_match('/location=["\'](.*)["\']/', $data, $matches);
            if (isset($matches[1])) {
                $location = new Location($matches[1]);
                $urls[] = strtolower($matches[1]);
                $this->locations[] = $location;
            }
        }
        if (filter_var($wsdl, FILTER_VALIDATE_URL)) {
            $wsdl = preg_replace('/\?.*/', '', $wsdl);
            if (\in_array(strtolower($wsdl), $urls, true)) return;
            $location = new Location($wsdl);
            $this->locations[] = $location;
        }
    }

    /**
     * @param $wsdl
     * @return string
     */
    public function saveWsdl($wsdl)
    {
        $outputPath = $this->config->get('outputPath');
        if (filter_var($wsdl, FILTER_VALIDATE_URL)) {
            $options['ssl'] = [
                'verify_peer' => false,
                'verify_peer_name' => false
            ];

            $context = stream_context_create($options);
            // http请求
            copy($wsdl, $outputPath, $context);
        } else {
            // 上传文件
            copy($wsdl, $outputPath);
        }
    }

    /**
     * Loads the method class
     */
    protected function loadMethods()
    {
        $types = $this->types;
        foreach ($this->methodKeys as $key => $value) {
            $inTypeKey = $value['soapIn'];
            $outTypeKey = $value['soapOut'];
            $method = new Method($inTypeKey, $outTypeKey);
            $method->setName($key);

            // in
            if (!array_key_exists($inTypeKey, $types)) {
                $method->setIsOrder(true);
                if(!\is_array($value['paramsIn'])){
                    $value['paramsIn'] = array();
                }
                $method->setParamsIn($value['paramsIn']);
            }else {
                /** @var ComplexType $inType */
                $inType = $types[$inTypeKey];
                $paramsInMembers = $inType->getMembers();
                $inTypeBaseType = $inType->getBaseType();
                if ($inTypeBaseType !== null) {
                    $paramsInMembers = array_merge($paramsInMembers, $inTypeBaseType->getMembers());
                }
                $method->setParamsIn($paramsInMembers);
            }

            //out
            if (!array_key_exists($outTypeKey, $types)) {
                if(!\is_array($value['paramsOut'])){
                    $value['paramsOut'] = array();
                }
                $method->setParamsOut($value['paramsOut']);
            }else {
                /** @var ComplexType $outType */
                $outType = $types[$outTypeKey];
                $paramsOutMembers = $outType->getMembers();
                $outTypeBaseType = $outType->getBaseType();
                if($outTypeBaseType !== null){
                    $paramsOutMembers = array_merge($paramsOutMembers,$outTypeBaseType->getMembers());
                }
                $method->setParamsOut($paramsOutMembers);
            }

            $this->methods[] = $method;
        }
    }
}
