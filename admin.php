<?php
include('dbconnect.php');
session_start();

// Check if admin is logged in

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit();
}

$email = $_SESSION['admin'];

$sql_user="SELECT COUNT(*) AS count FROM users";
$res_users=$connect->query($sql_user);
$row_user=$res_users->fetch_assoc();
$userCount=$row_user['count'];
//echo $userCount;

$sql_cookbook="SELECT COUNT(*) AS count FROM community_cookbook";
$res_cookbook=$connect->query($sql_cookbook);
$row_cookbook=$res_cookbook->fetch_assoc();
$cookbookCount=$row_cookbook['count'];


$sql_recipes="SELECT COUNT(*) AS count FROM recipes";
$res_recipes=$connect->query($sql_recipes);
$row_recipes=$res_recipes->fetch_assoc();
$recipesCount=$row_recipes['count'];

$sql_resources="SELECT COUNT(*) AS count FROM resources";
$res_resources=$connect->query($sql_resources);
$row_resources=$res_resources->fetch_assoc();
$resourcesCount=$row_resources['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FoodFusion - Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation -->
<nav>
    <ul>
        <li><a href="admin.php" class="active">Admin</a></li>
        <li><a href="receipe_setup.php">Recipes Set up</a></li>
        <li><a href="resources_setup.php">Resources Set up</a></li>
        <li><a href="manage_cookbook.php">Manage Cookbook</a></li>
        <li><a href="manage_contact.php">Manage Contact</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container_admin">

    <div class="item">
        <h3>Total User Count </h3>
        <h2><?php echo $userCount; ?></h2>
    </div>
    <div class="item">
         <h3>Total Number of Receipe </h3>
        <h2><?php echo $recipesCount; ?></h2>
    </div>
    <div class="item">
         <h3>Total Number of Posted Cookbook </h3>
        <h2><?php echo $cookbookCount; ?></h2>
    </div>
    <div class="item">
         <h3>Total Number of Resources </h3>
        <h2><?php echo $resourcesCount; ?></h2>
    </div>

</div>

<footer>
     <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="#">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>