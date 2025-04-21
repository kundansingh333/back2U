<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../includes/db_connect.php';

// Get user details
$user = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<p style='color: red;'>User not found!</p>";
        exit();
    }
}

// Store the previous page URL explicitly
$previousPage = $_SERVER['HTTP_REFERER'] ?? 'users.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $redirectUrl = $_POST['redirect_url'] ?? 'users.php'; // Get redirect URL from hidden field

    $updateQuery = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to the previous page (stored in the form)
        header("Location: $redirectUrl");
        exit();
    } else {
        echo "<p style='color: red;'>Error updating record: " . mysqli_error($conn) . "</p>";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="flex-1 p-6 mt-20">
    <h1 class="text-3xl text-center font-bold text-gray-800 dark:text-white">Edit User</h1>

    <form method="POST" action="" class="bg-white text-gray-800 p-6 rounded-lg shadow-md mt-6 w-96 mx-auto dark:bg-gray-800 dark:border dark:border-white/10 dark:shadow-blue-500/10 dark:text-white">
        <input type="hidden" name="redirect_url" value="<?= htmlspecialchars($previousPage) ?>">

        <label class="block mb-2 font-semibold">Username:</label>
        <input type="text" name="username" value="<?= isset($user['username']) ? htmlspecialchars($user['username']) : '' ?>" class="border p-2 w-full" required>

        <label class="block mt-4 mb-2 font-semibold">Email:</label>
        <input type="email" name="email" value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>" class="border p-2 w-full" required>

        <label class="block mt-4 mb-2 font-semibold">Role:</label>
        <select name="role" class="border p-2 w-full" required>
            <option value="user" <?= isset($user['role']) && $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= isset($user['role']) && $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>

        <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Update</button>
    </form>
</div>



