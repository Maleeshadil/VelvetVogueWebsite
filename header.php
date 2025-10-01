<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet Vogue</title>

    <!-- Css Links-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" />
    <!-- Include Font Awesome -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="FontAwesome/css/all.min.css" />
    <link rel="stylesheet" href="FontAwesome/css/fontawesome.min.css" />
    <!--Jquery Link-->
    <script src="jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="nav-container">
        <nav class="navbar custom-navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div>
                <img src="./image/Logo.png" alt="logo" width="50" height="50" class="d-inline-block align-top">
                <a class="navbar-brand" href="index.php">Velvet Vogue</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>"
                            href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'shop.php') ? 'active' : ''; ?>"
                            href="shop.php">Shop</a>
                    </li>
                    <?php if (!isset($_SESSION['Admin_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>"
                                href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>"
                                href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'active' : ''; ?>"
                                href="login_from.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'register.php') ? 'active' : ''; ?>"
                                href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'account.php') ? 'active' : ''; ?>"
                                href="account.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'active' : ''; ?>"
                                href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['User_name'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php') ? 'active' : ''; ?>"
                                href="admin_dashboard.php">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin_logout.php') ? 'active' : ''; ?>"
                                href="admin_logout.php">Admin Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (!isset($_SESSION['Admin_id'])): ?>
                        <li class="nav-item cart">
                        <img src="./image/shopping-cart.png" alt="cart" width="30" height="30">
                        <a class="nav-link" href="cart.php">
                            Cart <span class="badge badge-primary"><?php echo count($_SESSION['cart'] ?? []); ?></span>
                        </a>
                       </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</body>
<script src ="script.js"></script>
</html>