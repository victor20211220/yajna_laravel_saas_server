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
        <div class="position-absolute d-flex justify-content-between align-items-center p-4 z-1 w-100">
            @if($isSelfUser && $isOnEditFormPage)
                <div id="closeCardPreviewModalBtn">
                    {!! svg('vcard/close_card_preview_popup.svg', ['class' => 'd-block d-md-none']) !!}
                </div>
            @endif

            {!! svg('vcard/top_corner_share.svg', ['class' => 'ms-auto', 'id' => 'openShareCardModalBtn']) !!}
        </div>
        <div class="cover-photo w-100 position-relative">
            <img
                src="{{ $business->banner ? $banner . '/' . $business->banner : asset('assets/images/icons/user_interface/cover_photo_placeholder.png') }}"
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

        <!-- Name, Title, Company, Socials -->
        <section class="text-center pt-3 mt-1">
            @php $business_title = $business->title @endphp
            <div class="title fw-medium mb-3 lh-1"
                 id="{{ $stringid . '_title' }}_preview" {!! Utility::hideEmptyCardElement($business_title) !!}>{{ $business_title }}</div>

            @php
                $designation = $business->designation;
                $sub_title = $business->sub_title;
            @endphp
            <div class="display-flex justify-content-center align-items-center gap-2 mb-4 pb-2 lh-1"
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

            <div class="position-relative">
                @php $description = $business->description @endphp
                <div id="{{ $stringid . '_desc' }}_preview"
                     {!! Utility::hideEmptyCardElement($description) !!}  class="mb-4 pb-2 toggleable-description">
                    {!! nl2br(e($description)) !!}
                </div>
                <div class="toggle-arrow position-absolute bottom-0 start-0 end-0 mx-auto">
                    {!! svg('vcard/description-toggle.svg', [ 'class' => 'fill-text-color' ]) !!}
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3 mb-4 pb-2" id="save-share-contact-buttons">
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

            <!-- Social Icons Slider -->
            <div
                class="socials-slider" {!! Utility::isInitialSocials($social_content) || empty($social_content) ? "style=\"display:none;\"": ""!!}>
                @if (count($social_content))
                    @foreach ($social_content as $id => $social_item)
                        @foreach ($social_item as $key => $social_val)
                            @php
                                if($key === "id") continue;
                                $link = $social_val;
                                $platform = strtolower($key);
                                if($social_val){
                                    switch ($platform){
                                        case "whatsapp":
                                        case "phone":
                                            $digitsOnly = preg_replace('/\D/', '', $social_val);
                                            $link = ($platform === "whatsapp" ? "https://wa.me/": "tel:" ). $digitsOnly;
                                            break;

                                        case "address":
                                            $link = "https://www.google.com/maps/search/?api=1&query=". urlencode($social_val);
                                            break;

                                        case "email":
                                            $link = "mailto:". $social_val;
                                            break;

                                        case "website":
                                            $link = "https://". $social_val;
                                            break;
                                    }
                                }
                            @endphp
                            <div class="card-social-link" {!! Utility::hideEmptyCardElement($social_val) !!}>
                                <a href="{{ $link }}" target="_blank"
                                   id="{{ 'socials_' . $id . '_preview' }}">
                                    {!! svg('vcard/socials/'.$platform.'.svg', ['class' => 'w-100']) !!}
                                </a>
                                <p>{{ $key }}</p>
                            </div>

                        @endforeach
                    @endforeach
                @endif
            </div>
        </section>

        @if($isProClient)
            <section
                id="vcard-gallery-section" {!! Utility::hideSection(isset($gallery['is_enabled']) && $gallery['is_enabled']) !!}>
                <div class="vcard-section-title">Gallery</div>
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

            <section
                id="vcard-featured-videos-section" {!! Utility::hideSection(isset($gallery['is_video_enabled']) && $gallery['is_video_enabled']) !!}>
                <div class="vcard-section-title">Video</div>
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
                                @if(Utility::isDirectVideoFile($url))
                                    <video class="object-fit-cover video-slide-thumb">
                                        <source src="{{ $url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <iframe class="video-slide-thumb pointer-events-none"
                                            src="{{ str_replace('watch?v=', 'embed/', $url) }}?controls=0"
                                            frameborder="0"
                                            allowfullscreen></iframe>
                                @endif
                                <img
                                    src="{{ asset('assets/images/icons/vcard/video_play.svg') }}"
                                    alt=""
                                    class="video-play-overlay"
                                    data-url="{{ $url }}"
                                />
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>

            <section
                id="vcard-services-section" {!! Utility::hideSection(isset($services['is_enabled']) && $services['is_enabled']) !!}>
                <div class="vcard-section-title">Services</div>
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
            <div class="mt-4 d-flex justify-content-center gap-3 align-items-center site-links">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('login') }}">Signup</a>
                <a href="{{ route('about.terms') }}" target="_blank">Terms of Use</a>
                <a href="{{ route('about.privacy') }}" target="_blank">Privacy Policy</a>
            </div>
        </section>
    </div>

    <div class="modal fade vcard-modal" id="imageViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">
                <!-- Modal Body with Image -->
                <div class="modal-body p-0">
                    <img src="#" alt="Preview" class="img-fluid w-100 rounded-bottom" id="imageViewerModalImg">
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade vcard-modal" id="videoViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-0">
                <div class="modal-body p-0 overflow-hidden">
                    <video id="modalVideoPlayer" controls autoplay></video>
                    <iframe id="modalIframePlayer" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    @if(!$isOnEditFormPage)
        @include('components.share-card-modal', ['id' => 'shareCardModal', 'class' => 'vcard-modal'])
        @include('components.share-contact-modal-content', ['id' => 'shareContactModal'])
    @endif
@endsection
