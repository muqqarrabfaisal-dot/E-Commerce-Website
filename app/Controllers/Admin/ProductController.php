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

    public function storeProduct()
{
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        return [
            'success' => false,
            'message' => 'Invalid Request'
        ];
    }

    // =========================
    // 1. Validate POST fields
    // =========================

    if (
        !isset($_POST['category_id']) ||
        !isset($_POST['product_name']) ||
        !isset($_POST['description']) ||
        !isset($_POST['price']) ||
        !isset($_POST['quantity']) ||
        !isset($_POST['status'])
    ) {
        return [
            'success' => false,
            'message' => 'All Fields Are Required'
        ];
    }

    $category_id = (int) $_POST['category_id'];
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];
    $quantity = trim($_POST['quantity']);
    $status = trim($_POST['status']);

    if (
        empty($category_id) ||
        empty($product_name) ||
        empty($description) ||
        empty($price) ||
        empty($quantity)
    ) {
        return [
            'success' => false,
            'message' => 'All Fields Are Required'
        ];
    }

    // =========================
    // 2. Validate image
    // =========================

    if (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK
    ) {
        return [
            'success' => false,
            'message' => 'Image is required'
        ];
    }

    $fileSize = $_FILES['image']['size'];

    $maxSize = 2 * 1024 * 1024; // 2 MB

    if ($fileSize > $maxSize) {
        return [
            'success' => false,
            'message' => 'Image size must be less than 2 MB'
        ];
    }

    $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    $fileType = mime_content_type(
        $_FILES['image']['tmp_name']
    );

    if (!in_array($fileType, $allowedTypes, true)) {
        return [
            'success' => false,
            'message' => 'Only JPG, PNG and WEBP images are allowed'
        ];
    }

    // =========================
    // 3. Generate slug
    // =========================

    $slugname = strtolower($product_name);

    $slugname = preg_replace(
        "/[^a-z0-9]+/i",
        "-",
        $slugname
    );

    $slugname = trim($slugname, "-");

    // =========================
    // 4. Check duplicate product
    // =========================

    $result = $this->product->findBySlug($slugname);

    if ($result) {
        return [
            'success' => false,
            'message' => 'This Product Already Exists'
        ];
    }

    // =========================
    // 5. Generate unique filename
    // =========================

    $extension = strtolower(
        pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        )
    );

    $imageName = uniqid(
        'product_',
        true
    ) . '.' . $extension;

    $tmpName = $_FILES['image']['tmp_name'];

    // =========================
    // 6. Upload path
    // =========================

    $uploadPath = dirname(__DIR__, 3)
        . "/public/uploads/products/";

    if (!is_dir($uploadPath)) {
        return [
            'success' => false,
            'message' => 'Upload directory not found'
        ];
    }

    $imagePath = $uploadPath . $imageName;

    // =========================
    // 7. Upload image
    // =========================

    if (!move_uploaded_file($tmpName, $imagePath)) {
        return [
            'success' => false,
            'message' => 'Image Upload Failed'
        ];
    }

    // =========================
    // 8. Prepare product data
    // =========================

    $data = [
        'category_id' => $category_id,
        'product_name' => $product_name,
        'slug' => $slugname,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $imageName,
        'status' => $status
    ];

    // =========================
    // 9. Insert product
    // =========================

    $result = $this->product->productCreate($data);

    if (!$result) {

        // DB insert failed
        // Remove uploaded image
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        return [
            'success' => false,
            'message' => 'Product Insert Failed'
        ];
    }

    // =========================
    // 10. Success
    // =========================

    return [
        'success' => true,
        'message' => 'Product Inserted Successfully'
    ];
}

    public function findAll(){
        return $this->product->findAll();
    }

    public function updateProduct(){
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            return;
        }

        $id = (int)$_POST['id'];
        $category_id = (int)$_POST['category_id'];
        $product_name = trim($_POST['product_name']);
        $description = trim($_POST['description']);
        $price = (float)$_POST['price'];
        $quantity = trim($_POST['quantity']);
        $status = trim($_POST['status']);

        if (empty($category_id) || empty($product_name) || empty($description) || empty($price) || empty($quantity) || empty($status)) {
            return[
                'success' => false,
                'message' => "All Field Are Required"
            ];
        }

        $slugname = strtolower($product_name);
        $slugname = preg_replace("/[^a-z0-9]+/i","-",$slugname);
        $slugname = trim($slugname,"-");

        $resultslug = $this->product->findBySlugExceptId($id,$slugname);

        if ($resultslug) {
            return[
                'success' => false,
                'message' => "This Product Already Excists"
            ];
        }

        $data = [
            'id'           => $id,
            'category_id'  => $category_id,
            'product_name' => $product_name,
            'slug'         => $slugname,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity,
            'status'       => $status,
        ];

        $result = $this->product->updateProduct($data);

        if ($result) {
            return[
                'success' => true,
                'message' => "Updated Successfully"
            ];
        }else {
            return[
                'success' => false,
                'message' => "Updated Failed!"
            ];
        }
    }
    public function deleteProduct(){
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            return;
        }

        $id = (int)$_POST['id'];
        
        if($this->product->deleteProduct($id)){
            return[
                'success' => true,
                'message' => "Deleted Successfully"
            ];
        }else{
            return[
                'success' => false,
                'message' => "Deleted Failed"
            ];
        }

    }

    public function getCategoryName(){
        return $this->product->getCategoryName();
    }

    public function updateProductImage(){

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return [
            'success' => false,
            'message' => 'Invalid Request'
        ];
    }

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        return [
            'success' => false,
            'message' => 'Product ID is required'
        ];
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        return [
            'success' => false,
            'message' => 'Image is required'
        ];
    }

    $id = (int) $_POST['id'];

    // File size validation
    $fileSize = $_FILES['image']['size'];

    $maxSize = 2 * 1024 * 1024;

    if ($fileSize > $maxSize) {
        return [
            'success' => false,
            'message' => 'Image size must be less than 2 MB'
        ];
    }

    // File type validation
    $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    $fileType = mime_content_type($_FILES['image']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        return [
            'success' => false,
            'message' => 'Only JPG, PNG and WEBP images are allowed'
        ];
    }

    // Generate unique filename
    $extension = strtolower(
        pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)
    );

    $imageName = uniqid('product_', true) . '.' . $extension;

    $tmpName = $_FILES['image']['tmp_name'];

    // Get old image from database
    $oldProduct = $this->product->findImageById($id);

    if (!$oldProduct) {
        return [
            'success' => false,
            'message' => 'Product Not Found'
        ];
    }

    $oldImageName = $oldProduct['image'];

    // Upload path
    $uploadpath = dirname(__DIR__, 3) . "/public/uploads/products/";

    $imagepath = $uploadpath . $imageName;

    // Upload new image
    if (!move_uploaded_file($tmpName, $imagepath)) {
        return [
            'success' => false,
            'message' => 'Upload Failed'
        ];
    }

    // Update database
    $result = $this->product->updateProductImage($id, $imageName);

    if (!$result) {

        // Remove newly uploaded image
        if (file_exists($imagepath)) {
            unlink($imagepath);
        }

        return [
            'success' => false,
            'message' => 'Image update failed'
        ];
    }

    // Delete old image
    if (!empty($oldImageName) && $oldImageName !== $imageName) {

        $oldImagePath = $uploadpath . $oldImageName;

        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    return [
        'success' => true,
        'message' => 'Image updated successfully',
        'image' => $imageName
    ];
}







}

?>