<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Role</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-5">Select Your Role</h1>

        <div class="space-y-4">
            <button id="userBtn" class="bg-blue-500 text-white py-2 px-4 rounded w-full">User</button>
            <button id="adminBtn" class="bg-green-500 text-white py-2 px-4 rounded w-full">Admin</button>
        </div>
    </div>

    <script>
        document.getElementById('userBtn').addEventListener('click', function() {
            window.location.href = 'api/user/login';
        });

        document.getElementById('adminBtn').addEventListener('click', function() {
            window.location.href = 'api/admin/login';
        });
    </script>
</body>

</html>
