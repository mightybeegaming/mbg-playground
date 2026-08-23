<?php
require_once '_allowonlymethods.php';
/*
 * Page Processor
 */
class Page {
    private $redirectUrl;
    private $redirectStatus;

    public function __construct() {
        $this->redirectUrl = $_SERVER['REDIRECT_URL'] ?? '/';
        $this->redirectStatus = $_SERVER['REDIRECT_STATUS'] ?? '';
    }

    public function getConfig(){
        $configFile = $this->getConfigFile();
        $configPath = "pages/{$configFile}";
        
        $config = simplexml_load_file($configPath);
        $config = $this->xmlToArray($config);
        
        $config['data']['navBar'] = $this->getNavBar();
        $config['data']['license'] = $this->getLicense();
        $config['data']['poweredBy'] = $this->getPoweredBy();

        $additionalData = $this->getAdditionalData();
        if($additionalData) $config['data'] = array_merge($config['data'], $additionalData['data']);

        return $config;
    }

    private function getConfigFile() {  
        if($this->redirectStatus && $this->redirectStatus !== '200') return 'error.xml';

        $path = $this->redirectUrl;
        if($path === '/') return 'home.xml';

        $path = str_replace('/', '', $path);
        $file = "{$path}.xml";
        $filePath = "pages/{$file}";
        if(!file_exists($filePath)) return 'error.xml';

        return $file;
    }

    private function getAdditionalData() {
        $additional = [];

        if($this->redirectUrl === '/downloads') {
            $additional['data']['downloadList'] = $this->getDownloadList();
        }

        if(str_ends_with($this->redirectUrl, '/mods')) {
            $additional['data']['modList'] = $this->getModList();
        }

        return $additional;
    }

    private function getModList() {
        $redirectUrlParts = explode('/', $this->redirectUrl);
        $game = $redirectUrlParts[1];

        $modPath = "mods/{$game}.htm";

        if(!file_exists($modPath)) return;
        
        return file_get_contents($modPath);
    }

    private function xmlToArray($xml) {
        $array = [];

        foreach($xml as $key => $value) {
            if($value->count()) {
                $array[$key] = $this->xmlToArray($value);
            } else {
                $array[$key] = (string)$value;
            }
        }

        return $array;
    }

    private function getLicense() {
        $year = date('Y');

        $license = '';
        $license .= "<p><span>© {$year} <a href=\"/\">MBG Playground</a>. All rights reserved.</span></p>";

        return $license;
    }

    private function getNavBar() {
        $navBar = '';
        $navBar .= '<p>';
        // $navBar .= '<a href="/counterstrike">Counter-Strike</a>&ensp;&ensp;';
        // $navBar .= '<a href="/hytale">Hytale</a>&ensp;&ensp;';
        $navBar .= '<a href="/palworld">Palworld</a>&ensp;&ensp;';
        $navBar .= '<a href="/projectzomboid">Project&nbsp;Zomboid</a>&ensp;&ensp;';
        $navBar .= '<a href="/vrising">V&nbsp;Rising</a>&ensp;&ensp;';
        $navBar .= '<a href="/valheim">Valheim</a>';
        $navBar .= '</p>';

        return $navBar;
    }

    private function getPoweredBy() {
        $poweredBy = '';
        $poweredBy .= '<p>Powered by <a href="https://github.com/mightybeegaming" target="_blank">MightyBee</a></p>';

        return $poweredBy;
    }

    private function getDownloadList() {
        $list = '';

        foreach(scandir('_downloads/') as $file):
            $file_full_path = "_downloads/{$file}";
            
            if(!is_file($file_full_path)) continue;

            $fileEscapedChars = htmlspecialchars($file);
            $fileFormattedSize = $this->formatSize(filesize($file_full_path));
            $fileUrlEncoded = urlencode($file);

            $list .= '<tr>';
            $list .= "<td>{$fileEscapedChars}</td>";
            $list .= "<td class=\"file-size align-right\">{$fileFormattedSize}</td>";
            $list .= "<td class=\"align-right\"><span class=\"highlight\"><a href=\"/_downloads/{$fileUrlEncoded}\" download>Download</a></span></td>";
            $list .= '</tr>';
        endforeach;

        return $list;
    }

    private function formatSize($bytes) {
        $units = [
            'GB' => 1073741824,
            'MB' => 1048576,
            'KB' => 1024
        ];

        $formattedSize = "{$bytes} B";

        foreach($units as $unit => $value) {
            if($bytes >= $value) {
                $convertedSize = number_format($bytes / $value, 2);
                $formattedSize = "{$convertedSize} {$unit}";

                break;
            }
        }

        return $formattedSize;
    }
}