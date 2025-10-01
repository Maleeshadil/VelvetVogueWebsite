<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->

    <link rel="stylesheet" href="./asset/FontAwesome/css/all.min.css" />
    <link rel="stylesheet" href="./asset/FontAwesome/css/fontawesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold text-dark mb-3">Login to Velvet Vogue</h1>
            <p class="lead text-muted">Access your account to explore our collections.</p>
        </div>
    </section>

    <!-- Login Form Section -->
    <section class="login-form py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card p-4 shadow-sm">
                        <form action="" method="post" class="login">
                            <h2 class="h4 fw-bold text-dark mb-4 text-center">Login</h2>
                            <div class="mb-3">
                                <label for="userName" class="form-label text-dark fw-semibold">Username</label>
                                <input type="text" class="form-control form-control-lg" name="userName" id="userName"
                                    placeholder="Enter Your Username">
                                <div id="userNameError" class="error-message mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label text-dark fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg" name="pass" id="pass"
                                    placeholder="Enter Your Password">
                                <div id="passError" class="error-message mt-1"></div>
                            </div>
                            <button type="submit" name="loginBtn" id="btnLogin">Login</button>
                            <p class="signup-text text-center mt-3">
                                Not a member? <a href="register.php" class="signup-link">Signup</a>.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>

</html>

<?php include 'footer.php'; ?>