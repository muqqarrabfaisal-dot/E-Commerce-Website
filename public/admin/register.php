<?php
    session_start();
    require_once '../../app/Controllers/Web/AuthController.php'; 

    $auth = new AuthController();
    $auth->register();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro - Register</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

    <div class="register-container">
        <div class="register-box">
            <div class="logo">
                <h1>Electro<span>.</span></h1>
            </div>
            
            <h2>Create New Account</h2>

            <form method="POST">
                <!-- Name Row -->
                <div class="input-row">
                    <div class="input-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>

                <!-- Email & Age Row -->
                <div class="input-row">
                    <div class="input-group" style="flex: 2;">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group" style="flex: 1;">
                        <label>Phone</label>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                </div>

                <!-- Password Row -->
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <?php if(isset($_SESSION['error'])): ?>

                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                    </div>

                    <?php unset($_SESSION['error']); ?>

                    <?php endif; ?>

                <button name="submit" type="submit" class="register-btn">Create Account</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="login.php">Log In Here</a>
            </div>
        </div>
    </div>

</body>
</html>
