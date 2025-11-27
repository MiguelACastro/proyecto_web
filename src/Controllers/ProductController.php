<?php
namespace App\Controllers;

use App\Models\ProductModel;

class ProductController {

    public function index() {
        $productModel = new ProductModel(getPDO());
        $products = $productModel->all();
        return view('home/index', ['products' => $products]);
    }

    public function adminIndex() {
        $productModel = new ProductModel(getPDO());
        $products = $productModel->all();
        return view('admin/index', ['products' => $products]);
    }

    public function show($id) {
        $productModel = new ProductModel(getPDO());
        $product = $productModel->find($id);
        if($product) {
            return view('public/producto', ['product' => $product]);
        } else {
            return false;
        }
    }
    public function form($id = null) {
        $productModel = new ProductModel(getPDO());
        $product = [];
        if($id) {
            $product = $productModel->find($id);
            if(!$product) {
                return false;
            }
        }
        return view('admin/form', ['product'=> $product]);
    }
}