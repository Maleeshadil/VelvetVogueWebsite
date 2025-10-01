<?php
include 'header.php';

?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold text-dark mb-3">About Us</h1>
        <p class="lead text-muted">Discover our story, mission, and the team behind Velvet Vogue.</p>
    </div>
</section>

<!-- Our Story Section -->
<section class="about-story py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="h3 fw-bold text-dark mb-3">Our Story</h2>
                <p class="text-muted">
                    Velvet Vogue was founded in 2018 with a passion for bringing timeless fashion to everyone. What
                    started as a small boutique in Colombo has grown into a beloved online store, offering curated
                    collections of high-quality clothing for all occasions. Our journey is driven by a commitment to
                    style, sustainability, and customer satisfaction.
                </p>
                <p class="text-muted">
                    We believe fashion is more than just clothing it's a way to express yourself. That’s why we
                    carefully select each piece to ensure it meets our standards of elegance and comfort.
                </p>
            </div>
            <div class="col-md-6">
                <img src="./image/Aboutimg.jpg" class="img-fluid rounded shadow-sm" alt="Our Story">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Mission -->
            <div class="col-md-6">
                <div class="card h-100 text-center p-4">
                    <h3 class="h4 fw-bold text-dark mb-3">Our Mission</h3>
                    <p class="text-muted">
                        To empower individuals through fashion by providing stylish, sustainable, and affordable
                        clothing that inspires confidence and self-expression.
                    </p>
                </div>
            </div>
            <!-- Vision -->
            <div class="col-md-6">
                <div class="card h-100 text-center p-4">
                    <h3 class="h4 fw-bold text-dark mb-3">Our Vision</h3>
                    <p class="text-muted">
                        To become a global leader in sustainable fashion, creating a world where style and
                        responsibility go hand in hand.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="team-section py-5">
    <div class="container">
        <h2 class="text-center h3 fw-bold text-dark mb-5">Meet Our Team</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Team Member 1 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="./image/SEO.jpg" class="card-img-top rounded-circle mx-auto mt-3"
                        alt="Team Member 1" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title h6 fw-bold text-dark">Ayesha Perera</h5>
                        <p class="card-text small text-muted">Founder & CEO</p>
                        <p class="card-text small text-muted">Ayesha leads Velvet Vogue with a vision for sustainable
                            fashion and timeless style.</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="./image/CD.jpg" class="card-img-top rounded-circle mx-auto mt-3"
                        alt="Team Member 2" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title h6 fw-bold text-dark">Nimal Fernando</h5>
                        <p class="card-text small text-muted">Creative Director</p>
                        <p class="card-text small text-muted">Nimal curates our collections, ensuring every piece
                            reflects our brand’s elegance.</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="./image/MM.jpg" class="card-img-top rounded-circle mx-auto mt-3"
                        alt="Team Member 3" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title h6 fw-bold text-dark">Sanjana Wijesinghe</h5>
                        <p class="card-text small text-muted">Marketing Manager</p>
                        <p class="card-text small text-muted">Sanjana connects with our community, spreading the love
                            for Velvet Vogue.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call-to-Action Section -->
<section class="cta-section py-5 text-center bg-light">
    <div class="container">
        <h2 class="h3 fw-bold text-dark mb-3">Ready to Explore Our Collections?</h2>
        <p class="text-muted mb-4">Discover the perfect style for every occasion with Velvet Vogue.</p>
        <a href="shop.php" class="btn btn-primary btn-lg">Shop Now</a>
    </div>
</section>

<?php include 'footer.php'; ?>