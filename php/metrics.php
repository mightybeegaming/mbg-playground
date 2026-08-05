<?php
require_once '_allowonlymethods.php';
/*
 * Metrics API
 */
class Metrics {
    public $all;
    public $counterStrike;
    public $hytale;
    public $projectZomboid;
    public $vRising;
    public $valheim;
    
    private $serverData;
    private $metricsMapper;

    public function __construct() {
        $this->serverData = json_decode(file_get_contents('../metrics/_server.txt'), true);

        $this->metricsMapper = [
            'all' => 'getAll',
            'counterStrike' => 'getCounterStrike',
            'hytale' => 'getHytale',
            'palworld' => 'getPalworld',
            'projectZomboid' => 'getProjectZomboid',
            'vRising' => 'getVRising',
            'valheim' => 'getValheim'
        ];

        $server = $_GET['server'];
        if(isset($this->metricsMapper[$server])) {
            $method = $this->metricsMapper[$server];
            $this->$server = $this->$method();
        }
    }

    /*
     * All Servers
     */
    public function getAll() {
        foreach($this->metricsMapper as $server => $method) {
            if($server !== 'all') $metrics[$server] = $this->$method();
        }
        
        return $metrics;
    }

    /*
     * Counter-Strike
     */
    public function getCounterStrike() {
        $game = 'counterstrike';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $fileContent, $onlinePlayers);
        preg_match('/SCORE:T=(\d+);CT=(\d+)/', $fileContent, $scores);
        preg_match('/map\s*:\s*([^\s]+)/i', $fileContent, $currentMap);
        preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $fileContent, $nextMap);

        $metricsCounterStrike['onlinePlayers'] = count($onlinePlayers[1]);
        $metricsCounterStrike['scoreT'] = isset($scores[1]) ? (int)$scores[1] : 0;
        $metricsCounterStrike['scoreCt'] = isset($scores[2]) ? (int)$scores[2] : 0;
        $metricsCounterStrike['currentMap'] = $currentMap[1] ?? 0;
        $metricsCounterStrike['nextMap'] = $nextMap[1] ?? 0;

        return $this->mergeCommonData($game, $metricsCounterStrike);
    }

    /*
     * Hytale
     */
    public function getHytale() {
        $game = 'hytale';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match('/^[^(]*\((\d+)\)/', $fileContent, $onlinePlayers);
        preg_match('/at\s+(\d{4})-\d{2}-\d{2}T.*?on\s+(\d+(?:st|nd|rd|th))\s+day of year/', $fileContent, $worldAge);
        preg_match('/with (\d+(?:st|nd|rd|th)) moon phase/', $fileContent, $moonPhase);

        $metricsHytale['onlinePlayers'] = isset($onlinePlayers[1]) ? (int)$onlinePlayers[1] : 0;
        $metricsHytale['year'] = isset($worldAge[1]) ? (int)$worldAge[1] : 0;
        $metricsHytale['dayOfYear'] = isset($worldAge[2]) ? (int)$worldAge[2] : 0;
        $metricsHytale['moonPhase'] = $moonPhase[1] ?? '?';

        return $this->mergeCommonData($game, $metricsHytale);
    }

    /*
     * Palworld
     */
    public function getPalworld() {
        $game = 'palworld';

        $fileContent = file_get_contents("../metrics/{$game}.json");

        $onlinePlayers = 0;
        if($fileContent !== '') {
            $data = json_decode($fileContent, true);
            $onlinePlayers = count($data['players']);
        }
        
        $metricsPalworld['onlinePlayers'] = $onlinePlayers;

        return $this->mergeCommonData($game, $metricsPalworld);
    }

    /*
     * Project Zomboid
     */
    public function getProjectZomboid() {
        $game = 'projectzomboid';

        $fileLineCount = count(file("../metrics/{$game}.txt"));
        
        foreach(file('../metrics/projectzomboidworldinfo.txt') as $line) {
            [$key, $value] = explode(': ', $line, 2);
            $worldInfo[$key] = trim($value, "\r\n");
        }

        $dateTime = (isset($worldInfo['Date Time'])) ? $worldInfo['Date Time'] : '';
        if($dateTime) $dateTime = explode('|', $dateTime);
        
        $time = $dateTime[1] ?? '';
        if($time) {
            $time = strtotime($time);
            $time = date('g:i A', $time);
        }
        
        $weather = (isset($worldInfo['Weather'])) ? $worldInfo['Weather'] : '';
        if($weather) $weather = explode('|', $weather);

        $metricsProjectZomboid['onlinePlayers'] = max(0, $fileLineCount - 1);
        $metricsProjectZomboid['worldAge'] = isset($worldInfo['World Age']) ? (int)$worldInfo['World Age'] : 0;
        $metricsProjectZomboid['worldDate'] = $dateTime[0] ?? 0;
        $metricsProjectZomboid['worldTime'] = $time ? $time : 0;
        $metricsProjectZomboid['weather'] = isset($weather[0]) ? $weather[0] : 0;
        $metricsProjectZomboid['temperature'] = isset($weather[1]) ? (float)$weather[1] : 0;
        $metricsProjectZomboid['season'] = isset($weather[2]) ? $weather[2] : 0;
        $metricsProjectZomboid['electricity'] = $worldInfo['Blackout'] == 'false' ? 'On' : 'Off';
        $metricsProjectZomboid['water'] = $worldInfo['Water Shut'] == 'false' ? 'On' : 'Off';
        
        return $this->mergeCommonData($game, $metricsProjectZomboid);
    }

    /*
     * V Rising
     */
    public function getVRising() {
        $game = 'vrising';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match('/Total online players:\s*(\d+)/', $fileContent, $onlinePlayers);

        $metricsVRising['onlinePlayers'] = isset($onlinePlayers[1]) ? (int)$onlinePlayers[1] : 0;
        $metricsVRising['clans'] = substr_count($fileContent, 'Clan Name');

        return $this->mergeCommonData($game, $metricsVRising);
    }

    /*
     * Valheim
     */
    public function getValheim() {
        $game = 'valheim';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match('/Online\s+(\d+)/', $fileContent, $onlinePlayers);
        preg_match('/Day\s+(\d+)/', $fileContent, $worldAge);

        $metricsValheim['onlinePlayers'] = isset($onlinePlayers[1]) ? (int)$onlinePlayers[1] : 0;
        $metricsValheim['worldAge'] = isset($worldAge[1]) ? (int)$worldAge[1] : 0;    

        return $this->mergeCommonData($game, $metricsValheim);
    }

    private function getServer($metrics) {
        $monitorId = $metrics['monitorId'];
        $serverData = $this->serverData;
        $heartbeats = $serverData['heartbeatList'][$monitorId];

        $heartbeat = end($heartbeats);
        $metricsServer['status'] = $heartbeat['status'];

        $uptime24 = $serverData['uptimeList']["{$monitorId}_24"];
        $metricsServer['uptime24'] = round($uptime24 * 100, 2);
        
        return $metricsServer;
    }

    private function mergeCommonData($game, $serverMetrics) {
        $config = $this->getConfig("{$game}.json");
        if($config) $serverMetrics = array_merge($serverMetrics, $config);

        $serverMetrics['server'] = $this->getServer($serverMetrics);

        return $serverMetrics;
    }

    private function getConfig($file) {
        $config = file_get_contents("../config/{$file}");
        $config = json_decode($config, true);

        return $config;
    }
}

/*
* Handle Entry
*/
if(!isset($_GET['server'])) exit;

header('Content-Type: application/json');

$server = $_GET['server'];
$metrics = new Metrics();
echo json_encode($metrics->$server);