<?php
include '../includes/db_connect.php'; // Your DB connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $user_id = intval($_POST['id']);

        // Prepare and execute delete query
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo "<p class='bg-red-500'>User deleted successfully.</p>";
        } else {
            echo "Failed to delete user.";
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
