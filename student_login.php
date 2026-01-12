<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // In a real app, verify credentials from database here
    $_SESSION['user_role'] = 'student';
    header("Location: student.html"); // Redirect to the main dashboard
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #f0f0f2; 
            font-family: 'Segoe UI', sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-container { width: 100%; max-width: 400px; text-align: center; padding: 20px; }
        
        /* Header Section */
        .header-icon { font-size: 48px; color: #00C060; margin-bottom: 10px; }
        h1 { font-size: 28px; font-weight: 700; color: #000; margin: 10px 0 5px 0; }
        p.subtitle { color: #333; font-size: 16px; margin-bottom: 30px; }
        
        /* Card Styling */
        .login-card { 
            background: #ffffff; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
            text-align: left; 
        }
        
        /* Inputs */
        label { display: block; font-size: 14px; color: #000; margin-bottom: 8px; margin-top: 15px; font-weight: 500; }
        .input-group { position: relative; }
        .input-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #999; font-size: 18px; }
        .input-group input { 
            width: 100%; 
            padding: 12px 15px 12px 45px; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            font-size: 14px; 
            box-sizing: border-box; 
            outline: none; 
            color: #333;
        }
        .input-group input::placeholder { color: #bbb; }
        .input-group input:focus { border-color: #00C060; }
        
        /* Remember Me & Forget Password Row */
        .actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0; /* Override generic label margin */
            cursor: pointer;
            color: #333;
            font-weight: 400;
        }
        .forget-pass {
            color: #00C060;
            text-decoration: none;
            font-weight: 500;
        }
        .forget-pass:hover { text-decoration: underline; }

        /* Buttons */
        .btn-primary { 
            width: 100%; 
            background-color: #00C060; 
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 8px; 
            font-size: 16px; 
            font-weight: 600; 
            margin-top: 25px; 
            cursor: pointer; 
            transition: background 0.2s;
        }
        .btn-primary:hover { background-color: #00a352; }
        
        /* Divider */
        .divider { display: flex; align-items: center; text-align: center; margin: 25px 0 15px 0; color: #000; font-size: 14px; }
        .divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid #ddd; }
        .divider-text { padding: 0 10px; background: white; color: #333; }
        
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
        .btn-secondary:hover { background-color: #f9f9f9; }

        /* Sign Up Footer */
        .signup-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #333;
        }
        .signup-footer a {
            color: #000;
            text-decoration: underline;
            font-weight: 600;
        }
        .signup-footer a:hover { color: #00C060; }

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
            <form method="POST">
                
                <label>Email Address</label>
                <div class="input-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" placeholder="Sample@Student.edu" required>
                </div>
                
                <label>Password</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="******************" required>
                </div>

                <div class="actions-row">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forget-pass">Forget Password?</a>
                </div>

                <button type="submit" class="btn-primary">Sign in</button>
                
                <div class="divider"><span class="divider-text">Are you a Teacher?</span></div>
                
                <button type="button" class="btn-secondary" onclick="window.location.href='teacher_login.php'">Go to Teacher Login</button>

                <div class="signup-footer">
                    Don't have an account? <a href="StudentSignup.php">Sign Up</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>