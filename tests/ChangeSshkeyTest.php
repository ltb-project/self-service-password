<?php

require_once __DIR__ . '/../lib/functions.inc.php';

class ChangeSshkeyTest extends \PHPUnit\Framework\TestCase
{
    private $key1 = "ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAID+gaGqIHksI6yElJqN52DoDDPq1rfJx32zjL2tvsES3 a@b";
    private $key2 = "ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBCt5Z3IMcaL0OAQ62QpGLvRE+5GsolzqT7gGQ/76gz348IJfb+6MyXPQbT3BmNLtSw88UaaKp0HOQFj6f3US8rU= a@b";

    private function ocValues(array $values): array
    {
        # Same shape as ldap_get_values()
        return array_merge($values, array("count" => count($values)));
    }

    public function test_objectclass_present_same_case(): void
    {
        $mods = build_sshkey_modifications(
            $this->ocValues(array("top", "inetOrgPerson", "ldapPublicKey")),
            "ldapPublicKey", "sshPublicKey", $this->key1);

        $this->assertCount(1, $mods, "objectClass must not be added when present");
        $this->assertEquals("sshPublicKey", $mods[0]["attrib"]);
        $this->assertEquals(LDAP_MODIFY_BATCH_REPLACE, $mods[0]["modtype"]);
        $this->assertEquals(array($this->key1), $mods[0]["values"]);
    }

    public function test_objectclass_present_different_case(): void
    {
        $mods = build_sshkey_modifications(
            $this->ocValues(array("top", "inetorgperson", "ldappublickey")),
            "ldapPublicKey", "sshPublicKey", $this->key1);

        $this->assertCount(1, $mods, "objectClass comparison must be case-insensitive");
        $this->assertEquals("sshPublicKey", $mods[0]["attrib"]);
    }

    public function test_objectclass_missing_is_added_alone(): void
    {
        $mods = build_sshkey_modifications(
            $this->ocValues(array("top", "inetOrgPerson")),
            "ldapPublicKey", "sshPublicKey", $this->key1);

        $this->assertCount(2, $mods);
        $this->assertEquals("objectClass", $mods[0]["attrib"]);
        $this->assertEquals(LDAP_MODIFY_BATCH_ADD, $mods[0]["modtype"]);
        $this->assertEquals(array("ldapPublicKey"), $mods[0]["values"], "only the missing value is added");
        $this->assertEquals(LDAP_MODIFY_BATCH_REPLACE, $mods[1]["modtype"]);
    }

    public function test_multiple_keys_in_one_replace(): void
    {
        $input = "\n" . $this->key1 . "\r\n  \n" . $this->key2 . "\n" . $this->key1 . "\n";
        $mods = build_sshkey_modifications(
            $this->ocValues(array("top", "inetOrgPerson")),
            "ldapPublicKey", "sshPublicKey", $input);

        $this->assertCount(2, $mods, "objectClass add must appear once, not per key");
        $this->assertEquals(array($this->key1, $this->key2), $mods[1]["values"],
            "blank lines and duplicates are dropped, all keys replaced at once");
    }

    public function test_objectclass_check_disabled(): void
    {
        foreach (array("", null, false) as $objectClass) {
            $mods = build_sshkey_modifications(
                $this->ocValues(array("top")), $objectClass, "sshPublicKey", $this->key1);
            $this->assertCount(1, $mods, "empty objectClass setting disables the check");
        }
    }

    public function test_objectclass_unreadable(): void
    {
        $mods = build_sshkey_modifications(null, "ldapPublicKey", "sshPublicKey", $this->key1);
        $this->assertCount(1, $mods, "objectClass is not added when current values are unknown");
    }

    public function test_invalid_input(): void
    {
        foreach (array("", null, "   ") as $attribute) {
            $this->assertFalse(build_sshkey_modifications(
                $this->ocValues(array("top")), "ldapPublicKey", $attribute, $this->key1),
                "empty attribute must be rejected");
        }
        $this->assertFalse(build_sshkey_modifications(
            $this->ocValues(array("top")), "ldapPublicKey", "sshPublicKey", "\n  \n"),
            "input without keys must be rejected");
    }
}
