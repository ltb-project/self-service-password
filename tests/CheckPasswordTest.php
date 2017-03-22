<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';

class CheckPasswordTest extends \PHPUnit_Framework_TestCase
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
            "pwd_diff_login"          => true,
            "pwd_complexity"          => 0
        );

        $login = "coudot";
        $oldpassword = "secret";

        $this->assertEquals("sameaslogin", check_password_strength( "coudot", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("sameasold", check_password_strength( "secret", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("forbiddenchars", check_password_strength( "p@ssword", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("minspecial", check_password_strength( "password", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("mindigit", check_password_strength( "!password", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("minupper", check_password_strength( "!1password", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("minlower", check_password_strength( "!1PASSWORD", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("toobig", check_password_strength( "!1verylongPassword", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("tooshort", check_password_strength( "!1Pa", $oldpassword, $pwd_policy_config, $login ) );

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
            "pwd_diff_login"          => true,
            "pwd_complexity"          => 3
        );

        $this->assertEquals("notcomplex", check_password_strength( "simple", $oldpassword, $pwd_policy_config, $login ) );
        $this->assertEquals("", check_password_strength( "C0mplex", $oldpassword, $pwd_policy_config, $login ) );

    }
}

