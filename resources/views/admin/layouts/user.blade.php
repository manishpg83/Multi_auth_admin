@extends('admin.layouts.app')

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="custom-small-box-row">
                <div class="small-box-container">
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
                <div class="small-box-container">
                    <!-- small box -->
                    <div class="small-box bg-lime-400">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="small-box-container">
                    <!-- small box -->
                    <div class="small-box bg-rose-500">
                        <div class="inner">
                            <h3>{{ $festivals->count() }}</h3>
                            <p>Inactive Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <a href="{{ route('admin.festivals.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="small-box-container">
                    <!-- small box -->
                    <div class="small-box bg-orange-400">
                        <div class="inner">
                            <h3>{{ $plans->count() }}</h3>
                            <p>Trial Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="small-box-container">
                    <!-- small box -->
                    <div class="small-box bg-emerald-500">
                        <div class="inner">
                            <h3>5</h3>
                            <p>Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>

    <div class="card">
        @livewire('user-table')
    </div>

    <style>
        .custom-small-box-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .small-box-container {
            flex: 1;
            max-width: calc(20% - 10px);
            /* Adjust this value to add space between boxes */
            margin: 5px;
        }

        .small-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    </style>
@endsection
