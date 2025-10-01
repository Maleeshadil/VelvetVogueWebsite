<?php
include 'header.php';
include 'includes/db.inc.php';

$product_id = $_GET['id'] ?? null;
if (!$product_id ||!is_numeric($product_id)) {
    echo '<div class="container my-5"><p>Product not found</p></div>';
    include 'footer.php'; 
    exit;
}

// Prepare and execute the query
$stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
$stmt->bind_param('i', $product_id); // Bind the product ID as an integer
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc(); // Fetch a single product row


if (!$product) {
    echo '<div class="container my-5"><p>Product not found</p></div>';
    include 'footer.php';
    exit;
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p>LKR <?php echo number_format($product['price'], 2); ?></p>
            <p><strong>Size:</strong> <?php echo htmlspecialchars($product['size']); ?></p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($product['gender']); ?></p>
            <form id="add-to-cart-form">
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control w-25 d-inline" id="quantity" name="quantity" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: {
                product_id: <?php echo $product_id; ?>,
                quantity: $('#quantity').val(),
                title: '<?php echo addslashes($product['name']); ?>',
                price: <?php echo $product['price']; ?>,
                image: '<?php echo addslashes($product['image']); ?>',
                size: '<?php echo addslashes($product['size']); ?>' // Pass size to add_to_cart.php
            },
            success: function(response) {
                alert('Added to cart!');
                location.reload(); // Refresh to update cart count
            },
            error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.error('Response:', xhr.responseText);
           }
        });
    });
});
</script>

<?php include 'footer.php'; ?>