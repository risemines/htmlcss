<?php 
require 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password === $confirm_password) {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password_hash);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Passwords do not match.";
    }
}
?>

<form method="POST" action="" class="register-form">
    <h2>Create Account</h2>
    <div class="form-group">
        <input type="text" name="username" placeholder="Username" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    </div>
    <button type="submit">Register</button>
    <p>Already have an account? <a href="login.php">Login</a></p>
</form>
