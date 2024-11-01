<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email and password match a user in the database
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Fetch user details and store them in session
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['age'] = isset($user['age']) ? $user['age'] : '';
        $_SESSION['email'] = isset($user['email']) ? $user['email'] : '';
        $_SESSION['phone'] = isset($user['phone']) ? $user['phone'] : '';
        $_SESSION['country'] = isset($user['country']) ? $user['country'] : '';
        $_SESSION['photo'] = isset($user['photo']) ? 'uploads/' . $user['photo'] : ''; // Set photo path

        header("Location: profile.php"); // Redirect to profile page
        exit;
    } else {
        echo "Invalid email or password. Please try again.";
    }

    // Free result set
    if ($result) {
        $result->free();
    }
}

// Close the connection
$conn->close();
?>
