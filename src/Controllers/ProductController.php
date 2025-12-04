<?php
namespace App\Controllers;

use App\Models\ProductModel;

class ProductController {

    public function index() {
        $productModel = new ProductModel(getPDO());
        $products = $productModel->getRandom(3);
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
        $errors = $this->validate($data, $files);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['oldData'] = $data;
            return redirect('admin/products/create');
        }

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
        $errors = $this->validate($data, $files, $id);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['oldData'] = $data;
            return redirect('admin/products/edit/' . $id);
        }

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
            'totalProducts' => $totalProducts,
            'url' => BASE_PATH . 'search'
        ]);
    }

    public function categoryFilter($categoryName) {
        $categoryName = urldecode($categoryName);
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 10;
        $offset = ($page - 1) * $limit;

        $productModel = new ProductModel(getPDO());
        $products = $productModel->getByCategory($categoryName, $limit, $offset);
        $totalProducts = $productModel->countCategoryProducts($categoryName);
        $totalPages = ceil($totalProducts / $limit);

        return view('public/search', [
            'products' => $products,
            'query' => $categoryName,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'limit' => $limit,
            'totalProducts' => $totalProducts,
            'url' => BASE_PATH . 'category/' . urlencode($categoryName)
        ]);
    }

    private function validate($data, $files, $id = null) {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = "El nombre es obligatorio.";
        } elseif (strlen($data['name']) > 255) {
            $errors[] = "El nombre no puede exceder 255 caracteres.";
        }

        if (empty($data['shortDescription'])) {
            $errors[] = "La descripción corta es obligatoria.";
        } elseif (strlen($data['shortDescription']) > 1023) {
            $errors[] = "La descripción corta no puede exceder 1023 caracteres.";
        }

        if (empty($data['description'])) {
            $errors[] = "La descripción es obligatoria.";
        } elseif (strlen($data['description']) > 65535) {
            $errors[] = "La descripción no puede exceder 65535 caracteres.";
        }

        if (empty($data['price'])) {
            $errors[] = "El precio es obligatorio.";
        } elseif (!is_numeric($data['price']) || $data['price'] < 0) {
            $errors[] = "El precio debe ser un número válido.";
        }

        if (!empty($data['discount'])) {
            if (!is_numeric($data['discount']) || $data['discount'] < 0 || $data['discount'] > 100) {
                $errors[] = "El descuento debe ser un número entre 0 y 100.";
            }
        }
        
        $categories = ['Computación', 'Telefonía', 'TV y Video', 'Audio', 'Videojuegos', 'Energía', 'Herramientas', 'Cables', 'Smart Home'];
        if (empty($data['category'])) {
            $errors[] = "La categoría es obligatoria.";
        } elseif (!in_array($data['category'], $categories)) {
            $errors[] = "La categoría seleccionada no es válida.";
        }

        if (!$id) {
            if (empty($files['image']['name']) || $files['image']['error'] !== UPLOAD_ERR_OK) {
                $errors[] = "La imagen principal es obligatoria.";
            }

            if (empty($files['images']['name'][0]) || $files['images']['error'][0] !== UPLOAD_ERR_OK) {
                $errors[] = "Las imágenes del carrusel son obligatorias.";
            }
        }

        return $errors;
    }
}