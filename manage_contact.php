<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>manage_contact - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="admin.php">Home</a></li>
        <li><a href="receipe_setup.php">Recipes Set up</a></li>
        <li><a href="resources_setup.php">Resources Set up </a></li>
        <li><a href="manage_cookbook.php">Manage Cookbook</a></li>
        <li><a href="manage_contact.php"   class="active">Manage Contact</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
    </ul>
</nav>
<?php
include("dbconnect.php");
$sql="SELECT * FROM contact_messages";
$result=$connect->query($sql);
?>

<div class="container">
    <h1>Contact Information</h1>
    <p>We’d love to hear from you! Send us your feedback or recipe requests.</p>
    <?php
    if($result->num_rows>0)
        {
           
    ?>
    <div class="card">
      <table class="table0">
        <tr>
            <th>Id</th>
            <th>Sender Name</th>
            <th>Sender Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Send Time</th>
            <th> Action Taken </th>
        </tr>
        <?php
         while($row=$result->fetch_assoc())
            {
        ?>
         <tr>
            <td><?php echo $row['message_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><a href=""> Approve </a> | <a href=""> Reject </a> </td>
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
     <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>