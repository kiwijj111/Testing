<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FoodFusion - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation -->
<header>
    <div class="header-container">
        <div class="logo">Food<span>Fusion</span></div>
        <nav>
            <ul>
                <li><a href="index_users.php">Home</a></li>
                <li><a href="about_users.php">About Us</a></li>
                <li><a href="recipes_users.php">Recipes</a></li>
                <li><a href="contact_users.php">Contact</a></li>
                <li><a href="login.php" class="active">Login</a></li>
            </ul>
        </nav>
    </div>
</header>

<?php
include("dbconnect.php");

// Start session at the very top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is already logged in
if(isset($_SESSION['admin'])) {
    header("location:admin.php");
    exit();
}
if(isset($_SESSION['email'])) {
    header("location:index.php");
    exit();
}

if(isset($_POST['btnLogin']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // First check for admin user
    $sql = "SELECT * FROM users WHERE email='$email' AND usertype='0'";
    $result = $connect->query($sql);

    if($result && $result->num_rows > 0)
    {
        $admin = $result->fetch_assoc();
        
        // Direct password comparison for admin
        if($password == $admin['password_hash']) 
        {
            $_SESSION['admin'] = $email;
            header("location:admin.php");
            exit();
        }
        else
        {
            $error = "Invalid admin password.";
        }
    }
    else
    {
        // Check for regular user
        $sql = "SELECT * FROM users WHERE email='$email' AND usertype='1'";
        $result = $connect->query($sql);

        if($result && $result->num_rows > 0)
        {
            $user = $result->fetch_assoc();
            $failed_attempts = $user['failed_attempts'];
            $lockout_time   = $user['lockout_time'];

            // Check if account is locked
            if($failed_attempts >= 3 && strtotime($lockout_time) > time())
            {
                $error = "Your account is locked. Try again later.";
            }
            else
            {
                // Verify password for regular user
                if(password_verify($password, $user['password_hash']))
                {
                    // Reset failed attempts
                    $update_sql = "UPDATE users SET failed_attempts=0, lockout_time=NULL WHERE user_id='{$user['user_id']}'";
                    $connect->query($update_sql);

                    $_SESSION['email'] = $email;
                    header("location:index.php");
                    exit();
                }
                else
                {
                    // Increment failed attempts
                    $failed_attempts++;

                    if($failed_attempts >= 3)
                    {
                        $lock_time = date("Y-m-d H:i:s", strtotime("+5 minutes"));
                        $update_sql = "UPDATE users SET failed_attempts='$failed_attempts', lockout_time='$lock_time' WHERE user_id='{$user['user_id']}'";
                        $connect->query($update_sql);

                        $error = "Too many failed attempts. Your account is locked for 5 minutes.";
                    }
                    else
                    {
                        $update_sql = "UPDATE users SET failed_attempts='$failed_attempts' WHERE user_id='{$user['user_id']}'";
                        $connect->query($update_sql);

                        $error = "Invalid email or password. Attempt $failed_attempts of 3.";
                    }
                }
            }
        }
        else {
            $error = "No account found with this email.";
        }
    }
}
?>

<div class="login-container">
    <h1>Login</h1>
    
    <?php if(isset($error)): ?>
        <div class="alert alert-error">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['registration']) && $_GET['registration'] == 'success'): ?>
        <div class="alert alert-success">
            Registration successful! Please login with your credentials.
        </div>
    <?php endif; ?>
    
    <div>
        <form class="login-form" method="POST" action="">
            <input type="email" placeholder="Your Email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" name="btnLogin" class="login-btn">Login</button>
        </form>
        <div class="login-footer">
            <p>
                Not a member? Register <a href="registration.php" class="register-link">here</a>
            </p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>