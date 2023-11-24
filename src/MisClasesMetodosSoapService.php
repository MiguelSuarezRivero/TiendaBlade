<?php

namespace MisClases;

class MisClasesMetodosSoapService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
    );

    /**
     * @param string $wsdl The wsdl file to use
     * @param array $wsSecurity A array of wsSecurity values
     * @param array $options A array of config values
     */
    public function __construct(array $options = array(), array $wsSecurity = array(), $wsdl = null)
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      if (!$wsdl) {
        $wsdl = __DIR__.'/wsdl.xml';
      }
      if($wsSecurity){
        $this->setSoapHeader($wsSecurity);
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * Obtiene el Stock de todos los productos.
     *
     * @return Array
     */
    public function getStock()
    {
      return $this->__soapCall('getStock', array());
    }

    /**
     * add ws-security header
     *
     * @param array $wsSecurity ws-security config
     */
    private function setSoapHeader($wsSecurity)
    {
      $username = $wsSecurity['username'];
      $password = $wsSecurity['password'];
      $namespace = $wsSecurity['namespace'];
      $username = new \SoapVar($username, XSD_STRING, null, null, 'Username', $namespace);
      $password = new \SoapVar($password, XSD_STRING, null, null, 'Password', $namespace);
      $usernameToken = new \SoapVar(array($username, $password), SOAP_ENC_OBJECT, null, null, 'UsernameToken', $namespace);
      $usernameToken = new \SoapVar(array($usernameToken), SOAP_ENC_OBJECT, null, null, 'Security', $namespace);
      $wssTokenHeader = new \SoapHeader($namespace, 'Security', $usernameToken);
      $this->__setSoapHeaders($wssTokenHeader);
    }

}
