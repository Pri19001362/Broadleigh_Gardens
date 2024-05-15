<?php

class ReviewController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_review(array $review) 
    {
        
        $sql = "INSERT INTO reviews(Review)
        VALUES (:review);";
        $this->db->runSQL($sql, $review);
        return $this->db->lastInsertId();
    }

    public function get_review_by_id(int $id)
    {
        $sql = "SELECT * FROM reviews WHERE ReviewsID = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_review()
    {
        $sql = "SELECT * FROM reviews";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function update_review(array $review)
    {
        $sql = "UPDATE reviews SET Review = :review WHERE ReviewsID = :id";
        return $this->db->runSQL($sql, $review)->execute();
    }

    public function delete_review(int $id)
    {
        $sql = "DELETE FROM reviews WHERE ReviewsID  = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>