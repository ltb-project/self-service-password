<?php

namespace Aliyun\Core\Auth;

class Credential
{
	private  $dateTimeFormat = 'Y-m-d\TH:i:s\Z'; 
	private	 $refreshDate;
	private  $expiredDate;
	private  $accessKeyId;
	private  $accessSecret;
	private  $securityToken;
	
	function  __construct($accessKeyId, $accessSecret)
	{
	    $this->accessKeyId = $accessKeyId;
	    $this->accessSecret = $accessSecret;
	    $this->refreshDate = date($this->dateTimeFormat);
	}
	
	public function isExpired()
	{
		if($this->expiredDate == null)
		{
			return false;
		}
		if(strtotime($this->expiredDate)>date($this->dateTimeFormat))
		{
			return false;
		}
		return true;
	}
	
	public function getRefreshDate()
	{
		return $this->refreshDate;
	}
	
	public function getExpiredDate()
	{
		return $this->expiredDate;
	}
	
	public function setExpiredDate($expiredHours)
	{
		if($expiredHours>0)
		{
			return $this->expiredDate = date($this->dateTimeFormat, strtotime("+".$expiredHours." hour"));
		}
	}
	
	public function getAccessKeyId()
	{
		return $this->accessKeyId;
	}
	
	public function setAccessKeyId($accessKeyId)
	{
		$this->accessKeyId = $accessKeyId;
	}
	
	public function getAccessSecret()
	{
		return $this->accessSecret;
	}
	
	public function setAccessSecret($accessSecret)
	{
		$this->accessSecret = $accessSecret;
	}

}