<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        table.dataTable tbody tr:nth-child(odd) {
            background-color: #f3f4f6;
            /* Light gray for zebra stripe */
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
    <h1 style="text-align: center;font-size: medium;font-weight: 700;"> PROJECTS </h1>

    <div style="text-align: right; margin-bottom: 10px;">
        <a href="{{ route('admin.dashboard') }}"
            class="bg-blue-600 text-white py-1 px-2 rounded hover:bg-blue-300 inline-flex items-center">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>

        <!-- New Project Button -->
        <button id="newProjectBtn" class="bg-green-600 text-white py-1 px-2 rounded hover:bg-green-300 ml-2">
            Create New Project
        </button>
    </div>
    <!-- New Project Modal -->
    <div id="newProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-5 rounded shadow-lg w-1/3 mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Create New Project</h2>
                <button id="closeNewProjectModal" class="text-red-500 font-bold">&times;</button>
            </div>
            <form id="newProjectForm">
                <div class="mb-4">
                    <label class="block text-sm mb-1">Project Name:</label>
                    <input type="text" id="projectName" class="w-full border border-gray-300 rounded px-2 py-1"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Dept. Name:</label>
                    <input type="text" id="department" class="w-full border border-gray-300 rounded px-2 py-1"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Project Status:</label>
                    <select id="projectStatus" class="w-full border border-gray-300 rounded px-2 py-1" required>
                        <option value="">Select Status</option>
                        <option value="New">New</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Active">Active</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- DataTable -->
    <div class="container mt-5">
        <table class="table table-bordered" id="projectsTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Dept</th>
                    <th>Date/Time</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Edit Project Modal -->
    <div id="editProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-5 rounded shadow-lg w-1/3 mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Project</h2>
                <button id="closeEditProjectModal" class="text-red-500 font-bold">&times;</button>
            </div>
            <form id="editProjectForm">
                <input type="hidden" id="editProjectId">
                <div class="mb-4">
                    <label class="block text-sm mb-1">Project Name:</label>
                    <input type="text" id="editProjectName" class="w-full border border-gray-300 rounded px-2 py-1"
                        readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Dept. Name:</label>
                    <input type="text" id="editDeptName" class="w-full border border-gray-300 rounded px-2 py-1">
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Project Status:</label>
                    <select id="editProjectStatus" class="w-full border border-gray-300 rounded px-2 py-1">
                        <option value="New">New</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Active">Active</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Assign Users:</label>
                    <select id="editProjectUsers" class="w-full border border-gray-300 rounded px-2 py-1" multiple>
                        <!-- User options will be loaded via AJAX -->
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Users Modal -->
    <div id="viewUsersModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-5 rounded shadow-lg w-1/2 mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Assigned Users for <span id="projectName"></span></h2>
                <button id="closeViewUsersModal" class="text-red-500 font-bold">&times;</button>
            </div>
            <table id="usersTable" class="w-full border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">Name</th>
                        <th class="border border-gray-300 px-2 py-1">Email</th>
                        <th class="border border-gray-300 px-2 py-1">Assigned At</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('#projectsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('api.getProjects') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $(document).ready(function() {
            const newProjectModal = $('#newProjectModal');
            const newProjectForm = $('#newProjectForm');
            const projectsTable = $('#projectsTable').DataTable();

            // Show New Project Modal
            $('#newProjectBtn').click(function() {
                newProjectModal.show();
            });

            // Hide New Project Modal
            $('#closeNewProjectModal').click(function() {
                newProjectModal.hide();
            });

            // Handle New Project Form Submission
            newProjectForm.on('submit', function(e) {
                e.preventDefault();

                const projectName = $('#projectName').val();
                const projectStatus = $('#projectStatus').val();
                const department = $('#department').val();


                $.ajax({
                    url: '{{ route('api.createProject') }}',
                    method: 'POST',
                    data: {
                        name: projectName,
                        status: projectStatus,
                        department: department
                    },
                    success: function() {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Project created successfully.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        newProjectModal.hide();
                        projectsTable.ajax.reload();
                        newProjectForm.trigger("reset");
                    },
                    error: function(xhr) {
                        alert(
                            'An error occurred while creating the project. Please try again.'
                        );
                    }
                });
            });
        });
        $(document).ready(function() {
            const editProjectModal = $('#editProjectModal');
            const editProjectForm = $('#editProjectForm');
            const projectsTable = $('#projectsTable').DataTable();

            // Show Edit Modal
            $('#projectsTable tbody').on('click', '.edit-project', function() {
                const projectId = $(this).data('id');
                const projectName = $(this).data('name');
                const projectStatus = $(this).data('status');
                const projectDepartment = $(this).data('department');


                $('#editProjectId').val(projectId);
                $('#editProjectName').val(projectName);
                $('#editDeptName').val(projectDepartment);
                $('#editProjectStatus').val(projectStatus);

                // Load all users
                $.get('{{ route('api.getUsersList') }}', function(users) {
                    $('#editProjectUsers').empty();
                    users.forEach(user => {
                        $('#editProjectUsers').append(new Option(user.first_name, user.id));
                    });

                    // Load already assigned users
                    $.get('{{ route('api.getProjectUsers') }}', {
                        project_id: projectId
                    }, function(assignedUsers) {
                        $('#editProjectUsers').val(assignedUsers).trigger('change');
                    });

                    editProjectModal.show();
                });
            });

            // Hide Modal
            $('#closeEditProjectModal').click(function() {
                editProjectModal.hide();
            });

            // Save Changes
            editProjectForm.on('submit', function(e) {
                e.preventDefault();

                const projectId = $('#editProjectId').val();
                const projectStatus = $('#editProjectStatus').val();
                const assignedUsers = $('#editProjectUsers').val();
                const department = $('#editDeptName').val();


                $.ajax({
                    url: '{{ route('api.updateProject') }}',
                    method: 'POST',
                    data: {
                        id: projectId,
                        status: projectStatus,
                        users: assignedUsers,
                        department: department
                    },
                    success: function() {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Project Updated successfully.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        editProjectModal.hide();
                        projectsTable.ajax.reload();
                    },
                    error: function() {
                        alert('Error updating project. Please try again.');
                    }
                });
            });
        });
        $(document).ready(function() {
            const viewUsersModal = $('#viewUsersModal');
            const usersTable = $('#usersTable tbody');

            // Open Modal on Project Name Click
            $('#projectsTable tbody').on('click', '.view-users', function() {
                const projectId = $(this).data('id');
                const projectName = $(this).text();

                $('#projectName').text(projectName);
                usersTable.empty();

                $.ajax({
                    url: '{{ route('api.getProjectUsersTable') }}',
                    method: 'GET',
                    data: {
                        project_id: projectId
                    },
                    success: function(response) {
                        if (response.users.length === 0) {
                            usersTable.append(
                                '<tr><td colspan="4" class="text-center">No users assigned to this project.</td></tr>'
                            );
                        } else {
                            response.users.forEach(user => {
                                usersTable.append(`
                            <tr>
                                <td class="border border-gray-300 px-2 py-1">${user.first_name}</td>
                                <td class="border border-gray-300 px-2 py-1">${user.email}</td>
                                <td class="border border-gray-300 px-2 py-1">${user.created_at}</td>
                            </tr>
                        `);
                            });
                        }
                        viewUsersModal.show();
                    },
                    error: function() {
                        alert('Failed to load users. Please try again.');
                    }
                });
            });

            // Hide Modal
            $('#closeViewUsersModal').click(function() {
                viewUsersModal.hide();
            });
        });
    </script>

</body>

</html>
