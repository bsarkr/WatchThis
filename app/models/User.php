<?php

namespace app\models;

class User extends Model {
    protected $table = 'users';

    public function create($username, $email, $passwordHash, $avatarId) {
        $sql = "INSERT INTO users (username, email, password, avatar_id) VALUES (?, ?, ?, ?)";
        return $this->query($sql, [$username, $email, $passwordHash, $avatarId]);
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->query($sql, [$email], true);
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        return $this->query($sql, [$username], true);
    }

    public function updateUserSessionExp($inputData){
        $query = "update users set sessionExpiration = :sessionExpiration where id = :id";
        return $this->query($query, $inputData);
    }
    
    public function getUserByID($id) {
        $query = "SELECT id, username, email, sessionExpiration FROM users WHERE id = :id";
        $user = $this->query($query, ['id' => $id]);
        return $user ? $user[0] : false;
    }
    
    public function login($inputData) {
        $query = "SELECT id, username, email, password FROM users WHERE email = :email";
        $result = $this->query($query, ['email' => $inputData['email']]);
        if (!$result) return false;
    
        return password_verify($inputData['password'], $result[0]['password']) ? $result[0] : false;
    }
}