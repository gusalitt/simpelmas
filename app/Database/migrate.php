<?php

require __DIR__ . '/../Foundation/Application.php';
require __DIR__ . '/../app.php';

$path = __DIR__ . '/migrations';
$migrationFiles = glob($path . '/*.php');

rsort($migrationFiles);
$descMigrationFiles = $migrationFiles;

sort($migrationFiles);
$ascMigrationFiles = $migrationFiles;

foreach ($descMigrationFiles as $file) {
    try {
        echo "Running Down: " . basename($file) . PHP_EOL;
    
        $migration = require $file;
    
        if (isset($migration['down']) && is_callable($migration['down'])) {
            $migration['down']();
        }
    } catch (\Throwable $th) {
        echo "Error Down: " . $th->getMessage() . PHP_EOL;
    }
}

echo PHP_EOL;

foreach ($ascMigrationFiles as $file) {
    try {
        echo "Running Up: " . basename($file) . PHP_EOL;
    
        $migration = require $file;
    
        if (isset($migration['up']) && is_callable($migration['up'])) {
            $migration['up']();
        }
    } catch (\Throwable $th) {
        echo "Error Up: " . $th->getMessage() . PHP_EOL;
    }
}

echo "Done all migrations" . PHP_EOL;
