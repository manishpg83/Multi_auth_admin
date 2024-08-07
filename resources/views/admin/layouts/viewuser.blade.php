@extends('admin.layouts.app')

@section('content')
    @livewire('admin.view-user-details', ['userId' => $user->user_id])
@endsection
