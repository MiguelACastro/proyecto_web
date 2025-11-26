<?php

require __DIR__.'/../src/helpers/functions.php';
require __DIR__.'/../src/Models/ProductModel.php';

$route = trim($_GET['route'] ?? '', '/');

$method = $_SERVER['REQUEST_METHOD'];
if($route === '' || $route === 'home') {
    if($method === 'GET') {
        $productModel = new ProductModel(getPDO());
        $products = $productModel->all();
        return view('home/index', ['products' => $products]);
    }
}

if(preg_match('#^products\/(\d+)$#', $route, $matches)) {
    $productId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);

    if($method === 'GET') {
        $productModel = new ProductModel(getPDO());
        $product = $productModel->find($productId);
        if($product) {
            return view('producto', ['product' => $product]);
        }
    }
}

http_response_code(404);    
return view('errors/404');