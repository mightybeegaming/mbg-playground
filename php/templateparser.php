<?php
/*
 * Template Parser
 */
Class TemplateParser {
    private $config;
    private $data;
    private $downloadList;

    public function __construct($config) {
        $this->config = $config;
        $this->data = $this->config['data'];
    }

    public function parseTemplate() {
        $templateFile = $this->getTemplateFile();

        $parsedTemplate = $templateFile;
        foreach($this->data as $key => $value) {
            if($key === 'infoBox') $value = $this->buildInfoBox($value);
            
            $parsedTemplate = str_replace("{{{$key}}}", $value, $parsedTemplate);
        }

        $downloadList = $this->downloadList;
        $parsedTemplate = str_replace('{{downloadList}}', $downloadList, $parsedTemplate);

        $navBar = $this->getNavBar();
        $parsedTemplate = str_replace('{{navBar}}', $navBar, $parsedTemplate);

        $license = $this->getLicense();
        $parsedTemplate = str_replace('{{license}}', $license, $parsedTemplate);

        return $parsedTemplate;
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
        $date = date('Y');
        $license = "<span>© {$date} <a href=\"/\">MBG Playground</a>. All rights reserved.</span>";

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