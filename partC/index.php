<?php

// put full path to Smarty.class.php
require('Smarty-3.1.11/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');

$smarty->assign('name', 'Andrew');
$smarty->display('index.tpl');

?>