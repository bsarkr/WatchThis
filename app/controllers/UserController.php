<?php

namespace app\core;
use app\models\User;


class UserController extends Controller {
    public function getUsers() {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        $this->returnJSON($users);
    }

    public function usersView() {
        $this->returnView('./assets/views/users/usersView.html');
    }

}