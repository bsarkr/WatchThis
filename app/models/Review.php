<?php

namespace app\models;

use app\core\Database;

class Review {
    public function getAll() {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM reviews ORDER BY created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function add($name, $content) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO reviews (name, content) VALUES (:name, :content)");
        $stmt->execute([
            ':name' => $name,
            ':content' => $content
        ]);
    }
}