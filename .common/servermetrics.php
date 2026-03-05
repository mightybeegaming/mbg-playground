<?php
include 'bootstrap.php';

class ServerMetrics {
    public $counterStrike;
    public $hytale;
    public $projectZomboid;
    public $vRising;

    public function __construct() {
        $this->counterStrike = $this->getMetricsCounterStrike();
        $this->hytale = $this->getMetricsHytale();
        $this->projectZomboid = $this->getMetricsProjectZomboid();
        $this->vRising = $this->getMetricsVRising();
    }

    private function getMetricsCounterStrike() {
        $metricsCounterStrike = [
            'monitorId' => MONITOR_ID_COUNTERSTRIKE,
            'server' => '',
            'onlinePlayers' => 0,
            'scoreT' => 0,
            'scoreCt' => 0,
            'currentMap' => '',
            'nextMap' => ''
        ];

        $fileContent = file_get_contents(PATH_ONLINECOUNTERSTRIKE);

        preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $fileContent, $players);
        $metricsCounterStrike['onlinePlayers'] = count($players[1]) ?? 0;

        preg_match('/SCORE:T=(\d+);CT=(\d+)/', $fileContent, $scores);
        $metricsCounterStrike['scoreT'] = $scores[1] ?? 0;
        $metricsCounterStrike['scoreCt'] = $scores[2] ?? 0;

        preg_match('/map\s*:\s*([^\s]+)/i', $fileContent, $map);
        $metricsCounterStrike['currentMap'] = $map[1] ?? '';

        preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $fileContent, $map);
        $metricsCounterStrike['nextMap'] = $map[1] ?? '';

        $metricsCounterStrike['server'] = $this->getMetricsServer($metricsCounterStrike);

        return $metricsCounterStrike;
    }

    private function getMetricsHytale() {
        $metricsHytale = [
            'monitorId' => MONITOR_ID_HYTALE,
            'server' => '',
            'onlinePlayers' => 0
        ];

        $fileContent = file_get_contents(PATH_ONLINEHYTALE);

        preg_match('/^[^(]*\((\d+)\)/', $fileContent, $matches);
        $metricsHytale['onlinePlayers'] = $matches[1] ?? 0;

        $metricsHytale['server'] = $this->getMetricsServer($metricsHytale);

        return $metricsHytale;
    }

    private function getMetricsProjectZomboid() {
        $metricsProjectZomboid = [
            'monitorId' => MONITOR_ID_PROJECTZOMBOID,
            'server' => '',
            'onlinePlayers' => 0,
            'worldAge' => '',
            'worldDate' => '',
            'worldTime' => '',
            'weather' => '',
            'temperature' => 0,
        ];

        $fileLineCount = count(file(PATH_ONLINEPROJECTZOMBOID));
        $metricsProjectZomboid['onlinePlayers'] = max(0, $fileLineCount - 1);

        $metricsProjectZomboid['server'] = $this->getMetricsServer($metricsProjectZomboid);

        $fileContent = file_get_contents(PATH_WORLDINFOPROJECTZOMBOID);

        $pattern = '/World Age:\s*(\d+)\s*Date Time:\s*([\d-]+)\s*([\d:]+)\s*Weather:\s*([^\r\n]+)/s';

        if(preg_match($pattern, $fileContent, $matches)) {
            $worldAge = (int)$matches[1];
            $worldAge .= ' days';
            $metricsProjectZomboid['worldAge'] = $worldAge;

            $time = $matches[3];
            $time = date("g:i A", strtotime($time));
            $metricsProjectZomboid['worldTime'] = $time;

            $date = new DateTime($matches[2]);
            $date = $date->format('n/j/Y');
            $metricsProjectZomboid['worldDate'] = $date;

            $weatherParts = explode('|', $matches[4]);
            $metricsProjectZomboid['weather'] = $weatherParts[0] ?? '';
            $metricsProjectZomboid['temperature'] = $weatherParts[1] ?? '';
        }

        return $metricsProjectZomboid;
    }

    private function getMetricsVRising() {
        $metricsVRising = [
            'monitorId' => MONITOR_ID_VRISING,
            'server' => '',
            'onlinePlayers' => 0
        ];

        $fileLineCount = count(file(PATH_ONLINEVRISING));
        $metricsVRising['onlinePlayers'] = max(0, $fileLineCount - 1);

        $metricsVRising['server'] = $this->getMetricsServer($metricsVRising);

        return $metricsVRising;
    }

    private function getMetricsServer($metrics) {
        $metricsServer = [
            // 'data' => '',
            'status' => 0,
            'statusIndicator' => '',
            'statusText' => '',
            'latency' => 0,
            'latencyIndicator' => '',
            'latencyText' => '',
            'uptime24' => 0
        ];

        $fileContent = file_get_contents(PATH_ONLINESTATUS);
        if(!$fileContent) return $metricsServer;

        $jsonData = json_decode($fileContent, true);
        $monitorId = $metrics['monitorId'];
        $heartbeats = $jsonData['heartbeatList'][$monitorId];

        $heartbeat = end($heartbeats);
        // $metricsServer['data'] = $heartbeats;
        $metricsServer['status'] = $heartbeat['status'];
        $metricsServer['latency'] = $heartbeat['ping'];

        $metrics['server'] = $metricsServer;
        $status = $this->statusBuilder($metrics);
        $metricsServer['statusIndicator'] = $status['indicator'];
        $metricsServer['statusText'] = $status['text'];

        $latency = $this->latencyBuilder($metrics);
        $metricsServer['latencyIndicator'] = $latency['indicator'];
        $metricsServer['latencyText'] = $latency['text'];

        $uptime24 = $jsonData['uptimeList'][$monitorId . '_24'];
        $uptime24 = ($uptime24 * 100);
        $uptime24 = round($uptime24, 2);
        $metricsServer['uptime24'] = $uptime24 . ' %';
        
        return $metricsServer;
    }

    private function statusBuilder($metrics) {
        $status = [
            'indicator' => '',
            'text' => ''
        ];
        
        $onlinePlayers = (int)$metrics['onlinePlayers'];
        $onlinePlayers = ($onlinePlayers > 0) ? $onlinePlayers . ' ' : '';

        $onlineIndicator = "<span class=\"widget status status-online\">{$onlinePlayers}ONLINE</span>";
        $offlineIndicator = '<span class="widget status status-offline">OFFLINE</span>';

        $onlineText = 'ONLINE';
        $offlineText = 'OFFLINE';

        if($metrics['server']['status']) {
            $status['indicator'] = $onlineIndicator;
            $status['text'] = $onlineText;
        } else {
            $status['indicator'] = $offlineIndicator;
            $status['text'] = $offlineText;
        }

        return $status;
    }

    private function latencyBuilder($metrics) {
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
}

/*
* Handle Entry
*/

if(!isset($_GET['server'])) die();

$server = $_GET['server'];
$metrics = new ServerMetrics();
echo json_encode($metrics->$server);