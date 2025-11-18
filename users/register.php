<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ro‘yxatdan o‘tish - Microjob.uz</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>
<body class="bg-blue-50">

<!-- Top Navbar (Desktop) -->
<nav class="hidden md:flex justify-between items-center bg-white shadow p-4 px-8 sticky top-0 z-10">
    <div class="font-bold text-2xl">💼 Microjob.uz</div>
    <div class="space-x-6">
        <a href="index.php" class="text-gray-600 hover:text-blue-600">🏠 Bosh sahifa</a>
        <a href="list.php" class="text-gray-600 hover:text-blue-600">🔍 Ishlar</a>
        <a href="register.php" class="text-gray-600 hover:text-blue-600 font-semibold">📝 Ro‘yxatdan o'tish</a>
        <a href="login.php" class="text-gray-600 hover:text-blue-600">🔑 Kirish</a>
    </div>
</nav>

<!-- Registration Form Section -->
<section class="max-w-md mx-auto bg-white p-8 rounded-xl shadow mt-12 mb-24">
    <h2 class="text-2xl font-bold mb-6 text-center">📝 Ro‘yxatdan o‘tish</h2>

    <form id="registerForm">
        <!-- Alert container -->
        <div id="alertMsg" class="hidden fixed top-20 left-1/2 transform -translate-x-1/2 w-11/12 max-w-md p-4 rounded shadow text-white font-semibold z-[50]"></div>
        <!-- User Type -->
        <label class="block mb-2 font-semibold">Siz kimsiz? 👤</label>
        <select id="usertype" name="user_type" class="w-full border border-gray-300 rounded px-3 py-2 mb-4">
            <option value="student">🎓 Talaba</option>
            <option value="employer">🏢 Ish beruvchi</option>
            <option value="university">🏫 Universitet</option>
        </select>

        <!-- Name -->
        <label id="mainname" class="block mb-2 font-semibold">Ism va Familiya ✍️</label>
        <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 mb-4" placeholder="Sizning ismingiz">

        <!-- Email -->
        <label class="block mb-2 font-semibold">Email 📧</label>
        <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2 mb-4" placeholder="email@example.com">

        <!-- Password -->
        <label class="block mb-2 font-semibold">Parol 🔑</label>
        <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2 mb-4" placeholder="Parolni kiriting">

        <!-- Confirm Password -->
        <label class="block mb-2 font-semibold">Parolni tasdiqlash 🔑</label>
        <input type="password" name="confirm_password" required class="w-full border border-gray-300 rounded px-3 py-2 mb-4" placeholder="Parolni qayta kiriting">

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition font-semibold">✅ Ro‘yxatdan o‘tish</button>
    </form>

    <p class="text-center mt-4 text-gray-600">Agar hisobingiz mavjud bo‘lsa, <a href="login.php" class="text-blue-600 hover:underline">kirish</a></p>
</section>

<!-- Bottom Navbar (Mobile) -->
<nav class="fixed bottom-0 left-0 w-full bg-white shadow-inner border-t border-gray-200 flex justify-around py-2 md:hidden">
    <a href="index.php" class="flex flex-col items-center text-blue-600">
        <span class="text-xl">🏠</span>
        <span class="text-xs">Bosh sahifa</span>
    </a>
    <a href="jobs/list.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">🔍</span>
        <span class="text-xs">Ishlar</span>
    </a>
    <a href="users/register.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">📝</span>
        <span class="text-xs">Ro‘yxatdan o'tish</span>
    </a>
    <a href="users/login.php" class="flex flex-col items-center text-gray-600 hover:text-blue-600">
        <span class="text-xl">🔑</span>
        <span class="text-xs">Kirish</span>
    </a>
</nav>
<script>
$(document).ready(function(){

    function showAlert(message, type = "warning") {
        const alertDiv = $("#alertMsg");

        // Set message and style based on type
        let bgColor = "bg-yellow-500"; // warning default
        if(type === "danger") bgColor = "bg-red-500";
        if(type === "success") bgColor = "bg-green-500";

        alertDiv
            .removeClass("hidden bg-yellow-500 bg-red-500 bg-green-500")
            .addClass(bgColor)
            .text(message)
            .stop(true, true)
            .fadeIn(300)          // fade in
            .delay(3000)          // stay for 2.5 seconds
            .fadeOut(300);        // fade out
    }

    $("#usertype").on("change", function(){
        let selectedType =$(this).val();
        // console.log(selectedType);
        if(selectedType === "employer") $("#mainname").text("Korxona nomi ✍️");
        else if(selectedType === "university") $("#mainname").text("Universitet nomi ✍️");
        else if(selectedType === "student") $("#mainname").text("Ism va Familiya ✍️")
    });

    $("#registerForm").on("submit", function(e){
        e.preventDefault(); // always prevent default first

        let email = $("input[name='email']").val();
        let password = $("input[name='password']").val();
        let confirmPassword = $("input[name='confirm_password']").val();

        // Check password match
        if(password !== confirmPassword){
            showAlert("⚠️ Parolingizni ikkala maydonda ham bir xilligiga ishonch hosil qiling", "danger");
            return; // stop form submit
        }

        // Check email via AJAX
        $.ajax({
            url: "check_email.php",
            method: "POST",
            data: {email: email},
            success: function(response){
                if(response === "exists"){
                    showAlert("⚠️ Bu email allaqachon ro‘yxatdan o‘tgan!", "danger");
                    $("input[name='email']").val('').focus();
                } else {
                    // Email is free, submit the form
                    $.post("new_user.php", $("#registerForm").serialize(), function(res){
                        if(res === 'success'){
                            showAlert("🎉 Ro‘yxatdan o‘tildi!", "success");
                            setTimeout(() => {
                                window.location.href = "dashboard.php";
                            }, 2000);
                        }
                    });
                }
            }
        });
    });


});
</script>
</body>
</html>
