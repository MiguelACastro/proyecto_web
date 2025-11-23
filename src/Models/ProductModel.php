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
                $product = new Product($row['id'], $row['name'], $row['description'], $row['price'], $row['image']);
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

            $product = new Product($productDetails['id'], $productDetails['name'], $productDetails['description'], $productDetails['price'], $productDetails['image']);

            return $product;
        } catch (PDOException $e) {
            error_log('Error al consultar la base de datos: '. $e->getMessage());
            return [];
        }
    }
}