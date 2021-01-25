<?php

require 'DB.php';

class UserModel
{
    private $_db = null;

    public function __construct()
    {
            $this->_db = DB::getInstence();
    }


    public function addUser($login,$pass,$name)
    {

        $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user != []){
            return "Такой логин уже существует";
        }

        $date = time();
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(
                            login,pass,name,lastname,father,
                            email,phone,city,instagram,date,ip,agent) 
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->_db->prepare($sql);

        $query->execute([
            $login,$pass,$name,'','','','','','',$date,$ip,$agent
            ]);

        $this->setAuth($login);

        return 'ok';
    }


    public function getUser($login)
    {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $result = $this->_db->query("SELECT * FROM `users`ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMyOrders($id)
    {
        $result = $this->_db->query("SELECT * FROM `orders` WHERE `user_id` = '$id'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders()
    {
        $result = $this->_db->query("SELECT * FROM `orders`ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFavorites($user_id)
    {
        $result = $this->_db->query("SELECT * FROM `favorites` WHERE `user_id` = '$user_id' ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function auth($login, $pass)
    {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user['login'] == '')
            return 'Пользователя не найдено';
        elseif(password_verify($pass, $user['pass']))
            $this->setAuth($login);
        else
            return 'Не верный пароль';
        return 'ok';
    }


    public function updateDetails(
        $login,
        $name,
        $lastname,
        $father,
        $email,
        $phone,
        $city,
        $instagram,
        $id)
    {
        $sql = "UPDATE `users` SET `login`= ?,
                                    `email`= ?,
                                    `name`= ?,
                                    `lastname`= ?,
                                    `father`= ?,
                                    `phone`= ?,
                                    `city`= ?,
                                    `instagram`= ? 
                                    WHERE `id` = ?";
        
        $query = $this->_db->prepare($sql);
        $query->execute([   
                            $login,
                            $email,
                            $name,
                            $lastname,
                            $father,
                            $phone,
                            $city,
                            $instagram,
                            $id
                            ]);
        return 'ok';
    }

    
    public function setAuth($login)
    {

        $user = $this->getUser($login);

        foreach ($user as $key => $value) {
            setcookie($key, $value, time() + 3600, '/');
        }

    }

    public function changeStatus($status, $order_id){
        $sql = "UPDATE `orders` SET `status` = ? WHERE `id` = ?";
        
        $query = $this->_db->prepare($sql);
        $query->execute([ $status, $order_id ]);
        return 'ok';
    }

}