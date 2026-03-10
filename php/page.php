<?php
require_once('download.php');

class Page {
    private $redirectUrl;
    private $redirectStatus;

    public function __construct() {
        if(isset($_SERVER['REQUEST_URI'])) $this->redirectUrl = $_SERVER['REDIRECT_URL'] ?? '/';
        if(isset($_SERVER['REDIRECT_STATUS'])) $this->redirectStatus = $_SERVER['REDIRECT_STATUS'];
    }

    public function getConfig(){
        $configFile = $this->getConfigFile();

        $config = simplexml_load_file('pages/' . $configFile);
        $config = $this->xmlToArray($config);
        
        $addiotionalData = $this->getAdditionalData();
        if($addiotionalData) $config['data'] = array_merge($config['data'], $addiotionalData['data']);

        return $config;
    }

    private function getConfigFile() {
        $configFileName = '';
        switch($this->redirectUrl) {
            // Home
            case '/':
                $configFileName = 'home';
                break;
            
            // Others
            case '/discord':
                $configFileName = 'discord';
                break;
            case '/downloads':
                $configFileName = 'downloads';
                break;
            
            // Games
            case '/counterstrike':
                $configFileName = 'counterstrike';
                break;
            case '/hytale':
                $configFileName = 'hytale';
                break;
            case '/projectzomboid':
                $configFileName = 'projectzomboid';
                break;
            case '/vrising':
                $configFileName = 'vrising';
                break;
            
            // Mod List
            case '/counterstrike/mods':
                $configFileName = 'counterstrikemods';
                break;
            case '/vrising/mods':
                $configFileName = 'vrisingmods';
                break;
        }

        if(!$configFileName) $configFileName = '404';;
        if($this->redirectStatus && $this->redirectStatus !== '200') $configFileName = '403';;

        return $configFileName . '.xml';
    }

    private function getAdditionalData() {
        $isModlist = false;
        $addiotional = [];

        switch($this->redirectUrl) {
            case '/downloads':
                $addiotional['data']['downloadList'] = $this->getDownloadList();
                break;

            // Mod List
            case '/counterstrike/mods':
                $isModlist = true;
                break;
            case '/vrising/mods':
                $isModlist = true;
                break;
        }

        if($isModlist) $addiotional['data']['modList'] = $this->getModList();

        return $addiotional;
    }

    private function getDownloadList() {
        $download = new Download();
        
        return $download->generateList();
    }

    private function getModList() {
        switch($this->redirectUrl) {
            case '/counterstrike/mods':
                $modFolder = '_counterstrike';
                break;
            case '/vrising/mods':
                $modFolder = '_vrising';
                break;
        }
        $modList = file_get_contents($modFolder . '/modlist.htm');

        return $modList;
    }

    private function xmlToArray($xml) {
        $array = [];

        foreach($xml as $key => $value) {
            if($value->count() > 0) {
                $array[$key] = $this->xmlToArray($value);
            } else {
                $array[$key] = (string)$value;
            }
        }

        return $array;
    }
}