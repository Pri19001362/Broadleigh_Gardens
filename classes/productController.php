<?php

class ProductController {

    protected $db;

    // Constructor to initialize the database connection
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    // Method to create a new product in the database
    public function create_product(array $product) 
    {
        // SQL query to insert a new product
        $sql = "INSERT INTO products(Name, Description, Category, Price, Image) VALUES (:Name, :Description, :Category, :Price, :Image)";
        // Execute the SQL query with the provided product data
        $this->db->runSQL($sql, $product);
        // Return the ID of the newly inserted product
        return $this->db->lastInsertId();
    }

    // Method to retrieve a product by its ID
    public function get_product_by_id(int $id)
    {
        // SQL query to select a product by its ID
        $sql = "SELECT * FROM products WHERE ProductID = :id";
        $args = ['id' => $id];
        // Execute the SQL query with the provided ID and fetch the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all products, optionally filtered by a search query
    public function get_all_products($search_query = null)
    {
        if ($search_query !== null) {
            // SQL query to select products that match the search query
            $sql = "SELECT * FROM products WHERE Name LIKE :search_query";
            $args = ['search_query' => '%' . $search_query . '%'];
            // Execute the SQL query with the search query and fetch all results
            return $this->db->runSQL($sql, $args)->fetchAll();
        } else {
            // SQL query to select all products
            $sql = "SELECT * FROM products";
            // Execute the SQL query and fetch all results
            return $this->db->runSQL($sql)->fetchAll();
        }
    }

    // Method to update an existing product in the database
    public function update_product(array $product)
    {
        // SQL query to update a product
        $sql = "UPDATE products SET Name = :Name, Description = :Description, Category = :Category, Price = :Price WHERE ProductID = :ProductID";
        // Execute the SQL query with the provided product data
        return $this->db->runSQL($sql, $product)->execute();
    }

    // Method to delete a product by its ID
    public function delete_product(int $id)
    {
        // SQL query to delete a product by its ID
        $sql = "DELETE FROM products WHERE ProductID = :ProductID";
        $args = ['ProductID' => $id];
        // Execute the SQL query with the provided ID
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
