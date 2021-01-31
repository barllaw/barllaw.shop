<!DOCTYPE html>
<html>
<?php
$title = $data['title'];
require_once 'public/blocks/head.php'; ?>
<body>
<?php 
require_once 'public/blocks/header.php';
?>
<?php if (isset($data['id'])):?>
<div class="product-main content">
    <div class="wrapper">
        <?php 
            $img = explode(',',$data['img_path']);
            echo '<input id="product_img" type="hidden" value="'.$data['art'].'/'.$img[0].'">';?>
        <div class="slider">
            <?php for($i = 0; $i < count($img); $i++):?>
                <div class="slider__item">
                    <div class="img_wrap">
                        <img src="/public/img/<?=$data['art'].'/'.$img[$i];?>" alt="">
                    </div>
                </div>
            <?php endfor;?>
        </div>

    </div>
    <div class="info">
        <div>
            <p class="title"><span id='product_title'><?=$data['title'];?></span></p>
            <p class="desc"><b>Артикул: </b><span id='art'><?=$data['art'];?></span></p>
            <p class="desc"><b>Материал: </b><?=$data['material'];?></p>
            <?php
                if($data['made_in'] != '')
                    echo '<p class="desc"><b>Производство: </b>'
                    .$data['made_in'].'</p>';
                if($data['color'] != '')
                    echo '<p class="desc"><b>Цвет: </b><span id="color">'
                    .$data['color'].'</span></p>';
                if($data['temp'] != '')
                    echo '<p class="desc"><b>Температурный режим: </b>'
                    .$data['temp'].'</p>';
                if($data['more_param'] != '')
                    echo '<p class="desc"><b>Дополнительно: </b>'
                    .$data['more_param'].'</p>';
            ?>
            <p>
                <?php if($data['category'] == 'shoes'):?>
                    <select name="size" id="size">
                        <option value="none">Выберете размер</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                    </select>
                <?php elseif($data['category'] == 'accessories'):?>
                    <div  id="size"></div>
                <?php else:?>
                    <?php if($data['sub_cat'] == 'jeans' or $data['sub_cat'] == 'pants'):?>
                        <select name="size" id="size">
                            <option value="none">Выберете размер</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                        </select>
                    <?php else:?>
                        <select name="size" id="size">
                            <option value="none">Выберете размер</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    <?php endif;?>
                <?php endif;?>
            <br>
            <p style="opacity: .6; font-size: 13px;">Доставка от 2 до 4 дней.</p>
            </p>
        </div>
        <div>
            <p class="price" ><b>Цена: </b><span id='product_price'><?=$data['price'];?></span> грн.</p>
            
            <input type="hidden" name="item_id" id="product_id" value="<?=$data['id']?>">
            <input type="hidden" name="supplier" id="supplier" value="<?=$data['supplier']?>">
            <div class="product_btns">
            <?php
                if(isset($_COOKIE['login'])):
                    if($data['favorite'] == 'true'):
                    ?>
                    <div class="add_to_favorites-btn-wrap desk_fav_btn"><button class="favorite_btn user_fav_btn fav_btn_remove" id="remove_favorite"><i class="fas fa-heart"></i> Удалить из избранных</button></div>
                    <div class="add_to_favorites-btn-wrap mobile_fav_btn"><button class="favorite_btn user_fav_btn fav_btn_remove" id="remove_favorite"><i class="fas fa-heart"></i></button></div>
                    <?php else:?>
                    <div class="add_to_favorites-btn-wrap desk_fav_btn"><button class="favorite_btn user_fav_btn" id="add_to_favorites"><i class="far fa-heart"></i> Добавить в избранное</button></div>
                    <div class="add_to_favorites-btn-wrap mobile_fav_btn"><button class="favorite_btn user_fav_btn" id="add_to_favorites"><i class="far fa-heart"></i></button></div>
                    <?php endif;?>
                <?php endif;?>
                <div class='add_to_cart-btn-wrap'><button class="btn" id="add_to_cart">Добавить в корзину</button></div>
                <?php if($_COOKIE['login'] == 'admin'):?>
                    <div class="supplier" style="margin-top: 5px">
                        <p>Поставщик <?=$data['supplier']?></p>
                    </div>
                    <div class="admin_btns">
                        <button class="admin_btn" id="hide_product_btn"><i class="fas fa-eye-slash"></i> Спрятать</button>
                        <button class="admin_btn" id="not_availability"><i class="fas fa-star-half-alt"></i> Нет в наличии</button>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php else:?>
<div class="hidden_product" style='padding: 20px 0 30% 100px'>
    <h2>Товар на данный момент не доступен!</h2>
</div>
<?php endif;?>
<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

