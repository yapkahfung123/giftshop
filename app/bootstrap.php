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


//Autoload core Libraries
spl_autoload_register('myAutoLoad');

function myAutoLoad($className){
    if (file_exists(APPROOT . '/libraries/' . $className . '.php')) {
        require_once 'libraries/' . $className . '.php';
    }
    else if(file_exists(APPROOT . '/classes/' . $className . '.class.php')){
        require_once 'classes/' . $className . '.class.php';
    }
}
