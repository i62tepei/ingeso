<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/UserController.php';

$userController = new UserController($pdo);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($userController->getUser($_GET['id']));
        } else {
            $search = $_GET['search'] ?? "";
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $users = $userController->listUsers($search, $limit, $offset);

            $totalUsers = $userController->getTotalUsers($search);

            $totalPages = ceil($totalUsers / $limit);

            echo json_encode([
                'users' => $users,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ]);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $userController->saveUser($data)]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($_GET['id'])) {
            echo json_encode(['error' => 'ID requerido']);
            exit;
        }
        echo json_encode(['success' => $userController->saveUser(array_merge($data, ['id' => $_GET['id']]))]);
        break;

    default:
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
