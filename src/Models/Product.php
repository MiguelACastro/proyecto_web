<?php
namespace App\Models;
class Product {
    public $id;
    public $name;
    public $description;
    public $shortDescription;
    public $price;
    public $discount;
    public $category;
    public $mainImage;
    public $carrouselImages;

    public function __construct($id, $name, $description, $shortDescription, $price, $discount, $category, $mainImage, $carrouselImages) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->shortDescription = $shortDescription;
        $this->price = $price;
        $this->discount = $discount;
        $this->category = $category;   
        $this->mainImage = $mainImage;
        $this->carrouselImages = $carrouselImages;
    }
}