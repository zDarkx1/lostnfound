<?php

class User_model
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createUser($data)
    {
        $this->db->query("INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        return $this->db->execute();
    }
    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function updateUser($id, $data)
    {
        $this->db->query("UPDATE {$this->table} SET name = :name, email = :email WHERE id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
