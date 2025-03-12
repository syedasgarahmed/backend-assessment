<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="w-full max-w-sm bg-white p-8 rounded shadow">
        <h2 class="text-2xl mb-6 text-center">Admin Login</h2>
        
        <form id="adminLoginForm">
        @csrf
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
        </form>
        
        <div id="error" class="text-red-500 mt-4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#adminLoginForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.login.form') }}",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        localStorage.setItem('access_token', response.access_token);
                        alert('Login successful!');
                        window.location.href = "{{ route('admin.dashboard') }}";
                    },
                    error: function (xhr) {
                        $('#error').text('Invalid credentials. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
