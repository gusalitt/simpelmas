<?php

require __DIR__ . '/../Foundation/Application.php';
require __DIR__ . '/../app.php';

$path = __DIR__ . '/seeders';
$seederFiles = glob($path . '/*.php');

sort($seederFiles);

$context = [];
foreach ($seederFiles as $file) {
    try {
        echo "Running Seeder: " . basename($file) . PHP_EOL;
    
        $seeder = require $file;
    
        if (isset($seeder['run']) && is_callable($seeder['run'])) {
            $seeder['run']($context);
        }
    } catch (\Throwable $th) {
        echo "Error Seeder: " . $th->getMessage() . PHP_EOL;
    }
}

echo "Done all seeders" . PHP_EOL;