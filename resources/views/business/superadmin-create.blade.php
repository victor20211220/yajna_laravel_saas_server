@extends('layouts.new-client')
@section('page-title')
    {{ __('Create Business') }}
@endsection
@section('title')
    <h3 class="mb-0 page-title">
        {{ __('Create Business') }}
    </h3>
@endsection
@section('content')
    <button class="btn btn-primary mt-4" data-bs-toggle="modal"
            data-bs-target="#exampleModal" data-url="{{ route('business.create') }}"
            data-size="xl" data-bs-whatever="{{ __('Create New Business') }}">
        {{ __('Create Business') }}
    </button>
@endsection
