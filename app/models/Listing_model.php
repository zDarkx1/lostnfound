<?php

class Reports_model
{
    protected $table = 'listing';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function createListing($data)
    {
        $this->db->query("INSERT INTO {$this->table} (title, description,time,status, user_id) VALUES (:title, :description, :time, :status, :user_id)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':user_id', $data['user_id']);
        return $this->db->execute();
    }

    public function getAllListing()
    {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    public function getListingByKeyword($keyword)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE title LIKE :keyword OR description LIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->resultSet();
    }
    public function updateListing($id, $data)
    {
        $this->db->query("UPDATE {$this->table} SET title = :title, description = :description, status = :status WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }
    public function deleteListing($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getListingsByUserId($user_id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
    public function searchListings($keyword)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE title LIKE :keyword OR description LIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
