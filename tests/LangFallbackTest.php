<?php

class LangFallbackTest extends \PHPUnit\Framework\TestCase
{
    public function testFallbackToEnglishMessages()
    {
        $tmpDir = sys_get_temp_dir() . '/ssp-lang-test-' . uniqid();
        mkdir($tmpDir, 0700, true);
        $englishFile = $tmpDir . '/en.inc.php';
        $localeFile = $tmpDir . '/xx.inc.php';

        file_put_contents($englishFile, "<?php\n\$messages['title'] = 'English title';\n\$messages['mail'] = 'Mail';\n\$messages['questions']['birthday'] = 'When is your birthday?';\n");
        file_put_contents($localeFile, "<?php\n\$messages['title'] = 'Titre local';\n\$messages['questions']['birthday'] = 'Quelle est votre date de naissance ?';\n");

        $messages = array();
        require $englishFile;
        require $localeFile;

        unlink($englishFile);
        unlink($localeFile);
        rmdir($tmpDir);

        $this->assertSame('Mail', $messages['mail']);
        $this->assertSame('Titre local', $messages['title']);
        $this->assertSame('Quelle est votre date de naissance ?', $messages['questions']['birthday']);
    }
}
