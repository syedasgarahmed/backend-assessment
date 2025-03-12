<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <h1 style="font-size: 15px; font-weight: 700; text-align: center;">TIMESHEET</h1>

    <div style="text-align: right;">
        <a href="{{ route('admin.dashboard') }}"
            class="bg-blue-600 text-white py-1 px-2 rounded hover:bg-blue-300 inline-flex items-center">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
        <button id="createTimesheetBtn"
            class="bg-green-600 text-white py-1 px-2 rounded hover:bg-green-400 inline-flex items-center ml-2">
            <i class="fas fa-plus mr-1"></i> Create Timesheet
        </button>
    </div>


    <div class="container mx-auto mt-5 p-4 bg-white rounded shadow-lg">

        <table class="table table-bordered w-full" id="timesheetsTable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Project</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>End Date</th>
                    <th>Hours/day</th>
                    <th>Assigned on</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Timesheet Creation Modal -->
    <div id="createTimesheetModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-5 rounded-lg w-1/2">
            <div class="flex justify-between mb-4">
                <h2 class="text-2xl font-bold">Create Timesheet</h2>
                <button id="closeCreateTimesheetModal" class="text-red-500">X</button>
            </div>
            <form id="createTimesheetForm">
                @csrf
                <div class="mb-4">
                    <label class="block">Select Project:</label>
                    <select id="projectSelect" name="project_id" class="w-full p-2 border border-gray-300 rounded">
                        <!-- Dynamic Project List -->
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">Assign Users:</label>
                    <select id="userSelect" class="w-full p-2 border border-gray-300 rounded" multiple>
                        <!-- Dynamic User List -->
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">Task Name:</label>
                    <input type="text" id= "task_name" name="task_name"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">End Date:</label>
                    <input type="date" id="enddate" name="date"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">Hours/Day:</label>
                    <input type="number" id="hours" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="text-right">
                    <button type="submit"
                        class="bg-blue-600 text-white py-1 px-4 rounded hover:bg-blue-400">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- User Timesheet Modal -->
    <div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-5 rounded-lg w-3/4">
            <div class="flex justify-between mb-4">
                <h2 class="text-2xl font-bold">User Timesheets</h2>
                <button id="closeModal" class="text-red-500">X</button>
            </div>
            <table class="table-auto w-full" id="userTimesheetTable">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Task Name</th>
                        <th>Date</th>
                        <th>Hours</th>
                        <th>Assigned on</th>
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
            var table = $('#timesheetsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('api.getTimesheet') }}',
                columns: [{
                        data: 'user',
                        name: 'user.first_name',
                        render: function(data, type, row) {
                            return `<a href="#" class="user-link text-blue-600" data-user-id="${row.user.id}">${data.first_name}</a>`;
                        }
                    },
                    {
                        data: 'project.name',
                        name: 'project.name'
                    },
                    {
                        data: 'task_name',
                        name: 'task_name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return `<select class="status-select" data-id="${row.id}">
                    <option value="Pending" ${data === 'Pending' ? 'selected' : ''}>Pending</option>
                    <option value="In Progress" ${data === 'In Progress' ? 'selected' : ''}>In Progress</option>
                    <option value="Completed" ${data === 'Completed' ? 'selected' : ''}>Completed</option>
                </select>`;
                        }
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'hours',
                        name: 'hours'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            });

            // Handle click event on user name
            $('#timesheetsTable').on('click', '.user-link', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');

                // Fetch the user timesheets via AJAX
                $.ajax({
                    url: '{{ route('api.getUserTimesheets', ':id') }}'.replace(':id', userId),
                    method: 'GET',
                    success: function(data) {
                        $('#userTimesheetTable tbody').html(data);
                        $('#userModal').removeClass('hidden');
                    },
                    error: function(xhr) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            });

            // Close the modal
            $('#closeModal').click(function() {
                $('#userModal').addClass('hidden');
            });
            $('#timesheetsTable').on('change', '.status-select', function() {
                var timesheetId = $(this).data('id');
                var newStatus = $(this).val();

                $.ajax({
                    url: '{{ route('api.update.TimesheetStatus') }}', // Route to handle the update
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: timesheetId,
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Status updated successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Failed to update status.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'An error occurred. Please try again.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });

        });

        $(document).ready(function() {
            // Show Modal
            $('#createTimesheetBtn').click(function() {
                $('#createTimesheetModal').removeClass('hidden');
            });

            // Close Modal
            $('#closeCreateTimesheetModal').click(function() {
                $('#createTimesheetModal').addClass('hidden');
            });

            // Handle Create Timesheet Form Submission
            $('#createTimesheetForm').submit(function(e) {
                e.preventDefault();

                // Get selected users from the multiple select field
                const selectedUsers = $('#userSelect').val();
                const projectSelect = $('#projectSelect').val();
                const hour = $('#hours').val();
                const task_name = $('#task_name').val();
                const enddate = $('#enddate').val();
                $.ajax({
                    url: '{{ route('api.createTimesheet') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        project_id: projectSelect,
                        user_ids: selectedUsers,
                        date: enddate,
                        task_name: task_name,
                        hour: hour,
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#createTimesheetModal').addClass('hidden');
                            $('#createTimesheetForm')[0].reset();
                            $('#timesheetsTable').DataTable().ajax.reload();

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Timesheet created successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Failed to create timesheet.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'An error occurred. Please try again.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
