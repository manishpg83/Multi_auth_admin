@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Plans Management Box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Plans Management</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-block btn-outline-primary"
                                    style="margin-left: 5px;" data-toggle="modal"
                                    data-target="#addPlanModal">
                                    Add Plan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="planTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Plan Type</th>
                                <th>Plan Name</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($plans as $plan)
                                <tr>
                                    <td>{{ $plan->plan_id }}</td>
                                    <td>{{ $plan->plan_type }}</td>
                                    <td>{{ $plan->plan_name }}</td>
                                    <td>{{ $plan->amount }}</td>
                                    <td>{{ $plan->plan_description }}</td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="#"
                                            class="text-indigo-600 hover:text-indigo-900 edit-plan-btn"
                                            data-toggle="modal" data-target="#editPlanModal"
                                            data-id="{{ $plan->plan_id }}"
                                            data-type="{{ $plan->plan_type }}"
                                            data-name="{{ $plan->plan_name }}"
                                            data-amount="{{ $plan->amount }}"
                                            data-description="{{ $plan->plan_description }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Icon -->
                                        |
                                        <a href="#" class="text-red-600 hover:text-red-900 delete-btn"
                                            data-festival-id="{{ $plan->plan_id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>

                                        <!-- Delete Form -->
                                        <form id="delete-form-{{ $plan->plan_id }}"
                                            action="{{ route('admin.plans.destroy', $plan->plan_id) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No plans found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal for Editing Plans -->
            <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editPlanForm" action="{{ route('admin.plans.update', ':plan_id') }}"
                            method="POST">
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
                                    <input type="text" class="form-control" id="edit_plan_type"
                                        name="plan_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="edit_plan_name"
                                        name="plan_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_amount">Amount</label>
                                    <input type="number" class="form-control" id="edit_amount"
                                        name="amount" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_plan_description">Plan Description</label>
                                    <textarea class="form-control" id="edit_plan_description" name="plan_description" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
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
                        <form action="{{ route('admin.plans.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPlanModalLabel">Add Plan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="plan_type">Plan Type</label>
                                    <input type="text" class="form-control" id="plan_type"
                                        name="plan_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="plan_name"
                                        name="plan_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="plan_description">Plan Description</label>
                                    <textarea class="form-control" id="plan_description" name="plan_description" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Plan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection