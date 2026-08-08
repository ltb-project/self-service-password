<?php

namespace Aliyun\Core\Regions;

class EndpointProvider
{
	private static $endpoints;
	
	public static function findProductDomain($regionId, $product)
	{
		if(null == $regionId || null == $product || null == self::$endpoints)
		{
			return null;
		}
		
		foreach (self::$endpoints as $key => $endpoint)
		{
			if(in_array($regionId, $endpoint->getRegionIds()))
			{
			 	return self::findProductDomainByProduct($endpoint->getProductDomains(), $product);
			}	
		}
		return null;
	}
	
	private static function findProductDomainByProduct($productDomains, $product)
	{
		if(null == $productDomains)
		{
			return null;
		}
		foreach ($productDomains as $key => $productDomain)
		{
			if($product == $productDomain->getProductName())
			{
				return $productDomain->getDomainName();
			}
		}
		return null;
	}
	
	
	public static function getEndpoints()
	{
		return self::$endpoints;
	}
	
	public static function setEndpoints($endpoints)
	{
		self::$endpoints = $endpoints;
	}
	
}