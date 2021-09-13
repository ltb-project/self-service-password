<?php

namespace Aliyun\Api\Sms\Request\V20170525;

use Aliyun\Core\RpcAcsRequest;

class QuerySendDetailsRequest extends RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Dysmsapi", "2017-05-25", "QuerySendDetails");
		$this->setMethod("POST");
	}

	private  $sendDate;

	private  $pageSize;

	private  $phoneNumber;

	private  $resourceOwnerAccount;

	private  $currentPage;

	private  $bizId;

	private  $resourceOwnerId;

	private  $ownerId;

	public function getSendDate() {
		return $this->sendDate;
	}

	public function setSendDate($sendDate) {
		$this->sendDate = $sendDate;
		$this->queryParameters["SendDate"]=$sendDate;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->queryParameters["PageSize"]=$pageSize;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		$this->queryParameters["PhoneNumber"]=$phoneNumber;
	}

	public function getResourceOwnerAccount() {
		return $this->resourceOwnerAccount;
	}

	public function setResourceOwnerAccount($resourceOwnerAccount) {
		$this->resourceOwnerAccount = $resourceOwnerAccount;
		$this->queryParameters["ResourceOwnerAccount"]=$resourceOwnerAccount;
	}

	public function getCurrentPage() {
		return $this->currentPage;
	}

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
		$this->queryParameters["CurrentPage"]=$currentPage;
	}

	public function getBizId() {
		return $this->bizId;
	}

	public function setBizId($bizId) {
		$this->bizId = $bizId;
		$this->queryParameters["BizId"]=$bizId;
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
	
}