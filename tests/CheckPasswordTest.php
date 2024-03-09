<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';

class CheckPasswordTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test check_password_strength function
     */
    public function testCheckPasswordStrength()
    {

        # Load functions
        require_once __DIR__ . '/../lib/functions.inc.php';

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
        $entry_array = array('cn' => array('common name'), 'sn' => array('surname'), 'apppwd_attribute' => array("{SSHA}7JWaNGUygodHyWt+DwPpOuYMDdKYJQQX"));
        $appconf = array(array('pwd_policy_config' => array('pwd_no_reuse' => true), 'attribute' => 'apppwd_attribute', 'hash' => "auto"));
        $appconf2 = array(array('pwd_policy_config' => array('pwd_no_reuse' => true), 'attribute' => 'apppwd_attribute', 'hash' => "SSHA"));

        $this->assertEquals("sameaslogin", check_password_strength( "coudot", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("sameasold", check_password_strength( "secret", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("forbiddenchars", check_password_strength( "p@ssword", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("minspecial", check_password_strength( "password", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("mindigit", check_password_strength( "!password", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("minupper", check_password_strength( "!1password", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("minlower", check_password_strength( "!1PASSWORD", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("toobig", check_password_strength( "!1verylongPassword", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("tooshort", check_password_strength( "!1Pa", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("sameasapppwd", check_password_strength( "!TestMe123!", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("sameasapppwd", check_password_strength( "!TestMe123!", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf2 ) );
        

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

        $this->assertEquals("notcomplex", check_password_strength( "simple", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("specialatends", check_password_strength( "!simple", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("specialatends", check_password_strength( "simple?", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("forbiddenwords", check_password_strength( "companyname", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("forbiddenwords", check_password_strength( "trademark", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("forbiddenwords", check_password_strength( "working at companyname is fun", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("forbiddenldapfields", check_password_strength( "common name", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("forbiddenldapfields", check_password_strength( "my surname", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("diffminchars", check_password_strength( "C0mplex", "C0mplexC0mplex", $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("", check_password_strength( "C0mplex", "", $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("", check_password_strength( "C0mplex", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("", check_password_strength( "C0!mplex", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
        $this->assertEquals("", check_password_strength( "%C0!mplex", $oldpassword, $pwd_policy_config, $login, $entry_array, $appconf ) );
    }

    /**
     * Test check_password_strength function with pwned passwords
     */
    public function testCheckPasswordStrengthPwnedPasswords()
    {

        # Load functions
        require_once __DIR__ . '/../lib/functions.inc.php';

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
            $appconf = array('pwd_policy_config' => array('pwd_no_reuse' => true), 'attribute' => 'apppwd_attribute', 'hash' => "auto");

            $this->assertEquals("pwned", check_password_strength( "!1Password", $oldpassword, $pwd_policy_config, $login, array(), $appconf ) );
        }

    }

    /**
     * Test check_password_strength function with weak entropy password
     */
    public function testCheckPasswordStrengthWeakEntropy()
    {

        # Load functions
        require_once __DIR__ . '/../lib/functions.inc.php';

        $login = "johnsmith";
        $oldpassword = "secret";

        if ( version_compare(PHP_VERSION, '7.2.5') >= 0 ) {
            require_once __DIR__ . '/../lib/vendor/autoload.php';
            $pwd_policy_config = array(
                "pwd_show_policy"          => true,
                "pwd_min_length"           => 6,
                "pwd_max_length"           => 0,
                "pwd_min_lower"            => 0,
                "pwd_min_upper"            => 0,
                "pwd_min_digit"            => 0,
                "pwd_min_special"          => 0,
                "pwd_special_chars"        => "^a-zA-Z0-9",
                "pwd_forbidden_chars"      => "",
                "pwd_no_reuse"             => false,
                "pwd_diff_last_min_chars"  => 0,
                "pwd_diff_login"           => false,
                "pwd_complexity"           => 0,
                "use_pwnedpasswords"       => false,
                "pwd_no_special_at_ends"   => false,
                "pwd_forbidden_words"      => array(),
                "pwd_forbidden_ldap_fields"=> array(),
                "pwd_display_entropy"      => true,
                "pwd_check_entropy"        => true,
                "pwd_min_entropy"          => 3
            );

            $this->assertEquals("insufficiententropy", check_password_strength( "secret", $oldpassword, $pwd_policy_config, $login, array() ) );
        }

    }

    /**
     * Test check_password_strength function with strong entropy password
     */
    public function testCheckPasswordStrengthStrongEntropy()
    {

        # Load functions
        require_once __DIR__ . '/../lib/functions.inc.php';

        $login = "johnsmith";
        $oldpassword = "secret";

        if ( version_compare(PHP_VERSION, '7.2.5') >= 0 ) {
            require_once __DIR__ . '/../lib/vendor/autoload.php';
            $pwd_policy_config = array(
                "pwd_show_policy"          => true,
                "pwd_min_length"           => 6,
                "pwd_max_length"           => 0,
                "pwd_min_lower"            => 0,
                "pwd_min_upper"            => 0,
                "pwd_min_digit"            => 0,
                "pwd_min_special"          => 0,
                "pwd_special_chars"        => "^a-zA-Z0-9",
                "pwd_forbidden_chars"      => "",
                "pwd_no_reuse"             => false,
                "pwd_diff_last_min_chars"  => 0,
                "pwd_diff_login"           => false,
                "pwd_complexity"           => 0,
                "use_pwnedpasswords"       => false,
                "pwd_no_special_at_ends"   => false,
                "pwd_forbidden_words"      => array(),
                "pwd_forbidden_ldap_fields"=> array(),
                "pwd_display_entropy"      => true,
                "pwd_check_entropy"        => true,
                "pwd_min_entropy"          => 3
            );

            $this->assertEquals("", check_password_strength( "Th!Sis@Str0ngP@ss0rd", $oldpassword, $pwd_policy_config, $login, array() ) );
        }

    }

}
