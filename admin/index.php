<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100"> -->

<?php include '../includes/header.php'; ?>
<div class="flex mt-18">
    <?php include 'admin_navbar.php'; ?>

    <div class="bg-white flex-1 ml-64 p-6 h-screen overflow-auto dark:bg-gray-800 transition-colors duration-300">
        <?php 
        // Get page from URL, default to dashboard
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

        // Allowed pages
        $allowed_pages = ['dashboard', 'users', 'listings', 'settings'];
        if (in_array($page, $allowed_pages)) {
            include $page . ".php";
        } else {
            echo "<h2 class='text-red-500'>Page Not Found</h2>";
        }
        ?>
    </div>
</div>

<script>

</script>



