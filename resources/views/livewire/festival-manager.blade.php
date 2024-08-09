<div>
    <section class="bg-gray-50">
        <div class="max-w-screen-xl mx-auto">
            <!-- Start coding here -->
            <div class="relative overflow-hidden bg-white shadow-md sm:rounded-lg">
                <h3 class="ml-6 text-2xl font-semibold text-gray-500 mt-2">
                    Festival Table
                    @if ($statusFilter !== '')
                        (Showing {{ ucfirst($statusFilter) }} Festivals)
                    @endif
                </h3>
                <div
                    class="flex flex-col items-center justify-between p-2 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input wire:model.live="search" type="text" id="simple-search"
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-cyan-500 focus:ring-2 focus:border-cyan-500 dark:focus:ring-cyan-500 dark:focus:border-cyan-500"
                                    placeholder="Search Festival..." required>
                            </div>
                            @if ($isAdmin)
                            <div x-data="{ open: false }" class="relative inline-block ml-1 text-left">
                                <button @click="open = !open" type="button"
                                    class="inline-flex justify-center w-full px-2 py-2 text-sm font-medium text-gray-900 border border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-cyan-500"
                                    id="dropdownButton">
                                    <span>{{ $statusFilter === '' ? 'Statuses' : ucfirst($statusFilter) }}</span>
                                    <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M6.293 9.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 origin-top-right bg-white rounded-md shadow-lg w-44 ring-1 ring-black ring-opacity-5 z-1 focus:outline-none">
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
                            @endif
                        </form>
                    </div>
                    <div class="flex items-center justify-between w-full space-x-2 text-right md:w-1/2">
                        {{-- Uncomment and modify this block as needed
                        <button wire:click="sendSelectedFestivalsEmail" wire:loading.attr="disabled"
                            class="relative flex items-center px-3 py-1 space-x-2 font-bold text-white bg-blue-400 rounded-md shadow-sm text-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <!-- Email icon -->
                            <i class="fas fa-envelope"></i>
                            <!-- Button text -->
                            <span wire:loading.remove wire:target="sendSelectedFestivalsEmail">Send Emails</span>
                            <span wire:loading wire:target="sendSelectedFestivalsEmail" class="flex items-center ml-2">
                                <!-- Spinner icon -->
                                <i class="fas fa-spinner fa-spin"></i>
                                <!-- Text during loading -->
                                <span class="ml-2">Sending...</span>
                            </span>
                        </button>
                        --}}
                    
                        <button wire:click="create"
                            class="px-3 py-1 font-bold bg-yellow-300 rounded-md shadow-sm text-slate-950 text-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 ml-auto"
                            title="{{ $isAdmin ? 'Add Festival' : 'Request Festival' }}">
                            {{ $isAdmin ? 'Add Festival' : 'Request Festival' }}
                        </button>
                    </div>
                    
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                {{-- checkbox to email send --}}
                                {{-- <th scope="col" class="px-4 py-3">
                                    <input type="checkbox" wire:model="selectAll" class="form-checkbox h-5 w-5 text-blue-600 bg-gray-200 border-gray-300 rounded-md focus:ring-blue-500 focus:ring-2 cursor-pointer" />
                                </th> --}}
                                <th scope="col" class="px-4 py-1 font-bold" wire:click="sortBy('name')">Festival</th>
                                <th scope="col" class="px-4 py-1 font-bold" wire:click="sortBy('date')">Date</th>
                                <th scope="col" class="px-4 py-1 font-bold" wire:click="sortBy('subject_line')">
                                    Subject Line</th>
                                <th scope="col" class="px-4 py-1 font-bold">Email Body</th>
                                @if ($isAdmin)
                                    <th scope="col" class="px-4 py-1 font-bold" wire:click="sortBy('status')">Status
                                    </th>
                                    <th scope="col" class="px-4 py-1 font-bold">Actions</th>
                                @endif
                                <th scope="col" class="px-4 py-1 font-bold">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($festivals as $festival)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   {{-- checkbox to email send --}}
                                    {{-- <td class="px-4 py-3">
                                        <input type="checkbox" value="{{ $festival->festival_id }}" wire:model="selectedFestivalIds" class="form-checkbox h-5 w-5 text-blue-600 bg-gray-200 border-gray-300 rounded-md focus:ring-blue-500 focus:ring-2 cursor-pointer" />
                                    </td> --}}
                                    <td class="px-4 py-1">{{ $festival->name }}</td>
                                    <td class="px-4 py-1">{{ $festival->date }}</td>
                                    <td class="px-4 py-1">{{ $festival->subject_line }}</td>
                                    <td class="px-4 py-1">{{ Str::limit($festival->email_body, 50) }}</td>
                                    @if ($isAdmin)
                                        <td class="px-4 py-1">
                                            <div class="custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="status{{ $festival->festival_id }}"
                                                    wire:click="toggleStatus({{ $festival->festival_id }})"
                                                    {{ $festival->status === 'Active' ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="status{{ $festival->festival_id }}"></label>
                                            </div>
                                        </td>
                                        <td class="px-2 py-1">
                                            @if ($festival->trashed())
                                                <button wire:click="restore({{ $festival->festival_id }})"
                                                    class="text-green-500 hover:text-green-700">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button wire:click="forceDelete({{ $festival->festival_id }})"
                                                    class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button wire:click="edit({{ $festival->festival_id }})"
                                                    class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button wire:click="delete({{ $festival->festival_id }})"
                                                    class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @if (!$festival->approved)
                                                    <button wire:click="approveFestival({{ $festival->festival_id }})"
                                                        class="text-green-500 hover:text-green-700">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button wire:click="rejectFestival({{ $festival->festival_id }})"
                                                        class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    @endif
                                    <td class="px-4 py-1">
                                        <button wire:click="viewFestival({{ $festival->festival_id }})"
                                            class="text-green-600 hover:text-yellow-500"
                                            title="View Festival Details">
                                            <i class="fas fa-eye"></i>
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

    <!-- Festival Details Modal -->
    @if ($viewingFestival)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
            <div class="relative w-auto max-w-3xl mx-auto my-6">
                <!--content-->
                <div
                    class="relative flex flex-col w-full bg-white border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                    <!--header-->
                    <div
                        class="flex items-start justify-between p-3 border-b border-solid rounded-t border-blueGray-200">
                        <h3 class="text-2xl font-semibold">
                            Festival Details
                        </h3>
                    </div>
                    <!--body-->
                    <div class="relative flex-auto p-6">
                        <p class="mb-2"><strong>Name:</strong> {{ $viewingFestival->name }}</p>
                        <p class="mb-2"><strong>Date:</strong> {{ $viewingFestival->date }}</p>
                        <p class="mb-2"><strong>Status:</strong> {{ $viewingFestival->status }}</p>
                        <p class="mb-2"><strong>Subject Line:</strong> {{ $viewingFestival->subject_line }}</p>
                        <p class="mb-2"><strong>Email Body:</strong> {{ $viewingFestival->email_body }}</p>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-3 border-t border-solid rounded-b border-blueGray-200">
                        <button type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            wire:click="closeViewModal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed inset-0 z-40 bg-black opacity-25"></div>
    @endif

    <!-- Modal for Adding/Editing Festivals -->
    @if ($isModalOpen)
    <div class="modal-backdrop fade show"></div>
    <div class="modal show" style="display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog {{ $isAdmin ? 'modal-md modal-dialog-scrollable' : 'modal-sm' }}" role="document">
            <div class="modal-content max-w-lg mx-auto">
                <div class="modal-header">
                    @if ($isAdmin)
                        <h5 class="modal-title">{{ $editingFestivalId ? 'Edit Festival' : 'Add Festival' }}</h5>
                    @else
                        <h5 class="modal-title">{{ $editingFestivalId ? 'Edit Festival' : 'Request Festival' }}</h5>
                    @endif
                    <button type="button" class="close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editingFestivalId ? 'update' : 'store' }}">
                        <div class="form-group">
                            <label for="name">Festival Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" wire:model="date" required
                                @if (!$isAdmin) min="{{ date('Y-m-d') }}" @endif>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($isAdmin)
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" wire:model="status" required>
                                    <option value="" disabled>Select Status</option>
                                    <option value="Active" {{ $status === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subject_line">Subject Line</label>
                                <input type="text" class="form-control @error('subject_line') is-invalid @enderror" id="subject_line" wire:model="subject_line" required>
                                @error('subject_line')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_body">Email Body</label>
                                <textarea class="form-control @error('email_body') is-invalid @enderror" id="email_body" wire:model="email_body" required></textarea>
                                @error('email_body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    <button type="submit" class="btn btn-primary" wire:click="{{ $editingFestivalId ? 'update' : 'store' }}">
                        @if ($isAdmin)
                            {{ $editingFestivalId ? 'Update Festival' : 'Add Festival' }}
                        @else
                            {{ $editingFestivalId ? 'Update Request' : 'Request Festival' }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif



    <!-- New Confirmation Modal -->
    @if ($selectedFestivalId)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                    Send Festival Email
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to send emails for this festival to all active clients?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="sendFestivalEmail" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            {{ $isLoading ? 'disabled' : '' }}>
                            @if ($isLoading)
                                <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Sending...
                            @else
                                Send
                            @endif
                        </button>
                        <button wire:click="$set('selectedFestivalId', null)" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            {{ $isLoading ? 'disabled' : '' }}>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
