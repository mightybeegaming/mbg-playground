<?php
require_once('../processors/templateparser.php');

$modList = file_get_contents('modlist.htm');

$config['templateFile'] = '../templates/mods.htm';
$config['data'] = [
    'title' => 'V Rising Mods',
    'description' => 'Mod collection for the MBG V Rising dedicated server.',
    'modList' => $modList,
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();