@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6 text-center">My Projects</h1>

        <table id="userProjectsTable" class="min-w-full bg-white border table-striped border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border-b">Project Name</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Dept.</th>
                    <th class="py-2 px-4 border-b">Date/Time</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#userProjectsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('api.getUserProjects') }}",
                    type: 'GET',
                },
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
                        name: 'department',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    }
                ]
            });
        });
    </script>
@endsection
