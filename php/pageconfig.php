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
        $additionalKey = '';
        $additionalValue = '';

        $configFileName = '';
        switch($this->requestUri) {
            // Home
            case '/':
                $configFileName = 'pagehome.xml';
                break;
            
            // Others
            case '/discord':
                $configFileName = 'pagediscord.xml';
                break;
            case '/downloads':
                $configFileName = 'pagedownloads.xml';
                $additionalKey = 'downloadList';
                $additionalValue = $this->getDownloadList();
                break;
            
            // Games
            case '/counterstrike':
                $configFileName = 'pagecounterstrike.xml';
                break;
            case '/hytale':
                $configFileName = 'pagehytale.xml';
                break;
            case '/projectzomboid':
                $configFileName = 'pageprojectzomboid.xml';
                break;
            case '/vrising':
                $configFileName = 'pagevrising.xml';
                break;
            
            // Mod List
            case '/counterstrike/mods':
                $configFileName = 'modscounterstrike.xml';
                $additionalKey = 'modList';
                $additionalValue = $this->getModList($this->requestUri);
                break;
            case '/vrising/mods':
                $configFileName = 'modsvrising.xml';
                $additionalKey = 'modList';
                $additionalValue = $this->getModList($this->requestUri);
                break;
        }
        if(!$configFileName) $configFileName = 'pageerror404.xml';;

        if($this->redirectStatus && $this->redirectStatus !== '200') $configFileName = 'pageerror403.xml';;

        $data = simplexml_load_file('configs/' . $configFileName);
        $data = $this->xmlToArray($data);

        if($additionalKey && $additionalValue) {
            $data['data'][$additionalKey] = $additionalValue;
        }

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