<?php

namespace App\Tests\Service;

use App\Service\PasswordStrengthChecker;

class PasswordStrengthCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test check_password_strength function
     */
    public function testCheckPasswordStrength()
    {
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

        $passwordStrengthChecker = new PasswordStrengthChecker($pwd_policy_config);

        $this->assertEquals("sameaslogin", $passwordStrengthChecker->evaluate( "coudot", $oldpassword, $login ) );
        $this->assertEquals("sameasold", $passwordStrengthChecker->evaluate( "secret", $oldpassword, $login ) );
        $this->assertEquals("forbiddenchars", $passwordStrengthChecker->evaluate( "p@ssword", $oldpassword, $login ) );
        $this->assertEquals("minspecial", $passwordStrengthChecker->evaluate( "password", $oldpassword, $login ) );
        $this->assertEquals("mindigit", $passwordStrengthChecker->evaluate( "!password", $oldpassword, $login ) );
        $this->assertEquals("minupper", $passwordStrengthChecker->evaluate( "!1password", $oldpassword, $login ) );
        $this->assertEquals("minlower", $passwordStrengthChecker->evaluate( "!1PASSWORD", $oldpassword, $login ) );
        $this->assertEquals("toobig", $passwordStrengthChecker->evaluate( "!1verylongPassword", $oldpassword, $login ) );
        $this->assertEquals("tooshort", $passwordStrengthChecker->evaluate( "!1Pa", $oldpassword, $login ) );

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

        $passwordStrengthChecker = new PasswordStrengthChecker($pwd_policy_config);

        $this->assertEquals("notcomplex", $passwordStrengthChecker->evaluate( "simple", $oldpassword, $login ) );
        $this->assertEquals("", $passwordStrengthChecker->evaluate( "C0mplex", $oldpassword, $login ) );

    }
}

