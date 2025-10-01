<?php

include "header.php";
$cart = $_SESSION['cart'] ?? [];
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold text-dark mb-3">Your Shopping Cart</h1>
        <p class="lead text-muted">Review and proceed to checkout.</p>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8" id="cart-items">
            <?php if (empty($cart)): ?>
                <div class="alert alert-info" role="alert">
                    Your cart is empty. <a href="shop.php" class="text-primary">Continue shopping</a>.
                </div>
            <?php else: ?>
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="select-all">
                        <label class="form-check-label" for="select-all">Select All</label>
                    </div>
                    <button class="btn btn-outline-danger btn-sm" id="remove-selected">Remove Selected</button>
                </div>
                <?php foreach ($cart as $index => $item): ?>
                    <div class="card cart-item-card mb-3" id="cart-item-<?php echo $index; ?>">
                        <div class="row g-0 align-items-center p-3">
                            <div class="col-auto">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input select-product"
                                        id="select-<?php echo $index; ?>" data-index="<?php echo $index; ?>">
                                    <label class="form-check-label" for="select-<?php echo $index; ?>"></label>
                                </div>
                            </div>
                            <div class="col-3">
                                <img src="<?php echo htmlspecialchars($item['product']['image'] ?? 'placeholder.jpg'); ?>"
                                    class="img-fluid rounded product-img"
                                    alt="<?php echo htmlspecialchars($item['product']['title'] ?? 'Product'); ?>">
                            </div>
                            <div class="col">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="card-title mb-0">
                                            <?php echo htmlspecialchars($item['product']['title'] ?? 'Product'); ?></h5>
                                        <button class="btn btn-danger btn-sm remove-item"
                                            data-index="<?php echo $index; ?>">Remove</button>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label class="form-label mb-0">Size:</label>
                                            <select class="form-select form-select-sm size-select"
                                                data-index="<?php echo $index; ?>">
                                                <option value="S" <?php echo ($item['product']['size'] ?? 'M') === 'S' ? 'selected' : ''; ?>>S</option>
                                                <option value="M" <?php echo ($item['product']['size'] ?? 'M') === 'M' ? 'selected' : ''; ?>>M</option>
                                                <option value="L" <?php echo ($item['product']['size'] ?? 'M') === 'L' ? 'selected' : ''; ?>>L</option>
                                                <option value="XL" <?php echo ($item['product']['size'] ?? 'M') === 'XL' ? 'selected' : ''; ?>>XL</option>
                                                <option value="XXL" <?php echo ($item['product']['size'] ?? 'M') === 'XXL' ? 'selected' : ''; ?>>XXL</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label class="form-label mb-0">Quantity:</label>
                                            <div class="input-group input-group-sm quantity-input">
                                                <button class="btn btn-outline-dark update-qty"
                                                    data-index="<?php echo $index; ?>" data-action="decrease">-</button>
                                                <input type="number" class="form-control text-center qty-input"
                                                    value="<?php echo $item['quantity'] ?? 1; ?>" min="1"
                                                    data-index="<?php echo $index; ?>">
                                                <button class="btn btn-outline-dark update-qty"
                                                    data-index="<?php echo $index; ?>" data-action="increase">+</button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p class="card-text mb-0 fw-bold">LKR <span
                                                    class="item-total"><?php echo number_format(($item['quantity'] ?? 1) * ($item['product']['price'] ?? 0), 2); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <div id="cart-summary">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span id="subtotal">LKR 0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span>Shipping</span>
                            <span id="shipping">LKR 0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span id="total">LKR 0.00</span>
                        </div>
                    </div>
                    <button id="proceed-checkout" class="btn btn-dark w-100 mt-3" disabled>Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>