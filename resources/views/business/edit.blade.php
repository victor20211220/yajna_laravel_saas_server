@php
    use App\Models\Utility;
    $card_theme = json_decode($business->card_theme);
    $business_id = $business->id;
    $SITE_RTL = Utility::settings()['SITE_RTL'];

    $banner = Utility::get_file('card_banner');
    $logo = Utility::get_file('card_logo');
    $company_logo = Utility::get_file('card_company_logo');

    $gallery_path= Utility::get_file('gallery');
    $qr_path = Utility::get_file('qrcode');
    $isProClient = Utility::isProClient($business_id);
    $siteLogo = asset('assets/images/logo.png');

@endphp
@extends('layouts.new-client')
@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.min.css"/>
@endpush
@section('page-title')
    {{ __('Profile') }}
@endsection
@section('title')
    <div class="d-xl-flex gap-5 mb-4 pb-xl-2">
        <div class="d-flex flex-column w-100 gap-4 gap-md-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 page-title">
                    {{ __('Profile') }}
                </h3>
                <div class="d-flex align-items-center justify-content-between ms-auto gap-3 mb-0">
                    <div class="d-none d-xl-block">
                        <button type="reset" class="btn reset-form me-3">
                            {{__('Unsaved Changes')}}
                        </button>
                        <button type="button" class="btn btn-dark" id="submitUpdateBusinessForm">
                            {{__('Save Changes')}}
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary btn-icon d-block d-xl-none">
                        {!! svg('/user_interface/eye.svg', ['class' => 'fill-white']) !!}
                        <a href="{{ route('get.vcard',[$business->slug]) }}"
                           target="_blank" class="text-white">
                            {{  __('Preview') }}
                        </a>
                    </button>
                    <button type="button" class="btn btn-icon d-block d-xl-none" data-id="openShareCardModalOnFormBtn">
                        {!! svg('/user_interface/share_your_profile.svg') !!}
                    </button>
                </div>
            </div>
        </div>
        <div class="align-self-start card-edit-right-block d-none d-xl-block">
            <div class="d-flex justify-content-between justify-content-lg-start align-items-center gap-4">
                <button type="button" class="btn btn-white btn-icon border">
                    <a href="{{ route('get.vcard',[$business->slug]) }}"
                       target="_blank">
                        {{  __('See live preview') }}
                    </a>
                    {!! svg('/user_interface/eye.svg') !!}
                </button>
                <button type="button" class="btn btn-primary btn-icon" data-id="openShareCardModalOnFormBtn">
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
            <input type="hidden" name="edit_tab_key" id="edit_tab_key" value="{{ $tab }}">
            <div class="card">
                <div class="card-header bg-white sticky-top z-0 z-1 border-bottom overflow-auto">
                    <!-- Tab Container: fixed on scroll -->
                    <ul class="nav nav-pills nav-fill gap-2 flex-nowrap" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation" data-key="1">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if($tab === 1) active @endif"
                                data-bs-toggle="pill" data-bs-target="#details-setting" type="button">
                                {!! svg('user_interface/content.svg') !!}
                                {{ __('Content') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" data-key="2">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if($tab === 2) active @endif"
                                data-bs-toggle="pill" data-bs-target="#theme-setting" type="button">
                                {!! svg('user_interface/appearance.svg') !!}
                                {{ __('Appearance') }}
                            </button>
                        </li>
                        @if($isProClient)
                            <li class="nav-item" role="presentation" data-key="3">
                                <button
                                    class="nav-link tab-btn btn-icon fw-semibold @if($tab === 3) active @endif"
                                    data-bs-toggle="pill" data-bs-target="#sectionsTab" type="button">
                                    {!! svg('user_interface/sections.svg') !!}
                                    {{ __('Sections') }}
                                </button>
                            </li>
                        @endif
                        <li class="nav-item" role="presentation" data-key="4">
                            <button
                                class="nav-link tab-btn btn-icon fw-semibold @if($tab === 4) active @endif"
                                data-bs-toggle="pill" data-bs-target="#captureAndShareTab" type="button">
                                {!! svg('user_interface/capture_and_share.svg') !!}
                                {{ __('Capture & Share') }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  @if($tab === 1) show active @endif"
                             id="details-setting" role="tabpanel">
                            <!-- Profile Picture, Cover Photo, Company Logo upload start -->
                            <section
                                class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-center justify-content-md-{{ $isProClient ? 'between' : 'around'  }} text-md-start">
                                <div class="form-group">
                                    <div class="position-relative mb-2">
                                        {{ Form::label('logo', __('Profile Picture'), ['class' => 'form-label mb-0']) }}
                                        @include('components/more-info', ['label' => 'Upload an image with a maximum size of 10 MB'])
                                    </div>
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
                                    <div class="position-relative mb-2">
                                        {{ Form::label('banner', __('Cover Photo'), ['class' => 'form-label mb-0']) }}
                                        @include('components/more-info', ['label' => 'Recommended aspect ratio is 2560x1080px with a maximum size of 10 MB'])
                                    </div>
                                    <div class="position-relative rounded-4 add-image-block dropzone"
                                         data-target="banner">
                                        @php
                                            $hasBanner = isset($business->banner) && !empty($business->banner);
                                        @endphp
                                        <img
                                            src="{{ $hasBanner ? $banner . '/' . $business->banner : asset('assets/images/icons/user_interface/cover_photo_placeholder.png') }}"
                                            alt="" class="w-100 h-100 object-fit-cover img-fluid" id="banner">
                                        <div
                                            class="position-absolute text-center justify-content-center d-flex align-items-center w-100">
                                            <input
                                                class="custom-input-file custom-input-file-link banner d-none file-validate"
                                                type="file" name="banner" id="file-1"
                                                accept="image/*"
                                            >
                                            <label for="file-1" class="{{ $hasBanner ? 'd-none': '' }}">
                                                <span class="mb-2 d-none d-md-inline-block" style="color: #9D9DA1;">Drag file for upload or</span>
                                                <span class="mb-2 d-inline-block d-md-none" style="color: #9D9DA1;">Upload cover photo</span>
                                                <br/>
                                                <button type="button"
                                                        onclick="selectFile('banner')"
                                                        class="btn btn-primary btn-sm">{{ __('Select Files') }}</button>
                                            </label>
                                        </div>
                                        <button type="button"
                                                class="btn btn-white position-absolute bottom-0 end-0 rounded-circle me-2 mb-2 d-flex justify-content-center align-items-center p-0 {{ !$hasBanner ? 'd-none': '' }}"
                                                id="deleteBannerBtn">
                                            @include('components.delete-icon')
                                        </button>
                                    </div>
                                </div>
                                @if($isProClient)
                                    <div class="form-group">
                                        <div class="position-relative mb-2">
                                            {{ Form::label('company_logo', __('Company Logo'), ['class' => 'form-label mb-0']) }}
                                            @include('components/more-info', ['label' => 'Recommended size: 440 x 440 px (1:1)'])
                                        </div>
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
                                @endif
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
                                    @if (count($social_content))
                                        @foreach ($social_content as $id => $social_item)
                                            @foreach ($social_item as $key => $social_val)
                                                @php if($key === "id") continue; @endphp
                                                <div class="col-lg-4 social-row" id="socials_{{ $id }}">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between p-2 bg-light rounded">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img
                                                                src="{{ asset('custom/icon/white/' . strtolower($key) . '.svg') }}"
                                                                alt="" class="colored-social-icon">
                                                            <span
                                                                class="social-link-text">{{ $key }}</span>

                                                            {{-- Hidden Inputs --}}
                                                            <input type="hidden"
                                                                   name="socials[{{ $id }}][{{ $key }}]"
                                                                   value="{{ $social_val }}"
                                                                   class="social-link-href"
                                                            >
                                                            <input type="hidden"
                                                                   name="socials[{{ $id }}][id]"
                                                                   value="{{ $id }}"
                                                            >
                                                        </div>

                                                        <div class="d-flex align-items-center gap-2">
                                                            <button type="button"
                                                                    class="btn btn-white btn-edit-social" title="Edit">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-white btn-remove-social">
                                                                @include('components.delete-icon')
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>

                                <div class="mb-4 pb-3"></div>
                                <button
                                    type="button"
                                    class="btn btn-primary px-5 mx-auto d-block"
                                    id="openSocialsModal">
                                    {{__('Add more links')}}
                                </button>
                            </section>
                            <!--Socials end -->

                            <!--Phone, Address, Email, Website start -->
                            <section>
                                <h5 class="mb-3">{{__('Add Contact To Your Card')}}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }}
                                            <x-required></x-required>
                                            <br/>
                                            {!! Form::tel('phone', $business->phone, ['class' => 'form-control phone-input', 'id' => $business_id . '_phone', 'required' => true]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
                                            <x-required></x-required>
                                            {!! Form::text('address', $business->address, ['class' => 'form-control', 'id' => $business_id . '_address', 'required' => true]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                            <x-required></x-required>
                                            {!! Form::email('email', $business->email, ['class' => 'form-control', 'id' => $business_id . '_email', 'required' => true]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('website', __('Website'), ['class' => 'form-label']) }}
                                            {!! Form::text('website', $business->website, ['class' => 'form-control', 'id' => $business_id . '_website', 'placeholder' => 'example.com']) !!}
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--Phone, Address, Email, Website end -->
                        </div>

                        <div class="tab-pane fade @if($tab === 2) active show @endif"
                             id="theme-setting" role="tabpanel">
                            <section class="border-0">
                                @include('components.color-selector', [
                                    'id' => 'card_bg_color',
                                    'label' => 'Card Background',
                                    'tooltip_title' => 'Set a new background colour for your card',
                                    'value' => old('card_bg_color', $business->card_bg_color ?? '#FFFFFF'),
                                    'colors' => ['#222222', '#FFB3B2', '#FAB5C9', '#FDD4B3', '#FEEBB3', '#B6F9DF', '#B8EBF7', '#B7CFF9', '#CCB6FA'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'button_bg_color',
                                    'label' => 'Button Colour',
                                    'tooltip_title' => 'Change the colour of all buttons',
                                    'value' => old('button_bg_color', $business->button_bg_color ?? '#1570FD'),
                                    'colors' => ['#000000', '#FF3C39', '#F55381', '#FC8E3A', '#F4B813', '#06C27C', '#18BCE8', '#296DEE', '#9163F6'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'card_text_color',
                                    'label' => 'Card Text',
                                    'tooltip_title' => 'Select the text colour for your content',
                                    'value' => old('card_text_color', $business->card_text_color ?? '#171717'),
                                    'colors' => ['#FFFFFF', '#000000', '#FF0C02', '#F60946', '#FC8E3A', '#F4B813', '#18BCE8', '#18BCE8', '#175BFD'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'button_text_color',
                                    'label' => 'Button Text',
                                    'tooltip_title' => 'Change the text and icon colour of the button',
                                    'value' => old('button_text_color', $business->button_text_color ?? '#FFFFFF'),
                                    'colors' => ['#FFFFFF', '#000000', '#FF0C02', '#F60946', '#FC8E3A', '#F4B813', '#18BCE8', '#18BCE8', '#175BFD'],
                                ])
                            </section>
                        </div>

                        @if($isProClient)
                            <div class="tab-pane fade @if($tab === 3) active show @endif"
                                 id="sectionsTab" role="tabpanel">
                                <!-- Services start -->
                                <section>
                                    <div class="section-title d-flex align-items-center justify-content-between">
                                        <div>{{__('Add Services')}}</div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div
                                                class="form-check form-switch">
                                                <input type="checkbox"
                                                       name="is_services_enabled"
                                                       id="is_services_enabled"
                                                       class="form-check-input input-primary"
                                                    {{ isset($services['is_enabled']) && $services['is_enabled'] ? "checked=\"checked\"" : "" }}>
                                                <label class="form-check-label"
                                                       for="is_services_enabled"></label>
                                            </div>
                                            <div>{{__('On')}}</div>
                                        </div>
                                    </div>
                                    <div id="serviceList" class="row">
                                        @php $service_key = 1; @endphp
                                        @foreach ($services_content as $service_content)
                                            <div class="col-md-6 service-row" data-key="{{ $service_key }}">
                                                <div class="form-group">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <label
                                                            class="form-label mb-0">Service {{ $service_key }}</label>
                                                        <button type="button"
                                                                class="remove-service-row item-management-btn">
                                                            @include('components.delete-icon')
                                                        </button>
                                                    </div>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="{{ 'service_title_' . $service_key }}"
                                                           name="{{ 'services[' . $service_key . '][title]' }}"
                                                           value="{{ $service_content->title }}"
                                                           required/>
                                                </div>
                                            </div>
                                            @php $service_key++; @endphp
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary px-5 mx-auto d-block"
                                            id="addNewServiceBtn">{{__('Add New Service')}}</button>
                                </section>
                                <!-- Services end -->

                                <!-- Gallery start -->
                                <section class="mb-4" id="gallery">
                                    <div class="section-title d-flex align-items-center justify-content-between">
                                        <div>{{__('Add Your Gallery')}}</div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div
                                                class="form-check form-switch">
                                                <input type="checkbox"
                                                       name="is_gallery_enabled"
                                                       id="is_gallery_enabled"
                                                       class="form-check-input input-primary"
                                                    {{ isset($gallery['is_enabled']) && $gallery['is_enabled'] ? "checked=\"checked\"" : "" }}>
                                                <label class="form-check-label"
                                                       for="is_gallery_enabled"></label>
                                            </div>
                                            <div>{{__('On')}}</div>
                                        </div>
                                    </div>
                                    <!-- Gallery Preview Grid (5 items per row) -->
                                    <div class="row g-3" id="galleryPreview">
                                        @foreach ($gallery_contents as $gallery_content)
                                            @if(in_array($gallery_content->type, ['image', 'custom_image_link']))
                                                @php $url = $gallery_content->type === 'image' ? $gallery_path . '/' . $gallery_content->value : $gallery_content->value; @endphp
                                                <div class="col-12 col-lg-3">
                                                    <div
                                                        class="gallery-card bg-secondary position-relative border rounded overflow-hidden d-flex justify-content-center align-items-center">
                                                        <img src="{{ $url }}" class="img-fluid gallery-image"
                                                             alt="Gallery Image">
                                                        <button type="button"
                                                                class="btn item-management-btn position-absolute top-0 end-0 m-1 remove-gallery"
                                                                data-id="{{ $gallery_content->id }}">
                                                            @include('components.delete-icon')
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="pb-4"></div>
                                    <!-- Add More Pictures Button -->
                                    <button type="button" class="btn btn-primary px-5 mx-auto d-block"
                                            id="openGalleryModal">
                                        Add more pictures
                                    </button>

                                    <!-- Modal: Add Picture -->
                                    <div class="modal fade" id="addGalleryModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title">Add Picture</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Type Toggle -->
                                                    <div class="d-flex justify-content-center gap-3 mb-4"
                                                         id="galleryOptions">
                                                        <label class="btn btn-secondary gallery-option w-100">
                                                            <input type="radio" class="d-none gallery_mode"
                                                                   name="galleryoption" value="image">
                                                            <i class="bi bi-folder me-1"></i>Upload Image
                                                        </label>
                                                        <label class="btn btn-secondary gallery-option w-100">
                                                            <input type="radio" class="d-none gallery_mode"
                                                                   name="galleryoption" value="custom_image_link">
                                                            <i class="bi bi-folder me-1"></i> Custom Image
                                                        </label>
                                                    </div>

                                                    <!-- Upload Image -->
                                                    <div class="upload-image-div">
                                                        <label class="form-label">Upload Image</label>
                                                        <input name="upload_image" type="file" accept="image/*"
                                                               class="form-control" id="upload_image_modal">
                                                    </div>

                                                    <!-- Custom Image Link -->
                                                    <div class="custom-image-div d-none">
                                                        <label class="form-label">Custom image link</label>
                                                        <input name="custom_image_link" type="url" class="form-control"
                                                               id="custom_image_link_modal"
                                                               placeholder="Enter image URL">
                                                    </div>

                                                    <!-- Preview -->
                                                    <div class="preview-img mt-3 text-center d-none">
                                                        <img src="#" id="gallery_img_preview"
                                                             class="img-fluid rounded border"
                                                             style="max-height: 200px;" alt="">
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary"
                                                            id="cancelGalleryModal">Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-dark" id="saveGalleryModal">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Gallery end -->

                                <!-- Featured Videos start -->
                                <section class="mb-4" id="featuredVideos">
                                    <div class="section-title d-flex align-items-center justify-content-between">
                                        <div>{{__('Add Your Featured Videos')}}</div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div
                                                class="form-check form-switch">
                                                <input type="checkbox"
                                                       name="is_video_enabled"
                                                       id="is_video_enabled"
                                                       class="form-check-input input-primary"
                                                    {{ isset($gallery['is_video_enabled']) && $gallery['is_video_enabled'] ? "checked=\"checked\"" : "" }}>
                                                <label class="form-check-label"
                                                       for="is_video_enabled"></label>
                                            </div>
                                            <div>{{__('On')}}</div>
                                        </div>
                                    </div>

                                    <!-- Video Gallery Preview -->
                                    <div class="row g-3 mb-4" id="videoGalleryPreview">
                                        @foreach ($gallery_contents as $gallery_content)
                                            @if(in_array($gallery_content->type, ['video', 'custom_video_link']))
                                                @php $url = $gallery_content->type === 'video' ? $gallery_path . '/' . $gallery_content->value : $gallery_content->value; @endphp
                                                <div class="col-12 col-lg-3">
                                                    <div class="position-relative border rounded overflow-hidden">
                                                        <video class="w-100" controls
                                                               style="height: 200px; object-fit: cover;">
                                                            <source src="{{ $url }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <button type="button"
                                                                class="btn item-management-btn position-absolute top-0 end-0 m-1 remove-gallery"
                                                                data-id="{{ $gallery_content->id }}">
                                                            @include('components.delete-icon')
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="pb-4"></div>
                                    <!-- Add More Pictures Button -->
                                    <button type="button" class="btn btn-primary px-5 mx-auto d-block"
                                            id="openAddVideosModal">
                                        Add more videos
                                    </button>

                                    <!-- Modal: Add Video -->
                                    <div class="modal fade" id="addVideoModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-center gap-3 mb-4">
                                                        <label class="btn btn-secondary gallery-option w-100">
                                                            <input type="radio" class="d-none gallery_mode"
                                                                   name="galleryoption" value="video">
                                                            <i class="bi bi-folder me-1"></i>Upload Video
                                                        </label>
                                                        <label class="btn btn-secondary gallery-option w-100">
                                                            <input type="radio" class="d-none gallery_mode"
                                                                   name="galleryoption" value="custom_video_link">
                                                            <i class="bi bi-folder me-1"></i>Custom Video
                                                        </label>
                                                    </div>

                                                    <!-- File Upload for Video -->
                                                    <div class="upload-video-div">
                                                        <label class="form-label"
                                                               for="upload_video_modal">{{ __('Upload Video') }}</label>
                                                        <input type="file" name="upload_video" id="upload_video_modal"
                                                               accept="video/mp4, video/webm"
                                                               class="form-control">
                                                    </div>

                                                    <!-- Custom Video Link -->
                                                    <div class="custom-video-div d-none mt-3">
                                                        <label class="form-label"
                                                               for="custom_video_link_modal">{{ __('Custom video link') }}</label>
                                                        <input type="text" name="custom_video_link"
                                                               id="custom_video_link_modal"
                                                               class="form-control"
                                                               placeholder="{{ __('Enter Your Custom Video Link') }}">
                                                    </div>

                                                    <!-- Video Preview -->
                                                    <div class="preview-video mt-3 text-center d-none">
                                                        <video controls id="videoPreview" class="w-100 rounded"
                                                               style="max-height: 240px;"></video>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary"
                                                            id="cancelVideoModal">Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-dark" id="saveVideoModal">Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>
                                <!-- Featured Videos end -->

                                <!-- Google Review start -->
                                <section class="mb-5 border-0" id="googleReviewSection">
                                    <div class="section-title d-flex align-items-center justify-content-between">
                                        <div>{{__('Google Review')}}</div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div
                                                class="form-check form-switch">
                                                <input type="checkbox"
                                                       name="google_review_enabled"
                                                       id="google_review_enabled"
                                                       class="form-check-input input-primary"
                                                    {{ isset($business['google_review_enabled']) && $business['google_review_enabled'] ? "checked=\"checked\"" : "" }}>
                                                <label class="form-check-label"
                                                       for="google_review_enabled"></label>
                                            </div>
                                            <div>{{__('On')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        {{ Form::label('google_review_link', __('Link your google review page'), ['class' => 'form-label']) }}
                                        {{ Form::url('google_review_link', $business->google_review_link, ['class' => 'form-control', 'id' => $business_id . '_google_review_link', 'data-name'=>'business_google_review_link']) }}
                                    </div>
                                </section>
                                <!-- Google Review end -->
                            </div>
                        @endif

                        <div class="tab-pane fade @if($tab === 4) show active @endif"
                             id="captureAndShareTab" role="tabpanel">
                            <section id="leadCaptureSection">
                                <div class="section-title d-flex align-items-center justify-content-between">
                                    <div>{{__('Lead Capture')}}</div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div
                                            class="form-check form-switch">
                                            <input type="checkbox"
                                                   name="is_auto_contact_popup_enabled"
                                                   id="is_auto_contact_popup_enabled"
                                                   class="form-check-input input-primary"
                                                {{ $business->is_auto_contact_popup_enabled ? "checked=\"checked\"" : "" }}>
                                            <label class="form-check-label"
                                                   for="is_auto_contact_popup_enabled"></label>
                                        </div>
                                        <div>{{__('On')}}</div>
                                    </div>
                                </div>
                                <div>Collect and exchange contact info</div>
                                <div class="mb-4 pb-2"></div>
                                <div class="bg-secondary rounded p-3 p-md-4 mb-4">
                                    <h6 class="fw-bold mb-3">Form Fields</h6>
                                    <div class="row g-3 share-contact-form-fields">
                                        @php
                                            $fields = [
                                              'name' => 'Full Name',
                                              'phone' => 'Phone',
                                              'email' => 'Email',
                                              'company' => 'Company',
                                              'job_title' => 'Job Title',
                                              'notes' => 'Notes',
                                            ];
                                        @endphp

                                        @foreach($fields as $key => $label)
                                            @php
                                                $defaultRequired = in_array($key, ['name', 'phone']);
                                                $isEnabled  = old("is_{$key}_enabled",  $shareContactFields ? $shareContactFields->{"is_{$key}_enabled"}  : $defaultRequired);
                                                $isRequired = old("is_{$key}_required", $shareContactFields ? $shareContactFields->{"is_{$key}_required"} : $defaultRequired);
                                            @endphp
                                            <div class="col-md-6">
                                                <div
                                                    class="d-flex flex-row gap-3 justify-content-between align-items-center border rounded px-3 py-2 bg-white">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <i class="bi bi-grip-vertical text-muted"></i>
                                                        <label class="mb-0">{{ $label }}</label>
                                                    </div>

                                                    <div class="d-flex align-items-center gap-3">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="is_{{ $key }}_enabled"
                                                            {{ $isEnabled ? 'checked' : '' }}>
                                                        <span class="small text-muted">Required</span>

                                                        <div class="form-check form-switch m-0 p-0">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="is_{{ $key }}_required"
                                                                {{ $isRequired ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="section-title d-flex align-items-center justify-content-between">
                                    <div class="">Contact Info</div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div
                                            class="form-check form-switch">
                                            <input type="checkbox"
                                                   name="is_lead_direct_download_enabled"
                                                   id="is_lead_direct_download_enabled"
                                                   class="form-check-input input-primary"
                                                {{ $business->is_lead_direct_download_enabled ? "checked=\"checked\"" : "" }}>
                                            <label class="form-check-label"
                                                   for="is_services_enabled"></label>
                                        </div>
                                        <div>{{__('On')}}</div>
                                    </div>
                                </div>
                                <div>{{__('Allow leads to download your contact info directly on their phones')}}</div>
                            </section>
                            <section>
                                <div class="section-title d-flex align-items-center justify-content-between">
                                    <div>{{__('Share Your Card')}}</div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('copy_card_link', __('Copy your card link'), ['class' => 'form-label']) }}
                                    @include('components.copy-card-link-container')
                                </div>
                                <div class="row gy-4">
                                    <div class="col-lg-6 border-end">
                                        <div class="section-title">QR Code</div>
                                        @include('components.color-selector', [
                                            'id' => 'qrcode_foreground_color',
                                            'label' => 'Choose Colour',
                                            'value' => old('qrcode_foreground_color', $qr_detail && $qr_detail->foreground_color ? $qr_detail->foreground_color: '#000000'),
                                            'colors' => ['#000000', '#FF3C39', '#F55381', '#FC8E3A', '#F4B813', '#06C27C'],
                                        ])
                                        <div id="qr_type_option" class="{{ $isProClient ? "" : "display-none" }}">
                                            <div class="form-group">
                                                {{ Form::label('qrcode_image', __('Custom Logo'), ['class' => 'form-label fw-semibold']) }}
                                                <div class="mb-3">Add custom logo in the middle of the QR Code.</div>
                                                <input type="file" name="qrcode_image"
                                                       accept=".png, .jpg, .jpeg"
                                                       class="form-control qr-data d-none qr-code-image"
                                                       id="qrCodeImage">
                                                <button type="button"
                                                        class="btn btn-secondary d-flex justify-content-center align-items-center rounded-4"
                                                        id="add_qr_code_logo_btn"
                                                        onclick="selectNormalFile('qr-code-image')">
                                                    <span class="mb-0 fw-semibold">Add Logo</span>
                                                </button>
                                                <img id="qrCodeImageBuffer" alt=""
                                                     src="{{ $isProClient ? ($qr_detail && $qr_detail->image ? $qr_path.'/'.  $qr_detail->image: $siteLogo) : $siteLogo }}"
                                                     class="d-none" crossorigin="anonymous">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="section-title">{{ $business->title }}’s QR Code</div>
                                            <div class="code generated-qr-code mb-4">
                                            </div>
                                            <button type="button" class="btn btn-primary mb-4"
                                                    id="downloadMyQrCodeBtn">{{__('Download QR Code')}}</button>
                                            <div class="text-14 fst-italic">Lead capture mode is <span
                                                    id="isAutoContactPopupText">{{ $business->is_auto_contact_popup_enabled ? 'ON': 'OFF' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div id="tempQrCode" class="opacity-0 position-absolute"></div>
            </div>
            <!-- your .card lives somewhere up the page -->
            <div class="sticky-bottom-bar">
                <div class="sticky-bar-bg"></div>
                <div class="sticky-bar-content d-flex justify-content-center gap-3 p-3 position-relative">
                    <button type="reset" class="btn btn-secondary reset-form">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>

        <div class="d-none d-xl-block position-sticky align-self-start sticky-top-32">
            <div class="position-relative shadow-lg custom-box">
                @include('card.' . $card_theme->theme . '.index', ['is_on_form_preview' => true])
            </div>
        </div>
    </div>

    <!-- Image Crop Modal -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Drag to reposition</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="cropperContainer">
                        <img id="cropperTarget" class="img-fluid" alt="" src="#"/>
                    </div>
                    <input type="range" min="0.1" max="3" step="0.1" value="1" id="zoomSlider" class="form-range mt-3">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white border" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveCropped" class="btn btn-primary">Save</button>
                </div>
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
                                <div class="cursor-pointer text-center" onclick="socialRepeater('{{ $val }}')">
                                    <img
                                        src="{{ asset('assets/images/icons/user_interface/socials/' . strtolower($val) . '.svg') }}"
                                        alt="image">
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
                <form action="" id="socialItemForm">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <button type="button" class="btn p-0 d-flex align-items-center gap-2 border-0"
                                style="font-size: 1rem; font-weight: 500;" id="closeSocialItemModal">
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
                        <input type="text" class="form-control" id="socialItemModalInput"
                               placeholder="Enter profile link">
                    </div>

                    <!-- Add Button -->
                    <button type="button" class="btn btn-dark w-100 rounded" id="saveSocialItemBtn">Add</button>
                </form>
            </div>
        </div>
    </div>

    @include('components.share-card-modal', ['id' => 'shareCardModalOnForm'])

@endsection

@push('custom-scripts')
    <script src="{{ asset('js/bootstrap-toggle.js') }}"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="{{ asset('custom/js/vcard-section-border-color-util.js') }}"></script>

    <script type="text/javascript">
        var asset_path = `{{ asset('assets/images/icons/user_interface/socials/') }}`
        $('#pills-tab .nav-item').click(function () {
            const edit_tab_key = $(this).data('key');
            $('#edit_tab_key').val(edit_tab_key);
        })
        const iti_config = {
            initialCountry: "auto",
            nationalMode: false,
            formatOnDisplay: false,
            autoFormat: false,
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("us"));
            },
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
        };
        $(function () {
            $('.phone-input').each(function () {
                const input = this;
                window.intlTelInput(input, iti_config);
            });

        })

        $('[data-id="openShareCardModalOnFormBtn"]').click(function () {
            $('#shareCardModalOnForm').modal('show');
        })
    </script>

    <script id="imageUploadManagementScript">
        const toggleBannerControls = (hasImage) => {
            if (hasImage) {
                $('#deleteBannerBtn').removeClass('d-none');
                $('label[for="file-1"]').addClass('d-none');
            } else {
                $('#deleteBannerBtn').addClass('d-none');
                $('label[for="file-1"]').removeClass('d-none');
            }
        };
        const handleImageUpload = (inputClass, targetId) => {
            fileInput = $(`.${inputClass}`)[0];
            currentTarget = targetId;

            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#cropperTarget').attr('src', e.target.result);
                $('#zoomSlider').val(1);
                $('#cropperModal').modal('show');
            };
            reader.readAsDataURL(file);
        }

        const selectFile = (targetClass) => {
            const $input = $(`.${targetClass}`);

            // Clear previous value to ensure change event fires for same file
            $input.val('');

            $input.off('change').on('change', function () {
                if (this.files && this.files[0]) {
                    handleImageUpload(targetClass, targetClass);
                }
            });

            $input.trigger('click');
        };

        // crop the image
        let cropper;
        let currentTarget = '';
        let fileInput = null;

        $(function () {
            toggleBannerControls({{ $hasBanner ? "1": "0" }});
            $(`#deleteBannerBtn`).click(function () {
                var business_id = '{{$business->id}}';
                $.ajax({
                    url: '{{ route('business.delete-banner') }}',
                    type: 'POST',
                    data: {
                        "business_id": business_id,
                    },
                    success: function () {
                        location.reload();
                    }
                });
            })
            const $cropperModal = $('#cropperModal');
            $cropperModal.on('shown.bs.modal', function () {
                const image = document.getElementById('cropperTarget');
                cropper = new Cropper(image, {
                    viewMode: 1,
                    scalable: true,
                    zoomable: true,
                    dragMode: 'move',
                    aspectRatio: currentTarget === 'banner' ? 2560 / 1080 : 1,
                });

                $('#zoomSlider').on('input', function () {
                    cropper.zoomTo(parseFloat(this.value));
                });
            });

            $cropperModal.on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            $('#saveCropped').on('click', function () {
                const canvas = cropper.getCroppedCanvas(); // ⬅️ no dimensions → keeps native cropped resolution
                canvas.toBlob(function (blob) {
                    // Preview
                    const url = URL.createObjectURL(blob);
                    $(`#${currentTarget}`).attr('src', url);
                    $(`#${currentTarget}_preview`).attr('src', url).removeClass('d-none');

                    // Convert blob to File and assign to input
                    const file = new File([blob], 'cropped-image.jpg', {type: 'image/jpeg'});
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    if (currentTarget === 'banner') toggleBannerControls(true);
                    $('#cropperModal').modal('hide');
                }, 'image/jpeg');
            });

        })

        // drag and drop files
        $(function () {
            $('.dropzone').on('dragover', function (e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            }).on('dragleave', function () {
                $(this).removeClass('drag-over');
            }).on('drop', function (e) {
                e.preventDefault();
                $(this).removeClass('drag-over');

                const files = e.originalEvent.dataTransfer.files;
                if (files.length && files[0].type.startsWith('image/')) {
                    const targetId = $(this).data('target');
                    const fileInput = $(`.${targetId}`)[0];

                    // Put dropped file into input manually
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(files[0]);
                    fileInput.files = dataTransfer.files;

                    // Trigger the crop modal
                    handleImageUpload(targetId, targetId);
                }
            });
        })
    </script>

    <script id="livePreviewScript">
        const getPreviewElement = (element) => {
            return $(`#${element.attr('id')}_preview`)
        }
        //input change
        $(document).on('keyup', 'input', function () {
            const $input = $(this);
            let val = $input.val();
            const previewElement = getPreviewElement($input);
            const id = $input.attr('id');
            switch (id) {
                //role and company
                case "{{ $business_id }}_designation":
                case "{{ $business_id }}_subtitle": {
                    const $container = $('#roleAndCompanyOnVcard');
                    const $connector = $('#title_sub_title_connector');
                    const values = [
                        $("#{{ $business_id }}_designation").val(),
                        $("#{{ $business_id }}_subtitle").val(),
                    ]
                    if (values.some(val => val === null || val === '')) {
                        $connector.hide();
                    } else {
                        $connector.show();
                    }
                    if (values.every(val => val === null || val === '')) {
                        $container.hide();
                    } else {
                        $container.show();
                    }

                    break;
                }

                case "{{ $business_id }}_phone":
                case "{{ $business_id }}_address":
                case "{{ $business_id }}_email":
                case "{{ $business_id }}_website": {
                    let href = val;
                    if (id === "{{ $business_id }}_phone")
                        href = `tel:${val}`;
                    if (id === "{{ $business_id }}_address")
                        href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(val)}`;
                    if (id === "{{ $business_id }}_email")
                        href = `mailto:${val}`;
                    else
                        href = `https://${val}`;
                    previewElement.attr('href', href);

                    $container = previewElement.closest('div');
                    if (val) $container.show();
                    else $container.hide();

                    const $groupContainer = $('#contact-section');
                    const values = [
                        $("#{{ $business_id }}_phone").val(),
                        $("#{{ $business_id }}_address").val(),
                        $("#{{ $business_id }}_email").val(),
                        $("#{{ $business_id }}_website").val(),
                    ]
                    if (values.every(val => val === null || val === '')) {
                        $groupContainer.hide();
                    } else {
                        $groupContainer.show();
                    }
                    break;
                }

                //Google Review Link
                case "{{ $business_id }}_google_review_link":
                    previewElement.attr('href', val);
                    break;


            }
            //if not Google Review Link
            if (id !== "{{ $business_id }}_google_review_link") {
                previewElement.text(val);
            }

            if (val) previewElement.show();
            else previewElement.hide();
        });

        $(document).on('keyup', '#{{ $business_id }}_desc', function () {
            const input = $(this);
            let val = input.val();
            const formatted = val.replace(/\n/g, '<br>');
            const previewElement = getPreviewElement(input);
            previewElement.html(formatted);

            if (val) previewElement.show();
            else previewElement.hide();
        });

    </script>

    <script id="socialManagementScript">
        const socialSvgs = {
            @foreach ($businessfields as $key)
            "{{ strtolower($key) }}": `{!! svg('vcard/socials/' . strtolower($key) . '.svg', ['class' => 'w-100 h-100']) !!}`,
            @endforeach
        };

        const socialValidators = {
            facebook: /^https?:\/\/(www\.)?facebook\.com\/.+$/i,
            instagram: /^https?:\/\/(www\.)?instagram\.com\/.+$/i,
            linkedin: /^https?:\/\/(www\.)?linkedin\.com\/.+$/i,
            youtube: /^https?:\/\/(www\.)?youtube\.com\/.+$/i,
            twitter: /^https?:\/\/(www\.)?twitter\.com\/.+$/i,
            pinterest: /^https?:\/\/(www\.)?pinterest\.com\/.+$/i,
            tiktok: /^https?:\/\/(www\.)?tiktok\.com\/.+$/i,
            behance: /^https?:\/\/(www\.)?behance\.net\/.+$/i,
            whatsapp: phone => /^\+[0-9\s\-]{7,15}$/.test(phone),
        };


        var socials_row_no = {{ count($social_content) + 1 }};
        var selectedSocialName = '';
        var selectedSocialIcon = '';
        var editSocialId = null;

        $(`#openSocialsModal`).click(function () {
            $('#socialsModal').modal('show');
        })

        $(`#closeSocialItemModal`).click(function () {
            $('#socialItemModal').modal('hide');
        })

        $(function () {
            $saveSocialItemBtn = $('#saveSocialItemBtn');
            // Handle Save/Add/Update
            $saveSocialItemBtn.on('click', function () {
                const inputVal = $('#socialItemModalInput').val().trim();
                const platform = selectedSocialName.toLowerCase();
                const validator = socialValidators[platform];
                let previewLink = inputVal;
                if (platform === 'whatsapp') {
                    const cleaned = inputVal.replace(/\D/g, ''); // remove +, dashes, spaces
                    previewLink = `https://wa.me/${cleaned}`;
                }

                let isValid = false;

                if (validator instanceof RegExp) {
                    isValid = validator.test(inputVal);
                } else if (typeof validator === 'function') {
                    isValid = validator(inputVal);
                }

                if (!isValid) {
                    const msg = platform === 'whatsapp'
                        ? 'Please enter a valid WhatsApp phone number (e.g., +1234567890)'
                        : `Please enter a valid ${selectedSocialName} link (e.g., https://${platform}.com/yourprofile)`;
                    toastrs("", msg, "error");
                    return;
                }
                if (editSocialId) {
                    const editSocialRowSelector = `#${editSocialId}`;
                    $(editSocialRowSelector).find('.social-link-href').val(inputVal);
                    $(`${editSocialRowSelector}_preview`).attr('href', previewLink).show();
                } else {
                    // Create new card + hidden inputs
                    const newSocialDataId = `socials_${socials_row_no}`;
                    var html = `
                <div class="col-lg-4 social-row" id="${newSocialDataId}">
                    <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded">
                        <div class="d-flex align-items-center gap-2">
                            <img src="${asset_path}/${selectedSocialName.toLowerCase()}.svg" alt="" style="width:24px;height:24px;">
                            <span class="social-link-text">${selectedSocialName}</span>
                            <input type="hidden" name="socials[${socials_row_no}][${selectedSocialName}]" value="${inputVal}" class="social-link-href">
                            <input type="hidden" name="socials[${socials_row_no}][id]" value="${socials_row_no}">
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-white btn-edit-social" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-white btn-remove-social">
                                {!! view('components.delete-icon') !!}
                    </button>
                </div>
            </div>
        </div>
`;
                    $('#inputrow_socials').append(html);
                    let svgHtml = socialSvgs[platform];
                    let newSocialSlide = `
                    <a href="${previewLink}" target="_blank" class="card-social-link"
                        id="${newSocialDataId}_preview">
                       ${svgHtml}
                    </a>`;
                    $('.socials-slider').append(newSocialSlide);
                    socials_row_no++;
                }
                $(`.social-row input[type="hidden"]`).trigger('change');
                $('.socials-slider').show();
                $('#socialItemModal').modal('hide');
            });

            const $socialItemModal = $('#socialItemModal');
            $socialItemModal.off('shown.bs.modal').on('shown.bs.modal', function () {
                const platform = selectedSocialName.toLowerCase();
                const $input = $('#socialItemModalInput');
                if (platform === 'whatsapp') {
                    $input.attr('placeholder', '');
                    try {
                        const itiInstance = window.intlTelInputGlobals.getInstance($input[0]);
                        if (itiInstance) itiInstance.destroy();
                    } catch (e) {

                    }
                    // initialize intlTelInput
                    window.intlTelInput($input[0], iti_config);
                }
            });

            $socialItemModal.off('hidden.bs.modal').on('hidden.bs.modal', function () {
                const $input = $('#socialItemModalInput');
                $input.attr('placeholder', '');
                try {
                    const itiInstance = window.intlTelInputGlobals.getInstance($input[0]);
                    if (itiInstance) itiInstance.destroy();
                } catch (e) {

                }
            });
        })


        // When select a social in socialsModal
        function socialRepeater(el) {
            if ($('#inputrow_socials .social-row').length >= 10) {
                toastrs("", "You can only add up to 10 social links.", "error");
                return;
            }
            selectedSocialIcon = asset_path + '/' + el.toLowerCase() + '.svg';
            $('#socialItemModalIcon').attr('src', selectedSocialIcon);

            selectedSocialName = el;
            const selected = el.toLowerCase();
            const count = $(`#inputrow_socials .social-link-text`).filter(function () {
                return $(this).text().trim().toLowerCase() === selected;
            }).length;

            if (count >= 2) {
                toastrs("", `Only 2 ${el} links allowed.`, "error");
                return;
            }
            $('#socialItemModalName').text(selectedSocialName);

            $('#socialItemModalInput').val('');
            $saveSocialItemBtn.text('Add');
            editSocialId = null;

            // FIRST: Hide the socials modal

            const $socialsModal = $('#socialsModal');
            $socialsModal.modal('hide');
            // THEN: After it's fully hidden, open the socialItemModal
            $socialsModal.on('hidden.bs.modal', function () {
                $('#socialItemModal').modal('show');
                // Very important: unbind this event after running once!
                $(this).off('hidden.bs.modal');
            });
        }


        // Handle Edit Button
        $(document).on('click', '.btn-edit-social', function () {
            const $socialRow = $(this).closest('.social-row');
            editSocialId = $socialRow.attr('id');

            selectedSocialName = $socialRow.find('.social-link-text').text();
            $('#socialItemModalIcon').attr('src', asset_path + '/' + selectedSocialName.toLowerCase() + '.svg');
            $('#socialItemModalName').text(selectedSocialName);

            const link = $socialRow.find('.social-link-href').val();
            $('#socialItemModalInput').val(link);

            $saveSocialItemBtn.text('Update');
            $('#socialItemModal').modal('show');
        });


        // Handle Delete Button
        $(document).on('click', '.btn-remove-social', function () {
            const $socialRow = $(this).closest('.social-row');
            $('.socials-slider .card-social-link').eq($socialRow.index()).remove();
            $socialRow.remove();
            $(`.social-row input[type="hidden"]`).trigger('change');
        });

    </script>

    <script id="colorManagementScript">
        $(function () {
            const businessCard = document.querySelector('#businessCard');
            const colorOptions = {
                card_bg_color: "--custom-card-bg",
                button_bg_color: "--custom-button-bg",
                card_text_color: "--custom-color",
                button_text_color: "--custom-button-color"
            };
            $('.color-group').each(function () {
                const group = $(this);
                const inputId = group.data('input-id');
                const $input = $('#' + inputId);
                const currentColor = $input.val().toLowerCase();
                let matched = false;

                group.find('.color-swatch').each(function () {
                    const swatchColor = $(this).data('color').toLowerCase();
                    if (swatchColor === currentColor) {
                        $(this).addClass('selected');
                        matched = true;
                    }
                });

                if (!matched) {
                    group.find('.color-picker-swatch').addClass('selected');
                }

                group.on('click', '.color-swatch', function () {
                    const selectedColor = $(this).data('color');
                    group.find('.color-swatch, .color-picker-swatch').removeClass('selected');
                    $(this).addClass('selected');
                    $input.val(selectedColor).trigger('input');
                });

                group.on('input', 'input[type="color"]', function () {
                    const val = $(this).val().toLowerCase();
                    let found = false;

                    group.find('.color-swatch').each(function () {
                        if ($(this).data('color').toLowerCase() === val) {
                            group.find('.color-swatch, .color-picker-swatch').removeClass('selected');
                            $(this).addClass('selected');
                            found = true;
                        }
                    });

                    if (!found) {
                        group.find('.color-swatch, .color-picker-swatch').removeClass('selected');
                        group.find('.color-picker-swatch').addClass('selected');
                    }
                    const id = $(this).attr('id');
                    businessCard.style.setProperty(colorOptions[id], val);
                    if (id === "card_bg_color") {
                        businessCard.style.setProperty('--custom-section-border-color', getRelativeBorderColor());
                    }
                });
            });
        })

    </script>

    <script id="serviceManagementScript">
        let services_count = {{ count($services_content) + 1 }};
        const $service_list = $(`#serviceList`);
        const $vcard_service_list = $(`#vcardServiceList`);
        $(`#addNewServiceBtn`).click(function () {
            const current_service_row_count = $('.service-row').length;
            const html = `
                <div class="col-md-6 service-row" data-key="${services_count}">
                    <div class="form-group">
                        <div class="d-flex align-items-center mb-2">
                            <label class="form-label mb-0">Service ${current_service_row_count + 1}</label>
                            <button type="button" class="remove-service-row item-management-btn">
                            {!! view('components.delete-icon') !!}
            </button>
        </div>
        <input type="text" class="form-control" id="service_title_${services_count}" name="services[${services_count}][title]" required />
                    </div>
                </div>
            `;
            const preview_html = `
                <div class="col-6 vcard-service-row mb-2 pb-1" data-key="${services_count}">
                    <div class="btn button-bg rounded-pill w-100">
                        <div id="service_title_${services_count}_preview" class="button-color">

                        </div>
                   </div>
                </div>
            `;
            services_count++;
            $service_list.append(html);
            $vcard_service_list.append(preview_html);
        });

        $(document).on('click', '.remove-service-row', function () {
            const delete_key = $(this).closest('.service-row').data('key');
            $(`.service-row[data-key="${delete_key}"], .vcard-service-row[data-key="${delete_key}"]`).remove();
            $('.service-row').each(function () {
                const $service_row = $(this);
                const service_index = $service_row.index();
                console.log('service_index', service_index + 1);
                $service_row.find('.form-label').text(`Service ${service_index + 1}`);
            })
            services_count = $('.service-row:last-child').data('key') + 1;
        });

        $("#is_services_enabled").change(function () {
            const enable = $(this).is(":checked");
            const $section = $("#vcard-services-section");
            if (enable) $section.show();
            else $section.hide();
        })
    </script>

    <script id="galleryManagementScript">
        $(function () {
            $("#is_gallery_enabled").change(function () {
                const enable = $(this).is(":checked");
                const $section = $("#vcard-gallery-section");
                if (enable) $section.show();
                else $section.hide();
            })

            $('#openGalleryModal').click(function () {
                $('#addGalleryModal').modal('show');
                $(`input[name="galleryoption"][value="image"]`).prop('checked', true).trigger('change');
            })

            // Switch between Image and Custom Image
            $('#addGalleryModal input.gallery_mode').on('change', function () {
                const selected = $(this).val();
                $('.upload-image-div, .custom-image-div').addClass('d-none');
                if (selected === 'image') {
                    $('.upload-image-div').removeClass('d-none');
                } else {
                    $('.custom-image-div').removeClass('d-none');
                }
                $('#addGalleryModal .gallery-option').removeClass('btn-primary').addClass('btn-secondary');
                $(this).closest('.gallery-option').removeClass('btn-secondary').addClass('btn-primary');
                $('#addGalleryModal input:not([name="galleryoption"])').val('');
                $('#upload_image_modal').val('');
                resetPreview();
            });

            // Preview uploaded image
            $('#upload_image_modal').on('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#gallery_img_preview').attr('src', e.target.result).parent().removeClass('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Preview custom link
            $('#custom_image_link_modal').on('input', function () {
                const url = $(this).val().trim();
                if (url) {
                    $('#gallery_img_preview').attr('src', url).parent().removeClass('d-none');
                } else {
                    resetPreview();
                }
            });

            // Cancel
            $('#cancelGalleryModal').on('click', function () {
                $('#addGalleryModal input:not([name="galleryoption"])').val('');
                $('#upload_image_modal').val('');
                resetPreview();
                $('#addGalleryModal').modal('hide');
            });

            function resetPreview() {
                $('#gallery_img_preview').attr('src', '#').parent().addClass('d-none');
            }

            // Save button submits the main form
            $('#saveGalleryModal').on('click', function () {
                $('#submitUpdateBusinessForm').trigger('click');
            });


            // Gallery Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
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
    </script>

    <script id="featuredVideoManagementScript">
        $(function () {
            $("#is_video_enabled").change(function () {
                const enable = $(this).is(":checked");
                const $section = $("#vcard-featured-videos-section");
                if (enable) $section.show();
                else $section.hide();
            });

            $('#openAddVideosModal').click(function () {
                $('#addVideoModal').modal('show');
                $(`input[name="galleryoption"][value="video"]`).prop('checked', true).trigger('change');
            })

            // Switch between Image and Custom Image
            $('#addVideoModal input.gallery_mode').on('change', function () {
                const selected = $(this).val();
                $('.upload-video-div, .custom-video-div, .preview-video').addClass('d-none');
                if (selected === 'video') {
                    $('.upload-video-div').removeClass('d-none');
                } else {
                    $('.custom-video-div').removeClass('d-none');
                }
                $('#upload_video_modal').val('');
                $('#custom_video_link_modal').val('');
                $('#addVideoModal .gallery-option').removeClass('btn-primary').addClass('btn-secondary');
                $(this).closest('.gallery-option').removeClass('btn-secondary').addClass('btn-primary');
            });

            // Preview uploaded video
            $('#upload_video_modal').on('change', function () {
                const file = this.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    $('#videoPreview').attr('src', url);
                    $('.preview-video').removeClass('d-none');
                }
            });

            // Preview custom video link
            $('#custom_video_link_modal').on('input', function () {
                const link = $(this).val();
                if (link) {
                    $('#videoPreview').attr('src', link);
                    $('.preview-video').removeClass('d-none');
                }
            });

            // Cancel: reset fields & preview
            $('#cancelVideoModal').on('click', function () {
                $('#upload_video_modal').val('');
                $('#custom_video_link_modal').val('');
                $('#videoPreview').attr('src', '');
                $('.upload-video-div, .custom-video-div, .preview-video').addClass('d-none');
                $('#addVideoModal').modal('hide');
            });

            // Save: just triggers main form save
            $('#saveVideoModal').on('click', function () {
                $('#submitUpdateBusinessForm').trigger('click');
            });
        })
    </script>

    <script id="googleReviewManagementScript">
        $("#google_review_enabled").change(function () {
            const enable = $(this).is(":checked");
            const $section = $("#vcard-google-review-section");
            if (enable) $section.show();
            else $section.hide();
        });
    </script>

    <script id="autoContactPopupManagementScript">
        $("#is_auto_contact_popup_enabled").change(function () {
            const enable = $(this).is(":checked");
            const $text = $('#isAutoContactPopupText');
            $text.text(enable ? "ON" : "OFF");
        });
    </script>

    <script id="qrCodeManagementScript">
        let qrCode;

        function generate_qr() {
            qrCode = new QRCodeStyling({
                width: 162,
                height: 162,
                type: "svg",
                data: "{{ env('APP_URL').'/'.$business->slug }}",
                margin: 0,
                image: $(`#qrCodeImageBuffer`).attr('src'),
                imageOptions: {
                    imageSize: 0.4,
                    margin: 0,
                    hideBackgroundDots: true,
                    saveAsBlob: true,
                },
                dotsOptions: {
                    color: $("#qrcode_foreground_color").val(),
                    type: "dots",
                    roundSize: true
                },
                backgroundOptions: {
                    color: "#ffffff"
                },
                cornersSquareOptions: {
                    type: "extra-rounded" // 👈 Apple-style finder corners
                },
                cornersDotOptions: {
                    type: "dot" // 👈 round inner dot
                },
            });
            const $code = $('.code');
            $code.empty();
            qrCode.append($code[0]);

            const $tempQrCode = $('#tempQrCode');
            $tempQrCode.empty();
            qrCode.append($tempQrCode[0]);
        }

        $(function () {
            generate_qr();
        })

        $('.qr-data').on('change', function () {
            generate_qr();
        });

        $(document).on('input', '#qrcode_foreground_color', function () {
            generate_qr();
        });

        function selectNormalFile(targetId) {
            $(`.${targetId}`).trigger('click');
        }


        $(document).on('change', '#qrCodeImage', function () {
            const img_input = this;
            if (img_input.files && img_input.files[0]) {
                const img_reader = new FileReader();
                img_reader.onload = function (event) {
                    $("#qrCodeImageBuffer").attr("src", event.target.result);
                    setTimeout(generate_qr, 250); // delay if needed
                };
                img_reader.readAsDataURL(img_input.files[0]);
            }
        });


        $(`#downloadMyQrCodeBtn`).on('click', function (e) {
            e.preventDefault();
            qrCode.download({
                name: "{{ $business->title }}",
                extension: "svg"
            });
        });

    </script>

    <script id="formChangeDetectScript">
        $(function () {
            const $form = $('#updateBusinessForm');
            const original = $form.serialize(); // Save initial form state
            const cancelSaveButtonSelectors = ".reset-form, #submitUpdateBusinessForm, .sticky-bottom-bar"
            $(cancelSaveButtonSelectors).hide();

            $form.on('input change', 'input, textarea, select', function () {
                const current = $form.serialize();

                const fileChanged = $form.find('input[type="file"]').toArray().some(input => input.files.length > 0);

                if (current !== original || fileChanged) {
                    $(cancelSaveButtonSelectors).show();
                } else {
                    $(cancelSaveButtonSelectors).hide();
                }
            });


            $('.reset-form').on('click', function () {
                $form[0].reset(); // Reset form
                $(cancelSaveButtonSelectors).hide();
            });
        });
    </script>

    <script id="submitFormScript">
        $('#submitUpdateBusinessForm').click(function () {
            $(`#updateBusinessForm`).submit();
        })
        $(`#updateBusinessForm`).submit(function (e) {
            e.preventDefault();
            const form = $(this)[0];

            var banner_val = '{{$business->banner}}';
            var logo_val = '{{$business->logo}}';

            if (!banner_val && !logo_val) {
                var logo = $('input[name=logo]')[0].files[0];
                if (!logo) {
                    toastrs("", "Profile Picture is required", "error");
                    return;
                }

                var banner = $('input[name=banner]')[0].files[0];
                if (!banner) {
                    toastrs("", "Cover Photo is required", "error");
                    return;
                }
            }

            let socialValid = true;

            $('#inputrow_socials .social-row').each(function () {
                const $row = $(this);
                const platform = $row.find('.social-link-text').text().trim().toLowerCase();
                const link = $row.find('.social-link-href').val().trim();

                const validator = socialValidators[platform];

                let isValid;
                if (validator instanceof RegExp) {
                    isValid = validator.test(link);
                } else if (typeof validator === 'function') {
                    isValid = validator(link);
                }

                if (!isValid) {
                    const msg = platform === 'whatsapp'
                        ? 'Please enter a valid WhatsApp phone number (e.g., +1234567890)'
                        : `Please enter a valid ${platform} link (e.g., https://${platform}.com/yourprofile)`;
                    toastrs("", msg, "error");
                    socialValid = false;
                    return false;
                }
            });

            if (!socialValid) return;


            const phoneInput = $('#{{ $business_id }}_phone');
            const phoneVal = phoneInput.val().trim();
            const phonePattern = /^\+[0-9\s\-]{7,15}$/;

            if (!phonePattern.test(phoneVal)) {
                toastrs("", "Please enter a valid phone number (e.g. +1234567890)", "error");
                return;
            }

            const websiteInput = $('#{{ $business_id }}_website');
            let val = websiteInput.val().trim();

            if (val && !/^https?:\/\//i.test(val)) {
                val = 'https://' + val; // temporarily fix for validation
            }
            // Validate hostname properly
            const domainPattern = /^(https?:\/\/)?([\w\-]+\.)+[a-z]{2,}(\:\d+)?(\/.*)?$/i;
            if (val && !domainPattern.test(val)) {
                toastrs("", "Please enter a valid website URL (e.g. example.com)", "error");
                return;
            }

            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity(); // shows built-in validation UI
            }
        });

    </script>
@endpush
