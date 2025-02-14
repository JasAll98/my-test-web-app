<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "persondb";

// Baza bilan bog'lanish
$conn = new mysqli($servername, $username, $password,$dbname);

// Bog'lanishni tekshirish
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>