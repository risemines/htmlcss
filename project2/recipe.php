<?php
require 'config.php';
include 'header.php';

session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Get recipe ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch recipe details
$sql = "SELECT title, time, image, category, steps, ingredients FROM recipe WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $recipe = $result->fetch_assoc();
} else {
    echo "Recipe not found.";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id) {
  $stmt = $conn->prepare("INSERT IGNORE INTO favorite (user_id, recipe_id) VALUES (?, ?)");
  $stmt->bind_param("ii", $user_id, $id);
  if ($stmt->execute()) {
      echo "<script>alert('Recipe added to favorites!');</script>";
  } else {
      echo "<script>alert('Failed to add to favorites.');</script>";
  }
  $stmt->close();
}
?>

<body>
  <div class="container">
    <!-- Sidebar -->
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

    <!-- Main content -->
    <main>
        <div class="recipe-details">
            <h1><?php echo $recipe['title']; ?></h1>
            <img src="images/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['title']; ?>">
            <p>Category: <?php echo $recipe['category']; ?></p>
            <p>Cooking Time: <?php echo $recipe['time']; ?> min</p>
            <h2>Ingredients</h2>
            <p><?php echo nl2br($recipe['ingredients']); ?></p>
            <h2>Steps</h2>
            <p><?php echo nl2br($recipe['steps']); ?></p>

            <!-- Add to Favorites Form -->
            <?php if ($user_id): ?>
                <form method="POST" action="">
                    <button type="submit">Add to Favorites</button>
                </form>
            <?php else: ?>
                <p><a href="login.php">Login</a> to add this recipe to your favorites.</p>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>

