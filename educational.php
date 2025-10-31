<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Educational Resources - FoodFusion</title>
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
    include("dbconnect.php"); 
    $sql="SELECT * FROM resources WHERE category='educational'"; 
    $result=$connect->query($sql); 
 
?> 


<body>

<header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="recipes.php">Recipes</a></li>
                    <li><a href="cookbook.php">Post Cookbook</a></li>
                    <li><a href="cookbookForum.php">Cookbook Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="culinary.php">Culinary Resources</a></li>
                    <li><a href="educational.php"class="active">Educational Resources</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

<div class="container">
      <?php 
        if($result->num_rows>0) 
        { 
    ?> 
    <h1>Educational Resources</h1>
    <p>Learn more about cooking science and nutrition.</p>
    <div class="resource-list">
     <?php 
            while($row=$result->fetch_assoc()) 
            { 
        ?> 
        
    
        <div class="resource-item">
        <h3><?php echo $row['title']; ?> </h3> 
        <p><b>Description: </b><?php echo $row['description']; ?></p> 
            <p><b>Download Resource File : </b><?php echo $row['file_url']; ?></p> 
            <?php echo $row['file_url']; ?>
                            <a href="download.php?file=<?php echo urlencode($row['file_url']); ?>">Download</a>
            <p><?php echo $row['created_at']; ?></p>   
        </div>
        <?php 
            } 
        ?> 
      </div>
       
        <?php 
            } 
        ?> 
</div>

<footer>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="#">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>
