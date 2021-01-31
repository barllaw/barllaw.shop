<?php
require 'DB.php';


class User extends Controller
{
    public function reg()
    {

        if($_POST['reg']){
            $user = $this->model('UserModel');

            exit($user->addUser(
                strtolower($_POST['login']),
                $_POST['pass'],
                ucfirst($_POST['name'])
            ));

        }else
            $this->view('user/reg');
    }

    public function auth()
    {
        $data = [];
        $user = $this->model('UserModel');

        if($_POST['auth']){
            exit($user->auth($_POST['login'], $_POST['pass']));
        }


        $this->view('user/auth', $data);
    }

    public function dashboard($params = '')
    {
        $user = $this->model('UserModel');
        $products = $this->model('Products');

        if($_POST['change_status']){
            $user->changeStatus($_POST['status'], $_POST['order_id']);
        }

        if($_POST['update']){
            $user->updateDetails(
                strtolower($_POST['login']),
                ucfirst($_POST['name']),
                ucfirst($_POST['lastname']),
                ucfirst($_POST['father']),
                strtolower($_POST['email']),
                $_POST['phone'],
                ucfirst($_POST['city']),
                strtolower($_POST['instagram']),
                $_POST['id']
            );
        }
        
        $data['user'] = $user->setAuth($_COOKIE['login']);

        if($_COOKIE['login'] == 'admin'){
            $data['all_users'] = $user->getAllUsers();
            $data['all_orders'] = $user->getAllOrders();
            $data['hidden_products'] = $products->getHiddenProducts();
            $data['all_suppliers'] = $products->getSuppliers();
        }else{
            $data['orders'] = $user->getMyOrders($data['user']['id']);
            $data['favorites'] = $user->getFavorites($data['user']['id']);
        }

        $this->view('user/dashboard', $data, $params);
    }

    public function logout()
    {
        setcookie('login', $_COOKIE['login'], time() - 3600 * 12, '/');
        header('Location: /');
    }
}