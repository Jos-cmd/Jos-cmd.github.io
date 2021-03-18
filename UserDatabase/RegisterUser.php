<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

// User Variables
$loginUser = $_POST["loginUser"];
$loginPassword = $_POST["loginPassword"];
$encryptedPassword = password_hash($loginPassword, PASSWORD_DEFAULT);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE username = '$loginUser'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User already exists in the table
    echo "User already exists";
} else {
    // User does not exist, so we create the user/pass
    $sql2 = "INSERT INTO users (username, password) VALUES ('$loginUser', '$encryptedPassword')";
    if($conn->query($sql2) === TRUE){
        echo "New user registered successfully";
    }else{
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}
$conn->close();
?>