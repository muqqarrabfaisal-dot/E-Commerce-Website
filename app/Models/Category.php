<?php 

class Category{

    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }


    public function storeCategory($data){

        $query = "INSERT INTO categories (category_name, slug, description, status)
        VALUES (:category_name,:slug,:description,:status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":category_name",$data['category_name']);
        $stmt->bindValue(":slug",$data['slug']);
        $stmt->bindValue(":description",$data['description']);
        $stmt->bindValue(":status",$data['status']);

        $stmt->execute();

        return $stmt->rowCount() > 0;

    }

    public function findAll(){

        $query = "SELECT * FROM categories";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findBySlug($slug){
        $query = "SELECT * FROM categories WHERE slug = :slug";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":slug",$slug);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($data){
        $query = "UPDATE categories SET category_name = :category_name, slug = :slug, description = :description, status = :status
        WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id",$data['id']);
        $stmt->bindValue(":category_name",$data['category_name']);
        $stmt->bindValue(":slug",$data['slug']);
        $stmt->bindValue(":description",$data['description']);
        $stmt->bindValue(":status",$data['status']);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function deleteCategory($id){
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(":id",$id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function findById($id){
        $query = "SELECT * FROM categories WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findBySlugExceptId($id,$slug){
        $query = "SELECT * FROM categories WHERE slug=:slug And id != :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":slug",$slug);
        $stmt->bindValue(":id",$id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}



?>