<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$response = ['success' => false, 'cartCount' => count($_SESSION['cart'])];

// Handle update action (increase/decrease quantity or change size)
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $item_index = $_POST['item_index'] ?? null;
    $qty_action = $_POST['qty_action'] ?? null;
    $size = $_POST['size'] ?? null;

    if ($item_index !== null && isset($_SESSION['cart'][$item_index])) {
        if ($qty_action === 'increase') {
            $_SESSION['cart'][$item_index]['quantity']++;
        } elseif ($qty_action === 'decrease' && $_SESSION['cart'][$item_index]['quantity'] > 1) {
            $_SESSION['cart'][$item_index]['quantity']--;
        }
        if ($size) {
            $_SESSION['cart'][$item_index]['product']['size'] = $size;
        }
        $item = $_SESSION['cart'][$item_index];
        $subtotal = array_reduce($_SESSION['cart'], function ($sum, $item) {
            return $sum + ($item['quantity'] ?? 1) * ($item['product']['price'] ?? 0);
        }, 0);
        $shipping = $subtotal > 0 ? 500 : 0;
        $total = $subtotal + $shipping;
        $response = [
            'success' => true,
            'cartCount' => count($_SESSION['cart']),
            'item' => $item,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ];
    }
}

// Handle remove action
if (isset($_POST['action']) && $_POST['action'] === 'remove') {
    $item_index = $_POST['item_index'] ?? null;

    if ($item_index !== null && isset($_SESSION['cart'][$item_index])) {
        unset($_SESSION['cart'][$item_index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        $subtotal = array_reduce($_SESSION['cart'], function ($sum, $item) {
            return $sum + ($item['quantity'] ?? 1) * ($item['product']['price'] ?? 0);
        }, 0);
        $shipping = $subtotal > 0 ? 500 : 0;
        $total = $subtotal + $shipping;
        $response = [
            'success' => true,
            'cartCount' => count($_SESSION['cart']),
            'removedIndex' => $item_index,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ];
    }
}

echo json_encode($response);
?>