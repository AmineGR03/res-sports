<?php

$logFile = 'storage/logs/laravel.log';

if (file_exists($logFile)) {
    $lines = file($logFile);
    $lastLines = array_slice($lines, -20); // Get last 20 lines

    echo "=== DERNIERS LOGS LARAVEL ===\n";
    foreach ($lastLines as $line) {
        echo $line;
    }
} else {
    echo "Fichier de log non trouvé: $logFile\n";
}
