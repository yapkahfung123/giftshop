<?php

class Cron extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
        $this->adminModel = $this->model('AdminModel');
        $this->productModel = $this->model('ProductModel');
    }

    public static function removeImg($img = array(), $dir){
        if(is_array($img)){
            foreach ($img as $k => $v){
                unlink($dir . $v);
            }
        }
    }

    public function delete_img()
    {

        // Delete Product Img
        $get_product_Img = $this->productModel->getProductImg();

        foreach ($get_product_Img as $k => $v) {
            $db_imgPath = json_decode($v->img_path);

            $dir = $_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/products/' . $v->product_id . '/';

            if(file_exists($dir)){
                $dir_imgFile = array_diff(scandir($dir), array('..', '.'));
                $unwanted_file = array_diff($dir_imgFile, $db_imgPath);

                self::removeImg($unwanted_file, $dir);
            }
        }

        // Delete Category Image
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/public/img/uploads/category/';
        $dir_imgFile = array_diff(scandir($dir), array('..', '.'));

        foreach ($dir_imgFile as $k => $v) {
            $get_Category_Img = $this->dbFunc->select('img_path', 'category', 'img_path', $v);
            if(empty($get_Category_Img)){
                self::removeImg(array($v), $dir);
            }
        }

        echo "Done";
    }
}