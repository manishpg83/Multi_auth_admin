@extends('admin.layouts.app')

@section('content')
    <div class="mt-4 mb-16"> <!-- This div adds margin to top and bottom -->
        @livewire('plan-table')
    </div>
@endsection
