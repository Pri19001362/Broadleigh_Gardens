<?php

class ReviewController {

    protected $db;

    // Constructor to initialize the database connection
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    // Method to create a new review in the database
    public function create_review(array $review) 
    {
        // SQL query to insert a new review
        $sql = "INSERT INTO reviews (UserID, Review) VALUES (:UserID, :Review)";
        // Execute the SQL query with the provided review data
        $this->db->runSQL($sql, $review);
        // Return the ID of the newly inserted review
        return $this->db->lastInsertId();
    }

    // Method to retrieve a review by its ID
    public function get_review_by_id(int $id)
    {
        // SQL query to select a review by its ID
        $sql = "SELECT * FROM reviews WHERE ReviewsID = :id";
        $args = ['id' => $id];
        // Execute the SQL query with the provided ID and fetch the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve reviews by a user's ID
    public function get_reviews_by_user_id(int $user_id)
    {
        // SQL query to select reviews by user ID
        $sql = "SELECT * FROM reviews WHERE UserID = :user_id";
        $args = ['user_id' => $user_id];
        // Execute the SQL query with the provided user ID and fetch all results
        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    // Method to retrieve all reviews along with the user's email
    public function get_all_reviews_with_user_email()
    {
        // SQL query to select all reviews and join with the users table to get user email
        $sql = "SELECT reviews.*, users.Email FROM reviews 
                JOIN users ON reviews.UserID = users.UserID";
        // Execute the SQL query and fetch all results
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update an existing review in the database
    public function update_review(array $review)
    {
        // SQL query to update a review
        $sql = "UPDATE reviews SET Review = :Review WHERE ReviewsID = :id AND UserID = :user_id";
        // Execute the SQL query with the provided review data
        return $this->db->runSQL($sql, $review)->execute();
    }

    // Method to delete a review by its ID and user ID
    public function delete_review(int $id, int $user_id)
    {
        // SQL query to delete a review by its ID and user ID
        $sql = "DELETE FROM reviews WHERE ReviewsID = :id AND UserID = :user_id";
        $args = ['id' => $id, 'user_id' => $user_id];
        // Execute the SQL query with the provided ID and user ID
        return $this->db->runSQL($sql, $args)->execute();
    }
}

?>
