<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->homeModel = $this->model('HomeModel');
    }

    public function index()
    {
        $data = [
            'title' => 'GiftShop | YMC',
        ];

        $this->view('home/index', $data);
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title'=>'Login | YMC',
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "remember" => $_POST['remember'],
                "error_msg" => ''
            ];

            // If have data at backend
            $user_data = $this->homeModel->retriveUser($data['email']);

            if($user_data == false){
                $data['error_msg'] = "Login Failed! Invalid Combination";
            }else{
                if (password_verify($data['password'],$user_data->password )){
                    //Set Cookie for remember password
                    if ($data['remember'] == 'on') {
                        setcookie('user_email', $data['email'], time() + (10 * 365 * 24 * 60 * 60));
                        setcookie('user_pword', $data['password'], time() + (10 * 365 * 24 * 60 * 60));
                    } else {
                        if (isset($_COOKIE['user_email'])) {
                            setcookie("user_email", "");
                        }
                        if (isset($_COOKIE['user_pword'])) {
                            setcookie("user_pword", "");
                        }
                    }

                    $_SESSION['login_successfully'] = 'You been login successfully.';
                    setUserSession($user_data->user_id);
                    redirect('home/account');
                }else{
                    $data['error_msg'] = "Login Failed! Invalid Combination";
                }
            }

            $this->view('home/login', $data);
        }


        $data = [
            'title' => 'Login | YMC'
        ];

        $this->view('home/login', $data);
    }

    public function cart()
    {
        $data = [
            'title' => 'Cart | YMC'
        ];

        $this->view('home/cart', $data);
    }

    public function account(){
        if(!isset($_SESSION['user_id'])){
            redirect('home/login');
        }

        $data = [
            'title' => 'My Account | YMC'
        ];

        $this->view('home/account', $data);
    }

    public function categories()
    {
        $data = [
            'title' => 'Categories | YMC'
        ];

        $this->view('home/categories', $data);
    }

    public function checkout()
    {
        $data = [
            'title' => 'Checkout | YMC'
        ];

        $this->view('home/checkout', $data);
    }

    public function product()
    {
        $data = [
            'title' => 'Product | YMC'
        ];

        $this->view('home/product', $data);
    }

    public function collections()
    {
        $data = [
            'title' => 'Collection | YMC'
        ];

        $this->view('home/collections', $data);
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title'=>'Register | YMC',
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "confirm_pw" => $_POST['confirm_password'],
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "error_msg" => ''
            ];

            if($data['password'] != $data['confirm_pw']){
                $data['error_msg'] = "Password Combination Invalid";
            }

            $check_email = $this->homeModel->checkUser($data['email']);
            if($check_email == false){
                $data['error_msg'] = "Email Taken. Please register with other email";
            }

            if(empty($data['error_msg'])){
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                $this->homeModel->insertUser($data);

                $_SESSION['successfully'] = 'Congratulation you are one of our member. Login Now!';
                redirect('home/login');
            }


            $this->view('home/register', $data);

        }

        $data = [
            'title' => 'Register | YMC'
        ];

        $this->view('home/register', $data);
    }

    public function logout()
    {
        if(isset($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
            $_SESSION['successfully'] = "Logout Successfully";
        }
        redirect('home/login');
    }
}