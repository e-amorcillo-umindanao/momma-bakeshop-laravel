<?php
$marginTop = 1;
$bgColor = 'red';
$fgColor = 'white';
$title = 'Error';
$content = 'Testing parsing';

try {
    require __DIR__ . '/vendor/laravel/framework/src/Illuminate/Console/resources/views/components/line.php';
    echo "SUCCESS\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getFile() . ":" . $e->getLine() . "\n";
}
