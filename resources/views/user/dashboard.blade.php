<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-700">User Dashboard</h1>
            <form action="{{ route('userLogout') }}" method="POST">
                @csrf
                <button type="submit" class="text-red-500 hover:text-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Projects Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Projects</h2>
                <a href="{{ route('getMyProjects') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View My Projects
                </a>
            </div>

            <!-- Users Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Timesheets</h2>
                <a href="{{ route('getMyTimeSheet') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View My Timesheets
                </a>
            </div>

        </div>
    </div>
</body>

</html>
