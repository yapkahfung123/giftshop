<?php
//
session_start();
// Load config
require_once 'config/config.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/url_helper.php';
require_once 'helpers/function_custom.php';
require_once 'modules/kint.phar';
//require_once 'modules/xcrud/xcrud.php';



//Autoload core Libraries
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});