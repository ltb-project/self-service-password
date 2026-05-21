<?php

namespace Aliyun\Core;

abstract class RpcAcsRequest extends AcsRequest
{
	private $dateTimeFormat = 'Y-m-d\TH:i:s\Z'; 
	private $domainParameters = array();
	
	function  __construct($product, $version, $actionName)
	{
		parent::__construct($product, $version, $actionName);
		$this->initialize();
	}
	
	private function initialize()
	{
		$this->setMethod("GET");	
		$this->setAcceptFormat("JSON");
	}
	

    private function prepareValue($value)
    {
        if (is_bool($value)) {
            if ($value) {
                return "true";
            } else {
                return "false";
            }
        } else {
            return $value;
        }
    }

	public function composeUrl($iSigner, $credential, $domain)
	{
		$apiParams = parent::getQueryParameters();
        foreach ($apiParams as $key => $value) {
            $apiParams[$key] = $this->prepareValue($value);
        }
		$apiParams["RegionId"] = $this->getRegionId();
		$apiParams["AccessKeyId"] = $credential->getAccessKeyId();
		$apiParams["Format"] = $this->getAcceptFormat();
		$apiParams["SignatureMethod"] = $iSigner->getSignatureMethod();
		$apiParams["SignatureVersion"] = $iSigner->getSignatureVersion();
        $apiParams["SignatureNonce"] = md5(uniqid(mt_rand(), true));
        $apiParams["Timestamp"] = gmdate($this->dateTimeFormat);
		$apiParams["Action"] = $this->getActionName();
		$apiParams["Version"] = $this->getVersion();
		$apiParams["Signature"] = $this->computeSignature($apiParams, $credential->getAccessSecret(), $iSigner);
		if(parent::getMethod() == "POST") {
			
			$requestUrl = $this->getProtocol()."://". $domain . "/";			
			foreach ($apiParams as $apiParamKey => $apiParamValue)
			{
				$this->putDomainParameters($apiParamKey,$apiParamValue);
			}
			return $requestUrl;
		}
		else {	
			$requestUrl = $this->getProtocol()."://". $domain . "/?";

			foreach ($apiParams as $apiParamKey => $apiParamValue)
			{
				$requestUrl .= "$apiParamKey=" . urlencode($apiParamValue) . "&";
			}
			return substr($requestUrl, 0, -1);
		}
	}
	
	private function computeSignature($parameters, $accessKeySecret, $iSigner)
	{
	    ksort($parameters);
	    $canonicalizedQueryString = '';
	    foreach($parameters as $key => $value)
	    {
			$canonicalizedQueryString .= '&' . $this->percentEncode($key). '=' . $this->percentEncode($value);
	    }
	    $stringToSign = parent::getMethod().'&%2F&' . $this->percentencode(substr($canonicalizedQueryString, 1));
	    $signature = $iSigner->signString($stringToSign, $accessKeySecret."&");

	    return $signature;
	}
	
	protected function percentEncode($str)
	{
	    $res = urlencode($str);
	    $res = preg_replace('/\+/', '%20', $res);
	    $res = preg_replace('/\*/', '%2A', $res);
	    $res = preg_replace('/%7E/', '~', $res);
	    return $res;
	}
	
	public function getDomainParameter()	
	{
		return $this->domainParameters;
	}
	
	public function putDomainParameters($name, $value)
	{
		$this->domainParameters[$name] = $value;
	}
	
}
