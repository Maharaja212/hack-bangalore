<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$databasePassword = ""; // Replace with your database password
$dbname = "hack"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $databasePassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO hb (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Successfully inserted data, redirect to success page
        header("Location: job-grid-v1.html"); // Replace "success.html" with your actual success page
        exit();
    } else {
        // Handle insertion error, display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection (moved outside the if block)
$conn->close();
?>