<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp_feb";

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
ob_start(); // Starts buffering echo so we can clear when we want to send specific messages

if ($result->num_rows > 0) {
    // User already exists in the table
    ob_end_clean(); // Clears all previously echoed messages so we can send a specific message
    echo "-1";
    while($row = $result->fetch_assoc()) {
        if (password_verify($loginPassword, $row["password"]))     //$row["password"] == $loginPassword) NORMAL STRING CHECK
        {
            ob_end_clean(); // Clears all previously echoed messages so we can send a specific message
            echo "1";
        }
    }
} else {
    // User does not exist, so we create the user/pass
    $sql2 = "INSERT INTO users (username, password) VALUES ('$loginUser', '$encryptedPassword')";
    if($conn->query($sql2) === TRUE){
        ob_end_clean(); // Clears all previously echoed messages so we can send a specific message
        echo "0";
    }else{
        ob_end_clean();
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}
$conn->close();
?>