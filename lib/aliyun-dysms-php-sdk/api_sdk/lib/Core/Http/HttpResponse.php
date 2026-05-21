<?php

namespace Aliyun\Core\Http;

class HttpResponse
{
	private $body;
	private $status;
	
	public function getBody()
	{
		return $this->body;
	}
	
	public function setBody($body)
	{
		$this->body = $body;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status  = $status;
	}
	
	public function isSuccess()
	{
		if(200 <= $this->status && 300 > $this->status)
		{
			return true;
		}
		return false;
	}
}