<?php
require_once('php/templateparser.php');

$config['templateFile'] = 'templates/error.htm';
$config['data'] = [
    'title' => '500 - Server Error',
    'description' => 'The server encountered an unexpected condition.'
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();