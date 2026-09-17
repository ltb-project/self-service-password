<?php

$langDir = __DIR__ . '/../lang';
$files = glob($langDir . '/*.inc.php');
sort($files, SORT_STRING);

if (empty($files)) {
    fwrite(STDERR, "No language files found in $langDir\n");
    exit(1);
}

function flatten_messages(array $messages, string $prefix = ''): array
{
    $flat = array();
    foreach ($messages as $key => $value) {
        $fullKey = ($prefix === '') ? (string) $key : $prefix . '.' . (string) $key;
        if (is_array($value)) {
            $flat = array_merge($flat, flatten_messages($value, $fullKey));
        } else {
            $flat[$fullKey] = $value;
        }
    }
    return $flat;
}

function load_messages(string $file): array
{
    $messages = array();
    require $file;
    return flatten_messages($messages);
}

$reference = load_messages($langDir . '/en.inc.php');
$referenceCount = count($reference);

echo "Language report (reference: en, keys: $referenceCount)\n\n";
echo str_pad("Language", 12) . str_pad("Translated", 12) . str_pad("Missing", 10) . "Completion\n";
echo str_repeat("-", 44) . "\n";

foreach ($files as $file) {
    $lang = basename($file, '.inc.php');
    if ($lang === 'en') {
        continue;
    }

    $messages = load_messages($file);
    $translated = 0;
    $missing = array();

    foreach ($reference as $key => $englishValue) {
        if (!array_key_exists($key, $messages)) {
            $missing[] = $key;
            continue;
        }
        if ($messages[$key] !== $englishValue) {
            $translated++;
        }
    }

    $missingCount = count($missing);
    $percent = $referenceCount > 0 ? ($translated / $referenceCount) * 100 : 0;

    echo str_pad($lang, 12)
        . str_pad((string) $translated, 12)
        . str_pad((string) $missingCount, 10)
        . number_format($percent, 1) . "%\n";

    if ($missingCount > 0) {
        echo "  Missing keys: " . implode(', ', $missing) . "\n";
    }
}
