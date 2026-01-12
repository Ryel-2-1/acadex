<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* 1. General Page Styling */
        body {
            background-color: #f0f0f2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* 2. Main Container */
        .login-container {
            width: 100%;
            max-width: 400px;
            text-align: center;
            padding: 20px;
        }

        /* 3. Header Section (Icon + Text) */
        .header-icon {
            font-size: 48px;
            color: #00C060; /* Student Green Color */
            margin-bottom: 10px;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin: 10px 0 5px 0;
        }

        p.subtitle {
            color: #333;
            font-size: 16px;
            margin-bottom: 30px;
        }

        /* 4. The White Card */
        .login-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            text-align: left;
        }

        /* 5. Form Elements */
        label {
            display: block;
            font-size: 14px;
            color: #000;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
        }

        /* Green focus border for students */
        .input-group input:focus {
            border-color: #00C060; 
        }

        .input-group input::placeholder {
            color: #bbb;
        }

        /* 6. Remember Me & Forgot Password */
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .actions a {
            color: #00C060; /* Green Link */
            text-decoration: none;
            font-weight: 500;
        }

        /* 7. Buttons */
        .btn-primary {
            width: 100%;
            background-color: #00C060; /* Green Button */
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background-color: #00a352;
        }

        /* 8. Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #000;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider::before {
            margin-right: 10px;
        }

        .divider::after {
            margin-left: 10px;
        }

        /* 9. Secondary Button */
        .btn-secondary {
            width: 100%;
            background-color: white;
            color: #000;
            border: 1px solid #ccc;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="header-content">
            <i class="fa-solid fa-graduation-cap header-icon"></i>
            <h1>Student Portal</h1>
            <p class="subtitle">Sign in to manage your class and students.</p>
        </div>

        <div class="login-card">
            <form onsubmit="event.preventDefault()">
                
                <label for="email">Email Address</label>
                <div class="input-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" id="email" placeholder="Sample@Student.edu">
                </div>

                <label for="password">Password</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" placeholder="•••••••••••••••••••••">
                </div>

                <div class="actions">
                    <label style="margin:0; font-weight: 400; cursor: pointer;">
                        Remember me
                    </label>
                    <a href="#">Forget Password?</a>
                </div>

                <button class="btn-primary">Sign in</button>

                <div class="divider">Are you a Teacher?</div>

                <button class="btn-secondary">Go to Teacher Login</button>

            </form>
        </div>
    </div>

</body>
</html>