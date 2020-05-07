<?php
/*
 *Base Controller
 *Loads the models and views
 */

class Controller{

    // Load model
    public function model($model){
        // Require model file
        require_once '../app/models/' . $model . '.php';
        
        //Instatiate model
        
        return new $model();          
    }
    
    // Load view
    public function view($view, $data = []){
        // Check for view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            // View does not exist
            require_once '../app/views/pages/404.php';
        }
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);

            if(isset($url[2])){
                $url = $url[2];
            }else{
                $url = '';
            }
            return $url;
        }
    }
}




?>