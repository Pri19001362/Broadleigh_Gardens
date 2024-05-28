<?php

class ProductController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_product(array $product) 
    {
        $sql = "INSERT INTO products(Name, Description, Category, Price, Image) VALUES (:Name, :Description, :Category, :Price, :Image)";
        $this->db->runSQL($sql, $product);
        return $this->db->lastInsertId();
    }

    public function get_product_by_id(int $id)
    {
        $sql = "SELECT * FROM products WHERE ProductID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_products($search_query = null)
    {
        if ($search_query !== null) {
            $sql = "SELECT * FROM products WHERE Name LIKE :search_query";
            $args = ['search_query' => '%' . $search_query . '%'];
            return $this->db->runSQL($sql, $args)->fetchAll();
        } else {
            $sql = "SELECT * FROM products";
            return $this->db->runSQL($sql)->fetchAll();
        }
    }

    public function update_product(array $product)
    {
        $sql = "UPDATE products SET Name = :Name, Description = :Description, Category = :Category, Price = :Price WHERE ProductID = :ProductID";
        return $this->db->runSQL($sql, $product)->execute();
    }

    public function delete_product(int $id)
    {
        $sql = "DELETE FROM products WHERE ProductID = :ProductID";
        $args = ['ProductID' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

}


?>