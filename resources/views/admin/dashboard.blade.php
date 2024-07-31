@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Main Dashboard Content -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-cyan-500">
                            <div class="inner">
                                <h3>{{ $users->count() }}</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow-400">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Email sent ratio</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-lime-500">
                            <div class="inner">
                                <h3>{{ $festivals->count() }}</h3>
                                <p>Total Festival</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                            <a href="{{ route('admin.festivals.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-orange-400">
                            <div class="inner">
                                <h3>{{ $plans->count() }}</h3>
                                <p>Total Plans</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <a href="{{ route('admin.plans.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <!-- users table -->
                    <div class="card">
                        @livewire('user-table')
                    </div>
                    <!-- festival table -->
                    <div class="card">
                        @livewire('festival-manager')
                    </div>
                    <!-- Plans Management Box -->
                    <div class="card">
                        @livewire('plan-table')
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
