<?php

$file = 'online_players.txt';
$content = file_get_contents('data_hytale/online_players.txt');

preg_match('/default\s*\((\d+)\)/', $content, $matches);

$online_players = $matches[1] ?? 0;

echo $online_players;