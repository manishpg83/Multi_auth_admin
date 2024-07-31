@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid mt-2">
            <!-- Small boxes (Stat box) -->
            <livewire:dashboard />
            <!-- /.row -->

            <!-- Festivals Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @livewire('festival-manager')
                    </div>
                </div>
            </div>
            <!-- Clients Table -->
            <div class="row mb-10">
                <div class="col-12">
                    <div class="card">
                        @livewire('client-manager')
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        var firstName = "{{ Auth::user()->first_name }}";
        var lastName = "{{ Auth::user()->last_name }}";
        var companyName = "{{ Auth::user()->company_name }}";

        if (!firstName || !lastName || !companyName) {
            Swal.fire({
                title: "Complete Your Profile",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Complete Profile",
                allowOutsideClick: false
            }).then((result) => {
                window.location.href =
                    "{{ route('profile.edit') }}";
            });
        }

        $(document).ready(function() {
            $('#festivalTable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('festivals.index') }}",
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
                ]
            });

            $('#clientTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client.list') }}",
                columns: [{
                        data: 'client_id',
                        name: 'client_id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                ]
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('notify', message => {
                const notyf = new Notyf({
                    duration: 5000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                });
                notyf.success(message.message);
            });
        });
    </script>
@endsection
