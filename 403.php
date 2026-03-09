<?php
require_once('php/templateparser.php');

$config['templateFile'] = 'templates/error.htm';
$config['data'] = [
    'title' => '403 - Forbidden',
    'description' => 'You don’t have permission to access this page.'
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();