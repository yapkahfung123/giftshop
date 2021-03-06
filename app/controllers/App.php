<?php

class App extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
        $this->productModel = $this->model('ProductModel');
        $this->homeModel = $this->model('HomeModel');
        $this->adminModel = $this->model('AdminModel');
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

            // Get Product Price
            $product_price = $this->dbFunc->select("product_price, promo_price", "product", "product_id", $_POST['product_id']);

            if (empty($product_price[0]->promo_price)) {
                $product_price = $product_price[0]->product_price;
            } else {
                $product_price = $product_price[0]->promo_price;
            }

            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error_msg'] = 'Please Login First Before Add To Your Cart';
                $_SESSION['product_page'] = $_POST['product_id'];
                $response['error_code'] = 1;

                echo json_encode($response);
                exit();
            }

            $check_variation = $this->dbFunc->select('*', 'product_variation', 'product_id', $_POST['product_id']);

            if (!empty($check_variation)) {
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
            }

            if ($_POST['quantity'] < 1) {
                $response['error_code'] = 3;

                echo json_encode($response);

                exit();
            }

            $data = [
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'user_id' => $_SESSION['user_id'],
                'variation' => !empty($check_variation) ? json_encode($var_array) : null,
                'product_price' => $product_price
            ];


            $result = $this->dbFunc->insert(array(
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['product_price'],
                'variation' => $data['variation'],
                'status' => 1
            ), 'cart');

            $latest_cart_id = getLatestPK('cart');
            if ($result == 1) {
                $response['error_code'] = 0;
                $response['id'] = $latest_cart_id;
                echo json_encode($response);
                exit();
            }
        } else {
            redirect('');
        }
    }

    public function update_cart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($_POST['submit'] == 'Update Cart') {
                $data = [
                    'cart_id' => $_POST['cart_id'],
                    'qty' => $_POST['qty'],
                    'user_id' => $_SESSION['user_id']
                ];

                $error_cartID = array();

                for ($i = 0; count($data['cart_id']) > $i; $i++) {
                    // Check this cart user id is match with our current user
                    $check = checkUserIdAndSessionId($data['cart_id'][$i], $data['user_id']);

                    if ($check == true) {
                        $this->dbFunc->update(array(
                            'quantity' => $data['qty'][$i]
                        ), 'cart', 'cart_id=' . $data['cart_id'][$i]);
                    } else {
                        array_push($error_cartID, $data['cart_id'][$i]);
                    }
                }

                if (empty($error_cartID)) {
                    $_SESSION['successfully'] = "Quantity Update Successfully";
                    redirect('home/cart');
                } else {
                    $_SESSION['error_msg'] = "Some Product Failed To Update";
                    redirect('home/cart');
                }
            }

            if ($_POST['submit'] == 'Delete Cart') {
                $cartID = $_POST['id'];
                $currectUserId = $_SESSION['user_id'];
                $check = checkUserIdAndSessionId($cartID, $currectUserId);

                if ($check == true) {
                    $this->dbFunc->delete($cartID, 'cart');
                    $_SESSION['successfully'] = "Cart Delete Successfully";
                } else {
                    $_SESSION['error_msg'] = "Failed To Delete Cart";
                }
            }

            if ($_POST['submit'] == 'Navbar Cart Info') {
                $cart_id = $_POST['cart_id'];
                $user_id = $_SESSION['user_id'];

                $count_cart = countCart($user_id);

                $user_cart = $this->dbFunc->select('quantity, price', 'cart', 'user_id', $user_id);

                $cart_details = $this->homeModel->getCartByID($cart_id);

                $img = json_decode($cart_details->img_path);

                $total_price = 0;

                if (!empty($img)) {
                    $img = '<img style="width: 80px" src="' . URLROOT . 'public/img/uploads/products/' . $cart_details->product_id . '/' . $img[0] . '" alt=""/>';
                } else {
                    $img = '<img style="width: 80px" src="' . URLROOT . 'public/img/no-img.jpg" alt=""/>';
                }

                foreach ($user_cart as $value) {
                    $price = $value->price * $value->quantity;
                    $total_price += $price;
                }


                $html = '
                        <div class="nav-cart-item clearfix">
                            <div class="nav-cart-img">
                                <a href="javascript::void(0)">
                                    ' . $img . '
                                </a>
                            </div>
                            <div class="nav-cart-title">
                                <a href="javascript::void(0)">
                                    ' . ucfirst($cart_details->product_name) . '
                                </a>
                                <div class="nav-cart-price">
                                    <span>' . $cart_details->quantity . ' x</span>
                                    <span>RM ' . $cart_details->price . '</span>
                                </div>
                            </div>
                            <div class="nav-cart-remove">
                                <a href="javascript:void(0)" onclick="delete_cart(' . $cart_details->cart_id . ')"><i class="icon icon_close"></i></a>
                            </div>
                        </div>';


                $response['cart_product'] = $html;
                $response['total_cart_item'] = $count_cart;
                $response['total_price'] = $total_price;

                echo json_encode($response);

            }

            if (empty($_POST['submit'])) {
                redirect('');
            }
        }
    }

    public function shipping_name()
    {
        check_adminSession();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'state' => json_encode($_POST['state']),
                'group_id' => $_POST['group_id'],
            ];

            // Check have record or not
            $check_shipping_state_record = $this->dbFunc->select('*', 'shipping_name', 'shipping_group_id', $data['group_id']);

            if ($check_shipping_state_record != null) {
                $type = 'update';
            }else{
                $type = 'insert';
            }

            $result = $this->adminModel->add_state_name(array('id' => $data['group_id'], 'name' => $data['state']), $type);

            if ($result == true) {
                $_SESSION['success_msg'] = 'State added';
            } else {
                $_SESSION['error_msg'] = 'Failed to add';
            }

            redirect('admin/edit_shipping/' . $data['group_id']);

        } else {
            redirect('admin/shipping');
        }
    }
}

?>

