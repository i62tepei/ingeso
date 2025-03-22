<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function listUsers($search = "", $limit = 10, $offset = 0) {
        return $this->userModel->getUsers($search, $limit, $offset);
    }

    public function getTotalUsers($search = "") {
        return $this->userModel->getTotalUsers($search)['numRows'] ?? 0;
    }

    public function getUser($id) {
        return $this->userModel->getUserById($id);
    }

    public function saveUser($data) {
        if (isset($data['id'])) {
            return $this->userModel->updateUser($data['id'], $data);
        } else {
            return $this->userModel->createUser($data);
        }
    }
}
?>
