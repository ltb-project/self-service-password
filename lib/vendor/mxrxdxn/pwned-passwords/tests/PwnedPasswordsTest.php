<?php

use PwnedPasswords\Exceptions\InvalidPasswordException;
use PwnedPasswords\PwnedPasswords;

class PwnedPasswordsTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function a_password_can_be_validated()
    {
        // Init the PwnedPasswords class
        $pwnedPasswords = new PwnedPasswords();

        // Test that a common "known" password appears correctly in the Pwned Passwords API
        $this->assertTrue($pwnedPasswords->isPwned("password"));

        // Test that a "random" password does not appear in the Pwned Passwords API
        // This password may be in the API (but very unlikely)
        $this->assertFalse($pwnedPasswords->isPwned("!!!PaSsWoRd " . mt_rand(100000000, 999999999)));
    }

    /** @test */
    public function empty_passwords_throw_an_invalid_password_exception()
    {
        $this->expectException(InvalidPasswordException::class);

        $pwnedPasswords = new PwnedPasswords();
        $pwnedPasswords->isPwned('');
    }

    /** @test */
    public function a_number_of_hits_per_password_can_be_retrieved()
    {
        // Init the PwnedPasswords class
        $pwnedPasswords = new PwnedPasswords();

        // Test that a common "known" password appears correctly in the Pwned Passwords API
        $this->assertGreaterThan(0, $pwnedPasswords->isPwned("password", true));

        // Test that a "random" password does not appear in the Pwned Passwords API
        // This password may be in the API (but very unlikely)
        $this->assertEquals(0, $pwnedPasswords->isPwned("!!!PaSsWoRd " . mt_rand(100000000, 999999999), true));
    }
}
