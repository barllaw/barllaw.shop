<!DOCTYPE html>
<html>
<?php 
$title = 'Корзина';
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php';
?>

<div class="basket-main">
    

        <?php if(!isset($_SESSION['cart'])):?>
            <div class="empty-basket">
                <p><i class="fas fa-shopping-bag"></i></p>
                <h2>Корзина пуста </h2>
                <a href="/" >На главную</a>
            </div>
        <?php else:?>
    <div class="basket-products">
        <div class="top-line">
            <h1>Корзина товаров</h1>
            <form action="/basket/" method="post">
                <button class="btn_second" name="delete_all">Удалить все</button>
            </form>
        </div>

                <div class="product-basket">
                    <?php
                        for ($i = 0; $i < count($_SESSION['cart']); $i++):
                            $sum += $_SESSION['cart'][$i]['price'];
                            $img = explode(',',$_SESSION['cart'][$i]['img_path']);
                    ?>
                    <div class="row" id='<?=$i?>'>
                        <img src="/public/img/<?=$img[0]?>" alt="">
                        <div class="product_desc-basket">
                            <h4><?=$_SESSION['cart'][$i]['title']?></h4>
                            <p>Артикул: <?=$_SESSION['cart'][$i]['art']?></p>
                            <p><?php if($_SESSION['cart'][$i]['color'] != '') echo "Цвет: ".$_SESSION['cart'][$i]['color']; ?></p>
                            <p><?php if($_SESSION['cart'][$i]['size'] != '') echo "Размер: ".$_SESSION['cart'][$i]['size']; ?></p>

                        </div>
                        <span><?=$_SESSION['cart'][$i]['price']?> ₴</span>
                        <input type="hidden" id="deleteItem" value="<?=$i?>">
                        <button class="btn" id="btn_deleteItem"><i class="fas fa-times"></i></button>
                    </div>
                    <?php endfor;?>
                </div>

    </div>
    
    <div class="basket-right">
        <div class="total">
            <h2>Всего</h2>
            <div class="total-sum">
                <p>Количество товаров</p>
                <p><b><?=count($_SESSION['cart'])?></b></p>
            </div>
            <div class="total-sum">
                <p>Сумма</p>
                <p><b><?=$sum?> грн.</b></p>
            </div>
            <div><a class="btn" href="/basket/checkout">Оформить заказ</a></div>
        </div>
        <div class="basket-info">
            <p>После оформления заказа с вами свяжуться для подтверждения заказа.</p>
            <p>Обязательная минимальная предоплата 150грн.</p>
            <p>Доставка Новой Почтой по Украине от 2 до 4 дней.</p>
        </div>
    </div>
            <?php endif;?>
    
    

</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

