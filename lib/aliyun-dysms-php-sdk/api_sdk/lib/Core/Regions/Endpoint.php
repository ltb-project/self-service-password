<?php

namespace Aliyun\Core\Regions;

class Endpoint
{
	private $name;
	private $regionIds; 
	private $productDomains;
	
	function  __construct($name, $regionIds, $productDomains)
	{
		$this->name = $name;
		$this->regionIds = $regionIds;
		$this->productDomains = $productDomains;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getRegionIds()
	{
		return $this->regionIds;
	}
	
	public function setRegionIds($regionIds)
	{
		$this->regionIds = $regionIds;
	}
	
	public function getProductDomains()
	{
		return $this->productDomains;
	}
	
	public function setProductDomains($productDomains)
	{
		$this->productDomains = $productDomains;
	}
}