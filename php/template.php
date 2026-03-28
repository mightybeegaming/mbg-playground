<?php
require_once '_allowonlymethods.php';
/*
 * Template Processor
 */
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
        $placeHolders = array_combine(
            array_map(
                fn($key) => "{{ {$key} }}",
                array_keys($this->data)
            ),
            $this->data
        );

        $template = $this->getTemplateFile();

        return strtr($template, $placeHolders);
    }

    private function getTemplateFile() {
        $templateFile = $this->config['templateFile'];

        return file_get_contents($templateFile);
    }
}