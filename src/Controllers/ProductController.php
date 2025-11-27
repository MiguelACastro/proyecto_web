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

    public function store($data, $files) {
        $productModel = new ProductModel(getPDO());

        $mainImageName = uploadImage($files['image'], 'img');

        $carouselImages = transformImageArray($files['images']);
        $carouselImagesNames = [];
        if(isset($carouselImages)) {
            foreach($carouselImages as $image) {
                $carouselImagesNames[] = uploadImage($image, 'img');
            }
        }
        $data['mainImage'] = $mainImageName;
        $data['images'] = $carouselImagesNames;
        $productModel->insert($data);
        return redirect('/admin/products');
    }

    
}