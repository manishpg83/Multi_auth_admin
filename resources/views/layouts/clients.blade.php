@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-16"> <!-- This div adds margin to top and bottom -->
        @livewire('client-statistics')
        @livewire('client-manager')
    </div>
@endsection
