<div>
    <section class="bg-gray-50  ">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input wire:model.live="search" type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search Festival..." required>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 text-right">
                        <button wire:click="create"
                            class="bg-yellow-400 text-white px-2 py-1 text-md rounded-md shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            Add Festival
                        </button>

                        {{-- <select wire:model="statusFilter" class="ml-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:focus:border-primary-500">
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <p>Current Filter: {{ $statusFilter }}</p> --}}

                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('festival_id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('name')">Festival</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('date')">Date</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('status')">Status</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('subject_line')">Subject Line
                                </th>
                                <th scope="col" class="px-4 py-3">Email Body</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($festivals as $festival)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $festival->festival_id }}</td>
                                    <td class="px-4 py-3">{{ $festival->name }}</td>
                                    <td class="px-4 py-3">{{ $festival->date }}</td>
                                    <td class="px-4 py-3">
                                        <div class="custom-control custom-switch custom-switch-zindex">
                                            <input type="checkbox" class="custom-control-input"
                                                id="status{{ $festival->festival_id }}"
                                                wire:click="toggleStatus({{ $festival->festival_id }})"
                                                {{ $festival->status === 'Active' ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="status{{ $festival->festival_id }}"></label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $festival->subject_line }}</td>
                                    <td class="px-4 py-3">{{ Str::limit($festival->email_body, 50) }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                        <button wire:click="edit({{ $festival->festival_id }})"
                                            class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="delete({{ $festival->festival_id }})"
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
                    {{ $festivals->links() }}
                </div>
            </div>
        </div>
    </section>

    @if ($isModalOpen)
        <div class="modal-backdrop fade show"></div>
        <div class="modal show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingFestivalId ? 'Edit Festival' : 'Add Festival' }}</h5>
                        <button type="button" class="close" wire:click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $editingFestivalId ? 'update' : 'store' }}">
                            <div class="form-group">
                                <label for="name">Festival Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" wire:model="date">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    wire:model="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_scheduled">Email Scheduled</label>
                                <select class="form-control @error('email_scheduled') is-invalid @enderror"
                                    id="email_scheduled" wire:model="email_scheduled">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                @error('email_scheduled')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subject_line">Subject Line</label>
                                <input type="text" class="form-control @error('subject_line') is-invalid @enderror"
                                    id="subject_line" wire:model="subject_line">
                                @error('subject_line')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_body">Email Body</label>
                                <textarea class="form-control @error('email_body') is-invalid @enderror" id="email_body" wire:model="email_body"
                                    rows="5"></textarea>
                                @error('email_body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div wire:loading class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    wire:click="closeModal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
