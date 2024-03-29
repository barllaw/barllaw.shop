var width = window.innerWidth;
//Mobile

// Slider product   
$('.slider').slick({
    dots: true,
    adaptiveHeight: true
});

$('.slider .slick-prev').text('');
$('.slider .slick-prev').append('<i class="fas fa-angle-left"></i>');
$('.slider .slick-next').text('');
$('.slider .slick-next').append('<i class="fas fa-angle-right"></i>');

if(width < 540){
    $('.main_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: true,            
        autoplay: true,
        autoplaySpeed: 2000,
    });
}

if(width <  415 ){
    $('.desk_fav_btn').remove();
    $('footer').remove();
    $('.main_header').remove();
}
else if(width < 768){
    $('.main_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 2,
        arrows: false,
        dots: true,            
        autoplay: true,
        autoplaySpeed: 2000,
    });
}
else if(width < 1025){
    $('.main_header').remove();
}else{
    $('.mobile_header').remove();
//Desktop
//Show drop menu
const dropMenuBtns = document.querySelectorAll('.drop-menu-btn')
for(let i = 0; i < dropMenuBtns.length; i++){
    const dropMenuBtn = dropMenuBtns[i];
    dropMenuBtn.addEventListener('mouseover', function(){
        const dropMenu = this.querySelector('.drop-menu')
        dropMenu.style.display = 'flex';
    } )
    dropMenuBtn.addEventListener('mouseout', function(){
        const dropMenu = this.querySelector('.drop-menu')
        dropMenu.style.display = 'none';
    } )
}

// Main page banners effect
const banners = document.querySelectorAll('.product-banner')

for(let i = 0; i < banners.length; i++){
    const banner = banners[i];
    banner.addEventListener('mousemove', rotate )
    banner.addEventListener('mouseout', out )
}
function rotate(event){
    const banner_item = this.querySelector('.banner-item')
    const halfHeight = banner_item.offsetHeight / 2;
    const halfWidth = banner_item.offsetWidth / 2;
    const deg = 70;
    banner_item.style.transform = "rotateX("+ -(event.offsetY - halfHeight) / deg +"deg) rotateY("+ (event.offsetX - halfWidth) / deg +"deg)";
}
function out(event){
    const banner_item = this.querySelector('.banner-item')
    banner_item.style.transform = "rotateX(0deg) rotateY(0deg)";
}

//Main slider desk
$('.main_slider').slick({
    slidesToShow: 5,
    slidesToScroll: 2,
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2000,
});

$('.main_slider .slick-prev').text('');
$('.main_slider .slick-prev').append('<i class="fas fa-chevron-left"></i>');
$('.main_slider .slick-next').text('');
$('.main_slider .slick-next').append('<i class="fas fa-chevron-right"></i>');


}
    

// Show error
function showError(message){
    $('#error').css('padding', '10px 15px');
    $('#error').text(message);
}

// Hide error
function hideError(){
    $('#error').css('padding', '0px 15px');
    $('#error').text('');
}

// MOBILE MENU

// Show mobile menu
$("#mobile_btn").click(function(){
    $(".mobile_menu").toggleClass('show_mobile_menu')
    $(".nav").toggleClass('show_nav')
    $("body").toggleClass('over_hide')
})

// Close mobile menu
$('.mobile_menu_bg').click(function(){
    $(".mobile_menu").toggleClass('show_mobile_menu')
    $(".nav").toggleClass('show_nav')
    $("body").toggleClass('over_hide')
    $(".burger i").toggle()
})

$(".burger").click(function(){
    $(".burger i").toggle()
})

//show user menu
$('#user_menu_btn').click(function(){
    $('.left-side ul').toggleClass('show-user-menu')
})

//show nav cat
$('#cat-mobile-btn').click(function(){
    $('.nav-cat').toggleClass('show-nav-cat')
})

//sub cat
let sub_cat = $("#sub_cat");
$('#category').change(function(){
    if($(this).val() == 'outerwear'){
        //Outerwear
        $(sub_cat).html(`
            <option value="none">Не выбрано</option>
            <option value="winter-jackets">Зимние куртки</option>
            <option value="coats">Пальта</option>
            <option value="jackets">Куртки</option>
            <option value="leather-jackets">Кожанки</option>
            <option value="jeans-jackets">Джинсовки</option>
            <option value="bombers">Бомберы</option>  
        `)}
    else if($(this).val() == 'sweaters'){
        //Sweaters
        $(sub_cat).html(`
            <option value="none">Не выбрано</option>
            <option value="hoodies">Худи</option>
            <option value="sweatshirts">Свитшоты</option>
    `)}
    else if($(this).val() == 'pants'){
        //Pants
        $(sub_cat).html(`
            <option value="none">Не выбрано</option>
            <option value="jeans">Джинсы</option>
            <option value="sport-pants">Спорт штаны</option>
            <option value="pants">Брюки</option>
    `)}
    else if($(this).val() == 'shoes'){
        //shoes
        $(sub_cat).html(`
            <option value="none">Не выбрано</option>
            <option value="sneakers">Кроссовки</option>
            <option value="nike">Nike</option>
            <option value="adidas">Adidas</option>
            <option value="new-balance">New balance</option>
    `)
        $("#size").html(`
            <span><input type="checkbox" class="size" checked value="40"> 40</span>
            <span><input type="checkbox" class="size" checked value="41"> 41</span>
            <span><input type="checkbox" class="size" checked value="42"> 42</span>
            <span><input type="checkbox" class="size" checked value="43"> 43</span>
            <span><input type="checkbox" class="size" checked value="44"> 44</span>
            <span><input type="checkbox" class="size" checked value="45"> 45</span>
        `)
}
    else if($(this).val() == 'sports_suit'){
        //Sports_suit
        $(sub_cat).html(`
            <option value="">Нету</option>
    `)}
    else if($(this).val() == 'shirts'){
        //shirts
        $(sub_cat).html(`
            <option value="">Нету</option>
    `)}
    else if($(this).val() == 'accessories'){
        //accessories
        $(sub_cat).html(`
            <option value="">none</option>
            <option value="backpack">Рюкзаки</option>
            <option value="bag">Сумки</option>
    `)
    }
})
$(sub_cat).change(function(){
    if($('#category').val() == 'shoes'){
        if( $(this).val() != 'sneakers' && $(this).val() != 'none' ){
            $('#target_cat').val($(this).val())
            $(this).val('sneakers')
        }
    }
    if($(sub_cat).val() == 'pants' || $(sub_cat).val() == 'jeans'){
        $("#size").html(`
            <span><input type="checkbox" class="size" checked value="29"> 29</span>
            <span><input type="checkbox" class="size" checked value="30"> 30</span>
            <span><input type="checkbox" class="size" checked value="31"> 31</span>
            <span><input type="checkbox" class="size" checked value="32"> 32</span>
            <span><input type="checkbox" class="size" checked value="33"> 33</span>
            <span><input type="checkbox" class="size" checked value="34"> 34</span>
            <span><input type="checkbox" class="size" checked value="35"> 35</span>
            <span><input type="checkbox" class="size" checked value="36"> 36</span>
    `)
    }else if ($('#category').val() != 'shoes'){
        $("#size").html(`
            <span><input type="checkbox" class="size" checked value="XS"> XS</span>
            <span><input type="checkbox" class="size" checked value="S"> S</span>
            <span><input type="checkbox" class="size" checked value="M"> M</span>
            <span><input type="checkbox" class="size" checked value="L"> L</span>
            <span><input type="checkbox" class="size" checked value="XL"> XL</span>
            <span><input type="checkbox" class="size" value="XXL"> XXL</span>
    `)
    }
})

//style input change
$('#images').change(function() {
    if ($(this).val() != '') {
        $(this).prev().text('Выбрано файлов: ' + $(this)[0].files.length).addClass('success_image')
    }
    else {
        $(this).prev().text('Добавить...').removeClass('success_image');
    };
});

$('#new_product_form input[type="text"]').change(function(){
    $(this).removeClass('require');
})
$('#new_product_form select').change(function(){
    $(this).removeClass('require');
})

//Search animation

const searchBtn = $('.search-btn')
const cancelBtn = $('.cancel-btn')
const searchBox = $('.search-box')

$('.show-search-btn').click(function(){
    $('.search-box').addClass('active');
    $('.search-box input').addClass('active');
    $('.search-box .search-btn').addClass('active');
    $('.search-box .cancel-btn').addClass('active');
    $(this).addClass('active');
})
$('.search-box .cancel-btn').click(function(){
    $('.search-box').removeClass('active');
    $('.search-box input').removeClass('active');
    $('.search-box .search-btn').removeClass('active');
    $(this).removeClass('active');
    $('.show-search-btn').removeClass('active');
})
//Mask for phone
$('#phone').mask("+380 (99) 999-99-99");
//Validate poshta input
document.querySelector('#poshta').addEventListener('keyup', function(){
    this.value = this.value.replace(/[^\d]/g, '');
});
