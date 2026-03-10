<?php
/*
 * Page Config
 */
require_once('downloadsgenerator.php');

class PageConfig {
    public $data;

    public $requestUri;
    private $redirectStatus;

    public function __construct() {
        if(isset($_SERVER['REQUEST_URI'])) $this->requestUri = $_SERVER['REQUEST_URI'];
        if(isset($_SERVER['REDIRECT_STATUS'])) $this->redirectStatus = $_SERVER['REDIRECT_STATUS'];

        $this->data = $this->getData();
    }

    private function getData(){
        $isModlist = false;
        $addiotional = [];

        $configFileName = '';
        switch($this->requestUri) {
            // Home
            case '/':
                $configFileName = 'home.xml';
                break;
            
            // Others
            case '/discord':
                $configFileName = 'discord.xml';
                break;
            case '/downloads':
                $configFileName = 'downloads.xml';
                $addiotional['data']['downloadList'] = $this->getDownloadList();
                break;
            
            // Games
            case '/counterstrike':
                $configFileName = 'counterstrike.xml';
                break;
            case '/hytale':
                $configFileName = 'hytale.xml';
                break;
            case '/projectzomboid':
                $configFileName = 'projectzomboid.xml';
                break;
            case '/vrising':
                $configFileName = 'vrising.xml';
                break;
            
            // Mod List
            case '/counterstrike/mods':
                $configFileName = 'counterstrikemods.xml';
                $isModlist = true;
                break;
            case '/vrising/mods':
                $configFileName = 'vrisingmods.xml';
                $isModlist = true;
                break;
        }
        if(!$configFileName) $configFileName = '404.xml';;

        if($this->redirectStatus && $this->redirectStatus !== '200') $configFileName = '403.xml';;

        if($isModlist) $addiotional['data']['modList'] = $this->getModList($this->requestUri);

        $data = simplexml_load_file('pages/' . $configFileName);
        $data = $this->xmlToArray($data);
        
        if($addiotional) $data['data'] = array_merge($data['data'], $addiotional['data']);

        return $data;
    }

    private function getDownloadList() {
        $downloadsGenerator = new DownloadsGenerator();
        
        return $downloadsGenerator->getList();
    }

    private function getModList($requestUri) {
        switch($requestUri) {
            case '/counterstrike/mods':
                $modListPath = '.counterstrike/modList.htm';
                break;
            case '/vrising/mods':
                $modListPath = '.vrising/modList.htm';
                break;
        }

        $modList = file_get_contents($modListPath);

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