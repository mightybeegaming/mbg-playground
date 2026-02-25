<?php
include '../.common/bootstrap.php';

$file = count(file(PATH_ONLINEVRISING));
$online_players = max(0, $file - 1);

$data = [
    'online_players' => $online_players
];
echo json_encode($data);