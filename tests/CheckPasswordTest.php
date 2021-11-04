<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';

use PHPUnit\Framework\TestCase;

class CheckPasswordTest extends TestCase
{
    /**
     * Test check_password_strength function
     */
    public function testCheckPasswordStrength()
    {

        # Load functions
        require_once("lib/functions.inc.php");

        # Password policy
        $pwd_policy_config = array(
            "pwd_show_policy"         => true,
            "pwd_min_length"          => 6,
            "pwd_max_length"          => 12,
            "pwd_min_lower"           => 1,
            "pwd_min_upper"           => 1,
            "pwd_min_digit"           => 1,
            "pwd_min_special"         => 1,
            "pwd_special_chars"       => "^a-zA-Z0-9",
            "pwd_forbidden_chars"     => "@",
            "pwd_no_reuse"            => true,
            "pwd_diff_last_min_chars" => 0,
            "pwd_diff_login"          => true,
            "pwd_complexity"          => 0,
            "use_pwnedpasswords"      => false,
            "pwd_no_special_at_ends"  => false,
            "pwd_forbidden_words"     => array(),
            "pwd_forbidden_ldap_fields"=> array(),
        );

        $login = "coudot";
        $oldpassword = "secret";
        $entry = array('cn' => array('common name'), 'sn' => array('surname'));

        $this->assertEquals("sameaslogin", check_password_strength( "coudot", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("sameasold", check_password_strength( "secret", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("forbiddenchars", check_password_strength( "p@ssword", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("minspecial", check_password_strength( "password", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("mindigit", check_password_strength( "!password", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("minupper", check_password_strength( "!1password", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("minlower", check_password_strength( "!1PASSWORD", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("toobig", check_password_strength( "!1verylongPassword", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("tooshort", check_password_strength( "!1Pa", $oldpassword, $pwd_policy_config, $login, $entry ) );

        $pwd_policy_config = array(
            "pwd_show_policy"         => true,
            "pwd_min_length"          => 6,
            "pwd_max_length"          => 12,
            "pwd_min_lower"           => 0,
            "pwd_min_upper"           => 0,
            "pwd_min_digit"           => 0,
            "pwd_min_special"         => 0,
            "pwd_special_chars"       => "^a-zA-Z0-9",
            "pwd_forbidden_chars"     => "@",
            "pwd_no_reuse"            => true,
            "pwd_diff_last_min_chars" => 3,
            "pwd_diff_login"          => true,
            "pwd_complexity"          => 3,
            "use_pwnedpasswords"      => false,
            "pwd_no_special_at_ends"  => true,
            "pwd_forbidden_words"     => array('companyname', 'trademark'),
            "pwd_forbidden_ldap_fields"=> array('cn', 'sn'),
        );

        $this->assertEquals("notcomplex", check_password_strength( "simple", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("specialatends", check_password_strength( "!simple", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("specialatends", check_password_strength( "simple?", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("forbiddenwords", check_password_strength( "companyname", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("forbiddenwords", check_password_strength( "trademark", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("forbiddenwords", check_password_strength( "working at companyname is fun", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("forbiddenldapfields", check_password_strength( "common name", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("forbiddenldapfields", check_password_strength( "my surname", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("diffminchars", check_password_strength( "C0mplex", "C0mplexC0mplex", $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("", check_password_strength( "C0mplex", "", $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("", check_password_strength( "C0mplex", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("", check_password_strength( "C0!mplex", $oldpassword, $pwd_policy_config, $login, $entry ) );
        $this->assertEquals("", check_password_strength( "%C0!mplex", $oldpassword, $pwd_policy_config, $login, $entry ) );
    }

    /**
     * Test check_password_strength function with pwned passwords
     */
    public function testCheckPasswordStrengthPwnedPasswords()
    {

        # Load functions
        require_once("lib/functions.inc.php");

        $login = "coudot";
        $oldpassword = "secret";

        if ( version_compare(PHP_VERSION, '7.2.5') >= 0 ) {
            //require_once __DIR__ . '/../lib/vendor/mxrxdxn/pwned-passwords/src/PwnedPasswords/PwnedPasswords.php';
            require_once __DIR__ . '/../lib/vendor/autoload.php';
            $pwd_policy_config = array(
                "pwd_show_policy"         => true,
                "pwd_min_length"          => 6,
                "pwd_max_length"          => 12,
                "pwd_min_lower"           => 1,
                "pwd_min_upper"           => 1,
                "pwd_min_digit"           => 1,
                "pwd_min_special"         => 1,
                "pwd_special_chars"       => "^a-zA-Z0-9",
                "pwd_forbidden_chars"     => "@",
                "pwd_no_reuse"            => true,
                "pwd_diff_last_min_chars" => 0,
                "pwd_diff_login"          => true,
                "pwd_complexity"          => 0,
                "use_pwnedpasswords"      => true,
                "pwd_no_special_at_ends"  => false,
                "pwd_forbidden_words"     => array(),
                "pwd_forbidden_ldap_fields"=> array(),
            );

            $this->assertEquals("pwned", check_password_strength( "!1Password", $oldpassword, $pwd_policy_config, $login, array() ) );
        }

    }

}
