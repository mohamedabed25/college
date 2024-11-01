<?php
session_start();
include 'connect.php';

// Check if the form is submitted   
if (isset($_POST['signup'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];

    // Check if the email or phone number already exists
    $check_query = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $result = $conn->query($check_query);

    if ($result && $result->num_rows > 0) {
        echo "Email or phone number already exists";
    } else {
        // File upload logic
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $photoName = basename($_FILES['photo']['name']);
            $uploadFilePath = $uploadDir . $photoName;

            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
            }

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFilePath)) {
                // Insert query with photo name instead of full path
                $insert_query = "INSERT INTO users (username, password, age, email, phone, country, photo) 
                                 VALUES ('$username', '$password', '$age', '$email', '$phone', '$country', '$photoName')";

                if ($conn->query($insert_query) === TRUE) {
                    $_SESSION['photo'] = $uploadFilePath; // Save photo path to session
                    header("Location: login.php"); // Redirect to login page after registration
                    exit;
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Failed to upload photo. Check directory permissions.";
            }
        } else {
            echo "No photo uploaded or there was an error.";
        }
    }

    // Free the result set if needed
    if ($result) {
        $result->free();
    }
}

// Close the connection
$conn->close();
?>
