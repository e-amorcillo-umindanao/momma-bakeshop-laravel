<?php

// Rebranding script to change Tailwind color classes in all Blade views

$directory = __DIR__ . '/resources/views';

function processDirectory($dir)
{
    $files = scandir($dir);
    $count = 0;

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($path)) {
            $count += processDirectory($path);
        } elseif (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === 'php') {
            $content = file_get_contents($path);
            $originalContent = $content;

            // Map cool neutrals (slate) to warm neutrals (stone/brown)
            $content = str_replace('slate-', 'stone-', $content);

            // Map primary brand color (indigo/blue) to warm brand color (orange)
            $content = str_replace('indigo-', 'orange-', $content);
            $content = str_replace('blue-', 'orange-', $content);

            // For a "light brown" specific accent where appropriate, we can map some things to amber
            // Currently indigo is the main accent. Orange is a good fit.

            if ($content !== $originalContent) {
                file_put_contents($path, $content);
                $count++;
            }
        }
    }

    return $count;
}

$updatedFiles = processDirectory($directory);
echo "Successfully rebranded $updatedFiles Blade views replacing Indigo/Slate with Orange/Stone!\n";
