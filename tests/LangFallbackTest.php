<?php

class LangFallbackTest extends \PHPUnit\Framework\TestCase
{
    public function testFallbackToEnglishMessages()
    {
        $messages = array();
        require __DIR__ . '/../lang/en.inc.php';
        $english = $messages;

        $messages = array();
        require __DIR__ . '/../lang/de.inc.php';
        $this->assertArrayNotHasKey('policyentropy', $messages);

        $messages = array();
        require __DIR__ . '/../lang/en.inc.php';
        require __DIR__ . '/../lang/de.inc.php';

        $this->assertSame($english['policyentropy'], $messages['policyentropy']);
        $this->assertNotSame($english['title'], $messages['title']);
    }
}
