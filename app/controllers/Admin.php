<?php


class Admin extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
        $this->adminModel = $this->model('AdminModel');
        $this->productModel = $this->model('ProductModel');
        $this->entity_id = $this->getUrl();
    }

    public function index()
    {
        check_adminSession();

        $data = [
            'name' => '',
            'title' => 'YMC | Admin'
        ];

        $data['name'] = ucfirst($this->adminModel->get_name($_SESSION['admin_id'])->firstname);

        return $this->view('admin/index', $data);
    }

    public function login()
    {

        $data = [
            'title' => 'Admins Login'
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Admins Login',
                'uname' => $_POST['uname'],
                'pword' => $_POST['pword'],
                'remember' => $_POST['remember'],
                'error_msg' => ''
            ];


            $verify = $this->adminModel->admin_login();

            $pw_verify = password_verify($data['pword'], $verify[0]->password);

            if ($pw_verify == true || $pw_verify == 1) {
                if ($data['remember'] = 'on' && $data['remember'] != null) {
                    setcookie('admin_uname', $data['uname'], time() + (10 * 365 * 24 * 60 * 60));
                    setcookie('admin_pword', $data['pword'], time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if (isset($_COOKIE['admin_uname'])) {
                        setcookie("admin_uname", "");
                    }
                    if (isset($_COOKIE['admin_pword'])) {
                        setcookie("admin_pword", "");
                    }
                }

                $user = [
                    'id' => $verify[0]->user_id,
                    'username' => $verify[0]->email,
                    'name' => $verify[0]->firstname
                ];
                create_admin_session($user);
                $_SESSION['login'] = "Login Successfully";

                redirect('admin');


            } else {
                $data['error_msg'] = 'Incorrect Credential';
                $this->view('admin/login', $data);
            }
        }
        $this->view('admin/login', $data);
    }

    public function form()
    {
        $form_data = $this->adminModel->get_form_table();

        $data = [
            'title' => 'Form',
            'form' => $form_data
        ];

        return $this->view('admin/form', $data);


    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['name']);


        redirect('admin/login');

    }

    public function change_password()
    {
        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Admin | YMC',
                'reset_pw' => $_POST['pword'],
                'success_msg' => ''
            ];

            $update_pw = password_hash($data['reset_pw'], PASSWORD_BCRYPT);

            $result = $this->adminModel->change_pw($_SESSION['user_id'], $update_pw);

            $data['success_msg'] = 'Password Changed Successfuully';
            $this->view('admin/change-password', $data);
        }

        $data = [
            'title' => 'Admin'
        ];
        return $this->view('admin/change-password', $data);
    }

    public function deleteform()
    {
        check_adminSession();

        $formid = $_POST['formid'];

        $deleteForm = $this->adminModel->delete_form($formid);

        if ($deleteForm > 0) {
            echo "Success";
        }
    }

    public function product()
    {
        check_adminSession();

        $data = [
            'title' => 'Product | YMC'
        ];
        $data['product'] = $this->productModel->getProduct();

        $this->view('admin/product/product', $data);
    }

    public function add_product()
    {
        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array();

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
            if(isset($_FILES)){
                $save_img = save_product_img($_FILES);
            }

            $data['img_upload'] = json_encode($save_img['img_upload']);

            $product_add = $this->productModel->product($data, 'insert');
            if ($product_add == true) {

                $p_name = $data['p_name'];
                $_SESSION['success_msg'] = "Product <strong>" . $p_name . "</strong> added successfully";
                redirect('admin/product');
            } else {
                redirect('admin/add_product');
            }
        }

        $data = [
            'title' => 'Product | YMC',
        ];
        $data['category'] = $this->productModel->getCategory();

        $this->view('admin/product/add', $data);
    }

    public function edit_product()
    {
        check_adminSession();

        $entity_id = $this->entity_id;

        $product = $this->productModel->getProductByID($entity_id);
        $variation = $this->productModel->check_variation($entity_id);

        if(!empty($variation)){
            if($variation->variation_name != '[]'){
                $variation_decode = json_decode($variation->variation_name);

                // Switch objects to array
                foreach ($variation_decode as $k => $v){
                    $array[] = get_object_vars($v);
                }

                // Merge seperate array in one array
                $variation = call_user_func_array('array_merge', $array);
            }
        }

        $category =$this->productModel->getCategory();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array();

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }


            //If user didnt upload anything, then take data from db
            if($_FILES['p_img']['name'][0] != ''){
                $save_img = save_product_img($_FILES);
            }else{
                $save_img = array('img_upload' => json_decode($product->img_path));
            }


            $data['img_upload'] = json_encode($save_img['img_upload']);

            $data['id'] = $this->entity_id;

            $product_add = $this->productModel->product($data, 'update');
            if ($product_add == true) {
                $p_name = $data['p_name'];
                $_SESSION['success_msg'] = "Product <strong>" . $p_name . "</strong> edit successfully";
                redirect('admin/product');
                exit();
            } else {
                redirect('admin/edit_product/' . $data['id']);
            }
        }

        $data = [
            'title' => 'Product | YMC',
            'id' => $entity_id,
        ];
        $data['product'] = $product;
        $data['category'] = $category;
        $data['variation'] = $variation;

        $this->view('admin/product/edit', $data);
    }

    public function delete_product(){

        $productID = $_POST['product_id'];

        $deleteForm = $this->productModel->deleteProductByID($productID);

        if ($deleteForm) {
            $data['status'] = 'true';
        }else{
            $data['status'] = 'false';
        }

        echo json_encode($data);
    }

    public function category()
    {
        check_adminSession();
        $data = [
            'title' => 'Category | YMC'
        ];
        $data['category'] = $this->productModel->getCategory();

        $this->view('admin/category/category', $data);
    }

    public function add_category()
    {
        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array();

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }

            if(isset($_FILES)){
                $save_img = save_category_image($_FILES);
            }
            $data['img_upload'] = $save_img['img_upload'][0];


            $category_add = $this->productModel->category($data, 'insert');
            if ($category_add == true) {

                $c_name = $data['c_name'];
                $_SESSION['success_msg'] = "Category <strong>" . $c_name . "</strong> added successfully";
                redirect('admin/category');
            } else {
                redirect('admin/add_category');
            }
        }

        $data = [
            'title' => 'Product | YMC',
        ];

        $this->view('admin/category/add', $data);
    }

    public function edit_category()
    {
        check_adminSession();

        $entity_id = $this->entity_id;

        $category = $this->productModel->getCategoryByID($entity_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array();

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
            $save_img['img_upload'][0] = $category->img_path;

            //If user didnt upload anything, then take data from db

            if($_FILES['p_img']['name'] != ''){
                $save_img = save_category_image($_FILES);
            }else{
                $save_img['img_upload'][0] = $category->img_path;
            }

            $data['img_upload'] = $save_img['img_upload'][0];



            $data['id'] = $this->entity_id;

            $product_add = $this->productModel->category($data, 'update');

            if ($product_add != false) {

                $c_name = $data['c_name'];
                $_SESSION['success_msg'] = "Category <strong>" . $c_name . "</strong> Update successfully";
                redirect('admin/category');
            } else {
                redirect('admin/edit_category/' . $data['id']);
            }
        }

        $data = [
            'title' => 'Category | YMC',
        ];
        $data['category'] = $category;
        $data['id'] = $this->entity_id;

        $this->view('admin/category/edit', $data);
    }

    public function delete_category(){

        $categoryID = $_POST['category_id'];

        $deleteForm = $this->productModel->deleteCategoryByID($categoryID);

        if ($deleteForm) {
            $data['status'] = 'true';
        }else{
            $data['status'] = 'false';
        }

        echo json_encode($data);
    }

    public function user_list(){
        $user_list = $this->adminModel->user_lists();

        $data = [
            'title' => 'User List | YMC',
            'user_list' => $user_list
        ];
        
        $this->view('admin/user-list', $data);
    }

    public function options(){
        $data = [
            'title' => 'Options | YMC',
        ];

        $this->view('admin/options', $data);
    }
}