<?php
$file = 'online_players.txt';
$content = file_get_contents('_hytale/online_players.txt');

preg_match('/^[^(]*\((\d+)\)/', $content, $matches);

$online_players = $matches[1] ?? 0;

echo $online_players;