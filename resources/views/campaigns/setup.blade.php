@extends('layouts.admin')
@php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
@endphp
@section('page-title')
    {{ __('Manage Branch') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Business') }}</li>
@endsection
@section('title')
    {{ __(' Business Settings') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-3">
            @include('layouts.marketplace_setup')
        </div>
        <div class="col-xxl-9">

            <div class="card mb-0">
                <div class="card-header">
                    <h5>{{ 'Cost Per Day Settings' }}</h5>
                </div>
                {{ Form::open(['route' => 'wholesale.cost-setting', 'method' => 'post']) }}
                <div class="card-body">
                    <div class="row">
                        <div class="repeater">
                            <div class="col-lg-12 text-end mb-2">
                                <a data-repeater-create type="button" value="Add" class="submitbtn btn btn-sm btn-primary"
                                data-bs-placement="top" data-bs-toggle="tooltip"
                                title="{{__('Create')}}" data-bs-original-title="{{ __('Create') }}">
                                    <i class="ti ti-plus text-white"></i>
                                </a>
                            </div>
                            <div data-repeater-list="category_group">
                                @if (!empty($costDetail) && count($costDetail) > 0)
                                    @foreach ($costDetail as $cost)
                                        <div data-repeater-item class="row row-gap align-items-end mt-3">
                                            <input type="hidden" name="id" class="cat_id" value="{{ $cost->id }}" />
                                            <div class="col-sm-3 col-6">
                                                {{ Form::label('min', __('Min Days'), ['class' => 'mb-2']) }}
                                                <input class="dtpiker form-control" type="text" name="min" value="{{ $cost->min }}" placeholder="{{ __('Enter minimum days') }}"  />
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                {{ Form::label('max', __('Max Days'), ['class' => 'mb-2']) }}
                                                <input class="dtpiker form-control" type="text" name="max" value="{{ $cost->max }}"  placeholder="{{ __('Enter maximum days') }}" />
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                {{ Form::label('price', __('Per Day Price'), ['class' => 'mb-2']) }}
                                                <input class="dtpiker form-control" type="text" name="price" value="{{ $cost->price }}"  placeholder="{{ __('Enter price per day') }}"  />
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <a data-repeater-delete href="javascript:void(0)" class="btn btn-sm btn-danger mb-2"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    title="{{__('Delete')}}" data-bs-original-title="{{ __('Create') }}">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div data-repeater-item class="row row-gap align-items-end mt-3">
                                        <div class="col-sm-3 col-6">
                                            {{ Form::label('min', __('Min Days'), ['class' => 'mb-2']) }}
                                            <input class="dtpiker form-control" type="text" name="min" value="" required placeholder="{{ __('Enter minimum days') }}"/>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            {{ Form::label('max', __('Max Days'), ['class' => 'mb-2']) }}
                                            <input class="dtpiker form-control" type="text" name="max" value="" required placeholder="{{ __('Enter maximum days') }}" />
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            {{ Form::label('price', __('Per Day Price'), ['class' => 'mb-2']) }}
                                            <input class="dtpiker form-control" type="text" name="price" value="" required   placeholder="{{ __('Enter price per day') }}" />
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <a data-repeater-delete href="javascript:void(0)" class="btn btn-sm btn-danger mb-2"
                                            data-bs-placement="top" data-bs-toggle="tooltip"
                                            title="{{__('Delete')}}" data-bs-original-title="{{ __('Create') }}">
                                                <i class="ti ti-trash text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <input type="hidden" name="deleted_ids" id="deleted_ids" value="">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice btn-primary']) }}
                </div>
                {{ Form::close() }}

            </div>

        </div>

    </div>
@endsection
@push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function () {
            var deletedIds = [];

            $('.repeater').repeater({
                initEmpty: {{ empty($costDetail) ? 'true' : 'false' }},
                defaultValues: {
                    'min': '',
                    'max': '',
                    'price': ''
                },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {

                var totalItems = $('.repeater [data-repeater-item]').length;

                if (totalItems === 1) {
                    alert("At least one cost setting must be present. You cannot delete the last item.");
                    return;
                }


                var id = $(this).find('.cat_id').val();
                if (id) {
                    deletedIds.push(id);
                    $('#deleted_ids').val(deletedIds.join(','));
                }
                $(this).slideUp(deleteElement);
            },
            ready: function (setIndexes) {
                // Optional callback when repeater is ready
            }
            });


        });
    </script>
@endpush
