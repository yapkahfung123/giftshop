<?php

class Api extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
        $this->productModel = $this->model('ProductModel');
        $this->homeModel = $this->model('HomeModel');
        $this->entity_id = $this->getUrl();
    }

    public function state()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['postcode'])) {
                $api = new MainApi();
                $data = $api->get_state($_POST['postcode']);
                echo $data;
            }
        }
    }

    public function get_state_with_token()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $postcode = $_POST['postcode'];

            $token = API_TOKEN;
            $response = array();
            $headers = apache_request_headers();

            if (empty($headers['Api-Key'])) {
                $response['error'] = 'API KEY NOT FOUND';
                goto gotoError;
            }

            if ($headers['Api-Key'] != $token) {
                $response['error'] = 'API KEY WRONG';
                goto gotoError;
            }

            if (!Postcode::validate($postcode)) {
                $response['error'] = 'Invalid Postcode Entered';
                goto gotoError;
            }

            $response['state_name'] = Postcode::checkState($postcode);
            $response['region'] = Postcode::checkRegion($postcode);

            gotoError:
            echo json_encode($response);
        } else {
            $response['error'] = 'Error';

            echo json_encode($response);
        }
    }


    public function get_state()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $postcode = $_POST['postcode'];

            if (!Postcode::validate($postcode)) {
                $response['error'] = 'Invalid Postcode Entered';
                goto gotoError;
            }

            $response['state_name'] = Postcode::checkState($postcode);
            $response['region'] = Postcode::checkRegion($postcode);

            gotoError:
            echo json_encode($response);
        } else {
            $response['error'] = 'Error';

            echo json_encode($response);
        }
    }

    public function get_state_list_with_token()
    {

        $token = API_TOKEN;
        $response = array();
        $headers = apache_request_headers();

        if (empty($headers['Api-Key'])) {
            $response['error'] = 'API KEY NOT FOUND';
            goto gotoError;
        }

        if ($headers['Api-Key'] != $token) {
            $response['error'] = 'API KEY WRONG';
            goto gotoError;
        }

        $Postcode = Postcode::$data;
        foreach ($Postcode as $v) {
            $state[] = array_keys($v);
        }

        $response = array_merge($state[0], $state[1]);

        gotoError:
        echo json_encode($response);
    }

    public function get_state_list()
    {
        $Postcode = Postcode::$data;
        foreach ($Postcode as $v) {
            $state[] = array_keys($v);
        }

        $response = array_merge($state[0], $state[1]);

        gotoError:
        echo json_encode($response);
    }

    public function get_shipping_fee()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize String
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $state = $_POST['state'];
//        $state = 'Kuala Lumpur';

            $decode = $id = null;

            $all_state_from_db = $this->dbFunc->select('*', 'shipping_name');

            foreach ($all_state_from_db as $key => $value) {
                $decode = json_decode($value->shipping_name);
                if (in_array($state, $decode)) {
                    $id = $value->shipping_group_id;
                }
            }

            if ($id == null) {
                $response['error_code'] = 1;

                echo json_encode($response);
                exit();
            }

            $shipping_price = $this->dbFunc->select('shipping_price', 'shipping_group', 'id', $id)[0]->shipping_price;

            if ($shipping_price != null) {
                $response['error_code'] = 0;
                $response['shipping_price'] = $shipping_price;

                echo json_encode($response);
                exit();
            }
        }
    }
}