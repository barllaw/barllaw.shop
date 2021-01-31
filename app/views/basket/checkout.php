<!DOCTYPE html>
<html>
<?php 
$title = 'Оформить заказ';
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php';?>

<div class="basket-main content">
    
<?php if($data['success'] == 'true'):?>

<div class="empty-basket">
    <p><i class="fas fa-shopping-bag"></i></p>
    <h2>Спасибо! Заказ успешно оформлен. </h2>
    <a href="/" >На главную</a>
</div>

<?php else:?>

<div class="checkout">
    <h2>Оформить заказ</h2>
    <form action="">
        <input type="hidden" id="user_id" value="<?=$data['user']['id']?>">
        <label for="name">Имя</label>
        <input id="name" name="name" type="text" value="<?=$data['user']['name']?>">
        <label for="lastname">Фамилия</label>
        <input id="lastname" name="lastname" type="text" value="<?=$data['user']['lastname'] ?>">
        <label for="father">Отчество</label>
        <input id="father" name="father" type="text" value="<?=$data['user']['father']?>">
        <label for="phone">Номер телефона</label>
        <input id="phone" name="phone" type="text" value="<?=$data['user']['phone']?>">
        <label for="city">Город</label>
        <input id="city" name="city" type="text" value="<?=$data['user']['city']?>">
        <label for="poshta">Отделение Новой Почты</label>
        <input id="poshta" name="poshta" type="number" value="" pattern="^[0-9]+$">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?=$data['user']['email']?>">
        <label for="instagram">Instagram</label>
        <input id="instagram" name="instagram" type="text" value="<?=$data['user']['instagram']?>">
        <div id="error"></div>
        <button class="btn" id="new_order">Готово</button>
    </form>
</div>

<?php endif;?>

</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

