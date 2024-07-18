@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Main Dashboard Content -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $users->count() }}</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Email sent ratio</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $festivals->count() }}</h3>
                                <p>Total Festival</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <a href="{{ route('admin.festivals.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $plans->count() }}</h3>
                                <p>Total Plans</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <!-- ./col -->
                </div>
                <!-- client table -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">User List</h3>
                                        <div class="card-tools">
                                            {{-- <div class="input-group input-group-sm">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-block btn-outline-primary" style="margin-left: 5px;" data-toggle="modal" data-target="#addUserModal">
                                                        Add User
                                                    </button> 
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap" id="clientTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->user_id }}</td>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">No users found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- festival table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Festival Management</h3>
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm">

                                                {{-- <div class="input-group-append">
                                                    <button type="button" class="btn btn-block btn-outline-primary" style="margin-left: 5px;" data-toggle="modal" data-target="#addFestivalModal">
                                                        Add Festival
                                                    </button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="addFestivalModal" tabindex="-1"
                                        aria-labelledby="addFestivalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.festivals.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addFestivalModalLabel">Add Festival</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Festival Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Date</label>
                                                            <input type="date" class="form-control" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control" id="status" name="status" required>
                                                                <option value="active">Active</option>
                                                                <option value="inactive">Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="email_scheduled">Email Scheduled</label>
                                                                <select class="form-control" id="email_scheduled" name="email_scheduled" required>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="subject_line">Subject Line</label>
                                                            <input type="text" class="form-control" id="subject_line" name="subject_line">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_body">Email Body</label>
                                                            <textarea class="form-control" id="email_body" name="email_body"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap" id="festivalTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Festival</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Subject Line</th>
                                                    <th>Email Body</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($festivals as $festival)
                                                    <tr>
                                                        <td>{{ $festival->festival_id }}</td>
                                                        <td>{{ $festival->name }}</td>
                                                        <td>{{ $festival->date }}</td>
                                                        <td>
                                                            <span class="{{ $festival->status === 'Active' ? 'status-active' : 'status-inactive' }}"> {{ $festival->status }} </span>
                                                        </td>
                                                        <td>{{ $festival->subject_line }}</td>
                                                        <td>{{ $festival->email_body }}</td>
                                                        <td>
                                                            <!-- Edit Icon -->
                                                            <a href="#" class="text-indigo-600 hover:text-indigo-900" data-toggle="modal" data-target="#editFestivalModal{{ $festival->festival_id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>

                                                            <!-- Delete Icon -->
                                                            |
                                                            <a href="#"
                                                                class="text-red-600 hover:text-red-900 delete-btn"
                                                                data-festival-id="{{ $festival->festival_id }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>

                                                            <!-- Delete Form -->
                                                            <form id="delete-form-{{ $festival->festival_id }}"
                                                                action="{{ route('admin.festivals.destroy', $festival->festival_id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- Edit Festival Modal -->
                                                    <div class="modal fade"
                                                        id="editFestivalModal{{ $festival->festival_id }}" tabindex="-1"
                                                        aria-labelledby="editFestivalModalLabel{{ $festival->festival_id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form
                                                                    action="{{ route('admin.festivals.update', $festival->festival_id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editFestivalModalLabel{{ $festival->festival_id }}">
                                                                            Edit Festival</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="name{{ $festival->festival_id }}">Festival
                                                                                Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name{{ $festival->festival_id }}"
                                                                                name="name"
                                                                                value="{{ $festival->name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="date{{ $festival->festival_id }}">Date</label>
                                                                            <input type="date" class="form-control"
                                                                                id="date{{ $festival->festival_id }}"
                                                                                name="date"
                                                                                value="{{ $festival->date }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="status{{ $festival->festival_id }}">Status</label>
                                                                            <select class="form-control"
                                                                                id="status{{ $festival->festival_id }}"
                                                                                name="status" required>
                                                                                <option value="Active"
                                                                                    {{ $festival->status === 'Active' ? 'selected' : '' }}>
                                                                                    Active</option>
                                                                                <option value="inactive"
                                                                                    {{ $festival->status === 'inactive' ? 'selected' : '' }}>
                                                                                    Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="email_scheduled{{ $festival->festival_id }}">Email
                                                                                Scheduled</label>
                                                                            <input type="text" class="form-control"
                                                                                id="email_scheduled{{ $festival->festival_id }}"
                                                                                name="email_scheduled"
                                                                                value="{{ $festival->email_scheduled }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="subject_line{{ $festival->festival_id }}">Subject
                                                                                Line</label>
                                                                            <input type="text" class="form-control"
                                                                                id="subject_line{{ $festival->festival_id }}"
                                                                                name="subject_line"
                                                                                value="{{ $festival->subject_line }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="email_body{{ $festival->festival_id }}">Email
                                                                                Body</label>
                                                                            <textarea class="form-control" id="email_body{{ $festival->festival_id }}" name="email_body">{{ $festival->email_body }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <tr>
                                                        <td colspan="7">No festivals found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                </section>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // DataTables initialization
            $('#clientTable').DataTable();
            $('#festivalTable').DataTable();



            // Clear form fields when the modal is opened
            $('#addFestivalModal').on('show.bs.modal', function(event) {
                $('#name').val('');
                $('#date').val('');
                $('#status').val('active'); // Set default status if needed
                $('#email_scheduled').val('');
                $('#subject_line').val('');
                $('#email_body').val('');
            });
        });

        $(document).ready(function() {
            // Edit plan modal handling
            $('.edit-plan-btn').on('click', function() {
                var planId = $(this).data('id');
                var planType = $(this).data('type');
                var planName = $(this).data('name');
                var amount = $(this).data('amount');
                var description = $(this).data('description');

                $('#editPlanModal #edit_plan_type').val(planType);
                $('#editPlanModal #edit_plan_name').val(planName);
                $('#editPlanModal #edit_amount').val(amount);
                $('#editPlanModal #edit_plan_description').val(description);

                var editUrl = $('#editPlanForm').attr('action').replace(':plan_id', planId);
                $('#editPlanForm').attr('action', editUrl);
            });
        });

        $(document).ready(function() {
            // Clear form fields when the modal is opened
            $('#addPlanModal').on('show.bs.modal', function(event) {
                $('#plan_type').val('');
                $('#plan_name').val('');
                $('#amount').val('');
                $('#plan_description').val('');
            });
        });
    </script>
@endsection
