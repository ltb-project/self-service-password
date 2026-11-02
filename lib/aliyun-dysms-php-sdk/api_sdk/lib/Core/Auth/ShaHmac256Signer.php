<?php

namespace Aliyun\Core\Auth;

class ShaHmac256Signer implements ISigner
{
	public function signString($source, $accessSecret)
	{
		return	base64_encode(hash_hmac('sha256', $source, $accessSecret, true));
	}
	
	public function  getSignatureMethod() {
		return "HMAC-SHA256";
	}

	public function getSignatureVersion() {
		return "1.0";
	}

}