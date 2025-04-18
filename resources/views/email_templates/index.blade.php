@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Email Template') }}
@endsection
@section('title')
    {{ __('Manage Email Template') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Email Template') }}</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class=" card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($EmailTemplates->count() > 0)
                                    @foreach ($EmailTemplates as $EmailTemplate)
                                        <tr>
                                        <tr>
                                            <td>
                                                <div class="font-style font-weight-bold">{{ $EmailTemplate->name }}</div>
                                            </td>

                                            <td>
                                                <a href="{{ route('manage.email.language', [$EmailTemplate->id, \Auth::user()->lang]) }}"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Email Template Show') }}"
                                                    class="btn btn-warning btn-sm me-2">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="col" colspan="7">
                                            <h6 class="text-center p-4">{{ __('No Manually Plan Request Found.') }}</h6>
                                        </th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
