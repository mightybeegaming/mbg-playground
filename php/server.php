<?php
class Server {
    private $serverData;

    public function __construct() {
        $this->serverData = json_decode(file_get_contents('../metrics/servermetrics.txt'), true);
    }

    public function getMetrics() {
        $metrics['counterStrike'] = $this->getMetricsCounterStrike();
        $metrics['hytale'] = $this->getMetricsHytale();
        $metrics['projectZomboid'] = $this->getMetricsProjectZomboid();
        $metrics['vRising'] = $this->getMetricsVRising();
        
        return $metrics;
    }

    public function getMetricsCounterStrike() {
        $game = 'counterstrike';

        $metricsCounterStrike = [
            'server' => '',
            'onlinePlayers' => 0,
            'scoreT' => 0,
            'scoreCt' => 0,
            'currentMap' => '',
            'nextMap' => ''
        ];

        $fileContent = file_get_contents('../metrics/online' . $game . '.txt');

        preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $fileContent, $players);
        $metricsCounterStrike['onlinePlayers'] = count($players[1]);

        preg_match('/SCORE:T=(\d+);CT=(\d+)/', $fileContent, $scores);
        $metricsCounterStrike['scoreT'] = $scores[1] ?? 0;
        $metricsCounterStrike['scoreCt'] = $scores[2] ?? 0;

        preg_match('/map\s*:\s*([^\s]+)/i', $fileContent, $map);
        $metricsCounterStrike['currentMap'] = $map[1] ?? '';

        preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $fileContent, $map);
        $metricsCounterStrike['nextMap'] = $map[1] ?? '';

        $config = $this->getConfig($game . '.json');
        if($config) $metricsCounterStrike = array_merge($metricsCounterStrike, $config);

        $metricsCounterStrike['server'] = $this->getMetricsServer($metricsCounterStrike);

        return $metricsCounterStrike;
    }

    public function getMetricsHytale() {
        $game = 'hytale';

        $metricsHytale = [
            'server' => '',
            'onlinePlayers' => 0,
            'worldAge' => 0,
            'moonPhase' => ''
        ];

        $fileContent = file_get_contents('../metrics/online' . $game . '.txt');

        preg_match('/^[^(]*\((\d+)\)/', $fileContent, $matches);
        $metricsHytale['onlinePlayers'] = $matches[1] ?? 0;

        preg_match('/on (\d+)(?:st|nd|rd|th) day of year/', $fileContent, $matches);
        $metricsHytale['worldAge'] = $matches[1];

        preg_match('/with (\d+(?:st|nd|rd|th)) moon phase/', $fileContent, $matches);
        $metricsHytale['moonPhase'] = $matches[1];

        $config = $this->getConfig($game . '.json');
        if($config) $metricsHytale = array_merge($metricsHytale, $config);

        $metricsHytale['server'] = $this->getMetricsServer($metricsHytale);

        return $metricsHytale;
    }

    public function getMetricsProjectZomboid() {
        $game = 'projectzomboid';

        $metricsProjectZomboid = [
            'server' => '',
            'onlinePlayers' => 0,
            'worldAge' => '',
            'worldDate' => '',
            'worldTime' => '',
            'weather' => '',
            'temperature' => 0,
            'season' => 0
        ];

        $fileLineCount = count(file('../metrics/online' . $game . '.txt'));
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
        $time = date('g:i A', $time);
        $metricsProjectZomboid['worldTime'] = $time;

        $weather = explode('|', $worldInfo['Weather']);
        $metricsProjectZomboid['weather'] = $weather[0] ?? '';
        $metricsProjectZomboid['temperature'] = $weather[1] ?? '';
        $metricsProjectZomboid['season'] = $weather[2] ?? '';

        $config = $this->getConfig($game . '.json');
        if($config) $metricsProjectZomboid = array_merge($metricsProjectZomboid, $config);

        $metricsProjectZomboid['server'] = $this->getMetricsServer($metricsProjectZomboid);

        return $metricsProjectZomboid;
    }

    public function getMetricsVRising() {
        $game = 'vrising';

        $metricsVRising = [
            'server' => '',
            'onlinePlayers' => 0,
            'phase' => '',
            'timeLeft' => ''
        ];

        $fileLineCount = count(file('../metrics/online' . $game . '.txt'));
        $metricsVRising['onlinePlayers'] = max(0, $fileLineCount - 1);

        foreach(file('../metrics/worldinfovrising.txt') as $line) {
            [$key, $value] = explode(': ', $line, 2);
            $worldInfo[$key] = $value;
        }

        $bootTime = $worldInfo['Server Boot Time'];
        $bootTime = $this->convertToLocalTime($bootTime);

        $incursion = $this->calculateIncursion($bootTime);
        if($incursion) $metricsVRising = array_merge($metricsVRising, $incursion);

        $config = $this->getConfig($game . '.json');
        if($config) $metricsVRising = array_merge($metricsVRising, $config);

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

    private function getConfig($file) {
        $config = file_get_contents('../config/' . $file);
        $config = json_decode($config, true);

        return $config;
    }

    private function statusBuilder($metrics) {
        $status = [];
        
        $onlinePlayers = (int)$metrics['onlinePlayers'];
        $onlinePlayers = ($onlinePlayers > 0) ? $onlinePlayers . ' ' : '';

        $onlineIndicator = '<span class="widget status-online">' . $onlinePlayers . 'ONLINE</span>';
        $offlineIndicator = '<span class="widget status-offline">OFFLINE</span>';

        $serverStatus = $metrics['server']['status'];
        $status['indicator'] = $serverStatus ? $onlineIndicator : $offlineIndicator;
        $status['text'] = $serverStatus ? 'ONLINE' : 'OFFLINE';

        return $status;
    }

    private function convertToLocalTime($dateTime) {
        $utcDateTime = new DateTime($dateTime, new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('Asia/Singapore'));
        $localDateTime = $utcDateTime->format('Y-m-d H:i:s');

        return $localDateTime;
    }

    private function calculateIncursion($bootTime) {
        $bootTime = strtotime($bootTime);

        $incursionDuration = 20 * 60;
        $incursionInterval = 30 * 60;
        $preparingDuration = $incursionDuration;

        $now = time();
        $elapsed = $now - $bootTime;
        
        $cycleLength = $preparingDuration + $incursionDuration + $incursionInterval;
        $cycleNumber = floor($elapsed / $cycleLength);
        $cycleStart = $bootTime + $cycleNumber * $cycleLength;
        $activeStart = $cycleStart + $preparingDuration;

        if($now < $activeStart) {
            $phase = 'Preparing';

            $timeLeft = $activeStart - $now;
        } elseif($now < $activeStart + $incursionDuration) {
            $phase = 'Active';

            $timeLeft = $activeStart + $incursionDuration - $now;
        } else {
            $phase = 'Waiting';

            $nextCycleStart = $cycleStart + $cycleLength;
            $timeLeft = $nextCycleStart - $now;
        }

        $incursion['phase'] = $phase;
        $incursion['timeLeft'] = gmdate('H:i:s', $timeLeft);

        $offset = 9.25;
        $dayDuration = 1200;
        $gameElapsed = $elapsed % $dayDuration;
        $inGameHour = ($gameElapsed / $dayDuration) * 24 + $offset;

        $hours = floor($inGameHour);
        $minutes = floor(($inGameHour - $hours) * 60);

        $ampm = ($hours >= 12) ? 'PM' : 'AM';
        $hours = $hours % 12;
        if($hours == 0) $hours = 12;

        $time = sprintf('%2d:%02d %s', $hours, $minutes, $ampm);

        $incursion['time'] = $time;

        return $incursion;
    }
}

/*
* Handle Entry
*/
header('Content-Type: application/json');

if(!isset($_GET['method'])) die();

$method = $_GET['method'];
$server = new Server();
echo json_encode($server->$method());