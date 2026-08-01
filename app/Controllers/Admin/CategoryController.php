<?php

    require_once __DIR__. '/../../Models/Category.php';
    require_once __DIR__. '/../../../config/database.php';

class CategoryController{

    private $category;

    public function __construct() {
        $db = new Database();
        $pdo = $db->connect();
        $this->category = new Category($pdo);
    }

    public function storeCategory(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] !=='POST') {
            return;
        }

        $categoryName = trim($_POST['category_name']);
        $description = trim($_POST['description']);
        $status = trim($_POST['status']);

        if (empty($categoryName) || empty($description) || empty($status)) {
            $_SESSION['error'] = "All Field Are Required";
            return;
        }
        
        $slugName = strtolower($categoryName);
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slugName);
        $slug = trim($slug, "-");

        $resultSlug = $this->category->findBySlug($slug);

        if ($resultSlug) {
            $_SESSION['error'] = "This Category already exists";
            header("Location: category.php");
            exit;
        }

        $data = [
           'category_name' => $categoryName,
           'slug' => $slug,
            'description' => $description,
            'status' => $status
        ];

        $result = $this->category->storeCategory($data);

        if ($result) {
            return [
                'success' => true,
                'message' => "Category Created Successfully"
            ];
        }else {
            return [
                'success' => false,
                'message' => "Category creation Failed"
            ];
        }
    }

    public function getCategories(){
        $result = $this->category->findAll();
        return $result;
    }
    


}



?>