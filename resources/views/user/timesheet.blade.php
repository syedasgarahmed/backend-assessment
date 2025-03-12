@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6 text-center">My Timesheet</h1>

        <table id="userTimesheetTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border-b">Task Name</th>
                    <th class="py-2 px-4 border-b">Given Date</th>
                    <th class="py-2 px-4 border-b">Hours/day</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Assigned Date/Time</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const statusOptions = `
                <select class="status-dropdown border border-gray-300 rounded p-1">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            `;

            $('#userTimesheetTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('api.getTimesheets') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'task_name',
                        name: 'task_name'
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
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return `<div data-task-id="${row.id}" class="status-container">${statusOptions.replace(`value="${data}"`, `value="${data}" selected`)}</div>`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            const date = new Date(data);
                            return date.toLocaleString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                        }
                    }
                ]
            });

            // Handle status change
            $(document).on('change', '.status-dropdown', function() {
                const status = $(this).val();
                const taskId = $(this).closest('.status-container').data('task-id');

                $.ajax({
                    url: "{{ route('api.updateTimesheetStatus') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: taskId,
                        status: status
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    },
                    error: function(error) {
                        toastr.error('Error updating status. Please try again.', 'Error');
                    }
                });
            });

            // Toastr Configuration
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };
        });
    </script>
@endsection
