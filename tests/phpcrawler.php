<?php

function readDirectory($dirPath, &$output, $indent = 0)
{
    $indentStr = str_repeat("  ", $indent);
    $items = scandir($dirPath);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;

        $fullPath = $dirPath . DIRECTORY_SEPARATOR . $item;

        if (is_dir($fullPath)) {
            $output[] = "{$indentStr}[DIR] {$item}";
            readDirectory($fullPath, $output, $indent + 1);
        } elseif (is_file($fullPath)) {
            $output[] = "{$indentStr}[FILE] {$item}";
            $content = file_get_contents($fullPath);
            $contentLines = explode("\n", $content);
            foreach ($contentLines as $line) {
                $output[] = $indentStr . "    " . $line;
            }
        }
    }
}

// ==== USAGE ====

$directoryToScan = '/Users/joeboy/NipeX Laravel Training/KnowlegeBaseProject/maintenance-tracker/tests'; // <-- change this to your target
$outputFile = __DIR__ . '/directory_output.txt';

$output = [];
readDirectory($directoryToScan, $output);

// Save to file
file_put_contents($outputFile, implode(PHP_EOL, $output));

echo "Done! Output saved to: {$outputFile}" . PHP_EOL;
