<?php
include('dbconnect.php');
session_start();

// check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

$email = $_SESSION['email'];

// get logged-in user details
$sql1 = "SELECT * FROM users WHERE email='$email'";
$r = $connect->query($sql1);
$row = $r->fetch_assoc();
$user_id = $row['user_id']; 
$username = $row['first_name'] . " " . $row['last_name'];

// handle new comment
if (isset($_POST['btnComment'])) {
    $cookbook_id = $_POST['cookbook_id'];
    $comment_text = trim($_POST['comment_text']);

    if (!empty($comment_text)) {
        $stmt = $connect->prepare("INSERT INTO comments (cookbook_id, comment_text, commented_by, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("isi", $cookbook_id, $comment_text, $user_id);
        $stmt->execute();
        $stmt->close();
        
        // Refresh to show new comment
        header("Location: cookbookForum.php");
        exit();
    }
}

// fetch all recipes
$sqlRecipes = "SELECT * FROM community_cookbook ORDER BY created_at DESC";
$resultRecipes = $connect->query($sqlRecipes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community Cookbook - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
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
                    <li><a href="cookbookForum.php" class="active">Cookbook Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="culinary.php">Culinary Resources</a></li>
                    <li><a href="educational.php">Educational Resources</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <h1>Community Cookbook</h1>
            <p class="subtitle">Explore recipes and join the conversation with comments!</p>
        </div>

        <?php if ($resultRecipes->num_rows > 0): ?>
            <div class="recipes-grid">
                <?php while ($recipe = $resultRecipes->fetch_assoc()): ?>
                    <div class="recipe-card">
                        <div class="recipe-header">
                            <h2><?= htmlspecialchars($recipe['recipe_title']) ?></h2>
                            <div class="recipe-meta">
                                <span class="author">By: <?= htmlspecialchars($recipe['submitted_by']) ?></span>
                                <span class="date"><?= date('M j, Y g:i A', strtotime($recipe['created_at'])) ?></span>
                            </div>
                        </div>

                        <div class="recipe-content">
                            <div class="ingredients-section">
                                <h3>Ingredients</h3>
                                <div class="ingredients-list">
                                    <?= nl2br(htmlspecialchars($recipe['ingredients'])) ?>
                                </div>
                            </div>

                            <div class="instructions-section">
                                <h3>Instructions</h3>
                                <div class="instructions-text">
                                    <?= nl2br(htmlspecialchars($recipe['instructions'])) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <h3>Comments</h3>
                            <div class="comments-list">
                                <?php
                                $id = $recipe['cookbook_id'];
                                $sqlComments = "SELECT c.comment_text, c.created_at, u.first_name, u.last_name
                                                FROM comments c 
                                                LEFT JOIN users u ON c.commented_by = u.user_id
                                                WHERE c.cookbook_id = '$id'
                                                ORDER BY c.created_at ASC";
                                $resultComments = $connect->query($sqlComments);

                                if ($resultComments->num_rows > 0) {
                                    while ($commentRow = $resultComments->fetch_assoc()) {
                                        echo "<div class='comment-item'>";
                                        echo "<div class='comment-header'>";
                                        echo "<strong class='comment-author'>" 
                                             . htmlspecialchars($commentRow['first_name'] . " " . $commentRow['last_name']) 
                                             . "</strong>";
                                        echo "<span class='comment-date'>" . date('M j, Y g:i A', strtotime($commentRow['created_at'])) . "</span>";
                                        echo "</div>";
                                        echo "<p class='comment-text'>" . htmlspecialchars($commentRow['comment_text']) . "</p>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p class='no-comments'>No comments yet. Be the first to comment!</p>";
                                }
                                ?>
                            </div>

                            <!-- Comment Form -->
                            <form class="comment-form" action="cookbookForum.php" method="POST">
                                <input type="hidden" name="cookbook_id" value="<?= $recipe['cookbook_id'] ?>">
                                <textarea name="comment_text" placeholder="Write your comment..." required rows="3"></textarea>
                                <button type="submit" name="btnComment" class="comment-btn">Post Comment</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-recipes">
                <p>No recipes have been shared yet. <a href="cookbook.php">Be the first to share one!</a></p>
            </div>
        <?php endif; ?>
    </div>

    <footer>
     <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>
</body>
</html>