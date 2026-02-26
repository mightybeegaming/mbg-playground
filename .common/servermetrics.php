<?php
include 'bootstrap.php';

if(isset($_GET['server'])) {
    $metrics = '';

    switch($_GET['server']) {
        case 'counterstrike':
            $metrics = get_metrics_counterstrike();
            break;

        case 'hytale':
            $metrics = get_metrics_hytale();
            break;
        
        case 'projectzomboid':
            $metrics = get_metrics_projectzomboid();
            break;

        case 'vrising':
            $metrics = get_metrics_vrising();
            break;
    }

    echo json_encode($metrics);
}

function get_metrics_counterstrike() {
    $metrics = [
        'status' => get_server_status(MONITOR_ID_COUNTERSTRIKE),
        'status_indicator' => '',
        'online_players' => '',
        'score_t' => '',
        'score_ct' => '',
        'current_map' => '',
        'next_map' => ''
    ];

    $file_content = file_get_contents(PATH_ONLINECOUNTERSTRIKE);

    preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $file_content, $players);
    $metrics['online_players'] = count($players[1]) ?? 0;

    preg_match('/SCORE:T=(\d+);CT=(\d+)/', $file_content, $scores);
    $metrics['score_t'] = $scores[1] ?? 0;
    $metrics['score_ct'] = $scores[2] ?? 0;

    preg_match('/map\s*:\s*([^\s]+)/i', $file_content, $map);
    $metrics['current_map'] = $map[1] ?? '';

    preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $file_content, $map);
    $metrics['next_map'] = $map[1] ?? '';

    $metrics['status_indicator'] = status_indicator_builder($metrics);

    return $metrics;
}

function get_metrics_hytale() {
    $metrics = [
        'status' => get_server_status(MONITOR_ID_HYTALE),
        'status_indicator' => '',
        'online_players' => ''
    ];

    $file_content = file_get_contents(PATH_ONLINEHYTALE);

    preg_match('/^[^(]*\((\d+)\)/', $file_content, $matches);
    $metrics['online_players'] = $matches[1] ?? 0;

    $metrics['status_indicator'] = status_indicator_builder($metrics);

    return $metrics;
}

function get_metrics_projectzomboid() {
    $metrics = [
        'status' => get_server_status(MONITOR_ID_PROJECTZOMBOID),
        'status_indicator' => '',
        'online_players' => ''
    ];

    $file = count(file(PATH_ONLINEPROJECTZOMBOID));
    $metrics['online_players'] = max(0, $file - 1);

    $metrics['status_indicator'] = status_indicator_builder($metrics);

    return $metrics;
}

function get_metrics_vrising() {
    $metrics = [
        'status' => get_server_status(MONITOR_ID_VRISING),
        'status_indicator' => '',
        'online_players' => ''
    ];

    $file = count(file(PATH_ONLINEVRISING));
    $metrics['online_players'] = max(0, $file - 1);

    $metrics['status_indicator'] = status_indicator_builder($metrics);

    return $metrics;
}

function get_server_status($monitor_id) {   
    $status = 0;

    $file_content = file_get_contents(PATH_ONLINESTATUS);
    if(!$file_content) return $status;

    $json_data = json_decode($file_content, true);
    $heartbeats = $json_data['heartbeatList'][$monitor_id];

    $heartbeat = end($heartbeats);
    $status = $heartbeat['status'];
    
    return $status;
}

function status_indicator_builder($metrics) {
    $online_players = (int)$metrics['online_players'];
    $online_players = ($online_players > 0) ? $online_players . ' ' : '';

    $online_indicator = "<span class=\"status status-online\">{$online_players}ONLINE</span>";
    $offline_indicator = '<span class="status status-offline">OFFLINE</span>';

    return $metrics['status'] ? $online_indicator : $offline_indicator;
}