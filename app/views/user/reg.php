<?php
if($_COOKIE['login']){
    header('location: /');
}
?>
<!DOCTYPE html>
<html>
<?php
$title = 'Регистрация';
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="user-main content">
    <h1>Регистрация</h1>
    <form action="" method="post" class="form-control">
        <input type="text" id="name" placeholder="Имя" value="<?=$_POST['name']?>"><br>
        <input type="text" id="login" placeholder="Логин" value="<?=$_POST['email']?>"><br>
        <input type="password" id="pass" placeholder="Пароль" value="<?=$_POST['pass']?>"><br>
        <input type="password" id="re_pass" placeholder="Повторите пароль" value="<?=$_POST['re_pass']?>"><br>
        <div id="error"></div>
        <button class="btn" id="reg_btn">Зарегистрироваться</button>
    </form>
    <p>Уже зарегистрированы? <a href="/user/auth">Войти</a></p>
</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>