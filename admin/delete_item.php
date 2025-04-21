<?php
include '../includes/db_connect.php'; // Your DB connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $report_id = intval($_POST['id']);

        // Prepare and execute delete query
        $stmt = $conn->prepare("DELETE FROM reports WHERE report_id = ?");
        $stmt->bind_param("i", $report_id);

        if ($stmt->execute()) {
            echo "Item deleted successfully.";
        } else {
            echo "Failed to delete item.";
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
