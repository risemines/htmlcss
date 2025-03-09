<?php
require 'config.php'; 
include 'header.php'; 

$recipes_per_page = 8; // Number of recipes per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $recipes_per_page;

// Fetch recipes with LIMIT for pagination
$sql = "SELECT id, title, time, image, category FROM recipe LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $recipes_per_page);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total number of recipes for pagination
$total_sql = "SELECT COUNT(*) as total FROM recipe";
$total_result = $conn->query($total_sql);
$total_recipes = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_recipes / $recipes_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mamie's Recipes</title>
    <link rel="stylesheet" href="styles.css"> 
    <script src="scripts.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>Mamie's Secrets</h2>
            </div>
            <nav>
                <ul>
                <li><a href="home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="explore.php" class="<?= basename($_SERVER['PHP_SELF']) == 'explore.php' ? 'active' : '' ?>">Explore</a></li>
                <li><a href="favorite.php" class="<?= basename($_SERVER['PHP_SELF']) == 'favorite.php' ? 'active' : '' ?>">Favorites</a></li>
                </ul>
            </nav>
            <div class="subscribe">
                <p>Get weekly recipes directly to your email</p>
                <a href="register.php" class="register-btn">Register Now</a>
            </div>
        </aside>

        <main>
            <header class="search-bar">
                <input type="text" placeholder="What do you want to cook today?">
                <button class="filter-btn">☰</button>
            </header>

            <section class="recipes">
                <h2>Recommended Recipes</h2>
                <div class="recipe-grid">
                    <?php while ($recipe = $result->fetch_assoc()): ?>
                        <div class="recipe-card">
                            <a href="recipe.php?id=<?= $recipe['id'] ?>">
                                <img src="images/<?= $recipe['image'] ?>" alt="<?= $recipe['title'] ?>">
                                <h3><?= $recipe['title'] ?></h3>
                            </a>
                            <p><?= $recipe['category'] ?></p>
                            <div class="details">
                                <span><?= $recipe['time'] ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

