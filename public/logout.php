<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
setcookie(session_name(), "", time() - 3600, "/"); // Delete session cookie

header("Location: index.php"); // Redirect to login page
exit();
?>
