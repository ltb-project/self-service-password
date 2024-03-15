<?php

class LangTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test language files for missing and excess translations
     * All languages are compared with English
     */
    public function testTranslations()
    {

        # Available languages
        $languages = array();
        if ($handle = opendir(__DIR__.'/../lang')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    array_push($languages, str_replace(".inc.php", "", $entry));
                }
            }
            closedir($handle);
        }

        require(__DIR__."/../lang/en.inc.php");
        $reference = $messages;
        $error = '';

        foreach ($languages as $lang) {
            $messages = array();
            require(__DIR__."/../lang/$lang.inc.php");

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

