<?php
$host = "secret";
$db = "secret";
$user = "secret";
$pass = "secret";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>
