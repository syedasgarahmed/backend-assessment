<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow mb-8 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold text-blue-600">
                <a href="{{ url('/') }}">User Dashboard</a>
            </div>
            <div>
                @auth('user')
                    <a href="{{ route('user.dashboard') }}" class="text-blue-500 hover:text-blue-700">Dashboard</a>
                    <form action="{{ route('userLogout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Logout</button>
                    </form>
                @endauth
                @guest('user')
                    <a href="{{ route('user.login.form') }}" class="text-blue-500 hover:text-blue-700">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

    <!-- Additional Scripts -->
    @yield('scripts')
</body>

</html>
