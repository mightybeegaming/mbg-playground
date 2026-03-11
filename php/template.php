<?php
Class Template {
    private $config;
    private $data;

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
            $placeHolders['{{' . $key . '}}'] = $value;
        }

        $template = $this->getTemplateFile();
        $template = strtr($template, $placeHolders);

        return $template;
    }

    private function getTemplateFile() {
        $templateFile = $this->config['templateFile'];
        $templateFile = file_get_contents($templateFile);

        return $templateFile;
    }
}