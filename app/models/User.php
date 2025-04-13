<?php

namespace app\models;

class User extends Model {

    protected $table = 'users';

    public function getAllUsers() {
        return $this->findAll();
    }
}