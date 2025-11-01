<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFusion - Home</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    
</head>
<?php
include('dbconnect.php');
$sql="SELECT * FROM recipes ORDER BY created_at DESC LIMIT 3";
$result=$connect->query($sql);
?>
<body>
    <!-- Header with Navigation -->
    <header>
        <div class="header-container">
            <div class="logo">Food<span>Fusion</span></div>
            <nav>
               <ul>
                  <li><a href="index_users.php"class="active">Home</a></li>
                  <li><a href="about_users.php" >About Us</a></li>
                  <li><a href="recipes_users.php">Recipes</a></li>
                  <li><a href="contact_users.php" >Contact</a></li>
                  <li><a href="login.php">Login</a></li>
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
        <h2>Upcoming Cooking Events</h2>
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

    <!-- Join Us Button -->
    <div class="join-container">
        <button class="join-btn" id="joinBtn">Join Us</button>
    </div>

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

    <!-- Join Us Popup -->
    <div class="modal" id="joinModal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h3>Create Your FoodFusion Account</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="fname" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="lname" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="btnReg" class="submit-btn">Register Now</button>
            </form>
        </div>
    </div>

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
            
            // Modal functionality
            const modal = document.getElementById('joinModal');
            const joinBtn = document.getElementById('joinBtn');
            const closeBtn = document.getElementById('closeModal');
            
            joinBtn.addEventListener('click', () => {
                modal.style.display = 'flex';
            });
            
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
            
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
    
    <?php 
    // Process registration when form is submitted
    if(isset($_POST['btnReg'])) 
    { 
        $fname = $_POST['fname']; 
        $lname = $_POST['lname']; 
        $email = $_POST['email']; 
        $password = $_POST['password']; 
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (user_id, first_name, last_name, email, password_hash, failed_attempts, lockout_time, created_at, usertype) 
                VALUES (NULL, '$fname', '$lname', '$email', '$password_hash', '0', NULL, current_timestamp(), '1')"; 
        
        if($connect->query($sql) == TRUE) 
        { 
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } 
        else 
        {
            echo "<script>alert('Error: " . $connect->error . "');</script>";
        }
    } 
    ?>
</body>
</html>
