<?php
require_once APPROOT . '/libraries/Database.php';
$db = new Database();

function get_category(){
    global $db;
    $db->query("SELECT * FROM {$db->prefix}category WHERE status = 1 ORDER BY priority DESC");

    $result = $db->resultSet();

    return $result;
}

function get_category_name($id){
    global $db;
    $db->query("SELECT cat_name FROM {$db->prefix}category WHERE status = 1 AND cat_id = :id");

    $db->bind('id', $id);

    $result = $db->single();

    return $result->cat_name;
}

function getProductsRowCount($category = null){
    global $db;

    if(isset($category) && !empty($category)){
        $category = ' AND product_category = ' . $category;
    }

    $db->query("SELECT * FROM {$db->prefix}product WHERE status = 1{$category}");

    $db->resultSet();
    return $db->rowCount();

}

function paginationProductUrl($category_id = null, $page, $prevOrNext = null){

    switch ($prevOrNext) {
        Case 'prev':
            if ($category_id != null) {
                $url = '?category_id=' . $category_id . '&page=' . ($page - 1);
            } else {
                $url = '?page=' . ($page - 1);
            }
            break;

        Case 'next':
            if ($category_id != null) {
                $url = '?category_id=' . $category_id . '&page=' . ($page + 1);
            } else {
                $url = '?page=' . ($page + 1);
            }
            break;

        default:
            if ($category_id != null) {
                $url = '?category_id=' . $_GET['category_id'] . '&page=' . $page;
            } else {
                $url = '?page=' . $page;
            }
            break;
    }

    return $url;
}

function getProductById($id){
    global $db;
    $db->query("SELECT * FROM {$db->prefix}product WHERE product_id = :id");

    $db->bind('id', $id);

    $result = $db->single();

    return $result;
}

function getPrimaryKeyColumn($table)
{
    global $db;
    $db->query("SHOW KEYS FROM {$db->prefix}{$table} WHERE Key_name = 'PRIMARY'");
    $result = $db->single();

    return $result->Column_name;
}

function getLatestPrimaryKey($table){
    global $db;

    $primary_column = getPrimaryKeyColumn($table);

    $db->query("SELECT {$primary_column} FROM {$db->prefix}{$table} ORDER BY {$primary_column} DESC LIMIT 1");

    return $db->single()->product_id;
}