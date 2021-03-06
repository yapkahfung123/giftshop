<?php

function flash_template($session, $class, $style = null)
{
    if (!empty($style)) {
        $style = 'style = "' . $style . '"';
    }
    echo '<div class="' . $class . '"' . $style . '>' . $session . '</div>';
}

function dd(...$vars)
{
    Kint::dump(...$vars);
    exit;
}

function save_product_img($img, $latest_id, $type)
{
    require_once APPROOT . '/helpers/pic_resize.php';

    $product_id = ($type == 'add')? ($latest_id + 1) : $latest_id;

    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/products/' . $product_id . '/';
    $file_path_exist = file_exists($file_path);

    // If path not found then create new one for the new product id
    if(!$file_path_exist){
        mkdir($file_path);
    }

    $target_dir = $file_path;

    $error = array();
    $img_upload = array();

    foreach ($img['p_img']['tmp_name'] as $key => $value) {
        $temp_filename = 'IMG-' . substr(time(), '5') . '-' . mt_rand(0, (int)99999);
        $temp_filename .= '.' . pathinfo($img['p_img']['name'][$key], PATHINFO_EXTENSION);

        $target_file = $target_dir . $temp_filename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($img)) {
            $check = getimagesize($img['p_img']['tmp_name'][$key]);
            if ($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                array_push($error, $img['p_img']['name'][$key] . ' is not a image');
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                // Provide a filename
                $resize = new ResizeImage($img['p_img']['tmp_name'][$key]);
                // Resize the image
                $resize->resizeTo(300, 400, 'exact');

                //Save resize img file
                $resize->saveImage($target_file);
                array_push($img_upload, $temp_filename);
            }
//            if (move_uploaded_file($img['p_img']['tmp_name'][$key], $target_file)) {
//                echo "The file ". basename($temp_filename. " has been uploaded.");
//            } else {
//                echo "Sorry, there was an error uploading your file.";
//            }
        }
    }
    return array('error' => $error, 'img_upload' => $img_upload);

}

function save_category_image($img)
{
    require_once APPROOT . '/helpers/pic_resize.php';

    $error = array();

    $img_upload = array();

    $temp_filename = 'IMG-'. mt_rand(0, (int)9999999999);
    $temp_filename .= '.' . pathinfo($img['p_img']["name"],PATHINFO_EXTENSION);

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/category/';
    $target_file = $target_dir . $temp_filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (isset($img['p_img'])) {
        $check = getimagesize($img['p_img']['tmp_name']);
        if ($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            array_push($error, $img['p_img']['name'] . ' is not a image');
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Provide a filename
            $resize = new ResizeImage($img['p_img']['tmp_name']);
            // Resize the image
            $resize->resizeTo(570, 700, 'exact');

            //Save resize img file
            $resize->saveImage($target_file);
            array_push($img_upload, $temp_filename);
        }
    }

    return array('error' => $error, 'img_upload' => $img_upload);

}

function redirect($page){
    header('location: ' . URLROOT . $page);
}

function getState(){
    $api = new MainApi();

    return $api->get_state_list();
}

