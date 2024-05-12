<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hack";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to bump a freelancer
function bumpFreelancer($freelancerId) {
    global $conn;

    // Check if the freelancer already has a record in the bumps table
    $sql = "SELECT * FROM bumps WHERE freelancer_id = $freelancerId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If the freelancer exists, update the bump count
        $row = $result->fetch_assoc();
        $bumpCount = $row["bumps_count"] + 1;
        $sql = "UPDATE bumps SET bumps_count = $bumpCount WHERE freelancer_id = $freelancerId";
    } else {
        // If the freelancer doesn't exist, insert a new record
        $bumpCount = 1;
        $sql = "INSERT INTO bumps (freelancer_id, bumps_count) VALUES ($freelancerId, $bumpCount)";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Freelancer bumped successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to get the bump count for a freelancer
function getBumpCount($freelancerId) {
    global $conn;

    $sql = "SELECT bumps_count FROM bumps WHERE freelancer_id = $freelancerId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["bumps_count"];
    } else {
        return 0;
    }
}

// Example usage:
$freelancerId = 1; // Replace with the actual freelancer ID
bumpFreelancer($freelancerId);
echo "Bump count: " . getBumpCount($freelancerId);

$conn->close();
?>
