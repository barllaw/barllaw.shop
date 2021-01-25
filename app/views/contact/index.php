<!DOCTYPE html>
<html>
<?php require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="container main">
    <h1>Обратная связь</h1>
    <p>Same paragraph for company</p>
    <form action="/contact" method="post" class="form-control">
        <input type="text" name="name" placeholder="Name" value="<?=$_POST['name']?>"><br>
        <input type="email" name="email" placeholder="Email" value="<?=$_POST['email']?>"><br>
        <input type="text" name="age" placeholder="Age" value="<?=$_POST['age']?>"><br>
        <textarea name="message" placeholder="Enter message"><?=$_POST['message']?></textarea>
        <div class="error"><?=$data['message']?></div>
        <button class="btn" id="send">Send</button>
    </form>
</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>