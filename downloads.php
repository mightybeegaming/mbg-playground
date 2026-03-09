<?php
require_once('php/templateparser.php');
require_once('php/downloadsgenerator.php');

$downloadsGenerator = new DownloadsGenerator();
$downloadList = $downloadsGenerator->getDownloadList();

$config['templateFile'] = 'templates/downloads.htm';
$config['data'] = [
    'title' => 'Downloads',
    'description' => 'This is the official consolidated downloads page for MBG Playground.',
    'image' => '/media/logombg.jpg',
    'onloadJs' => '/js/onloaddownloads.js',
    'downloadList' => $downloadList
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();