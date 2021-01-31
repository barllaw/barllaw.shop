<?php
require 'DB.php';


class Categories extends Controller
{
    
    public function index($id = '')
    {
        $products = $this->model('Products');

        if($_POST['search']){
            exit($products->getIdWithArt($_POST['art']));
        }

        if($_POST['hide']){
            $products->hideProduct($_POST['product_id']);
        }
        if($_POST['availability']){
            $products->availability($_POST['product_id']);
        }
        if($_POST['not_availability']){
            $products->notAvailability($_POST['product_id']);
        }
        if($_POST['delete_product']){
            $files = $products->getProductFiles($_POST['product_id']);
            exit($products->deleteProduct( $_POST['product_id'], $files, $_POST['dir'] ));
        }
        if($_POST['active_product']){
            exit($products->activeProduct($_POST['product_id']));
        }
        if($_POST['add_supplier']){
            $products->addSupplier($_POST['supplier']);
        }
        if($_POST['delete_supplier']){
            $products->deleteSupplier($_POST['supplier']);
        }

        $data['page'] = 'clothes';
        $data['title'] = 'Одежда';
        $this->view('categories/index', $data);


        
    }
    
    public function outerwear($par = '', $second_par = '')
    {
    
        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('outerwear'),
            'title' => 'Верхняя одежда',
            'favorite' => [],
            'page' => 'Верхняя одежда',
        ];
            
        if($par != ''){
            if( $par == 'winter-jackets')
                $data['title'] = 'Зимние куртки';
            if( $par == 'coats')
                $data['title'] = 'Пальта';
            if( $par == 'jackets')
                $data['title'] = 'Куртки';
            if( $par == 'leather-jackets')
                $data['title'] = 'Кожанки';
            if( $par == 'jeans-jackets')
                $data['title'] = 'Джинсовки';
            $data['products']  = $products->getProductsSubCat($par);
        }
        if($second_par != ''){
            $data['products'] = $products->getProductsTargetCat($second_par);
            if( $second_par == 'tnf')
                $data['title'] = 'The North Face';
            }
        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }
                
        $this->view('categories/index', $data);

    }
    public function sweaters($par = '')
    {

        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('sweaters'),
            'title' => 'Кофты, худи',
            'favorite' => [],
            'page' => 'Кофты, худи',
        ];

        if($par != '')
            $data['products'] = $products->getProductsSubCat($par);

        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }

        $this->view('categories/index', $data);
    }

    public function pants($par = '')
    {

        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('pants'),
            'title' => 'Штаны',
            'favorite' => [],
            'page' => 'Штаны',
        ];

        if($par != '')
            $data['products'] = $products->getProductsSubCat($par);

        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }

        $this->view('categories/index', $data);
    }

    public function sports_suit()
    {

        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('sports_suit'),
            'title' => 'Спортивные костюмы',
            'favorite' => [],
            'page' => 'Спортивные костюмы',
        ];
        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }
        $this->view('categories/index', $data);
    }
    
    public function shirts()
    {
        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('shirts'),
            'title' => 'Рубашки',
            'favorite' => [],
            'page' => 'Рубашки',
        ];
        
        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }
        $this->view('categories/index', $data);
    }



    public function shoes($par = '', $second_par = '')
    {

        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('shoes'),
            'title' => 'Обувь',
            'favorite' => [],
            'page' => 'Обувь',
        ];
    
        if($par != '')
            $data['products']  = $products->getProductsSubCat($par);
        
        if($second_par != '')
            $data['products'] = $products->getProductsTargetCat($second_par);
        
        
        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }
    
        $this->view('categories/index', $data);

    }

    public function accessories($par = '', $second_par = '')
    {

        $products = $this->model('Products');
        $data = [
            'products' => $products->getProductsCategory('accessories'),
            'title' => 'Аксессуары',
            'favorite' => [],
            'page' => 'Аксессуары',
        ];
    
        if($par != '')
            $data['products']  = $products->getProductsSubCat($par);
        
        if($second_par != '')
            $data['products'] = $products->getProductsTargetCat($second_par);

    
        if(isset($_COOKIE['login'])){
            $data['favorite'] = $this->checkFavoriteProduct($data['products']);
        }

        $this->view('categories/index', $data);

    }

    public function checkFavoriteProduct($array)
    {
        $products = $this->model('Products');
        $user = $this->model('UserModel');
        $data['user'] = $user->setAuth($_COOKIE['login']);

        $fav_result = [];
        foreach ($array as $key ) {
            $result = $products->favExist($key['id'], $data['user']['id']);
            if($result != []){
                $fav_result[] = $key['id'];
            }
        }
        return $fav_result;
    }
}