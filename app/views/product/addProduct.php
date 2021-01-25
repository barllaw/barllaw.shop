<!DOCTYPE html>
<html>
<?php
$title = 'Добавить товар';
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="add_product-main container">
    
    <div class="error" id="error"></div>
    
    <form id="new_product_form" action="/product/addProduct" method="post" enctype="multipart/form-data">
        <label for="title">Название</label>
        <input class="require"  id="title" value="<?=$_POST['title']?>" type="text" name="title" placeholder="">

        <label for="art">Артикул</label>
        <input class="require"  id="art" value="<?=$_POST['art']?>" type="text" name="art" placeholder="">

        <label for="material">Материал</label>
        <input id="material" value="<?=$_POST['material']?>" type="text" name="material" placeholder="">

        <label for="made_in">Производство</label>
        <input id="made_in" value="Турция<?=$_POST['made_in']?>" type="text" name="made_in" placeholder="">

        <label for="temp">Температурный режим</label>
        <input id="temp" value="<?=$_POST['temp']?>" type="text" name="temp" placeholder="">

        <label for="more_param">Допольнительно</label>
        <input id="more_param" value="<?=$_POST['more_param']?>" type="text" name="more_param" placeholder="">

        <label for="color">Цвет</label>
        <input id="color" value="<?=$_POST['color']?>" type="text" name="color" placeholder="">

        <p>Изображения</p>
        <div>
            <label for="images" class="chous">Добавить...</label>
            <input id="images" type="file" name='images[]' multiple >
        </div>

        <label for="price">Цена</label>
        <input class="require"  id="price" value="<?=$_POST['price']?>" type="text" name="price" placeholder="">

        <label for="category">Категория</label>
        <select class="alert"  id="category" name="category">
            <option value="outerwear">Верхняя одежда</option>
            <option value="sweaters">Кофты, худи</option>
            <option value="pants">Штаны</option>
            <option value="sports_suit">Спорт костюмы</option>
            <option value="shirts">Рубашки</option>
            <option value="shoes">Обувь</option>
            <option value="accessories">Аксессуары</option>
        </select>

        <label for="sub_cat">Саб категория</label>

        <select class="alert"  id="sub_cat" name="sub_cat">
            <option value="winter-jackets">Зимние куртки</option>
            <option value="coats">Пальта</option>
            <option value="jackets">Куртки</option>
            <option value="leather-jackets">Кожанки</option>
            <option value="jeans-jackets">Джинсовки</option>
            <option value="bombers">Бомберы</option>
        </select>

        <label for="supplier">Таргет кат.</label>
        <input id="target_cat" value="<?=$_POST['target_cat']?>" type="text" name="target_cat" placeholder="">

        <label for="supplier">Поставщик</label>
        <select class="alert"  id="supplier" name="supplier">
            <option value="smm-drop">smm-drop</option>
            <option value="adre$drop">adre$drop</option>
            <option value="TUR">TUR</option>
            <option value="OdessaDROP">OdessaDROP</option>
            <option value="4_you_drop">4_you_drop</option>
            <option value="brewdrop">brewdrop</option>
            <option value="focus">focus</option>
            <option value="depot">depot</option>
            <option value="darkside">darkside</option>
            <option value="dropoptman">dropoptman</option>
        </select>

        <button type='submit' class="btn" id="new_product">Добавить</button>

    </form>
</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

