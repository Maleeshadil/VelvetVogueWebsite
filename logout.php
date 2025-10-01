<?php
// Start the session
session_start();

// Destroy all sessions
session_unset();
session_destroy();

// Redirect to the login page or homepage
header("Location: ./page/login_from.php");
exit();
?>