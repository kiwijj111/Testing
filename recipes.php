<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Recipes - FoodFusion</title> 
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
if (isset($_POST['BtnSearch'])) 
    { 
  $txtSearch=$_POST['txtSearch']; 
  $type=$_POST['custype']; 
  if(!empty($type) && !empty($txtSearch)){
        $sql = "SELECT * FROM recipes WHERE cuisine_type = '$type' AND title LIKE '%$txtSearch%'";
    }
    elseif (!empty($type)) 
    {
         $sql = "SELECT * FROM recipes WHERE cuisine_type = '$type'";//filter with type
    }
    elseif(!empty($txtSearch)) 
    {
        $sql = "SELECT * FROM recipes WHERE title LIKE '%$txtSearch%' OR description LIKE '%$txtSearch%'";
    } 
    else {
        $sql = "SELECT * FROM recipes"; // fallback: no filter
    }
  $result=$connect->query($sql);  
} 
else{ 
  $sql="SELECT * FROM recipes";  
  $result=$connect->query($sql);  
} 
?>  
<body> 
 
  <header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="recipes.php"class="active">Recipes</a></li>
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
    <?php 
    if($result->num_rows>0) 
    { 
    ?> 
    <h1>Recipe Collection</h1> 
    <p>Explore recipes from around the world.</p> 
 
    <!-- <div class="card "> --> 
    <form action="#" method="POST" class="card row"> 
        <input type="text" placeholder="Search recipes..." name="txtSearch"> 
         <select name="custype"> 
                <option value="">All Cuisines</option> 
                <option value="Italian">Italian</option> 
                <option value="Chinese">Chinese</option> 
                <option vluae="Myanmar">Myanmar</option> 
                <option value="Thai">Thai</option> 
                <option value="Japanese">Japanese</option> 
            </select> 
            <input type="submit" value="Search" name="BtnSearch"> 
    </form> 
    <!-- </div> --> 
<?php 
  while($row=$result->fetch_assoc()) 
  { 
?> 
    <div class="card row1 "> 
        <div> 
        <h3><?php echo $row['title'] ?></h3> 
        <p><b>Description: </b><?php echo $row['description'] ?></p> 
        <p><b>Cuisine_type: </b><?php echo $row['cuisine_type'] ?></p> 
        <p><b>Dietary_preference: </b><?php echo $row['dietary_preference'] ?></p> 
        <p><b>Difficulty_level: </b><?php echo $row['difficulty_level'] ?></p> 
        <p><?php echo $row['created_by'] ?></p> 
        <p><?php echo $row['created_at'] ?></p> 
</div> 
<img src="<?php echo "UploadFiles\\" . $row['image_url'];?>"> 
    </div> 
 
    <?php 
  } 
    }else 
    echo "There is no recipes data."; 
    ?> 
</div> 
 
<footer> 
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p> 
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p> 
</footer> 
 
</body> 
</html>