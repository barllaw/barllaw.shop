<?php
require 'DB.php';


class Product extends Controller
{
    public function index($id)
    {
        $products = $this->model('Products');
        $user = $this->model('UserModel');
        $data = $products->getOneProduct($id);
        $data['favorite'] = '';
        if(isset($_COOKIE['login']))
            $data['user'] = $user->setAuth($_COOKIE['login']);

        

        $result = $products->favExist(
            $id,
            $data['user']['id']
        );
        if($result != [])
            $data['favorite'] = 'true';
        
        $this->view('product/index', $data);
    }

    public function addProduct()
    {
        if($_POST['new_product']){
            $products = $this->model('Products');
            $products->addProduct(
                $_POST['title'],
                $_POST['art'],
                $_POST['material'],
                ucfirst($_POST['made_in']),
                $_POST['temp'],
                $_POST['more_param'],
                $_POST['color'],
                $_FILES['images'],
                $_POST['price'],
                $_POST['category'],
                $_POST['sub_cat'],
                $_POST['target_cat'],
                $_POST['supplier']
            );
             exit('ok');
        }
        
        $this->view('product/addProduct');
        
    }
}