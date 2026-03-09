<?php
require_once('processors/templateparser.php');

$infoBox = '';
$infoBox .= '<div class="info-box"><b>Match Score</b><br><div class="right-side" id="worldAge"></div></div>';
$infoBox .= '<div class="info-box"><b>Current Map</b><br><span class="highlight right-side" id="dateTime"></span></div>';
$infoBox .= '<div class="info-box"><b>Next Map</b><br><span class="highlight right-side" id="weatherTemperature"></span></div>';

$config['templateFile'] = 'templates/game.htm';
$config['data'] = [
    'title' => 'Project Zomboid',
    'description' => 'This is a Project Zomboid server with quality of life and immersion mods.',
    'image' => '/media/bannerprojectzomboid.jpg',
    'url' => '/projectzomboid',
    'onloadJs' => '/js/onloadprojectzomboid.js',
    'infoBox' => $infoBox
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();