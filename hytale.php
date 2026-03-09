<?php
require_once('php/templateparser.php');

$config['templateFile'] = 'templates/game.htm';
$config['data'] = [
    'title' => 'Hytale',
    'description' => 'This is a modded Hytale server to test and explore the early access build.',
    'image' => '/media/bannerhytale.jpg',
    'url' => '/hytale',
    'onloadJs' => '/js/onloadhytale.js',
    'infoBox' => ''
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();