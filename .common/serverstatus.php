<?php
// include '../.common/bootstrap.php';

function get_online_players($id) {
    $online_players = '';

    switch($id) {
        case '71':
            $file = file_get_contents(PATH_ONLINECOUNTERSTRIKE);
            preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $file, $players);
            $online_players = count($players[1]);
            break;

        case '73':
            $content = file_get_contents(PATH_ONLINEHYTALE);
            preg_match('/^[^(]*\((\d+)\)/', $content, $matches);
            $online_players = $matches[1] ?? 0;
            break;

        case '75':
            $file = count(file(PATH_ONLINEPROJECTZOMBOID));
            $online_players = max(0, $file - 1);
            break;

        case '58':
            $file = count(file(PATH_ONLINEVRISING));
            $online_players = max(0, $file - 1);
            break;
    }

    return $online_players;
}

function get_server_status() {
    $processed_data = [
        'counterstrike' => '',
        'hytale' => '',
        'projectzomboid' => '',
        'vrising' => ''
    ];
    
    $data = file_get_contents(PATH_ONLINESTATUS);
    if(!$data) return $processed_data;

    $json_data = json_decode($data, true);

    foreach($json_data['heartbeatList'] as $id => $heartbeats) {
        if($heartbeats) {
            $heartbeat = end($heartbeats);
            $status = $heartbeat['status'];

            $online_players = get_online_players($id);
            $online_players = $online_players ? $online_players . ' ' : '';

            $online_indicator = "<div class=\"status status-online\">{$online_players}ONLINE</div>";
            $offline_indicator = '<div class="status status-offline">OFFLINE</div>';

            switch($id) {
                case '71':
                    $processed_data['counterstrike'] = $status ? $online_indicator : $offline_indicator;
                    break;

                case '73':
                    $processed_data['hytale'] = $status ? $online_indicator : $offline_indicator;
                    break;

                case '75':
                    $processed_data['projectzomboid'] = $status ? $online_indicator : $offline_indicator;
                    break;

                case '58':
                    $processed_data['vrising'] = $status ? $online_indicator : $offline_indicator;
                    break;
            }
        }
    }
    
    return $processed_data;
}

$server_status = get_server_status();
