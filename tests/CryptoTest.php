<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';
require_once __DIR__ . '/../lib/functions.inc.php';

class CryptoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test encrypt and decrypt functions
     */
    public function testEncryptionAndDecryption()
    {
        // first encrypt use case : phone number + login
        $plaintext1 = "+33123456789:ldap_username";

        // second encrypt use case : session_id
        $plaintext2 = "azAZ09,-";

        // secret from config
        $passphrase = "secret";

        $encrypted1 = encrypt($plaintext1, $passphrase);
        $decrypted1 = decrypt($encrypted1, $passphrase);

        $this->assertNotEquals($plaintext1, $encrypted1);
        $this->assertEquals($plaintext1, $decrypted1);

        $encrypted2 = encrypt($plaintext2, $passphrase);
        $decrypted2 = decrypt($encrypted2, $passphrase);

        $this->assertNotEquals($plaintext2, $encrypted2);
        $this->assertEquals($plaintext2, $decrypted2);
    }
}

