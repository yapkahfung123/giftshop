<?php
//
session_start();
// Load config
require_once 'config/config.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/function_custom.php';
require_once 'helpers/db_helpers.php';
require_once 'modules/kint.phar';
require_once '../vendor/autoload.php';
require_once '../public/modules/xcrud/xcrud.php';

Xcrud_config::$theme = 'bootstrap';

//Autoload core Libraries
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});
