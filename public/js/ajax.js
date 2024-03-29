function validInput(input, empty = true, no_short = 2, no_more = 18){
    if(empty){
        result = input.length != '' && (input.length <= no_short || input.length >= no_more);
    }else{
        result = input.length <= no_short || input.length >= no_more;
    }
    return result;
}

//Validate Email
function validateEmail(mail) 
{
if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail))
{
    return (false)
}
    return (true)
}

// Add to cart 
$('#add_to_cart').click(function(e){
    e.preventDefault();

    title = $('#product_title').text();
    img_path = $('#product_img').val();
    art = $('#art').text();
    color = $('#color').text();
    size = $('#size').val();
    price = $('#product_price').text();
    item_id = $('#product_id').val();
    supplier = $('#supplier').val();
    
    if(size == 'none'){
        $('select').css('border', '1px solid #ff6161');
    }
    else{
        $.ajax({
            url: '/basket/',
            type: 'POST',
            data: {
                'title': title, 
                'img_path': img_path, 
                'art': art, 
                'color': color, 
                'size': size,
                'price': price,
                'item_id': item_id,
                'supplier': supplier
            },
            success: function(response){
                if($('.basket_icon span').text() == ''){
                    $('.basket_icon').append('<span>1</span/')
                }else{
                    currentItem = Number($('.basket_icon span').text());
                    countItem = currentItem + 1;
                    $('.basket_icon span').text(countItem)
                }
                $('#add_to_cart').css('background', '#62d07a');
                $('select').css('border', '1px solid #00000050');
                $('#add_to_cart').text('Добавлен');
            }
    
        })
    }
})

// Delete item from cart
var btn = document.querySelectorAll('#btn_deleteItem');
var deleteItem = document.querySelectorAll('#deleteItem');
for( let i = 0; i < btn.length; i++ ){
    $(btn[i]).click(function(){
        $.ajax({
        url: '/basket/',
        type: 'POST',
        data: {
            'deleteItem': i, 

        },
        success: function(response){
            document.location.reload();
        }

        })
    })
}

// Registration
$('#reg_btn').click(function(e){
    e.preventDefault();

    user_name = $('#name').val();
    login = $('#login').val();
    pass = $('#pass').val();
    re_pass = $('#re_pass').val();

    function validForm(){

        if(validInput(user_name, false))
            {return 'Имя должно содержать не менее 3 и не больше 18 символов';}
        if(validInput(login, false, 4, 18))
            {return 'Логин должен содержать не менее 5 и не больше 18 символов';}
        if(validInput(pass, false, 5, 18))
            {return 'Пароль должен содержать не менее 6 и не больше 18 символов';}
        if(re_pass != pass )
            {return 'Пароли не совпадают';}
        
        return 'ok';
    }

        if(validForm() != 'ok'){
            showError(validForm());
            return;
        }
    $.ajax({
        url: '/user/reg',
        type: 'POST',
        data: {
            'reg': true,
            'login': login, 
            'name': user_name, 
            'pass': pass
        },
        success: function(response){

            if(response == 'ok'){
                $(location).attr('href','/');
            }else{
                showError(response);
            }

        }

    })
})

// Auth
$('#auth_btn').click(function(e){
    e.preventDefault();
    login = $('#login').val();
    pass = $('#pass').val();

    function validForm(){
        if(login == '')
            {return 'Введите логин';}
        if(pass == '')
            {return 'Введите пароль';}
        return 'ok';
    }

    if(validForm() != 'ok'){
        showError(validForm());
        return;
    }

    $.ajax({
        url: '/user/auth',
        type: 'POST',
        data: {
            'auth': true,
            'login': login, 
            'pass': pass
        },
        success: function(response){

            if(response != 'ok'){
                showError(response);
            }else{
                $(location).attr('href','/');
            }

        }

    })
})

// Update details
$('#save_details').click(function(e){
    e.preventDefault();

    id = $('#id').val();
    login = $('#login').val();
    user_name = $('#name').val();
    lastname = $('#lastname').val();
    father = $('#father').val();
    email = $('#email').val();
    phone = $('#phone').val();
    city = $('#city').val();
    instagram = $('#instagram').val();

    phone = phone.replace('+380', '')
    instagram = instagram.replace('@', '')

    

    function validForm(){

        if(validInput(login))
            {return 'Логин должен содержать не менее 5 и не больше 18 символов';}
        if(validInput(user_name))
            {return 'Имя должно содержать не менее 3 и не больше 18 символов';}
        if(validInput(lastname))
            {return 'Фамилия должна содержать не менее 3 и не больше 18 символов';}
        if(validInput(father))
            {return 'Отчество должно содержать не менее 3 и не больше 18 символов';}
        if(email != ''){
            if(validateEmail(email))
                {return 'Введите корректный Email';}
        }
        if(validInput(city))
            {return 'Город должен содержать не менее 3 и не больше 18 символов';}
        if(validInput(instagram))
            {return 'Instagram должен содержать не менее 3 и не больше 18 символов';}
        return 'ok';
    }

        if(validForm() != 'ok'){
            showError(validForm());
            return;
        }

        hideError();

        $.ajax({
        url: '/user/dashboard',
        type: 'POST',
        data: {
            'update': true, 
            'id': id, 
            'login': login, 
            'name': user_name, 
            'lastname': lastname, 
            'father': father, 
            'email': email,
            'phone': phone,
            'city': city,
            'instagram': instagram
        },
        success: function(response){
            $('#error').css("background", "#09a709bf")
            $('#error').css("padding", "10px 15px")
            $('#error').text("Сохранено")
        }

    })
})

// Change status
let status_btn = document.querySelectorAll('#change_status');
let order_id = document.querySelectorAll('#order_id');
let status = document.querySelectorAll('#status');

for( let i = 0; i < status_btn.length; i++ ){
    $(status_btn[i]).click(function(){

        id = $(order_id[i]).text();
        status = $(status[i]).val();

        $.ajax({
        url: '/user/dashboard',
        type: 'POST',
        data: {
            'change_status': true,
            'order_id': id,
            'status': status

        },
        success: function(response){
            document.location.reload();
        }

        })
    })
}

// New order
$('#new_order').click(function(e){
    e.preventDefault();

    user_id = $('#user_id').val();
    user_name = $('#name').val();
    lastname = $('#lastname').val();
    father = $('#father').val();
    phone = $('#phone').val();
    city = $('#city').val();
    poshta = $('#poshta').val();
    email = $('#email').val();
    instagram = $('#instagram').val();

    function validForm(){

        if(validInput(user_name, false))
            {return 'Имя должно содержать не менее 3 и не больше 18 символов';}
        if(validInput(lastname, false))
            {return 'Фамилия должна содержать не менее 3 и не больше 18 символов';}
        if(validInput(father, false))
            {return 'Отчество должно содержать не менее 3 и не больше 18 символов';}
        if(email != ''){
            if(validateEmail(email))
                {return 'Введите корректный Email';}
        }
        if(validInput(city, false))
            {return 'Город должен содержать не менее 3 и не больше 18 символов';}
        if(poshta == '')
            {return 'Укажите отделение Новой Почты';}
        if(validInput(instagram, false))
            {return 'Instagram должен содержать не менее 3 и не больше 18 символов';}
        return 'ok';
    }

        if(validForm() != 'ok'){
            showError(validForm());
            return;
        }

        hideError();

        $.ajax({
        url: '/basket/checkout',
        type: 'POST',
        data: {
            'new_order': true, 
            'user_id': user_id, 
            'name': user_name, 
            'lastname': lastname, 
            'father': father, 
            'phone': phone,
            'city': city,
            'poshta': poshta,
            'email': email,
            'instagram': instagram
        },
        success: function(response){
            if(response == 'ok'){
                $(location).attr('href','/basket/success/');
            }else{
                $('#error').text(response)
            }
        }

    })
})


//Favorites

let btn_fav = document.querySelectorAll('.favorite_btn');
let product_img = document.querySelectorAll('#product_img');
let product_id = document.querySelectorAll('#product_id');
let product_title = document.querySelectorAll('#product_title');
let product_price = document.querySelectorAll('#product_price');

for (let i = 0; i < btn_fav.length; i++) {
    
    
    $(btn_fav[i]).click(function(){
        
        let id = $(product_id[i]).val();
        
        // Add to favorites
        if(btn_fav[i].id == 'add_to_favorites'){
            
            let img = $(product_img[i]).val();
            let title = $(product_title[i]).text();
            let price = $(product_price[i]).text();
    
            $.ajax({
            url: '/basket/',
            type: 'POST',
            data: {
                'add_to_fav': true, 
                'product_img': img, 
                'product_id': id, 
                'product_title': title, 
                'product_price': price
            },
            success: function(response){
                location.reload();
            }
        
            })

        }else if(btn_fav[i].id == 'remove_favorite'){

            // Remove favorite
            $.ajax({
            url: '/basket/',
            type: 'POST',
            data: {
                'remove_fav': true, 
                'product_id': id, 
            },
            success: function(response){
                document.location.reload();
            }
        
            })

        }
    })

}

// New product
$('#new_product').click(function(e){
    e.preventDefault();
    formData = new FormData();

    size_array = document.querySelectorAll(".size:checked");
    for(let i = 0; i < size_array.length; i++){
        if(i == 0){
            size = size_array[i].value;
        }else{
            size += ',' + size_array[i].value;
        }
    }

    title = $('#title').val()
    art = $('#art').val()
    material = $('#material').val()
    made_in = $('#made_in').val()
    temp = $('#temp').val()
    more_param = $('#more_param').val()
    color = $('#color').val()
    img = $('#images')[0].files;
    price = $('#price').val()
    category = $('#category').val()
    sub_cat = $('#sub_cat').val()
    target_cat = $('#target_cat').val()
    supplier = $('#supplier').val()


    function validateProduct(){
        if(img.length == 0){
            return 'Добавьте фото';
        }
        if(title == ''){
            return 'Введите название';
        }
        if(art == ''){
            return 'Введите артикул';
        }
        if(price == ''){
            return 'Введите цену';
        }
        if(category == 'none'){
            return 'Введите категорию';
        }
        if(sub_cat == 'none'){
            return 'Введите саб категорию';
        }
        if(supplier == 'none'){
            return 'Введите поставщика';
        }
        return 'ok';
    }

    if(validateProduct() != 'ok'){
        showError(validateProduct())
        return;
    }

    formData.append('new_product', true);
    formData.append('title', title);
    formData.append('art', art);
    formData.append('material', material);
    formData.append('made_in', made_in);
    formData.append('temp', temp);
    formData.append('more_param', more_param);
    formData.append('color', color);
    formData.append('size', size);
    formData.append('price', price);
    formData.append('category', category);
    formData.append('sub_cat', sub_cat);
    formData.append('target_cat', target_cat);
    formData.append('supplier', supplier);
    $.each($('#images')[0].files, function(i, file){
        formData.append('images[]', file);
    })

    $.ajax({
        url: '/product/addProduct',
        type: 'POST',
        data: formData,
        chache: false,
        contentType: false,
        processData: false,
        success: function(response){
            if(response == 'ok'){
                location.reload();
            }else{
                console.log(response);
            };
        }
        
    })
    
})

$('#search_btn').click(function(){
    
    art = $('#search_art').val();

    if(art == ''){
        $('#search_art').css('border-bottom', '2px solid #ff6161');
        return;
    }

    $.ajax({
        url: '/categories/',
        type: 'POST',
        data: {
            'search': true,
            'art': art
        },
        chache: false,
        success: function(response){
            if(response != ''){
                $(location).attr('href','/product/'+response);
            }else{
                $('.content').html(`
                <div class='notfound_product'>
                    <h2><i class="fas fa-tshirt"></i></h2>
                    <h3>Товар не найдено</h3>
                    <a href="/">На главную</a>
                </div>
                `)
            }
        }
        
    })
    
})

// Hide product
let btn_hide = document.querySelectorAll('#hide_product_btn');
for(let i = 0; i < btn_hide.length; i++){
    $(btn_hide[i]).click(function(){
        id = product_id[i].value;

        $.ajax({
            url: '/categories/',
            type: 'POST',
            data: {
                'hide': true,
                'product_id': id
            },
            chache: false,
            success: function(response){
                location.reload();
            }
            
        })
    })
}

// Not availability
let btn_not_availability = document.querySelectorAll('#not_availability');
for(let i = 0; i < btn_not_availability.length; i++){
    $(btn_not_availability[i]).click(function(){
        id = product_id[i].value;
        $.ajax({
            url: '/categories/',
            type: 'POST',
            data: {
                'not_availability': true,
                'product_id': id
            },
            chache: false,
            success: function(response){
                location.reload();
            }
            
        })
    })
}
// Availability
let btn_availability = document.querySelectorAll('#availability');
let not_avai_product_id = document.querySelectorAll('.not_availability #product_id');
for(let i = 0; i < btn_availability.length; i++){
    $(btn_availability[i]).click(function(){
        id = not_avai_product_id[i].value;
        $.ajax({
            url: '/categories/',
            type: 'POST',
            data: {
                'availability': true,
                'product_id': id
            },
            chache: false,
            success: function(response){
                location.reload();
            }
            
        })
    })
}

// Delete product
let delete_product_btn = document.querySelectorAll('#delete_product');
let img_src = document.querySelectorAll('.product-wrap img');
for(let i = 0; i < delete_product_btn.length; i++){
    $(delete_product_btn[i]).click(function(){
        id = product_id[i].value;
        dir = img_src[i].src.slice(18, -1);
        $.ajax({
            url: '/categories/',
            type: 'POST',
            data: {
                'delete_product': true,
                'product_id': id,
                'dir': dir
            },
            chache: false,
            success: function(response){
                if(response == 'ok'){
                    location.reload();
                }else{
                    console.log(response);
                }
            }
            
        })
    })
}

// Active product
let active_product = document.querySelectorAll('#active_product');
let hidden_product_id = document.querySelectorAll('#product_id');
for(let i = 0; i < active_product.length; i++){
    $(active_product[i]).click(function(){
        id = $(hidden_product_id[i]).text();
        $.ajax({
            url: '/categories/',
            type: 'POST',
            data: {
                'active_product': true,
                'product_id': id
            },
            chache: false,
            success: function(response){
                if(response == 'ok'){
                    location.reload();
                }else{
                    console.log(response);
                }
            }
            
        })
    })
}
