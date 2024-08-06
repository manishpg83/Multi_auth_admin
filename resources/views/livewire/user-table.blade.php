<div>
    <section class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <h3 class="text-2xl font-semibold text-gray-500 mb-2 ml-6 mt-2">Users Table</h3>
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input wire:model="search" type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:ring-2 focus:border-primary-500 block w-full pl-10 p-2"
                                    placeholder="Search Users..." required>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 text-right">
                        {{-- <button wire:click="create"
                            class="bg-cyan-500 text-white px-3 py-1 font-bold text-md rounded-md shadow-sm hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Add User
                        </button> --}}
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('user_id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('name')">User Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('email')">Email</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b text-gray-600">
                                    <td class="px-4 py-3">{{ $user->user_id }}</td>
                                    <td class="px-4 py-3">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-1">
                                        <div class="custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                id="status{{ $user->user_id }}"
                                                wire:click="toggleStatus({{ $user->user_id }})"
                                                {{ $user->status === 'Active' ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="status{{ $user->user_id }}"></label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-center space-x-2">
                                        {{-- <button wire:click="edit({{ $user->user_id }})"
                                            class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button> --}}
                                        <button onclick="confirmDelete({{ $user->user_id }})"
                                            class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', userId);
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success'
                });
            }
        });
    }
</script>


