@php
    use App\Models\Utility;
    $card_theme = json_decode($business->card_theme);
    $business_id = $business->id;

    $social_no = 1;
    $service_row_no = 0;

    $SITE_RTL = Utility::settings()['SITE_RTL'];

    $banner = Utility::get_file('card_banner');
    $logo = Utility::get_file('card_logo');
    $company_logo = Utility::get_file('card_company_logo');
    $s_image = Utility::get_file('service_images');
    $gallery_path= Utility::get_file('gallery');
    $qr_path = Utility::get_file('qrcode');


@endphp
@extends('layouts.new-client')
@section('page-title')
    {{ __('Profile') }}
@endsection
@section('title')
    <div class="d-flex gap-5 mb-4 pb-2">
        <div class="d-flex flex-column w-100 gap-4 gap-md-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    {{ __('Profile') }}
                </h3>
                <div class="d-flex align-items-center justify-content-between ms-auto gap-3">
                    <a type="reset" id="resetUpdateBusinessForm">
                        {{__('Unsaved Changes')}}
                    </a>
                    <button type="button" class="btn btn-dark" id="submitUpdateBusinessForm">
                        {{__('Save Changes')}}
                    </button>
                </div>
            </div>
        </div>
        <div class="d-none d-xl-block align-self-start card-edit-right-block">
            <div class="d-flex justify-content-start align-items-center gap-3">
                <button type="button" class="btn btn-white btn-icon border">
                    <a href="{{ route('get.vcard',[$business->slug]) }}"
                       target="_blank">
                        {{  __('See live preview') }}
                    </a>
                    {!! svg('/user_interface/eye.svg') !!}
                </button>
                <button type="button" class="btn btn-primary share-info btn-icon">
                    {{  __('Share your profile') }}
                    {!! svg('/user_interface/share_your_profile.svg', ['class' => 'fill-white']) !!}
                </button>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex gap-5">
        <div class="d-flex flex-column w-100 gap-4 gap-md-5">
            {{ Form::open(['route' => ['business.update', $business->id], 'method' => 'put', 'id' => 'updateBusinessForm', 'enctype' => 'multipart/form-data']) }}
            <input type="hidden" name="business_id" value="{{ $business->id }}">
            <div class="card">
                <div class="card-header sticky-top z-0 z-1 border-bottom">
                    <!-- Tab Container: fixed on scroll -->
                    <ul class="nav nav-pills nav-fill gap-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if(!session('tab') || session('tab') == 1) active @endif"
                                data-bs-toggle="pill" data-bs-target="#details-setting" type="button">
                                {!! svg('user_interface/content.svg') !!}
                                {{ __('Content') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if(session('tab') == 2) active @endif"
                                data-bs-toggle="pill" data-bs-target="#theme-setting" type="button">
                                {!! svg('user_interface/appearance.svg') !!}
                                {{ __('Appearance') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if(session('tab') == 3) active @endif"
                                data-bs-toggle="pill" data-bs-target="#sectionsTab" type="button">
                                {!! svg('user_interface/sections.svg') !!}
                                {{ __('Sections') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if(session('tab') == 4) active @endif"
                                data-bs-toggle="pill" data-bs-target="#captureAndShareTab" type="button">
                                {!! svg('user_interface/capture_and_share.svg') !!}
                                {{ __('Capture & Share') }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div
                            class="tab-pane fade  @if(!session('tab') or(session('tab') and session('tab') == 1)) show active @endif"
                            id="details-setting" role="tabpanel"
                            aria-labelledby="pills-user-tab-2">
                            <!-- Profile Picture, Cover Photo, Company Logo upload start -->
                            <section
                                class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-start">
                                <div class="form-group">
                                    {{ Form::label('logo', __('Profile Picture'), ['class' => 'form-label']) }}
                                    <x-required></x-required>
                                    <div class="position-relative add-image-block dropzone" data-target="business_logo">
                                        <img
                                            src="{{ $business->logo ? $logo.'/'.$business->logo: Utility::imagePlaceholderUrl() }}"
                                            alt="images" id="business_logo"
                                            class="rounded-circle w-100 h-100 object-fit-cover img-fluid">
                                        <div class="position-absolute end-0 bottom-0">
                                            <input class="d-none business_logo file-validate"
                                                   type="file"
                                                   name="logo"
                                                   accept="image/*"
                                            >
                                            <label>
                                                <img
                                                    src="{{ asset('assets/images/icons/user_interface/add_picture_button.svg') }}"
                                                    alt=""
                                                    class="cursor-pointer"
                                                    onclick="selectFile('business_logo')">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="coverPhotoUpload" class="form-group">
                                    {{ Form::label('banner', __('Cover Photo'), ['class' => 'form-label']) }}
                                    <x-required></x-required>
                                    <div class="position-relative rounded-4 add-image-block dropzone"
                                         data-target="banner">
                                        <img
                                            src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('assets/images/icons/user_interface/cover_photo_placeholder.png') }}"
                                            alt="" class="w-100 h-100 object-fit-cover img-fluid" id="banner">
                                        <div
                                            class="position-absolute top-50 start-50 text-center translate-middle text-center w-100">
                                            <input
                                                class="custom-input-file custom-input-file-link banner d-none file-validate"
                                                type="file" name="banner" id="file-1"
                                                accept="image/*"
                                            >
                                            <label for="file-1">
                                                <span class="mb-2 text-primary">Drag file for upload or</span><br/>
                                                <button type="button"
                                                        onclick="selectFile('banner')"
                                                        class="btn btn-primary btn-sm">{{ __('Select Files') }}</button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('company_logo', __('Company Logo'), ['class' => 'form-label']) }}
                                    <div class="position-relative add-image-block dropzone"
                                         data-target="business_company_logo">
                                        <img
                                            src="{{$business->company_logo ? $company_logo.'/'.$business->company_logo : Utility::imagePlaceholderUrl() }}"
                                            alt="images" id="business_company_logo"
                                            class="rounded-circle w-100 h-100 object-fit-cover img-fluid">
                                        <div class="position-absolute end-0 bottom-0">
                                            <input
                                                class="d-none business_company_logo file-validate"
                                                type="file"
                                                name="company_logo"
                                                accept="image/*"
                                            >
                                            <label>
                                                <img
                                                    src="{{ asset('assets/images/icons/user_interface/add_picture_button.svg') }}"
                                                    alt=""
                                                    class="cursor-pointer"
                                                    onclick="selectFile('business_company_logo')">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--Profile Picture, Cover Photo, Company Logo upload end -->

                            <!--Name, Job Title, Company, Description start -->
                            <section>
                                <div class="form-group">
                                    {{ Form::label('Title', __('Name'), ['class' => 'form-label']) }}
                                    <x-required></x-required>
                                    {!! Form::text('title', $business->title, ['class' => 'form-control', 'id' => $business_id . '_title', 'data-name'=>'business_title', 'required' => true]) !!}
                                    @error('title')
                                    <span class="invalid-favicon text-xs text-danger"
                                          role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('Designation', __('Job Title or Role'), ['class' => 'form-label']) }}
                                            {{ Form::text('designation', $business->designation, ['class' => 'form-control', 'id' => $business_id . '_designation', 'placeholder' => __('')]) }}
                                            @error('title')
                                            <span class="invalid-favicon text-xs text-danger"
                                                  role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('Sub_Title', __('Company'), ['class' => 'form-label']) }}
                                            {{ Form::text('sub_title', $business->sub_title, ['class' => 'form-control validation_subtitle', 'id' => $business_id . '_subtitle', 'placeholder' => __('')]) }}
                                            @error('sub_title')
                                            <span class="invalid-favicon text-xs text-danger"
                                                  role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('Description', __('Bio or Description'), ['class' => 'form-label']) }}
                                    {{ Form::textarea('description', $business->description, ['class' => 'form-control description-text','rows' => '5','cols' => '30', 'id' => $business_id . '_desc']) }}
                                    @error('description')
                                    <span class="invalid-favicon text-xs text-danger"
                                          role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-none">
                                    <h5 class="mb-3">{{__('Personalized link:')}}</h5>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" readonly
                                                   value=" {{ $business_url }}"
                                                   placeholder="https://demo.workdo.io/vcardgo-saas/james-donald">
                                            {{ Form::text('slug', $business->slug, ['class' => 'input-group-text text-start', 'placeholder' => __('Enter Slug')]) }}
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--Name, Job Title, Company, Description end -->

                            <!--Socials start -->
                            <section>
                                <p class="section-title">{{__('Add links to your card')}}</p>
                                <div class="row gy-4" id="inputrow_socials">
                                    @if (!is_null($social_content))
                                        @foreach ($social_content as $social_key => $social_val)
                                            @foreach ($social_val as $social_key1 => $social_val1)
                                                @if ($social_key1 != 'id')
                                                    <div class="col-lg-4 social-row" id="socials_{{ $social_no }}">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between p-2 bg-light rounded">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <img
                                                                    src="{{ asset('custom/icon/white/' . strtolower($social_key1) . '.svg') }}"
                                                                    alt="" style="width:24px;height:24px;">
                                                                <span
                                                                    class="social-link-text">{{ ucfirst($social_key1) }}</span>

                                                                {{-- Hidden Inputs --}}
                                                                <input type="hidden"
                                                                       name="socials[{{ $social_no }}][{{ $social_key1 }}]"
                                                                       value="{{ $social_val1 }}">
                                                                <input type="hidden"
                                                                       name="socials[{{ $social_no }}][id]"
                                                                       value="{{ $social_no }}">
                                                            </div>

                                                            <div class="d-flex align-items-center gap-2">
                                                                <button type="button"
                                                                        class="btn btn-white btn-edit-social"
                                                                        data-id="socials_{{ $social_no }}"
                                                                        data-name="{{ $social_key1 }}"
                                                                        data-href="{{ $social_val1 }}">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-white btn-remove-social"
                                                                        data-id="socials_{{ $social_no }}">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @php
                                                    $social_no++;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>

                                <button
                                    type="button"
                                    class="btn btn-primary px-5 mx-auto d-block"
                                    data-bs-toggle="modal"
                                    data-bs-target="#socialsModal">
                                    {{__('Add more links')}}
                                </button>
                            </section>
                            <!--Socials end -->

                            <!--Phone, Address, Email, Website start -->
                            <section class="row">
                                <div class="col-lg-12">
                                    <h5 class="mb-3">{{__('Add Contact To Your Card')}}</h5>
                                </div>
                                <div class="form-group mb-0">
                                    {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }}
                                    {!! Form::text('phone', $business->phone, ['class' => 'form-control', 'id' => $business_id . '_phone']) !!}
                                </div>
                                <div class="form-group mb-0">
                                    {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
                                    {!! Form::text('address', $business->address, ['class' => 'form-control', 'id' => $business_id . '_address']) !!}
                                </div>
                                <div class="form-group mb-0">
                                    {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                    {!! Form::email('email', $business->email, ['class' => 'form-control', 'id' => $business_id . '_email']) !!}
                                </div>
                                <div class="form-group mb-0">
                                    {{ Form::label('website', __('Website'), ['class' => 'form-label']) }}
                                    {!! Form::url('website', $business->website, ['class' => 'form-control', 'id' => $business_id . '_website']) !!}
                                </div>

                            </section>
                            <!--Phone, Address, Email, Website end -->

                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <button type="reset" class="btn btn-light">
                                    {{ __('Cancel') }}
                                </button>

                                <button type="submit" class="btn btn-dark">
                                    <i class="me-2" data-feather="folder"></i> {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade @if(session('tab') and session('tab') == 2) active show @endif"
                             id="theme-setting" role="tabpanel"
                             aria-labelledby="pills-user-tab-1">
                            <div class="form-group mb-0">
                                {{ Form::label('card_bg_color', __('Card Background'), ['class' => 'form-label']) }}
                                {!! Form::color('card_bg_color', old('card_bg_color', $business->card_bg_color ?? '#000000'), ['class' => 'form-control p-2', 'id' => $business_id . '_card_bg_color']) !!}
                            </div>
                            <div class="form-group mb-0">
                                {{ Form::label('button_bg_color', __('Button Colour'), ['class' => 'form-label']) }}
                                {!! Form::color('button_bg_color', old('button_bg_color', $business->button_bg_color ?? '#000000'), ['class' => 'form-control p-2', 'id' => $business_id . '_button_bg_color']) !!}
                            </div>
                            <div class="form-group mb-0">
                                {{ Form::label('card_text_color', __('Card Text'), ['class' => 'form-label']) }}
                                {!! Form::color('card_text_color', old('card_text_color', $business->card_text_color ?? '#000000'), ['class' => 'form-control p-2', 'id' => $business_id . '_card_text_color']) !!}
                            </div>
                            <div class="form-group mb-0">
                                {{ Form::label('button_text_color', __('Button Text'), ['class' => 'form-label']) }}
                                {!! Form::color('button_text_color', old('button_text_color', $business->button_text_color ?? '#000000'), ['class' => 'form-control p-2', 'id' => $business_id . '_button_text_color']) !!}
                            </div>
                        </div>
                        <div class="tab-pane fade @if(session('tab') and session('tab') == 3) active show @endif"
                             id="sectionsTab" role="tabpanel"
                             aria-labelledby="pills-user-tab-3">
                            <section class="mb-4" id="services">
                                <div class="header d-flex align-items-center justify-content-between mb-3">
                                    <h5>{{__('Services')}}</h5>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2">{{__('On/Off:')}}</span>
                                        <div
                                            class="form-check form-switch custom-switch-v1">
                                            <input type="checkbox"
                                                   name="is_services_enabled"
                                                   id="is_services_enabled"
                                                   class="form-check-input input-primary"
                                                {{ isset($services['is_enabled']) && $services['is_enabled'] ? "checked=\"checked\"" : "" }}>
                                            <label class="form-check-label"
                                                   for="is_services_enabled"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="row gy-4 mb-3 img-validate-class-detail"
                                         id="inputrow_service">
                                        @if ($services_content)
                                            @foreach ($services_content as $k1 => $content)
                                                <div class="col-md-6 service-row">
                                                    <div class="services-setting-card">
                                                        <a href="javascript:void(0)"
                                                           class="close-btn remove-service-row"
                                                           data-id="{{ 'services_' . $service_row_no }}">
                                                            <img
                                                                src="{{asset('assets/images/icons/delete.svg')}}"
                                                                alt="">
                                                        </a>
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label">{{__('Title:')}}</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   id="{{ 'title_' . $service_row_no }}"
                                                                   name="{{ 'services[' . $service_row_no . '][title]' }}"
                                                                   value="{{ $content->title }}"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $service_row_no++;
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                    <a href="javascript:void(0)"
                                       onclick="serviceRepeater()">
                                        <div
                                            class="bg-secondary serv-add-icon">
                                            <i class="ti ti-plus"></i>
                                        </div>
                                        <h6>{{__('Add New Service')}}</h6>
                                    </a>
                                </div>
                                <hr/>
                            </section>

                            <!-- Gallery start -->
                            <section class="mb-4" id="gallery">
                                <div class="header d-flex align-items-center justify-content-between mb-3">
                                    <h5>{{__('Gallery')}}</h5>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{__('On/Off:')}}</span>
                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden"
                                                   name="is_gallery_enabled"
                                                   value="off"/>
                                            <input type="checkbox"
                                                   name="is_gallery_enabled"
                                                   id="is_gallery_enabled"
                                                   class="form-check-input input-primary"
                                                {{ isset($gallery['is_enabled']) && $gallery['is_enabled'] ? "checked=\"checked\"" : "" }}/>
                                            <label class="form-check-label"
                                                   for="is_gallery_enabled"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="row gy-2 gx-2 my-3 gallery-btn">
                                        @foreach (\App\Models\Utility::gallaryoption() as $k => $gallary)
                                            <div class="col-auto">
                                                <label for="enable_{{$k}}"
                                                       class="btn btn-secondary">
                                                    <input type="radio"
                                                           class="d-none btn btn-secondary gallery_click"
                                                           name="galleryoption"
                                                           value="{{$k}}"
                                                           onclick="getSelectedGalleryValue()"
                                                           id="enable_{{$k}}"/><i
                                                        class="me-2"
                                                        data-feather="folder"></i>
                                                    {{ __($gallary) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div
                                        class="upload-file-div image d-none img-validate-class img-validate-class-detail">
                                        {{ Form::label('upload_image', __('Upload Image'), ['class' => 'form-label']) }}
                                        <div class="choose-file">
                                            <input
                                                class="file-validate custom-input-file custom-input-file-link upload_image1 d-none"
                                                onchange="showimagename()"
                                                type="file"
                                                name="upload_image"
                                                id="file-7"
                                                accept="image/*"
                                            >
                                            <label for="file-7">
                                                <button type="button"
                                                        onclick="selectFile('upload_image1')"
                                                        class="btn btn-primary">
                                                    {{__('Choose a file...')}}
                                                </button>
                                            </label>
                                            <span class="uploaded_image_name"></span>
                                        </div>
                                        <p class="file-error-detail text-danger"
                                           style=""></p>
                                    </div>
                                    <div
                                        class="upload-file-div form-group col-md-12 custom_image d-none">
                                        {{ Form::label('custom_image_link', __('Custom image link'), ['class' => 'form-label']) }}
                                        <div class="input-group">
                                            {{ Form::url('custom_image_link', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Custom Image Link')]) }}
                                        </div>
                                    </div>
                                    <div class="gallery-main">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="bussiness-hours-header">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <span>{{__('Content Type')}}</span>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <span>{{__('Preview')}}</span>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <span>{{__('Delete')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!is_null($gallery_contents))
                                            @foreach ($gallery_contents as $gallery_key => $gallery_content)
                                                @if(in_array($gallery_content->type, ['image', 'custom_image_link']))
                                                    @php $url = $gallery_content->value; @endphp
                                                    <div class="gallery-row row align-items-center gallary_data">
                                                        @if($gallery_content->type === "image")
                                                            <div class="col-md-3 col-12">
                                                                <div class="title">{{__('Image')}}</div>
                                                            </div>
                                                            <div class="col-md-7 col-12">
                                                                <div class="img-wrp">
                                                                    <a href="{{$gallery_path.'/' . $url}}"
                                                                       target=_blank>
                                                                        <img
                                                                            src="{{ $gallery_path.'/'. $url }}"
                                                                            alt="images">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-md-3 col-12">
                                                                <div class="title">{{__('Custom image link')}}</div>
                                                            </div>
                                                            <div class="col-md-7 col-12">
                                                                <div class="img-wrp">
                                                                    <a href="{{ $url }}" target=_blank>
                                                                        <img src="{{ $url }}"
                                                                             alt="images">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="col-md-2 col-12">
                                                            <span class="icon">
                                                                <a href="javascript:void(0)"
                                                                   class="close-btn remove-gallery"
                                                                   data-id="{{$gallery_content->id}}">
                                                                   <img
                                                                       src="{{asset('assets/images/icons/delete.svg')}}"
                                                                       alt="">
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <hr/>
                            </section>
                            <!-- Gallery end -->

                            <!-- Featured Videos start -->
                            <section class="mb-4" id="featuredVideos">
                                <div class="header d-flex align-items-center justify-content-between mb-3">
                                    <h5>{{__('Add Your Featured Videos')}}</h5>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{__('On/Off:')}}</span>
                                        <div
                                            class="form-check form-switch custom-switch-v1">
                                            <input type="hidden"
                                                   name="is_video_enabled"
                                                   value="off"/>
                                            <input type="checkbox"
                                                   name="is_video_enabled"
                                                   id="is_video_enabled"
                                                   class="form-check-input input-primary"
                                                {{ isset($gallery['is_video_enabled']) && $gallery['is_video_enabled'] ? "checked=\"checked\"" : "" }}/>
                                            <label class="form-check-label"
                                                   for="is_video_enabled"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="body">
                                    <div class="row gy-2 gx-2 my-3 gallery-btn">
                                        @foreach (\App\Models\Utility::featured_videos_option() as $k => $gallary)
                                            <div class="col-auto">
                                                <label for="enable_{{$k}}"
                                                       class="btn btn-secondary">
                                                    <input type="radio"
                                                           class="d-none btn btn-secondary gallery_click"
                                                           name="galleryoption"
                                                           value="{{$k}}"
                                                           onclick="getSelectedGalleryValue()"
                                                           id="enable_{{$k}}"/><i
                                                        class="me-2"
                                                        data-feather="folder"></i>
                                                    {{ __($gallary) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div
                                        class="upload-file-div video d-none img-validate-class img-validate-class-detail">
                                        {{ Form::label('upload_video', __('Upload Video'), ['class' => 'form-label']) }}
                                        <div class="choose-file">
                                            <input
                                                class="file-validate custom-input-file custom-input-file-link  upload_video d-none"
                                                type="file" name="upload_video"
                                                id="file-6"
                                                onchange="showvideoname()"
                                                accept="video/mp4">
                                            <label for="file-6">
                                                <button type="button"
                                                        onclick="selectFile('upload_video')"
                                                        class="btn btn-primary">
                                                    {{__('Choose a file...')}}
                                                </button>
                                            </label>
                                            <span
                                                class="uploaded_video_name"></span>
                                        </div>
                                        <p class="file-error text-danger"
                                           style=""></p>
                                        <p class="error-msg-video text-danger"
                                           style="">{{__('You can`t upload mp4 video because superadmin has not allowed it in storage settings.')}}</p>
                                    </div>
                                    <div
                                        class="upload-file-div form-group col-md-12 custom_video d-none">
                                        {{ Form::label('custom_video_link', __('Custom video link'), ['class' => 'form-label']) }}
                                        <div class="input-group">
                                            {{ Form::text('custom_video_link', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Custom Video Link')]) }}
                                        </div>
                                    </div>
                                    <div class="gallery-main">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="bussiness-hours-header">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <span>{{__('Content Type')}}</span>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <span>{{__('Preview')}}</span>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <span>{{__('Delete')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!is_null($gallery_contents))
                                            @foreach ($gallery_contents as $gallery_key => $gallery_content)
                                                @if(in_array($gallery_content->type, ['video', 'custom_video_link']))
                                                    @php $url = $gallery_content->value; @endphp
                                                    <div class="gallery-row row align-items-center gallary_data">
                                                        @if($gallery_content->type === "video")
                                                            <div class="col-md-3 col-12">
                                                                <div class="title">{{__('Video')}}</div>
                                                            </div>
                                                            <div class="col-md-7 col-12">
                                                                <div class="img-wrp">
                                                                    <a href="{{$gallery_path.'/' . $url}}"
                                                                       target=_blank>
                                                                        <video height="">
                                                                            <source
                                                                                src="{{ $gallery_path.'/'. $url }}"
                                                                                type="video/mp4">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-md-3 col-12">
                                                                <div class="title">{{__('Custom video link')}}</div>
                                                            </div>
                                                            <div class="col-md-7 col-12">
                                                                <div class="img-wrp">
                                                                    <a href="{{ $url }}" target=_blank>
                                                                        <video height="">
                                                                            <source
                                                                                src="{{ $url }}"
                                                                                type="video/mp4">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-2 col-12">
                                                            <span class="icon">
                                                                <a href="javascript:void(0)"
                                                                   class="close-btn remove-gallery"
                                                                   data-id="{{$gallery_content->id}}">
                                                                    <img
                                                                        src="{{asset('assets/images/icons/delete.svg')}}"
                                                                        alt="">
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </section>
                            <!-- Featured Videos end -->

                            <!-- Google Review start -->
                            <section class="mb-4"
                                     id="googleReviewAccordion">
                                <div class="header d-flex align-items-center justify-content-between mb-3">
                                    <h5>{{__('Google Review')}}</h5>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{__('On/Off:')}}</span>
                                        <div
                                            class="form-check form-switch custom-switch-v1">
                                            <input type="checkbox"
                                                   name="google_review_enabled"
                                                   id="google_review_enabled"
                                                   class="form-check-input input-primary"
                                                {{ isset($business['google_review_enabled']) && $business['google_review_enabled'] ? "checked=\"checked\"" : "" }}>
                                            <label class="form-check-label"
                                                   for="is_services_enabled"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="body">
                                    <div class="form-group mb-0">
                                        {{ Form::label('google_review_link', __('Link your google review page'), ['class' => 'form-label']) }}
                                        {{ Form::url('google_review_link', $business->google_review_link, ['class' => 'form-control', 'id' => $business_id . '_google_review_link', 'data-name'=>'business_google_review_link']) }}
                                    </div>
                                </div>
                            </section>
                            <!-- Google Review end -->
                        </div>
                        <div class="tab-pane fade @if(session('tab') and session('tab') == 4) show active @endif"
                             id="captureAndShareTab" role="tabpanel" aria-labelledby="pills-user-tab-8">
                            <div class="form-group">
                                <div class="form-group" id="StoreLink">
                                    <label class="form-label">{{__('Business Link:')}}</label>
                                    <div class="row gy-2">
                                        <div class="col-lg-8">
                                            <input type="text"
                                                   class="form-control d-inline-block"
                                                   id="myInput"
                                                   value="{{ $business_url }}" readonly/>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-primary w-100"
                                                    id="button-addon2" onclick="copyLink()"><i
                                                    class="me-2 far fa-copy"></i>{{__('Copy Link')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-4">
                                <div class="col-lg-6">
                                    <div class="theme-detail-card">
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <h5 class="mb-0 flex-grow-1">{{__('Qr Code Settings:')}}</h5>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('foreground_color', __('Choose Color'), ['class' => 'form-label']) }}
                                            <input type="color" name="qrcode_foreground_color"
                                                   value="{{$qr_detail && $qr_detail->foreground_color ? $qr_detail->foreground_color : "#000000"}}"
                                                   class="form-control qr-data" id="qrCodeColor">
                                        </div>
                                        <input type="hidden" class="qr-data" name="qrcode_type" id="qrCodeType"
                                               value="{{$qr_detail && $qr_detail->qr_type ? $qr_detail->qr_type : 0}}"/>
                                        <div id="qr_type_option">
                                            <div class="form-group">
                                                {{ Form::label('image', __('Image'), ['class' => 'form-label']) }}
                                                <input type="file" name="qrcode_image"
                                                       accept=".png, .jpg, .jpeg"
                                                       class="form-control qr-data" id="qrCodeImage">
                                                <img id="qrCodeImageBuffer" alt=""
                                                     src="{{ $qr_detail && $qr_detail->image ? $qr_path.'/'.  $qr_detail->image: "" }}"
                                                     class="d-none" crossorigin="anonymous">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-6 offset-lg-3">
                                        <div class="theme-preview">
                                            <div class="code">
                                            </div>
                                            <button type="button"
                                                    class="btn btn-secondary mt-2"
                                                    id="downloadMyQrCodeBtn">{{__('Download QR Code')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>

        <div class="d-none d-xl-block position-sticky align-self-start sticky-top-32">
            <div class="position-relative shadow-lg custom-box">
                @include('card.' . $card_theme->theme . '.index')
            </div>
        </div>
    </div>
    <div class="modal fade" id="socialsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add a Social Field') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row social-card-row">
                        @foreach ($businessfields as $val)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="cursor-pointer text-center"
                                     id="{{ $val }}" onclick="socialRepeater(this.id)">
                                    <img
                                        src="{{ asset('assets/images/icons/user_interface/socials/' . strtolower($val) . '.svg') }}"
                                        alt="image" class="{{ $val }}">
                                    <h5>{{ $val }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add/Edit Social Item -->
    <div class="modal fade" id="socialItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <!-- Back Button -->
                <div class="d-flex align-items-center gap-2 mb-3">
                    <button type="button" class="btn p-0 d-flex align-items-center gap-2" id="backFromSocialItemModal"
                            style="font-size: 1rem; font-weight: 500;">
                        <i class="bi bi-chevron-left"></i> Back
                    </button>
                </div>

                <hr class="my-0">

                <!-- Social Icon and Name -->
                <div class="d-flex align-items-center gap-3 my-4">
                    <img id="socialItemModalIcon" src="" alt="Icon" style="width: 40px;">
                    <h6 id="socialItemModalName" class="mb-0"></h6>
                </div>

                <!-- Input Field -->
                <div class="mb-4">
                    <input type="text" class="form-control" id="socialItemModalInput" placeholder="Enter your link">
                </div>

                <!-- Add Button -->
                <div>
                    <button type="button" class="btn btn-dark w-100 rounded" id="saveSocialItemBtn">Add</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom-scripts')
    <script type="text/javascript" src="{{ asset('custom/js/repeaterInput.js?v='.time()) }}"></script>
    <script src="{{ asset('js/bootstrap-toggle.js') }}"></script>

    <script src="{{ asset('custom/libs/jquery-ui/jquery-ui.js') }}"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="{{ asset('custom/theme1/js/slick.min.js') }}" defer="defer"></script>
    <script src="{{ asset('custom/js/jquery.qrcode.min.js') }}"></script>

    <script type="text/javascript">
        var theme = '{{ $card_theme->theme }}';
        var theme_path = `{{ asset('custom/${theme}/icon/') }}`;
        var asset_path = `{{ asset('assets/images/icons/user_interface/socials/') }}`

        var socials_row_no = {{ $social_no }};
        var selectedSocialName = '';
        var selectedSocialIcon = '';
        var editSocialId = null;

        // Handle Save/Add/Update
        $('#saveSocialItemBtn').on('click', function () {
            var inputVal = $('#socialItemModalInput').val();
            if (!inputVal) {
                alert('Please enter a link.');
                return;
            }

            if (editSocialId) {
                // Update existing hidden input + UI
                $('#' + editSocialId + ' input[name$="[' + selectedSocialName + ']"]').val(inputVal);
                $('#' + editSocialId + ' .social-link-text').text(selectedSocialName);
                $('#' + editSocialId + ' .social-link-href').attr('href', inputVal);
            } else {
                // Create new card + hidden inputs
                var html = `
                <div class="col-lg-4 social-row" id="socials_${socials_row_no}">
                    <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded">
                        <div class="d-flex align-items-center gap-2">
                            <img src="${asset_path}/${selectedSocialName.toLowerCase()}.svg" alt="" style="width:24px;height:24px;">
                            <span class="social-link-text">${selectedSocialName}</span>
                            <input type="hidden" name="socials[${socials_row_no}][${selectedSocialName}]" value="${inputVal}">
                            <input type="hidden" name="socials[${socials_row_no}][id]" value="${socials_row_no}">
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-white btn-edit-social" data-id="socials_${socials_row_no}" data-name="${selectedSocialName}" data-href="${inputVal}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-white btn-remove-social" data-id="socials_${socials_row_no}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </div>
                </div>
                `;
                $('#inputrow_socials').append(html);
                socials_row_no++;
            }

            $('#socialItemModal').modal('hide');
        });


        // When select a social in socialsModal
        function socialRepeater(el) {
            selectedSocialName = el;
            selectedSocialIcon = asset_path + '/' + el.toLowerCase() + '.svg';

            $('#socialItemModalInput').val('');
            $('#socialItemModalName').text(selectedSocialName);
            $('#socialItemModalIcon').attr('src', selectedSocialIcon);
            $('#saveSocialItemBtn').text('Add');
            editSocialId = null;

            // FIRST: Hide the socials modal
            $('#socialsModal').modal('hide');

            // THEN: After it's fully hidden, open the socialItemModal
            $('#socialsModal').on('hidden.bs.modal', function () {
                $('#socialItemModal').modal('show');
                // Very important: unbind this event after running once!
                $(this).off('hidden.bs.modal');
            });
        }


        // Handle Edit Button
        $(document).on('click', '.btn-edit-social', function () {
            editSocialId = $(this).data('id');
            selectedSocialName = $(this).data('name');
            var link = $(this).data('href');

            $('#socialItemModalName').text(selectedSocialName);
            $('#socialItemModalIcon').attr('src', asset_path + '/' + selectedSocialName.toLowerCase() + '.svg');
            $('#socialItemModalInput').val(link);
            $('#saveSocialItemBtn').text('Update');
            $('#socialItemModal').modal('show');
        });

        // Handle Delete Button
        $(document).on('click', '.btn-remove-social', function () {
            var id = $(this).data('id');
            $('#' + id).remove();
        });

        function socialRepeater1(el) {
            socials_row_no = repeaterInput(el, 'social_links', socials_row_no, 'inputrow_socials', theme_path, `${theme}`, asset_path);
        }


        var service_row_no = {{ $service_row_no }};

        function serviceRepeater() {
            service_row_no = repeaterInput('', 'service', service_row_no, 'inputrow_service', theme_path, `${theme}`, asset_path);
        }

        $("#is_services_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            if (enable) {
                $('#servicesOnCard').show();
            } else {
                $('#servicesOnCard').hide();
            }
        })

        $("#is_gallery_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            if (enable) {
                $('#galleryOnCard').show();
            } else {
                $('#galleryOnCard').hide();
            }
        })

        $("#is_video_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            if (enable) {
                $('#featuredVideosOnCard').show();
            } else {
                $('#featuredVideosOnCard').hide();
            }
        });

        $("#google_review_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            if (enable) {
                $('#googleReviewPreview').show();
            } else {
                $('#googleReviewPreview').hide();
            }
        })

        function validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_@.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(str);
        }

        function copyLink() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            // show_toastr('Success', "{{ __('Link copied') }}", 'success');
        }
    </script>


    <script>
        $(document).ready(function () {
            $("#details-setting-tab").click(function () {
                setTimeout(function () {
                    //$('.social-link-slider').slick('refresh');
                    $('.gallery-slider').slick('refresh');
                    $('.featured-video-slider').slick('refresh');
                }, 500);
            });

            $(".gallery_click").click(function () {
                $(".gallery_click").parent().removeClass('btn-primary').addClass('btn-secondary');
                if ($(this).is(":checked")) {

                    //checked
                    $(this).parent().removeClass('btn-secondary');
                    $(this).parent().addClass('btn-primary');

                } else {
                    //unchecked
                    $(this).parent().removeClass('btn-primary');
                    $(this).parent().addClass('btn-secondary');
                }

            })

        });

        // Gallery Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.remove-gallery').on('click', function () {
            var this_id = $(this).data('id');
            var business_id = '{{$business->id}}';
            $.ajax({
                url: '{{ route('destory.gallery') }}',
                type: 'POST',
                data: {
                    "id": this_id,
                    "business_id": business_id,
                },
                success: function () {
                    location.reload();
                }
            });
        });

        function download(url) {
            var a = $("<a style='display:none' id='js-downloder'>")
                .attr("href", url)
                .attr("download", "{{ $business->slug }}")
                .appendTo("body");
            a[0].click();
            a.remove();
        }

        function saveCapture(element) {
            html2canvas(element).then(function (canvas) {
                download(canvas.toDataURL("image/png"));
            })
        }

        //Gallery
        function getSelectedGalleryValue() {
            var checked = $("input[type=radio][name='galleryoption']:checked");
            var id = $(checked).attr("id");
            $(`.video, .image, .custom_image, .custom_video`).removeClass('d-none').addClass('d-none');

            if (id === 'enable_video') {
                $('.video').removeClass('d-none');
            } else if (id === 'enable_image') {
                $('.image').removeClass('d-none');
            } else if (id === 'enable_custom_image_link') {
                $('.custom_image').removeClass('d-none');
            } else if (id === 'enable_custom_video_link') {
                $('.custom_video').removeClass('d-none');
            }
        }

        $('.cp_link').on('click', function () {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('{{ __('Success') }}', '{{ __('Link Copy on Clipboard') }}', 'success');
        });

    </script>

    <script id="handlePreviewScript">
        const getPreviewElement = (element) => {
            return $(`#${element.attr('id')}_preview`)
        }
        //input change
        $(document).on('keyup', 'input', function () {
            const _this = $(this);
            getPreviewElement(_this).text(_this.val());
        });

        // description
        $(document).on('keyup', '#{{ $business_id }}_desc', function () {
            const _this = $(this);
            getPreviewElement(_this).text(_this.val());
        });

        // phone
        $(document).on('keyup', '#{{ $business_id }}_phone', function () {
            const _this = $(this);
            getPreviewElement(_this).attr('href', `tel:${_this.val()}`);
        });

        // address
        $(document).on('keyup', '#{{ $business_id }}_address', function () {
            const _this = $(this);
            getPreviewElement(_this).attr('href', `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(_this.val())}`);
        });

        // email
        $(document).on('keyup', '#{{ $business_id }}_email', function () {
            const _this = $(this);
            getPreviewElement(_this).attr('href', `mailto:${_this.val()}`);
        });

        // website
        $(document).on('keyup', '#{{ $business_id }}_website', function () {
            const _this = $(this);
            getPreviewElement(_this).attr('href', `${_this.val()}`);
        });


        //socials
        $(document).on('keyup', '.social_href', function () {
            var id = $(this).attr('id');
            var text = $(this).attr('name');
            var preview = $(`#${id}`).val();
            var h_preview = validURL(preview);
            if (h_preview === true) {
                $(`#${id}_error_href`).text("");
                $(`#${id}_href_preview`).attr("href", preview);
            } else {
                if (text.includes(`whatsapp`) === false) { // WhatsApp
                    $(`#${id}_error_href`).text("Please enter valid link");
                    $(`#${id}_href_preview`).attr("href", "#");
                }
            }
        });

        // color picker change
        $(document).on('input', '#{{ $business_id }}_card_bg_color', function () {
            $('#card_preview').css('background-color', $(this).val());
        });

        // gallery image upload
        function showimagename() {
            var uploaded_image_name = document.getElementById('file-7');
            $('.uploaded_image_name').text(uploaded_image_name.files.item(0).name);
        }

        //featured video upload
        function showvideoname() {
            var uploaded_image_name = document.getElementById('file-6');
            $('.uploaded_video_name').text(uploaded_image_name.files.item(0).name);
        }
    </script>

    <script type="text/javascript" id="qrCodeScript">
        function generate_qr() {
            $('.code').empty().qrcode({
                render: 'image',
                size: 500,
                ecLevel: "H",
                minVersion: 3,
                quiet: 1,
                text: "{{ env('APP_URL').'/'.$business->slug }}",
                fill: $(`#qrCodeColor`).val(),
                background: "#FFFFFF",
                radius: 26,
                mode: $(`#qrCodeType`).val() * 1,
                image: $("#qrCodeImageBuffer")[0],
                mSize: 0.32
            });
        }

        $(function () {
            generate_qr();
        })

        $('.qr-data').on('change', function () {
            generate_qr();
        });

        $(document).on('input', '#qrCodeColor', function () {
            generate_qr();
        });

        $(document).on('change', '#qrCodeImage', function () {
            const img_input = this;
            if (img_input.files && img_input.files[0]) {
                const img_reader = new FileReader();
                img_reader.onload = function (event) {
                    $("#qrCodeImageBuffer").attr("src", event.target.result);
                    $(`#qrCodeType`).val(4);
                    setTimeout(generate_qr, 250); // delay if needed
                };
                img_reader.readAsDataURL(img_input.files[0]);
            }
        });

        $(`#downloadMyQrCodeBtn`).on('click', function (e) {
            e.preventDefault();
            var img = new Image();
            img.src = $('.code').find('img').attr('src');
            img.onload = function () {
                var canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                var data = canvas.toDataURL('image/png');
                var a = document.createElement("a");
                a.download = "{{$business->title}}.png";
                a.href = data;
                a.click();
            };
        });
    </script>


    <script id="submitFormScript">
        $('#resetUpdateBusinessForm').click(function () {
            $(`#updateBusinessForm`)[0].reset();
        })

        $('#submitUpdateBusinessForm').click(function () {
            $(`#updateBusinessForm`).submit();
        })
        $(`#updateBusinessForm`).submit(function () {
            const form = $(this)[0];

            var banner_val = '{{$business->banner}}';
            var logo_val = '{{$business->logo}}';

            if (!banner_val && !logo_val) {
                var logo = $('input[name=logo]')[0].files[0];
                if (!logo) {
                    showSwalError("Profile Picture is required");
                    return false;
                }

                var banner = $('input[name=banner]')[0].files[0];
                if (!banner) {
                    showSwalError("Cover Photo is required");
                    return false;
                }
            }
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity(); // shows built-in validation UI
                return false;
            }
        });
    </script>

    <script id="swalScript">
        function showSwalError(message) {
            Swal.fire({
                icon: 'error',
                text: message,
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            });
        }
    </script>
@endpush
