<?php 

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

include_once ('../../include/config.inc.php');
include_once ('../../include/shared_function.inc.php');


spl_autoload_register('my_autoloader');

function my_autoloader($className) {
	
    if (file_exists('../../classes/'. $className . '.class.php')) {
        require_once('../../classes/'. $className . '.class.php');
    }else {
        echo 'Class doesn\'t exist : '.$className;
    }
}//add more else if(file_exist)(__classes_folder__) if needed

include_once ('../../include/mysql.inc.php');

include ('xcrud.php');
header('Content-Type: text/html; charset=' . Xcrud_config::$mbencoding);
echo Xcrud::get_requested_instance();
