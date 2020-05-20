<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
        $this->homeModel = $this->model('HomeModel');
        $this->productModel = $this->model('ProductModel');
        $this->entity_id = $this->getUrl();
    }

    public function index()
    {
        $prod_tag = $this->dbFunc->select("product_tagname, product_id", "product_tag");

        $data = [
            'title' => 'GiftShop | YMC',
            'prod_tag' => $prod_tag
        ];
        d($data);

        $this->view('home/index', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Login | YMC',
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "remember" => $_POST['remember'],
                "error_msg" => ''
            ];


            // If have data at backend
            $user_data = $this->homeModel->retriveUser($data['email']);

            if ($user_data == false) {
                $data['error_msg'] = "Login Failed! Invalid Combination";
                $this->view('home/login', $data);
            }

            if($user_data) {
                if (password_verify($data['password'], $user_data->password)) {
//                    Set Cookie for remember password
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
                } else {
                    $data['error_msg'] = "Login Failed! Invalid Combination";
                    $this->view('home/login', $data);
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

    public function account()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('home/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array();

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
            $data['success'] = '';
            $data['title'] = 'My Account | YMC';

            $result = $this->dbFunc->update(array(
                'firstname' => $data['account_first_name'],
                'lastname' => $data['account_last_name'],
            ), 'user', 'user_id = ' . $_SESSION['user_id']);

            if($result == true){
                $data['data'] = $this->homeModel->getUser();

                $data['success'] = "Information Update Successfully";
                $this->view('home/account/account', $data);
            }
            redirect('home/account');
        }

        $data = [
            'title' => 'My Account | YMC',
            'data' => $this->homeModel->getUser()
        ];

        $this->view('home/account/account', $data);
    }

    public function all_products()
    {
        if(!isset($_GET['page'])){
            $page = 1;
        }else{
            $page = $_GET['page'];
        }

        $category = null;
        if(isset($_GET['category_id'])){
            $category = $_GET['category_id'];
        }

        $limit = 3;
        $start = ($page - 1)*$limit;

        $products = $this->productModel->getProducts($start, $limit, $category);
        $totalProducts = getProductsRowCount($category);
        $total_pages = ceil($totalProducts/$limit);

        $data = [
            'title' => 'Categories | YMC',
            'products' => $products,
            'pagination' => ['page'=>$page, 'totalPages' => $total_pages, 'totalProducts' => $totalProducts],
            'category_id' => $category
        ];
        
        $this->view('home/products', $data);
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
        $product_id = $_GET['product_id'];

        $variation_decode = '';

        $product = $this->productModel->getProductByID($product_id);

        $variation = $this->dbFunc->select('variation_name', 'product_variation', 'product_id', $product_id);

        if($variation != null || !empty($variation)){
            $variation_decode = json_decode($variation[0]->variation_name);
        }


        $data = [
            'title' => 'Product | YMC',
            'product' => $product,
            'variation' => $variation_decode
        ];

        $this->view('home/product', $data);
    }

    public function collections()
    {
        $categories = $this->productModel->getCategory();


        $data = [
            'title' => 'Collection | YMC',
            'categories' => $categories
        ];

        $this->view('home/collections', $data);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Register | YMC',
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "confirm_pw" => $_POST['confirm_password'],
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "error_msg" => ''
            ];

            if ($data['password'] != $data['confirm_pw']) {
                $data['error_msg'] = "Password Combination Invalid";
            }

            $check_email = $this->homeModel->checkUser($data['email']);
            if ($check_email == false) {
                $data['error_msg'] = "Email Taken. Please register with other email";
            }

            if (empty($data['error_msg'])) {
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
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            $_SESSION['successfully'] = "Logout Successfully";
        }
        redirect('home/login');
    }

    public function test()
    {
        $this->view('home/test');
    }
}