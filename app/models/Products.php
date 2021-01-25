<?php
require 'DB.php';

class Products
{
    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstence();
    }

    public function getProducts(){
        $result = $this->_db->query('SELECT * FROM `products` ORDER BY `id` DESC');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsLimited($order, $limit){
        $result = $this->_db->query("SELECT * FROM `products` ORDER BY $order DESC LIMIT $limit");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsCategory($category){
        $result = $this->_db->query("SELECT * FROM `products` WHERE `category` = '$category' ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsSubCat($sub_cat){
        $result = $this->_db->query("SELECT * FROM `products` WHERE `sub_cat` = '$sub_cat' ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsTargetCat($second_par){
        $result = $this->_db->query("SELECT * FROM `products` WHERE `target_cat` = '$second_par' ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneProduct($id)
    {
        $result = $this->_db->query("SELECT * FROM `products` WHERE `id` = '$id'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsLimitOffset($offset){
        $limit = 2;
        if($offset){
            $offset = $limit * ($offset - 1);
        }else{
            $offset = 0;
        }
        $result = $this->_db->query("SELECT * FROM `products` LIMIT $limit OFFSET $offset");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductsCart($items)
    {
        $result = $this->_db->query("SELECT * FROM `products` WHERE `id` IN ($items)");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createArt()
    {
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
        $permitted_num = '0123456789';
        $chars = substr(str_shuffle($permitted_chars), 0, 3);
        $num = substr(str_shuffle($permitted_num), 0, 2);
        $result = $chars.$num;
        return $result;
    }


    public function addProduct($title, $art, $material, $made_in, $temp, $more_param,
         $color, $img, $price, $category, $sub_cat, $target_cat, $supplier)
    {

        if($art == 'new'){
            do{
                $new_art = $this->createArt();
                $art = $new_art;
                $result = $this->_db->query("SELECT * FROM `products` WHERE `art` = '$art' ");
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if($result == [])
                    break;
            }while(true);
        }

        mkdir('public/img/'.$art);
        $dir = 'public/img/'.$art.'/';
        $img_path = [];
        for($i = 0; $i < count($img['tmp_name']); $i++){
            move_uploaded_file($img['tmp_name'][$i], $dir.basename($img['name'][$i]));

            if($i == 0)
                $img_path = $img['name'][$i];
            else
                $img_path .= ','.$img['name'][$i];
        }
        $sql = "INSERT INTO products(
                    title, art, material, made_in, temp, more_param, color,
                img_path, price, category, sub_cat, target_cat, supplier) 
                VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
        $query = $this->_db->prepare($sql);

        $query->execute([ 
            $title, $art, $material, $made_in, $temp, $more_param, $color, $img_path,
             $price, $category, $sub_cat, $target_cat, $supplier 
            ]);


        $_POST = [];

        return 'ok';


    }

    public function favExist($product_id)
    {
        $result = $this->_db->query("SELECT * FROM `favorites` WHERE `product_id` = '$product_id' and `user_id` = '$_COOKIE[id]'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    

}