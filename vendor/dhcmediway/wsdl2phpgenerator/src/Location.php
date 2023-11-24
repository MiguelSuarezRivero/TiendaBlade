<?php
/**
 * User: liuende
 * Date: 2018/4/18
 * Time: 上午10:07
 */

namespace Wsdl2PhpGenerator;


class Location implements \JsonSerializable
{
    /**
     * @var String $url
     */
    private $url;

    /**
     * @var boolean $isValid
     */
    private $isValid;

    /**
     * Location constructor.
     * @param String $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }


    /**
     * @return String
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        // 为了加快解析速度,超时时间为2秒
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpCode === 200;
    }

    /**
     * @param $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
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
        return array(
          'url'=>$this->getUrl(),
          'isValid'=>$this->isValid()
        );
    }
}
