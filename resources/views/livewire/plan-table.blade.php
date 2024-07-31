<div>
    <section class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <h3 class="text-2xl font-semibold text-gray-500 mb-2 ml-6 mt-2">Plans Table</h3>
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input wire:model.debounce.300ms="search" type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:ring-2 focus:border-primary-500 block w-full pl-10 p-2"
                                    placeholder="Search Plans..." required>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 text-right">
                        <button wire:click="create"
                            class="bg-orange-500 text-white px-3 py-1 font-bold text-md rounded-md shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            data-bs-toggle="modal" data-bs-target="#addPlanModal">
                            Add Plan
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('plan_id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('plan_name')">Plan Name</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('plan_type')">Plan Type</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('amount')">Amount</th>
                                <th scope="col" class="px-4 py-3" wire:click="sortBy('plan_description')">Description
                                </th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                                <tr class="border-b text-gray-600">
                                    <td class="px-4 py-3">{{ $plan->plan_id }}</td>
                                    <td class="px-4 py-3">{{ $plan->plan_name }}</td>
                                    <td class="px-4 py-3">{{ $plan->plan_type }}</td>
                                    <td class="px-4 py-3">{{ $plan->amount }}</td>
                                    <td class="px-4 py-3">{{ $plan->plan_description }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center space-x-2">
                                            @if ($plan->trashed())
                                                <button wire:click="restore({{ $plan->plan_id }})"
                                                    class="text-green-500 hover:text-green-700">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button wire:click="forceDelete({{ $plan->plan_id }})"
                                                    class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button wire:click="edit({{ $plan->plan_id }})"
                                                    class="text-blue-500 hover:text-blue-700" data-bs-toggle="modal"
                                                    data-bs-target="#editPlanModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button wire:click="delete({{ $plan->plan_id }})"
                                                    class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                <div class="p-4">
                    {{ $plans->links() }}
                </div>
            </div>
        </div>
    </section>

    @if ($isModalOpen)
        <!-- Modal for Editing Plans -->
        <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="save">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPlanModalLabel">Edit Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_plan_type">Plan Type</label>
                                <input type="text" class="form-control" id="edit_plan_type" wire:model="planType"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="edit_plan_name">Plan Name</label>
                                <input type="text" class="form-control" id="edit_plan_name" wire:model="planName"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="edit_amount">Amount</label>
                                <input type="number" class="form-control" id="edit_amount" wire:model="amount"
                                    min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_plan_description">Plan Description</label>
                                <textarea class="form-control" id="edit_plan_description" wire:model="description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Adding Plans -->
        <div class="modal fade" id="addPlanModal" tabindex="-1" aria-labelledby="addPlanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPlanModalLabel">Add Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="add_plan_type">Plan Type</label>
                                <input type="text" class="form-control" id="add_plan_type" wire:model="planType"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="add_plan_name">Plan Name</label>
                                <input type="text" class="form-control" id="add_plan_name" wire:model="planName"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="add_amount">Amount</label>
                                <input type="number" class="form-control" id="add_amount" wire:model="amount"
                                    min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="add_plan_description">Plan Description</label>
                                <textarea class="form-control" id="add_plan_description" wire:model="description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
