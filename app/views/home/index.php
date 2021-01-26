<!DOCTYPE html>
<html>
<?php 
$title = 'Главная';
require_once 'public/blocks/head.php'; ?>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="main content">
    <!-- <h2>Популярные категории</h2> -->
    <div class="main_banners">
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/outerwear/winter-jackets/tnf/">
                    <img src="/public/img/_banners/tnf.jpg" alt="">
                </a>
            </div>
        </div>
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/sweaters/hoodies/">
                    <img src="/public/img/_banners/hoodies.jpg" alt="">
                </a>
            </div>
        </div>
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/pants/jeans/">
                    <img src="/public/img/_banners/jeans.jpg" alt="">
                </a>
            </div>
        </div>  
        <div class="product-banner">
            <div class="banner-item">
                <a href="/categories/shoes/sneakers/">
                    <img src="/public/img/_banners/sneakers.jpg" alt="">
                </a>
            </div>
        </div>  
    </div>
    <div class="main-wrapper">
        <h2>Все категории</h2>
        <div class="main_slider">
            <div class="slider__item">
                <a href="/categories/outerwear/winter-jackets">
                    <div class="image">
                        <img src="/public/img/_banners/winter.jpg" alt="">
                        <div class="title">Зимние куртки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/outerwear/winter-jackets/tnf">
                    <div class="image">
                        <img src="/public/img/_banners/tnf.jpg" alt="">
                        <div class="title">The North Face</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/outerwear/coats">
                    <div class="image">
                        <img src="/public/img/_banners/plt.jpg" alt="">
                        <div class="title">Пальта</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/outerwear/jackets">
                    <div class="image">
                        <img src="/public/img/_banners/jackets.jpg" alt="">
                        <div class="title">Куртки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/outerwear/leather-jackets">
                    <div class="image">
                        <img src="/public/img/_banners/leathers.jpg" alt="">
                        <div class="title">Кожанки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/outerwear/jeans-jackets">
                    <div class="image">
                        <img src="/public/img/_banners/jeans-jackets.jpg" alt="">
                        <div class="title">Джинсовки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/sweaters/hoodies">
                    <div class="image">
                        <img src="/public/img/_banners/hoodies.jpg" alt="">
                        <div class="title">Худи</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/sweaters/sweatshirts">
                    <div class="image">
                        <img src="/public/img/_banners/sweatshirts.jpg" alt="">
                        <div class="title">Свитшоты</div>
                    </div>
                </a>
            </div>

            <div class="slider__item">
                <a href="/categories/pants/jeans">
                    <div class="image">
                        <img src="/public/img/_banners/jeans.jpg" alt="">
                        <div class="title">Джинсы</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/pants/sport-pants">
                    <div class="image">
                        <img src="/public/img/_banners/sport-pants.jpg" alt="">
                        <div class="title">Спортивные штаны</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/pants/pants">
                    <div class="image">
                        <img src="/public/img/_banners/pants.jpg" alt="">
                        <div class="title">Брюки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/sports_suit/">
                    <div class="image">
                        <img src="/public/img/_banners/sport-suit.jpg" alt="">
                        <div class="title">Спортивные костюмы</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/shirts/">
                    <div class="image">
                        <img src="/public/img/_banners/shirts.jpg" alt="">
                        <div class="title">Рубашки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/shoes/">
                    <div class="image">
                        <img src="/public/img/_banners/sneakers.jpg" alt="">
                        <div class="title">Обувь</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/accessories/backpack">
                    <div class="image">
                        <img src="/public/img/_banners/backpack.jpg" alt="">
                        <div class="title">Рюкзаки</div>
                    </div>
                </a>
            </div>
            <div class="slider__item">
                <a href="/categories/accessories/bag">
                    <div class="image">
                        <img src="/public/img/_banners/bag.jpg" alt="">
                        <div class="title">Сумки</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

