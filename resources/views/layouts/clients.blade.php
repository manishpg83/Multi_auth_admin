@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-16">
        @livewire('client-statistics')
        @livewire('client-manager')
    </div>
@endsection
