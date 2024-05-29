<?php
class UserController {

    protected $db;

    // Constructor method to initialize the database controller
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    // Method to get a user by their ID
    public function get_user_by_id(int $id)
    {
        $sql = "SELECT * FROM users WHERE UserID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to get a user by their email address
    public function get_user_by_email(string $email)
    {
        $sql = "SELECT * FROM users WHERE Email = :email";
        $args = ['email' => $email];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to get all users from the database
    public function get_all_users()
    {
        $sql = "SELECT * FROM users";
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update user details
    public function update_user(array $user)
    {
        $sql = "UPDATE Users SET FirstName = :FirstName, LastName = :LastName, UserName = :UserName, Email = :Email, Phone = :Phone, Address = :Address WHERE UserID = :UserID";
        return $this->db->runSQL($sql, $user);
    }
    
    // Method to delete a user by their ID
    public function delete_user(int $id)
    {
        $sql = "DELETE FROM users WHERE UserID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

    // Method to register a new user
    public function register_user(array $user)
    {
        try {
            $sql = "INSERT INTO users(FirstName, LastName, UserName, Email, HashedPassword, Phone, Address) 
                    VALUES (:FirstName, :LastName, :UserName, :Email, :HashedPassword, :Phone, :Address)"; 
            return $this->db->runSQL($sql, $user)->fetch();
        } catch (PDOException $e) {
            // Handle duplicate entry error (email already exists)
            if ($e->getCode() == 23000) { // Could be 1062
                return false;
            }
            throw $e;
        }
    }   

    // Method to authenticate a user during login
    public function login_user(string $email, string $password)
    {
        $user = $this->get_user_by_email($email);
        if ($user) {
            $auth = password_verify($password, $user['HashedPassword']);
            if ($auth) {
                return $user;
            }
        }
        return false;
    }
}
?>
