<?php

require_once '../app/bootstrap.php';

if($_SERVER['REQUEST_SCHEME'] != 'https'){
    redirect('');
}

ini_set('display_errors', DEBUG);
ini_set('display_startup_errors', DEBUG);
error_reporting(E_ALL);


//Init Core Library

$init = new Core;
