@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Festival Management</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-block btn-outline-primary" style="margin-left: 5px;" data-toggle="modal" data-target="#addFestivalModal">
                                    Add Festival
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="addFestivalModal" tabindex="-1" aria-labelledby="addFestivalModalLabel" aria-hidden="true">
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
                                    <span class="{{ $festival->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                                        {{ $festival->status }}
                                    </span>
                                </td>
                                <td>{{ $festival->subject_line }}</td>
                                <td>{{ $festival->email_body }}</td>
                                <td>
                                    <!-- Edit Icon -->
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900" data-toggle="modal"
                                       data-target="#editFestivalModal{{ $festival->festival_id }}">
                                       <i class="fas fa-edit"></i>
                                    </a>
                                
                                    <!-- Delete Icon -->
                                    |
                                    <a href="#" class="text-red-600 hover:text-red-900"
                                       onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this festival?')) { document.getElementById('delete-form-{{ $festival->festival_id }}').submit(); }">
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
                            <div class="modal fade" id="editFestivalModal{{ $festival->festival_id }}"
                                tabindex="-1"
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
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label
                                                        for="name{{ $festival->festival_id }}">Festival
                                                        Name</label>
                                                    <input type="text" class="form-control"
                                                        id="name{{ $festival->festival_id }}"
                                                        name="name" value="{{ $festival->name }}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="date{{ $festival->festival_id }}">Date</label>
                                                    <input type="date" class="form-control"
                                                        id="date{{ $festival->festival_id }}"
                                                        name="date" value="{{ $festival->date }}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="status{{ $festival->festival_id }}">Status</label>
                                                    <select class="form-control"
                                                        id="status{{ $festival->festival_id }}"
                                                        name="status" required>
                                                        <option value="active"
                                                            {{ $festival->status === 'active' ? 'selected' : '' }}>
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
                                                    <textarea class="form-control"
                                                        id="email_body{{ $festival->festival_id }}"
                                                        name="email_body">{{ $festival->email_body }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
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
</div>
@endsection
