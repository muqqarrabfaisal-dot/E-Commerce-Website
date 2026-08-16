<?php

class Product{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function productCreate($data){

        $query = "INSERT INTO products
        (category_id, product_name, slug, description, price, quantity, image, status)
        VALUES
        (:category_id, :product_name, :slug, :description, :price, :quantity, :image, :status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":category_id",$data['category_id']);
        $stmt->bindValue(":product_name",$data['product_name']);
        $stmt->bindValue(":slug",$data['slug']);
        $stmt->bindValue(":description",$data['description']);
        $stmt->bindValue(":price",$data['price']);
        $stmt->bindValue(":quantity",$data['quantity']);
        $stmt->bindValue(":image",$data['image']);
        $stmt->bindValue(":status",$data['status']);

        $stmt->execute();

        return $stmt->rowCount() > 0;

    }

    public function findAll(){
        $query = "SELECT products.*, categories.category_name
        FROM products
        JOIN categories 
        ON categories.id = products.category_id
        ORDER BY products.id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function findById($id){
        $query = "SELECT * FROM products WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id" , $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findBySlug($slug){
        $query = "SELECT * FROM products WHERE slug = :slug";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":slug",$slug);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function findBySlugExceptId($id , $slug){
        $query = "SELECT * FROM products WHERE slug = :slug AND id != :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":slug", $slug);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($data){
        $query = "UPDATE products SET category_id = :category_id, product_name = :product_name, slug = :slug, description = :description, price = :price, quantity = :quantity, status = :status WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id",$data['id']);
        $stmt->bindValue(":category_id",$data['category_id']);
        $stmt->bindValue(":product_name",$data['product_name']);
        $stmt->bindValue(":slug",$data['slug']);
        $stmt->bindValue(":description",$data['description']);
        $stmt->bindValue(":price",$data['price']);
        $stmt->bindValue(":quantity",$data['quantity']);
        $stmt->bindValue(":status",$data['status']);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    
    public function deleteProduct($id){
        $query = "DELETE FROM products WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function getCategoryName(){
        $query = "SELECT id, category_name FROM categories ORDER BY category_name ASC";
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProductImage($id,$image){
        $query = "UPDATE products SET image=:image WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":image", $image);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function findImageById($id){
        $query = "SELECT image FROM products WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id",$id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function findActiveProduct(){
        $query = "SELECT products.*, categories.category_name
        FROM products
        JOIN categories 
        ON categories.id = products.category_id
        WHERE products.status = :status
        ORDER BY products.id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":status",1);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findRelatedProduct($category_Id,$product_Id){
        $query = "SELECT products.* , categories.category_name
        FROM products
        JOIN categories
        ON categories.id = products.category_id
        WHERE products.category_id = :category_id
        AND products.id != :product_id
        AND products.status = :status
        ORDER BY products.id DESC
        LIMIT 4";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":category_id",$category_Id);
        $stmt->bindValue(":product_id",$product_Id);
        $stmt->bindValue(":status",1);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}





?>