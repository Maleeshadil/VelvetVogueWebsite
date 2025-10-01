<?php

// Database connection
require_once './includes/db.inc.php';

// Get Form Input data
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$userName = $_POST['username'];
$password = $_POST['pass'];

// Function to check if the username or email already exists
function userNameOrEmailAvailable($conn, $userName, $email)
{
    // Query to check if either username or email exists
    $sql = "SELECT username, email FROM user WHERE username = ? OR email = ?";

    $stmt = mysqli_stmt_init($conn);

    $response = ["userNameExists" => false, "emailExists" => false];

    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
        mysqli_stmt_execute($stmt);

        // Fetch the results
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['username'] === $userName) {
                $response["userNameExists"] = true;
            }
            if ($row['email'] === $email) {
                $response["emailExists"] = true;
            }
        }

        mysqli_stmt_close($stmt);
    }

    return $response;
}

// Check if username or email is available
$availability = userNameOrEmailAvailable($conn, $userName, $email);

if (!$availability["userNameExists"] && !$availability["emailExists"]) {
    // Determine the table based on username pattern
    $table = preg_match('/^admin[0-9]*$/', $userName) ? 'admins' : 'user';

    // Query
    $sql = "INSERT INTO $table (fullName, email, username, password) VALUES (?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode(["status" => "error", "message" => "Failed to prepare statement"]);
    } else {
        // Password encryption
        $passHash = password_hash($password, PASSWORD_DEFAULT);

        // Bind data with the statement
        mysqli_stmt_bind_param($stmt, "ssss", $fullName, $email, $userName, $passHash);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        // Response message
        echo json_encode(["status" => "success", "message" => "User registered successfully"]);
    }
} else {
    // Response if username or email is already taken
    if ($availability["userNameExists"] && $availability["emailExists"]) {
        echo json_encode(["status" => "error", "message" => "Username and email already exist"]);
    } elseif ($availability["userNameExists"]) {
        echo json_encode(["status" => "error", "message" => "Username already exists"]);
    } elseif ($availability["emailExists"]) {
        echo json_encode(["status" => "error", "message" => "Email already exists"]);
    }
}

// Close the database connection
mysqli_close($conn);

