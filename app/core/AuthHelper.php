<?php

namespace app\core;

use app\models\User;
use DateTime;
use DateInterval;

class AuthHelper {
    public static function authRoute() {
        if (!isset($_SESSION['id'])) {
            http_response_code(401);
            header('Location: /login');
            exit();
        }
    }

    public static function nonAuthRoute() {
        if (isset($_SESSION['id'])) {
            http_response_code(401);
            header('Location: /');
            exit();
        }
    }

    public static function checkSession() {
        if (!isset($_SESSION['id'])) return;

        $userModel = new User();
        $user = $userModel->getUserByID($_SESSION['id']);
        $now = new DateTime();
        $nowString = $now->format('Y-m-d H:i:s');

        if ($user['sessionExpiration'] < $nowString) {
            self::endSession();
        }
    }

    public static function startSession($user) {
                
        session_regenerate_id(true);
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        $now = new DateTime();
        $expiry = (clone $now)->add(new DateInterval("PT4H"));
        $expiryStr = $expiry->format('Y-m-d H:i:s');

        $userModel = new User();
        $userModel->updateUserSessionExp(['sessionExpiration' => $expiryStr, 'id' => $user['id']]);
    }

    public static function endSession() {
        $_SESSION = [];
        $param = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $param['path'], $param['domain'], $param['secure'], $param['httponly']);
        session_destroy();
    }
}