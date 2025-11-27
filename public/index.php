<?php

require __DIR__.'/../src/helpers/functions.php';

use App\Controllers\ProductController;

$route = trim($_GET['route'] ?? '', '/');

$method = $_SERVER['REQUEST_METHOD'];
if($route === '' || $route === 'home') {
    if($method === 'GET') {
        return (new ProductController())->index();
    }
}

if(preg_match('#^products\/(\d+)$#', $route, $matches)) {
    $productId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);

    if($method === 'GET') {
        $productDetails = (new ProductController())->show($productId);
        if($productDetails) {
            return $productDetails;
        }
    }
}

if($route === 'admin/products') {
    if($method === 'GET') {
        return (new ProductController())->adminIndex();
    }
}

if($route === 'admin/products/create') {
    if($method === 'GET') {
        return (new ProductController())->form();
    }
}

if(preg_match('#^admin/products/edit/(\d+)$#', $route, $matches)) {
    $productId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);
    if($method === 'GET') {
        $productEdit = (new ProductController())->form($productId);
        if($productEdit) {
            return $productEdit;
        }
    }
}

http_response_code(404);    
return view('errors/404');