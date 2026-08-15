<?php

require_once __DIR__ . '/../../app/Controllers/Web/AuthController.php';

$authController = new AuthController();

$authController->register();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro - Register</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #FBFBFC;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #1E1F29;
            padding: 40px 0;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            padding: 15px;
        }

        .register-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 2px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #D10024;
        }

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
            color: #D10024;
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

        .input-row {
            display: flex;
            gap: 15px;
            margin-bottom: 5px;
        }

        .input-group {
            margin-bottom: 20px;
            flex: 1;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #E4E7ED;
            background-color: #FFF;
            font-family: inherit;
            box-sizing: border-box;
            outline: none;
            transition: 0.2s;
        }

        .input-group input:focus, .input-group select:focus {
            border-color: #D10024;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            background-color: #D10024;
            color: #FFF;
            border: none;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 40px;
            transition: 0.3s;
            margin-top: 10px;
        }

        .register-btn:hover {
            background-color: #15161D;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }

        .login-link a {
            color: #D10024;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 480px) {
            .input-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="register-box">
            <div class="logo">
                <h1>Electro<span>.</span></h1>
            </div>
            
            <h2>Create New Account</h2>

            <form action="#" method="POST">
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
                 </div>

                <!-- Password Row -->
                <div class="input-row">
                    <div class="input-group">
                        <label>Phone</label>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                </div>

                <button name="submit" type="submit" class="register-btn">Create Account</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="login.php">Log In Here</a>
            </div>
        </div>
    </div>

</body>
</html>
