<?php
// check_email.php
session_start();
require_once "microjob"; // your database connection file

if(isset($_POST['email'])){
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        echo "exists"; // email already registered
    } else {
        echo "available"; // email is free
    }
}
?>
