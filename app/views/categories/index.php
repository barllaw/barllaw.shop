<!DOCTYPE html>
<html>
<?php
$title = $data['title'];
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<?php if($data['page'] == 'clothes'): ?>
<div class="main-clothes">
    <div class="categories_banners">
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/outerwear">
                    <img src="/public/img/_banners/winter.jpg" alt="">
                </a>
            </div>
        </div>
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/sweaters">
                    <img src="/public/img/_banners/hoodies.jpg" alt="">
                </a>
            </div>
        </div>
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/pants">
                    <img src="/public/img/_banners/pants.jpg" alt="">
                </a>
            </div>
        </div>
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/sports_suit">
                    <img src="/public/img/_banners/sport-suit.jpg" alt="">
                </a>
            </div>
        </div>
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/shirts">
                    <img src="/public/img/_banners/shirts.jpg" alt="">
                </a>
            </div>
        </div>  
    </div>
</div>

<?php else: ?>

<div class="container products-main">
    <h2><?=$title?></h2>
    <div id="cat-mobile-btn" class="cat-mobile-btn btn_second">Категории</div>
    <?php if($data['page'] == 'Верхняя одежда'):?>
        <div class="nav-cat">
            <ul>
                <li><a href="/categories/outerwear/"><b><?=$data['page']?></b></a></li>
                <li><a href="/categories/outerwear/winter-jackets">Зимние куртки</a></li>
                <li><a href="/categories/outerwear/coats">Пальта</a></li>
                <li><a href="/categories/outerwear/jackets">Куртки</a></li>
                <li><a href="/categories/outerwear/leather-jackets">Кожанки</a></li>
                <li><a href="/categories/outerwear/jeans-jackets">Джинсовки</a></li>
                <li><a href="/categories/outerwear/bombers">Бомберы</a></li>
                <li><a href="/categories/outerwear/winter-jackets/tnf">The North Face</a></li>
            </ul>
        </div>
    <?php elseif($data['page'] == 'Кофты, худи'):?>
        <div class="nav-cat">
            <ul>
                <li><a href="/categories/sweaters/"><b><?=$data['page']?></b></a></li>
                <li><a href="/categories/sweaters/hoodies">Худи</a></li>
                <li><a href="/categories/sweaters/sweatshirts">Свитшоты</a></li>
            </ul>
        </div>
    <?php elseif($data['page'] == 'Штаны'):?>
        <div class="nav-cat">
            <ul>
                <li><a href="/categories/pants/"><b><?=$data['page']?></b></a></li>
                <li><a href="/categories/pants/jeans">Джинсы</a></li>
                <li><a href="/categories/pants/sport-pants">Спортивные штаны</a></li>
                <li><a href="/categories/pants/pants">Брюки</a></li>
            </ul>
        </div>
    <?php elseif($data['page'] == 'Обувь'):?>
        <div class="nav-cat">
            <ul>
                <li><a href="/categories/shoes/"><b><?=$data['page']?></b></a></li>
                <li><a href="/categories/shoes/sneakers">Кроссовки</a></li>
                <li><a href="/categories/shoes/sneakers/nike">Nike</a></li>
                <li><a href="/categories/shoes/sneakers/adidas">Adidas</a></li>
                <li><a href="/categories/shoes/sneakers/new-balance">New Balance</a></li>
            </ul>
        </div>
    <?php elseif($data['page'] == 'Аксессуары'):?>
        <div class="nav-cat">
            <ul>
                <li><a href="/categories/accessories/"><b><?=$data['page']?></b></a></li>
                <li><a href="/categories/accessories/backpack">Рюкзаки</a></li>
                <li><a href="/categories/accessories/bag">Сумки</a></li>
            </ul>
        </div>
    <?php endif;?>
    <div class="products">
        <?php
        for($i = 0; $i < count($data['products']); $i++): 
            $img = explode(',',$data['products'][$i]['img_path']);
        ?>
        <div class="product-wrap">
            <?php 
                
                if(isset($_COOKIE['login'])){
                    if(in_array($data['products'][$i]['id'], $data['favorite'])){
                        echo '<span class="favorite_btn favorites-icon" id="remove_favorite"><i class="fas fa-heart"></i></span>';
                    }else{
                        echo '<span class="favorite_btn favorites-icon" id="add_to_favorites"><i class="far fa-heart"></i></span>';
                    }
}            ?>
            <a href="/product/<?=$data['products'][$i]['id'] ?>" class="product">
                
                <div class="image">
                    <img src="/public/img/<?=$data['products'][$i]['art'].'/'.$img[0]?>" alt="Товар">
                </div>
                <div class="desc">
                    <input type="hidden" id="product_img" value="<?=$data['products'][$i]['art'].'/'.$img[0]?>">
                    <input type="hidden" id="product_id" value="<?=$data['products'][$i]['id']?>">
                    <span id="product_title"><?=$data['products'][$i]['title'] ?></span>
                    <div><price id="product_price" class="price"><?=$data['products'][$i]['price'] ?></price> <span style="font-weight: 200;"><small>₴</small></span></div>
                </div>
            </a>
        </div>
        <?php endfor; ?>
    </div>
</div>

<?php endif;?>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

