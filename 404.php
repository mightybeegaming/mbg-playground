<?php
require_once('php/templateparser.php');

$config['templateFile'] = 'templates/error.htm';
$config['data'] = [
    'title' => '404 - Page Not Found',
    'description' => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.'
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();