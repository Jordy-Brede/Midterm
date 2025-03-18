<?php
header("Content-Type: application/json");
require_once 'Database.php'; // Database connection class

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(["message" => "Invalid request method"]);
    exit;
}

// Parse request URI
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$resource = $requestUri[count($requestUri) - 2]; // e.g., 'quotes', 'authors', 'categories'
$id = $requestUri[count($requestUri) - 1];

if (!is_numeric($id)) {
    echo json_encode(["message" => "Invalid ID"]);
    exit;
}

$db = new Database();
$conn = $db->connect();

try {
    if ($resource === 'quotes') {
        $stmt = $conn->prepare("DELETE FROM quotes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Quote deleted", "id" => $id]);
        } else {
            echo json_encode(["message" => "No Quotes Found"]);
        }
    } elseif ($resource === 'authors') {
        $stmt = $conn->prepare("DELETE FROM authors WHERE id = :id");
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Author deleted", "id" => $id]);
        } else {
            echo json_encode(["message" => "Cannot delete author - it may be referenced in quotes"]);
        }
    } elseif ($resource === 'categories') {
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Category deleted", "id" => $id]);
        } else {
            echo json_encode(["message" => "Cannot delete category - it may be referenced in quotes"]);
        }
    } else {
        echo json_encode(["message" => "Invalid resource"]);
    }
} catch (PDOException $e) {
    echo json_encode(["message" => "Error: " . $e->getMessage()]);
}
