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
        return redirect('admin/products');
    }

    public function update($id, $data, $files) {
        $productModel = new ProductModel(getPDO());

        $current = $productModel->find($id);
        $imageName = $current->mainImage;

        if(!empty($files['image']['name'])) {
            $newImage = uploadImage($files['image'], 'img');

            if($newImage) {
                deleteImage('img' ,$imageName);
                $imageName = $newImage;
            }
        }

        if (isset($data['deletedImages'])) {
            foreach ($data['deletedImages'] as $image) {
                $productModel->deleteProductImage($image);
                deleteImage('img', $image);
            }
        }

        if (!empty($files['images']['name'][0])) {
            $carouselImages = transformImageArray($files['images']);
            foreach($carouselImages as $image) {
                $newImage = uploadImage($image, 'img');
                if ($newImage) {
                    $carouselImagesNames[] = $newImage;
                }
            }
        }
        $data['id'] = $id;
        $data['mainImage'] = $imageName;
        $data['images'] = $carouselImagesNames;
        $productModel->update($data);
        return redirect('admin/products');
    }

    public function delete($id) {
        $productModel = new ProductModel(getPDO());

        $product = $productModel->find($id);
        $mainImageName = $product->mainImage;
        $carouselImagesNames = $product->carrouselImages;

        $success = $productModel->delete($id);
        if($success) {
            deleteImage('img', $mainImageName);
            foreach($carouselImagesNames as $carouselImageName) {
                deleteImage('img', $carouselImageName);
            }
        }
        return redirect('admin/products');
    }

    public function search() {
        $query = $_GET['q'] ?? '';
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 10;
        $offset = ($page - 1) * $limit;

        $productModel = new ProductModel(getPDO());
        $products = $productModel->search($query, $limit, $offset);
        $totalProducts = $productModel->countSearch($query);
        $totalPages = ceil($totalProducts / $limit);

        return view('public/search', [
            'products' => $products,
            'query' => $query,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'limit' => $limit,
            'totalProducts' => $totalProducts
        ]);
    }
}