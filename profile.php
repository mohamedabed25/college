<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    
    <!-- Display user profile information -->
    <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p><strong>Age:</strong> <?php echo htmlspecialchars($_SESSION['age'] ?? 'N/A'); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? 'N/A'); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['phone'] ?? 'N/A'); ?></p>
    <p><strong>Country:</strong> <?php echo htmlspecialchars($_SESSION['country'] ?? 'N/A'); ?></p>
    
    <!-- Display profile photo if available -->
    <?php if (!empty($_SESSION['photo'])): ?>
        <p><strong>Photo:</strong></p>
        <img src="<?php echo htmlspecialchars($_SESSION['photo']); ?>" alt="User Photo" style="width: 150px; height: auto;">
    <?php else: ?>
        <p><strong>Photo:</strong> N/A</p>
    <?php endif; ?>
    <hr>

    <a href="logout.php">Logout</a>
</body>
</html>
