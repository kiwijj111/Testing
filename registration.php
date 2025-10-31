<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Registration - FoodFusion</title> 
    <link rel="stylesheet" href="style.css"> 
</head> 
<body> 
    <?php  
    include("dbconnect.php"); 
    
    // Check if form is submitted
    if(isset($_POST['btnReg'])) 
    { 
        $fname = $_POST['fname']; 
        $lname = $_POST['lname']; 
        $email = $_POST['email']; 
        $password = $_POST['password']; 
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Check if email already exists
        $check_sql = "SELECT * FROM users WHERE email='$email'";
        $check_result = $connect->query($check_sql);
        
        if($check_result->num_rows > 0) {
            $error = "Email already exists. Please use a different email.";
        } else {
            $sql = "INSERT INTO users (user_id, first_name, last_name, email, password_hash, failed_attempts, lockout_time, created_at, usertype) 
                    VALUES (NULL, '$fname', '$lname', '$email', '$password_hash', '0', NULL, current_timestamp(), '1')"; 
            
            if($connect->query($sql) === TRUE) 
            { 
                // Registration successful - redirect to login page
                header("location: login.php?registration=success"); 
                exit();
            } 
            else 
            {
                $error = "Registration failed. Please try again.";
            }
        }
    } 
    ?> 
 
<nav> 
    <ul> 
        <li><a href="index_users.php">Home</a></li> 
        <li><a href="about_users.php">About Us</a></li> 
        <li><a href="recipes_users.php">Recipes</a></li> 
        <li><a href="contact_users.php" >Contact</a></li> 
        <li><a href="login.php">Login</a></li> 
    </ul> 
</nav> 
 
<div class="container"> 
    <h1>Registration</h1> 
    <p>Join the best cooking community. Join us!</p> 
    
    <?php if(isset($error)): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
 
    <div class="card"> 
        <form method="POST" action="#"> 
            <input type="text" placeholder="First Name" name="fname" required> 
            <input type="text" placeholder="Last Name" name="lname" required> 
            <input type="email" placeholder="Your Email" name="email" required> 
            <input type="password" placeholder="Password" name="password" required> 
            <button type="submit" name="btnReg">Register</button> 
        </form> 
        <p style="text-align: center; margin-top: 15px;">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div> 
</div> 
 
<footer> 
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p> 
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p> 
</footer> 
 
</body> 
</html>