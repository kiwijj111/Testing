<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
// check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}
 $email=$_SESSION['email'];
include("dbconnect.php"); ?>
<body>

 <header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php"class="active">About Us</a></li>
                    <li><a href="recipes.php">Recipes</a></li>
                    <li><a href="cookbook.php">Post Cookbook</a></li>
                    <li><a href="cookbookForum.php">Cookbook Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="culinary.php">Culinary Resources</a></li>
                    <li><a href="educational.php">Educational Resources</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

<div class="container">
    <h1>About FoodFusion</h1>
    <p>We inspire home cooks worldwide with recipes, cooking tips, and food stories that connect people through culture and creativity.</p>

    <h2>Our Philosophy</h2>
    <div class="card">
        <p>To inspire and encourage everyone to enjoy cooking with simple, reliable recipes and tutorials. </p>
    </div>

    <h2>Meet Our Team</h2>
    <div class="team-grid">
        <div class="team-member">
            <img src="images/founder.png" alt="Maria Lopez" class="team-photo">
            <h3>Quinn Moore</h3>
            <p>Founder & Chief Culinary Officer</p>
        </div>
        <div class="team-member">
            <img src="images/RecipeDeveloper.png" alt="John Smith" class="team-photo">
            <h3>Jordan Wilson</h3>
            <p>Head Chef/Recipe Developer</p>
        </div>
        <div class="team-member">
            <img src="images/Jamie Miller.png" alt="Sophia Chen" class="team-photo">
            <h3>Jamie Miller</h3>
            <p>Food Writer & Content Creator</p>
        </div>
          <div class="team-member">
            <img src="images/Taylor Johnson.png" alt="Sophia Chen" class="team-photo">
            <h3>Taylor Johnson</h3>
            <p>Nutrition Expert</p>
        </div>
          <div class="team-member">
            <img src="images/Drew Jackson.png" alt="Sophia Chen" class="team-photo">
            <h3>Drew Jackson</h3>
            <p>Photography & Visual Specialist</p>
        </div>
    </div>
</div>

<footer>
     <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>