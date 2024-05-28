<?php

class ReviewController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_review(array $review) 
    {
        $sql = "INSERT INTO reviews (UserID, Review) VALUES (:UserID, :Review)";
        $this->db->runSQL($sql, $review);
        return $this->db->lastInsertId();
    }

    public function get_review_by_id(int $id)
    {
        $sql = "SELECT * FROM reviews WHERE ReviewsID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_reviews_by_user_id(int $user_id)
    {
        $sql = "SELECT * FROM reviews WHERE UserID = :user_id";
        $args = ['user_id' => $user_id];
        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    public function get_all_reviews_with_user_email()
    {
        $sql = "SELECT reviews.*, users.Email FROM reviews 
                JOIN users ON reviews.UserID = users.UserID";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function update_review(array $review)
    {
        $sql = "UPDATE reviews SET Review = :Review WHERE ReviewsID = :id AND UserID = :user_id";
        return $this->db->runSQL($sql, $review)->execute();
    }

    public function delete_review(int $id, int $user_id)
    {
        $sql = "DELETE FROM reviews WHERE ReviewsID = :id AND UserID = :user_id";
        $args = ['id' => $id, 'user_id' => $user_id];
        return $this->db->runSQL($sql, $args)->execute();
    }
}



?>