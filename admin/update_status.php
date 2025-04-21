<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['email'])) {
    $reportId = intval($_POST['id']);
    $userEmail = $_POST['email'];

    // Update status in the database
    $updateQuery = "UPDATE reports SET status = 'Found' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $reportId);
    
    if ($stmt->execute()) {
        // Send Email Notification
        $subject = "Your Lost Item Has Been Found!";
        $message = "Dear User,\n\nGood news! Your lost item has been found. Please visit our office to collect it.\n\nThank you!";
        $headers = "From: admin@lostandfound.com";

        mail($userEmail, $subject, $message, $headers);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to update status"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>
