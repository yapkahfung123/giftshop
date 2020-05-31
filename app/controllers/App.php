<?php

class App extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
        $this->productModel = $this->model('ProductModel');
        $this->entity_id = $this->getUrl();
    }

    public function add_variation()
    {
        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->entity_id = $_POST['product_id'];

            if (!empty($_POST['variation']) && !empty($_POST['variation_attr'])) {
                $data = [
                    'variation' => $_POST['variation'],
                    'attr' => $_POST['variation_attr'],
                    'id' => $_POST['product_id']
                ];


                foreach ($data['variation'] as $k => $v) {
                    $var_array[] = array($v => $data['attr'][$k]);
                }
                $decode = json_encode($var_array);
            } else {
                $decode = '[]';
            }

            $variation = array($this->entity_id, $decode);

            $check = $this->productModel->check_variation($this->entity_id);

            if (empty($check) || $check == false) {
                $type = "insert";
            } else {
                $type = "update";
            }

            $this->productModel->variation($variation, $type);

            $_SESSION['success_msg'] = 'Variation Saved Successfully';
            redirect('admin/edit_product/' . $this->entity_id);
        }
        redirect('admin/edit_product/' . $this->entity_id);
    }

    public function delete_img()
    {
//        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $product = $this->productModel->getProductByID($_POST['p_id']);

            $product_img = $product->img_path;

            $product_img = json_decode($product_img);

            //search index
            $product_index = array_search($_POST['img'], $product_img);

            unset($product_img[$product_index]);

            $product_img = array_values($product_img);

            $result = json_encode($product_img);

            //Update the file path
            $this->productModel->updateImg($result, $_POST['p_id']);

            //Delete pic from server
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/products/' . $_POST['product_id'] . '/' . $_POST['img'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/products/' . $_POST['product_id'] . '/' . $_POST['img']);
                $data['response'] = 'yes';
            } else {
                $data['response'] = 'file doesnt exist';
            }

            echo json_encode($data);
        }
    }

    public function delete_category_img()
    {
//        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $product = $this->productModel->getCategoryByID($_POST['p_id']);

            $product_img = $product->img_path;

            //Update the file path
            $this->dbFunc->update(array(
                'img_path' => null
            ), 'category', 'cat_id = ' . $_POST['p_id']);

//            Delete pic from server
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/category/' . $_POST['img'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/category/' . $_POST['img']);
                $data['response'] = 'yes';
            } else {
                $data['response'] = 'file doesnt exist';
            }

            echo json_encode($data);
        }
    }

    public function add_to_cart()
    {
        $response = array();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Check Post Data Is Null;
            foreach ($_POST['attribute'] as $k => $v) {
                if (empty($v) || $v == null) {
                    $response['error_code'] = 2;

                    echo json_encode($response);

                    exit();
                }
            }


            foreach ($_POST['variation'] as $k => $v) {
                $var_array[] = array(trim($v) => $_POST['attribute'][$k]);
            }


            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error_msg'] = 'Please Login First Before Add To Your Cart';
                $_SESSION['product_page'] = $_POST['product_id'];
                $response['error_code'] = 1;

                echo json_encode($response);
                exit();
            }

            $data = [
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'user_id' => $_SESSION['user_id'],
                'variation' => json_encode($var_array)
            ];


            $result = $this->dbFunc->insert(array(
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'variation' => $data['variation'],
                'status' => 1
            ), 'cart');


            if ($result == 1) {
                $response['error_code'] = 0;
                echo json_encode($response);
                exit();
            }
        } else {
            redirect('');
        }
    }
}