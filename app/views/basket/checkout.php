<!DOCTYPE html>
<html>
<?php 
$title = 'Заказ оформлен';
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
        <input type="hidden" id="user_id" value="<?=$_COOKIE['id']?>">
        <label for="name">Имя</label>
        <input id="name" name="name" type="text" value="<?=$_COOKIE['name']?>">
        <label for="lastname">Фамилия</label>
        <input id="lastname" name="lastname" type="text" value="<?=$_COOKIE['lastname'] ?>">
        <label for="father">Отчество</label>
        <input id="father" name="father" type="text" value="<?=$_COOKIE['father']?>">
        <label for="phone">Номер телефона</label>
        <input id="phone" name="phone" type="text" value="<?=$_COOKIE['phone']?>">
        <label for="city">Город</label>
        <input id="city" name="city" type="text" value="<?=$_COOKIE['city']?>">
        <label for="poshta">Отделение Новой Почты</label>
        <input id="poshta" name="poshta" type="text" value="">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?=$_COOKIE['email']?>">
        <label for="instagram">Instagram</label>
        <input id="instagram" name="instagram" type="text" value="<?=$_COOKIE['instagram']?>">
        <div id="error"></div>
        <button class="btn" id="new_order">Готово</button>
    </form>
</div>

<?php endif;?>

</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

