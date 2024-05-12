<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username 
$databasePassword =""; // Replace with your database password
$dbname = "hack"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username,$databasePassword,  $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name1 = $_POST['name1'];
    $email1 = $_POST['email1'];
    $password1 = $_POST['password1'];
    
    // SQL query to insert data into the database
    $sql = "INSERT INTO hb1 (name1, email1, password1) VALUES ('$name1', '$email1', '$password1')";
    
    if ($conn->query($sql) === TRUE) {
        // Successfully inserted data, redirect to success page
        header("Location: candidates-v1.html"); // Replace "success.html" with your actual success page
        exit();
    } else {
        // Handle insertion error, display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
