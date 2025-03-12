<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-700">Admin Dashboard</h1>
            <form action="{{ route('adminLogout') }}" method="POST">
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
                <a href="{{ route('projects.view') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Projects
                </a>
            </div>

            <!-- Users Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Users</h2>
                <a href="{{ route('users.view') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Users
                </a>
            </div>

            <!-- Attributes Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Attributes</h2>
                <a href="{{ route('attributes.view') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Attributes
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Timesheet</h2>
                <a href="{{ route('timesheet.view') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Timesheet
                </a>
            </div>

        </div>
    </div>

</body>

</html>
