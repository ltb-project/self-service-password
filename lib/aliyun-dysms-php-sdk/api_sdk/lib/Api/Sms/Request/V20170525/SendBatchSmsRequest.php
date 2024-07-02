<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace Aliyun\Api\Sms\Request\V20170525;

use Aliyun\Core\RpcAcsRequest;

class SendBatchSmsRequest extends RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Dysmsapi", "2017-05-25", "SendBatchSms");
		$this->setMethod("POST");
	}

	private  $templateCode;

	private  $templateParamJson;

	private  $resourceOwnerAccount;

	private  $smsUpExtendCodeJson;

	private  $resourceOwnerId;

	private  $signNameJson;

	private  $ownerId;

	private  $phoneNumberJson;

	public function getTemplateCode() {
		return $this->templateCode;
	}

	public function setTemplateCode($templateCode) {
		$this->templateCode = $templateCode;
		$this->queryParameters["TemplateCode"]=$templateCode;
	}

	public function getTemplateParamJson() {
		return $this->templateParamJson;
	}

	public function setTemplateParamJson($templateParamJson) {
		$this->templateParamJson = $templateParamJson;
		$this->queryParameters["TemplateParamJson"]=$templateParamJson;
	}

	public function getResourceOwnerAccount() {
		return $this->resourceOwnerAccount;
	}

	public function setResourceOwnerAccount($resourceOwnerAccount) {
		$this->resourceOwnerAccount = $resourceOwnerAccount;
		$this->queryParameters["ResourceOwnerAccount"]=$resourceOwnerAccount;
	}

	public function getSmsUpExtendCodeJson() {
		return $this->smsUpExtendCodeJson;
	}

	public function setSmsUpExtendCodeJson($smsUpExtendCodeJson) {
		$this->smsUpExtendCodeJson = $smsUpExtendCodeJson;
		$this->queryParameters["SmsUpExtendCodeJson"]=$smsUpExtendCodeJson;
	}

	public function getResourceOwnerId() {
		return $this->resourceOwnerId;
	}

	public function setResourceOwnerId($resourceOwnerId) {
		$this->resourceOwnerId = $resourceOwnerId;
		$this->queryParameters["ResourceOwnerId"]=$resourceOwnerId;
	}

	public function getSignNameJson() {
		return $this->signNameJson;
	}

	public function setSignNameJson($signNameJson) {
		$this->signNameJson = $signNameJson;
		$this->queryParameters["SignNameJson"]=$signNameJson;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setOwnerId($ownerId) {
		$this->ownerId = $ownerId;
		$this->queryParameters["OwnerId"]=$ownerId;
	}

	public function getPhoneNumberJson() {
		return $this->phoneNumberJson;
	}

	public function setPhoneNumberJson($phoneNumberJson) {
		$this->phoneNumberJson = $phoneNumberJson;
		$this->queryParameters["PhoneNumberJson"]=$phoneNumberJson;
	}
	
}