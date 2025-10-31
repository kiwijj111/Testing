<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

include("dbconnect.php");
if(Isset($_GET['btnSend']))
{
    $name=$_GET['uname'];
    $email=$_GET['email'];
    $sub=$_GET['sub'];
    $msg=$_GET['msg'];
    $sql="INSERT INTO contact_messages (message_id, name, email, subject, message,created_at) VALUES (NULL, '$name', '$email', '$sub', '$msg', current_timestamp())"; 
    if($connect->query($sql)==TRUE)
    {
        echo "Insert successfully";
        header("location:contact.php");
    }

}
?>
    <header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
               <ul>
                  <li><a href="index_users.php">Home</a></li>
                  <li><a href="about_users.php" >About Us</a></li>
                  <li><a href="recipes_users.php">Recipes</a></li>
                  <li><a href="contact_users.php" class="active" >Contact</a></li>
                  <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

<div class="container">
    <h1>Contact Us</h1>
    <p>We’d love to hear from you! Send us your feedback or recipe requests.</p>

   <div class="card">
        <form method="GET" action=#>
            <input type="text" placeholder="Your Name" name="uname" required>
            <input type="email" placeholder="Your Email" name="email" required>
            <input type="text" placeholder="Subject" name="sub" >
            <textarea placeholder="Your Message" name="msg" required></textarea>
            <button type="submit" name="btnSend">Send Message</button>
        </form>
    </div>
</div>

<footer>
     <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="#">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>
