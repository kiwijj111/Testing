<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>resources_setup - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("dbconnect.php");
if(isset($_POST['btnSave']))
{
   $title= $_POST['title'];
   $des=$_POST['des'];
   $category= $_POST['category'];
   
   if(isset($_FILES['upFile']) && $_FILES['upFile']['error']==0)
   {
     $filename= $_FILES['upFile']['name'];
     $filepath=$_FILES['upFile']['tmp_name'];
     $destPath="UploadFiles/".$filename; // Changed backslash to forward slash
   }

  $sql= "INSERT INTO resources (resource_id, title, description, category, file_url, created_at) VALUES (NULL, '$title', '$des', '$category', '$filename', NULL)"; 
   if($connect->query($sql)==TRUE)
   {
     echo " Save Successful ";
     move_uploaded_file($filepath,$destPath);
   }
}

// Add this query to fetch resources
$sql_resources = "SELECT * FROM resources";
$result = $connect->query($sql_resources);
?>

<nav>
    <ul>
        <li><a href="admin.php">Home</a></li>
        <li><a href="receipe_setup.php">Recipes Set up</a></li>
        <li><a href="resources_setup.php"  class="active">Resources Set up </a></li>
        <li><a href="manage_cookbook.php">Manage Cookbook</a></li>
        <li><a href="manage_contact.php">Manage Contact</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
    </ul>
</nav>

<div class="container">
    <h1>Resources Set up</h1>
    <p>We'd love to hear from you! Send us your feedback or recipe requests.</p>

    <div class="card">
        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Title" name="title" required>
            <textarea placeholder="Description" name="des" required></textarea>
            Resources Category:
            <select name="category">
                <option value="culinary">Culinary</option>
                <option value="educational">Educational</option>

            </select>
            <input type="file" placeholder="File" name="upFile">
            <button type="submit" name="btnSave">Save Resources</button>
        </form>
    </div>
     <h1>Resources Information</h1>
        <?php
            if($result->num_rows>0)
            {
        ?>
        <div class="card">
        <table class="table0">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Resources category</th>
                <th>File</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php
            while($row=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $row['resource_id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td>
                    <?php 
                    if (!empty($row['file_url'])) {
                        echo "<a href='UploadFiles/" . $row['file_url'] . "' target='_blank'>Download File</a>";
                    } else {
                        echo "No file";
                    }
                    ?>
                </td>
                <td><?php echo $row['created_at']; ?></td>
                <td><a href=""> Edit </a> | <a href=""> Delete </a> </td>
            </tr>
            <?php
                }
            ?>
        </table>
        </div>
        <?php
            } else {
                echo "<p>No resources found.</p>";
            }
        ?>
</div>
<footer>
<p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p> 
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p> 
</footer> 
 
</body> 
</html>