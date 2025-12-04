<?php
namespace App\Models;

use App\Models\Product;
use PDO;
use PDOException;

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
                $product = new Product($row['id'], $row['name'], $row['description'], $row['shortDescription'], $row['price'], $row['discount'], $row['category'], $row['mainImage'], null);
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

            $product = new Product($productDetails['id'], $productDetails['name'], $productDetails['description'], $productDetails['shortDescription'], $productDetails['price'], $productDetails['discount'], $productDetails['category'], $productDetails['mainImage'], $carrouselImages);

            return $product;
        } catch (PDOException $e) {
            error_log('Error al consultar la base de datos: '. $e->getMessage());
            return [];
        }
    }

    public function insert($data) {
        try {
            $sql = 'INSERT INTO products (name, description, shortDescription, price, discount, category, mainImage) VALUES (?, ?, ?, ?, ?, ?, ?)';

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                $data['name'],
                $data['description'],
                $data['shortDescription'],
                $data['price'],
                $data['discount'],
                $data['category'],
                $data['mainImage']
            ]);

            $productId = $this->pdo->lastInsertId();

            $this->insertImages($productId, $data['images']);

            return $productId;
        } catch (PDOException $e) {
            error_log('Error al insertar el producto: '. $e->getMessage());
            return false;
        }
    }

    public function update($data) {
        try {
            $sql = 'UPDATE products SET name = ?, description = ?, shortDescription = ?, price = ?, discount = ?, category = ?, mainImage = ? WHERE id = ?';

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $data['name'],
                $data['description'],
                $data['shortDescription'],
                $data['price'],
                $data['discount'],
                $data['category'],
                $data['mainImage'],
                $data['id']
            ]);

            if (!empty($data['images'])) {
                $this->insertImages($data['id'], $data['images']);
            }

            return true;
        } catch (PDOException $e) {
            error_log('Error al actualizar el producto: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProductImage($filename) {
        try {
            $sql = "DELETE FROM product_images WHERE filename = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$filename]);
        } catch (PDOException $e) {
            error_log('Error al eliminar imagen del producto: ' . $e->getMessage());
            return false;
        }
    }

    private function insertImages($productId, $images) {
        $sql = 'INSERT INTO product_images (productId, filename) VALUES (?, ?)';
        $stmt = $this->pdo->prepare($sql);

        foreach ($images as $image) {
            $stmt->execute([
                $productId,
                $image
            ]);
        }
    }

    public function delete($id) {
        try {
            $sql = 'DELETE FROM products WHERE id = ?';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log('Error al eliminar el producto: ' . $e->getMessage());
            return false;
        }
    }

    public function search($query, $limit, $offset) {
        try {
            $sql = "SELECT * FROM products WHERE name LIKE :query OR description LIKE :query OR shortDescription LIKE :query LIMIT :limit OFFSET :offset";
            $stmt = $this->pdo->prepare($sql);
            $searchTerm = "%$query%";
            $stmt->bindValue(':query', $searchTerm, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = [];
            foreach($rows as $row) {
                $product = new Product($row['id'], $row['name'], $row['description'], $row['shortDescription'], $row['price'], $row['discount'], $row['category'], $row['mainImage'], null);
                array_push($products, $product);
            }
            return $products;
        } catch (PDOException $e) {
            error_log('Error al buscar productos: ' . $e->getMessage());
            return [];
        }
    }

    public function countSearch($query) {
        try {
            $sql = 'SELECT COUNT(*) FROM products WHERE name LIKE ? OR description LIKE ? OR shortDescription LIKE ?';
            $stmt = $this->pdo->prepare($sql);
            $searchTerm = "%$query%";
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log('Error al contar los productos: ' . $e->getMessage());
            return 0;
        }
    }

    public function getByCategory($category, $limit, $offset) {
        try {
            $sql = "SELECT * FROM products WHERE category = :category LIMIT :limit OFFSET :offset";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = [];
            foreach($rows as $row) {
                $product = new Product($row['id'], $row['name'], $row['description'], $row['shortDescription'], $row['price'], $row['discount'], $row['category'], $row['mainImage'], null);
                array_push($products, $product);
            }
            return $products;
        } catch (PDOException $e) {
            error_log('Error al buscar productos por categoria: ' . $e->getMessage());
            return [];
        }
    }

    public function countCategoryProducts($category) {
        try {
            $sql = 'SELECT COUNT(*) FROM products WHERE category = ?';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$category]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log('Error al contar los productos por categoria: ' . $e->getMessage());
            return 0;
        }
    }

    public function getRandom($limit) {
        try {
            $sql = "SELECT * FROM products ORDER BY RAND() LIMIT :limit";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = [];
            foreach($rows as $row) {
                $product = new Product($row['id'], $row['name'], $row['description'], $row['shortDescription'], $row['price'], $row['discount'], $row['category'], $row['mainImage'], null);
                array_push($products, $product);
            }
            return $products;
        } catch (PDOException $e) {
            error_log('Error al obtener productos: ' . $e->getMessage());
            return [];
        }
    }
}