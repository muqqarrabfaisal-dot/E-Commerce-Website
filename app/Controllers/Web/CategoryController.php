<?php

require_once __DIR__ . '/../../Models/Category.php';
require_once __DIR__ . '/../../../config/database.php';

class CategoryController{
    private $category;

    public function __construct() {
        $db = new Database();
        $pdo = $db->connect();
        $this->category = new Category($pdo);
    }

    public function index(){
        return $this->category->findAll();
    }

    public function show($id){
        return $this->category->findById($id);
    }

    public function showBySlug($slug){
        return $this->category->findBySlug($slug);
    }

}






?>