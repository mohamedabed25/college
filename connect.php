<?php
$servername = "127.0.0.1"; // Server address
$username = "root";         // MySQL username
$password = "";             // MySQL password
$database = "users_courses_project"; // Database name
$port = 4306;               // Port number

// Create connection to MySQL without specifying the database initially
$conn = new mysqli($servername, $username, $password, "", $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists
$db_check_query = "SHOW DATABASES LIKE '$database'";
$db_check_result = $conn->query($db_check_query);

if ($db_check_result->num_rows == 0) {
    // If the database does not exist, you could create it or display an error
    die("Database '$database' does not exist. Please create the database.");
} else {
    // Select the database if it exists
    $conn->select_db($database);
    // echo "Connected successfully to the database.";
}

// You can proceed with other operations after this check
?>
