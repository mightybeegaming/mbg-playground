<?php
require_once('processors/templateparser.php');

$config['templateFile'] = 'templates/game.htm';

$config['data'] = [
    'title' => 'Hytale',
    'description' => 'This is a modded Hytale server to test and explore the early access build.',
    'image' => '/media/bannerhytale.jpg',
    'url' => '/hytale',
    'onloadJs' => '/js/onloadhytale.js'
];

$infoBox = '';
$infoBox .= '<div class="info-box"><b>Status</b><br><span class="highlight right-side" id="statusText"></span></div>';
$infoBox .= '<div class="info-box"><b>Uptime (24H)</b><br><span class="highlight right-side" id="uptime24"></span></div>';
$infoBox .= '<div class="info-box"><b>Online Players</b><br><span class="highlight right-side" id="onlinePlayers"></span></div>';
$config['data']['infoBox'] = $infoBox;

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();