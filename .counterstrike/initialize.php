<?php
include '../.common/bootstrap.php';

$file = file_get_contents(PATH_ONLINECOUNTERSTRIKE);

preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $file, $players);
$online_players = count($players[1]);

preg_match('/map\s*:\s*([^\s]+)/i', $file, $map);
$current_map = $map[1] ?? '';

preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $file, $map);
$next_map = $map[1] ?? '';

preg_match('/SCORE:T=(\d+);CT=(\d+)/', $file, $scores);
$score_t = $scores[1] ?? 0;
$score_ct = $scores[2] ?? 0;

$data = [
    'online_players' => $online_players,
    'current_map' => $current_map,
    'next_map' => $next_map,
    'score_t' => $score_t,
    'score_ct' 	=> $score_ct
];
echo json_encode($data);