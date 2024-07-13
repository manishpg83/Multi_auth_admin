@extends('admin.layouts.app')

@section('content')
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
                        <table class="table table-hover text-nowrap" id="festivalTable" style="width: 100% !important;">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        $(document).ready(function() {
            var notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'right',
                    y: 'top',
                },
                dismissible: true,
                ripple: false,
                types: [{
                        type: 'success',
                        layout: 'bottomLeft',
                    },
                    {
                        type: 'error',
                        layout: 'bottomRight',
                    },
                ],
            });
            var table = $('#festivalTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.festivals.index') }}",
                columns: [{
                        data: 'festival_id',
                        name: 'festival_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'subject_line',
                        name: 'subject_line'
                    },
                    {
                        data: 'email_body',
                        name: 'email_body'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#addFestivalForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    dataType: 'json', // Expect JSON response from server
                    success: function(response) {
                        if (response.success) {
                            notyf.success(response.message);
                            $('#addFestivalModal').modal('hide'); // Optionally close modal
                            $('#addFestivalForm')[0].reset(); // Optionally reset form
                            // Reload the DataTable (if using one)
                            $('#festivalTable').DataTable().ajax.reload();
                        } else {
                            notyf.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        notyf.error('Failed to create festival. Please try again.');
                    }
                });
            });
            // Handle edit button click
            $('#festivalTable').on('click', '.edit-btn', function(e) {
                e.preventDefault();
                var festivalId = $(this).data('festival-id');
                $.ajax({
                    url: "{{ route('admin.festivals.edit', ':id') }}".replace(':id', festivalId),
                    type: 'GET',
                    success: function(response) {
                        $('#editFestivalForm').attr('action',
                            "{{ route('admin.festivals.update', ':id') }}".replace(':id',
                                festivalId));
                        $('#editName').val(response.name);
                        $('#editDate').val(response.date);
                        $('#editStatus').val(response.status);
                        $('#editEmailScheduled').val(response.email_scheduled);
                        $('#editSubjectLine').val(response.subject_line);
                        $('#editEmailBody').val(response.email_body);
                        $('#editFestivalModal').modal('show');
                    },

                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Handle edit form submission
            $('#editFestivalForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(response) {
                        $('#editFestivalModal').modal('hide');
                        table.ajax.reload();
                        if (response.success) {
                            notyf.success(response.message);
                        } else {
                            notyf.error('Failed to update festival. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
            // Handle delete button click
            $('#festivalTable').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var festivalId = $(this).data('festival-id');
                if (confirm("Are you sure you want to delete this festival?")) {
                    $.ajax({
                        url: "{{ route('admin.festivals.destroy', ':id') }}".replace(':id',
                            festivalId),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            notyf.success(response.message);
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            notyf.error('Failed to delete festival. Please try again.');
                        }
                    });
                }
            });

        });
    </script>
@endsection
