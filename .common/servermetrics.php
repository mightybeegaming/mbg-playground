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
    $metrics_counterstrike = [
        'monitor_id' => MONITOR_ID_COUNTERSTRIKE,
        'server' => '',
        'online_players' => 0,
        'score_t' => 0,
        'score_ct' => 0,
        'current_map' => '',
        'next_map' => ''
    ];

    $file_content = file_get_contents(PATH_ONLINECOUNTERSTRIKE);

    preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $file_content, $players);
    $metrics_counterstrike['online_players'] = count($players[1]) ?? 0;

    preg_match('/SCORE:T=(\d+);CT=(\d+)/', $file_content, $scores);
    $metrics_counterstrike['score_t'] = $scores[1] ?? 0;
    $metrics_counterstrike['score_ct'] = $scores[2] ?? 0;

    preg_match('/map\s*:\s*([^\s]+)/i', $file_content, $map);
    $metrics_counterstrike['current_map'] = $map[1] ?? '';

    preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $file_content, $map);
    $metrics_counterstrike['next_map'] = $map[1] ?? '';

    $metrics_counterstrike['server'] = get_metrics_server($metrics_counterstrike);

    return $metrics_counterstrike;
}

function get_metrics_hytale() {
    $metrics_hytale = [
        'monitor_id' => MONITOR_ID_HYTALE,
        'server' => '',
        'online_players' => 0
    ];

    $file_content = file_get_contents(PATH_ONLINEHYTALE);

    preg_match('/^[^(]*\((\d+)\)/', $file_content, $matches);
    $metrics_hytale['online_players'] = $matches[1] ?? 0;

    $metrics_hytale['server'] = get_metrics_server($metrics_hytale);

    return $metrics_hytale;
}

function get_metrics_projectzomboid() {
    $metrics_projectzomboid = [
        'monitor_id' => MONITOR_ID_PROJECTZOMBOID,
        'server' => '',
        'online_players' => 0
    ];

    $file = count(file(PATH_ONLINEPROJECTZOMBOID));
    $metrics_projectzomboid['online_players'] = max(0, $file - 1);

    $metrics_projectzomboid['server'] = get_metrics_server($metrics_projectzomboid);

    return $metrics_projectzomboid;
}

function get_metrics_vrising() {
    $metrics_vrising = [
        'monitor_id' => MONITOR_ID_VRISING,
        'server' => '',
        'online_players' => 0
    ];

    $file = count(file(PATH_ONLINEVRISING));
    $metrics_vrising['online_players'] = max(0, $file - 1);

    $metrics_vrising['server'] = get_metrics_server($metrics_vrising);

    return $metrics_vrising;
}

function get_metrics_server($metrics_game) {
    $metrics_server = [
        'data' => '',
        'status' => 0,
        'status_indicator' => '',
        'status_text' => '',
        'latency' => 0,
        'latency_indicator' => '',
        'latency_text' => '',
        'uptime_24' => 0
    ];

    $file_content = file_get_contents(PATH_ONLINESTATUS);
    if(!$file_content) return $metrics_server;

    $json_data = json_decode($file_content, true);
    $heartbeats = $json_data['heartbeatList'][$metrics_game['monitor_id']];

    $heartbeat = end($heartbeats);
    $metrics_server['data'] = $heartbeats;
    $metrics_server['status'] = $heartbeat['status'];
    $metrics_server['latency'] = $heartbeat['ping'];

    $metrics_game['server'] = $metrics_server;
    $status = status_builder($metrics_game);
    $metrics_server['status_indicator'] = $status['indicator'];
    $metrics_server['status_text'] = $status['text'];

    $latency = latency_builder($metrics_game);
    $metrics_server['latency_indicator'] = $latency['indicator'];
    $metrics_server['latency_text'] = $latency['text'];

    $uptime_24 = $json_data['uptimeList'][$metrics_game['monitor_id'] . '_24'];
    $uptime_24 = ($uptime_24 * 100);
    $uptime_24 = round($uptime_24, 2);
    $metrics_server['uptime_24'] = $uptime_24 . '%';
    
    return $metrics_server;
}

function status_builder($metrics) {
    $status = [
        'indicator' => '',
        'text' => ''
    ];
    
    $online_players = (int)$metrics['online_players'];
    $online_players = ($online_players > 0) ? $online_players . ' ' : '';

    $online_indicator = "<span class=\"widget status status-online\">{$online_players}ONLINE</span>";
    $offline_indicator = '<span class="widget status status-offline">OFFLINE</span>';

    $online_text = 'ONLINE';
    $offline_text = 'OFFLINE';

    if($metrics['server']['status']) {
        $status['indicator'] = $online_indicator;
        $status['text'] = $online_text;
    } else {
        $status['indicator'] = $offline_indicator;
        $status['text'] = $offline_text;
    }

    return $status;
}

function latency_builder($metrics) {
    $builder = [
        'indicator' => '',
        'text' => ''
    ];

    $latency = (int)$metrics['server']['latency'];
    $latency = ($latency > 0) ? $latency : '?';

    if($metrics['server']['status']) {
        $builder['indicator'] = "<span class=\"widget latency latency-online\">{$latency} ms</span>";
        $builder['text'] = "{$latency} ms";
    } else {
        $builder['indicator'] = '';
        $builder['text'] = '? ms';
    }

    return $builder;
}