<?php

    require_once __DIR__. '/../../Models/Product.php';
    require_once __DIR__. '/../../../config/database.php';

class ProductController{

    private $product;

    public function __construct(){
        $db = new Database();
        $pdo = $db->connect();
        $this->product = new Product($pdo);
    }

    public function index(){
        return $this->product->findActiveProduct();
    }

    public function show($id){
        return $this->product->findById($id);
    }

    public function showBySlug($slug){
        return $this->product->findBySlug($slug);
    }

    public function related($categoryId,$productId){
        return $this->product->findRelatedProduct($categoryId,$productId);
    } 
    public function cartProducts($ids){
        return $this->product->findByIds($ids);
    }
}







?>