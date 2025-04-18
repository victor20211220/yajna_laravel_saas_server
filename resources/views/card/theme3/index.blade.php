@extends('card.layouts')
@section('contentCard')
@if($themeName)
    <div class="{{ $themeName }}" id="view_theme13">
@else
    <div class="{{ $business->theme_color }}" id="view_theme13">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
          <div class="wedding-card">
                <section class="profile-sec text-center">
                    <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme3/images/profile-banner-img.png') }}" class="profile-banner-img" alt="profile-banner-img" id="banner_preview"
                        loading="lazy">
                    <div class="container">
                        <div class="profile-content">
                            <p id="{{ $stringid . '_desc' }}_preview">
                            {!! nl2br(e($business->description)) !!}</p>
                        </div>
                        <div class="client-info-wrp">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme3/images/client-image.png') }}"   alt="client-image" loading="lazy">
                            </div>
                            <div class="client-info">
                                <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                                <p id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</p>
                                <span id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                            </div>
                        </div>
                    </div>
                </section>
                @php $j = 1; @endphp
            @foreach ($card_theme->order as $order_key => $order_value)
                @if ($j == $order_value)
                 @if ($order_key == 'gallery')
                  <section class="gallery-sec mb" id="gallery-div">
                    <img src="{{ asset('custom/theme3/images/background-img.png') }}" class="gallery-bg-img">
                    <div class="gallery-slider" id="inputrow_gallery_preview">
                      @php $image_count = 0; @endphp
                      @if (isset($is_pdf))
                        <div class="gallery-card">
                            <div class="gallery-card-inner">
                                @if (!is_null($gallery_contents) && !is_null($gallery))
                                    @foreach ($gallery_contents as $gallery_content)
                                        @if (isset($gallery_content->type))
                                            @if ($gallery_content->type == 'video')
                                                <!-- Handle video content -->
                                            @elseif($gallery_content->type == 'image')
                                                <a href="javascript:void(0);" id="gallerymodel"
                                                    class="gallery-popup-btn gallery-margin img-wrapper"
                                                    tabindex="0">
                                                    <img src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png') }}"
                                                        alt="gallery-image">
                                                </a>
                                            @endif
                                        @endif
                                        @php
                                            $image_count++;
                                        @endphp
                                    @endforeach
                                @endif
                            </div>
                        </div>
                      @else
                      @if (!is_null($gallery_contents) && !is_null($gallery))
                        @foreach ($gallery_contents as $gallery_content)
                            @if (isset($gallery_content->type))
                                @if ($gallery_content->type == 'video')
                                    <div class="gallery-card">
                                        <div class="gallery-card-inner">
                                            <a href="javascript:;" id="videomodel"
                                                class="video-popup-btn play-btn img-wrapper">
                                                <video loop controls="true">
                                                        <source class="videoresource"
                                                        src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png') }}"
                                                        type="video/mp4">
                                                </video>
                                            </a>
                                        </div>
                                    </div>
                                @elseif($gallery_content->type == 'image')
                                    <div class="gallery-card">
                                        <div class="gallery-card-inner">
                                            <a href="javascript:;" id="gallerymodel"
                                                tabindex="0"
                                                class="gallery-popup-btn gallery-margin img-wrapper">
                                                <img src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png') }}"
                                                    alt="images" class="imageresource">
                                            </a>
                                        </div>
                                    </div>
                                @elseif($gallery_content->type == 'custom_video_link')
                                    @if (str_contains($gallery_content->value, 'youtube') || str_contains($gallery_content->value, 'youtu.be'))
                                        @php
                                            if (
                                                strpos($gallery_content->value, 'src') !== false
                                            ) {
                                                preg_match(
                                                    '/src="([^"]+)"/',
                                                    $gallery_content->value,
                                                    $match,
                                                );
                                                $url = $match[1];
                                                $video_url = str_replace(
                                                    'https://www.youtube.com/embed/',
                                                    '',
                                                    $url,
                                                );
                                            } elseif (
                                                strpos($gallery_content->value, 'src') ==
                                                    false &&
                                                strpos($gallery_content->value, 'embed') !==
                                                    false
                                            ) {
                                                $video_url = str_replace(
                                                    'https://www.youtube.com/embed/',
                                                    '',
                                                    $gallery_content->value,
                                                );
                                            } else {
                                                $video_url = str_replace(
                                                    'https://youtu.be/',
                                                    '',
                                                    str_replace(
                                                        'https://www.youtube.com/watch?v=',
                                                        '',
                                                        $gallery_content->value,
                                                    ),
                                                );
                                                preg_match(
                                                    '/[\\?\\&]v=([^\\?\\&]+)/',
                                                    $gallery_content->value,
                                                    $matches,
                                                );
                                                if (count($matches) > 0) {
                                                    $videoId = $matches[1];
                                                    $video_url = strtok($videoId, '&');
                                                }
                                            }
                                        @endphp

                                        <div class="gallery-card">
                                            <div class="gallery-card-inner">
                                                <a href="javascript:;" id="videomodel"
                                                    tabindex="0"
                                                    class="video-popup-btn gallery-margin play-btn img-wrapper">
                                                    <video loop controls="true"
                                                        poster="{{ asset('custom/img/video_youtube.jpg') }}">
                                                        <source class="videoresource"
                                                            src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? 'https://www.youtube.com/embed/' . $video_url : asset('custom/img/logo-placeholder-image-2.png') }}"
                                                            type="video/mp4">
                                                    </video>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="gallery-card">
                                            <div class="gallery-card-inner">
                                                <a href="javascript:;" id="videomodel"
                                                    tabindex="0"
                                                    class="video-popup-btn play-btn gallery-margin img-wrapper">
                                                    <video loop controls="true"
                                                        poster="{{ asset('custom/img/video_youtube.jpg') }}">
                                                        <source class="videoresource"
                                                            src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png') }}"
                                                            type="video/mp4">
                                                    </video>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Handle YouTube or custom video link content -->
                                @elseif($gallery_content->type == 'custom_image_link')
                                    <div class="gallery-card">
                                        <div class="gallery-card-inner">
                                            <a href="javascript:;" id="gallerymodel"
                                                tabindex="0"
                                                class="gallery-popup-btn gallery-margin img-wrapper">
                                                <img class="imageresource"
                                                    src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png') }}"
                                                    alt="images">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @php
                                $image_count++;
                            @endphp
                        @endforeach
                      @endif
                      @endif
                    </div>
                    <div class="arrow-wrapper d-flex align-items-center justify-content-between">
                        <svg class="top-svg" width="576" height="15" viewBox="0 0 576 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M576 10.8143C571.682 16.0417 563.053 16.0417 558.814 10.8143C554.575 16.0417 545.463 16.0417 541.224 10.8143C536.985 16.0417 527.671 16.0417 523.432 10.8143C519.193 16.0417 509.778 16.0417 505.539 10.8143C501.3 16.0417 491.835 16.0417 487.596 10.8143C483.357 16.0417 473.87 16.0417 469.624 10.8143C465.385 16.0417 455.883 16.0417 451.637 10.8143C447.398 16.0417 437.89 16.0417 433.651 10.8143C429.412 16.0417 419.903 16.0417 415.657 10.8143C411.418 16.0417 401.902 16.0417 397.663 10.8143C393.425 16.0417 383.909 16.0417 379.67 10.8143C375.431 16.0417 365.915 16.0417 361.676 10.8143C357.437 16.0417 347.921 16.0417 343.682 10.8143C339.443 16.0417 329.928 16.0417 325.689 10.8143C321.45 16.0417 311.934 16.0417 307.695 10.8143C303.456 16.0417 293.94 16.0417 289.701 10.8143C285.462 16.0417 275.947 16.0417 271.708 10.8143C267.469 16.0417 257.953 16.0417 253.714 10.8143C249.475 16.0417 239.959 16.0417 235.72 10.8143C231.481 16.0417 221.965 16.0417 217.727 10.8143C213.488 16.0417 203.972 16.0417 199.733 10.8143C195.494 16.0417 185.978 16.0417 181.739 10.8143C177.5 16.0417 167.984 16.0417 163.745 10.8143C159.507 16.0417 149.991 16.0417 145.752 10.8143C141.513 16.0417 131.997 16.0417 127.758 10.8143C123.519 16.0417 114.003 16.0417 109.764 10.8143C105.526 16.0417 96.0096 16.0417 91.7707 10.8143C87.5318 16.0417 78.0159 16.0417 73.777 10.8143C69.5381 16.0417 60.0222 16.0417 55.7833 10.8143C51.5444 16.0417 42.0285 16.0417 37.7896 10.8143C33.5507 16.0417 23.1626 16.0417 18.9237 10.8143C14.6271 16.0417 4.32541 16.0417 0 10.8143V0H289.68H576V10.8143Z" fill="#C78665"/>
                        </svg>
                        <svg class="bottom-svg" width="576" height="15" viewBox="0 0 576 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M576 10.8143C571.682 16.0417 563.053 16.0417 558.814 10.8143C554.575 16.0417 545.463 16.0417 541.224 10.8143C536.985 16.0417 527.671 16.0417 523.432 10.8143C519.193 16.0417 509.778 16.0417 505.539 10.8143C501.3 16.0417 491.835 16.0417 487.596 10.8143C483.357 16.0417 473.87 16.0417 469.624 10.8143C465.385 16.0417 455.883 16.0417 451.637 10.8143C447.398 16.0417 437.89 16.0417 433.651 10.8143C429.412 16.0417 419.903 16.0417 415.657 10.8143C411.418 16.0417 401.902 16.0417 397.663 10.8143C393.425 16.0417 383.909 16.0417 379.67 10.8143C375.431 16.0417 365.915 16.0417 361.676 10.8143C357.437 16.0417 347.921 16.0417 343.682 10.8143C339.443 16.0417 329.928 16.0417 325.689 10.8143C321.45 16.0417 311.934 16.0417 307.695 10.8143C303.456 16.0417 293.94 16.0417 289.701 10.8143C285.462 16.0417 275.947 16.0417 271.708 10.8143C267.469 16.0417 257.953 16.0417 253.714 10.8143C249.475 16.0417 239.959 16.0417 235.72 10.8143C231.481 16.0417 221.965 16.0417 217.727 10.8143C213.488 16.0417 203.972 16.0417 199.733 10.8143C195.494 16.0417 185.978 16.0417 181.739 10.8143C177.5 16.0417 167.984 16.0417 163.745 10.8143C159.507 16.0417 149.991 16.0417 145.752 10.8143C141.513 16.0417 131.997 16.0417 127.758 10.8143C123.519 16.0417 114.003 16.0417 109.764 10.8143C105.526 16.0417 96.0096 16.0417 91.7707 10.8143C87.5318 16.0417 78.0159 16.0417 73.777 10.8143C69.5381 16.0417 60.0222 16.0417 55.7833 10.8143C51.5444 16.0417 42.0285 16.0417 37.7896 10.8143C33.5507 16.0417 23.1626 16.0417 18.9237 10.8143C14.6271 16.0417 4.32541 16.0417 0 10.8143V0H289.68H576V10.8143Z" fill="#C78665"/>
                        </svg>
                        <div class="slick-prev slick-arrow gallery-arrow">
                            <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/>
                            </svg>
                        </div>
                        <div class="slick-next slick-arrow gallery-arrow">
                            <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/>
                            </svg>
                        </div>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'product')
                  <section class="product-sec pb" id="product-div">
                        <div class="section-title common-title text-center d-flex align-items-center">
                            <div class="title-svg d-flex">
                                <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                    <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                    <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                    <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                                </svg>
                            </div>
                            <h2>{{ __('Product') }}</h2>
                            <div class="title-svg d-flex">
                                <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                    <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                    <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                    <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                                </svg>
                            </div>
                        </div>
                        <div class="container">
                            <div class="slider-wrapper">
                                @if(isset($is_pdf))
                                    @php $pr_image_count = 0; @endphp
                                    @foreach ($products_content as $k1 => $content)
                                        <div class="product-card edit-card" id="product_{{ $product_row_nos }}">
                                            <div class="product-card-inner">
                                                <div class="product-card-image">
                                                    <div class="img-wrapper">
                                                        <img src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                                        alt="product-image" loading="lazy">
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-content-top">
                                                        <h3 id="{{ 'product_title_' . $product_row_nos . '_preview' }}">
                                                            {{ $content->title }}</h3>
                                                        <p id="{{ 'product_description_' . $product_row_nos . '_preview' }}">
                                                        {{ $content->description }}</p>
                                                    </div>
                                                    <div
                                                        class="product-content-bottom d-flex align-items-center justify-content-between">
                                                        <div class="price">
                                                            <ins>$100</ins>
                                                        </div>
                                                        @if (!empty($content->purchase_link))
                                                            <a href="{{ url($content->purchase_link) }}" class="btn">{{ $content->link_title }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $pr_image_count++;
                                        $product_row_nos++;
                                        @endphp
                                    @endforeach
                                @else
                                <div class="product-sec-slider" id="inputrow_product_preview">
                                    @php $pr_image_count = 0; @endphp
                                    @foreach ($products_content as $k1 => $content)
                                        <div class="product-card" id="product_{{ $product_row_nos }}">
                                            <div class="product-card-inner">
                                                <div class="product-card-image">
                                                    <div class="img-wrapper">
                                                        <img src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                                        alt="product-image" loading="lazy">
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-content-top">
                                                        <h3 id="{{ 'product_title_' . $product_row_nos . '_preview' }}">
                                                            {{ $content->title }}</h3>
                                                        <p id="{{ 'product_description_' . $product_row_nos . '_preview' }}">
                                                        {{ $content->description }}</p>
                                                    </div>
                                                    <div
                                                        class="product-content-bottom d-flex align-items-center justify-content-between">
                                                        <div class="price">
                                                            <ins>$100</ins>
                                                        </div>
                                                        @if (!empty($content->purchase_link))
                                                            <a href="{{ url($content->purchase_link) }}" class="btn">{{ $content->link_title }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $pr_image_count++;
                                        $product_row_nos++;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="arrow-wrapper">
                                    <div class="slick-prev slick-arrow product-sec-arrow">
                                        <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="slick-next slick-arrow product-sec-arrow">
                                        <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                  </section>
                 @endif
                 @if ($order_key == 'bussiness_hour')
                  <section class="business-hour-sec mb" id="business-hours-div">
                    <div class="container">
                        <div class="business-hours text-center">
                            <div class="section-title">
                                <h2>{{ __('Business Hours') }}</h2>
                            </div>
                            <ul class="hours-list">
                                @foreach ($days as $k => $day)
                                    <li class="d-flex align-items-center justify-content-center">
                                        <span>{{ __($day) }}</span>
                                        <p class="days_{{ $k }}">
                                            @if (isset($business_hours->$k) && $business_hours->$k->days == 'on')
                                                {{ !empty($business_hours->$k->start_time) && isset($business_hours->$k->start_time) ? date('h:i A', strtotime($business_hours->$k->start_time)) : '00:00' }}
                                                -
                                                {{ !empty($business_hours->$k->end_time) && isset($business_hours->$k->end_time)
                                                    ? date('h:i A', strtotime($business_hours->$k->end_time))
                                                    : '00:00' }}
                                            @else
                                                {{ __('closed') }}
                                            @endif
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'service')
                 <section class="service-sec pb" id="services-div">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('Services') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <div class="slider-wrapper">
                            @if(isset($is_pdf))
                                @php $image_count = 0; @endphp
                                @foreach ($services_content as $k1 => $content)
                                   <div class="service-card edit-card" id="services_{{ $service_row_nos }}">
                                        <div class="service-card-inner">
                                            <div class="service-card-image">
                                                <img id="{{ 's_image' . $image_count . '_preview' }}"
                                                width="28" height="28"
                                                src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                class="img-fluid" alt="service-image">
                                            </div>
                                            <div class="service-content">
                                                <div class="service-content-top">
                                                    <h3 id="{{ 'title_' . $service_row_nos . '_preview' }}"> {{ $content->title }}</h3>
                                                    <p id="{{ 'description_' . $service_row_nos . '_preview' }}">{{ $content->description }} </p>
                                                </div>
                                                <div class="service-content-bottom text-center">
                                                    @if (!empty($content->purchase_link))
                                                    <a href="{{ url($content->purchase_link) }}"
                                                        id="{{ 'link_title_' . $service_row_nos . '_preview' }}"
                                                        class="btn">{{ $content->link_title }}
                                                        <svg width="12" height="6" viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.8625 2.66819L11.8621 2.66775L9.41278 0.230248C9.22929 0.0476469 8.9325 0.0483264 8.74985 0.231842C8.56723 0.415334 8.56793 0.712123 8.75142 0.894748L10.3959 2.53125L0.46875 2.53125C0.209859 2.53125 0 2.74111 0 3C0 3.25889 0.209859 3.46875 0.46875 3.46875L10.3959 3.46875L8.75144 5.10525C8.56795 5.28787 8.56725 5.58466 8.74988 5.76816C8.93252 5.95169 9.22934 5.95233 9.4128 5.76975L11.8621 3.33225L11.8625 3.3318C12.0461 3.14857 12.0455 2.85082 11.8625 2.66819Z" fill="white"/>
                                                        </svg>  </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $image_count++;
                                    $service_row_nos++;
                                    @endphp
                                @endforeach
                            @else
                            <div class="service-slider" id="inputrow_service_preview">
                                @php $image_count = 0; @endphp
                                @foreach ($services_content as $k1 => $content)
                                   <div class="service-card" id="services_{{ $service_row_nos }}">
                                        <div class="service-card-inner">
                                            <div class="service-card-image">
                                                <img id="{{ 's_image' . $image_count . '_preview' }}"
                                                width="28" height="28"
                                                src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                class="img-fluid" alt="service-image">
                                            </div>
                                            <div class="service-content">
                                                <div class="service-content-top">
                                                    <h3 id="{{ 'title_' . $service_row_nos . '_preview' }}"> {{ $content->title }}</h3>
                                                    <p id="{{ 'description_' . $service_row_nos . '_preview' }}">{{ $content->description }} </p>
                                                </div>
                                                <div class="service-content-bottom text-center">
                                                    @if (!empty($content->purchase_link))
                                                    <a href="{{ url($content->purchase_link) }}"
                                                        id="{{ 'link_title_' . $service_row_nos . '_preview' }}"
                                                        class="btn">{{ $content->link_title }}
                                                        <svg width="12" height="6" viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.8625 2.66819L11.8621 2.66775L9.41278 0.230248C9.22929 0.0476469 8.9325 0.0483264 8.74985 0.231842C8.56723 0.415334 8.56793 0.712123 8.75142 0.894748L10.3959 2.53125L0.46875 2.53125C0.209859 2.53125 0 2.74111 0 3C0 3.25889 0.209859 3.46875 0.46875 3.46875L10.3959 3.46875L8.75144 5.10525C8.56795 5.28787 8.56725 5.58466 8.74988 5.76816C8.93252 5.95169 9.22934 5.95233 9.4128 5.76975L11.8621 3.33225L11.8625 3.3318C12.0461 3.14857 12.0455 2.85082 11.8625 2.66819Z" fill="white"/>
                                                        </svg>  </a>

                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $image_count++;
                                    $service_row_nos++;
                                    @endphp
                                @endforeach
                            </div>
                            <div class="arrow-wrapper">
                                <div class="slick-prev slick-arrow service-arrow">
                                    <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow service-arrow">
                                    <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                 @endif
                 @if ($order_key == 'contact_info')
                  <section class="contact-info-sec pt pb" id="contact-div">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('Contact') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <ul class="contact-list" id="inputrow_contact_preview">
                            @if (!is_null($contactinfo_content) && !is_null($contactinfo))
                                @foreach ($contactinfo_content as $key => $val)
                                    @foreach ($val as $key1 => $val1)
                                        @php
                                            if ($key1 == 'Phone') {
                                                $href = 'tel:' . $val1;
                                            } elseif ($key1 == 'Email') {
                                                $href = 'mailto:' . $val1;
                                            } elseif ($key1 == 'Address') {
                                                $href = '';
                                            } else {
                                                $href = $val1;
                                            }
                                        @endphp
                                        @if ($key1 != 'id')
                                            <li id="contact_{{ $loop->parent->index + 1 }}" class="d-flex align-items-center justify-content-center">
                                                @if ($key1 == 'Address')
                                                    @foreach ($val1 as $key2 => $val2)
                                                        @if ($key2 == 'Address_url')
                                                            @php $href = $val2; @endphp
                                                        @endif
                                                    @endforeach
                                                        <img src="{{ asset('custom/theme3/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    <a href="{{ $href }}" target="_blank" class="contact-link" >
                                                        @foreach ($val1 as $key2 => $val2)
                                                            @if ($key2 == 'Address')
                                                            <span id="{{ $key1 . '_' . $nos }}_preview">
                                                                {{ $val2 }}
                                                            </span>
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                @else
                                                    @if ($key1 == 'Whatsapp')
                                                        <img src="{{ asset('custom/theme3/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-link">
                                                    @else
                                                            <img src="{{ asset('custom/theme3/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                        <a href="{{ $href }}" class="contact-link">
                                                    @endif

                                                    <span id="{{ $key1 . '_' . $nos }}_preview">
                                                        {{ $val1 }}
                                                    </span>
                                                    </a>
                                                @endif
                                            </li>
                                        @endif
                                        @php $nos++; @endphp
                                    @endforeach
                                @endforeach
                            @endif
                        </ul>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'appointment')
                  <section class="appointment-sec bg-light pt pb mb" id="appointment-div">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('Appointment') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <form class="appointment-form">
                            <div class="date-picker">
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker_min" placeholder="Pick a date">
                                </div>
                            </div>
                            <ul class="check-box-div d-flex" id="inputrow_appointment_preview">
                                @php $radiocount = 1; @endphp
                                @if (!is_null($appoinment_hours))
                                    @foreach ($appoinment_hours as $k => $hour)
                                        <li class="checkbox-custom" id="{{ 'appointment_' . $appointment_nos }}">
                                            <input type="radio" id="radio-{{ $radiocount }}" name="time"  data-id="@if (!empty($hour->start)) {{ $hour->start }} @else 00:00 @endif-@if (!empty($hour->end)) {{ $hour->end }} @else 00:00 @endif">
                                            <label for="radio-{{ $radiocount }}">
                                                <span  id="appoinment_start_{{ $appointment_nos }}_preview">
                                                    @if (!empty($hour->start))
                                                        {{ $hour->start }}
                                                    @else
                                                        00:00
                                                    @endif
                                                    </span>-
                                                    <span id="appoinment_end_{{ $appointment_nos }}_preview">
                                                        @if (!empty($hour->end))
                                                            {{ $hour->end }}
                                                        @else
                                                            00:00
                                                        @endif
                                                </span>
                                            </label>
                                        </li>
                                        @php
                                        $radiocount++;
                                        $appointment_nos++;
                                        @endphp
                                    @endforeach
                                @endif
                            </ul>
                            <div class="text-center">
                                <button type="button" class="btn appointment-btn">{{ __('Make An Appointment') }}</button>
                            </div>
                        </form>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'more')
                  <section class="more-info-sec pb">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('More') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <ul class="d-flex justify-content-between">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}"
                                    class="save-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 24"
                                        fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.7867 0.318213C5.92135 0.0780268 7.2727 0 8.83546 0H11.0998C12.5039 0 13.8151 0.6684 14.5939 1.7812L15.7312 3.40627C15.9909 3.77717 16.4279 4 16.896 4H23.9725C26.2086 4 28.0211 5.68153 27.9998 7.84693C27.9743 10.4256 27.9958 13.0052 27.9958 15.584C27.9958 17.0725 27.9139 18.3597 27.6616 19.4405C27.406 20.5365 26.957 21.5001 26.1641 22.2553C25.3713 23.0105 24.3597 23.4383 23.209 23.6817C22.0744 23.922 20.723 24 19.1603 24H8.83546C7.2727 24 5.92135 23.922 4.7867 23.6817C3.63615 23.4383 2.62443 23.0105 1.83159 22.2553C1.03877 21.5001 0.589773 20.5365 0.334074 19.4405C0.0819157 18.3597 0 17.0725 0 15.584V8.416C0 6.92743 0.0819157 5.64024 0.334074 4.55945C0.589773 3.46352 1.03877 2.49984 1.83159 1.74464C2.62443 0.989453 3.63615 0.561773 4.7867 0.318213ZM15.3977 10.6667C15.3977 9.93027 14.771 9.33333 13.9979 9.33333C13.2248 9.33333 12.5981 9.93027 12.5981 10.6667V14.7811L11.4882 13.7239C10.9416 13.2032 10.0553 13.2032 9.50861 13.7239C8.96196 14.2445 8.96196 15.0888 9.50861 15.6095L12.9206 18.8595C12.9356 18.8737 12.9508 18.8877 12.9664 18.9013C13.2223 19.1668 13.5896 19.3333 13.9979 19.3333C14.4062 19.3333 14.7735 19.1668 15.0294 18.9013C15.0449 18.8877 15.0602 18.8737 15.0752 18.8595L18.4871 15.6095C19.0338 15.0888 19.0338 14.2445 18.4871 13.7239C17.9405 13.2032 17.0542 13.2032 16.5076 13.7239L15.3977 14.7811V10.6667Z"
                                            fill="white" />
                                    </svg>
                                </a>
                                <h3>{{ __('Save') }}</h3>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="share-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
                                        fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.18161 14.3394L14.4018 9.11828C14.7464 8.77363 15.3067 8.77363 15.6514 9.11828C15.996 9.46382 15.996 10.0232 15.6514 10.3688L10.4312 15.589L14.5291 23.3295C14.8596 23.9543 15.5321 24.322 16.2364 24.2636C16.9416 24.2053 17.5443 23.7325 17.7679 23.0609C19.3233 18.3957 23.2241 6.69245 24.6796 2.32683C24.8908 1.69143 24.7255 0.99152 24.2527 0.517842C23.779 0.0441633 23.0791 -0.121095 22.4437 0.0909994L1.70881 7.00264C1.03806 7.22622 0.565255 7.82805 0.506045 8.53327C0.447719 9.23848 0.815362 9.91012 1.44104 10.2415L9.18161 14.3394Z"
                                            fill="white" />
                                    </svg>
                                </a>
                                <h3>{{ __('Share') }}</h3>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="contact-info d-flex align-items-center justify-content-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.7146 18.7675L19.7595 14.8124C19.6224 14.6754 19.4477 14.5823 19.2575 14.5451C19.0673 14.508 18.8703 14.5283 18.6918 14.6037L14.5282 16.3608L7.63915 9.47182L9.39626 5.30827C9.47162 5.12971 9.49201 4.93274 9.45484 4.74253C9.41766 4.55232 9.32459 4.37752 9.18754 4.24048L5.23242 0.285371C5.14195 0.194898 5.03455 0.12313 4.91634 0.0741659C4.79813 0.0252018 4.67144 0 4.5435 0C4.41555 0 4.28886 0.0252018 4.17065 0.0741659C4.05245 0.12313 3.94504 0.194898 3.85457 0.285371L1.15366 2.98631C-1.93852 6.07856 1.58733 11.6658 6.96079 17.0392C12.3342 22.4127 17.9215 25.9385 21.0138 22.8463L23.7147 20.1454C23.8974 19.9627 24 19.7148 24 19.4564C24 19.1981 23.8973 18.9502 23.7146 18.7675Z" fill="white"/>
                                    </svg>
                                </a>
                                <h3>{{ __('Contact') }}</h3>
                            </li>
                        </ul>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'testimonials')
                  <section class="testimonial-sec bg-light pt pb mb" id="testimonials-div">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('Testimonials') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <div class="testimonial-slider-wrp"  id="testimonials_{{ $testimonials_row_nos }}">
                            <div class="testimonial-content-slider">
                                @foreach ($testimonials_content as $testi_content)
                                    <div class="testimonial-content">
                                        <div class="testimonial-content-inner">
                                            <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                {{ $testi_content->description }} </p>
                                        </div>
                                    </div>
                                    @php
                                    $testimonials_row_nos++;
                                    @endphp
                                @endforeach
                            </div>
                            <div class="testimonial-image-slider">
                                @php
                                    $t_image_count = 0;
                                    $testimonials_row_nos=0;
                                    @endphp
                                @foreach ($testimonials_content as $testi_content)
                                <div class="testimonial-image-wrp">
                                    <div class="testimonial-img">
                                        <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                alt="testimonial image" loading="lazy">
                                    </div>
                                    <span  id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                        {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                    </span>
                                    @php
                                        $t_image_count++;
                                        $testimonials_row_nos++;
                                    @endphp
                                </div>
                                @endforeach
                            </div>
                            <div id=inputrow_testimonials_preview> </div>
                        </div>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'social')
                  <section class="social-link-sec mb" id="social-div">
                    <svg class="left-svg" width="75" height="5" viewBox="0 0 75 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1C3.36081 1 3.36081 4 6.72162 4C10.0824 4 10.0824 1 13.4501 1C16.811 1 16.811 4 20.1787 4C23.5395 4 23.5395 1 26.9072 1C30.268 1 30.268 4 33.6357 4C36.9965 4 36.9965 1 40.3643 1C43.7251 1 43.7251 4 47.0859 4C50.4467 4 50.4467 1 53.8144 1C57.1752 1 57.1752 4 60.5429 4C63.9038 4 63.9038 1 67.2715 1C70.6392 1 70.6392 4 74 4" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg class="right-svg" width="75" height="5" viewBox="0 0 75 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1C4.36081 1 4.36081 4 7.72162 4C11.0824 4 11.0824 1 14.4501 1C17.811 1 17.811 4 21.1787 4C24.5395 4 24.5395 1 27.9072 1C31.268 1 31.268 4 34.6357 4C37.9965 4 37.9965 1 41.3643 1C44.7251 1 44.7251 4 48.0859 4C51.4467 4 51.4467 1 54.8144 1C58.1752 1 58.1752 4 61.5429 4C64.9038 4 64.9038 1 68.2715 1C71.6392 1 71.6392 4 75 4" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="container">
                        <div class="social-link-slider" id="inputrow_socials_preview">
                            @if (!is_null($social_content) && !is_null($sociallinks))
                            @foreach ($social_content as $social_key => $social_val)
                                @foreach ($social_val as $social_key1 => $social_val1)
                                    @if ($social_key1 != 'id')
                                        <div class="social-link"  id="socials_{{ $loop->parent->index + 1 }}">
                                            @if ($social_key1 == 'Whatsapp')
                                                @php
                                                    $social_links = 'https://wa.me/' . $social_val1;
                                                @endphp
                                            @else
                                                @php
                                                    $social_links = url($social_val1);
                                                @endphp
                                            @endif
                                            <a href="{{ $social_links }}" target="_blank"   id="{{ 'social_link_' . $social_nos . '_href_preview' }}">
                                                <img src="{{ asset('custom/theme3/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
                                            </a>
                                        </div>
                                    @endif
                                    @php
                                        $social_nos++;
                                    @endphp
                                @endforeach
                            @endforeach
                        @endif
                        </div>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'payment')
                  <section class="payment-sec pb" id="payment-section">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('Payment') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    @if (!is_null($cardPayment_content) && !empty($cardPayment_content))
                    <ul class="d-flex align-items-center justify-content-center">
                        @if (isset($cardPayment_content->stripe) && $cardPayment_content->stripe->status == 'on')
                        <li>
                            <a href="{{ route('card.pay.with.stripe', $business->id) }}"
                                class="d-flex align-items-center" target="_blank">
                                <img src="{{ asset('custom/img/payments/stripe.png') }}"
                                    alt="payment-image" class="img-fluid" loading="lazy">
                                <span>{{ __('Stripe') }}</span>
                            </a>
                        </li>
                        @endif
                        @if (isset($cardPayment_content->paypal) && $cardPayment_content->paypal->status == 'on')
                        <li>
                            <a href="{{ route('card.pay.with.paypal', $business->id) }}" class="d-flex align-items-center" target="_blank">
                                <img src="{{ asset('custom/img/payments/paypal.png') }}" alt="payment-image"  loading="lazy">
                                <span>{{ __('Paypal') }}</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endif

                  </section>
                 @endif
                 @if (!isset($is_pdf))
                    @if ($order_key == 'google_map')
                    <section class="google-map-sec pb" id="google-map-div">
                        <div class="map img-wrapper">
                            <input type="hidden" id="mapLink"
                                value="{{ $business->google_map_link }}">
                            <div id="mapContainer">
                            </div>
                        </div>
                    </section>
                    @endif
                 @endif
                 @if ($order_key == 'appinfo')
                  <section class="download-sec pb" id="app-section">
                    <div class="section-title common-title text-center d-flex align-items-center">
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6172 13.7643C15.6172 13.1183 16.1461 12.5916 16.7947 12.5916C17.4433 12.5916 17.9721 13.1183 17.9721 13.7643C17.9721 14.4103 17.4433 14.937 16.7947 14.937C16.1461 14.937 15.6172 14.4103 15.6172 13.7643Z" fill="#222222"/>
                                <path d="M15.6172 7.47355C15.6172 6.82756 16.1461 6.30084 16.7947 6.30084C17.4433 6.30084 17.9721 6.82756 17.9721 7.47355C17.9721 8.11953 17.4433 8.64625 16.7947 8.64625C16.1461 8.64625 15.6172 8.11953 15.6172 7.47355Z" fill="#222222"/>
                                <path d="M15.6172 1.1727C15.6172 0.526723 16.1461 0 16.7947 0C17.4433 0 17.9721 0.526723 17.9721 1.1727C17.9721 1.81868 17.4433 2.34541 16.7947 2.34541C16.1461 2.35534 15.6172 1.82862 15.6172 1.1727Z" fill="#222222"/>
                                <path d="M16.8047 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 21.2081L21.1853 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 27.1312L21.1853 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8047 33.0444L21.1853 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 21.2081L12.4141 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 27.1312L12.4141 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.8046 33.0444L12.4141 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 33.5214C102.4 33.5214 102.4 36.483 97.7897 36.483C93.1796 36.483 93.1796 33.5214 88.5795 33.5214C83.9694 33.5214 83.9694 36.483 79.3693 36.483C74.7592 36.483 74.7592 33.5214 70.1591 33.5214C65.549 33.5214 65.549 36.483 60.9389 36.483C56.3288 36.483 56.3288 33.5214 51.7188 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M107 42.0384C102.14 42.0384 102.14 45 97.2808 45C92.4213 45 92.4213 42.0384 87.5517 42.0384C82.6922 42.0384 82.6922 45 77.8227 45C72.9631 45 72.9631 42.0384 68.0936 42.0384C63.234 42.0384 63.234 45 58.3645 45C53.5049 45 53.5049 42.0384 48.6354 42.0384C43.7759 42.0384 43.7759 45 38.9163 45C34.0568 45 34.0568 42.0384 29.1872 42.0384C24.3277 42.0384 24.3277 45 19.4582 45C14.5986 45 14.5986 42.0384 9.72908 42.0384C4.85955 42.0384 4.85955 45 0 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M35.4629 20.6814C35.4629 26.2965 40.9511 30.8382 40.9511 30.8382C40.9511 30.8382 46.4393 26.2865 46.4393 20.6814C46.4393 15.0763 40.9511 10.5246 40.9511 10.5246C40.9511 10.5246 35.4629 15.0663 35.4629 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M40.9512 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M29.8154 27.479C33.7968 31.4444 40.9115 30.7984 40.9115 30.7984C40.9115 30.7984 41.5601 23.7125 37.5787 19.7472C33.5972 15.7818 26.4825 16.4278 26.4825 16.4278C26.4825 16.4278 25.8339 23.5137 29.8154 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M26.4824 16.428L40.6719 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.0884 27.479C48.107 31.4444 40.9923 30.7984 40.9923 30.7984C40.9923 30.7984 40.3437 23.7125 44.3251 19.7472C48.3066 15.7818 55.4213 16.4278 55.4213 16.4278C55.4213 16.4278 56.0699 23.5137 52.0884 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.4217 16.428L41.2422 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40.9518 38.0532C45.4221 38.0532 49.0344 34.4457 49.0344 30.0033H32.8691C32.8691 34.4457 36.4814 38.0532 40.9518 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                        <h2>{{ __('Download Here') }}</h2>
                        <div class="title-svg d-flex">
                            <svg width="108" height="46" viewBox="0 0 108 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="theme-color" d="M1 33.5214C5.60011 33.5214 5.60012 36.483 10.2102 36.483C14.8203 36.483 14.8203 33.5214 19.4204 33.5214C24.0305 33.5214 24.0305 36.483 28.6306 36.483C33.2407 36.483 33.2407 33.5214 37.8408 33.5214C42.4509 33.5214 42.4509 36.483 47.061 36.483C51.6711 36.483 51.6711 33.5214 56.2812 33.5214" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M92.3843 13.7643C92.3843 13.1183 91.8554 12.5916 91.2068 12.5916C90.5582 12.5916 90.0293 13.1183 90.0293 13.7643C90.0293 14.4103 90.5582 14.937 91.2068 14.937C91.8554 14.937 92.3843 14.4103 92.3843 13.7643Z" fill="#222222"/>
                                <path d="M92.3843 7.47348C92.3843 6.8275 91.8554 6.30078 91.2068 6.30078C90.5582 6.30078 90.0293 6.8275 90.0293 7.47348C90.0293 8.11946 90.5582 8.64619 91.2068 8.64619C91.8554 8.64619 92.3843 8.11946 92.3843 7.47348Z" fill="#222222"/>
                                <path d="M92.3843 1.1727C92.3843 0.526723 91.8554 0 91.2068 0C90.5582 0 90.0293 0.526723 90.0293 1.1727C90.0293 1.81868 90.5582 2.34541 91.2068 2.34541C91.8554 2.35534 92.3843 1.82862 92.3843 1.1727Z" fill="#222222"/>
                                <path d="M91.1953 37.2084V14.0128" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L86.8047 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L86.8047 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L86.8047 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 21.2081L95.5859 16.8353" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 27.1312L95.5859 22.7584" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M91.1953 33.0444L95.5859 28.6716" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M1 42.0384C5.85955 42.0384 5.85954 45 10.7191 45C15.5787 45 15.5787 42.0384 20.4482 42.0384C25.3077 42.0384 25.3077 45 30.1773 45C35.0368 45 35.0368 42.0384 39.9064 42.0384C44.7659 42.0384 44.7659 45 49.6354 45C54.495 45 54.495 42.0384 59.3645 42.0384C64.2241 42.0384 64.2241 45 69.0837 45C73.9432 45 73.9432 42.0384 78.8127 42.0384C83.6723 42.0384 83.6723 45 88.5418 45C93.4014 45 93.4014 42.0384 98.2709 42.0384C103.14 42.0384 103.14 45 108 45" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M72.537 20.6814C72.537 26.2965 67.0487 30.8382 67.0487 30.8382C67.0487 30.8382 61.5605 26.2865 61.5605 20.6814C61.5605 15.0763 67.0487 10.5246 67.0487 10.5246C67.0487 10.5246 72.537 15.0663 72.537 20.6814Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M67.0488 10.5146V30.5002" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M78.1841 27.479C74.2027 31.4444 67.088 30.7984 67.088 30.7984C67.088 30.7984 66.4394 23.7125 70.4208 19.7472C74.4023 15.7818 81.517 16.4278 81.517 16.4278C81.517 16.4278 82.1656 23.5137 78.1841 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M81.5176 16.428L67.3281 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M55.9124 27.479C59.8939 31.4444 67.0086 30.7984 67.0086 30.7984C67.0086 30.7984 67.6572 23.7125 63.6758 19.7472C59.6943 15.7818 52.5796 16.4278 52.5796 16.4278C52.5796 16.4278 51.921 23.5137 55.9124 27.479Z" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="theme-color" d="M52.5801 16.428L66.7596 30.5601" stroke="#C78665" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M67.0494 38.0532C62.579 38.0532 58.9668 34.4457 58.9668 30.0033H75.142C75.1321 34.4457 71.5098 38.0532 67.0494 38.0532Z" fill="#222222"/>
                            </svg>
                        </div>
                    </div>
                    @if (!is_null($appInfo))
                    <ul class="d-flex align-items-center">
                        <li>
                            <a href="{{ $appInfo->playstore_id }}" target="_blank"
                                class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('custom/icon/apps/playstore' . $appInfo->variant . '.png') }}"
                                    alt="app-store" loading="lazy">
                            </a>
                        </li>
                        <li>
                            <a href="{{ $appInfo->appstore_id }}" target="_blank"
                                class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('custom/icon/apps/appstore' . $appInfo->variant . '.png') }}"
                                    alt="app-store" loading="lazy">
                            </a>
                        </li>
                    </ul>
                    @endif
                  </section>
                 @endif
                 @if ($order_key == 'custom_html')
                            <section class="custom-text-sec pb custom_html_text">
                                <div class="container">
                                    <div class="custom-text">
                                        <h3 id="{{ $stringid . '_chtml' }}_preview">
                                            {!! !empty($custom_html) ? stripslashes($custom_html) : 'hello' !!}
                                        </h3>
                                    </div>
                                </div>
                            </section>
                 @endif
                 @if ($order_key == 'svg')
                 <section class="custom-text-sec pb" id="svg-div">
                  <div class="container">
                    <div class="thankyou-svg">
                        @if(empty($business->svg_text))
                        <svg width="430" height="445" viewBox="0 0 430 445" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect class="theme-color" y="0.467285" width="430" height="443" fill="#C78665" fill-opacity="0.1"/>
                            <path class="theme-color" d="M78.7941 82.8982C78.7941 82.8982 -15.434 201.441 28.076 333.348C71.586 465.245 246.545 456.426 363.19 370.846C479.835 285.267 384.58 190.427 349.918 166.642C315.256 142.858 365.794 92.3381 323.717 54.1106C281.639 15.8921 183.213 -14.9743 78.7941 82.8982Z" fill="#C78665"/>
                            <path opacity="0.7" d="M78.7941 82.8982C78.7941 82.8982 -15.434 201.441 28.076 333.348C71.586 465.245 246.545 456.426 363.19 370.846C479.835 285.267 384.58 190.427 349.918 166.642C315.256 142.858 365.794 92.3381 323.717 54.1106C281.639 15.8921 183.213 -14.9743 78.7941 82.8982Z" fill="white"/>
                            <path d="M332.51 390.978C334.294 391.751 338.645 391.652 338.645 391.652C338.691 391.652 337.708 388.809 337.627 388.629C336.672 386.631 333.654 383.337 331.194 383.67C329.419 383.913 328.437 385.677 328.833 387.342C329.239 389.052 330.987 390.321 332.51 390.978Z" fill="#222222"/>
                            <path d="M334.015 403.576C335.862 403.846 339.745 402.721 340.061 402.631C340.673 404.8 341.484 406.987 342.421 409.146C342.953 410.379 343.529 411.612 344.124 412.836C343.773 412.314 343.448 411.855 343.394 411.792C341.944 410.118 338.159 407.733 335.871 408.705C334.222 409.407 333.744 411.369 334.573 412.872C335.42 414.402 337.439 415.167 339.078 415.401C340.736 415.644 344.07 414.753 344.953 414.501C345.187 414.969 345.413 415.437 345.647 415.904C346.773 418.145 347.908 420.368 348.954 422.591C349.323 423.374 349.656 424.157 349.99 424.939C349.674 424.48 349.404 424.094 349.359 424.04C347.908 422.366 344.124 419.981 341.836 420.953C340.187 421.655 339.709 423.617 340.538 425.119C341.385 426.649 343.403 427.414 345.043 427.648C346.629 427.882 349.71 427.081 350.756 426.793C351.08 427.603 351.395 428.422 351.675 429.223C351.846 429.772 352.053 430.294 352.197 430.861C352.35 431.419 352.504 431.968 352.657 432.508C352.909 433.569 353.179 434.658 353.405 435.693C353.567 436.413 353.702 437.106 353.846 437.799C353.486 437.016 352.756 435.495 352.684 435.378C351.503 433.506 348.125 430.582 345.719 431.185C343.989 431.626 343.214 433.497 343.8 435.108C344.403 436.755 346.287 437.808 347.863 438.294C349.602 438.825 353.468 438.339 353.945 438.276C354.179 439.428 354.387 440.553 354.576 441.614C354.711 442.397 354.837 443.153 354.954 443.882H356.495C356.351 443.072 356.189 442.226 356.017 441.345C355.783 440.175 355.522 438.933 355.234 437.655C355.522 437.538 357.171 436.872 358.63 436.062C359.901 437.439 363.153 439.041 363.577 439.248C363.135 440.337 362.694 441.389 362.262 442.379C362.036 442.901 361.811 443.396 361.595 443.891H363.226C363.352 443.585 363.487 443.279 363.613 442.955C364.064 441.848 364.532 440.67 364.992 439.446C365.46 439.545 369.28 440.319 371.055 439.914C372.668 439.545 374.623 438.636 375.344 437.043C376.056 435.486 375.416 433.56 373.722 432.993C371.371 432.202 367.785 434.874 366.469 436.656C366.388 436.764 365.676 437.997 365.235 438.78C365.424 438.276 365.613 437.799 365.793 437.277C366.172 436.251 366.514 435.225 366.884 434.118C367.046 433.578 367.208 433.029 367.379 432.481C367.55 431.941 367.668 431.338 367.821 430.762C368.145 429.421 368.397 428.044 368.632 426.658C369.533 426.982 372.731 428.098 374.389 427.981C376.038 427.864 378.11 427.261 379.065 425.794C380.002 424.363 379.669 422.357 378.074 421.547C375.867 420.413 371.911 422.51 370.344 424.067C370.244 424.166 369.244 425.407 368.713 426.109C368.848 425.272 368.983 424.435 369.082 423.59C369.389 421.133 369.623 418.64 369.866 416.147C369.938 415.383 370.019 414.627 370.1 413.862C370.416 413.979 374.191 415.383 376.056 415.257C377.705 415.14 379.777 414.537 380.732 413.07C381.669 411.639 381.336 409.632 379.741 408.822C377.534 407.688 373.587 409.776 372.01 411.342C371.893 411.459 370.452 413.259 370.109 413.727C370.29 412.053 370.479 410.388 370.731 408.75C371.082 406.492 371.551 404.296 372.164 402.208C372.308 402.262 376.245 403.747 378.146 403.612C379.795 403.495 381.868 402.892 382.823 401.425C383.76 399.994 383.426 397.997 381.832 397.178C379.624 396.044 375.678 398.132 374.101 399.697C373.975 399.823 372.434 401.749 372.173 402.127C372.209 402.001 372.236 401.866 372.272 401.749C372.957 399.526 373.894 397.448 374.867 395.558C375.434 394.451 376.029 393.434 376.642 392.453C377.344 392.804 380.588 394.379 382.309 394.442C383.967 394.505 386.084 394.136 387.202 392.777C388.292 391.454 388.175 389.43 386.688 388.44C384.625 387.072 380.462 388.719 378.732 390.095C378.642 390.167 377.768 391.04 377.137 391.679C377.417 391.238 377.696 390.779 377.975 390.365C379.011 388.8 380.057 387.441 380.994 386.235C381.534 385.56 382.03 384.948 382.507 384.39C383.381 384.372 386.886 384.264 388.427 383.544C389.923 382.842 391.635 381.529 392.004 379.819C392.355 378.145 391.328 376.399 389.553 376.21C387.084 375.94 384.156 379.324 383.255 381.34C383.174 381.511 382.273 384.39 382.318 384.39C382.318 384.39 382.363 384.39 382.372 384.39C381.904 384.921 381.408 385.497 380.885 386.127C379.921 387.315 378.84 388.656 377.768 390.204C376.687 391.742 375.56 393.452 374.533 395.351C373.497 397.259 372.515 399.31 371.767 401.569C371.758 401.596 371.749 401.623 371.749 401.65C371.758 400.921 371.731 398.896 371.713 398.734C371.425 396.539 369.587 392.462 367.145 392.012C365.388 391.688 363.901 393.065 363.757 394.775C363.613 396.521 364.883 398.267 366.118 399.364C367.505 400.606 371.371 401.812 371.677 401.902C370.992 404.053 370.461 406.312 370.046 408.633C369.812 409.956 369.614 411.306 369.434 412.647C369.425 412.017 369.416 411.459 369.398 411.378C369.109 409.182 367.271 405.115 364.829 404.656C363.072 404.332 361.586 405.709 361.442 407.409C361.297 409.155 362.568 410.901 363.802 411.999C365.055 413.115 368.325 414.204 369.199 414.483C369.136 415.005 369.064 415.518 369.001 416.039C368.704 418.523 368.415 421.007 368.064 423.437C367.938 424.292 367.785 425.128 367.632 425.965C367.623 425.407 367.614 424.939 367.605 424.867C367.316 422.672 365.478 418.595 363.036 418.145C361.279 417.821 359.793 419.198 359.649 420.908C359.504 422.654 360.775 424.4 362.009 425.497C363.208 426.559 366.217 427.594 367.253 427.936C367.073 428.791 366.893 429.646 366.676 430.465C366.514 431.023 366.406 431.572 366.217 432.121C366.037 432.67 365.866 433.209 365.694 433.749C365.325 434.775 364.947 435.828 364.559 436.818C364.298 437.511 364.028 438.159 363.766 438.816C363.901 437.97 364.127 436.296 364.136 436.152C364.172 434.685 363.649 432.292 362.604 430.609C362.613 430.393 362.595 430.177 362.568 429.961C362.298 428.269 360.703 427.009 358.973 427.477C356.576 428.116 355.053 432.319 354.945 434.523C354.936 434.658 355.026 436.08 355.089 436.971C354.972 436.449 354.855 435.945 354.729 435.405C354.477 434.343 354.197 433.299 353.9 432.166C353.738 431.626 353.567 431.077 353.405 430.528C353.251 429.979 353.017 429.412 352.828 428.854C352.35 427.558 351.81 426.271 351.233 424.984C352.161 424.759 355.45 423.923 356.765 422.915C358.081 421.907 359.468 420.26 359.459 418.514C359.45 416.804 358.063 415.32 356.288 415.509C353.819 415.779 351.684 419.702 351.233 421.871C351.206 422.006 351.062 423.599 350.999 424.471C350.647 423.698 350.296 422.933 349.918 422.159C348.818 419.945 347.629 417.731 346.458 415.518C346.097 414.843 345.746 414.159 345.395 413.484C345.728 413.412 349.647 412.494 351.125 411.369C352.44 410.361 353.828 408.714 353.819 406.969C353.81 405.259 352.422 403.774 350.647 403.963C348.179 404.233 346.043 408.156 345.593 410.325C345.557 410.487 345.349 412.782 345.331 413.367C344.557 411.873 343.791 410.379 343.106 408.876C342.151 406.798 341.331 404.71 340.682 402.631C340.835 402.595 344.935 401.668 346.449 400.507C347.764 399.499 349.152 397.853 349.143 396.107C349.134 394.397 347.746 392.912 345.971 393.101C343.502 393.371 341.367 397.295 340.916 399.463C340.88 399.634 340.664 402.1 340.655 402.55C340.619 402.424 340.565 402.298 340.529 402.181C339.871 399.949 339.511 397.7 339.277 395.585C339.141 394.352 339.078 393.173 339.042 392.021C339.826 391.922 343.394 391.454 344.872 390.554C346.287 389.7 347.854 388.215 348.034 386.478C348.215 384.777 346.998 383.148 345.214 383.148C342.737 383.139 340.178 386.811 339.493 388.917C339.457 389.034 339.205 390.239 339.042 391.121C339.033 390.599 339.015 390.06 339.015 389.565C339.015 387.693 339.141 385.974 339.259 384.453C339.331 383.589 339.421 382.806 339.502 382.086C340.223 381.592 343.088 379.567 343.971 378.127C344.836 376.714 345.539 374.68 344.89 373.052C344.259 371.459 342.439 370.577 340.844 371.396C338.637 372.53 338.06 376.966 338.421 379.144C338.457 379.333 339.286 382.221 339.322 382.203C339.322 382.203 339.358 382.176 339.367 382.176C339.268 382.878 339.178 383.625 339.087 384.444C338.934 385.965 338.781 387.684 338.736 389.565C338.691 391.445 338.691 393.488 338.88 395.639C339.069 397.799 339.385 400.057 340.006 402.343C340.015 402.37 340.024 402.397 340.033 402.424C339.646 401.812 338.493 400.138 338.394 400.012C336.943 398.339 333.159 395.954 330.87 396.926C329.221 397.628 328.744 399.589 329.573 401.092C330.357 402.586 332.375 403.342 334.015 403.576Z" fill="#222222"/>
                            <path d="M376.561 391.94C376.597 391.967 377.354 389.052 377.381 388.863C377.687 386.667 376.984 382.258 374.75 381.178C373.137 380.404 371.344 381.34 370.758 382.941C370.155 384.588 370.92 386.604 371.821 387.99C372.867 389.619 376.561 391.931 376.561 391.94Z" fill="#222222"/>
                            <path d="M44.2664 416.435C45.1944 416.84 47.4469 416.786 47.456 416.786C47.483 416.786 46.9694 415.31 46.9244 415.22C46.4288 414.185 44.861 412.476 43.5816 412.647C42.6626 412.773 42.149 413.691 42.3562 414.554C42.5725 415.436 43.4825 416.093 44.2664 416.435Z" fill="#222222"/>
                            <path d="M45.0498 422.968C46.0049 423.112 48.0232 422.528 48.1853 422.474C48.5007 423.598 48.9242 424.732 49.4107 425.857C49.69 426.496 49.9874 427.135 50.2937 427.774C50.1135 427.504 49.9423 427.27 49.9153 427.234C49.1675 426.37 47.1942 425.128 46.0139 425.632C45.1579 425.992 44.9147 427.018 45.3381 427.792C45.7796 428.584 46.8248 428.98 47.6718 429.106C48.5367 429.232 50.2667 428.764 50.7172 428.638C50.8343 428.881 50.9515 429.124 51.0776 429.367C51.6633 430.528 52.2489 431.688 52.7895 432.84C52.9787 433.245 53.1499 433.65 53.3301 434.055C53.168 433.812 53.0238 433.614 53.0058 433.587C52.2579 432.723 50.2937 431.482 49.1044 431.985C48.2484 432.345 47.9961 433.371 48.4286 434.145C48.8701 434.937 49.9153 435.333 50.7622 435.459C51.5822 435.576 53.186 435.162 53.7266 435.018C53.8888 435.441 54.06 435.864 54.2041 436.278C54.2942 436.566 54.4023 436.836 54.4744 437.124C54.5555 437.412 54.6366 437.7 54.7177 437.979C54.8528 438.528 54.988 439.095 55.1051 439.635C55.1862 440.013 55.2583 440.363 55.3304 440.723C55.1412 440.318 54.7627 439.527 54.7267 439.464C54.114 438.492 52.357 436.971 51.1136 437.286C50.2126 437.511 49.8162 438.483 50.1225 439.32C50.4379 440.174 51.411 440.723 52.2309 440.966C53.1319 441.245 55.1322 440.993 55.3844 440.957C55.5016 441.551 55.6187 442.136 55.7088 442.685C55.7809 443.09 55.844 443.486 55.907 443.864H56.7089C56.6369 443.441 56.5468 443.009 56.4567 442.55C56.3395 441.947 56.1954 441.299 56.0512 440.633C56.2044 440.57 57.0513 440.228 57.8082 439.806C58.4659 440.516 60.1598 441.353 60.3761 441.461C60.1508 442.028 59.9165 442.568 59.6913 443.081C59.5742 443.351 59.457 443.612 59.3399 443.864H60.1869C60.2499 443.702 60.322 443.549 60.3851 443.378C60.6193 442.802 60.8626 442.19 61.1059 441.551C61.3492 441.605 63.3314 442.001 64.2504 441.794C65.0884 441.605 66.1065 441.128 66.4759 440.309C66.8453 439.5 66.512 438.501 65.638 438.204C64.4216 437.79 62.5565 439.176 61.8717 440.102C61.8357 440.156 61.4573 440.795 61.232 441.2C61.3311 440.939 61.4303 440.687 61.5204 440.417C61.7186 439.887 61.8898 439.356 62.088 438.78C62.1691 438.501 62.2592 438.213 62.3403 437.925C62.4304 437.646 62.4935 437.331 62.5655 437.034C62.7277 436.341 62.8629 435.621 62.989 434.901C63.4575 435.072 65.1154 435.648 65.9714 435.585C66.8273 435.522 67.8995 435.207 68.3951 434.451C68.8816 433.704 68.7104 432.669 67.8815 432.246C66.7372 431.661 64.6829 432.741 63.872 433.551C63.8179 433.605 63.3044 434.244 63.025 434.613C63.0971 434.181 63.1602 433.749 63.2143 433.308C63.3764 432.03 63.4936 430.735 63.6197 429.448C63.6558 429.052 63.7008 428.656 63.7459 428.26C63.908 428.323 65.8723 429.052 66.8363 428.98C67.6923 428.917 68.7645 428.602 69.2601 427.846C69.7466 427.099 69.5754 426.064 68.7465 425.641C67.6022 425.056 65.5479 426.136 64.737 426.946C64.6739 427.009 63.9261 427.936 63.7549 428.188C63.845 427.315 63.9441 426.451 64.0792 425.605C64.2594 424.435 64.5027 423.292 64.8181 422.213C64.8992 422.24 66.9354 423.013 67.9266 422.941C68.7825 422.878 69.8547 422.564 70.3503 421.808C70.8368 421.061 70.6656 420.026 69.8367 419.603C68.6924 419.018 66.6381 420.098 65.8272 420.908C65.7641 420.971 64.9622 421.97 64.8271 422.168C64.8451 422.105 64.8631 422.033 64.8811 421.97C65.2325 420.818 65.7191 419.738 66.2236 418.757C66.512 418.181 66.8273 417.65 67.1427 417.146C67.5121 417.326 69.188 418.145 70.08 418.181C70.936 418.217 72.0442 418.019 72.6208 417.317C73.1885 416.633 73.1254 415.58 72.3505 415.067C71.2783 414.356 69.1159 415.211 68.2239 415.922C68.1789 415.958 67.7193 416.408 67.395 416.741C67.5391 416.516 67.6833 416.273 67.8275 416.057C68.3681 415.247 68.9087 414.536 69.3952 413.916C69.6745 413.565 69.9358 413.25 70.1791 412.962C70.6296 412.953 72.4497 412.899 73.2516 412.521C74.0264 412.152 74.9184 411.477 75.1076 410.586C75.2878 409.713 74.7562 408.813 73.8372 408.714C72.5578 408.579 71.0351 410.325 70.5665 411.378C70.5305 411.468 70.053 412.962 70.08 412.962C70.08 412.962 70.098 412.962 70.107 412.962C69.8637 413.241 69.6115 413.538 69.3321 413.862C68.8276 414.473 68.269 415.175 67.7103 415.976C67.1517 416.777 66.566 417.659 66.0344 418.649C65.5028 419.639 64.9893 420.701 64.6018 421.871C64.6018 421.88 64.5928 421.898 64.5928 421.916C64.6018 421.538 64.5838 420.485 64.5748 420.404C64.4306 419.261 63.4756 417.155 62.2051 416.921C61.2951 416.75 60.5202 417.47 60.4481 418.352C60.3761 419.261 61.0338 420.161 61.6735 420.737C62.3943 421.385 64.4036 422.006 64.5568 422.051C64.1964 423.166 63.9261 424.336 63.7098 425.542C63.5837 426.226 63.4846 426.928 63.3945 427.63C63.3855 427.306 63.3855 427.009 63.3764 426.973C63.2323 425.83 62.2772 423.724 61.0068 423.49C60.0968 423.319 59.3219 424.039 59.2498 424.921C59.1777 425.83 59.8355 426.73 60.4752 427.306C61.1239 427.882 62.8268 428.449 63.2773 428.593C63.2413 428.863 63.2053 429.133 63.1782 429.403C63.025 430.69 62.8719 431.985 62.6917 433.236C62.6286 433.677 62.5475 434.118 62.4664 434.55C62.4574 434.262 62.4574 434.019 62.4484 433.983C62.3042 432.84 61.3492 430.735 60.0787 430.501C59.1687 430.33 58.3938 431.05 58.3218 431.931C58.2497 432.831 58.9074 433.74 59.5471 434.316C60.1688 434.865 61.7276 435.405 62.2682 435.576C62.1781 436.017 62.079 436.467 61.9709 436.89C61.8898 437.178 61.8267 437.466 61.7276 437.745C61.6375 438.033 61.5474 438.312 61.4573 438.591C61.2681 439.122 61.0698 439.671 60.8626 440.183C60.7275 440.543 60.5833 440.876 60.4481 441.218C60.5202 440.777 60.6374 439.913 60.6374 439.842C60.6554 439.077 60.3851 437.835 59.8445 436.971C59.8445 436.854 59.8445 436.746 59.8264 436.638C59.6823 435.756 58.8624 435.108 57.9613 435.351C56.7179 435.684 55.9251 437.862 55.871 439.014C55.871 439.086 55.916 439.824 55.9431 440.282C55.88 440.013 55.8259 439.752 55.7539 439.473C55.6277 438.924 55.4746 438.375 55.3214 437.79C55.2403 437.511 55.1502 437.223 55.0601 436.944C54.979 436.656 54.8619 436.368 54.7627 436.071C54.5195 435.396 54.2311 434.73 53.9338 434.064C54.4114 433.947 56.1233 433.515 56.808 432.993C57.4928 432.471 58.2136 431.616 58.2046 430.708C58.1956 429.817 57.4838 429.052 56.5558 429.151C55.2763 429.286 54.1681 431.329 53.9338 432.453C53.9158 432.525 53.8437 433.353 53.8077 433.803C53.6275 433.407 53.4473 433.002 53.249 432.606C52.6814 431.455 52.0597 430.312 51.456 429.16C51.2668 428.809 51.0866 428.458 50.9064 428.107C51.0776 428.071 53.1139 427.594 53.8798 427.009C54.5645 426.487 55.2853 425.632 55.2763 424.723C55.2673 423.832 54.5555 423.067 53.6275 423.166C52.348 423.301 51.2398 425.344 51.0055 426.469C50.9875 426.55 50.8794 427.738 50.8704 428.044C50.4649 427.27 50.0685 426.496 49.7171 425.713C49.2215 424.633 48.798 423.553 48.4647 422.474C48.5458 422.456 50.6721 421.97 51.456 421.367C52.1408 420.845 52.8616 419.99 52.8526 419.081C52.8436 418.19 52.1318 417.425 51.2037 417.524C49.9243 417.659 48.8161 419.702 48.5818 420.827C48.5638 420.917 48.4466 422.195 48.4466 422.429C48.4286 422.366 48.4016 422.303 48.3836 422.24C48.0412 421.079 47.852 419.918 47.7348 418.82C47.6628 418.181 47.6267 417.569 47.6087 416.966C48.0142 416.912 49.8612 416.669 50.6271 416.21C51.3659 415.769 52.1768 414.995 52.2669 414.096C52.357 413.214 51.7263 412.368 50.8073 412.368C49.5188 412.368 48.1944 414.267 47.8339 415.355C47.8159 415.418 47.6898 416.039 47.5997 416.498C47.5997 416.228 47.5817 415.949 47.5907 415.688C47.5907 414.716 47.6537 413.826 47.7168 413.034C47.7529 412.584 47.7979 412.179 47.843 411.801C48.2124 411.549 49.7081 410.496 50.1586 409.749C50.6091 409.02 50.9695 407.958 50.6361 407.112C50.3117 406.284 49.3657 405.825 48.5367 406.248C47.3925 406.842 47.0951 409.137 47.2843 410.271C47.3023 410.37 47.7348 411.873 47.7529 411.855C47.7529 411.855 47.7709 411.846 47.7709 411.837C47.7168 412.197 47.6718 412.593 47.6267 413.016C47.5456 413.808 47.4645 414.698 47.4465 415.67C47.4195 416.642 47.4195 417.704 47.5186 418.82C47.6177 419.936 47.7799 421.115 48.1043 422.303C48.1043 422.312 48.1133 422.33 48.1133 422.339C47.915 422.024 47.3114 421.151 47.2573 421.088C46.5095 420.224 44.5452 418.982 43.3559 419.486C42.4999 419.846 42.2477 420.872 42.6801 421.646C43.1487 422.456 44.2029 422.842 45.0498 422.968Z" fill="#222222"/>
                            <path d="M67.1244 416.93C67.1424 416.939 67.5389 415.427 67.5479 415.328C67.71 414.195 67.3406 411.9 66.1873 411.342C65.3494 410.937 64.4213 411.423 64.115 412.26C63.7996 413.115 64.1961 414.159 64.6646 414.879C65.2052 415.724 67.1244 416.93 67.1244 416.93Z" fill="#222222"/>
                            <path d="M83.6952 407.319C83.6952 407.319 82.5149 400.165 84.6593 399.562C86.8037 398.95 89.4527 402.838 89.4527 402.838C89.4527 402.838 91.6241 398.518 93.0117 400.129C94.3992 401.74 94.6065 403.305 94.6065 403.305C94.6065 403.305 98.1024 400.93 98.652 403.395C99.2016 405.861 95.2732 411.378 91.8313 412.583C88.3895 413.78 85.317 413.438 83.6952 407.319Z" fill="#222222"/>
                            <path d="M111.959 417.092C111.959 417.092 115.014 410.522 117.131 411.224C119.249 411.926 119.249 416.624 119.249 416.624C119.249 416.624 123.483 414.275 123.718 416.39C123.952 418.505 123.249 419.908 123.249 419.908C123.249 419.908 127.484 419.908 126.538 422.257C125.601 424.606 119.249 426.955 115.726 426.01C112.194 425.074 109.851 423.067 111.959 417.092Z" fill="#222222"/>
                            <path d="M87.8749 411.233C87.8749 411.233 86.7036 429.564 92.1727 443.414C92.1727 443.414 100.768 428.007 114.824 422.347" stroke="#222222" stroke-miterlimit="10"/>
                            <path d="M92.1735 443.414C92.1735 443.414 92.3717 438.932 86.9025 434.442C81.4334 429.96 78.1176 428.979 78.1176 428.979C78.1176 428.979 75.5768 433.47 80.6585 437.951C85.7222 442.442 92.1735 443.414 92.1735 443.414Z" fill="#222222"/>
                            <path d="M92.1738 443.414C92.1738 443.414 95.6878 437.753 98.6161 436.196C101.544 434.64 107.401 435.998 107.401 435.998C107.401 435.998 103.887 439.508 100.959 441.263C98.0304 443.027 92.1738 443.414 92.1738 443.414Z" fill="#222222"/>
                            <path d="M100.958 431.904C100.958 431.904 99.9851 429.762 101.544 425.47C103.103 421.177 104.67 419.036 104.67 419.036C104.67 419.036 105.644 420.79 104.869 424.696C104.085 428.593 100.958 431.904 100.958 431.904Z" fill="#222222"/>
                            <path d="M88.8496 427.027C88.8496 427.027 88.8496 422.932 91.7779 419.612C94.7062 416.3 97.6345 413.951 97.6345 413.951C97.6345 413.951 96.8506 420.781 94.508 423.121C92.1744 425.47 88.8496 427.027 88.8496 427.027Z" fill="#222222"/>
                            <path d="M88.4622 428.394C88.4622 428.394 87.0926 425.272 85.1464 423.715C83.1912 422.158 80.0647 420.592 80.0647 420.592C80.0647 420.592 78.506 423.715 80.6504 425.668C82.7948 427.611 88.4622 428.394 88.4622 428.394Z" fill="#222222"/>
                            <path d="M103.5 429.564C103.5 429.564 103.698 428.98 107.014 428.593C110.33 428.206 112.871 429.762 112.871 429.762C112.871 429.762 111.501 431.517 107.987 431.13C104.473 430.734 103.5 429.564 103.5 429.564Z" fill="#222222"/>
                            <path d="M318.328 405.249C318.328 405.249 315.273 398.68 313.156 399.382C311.038 400.084 311.038 404.781 311.038 404.781C311.038 404.781 306.804 402.433 306.569 404.547C306.335 406.662 307.038 408.066 307.038 408.066C307.038 408.066 302.803 408.066 303.749 410.415C304.686 412.764 311.038 415.112 314.561 414.167C318.084 413.231 320.427 411.225 318.328 405.249Z" fill="#222222"/>
                            <path d="M313.579 417.092C313.579 417.092 310.525 410.523 308.408 411.225C306.29 411.927 306.29 416.624 306.29 416.624C306.29 416.624 302.056 414.275 301.821 416.39C301.587 418.505 302.29 419.909 302.29 419.909C302.29 419.909 298.055 419.909 299.001 422.258C299.938 424.606 306.29 426.955 309.813 426.01C313.336 425.065 315.688 423.067 313.579 417.092Z" fill="#222222"/>
                            <path d="M326.68 443.594C326.626 443.45 320.923 428.773 310.543 423.706L310.939 422.896C318.571 426.622 323.635 435.081 325.995 439.85C321.95 419.18 315.454 411.837 315.39 411.756L316.057 411.153C316.364 411.486 323.545 419.576 327.554 443.36L326.68 443.594Z" fill="#222222"/>
                            <path d="M327.545 443.36C327.545 443.36 326.185 435.729 327.392 432.948C328.6 430.168 332.041 424.408 332.041 424.408C332.041 424.408 333.807 427.747 332.6 432.39C331.393 437.034 327.545 443.36 327.545 443.36Z" fill="#222222"/>
                            <path d="M327.122 443.162C327.122 443.162 325.546 439.914 321.545 437.124C317.545 434.343 312.066 431.185 312.066 431.185C312.066 431.185 312.256 435.738 316.626 438.519C320.986 441.308 327.122 443.162 327.122 443.162Z" fill="#222222"/>
                            <path d="M326.374 438.617C326.374 438.617 322.562 427.477 322.562 421.816C322.562 416.156 324.238 407.148 324.238 407.148C324.238 407.148 324.428 409.191 325.446 417.452C326.464 425.713 326.374 438.617 326.374 438.617Z" fill="#222222"/>
                            <path d="M321.824 433.326C321.824 433.326 319.22 430.545 317.454 429.708C315.688 428.871 313.453 427.854 313.453 427.854C313.453 427.854 314.471 430.545 316.517 431.85C318.562 433.146 324.049 436.403 324.049 436.403L321.824 433.326Z" fill="#222222"/>
                            <path d="M416.953 443.882H429.099" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0 443.882H411.115" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M404.132 195.205C404.132 195.205 396.753 183.407 386.41 183.83C376.075 184.253 376.282 196.897 372.912 196.258C369.534 195.628 364.893 190.571 360.253 192.883C355.613 195.205 353.081 199.417 352.027 200.047C350.973 200.676 345.233 197.059 342.323 199.201C339.413 201.342 336.313 202.224 336.313 202.224C336.313 202.224 333.25 201.306 332.196 201.306C331.141 201.306 323.113 205.068 323.113 205.068H426.694C426.694 205.068 421.846 197.086 418.468 195.196C415.089 193.297 410.241 196.042 407.71 196.672C405.187 197.311 404.132 195.205 404.132 195.205Z" stroke="#222222" stroke-miterlimit="10"/>
                            <path d="M97.1207 79.0647C97.1207 79.0647 89.7414 67.2671 79.3978 67.6901C69.0632 68.113 69.2704 80.7565 65.9006 80.1176C62.5218 79.4877 57.8816 74.4303 53.2414 76.743C48.6011 79.0647 46.0693 83.2762 45.0151 83.9062C43.9609 84.5361 38.2215 80.9185 35.3112 83.0603C32.4009 85.202 29.3014 86.0839 29.3014 86.0839C29.3014 86.0839 26.238 85.166 25.1838 85.166C24.1296 85.166 16.1016 88.9276 16.1016 88.9276H119.682C119.682 88.9276 114.835 80.9455 111.456 79.0557C108.077 77.157 103.23 79.9016 100.698 80.5316C98.1749 81.1705 97.1207 79.0647 97.1207 79.0647Z" stroke="#222222" stroke-miterlimit="10"/>
                            <path d="M192.258 262.535C192.258 262.535 192.87 262.382 194.015 262.148" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M197.538 261.446C217.73 257.712 289.126 248.425 293.766 302.886C298.28 355.89 191.411 383.832 102.508 365.141C20.9391 347.998 -42.7446 259.493 82.136 197.842C207.017 136.19 324.518 181.023 381.12 130.017C433.991 82.3672 392.382 54.7765 374.632 47.2354" stroke="#222222" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="4 4"/>
                            <path d="M372.965 46.5604C372.362 46.3264 371.794 46.1194 371.271 45.9395" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M348.864 106.431H82.1816V249.289H348.864V106.431Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M215.523 184.362L82.1816 106.431V249.289H348.864V106.431L215.523 184.362Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M82.1816 106.431L208.252 22.9023C212.658 19.9867 218.388 19.9867 222.794 22.9023L348.864 106.431H82.1816Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M82.1816 249.289L208.549 173.95C212.847 171.385 218.208 171.385 222.506 173.95L348.873 249.289H82.1816Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M152.514 59.8339L93.4707 98.9523L106.229 202.08L341.727 173.023L332.122 95.3437L258.744 46.7224L152.514 59.8339Z" fill="#222222"/>
                            <path d="M328.482 32.1567L92.9707 61.2124L109.604 195.702L345.116 166.646L328.482 32.1567Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M274.917 156.186C274.935 156.195 275.142 154.629 275.142 154.521C275.16 153.36 274.511 151.101 273.277 150.678C272.385 150.372 271.511 150.984 271.304 151.857C271.096 152.757 271.628 153.756 272.187 154.422C272.844 155.214 274.917 156.186 274.917 156.186Z" fill="#B2B2B2"/>
                            <path d="M293.389 136.127C293.389 136.127 293.416 136.109 293.416 136.1C293.407 136.613 293.407 137.162 293.416 137.765C293.443 138.881 293.479 140.132 293.623 141.499C293.758 142.867 293.938 144.343 294.272 145.882C294.605 147.421 295.029 149.031 295.686 150.633C295.695 150.651 295.704 150.669 295.713 150.687C295.38 150.282 294.398 149.166 294.308 149.094C293.109 148.015 290.154 146.629 288.595 147.529C287.469 148.177 287.298 149.643 288.028 150.66C288.776 151.695 290.307 152.064 291.506 152.091C292.866 152.118 295.578 150.957 295.794 150.867C296.434 152.388 297.209 153.891 298.083 155.367C298.579 156.213 299.11 157.05 299.651 157.886C299.344 157.544 299.074 157.239 299.029 157.203C297.831 156.123 294.875 154.737 293.317 155.637C292.19 156.285 292.019 157.751 292.749 158.768C293.497 159.803 295.029 160.172 296.227 160.199C297.452 160.226 299.777 159.281 300.399 159.02C300.606 159.335 300.813 159.659 301.029 159.974C302.048 161.495 303.066 163.007 304.012 164.519C304.345 165.05 304.66 165.59 304.976 166.12C304.706 165.815 304.48 165.563 304.435 165.527C303.237 164.447 300.282 163.061 298.723 163.961C297.597 164.609 297.425 166.075 298.155 167.092C298.903 168.127 300.435 168.496 301.633 168.523C302.804 168.55 304.958 167.695 305.688 167.398C305.994 167.956 306.3 168.514 306.571 169.072C306.751 169.459 306.94 169.81 307.093 170.206C307.183 170.431 307.273 170.647 307.363 170.863L308.31 170.746C308.174 170.449 308.048 170.152 307.913 169.855C307.751 169.468 307.535 169.081 307.345 168.694C306.886 167.803 306.381 166.912 305.85 166.039C306.499 165.797 308.805 164.897 309.661 164.051C310.517 163.205 311.382 161.891 311.211 160.631C311.049 159.389 309.913 158.444 308.652 158.741C306.895 159.155 305.697 162.188 305.561 163.79C305.552 163.889 305.589 165.05 305.625 165.689C305.3 165.167 304.976 164.636 304.633 164.114C303.642 162.611 302.579 161.117 301.534 159.623C301.21 159.164 300.903 158.705 300.588 158.246C300.822 158.165 303.579 157.158 304.543 156.204C305.399 155.358 306.264 154.044 306.093 152.784C305.931 151.542 304.796 150.597 303.534 150.894C301.777 151.308 300.579 154.341 300.444 155.943C300.435 156.06 300.489 157.742 300.525 158.165C299.831 157.158 299.146 156.141 298.516 155.115C297.642 153.702 296.858 152.262 296.209 150.813C296.317 150.777 299.2 149.733 300.191 148.761C301.047 147.916 301.912 146.602 301.741 145.342C301.579 144.1 300.444 143.155 299.182 143.452C297.425 143.866 296.227 146.899 296.092 148.501C296.083 148.627 296.146 150.426 296.173 150.75C296.137 150.66 296.083 150.579 296.047 150.489C295.371 148.932 294.911 147.34 294.551 145.828C294.344 144.946 294.191 144.1 294.065 143.272C294.623 143.137 297.155 142.471 298.146 141.697C299.092 140.95 300.092 139.736 300.065 138.467C300.038 137.216 299.02 136.154 297.723 136.307C295.93 136.523 294.407 139.403 294.101 140.986C294.083 141.076 294.01 141.967 293.965 142.615C293.911 142.237 293.848 141.85 293.812 141.49C293.65 140.132 293.578 138.881 293.524 137.774C293.497 137.144 293.488 136.568 293.488 136.037C293.965 135.614 295.858 133.895 296.362 132.77C296.858 131.673 297.182 130.134 296.578 129.018C295.984 127.92 294.578 127.443 293.506 128.181C292.01 129.198 291.992 132.455 292.452 134.003C292.506 134.129 293.362 136.145 293.389 136.127Z" fill="#B2B2B2"/>
                            <path d="M309.562 170.575L315.131 169.891C314.96 169.603 314.779 169.324 314.581 169.072C314.563 168.91 314.536 168.757 314.491 168.604C314.14 167.407 312.878 166.643 311.671 167.128C310.563 167.578 309.869 169.117 309.562 170.575Z" fill="#B2B2B2"/>
                            <path d="M289.29 143.11C290.65 143.515 293.786 143.056 293.786 143.056C293.822 143.047 292.858 141.076 292.777 140.959C291.903 139.601 289.425 137.486 287.677 137.945C286.415 138.278 285.866 139.646 286.298 140.815C286.758 142.003 288.136 142.768 289.29 143.11Z" fill="#B2B2B2"/>
                            <path d="M131.459 192.316C131.261 192.388 131.098 192.505 130.945 192.622L133.234 192.343C132.603 192.154 131.981 192.109 131.459 192.316Z" fill="#B2B2B2"/>
                            <path d="M302.435 171.016C302.12 171.142 301.867 171.331 301.66 171.556L304.679 171.187C303.877 170.872 303.084 170.764 302.435 171.016Z" fill="#B2B2B2"/>
                            <path d="M313.707 165.419C314.662 166.085 316.942 166.561 317.717 166.714C317.663 167.344 317.609 167.983 317.527 168.595C317.473 168.937 317.437 169.27 317.374 169.612L318.293 169.495C318.329 169.234 318.356 168.973 318.392 168.703C318.501 167.704 318.564 166.687 318.609 165.662C319.284 165.815 321.699 166.336 322.889 166.103C324.069 165.869 325.519 165.248 326.078 164.105C326.628 162.98 326.204 161.567 324.988 161.117C323.294 160.496 320.618 162.359 319.627 163.628C319.564 163.709 318.951 164.699 318.627 165.248C318.645 164.627 318.672 164.015 318.672 163.394C318.672 161.594 318.618 159.767 318.573 157.94C318.555 157.383 318.546 156.825 318.537 156.267C318.78 156.321 321.636 157.005 322.97 156.744C324.15 156.51 325.601 155.889 326.159 154.746C326.709 153.621 326.285 152.208 325.069 151.758C323.375 151.137 320.699 153 319.708 154.269C319.636 154.368 318.753 155.79 318.546 156.168C318.528 154.944 318.51 153.72 318.555 152.514C318.609 150.849 318.753 149.22 319.005 147.655C319.113 147.682 322.096 148.402 323.456 148.141C324.636 147.907 326.087 147.286 326.646 146.143C327.195 145.018 326.772 143.605 325.556 143.155C323.862 142.534 321.186 144.397 320.194 145.666C320.113 145.765 319.167 147.304 319.023 147.592C319.041 147.502 319.041 147.403 319.059 147.304C319.357 145.63 319.843 144.055 320.384 142.597C320.69 141.751 321.032 140.959 321.384 140.195C321.924 140.384 324.402 141.229 325.664 141.13C326.862 141.031 328.367 140.573 329.051 139.493C329.718 138.44 329.457 136.982 328.295 136.406C326.673 135.596 323.817 137.162 322.69 138.314C322.627 138.377 322.078 139.079 321.681 139.601C321.843 139.259 322.006 138.899 322.168 138.575C322.78 137.351 323.411 136.271 323.988 135.317C324.312 134.777 324.627 134.3 324.916 133.85C325.547 133.76 328.078 133.373 329.124 132.716C330.142 132.078 331.268 130.971 331.376 129.702C331.484 128.46 330.583 127.29 329.277 127.308C327.466 127.335 325.655 130.044 325.177 131.583C325.132 131.718 324.736 133.877 324.772 133.868C324.772 133.868 324.799 133.868 324.808 133.859C324.519 134.282 324.213 134.741 323.889 135.254C323.294 136.199 322.636 137.27 321.997 138.476C321.357 139.691 320.69 141.022 320.113 142.489C319.537 143.956 319.005 145.54 318.672 147.232C318.672 147.25 318.663 147.268 318.663 147.295C318.609 146.773 318.401 145.306 318.374 145.189C317.969 143.623 316.275 140.842 314.473 140.734C313.176 140.654 312.221 141.787 312.275 143.029C312.329 144.307 313.401 145.45 314.392 146.134C315.509 146.908 318.41 147.43 318.645 147.475C318.338 149.095 318.158 150.777 318.068 152.487C318.014 153.468 317.996 154.458 317.987 155.448C317.924 154.998 317.861 154.593 317.852 154.53C317.446 152.964 315.752 150.183 313.95 150.075C312.653 149.994 311.698 151.128 311.752 152.37C311.806 153.648 312.878 154.791 313.869 155.475C314.879 156.168 317.338 156.672 317.996 156.789C317.996 157.167 317.996 157.554 317.996 157.931C318.005 159.758 318.023 161.576 317.978 163.367C317.96 163.997 317.924 164.618 317.897 165.239C317.843 164.834 317.789 164.501 317.78 164.447C317.374 162.881 315.68 160.1 313.878 159.992C312.581 159.911 311.626 161.045 311.68 162.287C311.644 163.592 312.716 164.735 313.707 165.419Z" fill="#B2B2B2"/>
                            <path d="M321.229 139.871C321.256 139.889 321.544 137.711 321.544 137.567C321.571 135.956 320.67 132.824 318.958 132.248C317.724 131.834 316.508 132.662 316.228 133.886C315.94 135.128 316.67 136.523 317.445 137.441C318.355 138.521 321.229 139.871 321.229 139.871Z" fill="#B2B2B2"/>
                            <path d="M254.816 153.486L254.834 153.468C254.825 153.837 254.825 154.233 254.834 154.674C254.852 155.475 254.879 156.384 254.978 157.365C255.077 158.345 255.203 159.416 255.447 160.532C255.69 161.648 255.996 162.809 256.465 163.961C256.474 163.97 256.474 163.988 256.483 163.997C256.24 163.7 255.528 162.899 255.474 162.845C254.609 162.062 252.482 161.063 251.347 161.72C250.536 162.188 250.41 163.25 250.933 163.979C251.473 164.726 252.572 164.987 253.446 165.014C254.429 165.032 256.384 164.195 256.537 164.132C256.996 165.23 257.555 166.31 258.186 167.38C258.546 167.992 258.925 168.595 259.312 169.198C259.096 168.946 258.898 168.73 258.861 168.703C257.996 167.92 255.861 166.921 254.735 167.578C253.924 168.046 253.798 169.108 254.32 169.837C254.861 170.584 255.96 170.845 256.834 170.872C257.717 170.89 259.402 170.206 259.844 170.026C259.997 170.251 260.141 170.485 260.294 170.71C261.024 171.808 261.763 172.897 262.448 173.986C262.691 174.373 262.916 174.76 263.141 175.146C262.943 174.931 262.781 174.742 262.754 174.715C261.889 173.932 259.763 172.933 258.627 173.59C257.816 174.058 257.69 175.119 258.213 175.848C258.546 176.316 259.105 176.586 259.681 176.739L262.961 176.334C263.249 176.226 263.502 176.127 263.655 176.064C263.691 176.118 263.718 176.181 263.745 176.235L264.394 176.154C264.195 175.794 263.979 175.434 263.763 175.075C264.232 174.895 265.898 174.247 266.52 173.635C267.142 173.023 267.763 172.078 267.646 171.16C267.529 170.269 266.709 169.585 265.799 169.792C264.529 170.089 263.664 172.276 263.574 173.437C263.565 173.509 263.592 174.346 263.619 174.814C263.385 174.436 263.15 174.058 262.907 173.68C262.186 172.591 261.429 171.511 260.673 170.44C260.438 170.107 260.213 169.774 259.988 169.45C260.159 169.387 262.15 168.658 262.844 167.974C263.466 167.362 264.087 166.418 263.961 165.5C263.844 164.609 263.024 163.925 262.114 164.141C260.844 164.438 259.979 166.624 259.889 167.785C259.88 167.875 259.925 169.081 259.943 169.387C259.438 168.658 258.943 167.929 258.492 167.182C257.861 166.157 257.294 165.122 256.825 164.078C256.906 164.051 258.988 163.295 259.699 162.593C260.321 161.981 260.943 161.036 260.817 160.118C260.7 159.227 259.88 158.543 258.97 158.759C257.699 159.056 256.834 161.243 256.744 162.404C256.735 162.494 256.78 163.799 256.807 164.033C256.78 163.97 256.744 163.907 256.717 163.844C256.231 162.719 255.897 161.576 255.636 160.478C255.483 159.848 255.375 159.227 255.284 158.633C255.69 158.534 257.519 158.057 258.231 157.491C258.916 156.951 259.636 156.078 259.618 155.16C259.6 154.26 258.861 153.486 257.933 153.603C256.636 153.756 255.537 155.844 255.32 156.987C255.311 157.05 255.257 157.698 255.221 158.165C255.185 157.896 255.14 157.617 255.104 157.356C254.987 156.375 254.933 155.475 254.897 154.674C254.879 154.215 254.87 153.81 254.87 153.423C255.212 153.117 256.582 151.875 256.951 151.065C257.312 150.273 257.546 149.167 257.105 148.357C256.672 147.565 255.663 147.223 254.888 147.754C253.807 148.492 253.798 150.84 254.122 151.956C254.176 152.046 254.798 153.504 254.816 153.486Z" fill="#B2B2B2"/>
                            <path d="M138.477 191.687L143.766 191.03C143.63 190.814 143.486 190.598 143.333 190.409C143.315 190.256 143.288 190.103 143.252 189.95C142.91 188.78 141.675 188.024 140.495 188.501C139.459 188.933 138.801 190.328 138.477 191.687Z" fill="#B2B2B2"/>
                            <path d="M122.611 158.183C122.611 158.183 122.638 158.165 122.638 158.156C122.629 158.66 122.629 159.2 122.638 159.785C122.665 160.874 122.701 162.098 122.836 163.439C122.962 164.771 123.142 166.219 123.467 167.722C123.791 169.234 124.206 170.8 124.854 172.366C124.863 172.384 124.872 172.402 124.881 172.42C124.548 172.024 123.593 170.935 123.512 170.863C122.34 169.801 119.448 168.451 117.926 169.333C116.826 169.972 116.655 171.403 117.367 172.393C118.097 173.401 119.592 173.761 120.773 173.788C122.106 173.815 124.755 172.681 124.962 172.591C125.584 174.076 126.35 175.551 127.197 176.991C127.684 177.819 128.197 178.638 128.729 179.457C128.431 179.124 128.161 178.827 128.125 178.782C126.954 177.72 124.061 176.37 122.539 177.252C121.439 177.891 121.268 179.322 121.98 180.312C122.71 181.32 124.206 181.68 125.386 181.707C126.584 181.734 128.864 180.807 129.459 180.555C129.666 180.87 129.864 181.176 130.071 181.491C131.062 182.975 132.062 184.451 132.99 185.936C133.324 186.458 133.621 186.98 133.928 187.511C133.666 187.214 133.441 186.962 133.405 186.926C132.234 185.873 129.341 184.514 127.819 185.396C126.719 186.035 126.548 187.466 127.26 188.456C127.99 189.464 129.486 189.824 130.666 189.851C131.81 189.878 133.919 189.041 134.63 188.744C134.928 189.293 135.225 189.842 135.495 190.382C135.667 190.76 135.856 191.102 136.009 191.489C136.072 191.641 136.135 191.794 136.198 191.947L137.117 191.83C137.018 191.596 136.91 191.372 136.811 191.138C136.658 190.76 136.441 190.382 136.252 190.004C135.802 189.131 135.306 188.267 134.784 187.403C135.423 187.169 137.676 186.287 138.514 185.459C139.352 184.631 140.199 183.344 140.036 182.112C139.874 180.897 138.766 179.97 137.532 180.267C135.811 180.672 134.639 183.632 134.513 185.207C134.504 185.306 134.54 186.44 134.576 187.07C134.261 186.557 133.946 186.044 133.612 185.531C132.639 184.055 131.603 182.598 130.585 181.14C130.269 180.69 129.963 180.24 129.657 179.79C129.882 179.709 132.585 178.719 133.531 177.792C134.369 176.964 135.216 175.677 135.054 174.444C134.892 173.23 133.783 172.303 132.549 172.6C130.828 173.005 129.657 175.965 129.531 177.54C129.522 177.657 129.576 179.295 129.612 179.709C128.927 178.719 128.26 177.729 127.638 176.721C126.783 175.335 126.017 173.932 125.377 172.51C125.485 172.474 128.305 171.457 129.269 170.503C130.107 169.675 130.954 168.388 130.792 167.155C130.63 165.94 129.531 165.014 128.287 165.311C126.566 165.716 125.395 168.676 125.269 170.251C125.26 170.377 125.314 172.141 125.35 172.456C125.314 172.375 125.26 172.285 125.224 172.204C124.557 170.683 124.106 169.126 123.755 167.65C123.548 166.795 123.404 165.958 123.278 165.149C123.818 165.014 126.305 164.366 127.269 163.601C128.197 162.872 129.17 161.684 129.152 160.442C129.125 159.218 128.125 158.174 126.864 158.327C125.107 158.543 123.62 161.36 123.323 162.908C123.305 162.989 123.232 163.871 123.196 164.501C123.142 164.132 123.088 163.754 123.043 163.403C122.881 162.08 122.818 160.856 122.764 159.767C122.737 159.146 122.728 158.588 122.728 158.066C123.196 157.652 125.044 155.97 125.548 154.872C126.035 153.801 126.35 152.298 125.755 151.2C125.17 150.129 123.8 149.661 122.755 150.381C121.295 151.38 121.268 154.566 121.719 156.078C121.746 156.231 122.584 158.201 122.611 158.183Z" fill="#B2B2B2"/>
                            <path d="M118.601 165.014C119.925 165.41 122.998 164.96 123.007 164.96C123.043 164.951 122.097 163.025 122.024 162.908C121.178 161.576 118.745 159.506 117.033 159.956C115.798 160.28 115.258 161.621 115.69 162.764C116.123 163.934 117.465 164.681 118.601 165.014Z" fill="#B2B2B2"/>
                            <path d="M142.487 186.845C143.424 187.493 145.65 187.961 146.407 188.114C146.353 188.735 146.299 189.356 146.218 189.959C146.173 190.229 146.146 190.49 146.1 190.76L146.992 190.652C147.011 190.463 147.038 190.265 147.056 190.076C147.164 189.095 147.227 188.105 147.272 187.097C147.939 187.25 150.299 187.754 151.462 187.529C152.615 187.304 154.029 186.692 154.579 185.576C155.12 184.478 154.705 183.092 153.507 182.651C151.849 182.04 149.236 183.866 148.263 185.108C148.2 185.189 147.605 186.152 147.281 186.692C147.299 186.089 147.326 185.486 147.326 184.874C147.326 183.11 147.272 181.32 147.227 179.538C147.209 178.989 147.209 178.449 147.191 177.9C147.425 177.954 150.218 178.62 151.525 178.368C152.678 178.143 154.092 177.531 154.642 176.415C155.183 175.317 154.768 173.932 153.57 173.491C151.912 172.879 149.299 174.705 148.326 175.947C148.254 176.037 147.389 177.441 147.191 177.801C147.173 176.604 147.164 175.407 147.2 174.228C147.254 172.6 147.389 171.007 147.641 169.477C147.749 169.504 150.669 170.206 152.002 169.945C153.164 169.72 154.57 169.108 155.12 167.992C155.66 166.894 155.246 165.509 154.047 165.068C152.39 164.456 149.777 166.282 148.804 167.524C148.731 167.623 147.803 169.126 147.65 169.405C147.668 169.315 147.668 169.216 147.686 169.126C147.975 167.488 148.461 165.94 148.984 164.519C149.29 163.691 149.623 162.917 149.966 162.161C150.497 162.35 152.921 163.178 154.147 163.07C155.318 162.971 156.796 162.521 157.462 161.468C158.12 160.433 157.859 159.011 156.723 158.444C155.138 157.652 152.345 159.182 151.236 160.307C151.173 160.37 150.633 161.063 150.245 161.567C150.407 161.234 150.561 160.883 150.723 160.568C151.317 159.371 151.939 158.318 152.498 157.382C152.822 156.852 153.119 156.384 153.408 155.943C154.02 155.853 156.498 155.475 157.516 154.827C158.516 154.197 159.616 153.126 159.715 151.875C159.823 150.66 158.94 149.517 157.66 149.535C155.895 149.562 154.11 152.208 153.651 153.72C153.615 153.855 153.228 155.961 153.255 155.961C153.255 155.961 153.282 155.961 153.291 155.952C153.002 156.366 152.705 156.816 152.39 157.31C151.813 158.228 151.164 159.281 150.542 160.469C149.912 161.657 149.263 162.962 148.704 164.393C148.137 165.832 147.623 167.371 147.29 169.027C147.29 169.045 147.281 169.063 147.281 169.081C147.227 168.568 147.029 167.128 147.001 167.02C146.605 165.491 144.947 162.773 143.181 162.665C141.911 162.593 140.974 163.691 141.028 164.915C141.082 166.156 142.127 167.281 143.1 167.956C144.19 168.712 147.029 169.225 147.263 169.27C146.965 170.854 146.785 172.501 146.695 174.174C146.641 175.137 146.623 176.1 146.614 177.072C146.551 176.631 146.497 176.235 146.479 176.181C146.082 174.651 144.425 171.934 142.659 171.826C141.388 171.754 140.451 172.852 140.505 174.075C140.559 175.317 141.604 176.442 142.578 177.117C143.56 177.801 145.974 178.287 146.614 178.404C146.614 178.773 146.614 179.151 146.614 179.52C146.623 181.302 146.632 183.083 146.596 184.838C146.587 185.45 146.551 186.062 146.515 186.665C146.461 186.269 146.407 185.936 146.398 185.891C146.001 184.361 144.344 181.644 142.578 181.536C141.307 181.464 140.37 182.562 140.424 183.785C140.469 185.054 141.514 186.179 142.487 186.845Z" fill="#B2B2B2"/>
                            <path d="M251.86 158.525C252.842 158.813 255.104 158.48 255.113 158.48C255.14 158.48 254.437 157.05 254.383 156.969C253.752 155.988 251.968 154.458 250.698 154.791C249.788 155.034 249.391 156.015 249.707 156.861C250.031 157.734 251.022 158.282 251.86 158.525Z" fill="#B2B2B2"/>
                            <path d="M149.848 161.846C149.875 161.864 150.155 159.731 150.155 159.596C150.182 158.022 149.299 154.953 147.623 154.386C146.415 153.981 145.226 154.791 144.947 155.988C144.667 157.203 145.379 158.561 146.136 159.47C147.037 160.523 149.848 161.846 149.848 161.846Z" fill="#B2B2B2"/>
                            <path d="M269.484 174.634C269.88 174.913 270.583 175.138 271.223 175.309L273.007 175.093C273.007 175.003 273.016 174.913 273.025 174.823C273.187 174.859 273.493 174.922 273.854 174.994L277.665 174.526C277.981 174.31 278.251 174.04 278.422 173.707C278.818 172.897 278.512 171.871 277.629 171.547C276.404 171.097 274.476 172.447 273.755 173.365C273.71 173.419 273.268 174.139 273.034 174.535C273.052 174.085 273.061 173.644 273.07 173.194C273.07 171.889 273.034 170.575 272.998 169.261C272.989 168.856 272.98 168.46 272.971 168.055C273.142 168.1 275.205 168.586 276.169 168.397C277.025 168.226 278.062 167.776 278.467 166.958C278.863 166.148 278.557 165.122 277.674 164.798C276.449 164.348 274.521 165.698 273.8 166.607C273.746 166.679 273.115 167.704 272.962 167.974C272.944 167.093 272.935 166.211 272.971 165.338C273.007 164.141 273.115 162.962 273.295 161.828C273.376 161.846 275.53 162.368 276.512 162.179C277.368 162.008 278.413 161.558 278.809 160.739C279.206 159.929 278.9 158.912 278.017 158.58C276.791 158.13 274.863 159.479 274.142 160.388C274.088 160.46 273.403 161.567 273.295 161.783C273.304 161.72 273.313 161.648 273.322 161.576C273.539 160.37 273.89 159.227 274.277 158.175C274.503 157.563 274.746 156.987 274.998 156.438C275.386 156.573 277.179 157.185 278.089 157.113C278.954 157.041 280.044 156.708 280.53 155.934C281.017 155.169 280.828 154.125 279.981 153.702C278.809 153.117 276.746 154.251 275.935 155.079C275.89 155.124 275.494 155.637 275.205 156.006C275.323 155.763 275.44 155.502 275.557 155.268C275.998 154.386 276.458 153.603 276.863 152.919C277.098 152.532 277.323 152.181 277.53 151.857C277.98 151.794 279.81 151.515 280.566 151.038C281.305 150.579 282.116 149.779 282.188 148.861C282.269 147.961 281.612 147.115 280.675 147.133C279.368 147.151 278.053 149.104 277.719 150.219C277.692 150.318 277.404 151.875 277.431 151.866C277.431 151.866 277.449 151.866 277.458 151.866C277.251 152.172 277.025 152.505 276.791 152.874C276.368 153.558 275.89 154.323 275.422 155.205C274.962 156.078 274.476 157.041 274.061 158.103C273.647 159.164 273.259 160.298 273.016 161.522C273.016 161.54 273.016 161.549 273.007 161.567C272.971 161.189 272.818 160.127 272.8 160.046C272.511 158.921 271.286 156.915 269.98 156.834C269.042 156.78 268.349 157.59 268.394 158.49C268.43 159.407 269.205 160.235 269.916 160.73C270.727 161.288 272.818 161.666 272.989 161.693C272.773 162.863 272.637 164.078 272.574 165.311C272.538 166.022 272.52 166.733 272.511 167.443C272.466 167.12 272.421 166.823 272.412 166.787C272.124 165.662 270.899 163.655 269.592 163.574C268.655 163.52 267.961 164.33 268.006 165.23C268.042 166.148 268.817 166.976 269.529 167.47C270.259 167.974 272.034 168.334 272.502 168.424C272.502 168.703 272.502 168.973 272.502 169.252C272.511 170.566 272.52 171.889 272.493 173.176C272.484 173.635 272.457 174.076 272.43 174.526C272.385 174.238 272.349 173.995 272.34 173.95C272.052 172.825 270.826 170.818 269.52 170.737C268.583 170.683 267.889 171.493 267.925 172.393C267.997 173.311 268.772 174.139 269.484 174.634Z" fill="#B2B2B2"/>
                            <path class="theme-color" d="M224.452 147.268C230.524 132.959 213.82 135.02 223.19 147.421C213.82 135.011 207.251 150.489 222.695 148.582C207.251 150.489 217.388 163.907 223.46 149.589C217.388 163.898 234.092 161.837 224.722 149.436C234.101 161.846 240.661 146.368 225.217 148.276C240.661 146.377 230.524 132.959 224.452 147.268Z" fill="#C78665"/>
                            <path d="M228.019 147.934C227.74 145.693 225.703 144.1 223.46 144.379C221.216 144.658 219.622 146.692 219.901 148.933C220.18 151.173 222.216 152.766 224.46 152.487C226.704 152.208 228.289 150.174 228.019 147.934Z" fill="white"/>
                            <path class="theme-color" d="M296.029 53.8587C301.138 41.8091 287.082 43.5459 294.975 53.9937C287.082 43.5549 281.559 56.5764 294.56 54.9745C281.559 56.5764 290.091 67.87 295.2 55.8204C290.091 67.87 304.147 66.1332 296.254 55.6855C304.147 66.1242 309.67 53.1028 296.669 54.7046C309.67 53.1028 301.138 41.8091 296.029 53.8587Z" fill="#C78665"/>
                            <path d="M299.03 54.4165C298.796 52.5357 297.075 51.1949 295.192 51.4289C293.309 51.6628 291.966 53.3816 292.2 55.2624C292.435 57.1432 294.156 58.484 296.039 58.2501C297.922 58.0161 299.264 56.2973 299.03 54.4165Z" fill="white"/>
                            <path class="theme-color" d="M182.528 165.968C194.115 162.278 184.393 153.432 181.798 165.302C184.393 153.432 171.86 157.428 180.852 165.599C171.86 157.419 169.058 170.251 180.645 166.561C169.058 170.251 178.78 179.097 181.374 167.227C178.78 179.097 191.313 175.101 182.321 166.93C191.313 175.11 194.115 162.278 182.528 165.968Z" fill="#C78665"/>
                            <path d="M183.952 168.415C185.142 167.11 185.042 165.094 183.745 163.907C182.439 162.719 180.42 162.818 179.231 164.114C178.042 165.418 178.141 167.434 179.438 168.622C180.736 169.819 182.763 169.72 183.952 168.415Z" fill="white"/>
                            <path class="theme-color" d="M204.998 74.2412C216.586 70.5516 206.864 61.7057 204.269 73.5753C206.864 61.7057 194.33 65.7012 203.323 73.8722C194.33 65.6922 191.528 78.5247 203.115 74.8351C191.528 78.5247 201.25 87.3706 203.845 75.501C201.25 87.3706 213.783 83.3751 204.791 75.2041C213.783 83.3751 216.586 70.5516 204.998 74.2412Z" fill="#C78665"/>
                            <path d="M206.423 76.6888C207.612 75.3839 207.513 73.3682 206.216 72.1803C204.909 70.9925 202.891 71.0914 201.702 72.3873C200.512 73.6921 200.611 75.7079 201.909 76.8958C203.206 78.0836 205.234 77.9936 206.423 76.6888Z" fill="white"/>
                            <path class="theme-color" d="M121.565 128.073C129.602 132.6 129.503 122.638 121.556 127.326C129.494 122.638 120.808 117.742 120.898 126.957C120.808 117.742 112.221 122.809 120.249 127.335C112.212 122.809 112.311 132.771 120.258 128.082C112.32 132.771 121.006 137.666 120.916 128.451C121.015 137.666 129.602 132.6 121.565 128.073Z" fill="#C78665"/>
                            <path d="M120.933 130.134C122.276 130.125 123.348 129.027 123.33 127.686C123.321 126.345 122.222 125.274 120.879 125.292C119.537 125.301 118.465 126.399 118.483 127.74C118.501 129.072 119.6 130.143 120.933 130.134Z" fill="white"/>
                            <path class="theme-color" d="M262.843 57.3953C268.412 60.5269 268.339 53.6337 262.834 56.8733C268.339 53.6247 262.321 50.2411 262.384 56.6214C262.321 50.2411 256.374 53.7507 261.933 56.8823C256.365 53.7507 256.437 60.6439 261.942 57.4043C256.446 60.6529 262.456 64.0365 262.393 57.6562C262.465 64.0365 268.412 60.5269 262.843 57.3953Z" fill="#C78665"/>
                            <path d="M262.411 58.8172C263.339 58.8082 264.078 58.0523 264.069 57.1254C264.06 56.1985 263.303 55.4606 262.375 55.4696C261.447 55.4786 260.708 56.2345 260.717 57.1614C260.726 58.0793 261.483 58.8262 262.411 58.8172Z" fill="white"/>
                            <path class="theme-color" d="M313.507 110.957C319.076 114.089 319.004 107.195 313.498 110.435C319.004 107.186 312.985 103.803 313.048 110.183C312.985 103.803 307.038 107.312 312.597 110.444C307.029 107.312 307.101 114.206 312.606 110.966C307.11 114.215 313.12 117.598 313.057 111.218C313.12 117.598 319.076 114.089 313.507 110.957Z" fill="#C78665"/>
                            <path d="M313.075 112.379C314.003 112.37 314.742 111.614 314.733 110.687C314.724 109.76 313.967 109.022 313.039 109.031C312.111 109.04 311.372 109.796 311.381 110.723C311.381 111.641 312.147 112.388 313.075 112.379Z" fill="white"/>
                            <path class="theme-color" d="M173.228 67.1951C178.796 70.3267 178.724 63.4335 173.219 66.6731C178.715 63.4245 172.705 60.0409 172.769 66.4212C172.705 60.0409 166.759 63.5505 172.318 66.6821C166.75 63.5505 166.822 70.4437 172.327 67.2041C166.831 70.4527 172.841 73.8363 172.778 67.456C172.85 73.8453 178.796 70.3357 173.228 67.1951Z" fill="#C78665"/>
                            <path d="M172.796 68.617C173.724 68.608 174.462 67.8521 174.453 66.9252C174.444 65.9983 173.688 65.2604 172.76 65.2694C171.831 65.2784 171.093 66.0343 171.102 66.9612C171.111 67.8881 171.868 68.626 172.796 68.617Z" fill="white"/>
                            <path class="theme-color" d="M139.604 95.7218C147.641 100.248 147.542 90.2864 139.595 94.9749C147.533 90.2864 138.847 85.391 138.937 94.6059C138.847 85.391 130.26 90.4574 138.288 94.9839C130.251 90.4574 130.35 100.419 138.297 95.7308C130.359 100.419 139.045 105.315 138.955 96.0997C139.054 105.315 147.641 100.248 139.604 95.7218Z" fill="#C78665"/>
                            <path d="M138.972 97.7735C140.315 97.7645 141.387 96.6667 141.369 95.3258C141.36 93.985 140.261 92.9141 138.918 92.9321C137.576 92.9411 136.504 94.039 136.522 95.3798C136.54 96.7117 137.639 97.7825 138.972 97.7735Z" fill="white"/>
                            <path class="theme-color" d="M115.645 73.0445C122.439 76.869 122.349 68.455 115.636 72.4146C122.349 68.455 115.005 64.3155 115.087 72.0996C115.005 64.3155 107.752 68.599 114.537 72.4236C107.743 68.599 107.833 77.013 114.546 73.0535C107.833 77.013 115.177 81.1525 115.096 73.3684C115.186 81.1525 122.439 76.869 115.645 73.0445Z" fill="#C78665"/>
                            <path d="M115.113 74.7814C116.249 74.7724 117.15 73.8455 117.141 72.7116C117.132 71.5777 116.204 70.6778 115.068 70.6868C113.933 70.6958 113.032 71.6227 113.041 72.7566C113.059 73.8905 113.987 74.7904 115.113 74.7814Z" fill="white"/>
                            <path class="theme-color" d="M320.78 81.0894C328.817 85.6159 328.718 75.6541 320.771 80.3425C328.709 75.6541 320.023 70.7587 320.113 79.9736C320.023 70.7587 311.436 75.8251 319.464 80.3515C311.427 75.8251 311.526 85.7869 319.473 81.0984C311.535 85.7869 320.221 90.6823 320.131 81.4674C320.23 90.6823 328.817 85.6159 320.78 81.0894Z" fill="#C78665"/>
                            <path d="M320.148 83.1412C321.491 83.1322 322.563 82.0343 322.545 80.6935C322.536 79.3527 321.437 78.2818 320.094 78.2998C318.752 78.3088 317.679 79.4067 317.697 80.7475C317.716 82.0793 318.815 83.1592 320.148 83.1412Z" fill="white"/>
                            <path d="M162.596 129.765L159.776 106.943L155.118 107.519L154.893 105.729L166.362 104.316L166.588 106.106L162.083 106.664L164.903 129.486L162.596 129.765Z" fill="#222222"/>
                            <path d="M172.12 128.595L169.074 103.983L171.417 103.695L172.768 114.601L180.526 113.648L179.175 102.741L181.49 102.453L184.536 127.065L182.22 127.353L180.742 115.384L172.985 116.338L174.462 128.307L172.12 128.595Z" fill="#222222"/>
                            <path d="M187.51 126.687L189.663 101.436L192.096 101.139L200.376 125.103L198.097 125.382L196.06 118.939L190.186 119.668L189.753 126.417L187.51 126.687ZM190.321 117.949L195.556 117.301L191.267 104.352L190.321 117.949Z" fill="#222222"/>
                            <path d="M203.358 124.734L200.312 100.122L201.988 99.915L212.197 118.057L209.836 98.9431L211.845 98.6912L214.891 123.303L213.251 123.51L202.952 105.161L205.34 124.482L203.358 124.734Z" fill="#222222"/>
                            <path d="M219.143 122.791L216.098 98.1784L218.44 97.8904L220.053 110.894L225.018 97.0805L227.234 96.8105L223.459 108.014L231.37 121.288L229.09 121.567L222.152 109.931L220.459 114.215L221.486 122.512L219.143 122.791Z" fill="#222222"/>
                            <path d="M243.696 119.758L242.687 111.587L235.082 95.8385L237.335 95.5595L243.47 108.68L246.038 94.4797L248.318 94.2007L244.939 111.308L245.948 119.479L243.696 119.758Z" fill="#222222"/>
                            <path d="M259.887 118.066C258.265 118.264 256.95 118.102 255.95 117.58C254.949 117.058 254.193 116.248 253.67 115.15C253.156 114.052 252.805 112.766 252.625 111.29L251.363 101.085C251.174 99.5821 251.21 98.2593 251.471 97.1074C251.733 95.9556 252.282 95.0197 253.129 94.2997C253.976 93.5798 255.193 93.1209 256.769 92.9229C258.373 92.7249 259.671 92.8689 260.671 93.3639C261.671 93.8588 262.428 94.6327 262.95 95.6856C263.473 96.7385 263.824 98.0163 264.014 99.5191L265.284 109.76C265.464 111.236 265.437 112.568 265.203 113.746C264.969 114.925 264.437 115.888 263.599 116.644C262.77 117.391 261.527 117.868 259.887 118.066ZM259.653 116.212C260.752 116.077 261.554 115.753 262.067 115.249C262.581 114.745 262.896 114.088 263.013 113.279C263.131 112.469 263.122 111.551 262.995 110.516L261.617 99.3662C261.491 98.3313 261.275 97.4494 260.968 96.7025C260.662 95.9556 260.193 95.4156 259.581 95.0737C258.959 94.7317 258.103 94.6237 257.013 94.7587C255.94 94.8937 255.139 95.1996 254.607 95.6856C254.084 96.1715 253.76 96.8104 253.643 97.6114C253.526 98.4033 253.526 99.3212 253.661 100.356L255.039 111.506C255.166 112.541 255.382 113.432 255.697 114.187C256.004 114.943 256.481 115.501 257.112 115.861C257.724 116.23 258.58 116.347 259.653 116.212Z" fill="#222222"/>
                            <path d="M276.069 116.068C274.402 116.275 273.078 116.131 272.078 115.654C271.077 115.168 270.348 114.421 269.87 113.396C269.392 112.379 269.068 111.182 268.906 109.832L266.689 91.9331L268.942 91.6541L271.167 109.607C271.285 110.561 271.501 111.416 271.807 112.163C272.114 112.919 272.591 113.477 273.24 113.855C273.88 114.232 274.754 114.349 275.844 114.214C276.898 114.088 277.691 113.756 278.222 113.225C278.754 112.694 279.087 112.037 279.223 111.236C279.358 110.435 279.367 109.562 279.25 108.608L277.024 90.6552L279.241 90.3853L281.457 108.284C281.628 109.643 281.592 110.876 281.358 111.983C281.124 113.09 280.592 113.998 279.745 114.709C278.925 115.411 277.691 115.87 276.069 116.068Z" fill="#222222"/>
                            <path d="M235.687 279.093C235.687 279.093 236.705 299.611 235.281 301.276C231.984 305.154 221.703 300.115 221.703 300.115L235.687 279.093Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M231.471 269.545L240.499 320.092" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M232.02 321.46C232.02 321.46 238.309 313.811 239.949 316.268C241.589 318.725 246.518 327.193 244.328 332.934C242.139 338.675 232.29 340.034 231.471 339.494C230.651 338.945 232.02 321.46 232.02 321.46Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M205.503 221.662C205.503 221.662 201.593 221.401 199.503 224.533C197.412 227.664 200.025 228.528 200.89 229.401C201.764 230.274 200.196 230.787 200.719 232.011C201.242 233.226 203.071 232.182 203.071 232.182L208.287 227.754C208.287 227.754 218.992 219.502 217.595 218.809C216.198 218.098 211.675 216.703 205.503 221.662Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M215.288 257.694L202.691 277.833L209.341 300.106" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M202.692 277.833C202.692 277.833 200.557 276.861 200.169 277.833C199.782 278.805 199.971 285.005 200.557 285.392C201.143 285.779 204.242 287.525 204.629 286.751C205.017 285.977 204.629 279.39 204.629 279.39L202.692 277.833Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M203.08 274.927C203.08 274.927 201.332 275.899 201.332 276.673C201.332 277.446 203.657 281.514 204.63 280.938C205.603 280.353 206.567 280.164 205.99 278.805C205.269 277.113 206.216 278.31 203.08 274.927Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M215.288 257.694C215.288 257.694 208.972 270.706 207.494 273.415C206.016 276.132 203.755 277.716 203.529 281.109C203.304 284.501 206.368 289.937 206.368 289.937L204.214 307.035L227.902 304.542C227.902 304.542 235.894 281.073 236.516 276.357C237.308 270.346 238.245 264.326 235.38 260.168C232.362 255.795 226.073 251.763 226.073 251.763L215.288 257.694Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M192.403 346.126C192.403 346.126 184.393 377.218 184.213 380.133C184.095 382.023 182.483 402.568 180.203 416.138C178.969 423.481 176.383 428.143 176.383 428.143C176.383 428.143 165.462 433.965 164.363 434.685C163.273 435.414 156.173 435.954 155.623 437.591C155.074 439.229 155.443 441.776 156.173 442.316C156.903 442.865 167.463 443.774 167.463 443.774C167.463 443.774 178.023 443.594 178.572 443.594C179.122 443.594 188.222 444.503 190.042 443.045C191.862 441.587 191.313 439.229 190.592 436.314C189.862 433.407 188.222 428.494 188.411 427.036C188.591 425.578 197.881 397.393 197.701 392.12C197.521 386.846 198.061 378.846 198.061 378.846L217.721 347.566L192.403 346.126Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M155.623 437.601C155.074 439.238 155.443 441.785 156.173 442.325C156.903 442.874 167.463 443.783 167.463 443.783C167.463 443.783 178.023 443.603 178.572 443.603C179.122 443.603 188.222 444.512 190.042 443.054C191.862 441.596 191.313 439.238 190.592 436.323C190.105 434.388 189.222 431.562 188.736 429.457C187.591 429.736 186.033 430.177 184.222 430.86C180.401 432.318 179.122 430.86 179.122 430.86L176.392 428.134C176.392 428.134 165.471 433.956 164.372 434.676C163.273 435.414 156.173 435.963 155.623 437.601Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M184.617 440.67C187.942 440.193 189.852 439.599 189.852 439.599" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M156.174 439.778C156.174 439.778 159.634 440.138 170.923 441.047C174.834 441.362 178.312 441.281 181.186 441.047" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M214.432 351.4C214.432 351.4 230.425 386.28 232.119 387.873C233.812 389.465 259.374 409.956 263.231 414.284C267.078 418.613 269.916 424.561 269.916 424.561C269.916 424.561 265.483 433.542 263.717 434.73C261.96 435.918 258.041 437.583 258.5 439.383C258.96 441.182 259.032 442.451 260.519 442.919C262.005 443.387 271.691 443.774 274.358 442.532C277.025 441.299 290.387 428.737 290.838 427.072C291.297 425.407 289.171 423.157 287.252 421.439C285.332 419.72 279.332 416.588 277.25 415.238C275.169 413.897 263.186 393.02 256.851 387.765C250.517 382.509 242.751 378.334 242.751 378.334L235.732 349.582L214.432 351.4Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M290.837 427.072C291.296 425.407 289.17 423.158 287.251 421.439C286.223 420.521 284.016 419.189 281.872 417.947C281.133 419.981 279.88 422.951 278.466 424.283C276.213 426.406 272.925 426.406 272.925 426.406L269.906 424.571C269.906 424.571 265.473 433.551 263.707 434.739C261.95 435.927 258.031 437.592 258.49 439.392C258.95 441.192 259.022 442.46 260.509 442.928C261.995 443.396 271.681 443.783 274.348 442.541C277.024 441.3 290.377 428.737 290.837 427.072Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M267.744 440.463C269.465 440.364 271.177 440.049 272.547 439.356C276.98 437.115 287.819 425.057 287.819 425.057" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M259.986 439.851C259.986 439.851 262.752 440.445 265.933 440.499" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M266.097 396.494C258.88 386.397 243.365 375.589 243.365 375.589L237.409 350.023H237.436C237.436 350.023 238.157 332.907 237.436 328.084C236.715 323.26 227.894 304.551 227.894 304.551L203.035 306.018L201.107 318.554L201.287 321.793L191.088 345.676C191.088 345.676 182.375 373.06 182.375 376.669C182.375 380.277 177.32 416.318 175.158 421.367C172.996 426.415 171.545 428.215 171.545 428.215C171.545 428.215 183.637 437.952 190.583 436.323C197.53 434.703 197.53 434.703 197.53 434.703C197.53 434.703 197.53 416.318 202.224 404.782C206.919 393.245 215.217 364.412 215.217 364.412C215.217 364.412 219.191 384.237 222.074 390.365C224.957 396.494 234.346 404.422 244.806 412.35C255.276 420.278 262.133 429.295 262.133 429.295C262.133 429.295 268.584 430.366 272.936 426.406C277.288 422.446 281.883 417.956 281.883 417.956C281.883 417.956 273.314 406.59 266.097 396.494Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M205.71 224.569C205.71 224.569 203.151 228.069 203.016 231.165C202.953 232.569 203.187 234.062 203.305 235.646C203.449 237.545 202.376 238.373 202.836 240.524C202.926 240.947 203.782 242.153 204.115 242.845C205.467 245.635 207.251 249.235 208.008 249.883C208.954 250.693 212.189 250.153 212.189 250.153C213.351 249.487 216.865 254.679 215.288 257.694C214.396 259.404 215.693 259.574 215.693 259.574C215.693 259.574 220.144 255.534 221.487 254.589C222.839 253.644 226.073 251.763 226.073 251.763L223.92 242.342C223.92 242.342 226.614 237.896 225.001 235.07C223.379 232.245 216.234 226.449 213.405 224.974C210.576 223.489 208.548 223.219 208.008 223.219C207.467 223.219 205.71 224.569 205.71 224.569Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M212.189 250.153C212.189 250.153 214.478 249.298 216.676 248.11L212.189 250.153Z" fill="white"/>
                            <path d="M212.189 250.153C212.189 250.153 214.478 249.298 216.676 248.11" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M222.983 240.947C222.983 240.947 221.929 242.693 221.082 242.693L219.893 242.522V244.213" fill="white"/>
                            <path d="M222.983 240.947C222.983 240.947 221.929 242.693 221.082 242.693L219.893 242.522V244.213" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M206.512 233.82C207.161 234.468 207.35 238.085 206.26 238.742C205.124 239.426 205.719 240.893 206.53 241.163C207.341 241.433 208.548 241.163 208.548 241.163" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M206.656 244.096C206.656 244.096 209.756 245.716 212.585 242.881" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M205.332 232.65C205.332 232.65 204.567 231.624 203.404 231.687" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M208.188 232.263C208.188 232.263 210.674 230.535 212.954 232.452" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M210.864 237.383C211.347 237.383 211.738 236.718 211.738 235.898C211.738 235.078 211.347 234.413 210.864 234.413C210.382 234.413 209.99 235.078 209.99 235.898C209.99 236.718 210.382 237.383 210.864 237.383Z" fill="#222222"/>
                            <path d="M205.494 235.844C205.494 236.537 205.16 237.104 204.746 237.104C204.331 237.104 203.998 236.537 203.998 235.844C203.998 235.151 204.331 234.584 204.746 234.584C205.16 234.584 205.494 235.151 205.494 235.844Z" fill="#222222"/>
                            <path d="M208.459 222.526C208.459 222.526 211.856 223.912 212.027 226.611C212.198 229.302 218.379 235.556 221.334 235.907C224.29 236.258 224.029 239.039 222.983 240.947C221.938 242.854 221.154 248.677 223.857 251.025C226.551 253.374 229.254 254.238 231.074 256.065C232.903 257.892 234.814 260.411 234.471 262.409C234.12 264.407 235.084 266.405 236.904 267.359C238.733 268.312 244.04 267.619 247.347 261.185C250.653 254.76 252.392 252.06 248.392 247.975C244.391 243.889 240.914 242.764 240.914 242.764C240.914 242.764 242.562 242.413 241.265 235.898C239.958 229.383 231.957 230.508 231.696 230.508C231.435 230.508 229.173 226.422 227.083 222.337C224.993 218.251 220.388 216.254 217.253 217.297C214.108 218.359 209.153 220.96 208.459 222.526Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M180.302 272.731L174.445 259.197L181.446 262.832L187.474 276.178L180.302 272.731Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M217.641 265.433L213.163 290.603C213.163 290.603 204.315 288.578 199.557 285.77C194.8 282.963 191.592 279.174 191.592 279.174C191.592 279.174 190.268 273.19 189.403 272.488C188.538 271.786 186.97 270.193 186.349 269.437C185.727 268.681 184.763 267.485 184.303 268.303C183.853 269.122 183.781 269.806 184.619 270.616C185.457 271.426 186.7 274.225 186.7 274.225L183.628 272.578C183.628 272.578 181.835 268.339 181.249 267.485C180.663 266.621 178.483 263.813 177.492 264.011C176.5 264.209 177.537 266.018 177.537 266.018L177.816 267.152C177.816 267.152 177.248 270.985 177.365 272.308C177.483 273.631 178.059 274.954 178.059 274.954C178.059 274.954 179.14 278.76 180.141 279.849C181.141 280.938 186.231 283.836 186.231 283.836C186.231 283.836 196.872 292.682 202.206 295.993C207.531 299.305 214.496 302.229 216.244 302.706C217.992 303.174 219.353 302.49 220.461 300.556C221.569 298.63 223.443 293.851 223.443 293.851L230.669 267.071C232.003 263.021 227.975 254.013 221.605 258.783C219.47 260.375 218.109 262.805 217.641 265.433Z" fill="white" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M213.162 290.603C213.162 290.603 215.541 291.359 216.622 292.592" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M177.824 267.133C177.824 267.133 179.392 270.022 179.752 271.291C180.113 272.56 181.185 274.251 181.185 274.251" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M360.514 34.349L358.531 46.1736L306.191 26.4299L360.514 34.349Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M360.514 22.0564L306.191 26.4299L360.514 34.349V22.0564Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M306.191 26.4299L351.026 56.5944L358.531 46.1736L306.191 26.4299Z" fill="#222222" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="theme-color" d="M306.191 26.4299L362.559 56.0455L360.73 39.2264L306.191 26.4299Z" fill="#C78665" stroke="#222222" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        @else
                        <img id="svg_text_preview" src="{{ isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text :'' }}">
                        @endif
                        </div>
                  </div>
                 </section>
                @endif

                @php $j = $j + 1; @endphp
                @endif
            @endforeach
            @if ($plan->enable_branding == 'on')
                @if ($is_branding_enabled)
                <section class="footer-sec">
                    <p id="{{ $stringid . '_branding' }}_preview">{{ $business->branding_text }}</p>
                </section>
                @endif
            @endif
            </div>
         </div>
     </main>
        <div id="previewImage"> </div>
        <a id="download" href="#" class="font-lg download mr-3 text-white">
            <i class="fas fa-download"></i>
        </a>
  </div>
@endsection
