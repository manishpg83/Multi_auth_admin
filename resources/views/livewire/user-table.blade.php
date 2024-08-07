<div>
    <section class="bg-gray-50">
        <div class="max-w-screen-xl mx-auto">
            <div class="relative overflow-hidden bg-white shadow-md sm:rounded-lg">
                <h3 class="mt-2 mb-2 ml-6 text-2xl font-semibold text-gray-500">Users Table</h3>
                <div
                    class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input wire:model="search" type="text" id="simple-search"
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-cyan-500 focus:ring-2 focus:border-primary-500"
                                    placeholder="Search Users..." required>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="w-full text-right md:w-1/2">
                        <button wire:click="create"
                            class="px-3 py-1 font-bold text-white rounded-md shadow-sm bg-cyan-500 text-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Add User
                        </button>
                    </div> --}}
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('user_id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('first_name')">User Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('email')">Email</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-gray-600 border-b">
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
                                    <td class="px-4 py-3">
                                        <button wire:click="edit({{ $user->user_id }})"
                                            class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $user->user_id }})"
                                            class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button wire:click="view({{ $user->user_id }})"
                                            class="text-green-500 hover:text-green-700">
                                            <i class="fas fa-eye"></i>
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

    <!-- Modal for Editing Users -->
    @if ($isModalOpen)
        <div class="modal-backdrop fade show"></div>
        <div class="modal show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="flex flex-col max-w-lg mx-auto modal-content">
                    <div class="flex items-center justify-between px-4 py-3 modal-header">
                        <h5 class="text-lg font-semibold modal-title">{{ $userId ? 'Edit User' : 'Add User' }}</h5>
                        <button type="button" class="close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="px-4 py-3 overflow-auto modal-body">
                            <div class="mb-3 form-group">
                                <label for="firstName" class="block text-sm font-medium text-gray-700">First
                                    Name</label>
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                    id="firstName" wire:model.defer="firstName" required>
                                @error('firstName')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                    id="lastName" wire:model.defer="lastName" required>
                                @error('lastName')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" wire:model.defer="email" required>
                                @error('email')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end px-4 py-3 modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                            <button type="submit" class="ml-2 btn btn-primary">
                                {{ $userId ? 'Update User' : 'Add User' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                @this.call('delete', id);
            }
        }
        window.addEventListener('user-saved', event => {
            notyf().success(`User ${event.detail.action} successfully!`);
        })
    </script>
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
