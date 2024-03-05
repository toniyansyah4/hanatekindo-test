<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">List of Users</h1>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="pb-4">
                    <a href="{{ route('master.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create User</a>
                </div>
                <table id="users-table" class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">No</th>
                            <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Name</th>
                            <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Email</th>
                            <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Status</th>
                            <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        console.log("Document ready");
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ route('master.datatables') }}`,
            columns: [
                {
                    data: 'no',
                    name: 'no',
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'user_status', name: 'user_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>