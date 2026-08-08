<?php


namespace Aliyun\Core\Exception;

class ServerException extends ClientException
{
    private $httpStatus;
    private $requestId;

    function  __construct($errorMessage, $errorCode, $httpStatus, $requestId)
    {
        $messageStr = $errorCode . " " . $errorMessage . " HTTP Status: " . $httpStatus . " RequestID: " . $requestId;
        parent::__construct($messageStr, $errorCode);
        $this->setErrorMessage($errorMessage);
        $this->setErrorType("Server");
        $this->httpStatus = $httpStatus;
        $this->requestId = $requestId;
    }

    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

}
