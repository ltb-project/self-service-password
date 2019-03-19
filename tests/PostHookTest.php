<?php

class PostHookTest extends \PHPUnit_Framework_TestCase
{
    public function testCommand()
    {
        # Load functions
        require_once("lib/functions.inc.php");

        $login = "jdoe";
        $newpassword = "jane";
        $oldpassword = "john";
        $posthook = "/usr/local/bin/posthook.sh";

        $this->assertEquals("/usr/local/bin/posthook.sh 'jdoe' 'jane' 'john'", posthook_command($posthook, $login, $newpassword, $oldpassword) );
        $this->assertEquals("/usr/local/bin/posthook.sh 'jdoe' 'jane'", posthook_command($posthook, $login, $newpassword) );
        $this->assertEquals("/usr/local/bin/posthook.sh 'jdoe' amFuZQ== am9obg==", posthook_command($posthook, $login, $newpassword, $oldpassword, true) );
        $this->assertEquals("/usr/local/bin/posthook.sh 'jdoe' amFuZQ==", posthook_command($posthook, $login, $newpassword, null, true) );
    }
    public function testCommandWithSpecialCharacters()
    {
        # Load functions
        require_once("lib/functions.inc.php");
        setlocale(LC_CTYPE, "en_US.UTF-8");

        $login = "jdoé";
        $newpassword = "jæne";
        $oldpassword = "jøhn";
        $posthook = "/usr/local/bin/posthook.sh";

        $this->assertEquals("/usr/local/bin/posthook.sh 'jdoé' 'jæne' 'jøhn'", posthook_command($posthook, $login, $newpassword, $oldpassword) );
    }
}

