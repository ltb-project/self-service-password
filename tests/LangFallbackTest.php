<?php

class LangFallbackTest extends \PHPUnit\Framework\TestCase
{
    private function flattenMessages(array $messages, string $prefix = ''): array
    {
        $flat = array();
        foreach ($messages as $key => $value) {
            $fullKey = ($prefix === '') ? (string) $key : $prefix . '.' . (string) $key;
            if (is_array($value)) {
                $flat = array_merge($flat, $this->flattenMessages($value, $fullKey));
            } else {
                $flat[$fullKey] = $value;
            }
        }

        return $flat;
    }

    public function testFallbackToEnglishMessages()
    {
        $tmpDir = sys_get_temp_dir() . '/ssp-lang-test-' . bin2hex(random_bytes(8));
        mkdir($tmpDir, 0700, true);
        $englishFile = $tmpDir . '/en.inc.php';
        $localeFile = $tmpDir . '/xx.inc.php';

        try {
            file_put_contents($englishFile, "<?php\n\$messages['title'] = 'English title';\n\$messages['mail'] = 'Mail';\n\$messages['questions']['birthday'] = 'When is your birthday?';\n\$messages['questions']['color'] = 'What is your favorite color?';\n\$messages['labels']['account'] = 'Account';\n");
            file_put_contents($localeFile, "<?php\n\$messages['title'] = 'Titre local';\n\$messages['questions']['birthday'] = 'Quelle est votre date de naissance ?';\n");

            $messages = array();
            require $englishFile;
            $englishMessages = $messages;

            $messages = array();
            require $localeFile;
            $messages = array_replace_recursive($englishMessages, $messages);

            $this->assertSame('Mail', $messages['mail']);
            $this->assertSame('Titre local', $messages['title']);
            $this->assertSame('Quelle est votre date de naissance ?', $messages['questions']['birthday']);
            $this->assertSame('What is your favorite color?', $messages['questions']['color']);
            $this->assertSame('Account', $messages['labels']['account']);
        } finally {
            if (file_exists($englishFile)) {
                unlink($englishFile);
            }
            if (file_exists($localeFile)) {
                unlink($localeFile);
            }
            if (is_dir($tmpDir)) {
                rmdir($tmpDir);
            }
        }
    }

    public function testMissingLocaleFileFallsBackToEnglish()
    {
        $tmpDir = sys_get_temp_dir() . '/ssp-lang-test-' . bin2hex(random_bytes(8));
        mkdir($tmpDir, 0700, true);
        $englishFile = $tmpDir . '/en.inc.php';
        $localeFile = $tmpDir . '/missing.inc.php';

        try {
            file_put_contents($englishFile, "<?php\n\$messages['title'] = 'English title';\n\$messages['questions']['color'] = 'What is your favorite color?';\n");

            $messages = array();
            require $englishFile;
            $englishMessages = $messages;

            $messages = array();
            if (file_exists($localeFile)) {
                require $localeFile;
            }
            $messages = array_replace_recursive($englishMessages, $messages);

            $this->assertSame('English title', $messages['title']);
            $this->assertSame('What is your favorite color?', $messages['questions']['color']);
        } finally {
            if (file_exists($englishFile)) {
                unlink($englishFile);
            }
            if (file_exists($localeFile)) {
                unlink($localeFile);
            }
            if (is_dir($tmpDir)) {
                rmdir($tmpDir);
            }
        }
    }

    public function testRealLanguageMergeKeepsEnglishKeyCoverage()
    {
        $messages = array();
        require __DIR__ . '/../lang/en.inc.php';
        $englishMessages = $messages;
        $englishFlat = $this->flattenMessages($englishMessages);
        $langFiles = glob(__DIR__ . '/../lang/*.inc.php');
        sort($langFiles, SORT_STRING);

        foreach ($langFiles as $langFile) {
            if (basename($langFile) === 'en.inc.php') {
                continue;
            }

            $messages = array();
            require $langFile;
            $localeFlat = $this->flattenMessages($messages);
            $mergedMessages = array_replace_recursive($englishMessages, $messages);
            $mergedFlat = $this->flattenMessages($mergedMessages);

            $this->assertEmpty(array_diff_key($englishFlat, $mergedFlat), basename($langFile));
            $this->assertEmpty(array_diff_key($localeFlat, $englishFlat), basename($langFile));
        }
    }

    public function testInvalidLanguageFallsBackToEnglish()
    {
        require_once __DIR__ . '/../lib/language.inc.php';

        $languageFiles = array();
        foreach (glob(__DIR__ . '/../lang/*.inc.php') as $langFilePath) {
            $languageFiles[basename($langFilePath, '.inc.php')] = $langFilePath;
        }
        $availableLanguages = array_keys($languageFiles);

        $lang = resolve_language_code('../../etc/passwd', $availableLanguages, $languageFiles);
        $this->assertSame('en', $lang);

        $lang = resolve_language_code('zz', $availableLanguages, $languageFiles);
        $this->assertSame('en', $lang);

        $lang = resolve_language_code('fr', array('fr'), $languageFiles);
        $this->assertSame('fr', $lang);

        $lang = resolve_language_code('fr', array('de'), $languageFiles);
        $this->assertSame('de', $lang);
    }
}
