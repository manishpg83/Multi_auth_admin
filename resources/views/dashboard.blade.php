@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid mt-2">
            <!-- Small boxes (Stat box) -->
            <livewire:dashboard />
            <!-- /.row -->

            <!-- Festivals Table -->
            <div class="py-4 container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Festival Management</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-block btn-outline-primary"
                                                style="margin-left: 5px;" data-toggle="modal" data-target="#addFestivalModal">
                                                Add Festival
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addFestivalModal" tabindex="-1" aria-labelledby="addFestivalModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="addFestivalForm" action="{{ route('admin.festivals.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addFestivalModalLabel">Add Festival</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Festival Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_scheduled">Email Scheduled</label>
                                                    <select class="form-control" id="email_scheduled" name="email_scheduled"
                                                        required>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subject_line">Subject Line</label>
                                                    <input type="text" class="form-control" id="subject_line"
                                                        name="subject_line">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_body">Email Body</label>
                                                    <textarea class="form-control" id="email_body" name="email_body"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Add this just before the closing </div> of the card -->
                            <!-- Edit Festival Modal -->
                            <div class="modal fade" id="editFestivalModal" tabindex="-1" aria-labelledby="editFestivalModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="editFestivalForm" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editFestivalModalLabel">Edit Festival</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="editName">Festival Name</label>
                                                    <input type="text" class="form-control" id="editName" name="name"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editDate">Date</label>
                                                    <input type="date" class="form-control" id="editDate" name="date"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editStatus">Status</label>
                                                    <select class="form-control" id="editStatus" name="status" required>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmailScheduled">Email Scheduled</label>
                                                    <select class="form-control" id="editEmailScheduled" name="email_scheduled"
                                                        required>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editSubjectLine">Subject Line</label>
                                                    <input type="text" class="form-control" id="editSubjectLine"
                                                        name="subject_line">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmailBody">Email Body</label>
                                                    <textarea class="form-control" id="editEmailBody" name="email_body"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="p-0 card-body table-responsive">
                                <table class="table table-hover text-nowrap" id="festivalTable1" style="width: 100% !important;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Festival</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Subject Line</th>
                                            <th>Email Body</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clients Table -->
            <div class="py-4 container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Client Data</h3>
                            </div>
                            <div class="p-0 card-body table-responsive">
                                <table class="table table-hover text-nowrap" id="clientTable" style="width: 100% !important;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Company Name</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#festivalTable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('festivals.index') }}", // Adjust the route name as per your route configuration
                columns: [
                    { data: 'festival_id', name: 'festival_id' },
                    { data: 'name', name: 'name' },
                    { data: 'date', name: 'date' },
                    { data: 'status', name: 'status' },
                    { data: 'subject_line', name: 'subject_line' },
                    { data: 'email_body', name: 'email_body' },
                    // Add more columns as needed
                ]
            });

            // Initialize client table
            $('#clientTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client.list') }}", // Adjust the route name as per your client routes
                columns: [
                    { data: 'client_id', name: 'client_id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'company_name', name: 'company_name' },
                ]
            });
        });
    </script>
@endsection
