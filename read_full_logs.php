<?php

$logFile = 'storage/logs/laravel.log';

if (file_exists($logFile)) {
    $content = file_get_contents($logFile);

    // Extract lines containing our debug info
    $lines = explode("\n", $content);
    $debugLines = [];

    foreach ($lines as $line) {
        if (strpos($line, 'Filtered equipment') !== false ||
            strpos($line, 'Base total') !== false ||
            strpos($line, 'Equipment cost added') !== false ||
            strpos($line, 'Raw request data') !== false) {
            $debugLines[] = $line;
        }
    }

    echo "=== DEBUG INFO FROM LOGS ===\n";
    foreach ($debugLines as $line) {
        echo $line . "\n";
    }

    if (empty($debugLines)) {
        echo "Aucune information de debug trouvée dans les logs.\n";
    }

} else {
    echo "Fichier de log non trouvé: $logFile\n";
}
