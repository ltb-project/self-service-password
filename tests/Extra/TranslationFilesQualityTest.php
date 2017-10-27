<?php

namespace App\Tests\Extra;

class TranslationFilesQualityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test language files for missing and excess translations
     * All languages are compared with English
     */
    public function testTranslations()
    {
        $path = __DIR__ . '/../../lang';

        # Available languages
        $languages = array();
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    array_push($languages, str_replace(".inc.php", "", $entry));
                }
            }
            closedir($handle);
	    }

	    // will be modified by languages files
	    $messages = array();

        require($path . "/en.inc.php");
        $reference = $messages;
        $error = '';

        foreach ($languages as $lang) {
            $messages = array();
            require($path . "/$lang.inc.php");

            $missing = array_diff(array_keys($reference), array_keys($messages));
            if (!empty($missing)) {
                $error .= "\nMissing translations in $lang: " . implode(', ', $missing);
            }
	    
            $extra = array_diff(array_keys($messages), array_keys($reference));
            if (!empty($extra)) {
                $error .= "\nExtra translations in $lang: " . implode(', ', $extra);
            }
        }

        $this->assertEmpty($error, $error);
    }
}

