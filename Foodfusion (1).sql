-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2025 at 09:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Foodfusion`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `cookbook_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `commented_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `cookbook_id`, `comment_text`, `commented_by`, `created_at`) VALUES
(1, 4, 'great content', 5, '2025-10-08 13:20:27'),
(2, 5, 'Gonna try it!!!', 1, '2025-10-09 18:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `community_cookbook`
--

CREATE TABLE `community_cookbook` (
  `cookbook_id` int(11) NOT NULL,
  `recipe_title` varchar(255) NOT NULL,
  `instructions` text NOT NULL,
  `ingredients` text NOT NULL,
  `submitted_by` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_cookbook`
--

INSERT INTO `community_cookbook` (`cookbook_id`, `recipe_title`, `instructions`, `ingredients`, `submitted_by`, `created_at`) VALUES
(1, 'Spicy Tomato Pasta', 'Sauté garlic and chili in butter, add tomatoes and stock. Simmer until thick, toss with pasta.', 'Butter, chili flakes, garlic, cherry tomatoes, chicken stock', 'Htoo Htoo', '2025-10-09 18:30:15'),
(2, 'Vegetable Salad', 'Boil and dice all vegetables. Mix', 'Potatoes, sweet potato, red onion, zucchini, red pepper, green beans', 'Htoo Htoo', '2025-10-09 18:31:40'),
(3, 'Turkey Meatloaf', 'Mix ingredients, place in loaf pan, bake 1 hour at 180°C. Brush with cranberry jelly.', 'Turkey mince, egg, onion, apple, garlic, sage, parsley, breadcrumbs, cranberry jelly', 'Thu Ta', '2025-10-09 18:32:42'),
(4, 'Nepalese Chicken Curry', 'Fry spices and aromatics, add chicken and tomato, simmer 30 minutes till cooked.', 'Chicken thigh, crushed tomatoes, chicken stock, onion, spices, bay leaf, cinnamon stick', 'Phone Pyae', '2025-10-09 18:33:34'),
(5, 'Peach Cake', 'Prepare cake base, layer peaches, pour cream mix, bake until set and golden.', 'Vanilla cake mix, coconut, butter, canned peaches, sour cream, egg, cinnamon', 'Phone Pyae', '2025-10-09 18:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`message_id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, '', 'Htoo@gmail.com', 'Request', 'Hello! Do you have a tutorial for making Burmese noodles? ', '2025-10-13 16:39:00'),
(2, '', 'Thuta@gmail.com', 'Recipe feedback', 'Hi, I loved your chicken curry recipe! ', '2025-10-13 16:41:26'),
(3, '', 'Khine@gmail.com', 'Recipe feedback', 'Tried the Burmese tea leaf salad—delicious! ', '2025-10-13 16:42:29'),
(4, '', 'Khine@gmail.com', 'Question', 'How do I store leftovers to keep them fresh?', '2025-10-13 16:44:11'),
(5, '', 'Phonepyae@gmail.com', 'Question', 'Are your recipes suitable for beginners', '2025-10-13 16:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cuisine_type` varchar(50) DEFAULT NULL,
  `dietary_preference` varchar(50) DEFAULT NULL,
  `difficulty_level` varchar(500) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `description`, `cuisine_type`, `dietary_preference`, `difficulty_level`, `image_url`, `created_by`, `created_at`) VALUES
(1, 'Margherita Pizza', 'Classic Italian pizza with tomatoes, mozzarella, and basil.', 'Italian', 'Vegetarian', 'Easy', 'Margherita Pizza.png', NULL, '2025-10-09 16:08:18'),
(2, 'Halal Mohinga', 'Myanmar’s national dish with rice noodles and fish broth', 'Myanmar', 'Halal', 'Medium', 'Mohinga.png', NULL, '2025-10-09 16:09:01'),
(3, 'Halal Chicken Biryani', 'Halal chicken cooked with basmati rice and spices.', 'Indian', 'Halal', 'Medium', 'chicken biryani.png', NULL, '2025-10-09 16:09:38'),
(4, 'Vegetarian Green Curry', 'Thai curry made with vegetables, coconut milk, and herbs.', 'Thai', 'Vegetarian', 'Medium', 'ThaiGreenCurry.png', NULL, '2025-10-09 16:10:17'),
(5, 'Gluten-Free Brownies', 'Rich chocolate brownies made with gluten-free flour.', 'American', 'Gluten-Free', 'Easy', 'Brownies.png', NULL, '2025-10-09 16:15:34'),
(6, 'Vegetarian Shan Noodles', 'Rice noodles with tomato-based sauce and vegetables.', 'Myanmar', 'Vegetarian', 'Medium', 'shannoodle.png', NULL, '2025-10-09 16:17:04'),
(7, 'Alfredo Pasta', 'Creamy pasta made with cashew-based Alfredo sauce.', 'Italian', 'Dairy-Free', 'Medium', 'Alfredo Pasta.png', NULL, '2025-10-09 16:17:49'),
(8, 'Vegan Chana Masala', 'Chickpeas cooked with spices in tomato gravy.', 'Indian', 'Vegan', 'Medium', 'Paneer Butter Masala.png', NULL, '2025-10-09 16:19:09'),
(9, 'Vegan Pad Thai', 'Rice noodles stir-fried with tofu and tamarind sauce.', 'Thai', 'Vegan', 'Medium', 'Vegan Pad Thai.png', NULL, '2025-10-09 16:20:10'),
(10, 'Vegetarian Fried Rice', 'Fried rice with vegetables, soy sauce, and sesame oil.', 'Chinese', 'Vegetarian', 'Easy', 'friedrice.png', NULL, '2025-10-09 16:20:57'),
(11, 'Myanmar Tea Salad', 'Tea leaf salad with crunchy beans and cabbage', 'Myanmar', 'Vegetarian', 'Easy', 'Tealeafsalad.png', NULL, '2025-10-09 16:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(500) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `title`, `description`, `category`, `file_url`, `created_at`) VALUES
(1, 'Classic Italian Pasta Recipe Card', 'Downloadable recipe card with step-by-step instructions for homemade pasta.', 'culinary', 'pasta-card.pdf', '2025-09-09 04:23:45'),
(2, 'Knife Skills Tutorial', 'tutorial teaching basic and advanced knife handling techniques.', 'culinary', 'Knife Skills.pdf', '2025-09-09 04:24:15'),
(3, 'Kitchen Hacks eBook', 'guide featuring 25 simple kitchen hacks to save time and effort.', 'culinary', 'Kitchen-Hacks.pdf', '2025-09-09 04:25:38'),
(4, 'Vegetarian Meal Prep', 'Instructional on preparing vegetarian meals for the whole week.', 'culinary', 'vegetarianPlan.pdf', '2025-09-09 04:31:23'),
(5, 'Nutrition for Home Cooks', 'Educational guide explaining the basics of balanced meals and nutrition.', 'educational', 'NutritionGuide.pdf', '2025-09-09 04:32:11'),
(6, 'Thai Cooking Masterclass', 'Step-by-step explanation on traditional Thai cooking methods and flavors', 'culinary', 'basicThai.pdf', '2025-09-09 04:33:22'),
(7, 'Food Safety & Hygiene Guide', 'PDF resource about best practices for food storage, handling, and preparation.', 'educational', 'foodsafety.pdf', '2025-09-09 04:34:18'),
(8, 'Indian Curry Fundamentals', 'educational covering the spices and techniques used in Indian curries.', 'educational', 'currybase.pdf', '2025-09-09 04:35:50'),
(9, 'Sauce Making Basics', 'Instructional on how to make classic sauces such as béchamel and hollandaise.', 'educational', 'saucebasic.pdf', '2025-09-09 04:36:51'),
(10, 'Gluten-Free Bread Recipe Card', 'recipe card for baking soft and fluffy gluten-free bread.', 'culinary', 'Gluten-Free_Bread.pdf', '2025-09-09 04:37:36'),
(11, 'Homemade Pizza Guide', 'Printable recipe card for making authentic Italian-style pizza at home.', 'culinary', 'Pizzacard.pdf', '2025-09-09 04:42:23'),
(12, 'Smoothie Recipes Collection', '20 healthy smoothie recipes for breakfast or snacks.', 'culinary', 'Smoothie.pdf', '2025-09-09 04:43:23'),
(13, 'Baking Essentials Tutorial', 'tutorial covering must-know baking techniques for beginners.', 'culinary', 'Baking Guide.pdf', '2025-09-09 04:44:52'),
(14, 'Quick 15-Minute Meals', '10 recipes you can cook in 15 minutes or less.', 'culinary', 'QuickMeal.pdf', '2025-09-09 04:45:46'),
(15, 'Understanding Dietary Preferences', 'PDF explaining Vegan, Vegetarian, Gluten-Free, and Halal diets.', 'educational', 'Diet Therapy.pdf', '2025-09-09 04:52:25'),
(16, 'Meal Planning for Beginners', 'Educational guiding how to organize and plan meals for a week.', 'educational', 'Meal-Planning.pdf', '2025-09-09 04:53:24'),
(17, 'Sustainable Cooking Practices', 'PDF resource promoting eco-friendly and sustainable kitchen habits.', 'educational', 'sustainability-cookbook.pdf', '2025-09-09 04:54:06'),
(18, 'Beginner’s Guide to Herbs & Spices', 'Instructional on introducing common herbs and spices with cooking tips.', 'educational', 'Handbook of herbs.pdf', '2025-09-09 04:54:59'),
(19, 'Understanding Cooking Oils', 'PDF guide that compares different cooking oils and their best uses.', 'educational', 'cooking-oils.pdf', '2025-09-09 04:55:32'),
(20, 'History of World Cuisines', 'Downloadable eBook exploring the origins of popular cuisines across cultures.', 'educational', 'WorldlCuisine.pdf', '2025-09-09 04:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `failed_attempts` int(11) NOT NULL DEFAULT 0,
  `lockout_time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password_hash`, `failed_attempts`, `lockout_time`, `created_at`, `usertype`) VALUES
(1, 'Htoo', 'Htoo', 'Htoo@gmail.com', '$2y$10$SydrO46MPnZmBG.UFc.Rz.3GqqMyRyToverNhracWILskcobbA7Be', 0, NULL, '2025-10-09 18:24:28', 1),
(2, 'Phone', 'Pyae', 'Phonepyae@gmail.com', '$2y$10$xsDd6ldxm5qhpSwRvQomaehbYtNJIEeDRC2i4lCuPD0.61UCEERUq', 0, NULL, '2025-10-09 18:25:08', 1),
(3, 'Min', 'Thant', 'Minthant@gmail.com', '$2y$10$Oaq30uFPp50JrpdnYmCkiuxNSQuyu/NPWZTz8DaSzCPno35qtmB1G', 0, NULL, '2025-10-09 18:25:42', 1),
(4, 'Thu', 'Ta', 'Thuta@gmail.com', '$2y$10$P8bI1GhcHVN.auQbQKQfYOiD8CIrcSCoYUcA0pWQ8asodEAjKr80u', 0, NULL, '2025-10-09 18:26:29', 1),
(5, 'Admin', 'User', 'admin@gmail.com', 'admin1234', 0, NULL, '2025-10-09 18:27:49', 0),
(6, 'Khine', 'Khine', 'Khine@gmail.com', '$2y$10$UCjpCN2cl3Xv30UURwp.2un2EABLgkDLgkl5GDqDoNs1Du24j5j6q', 3, '2025-10-13 19:48:05', '2025-10-09 18:37:13', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `cookbook_id` (`cookbook_id`),
  ADD KEY `commented_by` (`commented_by`);

--
-- Indexes for table `community_cookbook`
--
ALTER TABLE `community_cookbook`
  ADD PRIMARY KEY (`cookbook_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_cookbook`
--
ALTER TABLE `community_cookbook`
  MODIFY `cookbook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`cookbook_id`) REFERENCES `community_cookbook` (`cookbook_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`commented_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
