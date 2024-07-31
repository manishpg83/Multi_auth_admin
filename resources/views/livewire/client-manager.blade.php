<div>
    <section class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <h3 class="text-2xl font-semibold text-gray-500 mb-2 ml-6 mt-2">
                    Clients Table
                    @if ($statusFilter !== '')
                        (Showing {{ ucfirst($statusFilter) }} Clients)
                    @endif
                </h3>
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="rounded-lg">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                            <div class="w-full">
                                <form class="flex items-center">
                                    <label for="client-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <input wire:model.live="search" type="text" id="client-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:ring-2 focus:border-primary-500 block w-full  p-2 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search Client..." required>
                                    </div>
                                    <div x-data="{ open: false }" class="relative inline-block text-left ml-1">
                                        <button @click="open = !open" type="button"
                                            class="inline-flex w-full justify-center rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-cyan-500"
                                            id="dropdownButton">
                                            <span>{{ $statusFilter === '' ? 'Statuses' : ucfirst($statusFilter) }}</span>
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M6.293 9.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false"
                                            class="absolute right-0 z-1 mt-2 w-44 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <div class="py-1">
                                                <a wire:click="$set('statusFilter', '')" href="#"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem">All Statuses</a>
                                                <a wire:click="$set('statusFilter', 'Active')" href="#"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem">Active</a>
                                                <a wire:click="$set('statusFilter', 'Inactive')" href="#"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem">Inactive</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 text-right">
                        @if ($clients->whereNotNull('deleted_at')->count() > 0)
                            <button wire:click="restoreSelected"
                                class="bg-green-500 text-white font-bold px-3 py-1 text-md rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-2">
                                Restore Selected
                            </button>
                        @endif
                        <button wire:click="deleteSelected"
                            class="bg-red-500 text-white font-bold px-3 py-1 text-md rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-2">
                            Delete Selected
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    <input type="checkbox"
                                        class="form-checkbox h-5 w-5 text-blue-600 bg-gray-200 border-gray-300 rounded-md focus:ring-blue-500 focus:ring-2 cursor-pointer"
                                        wire:model="selectAll" wire:click="selectAllClients">
                                </th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('client_id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('first_name')">First Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('last_name')">Last Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('email')">Email</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('company_name')">Company Name
                                </th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('status')">Status</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientsPaginated as $client)
                                <tr class="border-b text-gray-600">
                                    <td class="px-4 py-3">
                                        <input type="checkbox"
                                            class="form-checkbox h-5 w-5 text-blue-600 bg-gray-200 border-gray-300 rounded-md focus:ring-blue-500 focus:ring-2 cursor-pointer"
                                            wire:model="selectedClients" value="{{ $client->client_id }}">
                                    </td>
                                    <td class="px-4 py-3">{{ $client->client_id }}</td>
                                    <td class="px-4 py-3">{{ $client->first_name }}</td>
                                    <td class="px-4 py-3">{{ $client->last_name }}</td>
                                    <td class="px-4 py-3">{{ $client->email }}</td>
                                    <td class="px-4 py-3">{{ $client->company_name }}</td>
                                    <td class="px-4 py-3">
                                        @if ($client->trashed())
                                            <span class="text-red-500">Inactive (Deleted)</span>
                                        @else
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="client_status{{ $client->client_id }}"
                                                    wire:click="toggleStatusClient({{ $client->client_id }})"
                                                    {{ $client->status === 'Active' ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="client_status{{ $client->client_id }}"></label>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                        @if ($client->trashed())
                                            <button wire:click="restore({{ $client->client_id }})"
                                                class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                            <button wire:click="forceDelete({{ $client->client_id }})"
                                                class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button wire:click="delete({{ $client->client_id }})"
                                                class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $clientsPaginated->links() }}
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            // Toggle dropdown visibility
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Handle status selection
            dropdownMenu.addEventListener('click', function(event) {
                const target = event.target;
                if (target.tagName === 'A') {
                    const value = target.getAttribute('data-value');
                    dropdownButton.querySelector('span').textContent = target.textContent;
                    @this.set('statusFilter', value);
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</div>
