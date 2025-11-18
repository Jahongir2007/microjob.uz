<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header("Location: index.php");
    exit();
}

if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] !== 'university' && $_SESSION['user_role'] === 'employer'){ // only allow students
        // redirect employers/universities to their dashboard
        header("Location: employer_dashboard.php");
        exit();
    }else if($_SESSION['user_role'] !== 'university' && $_SESSION['user_role'] === 'student'){
        header("Location: dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universitet sahifasi - Microjob.uz</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>
<body class="bg-blue-50 min-h-screen flex flex-col">

<!-- Top Navbar (Desktop) -->
<nav class="hidden md:flex justify-between items-center bg-white shadow p-4 px-8 sticky top-0 z-10">
    <div class="font-bold text-2xl">💼 Microjob.uz</div>
    <div class="space-x-6">
        <a href="#" class="text-gray-600 hover:text-blue-600">🏠 Bosh sahifa</a>
        <a href="list.php" class="text-gray-600 hover:text-blue-600">💼 Ishlar</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">👤 <?php echo $_SESSION['user_name']; ?></a>
        <a href="logout.php" class="text-gray-600 hover:text-blue-600">🚪 Chiqish</a>
    </div>
</nav>

<!-- Main content -->
<main class="flex-grow px-4 md:px-8 py-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">🏫 Universitet sahifasi</h1>
        <button id="addVolunteerBtn" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">➕ Volontyorlikka elon berish</button>
    </div>

    <!-- Add Volunteer Modal -->
    <div id="addVolunteerModal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">➕ Yangi Volontyorlik ishi</h2>
            <form id="volunteerForm">
                <label class="block mb-2 font-semibold">Sarlavha</label>
                <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2 mb-4" required>
                
                <label class="block mb-2 font-semibold">Tavsif</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2 mb-4" required></textarea>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">✅ Qo‘shish</button>
            </form>
            <button id="closeModal" class="mt-4 w-full bg-gray-200 py-2 rounded hover:bg-gray-300 transition">❌ Bekor qilish</button>
        </div>
    </div>

    <!-- Volunteer Works Grid -->
    <section>
        <h2 class="text-2xl font-bold mb-4">Universitetning volontyorlik ishlari</h2>
        <div id="volunteerList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Volunteer cards appended here -->
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

<!-- jQuery Script -->
<script>
$(document).ready(function(){

    // Modal show/hide
    $("#addVolunteerBtn").click(() => $("#addVolunteerModal").fadeIn());
    $("#closeModal").click(() => $("#addVolunteerModal").fadeOut());

    // Fetch volunteer works
    let volunteerData = [];
    function renderVolunteers(data){
        $("#volunteerList").empty();
        data.forEach(v => {
            $("#volunteerList").append(`
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold mb-2">${v.title}</h3>
                    <p class="mb-2">${v.description}</p>
                    <small class="text-gray-500">Created: ${v.created_at}</small>
                    <div class="flex gap-2 mt-3">
                        <button class="flex-1 bg-green-600 text-white py-1 rounded hover:bg-green-700 editVolunteer" data-id="${v.id}">✏️ Edit</button>
                        <button class="flex-1 bg-red-600 text-white py-1 rounded hover:bg-red-700 deleteVolunteer" data-id="${v.id}">🗑️ Delete</button>
                    </div>
                </div>
            `);
        });
    }

    // Example: Fetch from server
    $.getJSON("get_volunteers.php", function(data){
        volunteerData = data;
        renderVolunteers(volunteerData);
    });

    // Add new volunteer work
    $("#volunteerForm").submit(function(e){
        e.preventDefault();
        $.post("add_volunteer.php", $(this).serialize(), function(res){
            if(res === 'success'){
                alert("🎉 Volunteer work qo‘shildi!");
                $("#addVolunteerModal").fadeOut();
                $.getJSON("get_volunteers.php", function(data){
                    volunteerData = data;
                    renderVolunteers(volunteerData);
                });
            }
        });
    });

    // Edit & Delete buttons
    $(document).on("click", ".deleteVolunteer", function(){
        const id = $(this).data("id");
        if(confirm("Bu volunteer workni o‘chirmoqchimisiz?")){
            $.post("delete_volunteer.php", {id:id}, function(res){
                if(res === 'success'){
                    alert("✅ O‘chirildi!");
                    $.getJSON("get_volunteers.php", function(data){
                        volunteerData = data;
                        renderVolunteers(volunteerData);
                    });
                }
            });
        }
    });

    $(document).on("click", ".editVolunteer", function(){
        const id = $(this).data("id");
        const v = volunteerData.find(x => x.id == id);
        if(v){
            $("#addVolunteerModal").fadeIn();
            $("#volunteerForm [name='title']").val(v.title);
            $("#volunteerForm [name='description']").val(v.description);
        }
    });

});
</script>
</body>
</html>
