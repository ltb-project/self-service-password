<?php

namespace PwnedPasswords;

use RuntimeException;
use InvaliArgumentException;

class PwnedPasswords
{
    const API = 'https://api.pwnedpasswords.com/range/';
	
    const CURL = 2;
    
    const FILE = 4;
    
    /**
    * cached result 
    * @var array $cache
    */
    private $cache;
    
    /**
    * 
    * @var array $options 
    */
    private $options;
    
    public function __construct() 
    {
        $this->cache = [];
    	$this->options = [
		'curl' => [],
		'method' => null
	];
    }
	
    public function setMethod($method) 
    {
	$this->options['method'] = $method;
	
	return $this;
    }
	
    public function setCurlOptions(array $options = []) 
    {
    	$this->options['curl'] = $options;

	return $this;
    }
	
    public function clearCache() 
    {
        $this->cache = [];
	    
	return $this;
    }
    
    private function fetch(string $url): string
    {
	if($this->options['method'] === null) {
		try {
			return $this->fetchCurl($url);
		} catch (RuntimeException $e) {
			return $this->fetchFile($url);
		}
	} elseif($this->options['method'] === static::CURL) {   
		return $this->fetchCurl($url);
	} elseif ($this->options['method'] === static::FILE) {
            return $this->fetchFile($url);
        } else {
            throw new InvaliArgumentException("Unsupported method {$this->options['method']}");   
        }
    }
    
    private function fetchFile(string $file): string
    {
	$opts = [
		'http'=> [
			'method'=>"GET",
		]
	];
		
	$response = file_get_contents($file, false, stream_context_create($opts));   
		
	if($response === false) {
		throw new RuntimeException('Failed to open stream.');
	}
		
	return (string) $response;
    }
    
    private function fetchCurl(string $url): string 
    {
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'method' => 'GET' ] );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
        
	foreach($this->options['curl'] as $option => $value) {
            curl_setopt( $ch, $option, $value);   
        }
        
	$response = curl_exec($ch);
        
	if(curl_errno($ch) !== 0) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new RuntimeException($error);
        }
        
	curl_close($ch);	
	
	return $response;
    }
    
    public function getCount(string $input): int
    {
        if( $input === '') {
		throw new InvaliArgumentException('password cannot be empty.');
	}
        
        $password = strtoupper(sha1($input));
		
        unset($input);
        
        if(isset($this->cache[$password])) {
            return $this->cache[$password];   
        }
        
	$this->cache[$password] = 0;
        $prefix = substr($password, 0, 5);
        $url = static::API . $prefix;
        $result = explode(PHP_EOL, $this->fetch($url));
        
	foreach ($result as $line) {
            list($hash,$count) = explode(':', $line);
            if (trim(strtoupper($prefix . $hash)) === $password) {
                $this->cache[$password] = (int) $count;
            }
        }

	return $this->cache[$password];
    }

    /**
     * @param string $password
     * @return bool
     */
    public function isInsecure(string $password): bool
    {
        return $this->getCount($password) > 0 ;
    }
}
