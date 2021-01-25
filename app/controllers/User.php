<?php


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
        if($_POST['auth']){
            $user = $this->model('UserModel');
            exit($user->auth($_POST['login'], $_POST['pass']));
        }

        $this->view('user/auth', $data);
    }

    public function dashboard($params = '')
    {
        $user = $this->model('UserModel');

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
        
        $data['orders'] = $user->getMyOrders($_COOKIE['id']);
        $data['all_users'] = $user->getAllUsers();
        $data['all_orders'] = $user->getAllOrders();
        $data['favorites'] = $user->getFavorites($_COOKIE['id']);
        $this->view('user/dashboard', $data, $params);
    }

    public function logout()
    {
        foreach($_COOKIE as $key => $val){
            setcookie($key, $val, time() - 3600, '/');
        }
        header('Location: /');
    }
}