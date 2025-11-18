<?php
session_start();
if(isset($_SESSION['user_name'])){
    header('Location: users/dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Microjob.uz - Talabalar uchun ish topish</title>
<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
body {
    font-family: 'Poppins', sans-serif;
}
</style>
</head>
<body class="bg-blue-50">

<!-- Top Navbar (Desktop) -->
<nav class="hidden md:flex justify-between items-center bg-white shadow p-4 px-8 sticky top-0 z-10">
    <div class="font-bold text-2xl">💼 Microjob.uz</div>
    <div class="space-x-6">
        <a href="#" class="text-gray-600 hover:text-blue-600">🏠 Bosh sahifa</a>
        <a href="jobs/list.php" class="text-gray-600 hover:text-blue-600">💼 Ishlar</a>
        <a href="users/register.php" class="text-gray-600 hover:text-blue-600">📝 Ro'yhatdan o'tish</a>
        <a href="users/login.php" class="text-gray-600 hover:text-blue-600">🔑 Kirish</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="text-center py-16 px-4">
    <h1 class="text-3xl md:text-5xl font-bold mb-4">💼 Microjob.uz</h1>
    <p class="text-md md:text-lg mb-6">Talabalar uchun mikroishlar va stajirovkalarni toping 📝</p>
    <div class="flex justify-center gap-4 flex-wrap">
        <a href="users/register.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">📝 Ro‘yxatdan o‘tish</a>
        <a href="jobs/list.php" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">🔍 Ishlarni ko‘rish</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-6">Nega Microjob.uz? 🤔</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-xl font-semibold mb-2">🎓 Talabalar</h3>
            <p>Mikroishlar, stajirovkalar va loyihalarni toping va o‘qing 💡</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-xl font-semibold mb-2">🏢 Ish beruvchilar</h3>
            <p>Ish e’lonlarini joylashtiring va talabalarni tez ishga oling ⚡</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition text-center">
            <h3 class="text-xl font-semibold mb-2">🏫 Universitetlar</h3>
            <p>Talabalarni tasdiqlang va ularni ish imkoniyatlari bilan bog‘lang ✅</p>
        </div>
    </div>
</section>

<!-- Job Search Section -->
<section class="py-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-4">Ishlarni qidirish 🔎</h2>
    <div class="flex justify-center mb-6">
        <input type="text" id="jobSearch" placeholder="Ish nomini yozing..." class="border border-gray-300 px-4 py-2 rounded-lg w-full max-w-md">
    </div>
    <div id="jobList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Job cards will be appended here via jQuery -->
    </div>
</section>

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
    <a href="users/register.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">📝</span>
        <span class="text-xs">Ro'yhatdan o'tish</span>
    </a>
    <a href="users/login.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">🔑</span>
        <span class="text-xs">Kirish</span>
    </a>
</nav>

<!-- jQuery Script to Load Jobs -->
<script>
$(document).ready(function(){
    const jobs = [
        {title: "💻 Veb Dasturchi Stajirovkasi", description: "Veb loyihalarda ishlang va o‘rganing.", employer: "ABC Kompaniya"},
        {title: "🎨 Grafik Dizayner", description: "Ijtimoiy tarmoqlar uchun grafiklar yarating.", employer: "XYZ Studio"},
        {title: "✍️ Kontent Yozuvchi", description: "Blog va maqolalar yozing.", employer: "Freelance Hub"}
    ];

    function renderJobs(filter="") {
        $("#jobList").empty();
        jobs.forEach(job => {
            if(job.title.toLowerCase().includes(filter.toLowerCase())){
                $("#jobList").append(`
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold mb-2">${job.title}</h3>
                        <p class="mb-2">${job.description}</p>
                        <small class="text-gray-500">E’lon bergan: ${job.employer}</small>
                        <button class="mt-3 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition applyJob">Ariza yuborish</button>
                    </div>
                `);
            }
        });
    }

    renderJobs();

    $("#jobSearch").on("input", function(){
        const query = $(this).val();
        renderJobs(query);
    });

    $(document).on("click", ".applyJob", function(){
        alert("Ariza yuborish funksiyasi tez orada qo‘shiladi!");
    });
});
</script>
<!-- Footer -->
<footer class="bg-blue-600 text-white mt-12">
    <div class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- About -->
        <div>
            <h3 class="text-xl font-bold mb-2">💼 Microjob.uz</h3>
            <p>Talabalar uchun mikroishlar va stajirovkalarni topish platformasi 📝</p>
        </div>
        <!-- Quick Links -->
        <div>
            <h3 class="text-xl font-bold mb-2">🔗 Tezkor havolalar</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:underline">🏠 Bosh sahifa</a></li>
                <li><a href="jobs/list.php" class="hover:underline">💼 Ishlar</a></li>
                <li><a href="users/register.php" class="hover:underline">📝 Ro'yhatdan o'tish</a></li>
                <li><a href="users/login.php" class="hover:underline">🔑 Kirish</a></li>
            </ul>
        </div>
        <!-- Contact -->
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

</body>
</html>
