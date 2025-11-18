<?php 
session_start();

include "../php/db.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $user_type = trim($_POST['user_type']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (role, name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_type, $name, $email, $hashed_pass);

     if ($stmt->execute()) {
        // ✅ Set PHP session here
        $_SESSION['user_id'] = $stmt->insert_id;   // store user ID
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $user_type;

        echo "success";
    } else {
        echo "error";
    }
}
?>
