<?php
session_start();
if(!isset($_SESSION['user_name'])){
    http_response_code(401);
    echo json_encode([]);
    exit();
}

include "../php/db.php"; // your database connection

$sql = "SELECT id, title, description, employer_id FROM jobs ORDER BY id DESC";
$result = $conn->query($sql);

$jobs = [];

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $jobs[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($jobs);
