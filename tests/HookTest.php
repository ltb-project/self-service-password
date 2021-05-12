<?php

class HookTest extends \PHPUnit_Framework_TestCase
{
    public function testCommand()
    {
        # Load functions
        require_once("lib/functions.inc.php");

        $login = "jdoe";
        $newpassword = "jane";
        $oldpassword = "john";
        $hook = "/usr/local/bin/hook.sh";

        $this->assertEquals("/usr/local/bin/hook.sh 'jdoe' 'jane' 'john'", hook_command($hook, $login, $newpassword, $oldpassword) );
        $this->assertEquals("/usr/local/bin/hook.sh 'jdoe' 'jane'", hook_command($hook, $login, $newpassword) );
        $this->assertEquals("/usr/local/bin/hook.sh 'jdoe' amFuZQ== am9obg==", hook_command($hook, $login, $newpassword, $oldpassword, true) );
        $this->assertEquals("/usr/local/bin/hook.sh 'jdoe' amFuZQ==", hook_command($hook, $login, $newpassword, null, true) );
    }
    public function testCommandWithSpecialCharacters()
    {
        # Load functions
        require_once("lib/functions.inc.php");
        setlocale(LC_CTYPE, "en_US.UTF-8");

        $login = "jdoé";
        $newpassword = "jæne";
        $oldpassword = "jøhn";
        $hook = "/usr/local/bin/hook.sh";

        $this->assertEquals("/usr/local/bin/hook.sh 'jdoé' 'jæne' 'jøhn'", hook_command($hook, $login, $newpassword, $oldpassword) );
    }
}

