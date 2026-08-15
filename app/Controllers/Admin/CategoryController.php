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
        
        if ($_SERVER['REQUEST_METHOD'] !=='POST') {
            return;
        }

        $categoryName = trim($_POST['category_name']);
        $description = trim($_POST['description']);
        $status = trim($_POST['status']);

        if (empty($categoryName) || empty($description) || empty($status)) {
            return[
                'success' => false,
                'message' => "all field are required"
            ];
        }
        
        $slugName = strtolower($categoryName);
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slugName);
        $slug = trim($slug, "-");

        $resultSlug = $this->category->findBySlug($slug);

        if ($resultSlug) {
            return [
                'success' => false,
                'message' => "This Category already excists "
            ];
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
    public function updateCategory(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $id = (int)$_POST['id'];
        $categoryName = trim($_POST['category_name']);
        $description = trim($_POST['description']);
        $status = (int)$_POST['status'];

        if (empty($categoryName) || empty($description) ) {
            return[
                'success' => false,
                'message' => "All Fields Are Required"
            ];
        }

        $slug = strtolower($categoryName);
        $slug = preg_replace("/[^a-z0-9]+/i","-",$slug);
        $slug = trim($slug,"-");

        $resultslug = $this->category->findBySlugExceptId($id,$slug);

        if ($resultslug) {
            return [
                'success' => false,
                'message' => "This Category Aleready Excists"
            ];
        }

        $data = [
            'id' => $id,
            'category_name' => $categoryName,
            'slug' => $slug,
            'description' => $description,
            'status' => $status

        ];

        $result = $this->category->updateCategory($data);

        if ($result) {
            return [
                'success' => true,
                'message' => "Data Updated Successfully"
            ];            
        }else {
            return [
                'success' => false,
                'message' => "Updated  Failed"
            ];
        }

    }

    public function deleteCategory(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        if (!isset($_POST['id'])) {
            return[
                'success' => false,
                'message' => 'invailed request'
            ];
        }

        $id = (int)$_POST['id'];

        $result = $this->category->deleteCategory($id);

        
        if ($result) {
            return [
                'success' => true,
                'message' => "Data Deleted Successfully"
            ];            
        }else {
            return [
                'success' => false,
                'message' => "Deleted  Failed"
            ];
        }

    }

    public function getCategories(){
        $result = $this->category->findAll();
        return $result;
    }
    


}



?>