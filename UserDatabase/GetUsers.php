﻿<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = ""

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connection success! :) <br><br>";

$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["username"] . "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>