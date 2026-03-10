<?php
require_once('download.php');

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
        
        $additionalData = $this->getAdditionalData();
        if($additionalData) $config['data'] = array_merge($config['data'], $additionalData['data']);

        return $config;
    }

    private function getConfigFile() {
        if($this->redirectStatus && $this->redirectStatus !== '200') return '403.xml';

        $path = $this->redirectUrl;
        if($path === '/') return 'home.xml';

        $file = str_replace('/', '', $path) . '.xml';
        $filePath = 'pages/' . $file;
        if(!file_exists($filePath)) return '404.xml';

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

    private function getDownloadList() {
        $download = new Download();
        
        return $download->generateList();
    }

    private function getModList() {
        $redirectUrlParts = explode('/', $this->redirectUrl);
        $game = $redirectUrlParts[1];

        $modFolder = '_' . $game;
        $modPath = $modFolder . '/modlist.htm';

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
}