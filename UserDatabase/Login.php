<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

// User Variables
$loginUser = $_POST["loginUser"];
$loginPassword = $_POST["loginPassword"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE username = '$loginUser'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    if(password_verify($loginPassword, $row["password"]))     //$row["password"] == $loginPassword) NORMAL STRING CHECK
    {
        echo "Login successful.";
        // Get user data
    }
    else
    {
        echo "Wrong credentials.";
    }
  }
} else {
  echo "Username doesn't exist";
}
$conn->close();
?>