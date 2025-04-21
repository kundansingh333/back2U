<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw JSON input
    $data = json_decode(file_get_contents("php://input"), true);
    $ids = $data['ids'] ?? [];

    if (count($ids) === 2) {
        // Fetch item data for insertion
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $types = str_repeat('i', count($ids));

        $stmt = $conn->prepare("SELECT report_id, item_name, status, user_id, username FROM reports WHERE report_id IN ($placeholders)");
        $stmt->bind_param($types, ...$ids);
        $stmt->execute();
        $result = $stmt->get_result();

        $insertStmt = $conn->prepare("INSERT INTO verified_item (report_id, item_name, status, user_id, username) VALUES (?, ?, ?, ?, ?)");

        while ($row = $result->fetch_assoc()) {
            $insertStmt->bind_param("issis", $row['report_id'], $row['item_name'], $row['status'], $row['user_id'], $row['username']);
            $insertStmt->execute();
        }

        // Update original reports' status
        $updateStmt = $conn->prepare("UPDATE reports SET status = 'Verified' WHERE report_id IN ($placeholders)");
        $updateStmt->bind_param($types, ...$ids);
        $updateStmt->execute();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Exactly two items must be selected.']);
    }
}
?>
