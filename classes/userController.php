<?php

class UserController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function get_user_by_id(int $id)
    {
        $sql = "SELECT * FROM users WHERE UserID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_user_by_email(string $email)
    {
        $sql = "SELECT * FROM users WHERE Email = :email";
        $args = ['email' => $email];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_users()
    {
        $sql = "SELECT * FROM users";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function update_user(array $user)
    {
        $sql = "UPDATE users SET FirstName = :firstname, LastName = :lastname, Email = :email WHERE UserID = :id";
        return $this->db->runSQL($sql, $user)->execute();
    }

    public function delete_user(int $id)
    {
        $sql = "DELETE FROM users WHERE UserID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

    public function register_user(array $user)
    {
        try {

            $sql = "INSERT INTO users(FirstName, LastName, Email, HashedPassword) 
                    VALUES (:firstname, :lastname, :email, :password)"; 

            return $this->db->runSQL($sql, $user)->fetch();

        } catch (PDOException $e) {

            if ($e->getCode() == 23000) { //Could be 1062
                return false;
            }
            throw $e;
        }
    }   

    public function login_user(string $email, string $password)
    {
        $user = $this->get_user_by_email($email);

        if ($user) {
            $auth = password_verify($password,  $user['password']);
            return $auth ? $user : false;
        }
        return false;
    }


}

?>