<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__.'/../src/helpers/functions.php';

use App\Controllers\ProductController;
use App\Controllers\AuthController;

$route = trim($_GET['route'] ?? '', '/');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
}

if(str_starts_with($route, 'admin/')) {
    requireAuth();
}

if($route === 'login') {
    if($method === 'GET') {
        if(isAuth()) {
            redirect('admin/products');
        } else {
            return viewWithoutLayout('auth/login');
        }
    } elseif ($method === 'POST') {
        return (new AuthController())->attemptLogin($_POST['email'], $_POST['password']);
    }
}

if($route === 'logout') {
    if($method === 'GET') {
        return (new AuthController())->logout();
    }
}

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
    } elseif ($method === 'POST') {
        return (new ProductController())->store($_POST, $_FILES);
    }
}

if(preg_match('#^admin/products/edit/(\d+)$#', $route, $matches)) {
    $productId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);
    if($method === 'GET') {
        $productEdit = (new ProductController())->form($productId);
        if($productEdit) {
            return $productEdit;
        }
    } elseif ($method === 'PUT') {
        return (new ProductController())->update($productId, $_POST, $_FILES);
    }
}

if (preg_match('#^admin/products/delete/(\d+)$#', $route, $matches)) {
    $productId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);
    return (new ProductController())->delete($productId);
}

http_response_code(404);    
return view('errors/404');