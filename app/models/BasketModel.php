<?php
class BasketModel
{
    private $s_name = 'cart';
    private $_db = null;

    public function __construct()
    {
            $this->_db = DB::getInstence();
    }

    public function isSetSession()
    {
        return isset($_SESSION[$this->s_name]);
    }

    public function deleteSession()
    {
        unset($_SESSION[$this->s_name]);
    }

    public function getSession()
    {
        return $_SESSION[$this->s_name];
    }


    public function deleteItem($itemID)
        {
        
            if(count($_SESSION[$this->s_name]) == 1)
                unset($_SESSION[$this->s_name]);
            else{
                unset($_SESSION[$this->s_name][$itemID]);
                $new_arr = [];
                foreach ($_SESSION[$this->s_name] as $key) {
                    $new_arr[] = $key;
                }
                $_SESSION[$this->s_name] = $new_arr;
            }
        }

    public function countItems()
    {
        return count($_SESSION[$this->s_name]);
    }


    public function addToCart($title, $img_path, $art, $color, $size, $price, $item_id, $supplier)
    {
        $item = ['title' => $title, 'img_path' => $img_path, 'art' => $art, 'color' => $color, 'size' => $size, 'price' => $price, 'item_id' => $item_id, 'supplier' => $supplier];

        $itemExist = false;
        foreach ($_SESSION[$this->s_name] as $key) {
            if($key['art'] == $art)
            $itemExist = true;
        }
        if(!$itemExist)
            $_SESSION[$this->s_name][] = $item;

        
    }

    public function newOrder(
        $user_id,
        $name,
        $lastname,
        $father,
        $phone,
        $city,
        $poshta,
        $email,
        $instagram
    )
    {
        $token = '1522265936:AAG19KjdhtUx2zqNSQlis3ecvrK5pfenBlg';
        $chat_id = '379565079';


        $date = time();
        foreach ($_SESSION[$this->s_name] as $key) {
            $sql = "INSERT INTO `orders`(
                            `user_id`, `product_id`, `title`, `art`, `color`,
                             `size`, `name`, `lastname`, `father`, `phone`, `email`, `instagram`,
                             `city`, `poshta`, `img`, `price`, `status`, `date`, `supplier`) 
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $this->_db->prepare($sql);

            $query->execute([
 
                $user_id,
                $key['item_id'],
                $key['title'],
                $key['art'],
                $key['color'],
                $key['size'],
                $name,
                $lastname,
                $father,
                $phone,
                $email,
                $instagram,
                $city,
                $poshta,
                $key['img_path'],
                $key['price'],
                'Новый',
                $date,
                $key['supplier']
            ]);

            $for_telegram = 
                            '<b>Клиент</b>'.'%0A'.
                            'Имя: '.$name.'%0A'.
                            'Фамилия: '.$lastname.'%0A'.
                            'Отчество: '.$father.'%0A'.
                            'Телефон: '.$phone.'%0A'.
                            'Инст: '.$instagram.'%0A'.
                            'Город: '.$city.'%0A'.
                            'Новая Пошта: '.$poshta.'%0A'.
                            '<b>Товар</b>'.'%0A'.
                            'Название: '.$key['title'].'%0A'.
                            'Арт: '.$key['art'].'%0A'.
                            'Размер: '.$key['size'].'%0A'.
                            'Поставщик: '.$key['supplier'].'%0A'.
                            'Цена: '.$key['price'];

            fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$for_telegram}", 'r');
        }   

        unset($_SESSION[$this->s_name]);
        return 'ok';
    }

    public function addToFavorites( $user_id, $img, $product_id, $title, $price)
    {

        $sql = "INSERT INTO `favorites`(
                    `user_id`, `product_id`, `title`, `price`, `img_path`) 
            VALUES(?,?,?,?,?)";
        $query = $this->_db->prepare($sql);

        $query->execute([
            $user_id,
            $product_id,
            $title,
            $price,
            $img
        ]);
        exit($product_id);
    }
    
    public function removeFavorite($product_id, $user_id)
    {
        $sql = "DELETE FROM `favorites` WHERE `product_id` = ? and `user_id` = ? ";
        $query = $this->_db->prepare($sql);

        $query->execute([
            $product_id,
            $user_id
        ]);
    }

    

}