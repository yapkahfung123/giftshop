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

function save_product_img($img)
{
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/products/';
    $error = array();

    $img_upload = array();

    foreach ($img['p_img']['tmp_name'] as $key => $value) {
        $temp_filename = 'IMG-' . mt_rand(0, (int)9999999999);
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
                move_uploaded_file($img['p_img']['tmp_name'][$key], $target_file);
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
            move_uploaded_file($img['p_img']['tmp_name'], $target_file);
            array_push($img_upload, $temp_filename);
        }
    }

    return array('error' => $error, 'img_upload' => $img_upload);

}