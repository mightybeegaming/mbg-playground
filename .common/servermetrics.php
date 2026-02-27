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
        'server' => get_metrics_server(MONITOR_ID_COUNTERSTRIKE),
        'status_indicator' => '',
        'status_text' => '',
        'latency_indicator' => '',
        'latency_text' => '',
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

    $status = status_builder($metrics);
    $latency = latency_builder($metrics);

    $metrics['status_indicator'] = $status['indicator'];
    $metrics['status_text'] = $status['text'];
    $metrics['latency_indicator'] = $latency['indicator'];
    $metrics['latency_text'] = $latency['text'];

    return $metrics;
}

function get_metrics_hytale() {
    $metrics = [
        'server' => get_metrics_server(MONITOR_ID_HYTALE),
        'status_indicator' => '',
        'status_text' => '',
        'latency_indicator' => '',
        'latency_text' => '',
        'online_players' => ''
    ];

    $file_content = file_get_contents(PATH_ONLINEHYTALE);

    preg_match('/^[^(]*\((\d+)\)/', $file_content, $matches);
    $metrics['online_players'] = $matches[1] ?? 0;

    $status = status_builder($metrics);
    $latency = latency_builder($metrics);

    $metrics['status_indicator'] = $status['indicator'];
    $metrics['status_text'] = $status['text'];
    $metrics['latency_indicator'] = $latency['indicator'];
    $metrics['latency_text'] = $latency['text'];

    return $metrics;
}

function get_metrics_projectzomboid() {
    $metrics = [
        'server' => get_metrics_server(MONITOR_ID_PROJECTZOMBOID),
        'status_indicator' => '',
        'status_text' => '',
        'latency_indicator' => '',
        'latency_text' => '',
        'online_players' => ''
    ];

    $file = count(file(PATH_ONLINEPROJECTZOMBOID));
    $metrics['online_players'] = max(0, $file - 1);

    $status = status_builder($metrics);
    $latency = latency_builder($metrics);

    $metrics['status_indicator'] = $status['indicator'];
    $metrics['status_text'] = $status['text'];
    $metrics['latency_indicator'] = $latency['indicator'];
    $metrics['latency_text'] = $latency['text'];

    return $metrics;
}

function get_metrics_vrising() {
    $metrics = [
        'server' => get_metrics_server(MONITOR_ID_VRISING),
        'status_indicator' => '',
        'status_text' => '',
        'latency_indicator' => '',
        'latency_text' => '',
        'online_players' => ''
    ];

    $file = count(file(PATH_ONLINEVRISING));
    $metrics['online_players'] = max(0, $file - 1);

    $status = status_builder($metrics);
    $latency = latency_builder($metrics);

    $metrics['status_indicator'] = $status['indicator'];
    $metrics['status_text'] = $status['text'];
    $metrics['latency_indicator'] = $latency['indicator'];
    $metrics['latency_text'] = $latency['text'];

    return $metrics;
}

function get_metrics_server($monitor_id) {
    $metrics = [
        'data' => '',
        'status' => 0,
        'latency' => 0,
        'uptime' => 0,
    ];

    $file_content = file_get_contents(PATH_ONLINESTATUS);
    if(!$file_content) return $metrics;

    $json_data = json_decode($file_content, true);
    $heartbeats = $json_data['heartbeatList'][$monitor_id];

    $uptime_24 = $json_data['uptimeList'][$monitor_id . '_24'];
    $uptime_24 = ($uptime_24 * 100);
    $uptime_24 = round($uptime_24, 2);

    $heartbeat = end($heartbeats);
    $metrics['data'] = $heartbeats;
    $metrics['status'] = $heartbeat['status'];
    $metrics['latency'] = $heartbeat['ping'];
    $metrics['uptime_24'] = $uptime_24 . '%';
    
    return $metrics;
}

function status_builder($metrics) {
    $builder = [
        'indicator' => '',
        'text' => ''
    ];
    
    $online_players = (int)$metrics['online_players'];
    $online_players = ($online_players > 0) ? $online_players . ' ' : '';

    $online_indicator = "<span class=\"status status-online\">{$online_players}ONLINE</span>";
    $offline_indicator = '<span class="status status-offline">OFFLINE</span>';

    $online_text = 'ONLINE';
    $offline_text = 'OFFLINE';

    if($metrics['server']['status']) {
        $builder['indicator'] = $online_indicator;
        $builder['text'] = $online_text;
    } else {
        $builder['indicator'] = $offline_indicator;
        $builder['text'] = $offline_text;
    }

    return $builder;
}

function latency_builder($metrics) {
    $builder = [
        'indicator' => '',
        'text' => ''
    ];

    $latency = (int)$metrics['server']['latency'];
    $latency = ($latency > 0) ? $latency : '?';

    if($metrics['server']['status']) {
        $builder['indicator'] = "<span class=\"latency latency-online\">{$latency} ms</span>";
        $builder['text'] = "{$latency} ms";
    } else {
        $builder['indicator'] = '';
        $builder['text'] = '? ms';
    }

    return $builder;
}