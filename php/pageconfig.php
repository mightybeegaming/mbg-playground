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
        if($this->redirectStatus && $this->redirectStatus !== '200') return $this->getConfigError403();

        $data = '';
        switch($this->requestUri) {
            case '/':
                $data = $this->getConfigHome();
                break;
            case '/discord':
                $data = $this->getConfigDiscord();
                break;
            case '/downloads':
                $data = $this->getConfigDownloads();
                break;
            case '/counterstrike':
                $data = $this->getConfigCounterStrike();
                break;
            case '/hytale':
                $data = $this->getConfigHytale();
                break;
            case '/projectzomboid':
                $data = $this->getConfigProjectZomboid();
                break;
            case '/vrising':
                $data = $this->getConfigVRising();
                break;
        }
        if(!$data) $data = $this->getConfigError404();

        return $data;
    }

    private function getConfigHome() {
        $config['templateFile'] = 'templates/home.htm';
        $config['data'] = [
            'title' => 'MBG Playground',
            'description' => 'MBG Playground is a collection of media and game servers to enjoy with friends.',
            'image' => '/media/logombg.jpg',
            'url' => '/',
            'onloadJs' => '/js/onloadhome.js'
        ];

        return $config;
    }

    private function getConfigDiscord() {
        $config['templateFile'] = 'templates/discord.htm';
        $config['data'] = [
            'title' => 'Discord',
            'description' => 'MBG Playground official Discord invitation.',
            'image' => '/media/bannerdiscord.jpg',
            'url' => '/discord',
            'onloadJs' => '/js/onloaddiscord.js'
        ];

        return $config;
    }

    private function getConfigDownloads() {
        $downloadsGenerator = new DownloadsGenerator();
        $downloadList = $downloadsGenerator->getDownloadList();

        $config['templateFile'] = 'templates/downloads.htm';
        $config['data'] = [
            'title' => 'Downloads',
            'description' => 'This is the official consolidated downloads page for MBG Playground.',
            'image' => '/media/logombg.jpg',
            'onloadJs' => '/js/onloaddownloads.js',
            'downloadList' => $downloadList
        ];

        return $config;
    }

    private function getConfigError403() {
        $config['templateFile'] = 'templates/error.htm';
        $config['data'] = [
            'title' => '403 - Forbidden',
            'description' => 'You don’t have permission to access this page.'
        ];

        return $config;
    }

    private function getConfigError404() {
        $config['templateFile'] = 'templates/error.htm';
        $config['data'] = [
            'title' => '404 - Page Not Found',
            'description' => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.'
        ];

        return $config;
    }

    private function getConfigError500() {
        $config['templateFile'] = 'templates/error.htm';
        $config['data'] = [
            'title' => '500 - Server Error',
            'description' => 'The server encountered an unexpected condition.'
        ];

        return $config;
    }

    private function getConfigCounterStrike() {
        $infoBox = '';
        $infoBox .= '<div class="info-box"><b>Match Score</b><br><div class="right-side" id="matchScore"></div></div>';
        $infoBox .= '<div class="info-box"><b>Current Map</b><br><span class="highlight right-side" id="currentMap"></span></div>';
        $infoBox .= '<div class="info-box"><b>Next Map</b><br><span class="highlight right-side" id="nextMap"></span></div>';

        $config['templateFile'] = 'templates/game.htm';
        $config['data'] = [
            'title' => 'Counter-Strike',
            'description' => 'This is a Counter-Strike server with performance and stability enhancements.',
            'image' => '/media/bannercounterstrike.jpg',
            'url' => '/counterstrike',
            'onloadJs' => '/js/onloadcounterstrike.js',
            'infoBox' => $infoBox
        ];

        return $config;
    }

    private function getConfigHytale() {
        $config['templateFile'] = 'templates/game.htm';
        $config['data'] = [
            'title' => 'Hytale',
            'description' => 'This is a modded Hytale server to test and explore the early access build.',
            'image' => '/media/bannerhytale.jpg',
            'url' => '/hytale',
            'onloadJs' => '/js/onloadhytale.js',
            'infoBox' => ''
        ];

        return $config;
    }

    private function getConfigProjectZomboid() {
        $infoBox = '';
        $infoBox .= '<div class="info-box"><b>World Age</b><br><div class="right-side" id="worldAge"></div></div>';
        $infoBox .= '<div class="info-box"><b>Date Time</b><br><div class="right-side" id="dateTime"></div></div>';
        $infoBox .= '<div class="info-box"><b>Weather</b><br><div class="right-side" id="weatherTemperature"></div></div>';

        $config['templateFile'] = 'templates/game.htm';
        $config['data'] = [
            'title' => 'Project Zomboid',
            'description' => 'This is a Project Zomboid server with quality of life and immersion mods.',
            'image' => '/media/bannerprojectzomboid.jpg',
            'url' => '/projectzomboid',
            'onloadJs' => '/js/onloadprojectzomboid.js',
            'infoBox' => $infoBox
        ];

        return $config;
    }

    private function getConfigVRising() {
        $config['templateFile'] = 'templates/game.htm';
        $config['data'] = [
            'title' => 'V Rising',
            'description' => 'This is a V Rising server with quality of life adjustments and game mechanic overhaul mods.',
            'image' => '/media/bannervrising.jpg',
            'url' => '/vrising',
            'onloadJs' => '/js/onloadvrising.js',
            'infoBox' => ''
        ];

        return $config;
    }
}