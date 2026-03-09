<?php
require_once('processors/templateparser.php');

$config['templateFile'] = 'templates/game.htm';

$config['data'] = [
    'title' => 'V Rising',
    'description' => 'This is a V Rising server with quality of life adjustments and game mechanic overhaul mods.',
    'image' => '/media/bannervrising.jpg',
    'url' => '/vrising',
    'onloadJs' => '/js/onloadvrising.js'
];

$infoBox = '';
$infoBox .= '<div class="info-box"><b>Status</b><br><span class="highlight right-side" id="statusText"></span></div>';
$infoBox .= '<div class="info-box"><b>Uptime (24H)</b><br><span class="highlight right-side" id="uptime24"></span></div>';
$infoBox .= '<div class="info-box"><b>Online Players</b><br><span class="highlight right-side" id="onlinePlayers"></span></div>';
$config['data']['infoBox'] = $infoBox;

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();