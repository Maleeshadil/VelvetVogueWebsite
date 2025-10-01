<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->

    <link rel="stylesheet" href="FontAwesome/css/all.min.css" />
    <link rel="stylesheet" href="FontAwesome/css/fontawesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Register-Form</title>
</head>

<body>
    <!-- Render HTML here -->

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold text-dark mb-3">Sign Up for Velvet Vogue</h1>
            <p class="lead text-muted">Create an account to start shopping today.</p>
        </div>
    </section>

    <!-- Signup Form Section -->
    <section class="signup-form py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card p-4 shadow-sm">
                        <form action="/register.php" method="post" class="signup">
                            <h2 class="h4 fw-bold text-dark mb-4 text-center">Sign Up</h2>
                            <div class="mb-3">
                                <label for="fullName" class="form-label text-dark fw-semibold">Full Name</label>
                                <input type="text" class="form-control form-control-lg" name="fullName" id="fullName"
                                    placeholder="Enter Your Full Name">
                                <div id="fullNameError" class="error-message mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark fw-semibold">Email</label>
                                <input type="text" class="form-control form-control-lg" name="email" id="email"
                                    placeholder="Enter Your Email">
                                <div id="EmailError" class="error-message mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label text-dark fw-semibold">Username</label>
                                <input type="text" class="form-control form-control-lg" name="username" id="username"
                                    placeholder="Enter Your Username">
                                <div id="userNameError" class="error-message mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label text-dark fw-semibold">Password</label>
                                <input type="password" data-ms-member="password" class="form-control form-control-lg"
                                    name="pass" id="pass" placeholder="Enter Your Password">
                                <div class="validation-container mt-2">
                                    <div class="validation-point" ms-code-pw-validation="minlength-8">
                                        <i class="fa-solid fa-circle-check valid" ms-code-pw-validation-icon="true"></i>
                                        <i class="fa-solid fa-circle-xmark invalid"
                                            ms-code-pw-validation-icon="false"></i>
                                        Password must be over 8 characters
                                    </div>
                                    <div class="validation-point" ms-code-pw-validation="number">
                                        <i class="fa-solid fa-circle-check valid" ms-code-pw-validation-icon="true"></i>
                                        <i class="fa-solid fa-circle-xmark invalid"
                                            ms-code-pw-validation-icon="false"></i>
                                        Password must contain 1 number
                                    </div>
                                    <div class="validation-point" ms-code-pw-validation="special-character">
                                        <i class="fa-solid fa-circle-check valid" ms-code-pw-validation-icon="true"></i>
                                        <i class="fa-solid fa-circle-xmark invalid"
                                            ms-code-pw-validation-icon="false"></i>
                                        Password must contain 1 special character
                                    </div>
                                    <div class="validation-point" ms-code-pw-validation="upper-lower-case">
                                        <i class="fa-solid fa-circle-check valid" ms-code-pw-validation-icon="true"></i>
                                        <i class="fa-solid fa-circle-xmark invalid"
                                            ms-code-pw-validation-icon="false"></i>
                                        Password must contain 1 uppercase and 1 lowercase letter
                                    </div>
                                </div>
                                <div id="passError" class="error-message mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label for="cPass" class="form-label text-dark fw-semibold">Confirm Password</label>
                                <input type="password" class="form-control form-control-lg" name="cPass" id="cPass"
                                    placeholder="Confirm Your Password">
                                <div id="cpError" class="error-message mt-1"></div>
                            </div>
                            <button type="submit" name="signupBtn" id="btnsignup"
                                class="btn btn-primary btn-lg w-100 disabled">Sign Up</button>
                            <p class="signup-text text-center mt-3">
                                Already a member? <a href="login_from.php" class="signup-link">Login</a>.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>  
</body>
<script src="script.js"></script>

</html>
<?php
include 'footer.php';
?>