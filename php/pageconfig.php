<?php
/*
 * Page Config
 */
require_once('downloadsgenerator.php');

class PageConfig {
    public $data;

    private $requestUri;
    private $redirectStatus;

    public function __construct() {
        if(isset($_SERVER['REQUEST_URI'])) $this->requestUri = $_SERVER['REQUEST_URI'];
        if(isset($_SERVER['REDIRECT_STATUS'])) $this->redirectStatus = $_SERVER['REDIRECT_STATUS'];

        $this->data = $this->getData();
    }

    private function getData(){
        $configFileName = '';
        switch($this->requestUri) {
            // Home
            case '/':
                $configFileName = 'pagehome.json';
                break;
            
            // Others
            case '/discord':
                $configFileName = 'pagediscord.json';
                break;
            case '/downloads':
                $configFileName = 'pagedownloads.json';
                break;
            
            // Games
            case '/counterstrike':
                $configFileName = 'pagecounterstrike.json';
                break;
            case '/hytale':
                $configFileName = 'pagehytale.json';
                break;
            case '/projectzomboid':
                $configFileName = 'pageprojectzomboid.json';
                break;
            case '/vrising':
                $configFileName = 'pagevrising.json';
                break;
            
            
        }
        if(!$configFileName) $configFileName = 'pageerror404.json';;

        if($this->redirectStatus && $this->redirectStatus !== '200') $configFileName = 'pageerror403.json';;

        $configJson = file_get_contents('configs/' . $configFileName);
        $data = json_decode($configJson, true);

        return $data;
    }
}