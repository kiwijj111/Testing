<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="admin-nav">
   <ul>
        <li><a href="admin.php">Admin</a></li>
        <li><a href="receipe_setup.php">Recipes Set up</a></li>
        <li><a href="resources_setup.php">Resources Set up</a></li>
        <li><a href="manage_cookbook.php">Manage Cookbook</a></li>
        <li><a href="manage_contact.php">Manage Contact</a></li>
        <li><a href="manage_users.php" class="active">Manage Users</a></li>
    </ul>
</nav>

<?php
include("dbconnect.php");

// Handle approve action
if(isset($_GET['approve'])) {
    $user_id = intval($_GET['approve']);
    // Add your approve logic here
    echo "<script>alert('User ID $user_id approved successfully!');</script>";
}

// Handle reject action
if(isset($_GET['reject'])) {
    $user_id = intval($_GET['reject']);
    // Add your reject logic here
    echo "<script>alert('User ID $user_id rejected!');</script>";
}

$sql = "SELECT * FROM users ORDER BY user_id DESC";
$result = $connect->query($sql);
?>

<div class="admin-container">
    <h1>User Management</h1>
    <p>Manage all registered users and their account status.</p>
    
    <?php
    if($result->num_rows > 0) {
    ?>
    <div class="table-container">
        <table class="table0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password Hash</th>
                    <th>Failed Attempts</th>
                    <th>Lockout Time</th>
                    <th>Created At</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($row = $result->fetch_assoc()) {
                $lockout_status = $row['lockout_time'] && strtotime($row['lockout_time']) > time() ? 
                    '<span class="status-locked">Locked</span>' : 
                    '<span class="status-active">Active</span>';
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td class="password-cell" title="<?php echo htmlspecialchars($row['password_hash']); ?>">
                    <?php echo htmlspecialchars(substr($row['password_hash'], 0, 20) . '...'); ?>
                </td>
                <td><?php echo htmlspecialchars($row['failed_attempts']); ?></td>
                <td>
                    <?php 
                    if($row['lockout_time']) {
                        echo htmlspecialchars($row['lockout_time']) . '<br>' . $lockout_status;
                    } else {
                        echo 'Not Locked';
                    }
                    ?>
                </td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                <td>
                    <?php
                    $type = $row['usertype'];
                    if($type == 0) {
                        echo '<span class="status-admin">Admin</span>';
                    } else {
                        echo '<span class="status-customer">Customer</span>';
                    }
                    ?>
                </td>
                <td class="action-links">
                    <a href="?approve=<?php echo $row['user_id']; ?>" onclick="return confirm('Approve this user?')">Approve</a> | 
                    <a href="?reject=<?php echo $row['user_id']; ?>" onclick="return confirm('Reject this user?')" style="color: #dc3545;">Reject</a>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    
    <div style="text-align: center; margin-top: 1rem; color: #666; font-size: 0.9rem;">
        Total Users: <?php echo $result->num_rows; ?>
    </div>
    
    <?php
    } else {
        echo '<div style="text-align: center; padding: 2rem; color: #666;">';
        echo '<p>No users found in the database.</p>';
        echo '</div>';
    }
    ?>
</div>

<footer>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

</body>
</html>