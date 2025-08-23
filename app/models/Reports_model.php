<?php

class Reports_model
{
    protected $table = 'reports';
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function createReport($data)
    {
        $this->db->query("INSERT INTO {$this->table} (title, description, status, user_id) VALUES (:title, :description, :status, :user_id)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':user_id', $data['user_id']);
        return $this->db->execute();
    }

    public function getAllReports()
    {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    public function getReportById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function updateReport($id, $data)
    {
        $this->db->query("UPDATE {$this->table} SET title = :title, description = :description, status = :status WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }
    public function deleteReport($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
