<?php
// Database connection
require_once 'includes/db.inc.php';

if (isset($_POST["UserName"]) && isset($_POST["Pass"])) {
    $userName = $_POST["UserName"];
    $password = $_POST["Pass"];

    // Determine the table based on username pattern
    $table = preg_match('/^admin[0-9]*$/', $userName) ? 'admins' : 'user';

    // Query to fetch user/admin details
    $sql = "SELECT * FROM $table WHERE username=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode(["status" => "error", "message" => "Failed to prepare statement"]);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $dbpass = $row["password"];
        $isPassOk = password_verify($password, $dbpass);

        if ($isPassOk) {
            session_start();
            $_SESSION["User_name"] = $row["username"];
            $_SESSION["User_role"] = $table === 'admins' ? 'admin' : 'user'; // Store role in session

             // Create Admin_id session if the user is an admin
            if ($table === 'admins') {
                $_SESSION["Admin_id"] = $row["id"]; // Assuming 'id' is the primary key in the admins table
            }

            echo json_encode(["status" => "success", "message" => "Login successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username"]);
    }
    exit(); // Ensure no further output after JSON response
}
?>

