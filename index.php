<?php
include 'header.php';

// Attempt to include db.php with error handling
$dbIncluded = @include 'includes/db.inc.php';
if (!$dbIncluded) {
    die('Error: Could not include db.php. Please check the file path or ensure it exists in the correct directory.');
}

// Check if $conn is initialized
if (!isset($conn)) {
    die('Error: Database connection failed. Please check db.inc.php for correct configuration.');
}

// Load New Arrivals (limit to 4)
$new_arrivals_stmt = $conn->query('SELECT * FROM products ORDER BY id DESC LIMIT 4');
$new_arrivals = [];
while ($row = $new_arrivals_stmt->fetch_assoc()) {
    $new_arrivals[] = $row;
}

// Load Young’s Favourite (limit to 2)
$youngs_favourite_stmt = $conn->query('SELECT * FROM products ORDER BY id DESC LIMIT 2');
$youngs_favourite = [];
while ($row = $youngs_favourite_stmt->fetch_assoc()) {
    $youngs_favourite[] = $row;
}

?>


<!-- Hero Section -->
<section class="hero-section container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-left">
                <div class="hero-content">
                    <h1 class="display-4 txt-1">LET'S </h1>
                    <h1 class="display-4">EXPLORE </h1>
                    <h1 class="display-4 txt-3">UNIQUE </h1>
                    <h1 class="display-4">CLOTHES.</h1>
                    <p class="lead">Live for influential and innovative fashion!</p>
                    <a href="shop.php" class="btn  btn-lg mt-3">Shop Now</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="./image/lady-pink-clothes.png" alt="Hero Image" class="img-fluid"
                    style="max-width: 100%; height: auto; width: 450px;">
            </div>
        </div>
    </div>
</section>

<!-- Brand Partners -->
<section class="brand-partners text-center py-5">
    <div class="container">
        <h2 class="h4 mb-4">Our Brand Partners</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
            <img src="./image/moose.png" alt="Moose" class="brand-logo">
            <img src="./image/rebron.png" alt="Rebron" class="brand-logo">
            <img src="./image/emerald.png" alt="Emerald" class="brand-logo">
            <img src="./image/levi's.png" alt="Levi's" class="brand-logo">
            <img src="./image/H and M.png" alt="H&M" class="brand-logo">
            <img src="./image/Boss.png" alt="Boss" class="brand-logo">
        </div>
    </div>
</section>

<!-- New Arrivals -->
<section class="new-arrivals container my-5">
    <h2 class="text-center h4">NEW ARRIVALS</h2>
    <div class="row row-cols-2 row-cols-md-4 g-4" id="new-arrivals-container">
        <?php foreach ($new_arrivals as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title h6"><?php echo htmlspecialchars(substr($product['name'], 0, 20)); ?>...</h5>
                        <p class="card-text small">Size: <?php echo htmlspecialchars($product['size']); ?></p>
                        <p class="card-text small">LKR <?php echo number_format($product['price'], 2); ?></p>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">View
                            Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
        <a href="shop.php" class="btn btn-outline-primary btn-lg">Explore Now</a>
    </div>
</section>

<!-- Payday Sale Banner -->
<section class="payday-sale">
    <div class="payday-sale-container">
      <div class="payday-sale-grid">
        <div class="payday-image">
          <img src="./image/img-girl.png" alt="Payday Sale Image">
        </div>
        <div class="payday-content">
          <h2>PAYDAY <br><span>SALE NOW</span></h2>
          <p>Spend minimum LKR 10,000 get 30% off voucher code for your next purchase</p>
          <p class="date"><strong>1 June - 10 June 2025</strong> </p>
          <p class="terms"><small>*Terms & Conditions apply</small></p>
          <a href="shop.php" class="shop-btn">SHOP NOW</a>
        </div>
      </div>
    </div>
  </section>

<!-- Young’s Favourite -->
<section class="youngs-favourite container my-5">
    <h2 class="text-center h4">Young’s Favourite</h2>
    <div class="row justify-content-center g-4" id="youngs-favourite-container">
        <?php foreach ($youngs_favourite as $product): ?>
            <div class="col-auto">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body text-center"> <h5 class="card-title h6">
                        <?php echo htmlspecialchars(substr($product['name'], 0, 20)); ?>...</h5>
                        <p class="card-text small" >Size: <?php echo htmlspecialchars($product['size']); ?></p>
                        <p class="card-text small">LKR <?php echo number_format($product['price'], 2); ?></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="shop.php" class="btn btn-outline-primary btn-lg">Explore Now</a>
            </div>
</section>

<!-- Newsletter Signup -->
<section class="newsletter">
    <div class="container">
        <h2 class="text-center">JOIN SHOPPING COMMUNITY TO GET MONTHLY PROMO</h2>
        <p class="text-center">Type your email down below and be young wild generation</p>
        <form class="text-center mt-3">
            <input type="email" class="form-control d-inline w-25" placeholder="Add your email here">
            <button type="submit" class="btn btn-dark">Send</button>
        </form>
    </div>
</section>

<!-- Vertically Centered Modal with Error Styling -->
  <div class="modal fade" id="sampleModal" tabindex="-1" aria-labelledby="sampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content text-center rounded-3 border border-3"
        style="background-color: #F8F9FA; border-color: #FFCDD2;">
        <div class="modal-header justify-content-center border-0">
          <!-- Error Icon -->
          <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
        </div>
        <div class="modal-body">
          <h5 class="modal-title fw-bold text-danger" id="sampleModalLabel">Error!</h5>
          <p class="fs-5">Oops! Something went wrong!</p>
        </div>
        <div class="modal-footer justify-content-center border-0">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal-ok-button">
            OK
          </button>
        </div>
      </div>
    </div>
  </div>

<?php include 'footer.php'; ?>