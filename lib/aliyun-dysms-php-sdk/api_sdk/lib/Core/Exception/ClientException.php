<?php

namespace Aliyun\Core\Exception;

class ClientException extends \Exception
{
    function  __construct($errorMessage, $errorCode)
    {
        parent::__construct($errorMessage);
        $this->errorMessage = $errorMessage;
        $this->errorCode = $errorCode;
        $this->setErrorType("Client");
    }
    
    private $errorCode;
    private $errorMessage;
    private $errorType;
    
    public function getErrorCode()
    {
        return $this->errorCode;
    }
    
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }
    
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
    
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
    
    public function getErrorType()
    {
        return $this->errorType;
    }
    
    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;
    }
    

}
