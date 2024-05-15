<?php

class Controllers {

    protected $db = null;
    protected $users = null;
    protected $products = null;
    protected $reviews = null;

    public function __construct()
    {
        //----Database----//

        $type ='mysql';
        $server = '127.0.0.1';
        $db = 'broadleighgardens';
        $port = '3306';
        $charset = 'latin1';

        $username = 'root';
        $password = '';
    
         //----Database----//

        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
    
        try {
            $this->db = new DatabaseController($dsn, $username, $password); 
        }
        catch (PDOException $e) {
            throw new PDOException($e -> getMessage(), $e -> getCode());
            echo $e;
        }
    }

    public function users()
    {
        if ($this->users === null) {
            $this->users = new UserController($this->db);
        }
        return $this->users;
    }

    public function products()
    {
        if ($this->products === null) {
            $this->products = new ProductController($this->db);
        }
        return $this->products;
    }
    public function reviews()
    {
        if ($this->reviews === null) {
            $this->reviews = new ReviewController($this->db);
        }
        return $this->reviews;
    }
}