<?php
require_once('processors/templateparser.php');

$config['templateFile'] = 'templates/game.htm';

$config['data'] = [
    'title' => 'Counter-Strike',
    'description' => 'This is a Counter-Strike server with performance and stability enhancements.',
    'image' => '/media/bannercounterstrike.jpg',
    'url' => '/counterstrike',
    'onloadJs' => '/js/onloadcounterstrike.js'
];

$infoBox = '';
$infoBox .= '<div class="info-box"><b>Status</b><br><span class="highlight right-side" id="statusText"></span></div>';
$infoBox .= '<div class="info-box"><b>Uptime (24H)</b><br><span class="highlight right-side" id="uptime24"></span></div>';
$infoBox .= '<div class="info-box"><b>Online Players</b><br><span class="highlight right-side" id="onlinePlayers"></span></div>';
$infoBox .= '<div class="info-box"><b>Match Score</b><br><div class="right-side" id="matchScore"></div></div>';
$infoBox .= '<div class="info-box"><b>Current Map</b><br><span class="highlight right-side" id="currentMap"></span></div>';
$infoBox .= '<div class="info-box"><b>Next Map</b><br><span class="highlight right-side" id="nextMap"></span></div>';
$config['data']['infoBox'] = $infoBox;

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();