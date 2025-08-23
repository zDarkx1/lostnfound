<?php

class User_model
{
<<<<<<< HEAD
    private $table = 'user';
    private $db;

=======
    private $table = 'users';
    private $db;
>>>>>>> staging/mvc
    public function __construct()
    {
        $this->db = new Database();
    }

    public function createUser($data)
    {
<<<<<<< HEAD
        $this->db->query("INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)");
=======
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
>>>>>>> staging/mvc
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        return $this->db->execute();
    }
    public function getAllUsers()
    {
<<<<<<< HEAD
        $this->db->query("SELECT * FROM {$this->table}");
=======
        $this->db->query("SELECT * FROM users");
>>>>>>> staging/mvc
        return $this->db->resultSet();
    }
    public function getUserById($id)
    {
<<<<<<< HEAD
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
=======
        $this->db->query("SELECT * FROM users WHERE id = :id");
>>>>>>> staging/mvc
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function updateUser($id, $data)
    {
<<<<<<< HEAD
        $this->db->query("UPDATE {$this->table} SET name = :name, email = :email WHERE id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
=======
        $this->db->query("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        return $this->db->execute();
    }
    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
>>>>>>> staging/mvc
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
