<?php
class QuoteController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteQuote($id) {
        $stmt = $this->conn->prepare("DELETE FROM quotes WHERE id = :id");
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Quote deleted", "id" => $id]);
        } else {
            echo json_encode(["message" => "No Quotes Found"]);
        }
    }
}
