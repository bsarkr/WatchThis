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
}