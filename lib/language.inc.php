<?php

# Resolve language code with allow-list and English fallback
function resolve_language_code($lang, $available_languages, $language_files) {

    if (in_array($lang, $available_languages, true) && array_key_exists($lang, $language_files)) {
        return $lang;
    }

    if (in_array("en", $available_languages, true) && array_key_exists("en", $language_files)) {
        return "en";
    }

    if (!empty($available_languages)) {
        return $available_languages[0];
    }

    if (array_key_exists("en", $language_files)) {
        return "en";
    }

    return array_key_first($language_files);
}
