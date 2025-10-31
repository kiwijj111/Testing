<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFusion - Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <style>
    
    </style>
</head>
 <?php
 include('dbconnect.php');
 $sql="SELECT * FROM recipes ORDER BY created_at DESC LIMIT 3";
 $result=$connect->query($sql);
 
?>
<?php 
session_start();
// check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}
 $email=$_SESSION['email'];
include("dbconnect.php"); ?>
<body>
    <!-- Header with Navigation -->
    <header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
                <ul>
                    <li><a href="index.php"class="active">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="recipes.php">Recipes</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to FoodFusion</h1>
        <p>Connecting food lovers through recipes, cooking tips, and community stories.</p>
    </section>

    <!-- Carousel Section -->
    <section class="carousel-section">
        <h2>Explore Our Community</h2>
        <div class="carousel">
            <div class="carousel-inner">
                <?php
                // Define carousel images with their captions
                $carouselItems = [
                    [
                        'image' => 'images/slide1.png',
                        'caption' => 'Discover the best cooking adventure with our best recipes and community'
                    ],
                    [
                        'image' => 'images/slide2.png',
                        'caption' => 'recipes and tips by professional chefs'
                    ],
                    [
                        'image' => 'images/slide3.png',
                        'caption' => 'variable categorys'
                    ]
                ];
                
                // Loop through carousel items and generate HTML
                foreach ($carouselItems as $index => $item) {
                    echo '<div class="carousel-item">';
                    echo '<img src="' . $item['image'] . '" alt="' . $item['caption'] . '">';
                    echo '<div class="carousel-caption">' . $item['caption'] . '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <button class="carousel-control prev">&lt;</button>
            <button class="carousel-control next">&gt;</button>
            <div class="carousel-indicators">
                <?php
                // Generate indicators based on number of carousel items
                for ($i = 0; $i < count($carouselItems); $i++) {
                    $activeClass = $i === 0 ? 'active' : '';
                    echo '<div class="indicator ' . $activeClass . '"></div>';
                }
                ?>
            </div>
        </div>
    </section>

 
     

  <!-- Latest Recipes Section -->
    <section class="latest-recipes-section">
        <h2>Latest Recipes</h2>
        <div class="recipes-container">
            <?php
            while($row=$result->fetch_assoc()) {
            ?>
            <div class="recipe-item">
                <h3><?php echo $row['title']; ?></h3>
                <p class="recipe-description"><?php echo $row['description']; ?></p>
                <p class="recipe-cuisine"><?php echo $row['cuisine_type']; ?></p>
                <div class="recipe-image">
                    <img src="<?php echo "UploadFiles//".$row['image_url']; ?>" alt="<?php echo $row['title']; ?>">
                </div>
            </div>
            <?php
            }
            ?> 
        </div>
    </section>

<footer>
     <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

    <script>
        // Carousel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('.carousel-inner');
            const items = document.querySelectorAll('.carousel-item');
            const indicators = document.querySelectorAll('.indicator');
            const prevBtn = document.querySelector('.carousel-control.prev');
            const nextBtn = document.querySelector('.carousel-control.next');
            let currentIndex = 0;
            const totalItems = items.length;
            
            // Update carousel position
            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                
                // Update indicators
                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.add('active');
                    } else {
                        indicator.classList.remove('active');
                    }
                });
            }
            
            // Next slide
            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }
            
            // Previous slide
            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            }
            
            // Add event listeners
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);
            
            // Add click events to indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });
            
            // Auto advance slides
            setInterval(nextSlide, 5000);
            
            
        });
    </script>
</body>
</html>