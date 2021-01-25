<!DOCTYPE html>
<html>
<?php require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="container main">
    <h1>About Company</h1>
    <p>Same paragraph for company</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorem expedita hic incidunt
        quasi quidem repudiandae sint tempore ut velit.</p>
    <?php if($params): ?>
    <div class="params">
        <h3>Есть дополнительные параметры:</h3>
        <p><?php echo $params ?></p>
    </div>
    <?php endif; ?>
</div>


<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>