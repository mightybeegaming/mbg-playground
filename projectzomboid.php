<?php
require_once('processors/templateparser.php');

$config['templateFile'] = 'templates/game.htm';

$config['data'] = [
    'title' => 'Project Zomboid',
    'description' => 'This is a Project Zomboid server with quality of life and immersion mods.',
    'image' => '/media/bannerprojectzomboid.jpg',
    'url' => '/projectzomboid',
    'onloadJs' => '/js/onloadprojectzomboid.js'
];

$infoBox = '';
$infoBox .= '<div class="info-box"><b>Status</b><br><span class="highlight right-side" id="statusText"></span></div>';
$infoBox .= '<div class="info-box"><b>Uptime (24H)</b><br><span class="highlight right-side" id="uptime24"></span></div>';
$infoBox .= '<div class="info-box"><b>Online Players</b><br><span class="highlight right-side" id="onlinePlayers"></span></div>';
$infoBox .= '<div class="info-box"><b>Match Score</b><br><div class="right-side" id="worldAge"></div></div>';
$infoBox .= '<div class="info-box"><b>Current Map</b><br><span class="highlight right-side" id="dateTime"></span></div>';
$infoBox .= '<div class="info-box"><b>Next Map</b><br><span class="highlight right-side" id="weatherTemperature"></span></div>';
$config['data']['infoBox'] = $infoBox;

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();