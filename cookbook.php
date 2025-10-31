<?php
include('dbconnect.php');
session_start();
// check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}
 $email=$_SESSION['email'];

 $sql1="SELECT * FROM users WHERE email='$email'";
 $r=$connect->query($sql1);
 $row=$r->fetch_assoc();
 $username= $row['first_name']." ".$row['last_name'];
//  echo $username;

if(isset($_GET['btnSubmit'])) {
    $title = $_GET['title'];
    $ingredient = $_GET['ingredient'];
    $instruction = $_GET['instruction'];
    
    // Fixed the SQL query - added proper escaping to prevent SQL injection
    $title = $connect->real_escape_string($title);
    $ingredient = $connect->real_escape_string($ingredient);
    $instruction = $connect->real_escape_string($instruction);
    
    $sql = "INSERT INTO community_cookbook (cookbook_id, recipe_title, instructions, ingredients, submitted_by, created_at)
            VALUES (NULL, '$title', '$instruction', '$ingredient', '$username', current_timestamp())";
    
    if($connect->query($sql) == TRUE) {
        echo "Inserted successfully";
        header("location: cookbook.php");
        exit(); // Added exit after header redirect
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community Cookbook - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>



  <header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="recipes.php">Recipes</a></li>
                    <li><a href="cookbook.php"class="active">Post Cookbook</a></li>
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
    <h1>Community Cookbook</h1>
    <p>Share your favorite recipes and connect with other food lovers!</p>

    <div class="card">
        <h3>Submit Your Recipe</h3>
        <form method="GET"> <!-- Added method attribute -->
            <input type="text" placeholder="Recipe Title" name="title" required>
            <textarea placeholder="Ingredients" name="ingredient" required></textarea>
            <textarea placeholder="Instructions" name="instruction" required></textarea> <!-- Fixed name attribute -->
            <button type="submit" name="btnSubmit">Submit</button>
        </form>
    </div>

    <h2>Recent Submissions</h2>
    <div class="card">
        <strong>Alice</strong> - Homemade Lasagna
    </div>
    <div class="card">
        <strong>Bob</strong> - Thai Green Curry
    </div>
</div>

<footer>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="#">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>