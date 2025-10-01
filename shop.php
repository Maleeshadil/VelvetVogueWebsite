<?php
include 'header.php';

// Attempt to include db.php with error handling
$dbIncluded = @include 'includes/db.inc.php';
if (!$dbIncluded) {
    die('Error: Could not include db.inc.php. Please check the file path or ensure it exists in the correct directory.');
}

// Check if $pdo is initialized
if (!isset($conn)) {
    die('Error: Database connection failed. Please check db.inc.php for correct configuration.');
}

// Initial load: Fetch all products
$sql = "SELECT * FROM products ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = [];
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
?>

<!-- Shop Page Content -->
<div class="container-fluid py-5">
    <div class="row">
        <!-- Filter Section (Left Side) -->
        <div class="col-md-3 filter-section">
            <div class="filter-card p-4">
                <h2 class="h5 mb-4 fw-bold text-dark">Filter Products</h2>
                <form id="filter-form" class="filter-form">
                    <button type="submit" class="btn btn-dark w-full mt-3 mb-3 d-flex align-items-center justify-content-center" style="font-weight: bold; font-size: 16px;">
                        <span class="me-2" style="display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 .4.8L10 8.5v5.9a.5.5 0 0 1-.757.429l-2-1.2a.5.5 0 0 1-.243-.429V8.5L1.1 1.8a.5.5 0 0 1 .4-.8z"/>
                            </svg>
                        </span>
                        Apply Filters
                    </button>
                    <!-- Categories Section -->
                    <div class="filter-group mb-4">
                        <h6 class="fw-bold text-dark mb-2">Categories</h6>
                        <select name="category" id="category" class="form-select">
                            <option value="">All Categories</option>
                            <option value="Formalwear">Formalwear</option>
                            <option value="Casualwear">Casualwear</option>
                            <option value="Outerwear">Outerwear</option>
                            <option value="Activewear">Activewear</option>
                            <option value="Accessories">Accessories</option>
                        </select>
                    </div>

                    <!-- Size Section -->
                    <div class="filter-group mb-4">
                        <h6 class="fw-bold text-dark mb-2">Size</h6>
                        <select name="size" id="size" class="form-select">
                            <option value="">All Sizes</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>

                    <!-- Price Range Section -->
                    <div class="filter-group mb-4">
                        <h6 class="fw-bold text-dark mb-2">Price Range</h6>
                        <select name="price_range" id="price_range" class="form-select">
                            <option value="0-999999">All Prices</option>
                            <option value="0-2000">LKR 0 - 2,000</option>
                            <option value="2000-5000">LKR 2,000 - 5,000</option>
                            <option value="5000-10000">LKR 5,000 - 10,000</option>
                            <option value="10000-999999">LKR 10,000+</option>
                        </select>
                    </div>

                    <!-- Gender Section -->
                    <div class="filter-group mb-4">
                        <h6 class="fw-bold text-dark mb-2">Gender</h6>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">All Genders</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                            <option value="Unisex">Unisex</option>
                        </select>
                    </div>

                    <!-- Sort By Section -->
                    <div class="filter-group mb-4">
                        <h6 class="fw-bold text-dark mb-2">Sort By</h6>
                        <select name="sort" id="sort" class="form-select">
                            <option value="id DESC">Newest First</option>
                            <option value="price ASC">Price: Low to High</option>
                            <option value="price DESC">Price: High to Low</option>
                        </select>
                    </div>                   
                </form>
            </div>
        </div>

        <!-- Products Section (Right Side) -->
        <div class="col-md-9 shop-products">
            <h2 class="text-center h4 mb-4">Our Products</h2>
            <div class="row row-cols-2 row-cols-md-4 g-4" id="shop-products-container">
                <?php foreach ($products as $product): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title h6"><?php echo htmlspecialchars(substr($product['name'], 0, 20)); ?>...</h5>
                                <p class="card-text small">Size: <?php echo htmlspecialchars($product['size']); ?></p>
                                <p class="card-text small">LKR <?php echo number_format($product['price'], 2); ?></p>
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                    <p class="text-center">No products found matching your filters.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>