<?php

namespace Aliyun\Api\Sms\Request\V20170525;

use Aliyun\Core\RpcAcsRequest;

class SendSmsRequest extends RpcAcsRequest
{
	public function  __construct()
	{
		parent::__construct("Dysmsapi", "2017-05-25", "SendSms");
		$this->setMethod("POST");
	}

	private  $templateCode;

	private  $phoneNumbers;

	private  $signName;

	private  $resourceOwnerAccount;

	private  $templateParam;

	private  $resourceOwnerId;

	private  $ownerId;

	private  $outId;

    private  $smsUpExtendCode;

	public function getTemplateCode() {
		return $this->templateCode;
	}

	public function setTemplateCode($templateCode) {
		$this->templateCode = $templateCode;
		$this->queryParameters["TemplateCode"]=$templateCode;
	}

	public function getPhoneNumbers() {
		return $this->phoneNumbers;
	}

	public function setPhoneNumbers($phoneNumbers) {
		$this->phoneNumbers = $phoneNumbers;
		$this->queryParameters["PhoneNumbers"]=$phoneNumbers;
	}

	public function getSignName() {
		return $this->signName;
	}

	public function setSignName($signName) {
		$this->signName = $signName;
		$this->queryParameters["SignName"]=$signName;
	}

	public function getResourceOwnerAccount() {
		return $this->resourceOwnerAccount;
	}

	public function setResourceOwnerAccount($resourceOwnerAccount) {
		$this->resourceOwnerAccount = $resourceOwnerAccount;
		$this->queryParameters["ResourceOwnerAccount"]=$resourceOwnerAccount;
	}

	public function getTemplateParam() {
		return $this->templateParam;
	}

	public function setTemplateParam($templateParam) {
		$this->templateParam = $templateParam;
		$this->queryParameters["TemplateParam"]=$templateParam;
	}

	public function getResourceOwnerId() {
		return $this->resourceOwnerId;
	}

	public function setResourceOwnerId($resourceOwnerId) {
		$this->resourceOwnerId = $resourceOwnerId;
		$this->queryParameters["ResourceOwnerId"]=$resourceOwnerId;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setOwnerId($ownerId) {
		$this->ownerId = $ownerId;
		$this->queryParameters["OwnerId"]=$ownerId;
	}

	public function getOutId() {
		return $this->outId;
	}

	public function setOutId($outId) {
		$this->outId = $outId;
		$this->queryParameters["OutId"]=$outId;
	}

    public function getSmsUpExtendCode() {
        return $this->smsUpExtendCode;
    }

    public function setSmsUpExtendCode($smsUpExtendCode) {
        $this->smsUpExtendCode = $smsUpExtendCode;
        $this->queryParameters["SmsUpExtendCode"]=$smsUpExtendCode;
    }
}