<div>
    <section class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input wire:model="search" type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                    placeholder="Search Users..." required>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 text-right">
                        <button wire:click="create"
                            class="bg-blue-500 text-white px-2 py-1 text-md rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Add User
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('user_id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('first_name')">First Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('last_name')">Last Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('email')">Email</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-3">{{ $user->user_id }}</td>
                                    <td class="px-4 py-3">{{ $user->first_name }}</td>
                                    <td class="px-4 py-3">{{ $user->last_name }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                        <button wire:click="edit({{ $user->user_id }})"
                                            class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="delete({{ $user->user_id }})"
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
