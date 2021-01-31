<?php
require 'DB.php';
class Basket extends Controller
{
    public function index()
    {
        $cart = $this->model('BasketModel');
        $user = $this->model('UserModel');
        if(isset($_COOKIE['login']))
            $data['user'] = $user->setAuth($_COOKIE['login']);
        
        $data['products'] = [];

        

        if(isset($_POST['delete_all'])){
            $cart->deleteSession();
        }

        if(isset($_POST['deleteItem'])){
            $cart->deleteItem($_POST['deleteItem']);
        }


        if (isset($_POST['item_id'])) {
            $cart->addToCart(
                $_POST['title'],
                $_POST['img_path'],
                $_POST['art'],
                $_POST['color'],
                $_POST['size'],
                $_POST['price'],
                $_POST['item_id'],
                $_POST['supplier']);
        }

        if($_POST['add_to_fav']){
            $cart->addToFavorites(
                $data['user']['id'],
                $_POST['product_img'],
                $_POST['product_id'],
                $_POST['product_title'],
                $_POST['product_price']
            );
        }

        if($_POST['remove_fav']){
            $cart->removeFavorite(
                $_POST['product_id'],
                $data['user']['id']
            );
        }
        
        $this->view('basket/index', $data);


    }

    public function checkout()
    {
        $data = [];
        $cart = $this->model('BasketModel');
        $user = $this->model('UserModel');
        if(isset($_COOKIE['login']))
            $data['user'] = $user->setAuth($_COOKIE['login']);
        
        if($_POST['new_order']){
            $result = $cart->newOrder(
                 $_POST['user_id'],
                 $_POST['name'],
                 $_POST['lastname'],
                 $_POST['father'],
                 $_POST['phone'],
                 $_POST['city'],
                 $_POST['poshta'],
                 $_POST['email'],
                 $_POST['instagram']
             );
 
             exit($result);
         }
        $this->view('basket/checkout', $data);
    }

    public function success()
    {
        $data['success'] = 'true';
        $this->view('basket/checkout', $data);
    }


}