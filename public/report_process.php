<?php
// session_start();


// // If user is not logged in, redirect to login page
// if (!isset($_SESSION["user_id"])) {
//     header("Location: login.php");
//     exit();
// }

// include '../includes/db_connect.php'; // Database connection

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Sanitize inputs
//     $username = htmlspecialchars(trim($_POST["username"]));
//     $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
//     $item_name = htmlspecialchars(trim($_POST["item_name"]));
//     $category = htmlspecialchars(trim($_POST["category"]));
//     $description = htmlspecialchars(trim($_POST["description"]));
//     $datetime = htmlspecialchars(trim($_POST["datetime"]));
//     $location = htmlspecialchars(trim($_POST["location"]));
//     $status = htmlspecialchars(trim($_POST["status"]));
//     $contact_info = htmlspecialchars(trim($_POST["contact_info"]));
//     $user_id = $_SESSION["user_id"];

//     // Define upload directory (inside 'public/uploads/')
//     $uploadDir = __DIR__ . "/uploads/";
//     $imagePath = ""; // Default empty image path

//     // Ensure the uploads directory exists
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0775, true); // Create directory with correct permissions
//     }
//     print_r($_FILES);
//     // Handle file upload if an image is selected
//     if (!empty($_FILES["image"]["name"])) {
//         $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
//         $allowedTypes = ["jpg", "jpeg", "png", "gif"];

//         // Validate file type
//         if (!in_array($imageFileType, $allowedTypes)) {
//             echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.'); window.location.href='report.php';</script>";
//             exit();
//         }

//         // Validate file size (max 2MB)
//         if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
//             echo "<script>alert('File size too large. Max 2MB allowed.'); window.location.href='report.php';</script>";
//             exit();
//         }

//         // Generate unique filename
//         $imageName = uniqid("img_") . "." . $imageFileType;
//         $imagePath = "uploads/" . $imageName; // Path saved in database
//         $targetFile = $uploadDir . $imageName; // Absolute path for moving file

//         // Move file to uploads directory
//         echo $_FILES["image"]["tmp_name"];
//         if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
//             echo "<script>alert('Error uploading image.'); window.location.href='report.php';</script>";
//             exit();
//         }

//         // Set correct permissions for uploaded file
//         chmod($targetFile, 0644);
//     }

//     // Prepare SQL statement
//     $stmt = $conn->prepare("INSERT INTO reports (user_id, username, email, item_name, category, description, datetime, location, status, contact_info, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("issssssssss", $user_id, $username, $email, $item_name, $category, $description, $datetime, $location, $status, $contact_info, $imagePath);

//     // Execute and handle response
//     if ($stmt->execute()) {
//         echo "<script>alert('Report submitted successfully!'); window.location.href='index.php';</script>";
//     } else {
//         echo "<script>alert('Error submitting report. Please try again.'); window.location.href='report.php';</script>";
//     }

//     // Close resources
//     $stmt->close();
//     $conn->close();
// }
?>




<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include '../includes/db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $item_name = htmlspecialchars(trim($_POST["item_name"]));
    $category = htmlspecialchars(trim($_POST["category"]));
    $description = htmlspecialchars(trim($_POST["description"]));
    $datetime = htmlspecialchars(trim($_POST["datetime"]));
    $location = htmlspecialchars(trim($_POST["location"]));
    $status = htmlspecialchars(trim($_POST["status"]));
    $contact_info = htmlspecialchars(trim($_POST["contact_info"]));
    $user_id = $_SESSION["user_id"];

    // Define upload directory (inside 'public/uploads/')
    $uploadDir = realpath(__DIR__ . '/../public/uploads/') . '/'; // Correct absolute path
    $imagePath = ""; // Default empty image path

    // Ensure the uploads directory exists and is writable
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true); // Create directory if not exists
    }

    // Handle file upload if an image is selected
    if (!empty($_FILES["image"]["name"])) {
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        // Validate file type
        if (!in_array($imageFileType, $allowedTypes)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.'); window.location.href='report.php';</script>";
            exit();
        }

        // Validate file size (max 2MB)
        if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
            echo "<script>alert('File size too large. Max 2MB allowed.'); window.location.href='report.php';</script>";
            exit();
        }

        // Generate unique filename
        $imageName = uniqid("img_") . "." . $imageFileType;
        $imagePath = "uploads/" . $imageName; // Correct relative path stored in the database
        $targetFile = $uploadDir . $imageName; // Absolute path for moving file

        // Check if file uploaded properly
        if ($_FILES["image"]["error"] !== 0) {
            echo "<script>alert('Upload Error: " . $_FILES["image"]["error"] . "'); window.location.href='report.php';</script>";
            exit();
        }

        // Debugging: Print temporary file path
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "<script>alert('Error moving uploaded file. Check folder permissions.'); window.location.href='report.php';</script>";
            exit();
        }

        // Set correct permissions for uploaded file
        chmod($targetFile, 0644);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO reports (user_id, username, email, item_name, category, description, datetime, location, status, contact_info, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssss", $user_id, $username, $email, $item_name, $category, $description, $datetime, $location, $status, $contact_info, $imagePath);

    // Execute and handle response
    if ($stmt->execute()) {
        echo "<script>alert('Report submitted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error submitting report. Please try again.'); window.location.href='report.php';</script>";
    }

    // Close resources
    $stmt->close();
    $conn->close();
}
?>

