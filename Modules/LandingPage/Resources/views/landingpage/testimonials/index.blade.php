@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Page') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Landing Page')}}</li>
@endsection
@section('title')
    {{ __('Landing Page') }}
@endsection
@php
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo=\App\Models\Utility::get_file('uploads/landing_page_image');
@endphp

@push('css-page')

<link rel="stylesheet" href="{{asset('custom/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('custom-scripts')
<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/tinymce.min.js')}}" referrerpolicy="origin"></script>



@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Landing Page')}}</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card mb-xl-0 sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">

                            @include('landingpage::layouts.tab')


                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    {{--  Start for all settings tab --}}


                        <div class="card">
                            {{ Form::open(array('route' => 'testimonials.store', 'method'=>'post', 'enctype' => "multipart/form-data",'class' => 'needs-validation', 'novalidate')) }}
                                @csrf
                            <div class="card-header d-flex align-items-center justify-content-between gap-2">
                                <h5>{{ __('Testimonials') }}</h5>
                                    <div class="form-check form-switch custom-switch-v1">
                                        <input type="checkbox" class="form-check-input input-primary" name="testimonials_status" id="testimonials_status"
                                            {{ $settings['testimonials_status'] == 'on' ? 'checked="checked"' : '' }}>
                                        <label class="custom-control-label" for="testimonials_status"></label>
                                    </div>
                            </div>


                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}<x-required></x-required>
                                                {{ Form::text('testimonials_heading',$settings['testimonials_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading'),'required'=>'required']) }}
                                                @error('mail_host')
                                                <span class="invalid-mail_driver" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}<x-required></x-required>
                                                {{ Form::text('testimonials_description', $settings['testimonials_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description'),'required'=>'required']) }}
                                                @error('testimonials_description')
                                                <span class="invalid-testimonials_description" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-0">
                                                {{ Form::label('Long Description', __('Long Description'), ['class' => 'form-label']) }}<x-required></x-required>
                                                {{ Form::textarea('testimonials_long_description', $settings['testimonials_long_description'], ['class' => 'form-control', 'placeholder' => __('Enter Long Description'),'required'=>'required']) }}
                                                @error('testimonials_long_description')
                                                <span class="invalid-mail_port" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-print-invoice btn-primary" type="submit" >{{ __('Save Changes') }}</button>
                                </div>
                            {{ Form::close() }}

                        </div>


                        <div class="card mb-0">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <h5>{{ __('Testimonials List') }}</h5>
                                    </div>
                                    <div class="col-3 justify-content-end d-flex">
                                        <a data-size="lg" data-url="{{ route('testimonials_create') }}" data-ajax-popup="true" title="{{__('Create Testimonial')}}"
                                        data-bs-toggle="tooltip" data-title="{{__('Create Testimonial')}}"  class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus text-light"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- <div class="justify-content-end d-flex">

                                    <a data-size="lg" data-url="{{ route('users.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                                        <i class="ti ti-plus text-light"></i>
                                    </a>
                                </div> --}}

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{__('No')}}</th>
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @if (is_array($testimonials) || is_object($testimonials))
                                            @php
                                                $no = 1
                                            @endphp
                                                @foreach ($testimonials as $key => $value)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $value['testimonials_title'] }}</td>
                                                        <td>
                                                            <span>
                                                                <div class="action-btn  me-2">
                                                                        <a href="#" class="mx-3 bg-info btn btn-sm align-items-center" data-url="{{ route('testimonials_edit',$key) }}" data-ajax-popup="true" data-title="{{__('Edit Testimonial')}}" data-size="lg" data-bs-toggle="tooltip"  title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                                    <div class="action-btn me-2">
                                                                        <a href="#"
                                                                            class="bs-pass-para bg-danger mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                            data-confirm="{{ __('Are You Sure?') }}"
                                                                            data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                            data-confirm-yes="delete-form-{{ $key }}"
                                                                            title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"><span class="text-white"><i
                                                                                    class="ti ti-trash"></i></span></a>
                                                                    </div>
                                                                    {!! Form::open([
                                                                        'method' => 'GET',
                                                                        'route' => ['testimonials_delete', $key],
                                                                        'id' => 'delete-form-' . $key,
                                                                    ]) !!}
                                                                    {!! Form::close() !!}

                                                                </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection



