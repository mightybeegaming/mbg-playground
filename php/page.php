<?php
require_once('_allowonlymethods.php');
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
        $configPath = 'pages/' . $configFile;
        
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

        $file = str_replace('/', '', $path) . '.xml';
        $filePath = 'pages/' . $file;
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

        $modPath = 'mods/' . $game . '.htm';

        if(!file_exists($modPath)) return;

        $modList = file_get_contents($modPath);
        
        return $modList;
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
        $license = '';
        $license .= '<p><span>© ' . date('Y') . ' <a href="/">MBG Playground</a>. All rights reserved.</span></p>';

        return $license;
    }

    private function getNavBar() {
        $navBar = '';
        $navBar .= '<p>';
        $navBar .= '<a href="/counterstrike">Counter-Strike</a>&ensp;&ensp;';
        $navBar .= '<a href="/hytale">Hytale</a>&ensp;&ensp;';
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
            $file_full_path = '_downloads/' . $file;
            
            if(!is_file($file_full_path)) continue;

            $list .= '<tr>';
            $list .= '<td>' . htmlspecialchars($file) . '</td>';
            $list .= '<td class="file-size align-right">' . $this->formatSize(filesize($file_full_path)) . '</td>';
            $list .= '<td class="align-right"><span class="highlight"><a href="/_downloads/' . urlencode($file) . '" download>Download</a></span></td>';
            $list .= '</tr>';
        endforeach;

        return $list;
    }

    private function formatSize($bytes) {
        $gb = 1073741824;
        $mb = 1048576;
        $kb = 1024;

        if($bytes >= $gb) return number_format($bytes / $gb, 2) . ' GB';
        if($bytes >= $mb) return number_format($bytes / $mb, 2) . ' MB';
        if($bytes >= $kb) return number_format($bytes / $kb, 2) . ' KB';
        
        return $bytes . ' B';
    }
}