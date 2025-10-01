<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Attempt to include db.php with error handling
$dbIncluded = @include 'includes/db.inc.php';
if (!$dbIncluded || !$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get filter parameters from the AJAX request
$category = isset($_GET['category']) ? $_GET['category'] : '';
$size = isset($_GET['size']) ? $_GET['size'] : '';
$price_min = isset($_GET['price_min']) ? floatval($_GET['price_min']) : 0;
$price_max = isset($_GET['price_max']) ? floatval($_GET['price_max']) : 999999;
$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id DESC';

// Build the SQL query with filters
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];
$types = ""; // To store parameter types for MySQLi bind_param()

if ($category) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}
if ($size) {
    $sql .= " AND size = ?";
    $params[] = $size;
    $types .= "s";
}
if ($price_min > 0 || $price_max < 999999) {
    $sql .= " AND price BETWEEN ? AND ?";
    $params[] = $price_min;
    $params[] = $price_max;
    $types .= "dd"; // 'd' for double (float)
}
if ($gender) {
    $sql .= " AND gender = ?";
    $params[] = $gender;
    $types .= "s";
}
$sql .= " ORDER BY " . $sort;

try {
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    // Bind parameters dynamically
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch products
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Return the products as JSON
    echo json_encode(['products' => $products]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
exit;