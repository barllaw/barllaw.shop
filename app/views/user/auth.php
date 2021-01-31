<?php
if($_COOKIE['login']){
    header('location: /');
}
?>
<!DOCTYPE html>
<html>
<?php
$title = 'Вход';
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="container user-main content">
    <h1>Вход</h1>
    <form action="" method="post" class="form-control">
        <input value="" type="text" id="login" placeholder="Логин"><br>
        <input value="" type="password" id="pass" placeholder="Пароль"><br>
        <div id="error"></div>
        <button class="btn" id="auth_btn">Войти</button>
    </form>
        <p><a href="/user/reg">Зарегистрироваться</a></p>
</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>