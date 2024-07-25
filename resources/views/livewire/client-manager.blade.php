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
                    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-sm">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                            <div class="w-full md:w-1/2">
                                <label for="simple-search" class="block mb-2 text-sm font-medium text-gray-700">Search
                                    Clients</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input wire:model.live="search" type="text" id="simple-search"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                        placeholder="Search Client..." required>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <label for="statusFilter" class="block mb-2 text-sm font-medium text-gray-700">Filter by
                                    Status</label>
                                <select wire:model.live="statusFilter" id="statusFilter"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">All Statuses</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 text-right">
                        <button type="button"
                            class="bg-blue-500 text-white font-bold px-3 py-1 text-md rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                            data-bs-toggle="modal" data-bs-target="#clientModal">
                            Add Client
                        </button>
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
                                            <button wire:click="edit({{ $client->client_id }})"
                                                class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
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
    <!-- Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientModalLabel">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('client-form-component')
                </div>
            </div>
        </div>
    </div>

</div>
