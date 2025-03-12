<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 shadow-md rounded">
            <h2 class="text-2xl font-bold mb-6 text-center">User Registration</h2>
            <form id="registerForm">
                <div class="mb-4">
                    <input type="text" name="first_name" class="w-full p-2 border border-gray-300 rounded"
                        placeholder="First Name" required>
                </div>
                <div class="mb-4">
                    <input type="text" name="last_name" class="w-full p-2 border border-gray-300 rounded"
                        placeholder="Last Name" required>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded"
                        placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded"
                        placeholder="Password" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password_confirmation"
                        class="w-full p-2 border border-gray-300 rounded" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Register</button>
            </form>
            <div id="message" class="mt-4 text-center"></div>
            <div class="mt-4 text-center">
                <a href="/api/user/login" class="text-blue-500">Login
                </a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/api/register',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#message').html('<p class="text-green-500">' + response.message +
                            '</p>');
                        // Redirect to user.dashboard after 3 seconds
                        setTimeout(function() {
                            window.location.href = "/api/user/dashboard";
                        }, 3000);
                    },
                    error: function(error) {
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;
                            let errorMessages = '';

                            // Loop through all errors and build the message
                            $.each(errors, function(key, messages) {
                                messages.forEach(function(message) {
                                    errorMessages +=
                                        '<p class="text-red-500">' + message +
                                        '</p>';
                                });
                            });

                            $('#message').html(errorMessages);
                        } else {
                            $('#message').html(
                                '<p class="text-red-500">An unexpected error occurred. Please try again.</p>'
                                );
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
