@extends('layouts.admin')
@php
    $profile=asset(Storage::url('uploads/avatar/'));
    $chatgpt_setting= \App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());
@endphp
@section('page-title')
   {{__('Manage Users')}}
@endsection
@section('title')
    {{ $emailTemplate->name }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Email Template')}}</li>
@endsection
@section('action-btn')
<div class="row">
    <div class="text-end">
        <div class="text-end">
            <div class="d-flex justify-content-end drp-languages">
                @if(isset($chatgpt_setting['chatgpt_key']) && (!empty($chatgpt_setting['chatgpt_key'])))
                <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                    data-bs-placement="top">
                    <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
                        data-url="{{ route('generate', ['email template']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="{{ __('Generate') }}" data-title="{{ __('Generate content with AI') }}">
                        <i class="fas fa-robot"></i>&nbsp;{{ __('Generate with AI') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<div class="row invoice-row">
    <div class="col-lg-4 col-md-5 col-12">
        <div class="card mb-0 h-100">
            <div class="card-header card-body">
                <h5></h5>
                {{Form::model($emailTemplate, array('route' => array('email-templates.update', $emailTemplate->id), 'method' => 'PUT')) }}
                <div class="row">
                    <div class="form-group col-md-12">
                        {{Form::label('name',__('Name'),['class'=>'form-label text-dark'])}}
                        {{Form::text('name',null,array('class'=>'form-control font-style','disabled'=>'disabled'))}}
                    </div>
                    <div class="form-group col-md-12">
                        {{Form::label('from',__('From'),['class'=>'form-label text-dark'])}}
                        {{Form::text('from',null,array('class'=>'form-control font-style','required'=>'required'))}}
                    </div>
                    {{Form::hidden('lang',$currEmailTempLang->lang,array('class'=>''))}}
                    <div class="col-12 text-end">
                        <input type="submit" value="{{__('Save Changes')}}" class="btn btn-print-invoice  btn-primary m-r-10">
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7 col-12">
        <div class="card mb-0 h-100">
            <div class="card-body">
                <h5></h5>
                <div class="row text-xs">
                    <h6 class="font-weight-bold mb-4">{{__('Variables')}}</h6>
                    <div>
                        @if ($emailTemplate->name == 'User Created')
                            <p class="mb-1">{{ __('App URL') }} : <span
                                    class="pull-right text-primary">{app_url}</span></p>
                            <p class="mb-1">{{ __('User Name') }} : <span
                                    class="pull-right text-primary">{user_name}</span></p>
                            <p class="mb-1">{{ __('User Email') }} : <span
                                    class="pull-right text-primary">{user_email}</span></p>
                            <p class="mb-1">{{ __('User Password') }} : <span
                                    class="pull-right text-primary">{user_password}</span></p>
                            <p class="mb-1">{{ __('User Type') }} : <span
                                    class="pull-right text-primary">{user_type}</span></p>
                        @elseif($emailTemplate->name == 'Appointment Created')
                            <p class="mb-1">{{ __('App Name') }} : <span
                                    class="pull-right text-primary">{app_name}</span></p>
                            <p class="mb-1">{{ __('Appointment Name') }} : <span
                                    class="pull-right text-primary">{appointment_name}</span></p>
                            <p class="mb-1">{{ __('Appointment Email') }} : <span
                                    class="pull-right text-primary">{appointment_email}</span></p>
                            <p class="mb-1">{{ __('Appointment Phone') }} : <span
                                    class="pull-right text-primary">{appointment_phone}</span></p>
                            <p class="mb-1">{{ __('Appointment Date') }} : <span
                                    class="pull-right text-primary">{appointment_date}</span></p>
                            <p class="mb-1">{{ __('Appointment Time') }} : <span
                                    class="pull-right text-primary">{appointment_time}</span></p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <h5></h5>
            <div class="row row-gap">
                <div class="col-md-3 col-sm-4">
                    <div class="card sticky-top language-sidebar mb-0">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @foreach($languages as $key => $lang)
                            <a class="list-group-item list-group-item-action border-0 {{($currEmailTempLang->lang == $key)?'active':''}}" href="{{route('manage.email.language',[$emailTemplate->id,$key])}}">
                                {{Str::ucfirst($lang)}}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    </div>

                <div class="col-md-9 col-sm-8">
                    <div class="card h-100 p-3">
                        {{Form::model($currEmailTempLang, array('route' => array('updateEmail.settings',$currEmailTempLang->parent_id), 'method' => 'PUT')) }}
                            <div class="form-group col-12">
                                {{Form::label('subject',__('Subject'),['class'=>'form-label text-dark'])}}
                                {{Form::text('subject',null,array('class'=>'form-control font-style','required'=>'required'))}}
                            </div>
                            <div class="form-group col-12">
                                {{Form::label('content',__('Email Message'),['class'=>'form-label text-dark'])}}
                                {{Form::textarea('content',$currEmailTempLang->content,array('class'=>'summernote','id'=>'content','required'=>'required'))}}
                            </div>

                            <div class="col-md-12 text-end">
                                {{Form::hidden('lang',null)}}
                                <input type="submit" value="{{__('Save Changes')}}" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection
@push('custom-scripts')
<script src="{{ asset('custom/libs/summernote/summernote-bs4.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                ['list', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'unlink']],
            ],
            height: 250,
        });

    });
</script>
@endpush
