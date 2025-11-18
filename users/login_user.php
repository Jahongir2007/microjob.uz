<?php
session_start();
include "../php/db.php"; // your DB connection

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user by email
    $stmt = $conn->prepare("SELECT id, password, name, email, role FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hash, $name, $emailFetched, $role);
    $stmt->fetch();

    if($stmt->num_rows > 0){
        // Check password
        if(password_verify($password, $hash)){
            // Password correct, set session
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $emailFetched;
            $_SESSION['user_role'] = $role;
            echo "correct";
        } else {
            echo "incorrect";
        }
    } else {
        echo "incorrect";
    }

    $stmt->close();
    $conn->close();
}
?>
