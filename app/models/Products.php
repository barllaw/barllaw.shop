<?php

class Products
{
    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstence();
    }

    public function getProductsCategory($category){
        $result = $this->_db->query("SELECT * FROM `products` WHERE `category` = '$category' and `hide` = '0' ORDER BY `availability` DESC, `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsSubCat($sub_cat){
        $result = $this->_db->query("SELECT * FROM `products` WHERE `sub_cat` = '$sub_cat' and `hide` = '0' ORDER BY `availability` DESC, `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsTargetCat($second_par){
        $result = $this->_db->query("SELECT * FROM `products` WHERE `target_cat` = '$second_par' and `hide` = '0' ORDER BY `availability` DESC, `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneProduct($id)
    {
        $result = $this->_db->query("SELECT * FROM `products` WHERE `id` = '$id' and `hide` = '0'");
        return $result->fetch(PDO::FETCH_ASSOC);
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

    public function favExist($product_id, $user_id)
    {
        $result = $this->_db->query("SELECT * FROM `favorites` WHERE `product_id` = '$product_id' and `user_id` = '$user_id'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdWithArt($art)
    {
        $result = $this->_db->query("SELECT `id` FROM `products` WHERE `art` = '$art' ");
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
    
    public function hideProduct($id)
    {
        $this->_db->query("UPDATE `products` SET `hide` = '1' WHERE `id` = '$id'");
        $this->_db->query("UPDATE `favorites` SET `hidden` = '1' WHERE `product_id` = '$id'");
    }

    public function activeProduct($id)
    {
        $this->_db->query("UPDATE `products` SET `hide` = '0' WHERE `id` = '$id'");
        $this->_db->query("UPDATE `favorites` SET `hidden` = '0' WHERE `product_id` = '$id'");
        return 'ok';
    }

    public function getHiddenProducts()
    {
        $result = $this->_db->query("SELECT * FROM `products` WHERE `hide` = '1' ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function availability($id)
    {
        $this->_db->query("UPDATE `products` SET `availability` = '1' WHERE `id` = '$id'");
        $this->_db->query("UPDATE `favorites` SET `availability` = '1' WHERE `product_id` = '$id'");
    }
    
    public function notAvailability($id)
    {
        $this->_db->query("UPDATE `products` SET `availability` = '0' WHERE `id` = '$id'");
        $this->_db->query("UPDATE `favorites` SET `availability` = '0' WHERE `product_id` = '$id'");
    }

    public function getProductFiles($id)
    {
        $result = $this->_db->query("SELECT `img_path` FROM `products` WHERE `id` = '$id'");
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result['img_path'];
    }

    public function deleteProduct($id, $files, $dir)
    {
        $dir_arr = explode('/',$dir);
        $dir = $dir_arr[1].'/'.$dir_arr[2].'/'.$dir_arr[3];
        $files = explode(',', $files);

        foreach ($files as $key) {
            unlink($dir.'/'.$key);
        }
        rmdir($dir);

        $this->_db->query("DELETE FROM `products` WHERE `id` = '$id'");
        $this->_db->query("DELETE FROM `favorites` WHERE `product_id` = '$id'");
        return 'ok';
    }

    public function addSupplier($supplier)
    {
        $sql = "INSERT INTO suppliers(supplier) VALUES(?)";
        $query = $this->_db->prepare($sql);
        $query->execute([$supplier]);
        
        header('location: /user/dashboard/addProduct');
    }

    public function deleteSupplier($supplier)
    {
        $this->_db->query("DELETE FROM `suppliers` WHERE `supplier` = '$supplier'");
        header('location: /user/dashboard/addSupplier');
    }

    public function getSuppliers()
    {
        $result = $this->_db->query("SELECT * FROM `suppliers`");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    

}