<?php
require 'config.php';
include 'header.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to view your favorites.";
    exit;
}

$user_id = $_SESSION['user_id'];


// Fetch all favorite recipes for the user
$sql = "SELECT recipe.id, recipe.title, recipe.image FROM favorite 
        JOIN recipe ON favorite.recipe_id = recipe.id 
        WHERE favorite.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

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
    <div class="favorites-page">

        <!-- Display all favorite recipes -->
        <?php if ($result->num_rows > 0): ?>
            <section class="recipes">
                <h2>Your Favorite Recipes</h2>
                <div class="recipe-grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="recipe-card">
                            <a href="recipe.php?id=<?php echo $row['id']; ?>">
                                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                                <h3><?php echo $row['title']; ?></h3>
                            </a>
                            <div class="details">
                            <a href="recipe.php?id=<?php echo $row['id']; ?>">View Recipe</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php else: ?>
            <p>You have no favorite recipes yet.</p>
        <?php endif; ?>
    </div>
</main>

</div>
</body>

