<?php
require_once __DIR__ . '/../config/db.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsers($search = "", $limit = 10, $offset = 0) {
        $sql = "SELECT * FROM users WHERE full_name LIKE :search LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalUsers($search = "") {
        $sql = "SELECT COUNT(id) as numRows FROM users WHERE full_name LIKE :search";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data) {
        $sql = "INSERT INTO users (dni, full_name, birthday, phone, email) 
                VALUES (:dni, :full_name, :birthday, :phone, :email)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateUser($id, $data) {
        $sql = "UPDATE users SET dni=:dni, full_name=:full_name, birthday=:birthday, 
                phone=:phone, email=:email WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }
}
?>