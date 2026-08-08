<?php

namespace Aliyun\Core\Profile;

interface IClientProfile
{
	public function getSigner();
	
	public function getRegionId();
	
	public function getFormat();
	
	public function getCredential();
}