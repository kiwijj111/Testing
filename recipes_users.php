<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipes - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">Food<span>Fusion</span></div>
        <nav>
            <ul>
                <li><a href="index_users.php">Home</a></li>
                <li><a href="about_users.php">About Us</a></li>
                <li><a href="recipes_users.php" class="active">Recipes</a></li>
                <li><a href="contact_users.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <h1>Recipe Collection</h1>
    <p class="subtitle">Explore recipes from around the world.</p>

    <div class="search-filter">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search recipes..." onkeyup="filterRecipes()">
            <button onclick="filterRecipes()">Search</button>
        </div>
        <div class="filter-options">
            <select id="categoryFilter" onchange="filterRecipes()">
                <option value="all">All Cuisines</option>
                <option value="Italian">Italian</option>
                <option value="Chinese">Chinese</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Thai">Thai</option>
                <option value="Japanese">Japanese</option>
                <option value="indian">Indian</option>
            </select>
            <select id="difficultyFilter" onchange="filterRecipes()">
                <option value="all">All Levels</option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
        </div>
    </div>

    <div class="recipes-grid" id="recipesContainer">
        <!-- Recipe cards will be populated by JavaScript -->
    </div>
</div>

<footer>
    <p>Follow us for daily recipes and cooking inspiration!</p>
    <p>&copy; 2025 FoodFusion | <a href="privacypolicy.php">Privacy Policy</a> | <a href="cookiepolicy.php">Cookie Policy</a></p>
    <p>Follow us: <a href="https://www.facebook.com">Facebook</a> | <a href="https://www.instagram.com">Instagram</a> | <a href="https://www.youtube.com">YouTube</a></p>
</footer>

<script>
// Recipe data
const recipes = [
    {
        id: 1,
        name: "Alfredo Pasta",
        description: "Classic Italian pasta dish with creamy sauce and pancetta.",
        image: "images/Alfredo Pasta.png",
        category: "Italian",
        difficulty: "medium",
        cookTime: "30 min",
        rating: 4.8
    },
    {
        id: 2,
        name: "Chicken Biryani",
        description: "Fragrant spiced rice dish from South Asia with tender chicken.",
        image: "images/chicken biryani.png",
        category: "indian",
        difficulty: "hard",
        cookTime: "60 min",
        rating: 4.9
    },
    {
        id: 3,
        name: "Halal Mohinga",
        description: "Myanmar's national dish with rice noodles and fish broth",
        image: "images/Mohinga.png",
        category: "Myanmar",
        difficulty: "medium",
        cookTime: "45 min",
        rating: 4.7
    },
    {
        id: 4,
        name: "Pad Thai",
        description: "Stir-fried rice noodles with shrimp, tofu, and peanuts.",
        image: "images/Vegan Pad Thai.png",
        category: "Thai",
        difficulty: "medium",
        cookTime: "35 min",
        rating: 4.6
    },
    {
        id: 5,
        name: "Margherita Pizza",
        description: "Classic Neapolitan pizza with fresh mozzarella and basil.",
        image: "images/Margherita Pizza.png",
        category: "Italian",
        difficulty: "easy",
        cookTime: "25 min",
        rating: 4.5
    },
    {
        id: 6,
        name: "Tom Yum Soup",
        description: "Fresh Mediterranean salad with feta cheese and olives.",
        image: "images/Tom Yum Soup.png",
        category: "Thai",
        difficulty: "easy",
        cookTime: "15 min",
        rating: 4.4
    }
];

// Display recipes
function displayRecipes(recipesToShow) {
    const container = document.getElementById('recipesContainer');
    container.innerHTML = '';

    if (recipesToShow.length === 0) {
        container.innerHTML = '<p class="no-results">No recipes found matching your criteria.</p>';
        return;
    }

    recipesToShow.forEach(recipe => {
        const recipeCard = `
            <div class="recipe-card" data-category="${recipe.category}" data-difficulty="${recipe.difficulty}">
                <div class="recipe-image">
                    <img src="${recipe.image}" alt="${recipe.name}" onerror="this.src='https://via.placeholder.com/300x200/FF6B6B/white?text=Recipe+Image'">
                    <div class="recipe-overlay">
                        <span class="difficulty ${recipe.difficulty}">${recipe.difficulty}</span>
                        <span class="cook-time">${recipe.cookTime}</span>
                    </div>
                </div>
                <div class="recipe-content">
                    <h3>${recipe.name}</h3>
                    <p>${recipe.description}</p>
                    <div class="recipe-meta">
                        <span class="rating">⭐ ${recipe.rating}</span>
                        <span class="category">${recipe.category}</span>
                    </div>
                    <button class="view-recipe-btn" onclick="location.href='login.php'">View Recipe</button>
                </div>
            </div>
        `;
        container.innerHTML += recipeCard;
    });
}

// Filter recipes
function filterRecipes() {
    const category = document.getElementById('categoryFilter').value;
    const difficulty = document.getElementById('difficultyFilter').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();

    let filteredRecipes = recipes.filter(recipe => {
        const matchesCategory = category === 'all' || recipe.category.toLowerCase() === category.toLowerCase();
        const matchesDifficulty = difficulty === 'all' || recipe.difficulty === difficulty;
        const matchesSearch = recipe.name.toLowerCase().includes(searchTerm) || 
                            recipe.description.toLowerCase().includes(searchTerm);

        return matchesCategory && matchesDifficulty && matchesSearch;
    });

    displayRecipes(filteredRecipes);
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    displayRecipes(recipes);
});
</script>

</body>
</html>