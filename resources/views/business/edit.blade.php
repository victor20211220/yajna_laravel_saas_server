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
    $siteLogo = asset('assets/images/qrcode-logo.png');
    $imagePlaceholderUrl = Utility::imagePlaceholderUrl();

@endphp
@extends('layouts.new-client')
@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/> <!-- 'nano' theme -->
@endpush
@section('page-title')
    {{ __('Profile') }}
@endsection
@section('title')
    <div class="d-xl-flex gap-5 mb-4">
        <div class="d-flex flex-column w-100 gap-4 gap-md-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 page-title">
                    {{ __('Profile') }}
                </h3>
                <div class="d-flex align-items-center justify-content-between ms-auto gap-3 mb-0">
                    <div class="d-none d-md-block">
                        <button type="reset" class="btn reset-form me-3">
                            {{__('Unsaved Changes')}}
                        </button>
                        <button type="button" class="btn btn-primary submit-form">
                            {{__('Save Changes')}}
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary btn-icon d-xl-none" id="openPreviewOnTabletMobile">
                        {!! svg('/user_interface/eye.svg', ['class' => 'fill-white']) !!}
                        <a href="javascript:void(0)" class="text-white">
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
    <div class="d-flex gap-5 position-relative edit-profile-container">
        <div class="d-flex flex-column w-100">
            {{ Form::open(['route' => ['business.update', $business->id], 'method' => 'put', 'id' => 'updateBusinessForm', 'enctype' => 'multipart/form-data',  'novalidate' => true]) }}
            <input type="hidden" name="business_id" value="{{ $business->id }}">
            <input type="hidden" id="edit_tab_key" value="{{ $tab }}">
            <div class="card">
                <div class="sticky-top z-0 z-1">
                    <div
                        class="scroll-left d-none position-absolute top-50 start-0 translate-middle-y z-2 bg-transparent p-1">
                        <div class="scroll-arrow-bg"></div>
                        {!! svg('user_interface/scroll-left.svg') !!}
                    </div>

                    <div class="nav-scroll card-header bg-white border-bottom overflow-auto">
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
                    <div
                        class="scroll-right d-none position-absolute top-50 end-0 translate-middle-y z-2  bg-transparent p-1">
                        <div class="scroll-arrow-bg"></div>
                        {!! svg('user_interface/scroll-right.svg') !!}
                    </div>

                </div>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  @if($tab === 1) active show @endif"
                             id="details-setting" role="tabpanel">
                            <!-- Profile Picture, Cover Photo, Company Logo upload start -->
                            <section
                                class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-center justify-content-md-{{ $isProClient ? 'between' : 'around'  }} text-md-start gap-3">
                                <div class="form-group">
                                    <div class="position-relative mb-2">
                                        {{ Form::label('logo', __('Profile Picture'), ['class' => 'form-label mb-0']) }}
                                        @include('components/more-info', ['label' => 'Upload an image with a maximum size of 10 MB'])
                                    </div>
                                    <div class="position-relative add-image-block dropzone" data-target="business_logo">
                                        @php
                                            $hasLogo = $business->logo;
                                        @endphp
                                        <img
                                            src="{{ $hasLogo ? $logo.'/'.$business->logo: $imagePlaceholderUrl }}"
                                            alt="images" id="business_logo"
                                            class="rounded-circle w-100 h-100 object-fit-cover img-fluid">
                                        <input class="d-none business_logo"
                                               type="file"
                                               name="logo"
                                               accept=".jpg,.jpeg,.png"
                                        >
                                        <input type="hidden" name="is_business_logo_deleted" value="0">
                                        <div class="position-absolute bottom-0 end-0">
                                            <button type="button"
                                                    class="upload-image {{ $hasLogo ? "d-none": "" }} btn btn-icon btn-primary rounded-circle justify-content-center">
                                                {!! svg('/user_interface/add_picture_button.svg') !!}
                                            </button>
                                            @include('components.image-button-options-dropdown', ['class' => !$hasLogo ? "d-none" : ""])
                                        </div>
                                    </div>
                                </div>

                                <div id="coverPhotoUpload" class="form-group">
                                    <div class="position-relative mb-2">
                                        {{ Form::label('banner', __('Cover Photo'), ['class' => 'form-label mb-0']) }}
                                        @include('components/more-info', ['label' => 'Recommended aspect ratio is 2560x1080px with a maximum size of 10 MB'])
                                    </div>
                                    <div class="position-relative add-image-block dropzone"
                                         data-target="banner">
                                        @php
                                            $hasBanner = isset($business->banner) && !empty($business->banner);
                                        @endphp
                                        <img
                                            src="{{ $hasBanner ? $banner . '/' . $business->banner : asset('assets/images/icons/user_interface/cover_photo_placeholder.png') }}"
                                            alt="" class="w-100 h-100 object-fit-cover img-fluid" id="banner">
                                        <input
                                            class="d-none banner"
                                            type="file" name="banner"
                                            accept=".jpg,.jpeg,.png"
                                        >
                                        <input type="hidden" name="is_banner_deleted" value="0">
                                        <div
                                            class="position-absolute text-center justify-content-center d-flex align-items-center w-100 h-100 top-0 left-0 {{ $hasBanner ? 'd-none': '' }}"
                                            id="bannerUploadPlaceholderDiv">
                                            <label>
                                                <span class="mb-2 d-none d-md-inline-block" style="color: #9D9DA1;">Drag file for upload or</span>
                                                <span class="mb-2 d-inline-block d-md-none" style="color: #9D9DA1;">Upload cover photo</span>
                                                <br/>
                                                <button type="button"
                                                        class="upload-image btn btn-primary btn-sm w-auto h-auto">{{ __('Select Files') }}</button>
                                            </label>
                                        </div>
                                        @include('components.image-button-options-dropdown', ['class' => "position-absolute bottom-0 end-0 mb-2 me-2 ".(!$hasBanner ? "d-none" : "")])
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
                                            @php
                                                $hasCompanyLogo = $business->company_logo;
                                            @endphp
                                            <img
                                                src="{{$hasCompanyLogo ? $company_logo.'/'.$business->company_logo : $imagePlaceholderUrl }}"
                                                alt="images" id="business_company_logo"
                                                class="rounded-circle w-100 h-100 object-fit-cover img-fluid">
                                            <input
                                                class="d-none business_company_logo file-validate"
                                                type="file"
                                                name="company_logo"
                                                accept=".jpg,.jpeg,.png"
                                            >
                                            <input type="hidden" name="is_business_company_logo_deleted" value="0">
                                            <div class="position-absolute bottom-0 end-0">
                                                <button type="button"
                                                        class="upload-image {{ $hasCompanyLogo ? "d-none": "" }} btn btn-icon btn-primary rounded-circle justify-content-center">
                                                    {!! svg('/user_interface/add_picture_button.svg') !!}
                                                </button>
                                                @include('components.image-button-options-dropdown', ['class' => !$hasCompanyLogo ? "d-none" : ""])
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
                                    {!! Form::text('title', $business->title, ['class' => 'form-control', 'id' => $business_id . '_title', 'data-name'=>'business_title', 'validation-required' => 'true']) !!}
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('Designation', __('Job Title or Role'), ['class' => 'form-label']) }}
                                            {{ Form::text('designation', $business->designation, ['class' => 'form-control', 'id' => $business_id . '_designation', 'placeholder' => __('')]) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('Sub_Title', __('Company'), ['class' => 'form-label']) }}
                                            {{ Form::text('sub_title', $business->sub_title, ['class' => 'form-control validation_subtitle', 'id' => $business_id . '_subtitle', 'placeholder' => __('')]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('Description', __('Bio or Description'), ['class' => 'form-label']) }}
                                    {{ Form::textarea('description', $business->description, ['class' => 'form-control description-text','rows' => '5','cols' => '30', 'id' => $business_id . '_desc']) }}
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
                                                                src="{{ asset('assets/images/icons/user_interface/socials/' . strtolower($key) . '.svg') }}"
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
                                                                    class="btn-edit-social btn btn-icon rounded-circle p-0">
                                                                @include('components.edit-icon')
                                                            </button>
                                                            <button type="button"
                                                                    class="btn-remove-social btn btn-icon rounded-circle p-0">
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
                                    'colors' => ['#FFFFFF', '#000000', '#FF0C02', '#F60946', '#FC8E3A', '#F4B813', '#b8ebf7', '#18BCE8', '#175BFD'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'button_text_color',
                                    'label' => 'Button Text',
                                    'tooltip_title' => 'Change the text and icon colour of the button',
                                    'value' => old('button_text_color', $business->button_text_color ?? '#FFFFFF'),
                                    'colors' => ['#FFFFFF', '#000000', '#FF0C02', '#F60946', '#FC8E3A', '#F4B813', '#b8ebf7', '#18BCE8', '#175BFD'],
                                ])
                            </section>
                        </div>

                        @if($isProClient)
                            <div class="tab-pane fade @if($tab === 3) active show @endif"
                                 id="sectionsTab" role="tabpanel">
                                <!-- Gallery start -->
                                <section class="mb-4" id="gallery">
                                    <div class="section-title d-flex align-items-center justify-content-between">
                                        <div>{{__('Add Image Gallery')}}</div>
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
                                    </div>
                                    <div class="pb-4"></div>
                                    <!-- Add More Pictures Button -->
                                    <button type="button"
                                            class="add-more-placeholders invalid btn btn-primary px-5 mx-auto d-block"
                                            data-mode="image">
                                        Add more pictures
                                    </button>
                                </section>
                                <!-- Gallery end -->

                                <!-- Featured Videos start -->
                                <section class="mb-4" id="featuredVideos">
                                    <div class="section-title d-flex align-items-center justify-content-between">
                                        <div>{{__('Add Video Gallery')}}</div>
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
                                    </div>

                                    <div class="pb-4"></div>
                                    <!-- Add More Pictures Button -->
                                    <button type="button"
                                            class="add-more-placeholders invalid btn btn-primary px-5 mx-auto d-block"
                                            data-mode="video">
                                        Add more videos
                                    </button>

                                </section>
                                <!-- Featured Videos end -->

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
                                                                class="remove-service-row item-management-btn btn btn-icon rounded-circle p-0">
                                                            {!! svg('/user_interface/bin_icon_primary.svg') !!}
                                                        </button>
                                                    </div>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="{{ 'service_title_' . $service_key }}"
                                                           name="{{ 'services[' . $service_key . '][title]' }}"
                                                           value="{{ $service_content->title }}"
                                                           validation-required="true"/>
                                                </div>
                                            </div>
                                            @php $service_key++; @endphp
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary px-5 mx-auto d-block"
                                            id="addNewServiceBtn">{{__('Add new service')}}</button>
                                </section>
                                <!-- Services end -->

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
                                        {{ Form::label('google_review_link', __('Link your google review page'), ['class' => 'section-subtitle']) }}
                                        {{ Form::url('google_review_link', $business->google_review_link, ['class' => 'form-control', 'id' => $business_id . '_google_review_link', 'data-name'=>'business_google_review_link', 'validation-required' => 'false', 'validation-message' => 'Please enter a valid URL']) }}
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
                                <div class="section-subtitle">Collect and exchange contact info</div>
                                <div class="mb-3"></div>
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
                                                $isRequired = old("is_{$key}_required", $shareContactFields ? $shareContactFields->{"is_{$key}_required"} : $defaultRequired);
                                                $isEnabled  = old("is_{$key}_enabled",  $shareContactFields ? $shareContactFields->{"is_{$key}_enabled"}  : $defaultRequired);
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
                                                               name="is_{{ $key }}_required" id="is_{{ $key }}_required"
                                                            {{ $isRequired ? 'checked' : '' }}>
                                                        <label class="small text-muted" for="is_{{ $key }}_required">Required</label>

                                                        <div class="form-check form-switch m-0 p-0">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="is_{{ $key }}_enabled"
                                                                {{ $isEnabled ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="section-title d-flex align-items-center justify-content-between">
                                    <div>Contact Info</div>
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
                                <div
                                    class="section-subtitle mb-0">{{__('Allow leads to download your contact info directly on their phones')}}</div>
                            </section>
                            <section>
                                <div class="section-title d-flex align-items-center justify-content-between">
                                    <div>{{__('Share Your Card')}}</div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('copy_card_link', __('Copy your card link'), ['class' => 'section-subtitle']) }}
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
                                            'class' => 'section-subtitle',
                                        ])
                                        <div id="qr_type_option" class="{{ $isProClient ? "" : "display-none" }}">
                                            <div class="form-group">
                                                {{ Form::label('qrcode_image', __('Custom Logo'), ['class' => 'form-label section-title']) }}
                                                <div class="section-subtitle">Add custom logo in the middle of the QR
                                                    Code.
                                                </div>
                                                <div class="position-relative add-image-block dropzone"
                                                     data-target="qrcode_image">
                                                    @php
                                                        $hasQRImg = $qr_detail && $qr_detail->image;
                                                    @endphp
                                                    <img
                                                        src="{{ $isProClient ? ($hasQRImg ? $qr_path.'/'.  $qr_detail->image: $imagePlaceholderUrl) : $imagePlaceholderUrl }}"
                                                        alt="images" id="qrcode_image"
                                                        class="rounded-circle w-100 h-100 object-fit-cover img-fluid">
                                                    <input class="d-none qrcode_image"
                                                           type="file"
                                                           name="qrcode_image"
                                                           accept=".jpg,.jpeg,.png"
                                                    >
                                                    <input type="hidden" name="is_qrcode_image_deleted" value="0">
                                                    <div class="position-absolute bottom-0 end-0">
                                                        <button type="button"
                                                                class="upload-image {{ $hasQRImg ? "d-none": "" }} btn btn-icon btn-primary rounded-circle justify-content-center">
                                                            {!! svg('/user_interface/add_picture_button.svg') !!}
                                                        </button>
                                                        @include('components.image-button-options-dropdown', ['class' => !$hasQRImg ? "d-none" : ""])
                                                    </div>
                                                </div>
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
            </div>
            <!-- your .card lives somewhere up the page -->
            <div class="sticky-bottom-bar">
                <div class="sticky-bar-bg"></div>
                <div class="sticky-bar-content d-flex justify-content-center gap-3 p-3 position-relative">
                    <button type="reset" class="btn btn-white reset-form">Cancel</button>
                    <button type="button" class="btn btn-primary submit-form">Save Changes</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>

        <div class="d-none d-xl-block">
            <div class="position-sticky sticky-top-32" id="previewOnDesktop">
                <div class="shadow-none shadow-xl-lg custom-box">
                    @include('card.' . $card_theme->theme . '.index', ['is_on_form_preview' => true])
                    @include('components.share-contact-modal-content', ['is_on_form_preview' => true, 'id' => 'shareContactModalPreview'])
                </div>
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close mt-1 me-1" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 mx-2 pt-0 mt-0">
                    @php
                        $recommendedFields = array_filter($businessfields, fn($value) => $value === true);
                        $normalFields =  array_filter($businessfields, fn($value) => $value === false)
                    @endphp
                    <p class="modal-section-title fw-bold mb-4">Recommended</p>
                    <div class="row social-card-row">
                        @foreach ($recommendedFields as $key => $val)
                            <div class="col-6 col-lg-4">
                                <div class="cursor-pointer d-flex align-items-center gap-3 mb-3"
                                     onclick="socialRepeater('{{ $key }}')">
                                    <img
                                        src="{{ asset('assets/images/icons/user_interface/socials/' . strtolower($key) . '.svg') }}"
                                        alt="image">
                                    <div>{{ $key }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="modal-section-title fw-bold mt-3 mb-4">Social Links</p>
                    <div class="row social-card-row">
                        @foreach ($normalFields as $key => $val)
                            <div class="col-6 col-lg-4">
                                <div class="cursor-pointer d-flex align-items-center gap-3 mb-3"
                                     onclick="socialRepeater('{{ $key }}')">
                                    <img
                                        src="{{ asset('assets/images/icons/user_interface/socials/' . strtolower($key) . '.svg') }}"
                                        alt="image">
                                    <div>{{ $key }}</div>
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
                    <input type="text" class="form-control" id="socialItemModalInput" validation-required="true">
                </div>

                <!-- Add Button -->
                <button type="button" class="btn btn-primary w-100 rounded" id="saveSocialItemBtn">Add</button>
            </div>
        </div>
    </div>

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
                        <label class="btn btn-white gallery-option w-100">
                            <input type="radio" class="d-none gallery_mode"
                                   name="galleryoption" value="image">
                            <i class="bi bi-folder me-1"></i>Upload Image
                        </label>
                        <label class="btn btn-white gallery-option w-100">
                            <input type="radio" class="d-none gallery_mode"
                                   name="galleryoption" value="custom_image_link">
                            <i class="bi bi-folder me-1"></i> Custom Image
                        </label>
                    </div>

                    <!-- Upload Image -->
                    <div class="upload-image-div">
                        <label class="form-label">Upload Image</label>
                        <input name="upload_image" type="file" accept=".jpg,.jpeg,.png"
                               class="form-control" id="upload_image_modal" validation-required="true">
                    </div>

                    <!-- Custom Image Link -->
                    <div class="custom-image-div d-none">
                        <label class="form-label">Custom image link</label>
                        <input name="custom_image_link" type="url" class="form-control"
                               id="custom_image_link_modal"
                               placeholder="Enter image URL" validation-required="true">
                    </div>

                    <!-- Preview -->
                    <div class="preview-img mt-3 text-center d-none">
                        <img src="#" id="gallery_img_preview"
                             class="img-fluid rounded border"
                             style="max-height: 200px;" alt="">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white"
                            id="cancelGalleryModal" data-bs-dismiss="modal">Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="saveGalleryModal">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add Video -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title">Add Video</h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <label class="btn btn-white gallery-option w-100">
                            <input type="radio" class="d-none gallery_mode"
                                   name="galleryoption" value="video">
                            <i class="bi bi-folder me-1"></i>Upload Video
                        </label>
                        <label class="btn btn-white gallery-option w-100">
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
                               class="form-control" validation-required="true">
                    </div>

                    <!-- Custom Video Link -->
                    <div class="custom-video-div d-none mt-3">
                        <label class="form-label"
                               for="custom_video_link_modal">{{ __('Custom video link') }}</label>
                        <input type="text" name="custom_video_link"
                               id="custom_video_link_modal"
                               class="form-control"
                               placeholder="{{ __('Enter Your Custom Video Link') }}" validation-required="true">
                    </div>

                    <!-- Video Preview -->
                    <div class="preview-video mt-3 text-center d-none">
                        <video controls id="videoPreview"
                               class="w-100 rounded display-none"
                               style="height: 240px;"></video>
                        <iframe id="iframePlayer" frameborder="0" allowfullscreen
                                class="w-100 display-none"
                                style="height: 240px;"></iframe>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="saveVideoModal">Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('components.share-card-modal', ['id' => 'shareCardModalOnForm', 'is_on_form_preview' => true])

    <!-- Offcanvas target -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="previewOnTablet">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body overflow-x-hidden d-flex justify-content-center align-items-center"
             id="previewOnTabletBody"></div>
    </div>

    <!-- Modal target -->
    <div class="modal fade" id="previewOnMobile" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-none bg-transparent">
                <div class="modal-body p-0 d-flex justify-content-end" id="previewOnMobileBody"></div>
            </div>
        </div>
    </div>

@endsection

@push('custom-scripts')
    <script src="{{ asset('js/bootstrap-toggle.js') }}"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="{{ asset('custom/js/vcard-section-border-color-util.js') }}"></script>

    <script type="text/javascript">
        var asset_path = `{{ asset('assets/images/icons/user_interface/socials/') }}`

        $('[data-id="openShareCardModalOnFormBtn"]').click(function () {
            $('#shareCardModalOnForm').modal('show');
        })
    </script>

    <script id="imageUploadManagementScript">
        let cropper;
        let currentTarget;
        const $cropperModal = $('#cropperModal');

        $('.dropzone .upload-image, .dropzone .upload-new-image').click(function () {
            currentTarget = $(this).closest('.dropzone').data('target');

            const $input = $(`.${currentTarget}`);
            $input.val('');

            $input.off('change').on('change', function () {
                if (this.files && this.files[0]) handleImageUpload();
            });
            $input.trigger('click');
        })

        // drag and drop files
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
                currentTarget = $(this).data('target');

                // Put dropped file into input manually
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                $(`.${currentTarget}`)[0].files = dataTransfer.files;

                // Trigger the crop modal
                handleImageUpload();
            }
        });

        //handle image upload and open the cropper modal
        const handleImageUpload = () => {
            const reader = new FileReader();
            reader.onload = function (e) {
                initCropper(e.target.result);
            };
            reader.readAsDataURL($(`.${currentTarget}`)[0].files[0]);
        }

        const initCropper = (url) => {
            const $cropperTarget = $('#cropperTarget');
            const $zoomSlider = $('#zoomSlider');
            const image = $cropperTarget[0];

            try {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            } catch {

            }

            $zoomSlider.val(1);
            $cropperTarget.attr('src', url);

            // Wait until image is fully loaded
            image.onload = () => {
                $cropperModal.off('shown.bs.modal').on('shown.bs.modal', function () {
                    cropper = new Cropper(image, {
                        viewMode: 1,
                        scalable: true,
                        zoomable: true,
                        dragMode: 'move',
                        aspectRatio: currentTarget === 'banner' ? 2560 / 1080 : 1,
                    });

                    $zoomSlider.on('input', function () {
                        cropper.zoomTo(parseFloat(this.value));
                    });
                });

                $cropperModal.modal('show');
            };
        };

        // when save the cropped image
        $('#saveCropped').on('click', function () {
            const canvas = cropper.getCroppedCanvas(); // ⬅️ no dimensions → keeps native cropped resolution
            canvas.toBlob(function (blob) {
                // Preview
                const url = URL.createObjectURL(blob);
                $(`#${currentTarget}`).attr('src', url);
                $(`#${currentTarget}_preview, #${currentTarget}_preview_1`).attr('src', url);

                // Convert blob to File and assign to input
                const file = new File([blob], 'cropped-image.jpg', {type: 'image/jpeg'});
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $(`.${currentTarget}`)[0].files = dataTransfer.files;

                // Flag the target as un-deleted
                $(`input[name="is_${currentTarget}_deleted"][type="hidden"]`).val('0').trigger('change');

                const $dropzone = $(`.dropzone[data-target="${currentTarget}"]`);
                $dropzone.find(`.image-buttons-dropdown`).removeClass('d-none');
                $dropzone.find(`.upload-image`).addClass('d-none');

                switch (currentTarget) {
                    // if the target is banner
                    case "banner":
                        //hide original upload button
                        $('#bannerUploadPlaceholderDiv').addClass('d-none');
                        break;

                    // if the target is business_company_logo
                    case "business_company_logo":
                        // show the business_company_logo_preview
                        $('#business_company_logo_preview').removeClass('d-none');
                        break;

                    case "qrcode_image":
                        setTimeout(generate_qr, 250);
                        break;
                    default:
                        break;
                }

                $('#cropperModal').modal('hide');

            }, 'image/jpeg');
        });


        $('.dropzone .edit-image').click(function () {
            currentTarget = $(this).closest('.dropzone').data('target');
            initCropper($(`#${currentTarget}`).attr('src'));
        })

        // When clicked the delete image
        $(`.dropzone .delete-image`).click(function () {
            currentTarget = $(this).closest('.dropzone').data('target');

            // Remove files set in the target
            $(`input[name="${currentTarget}"][type="file"]`).val('');

            // Flag the target as deleted
            $(`input[name="is_${currentTarget}_deleted"][type="hidden"]`).val('1').trigger('change');

            const $dropzone = $(`.dropzone[data-target="${currentTarget}"]`);
            $dropzone.find(`.image-buttons-dropdown`).addClass('d-none');
            $dropzone.find(`.upload-image`).removeClass('d-none');

            let placeholder_src = "{{ $imagePlaceholderUrl }}";
            switch (currentTarget) {
                // If the target is banner
                case "banner":
                    // Show the original upload button
                    $('#bannerUploadPlaceholderDiv').removeClass('d-none');

                    // Set different placeholder image.
                    placeholder_src = "{{ asset('assets/images/icons/user_interface/cover_photo_placeholder.png') }}";
                    break;

                // if the target is business_company_logo
                case "business_company_logo":
                    // hide the business_company_logo_preview
                    $('#business_company_logo_preview').addClass('d-none');
                    break;

                // If the target is qrcode_image
                case "qrcode_image":
                    setTimeout(generate_qr, 250);
                    break;
            }

            // Set placeholder image to the dropzone and the associated preview in the VCard
            $(`#${currentTarget}, #${currentTarget}_preview, #${currentTarget}_preview_1`).attr('src', placeholder_src);
        })
    </script>

    <script id="livePreviewScript">
        const getPreviewElement = (element) => {
            return $(`#${element.attr('id')}_preview, #${element.attr('id')}_preview_1`)
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
            @foreach ($businessfields as $key => $val)
            "{{ strtolower($key) }}": `{!! svg('vcard/socials/' . strtolower($key) . '.svg', ['class' => 'w-100 h-100']) !!}`,
            @endforeach
        };
        const editIcon = `{!! view('components.edit-icon')  !!}`;
        const deleteIcon = `{!! view('components.delete-icon')  !!}`;

        const linkValidators = {
            facebook: {
                pattern: "^https?:\/\/(www\.)?facebook\.com\/.+$",
                message: "Please enter a valid facebook profile url: (e.g., https://facebook.com/yourprofile)"
            },
            instagram: {
                pattern: "^https?:\/\/(www\.)?instagram\.com\/.+$",
                message: "Please enter a valid instagram profile url: (e.g., https://instagram.com/yourprofile)"
            },
            linkedin: {
                pattern: "^https?:\/\/(www\.)?linkedin\.com\/.+$",
                message: "Please enter a valid linkedin profile url: (e.g., https://linkedin.com/yourprofile)"
            },
            youtube: {
                pattern: "^https?:\/\/(www\.)?youtube\.com\/.+$",
                message: "Please enter a valid youtube profile url: (e.g., https://youtube.com/yourprofile)"
            },
            twitter: {
                pattern: "^https?:\/\/(www\.)?twitter\.com\/.+$",
                message: "Please enter a valid twitter profile url: (e.g., https://twitter.com/yourprofile)"
            },
            pinterest: {
                pattern: "^https?:\/\/(www\.)?pinterest\.com\/.+$",
                message: "Please enter a valid pinterest profile url: (e.g., https://pinterest.com/yourprofile)"
            },
            tiktok: {
                pattern: "^https?:\/\/(www\.)?tiktok\.com\/.+$",
                message: "Please enter a valid tiktok profile url: (e.g., https://tiktok.com/yourprofile)"
            },
            behance: {
                pattern: "^https?:\/\/(www\.)?behance\.net\/.+$",
                message: "Please enter a valid tiktok profile url: (e.g., https://behance.net/yourprofile)"
            },
            whatsapp: {
                pattern: "^[\\d \\-]{7,16}$",
                message: "Please enter a valid whatsapp number"
            },
            phone: {
                pattern: "^[\\d \\-]{7,16}$",
                message: "Please enter a valid phone number"
            },
            address: {
                pattern: "",
                message: "Please enter the address"
            },
            email: {
                pattern: "^[^@]+@[^@]+\.[^@]+$",
                message: "Please enter a valid email address: (e.g., user@example.com)"
            },
            website: {
                pattern: "^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$",
                message: "Please enter a valid website: (e.g., my.com)"
            },
        };

        let socialsRowNumber = {{ count($social_content) + 1 }};
        let selectedSocialName = "";
        let editSocialId = null;
        let itiInstance = null;
        const $socialItemModalInputClone = $('#socialItemModalInput').prop('outerHTML');

        $(`#openSocialsModal`).click(function () {
            $('#socialsModal').modal('show');
        })

        $(`#closeSocialItemModal`).click(function () {
            $('#socialItemModal').modal('hide');
        })

        // When select a social in socialsModal
        function socialRepeater(linkKey) {
            if ($('#inputrow_socials .social-row').length >= 10) {
                toastrs("", "You can only add up to 10 links.", "error");
                return;
            }
            $('#socialItemModalIcon').attr('src', asset_path + '/' + linkKey.toLowerCase() + '.svg');

            selectedSocialName = linkKey;
            const selected = linkKey.toLowerCase();
            const count = $(`#inputrow_socials .social-link-text`).filter(function () {
                return $(this).text().trim().toLowerCase() === selected;
            }).length;

            if (count >= 2) {
                toastrs("", `Only 2 ${linkKey} same links allowed.`, "error");
                return;
            }
            $('#socialItemModalName').text(selectedSocialName);
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

        const $socialItemModal = $('#socialItemModal');
        $socialItemModal.on('shown.bs.modal', function () {
            const platform = selectedSocialName.toLowerCase();
            const $input = $('#socialItemModalInput');
            if (["whatsapp", "phone"].indexOf(platform) !== -1) {
                // initialize intlTelInput
                itiInstance = window.intlTelInput($input[0], {
                    initialCountry: "auto",
                    nationalMode: true,
                    strictMode: true,
                    geoIpLookup: callback => {
                        fetch("https://ipapi.co/json")
                            .then(res => res.json())
                            .then(data => callback(data.country_code))
                            .catch(() => callback("us"));
                    },
                    loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
                });
            }

            const linkValidator = linkValidators[platform];
            $input.attr("validation-regex", linkValidator.pattern).attr("validation-message", linkValidator.message);
        });

        $socialItemModal.on('hidden.bs.modal', function () {
            if (itiInstance) itiInstance.destroy();
            const $input = $('#socialItemModalInput');
            $input.prop('outerHTML', $socialItemModalInputClone);
        });

        const $socialsSlider = $('.socials-slider');
        const $saveSocialItemBtn = $('#saveSocialItemBtn');

        // Handle Save/Add/Update
        $saveSocialItemBtn.on('click', function () {
            const platform = selectedSocialName.toLowerCase();
            const $input = $('#socialItemModalInput');
            let inputVal = $input.val().trim();
            if (!validateInContainer($socialItemModal)) return false;
            if (["whatsapp", "phone"].indexOf(platform) !== -1) {
                inputVal = itiInstance.getNumber();
                $input.val(inputVal);
            }
            let previewLink = inputVal;
            switch (platform) {
                case "whatsapp":
                case "phone":
                    const cleaned = inputVal.replace(/\D/g, ''); // remove +, dashes, spaces
                    previewLink = (platform === "whatsapp" ? "https://wa.me/" : "tel:") + cleaned;
                    break;

                case "address":
                    previewLink = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(inputVal)}`;
                    break;

                case "email":
                    previewLink = `mailto:${inputVal}`;
                    break;

                case "website":
                    previewLink = `https://${inputVal}`;
                    break;
            }

            if (editSocialId) {
                const editSocialRowSelector = `#${editSocialId}`;
                $(editSocialRowSelector).find('.social-link-href').val(inputVal).trigger('change');
                $(`${editSocialRowSelector}_preview`).attr('href', previewLink).closest('.card-social-link').show();
            } else {
                // Create new card + hidden inputs
                const newSocialDataId = `socials_${socialsRowNumber}`;
                var html = `<div class="col-lg-4 social-row" id="${newSocialDataId}">
                        <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded">
                            <div class="d-flex align-items-center gap-2">
                                <img src="${asset_path}/${selectedSocialName.toLowerCase()}.svg" alt="" class="colored-social-icon">
                                <span class="social-link-text">${selectedSocialName}</span>
                                <input type="hidden" name="socials[${socialsRowNumber}][${selectedSocialName}]" value="${inputVal}" class="social-link-href">
                                <input type="hidden" name="socials[${socialsRowNumber}][id]" value="${socialsRowNumber}">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button"
                                        class="btn-edit-social btn btn-icon rounded-circle p-0">
                                    ${editIcon}
                                </button>
                                <button type="button"
                                    class="btn-remove-social btn btn-icon rounded-circle p-0">
                                    ${deleteIcon}
                                </button>
                            </div>
                        </div>
                    </div>`;

                $('#inputrow_socials').append(html);
                let svgHtml = socialSvgs[platform];
                let newSocialSlide = `
                    <div class="card-social-link">
                        <a href="${previewLink}" target="_blank" class="w-100"
                            id="${newSocialDataId}_preview">
                           ${svgHtml}
                        </a>
                        <p>${selectedSocialName}</p>
                    </div>
                `;
                $socialsSlider.append(newSocialSlide);
                socialsRowNumber++;
            }
            $socialsSlider.show();
            $('#socialItemModal').modal('hide');
        })


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
            if ($('#inputrow_socials .social-row').length === 0) {
                $socialsSlider.hide();
            }
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
                const initialColor = $input.val();

                // Init Pickr
                const pickr = Pickr.create({
                    el: group.find('.color-picker-trigger')[0],
                    theme: 'nano',
                    default: initialColor,
                    swatches: [],
                    components: {
                        preview: true,
                        opacity: false,
                        hue: true,
                        interaction: {
                            hex: true,
                            input: true,
                            save: true
                        }
                    }
                });


                // Apply color via Pickr
                pickr.on('change', (color) => {
                    const hex = color.toHEXA().toString().toLowerCase();
                    $input.val(hex).trigger('input');
                });

                // Apply color via Pickr
                pickr.on('save', (color) => {
                    pickr.hide();
                });

                // Highlight initial selection
                const currentColor = initialColor.toLowerCase();
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

                // Handle swatch click
                group.on('click', '.color-swatch', function () {
                    const selectedColor = $(this).data('color');
                    group.find('.color-swatch, .color-picker-swatch').removeClass('selected');
                    $(this).addClass('selected');
                    $input.val(selectedColor).trigger('input');
                    // ✅ update pickr value
                    pickr.setColor(selectedColor);
                });

                // On input trigger (shared logic)
                $input.on('input', function () {
                    const val = $(this).val().toLowerCase();
                    group.find('.color-swatch, .color-picker-swatch').removeClass('selected');
                    const matchedSwatch = group.find(`.color-swatch[data-color="${val}"]`);
                    if (matchedSwatch.length > 0) {
                        matchedSwatch.addClass('selected');
                    } else {
                        group.find('.color-picker-swatch').addClass('selected');
                    }

                    businessCard.style.setProperty(colorOptions[inputId], val);
                    if (inputId === "card_bg_color") {
                        businessCard.style.setProperty('--custom-section-border-color', getRelativeBorderColor());
                    }
                });
            });
        })
    </script>

    <script id="serviceManagementScript">
        let services_count = {{ count($services_content) + 1 }};
        const bin_icon_primary = `{!! svg('/user_interface/bin_icon_primary.svg') !!}`;
        const $service_list = $(`#serviceList`);
        const $vcard_service_list = $(`#vcardServiceList`);

        $(`#addNewServiceBtn`).click(function () {
            const current_service_row_count = $('.service-row').length;
            if (!validateInContainer($('#serviceList'))) return false;
            const html = `
                <div class="col-md-6 service-row" data-key="${services_count}">
                    <div class="form-group">
                        <div class="d-flex align-items-center mb-2">
                            <label class="form-label mb-0">Service ${current_service_row_count + 1}</label>
                            <button type="button" class="remove-service-row item-management-btn btn btn-icon rounded-circle p-0">
                                ${bin_icon_primary}
                            </button>
                        </div>
                        <input type="text" class="form-control" id="service_title_${services_count}" name="services[${services_count}][title]" validation-required="true" />
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
        $("#is_gallery_enabled").change(function () {
            const enable = $(this).is(":checked");
            const $section = $("#vcard-gallery-section");
            if (enable) $section.show();
            else $section.hide();
        })

        const businessId = {{ $business->id }};
        const galleryPath = "{{ $gallery_path }}";
        const deletePrimaryIcon = `{!! svg('/user_interface/bin_icon_primary.svg') !!}`;
        const imagePlaceholderIcon = `{!! svg('/user_interface/image_placeholder_icon.svg') !!}`;
        const videoPlaceholderIcon = `{!! svg('/user_interface/video_placeholder_icon.svg') !!}`;
        const perRow = window.innerWidth >= 1200 ? 4 : window.innerWidth >= 768 ? 3 : 2;
        const maxImages = 24;
        const maxVideos = 12;
        let imageListSlick = null;
        let videoListSlick = null;
        const fileListSlickConfig = {
            dots: false,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
            ]
        }

        // Gallery Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetchGallery() {
            $.get(`/gallery/${businessId}`, function (items) {
                const images = items.filter(i => ['image', 'custom_image_link'].includes(i.type));
                const videos = items.filter(i => ['video', 'custom_video_link'].includes(i.type));

                renderItems(images, '#galleryPreview', 'image');
                renderItems(videos, '#videoGalleryPreview', 'video');
            });
        }

        function getVideoHTML(url) {
            let html = "";
            if (/\.(mp4|webm|ogg)$/i.test(url)) {
                html = `<video class="w-100 object-fit-cover gallery-card" controls>
                     <source src="${url}" type="video/mp4">
                       Your browser does not support the video tag.
                </video>`;
            } else {
                html += `<iframe src="${url.replace('watch?v=', 'embed/')}" width="100%" height="200" frameborder="0" allowfullscreen></iframe>`
            }
            return html;
        }

        function renderItems(items, targetSelector, mode) {
            const $target = $(targetSelector).empty();
            items.forEach(i => {
                let path = i.value;
                if (["image", "video"].indexOf(i.type) !== -1) {
                    path = `${galleryPath}/${path}`;
                }
                let html = `<div class="col-6 col-md-4 col-xl-3">`;
                if (mode === "image") {
                    html += `
                        <div class="gallery-card bg-secondary position-relative rounded-3 overflow-hidden d-flex justify-content-center align-items-center">
                            <img src="${path}" class="gallery-image w-100 h-100 object-fit-cover" alt="Gallery Image">
                            <button type="button" class="remove-gallery item-management-btn btn btn-icon rounded-circle position-absolute top-0 end-0 m-1 border-0" data-id="${i.id}">
                                ${deletePrimaryIcon}
                            </button>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="gallery-card position-relative rounded-3 overflow-hidden">
                            ${getVideoHTML(path)}
                            <button type="button" class="remove-gallery item-management-btn btn btn-icon rounded-circle position-absolute top-0 end-0 m-1 border-0" data-id="${i.id}">
                                ${deletePrimaryIcon}
                            </button>
                        </div>
                    `
                }
                html += `</div>`;
                $target.append(html);

            });
            const maxItems = mode === 'image' ? maxImages : maxVideos;

            // Add placeholders
            const remain = perRow - items.length % perRow;
            const $addMorePlaceholdersBtn = $(`.add-more-placeholders[data-mode="${mode}"]`);
            $addMorePlaceholdersBtn.addClass('invalid')
            if ([0, perRow].indexOf(remain) === -1 || items.length === 0) {
                for (let i = 0; i < remain; i++) {
                    $target.append(`
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="file-placeholder gallery-card bg-secondary w-100 rounded-3 d-flex justify-content-center align-items-center cursor-pointer" data-mode="${mode}">
                                ${mode === "image" ? imagePlaceholderIcon : videoPlaceholderIcon}
                            </div>
                        </div>
                    `);
                }
            } else if (items.length !== maxItems) {
                $addMorePlaceholdersBtn.removeClass('invalid');
            }

        }

        $(document).ready(fetchGallery);

        // Upload trigger
        $(document).on('click', '.file-placeholder', function () {
            const _this = $(this);
            const mode = _this.data('mode');
            if (mode === "image") {
                $('#addGalleryModal').modal('show');
                $(`input[name="galleryoption"][value="image"]`).prop('checked', true).trigger('change');
            } else {
                $('#addVideoModal').modal('show');
                $(`input[name="galleryoption"][value="video"]`).prop('checked', true).trigger('change');
            }
        });

        // Upload trigger
        $(document).on('click', '.add-more-placeholders', function () {
            const $this = $(this);
            const mode = $this.data('mode');
            if ($this.hasClass('invalid')) {
                toastrs("", `Please fill all the existing ${mode}s`, "error");
                return false;
            }
            const $target = $(mode === "image" ? "#galleryPreview" : "#videoGalleryPreview");
            for (let i = 0; i < perRow; i++) {
                $target.append(`
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="file-placeholder gallery-card bg-secondary w-100 rounded-3 d-flex justify-content-center align-items-center cursor-pointer" data-mode="${mode}">
                            ${mode === "image" ? imagePlaceholderIcon : videoPlaceholderIcon}
                        </div>
                    </div>
                `);
            }
            $this.addClass('invalid');
        });

        // Switch between Image and Custom Image
        $('#addGalleryModal input.gallery_mode').on('change', function () {
            const selected = $(this).val();
            $('.upload-image-div, .custom-image-div').addClass('d-none');
            if (selected === 'image') {
                $('.upload-image-div').removeClass('d-none');
            } else {
                $('.custom-image-div').removeClass('d-none');
            }
            $('#addGalleryModal .gallery-option').removeClass('btn-primary').addClass('btn-white');
            $(this).closest('.gallery-option').removeClass('btn-white').addClass('btn-primary');
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

        function resetPreview() {
            $('#gallery_img_preview').attr('src', '#').parent().addClass('d-none');
        }

        // Save Image
        $('#saveGalleryModal').on('click', function () {
            const mode = $('#addGalleryModal input[name="galleryoption"]:checked').val();
            const formData = new FormData();
            formData.append('business_id', businessId);
            formData.append('galleryoption', mode);

            if (mode === 'image') {
                if (!validateInContainer($('.upload-image-div'))) return false;
                const file = $('#upload_image_modal')[0].files[0];
                formData.append('file', file);
            } else {
                if (!validateInContainer($('.custom-image-div'))) return false;
                const url = $('#custom_image_link_modal').val().trim();
                formData.append('link', url);
            }

            setLoadingState($(this));
            $.ajax({
                url: '/gallery/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: () => {
                    setLoadingState($(this), false);
                    $('#addGalleryModal').modal('hide');
                    fetchGallery();
                },
                error: (xhr) => {
                    setLoadingState($(this), false);
                    toastrs('', xhr.responseJSON?.error || 'Failed to save item', 'error');
                }
            });
        });

        $('#addGalleryModal').on('hidden.bs.modal', function () {
            $('#addGalleryModal input:not([name="galleryoption"])').val('');
            $('#upload_image_modal').val('');
            resetPreview();
        });

        $(document).on('click', '.remove-gallery', function () {
            $(this).prop('disabled', true);
            $.post('/business/destroy', {id: $(this).data('id'), business_id: businessId}, fetchGallery);
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
                $('#addVideoModal .gallery-option').removeClass('btn-primary').addClass('btn-white');
                $(this).closest('.gallery-option').removeClass('btn-white').addClass('btn-primary');
            });

            // Preview uploaded video
            $('#upload_video_modal').on('change', function () {
                const file = this.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    $('#iframePlayer').hide().removeAttr('src');
                    $('#videoPreview').show().attr('src', url);
                    $('.preview-video').removeClass('d-none');
                }
            });

            // Preview custom video link
            $('#custom_video_link_modal').on('input', function () {
                const url = $(this).val();
                if (url) {
                    const isVideoFile = /\.(mp4|webm|ogg)$/i.test(url);
                    if (isVideoFile) {
                        $('#iframePlayer').hide().removeAttr('src');
                        $('#videoPreview').show().attr('src', url);
                    } else {
                        const embedUrl = url.replace('watch?v=', 'embed/');
                        $('#videoPreview').hide().removeAttr('src');
                        $('#iframePlayer').show().attr('src', embedUrl);
                    }
                    $('.preview-video').removeClass('d-none');
                }
            });

            // Save Video
            $('#saveVideoModal').on('click', function () {
                const mode = $('#addVideoModal input[name="galleryoption"]:checked').val();
                const formData = new FormData();
                formData.append('business_id', businessId);
                formData.append('galleryoption', mode);

                if (mode === 'video') {
                    if (!validateInContainer($('.upload-video-div'))) return false;
                    const file = $('#upload_video_modal')[0].files[0];
                    formData.append('file', file);
                } else {
                    if (!validateInContainer($('.custom-video-div'))) return false;
                    const url = $('#custom_video_link_modal').val().trim();
                    formData.append('link', url);
                }

                setLoadingState($(this));
                $.ajax({
                    url: '/gallery/store',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: () => {
                        setLoadingState($(this), false);
                        $('#addVideoModal').modal('hide');
                        fetchGallery();
                    },
                    error: (xhr) => {
                        setLoadingState($(this), false);
                        toastrs('', xhr.responseJSON?.error || 'Failed to save item', 'error');
                    }
                });
            });

            // Cancel: reset fields & preview
            $('#addVideoModal').on('hidden.bs.modal', function () {
                $('#upload_video_modal').val('');
                $('#custom_video_link_modal').val('');
                $('#videoPreview, #iframePlayer').hide().removeAttr('src');
                $('.upload-video-div, .custom-video-div, .preview-video').addClass('d-none');
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

    <script id="contactSharePreviewManagementScript">
        $(function () {
            const $is_auto_contact_popup_enabled = $('#is_auto_contact_popup_enabled');
            const $modal = $('#shareContactModalPreview');
            const $text = $('#isAutoContactPopupText');
            if ($is_auto_contact_popup_enabled.is(":checked")) $modal.addClass('d-block');

            // 1. Toggle modal visibility based on popup switch
            $is_auto_contact_popup_enabled.on('change', function () {
                const enable = $(this).is(":checked");
                if (enable) {
                    $modal.addClass('d-block');
                    $text.text("ON");
                } else {
                    $modal.removeClass('d-block');
                    $text.text("OFF");
                }
            });

            // 2. Field toggle logic
            const fields = ['name', 'phone', 'email', 'company', 'job_title', 'notes'];

            fields.forEach(field => {
                const enabledSelector = `input[name="is_${field}_enabled"]`;
                const requiredSelector = `input[name="is_${field}_required"]`;
                const previewFieldSelector = `#shareContactModalPreview [name="${field === 'notes' ? 'message' : field}"]`;

                function updateFieldVisibility() {
                    const isEnabled = $(enabledSelector).is(':checked');
                    const isRequired = $(requiredSelector).is(':checked');
                    const $input = $(previewFieldSelector);

                    if (isEnabled) {
                        $input.closest('.form-control, textarea').show();
                        if (isRequired) {
                            $input.attr('required', 'required');
                        } else {
                            $input.removeAttr('required');
                        }
                    } else {
                        $input.closest('.form-control, textarea').hide();
                        $input.removeAttr('required');
                    }
                }

                // Init on load
                updateFieldVisibility();

                // Bind change events
                $(enabledSelector + ',' + requiredSelector).on('change', updateFieldVisibility);
            });

            $('#shareContactModalPreview .btn-close').click(function () {
                $modal.removeClass('d-block');
            })
        });


    </script>

    <script id="qrCodeManagementScript">
        let qrCode;

        function generate_qr() {
            const imgSrc = $(`#qrcode_image`).attr('src');
            qrCode = new QRCodeStyling(
                {
                    width: 162,
                    height: 162,
                    type: "svg",
                    data: "{{ route('get.vcard',[$business->slug]) }}",
                    margin: 0,
                    image: imgSrc !== "{{ $imagePlaceholderUrl }}" ? imgSrc : "{{ $siteLogo }}",
                    imageOptions: {
                        imageSize: 0.4,
                        margin: 0,
                        hideBackgroundDots: true,
                        saveAsBlob: true,
                    },
                    dotsOptions: {
                        color: $('#qrcode_foreground_color').val(),
                        type: "dots",
                        roundSize: true
                    },
                    backgroundOptions: {
                        color: "#ffffff"
                    },
                    cornersSquareOptions: {
                        type: "extra-rounded"
                    },
                    cornersDotOptions: {
                        type: "dot"
                    },
                }
            );
            const $code = $('.code');
            $code.empty();
            qrCode.append($code[0]);
        }

        $(function () {
            setTimeout(function () {
                generate_qr();
            }, 1000);
        })

        $('.qr-data').on('change', function () {
            generate_qr();
        });

        $(document).on('input', '#qrcode_foreground_color', function () {
            generate_qr();
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
            $('#pills-tab .nav-item').click(function () {
                const edit_tab_key = $(this).data('key');
                $('#edit_tab_key').val(edit_tab_key);
            })
            const $form = $('#updateBusinessForm');
            const original = $form.serialize(); // Save initial form state
            const cancelSaveButtonSelectors = ".reset-form, .submit-form, .sticky-bottom-bar"
            $(cancelSaveButtonSelectors).hide();

            function checkFormChanged() {
                const current = $form.serialize();
                const fileChanged = $form.find('input[type="file"]').toArray().some(input => input.files.length > 0);
                if (current !== original || fileChanged) {
                    $(cancelSaveButtonSelectors).show();
                } else {
                    $(cancelSaveButtonSelectors).hide();
                }
            }

            $form.on('input change', 'input, textarea, select', function () {
                checkFormChanged();
            });
            const observer = new MutationObserver(checkFormChanged);
            observer.observe($form[0], {
                childList: true,
                subtree: true,
            });


            $('.reset-form').on('click', function () {
                $form[0].reset(); // Reset form
                $form.find('input, textarea, select').each(function () {
                    this.dispatchEvent(new Event('change', {bubbles: true}));
                });
                $form.find('input[type="color"]').each(function () {
                    this.dispatchEvent(new Event('input', {bubbles: true}));
                });
            });
        });
    </script>

    <script id="formValidationScript">
        function showValidationTooltip($input, message) {
            removeValidationTooltip($input);

            $input
                .addClass('is-invalid')
                .attr('data-bs-toggle', 'tooltip')
                .attr('data-bs-placement', 'top')
                .attr('title', message);

            // Initialize Bootstrap tooltip
            const tooltip = new bootstrap.Tooltip($input[0]);
            tooltip.show();

            // Store reference for later removal
            $input.data('bs.tooltip-instance', tooltip);
        }

        function removeValidationTooltip($input) {
            $input.removeClass('is-invalid');

            // Destroy existing tooltip if any
            const tooltip = $input.data('bs.tooltip-instance');
            if (tooltip) {
                tooltip.dispose();
                $input.removeData('bs.tooltip-instance');
            }

            $input.removeAttr('data-bs-toggle data-bs-placement title');
        }

        function validateInput($input) {
            const val = $input.val().trim();
            const required = $input.attr('validation-required') === 'true';
            const pattern = $input.attr('validation-regex');
            const message = $input.attr('validation-message') || 'Please fill out this field';

            let isValid = true;

            if (required && !val) {
                isValid = false;
            } else if (val) {
                if (["url", "file"].indexOf($input.attr('type')) !== -1) {
                    isValid = $input[0].checkValidity();
                } else if (pattern) {
                    isValid = new RegExp(pattern).test(val);
                }
            }

            if (!isValid) {
                showValidationTooltip($input, message);
            } else {
                removeValidationTooltip($input);
            }

            return isValid;
        }

        function validateInContainer($container) {
            const $fields = $container.find('[validation-required], [validation-regex]');
            for (let i = 0; i < $fields.length; i++) {
                const $input = $($fields[i]);
                if (!validateInput($input)) {
                    $input.focus(); // optional
                    return false;
                }
            }
            return true;
        }

        $(document).on('input blur', '[validation-required], [validation-regex]', function () {
            validateInput($(this));
        });
    </script>

    <script id="submitFormScript">
        function delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }


        $('.submit-form').click(function () {
            $(`#updateBusinessForm`).submit();
        })

        let isSubmitting = false;

        $('#updateBusinessForm').off('submit').on('submit', async function (e) {
            e.preventDefault();
            if (isSubmitting) return;
            isSubmitting = true;

            const $form = $(this);
            const banner_val = '{{$business->banner}}';
            const logo_val = '{{$business->logo}}';
            const $currentTab = $('.tab-pane.active');

            if ($currentTab.attr('id') === "details-setting") {
                if (!banner_val && !logo_val) {
                    var logo = $('input[name=logo]')[0].files[0];
                    if (!logo) {
                        toastrs("", "Profile Picture is required", "error");
                        isSubmitting = false;
                        return;
                    }

                    var banner = $('input[name=banner]')[0].files[0];
                    if (!banner) {
                        toastrs("", "Cover Photo is required", "error");
                        isSubmitting = false;
                        return;
                    }
                }
            }

            if (!validateInContainer($currentTab)) {
                isSubmitting = false;
                return;
            }

            setLoadingState($('.submit-form'), true);
            $('#edit_tab_key').attr('name', 'edit_tab_key');
            await delay(10);
            $form.off('submit').submit();
        });


    </script>

    <script id="crossDevicePreviewManagementScript">
        $(function () {
            $('#openPreviewOnTabletMobile').click(function () {
                if (window.innerWidth >= 768) {
                    const offcanvas = bootstrap.Offcanvas.getOrCreateInstance('#previewOnTablet');
                    offcanvas.show();
                } else {
                    const modal = bootstrap.Modal.getOrCreateInstance('#previewOnMobile');
                    modal.show();
                }
            })

            $('#closeCardPreviewModalBtn').click(function () {
                $('#previewOnMobile').modal('hide');
            })
        })


        function relocateCustomBox() {
            const $box = $('.custom-box');
            const $previewOnDesktop = $('#previewOnDesktop');
            const $previewOnTabletBody = $('#previewOnTabletBody');
            const $previewOnMobileBody = $('#previewOnMobileBody');

            // Ensure modal/offcanvas are hidden
            const modal = bootstrap.Modal.getInstance('#previewOnMobile');
            if (modal) modal.hide();

            const offcanvas = bootstrap.Offcanvas.getInstance('#previewOnTablet');
            if (offcanvas) offcanvas.hide();

            if (window.innerWidth >= 1200) {
                // Move to original
                if (!$previewOnDesktop.has($box).length) {
                    $previewOnDesktop.append($box);
                }

            } else if (window.innerWidth >= 768) {
                // Move to offcanvas
                if (!$previewOnTabletBody.has($box).length) {
                    $previewOnTabletBody.append($box);
                }


            } else {
                // Move to modal
                if (!$previewOnMobileBody.has($box).length) {
                    $previewOnMobileBody.append($box);
                }

            }
        }

        $(document).ready(() => relocateCustomBox());
        $(window).on('resize', () => relocateCustomBox());
    </script>

@endpush
