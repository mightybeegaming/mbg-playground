<?php
$file = '_counterstrike/online_players.txt';

$bots = 0;
$steamUsers = 0;
$steamIds = [];

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    // Normalize spacing
    $line = trim($line);

    // Skip headers and irrelevant lines
    if (
        $line === '' ||
        str_starts_with($line, 'Clients') ||
        str_starts_with($line, '#') ||
        str_starts_with($line, 'Total') ||
        str_starts_with($line, 'L ')
    ) {
        continue;
    }

    // Steam ID detection
    if (preg_match('/(STEAM_\d:\d:\d+)/', $line, $matches)) {
        $steamUsers++;
        $steamIds[] = $matches[1];
    }
}

echo $steamUsers;