<?php
require_once 'php/_allowonlymethods.php';
require_once 'php/page.php';
require_once 'php/template.php';

$page = new Page();
$pageConfig = $page->getConfig();

$template = new Template($pageConfig);
$template->render();