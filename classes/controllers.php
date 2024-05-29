<?php

class Controllers {

    // Properties to hold instances of database and other controllers
    protected $db = null;
    protected $users = null;
    protected $products = null;
    protected $reviews = null;

    public function __construct()
    {
        // Database configuration
        $type = 'mysql';
        $server = '127.0.0.1';
        $db = 'broadleighgardens';
        $port = '3306';
        $charset = 'latin1';

        // Database credentials
        $username = 'root';
        $password = '';
    
        // Data Source Name (DSN) for database connection
        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
    
        try {
            // Initialize the database connection
            $this->db = new DatabaseController($dsn, $username, $password); 
        }
        catch (PDOException $e) {
            // Handle potential database connection errors
            throw new PDOException($e->getMessage(), $e->getCode());
            echo $e;
        }
    }

    // Method to get an instance of UserController
    public function users()
    {
        if ($this->users === null) {
            $this->users = new UserController($this->db);
        }
        return $this->users;
    }

    // Method to get an instance of ProductController
    public function products()
    {
        if ($this->products === null) {
            $this->products = new ProductController($this->db);
        }
        return $this->products;
    }

    // Method to get an instance of ReviewController
    public function reviews()
    {
        if ($this->reviews === null) {
            $this->reviews = new ReviewController($this->db);
        }
        return $this->reviews;
    }
}
?>
