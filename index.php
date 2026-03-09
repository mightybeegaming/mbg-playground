<?php
require_once('php/pageconfig.php');
require_once('php/templateparser.php');

$pageConfig = new PageConfig();
$pageConfigData = $pageConfig->data;

$templateParser = new TemplateParser($pageConfigData);
echo $templateParser->parseTemplate();