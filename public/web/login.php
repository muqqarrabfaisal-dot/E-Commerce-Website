<?php

require_once __DIR__ . '/../../app/Controllers/Web/AuthController.php';
require_once '../../app/Middleware/GuestMiddleware.php';

$authController = new AuthController();

$authController->login();

$guestmiddleware = new GuestMiddleware();
$guestmiddleware->handle(2,'index.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro - Login</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* Base Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #FBFBFC;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #1E1F29;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 15px;
        }

        /* Login Card */
        .login-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 2px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #D10024; /* Electro Red Accent */
            text-align: left;
        }

        /* Logo Styling based on image_bafc74.png */
        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo h1 {
            font-size: 36px;
            font-weight: 700;
            margin: 0;
            color: #15161D;
            letter-spacing: -1px;
        }

        .logo h1 span {
            color: #D10024; /* The red dot */
        }

        h2 {
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 30px;
            color: #1E1F29;
            text-align: center;
            border-bottom: 1px solid #E4E7ED;
            padding-bottom: 15px;
        }

        /* Form Controls */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #E4E7ED;
            background-color: #FFF;
            font-family: inherit;
            box-sizing: border-box;
            outline: none;
            transition: 0.2s border-color;
        }

        .input-group input:focus {
            border-color: #D10024;
        }

        /* Footer Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-options a {
            color: #1E1F29;
            text-decoration: none;
            transition: 0.2s;
        }

        .form-options a:hover {
            color: #D10024;
        }

        /* Red Action Button */
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #D10024;
            color: #FFF;
            border: none;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 40px; /* Matching the Search button style */
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #15161D;
            box-shadow: 0px 5px 10px rgba(209, 0, 36, 0.2);
        }

        .signup-text {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }

        .signup-text a {
            color: #D10024;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <h1>Electro<span>.</span></h1>
            </div>
            
            <h2>User Login</h2>

            <form action="#" method="POST">
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-options">
                    <label style="cursor: pointer;">
                        <input type="checkbox" style="accent-color: #D10024;"> Remember Me
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button name="btnsub" type="submit" class="login-btn">Log In</button>
            </form>

            <div class="signup-text">
                Don't have an account? <a href="register.php">Register Now</a>
            </div>
        </div>
    </div>

</body>
</html>