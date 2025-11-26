<?php
namespace App\Models;
class Product {
    public $id;
    public $name;
    public $description;
    public $price;
    public $discount;
    public $category;
    public $mainImage;
    public $carrouselImages;

    public function __construct($id, $name, $description, $price, $discount, $category, $mainImage, $carrouselImages) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
        $this->category = $category;   
        $this->mainImage = $mainImage;
        $this->carrouselImages = $carrouselImages;
    }
}