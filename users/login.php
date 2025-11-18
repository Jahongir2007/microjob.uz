<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kirish - Microjob.uz</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>
<body class="bg-blue-50">

<!-- Top Navbar -->
<nav class="hidden md:flex justify-between items-center bg-white shadow p-4 px-8 sticky top-0 z-10">
    <div class="font-bold text-2xl">💼 Microjob.uz</div>
    <div class="space-x-6">
        <a href="index.php" class="text-gray-600 hover:text-blue-600">🏠 Bosh sahifa</a>
        <a href="list.php" class="text-gray-600 hover:text-blue-600">🔍 Ishlar</a>
        <a href="register.php" class="text-gray-600 hover:text-blue-600">📝 Ro‘yxatdan o'tish</a>
        <a href="login.php" class="text-gray-600 hover:text-blue-600 font-semibold">🔑 Kirish</a>
    </div>
</nav>

<!-- Login Form -->
<section class="max-w-md mx-auto bg-white p-8 rounded-xl shadow mt-12 mb-24">
    <h2 class="text-2xl font-bold mb-6 text-center">🔑 Kirish</h2>

    <form id="loginForm">
        <div id="alertMsg" class="hidden fixed top-20 left-1/2 transform -translate-x-1/2 w-11/12 max-w-md p-4 rounded shadow text-white font-semibold z-[50]"></div>

        <label class="block mb-2 font-semibold">Email 📧</label>
        <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2 mb-4" placeholder="email@example.com">

        <label class="block mb-2 font-semibold">Parol 🔑</label>
        <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2 mb-4" placeholder="Parolni kiriting">

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition font-semibold">✅ Kirish</button>
    </form>

    <p class="text-center mt-4 text-gray-600">Agar hisobingiz mavjud bo‘lmasa, <a href="register.php" class="text-blue-600 hover:underline">ro‘yxatdan o‘ting</a></p>
</section>

<!-- Bottom Navbar -->
<nav class="fixed bottom-0 left-0 w-full bg-white shadow-inner border-t border-gray-200 flex justify-around py-2 md:hidden">
    <a href="index.php" class="flex flex-col items-center text-blue-600">
        <span class="text-xl">🏠</span>
        <span class="text-xs">Bosh sahifa</span>
    </a>
    <a href="list.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">🔍</span>
        <span class="text-xs">Ishlar</span>
    </a>
    <a href="register.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">📝</span>
        <span class="text-xs">Ro‘yxatdan o'tish</span>
    </a>
    <a href="login.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">🔑</span>
        <span class="text-xs">Kirish</span>
    </a>
</nav>

<script>
$(document).ready(function(){

    function showAlert(message, type = "warning") {
        const alertDiv = $("#alertMsg");
        let bgColor = "bg-yellow-500"; 
        if(type === "danger") bgColor = "bg-red-500";
        if(type === "success") bgColor = "bg-green-500";

        alertDiv
            .removeClass("hidden bg-yellow-500 bg-red-500 bg-green-500")
            .addClass(bgColor)
            .text(message)
            .stop(true,true)
            .fadeIn(300)
            .delay(3000)
            .fadeOut(300);
    }

    $("#loginForm").on("submit", function(e){
        e.preventDefault();
        $.post("login_user.php", $("#loginForm").serialize(), function(res){
            if(res === "correct"){
                showAlert("🎉 Muvaffaqiyatli kirildi!", "success");
                setTimeout(() => {
                    window.location.href = "dashboard.php";
                }, 1500);
            } else {
                showAlert("❌ Email yoki parol xato!", "danger");
            }
        });
    });

});
</script>

</body>
</html>
