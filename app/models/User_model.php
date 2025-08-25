<?php

class User_model
{
    private $table = 'users';
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($email, $password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            if (password_verify($password, $row->password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function createUser($data)
    {
        $this->db->query("INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        return $this->db->execute();
    }
    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM users");
        return $this->db->resultSet();
    }
    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function updateUser($id, $data)
    {
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
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function searchUser($keyword)
    {
        $this->db->query("SELECT name, email, phone, created_at FROM users WHERE name LIKE :keyword OR email LIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
