@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Clients</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p>Email Sent</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Email Opened</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope-open"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Email Replied</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-reply"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- Example Table -->
            <table id="clientTable" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <!-- Other headers -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                        <!-- Other data -->
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <!-- Other data -->
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            

            <!-- Example Table -->
            <table id="festivalTable" class="table" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <!-- Other headers -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Summer Festival</td>
                        <td>2024-08-15</td>
                        <!-- Other data -->
                    </tr>
                    <tr>
                        <td>Spring Festival</td>
                        <td>2024-05-20</td>
                        <!-- Other data -->
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // Check if first name is empty or null
            var firstName = "{{ Auth::user()->first_name }}";
            if (!firstName) {
                Swal.fire({
                    title: "Complete Your Profile",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: false, // Disable cancel button
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Complete Profile",
                    allowOutsideClick: false // Prevent clicking outside the modal to close
                }).then((result) => {
                    // Redirect to edit profile page when confirmed
                    window.location.href =
                        "{{ route('profile.edit') }}"; // Replace 'profile.edit' with your actual route name
                });
            }

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
