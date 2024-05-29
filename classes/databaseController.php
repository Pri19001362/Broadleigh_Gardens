<?php

class DatabaseController extends PDO {
    //Constructor to initialize the DatabaseController

    public function __construct(string $dsn, string $username, string $password, array $options = [])
    {
        // Default PDO options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Set the default fetch mode to associative array
            PDO::ATTR_EMULATE_PREPARES => false,               // Disable emulation of prepared statements
        ];
 
        // Call the parent PDO constructor with the DSN, username, password, and options
        parent::__construct($dsn, $username, $password, $options);
    }

    public function runSQL(string $sql, array $args = null)
    {
        // If no arguments are provided, run the query directly
        if (!$args) {
            return $this->query($sql);
        }

        // Prepare the SQL statement
        $statement = $this->prepare($sql);
        
        // Execute the statement with the provided arguments
        $statement->execute($args);
        
        // Return the executed statement
        return $statement;
    }

}
