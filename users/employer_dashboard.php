<?php
session_start();

// Only allow employers
if(!isset($_SESSION['user_name'])){
    header("Location: index.php");
    exit();
}

if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] !== 'employer' && $_SESSION['user_role'] === 'student'){ // only allow students
        // redirect employers/universities to their dashboard
        header("Location: dashboard.php");
        exit();
    }else if($_SESSION['user_role'] !== 'employer' && $_SESSION['user_role'] === 'university'){
        header("Location: university_dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Microjob.uz - Korxona sahifasi</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>
<body class="bg-blue-50 min-h-screen flex flex-col">

<!-- Top Navbar -->
<nav class="hidden md:flex justify-between items-center bg-white shadow p-4 px-8 sticky top-0 z-10">
    <div class="font-bold text-2xl">💼 Microjob.uz</div>
    <div class="space-x-6">
        <a href="#" class="text-gray-600 hover:text-blue-600">🏠 Bosh sahifa</a>
        <a href="jobs/list.php" class="text-gray-600 hover:text-blue-600">💼 Ishlar</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">👤 <?php echo $_SESSION['user_name']; ?></a>
        <a href="logout.php" class="text-gray-600 hover:text-blue-600">🚪 Chiqish</a>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow">
    <section class="text-center py-16 px-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">💼 Korxona sahifasi</h1>
        <p class="text-md md:text-lg mb-6">O‘z ish e’lonlaringizni boshqaring va talabalarni toping ⚡</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <button id="addJobBtn" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">➕ Ish e’lon qo‘shish</button>
        </div>
    </section>

    <!-- My Jobs Section -->
    <section class="py-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-4">Mening e’lonlarim 📋</h2>
        <div id="myJobsList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Job cards will be appended here via jQuery -->
        </div>
    </section>
</main>

<!-- Bottom Navbar (Mobile) -->
<nav class="fixed bottom-0 left-0 w-full bg-white shadow-inner border-t border-gray-200 flex justify-around py-2 md:hidden">
    <a href="#" class="flex flex-col items-center text-blue-600">
        <span class="text-xl">🏠</span>
        <span class="text-xs">Bosh sahifa</span>
    </a>
    <a href="jobs/list.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">💼</span>
        <span class="text-xs">Ishlar</span>
    </a>
    <a href="#" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">👤</span>
        <span class="text-xs"><?php echo $_SESSION['user_name']; ?></span>
    </a>
    <a href="logout.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">🚪</span>
        <span class="text-xs">Chiqish</span>
    </a>
</nav>

<!-- Footer -->
<footer class="bg-blue-600 text-white mt-12">
    <div class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-xl font-bold mb-2">💼 Microjob.uz</h3>
            <p>Talabalar uchun mikroishlar va stajirovkalarni topish platformasi 📝</p>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-2">🔗 Tezkor havolalar</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:underline">🏠 Bosh sahifa</a></li>
                <li><a href="jobs/list.php" class="hover:underline">💼 Ishlar</a></li>
                <li><a href="users/register.php" class="hover:underline">📝 Ro'yhatdan o'tish</a></li>
                <li><a href="users/login.php" class="hover:underline">🔑 Kirish</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-2">📞 Aloqa</h3>
            <p>Email: <a href="mailto:support@microjob.uz" class="underline hover:text-gray-200">support@microjob.uz</a></p>
            <p>Telefon: <a href="tel:+998901234567" class="underline hover:text-gray-200">+998 90 123 45 67</a></p>
            <div class="flex space-x-4 mt-2">
                <a href="#" class="hover:text-gray-200 text-xl">🐦</a>
                <a href="#" class="hover:text-gray-200 text-xl">📘</a>
                <a href="#" class="hover:text-gray-200 text-xl">📸</a>
            </div>
        </div>
    </div>
    <div class="text-center text-sm bg-blue-700 py-4 mt-4">
        &copy; 2025 Microjob.uz | Barcha huquqlar himoyalangan ✅
    </div>
</footer>

<script>
$(document).ready(function(){
    // Fetch employer's jobs
    function renderMyJobs(jobs){
        $("#myJobsList").empty();
        if(jobs.length === 0){
            $("#myJobsList").append('<p class="text-center text-gray-600 col-span-full">Hozircha ish e’lonlaringiz yo‘q.</p>');
        }
        jobs.forEach(job => {
            $("#myJobsList").append(`
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold mb-2">${job.title}</h3>
                    <p class="mb-2">${job.description}</p>
                    <small class="text-gray-500">Olingan arizalar: ${job.applications}</small>
                    <div class="flex justify-between mt-3">
                        <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Tahrirlash</button>
                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 deleteJobBtn" data-id="${job.id}">O‘chirish</button>
                    </div>
                </div>
            `);
        });
    }

    // Sample AJAX to get jobs (replace with your get_employer_jobs.php)
    $.getJSON("get_employer_jobs.php", function(data){
        renderMyJobs(data);
    });

    // Delete job
    $(document).on("click", ".deleteJobBtn", function(){
        const id = $(this).data("id");
        if(confirm("Ish e’lonini o‘chirmoqchimisiz?")){
            $.post("delete_job.php", {id: id}, function(res){
                if(res === "success") location.reload();
                else alert("Xatolik yuz berdi!");
            });
        }
    });

    // Add job button click
    $("#addJobBtn").click(function(){
        window.location.href = "add_job.php";
    });
});
</script>

</body>
</html>
