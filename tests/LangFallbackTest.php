<?php

class LangFallbackTest extends \PHPUnit\Framework\TestCase
{
    public function testFallbackToEnglishMessages()
    {
        $tmpDir = sys_get_temp_dir() . '/ssp-lang-test-' . bin2hex(random_bytes(8));
        mkdir($tmpDir, 0700, true);
        $englishFile = $tmpDir . '/en.inc.php';
        $localeFile = $tmpDir . '/xx.inc.php';

        file_put_contents($englishFile, "<?php\n\$messages['title'] = 'English title';\n\$messages['mail'] = 'Mail';\n\$messages['questions']['birthday'] = 'When is your birthday?';\n\$messages['questions']['color'] = 'What is your favorite color?';\n");
        file_put_contents($localeFile, "<?php\n\$messages['title'] = 'Titre local';\n\$messages['questions']['birthday'] = 'Quelle est votre date de naissance ?';\n");

        $messages = array();
        require $englishFile;
        $englishMessages = $messages;

        $messages = array();
        require $localeFile;
        $messages = array_replace_recursive($englishMessages, $messages);

        unlink($englishFile);
        unlink($localeFile);
        rmdir($tmpDir);

        $this->assertSame('Mail', $messages['mail']);
        $this->assertSame('Titre local', $messages['title']);
        $this->assertSame('Quelle est votre date de naissance ?', $messages['questions']['birthday']);
        $this->assertSame('What is your favorite color?', $messages['questions']['color']);
    }
}
