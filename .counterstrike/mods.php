<?php
require_once('../php/templateparser.php');

$modList = file_get_contents('modlist.htm');

$config['templateFile'] = '../templates/mods.htm';
$config['data'] = [
    'title' => 'Counter-Strike Mods',
    'description' => 'Mod collection for the MBG Counter-Strike dedicated server.',
    'modList' => $modList,
];

$templateParser = new TemplateParser($config);
echo $templateParser->parseTemplate();