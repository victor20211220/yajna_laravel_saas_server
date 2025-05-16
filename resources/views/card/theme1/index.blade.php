@php
    use App\Models\Utility;
    $isProClient = Utility::isProClient($business->id);
    $isSelfUser = auth()->check() && auth()->id() === $business->created_by;
    $isOnEditFormPage = Route::currentRouteName() === 'business.edit';
@endphp
@extends('card.layouts')
@section('contentCard')
    <div class="business-card position-absolute top-0 start-50 translate-middle-x z-10 custom-rounded-34 display-none"
         id="businessCard">
        @if($isSelfUser && !$isOnEditFormPage)
            <a href="{{ route('home') }}" class="position-absolute top-0 start-0 m-4 z-1" id="backToPageOnCardArrow">
                <i class="bi bi-arrow-left-circle text-white"></i>
            </a>
        @endif

        {!! svg('vcard/top_corner_share.svg', ['class' => 'position-absolute top-0 end-0 m-4 z-1', 'id' => 'openShareCardModalBtn']) !!}
        <div class="cover-photo w-100 position-relative">
            <img src="{{ $business->banner ? $banner . '/' . $business->banner : "/assets/images/white-blank.png" }}"
                 alt="cover-photo"
                 class="object-fit-cover w-100 h-100" id="banner_preview">
            <div class="overlay position-absolute top-0 bottom-0 start-0 end-0"></div>
        </div>


        <!-- Profile Image -->
        <div class="text-center position-relative" id="card_logos">
            <img src="{{ $business->logo ? $logo . '/' . $business->logo : Utility::imagePlaceholderUrl() }}"
                 alt="profile-picture" class="rounded-circle border border-color-custom border-4"
                 id="business_logo_preview">
            @php $business_company_logo = $business->company_logo; @endphp
            <img src="{{ $business_company_logo ? $company_logo . '/' . $business_company_logo : "" }}"
                 class="rounded-circle border border-color-custom border-4 position-absolute {{ $business_company_logo ? "": "d-none" }}"
                 alt="company-logo" id="business_company_logo_preview">
        </div>

        <!-- Name, Title, Company -->
        <section class="text-center pt-3">
            @php $business_title = $business->title @endphp
            <div class="title fw-medium mb-3"
                 id="{{ $stringid . '_title' }}_preview" {!! Utility::hideEmptyCardElement($business_title) !!}>{{ $business_title }}</div>

            @php
                $designation = $business->designation;
                $sub_title = $business->sub_title;
            @endphp
            <div class="display-flex justify-content-center align-items-center gap-2 mb-4 pb-2"
                 id="roleAndCompanyOnVcard" {!! Utility::hideEmptyCardElement([$designation, $sub_title], "and") !!}>
                <div id="{{ $stringid . '_designation' }}_preview" {!! Utility::hideEmptyCardElement($designation) !!}>
                    {{ $designation}}
                </div>
                <div id="title_sub_title_connector" {!! Utility::hideEmptyCardElement([$designation, $sub_title]) !!}>
                    ·
                </div>
                <div id="{{ $stringid . '_subtitle' }}_preview"
                     class="button-bg-color" {!! Utility::hideEmptyCardElement($sub_title) !!}>{{ $sub_title }}</div>
            </div>

            @php $description = $business->description @endphp
            <div id="{{ $stringid . '_desc' }}_preview"
                 {!! Utility::hideEmptyCardElement($description) !!}  class="mb-4 pb-2">
                {!! nl2br(e($description)) !!}
            </div>
            <!-- Social Icons Slider -->
            <div
                class="socials-slider mb-4 pb-2" {!! Utility::isInitialSocials($social_content) ? "style=\"display:none;\"": ""!!}>
                @if (count($social_content))
                    @foreach ($social_content as $id => $social_item)
                        @foreach ($social_item as $key => $social_val)
                            @php
                                if($key === "id") continue;
                                $link = $social_val;
                                $platform = strtolower($key);
                                if($social_val){
                                    if ($platform === 'whatsapp') {
                                        // Remove non-digits from the number
                                        $digitsOnly = preg_replace('/\D/', '', $social_val);
                                        $link = 'https://wa.me/' . $digitsOnly;
                                    } elseif (!preg_match('/^https?:\/\//i', $link)) {
                                        $link = url($link);
                                    }
                                }
                            @endphp
                            <a href="{{ $link }}" target="_blank" class="card-social-link"
                               id="{{ 'socials_' . $id . '_preview' }}" {!! Utility::hideEmptyCardElement($social_val) !!}>
                                {!! svg('vcard/socials/'.$platform.'.svg', ['class' => 'w-100 h-100']) !!}
                            </a>
                        @endforeach
                    @endforeach
                @endif
            </div>

            <div class="d-flex justify-content-center gap-3" id="save-share-contact-buttons">
                <a href="{{ route('bussiness.save', $business->slug) }}"
                   class="btn button-bg button-color rounded-pill flex-grow-1 d-flex justify-content-center align-items-center gap-2 py-2"
                   id="save-contact-on-vcard">
                    {!! svg('vcard/save_contact.svg', ['class' => 'fill-button-color']) !!}
                    Save Contact
                </a>
                <button id="openShareContactModalBtn"
                        class="btn text-bg text-bg base-color rounded-pill flex-grow-1 d-flex justify-content-center align-items-center gap-2 py-2">
                    {!! svg('vcard/share_contact.svg', ['class' => 'fill-base-color']) !!}
                    Share Contact
                </button>
            </div>
        </section>

        <!-- Contact -->
        @php
            $phone = $business->phone;
            $address = $business->address;
            $email = $business->email;
            $website = $business->website;
        @endphp
        <section
            id="contact-section" {!! Utility::hideEmptyCardElement([$phone, $address, $email, $website], "and") !!}>
            <div class="section-title">Contact</div>
            <div class="mb-4 pb-2"></div>
            <div
                class="display-flex justify-content-start align-items-center gap-3 mb-3" {!! Utility::hideEmptyCardElement($phone) !!}>
                {!! svg('vcard/phone.svg') !!}
                <a id="{{ $stringid . '_phone' }}_preview" href="tel:{{ $phone }}">
                    {{ $phone }}
                </a>
            </div>
            <div
                class="display-flex justify-content-start align-items-center gap-3 mb-3" {!! Utility::hideEmptyCardElement($address) !!}>
                {!! svg('vcard/address.svg') !!}
                <a id="{{ $stringid . '_address' }}_preview"
                   href="https://www.google.com/maps/search/?api=1&query={{ urlencode($address) }}"
                   target="_blank">
                    {{ $address }}
                </a>
            </div>
            <div
                class="display-flex justify-content-start align-items-center gap-3 mb-3" {!! Utility::hideEmptyCardElement($email) !!}>
                {!! svg('vcard/email.svg') !!}
                <a id="{{ $stringid . '_email' }}_preview" href="mailto:{{ $email }}">
                    {{ $email }}
                </a>
            </div>
            <div
                class="display-flex justify-content-start align-items-center gap-3 mb-3" {!! Utility::hideEmptyCardElement($website) !!}>
                {!! svg('vcard/website.svg') !!}
                <a id="{{ $stringid . '_website' }}_preview"
                   href="https://{{ $website }}"
                   target="_blank">
                    {{ $website }}
                </a>
            </div>
        </section>

        @if($isProClient)
            <section id="vcard-services-section" {!! Utility::hideSection(isset($services['is_enabled']) && $services['is_enabled']) !!}>
                <div class="section-title">Services</div>
                <div class="mb-4 pb-2"></div>
                @php $service_key = 1; @endphp
                <div class="row" id="vcardServiceList">
                    @foreach ($services_content as $service_content)
                        <div class="col-6 vcard-service-row mb-2 pb-1" data-key="{{ $service_key }}">
                            <div class="btn button-bg rounded-pill w-100">
                                <div id="{{ 'service_title_' . $service_key }}_preview" class="button-color">
                                    {{ $service_content->title }}
                                </div>
                            </div>
                        </div>
                        @php $service_key++; @endphp
                    @endforeach
                </div>
            </section>

            <section id="vcard-gallery-section" {!! Utility::hideSection(isset($gallery['is_enabled']) && $gallery['is_enabled']) !!}>
                <div class="section-title">Gallery</div>
                <div class="mb-4 pb-2"></div>
                <div class="gallery-slider invisible">
                    @foreach ($gallery_contents as $gallery_content)
                        @if(in_array($gallery_content->type, ['image', 'custom_image_link']))
                            @php $url = $gallery_content->type === 'image' ? $gallery_path . '/' . $gallery_content->value : $gallery_content->value; @endphp
                            <div class="gallery-slide-wrapper">
                                <img src="{{ $url }}" class="gallery-slide-image" alt="Gallery" data-full="{{ $url }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>

            <section id="vcard-featured-videos-section" {!! Utility::hideSection(isset($gallery['is_video_enabled']) && $gallery['is_video_enabled']) !!}>
                <div class="section-title">Featured Video</div>
                <div class="mb-4 pb-2"></div>
                <div class="video-slider invisible">
                    @foreach ($gallery_contents as $gallery_content)
                        @if(in_array($gallery_content->type, ['video', 'custom_video_link']))
                            @php
                                $url = $gallery_content->type === 'video'
                                    ? $gallery_path . '/' . $gallery_content->value
                                    : $gallery_content->value;
                            @endphp

                            <div class="video-slide-wrapper position-relative">
                                <video class="video-slide-thumb" data-full="{{ $url }}" muted playsinline
                                       preload="metadata">
                                    <source src="{{ $url }}" type="video/mp4">
                                </video>
                                {!! svg('vcard/video_play.svg', ['class' => 'video-play-overlay']) !!}
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
            <section id="vcard-google-review-section"
                     class="pb-0 px-5 border-0" {!! Utility::hideSection($business['google_review_enabled']) !!}>
                <div class="d-flex justify-content-center gap-2">
                    {!! svg('vcard/google_review_star.svg', ['class' => 'fill-button-bg']) !!}
                    {!! svg('vcard/google_review_star.svg', ['class' => 'fill-button-bg']) !!}
                    {!! svg('vcard/google_review_star.svg', ['class' => 'fill-button-bg']) !!}
                    {!! svg('vcard/google_review_star.svg', ['class' => 'fill-button-bg']) !!}
                    {!! svg('vcard/google_review_star.svg', ['class' => 'fill-button-bg']) !!}
                </div>
                <div class="mb-2 pb-1"></div>
                <a href="{{ $business->google_review_link }}" id="{{ $stringid . '_google_review_link' }}_preview"
                   target="_blank"
                   class="btn button-bg rounded-pill d-flex justify-content-center px-4 gap-3 align-items-center m-0">
                <span class="button-color-bg d-block rounded-circle m-0" id="google-icon-div">
                    {!! svg('vcard/google_icon.svg') !!}
                </span>
                    <span class="button-color text-start">Leave us a review on Google!</span>
                </a>
            </section>
        @endif
        <section class="border-0 pb-0">
            <a class="mt-4 mt-xl-2 mb-4" href="{{ url('/') }}">
                {!! svg('logo.svg', ['class' => 'fill-text-color mx-auto d-block', 'id' => 'vcard-logo']) !!}
            </a>
        </section>
    </div>

    <div class="modal fade vcard-modal" id="imageViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <!-- Modal Header with Close Button -->
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body with Image -->
                <div class="modal-body p-0">
                    <img src="#" alt="Preview" class="img-fluid w-100 rounded-bottom" id="imageViewerModalImg">
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade vcard-modal" id="videoViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <video id="modalVideoPlayer" class="w-100 rounded-bottom" controls autoplay>
                        <source id="modalVideoSource" src="" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade vcard-modal" id="shareContactModal" tabindex="-1" aria-labelledby="shareContactModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold mx-auto" id="shareContactModalLabel">Share Contact</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($business->shareContactField)
                        <form method="POST" action="{{ route('contacts.store') }}">
                            @csrf
                            <div class="d-grid gap-3 mb-4">

                                @if ($business->shareContactField->is_name_enabled)
                                    <input type="text" name="name"
                                           class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                           placeholder="Name"
                                           @if($business->shareContactField->is_name_required) required @endif>
                                @endif

                                @if ($business->shareContactField->is_phone_enabled)
                                    <input type="tel" pattern="[0-9]{10,15}" name="phone"
                                           class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                           placeholder="Phone number"
                                           @if($business->shareContactField->is_phone_required) required @endif>
                                @endif

                                @if ($business->shareContactField->is_email_enabled)
                                    <input type="email" name="email"
                                           class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                           placeholder="Email"
                                           @if($business->shareContactField->is_email_required) required @endif>
                                @endif

                                @if ($business->shareContactField->is_company_enabled)
                                    <input type="text" name="company"
                                           class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                           placeholder="Company"
                                           @if($business->shareContactField->is_company_required) required @endif>
                                @endif

                                @if ($business->shareContactField->is_job_title_enabled)
                                    <input type="text" name="job_title"
                                           class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                           placeholder="Job Title"
                                           @if($business->shareContactField->is_job_title_required) required @endif>
                                @endif

                                @if ($business->shareContactField->is_notes_enabled)
                                    <textarea name="message"
                                              class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                              rows="3" placeholder="Notes"
                                              @if($business->shareContactField->is_notes_required) required @endif></textarea>
                                @endif

                                <input type="hidden" name="business_id" value="{{ $business->id }}">
                            </div>

                            <div class="d-grid">
                                <button type="submit"
                                        class="btn btn-primary rounded-3 py-2 d-flex justify-content-center align-items-center gap-2">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <span>Share Contact</span>
                                </button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @if(!$isOnEditFormPage)
        @include('components.share-card-modal', ['id' => 'shareCardModal', 'class' => 'vcard-modal'])
    @endif
@endsection
