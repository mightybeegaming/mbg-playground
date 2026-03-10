<?php
class Server {
    public $counterStrike;
    public $hytale;
    public $projectZomboid;
    public $vRising;

    private $serverData;

    public function __construct() {
        $this->serverData = json_decode(file_get_contents('../metrics/servermetrics.txt'), true);
        
        $this->counterStrike = $this->getMetricsCounterStrike();
        $this->hytale = $this->getMetricsHytale();
        $this->projectZomboid = $this->getMetricsProjectZomboid();
        $this->vRising = $this->getMetricsVRising();
    }

    public function getMetricsCounterStrike() {
        $metricsCounterStrike = [
            'monitorId' => '71',
            'server' => '',
            'onlinePlayers' => 0,
            'scoreT' => 0,
            'scoreCt' => 0,
            'currentMap' => '',
            'nextMap' => ''
        ];

        $fileContent = file_get_contents('../metrics/onlinecounterstrike.txt');

        preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $fileContent, $players);
        $metricsCounterStrike['onlinePlayers'] = count($players[1]);

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

    public function getMetricsHytale() {
        $metricsHytale = [
            'monitorId' => '73',
            'server' => '',
            'onlinePlayers' => 0
        ];

        $fileContent = file_get_contents('../metrics/onlinehytale.txt');

        preg_match('/^[^(]*\((\d+)\)/', $fileContent, $matches);
        $metricsHytale['onlinePlayers'] = $matches[1] ?? 0;

        $metricsHytale['server'] = $this->getMetricsServer($metricsHytale);

        return $metricsHytale;
    }

    public function getMetricsProjectZomboid() {
        $metricsProjectZomboid = [
            'monitorId' => '75',
            'server' => '',
            'onlinePlayers' => 0,
            'worldAge' => '',
            'worldDate' => '',
            'worldTime' => '',
            'weather' => '',
            'temperature' => 0,
            'season' => 0
        ];

        $fileLineCount = count(file('../metrics/onlineprojectzomboid.txt'));
        $metricsProjectZomboid['onlinePlayers'] = max(0, $fileLineCount - 1);
        
        foreach(file('../metrics/worldinfoprojectzomboid.txt') as $line) {
            [$key, $value] = explode(': ', $line, 2);
            $worldInfo[$key] = $value;
        }

        $metricsProjectZomboid['worldAge'] = $worldInfo['World Age'];
        
        $dateTime = explode('|', $worldInfo['Date Time']);
        $metricsProjectZomboid['worldDate'] = $dateTime[0] ?? '';

        $time = $dateTime[1] ?? 0;
        $time = strtotime($time);
        $time = date("g:i A", $time);
        $metricsProjectZomboid['worldTime'] = $time;

        $weather = explode('|', $worldInfo['Weather']);
        $metricsProjectZomboid['weather'] = $weather[0] ?? '';
        $metricsProjectZomboid['temperature'] = $weather[1] ?? '';
        $metricsProjectZomboid['season'] = $weather[2] ?? '';

        $metricsProjectZomboid['server'] = $this->getMetricsServer($metricsProjectZomboid);

        return $metricsProjectZomboid;
    }

    public function getMetricsVRising() {
        $metricsVRising = [
            'monitorId' => '58',
            'server' => '',
            'onlinePlayers' => 0
        ];

        $fileLineCount = count(file('../metrics/onlinevrising.txt'));
        $metricsVRising['onlinePlayers'] = max(0, $fileLineCount - 1);

        $metricsVRising['server'] = $this->getMetricsServer($metricsVRising);

        return $metricsVRising;
    }

    private function getMetricsServer($metrics) {
        $metricsServer = [
            'status' => 0,
            'statusIndicator' => '',
            'statusText' => '',
            'uptime24' => 0
        ];

        $monitorId = $metrics['monitorId'];
        $serverData = $this->serverData;
        $heartbeats = $serverData['heartbeatList'][$monitorId];

        $heartbeat = end($heartbeats);
        $metricsServer['status'] = $heartbeat['status'];

        $metrics['server'] = $metricsServer;
        $status = $this->statusBuilder($metrics);
        $metricsServer['statusIndicator'] = $status['indicator'];
        $metricsServer['statusText'] = $status['text'];

        $uptime24 = $serverData['uptimeList'][$monitorId . '_24'];
        $metricsServer['uptime24'] = round($uptime24 * 100, 2);
        
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
}

/*
* Handle Entry
*/
header('Content-Type: application/json');

if(!isset($_GET['metrics'])) die();

$metrics = $_GET['metrics'];
$server = new Server();
echo json_encode($server->$metrics);