<?php

class DatabaseController extends PDO {

    public function __construct(string $dsn, string $username, string $password, array $options = [])
    {
        // Set default PDO options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,           // Set error mode to throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      // Set default fetch mode to fetch associative arrays
            PDO::ATTR_EMULATE_PREPARES => false,                  // Disable emulated prepared statements
        ];
 
        // Call the parent constructor to initialize the PDO connection
        parent::__construct($dsn, $username, $password, $options);
    }

    public function runSQL(string $sql, array $args = null)
    {
        // Check if query has parameters
        if (!$args)
        {
            // If no parameters, execute query directly
            return $this->query($sql);
        }

        // Prepare SQL statement
        $statement = $this->prepare($sql);
        
        // Execute SQL statement with provided parameters
        $statement->execute($args);
        
        // Return statement object
        return $statement;
    }

}
