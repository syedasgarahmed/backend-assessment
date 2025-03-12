<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        table.dataTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
    </style>
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

    <div style="text-align: center;">
        <h1 style="font-size: 15px; font-weight: 700;">USERS</h1>
        <div style="text-align: right;">
            <a href="{{ route('admin.dashboard') }}"
                class="bg-blue-600 text-white py-1 px-2 rounded hover:bg-blue-300 inline-flex items-center">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Users Table -->
    <div class="container mx-auto mt-5 p-4 bg-white rounded shadow-lg">
        <table class="table table-bordered w-full" id="usersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time</th>
                    <th>Actions</th>

                </tr>
            </thead>
        </table>
    </div>

    <!-- Projects Modal -->
    <div id="projectsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-5 rounded shadow-lg w-1/2 mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Assigned Projects</h2>
                <button id="closeModal" class="text-red-500 font-bold">&times;</button>
            </div>
            <div id="projectsContent" class="overflow-y-auto max-h-96">
                <table class="w-full text-sm text-left text-gray-700 border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2">Name</th>
                            <th class="border border-gray-300 p-2">Status</th>
                            <th class="border border-gray-300 p-2">Created At</th>

                        </tr>
                    </thead>
                    <tbody id="projectsTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-5 rounded shadow-lg w-1/3 mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit User</h2>
                <button id="closeEditModal" class="text-red-500 font-bold">&times;</button>
            </div>
            <form id="editUserForm">
                <input type="hidden" id="userId">
                <div class="mb-4">
                    <label class="block text-sm mb-1">First Name:</label>
                    <input type="text" id="first_name" class="w-full border border-gray-300 rounded px-2 py-1"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Last Name:</label>
                    <input type="text" id="last_name" class="w-full border border-gray-300 rounded px-2 py-1"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Email:</label>
                    <input type="email" id="email" class="w-full border border-gray-300 rounded px-2 py-1"
                        required>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const projectsModal = $('#projectsModal');
            const projectsContent = $('#projectsContent');
            const editUserModal = $('#editUserModal');
            const editUserForm = $('#editUserForm');
            const userIdInput = $('#userId');
            const first_name = $('#first_name');
            const last_name = $('#last_name');
            const emailInput = $('#email');

            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('api.getUsers') }}',
                columns: [{
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Handle link click
            $('#usersTable tbody').on('click', '.user-link', function(e) {
                e.preventDefault();

                const userId = $(this).data('id');

                $.ajax({
                    url: '{{ route('api.getUserProject') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        let html = '';

                        if (response.projects.length > 0) {
                            response.projects.forEach(project => {
                                html += `
                            <tr>
                                <td class="border border-gray-300 p-2">${project.name}</td>
                                <td class="border border-gray-300 p-2">${project.status}</td>
                                <td class="border border-gray-300 p-2">${project.created_at}</td>
                            </tr>`;
                            });
                        } else {
                            html =
                                `<tr><td colspan="3" class="text-center p-2">No projects assigned to this user.</td></tr>`;
                        }

                        $('#projectsTableBody').html(html);
                        projectsModal.show();
                    }
                });
            });

            // Close Modal
            $('#closeModal').click(function() {
                projectsModal.hide();
            });
            // Close Edit Modal
            $('#closeEditModal').click(function() {
                editUserModal.hide();
            });
            // Handle Edit Button Click
            $('#usersTable tbody').on('click', '.edit-user', function() {
                const userId = $(this).data('id');

                $.ajax({
                    url: '{{ route('api.getUser') }}',
                    method: 'GET',
                    data: {
                        id: userId
                    },
                    success: function(response) {
                        userIdInput.val(response.id);
                        first_name.val(response.first_name);
                        last_name.val(response.last_name);
                        emailInput.val(response.email);
                        editUserModal.show();
                    }
                });
            });
            // Handle Form Submission
            editUserForm.on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('api.updateUser') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        id: userIdInput.val(),
                        first_name: first_name.val(),
                        last_name: last_name.val(),
                        email: emailInput.val(),
                    },
                    success: function() {
                        editUserModal.hide();
                        $('#usersTable').DataTable().ajax.reload();
                    }
                });
            });
            // Handle Delete Button Click
            $('#usersTable tbody').on('click', '.delete-user', function() {
                const userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '{{ route('api.deleteUser') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            user_id: userId
                        },
                        success: function(response) {
                            alert('User deleted successfully.');
                            $('#usersTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            alert('Error deleting user. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
