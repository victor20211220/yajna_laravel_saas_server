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

@endphp
@extends('layouts.new-client')
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
                <div
                    class="d-flex align-items-center justify-content-between ms-auto gap-3 mb-0">
                    <button type="reset" id="resetUpdateBusinessForm" class="btn d-none d-xl-block">
                        {{__('Unsaved Changes')}}
                    </button>
                    <button type="button" class="btn btn-dark d-none d-xl-block" id="submitUpdateBusinessForm">
                        {{__('Save Changes')}}
                    </button>
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
                <div class="card-header bg-white sticky-top z-0 z-1 border-bottom">
                    <!-- Tab Container: fixed on scroll -->
                    <ul class="nav nav-pills nav-fill gap-2" id="pills-tab" role="tablist">
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
                                                <span class="mb-2" style="color: #9D9DA1;">Drag file for upload or</span><br/>
                                                <button type="button"
                                                        onclick="selectFile('banner')"
                                                        class="btn btn-primary btn-sm">{{ __('Select Files') }}</button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if($isProClient)
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
                                            {!! Form::text('phone', $business->phone, ['class' => 'form-control', 'id' => $business_id . '_phone']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
                                            {!! Form::text('address', $business->address, ['class' => 'form-control', 'id' => $business_id . '_address']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                            {!! Form::email('email', $business->email, ['class' => 'form-control', 'id' => $business_id . '_email']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('website', __('Website'), ['class' => 'form-label']) }}
                                            {!! Form::url('website', $business->website, ['class' => 'form-control', 'id' => $business_id . '_website']) !!}
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
                                    'value' => old('card_bg_color', $business->card_bg_color ?? '#FFFFFF'),
                                    'colors' => ['#222222', '#FFB3B2', '#FAB5C9', '#FDD4B3', '#FEEBB3', '#B6F9DF', '#B8EBF7', '#B7CFF9', '#CCB6FA'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'button_bg_color',
                                    'label' => 'Button Colour',
                                    'value' => old('button_bg_color', $business->button_bg_color ?? '#1570FD'),
                                    'colors' => ['#000000', '#FF3C39', '#F55381', '#FC8E3A', '#F4B813', '#06C27C', '#18BCE8', '#296DEE', '#9163F6'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'card_text_color',
                                    'label' => 'Card Text',
                                    'value' => old('card_text_color', $business->card_text_color ?? '#171717'),
                                    'colors' => ['#FFFFFF', '#000000', '#FF0C02', '#F60946', '#FC8E3A', '#F4B813', '#18BCE8', '#18BCE8', '#175BFD'],
                                ])
                                @include('components.color-selector', [
                                    'id' => 'button_text_color',
                                    'label' => 'Button Text',
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
                                                             style="max-height: 200px;">
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
                            <section>
                                <div class="section-title">Lead Capture</div>
                                <div>Collect and exchange contact info</div>
                                <div class="mb-4 pb-2"></div>
                                <div class="bg-secondary rounded p-4 mb-4">
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
                                                    class="d-flex flex-column flex-md-row gap-3 justify-content-between align-items-center border rounded px-3 py-2 bg-white">
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
                                <div class="fw-semibold">Contact Info</div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{__('Allow leads to download your contact info directly on their phones')}}</div>
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
                                        <input type="hidden" class="qr-data" name="qrcode_type" id="qrCodeType"
                                               value="{{$qr_detail && $qr_detail->qr_type ? $qr_detail->qr_type : 0}}"/>
                                        <div id="qr_type_option">
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
                                                     src="{{ $qr_detail && $qr_detail->image ? $qr_path.'/'.  $qr_detail->image: "" }}"
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
                                            <div class="text-14 fst-italic">Lead capture mode is ON</div>
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
                    <button type="reset" class="btn btn-secondary">Cancel</button>
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
                        <input type="url" class="form-control" id="socialItemModalInput"
                               placeholder="Enter your link"
                               required>
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
    <script src="{{ asset('custom/js/jquery.qrcode.min.js') }}"></script>
    <script type="text/javascript">
        var asset_path = `{{ asset('assets/images/icons/user_interface/socials/') }}`

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

        $('.cp_link').on('click', function () {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('{{ __('Success') }}', '{{ __('Link Copy on Clipboard') }}', 'success');
        });
        $('#pills-tab .nav-item').click(function () {
            const edit_tab_key = $(this).data('key');
            console.log(`edit_tab_key:`, edit_tab_key);
            $('#edit_tab_key').val(edit_tab_key);
        })

        $('[data-id="openShareCardModalOnFormBtn"]').click(function () {
            $('#shareCardModalOnForm').modal('show');
        })

    </script>

    <script id="livePreviewScript">
        const getPreviewElement = (element) => {
            return $(`#${element.attr('id')}_preview`)
        }
        //input change
        $(document).on('keyup', 'input', function () {
            const _this = $(this);
            if (_this.attr('id') === "{{ $business_id }}_google_review_link") {
                getPreviewElement(_this).attr('href', `${_this.val()}`);
            } else {
                getPreviewElement(_this).text(_this.val());
            }
        });

        // company
        $(document).on('keyup', '#{{ $business_id }}_subtitle', function () {
            const _this = $(this);
            const connector = $('#title_sub_title_connector');
            if (_this.val() === "") {
                connector.addClass('d-none');
            } else {
                if (connector.hasClass('d-none')) {
                    connector.removeClass('d-none');
                }
            }
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
    </script>

    <script id="socialManagementScript">
        const socialSvgs = {
            @foreach ($businessfields as $key)
            "{{ strtolower($key) }}": `{!! svg('vcard/socials/' . strtolower($key) . '.svg', ['class' => 'w-100 h-100']) !!}`,
            @endforeach
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

        // Handle Save/Add/Update
        $('#saveSocialItemBtn').on('click', function () {
            const form = $('#socialItemForm')[0];
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            const inputVal = $('#socialItemModalInput').val();
            if (editSocialId) {
                const editSocialRowSelector = `#${editSocialId}`;
                $(editSocialRowSelector).find('.social-link-href').val(inputVal);
                $(`${editSocialRowSelector}_preview`).attr('href', inputVal);
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

                let svgHtml = socialSvgs[selectedSocialName.toLowerCase()];
                let newSocialSlide = `
                    <a href="${inputVal}" target="_blank" class="card-social-link"
                        id="${newSocialDataId}_preview">
                       ${svgHtml}
                    </a>`;
                $('.socials-slider').slick('slickAdd', newSocialSlide);

                socials_row_no++;
            }

            $('#socialItemModal').modal('hide');
        });


        // When select a social in socialsModal
        function socialRepeater(el) {
            selectedSocialIcon = asset_path + '/' + el.toLowerCase() + '.svg';
            $('#socialItemModalIcon').attr('src', selectedSocialIcon);

            selectedSocialName = el;
            $('#socialItemModalName').text(selectedSocialName);

            $('#socialItemModalInput').val('');
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
            const $socialRow = $(this).closest('.social-row');
            editSocialId = $socialRow.attr('id');

            const selectedSocialName = $socialRow.find('.social-link-text').text();
            $('#socialItemModalIcon').attr('src', asset_path + '/' + selectedSocialName.toLowerCase() + '.svg');
            $('#socialItemModalName').text(selectedSocialName);

            const link = $socialRow.find('.social-link-href').val();
            $('#socialItemModalInput').val(link);

            $('#saveSocialItemBtn').text('Update');
            $('#socialItemModal').modal('show');
        });

        // Handle Delete Button
        $(document).on('click', '.btn-remove-social', function () {
            const $socialRow = $(this).closest('.social-row');
            $('.socials-slider').slick('slickRemove', $socialRow.index());
            $socialRow.remove();
        });

    </script>

    <script id="colorManagementScript">
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
            });
        });
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
            var $input = $(this);
            var enable = $input.is(":checked");
            $("#vcard-services-section").toggleClass('d-none');
        })
    </script>

    <script id="galleryManagementScript">

        $("#is_gallery_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            $('#vcard-gallery-section').toggleClass('d-none');
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

        function selectNormalFile(targetId) {
            $(`.${targetId}`).trigger('click');
        }

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


    </script>

    <script id="featuredVideosManagementScript">
        $("#is_video_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            $('#vcard-featured-videos-section').toggleClass('d-none');
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
    </script>

    <script id="googleReviewManagementScript">
        $("#google_review_enabled").change(function () {
            var $input = $(this);
            var enable = $input.is(":checked");
            $('#vcard-google-review-section').toggleClass('d-none');
        });


    </script>

    <script id="qrCodeScript">
        function generate_qr() {
            $('.code').empty().qrcode({
                render: 'image',
                size: 162,
                ecLevel: "H",
                minVersion: 3,
                quiet: 1,
                text: "{{ env('APP_URL').'/'.$business->slug }}",
                fill: $(`#qrcode_foreground_color`).val(),
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

        $(document).on('input', '#qrcode_foreground_color', function () {
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
                    toastrs("", "Profile Picture is required", "error");
                    return false;
                }

                var banner = $('input[name=banner]')[0].files[0];
                if (!banner) {
                    toastrs("", "Cover Photo is required", "error");
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
@endpush
