<?php
require_once('processors/templateparser.php');

$config['templateFile'] = 'templates/home.htm';
$config['data'] = [
    'title' => 'MBG Playground',
    'description' => 'MBG Playground is a collection of media and game servers to enjoy with friends.',
    'image' => '/media/logombg.jpg',
    'url' => '/',
    'onloadJs' => '/js/onloadhome.js'
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();