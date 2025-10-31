<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage cookbook - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php 
session_start(); 
 
if(!isset($_SESSION['admin'])){ 
    header("location:login.php"); 
    exit(); 
} 
 
$email=$_SESSION['admin']; 
include("dbconnect.php");  
$sql="SELECT * FROM community_cookbook";  
$result=$connect->query($sql);  
?>

<body>

<nav>
    <ul>
        <li><a href="admin.php" >Admin</a></li>
        <li><a href="receipe_setup.php">Recipes Set up</a></li>
        <li><a href="resources_setup.php">Resources Set up </a></li>
        <li><a href="manage_cookbook.php"class="active">Manage Cookbook</a></li>
        <li><a href="manage_contact.php">Manage Contact</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
    </ul>
</nav>

<div class="container">
     <?php
    if($result->num_rows>0)
        {
           
    ?>
        
    <h1>Cookbook information</h1>
     <div class="card">
      <table class="table0">
        <tr>
            <th>Id</th>
            <th>Recipe title</th>
            <th>Instructions</th>
            <th>Ingredients</th>
            <th>Posted by</th>
            <th>Send Time</th>
        </tr>
        <?php
         while($row=$result->fetch_assoc())
            {
        ?>
         <tr>
            <td><?php echo $row['cookbook_id']; ?></td>
            <td><?php echo $row['recipe_title']; ?></td>
            <td><?php echo $row['instructions']; ?></td>
            <td><?php echo $row['ingredients']; ?></td>
            <td><?php echo $row['submitted_by']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php
            }
        ?>
       </table>
    </div>
    <?php
        }
    ?>

    
</div>

<footer>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>
