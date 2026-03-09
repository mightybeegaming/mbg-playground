<?php
require_once('processors/templateparser.php');

$infoBox = '';
$infoBox .= '<div class="info-box"><b>World Age</b><br><div class="right-side" id="worldAge"></div></div>';
$infoBox .= '<div class="info-box"><b>Date Time</b><br><div class="right-side" id="dateTime"></div></div>';
$infoBox .= '<div class="info-box"><b>Weather</b><br><div class="right-side" id="weatherTemperature"></div></div>';

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