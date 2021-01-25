<?php
 if(!$_COOKIE['login']){
     header('location: /user/auth');
 }
?>
<!DOCTYPE html>
<html>
<?php
$title = 'Мой профиль';
require_once 'public/blocks/head.php'; ?>
<body>
<?php 
require_once 'public/blocks/header.php'; 

if($_COOKIE['login'] == 'admin'):
?>
<div class="profile-main admin-main">
    <h1>Admin</h1>
    <div id="user_menu_btn" class="user-menu btn_second">
        Меню
    </div>
    <div class="profile-content">
        <div class="left-side">
            <ul>
                <li>
                    <a href="/user/dashboard/orders" style='<?php if($params == '' or $params == 'orders') echo 'font-weight: bold;' ?>' >
                        <span><i class="fas fa-shopping-bag"></i></span>Заказы
                    </a></li>
                <li>
                    <a href="/product/addProduct" style='' >
                        <span><i class="fas fa-cart-arrow-down"></i></span>Добавить товар
                    </a></li>
                <li>
                    <a href="/user/dashboard/hiddenProduct" style='' >
                        <span><i class="fas fa-minus-circle"></i></span>Неактивные товары
                    </a></li>
                <li>
                    <a href="/user/dashboard/users" style="<?php if($params == 'users') echo 'font-weight: bold;' ?>" >
                        <span><i class="fas fa-user"></i></span>Пользователи
                    </a></li>
                <li>
                    <a href="/user/logout">
                        <span><i class="fas fa-sign-out-alt" ></i></span>Выйти
                    </a></li>
            </ul>

        </div>
        <div class="right-side">
        
            <?php if($params == '' or $params == 'orders'): ?>
             
             <div class="orders">
                 <h2>Заказы</h2>
                 <?php
                    foreach ($data['all_orders'] as $key):
                 ?>
                 <div class="order">
                        <div class="id"><small>#</small><span id="order_id"><?=$key['id']?></span></div>
                        <div class="img"><a href="/product/<?=$key['product_id']?>/"><img src="/public/img/<?=$key['img']?>" alt=""></a></div>
                        <div class="desc">
                            <div class="title"><?=$key['title']?></div>
                            <div class="art"><?=$key['art']?></div>
                            <div class="color"><?=$key['color']?></div>
                            <div class="size"><?=$key['size']?></div>
                            <div class="supplier"><?=$key['supplier']?></div>
                        </div>
                        <div class="nothing"></div>
                        <div class="client">
                            <div class="name"><?=$key['name']?></div>
                            <div class="lastname"><?=$key['lastname']?></div>
                            <div class="father"><?=$key['father']?></div>
                            <div class="phone"><?=$key['phone']?></div>
                            <div class="city"><?=$key['city']?></div>
                            <div class="nova_poshta"><?=$key['poshta']?></div>
                            <div class="email"><?=$key['email']?></div>
                            <div class="instagram">@<?=$key['instagram']?></div>
                        </div>
                        <div class="row-end">
                            <div class="status">
                                <?php
                                    if($key['status'] == 'Новый'){
                                        $status_icon = '<i style="color: #77777785" class="fas fa-circle"></i>';
                                    }else if($key['status'] == 'В процессе'){
                                        $status_icon = '<i style="color: #f1a70085" class="fas fa-circle-notch"></i>';
                                    }else if($key['status'] == 'Получен'){
                                        $status_icon = '<i style="color: #00f10085" class="fas fa-check-circle"></i>';
                                    }else if($key['status'] == 'Отказ'){
                                        $status_icon = '<i style="color: #f1000085" class="far fa-times-circle"></i>';
                                    }
                                    echo $status_icon;
                                ?>
                                <select name="status" id="status">
                                <option value=""></option>
                                    <?php
                                        $status_array = [ 'Новый','В процессе','Получен', 'Отказ' ];

                                        foreach ($status_array as $status) {
                                            $selected = '';
                                            if($status == $key['status'])
                                                $selected = 'selected';
                                            echo "<option value='$status' $selected>$status</option>";
                                        };
                                        $key['status'];
                                    ?>  
                                </select>
                            </div>
                            <div class="date"><?=date('d.m.y H:i', $key['date'])?></div>
                            <div class="change_status btn" id="change_status">Сохранить</div>
                        </div>
                 </div>
                 <?php endforeach;?>
             </div>   
                
             <?php elseif($params == 'users'): ?>
                <div class="users">
                 <h2>Пользователи</h2>

                    <div>
                        <div class="users-wrap">
                            <?php
                                foreach ($data['all_users'] as $user):
                            ?>
                            <div class="user">
                                    <div><p>Логин: <?=$user['login']?></p></div>
                                    <div>
                                        <p>Имя: <?=$user['name']?></p>
                                        <p>Фамилия: <?=$user['lastname']?></p>
                                        <p>Отчество: <?=$user['father']?></p>
                                    </div>
                                    <div>
                                        <p>Емайл: <?=$user['email']?></p>
                                        <p>Тел: <?=$user['phone']?></p>
                                        <p>Город: <?=$user['city']?></p>
                                        <p>Инст: <?=$user['instagram']?></p>
                                        <p><?=date('d.m.y H:i', $user['date'])?></p>
                                    </div>
                            </div>
                            <?php endforeach;?>
                        </div>

                    </div>
             </div>         
            <?php endif;?>

        </div>
    </div>
    
    
</div>
<?php else:?>
<div class="profile-main">
    <h1>Мой профиль</h1>
    <div id="user_menu_btn" class="user-menu btn_second">
        Меню
    </div>
    <div class="profile-content">
        <div class="left-side">
        
            <div class="welcome">
                <p>Привет, <b><?=ucfirst($_COOKIE['name'])?></b></p>
            </div>
            <ul>
                <li>
                    <a href="/user/dashboard/my-details" style='<?php if($params == '' or $params == 'my-details') echo 'font-weight: bold;' ?>' >
                        <span><i class="far fa-user"></i></span>Мои данные
                    </a></li>
                <li>
                    <a href="/user/dashboard/favorites" style='<?php if($params == 'favorites') echo 'font-weight: bold;' ?>' >
                        <span><i class="far fa-heart"></i></span>Избранное
                    </a></li>
                <li>
                    <a href="/user/dashboard/my-orders" style="<?php if($params == 'my-orders') echo 'font-weight: bold;' ?>" >
                        <span><i class="fas fa-shopping-basket"></i></span>Мои заказы
                    </a></li>
                <li>
                    <a href="/user/logout">
                        <span><i class="fas fa-sign-out-alt" ></i></span>Выйти
                    </a></li>
            </ul>

        </div>
        <div class="right-side">
        
            <?php if($params == '' or $params == 'my-details'): ?>
             
             <div class="my-details">
                 <h2><i class="far fa-user"></i> Мои данные</h2>
                 <div>
                    <input type="hidden" id="id" value="<?=$_COOKIE['id']?>">
                    <label for="login">Логин</label>
                    <input id="login" name="login" value="<?=$_COOKIE['login']?>" type="text">
                    <label for="name">Имя</label>
                    <input id="name" name="name" value="<?=$_COOKIE['name']?>" type="text">
                    <label for="lastname">Фамилия</label>
                    <input id="lastname" name="lastname" value="<?=$_COOKIE['lastname']?>" type="text">
                    <label for="father">Отчество</label>
                    <input id="father" name="father" value="<?=$_COOKIE['father']?>" type="text">
                    <label for="email">Email</label>
                    <input id="email" name="email" value="<?=$_COOKIE['email']?>" type="email">
                    <label for="phone">Номер телефона</label>
                    <input id="phone" name="phone" value="+380<?=$_COOKIE['phone']?>" type="text">
                    <label for="city">Город</label>
                    <input id="city" name="city" value="<?=$_COOKIE['city']?>" type="text">
                    <label for="instagram">Логин Instagram</label>
                    <input id="instagram" name="instagram" value="@<?=$_COOKIE['instagram']?>" type="text">
                    <div id="error"></div>
                    <div class="btn" id="save_details">Сохранить</div>
                 </div>
             </div>   
                
             <?php elseif($params == 'my-orders'): ?>
                <div class="my-orders">
                 <h2><i class="fas fa-shopping-bag"></i> Мои заказы</h2>
                 <?php if(!$data['orders']): ?>
                    <div>
                        Вы еще ничего не заказывали.
                    </div>
                <?php else: ?>
                    <div>
                        <div class="user_orders">
                            <?php
                                for ($i = count($data['orders']) - 1; $i >= 0 ; $i--):
                            ?>
                            <div class="row">
                                <a href="/product/<?=$data['orders'][$i]['product_id']?>"><img src="/public/img/<?=$data['orders'][$i]['img']?>" alt=""></a>
                                <div class="user_orders-desc">
                                    <h4><?=$data['orders'][$i]['title']?></h4>
                                    <p>Артикул: <?=$data['orders'][$i]['art']?></p>
                                    <p><?php if($data['orders'][$i]['color'] != '') echo "Цвет: ".$data['orders'][$i]['color']; ?></p>
                                    <p><?php if($data['orders'][$i]['size'] != '') echo "Размер: ".$data['orders'][$i]['size']; ?></p>

                                </div>
                                <span><?=$data['orders'][$i]['price']?> ₴</span>
                                <div class="row-end">
                                    <p><?php
                                    if($data['orders'][$i]['status'] == 'Новый'){
                                        $status_icon = '<i style="color: #77777785" class="fas fa-circle"></i>';
                                    }else if($data['orders'][$i]['status'] == 'В процессе'){
                                        $status_icon = '<i style="color: #f1a70085" class="fas fa-circle-notch"></i>';
                                    }else if($data['orders'][$i]['status'] == 'Получен'){
                                        $status_icon = '<i style="color: #00f10085" class="fas fa-check-circle"></i>';
                                    }else if($data['orders'][$i]['status'] == 'Отказ'){
                                        $status_icon = '<i style="color: #f1000085" class="far fa-times-circle"></i>';
                                    }
                                    echo $status_icon.' ';
                                    echo $data['orders'][$i]['status']?></p>
                                    <p><?=date('d.m.y', $data['orders'][$i]['date'])?></p>
                                </div>
                            </div>
                            <?php endfor;?>
                        </div>

                    </div>
                <?php endif;?>
             </div>   
             <?php elseif($params == 'favorites'): ?>
                <div class="favorites">
                 <h2><i class="fas fa-heart"></i> Избранное</h2>
                 <?php if(!$data['favorites']): ?>
                    <div class="favorites-empty">
                        <p>Избранное пустое.</p>
                        <p><a href="/" class="btn_second" style="display: block; width: 150px; margin-top: 30px; text-align: center;padding: 5px">На главную</a></p>
                    </div>
                <?php else: ?>
                    <div class="favorites-wrap">
                        <?php
                            foreach ($data['favorites'] as $key):
                        ?>
                        <div class="fav_product">
                            <span class="favorites-icon favorite_btn" id="remove_favorite"><i class="fas fa-times"></i></span>
                            <a href="/product/<?=$key['product_id']?>">
                                <div class="image" >
                                    <img src="/public/img/<?=$key['art'].'/'.$key['img_path']?>" alt="Товар">
                                </div>
                                <div class="desc">
                                    <input type="hidden" id="product_id" value="<?=$key['product_id']?>">
                                    <span id="product_title"><?=$key['title'] ?></span>
                                    <h4><price id="product_price"><?=$key['price'] ?></price> ₴</h4>
                                </div>
                            </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
             </div>               
            <?php endif;?>

        </div>
    </div>
    
    
</div>
<?php 
endif;
require_once 'public/blocks/footer.php'; ?>
</body>
</html>