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

    public function __construct() {
        $this->serverData = json_decode(file_get_contents('../metrics/_server.txt'), true);
        
        switch($_GET['server']) {
            case 'all':
                $this->all = $this->getAll();
                break;
            case 'counterStrike':
                $this->counterStrike = $this->getCounterStrike();
                break;
            case 'hytale':
                $this->hytale = $this->getHytale();
                break;
            case 'projectZomboid':
                $this->projectZomboid = $this->getProjectZomboid();
                break;
            case 'vRising':
                $this->vRising = $this->getVRising();
                break;
            case 'valheim':
                $this->valheim = $this->getValheim();
                break;
        }
    }

    /*
     * All Servers
     */
    public function getAll() {
        $metrics['counterStrike'] = $this->getCounterStrike();
        $metrics['hytale'] = $this->getHytale();
        $metrics['projectZomboid'] = $this->getProjectZomboid();
        $metrics['vRising'] = $this->getVRising();
        $metrics['valheim'] = $this->getValheim();
        
        return $metrics;
    }

    /*
     * Counter-Strike
     */
    public function getCounterStrike() {
        $game = 'counterstrike';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $fileContent, $players);
        $metricsCounterStrike['onlinePlayers'] = count($players[1]);

        preg_match('/SCORE:T=(\d+);CT=(\d+)/', $fileContent, $scores);
        $metricsCounterStrike['scoreT'] = isset($scores[1]) ? (int)$scores[1] : '?';
        $metricsCounterStrike['scoreCt'] = isset($scores[2]) ? (int)$scores[2] : '?';

        preg_match('/map\s*:\s*([^\s]+)/i', $fileContent, $map);
        $metricsCounterStrike['currentMap'] = $map[1] ?? '?';

        preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $fileContent, $map);
        $metricsCounterStrike['nextMap'] = $map[1] ?? '?';

        $config = $this->getConfig("{$game}.json");
        if($config) $metricsCounterStrike = array_merge($metricsCounterStrike, $config);

        $metricsCounterStrike['server'] = $this->getServer($metricsCounterStrike);

        return $metricsCounterStrike;
    }

    /*
     * Hytale
     */
    public function getHytale() {
        $game = 'hytale';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match('/^[^(]*\((\d+)\)/', $fileContent, $matches);
        $metricsHytale['onlinePlayers'] = isset($matches[1]) ? (int)$matches[1] : 0;

        preg_match('/at\s+(\d{4})-\d{2}-\d{2}T.*?on\s+(\d+(?:st|nd|rd|th))\s+day of year/', $fileContent, $matches);
        $metricsHytale['year'] = isset($matches[1]) ? (int)$matches[1] : '?';
        $metricsHytale['dayOfYear'] = isset($matches[2]) ? (int)$matches[2] : '?';

        preg_match('/with (\d+(?:st|nd|rd|th)) moon phase/', $fileContent, $matches);
        $metricsHytale['moonPhase'] = $matches[1] ?? 'Unknown';

        $config = $this->getConfig("{$game}.json");
        if($config) $metricsHytale = array_merge($metricsHytale, $config);

        $metricsHytale['server'] = $this->getServer($metricsHytale);

        return $metricsHytale;
    }

    /*
     * Project Zomboid
     */
    public function getProjectZomboid() {
        $game = 'projectzomboid';

        $fileLineCount = count(file("../metrics/{$game}.txt"));
        $metricsProjectZomboid['onlinePlayers'] = max(0, $fileLineCount - 1);
        
        foreach(file('../metrics/projectzomboidworldinfo.txt') as $line) {
            [$key, $value] = explode(': ', $line, 2);
            $worldInfo[$key] = trim($value, "\r\n");
        }

        $metricsProjectZomboid['worldAge'] = isset($worldInfo['World Age']) ? (int)$worldInfo['World Age'] : '?';
        
        $dateTime = (isset($worldInfo['Date Time'])) ? $worldInfo['Date Time'] : '';
        if($dateTime) $dateTime = explode('|', $dateTime);
        $metricsProjectZomboid['worldDate'] = $dateTime[0] ?? '?';

        $time = $dateTime[1] ?? '';
        if($time) {
            $time = strtotime($time);
            $time = date('g:i A', $time);
        }
        $metricsProjectZomboid['worldTime'] = $time ? $time : '?';

        $weather = (isset($worldInfo['Weather'])) ? $worldInfo['Weather'] : '';
        if($weather) $weather = explode('|', $weather);
        $metricsProjectZomboid['weather'] = isset($weather[0]) ? $weather[0] : '?';
        $metricsProjectZomboid['temperature'] = isset($weather[1]) ? (float)$weather[1] : '?';
        $metricsProjectZomboid['season'] = isset($weather[2]) ? $weather[2] : '?';

        $config = $this->getConfig("{$game}.json");
        if($config) $metricsProjectZomboid = array_merge($metricsProjectZomboid, $config);

        $metricsProjectZomboid['server'] = $this->getServer($metricsProjectZomboid);

        return $metricsProjectZomboid;
    }

    /*
     * V Rising
     */
    public function getVRising() {
        $game = 'vrising';

        $fileLineCount = count(file("../metrics/{$game}.txt"));
        $metricsVRising['onlinePlayers'] = max(0, $fileLineCount - 1);

        /*
        foreach(file('../metrics/vrisingworldinfo.txt') as $line) {
            [$key, $value] = explode(': ', $line, 2);
            $worldInfo[$key] = $value;
        }

        $bootTime = (isset($worldInfo['Server Boot Time'])) ? $worldInfo['Server Boot Time'] : '';
        if($bootTime) $bootTime = $this->convertToLocalTime($bootTime);

        $incursion = $this->calculateIncursion($bootTime);
        if($incursion) $metricsVRising = array_merge($metricsVRising, $incursion);
        */

        $config = $this->getConfig("{$game}.json");
        if($config) $metricsVRising = array_merge($metricsVRising, $config);

        $metricsVRising['server'] = $this->getServer($metricsVRising);

        return $metricsVRising;
    }

    /*
     * Valheim
     */
    public function getValheim() {
        $game = 'valheim';

        $fileContent = file_get_contents("../metrics/{$game}.txt");

        preg_match('/Online\s+(\d+)/', $fileContent, $match);
        $metricsValheim['onlinePlayers'] = isset($match[1]) ? (int)$match[1] : 0;
        
        preg_match('/Day\s+(\d+)/', $fileContent, $match);
        $metricsValheim['worldAge'] = isset($match[1]) ? (int)$match[1] : '?';    

        $config = $this->getConfig("{$game}.json");
        if($config) $metricsValheim = array_merge($metricsValheim, $config);

        $metricsValheim['server'] = $this->getServer($metricsValheim);

        return $metricsValheim;
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

    private function getConfig($file) {
        $config = file_get_contents("../config/{$file}");
        $config = json_decode($config, true);

        return $config;
    }

    private function convertToLocalTime($dateTime) {
        $utcDateTime = new DateTime($dateTime, new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('Asia/Singapore'));
        $localDateTime = $utcDateTime->format('Y-m-d H:i:s');

        return $localDateTime;
    }

    private function calculateIncursion($bootTime) {
        $incursion['phase'] = '?';
        $incursion['timeLeft'] = '?';
        $incursion['time'] = '?';

        if(!$bootTime) return $incursion;

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

        $offset = 10;
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
if(!isset($_GET['server'])) exit;

header('Content-Type: application/json');

$server = $_GET['server'];
$metrics = new Metrics();
echo json_encode($metrics->$server);