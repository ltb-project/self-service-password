<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';

class HashOldPasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test hash_old_password function
     */
    public function testHashOldPassword()
    {

        # Load functions
        require_once("lib/functions.inc.php");

		$candidate_password = "hello_S3lfServ1ce";
		
		# Test SSHA hashed password
		$ldap_password = '{SSHA}/oFcrDRwH5K6Gv3ng1D9I+m32ftIpGivlUB6jw=='; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test SHA1 hashed password
		$ldap_password = '{SHA}cxMgpYJFOW1BPAkO4tbAHXwz9Z0='; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test SHA512 hashed password
		$ldap_password = '{SHA512}Eg8xKRGYinaxsrM4edoROEUcQoqFRDI3Slcg5wWig80g1VpYFx+DQVqA++TN2B44XDoSMjRkwCOcgrRS+wsS1g=='; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test SMD5 hashed password
		$ldap_password = '{SMD5}xT4bI4kPLtAmUYjmRqT2t0H+PTHjFY4C'; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test MD5 hashed password
		$ldap_password = '{MD5}iNCvX+AiYnAeZoORPjwOuw=='; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		
		# Test CRYPT hashed password - standard DES
		$ldap_password = '{CRYPT}WCFar/a24WRlk'; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - extended DES
		$ldap_password = '{CRYPT}_6uVCtbvym/90wKTIrKY'; 
		# Generated using random 8-chars string from https://www.random.org/strings/ and https://quickhash.com/ Extended DES algorithm
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - md5 hash
		$ldap_password = '{CRYPT}$1$akUYgSg4$WQceCqgPDPgefRr/Zutj70'; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - Blowfish hash with 2a
		$ldap_password = '{CRYPT}$2a$06$1ZJSTvTH9xju5zGUoXuMIuDSFw57SLYopcqamCKQYeUgfeUbndMNW'; 
		# Above password generated using random string from https://www.random.org/strings/ and http://php.fnlist.com/crypt_hash/crypt online calculation
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - Blowfish hash with 2y
		$ldap_password = '{CRYPT}$2y$06$1ZJSTvTH9xju5zGUoXuMIuDSFw57SLYopcqamCKQYeUgfeUbndMNW';
		# Above password generated using random string from https://www.random.org/strings/ and http://php.fnlist.com/crypt_hash/crypt online calculation
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - sha256 sum
		$ldap_password = '{CRYPT}$5$4mxifKQN$PRzssKp/vzWdcN3QNXSOuutw7vbS6pR4hgtp9AboH83'; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - sha256 sum with custom rounds value
		$ldap_password = '{CRYPT}$5$rounds=12345$eKNy1/RDIlJ$gehYUSLkKuhof/Sbp.N7XHdAe/U6hi1G9ZrdEgDbPx8'; 
		#Above pass obtained via linux command :  echo "username:hello_S3lfServ1ce" | chpasswd -c SHA256 -s 12345 and copying /etc/shadow value
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - sha512 sum
		$ldap_password = '{CRYPT}$6$T87Jnfqj$6gdQfurLrxU0E6TxzdiklrT1QTDPFTO06vIkDBN2Frx4WMJNr.uMWUm4basMbu8D7mEFVFxXkEED72DNPzoYH.'; # Obtained via Apache Directory Studio
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
		
		# Test CRYPT hashed password - sha512 sum with custom rounds value
		$ldap_password = '{CRYPT}$6$rounds=12345$mgoMm/FzDwtJjkr$j0zvqlK9Tn/iTpEgnKFMCW8us1x.ex54qpzljcCXZfVJL2FHvNg7t2fjdCfqKb7HNMvRC838XdJdiyUmaIkzs/'; 
		#Above pass obtained via linux command :  echo "username:hello_S3lfServ1ce" | chpasswd -c SHA512 -s 12345 and copying /etc/shadow value
		$candidate_hashed = hash_old_password($ldap_password, $candidate_password);
		$this->assertEquals($ldap_password, $candidate_hashed);
    }
}

