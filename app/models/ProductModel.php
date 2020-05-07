<?php

class ProductModel
{
    private $db;
    private $prefix;

    public function __construct()
    {
        $this->db = new Database();
        $this->prefix = 'ymc_';
    }

    public function product($product, $type)
    {
        if ($type == 'insert') {
            $this->db->query("INSERT INTO {$this->prefix}product (product_name, product_price, product_description, product_stock, product_category, img_path, priority) VALUES (:p_name, :p_price, :p_desc, :p_stock, :p_cate, :img, :priority)");
        } elseif ($type == 'update') {
            $this->db->query("UPDATE {$this->prefix}product SET product_name = :p_name, product_price = :p_price, product_description = :p_desc,  product_stock = :p_stock, product_category = :p_cate, img_path = :img, priority = :priority WHERE product_id = {$product['id']}");
        }


        $this->db->bind('p_name', $product['p_name']);
        $this->db->bind('p_price', $product['p_price']);
        $this->db->bind('p_desc', $product['p_description']);
        $this->db->bind('p_stock', $product['p_stock']);
        $this->db->bind('p_cate', $product['category']);
        $this->db->bind('img', $product['img_upload']);
        $this->db->bind('priority', $product['priority']);

        $result = $this->db->execute();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

    public function getProduct()
    {
        $this->db->query("SELECT * FROM {$this->prefix}product WHERE status = 1 ORDER BY created_at DESC");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getProductByID($id)
    {
        $this->db->query("SELECT * FROM {$this->prefix}product WHERE product_id = :id");

        $this->db->bind('id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function deleteProductByID($id)
    {
        $this->db->query("UPDATE {$this->prefix}product SET status = 0 WHERE product_id = {$id}");

        return $this->db->execute();
    }

    public function category($category, $type)
    {
        if ($type == 'insert') {
            $this->db->query("INSERT INTO {$this->prefix}category (cat_name, cat_desc, priority) VALUES (:cat_name, :cat_desc, :priority)");
        } elseif ($type == 'update') {
            $this->db->query("UPDATE {$this->prefix}category SET cat_name = :cat_name, cat_desc = :cat_desc, priority = :priority WHERE cat_id = {$category['id']}");
        }


        $this->db->bind('cat_name', $category['c_name']);
        $this->db->bind('cat_desc', $category['c_description']);
        $this->db->bind('priority', $category['priority']);

        $result = $this->db->execute();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCategory()
    {
        $this->db->query("SELECT * FROM {$this->prefix}category WHERE status = 1 ORDER BY created_at DESC");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getCategoryByID($id)
    {
        $this->db->query("SELECT * FROM {$this->prefix}category WHERE cat_id = :id");

        $this->db->bind('id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function deleteCategoryByID($id)
    {
        $this->db->query("UPDATE {$this->prefix}category SET status = 0 WHERE cat_id = {$id}");

        return $this->db->execute();
    }

    public function check_variation($id)
    {
        $this->db->query("SELECT * FROM {$this->prefix}product_variation WHERE product_id = {$id}");

        $result = $this->db->single();

        return $result;
    }

    public function variation($variation, $type)
    {
        if($type == 'insert'){
            $this->db->query("INSERT INTO {$this->prefix}product_variation (product_id, variation_name) VALUES (:id, :var_name)");
        }elseif($type == 'update'){
            $this->db->query("UPDATE {$this->prefix}product_variation SET variation_name = :var_name WHERE product_id = :id");
        }

        $this->db->bind('id', $variation['0']);
        $this->db->bind('var_name', $variation['1']);

        $result = $this->db->execute();

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function updateImg($data, $product_id){
        $this->db->query("UPDATE {$this->prefix}product SET img_path = :img WHERE product_id = :id");

        $this->db->bind('img', $data);
        $this->db->bind('id', $product_id);

        return $this->db->execute();
    }

}