<?php

class CheckSshkeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test check_sshkey function
     */
    public function testCheckSshkeyValidity()
    {
	# Load functions
	require_once("lib/functions.inc.php");

	# Valid SSH Keys Configuration
	$ssh_valid_key_types = array('ssh-rsa', 'ssh-dss', 'ecdsa-sha2-nistp256', 'ssh-ed25519');

	# Sample inputs to test
	$valid_key_dsa = "ssh-dss    AAAAB3NzaC1kc3MAAACBAPk0v+w59ie8OmBDlWdBKq/8YFP9h6BbnDxUkwLNlUQ27sCdI3Ko6R/ivEC22Q+SKSF+vL8TThfRWlwhDuro0aqK/0oqwz0d8wyxwWKSlygzME7PoAA5xIxAwTSF3apxGhMkZ3xVQyVVO0P/w4nRGOYEEfmeZdR6NMtZej9UszmfAAAAFQC8QxCoKLq+0e23E50YpO+gEHKrqwAAAIAGvgIwBXV7SxhhdudjJKBpjSVc+SOM5oxMT/Yx8qfkx6nGrvsmBMtCtjkDYsYxfC/GAJK2LEvfPUah5a0U33EmfIXxSjc+MGOd90i69FKSfaa5nuGb+9T/bhevYDsJvBkvl+rWABLCnDXvqUY0ZJ5JO6mT9xD+mq7Q7hy6kZzVAgAAAIARAuLXJVf3tMsASLxm++efey9dQl+8EsveT08E45eKxJU0F5yIdqkHcuWquDP9xI9e35cKx13W5uSGIr9TDH9wNjyY0aX3MkUeYM9UQut3bHr/tH4TjM87hDitOCuRERGZwvvhHX3mxzug0N44DLyXmZFvV2Wq+MInLdVujcricg== a@b";
	$valid_key_ecdsa = "ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBCt5Z3IMcaL0OAQ62QpGLvRE+5GsolzqT7gGQ/76gz348IJfb+6MyXPQbT3BmNLtSw88UaaKp0HOQFj6f3US8rU= a@b";
	$valid_key_ed22519 = "ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAID+gaGqIHksI6yElJqN52DoDDPq1rfJx32zjL2tvsES3 a@b";
	$valid_key_rsa = "ssh-rsa	AAAAB3NzaC1yc2EAAAADAQABAAABAQDNOVwGEYBQ7CFJSkkjIwR7NInRZXaHLCJgJUaDlJed2eDLvKm4zauJli1JIOdD1+ddB+B5UHlTLuI6m/NDS3PU4xfLDCclmf8FYwSJ7pR7KVg+UakVvZ4Q51bbWwgDO4zMEnWc4U6BuO5oTyz7H8g5YpG7Opw5fdTKfppxeeqshPKT6lyKAV2z+XMQrChukir4MXe7O9Amr+3GfCafodMzx3qkedld2FuhTZ3LTNoZ6/WwrYwdGbcvQX+VpN7f2VE0jBS7DpNr+fyzgW+vtU/Ejzq1rYTQNkV2lMhmyMuXi2OdUnDp6KsKuZ4T4SkB2zfgC+uOwlmumFouBv25qqtZ a@b";
	$invalid_key_one = "ssh-rsa thisisnotbase64encoded a@b";
	$invalid_key_two = "ssh-rsa AAAAC3NzaC1lZDI1NTE5AAAAID+gaGqIHksI6yElJqN52DoDDPq1rfJx32zjL2tvsES3 a@b";
	$invalid_key_three = "ssh-dsa AAAAB3NzaC1kc3MAAACBAPk0v+w59ie8OmBDlWdBKq/8YFP9h6BbnDxUkwLNlUQ27sCdI3Ko6R/ivEC22Q+SKSF+vL8TThfRWlwhDuro0aqK/0oqwz0d8wyxwWKSlygzME7PoAA5xIxAwTSF3apxGhMkZ3xVQyVVO0P/w4nRGOYEEfmeZdR6NMtZej9UszmfAAAAFQC8QxCoKLq+0e23E50YpO+gEHKrqwAAAIAGvgIwBXV7SxhhdudjJKBpjSVc+SOM5oxMT/Yx8qfkx6nGrvsmBMtCtjkDYsYxfC/GAJK2LEvfPUah5a0U33EmfIXxSjc+MGOd90i69FKSfaa5nuGb+9T/bhevYDsJvBkvl+rWABLCnDXvqUY0ZJ5JO6mT9xD+mq7Q7hy6kZzVAgAAAIARAuLXJVf3tMsASLxm++efey9dQl+8EsveT08E45eKxJU0F5yIdqkHcuWquDP9xI9e35cKx13W5uSGIr9TDH9wNjyY0aX3MkUeYM9UQut3bHr/tH4TjM87hDitOCuRERGZwvvhHX3mxzug0N44DLyXmZFvV2Wq+MInLdVujcricg== a@b";
	$invalid_key_four = "";
	$invalid_key_five = "    ";
	$invalid_key_six = "	 CSBBQUFBYWJj a@b";

	this->assertEquals(true, check_sshkey($valid_key_dsa, $ssh_valid_key_types));
	this->assertEquals(true, check_sshkey($valid_key_ecdsa, $ssh_valid_key_types));
	this->assertEquals(true, check_sshkey($valid_key_ed22519, $ssh_valid_key_types));
	this->assertEquals(true, check_sshkey($valid_key_rsa, $ssh_valid_key_types));
	this->assertEquals(false, check_sshkey($invalid_key_one, $ssh_valid_key_types));
	this->assertEquals(false, check_sshkey($invalid_key_two, $ssh_valid_key_types));
	this->assertEquals(false, check_sshkey($invalid_key_three, $ssh_valid_key_types));
	this->assertEquals(false, check_sshkey($invalid_key_four, $ssh_valid_key_types));
	this->assertEquals(false, check_sshkey($invalid_key_five, $ssh_valid_key_types));
	this->assertEquals(false, check_sshkey($invalid_key_six, $ssh_valid_key_types));
    }
}
