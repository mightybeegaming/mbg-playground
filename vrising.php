<?php
require_once('php/templateparser.php');

$config['templateFile'] = 'templates/game.htm';
$config['data'] = [
    'title' => 'V Rising',
    'description' => 'This is a V Rising server with quality of life adjustments and game mechanic overhaul mods.',
    'image' => '/media/bannervrising.jpg',
    'url' => '/vrising',
    'onloadJs' => '/js/onloadvrising.js',
    'infoBox' => ''
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();