<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attributes</title>
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
        <h1 style="font-size: 15px; font-weight: 700;">ATTRIBUTES</h1>
        <div style="text-align: right;">
            <a href="{{ route('admin.dashboard') }}"
                class="bg-blue-600 text-white py-1 px-2 rounded hover:bg-blue-300 inline-flex items-center">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Attributes Table -->
    <div class="container mx-auto mt-5 p-4 bg-white rounded shadow-lg">
        <table class="table table-bordered w-full" id="attributesTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#attributesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('api.getAttributes') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            });
        });
    </script>
</body>

</html>
