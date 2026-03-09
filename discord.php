<?php
require_once('processors/templateparser.php');

$config['templateFile'] = 'templates/discord.htm';
$config['data'] = [
    'title' => 'Discord',
    'description' => 'MBG Playground official Discord invitation.',
    'image' => '/media/bannerdiscord.jpg',
    'url' => '/discord',
    'onloadJs' => '/js/onloaddiscord.js'
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();