<header>

    <div class="container mobile_header">
        <div class="header_left">

            <div class="burger" id="mobile_btn">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>


            <div class="logo">
                <a href="/"><img src="/public/img/logo_transparent.png" alt=""></a>
            </div>
        </div>

        <div class="user-wrap">
            <div class="search-box">

                <input id='search_art' type="text" placeholder='Поиск по артикулу...'>

                <div class="show-search-btn"><i class="fas fa-search"></i></div>
                <div class="search-btn" id='search_btn'><i class="fas fa-search"></i></div>
                <div class="cancel-btn"><i class="fas fa-times"></i></div>

            </div>
            <a href="/basket"><i class="fas fa-shopping-cart"></i></a>
            <?php 
                if($_COOKIE['login']){
                    echo '<a href="/user/dashboard/favorites"><i class="fas fa-heart"></i></a>';
                }
            ?>
            <a href="/user/dashboard"><i class="fas fa-user"></i></a>
        </div>
    </div>



    <div class="container main_header">

        <div class="logo">
            <a href="/"><img src="/public/img/logo_transparent.png" alt=""></a>
            <div class="nav">
                <div class="menu">
                    <ul>
                        <li class="drop-menu-btn">
                            <a href="/categories/">
                                Одежда
                            </a>
                            <div class="drop-menu container">
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/outerwear">Верхняя одежда</a></div>   
                                    <p class=""><a href="/categories/outerwear/winter-jackets">Зимние куртки</a></p>   
                                    <p class=""><a href="/categories/outerwear/coats">Пальта</a></p>   
                                    <p class=""><a href="/categories/outerwear/jackets">Куртки</a></p>   
                                    <p class=""><a href="/categories/outerwear/leather-jackets">Кожанки</a></p>   
                                    <p class=""><a href="/categories/outerwear/jeans-jackets">Джинсовки</a></p>   
                                </div>
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/sweaters">Кофты, худи</a></div>
                                    <p><a href="/categories/sweaters/hoodies">Худи</a></p>
                                    <p><a href="/categories/sweaters/sweatshirts">Свитшоты</a></p>
                                </div>
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/pants">Штаны</a></div>
                                    <p><a href="/categories/pants/jeans">Джинсы</a></p>
                                    <p><a href="/categories/pants/sport-pants">Спортивные штаны</a></p>
                                    <p><a href="/categories/pants/pants">Брюки</a></p>
                                </div>
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/sports_suit">Спортивные костюмы</a></div>
                                </div>
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/shirts">Рубашки</a></div>
                                </div>
                            </div>
                        </li>
                        <li class="drop-menu-btn">
                            <a href="/categories/shoes">
                                Обувь
                            </a>
                            <div class="drop-menu container">
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/shoes">Обувь</a></div>   
                                    <p class=""><a href="/categories/shoes/sneakers">Кроссовки</a></p>   
                                    <p class=""><a href="/categories/shoes/sneakers/nike">Nike</a></p>   
                                    <p class=""><a href="/categories/shoes/sneakers/adidas">Adidas</a></p>   
                                    <p class=""><a href="/categories/shoes/sneakers/new-balance">New Balance</a></p>   
                                </div>
                            </div>
                        </li>
                        <li class="drop-menu-btn">
                            <a href="/categories/accessories">
                                Аксессуары
                            </a>
                            <div class="drop-menu container">
                                <div class="">
                                    <div class="drop-menu-title"><a href="/categories/accessories/backpack">Рюкзаки</a></div>
                                    <div class="drop-menu-title"><a href="/categories/accessories/bag">Сумки</a></div>
                                </div>
                            </div>
                        </li>
                    </ul>   
                </div>
            </div>
        </div>
        <div class="user-wrap">
            <div class="search-box">

                <input id='search_art' type="text" placeholder='Поиск по артикулу...'>

                <div class="show-search-btn"><i class="fas fa-search"></i></div>
                <div class="search-btn" id='search_btn'><i class="fas fa-search"></i></div>
                <div class="cancel-btn"><i class="fas fa-times"></i></div>

            </div>
            <a href="/basket" class='basket_icon'>
                <i class="fas fa-shopping-cart"></i>
                <?php 
                if(isset($_SESSION['cart']))
                    if(count($_SESSION['cart']) > 0 ):?>
                <span><?=count($_SESSION['cart'])?></span>
                <?php endif;?>
            </a>
            <?php 
                if($_COOKIE['login']){
                    echo '<a href="/user/dashboard/favorites"><i class="fas fa-heart"></i></a>';
                }
            ?>
            <a href="/user/dashboard"><i class="fas fa-user"></i></a>
        </div>

        <div class="social">
            <a href="https://www.instagram.com/barllaw.shop/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>

    </div>
</header>
<?php require_once 'public/blocks/mobile_menu.php'; ?>
