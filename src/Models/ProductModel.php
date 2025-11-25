<?php
require __DIR__.'/Product.php';

class ProductModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        try {
            $query = "SELECT * FROM products";

            $stmt = $this->pdo->query($query);

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];

            foreach($rows as $row) {
                $product = new Product($row['id'], $row['name'], $row['shortDescription'], $row['price'], $row['discount'], $row['category'], $row['mainImage'], null);
                array_push($products, $product);
            }

            return $products;
        }catch (PDOException $e) {
            error_log('Error al consultar la base de datos: '. $e->getMessage());
            return [];
        }
    }

    function find($id) {
        try {
            $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute(['id' => $id]);

            $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$productDetails) {
                return null;
            }

            $sql = "SELECT * FROM product_images WHERE productId = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute(['id' => $id]);
            
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $carrouselImages = [];
            foreach($images as $row) {
                array_push($carrouselImages, $row['filename']);
            }

            $product = new Product($productDetails['id'], $productDetails['name'], $productDetails['description'], $productDetails['price'], $productDetails['discount'], $productDetails['category'], null, $carrouselImages);

            return $product;
        } catch (PDOException $e) {
            error_log('Error al consultar la base de datos: '. $e->getMessage());
            return [];
        }
    }
}