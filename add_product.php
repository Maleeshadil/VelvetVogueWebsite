<?php
session_start();
if (!isset($_SESSION['User_name'])) {
    header('Location: login_from.php');
    exit;
}
include 'header.php';

// Database connection
require_once 'includes/db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $gender = $_POST['gender'];
    $size = $_POST['size'];

    $stmt = mysqli_prepare($conn, 'INSERT INTO products (name, price, image, category, description, gender, size) VALUES (?, ?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sdsssss', $name, $price, $image, $category, $description, $gender, $size);
    mysqli_stmt_execute($stmt);
    header('Location: admin_dashboard.php');
    exit;
}
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Add New Product</h2>
    <form method="post" class="shadow p-4 rounded bg-light">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="price">Price (LKR)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" placeholder="Enter image URL" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description" required></textarea>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="unisex">Unisex</option>
            </select>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="e.g., S, M, L" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add Product</button>
    </form>
</div>

<?php include 'footer.php'; ?>