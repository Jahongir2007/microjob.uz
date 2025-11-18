<?php
session_start(); // always start session first

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Optionally, redirect user after logout
header("Location: ../index.php");
exit();
?>
