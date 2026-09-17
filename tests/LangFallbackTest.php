<?php

class LangFallbackTest extends \PHPUnit\Framework\TestCase
{
    public function testFallbackToEnglishMessages()
    {
        $messages = array();
        require __DIR__ . '/../lang/en.inc.php';
        $english = $messages;

        $langFiles = glob(__DIR__ . '/../lang/*.inc.php');
        sort($langFiles, SORT_STRING);
        $selectedLangFile = null;
        $missingKey = null;
        $translatedKey = null;

        foreach ($langFiles as $langFile) {
            if (basename($langFile) === 'en.inc.php') {
                continue;
            }

            $messages = array();
            require $langFile;

            $candidateMissing = array_diff_key($english, $messages);
            if (empty($candidateMissing)) {
                continue;
            }

            $candidateTranslated = array();
            foreach ($messages as $key => $value) {
                if (array_key_exists($key, $english) && $value !== $english[$key]) {
                    $candidateTranslated[] = $key;
                }
            }

            if (empty($candidateTranslated)) {
                continue;
            }

            $selectedLangFile = $langFile;
            $missingKey = array_key_first($candidateMissing);
            $translatedKey = $candidateTranslated[0];
            break;
        }

        $this->assertNotNull($selectedLangFile, 'No language file with both missing and translated keys was found.');
        $this->assertNotNull($missingKey, 'Missing key could not be determined.');
        $this->assertNotNull($translatedKey, 'Translated key could not be determined.');

        $messages = array();
        require __DIR__ . '/../lang/en.inc.php';
        require $selectedLangFile;

        $this->assertSame($english[$missingKey], $messages[$missingKey]);
        $this->assertNotSame($english[$translatedKey], $messages[$translatedKey]);
    }
}
