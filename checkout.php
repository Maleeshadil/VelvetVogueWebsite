<?php
include 'header.php';
$cart = $_SESSION['cart'] ?? [];
$subtotal = array_reduce($cart, function ($sum, $item) {
    return $sum + $item['quantity'] * $item['product']['price'];
}, 0);
$shipping = $subtotal > 0 ? 500 : 0; // Flat shipping fee of LKR 500
$total = $subtotal + $shipping;
?>

<div class="container py-5">
    <h1 class="mb-4 text-center text-dark">Checkout</h1>

    <div class="row">
        <!-- Cart Summary -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-light">
                    <h5 class="card-title text-primary">Order Summary</h5>
                    <p class="mb-1">Subtotal: LKR <?php echo number_format($subtotal, 2); ?></p>
                    <p class="mb-1">Shipping: LKR <?php echo number_format($shipping, 2); ?></p>
                    <hr class="my-2">
                    <h5 class="mb-0">Total: LKR <?php echo number_format($total, 2); ?></h5>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary">Shipping & Payment Details</h5>
                    <form action="process_checkout.php" method="post" id="checkout-form">
                        <div class="form-group mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="cash_on_delivery">Cash on Delivery</option>
                            </select>
                        </div>

                        <!-- Credit Card Details (hidden by default) -->
                        <div id="credit-card-details" class="collapse">
                            <div class="form-group mb-3">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="card_number" name="card_number"
                                    placeholder="1234 5678 9012 3456" required pattern="\d{16}"
                                    title="Please enter a 16-digit card number">
                            </div>
                            <div class="form-group mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="month" class="form-control" id="expiry_date" name="expiry_date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required
                                    pattern="\d{3,4}" title="Please enter a 3 or 4-digit CVV">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 mt-3">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>