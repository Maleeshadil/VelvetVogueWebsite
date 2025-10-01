<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;
$product = [
    'id' => $product_id,
    'title' => $_POST['title'],
    'price' => $_POST['price'],
    'image' => $_POST['image'],
    'size' => $_POST['size'] // Include size in the session
];
$_SESSION['cart'][] = [
    'product' => $product,
    'quantity' => $quantity
];
echo json_encode(['success' => true]);
?>