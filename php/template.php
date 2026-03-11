<?php
Class Template {
    private $config;
    private $data;
    private $downloadList;

    public function __construct($config) {
        $this->config = $config;
        $this->data = $this->config['data'];
    }

    public function render() {
        echo $this->parse();
    }

    private function parse() {
        $placeHolders = [];
        
        foreach($this->data as $key => $value) {
            if($key === 'infoBox') $value = $this->buildInfoBox($value);
            $placeHolders['{{' . $key . '}}'] = $value;
        }

        $placeHolders['{{downloadList}}'] = $this->downloadList ?? '';
        $placeHolders['{{navBar}}'] = $this->getNavBar();
        $placeHolders['{{license}}'] = $this->getLicense();

        $template = $this->getTemplateFile();
        $template = strtr($template, $placeHolders);

        return $template;
    }

    public function setDownloadList($list) {
        $this->downloadList = $list;
    }

    private function buildInfoBox($infoBox) {
        $defaultInfoBox = '';
        $defaultInfoBox .= '<div class="info-box"><b>Status</b><br><span class="highlight right-side" id="statusText"></span></div>';
        $defaultInfoBox .= '<div class="info-box"><b>Uptime (24H)</b><br><span class="highlight right-side" id="uptime24"></span></div>';
        $defaultInfoBox .= '<div class="info-box"><b>Online Players</b><br><span class="highlight right-side" id="onlinePlayers"></span></div>';

        if($infoBox) $defaultInfoBox .= $infoBox;

        return $defaultInfoBox;
    }

    private function getTemplateFile() {
        $templateFile = $this->config['templateFile'];
        $templateFile = file_get_contents($templateFile);

        return $templateFile;
    }

    private function getLicense() {
        $license = '<span>© ' . date('Y') . ' <a href="/">MBG Playground</a>. All rights reserved.</span>';

        return $license;
    }

    private function getNavBar() {
        $navBar = '';
        $navBar .= '<p>';
        $navBar .= '<a href="/counterstrike">Counter-Strike</a> | ';
        $navBar .= '<a href="/hytale">Hytale</a> | ';
        $navBar .= '<a href="/projectzomboid">Project Zomboid</a> | ';
        $navBar .= '<a href="/vrising">V Rising</a>';
        $navBar .= '</p>';

        return $navBar;
    }
}