<?php


//Flash message helper
//EXAMPLE - flash('register_success', 'You are now registered');
//DISPLAY IN VIEW -  echo flash('register_success' );
function flash($name = '', $message = '', $class = 'alert alert-success fade in alert-dismissible'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION['name'])){

            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name . '_class'])){
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        }elseif(empty($message) && !empty($_SESSION['name'])){
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}

function setUserSession($data){
    $_SESSION['user_id'] = $data['user_id'];
}

function check_adminSession(){
    if(!isset($_SESSION['admin_id']) && !isset($_SESSION['user_name']) && !isset($_SESSION['name']) && $_SESSION['user_name'] != 'admin'){
        redirect('admin/login');
    }
}

function create_admin_session($user){
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['user_name'] = $user['username'];
    $_SESSION['name'] = $user['name'];
}