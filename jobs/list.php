<?php
require_once "../php/db.php";
$jobs = $conn->query("SELECT jobs.id, jobs.title, jobs.description, users.name as employer_name FROM jobs JOIN users ON jobs.employer_id = users.id");
?>
<!DOCTYPE html>
<html>
<head><title>Jobs</title></head>
<body>
<h2>Job Listings</h2>
<?php while($job = $jobs->fetch_assoc()): ?>
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <h3><?php echo $job['title']; ?></h3>
        <p><?php echo $job['description']; ?></p>
        <small>Posted by: <?php echo $job['employer_name']; ?></small>
    </div>
<?php endwhile; ?>
</body>
</html>
