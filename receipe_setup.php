<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipe Setup - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
    exit();
}
$email=$_SESSION['admin'];
include("dbconnect.php");

// Handle delete action
if(isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM recipes WHERE recipe_id='$id'";
    if($connect->query($sql)==TRUE) {
        echo "<script>alert('Recipe deleted successfully');</script>";
        header("location:receipe_setup.php");
        exit();
    }
}

if(isset($_POST['btnSave']))
{
   $title= $_POST['title'];
   $des=$_POST['description'];
   $custype= $_POST['custype'];
   $diettype=$_POST['dietPre'];
   $difflevel= $_POST['diffLevel'];
   $filename = '';
   
   if(isset($_FILES['reImage']) && $_FILES['reImage']['error']==0)
   {
     $filename= $_FILES['reImage']['name'];
     $filepath=$_FILES['reImage']['tmp_name'];
     $destPath="UploadFiles/".$filename;
     move_uploaded_file($filepath,$destPath);
   }

   $sql="INSERT INTO recipes (title, description, cuisine_type, dietary_preference, difficulty_level, image_url, created_at) 
         VALUES ('$title','$des','$custype','$diettype','$difflevel','$filename',NOW())";
   
   if($connect->query($sql)==TRUE)
   {
     echo "<script>alert('Save Successful');</script>";
     header("location:receipe_setup.php");
     exit();
   } else {
     echo "<script>alert('Error: " . $connect->error . "');</script>";
   }
}
elseif(isset($_POST['btnUpdate']))
{
    $id=$_POST['id'];
    $title=$_POST['title'];
    $des=$_POST['description'];
    $custype= $_POST['custype'];
    $diettype=$_POST['dietPre'];
    $difflevel= $_POST['diffLevel'];
    
    // Handle image update
    if(isset($_FILES['reImage']) && $_FILES['reImage']['error']==0)
    {
        $filename= $_FILES['reImage']['name'];
        $filepath=$_FILES['reImage']['tmp_name'];
        $destPath="UploadFiles/".$filename;
        move_uploaded_file($filepath,$destPath);
        
        $sql="UPDATE recipes SET 
              title='$title',
              description='$des',
              cuisine_type='$custype',
              dietary_preference='$diettype',
              difficulty_level='$difflevel',
              image_url='$filename'
              WHERE recipe_id='$id'";
    }
    else
    {
        // Keep existing image if no new image uploaded
        $sql="UPDATE recipes SET 
              title='$title',
              description='$des',
              cuisine_type='$custype',
              dietary_preference='$diettype',
              difficulty_level='$difflevel'
              WHERE recipe_id='$id'";
    }
    
    if($connect->query($sql)==TRUE)
    {
        echo "<script>alert('Update Successful');</script>";
        header("location:receipe_setup.php");
        exit();
    } else {
        echo "<script>alert('Error updating: " . $connect->error . "');</script>";
    }
}

// Check if editing
if(isset($_GET['editid']))
{
    $id=$_GET['editid'];
    $sql="SELECT * FROM recipes WHERE recipe_id='$id'";
    $result=$connect->query($sql);
    $row=$result->fetch_assoc();
}

// Get all recipes for display
$sql="SELECT * FROM recipes ORDER BY created_at DESC";
$result=$connect->query($sql);
?>
<nav>
    <ul>
        <li><a href="admin.php">Home</a></li>
        <li><a href="receipe_setup.php" class="active">Recipes Set up</a></li>
        <li><a href="resources_setup.php">Resources Set up</a></li>
        <li><a href="manage_cookbook.php">Manage Cookbook</a></li>
        <li><a href="manage_contact.php">Manage Contact</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="container">
    <h1>Recipe Setup</h1>
    <div class="card">
        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($_GET['editid'])? $row['recipe_id']:""; ?>">
            
            <div class="form-group">
                <input type="text" placeholder="Recipe Title" name="title" value="<?php echo isset($_GET['editid'])? $row['title']:""; ?>" required>
            </div>
            
            <div class="form-group">
                <textarea placeholder="Recipe Description" name="description" required><?php echo isset($_GET['editid'])? $row['description']:""; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Cuisine Type:</label>
                <select name="custype" required>
                    <option value="Italian" <?php echo (isset($_GET['editid']) && $row['cuisine_type']=='Italian')?'selected':''; ?>>Italian</option>
                    <option value="Chinese" <?php echo (isset($_GET['editid']) && $row['cuisine_type']=='Chinese')?'selected':''; ?>>Chinese</option>
                    <option value="Indian" <?php echo (isset($_GET['editid']) && $row['cuisine_type']=='Indian')?'selected':''; ?>>Indian</option>
                    <option value="Thai" <?php echo (isset($_GET['editid']) && $row['cuisine_type']=='Thai')?'selected':''; ?>>Thai</option>
                    <option value="Myanmar" <?php echo (isset($_GET['editid']) && $row['cuisine_type']=='Myanmar')?'selected':''; ?>>Myanmar</option>
                    <option value="American" <?php echo (isset($_GET['editid']) && $row['cuisine_type']=='American')?'selected':''; ?>>American</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Dietary Preference:</label>
                <select name="dietPre" required>
                    <option value="Vegetarian" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Vegetarian')?'selected':''; ?>>Vegetarian</option>
                    <option value="Non-Vegetarian" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Non-Vegetarian')?'selected':''; ?>>Non-Vegetarian</option>
                    <option value="Vegan" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Vegan')?'selected':''; ?>>Vegan</option>
                    <option value="Dairy-Free" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Dairy-Free')?'selected':''; ?>>Dairy-Free</option>
                    <option value="Halal" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Halal')?'selected':''; ?>>Halal</option>
                    <option value="Keto" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Keto')?'selected':''; ?>>Keto</option>
                    <option value="Gluten-Free" <?php echo (isset($_GET['editid']) && $row['dietary_preference']=='Gluten-Free')?'selected':''; ?>>Gluten-Free</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Difficulty Level:</label>
                <select name="diffLevel" required>
                    <option value="Very Easy" <?php echo (isset($_GET['editid']) && $row['difficulty_level']=='Very Easy')?'selected':''; ?>>Very Easy</option>
                    <option value="Easy" <?php echo (isset($_GET['editid']) && $row['difficulty_level']=='Easy')?'selected':''; ?>>Easy</option>
                    <option value="Medium" <?php echo (isset($_GET['editid']) && $row['difficulty_level']=='Medium')?'selected':''; ?>>Medium</option>
                    <option value="Hard" <?php echo (isset($_GET['editid']) && $row['difficulty_level']=='Hard')?'selected':''; ?>>Hard</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Recipe Image:</label>
                <input type="file" name="reImage">
                <?php if(isset($_GET['editid']) && !empty($row['image_url'])): ?>
                    <div class="current-image">
                        <p>Current Image: <?php echo $row['image_url']; ?></p>
                        <img src="UploadFiles/<?php echo $row['image_url']; ?>" width="100">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <?php if(isset($_GET['editid'])): ?>
                    <button type="submit" name="btnUpdate" class="btn-primary">Update Recipe</button>
                    <a href="receipe_setup.php" class="btn-cancel">Cancel</a>
                <?php else: ?>
                    <button type="submit" name="btnSave" class="btn-primary">Save Recipe</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <?php if($result->num_rows > 0 && !isset($_GET['editid'])): ?>
    <h1>Recipe Information</h1>
    <div class="card">
        <table class="table0">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Cuisine Type</th>
                <th>Dietary Preference</th>
                <th>Difficulty Level</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php while($row=$result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['recipe_id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['cuisine_type']; ?></td>
                <td><?php echo $row['dietary_preference']; ?></td>
                <td><?php echo $row['difficulty_level']; ?></td>
                <td>
                    <?php if(!empty($row['image_url'])): ?>
                        <img src="UploadFiles/<?php echo $row['image_url']; ?>" width="50" height="50">
                    <?php else: ?>
                        No Image
                    <?php endif; ?>
                </td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="receipe_setup.php?editid=<?php echo $row['recipe_id']; ?>" class="btn-edit">Edit</a> | 
                    <a href="receipe_setup.php?deleteid=<?php echo $row['recipe_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this recipe?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>