@extends('layouts.new-client')
@section('page-title')
    {{ __('Create Business') }}
@endsection
@section('title')
    <div>
        <h4 class="mb-4">
            {{ __('Create Business') }}
        </h4>
    </div>
@endsection
@section('content')
    <button class="btn btn-danger" data-bs-toggle="modal"
       data-bs-target="#exampleModal" data-url="{{ route('business.create') }}"
       data-size="xl" data-bs-whatever="{{ __('Create New Business') }}">
        {{ __('Create Business') }}
    </button>
@endsection
