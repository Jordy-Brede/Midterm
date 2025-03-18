<?php
class CategoryController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteCategory($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(["message" => "Category deleted", "id" => $id]);
            } else {
                echo json_encode(["message" => "Cannot delete category - it may be referenced in quotes"]);
            }
        } catch (PDOException $e) {
            echo json_encode(["message" => "Database Error: " . $e->getMessage()]);
        }
    }
}
