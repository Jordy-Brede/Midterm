<?php
header("Content-Type: application/json");

require_once 'Database.php';
require_once 'QuoteController.php';
require_once 'AuthorController.php';
require_once 'CategoryController.php';

// Parse request method and URI
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/api/'));
$resource = $requestUri[0] ?? null;
$id = $requestUri[1] ?? null;

// Initialize controllers
$db = new Database();
$conn = $db->connect();
$quoteController = new QuoteController($conn);
$authorController = new AuthorController($conn);
$categoryController = new CategoryController($conn);

// Handle DELETE requests
if ($method === 'DELETE' && $id !== null) {
    switch ($resource) {
        case 'quotes':
            $quoteController->deleteQuote($id);
            break;
        case 'authors':
            $authorController->deleteAuthor($id);
            break;
        case 'categories':
            $categoryController->deleteCategory($id);
            break;
        default:
            echo json_encode(["message" => "Invalid resource"]);
            break;
    }
} else {
    echo json_encode(["message" => "Invalid request"]);
}
