<?php
/**
 * @package Wsdl2PhpGenerator
 */

namespace Wsdl2PhpGenerator;

/**
 * User: liuende
 * Date: 2018/4/13
 * Time: 上午11:00
 */
class Method implements \JsonSerializable
{
    /**
     * @var string The name of the method
     */
    private $name;

    /**
     * @var string The name of the soapIn node
     */
    private $soapIn;

    /**
     * @var array An array with Variables
     * @see Variable
     */
    private $paramsIn;

    /**
     * @var string A description of the soapOut node
     */
    private $soapOut;

    /**
     * @var array An array with Variables
     */
    private $paramsOut;

    /**
     * @var boolean a status to define params is order
     */
    private $isOrder;
    /**
     * Method constructor.
     * @param string $soapIn
     * @param string $soapOut
     */
    public function __construct($soapIn, $soapOut)
    {
        $this->soapIn = $soapIn;
        $this->soapOut = $soapOut;
        $this->setIsOrder(false);
    }


    /**
     * @return array
     */
    public function getParamsIn()
    {
        return $this->paramsIn;
    }

    /**
     * @param array|Variable[] $paramsIn
     */
    public function setParamsIn(array $paramsIn)
    {
        foreach ($paramsIn as $param) {
            if($param instanceof Variable){
                $this->paramsIn[] = $param->getName();
            }else{
                $this->paramsIn[] = $param;
            }
        }
    }

    /**
     * @return string
     */
    public function getSoapIn()
    {
        return $this->soapIn;
    }

    /**
     * @param $soapIn
     */
    public function setSoapIn($soapIn)
    {
        $this->soapIn = $soapIn;
    }

    /**
     * @return string
     */
    public function getSoapOut()
    {
        return $this->soapOut;
    }

    /**
     * @param $soapOut
     */
    public function setSoapOut($soapOut)
    {
        $this->soapOut = $soapOut;
    }


    /**
     * @return array
     */
    public function getParamsOut()
    {
        return $this->paramsOut;
    }

    /**
     * @param array|Variable[] $paramsOut
     */
    public function setParamsOut(array $paramsOut)
    {
        foreach ($paramsOut as $param) {
            if($param instanceof Variable){
                $this->paramsOut[] = $param->getName();
            }else{
                $this->paramsOut[] = $param;
            }
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'soapIn' => $this->getSoapIn(),
            'paramsIn' => $this->getParamsIn() ?? array(),
            'soapOut' => $this->getSoapOut(),
            'paramsOut' => $this->getParamsOut() ?? array()
        ];
    }

    /**
     * @return bool
     */
    public function isOrder()
    {
        return $this->isOrder;
    }

    /**
     * @param $isOrder
     */
    public function setIsOrder($isOrder)
    {
        $this->isOrder = $isOrder;
    }
}
