<?php

namespace Aliyun\Core\Profile;

use Aliyun\Core\Auth\Credential;
use Aliyun\Core\Auth\ShaHmac1Signer;
use Aliyun\Core\Regions\ProductDomain;
use Aliyun\Core\Regions\Endpoint;
use Aliyun\Core\Regions\EndpointProvider;

class DefaultProfile implements IClientProfile
{
	private static $profile;
	private static $endpoints;
	private static $credential;
	private static $regionId;
	private static $acceptFormat;
	
	private static $isigner;
	private static $iCredential;
	
	private function  __construct($regionId,$credential)
	{
	    self::$regionId = $regionId;
	    self::$credential = $credential;
	}
	
	public static function getProfile($regionId, $accessKeyId, $accessSecret)
	{
		$credential =new Credential($accessKeyId, $accessSecret);
		self::$profile = new DefaultProfile($regionId, $credential);
		return self::$profile;
	}
	
	public function getSigner()
	{
		if(null == self::$isigner)
		{
			self::$isigner = new ShaHmac1Signer(); 
		}
		return self::$isigner;
	}
	
	public function getRegionId()
	{
		return self::$regionId;
	}
	
	public function getFormat()
	{
		return self::$acceptFormat;
	}
	
	public function getCredential()
	{
		if(null == self::$credential && null != self::$iCredential)
		{
			self::$credential = self::$iCredential;
		}
		return self::$credential;
	}
	
	public static function getEndpoints()
	{
		if(null == self::$endpoints)
		{
			self::$endpoints = EndpointProvider::getEndpoints();
		}
		return self::$endpoints;
	}
	
	public static function addEndpoint($endpointName, $regionId, $product, $domain)
	{
		if(null == self::$endpoints)
		{
			self::$endpoints = self::getEndpoints();
		}
		$endpoint = self::findEndpointByName($endpointName);
		if(null == $endpoint)
		{
			self::addEndpoint_($endpointName, $regionId, $product, $domain);
		}
		else 
		{
			self::updateEndpoint($regionId, $product, $domain, $endpoint);
		}
	}
	
	public static function findEndpointByName($endpointName)
	{
		foreach (self::$endpoints as $key => $endpoint)
		{
			if($endpoint->getName() == $endpointName)
			{
				return $endpoint;
			}
		}
	}
	
	private static function addEndpoint_($endpointName,$regionId, $product, $domain)
	{
		$regionIds = array($regionId);
		$productDomains = array(new ProductDomain($product, $domain));
		$endpoint = new Endpoint($endpointName, $regionIds, $productDomains);
		array_push(self::$endpoints, $endpoint);
	}
	
	private static function updateEndpoint($regionId, $product, $domain, $endpoint)
	{
		$regionIds = $endpoint->getRegionIds();
		if(!in_array($regionId,$regionIds))
		{
			array_push($regionIds, $regionId);
			$endpoint->setRegionIds($regionIds);
		}

		$productDomains = $endpoint->getProductDomains();
		if(null == self::findProductDomain($productDomains, $product, $domain))
		{
		 	array_push($productDomains, new ProductDomain($product, $domain));	
		}
		$endpoint->setProductDomains($productDomains);
	}
	
	private static function findProductDomain($productDomains, $product, $domain)
	{
		foreach ($productDomains as $key => $productDomain)
		{
			if($productDomain->getProductName() == $product && $productDomain->getDomainName() == $domain)
			{
				return $productDomain;
			}
		}
		return null;
	}

}