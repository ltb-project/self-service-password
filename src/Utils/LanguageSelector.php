<?php
/*
 * LTB Self Service Password
 *
 * Copyright (C) 2009 Clement OUDOT
 * Copyright (C) 2009 LTB-project.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * GPL License: http://www.gnu.org/licenses/gpl.txt
 */

namespace App\Utils;

/**
 * Class LanguageSelector
 */
class LanguageSelector
{
    /**
     * @param string   $path
     * @param string   $lang
     * @param string[] $allowedLangs
     *
     * @return array
     */
    public function findAvailableLanguages($path, $lang, $allowedLangs)
    {
        $languages = [];
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ('.' !== $entry && '..' !== $entry) {
                    $entryLang = str_replace(".inc.php", "", $entry);
                    // Only add language to possibilities if it is the default language or part of the allowed languages
                    // empty $allowed_lang <=> all languages are allowed
                    if ($entryLang === $lang || empty($allowedLangs) || in_array($entryLang, $allowedLangs)) {
                        array_push($languages, $entryLang);
                    }
                }
            }
            closedir($handle);
        }

        return $languages;
    }

    /**
     * detect the preferred language of the user agent
     *
     * @copyright Roy Kaldung <roy@kaldung.com>
     *
     * @license http://www.php.net/license/3_01.txt PHP license
     */
    /**
     * split request header Accept-Language to determine the UserAgent's
     * prefered language
     *
     * @param string   $defaultLanguage    preselected default language
     * @param string[] $availableLanguages
     *
     * @return string returns the default language or a match from $availableLanguages
     */
    public function detectLanguage($defaultLanguage, $availableLanguages)
    {
        $acceptedLanguages = filter_input(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE', FILTER_SANITIZE_STRING);
        $languageList      = explode(',', $acceptedLanguages);
        $choosenLanguage   = $defaultLanguage;
        foreach ($languageList as $currentLanguage) {
            $currentLanguage = explode(';', $currentLanguage);
            if (preg_match('/(..)-?.*/', $currentLanguage[0], $reg)) {
                foreach ($reg as $checkLang) {
                    if ($match = preg_grep('/'.$checkLang.'/i', $availableLanguages)) {
                        $choosenLanguage = $match[key($match)];
                        break 2;
                    }
                }
            }
        }

        return $choosenLanguage;
    }
}
