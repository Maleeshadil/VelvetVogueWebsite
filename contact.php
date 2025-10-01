<?php
include 'header.php';
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold text-dark mb-3">Contact Us</h1>
        <p class="lead text-muted">We’d love to hear from you. Get in touch today!</p>
    </div>
</section>

<!-- Contact Information Section -->
<section class="contact-info py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4" style="background-color: #CBE2B5;">
                    <h3 class="h5 fw-bold text-dark mb-3">Address</h3>
                    <p class="text-muted mb-0">123 Fashion Lane, Colombo 03, Sri Lanka</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4" style="background-color: #CBE2B5;">
                    <h3 class="h5 fw-bold text-dark mb-3">Phone</h3>
                    <p class="text-muted mb-0">+94 112 345 678</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4" style="background-color: #CBE2B5;">
                    <h3 class="h5 fw-bold text-dark mb-3">Email</h3>
                    <p class="text-muted mb-0">support@velvetvogue.com</p>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card text-center p-4" style="background-color: #CBE2B5;">
                    <h3 class="h5 fw-bold text-dark mb-3">Operating Hours</h3>
                    <p class="text-muted mb-0">Monday - Friday: 9:00 AM - 6:00 PM</p>
                    <p class="text-muted mb-0">Saturday: 10:00 AM - 4:00 PM</p>
                    <p class="text-muted mb-0">Sunday: Closed</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form py-5 bg-light">
    <div class="container">
        <h2 class="text-center h3 fw-bold text-dark mb-4">Send Us a Message</h2>
        <div class="card p-4 shadow-sm">
            <form action="contact-submit.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label text-dark fw-semibold">Your Name</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                        placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label text-dark fw-semibold">Your Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                        placeholder="Your Email" required>
                </div>
                <div class="col-12">
                    <label for="subject" class="form-label text-dark fw-semibold">Subject</label>
                    <input type="text" class="form-control form-control-lg" id="subject" name="subject"
                        placeholder="Subject" required>
                </div>
                <div class="col-12">
                    <label for="message" class="form-label text-dark fw-semibold">Your Message</label>
                    <textarea class="form-control form-control-lg" id="message" name="message" rows="5"
                        placeholder="Your Message" required></textarea>
                </div>
                <div class="col-12 text-center m-5">
                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="location-section py-5">
    <div class="container">
        <h2 class="text-center h3 fw-bold text-dark mb-4">Visit Us</h2>
        <div class="ratio ratio-16x9">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d8638.603599270686!2d79.84683872310332!3d6.9124462853609865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s23%20Fashion%20Lane%2C%20Colombo%2003!5e0!3m2!1sen!2slk!4v1749121081178!5m2!1sen!2slk"
                class="w-100 h-100 rounded shadow-sm border-0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <p class="text-center text-muted mt-3">Find us at 123 Fashion Lane, Colombo 03. We’re located in the heart of
            the city!</p>
    </div>
</section>

<!-- Call-to-Action Section -->
<section class="cta-section py-5 text-center">
    <div class="container">
        <h2 class="h3 fw-bold text-dark mb-3">Have Questions? Let’s Talk!</h2>
        <p class="text-muted mb-4">Reach out to us or explore our latest collections today.</p>
        <div class="button-group">
            <a href="contact.php" class="btn btn-outline-primary btn-lg">Contact Us</a>
            <a href="shop.php" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>