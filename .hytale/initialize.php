<?php
include '../.common/bootstrap.php';

$content = file_get_contents(PATH_ONLINEHYTALE);
preg_match('/^[^(]*\((\d+)\)/', $content, $matches);
$online_players = $matches[1] ?? 0;

$data = [
    'online_players' => $online_players
];
echo json_encode($data);