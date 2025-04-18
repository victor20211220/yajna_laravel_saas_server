@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme14">
@else
<div class="{{ $business->theme_color }}" id="view_theme14">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="wedding-card">
                <section class="profile-sec mb">
                    <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme4/images/profile-banner.png') }}" class="profile-banner" alt="profile-banner-img" id="banner_preview" loading="lazy">
                    <div class="profile-wrp">
                        <div class="profile-content text-center">
                            <p id="{{ $stringid . '_desc' }}_preview">
                                {!! nl2br(e($business->description)) !!}</p>
                        </div>
                        <div class="client-info-wrp d-flex align-items-center">
                            <img src="{{ asset('custom/theme4/images/client-bg-img.png') }}" class="client-bg top" loading="lazy">
                            <img src="{{ asset('custom/theme4/images/client-bg-img.png') }}" class="client-bg bottom" loading="lazy">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme4/images/client-image.png') }}"   alt="client-image" loading="lazy">
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
                    <section class="gallery-sec pb" id="gallery-div">
                        <div class="container">
                            <div class="section-title common-title">
                                <h2>{{__('Gallery')}}</h2>
                            </div>
                        </div>
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
                                                class="gallery-popup-btn img-wrapper">
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
                                                    class="video-popup-btn play-btn img-wrapper">
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
                                                    class="video-popup-btn play-btn img-wrapper">
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
                                                class="gallery-popup-btn img-wrapper">
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
                    </section>
                @endif
                @if ($order_key == 'service')
                    <section class="service-sec pb" id="services-div">
                        <div class="container">
                            <div class="section-title common-title">
                                <h2>{{ __('Services') }}</h2>
                            </div>
                            @if (isset($is_pdf))
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
                                                        class="btn">{{ $content->link_title }}</a>
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
                                                        class="btn">{{ $content->link_title }}</a>
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
                            @endif
                        </div>
                    </section>
                @endif
                @if ($order_key == 'bussiness_hour')
                    <section class="business-hour-sec mb" id="business-hours-div">
                        <div class="container">
                            <div class="business-hours text-center">
                                <div class="section-title common-title">
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
                @if ($order_key == 'product')
                    <section class="product-sec pb" id="product-div">
                        <div class="container">
                            <div class="section-title common-title">
                                <h2>{{ __('Product') }}</h2>
                            </div>
                            @if (isset($is_pdf))
                                @php $pr_image_count = 0; @endphp
                                @foreach ($products_content as $k1 => $content)
                                <div class="product-card edit-card" id="product_{{ $product_row_nos }}">
                                        <div class="product-card-inner">
                                            <div class="product-card-image">
                                                <div class="img-wrapper">
                                                    <img src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="product-image" loading="lazy">
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
                                                        <ins id="{{ 'product_currency_select' . $product_row_nos . '_preview' }}">{{ $content->currency }}</ins>
                                                        <ins id="{{ 'product_price_' . $product_row_nos . '_preview' }}">{{ $content->price }}</ins>
                                                    </div>
                                                    @if (!empty($content->purchase_link))
                                                        <a href="{{ url($content->purchase_link) }}" class="btn">{{ $content->link_title }}</a>
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
                                                        <img src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="product-image" loading="lazy">
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
                                                            <ins id="{{ 'product_currency_select' . $product_row_nos . '_preview' }}">{{ $content->currency }}</ins>
                                                            <ins id="{{ 'product_price_' . $product_row_nos . '_preview' }}">{{ $content->price }}</ins>
                                                        </div>
                                                        @if (!empty($content->purchase_link))
                                                            <a href="{{ url($content->purchase_link) }}" class="btn">{{ $content->link_title }}</a>
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
                            @endif
                        </div>
                    </section>
                @endif
                @if ($order_key == 'contact_info')
                <section class="contact-info-sec mb" id="contact-div">
                    <img src="{{ asset('custom/theme4/images/contact-bg.png') }}" class="contact-bg" alt="contact-bg" loading="lazy">
                    <img src="{{ asset('custom/theme4/images/contact-image.png') }}" class="contact-image" alt="contact-image" loading="lazy">
                    <div class="container">
                        <div class="section-title common-title">
                            <h2>{{ __('Contact') }}</h2>
                        </div>
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
                                        <li id="contact_{{ $loop->parent->index + 1 }}" class="d-flex align-items-center">
                                            @if ($key1 == 'Address')
                                                @foreach ($val1 as $key2 => $val2)
                                                    @if ($key2 == 'Address_url')
                                                        @php $href = $val2; @endphp
                                                    @endif
                                                @endforeach
                                                    <img src="{{ asset('custom/theme4/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                    <img src="{{ asset('custom/theme4/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-link">
                                                @else
                                                        <img src="{{ asset('custom/theme4/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                <section class="appointment-sec pb" id="appointment-div">
                    <div class="container">
                        <div class="appointment-form-wrp">
                            <form class="appointment-form">
                                <div class="section-title common-title">
                                    <h2>{{ __('Appointment') }}</h2>
                                </div>
                                <div class="date-picker">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker_min"
                                            placeholder="Pick a date">
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
                    </div>
                </section>
                @endif
                @if ($order_key == 'more')
                <section class="more-info-sec pb">
                    <div class="container">
                        <div class="section-title common-title">
                        <h2>{{ __('More') }}</h2>
                        </div>
                    </div>
                    <div class="more-info-wrp">
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
                                <span>{{ __('Save') }}</span>
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
                                <span>{{ __('Share') }}</span>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="contact-info d-flex align-items-center justify-content-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.8727 9.74257C19.0006 9.7426 19.1273 9.71743 19.2456 9.66848C19.3638 9.61953 19.4712 9.54776 19.5617 9.45729C19.6521 9.36681 19.7239 9.2594 19.7729 9.14118C19.8218 9.02297 19.847 8.89626 19.847 8.76831V0.974257C19.847 0.715868 19.7443 0.468062 19.5616 0.285353C19.3789 0.102645 19.1311 0 18.8727 0C18.6143 0 18.3665 0.102645 18.1838 0.285353C18.0011 0.468062 17.8984 0.715868 17.8984 0.974257V8.76831C17.8984 8.89626 17.9236 9.02297 17.9725 9.14118C18.0215 9.2594 18.0932 9.36681 18.1837 9.45729C18.2742 9.54776 18.3816 9.61953 18.4998 9.66848C18.618 9.71743 18.7447 9.7426 18.8727 9.74257Z"
                                            fill="#222222" />
                                        <path
                                            d="M14.9743 7.79403C15.1022 7.79406 15.2289 7.76888 15.3471 7.71993C15.4653 7.67099 15.5728 7.59922 15.6632 7.50875C15.7537 7.41827 15.8255 7.31086 15.8744 7.19264C15.9234 7.07442 15.9485 6.94772 15.9485 6.81977V2.92274C15.9485 2.66435 15.8459 2.41655 15.6632 2.23384C15.4805 2.05113 15.2326 1.94849 14.9743 1.94849C14.7159 1.94849 14.4681 2.05113 14.2854 2.23384C14.1026 2.41655 14 2.66435 14 2.92274V6.81977C14 6.94772 14.0251 7.07442 14.0741 7.19264C14.123 7.31086 14.1948 7.41827 14.2853 7.50875C14.3758 7.59922 14.4832 7.67099 14.6014 7.71993C14.7196 7.76888 14.8463 7.79406 14.9743 7.79403Z"
                                            fill="#222222" />
                                        <path
                                            d="M22.7692 6.81988C22.8971 6.81991 23.0238 6.79474 23.1421 6.74579C23.2603 6.69684 23.3677 6.62507 23.4582 6.5346C23.5486 6.44413 23.6204 6.33671 23.6693 6.21849C23.7183 6.10028 23.7435 5.97357 23.7434 5.84562V3.89711C23.7434 3.63872 23.6408 3.39091 23.4581 3.2082C23.2754 3.0255 23.0276 2.92285 22.7692 2.92285C22.5108 2.92285 22.263 3.0255 22.0803 3.2082C21.8976 3.39091 21.7949 3.63872 21.7949 3.89711V5.84562C21.7949 5.97357 21.8201 6.10028 21.869 6.21849C21.918 6.33671 21.9897 6.44413 22.0802 6.5346C22.1707 6.62507 22.2781 6.69684 22.3963 6.74579C22.5145 6.79474 22.6412 6.81991 22.7692 6.81988Z"
                                            fill="#222222" />
                                        <path
                                            d="M23.7146 18.7675L19.7595 14.8124C19.6224 14.6754 19.4477 14.5823 19.2575 14.5451C19.0673 14.508 18.8703 14.5283 18.6918 14.6037L14.5282 16.3608L7.63915 9.47182L9.39626 5.30827C9.47162 5.12971 9.49201 4.93274 9.45484 4.74253C9.41766 4.55232 9.32459 4.37752 9.18754 4.24048L5.23242 0.285371C5.14195 0.194898 5.03455 0.12313 4.91634 0.0741659C4.79813 0.0252018 4.67144 0 4.5435 0C4.41555 0 4.28886 0.0252018 4.17065 0.0741659C4.05245 0.12313 3.94504 0.194898 3.85457 0.285371L1.15366 2.98631C-1.93852 6.07856 1.58733 11.6658 6.96079 17.0392C12.3342 22.4127 17.9215 25.9385 21.0138 22.8463L23.7147 20.1454C23.8974 19.9627 24 19.7148 24 19.4564C24 19.1981 23.8973 18.9502 23.7146 18.7675Z"
                                            fill="#222222" />
                                    </svg>
                                </a>
                                <span>{{ __('Contact') }}</span>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif
                @if ($order_key == 'testimonials')
                    <section class="testimonial-sec mb" id="testimonials-div">
                        <div class="container">
                            <div class="section-title common-title">
                                <h2>{{ __('Testimonials') }}</h2>
                            </div>
                            @if (isset($is_pdf))
                                @php
                                    $t_image_count = 0;
                                    $rating = 0;
                                @endphp
                                @foreach ($testimonials_content as $k2 => $testi_content)
                                    <div class="testimonial-card" id="testimonials_{{ $testimonials_row_nos }}">
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-image">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
                                            </div>
                                            <div class="testimonial-content">
                                                <div class="testimonial-content-top">
                                                    <div class="rating d-flex align-items-center justify-content-center">
                                                        @php
                                                            if (!empty($testi_content->rating)) {
                                                                $rating = (int) $testi_content->rating;
                                                                $overallrating = $rating;
                                                            } else {
                                                                $overallrating = 0;
                                                            }
                                                        @endphp
                                                        <span
                                                            id="{{ 'stars' . $testimonials_row_nos }}_star"
                                                            class="stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($overallrating < $i)
                                                                    @if (is_float($overallrating) && round($overallrating) == $i)
                                                                        <i
                                                                            class="star-color fas fa-star-half-alt"></i>
                                                                    @else
                                                                        <i class="fa fa-star"></i>
                                                                    @endif
                                                                @else
                                                                    <i class="star-color fas fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                                        {{ $testi_content->description }} </p>
                                                </div>
                                                <div class="testimonial-content-bottom">
                                                    <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                        {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $t_image_count++;
                                        $testimonials_row_nos++;
                                    @endphp
                                @endforeach
                            @else
                                <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                    @php
                                        $t_image_count = 0;
                                        $rating = 0;
                                    @endphp
                                    @foreach ($testimonials_content as $k2 => $testi_content)
                                        <div class="testimonial-card" id="testimonials_{{ $testimonials_row_nos }}">
                                            <div class="testimonial-card-inner">
                                                <div class="testimonial-image">
                                                    <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                        src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                        alt="testimonial image" loading="lazy">
                                                </div>
                                                <div class="testimonial-content">
                                                    <div class="testimonial-content-top">
                                                        <div class="rating d-flex align-items-center justify-content-center">
                                                            @php
                                                                if (!empty($testi_content->rating)) {
                                                                    $rating = (int) $testi_content->rating;
                                                                    $overallrating = $rating;
                                                                } else {
                                                                    $overallrating = 0;
                                                                }
                                                            @endphp
                                                            <span
                                                                id="{{ 'stars' . $testimonials_row_nos }}_star"
                                                                class="stars">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($overallrating < $i)
                                                                        @if (is_float($overallrating) && round($overallrating) == $i)
                                                                            <i
                                                                                class="star-color fas fa-star-half-alt"></i>
                                                                        @else
                                                                            <i class="fa fa-star"></i>
                                                                        @endif
                                                                    @else
                                                                        <i class="star-color fas fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </span>
                                                        </div>
                                                        <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                                            {{ $testi_content->description }} </p>
                                                    </div>
                                                    <div class="testimonial-content-bottom">
                                                        <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                            {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $t_image_count++;
                                            $testimonials_row_nos++;
                                        @endphp
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                @endif
                @if ($order_key == 'social')
                    <section class="social-link-sec pb" id="social-div">
                        <div class="container">
                            <div class="slider-wrapper">
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
                                                            <img src="{{ asset('custom/theme4/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                                <div class="arrow-wrapper">
                                    <div class="slick-prev slick-arrow social-link-arrow">
                                        <svg width="16" height="26" viewBox="0 0 16 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.89144 25.7391L16 12.8696L2.89144 0L0 2.83873L10.2171 12.8696L0 22.9004L2.89144 25.7391Z"
                                                fill="#222222" />
                                        </svg>
                                    </div>
                                    <div class="slick-next slick-arrow social-link-arrow">
                                        <svg width="16" height="26" viewBox="0 0 16 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.89144 25.7391L16 12.8696L2.89144 0L0 2.83873L10.2171 12.8696L0 22.9004L2.89144 25.7391Z"
                                                fill="#222222" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
                @if ($order_key == 'payment')
                    <section class="payment-sec pb" id="payment-section">
                        <div class="container">
                            <div class="section-title common-title">
                        <h2>{{ __('Payment') }}</h2>
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
                        <div class="container">
                            <div class="section-title common-title">
                                <h2>{{ __('Download Here') }}</h2>
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
                                <svg width="382" height="270" viewBox="0 0 382 270" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_309_2554)">
                                    <path d="M376.96 150.611C375.131 150.611 373.452 148.916 373.353 146.952C373.326 146.442 373.394 145.721 373.864 145.187C374.386 144.594 375.2 144.456 375.791 144.445C376.564 144.43 377.201 144.626 377.63 145.008C378.137 145.459 378.372 146.339 377.914 146.929C377.834 147.032 377.685 147.051 377.582 146.971C377.478 146.892 377.459 146.744 377.539 146.641C377.832 146.264 377.655 145.663 377.314 145.359C376.886 144.978 376.254 144.909 375.8 144.916C375.305 144.925 374.628 145.033 374.22 145.497C373.855 145.913 373.804 146.505 373.825 146.928C373.914 148.668 375.399 150.168 377.006 150.138C377.765 150.124 378.559 149.81 379.433 149.18C380.244 148.594 380.801 147.981 381.134 147.307C381.721 146.118 381.646 144.587 380.932 143.212C380.345 142.082 379.366 141.061 377.94 140.092C377.555 139.83 377.142 139.593 376.733 139.627C376.604 139.638 376.488 139.542 376.477 139.412C376.467 139.283 376.563 139.169 376.693 139.158C377.249 139.111 377.75 139.392 378.208 139.703C379.7 140.717 380.729 141.794 381.352 142.995C382.135 144.502 382.212 146.192 381.558 147.515C381.19 148.259 380.585 148.929 379.709 149.56C378.754 150.249 377.873 150.592 377.013 150.608C376.997 150.611 376.978 150.611 376.96 150.611Z" fill="#131313"/>
                                    <path class="theme-color" d="M143.08 74.2622V129.882H130.223V106.941H112.781V129.882H99.9238V74.2622H112.781V95.9399H130.223V74.2622H143.08Z" fill="#748173" fill-opacity="0.1"/>
                                    <path class="theme-color" d="M186.05 74.2622L203.545 129.882H189.474L186.031 118.432H167.961L164.458 129.882H152.979L170.893 74.2622H186.05ZM171.102 108.164H182.944L177.075 88.6463L171.102 108.164Z" fill="#748173" fill-opacity="0.1"/>
                                    <path d="M62.6113 94.9671C62.6113 94.9671 65.2229 87.0698 65.0733 85.5763C64.5111 84.3679 62.1806 79.9549 62.6966 76.7296C62.7464 76.6348 65.5811 75.5636 65.5811 75.5636L76.3504 75.5627C76.3504 75.5627 77.1094 79.2898 74.9948 84.8787C74.7109 84.9572 72.9363 97.4597 72.9363 97.4597L62.6113 94.9671Z" fill="white"/>
                                    <path d="M60.502 99.7372L62.983 93.9309C62.983 93.9309 69.62 93.3254 73.0133 97.011C73.0477 96.7159 70.1251 116.055 63.7665 116.457C63.7257 116.442 52.5547 113.503 35.0931 102.951L32.6348 84.1421L60.502 99.7372Z" fill="#131313"/>
                                    <path d="M64.3801 76.0528C64.2677 76.0528 64.1661 75.977 64.138 75.8632C63.9086 74.9121 64.3257 72.0134 65.6107 71.2671C66.0668 71.0018 66.8258 70.8845 67.8469 71.8311C67.9475 71.9241 67.953 72.0811 67.8596 72.1813C67.7662 72.2814 67.6084 72.2868 67.5077 72.1939C66.8675 71.6001 66.3134 71.4322 65.8618 71.6948C64.8 72.3121 64.4291 74.9473 64.6222 75.7477C64.654 75.8804 64.5724 76.0149 64.4382 76.0464C64.4191 76.05 64.3992 76.0528 64.3801 76.0528Z" fill="#131313"/>
                                    <path d="M63.7013 116.678C62.2831 116.678 58.5162 115.388 53.8515 113.301C49.7673 111.475 43.1756 108.231 34.9672 103.15C34.8565 103.082 34.8221 102.937 34.891 102.826C34.9599 102.715 35.1059 102.681 35.2175 102.75C49.7292 111.732 61.2684 116.206 63.7004 116.206C63.7086 116.206 63.7168 116.206 63.7249 116.206C63.8546 116.206 63.9598 116.31 63.9616 116.439C63.9634 116.569 63.8582 116.675 63.7276 116.677C63.7186 116.678 63.7104 116.678 63.7013 116.678Z" fill="#131313"/>
                                    <path d="M59.8889 101.1C59.85 101.1 59.8101 101.09 59.7729 101.069C59.6586 101.005 59.6187 100.862 59.6831 100.748C63.5797 93.8634 64.7159 86.4074 64.8274 85.615C64.6497 85.2495 63.771 83.413 63.1009 81.4746C62.0517 78.4397 62.0009 76.6781 62.9458 76.0897C62.9703 76.0744 65.8304 74.7451 67.42 75.5591C68.0503 75.8821 68.3958 76.4796 68.4474 77.3351C68.4474 77.3414 68.4483 77.3477 68.4474 77.354C68.4248 78.4667 67.78 79.0037 65.163 80.0866C65.0424 80.1363 64.9036 80.0794 64.8537 79.9594C64.8039 79.8394 64.861 79.7013 64.9816 79.6517C67.673 78.5371 67.9569 78.113 67.975 77.354C67.9333 76.7007 67.7011 76.2621 67.265 76.0112C65.9628 75.2631 63.3357 76.4272 63.1879 76.4949C61.8885 77.3351 63.781 82.442 65.2836 85.4706C65.3044 85.5121 65.3117 85.5591 65.3062 85.6042C65.2963 85.6836 64.2425 93.6504 60.0948 100.978C60.0522 101.057 59.9715 101.1 59.8889 101.1Z" fill="#131313"/>
                                    <path d="M71.2485 85.0664C71.1252 85.0664 71.0209 84.9716 71.0127 84.8471C70.8867 83.0512 69.8583 81.7093 67.9558 80.8592C66.5068 80.2112 65.0713 80.1065 65.0568 80.1056C64.9262 80.0966 64.8283 79.9847 64.8364 79.8547C64.8455 79.7248 64.957 79.6255 65.0885 79.6355C65.1502 79.64 66.6119 79.7446 68.1372 80.4233C70.1893 81.3366 71.3473 82.8554 71.4852 84.8137C71.4942 84.9436 71.3963 85.0564 71.2657 85.0655C71.2594 85.0664 71.2539 85.0664 71.2485 85.0664Z" fill="#131313"/>
                                    <path d="M63.723 116.678C63.5934 116.678 63.4882 116.574 63.4864 116.445C63.4845 116.315 63.5897 116.209 63.7203 116.207C64.4993 116.198 64.988 115.962 65.3979 115.707C69.3144 112.454 71.7955 103.75 72.812 96.6826L74.058 88.2592C74.0589 88.2547 74.0598 88.2511 74.0598 88.2466C74.0598 88.2466 74.5005 86.0879 74.9466 83.9275C75.206 82.6731 75.4137 81.6732 75.5651 80.9548C75.6512 80.5487 75.7229 80.2094 75.7755 79.9711C75.8172 79.7807 75.8435 79.6625 75.8671 79.5867C76.4773 77.2178 76.5299 75.4463 76.0248 74.3218C75.6431 73.4735 75.0419 73.2497 74.7843 73.1541L74.7444 73.1387C74.398 73.0286 74.0879 73.0683 73.7968 73.2579C72.9426 73.8156 72.559 75.4517 72.5291 75.6918C72.5291 75.7089 72.5273 75.7269 72.5227 75.7441C72.1736 77.2539 72.3504 77.9533 72.5608 78.2736C72.7358 78.5417 72.9616 78.585 73.046 78.6012L73.0605 78.6039C73.3951 78.659 73.6653 78.5931 73.8857 78.4027C74.4678 77.9 74.5685 76.6303 74.5576 76.1836C74.5549 76.0536 74.6583 75.9453 74.7889 75.9426C74.9203 75.9399 75.0283 76.0428 75.031 76.1728C75.0328 76.2477 75.0645 78.0092 74.1958 78.7592C73.8657 79.0443 73.4567 79.1481 72.9789 79.0696C72.9752 79.0687 72.9725 79.0687 72.9689 79.0678L72.9553 79.0651C72.6189 79.001 72.3523 78.8214 72.1627 78.5326C71.7846 77.9551 71.7501 76.9822 72.0603 75.6403H72.0621C72.0711 75.5077 72.1201 75.2721 72.2616 74.838C72.3967 74.4256 72.6343 73.8372 72.9961 73.3743C73.5239 72.7001 74.1795 72.4646 74.8922 72.6938C74.8968 72.6947 74.9004 72.6965 74.9049 72.6983L74.9475 72.7146C75.2332 72.8211 75.9922 73.1026 76.4547 74.1314C77.0051 75.356 76.9607 77.2313 76.3232 79.7058C76.3205 79.7167 76.3168 79.7275 76.3123 79.7383C76.2153 80.0903 75.1933 85.0465 74.5223 88.3359L73.2763 96.7512C72.2471 103.91 69.7116 112.749 65.6845 116.08C65.6763 116.086 65.6681 116.092 65.6591 116.098C65.2102 116.379 64.6289 116.669 63.7212 116.679C63.7248 116.678 63.7239 116.678 63.723 116.678Z" fill="#131313"/>
                                    <path d="M70.4409 78.3909C70.3366 78.3909 70.2296 78.3818 70.1199 78.3638C70.1162 78.3629 70.1126 78.3629 70.109 78.362L70.0945 78.3593C69.9684 78.3349 69.5848 78.26 69.3019 77.825C68.9256 77.2484 68.892 76.2755 69.2022 74.9345H69.204C69.213 74.8018 69.262 74.5663 69.4035 74.1322C69.5386 73.7198 69.7762 73.1314 70.138 72.6685C70.6648 71.9943 71.3214 71.7588 72.0341 71.988C72.0387 71.9889 72.0423 71.9907 72.0468 71.9925L72.0895 72.0088C72.3524 72.1062 73.0525 72.3661 73.5177 73.2614C73.5775 73.3769 73.5322 73.5195 73.4161 73.579C73.3 73.6386 73.1577 73.5935 73.0969 73.478C72.7161 72.7443 72.1611 72.5385 71.9244 72.4501L71.8845 72.4347C71.5372 72.3246 71.228 72.3643 70.9369 72.5538C70.0827 73.1116 69.6991 74.7477 69.6692 74.9877C69.6692 75.0049 69.6674 75.0229 69.6628 75.0401C69.3137 76.5499 69.4896 77.2484 69.6982 77.5687C69.8723 77.8359 70.099 77.8801 70.1851 77.8972L70.2006 77.8999C70.5615 77.9595 70.8671 77.89 71.1346 77.687C71.8954 77.1112 72.0559 75.6817 72.0577 75.6673C72.0713 75.5382 72.1883 75.4444 72.318 75.4579C72.4476 75.4715 72.542 75.587 72.5284 75.7169C72.5211 75.7837 72.3461 77.3612 71.422 78.0615C71.1337 78.2808 70.8045 78.3909 70.4409 78.3909Z" fill="#131313"/>
                                    <path d="M66.2957 75.7684C66.2875 75.7684 66.2784 75.7684 66.2703 75.7666C66.1406 75.7531 66.0463 75.6367 66.0599 75.5076C66.0935 75.1981 66.1533 74.8552 66.2376 74.4879H66.2394C66.2485 74.3552 66.2975 74.1197 66.4389 73.6856C66.5741 73.2732 66.8107 72.6848 67.1735 72.2218C67.7012 71.5477 68.3569 71.3122 69.0705 71.5405C69.075 71.5423 69.0787 71.5432 69.0832 71.545C69.1077 71.554 69.1358 71.563 69.1657 71.573C69.4287 71.6569 69.9175 71.813 70.3573 72.6586C70.4171 72.7741 70.3718 72.9167 70.2557 72.9763C70.1396 73.0358 69.9964 72.9907 69.9365 72.8752C69.5874 72.2029 69.2464 72.0937 69.0215 72.0215C68.9844 72.0098 68.9508 71.9989 68.92 71.9872C68.5736 71.8771 68.2634 71.9168 67.9733 72.1063C67.1191 72.664 66.7355 74.3002 66.7055 74.5402C66.7055 74.5574 66.7037 74.5754 66.6992 74.5925C66.6185 74.9409 66.5623 75.2649 66.5305 75.5564C66.5178 75.6782 66.4145 75.7684 66.2957 75.7684Z" fill="#131313"/>
                                    <path d="M68.2036 77.7528C68.1229 77.7528 68.044 77.7113 67.9996 77.6373C67.9334 77.5254 67.9706 77.381 68.083 77.3142C68.9336 76.8143 69.1249 75.3126 69.1267 75.2973C69.1422 75.1682 69.26 75.0762 69.3897 75.0915C69.5194 75.1069 69.6119 75.2242 69.5965 75.3532C69.5883 75.4245 69.3761 77.1004 68.3233 77.7194C68.2852 77.742 68.2444 77.7528 68.2036 77.7528Z" fill="#131313"/>
                                    <path d="M60.5021 99.9728C60.4595 99.9728 60.4169 99.9611 60.3779 99.9376C60.1938 99.8248 41.8354 88.5849 32.8498 84.6186C30.0314 83.3751 23.38 82.7912 23.3128 82.7858C23.3101 82.7858 23.3065 82.7849 23.3038 82.7849C22.0089 82.6233 20.8672 81.6532 20.5879 80.4791C20.412 79.7373 20.052 77.6012 20.0365 77.5101C20.0148 77.3819 20.1018 77.2601 20.2306 77.2384C20.3603 77.2168 20.4818 77.3034 20.5035 77.4316C20.5072 77.4532 20.8762 79.6425 21.0485 80.3699C21.2834 81.3581 22.2537 82.1766 23.3582 82.3165C23.6964 82.3454 30.1656 82.9184 33.0411 84.1882C42.0548 88.167 60.4405 99.4232 60.6254 99.537C60.737 99.6055 60.7714 99.7508 60.7025 99.8609C60.659 99.9331 60.581 99.9728 60.5021 99.9728Z" fill="#131313"/>
                                    <path d="M73.0475 96.9508C73.0003 96.9508 72.9523 96.9363 72.9105 96.9075C72.8598 96.8714 67.778 93.3338 63.0236 94.1622C62.8948 94.1848 62.7724 94.0991 62.7497 93.9709C62.727 93.8428 62.8132 93.7209 62.942 93.6984C67.8941 92.8356 72.9713 96.3723 73.1844 96.523C73.2914 96.5979 73.3159 96.745 73.2406 96.8515C73.1944 96.9165 73.1218 96.9508 73.0475 96.9508Z" fill="#131313"/>
                                    <path class="theme-color" d="M137.322 74.2622V129.882H124.465V106.941H107.023V129.882H94.166V74.2622H107.023V95.9399H124.465V74.2622H137.322Z" fill="#748173"/>
                                    <path class="theme-color" d="M181.368 74.2622L198.863 129.883H184.792L181.349 118.432H163.279L159.776 129.883H148.297L166.211 74.2631H181.368V74.2622ZM166.42 108.164H178.262L172.394 88.6463L166.42 108.164Z" fill="#748173"/>
                                    <path class="theme-color" d="M258.746 74.2622V129.882H247.576L225.703 92.3129C225.731 93.2641 225.758 93.8886 225.785 94.1873C225.894 95.1385 225.949 95.9398 225.949 96.5914V129.882H215.754V74.2622H229.865L248.878 107.063C248.714 105.434 248.632 104.198 248.632 103.355V74.2622H258.746Z" fill="#748173" fill-opacity="0.1"/>
                                    <path class="theme-color" d="M253.242 74.2622V129.882H242.072L220.2 92.3129C220.227 93.2641 220.254 93.8886 220.281 94.1873C220.39 95.1385 220.445 95.9398 220.445 96.5914V129.882H210.25V74.2622H224.361L243.374 107.063C243.21 105.434 243.128 104.198 243.128 103.355V74.2622H253.242Z" fill="#748173"/>
                                    <path class="theme-color" d="M89.2975 74.2622V85.2639H75.4586V129.882H62.1929V85.2639H48.2715V74.2622H89.2975Z" fill="#748173" fill-opacity="0.1"/>
                                    <path d="M334.975 110.429C333.644 110.003 332.198 109.862 330.821 110.052L330.602 110.394C329.736 111.739 327.734 114.156 324.051 115.231C321.817 115.884 320.617 116.021 319.096 116.195C318.564 116.257 317.961 116.325 317.243 116.425L317.229 116.427L317.214 116.428C315.093 116.538 312.671 116.602 311.729 116.624L311.468 116.63L311.401 116.379C311.226 115.72 310.5 113.949 307.559 111.753C307.556 111.751 307.553 111.749 307.55 111.747C307.53 111.735 307.511 111.724 307.491 111.712C306.447 111.071 305.793 109.626 305.213 108.201C305.127 107.989 304.861 107.525 304.469 107.285C304.376 107.229 304.281 107.187 304.187 107.165C303.898 107.093 303.609 107.175 303.331 107.409C303.327 107.412 303.325 107.415 303.322 107.418L303.307 107.436L303.272 107.466C302.11 108.45 302.266 110.496 303.72 113.388L304.033 114.01L303.351 113.857C302.642 113.697 301.558 113.469 300.422 113.286C297.746 112.855 296.052 112.868 295.386 113.324C295.201 113.451 295.092 113.615 295.063 113.81L295.061 113.823L295.058 113.835C295.016 114.02 295.051 114.196 295.16 114.362C295.206 114.432 295.269 114.502 295.345 114.57L295.933 115.094L295.145 115.144C294.526 115.183 297.194 115.475 296.866 115.704C296.544 115.931 296.787 116.225 296.728 116.637C296.722 116.674 296.65 116.709 296.529 116.74C297.389 118.307 297.926 119.991 298.46 121.739C298.573 122.153 298.512 122.504 298.364 122.826C298.964 122.956 299.658 123.087 300.457 123.221C303.903 123.799 316.587 125.534 317.125 125.607L317.162 125.612L317.196 125.625C317.678 125.804 319.035 125.965 320.093 126.04C321.746 126.156 324.497 126.218 328.215 125.854C331.307 125.551 333.63 124.02 335.034 122.789C335.867 122.058 336.475 121.354 336.839 120.891L337.2 120.432C336.967 117.065 335.617 113.755 334.975 110.429Z" fill="white"/>
                                    <path d="M311.379 116.951C311.252 116.951 311.148 116.851 311.142 116.725C311.141 116.707 310.989 114.716 307.376 112.015C306.218 111.339 305.525 109.82 304.915 108.32C304.819 108.085 304.496 107.568 304.109 107.472C303.928 107.427 303.745 107.481 303.552 107.638C303.531 107.661 303.507 107.682 303.477 107.707C302.352 108.66 302.686 110.905 304.42 114.029C304.483 114.142 304.442 114.286 304.327 114.349C304.213 114.412 304.069 114.371 304.006 114.257C302.125 110.867 301.836 108.478 303.17 107.349C303.181 107.34 303.19 107.331 303.198 107.325C303.208 107.313 303.218 107.302 303.23 107.292C303.628 106.959 303.989 106.958 304.223 107.016C304.962 107.198 305.35 108.134 305.354 108.143C305.935 109.572 306.59 111.017 307.626 111.614C307.634 111.619 307.642 111.624 307.649 111.63C310.805 113.985 311.451 115.842 311.582 116.475C312.329 116.458 314.954 116.393 317.22 116.275C317.351 116.267 317.462 116.368 317.468 116.498C317.475 116.628 317.375 116.739 317.244 116.745C314.576 116.884 311.415 116.95 311.383 116.95C311.383 116.951 311.381 116.951 311.379 116.951Z" fill="#131313"/>
                                    <path d="M317.168 125.767C317.158 125.767 317.147 125.766 317.136 125.765C317.004 125.747 303.95 123.964 300.429 123.373C299.119 123.153 298.565 122.925 298.455 122.558C298.35 122.214 298.654 121.931 298.976 121.632C299.175 121.447 299.397 121.24 299.522 121.023C298.111 120.738 298.104 120.671 298.085 120.512C298.074 120.409 298.134 120.307 298.23 120.265C298.395 120.194 299.281 120.367 299.736 120.582C300.144 120.665 300.678 120.769 301.376 120.9C301.505 120.924 301.589 121.047 301.566 121.175C301.541 121.303 301.418 121.387 301.289 121.364C300.785 121.27 300.361 121.189 300.003 121.12C299.856 121.46 299.561 121.734 299.3 121.977C299.153 122.114 298.906 122.343 298.908 122.425C298.915 122.447 299.029 122.662 300.508 122.91C304.021 123.5 317.069 125.282 317.2 125.3C317.33 125.318 317.421 125.436 317.402 125.565C317.386 125.681 317.285 125.767 317.168 125.767Z" fill="#131313"/>
                                    <path d="M301.334 121.365C301.315 121.365 301.295 121.362 301.275 121.357L299.26 120.843C297.532 120.586 297.304 120.519 297.232 120.256C297.174 120.044 297.346 119.905 297.512 119.772C297.691 119.626 297.938 119.427 298.026 119.118C298.047 119.042 298.106 118.981 298.183 118.958C298.497 118.86 299.068 118.76 299.69 118.654C299.582 118.636 299.474 118.62 299.366 118.603C298.501 118.467 297.812 118.35 297.317 118.258C296.415 118.089 296.18 118.034 296.205 117.77C296.229 117.498 296.503 117.509 297.049 117.531C298.884 117.603 300.189 117.685 301.036 117.779C302.044 117.892 302.34 118.003 302.358 118.276C302.366 118.388 302.327 118.476 302.212 118.554C302.28 118.564 302.346 118.573 302.412 118.583C302.542 118.601 302.631 118.721 302.613 118.849C302.595 118.978 302.475 119.069 302.346 119.05C302.338 119.049 301.842 118.978 301.143 118.875C300.827 118.937 300.434 119.006 299.95 119.089C299.375 119.186 298.782 119.287 298.438 119.376C298.295 119.737 298.026 119.963 297.833 120.12C298.179 120.206 298.883 120.311 299.343 120.379C299.351 120.38 299.36 120.382 299.367 120.384L301.394 120.902C301.521 120.934 301.597 121.062 301.564 121.189C301.536 121.294 301.44 121.365 301.334 121.365ZM299.26 118.109C299.867 118.206 300.514 118.304 301.129 118.396C301.266 118.368 301.394 118.341 301.506 118.314C301.127 118.252 300.451 118.181 299.26 118.109Z" fill="#131313"/>
                                    <path d="M298.323 117.886C298.304 117.886 298.286 117.885 298.268 117.88C296.97 117.577 297.15 116.332 297.209 115.924C297.305 115.253 297.506 114.858 297.842 114.679C298.356 114.407 299.029 114.729 299.881 115.137C300.707 115.532 301.736 116.025 302.917 116.125C303.048 116.136 303.144 116.25 303.133 116.379C303.122 116.509 303.008 116.606 302.877 116.594C301.609 116.487 300.537 115.973 299.676 115.562C298.974 115.225 298.367 114.934 298.065 115.095C297.88 115.193 297.749 115.495 297.678 115.99C297.585 116.627 297.606 117.242 298.376 117.422C298.503 117.451 298.583 117.578 298.553 117.705C298.527 117.813 298.43 117.886 298.323 117.886Z" fill="#131313"/>
                                    <path d="M308.021 120.455C307.992 120.455 307.962 120.45 307.933 120.438C305.664 119.531 304.708 117.861 304.306 116.62C303.975 115.601 303.954 114.712 303.965 114.326C301.852 113.808 296.736 112.783 295.565 113.585C295.413 113.689 295.384 113.794 295.376 113.864C295.375 113.874 295.373 113.884 295.37 113.894C295.344 113.997 295.362 114.09 295.426 114.187C295.932 114.954 298.767 115.417 300.837 115.755C301.619 115.883 302.358 116.003 302.948 116.13C303.075 116.158 303.156 116.283 303.129 116.41C303.102 116.537 302.976 116.619 302.848 116.591C302.27 116.466 301.537 116.347 300.761 116.22C298.248 115.809 295.651 115.385 295.031 114.445C294.899 114.243 294.856 114.02 294.909 113.794C294.941 113.551 295.073 113.351 295.299 113.197C296.901 112.099 303.522 113.726 304.271 113.915C304.385 113.944 304.46 114.05 304.449 114.166C304.448 114.177 304.355 115.243 304.764 116.492C305.306 118.149 306.432 119.33 308.112 120C308.233 120.049 308.292 120.186 308.243 120.307C308.204 120.399 308.115 120.455 308.021 120.455Z" fill="#131313"/>
                                    <path d="M322.819 126.283C319.284 126.283 317.207 125.885 317.009 125.704C315.648 124.49 315.323 122.625 315.288 121.276C315.235 119.145 315.873 117.047 316.504 116.425C316.54 116.389 316.586 116.367 316.635 116.359C317.609 116.211 318.388 116.121 319.076 116.043C320.59 115.87 321.784 115.733 324.005 115.084C328.218 113.854 330.212 110.801 330.723 109.895C330.737 109.87 330.747 109.853 330.753 109.843C330.82 109.731 330.966 109.696 331.078 109.763C331.19 109.83 331.226 109.975 331.158 110.086C331.154 110.093 331.147 110.107 331.137 110.125C330.603 111.07 328.523 114.255 324.14 115.537C321.88 116.197 320.667 116.335 319.131 116.511C318.467 116.587 317.717 116.673 316.789 116.813C316.311 117.369 315.712 119.253 315.763 121.264C315.794 122.514 316.088 124.232 317.306 125.336C317.688 125.483 321.386 126.203 328.181 125.537C333.942 124.973 337.06 120.044 337.091 119.995C337.16 119.884 337.306 119.849 337.416 119.918C337.528 119.987 337.562 120.132 337.493 120.242C337.461 120.295 336.671 121.555 335.134 122.903C333.713 124.15 331.361 125.699 328.228 126.006C326.172 126.208 324.357 126.283 322.819 126.283ZM317.324 125.353C317.325 125.354 317.326 125.355 317.327 125.355C317.326 125.354 317.325 125.353 317.324 125.353Z" fill="#131313"/>
                                    <path d="M36.0785 179.526L27.3704 183.388C27.3704 183.388 20.8422 176.336 24.2709 171.158C24.2963 171.148 30.9378 168.626 30.9378 168.626L36.0785 179.526Z" fill="white"/>
                                    <path d="M49.4834 159.716L30.707 167.849L37.8826 183.447C37.8826 183.447 60.2119 178.441 67.499 175.341C74.5794 172.679 76.5717 168.479 76.7775 165.063C76.8981 163.064 76.0838 161.421 74.8723 159.822C57.8487 137.355 34.0631 121.675 34.0631 121.675L17.5273 125.315C17.5273 125.315 17.7087 138.773 37.3457 151.807C39.6236 153.444 53.0862 162.02 53.0862 162.02L49.4834 159.716Z" fill="white"/>
                                    <path d="M37.8828 183.683C37.7921 183.683 37.7068 183.63 37.6679 183.546L30.4923 167.948C30.466 167.89 30.4632 167.824 30.4868 167.765C30.5095 167.707 30.5548 167.659 30.6138 167.634L49.3902 159.501C49.5099 159.448 49.6496 159.503 49.7022 159.623C49.7547 159.742 49.6994 159.881 49.5797 159.933L31.0245 167.97L38.0197 183.176C40.1979 182.683 60.5766 178.032 67.4077 175.124C67.4104 175.123 67.414 175.121 67.4167 175.12C75.043 172.254 76.2464 168.968 76.4168 166.133C76.5257 164.328 76.405 162.184 74.6866 159.966C64.8142 147.222 54.2616 137.544 47.1477 131.669C39.438 125.303 33.9944 121.908 33.9399 121.873C33.8293 121.805 33.7949 121.659 33.8647 121.548C33.9336 121.438 34.0796 121.404 34.1911 121.474C34.2455 121.507 39.7109 124.915 47.4433 131.3C54.5781 137.191 65.1606 146.896 75.063 159.678C76.8766 162.019 77.0054 164.269 76.8911 166.161C76.7714 168.153 76.1167 169.75 74.8326 171.184C73.3328 172.86 70.9633 174.29 67.5899 175.559C60.3626 178.634 38.1612 183.627 37.9372 183.677C37.9181 183.681 37.9 183.683 37.8828 183.683Z" fill="#131313"/>
                                    <path d="M43.9535 182.268C43.8646 182.268 43.7794 182.218 43.7386 182.132L35.9735 165.682C35.9182 165.563 35.969 165.424 36.0869 165.368C36.2057 165.313 36.3462 165.364 36.4016 165.481L44.1666 181.932C44.2219 182.05 44.1711 182.19 44.0532 182.245C44.0215 182.26 43.987 182.268 43.9535 182.268Z" fill="#131313"/>
                                    <path d="M28.6565 182.888C28.6565 182.888 21.7484 179.469 24.6303 171.023L16.5859 174.079L23.2655 194.957C23.2664 194.957 30.9979 193.871 28.6565 182.888Z" fill="#131313"/>
                                    <path d="M23.2662 195.193C23.1647 195.193 23.0722 195.128 23.0404 195.028L16.3608 174.15C16.3228 174.031 16.3844 173.903 16.5023 173.859L30.8535 168.408C30.9759 168.362 31.1129 168.422 31.1591 168.544C31.2054 168.666 31.1446 168.802 31.0222 168.848L16.8795 174.22L23.4285 194.688C24.0669 194.553 26.1499 193.973 27.55 191.962C29.0263 189.841 29.3237 186.817 28.435 182.975C28.4251 182.953 28.4187 182.928 28.4169 182.903C28.4015 182.721 28.542 182.646 28.8504 182.483C29.0399 182.383 29.3192 182.244 29.6792 182.071C30.2822 181.78 31.1246 181.384 32.1811 180.897C33.9793 180.068 35.8029 179.246 35.821 179.238C35.9398 179.184 36.0804 179.237 36.1348 179.356C36.1883 179.474 36.1357 179.614 36.0169 179.668C33.5549 180.777 29.6456 182.569 28.922 182.98C29.8125 186.909 29.4806 190.023 27.9345 192.237C26.1481 194.796 23.4131 195.175 23.297 195.19C23.2871 195.192 23.2771 195.193 23.2662 195.193Z" fill="#131313"/>
                                    <path d="M53.0885 162.254C53.045 162.254 53.0005 162.242 52.9606 162.217C52.8264 162.131 39.4664 153.62 37.2093 151.997C32.7206 149.018 28.8766 145.762 25.7907 142.325C23.3188 139.572 21.3238 136.696 19.8629 133.778C17.3674 128.794 17.2948 125.458 17.293 125.319C17.2912 125.189 17.3955 125.082 17.526 125.08C17.6539 125.08 17.7645 125.182 17.7663 125.312C17.7673 125.345 17.8443 128.704 20.3027 133.6C22.5734 138.122 27.3958 144.918 37.4795 151.611C39.733 153.231 53.0821 161.735 53.2164 161.821C53.3261 161.891 53.3587 162.037 53.288 162.147C53.2426 162.216 53.1665 162.254 53.0885 162.254Z" fill="#131313"/>
                                    <path d="M93.5438 204.028L98.8895 208.792C98.8895 208.792 96.2298 218.316 90.8252 217.557C90.5269 217.276 85.9629 212.985 85.9629 212.985L93.5438 204.028Z" fill="white"/>
                                    <path d="M10.3928 126.623C7.81656 141.166 14.7165 149.194 31.7419 167.401C44.6449 180.732 85.0479 214.065 85.0479 214.065L94.798 202.546L43.3355 144.08L27.109 128.742C27.109 128.742 11.1237 122.494 10.3928 126.623Z" fill="white"/>
                                    <path d="M85.0489 214.3C84.9981 214.3 84.9464 214.284 84.9038 214.25C84.7705 214.147 71.434 203.793 56.2676 190.577C47.3582 182.814 39.5705 175.598 33.1185 169.126C25.0479 161.031 19.0566 154.086 15.3096 148.482C10.7964 141.732 9.6375 136.135 9.45977 132.63C9.26571 128.812 10.1381 126.625 10.1752 126.533C10.2242 126.413 10.362 126.355 10.4836 126.404C10.6051 126.452 10.6631 126.589 10.6141 126.71C10.6014 126.743 9.74088 128.925 9.93494 132.639C10.1145 136.079 11.2616 141.575 15.705 148.22C24.1556 160.861 42.5974 178.037 56.5786 190.22C70.7802 202.594 83.3749 212.458 85.0163 213.738L94.4879 202.547L39.7691 140.251C39.7418 140.22 39.7237 140.183 39.7156 140.143L38.5385 134.464C38.5122 134.337 38.5947 134.212 38.7226 134.186C38.8505 134.16 38.9756 134.242 39.0019 134.369L40.1671 139.988L94.9785 202.39C95.0556 202.478 95.0565 202.609 94.9812 202.697L85.2312 214.216C85.1831 214.272 85.116 214.3 85.0489 214.3Z" fill="#131313"/>
                                    <path d="M97.9841 208.082C97.9841 208.082 98.8002 215.353 90.5273 217.275L96.7843 223.158L110.972 206.035C110.973 206.035 105.629 200.546 97.9841 208.082Z" fill="#131313"/>
                                    <path d="M96.7839 223.395C96.7231 223.395 96.6651 223.372 96.6215 223.331L85.8005 213.157C85.7053 213.067 85.7017 212.918 85.7915 212.824C85.8813 212.729 86.0309 212.724 86.1261 212.814L96.763 222.815L110.651 206.054C110.167 205.618 108.533 204.322 106.119 204.298C103.581 204.274 100.96 205.621 98.3336 208.303C98.3164 208.329 98.2937 208.353 98.2665 208.37C98.0706 208.498 98.0552 208.508 95.5705 206.409C94.4089 205.427 93.2437 204.424 93.2328 204.414C93.1339 204.329 93.1231 204.18 93.2083 204.082C93.2935 203.983 93.4432 203.972 93.542 204.057C95.06 205.365 97.4785 207.419 98.0933 207.872C100.756 205.187 103.432 203.826 106.051 203.826C106.078 203.826 106.105 203.826 106.133 203.826C109.228 203.86 111.069 205.792 111.146 205.874C111.227 205.96 111.231 206.093 111.155 206.184L96.967 223.308C96.9253 223.359 96.8646 223.389 96.7993 223.394C96.7938 223.395 96.7893 223.395 96.7839 223.395Z" fill="#131313"/>
                                    <path d="M83.8458 206.505C83.7896 206.505 83.7325 206.485 83.688 206.445C71.4778 195.529 57.4395 182.767 45.3644 169.444C38.5034 161.873 32.9827 154.869 28.9583 148.625C24.2665 141.347 21.439 134.85 20.5558 129.315C20.5349 129.186 20.6229 129.066 20.7526 129.045C20.8822 129.025 21.0029 129.112 21.0237 129.241C22.6487 139.422 30.956 152.841 45.7171 169.128C57.7777 182.434 71.8043 195.186 84.0063 206.094C84.1034 206.18 84.1115 206.329 84.0245 206.427C83.9755 206.479 83.9111 206.505 83.8458 206.505Z" fill="#131313"/>
                                    <path d="M80.7111 210.877C80.6603 210.877 80.6095 210.86 80.566 210.827C80.4626 210.748 80.4445 210.599 80.5243 210.497L90.5001 197.722C90.5799 197.619 90.7286 197.601 90.832 197.68C90.9354 197.76 90.9535 197.909 90.8737 198.011L80.8979 210.786C80.8516 210.845 80.7818 210.877 80.7111 210.877Z" fill="#131313"/>
                                    <path d="M25.7354 142.963C25.6492 142.963 25.5667 142.917 25.5241 142.835C25.4642 142.72 25.5105 142.577 25.6265 142.518C30.9341 139.807 25.5685 128.626 25.5141 128.514C25.457 128.396 25.5059 128.255 25.6238 128.199C25.7417 128.142 25.8832 128.19 25.9403 128.308C25.9548 128.337 27.3567 131.237 28.0541 134.451C28.9935 138.783 28.2291 141.717 25.8433 142.936C25.8088 142.955 25.7725 142.963 25.7354 142.963Z" fill="#131313"/>
                                    <path d="M345.379 178.881L354.121 181.391C354.121 181.391 359.359 173.87 355.434 169.426C355.409 169.42 348.798 167.905 348.798 167.905L345.379 178.881Z" fill="white"/>
                                    <path d="M330.09 161.911L348.913 167.14L344.192 182.824C344.192 182.824 322.423 181.017 315.125 179.039C308.081 177.45 305.642 173.741 304.995 170.539C304.617 168.665 305.169 167.005 306.103 165.336C319.223 141.87 339.633 123.933 339.633 123.933L355.745 125.209C355.745 125.209 357.354 137.953 340.515 152.845C338.578 154.692 326.986 164.56 326.986 164.56L330.09 161.911Z" fill="#131313"/>
                                    <path d="M344.194 183.058C344.187 183.058 344.181 183.058 344.174 183.058C343.956 183.039 322.309 181.226 315.069 179.267C311.712 178.51 309.281 177.467 307.64 176.078C306.234 174.889 305.404 173.464 305.027 171.594C304.668 169.819 304.492 167.673 305.899 165.219C313.569 151.84 322.29 141.28 328.255 134.777C334.72 127.729 339.436 123.79 339.484 123.752C339.584 123.668 339.733 123.681 339.817 123.781C339.901 123.881 339.888 124.029 339.787 124.113C339.74 124.152 335.044 128.074 328.599 135.102C322.652 141.586 313.958 152.114 306.312 165.453C304.982 167.771 305.152 169.811 305.493 171.502C306.029 174.156 307.598 177.1 315.18 178.81C315.184 178.811 315.186 178.812 315.19 178.812C322.021 180.663 341.854 182.389 344.023 182.573L348.619 167.303L330.027 162.139C329.901 162.104 329.828 161.974 329.863 161.848C329.899 161.723 330.028 161.649 330.155 161.685L348.979 166.914C349.04 166.931 349.092 166.971 349.122 167.026C349.153 167.082 349.16 167.147 349.141 167.208L344.421 182.891C344.389 182.991 344.297 183.058 344.194 183.058Z" fill="#131313"/>
                                    <path d="M352.84 181.086C352.84 181.086 358.917 176.948 355.076 169.343L363.084 171.178L359.531 191.788C359.531 191.788 352.079 191.774 352.84 181.086Z" fill="#131313"/>
                                    <path d="M359.523 192.024C359.309 192.024 356.739 191.978 354.752 189.837C352.997 187.945 352.271 185.045 352.591 181.215C351.835 180.917 347.92 179.739 345.455 179.016C345.33 178.979 345.258 178.849 345.295 178.724C345.332 178.6 345.463 178.528 345.588 178.564C345.607 178.57 347.439 179.108 349.248 179.655C353.066 180.812 353.068 180.847 353.08 181.068C353.08 181.093 353.078 181.117 353.071 181.141C352.739 184.89 353.421 187.707 355.099 189.516C356.681 191.223 358.703 191.499 359.333 191.544L362.813 171.358L348.745 168.136C348.617 168.107 348.538 167.98 348.567 167.853C348.596 167.727 348.723 167.647 348.851 167.676L363.138 170.95C363.26 170.977 363.339 171.096 363.318 171.219L359.765 191.829C359.746 191.941 359.649 192.024 359.534 192.025C359.532 192.024 359.528 192.024 359.523 192.024Z" fill="#131313"/>
                                    <path d="M326.989 164.795C326.922 164.795 326.856 164.767 326.809 164.713C326.724 164.614 326.735 164.466 326.835 164.381C326.951 164.282 338.444 154.495 340.354 152.675C349.004 145.024 352.664 137.972 354.212 133.401C355.888 128.453 355.517 125.27 355.513 125.238C355.497 125.109 355.589 124.992 355.719 124.976C355.849 124.959 355.967 125.05 355.983 125.179C355.999 125.312 356.372 128.477 354.672 133.517C353.676 136.468 352.171 139.448 350.197 142.376C347.735 146.03 344.531 149.611 340.675 153.021C338.763 154.845 327.26 164.64 327.144 164.739C327.098 164.776 327.044 164.795 326.989 164.795Z" fill="#131313"/>
                                    <path d="M294.302 209.566L289.879 214.769C289.879 214.769 293.652 223.423 298.66 221.998C298.905 221.693 302.652 217.04 302.652 217.04L294.302 209.566Z" fill="white"/>
                                    <path d="M362.005 124.821C369.132 142.114 361.562 147.412 347.875 166.851C337.443 181.142 303.659 217.941 303.659 217.941L292.92 208.329L333.833 146.325L346.374 128.942C346.375 128.942 360.48 121.119 362.005 124.821Z" fill="#131313"/>
                                    <path d="M312.496 178.821C312.454 178.821 312.41 178.809 312.372 178.784C312.267 178.715 312.238 178.575 312.307 178.471L336.289 142.042L336.648 136.579C336.656 136.454 336.764 136.361 336.889 136.369C337.014 136.377 337.108 136.484 337.1 136.609L336.738 142.131C336.736 142.17 336.723 142.207 336.702 142.24L312.687 178.719C312.643 178.785 312.571 178.821 312.496 178.821Z" fill="white"/>
                                    <path d="M303.659 218.177C303.603 218.177 303.546 218.157 303.5 218.117L292.762 208.506C292.675 208.428 292.659 208.299 292.722 208.201L312.297 178.467C312.369 178.358 312.516 178.328 312.626 178.399C312.735 178.47 312.765 178.617 312.694 178.726L293.229 208.292L303.643 217.612C305.348 215.777 320.42 199.501 335.211 181.922C335.295 181.823 335.444 181.809 335.544 181.892C335.645 181.976 335.658 182.124 335.574 182.225C319.94 200.805 303.992 217.932 303.832 218.102C303.786 218.151 303.723 218.177 303.659 218.177Z" fill="#131313"/>
                                    <path d="M335.394 182.298C335.343 182.298 335.291 182.28 335.249 182.245C335.153 182.165 335.14 182.023 335.221 181.928C339.989 176.261 344.292 170.977 348.008 166.225C348.085 166.127 348.228 166.109 348.326 166.185C348.425 166.262 348.443 166.404 348.366 166.502C344.647 171.259 340.34 176.546 335.568 182.217C335.523 182.27 335.459 182.298 335.394 182.298Z" fill="white"/>
                                    <path d="M348.186 166.599C348.135 166.599 348.083 166.582 348.041 166.549C347.937 166.469 347.919 166.321 347.999 166.219C353.875 158.705 358.398 152.377 361.441 147.413C365.108 141.431 364.885 135.386 364.052 131.367C363.147 126.999 361.346 124.011 361.328 123.981C361.26 123.87 361.296 123.725 361.408 123.657C361.519 123.59 361.665 123.625 361.733 123.737C361.752 123.768 363.59 126.812 364.513 131.255C365.056 133.866 365.183 136.445 364.892 138.92C364.527 142.016 363.503 144.956 361.846 147.658C358.794 152.638 354.26 158.979 348.373 166.507C348.326 166.567 348.256 166.599 348.186 166.599Z" fill="#131313"/>
                                    <path d="M290.642 213.98C290.642 213.98 290.833 220.96 298.906 221.693L293.77 228.074L278.094 213.745C278.094 213.747 282.419 207.858 290.642 213.98Z" fill="#131313"/>
                                    <path d="M293.77 228.31C293.711 228.31 293.654 228.288 293.61 228.247L277.934 213.919C277.847 213.84 277.832 213.707 277.9 213.611C277.962 213.523 279.449 211.452 282.374 211.013C284.871 210.64 287.608 211.571 290.509 213.781C291.039 213.261 293.043 211.015 294.299 209.587C294.385 209.488 294.535 209.478 294.633 209.564C294.731 209.65 294.742 209.799 294.655 209.896C294.645 209.907 293.678 211.008 292.709 212.088C290.633 214.405 290.616 214.397 290.408 214.297C290.379 214.284 290.353 214.264 290.333 214.241C287.5 212.052 284.849 211.123 282.453 211.477C280.19 211.813 278.822 213.235 278.415 213.719L293.743 227.729L302.468 216.891C302.549 216.79 302.698 216.773 302.8 216.854C302.903 216.935 302.919 217.083 302.838 217.185L293.954 228.22C293.914 228.27 293.853 228.303 293.788 228.307C293.782 228.31 293.776 228.31 293.77 228.31Z" fill="#131313"/>
                                    <path d="M25.7628 55.2919C25.7628 55.2919 25.3112 49.9142 16.5306 53.4193C15.5857 53.4536 7.8433 53.7893 6.34615 61.2868C6.32167 61.4132 4.88709 67.7213 9.76302 70.5089C9.85189 70.555 10.6571 71.4384 10.6571 71.4384L11.6011 80.8365L20.5387 79.5442L20.3165 77.0823C20.3165 77.0823 25.858 77.3874 26.0965 66.7683C25.965 66.8089 29.6902 65.8785 28.4787 61.8445C28.3581 61.6235 31.5555 56.9948 25.7628 55.2919Z" fill="white"/>
                                    <path d="M7.13552 85.8208C7.04122 85.8208 6.95235 85.7648 6.91517 85.6719C6.86711 85.551 6.92605 85.4138 7.04756 85.366C7.14006 85.329 9.33182 84.4644 10.926 84.0845C11.597 83.9248 12.016 83.2082 11.86 82.4872C11.8582 82.4799 11.8573 82.4718 11.8564 82.4646L10.5243 70.8267C10.5098 70.6976 10.6032 70.5803 10.7328 70.5659C10.8625 70.5505 10.9804 70.6444 10.9949 70.7734L12.3261 82.4005C12.5283 83.3652 11.9516 84.3254 11.0366 84.5438C9.47601 84.9156 7.24525 85.7955 7.22349 85.8045C7.19447 85.8154 7.16454 85.8208 7.13552 85.8208Z" fill="#131313"/>
                                    <path d="M20.9463 77.345C20.0603 77.345 17.845 77.1528 15.8137 75.43C15.714 75.3452 15.7022 75.1972 15.7874 75.0979C15.8718 74.9986 16.0214 74.9869 16.1211 75.0717C18.5006 77.0905 21.1258 76.8766 21.2891 76.8613C27.3194 76.013 25.4894 60.3673 25.4704 60.2093C25.4549 60.0803 25.5474 59.963 25.6771 59.9467C25.8077 59.9314 25.9247 60.0234 25.941 60.1525C25.9455 60.1931 26.427 64.2306 26.1233 68.3241C25.9437 70.7418 25.5302 72.71 24.8927 74.1738C24.0739 76.0536 22.8823 77.1158 21.3498 77.3287C21.3471 77.3287 21.3435 77.3296 21.3407 77.3296C21.3163 77.3315 21.1757 77.345 20.9463 77.345Z" fill="#131313"/>
                                    <path d="M11.0714 71.0487C10.356 71.0487 9.76382 70.8592 9.30407 70.4828C8.29025 69.6517 8.29025 68.1897 8.31474 67.7611C8.34013 67.3161 8.46799 66.8839 8.68381 66.5112C9.00482 65.958 9.44553 65.6241 9.99325 65.5194C11.202 65.2865 12.4852 66.2738 12.5387 66.3162C12.6411 66.3966 12.6593 66.5446 12.5786 66.6474C12.4979 66.7494 12.3491 66.7675 12.2467 66.6871C12.2349 66.6781 11.0778 65.7892 10.0812 65.9823C9.66951 66.0618 9.34578 66.3126 9.09369 66.7467C8.91414 67.0553 8.80804 67.4154 8.78719 67.7872C8.76633 68.1599 8.7627 69.4288 9.60513 70.1191C10.2054 70.611 11.1132 70.7084 12.3029 70.407C12.4298 70.3745 12.5586 70.4512 12.5904 70.5776C12.623 70.7039 12.5459 70.8321 12.419 70.8637C11.9311 70.9864 11.4813 71.0487 11.0714 71.0487Z" fill="#131313"/>
                                    <path d="M12.266 69.3827C12.1789 69.3827 12.1009 69.3349 12.0601 69.2627C12.0139 69.2139 11.8089 69.0235 10.9021 68.3142C10.3045 67.8458 9.69969 67.3856 9.69425 67.3811C9.59088 67.3016 9.57093 67.1536 9.64982 67.0508C9.72962 66.947 9.87743 66.928 9.98171 67.0065C9.98806 67.0111 10.5947 67.4731 11.195 67.9433C12.4872 68.9549 12.4909 68.9982 12.5026 69.1264C12.5144 69.2563 12.4183 69.3701 12.2877 69.3818C12.2796 69.3827 12.2732 69.3827 12.266 69.3827Z" fill="#131313"/>
                                    <path d="M10.5432 69.1988C10.5015 69.1988 10.4597 69.1879 10.4217 69.1654C10.3092 69.0986 10.2729 68.9533 10.341 68.8423L10.8442 68.0075C10.9113 67.8956 11.0573 67.8595 11.1689 67.9272C11.2813 67.994 11.3176 68.1393 11.2496 68.2503L10.7463 69.0851C10.7019 69.1581 10.6239 69.1988 10.5432 69.1988Z" fill="#131313"/>
                                    <path d="M12.8785 66.919C12.6328 66.919 12.3671 66.8035 12.086 66.5725C11.9853 66.4894 11.9708 66.3414 12.0542 66.2404C12.1377 66.1402 12.2864 66.1257 12.388 66.2088C12.6446 66.419 12.8513 66.4903 13.0019 66.4199C13.7781 66.0581 13.7971 62.7876 13.8035 61.7119C13.8071 61.0675 13.8107 60.9692 13.8525 60.8834C13.9041 60.7779 14.0257 60.7264 14.1372 60.7616C19.0603 62.3283 21.4289 61.2986 22.2196 60.7824C22.7102 60.462 22.8997 60.1588 22.9251 60.0604C22.9043 59.99 22.9169 59.9133 22.9614 59.8537C23.0167 59.7788 23.111 59.7436 23.2026 59.7635C23.802 59.8935 24.4395 59.999 25.0398 59.8853C25.6655 59.7671 26.1742 59.398 26.3656 58.9224C26.4145 58.8015 26.5524 58.7428 26.6739 58.7916C26.7954 58.8403 26.8543 58.9775 26.8054 59.0984C26.5542 59.722 25.9112 60.2012 25.1278 60.3492C24.5302 60.462 23.9244 60.3907 23.3486 60.2761C23.306 60.3763 23.238 60.4855 23.1446 60.5992C22.897 60.9015 22.1353 61.6379 20.4105 61.9429C18.7193 62.2416 16.6581 62.025 14.2805 61.3013C14.2787 61.4213 14.2778 61.5702 14.2768 61.7155C14.2632 64.1277 14.1236 66.4181 13.2023 66.8477C13.098 66.8946 12.9901 66.919 12.8785 66.919Z" fill="#131313"/>
                                    <path d="M16.1553 65.6151C16.0727 65.6151 15.992 65.5718 15.9485 65.4951C15.8841 65.3814 15.9249 65.2379 16.0392 65.1738C17.6207 64.2894 19.5213 64.8751 19.6011 64.9013C19.7254 64.941 19.7943 65.0737 19.7553 65.1973C19.7154 65.3209 19.583 65.3895 19.4579 65.3507C19.4397 65.3453 17.6696 64.8029 16.2713 65.5853C16.2341 65.6061 16.1942 65.6151 16.1553 65.6151Z" fill="#131313"/>
                                    <path d="M22.5023 71.6868C22.4361 71.6868 22.3699 71.6588 22.3228 71.6056C22.2375 71.5072 22.2484 71.3583 22.3473 71.2735C22.3935 71.2338 22.4452 71.1922 22.4996 71.148C22.9857 70.7573 23.304 70.4324 22.9748 69.8151C22.7662 69.4243 22.5676 69.0832 22.3926 68.7836C21.8812 67.9064 21.5112 67.272 21.4668 66.3804C21.4105 65.8299 21.5574 65.3814 21.9047 65.0466C22.7943 64.1884 24.695 64.4356 24.7757 64.4474C24.9054 64.4645 24.9961 64.5836 24.9779 64.7127C24.9607 64.8417 24.841 64.932 24.7113 64.9148C24.6941 64.9121 22.9566 64.6874 22.233 65.3859C21.9909 65.6196 21.8948 65.931 21.9374 66.338C21.9383 66.3425 21.9383 66.347 21.9383 66.3515C21.9764 67.1312 22.3047 67.6944 22.8007 68.5472C22.9775 68.8513 23.1788 69.1951 23.391 69.594C23.9287 70.602 23.1915 71.1949 22.7952 71.5135C22.7454 71.5541 22.6973 71.592 22.6547 71.629C22.6121 71.6678 22.5577 71.6868 22.5023 71.6868Z" fill="#131313"/>
                                    <path d="M17.828 67.3849C17.8516 67.8641 18.0946 68.2422 18.3694 68.2278C18.6451 68.2142 18.8482 67.8144 18.8246 67.3352C18.801 66.856 18.558 66.4779 18.2832 66.4923C18.0085 66.5059 17.8044 66.9057 17.828 67.3849Z" fill="#131313"/>
                                    <path d="M23.6562 66.8416C23.6797 67.3208 23.9228 67.699 24.1975 67.6845C24.4732 67.671 24.6763 67.2712 24.6527 66.792C24.6292 66.3128 24.3861 65.9347 24.1114 65.9491C23.8366 65.9627 23.6326 66.3624 23.6562 66.8416Z" fill="#131313"/>
                                    <path d="M20.9665 73.7352C20.3018 73.7352 19.375 73.5818 18.6777 72.8644C18.587 72.7705 18.5897 72.6216 18.6831 72.5314C18.7774 72.4411 18.927 72.4438 19.0177 72.5368C20.0207 73.5692 21.6856 73.1956 21.7028 73.191C21.8298 73.1613 21.9576 73.2398 21.9875 73.3661C22.0175 73.4925 21.9386 73.6197 21.8116 73.6495C21.7799 73.6576 21.4389 73.7352 20.9665 73.7352Z" fill="#131313"/>
                                    <path d="M10.6575 71.675C10.6194 71.675 10.5813 71.666 10.5459 71.647C8.36415 70.4792 6.81894 68.3946 6.19596 65.7784C5.63283 63.4122 5.91213 60.8357 6.94317 58.8873C8.59176 55.7721 11.1127 54.3868 12.9363 53.7741C14.7254 53.1721 16.1791 53.1748 16.4856 53.183C18.0897 52.4926 19.858 52.1415 21.6054 52.1695C22.8314 52.1885 23.7491 52.4042 24.4927 52.8464C25.3605 53.3635 25.9345 54.2379 25.9944 55.1151C26.9411 55.4003 27.5668 55.6647 27.9041 55.9219C28.7837 56.5924 29.3668 57.577 29.5056 58.622C29.6398 59.64 29.3414 60.6814 28.6414 61.6416C29.0912 62.4854 29.2018 63.8111 28.8735 64.6287C28.3285 65.9905 26.9211 66.7837 25.9481 66.67C25.8185 66.6547 25.7251 66.5383 25.7405 66.4083C25.7559 66.2793 25.8738 66.1863 26.0035 66.2016C26.6944 66.282 27.9522 65.6566 28.4337 64.4536C28.7275 63.7208 28.5978 62.4565 28.1571 61.7481C28.1054 61.665 28.1109 61.5586 28.1707 61.4801C28.8708 60.574 29.1619 59.6327 29.0358 58.6834C28.9152 57.7746 28.3847 56.8821 27.6158 56.2964C27.3111 56.0636 26.6645 55.8019 25.696 55.5185C25.5945 55.4887 25.5247 55.3949 25.5265 55.2893C25.5364 54.5186 25.0359 53.719 24.2506 53.2516C23.5814 52.8527 22.738 52.6595 21.5982 52.6415C19.9015 52.6144 18.1813 52.9592 16.6261 53.6369C16.5926 53.6513 16.5563 53.6586 16.5191 53.6567C16.5037 53.6558 14.963 53.5882 13.0705 54.228C10.545 55.0817 8.6244 56.7242 7.36212 59.1084C5.35625 62.8969 6.3873 68.8873 10.7699 71.2328C10.8851 71.2941 10.9286 71.4376 10.866 71.5522C10.8234 71.6299 10.7418 71.675 10.6575 71.675Z" fill="#131313"/>
                                    <path d="M20.6645 79.9134C20.553 79.9134 20.4541 79.8349 20.4324 79.7221L19.93 77.1104C19.9055 76.9823 19.9899 76.8596 20.1177 76.8343C20.2465 76.8099 20.3698 76.8938 20.3952 77.0211L20.8976 79.6328C20.9221 79.7609 20.8377 79.8836 20.7099 79.9089C20.6945 79.9125 20.679 79.9134 20.6645 79.9134Z" fill="#131313"/>
                                    <path class="theme-color" d="M83.1901 74.2622V85.2639H69.3512V129.882H56.0854V85.2639H42.1641V74.2622H83.1901Z" fill="#748173"/>
                                    <path d="M20.5391 79.5444C20.5391 79.5444 21.2074 82.3203 23.3339 82.5513C23.3339 82.5513 31.9903 82.9204 33.7586 84.7705C32.8463 85.764 35.0934 102.95 35.0934 102.95L37.6171 124.262C37.6171 124.262 27.1778 136.247 10.3927 126.623C10.3927 126.623 9.50769 110.916 4.94643 104.182C4.48577 104.15 -2.2854 96.2748 0.812272 91.842C0.924717 91.5406 1.3745 86.3227 11.5335 84.0999C11.5335 84.0999 12.3496 82.8266 11.9135 80.8737C12.0885 80.8105 16.4339 78.9948 20.5391 79.5444Z" fill="#131313"/>
                                    <path d="M23.3628 130.689C22.6627 130.689 21.9581 130.653 21.2481 130.582C17.6889 130.226 14.0045 128.967 10.2975 126.841C10.1587 126.793 10.156 126.758 10.0834 125.937C8.91547 112.702 6.47161 106.996 4.62716 104.54C4.54917 104.436 4.57003 104.288 4.67522 104.211C4.78041 104.133 4.92822 104.154 5.00621 104.259C6.88784 106.764 9.37704 112.551 10.555 125.897C10.5768 126.139 10.5958 126.356 10.6085 126.475C17.1004 130.18 23.3293 131.148 29.122 129.354C34.2237 127.774 37.1826 124.513 37.5027 124.02C36.9088 120.367 33.6324 95.1855 33.5989 94.9301C33.5817 94.8011 33.6733 94.6829 33.8029 94.6666C33.9317 94.6495 34.0514 94.7406 34.0677 94.8697C34.1013 95.126 37.3903 120.404 37.9725 123.966C38.0269 124.106 37.9135 124.26 37.8401 124.359C37.1862 125.245 34.2872 128.121 29.7069 129.66C27.6693 130.344 25.5419 130.689 23.3628 130.689ZM37.5852 124.217C37.5852 124.218 37.5852 124.218 37.5852 124.217V124.217Z" fill="#131313"/>
                                    <path d="M11.9146 81.1089C11.8184 81.1089 11.7278 81.0493 11.6924 80.9546C11.647 80.8327 11.7105 80.6974 11.8329 80.6522C16.542 78.9322 20.5238 79.3067 20.5637 79.3103C20.6934 79.3229 20.7886 79.4384 20.7759 79.5684C20.7632 79.6974 20.6472 79.7922 20.5166 79.7796C20.4776 79.776 16.5982 79.4141 11.9962 81.0953C11.9699 81.1035 11.9418 81.1089 11.9146 81.1089Z" fill="#131313"/>
                                    <path d="M35.6861 104.443C35.5755 104.443 35.4785 104.362 35.4622 104.249L34.9516 100.713C34.9335 100.589 35.0196 100.475 35.1439 100.457C35.2681 100.44 35.3824 100.525 35.4005 100.649L35.911 104.185C35.9292 104.309 35.843 104.423 35.7188 104.441C35.707 104.442 35.6961 104.443 35.6861 104.443Z" fill="white"/>
                                    <path d="M76.4826 73.9096C76.4826 73.9096 75.2756 70.3612 73.1373 71.8728C73.082 71.7807 71.9095 69.4316 69.9544 71.3963C69.9544 71.3963 68.7937 69.4425 67.2304 71.0064C67.3891 70.8268 65.735 68.8261 64.6024 71.6029C64.3159 72.7734 63.4199 76.7369 66.3091 75.5935C66.3199 75.5863 67.2014 77.1006 69.0948 75.5358C69.0485 76.0023 69.8248 77.8145 71.6493 76.0484C71.7399 76.2081 73.0585 78.3776 74.4141 76.6548C74.4486 76.4337 74.7787 74.1875 74.7787 74.1875L76.4826 73.9096Z" fill="white"/>
                                    <path d="M65.503 76.1123C65.3607 76.1123 65.2228 76.088 65.0904 76.0392C64.3478 75.7649 64.0938 74.8119 64.0712 74.7217C63.8055 73.7759 64.1084 70.87 65.3607 70.075C65.8059 69.7916 66.5595 69.6445 67.6177 70.5506C67.722 70.6399 67.7338 70.796 67.644 70.8998C67.5542 71.0036 67.3974 71.0153 67.2931 70.926C66.6293 70.3583 66.0698 70.2122 65.6282 70.4919C64.5917 71.1498 64.326 73.7985 64.5509 74.5908C64.5518 74.5944 64.5527 74.5971 64.5536 74.6007C64.5554 74.608 64.7513 75.3859 65.2645 75.5745C65.552 75.6801 65.9093 75.5817 66.3264 75.2821C66.438 75.2018 66.593 75.227 66.6737 75.338C66.7544 75.449 66.729 75.6034 66.6175 75.6837C66.2212 75.9689 65.8476 76.1123 65.503 76.1123Z" fill="#131313"/>
                                    <path d="M73.2505 77.5951C73.1806 77.5951 73.109 77.5906 73.0365 77.5815C73.0328 77.5815 73.0301 77.5806 73.0265 77.5797L73.0129 77.5779C72.6737 77.5265 72.4008 77.3586 72.1995 77.0771C71.7987 76.5149 71.7252 75.5438 71.9818 74.1911H71.9836C71.9882 74.0584 72.0263 73.8211 72.1514 73.3807C72.2702 72.9628 72.4842 72.3654 72.8279 71.888C73.3275 71.194 73.9741 70.9341 74.695 71.1336C74.6995 71.1345 74.7032 71.1363 74.7077 71.1372L74.7512 71.1516C75.1747 71.2897 76.4624 71.7111 76.7353 74.034C76.7426 74.0963 76.7245 74.1586 76.6855 74.2082C76.6465 74.2569 76.5893 74.2885 76.5268 74.2957L75.0323 74.4663C75.026 75.0339 74.9371 76.5455 74.1809 77.235C73.9206 77.4742 73.6077 77.5951 73.2505 77.5951ZM73.099 77.1141C73.4046 77.152 73.6549 77.078 73.8626 76.8885C74.4946 76.3118 74.5798 74.8002 74.559 74.2669C74.5545 74.1441 74.6451 74.0376 74.7685 74.0241L76.2339 73.8571C75.9437 72.0396 74.9426 71.712 74.6043 71.6019L74.5635 71.5884C74.2126 71.4927 73.9043 71.5433 73.6213 71.7445C72.7898 72.3347 72.4715 73.9853 72.4516 74.2262C72.4525 74.2434 72.4507 74.2614 72.4479 74.2786C72.1596 75.801 72.3645 76.4923 72.5867 76.8045C72.7726 77.0653 72.9993 77.0996 73.0845 77.1123L73.099 77.1141Z" fill="#131313"/>
                                    <path d="M70.4002 77.005C70.3186 77.005 70.2351 76.9996 70.1508 76.9888C70.1472 76.9888 70.1435 76.9879 70.1399 76.987L70.1254 76.9843C69.9985 76.9644 69.6122 76.9048 69.312 76.4816C68.913 75.9203 68.8414 74.9493 69.0971 73.5974H69.0989C69.1034 73.4647 69.1415 73.2274 69.2667 72.7879C69.3855 72.371 69.5986 71.7735 69.9422 71.2962C70.4419 70.6022 71.0884 70.3405 71.8103 70.5408C71.8148 70.5417 71.8184 70.5435 71.823 70.5444L71.8665 70.5588C72.1331 70.6464 72.8431 70.8783 73.3437 71.7546C73.4081 71.8674 73.3682 72.0118 73.2548 72.0759C73.1415 72.1399 72.9964 72.1002 72.932 71.9874C72.5221 71.2691 71.959 71.085 71.7187 71.0065L71.6779 70.9929C71.3269 70.8973 71.0186 70.9478 70.7357 71.1491C69.9041 71.7393 69.5859 73.3898 69.5659 73.6308C69.5668 73.6479 69.565 73.666 69.5623 73.6831C69.2739 75.2055 69.477 75.8959 69.6983 76.2082C69.8833 76.4681 70.1118 76.5042 70.198 76.5168L70.2134 76.5195C70.5761 76.5646 70.879 76.4825 71.1383 76.2704C71.8756 75.6649 71.9789 74.2309 71.9808 74.2165C71.9898 74.0865 72.1023 73.9881 72.2328 73.9972C72.3634 74.0053 72.4623 74.1172 72.4541 74.2471C72.4496 74.3139 72.3371 75.8977 71.4421 76.6332C71.141 76.8814 70.7919 77.005 70.4002 77.005Z" fill="#131313"/>
                                    <path d="M67.6261 76.5294C67.481 76.5294 67.3359 76.5077 67.1936 76.4617C66.6885 76.3002 66.0673 75.7975 65.9794 74.3247C65.963 74.0513 66.0211 73.758 66.0818 73.4475C66.0936 73.3898 66.1054 73.3302 66.1163 73.2697H66.1181C66.1226 73.1371 66.1607 72.8997 66.2859 72.4602C66.4046 72.0433 66.6177 71.4459 66.9614 70.9685C67.4611 70.2745 68.1076 70.0128 68.8295 70.2132C68.834 70.2141 68.8376 70.2159 68.8422 70.2168C68.8666 70.2249 68.8948 70.233 68.9256 70.2411C69.1913 70.3151 69.6864 70.4514 70.1589 71.279C70.2232 71.3918 70.1833 71.5361 70.07 71.6002C69.9566 71.6643 69.8115 71.6246 69.7472 71.5118C69.3717 70.8539 69.0271 70.7582 68.7986 70.6951C68.7615 70.6842 68.727 70.6752 68.6962 70.6653C68.3452 70.5696 68.0378 70.6211 67.7549 70.8214C66.9233 71.4116 66.6051 73.0622 66.5851 73.3031C66.586 73.3203 66.5842 73.3383 66.5815 73.3564C66.5697 73.4177 66.5579 73.4782 66.5461 73.5378C66.4881 73.8302 66.4391 74.0828 66.4518 74.2967C66.5098 75.266 66.8082 75.8435 67.3387 76.0141C67.7676 76.1513 68.2527 75.9654 68.5184 75.5602C68.9537 74.8987 69.0326 73.9746 69.0335 73.9646C69.0444 73.8347 69.1586 73.7381 69.2883 73.7489C69.4189 73.7598 69.5159 73.8726 69.505 74.0025C69.5014 74.0449 69.4162 75.0539 68.9138 75.8183C68.6191 76.2695 68.1267 76.5294 67.6261 76.5294Z" fill="#131313"/>
                                    <path d="M48.4544 113.82C48.4544 113.82 51.2102 120.359 46.4095 124.068C45.4664 123.914 31.273 122.671 13.7425 112.425C13.5657 112.317 0.340751 103.336 0.238281 95.1207C0.238281 95.1207 9.74348 88.0618 18.0064 95.4754C18.0054 95.4754 27.2676 107.124 48.4544 113.82Z" fill="#131313"/>
                                    <path d="M48.4554 113.82L57.6169 115.268C57.6169 115.268 59.8839 113.281 65.0609 113.329C66.5798 113.085 68.6147 112.25 69.118 113.38C68.7008 114.232 66.5961 115.504 64.3545 116.415C65.2033 116.365 73.1107 115.813 73.8815 117.42C73.8316 117.698 73.7763 118.819 69.2948 118.591C70.0856 118.57 75.2217 119.528 75.2381 120.838C75.248 121.252 74.83 122.023 73.614 121.883C74.2596 122.104 75.9463 123.44 73.1397 123.831C72.7579 123.815 67.0042 123.487 67.0042 123.487C67.0042 123.487 72.076 124.916 71.6026 125.98C71.6026 125.98 71.6598 127.32 64.4252 125.767C63.6962 125.713 58.433 125.62 56.2694 124.657L47.2402 124.147C47.2393 124.149 51.0615 120.798 48.4554 113.82Z" fill="white"/>
                                    <path d="M72.338 124.064C71.5273 124.064 70.5289 123.991 69.3365 123.847L66.4129 123.521C66.2796 123.507 66.1835 123.387 66.1989 123.254C66.2134 123.121 66.3331 123.026 66.4673 123.041L69.3936 123.368C72.922 123.795 74.0891 123.509 74.4472 123.193C74.5343 123.116 74.5751 123.032 74.5751 122.928C74.5824 122.592 74.2151 122.21 73.4969 122.122C70.9451 121.807 66.6342 121.323 66.5906 121.317C66.4573 121.302 66.3612 121.183 66.3766 121.05C66.392 120.918 66.5126 120.823 66.645 120.837C66.6886 120.842 71.0014 121.327 73.5559 121.642C74.6069 121.772 75.072 122.402 75.0603 122.934C75.0603 123.169 74.9596 123.386 74.7692 123.555C74.3829 123.894 73.5803 124.064 72.338 124.064Z" fill="#131313"/>
                                    <path d="M73.735 122.128C73.6642 122.128 73.5926 122.126 73.5182 122.123C73.384 122.118 73.2798 122.006 73.2852 121.872C73.2906 121.739 73.4049 121.636 73.5373 121.64C74.4504 121.676 74.9755 121.451 75.0063 121.221C75.0444 120.944 74.9809 120.71 74.8141 120.503C74.0587 119.571 71.3546 119.36 69.1819 119.19C68.159 119.111 67.1932 119.035 66.456 118.898C66.3245 118.873 66.2375 118.747 66.2619 118.616C66.2864 118.485 66.4134 118.399 66.5449 118.423C67.2567 118.556 68.2098 118.63 69.22 118.708C71.6031 118.894 74.3044 119.105 75.1913 120.199C75.4434 120.51 75.5432 120.875 75.4869 121.285C75.4153 121.819 74.766 122.128 73.735 122.128Z" fill="#131313"/>
                                    <path d="M66.4996 118.903C66.3727 118.903 66.2657 118.804 66.2575 118.677C66.2485 118.544 66.35 118.429 66.4842 118.421C67.0365 118.386 67.7229 118.376 68.4493 118.365C70.3681 118.337 72.9951 118.299 73.5546 117.681C73.6208 117.607 73.6471 117.534 73.639 117.444C73.6381 117.435 73.6381 117.424 73.6381 117.414C73.6399 117.371 73.6317 117.305 73.5419 117.22C72.5172 116.241 66.1532 116.511 63.7874 116.699C63.6532 116.709 63.5371 116.611 63.5262 116.477C63.5153 116.344 63.6151 116.228 63.7493 116.217C64.6425 116.147 72.5118 115.566 73.8784 116.871C74.0833 117.067 74.1259 117.273 74.1241 117.416C74.1395 117.633 74.0679 117.837 73.9155 118.005C73.2654 118.724 71.2423 118.808 68.4565 118.849C67.7365 118.86 67.0555 118.869 66.516 118.904C66.5105 118.902 66.5051 118.903 66.4996 118.903Z" fill="#131313"/>
                                    <path d="M64.3533 116.651C64.2545 116.651 64.162 116.589 64.1285 116.49C64.0867 116.367 64.1538 116.233 64.2781 116.193C66.4943 115.454 67.9987 114.667 68.7487 113.852C68.9391 113.644 68.9101 113.401 68.8194 113.243C68.7296 113.086 68.5356 112.938 68.2608 112.996C66.6639 113.329 64.5846 113.715 63.7168 113.66C59.2743 113.88 57.8043 115.413 57.7898 115.428C57.7436 115.478 57.6774 115.506 57.6094 115.505C57.5686 115.504 53.429 115.391 48.3925 114.049C48.2665 114.016 48.1912 113.887 48.2248 113.761C48.2583 113.635 48.3889 113.56 48.515 113.594C53.0635 114.806 56.8667 115.004 57.5214 115.03C57.895 114.687 59.5672 113.391 63.7068 113.188C63.7159 113.188 63.7258 113.188 63.7349 113.188C64.3624 113.232 65.9348 113 68.1638 112.534C68.5945 112.444 69.0135 112.631 69.2311 113.01C69.4487 113.39 69.3961 113.845 69.0978 114.169C68.2925 115.045 66.7219 115.876 64.4277 116.639C64.4041 116.647 64.3787 116.651 64.3533 116.651Z" fill="#131313"/>
                                    <path d="M70.387 126.844C69.4575 126.844 68.091 126.591 66.2937 126.242C65.3787 126.064 64.4084 125.998 63.2858 125.922C61.4513 125.798 59.1688 125.643 56.2362 124.892C55.8254 124.884 51.0075 124.775 46.3864 124.301C46.2567 124.288 46.1615 124.172 46.1751 124.042C46.1887 123.913 46.3039 123.819 46.4354 123.832C51.2224 124.323 56.2235 124.42 56.2734 124.421C56.2915 124.421 56.3106 124.424 56.3278 124.429C59.2314 125.175 61.4975 125.327 63.3184 125.451C64.4574 125.528 65.4412 125.595 66.3852 125.779C68.5144 126.193 70.7171 126.621 71.2539 126.2C71.321 126.148 71.3555 126.083 71.3636 125.993C71.3101 125.687 71.1134 125.241 66.3599 123.503C66.2374 123.458 66.174 123.322 66.2193 123.2C66.2646 123.079 66.3998 123.015 66.5231 123.06C68.8082 123.896 70.2247 124.494 70.981 124.945C71.6901 125.366 71.7844 125.635 71.8352 125.944C71.8379 125.96 71.8388 125.975 71.8379 125.992C71.8279 126.23 71.7273 126.43 71.5468 126.571C71.302 126.762 70.9148 126.844 70.387 126.844Z" fill="#131313"/>
                                    <path d="M46.39 124.304C46.2839 124.304 46.0753 124.28 45.6047 124.213C45.1867 124.152 44.4821 124.041 43.5018 123.855C41.8922 123.55 39.2978 122.997 36.0805 122.091C30.5163 120.524 22.1038 117.61 13.6214 112.627C9.92074 110.453 6.53652 107.593 4.09266 104.575C1.4357 101.296 0.0210766 98.0273 0.000219956 95.1223C-0.0251708 91.5477 2.14664 87.1447 7.05522 85.3642C7.17854 85.3191 7.31366 85.3822 7.359 85.505C7.40343 85.6268 7.34086 85.7622 7.21754 85.8073C2.52569 87.5093 0.449092 91.7102 0.473576 95.1196C0.512569 100.581 6.01782 107.615 13.8608 112.223C22.1963 117.119 30.4637 120.004 35.9326 121.56C41.8559 123.247 45.8477 123.794 46.3492 123.831C47.4945 123.202 48.2861 122.111 48.7051 120.584C49.4115 118.007 48.8139 114.959 48.2889 114.007C47.8137 113.811 47.2515 113.583 46.6185 113.326C43.675 112.132 39.2271 110.327 34.722 108.219C34.7184 108.217 34.7148 108.215 34.7103 108.213L31.9925 106.758C31.9898 106.757 31.9871 106.756 31.9844 106.754C24.33 102.251 19.5583 98.4975 17.8028 95.597C17.7356 95.4851 17.771 95.3407 17.8835 95.2739C17.995 95.2072 18.141 95.2424 18.2081 95.3543C19.922 98.1861 24.6365 101.884 32.2211 106.346L34.9288 107.795C39.4211 109.897 43.86 111.698 46.7972 112.891C47.4646 113.161 48.0531 113.4 48.5446 113.603C48.5908 113.622 48.6298 113.655 48.6561 113.697C49.2419 114.652 49.932 117.902 49.1621 120.708C48.7015 122.388 47.8128 123.588 46.5197 124.274C46.4897 124.291 46.4671 124.304 46.39 124.304ZM46.2993 123.858C46.2984 123.859 46.2966 123.859 46.2957 123.86C46.2966 123.86 46.2975 123.859 46.2993 123.858Z" fill="#131313"/>
                                    <path d="M38.1332 123.275C38.1141 123.275 38.0951 123.272 38.0751 123.268C34.3482 122.296 24.5011 119.342 13.5894 112.932C9.42624 110.486 6.42469 108.181 4.41338 105.884C4.33086 105.79 4.34084 105.648 4.43515 105.565C4.52946 105.483 4.67273 105.493 4.75525 105.587C6.73482 107.847 9.69919 110.123 13.8207 112.543C24.6834 118.925 34.4824 121.864 38.1912 122.831C38.3127 122.863 38.3844 122.986 38.3526 123.106C38.3263 123.207 38.2338 123.275 38.1332 123.275Z" fill="white"/>
                                    <path d="M36.5236 108.294C36.4946 108.294 36.4665 108.289 36.4384 108.277C34.944 107.67 31.0247 105.987 26.9096 103.47C22.6041 100.837 19.5445 98.1888 17.817 95.5997C17.7481 95.4959 17.7762 95.356 17.8805 95.2865C17.9848 95.218 18.1253 95.2459 18.1951 95.3497C22.6694 102.054 35.197 107.285 36.6107 107.859C36.7268 107.906 36.7821 108.038 36.7349 108.154C36.6977 108.242 36.6125 108.294 36.5236 108.294Z" fill="white"/>
                                    <path class="theme-color" d="M146.005 148.139L128.024 181.092V205.078H114.653V181.092L96.6719 148.139H112.221L123.129 169.698L133.986 148.139H146.005Z" fill="#748173" fill-opacity="0.1"/>
                                    <path class="theme-color" d="M174.489 205.953C166.783 205.953 160.821 203.075 156.606 197.318C152.391 191.561 150.283 184.595 150.283 176.42C150.283 168.106 152.419 161.167 156.691 155.605C160.962 150.044 167.049 147.262 174.95 147.262C182.935 147.262 188.959 150.231 193.02 156.168C197.083 162.107 199.114 168.898 199.114 176.546C199.114 184.805 197.019 191.771 192.833 197.444C188.644 203.116 182.529 205.953 174.489 205.953ZM174.866 158.149C167.839 158.149 164.325 164.296 164.325 176.586C164.325 188.906 167.839 195.066 174.866 195.066C181.671 195.066 185.073 188.92 185.073 176.629C185.072 164.309 181.671 158.149 174.866 158.149Z" fill="#748173" fill-opacity="0.1"/>
                                    <path class="theme-color" d="M258.468 148.139V183.595C258.468 189.323 257.812 193.585 256.499 196.38C255.185 199.175 252.761 201.469 249.227 203.263C245.691 205.057 241.172 205.953 235.667 205.953C230.162 205.953 225.782 205.146 222.527 203.533C219.271 201.921 216.833 199.627 215.212 196.65C213.591 193.675 212.781 189.323 212.781 183.594V148.138H227.326V183.594C227.326 186.653 227.584 188.906 228.101 190.351C228.618 191.798 229.652 192.945 231.202 193.792C232.753 194.641 234.66 195.065 236.923 195.065C239.438 195.065 241.485 194.648 243.064 193.813C244.643 192.979 245.69 191.874 246.208 190.497C246.725 189.12 246.983 186.819 246.983 183.593V148.137H258.468V148.139Z" fill="#748173" fill-opacity="0.1"/>
                                    <path class="theme-color" d="M140.777 148.139L122.795 181.092V205.078H109.425V181.092L91.4434 148.139H106.992L117.901 169.698L128.758 148.139H140.777Z" fill="#748173"/>
                                    <path class="theme-color" d="M169.262 205.953C161.556 205.953 155.595 203.075 151.38 197.318C147.164 191.561 145.057 184.595 145.057 176.42C145.057 168.106 147.192 161.167 151.464 155.605C155.735 150.044 161.823 147.262 169.724 147.262C177.708 147.262 183.732 150.231 187.794 156.168C191.856 162.107 193.888 168.898 193.888 176.546C193.888 184.805 191.793 191.771 187.606 197.444C183.417 203.116 177.303 205.953 169.262 205.953ZM169.638 158.149C162.612 158.149 159.098 164.296 159.098 176.586C159.098 188.906 162.612 195.066 169.638 195.066C176.443 195.066 179.846 188.92 179.846 176.629C179.846 164.309 176.443 158.149 169.638 158.149Z" fill="#748173"/>
                                    <path class="theme-color" d="M253.242 148.139V183.595C253.242 189.323 252.585 193.585 251.272 196.38C249.958 199.175 247.534 201.469 244 203.263C240.465 205.057 235.945 205.953 230.441 205.953C224.936 205.953 220.556 205.146 217.3 203.533C214.045 201.921 211.606 199.627 209.986 196.65C208.364 193.675 207.555 189.323 207.555 183.594V148.138H222.099V183.594C222.099 186.653 222.357 188.906 222.874 190.351C223.391 191.798 224.425 192.945 225.976 193.792C227.526 194.641 229.433 195.065 231.697 195.065C234.211 195.065 236.258 194.648 237.838 193.813C239.416 192.979 240.464 191.874 240.982 190.497C241.498 189.12 241.757 186.819 241.757 183.593V148.137H253.242V148.139Z" fill="#748173"/>
                                    <path class="theme-color" d="M286.971 74.2622V100.394L304.493 74.2622H317.024L303.601 94.1205L320.382 129.883H305.965L294.813 105.73L286.972 117.129V129.884H274.115V74.2622H286.971Z" fill="#748173" fill-opacity="0.1"/>
                                    <path class="theme-color" d="M282.682 74.2622V100.394L300.203 74.2622H312.735L299.311 94.1205L316.092 129.883H301.675L290.523 105.73L282.681 117.129V129.884H269.824V74.2622H282.682Z" fill="#748173"/>
                                    <path d="M358.374 120.214C358.673 120.024 358.959 119.777 359.22 119.495C358.588 117.879 358.834 114.529 359.97 109.265L360.03 108.987L360.315 109.005C360.904 109.043 361.486 109.062 362.081 109.079C362.759 109.1 363.46 109.121 364.175 109.176C364.62 109.21 366.82 107.916 368.784 105.982C371.147 103.655 373.894 99.8203 373.555 94.7684C373.28 90.656 369.463 87.3603 367.412 85.5897C366.934 85.1773 366.43 84.7702 365.943 84.3768C364.173 82.9473 362.342 81.4691 361.376 79.4233C360.573 77.7231 360.457 75.8785 360.334 73.9229C360.27 72.9067 360.204 71.8563 360.03 70.8455C359.358 66.9415 356.879 63.3309 353.399 61.1885L353.385 61.1803C349.636 58.8782 345.272 59.0632 341.115 59.6056C339.768 59.7815 338.218 60.0297 336.855 60.7607C335.399 61.5404 334.404 62.8101 334.191 64.1575C333.826 66.4605 335.5 68.5533 336.969 69.9025L337.12 70.0414L337.062 70.2373C335.827 74.4084 335.745 77.5687 336.816 79.6308C337.211 80.3916 337.771 80.998 338.481 81.4339C338.808 81.6352 339.176 81.8039 339.575 81.9357L339.894 82.0413L339.784 82.3562C339.587 82.9202 339.191 83.4662 338.538 84.0745C338.356 84.2441 338.164 84.4111 337.978 84.5726C337.523 84.9688 337.052 85.3785 336.677 85.8676C335.38 87.5588 335.366 89.9945 336.646 91.535C336.647 91.5359 336.652 91.5413 336.664 91.5485L336.942 91.7398L336.743 92.0124C335.584 93.6061 334.659 95.6095 333.997 97.9667L333.924 98.2248L333.655 98.2059C333.44 98.1905 333.253 98.1679 333.1 98.1373L333.067 98.131L333.037 98.1183C327.374 95.7711 322.707 93.1431 319.789 91.3518C316.182 89.1381 313.885 87.3792 312.939 86.4705L312.921 86.4533L312.905 86.4335C311.797 84.9859 309.83 82.3336 309.253 81.5557L309.141 81.4032L309.216 81.23C309.488 80.6037 310.001 78.7573 308.897 75.1502C308.896 75.1466 308.895 75.1439 308.893 75.1412C308.537 74.3344 308.174 71.9772 307.989 70.6443C307.953 70.3844 307.814 70.1678 307.598 70.0351C307.506 69.9783 307.402 69.9395 307.29 69.9196C306.916 69.8528 306.559 70.0252 306.381 70.3591C306.036 71.0016 305.804 71.9294 305.69 73.1179L305.045 73.1883C304.886 72.7009 304.726 72.2308 304.57 71.7913C303.235 68.029 302.386 67.0688 302 66.8314C301.962 66.808 301.929 66.7917 301.897 66.7764C301.73 66.6934 301.57 66.678 301.419 66.7313L301.409 66.7349L301.397 66.7385C301.224 66.7863 301.092 66.8937 301.003 67.058C300.812 67.4099 300.816 68.0308 301.018 68.9567L300.402 69.1814C299.732 67.927 299.146 67.1744 298.559 66.8143C298.45 66.7475 298.34 66.6943 298.232 66.6564C297.883 66.5345 297.548 66.5589 297.207 66.7322C296.99 66.8423 296.875 67.0778 296.866 67.4316L296.855 67.9026L296.414 67.7303C296.181 67.6391 295.941 67.6292 295.736 67.7059C295.546 67.7727 295.409 67.9072 295.329 68.1039C295.032 68.8358 295.541 70.5224 296.841 73.1188L296.302 73.4897C295.559 72.6928 295.031 72.2091 294.64 71.97C294.299 71.7606 294.125 71.7714 293.898 71.8111C293.893 71.812 293.887 71.8138 293.882 71.8156C293.696 71.8896 293.572 72.0169 293.511 72.1956C293.253 72.9536 294.147 74.5058 295.628 76.9758C299.297 83.0998 305.47 90.7056 306.162 91.553L306.247 91.6568L306.235 91.7904C306.234 91.8003 306.233 91.8093 306.231 91.8256C306.229 91.8481 306.236 91.8707 306.252 91.8869C313.148 99.6065 319.133 104.012 322.941 106.35C323.199 106.508 323.46 106.665 323.717 106.816C327.239 108.886 329.572 109.661 330.411 109.898L330.84 110.019L330.819 110.05C332.197 109.86 333.642 110.001 334.973 110.426C335.616 113.752 336.966 117.062 337.197 120.43L337.261 120.349L338.485 125.259L338.729 125.684C338.7 125.349 340.947 127.171 340.946 127.182C342.073 127.353 341.127 127.641 342.202 127.552C348.519 127.21 353.296 123.43 358.374 120.214Z" fill="white"/>
                                    <path d="M339.416 89.5539C339.416 89.5539 331.819 94.2584 334.213 106.653C334.014 106.792 338.313 125.135 338.313 125.135C338.313 125.135 348.911 133.504 361.262 123.933C361.262 123.933 359.753 113.345 360.838 105.22C360.856 105.153 366.945 92.1809 353.677 88.7598C353.161 89.1586 346.528 94.9812 341.712 94.364C341.434 94.3874 338.878 92.6114 339.416 89.5539Z" fill="white"/>
                                    <path d="M341.665 82.4033C340.724 82.4033 340.102 82.2463 340.048 82.2319C338.492 81.8574 337.358 81.0063 336.681 79.7023C334.834 76.1476 336.836 69.9388 338.193 66.5537C338.241 66.4328 338.38 66.3741 338.501 66.4219C338.622 66.4698 338.681 66.6069 338.633 66.7279C337.305 70.038 335.341 76.097 337.101 79.4857C337.713 80.6625 338.743 81.4323 340.164 81.7743C340.282 81.805 342.996 82.4891 345.825 80.7672C345.936 80.6995 346.082 80.7347 346.15 80.8457C346.218 80.9567 346.184 81.102 346.072 81.1697C344.427 82.1714 342.81 82.4033 341.665 82.4033Z" fill="#131313"/>
                                    <path d="M352.288 77.4559C351.711 77.4559 351.062 77.3025 350.349 76.9975C350.228 76.9461 350.173 76.8071 350.224 76.688C350.276 76.5688 350.416 76.5138 350.535 76.5643C351.721 77.0724 352.679 77.1193 353.385 76.7069C354.375 76.1275 354.581 74.8091 354.621 74.4192C354.661 74.0294 354.61 73.6377 354.475 73.2875C354.283 72.7912 353.994 72.4853 353.59 72.3508C352.625 72.0304 351.346 72.8183 351.333 72.8264C351.223 72.8959 351.077 72.8625 351.007 72.7524C350.937 72.6423 350.971 72.497 351.081 72.4275C351.141 72.3896 352.56 71.5133 353.738 71.9032C354.279 72.0819 354.675 72.4907 354.917 73.1188C355.079 73.5375 355.139 74.0041 355.092 74.467C355.047 74.9129 354.807 76.4217 353.625 77.1139C353.234 77.3422 352.788 77.4559 352.288 77.4559Z" fill="#131313"/>
                                    <path d="M350.785 75.4931C350.766 75.4931 350.747 75.4904 350.728 75.4859C350.601 75.4543 350.524 75.3261 350.556 75.1998C350.587 75.0762 350.599 75.0301 352.098 74.1963C352.798 73.8082 353.501 73.4283 353.509 73.4247C353.624 73.3624 353.767 73.4048 353.83 73.5195C353.892 73.6341 353.849 73.7767 353.734 73.8389C353.727 73.8425 353.026 74.2207 352.33 74.6069C351.269 75.1971 351.027 75.3586 350.972 75.4011C350.928 75.4588 350.859 75.4931 350.785 75.4931Z" fill="#131313"/>
                                    <path d="M352.597 75.5843C352.503 75.5843 352.415 75.5284 352.377 75.4372L351.994 74.4915C351.945 74.3706 352.004 74.2334 352.125 74.1846C352.246 74.1359 352.385 74.1946 352.434 74.3146L352.817 75.2604C352.866 75.3813 352.807 75.5185 352.686 75.5672C352.657 75.5789 352.627 75.5843 352.597 75.5843Z" fill="#131313"/>
                                    <path d="M347.082 71.2679C346.997 71.2679 346.916 71.2228 346.873 71.1424C346.001 69.5045 344.268 70.212 344.194 70.2427C344.074 70.2932 343.935 70.2373 343.884 70.1182C343.833 69.999 343.889 69.8601 344.008 69.8095C344.03 69.8005 346.215 68.8981 347.291 70.9222C347.352 71.0369 347.308 71.1794 347.192 71.2408C347.158 71.2598 347.12 71.2679 347.082 71.2679Z" fill="#131313"/>
                                    <path d="M339.696 75.7532C339.632 75.7532 339.569 75.7279 339.523 75.6783C339.519 75.6738 339.124 75.2532 338.756 74.8345C338.544 74.5935 338.452 74.2732 338.502 73.9564C338.551 73.6442 338.735 73.3725 339.006 73.211C340.122 72.5468 340.934 71.5676 341.179 70.593C341.315 69.9468 341.229 69.4288 340.921 69.0625C340.334 68.3658 339.121 68.3946 339.109 68.3955C338.979 68.4001 338.869 68.2972 338.865 68.1672C338.861 68.0373 338.963 67.9281 339.094 67.9245C339.153 67.9227 340.546 67.8866 341.282 68.7583C341.69 69.2411 341.81 69.8936 341.641 70.6986C341.365 71.8014 340.471 72.8888 339.249 73.6162C339.098 73.7055 338.997 73.8562 338.969 74.0304C338.94 74.2091 338.992 74.3896 339.112 74.525C339.475 74.9383 339.864 75.3534 339.868 75.3579C339.957 75.4527 339.952 75.6025 339.856 75.6909C339.812 75.7324 339.754 75.7532 339.696 75.7532Z" fill="#131313"/>
                                    <path d="M345.456 72.8797C345.332 73.367 345.006 73.7063 344.726 73.6359C344.445 73.5655 344.318 73.1134 344.442 72.6261C344.565 72.1388 344.891 71.7994 345.172 71.8698C345.452 71.9393 345.579 72.3915 345.456 72.8797Z" fill="#131313"/>
                                    <path d="M295.817 117.699C295.817 117.699 293.617 119.947 295.565 120.958C295.517 121.034 294.204 122.8 296.421 123.502C296.421 123.502 295.399 125.108 297.166 125.673C296.971 125.623 296.101 127.613 298.614 127.396C299.601 127.163 302.913 126.319 300.955 124.61C300.946 124.604 301.745 123.373 299.85 122.564C300.217 122.42 301.28 121.153 299.261 120.473C299.346 120.345 300.47 118.54 298.662 118.19C298.484 118.248 296.675 118.859 296.675 118.859L295.817 117.699Z" fill="white"/>
                                    <path d="M298.158 127.677C297.781 127.677 297.435 127.611 297.16 127.45C296.767 127.22 296.357 126.704 296.638 125.549C296.67 125.417 296.805 125.335 296.938 125.367C297.071 125.4 297.154 125.533 297.121 125.666C296.953 126.355 297.05 126.812 297.411 127.023C298.252 127.513 300.332 126.741 300.845 126.267C300.848 126.264 300.851 126.262 300.853 126.261C300.991 126.142 301.341 125.755 301.298 125.397C301.269 125.158 301.067 124.94 300.696 124.752C300.573 124.689 300.525 124.54 300.588 124.419C300.65 124.298 300.801 124.249 300.923 124.311C301.451 124.581 301.743 124.928 301.792 125.341C301.871 126.014 301.244 126.578 301.18 126.634C300.706 127.068 299.298 127.677 298.158 127.677Z" fill="#131313"/>
                                    <path d="M296.142 121.25C295.99 121.25 295.836 121.241 295.687 121.218C294.959 121.109 294.507 120.718 294.378 120.089C294.377 120.085 294.376 120.08 294.375 120.077L294.37 120.04C294.311 119.667 294.133 118.533 295.791 117.431C295.844 117.396 295.907 117.384 295.969 117.396C296.03 117.408 296.085 117.444 296.119 117.496L296.797 118.512C297.253 118.29 298.397 117.806 299.197 118.103C299.542 118.231 299.783 118.48 299.915 118.845C299.916 118.848 299.917 118.851 299.919 118.855L299.922 118.865C300.017 119.146 299.993 119.423 299.854 119.689C299.581 120.209 298.873 120.64 297.752 120.968C297.644 121.018 297.449 121.078 297.076 121.151C296.825 121.201 296.489 121.25 296.142 121.25ZM294.843 120.001C294.902 120.284 295.05 120.484 295.296 120.612C296.03 120.994 297.38 120.612 297.571 120.535C297.586 120.527 297.601 120.521 297.617 120.516C298.855 120.154 299.289 119.747 299.435 119.47C299.551 119.247 299.497 119.083 299.474 119.014L299.47 119.003C299.386 118.773 299.243 118.624 299.033 118.545C298.375 118.301 297.223 118.809 296.834 119.024C296.726 119.085 296.59 119.051 296.521 118.95L295.859 117.959C294.66 118.841 294.788 119.653 294.837 119.967L294.843 120.001Z" fill="#131313"/>
                                    <path d="M296.798 123.618C296.648 123.618 296.495 123.609 296.346 123.586C295.617 123.477 295.163 123.086 295.035 122.456C295.034 122.452 295.033 122.447 295.032 122.443L295.026 122.406C294.989 122.17 294.891 121.545 295.366 120.827C295.437 120.718 295.584 120.688 295.694 120.76C295.803 120.831 295.834 120.977 295.762 121.086C295.388 121.652 295.46 122.112 295.494 122.334L295.5 122.368C295.559 122.651 295.707 122.851 295.952 122.979C296.687 123.361 298.036 122.979 298.227 122.902C298.242 122.894 298.257 122.888 298.274 122.883C299.512 122.521 299.945 122.115 300.091 121.839C300.208 121.617 300.154 121.451 300.13 121.381L300.126 121.369C300.026 121.093 299.856 120.907 299.609 120.8C298.889 120.49 297.79 120.953 297.779 120.958C297.659 121.01 297.519 120.955 297.468 120.835C297.416 120.715 297.471 120.576 297.591 120.525C297.643 120.502 298.888 119.976 299.795 120.367C300.165 120.527 300.427 120.811 300.573 121.212C300.573 121.215 300.575 121.219 300.576 121.223L300.58 121.233C300.673 121.516 300.65 121.794 300.511 122.058C300.237 122.578 299.53 123.008 298.408 123.335C298.3 123.385 298.104 123.445 297.733 123.518C297.482 123.569 297.147 123.618 296.798 123.618Z" fill="#131313"/>
                                    <path d="M297.687 125.955C297.536 125.955 297.381 125.946 297.231 125.924C296.504 125.813 296.052 125.424 295.923 124.795C295.922 124.79 295.922 124.786 295.921 124.781C295.918 124.76 295.912 124.737 295.907 124.712C295.86 124.481 295.772 124.051 296.221 123.372C296.292 123.263 296.44 123.233 296.549 123.305C296.658 123.376 296.689 123.522 296.617 123.631C296.275 124.148 296.333 124.431 296.372 124.618C296.379 124.65 296.385 124.679 296.389 124.706C296.448 124.989 296.595 125.189 296.841 125.316C297.576 125.699 298.925 125.316 299.116 125.24C299.131 125.232 299.146 125.226 299.163 125.221C299.213 125.206 299.263 125.193 299.313 125.178C299.552 125.11 299.757 125.052 299.908 124.963C300.382 124.685 300.928 124.24 300.838 123.69C300.78 123.336 300.47 123.06 300.083 123.019C299.432 122.949 298.717 123.238 298.71 123.241C298.589 123.291 298.451 123.234 298.401 123.113C298.351 122.993 298.408 122.855 298.529 122.806C298.562 122.792 299.359 122.467 300.134 122.55C300.732 122.614 301.215 123.052 301.306 123.614C301.38 124.063 301.238 124.731 300.148 125.369C299.945 125.489 299.701 125.558 299.444 125.631C299.396 125.645 299.347 125.658 299.298 125.673C299.19 125.722 298.994 125.783 298.621 125.856C298.37 125.906 298.034 125.955 297.687 125.955ZM299.077 125.267C299.059 125.283 299.039 125.304 299.023 125.333C299.036 125.308 299.056 125.285 299.077 125.267Z" fill="#131313"/>
                                    <path d="M339.723 71.3709C339.6 71.8582 339.273 72.1975 338.993 72.1271C338.713 72.0567 338.586 71.6046 338.709 71.1173C338.833 70.63 339.159 70.2907 339.439 70.361C339.719 70.4305 339.846 70.8827 339.723 71.3709Z" fill="#131313"/>
                                    <path d="M341.607 78.7753C341.483 78.7753 341.379 78.6788 341.371 78.5533C341.364 78.4234 341.463 78.3115 341.594 78.3043C342.451 78.2546 343.653 78.0525 344.505 77.3766C344.608 77.2953 344.757 77.3125 344.838 77.4136C344.92 77.5155 344.903 77.6635 344.801 77.7448C343.852 78.4983 342.549 78.7212 341.623 78.7744C341.616 78.7754 341.612 78.7753 341.607 78.7753Z" fill="#131313"/>
                                    <path d="M342.641 94.7066C341.958 94.7066 341.366 94.564 340.866 94.2771C338.714 93.0425 339.163 89.6655 339.183 89.5221C339.194 89.4472 339.24 89.3813 339.307 89.3461L340.9 88.5131C342.009 87.9338 342.749 86.8472 342.882 85.6082L343.273 81.9343C343.286 81.8052 343.404 81.7114 343.533 81.7249C343.663 81.7385 343.757 81.8549 343.743 81.9839L343.352 85.6578C343.204 87.0539 342.369 88.2776 341.121 88.9301L339.639 89.7053C339.583 90.2928 339.435 92.9135 341.103 93.87C342.582 94.7165 345.938 94.4855 353.532 88.5736C353.636 88.4933 353.784 88.5113 353.865 88.6142C353.946 88.7171 353.928 88.8651 353.824 88.9454C348.9 92.7772 345.152 94.7066 342.641 94.7066Z" fill="#131313"/>
                                    <path d="M347.961 129.135C346.644 129.135 345.365 128.973 344.135 128.649C340.169 127.605 338.112 125.271 338.026 125.172C338.001 125.142 337.983 125.107 337.975 125.068L334.629 109.881C334.601 109.753 334.681 109.628 334.809 109.6C334.937 109.572 335.063 109.652 335.091 109.78L338.424 124.906C338.721 125.226 340.736 127.273 344.283 128.2C347.8 129.119 353.586 129.091 361.23 123.781C359.695 120.341 360.299 106.258 361.553 101.567C361.843 100.483 362.634 96.6824 360.624 93.3334C359.269 91.0764 356.956 89.5467 353.748 88.786C353.621 88.7562 353.542 88.6289 353.572 88.5017C353.602 88.3754 353.73 88.2968 353.857 88.3266C357.194 89.1172 359.608 90.7208 361.03 93.0906C363.135 96.5975 362.313 100.557 362.011 101.687C360.779 106.291 360.166 120.814 361.74 123.747C361.796 123.851 361.765 123.981 361.667 124.05C358.19 126.491 354.787 128.072 351.553 128.749C350.331 129.007 349.13 129.135 347.961 129.135Z" fill="#131313"/>
                                    <path d="M364.185 109.331C364.178 109.331 364.171 109.331 364.163 109.33C363.452 109.275 362.96 109.266 362.483 109.258C362 109.25 361.499 109.242 360.775 109.186C360.644 109.176 360.547 109.062 360.557 108.933C360.567 108.803 360.68 108.706 360.811 108.717C361.522 108.772 362.014 108.78 362.491 108.788C362.975 108.796 363.475 108.804 364.2 108.86C364.513 108.851 366.916 107.596 369.266 105.024C371.245 102.859 373.54 99.326 373.236 94.7912C372.969 90.8114 369.218 87.5716 367.202 85.8317C366.729 85.4229 366.227 85.0177 365.741 84.6261C363.943 83.174 362.083 81.6724 361.087 79.5606C360.258 77.8054 360.134 75.8435 360.016 73.9474C359.952 72.9394 359.887 71.8962 359.716 70.9017C359.058 67.0852 356.634 63.5567 353.231 61.4612C349.564 59.2033 345.261 59.3883 341.158 59.9234C339.839 60.0958 338.322 60.3385 337.007 61.0434C335.64 61.7761 334.705 62.9602 334.507 64.2091C334.153 66.4472 335.873 68.5084 337.377 69.844C337.475 69.9306 337.483 70.0795 337.396 70.177C337.309 70.2745 337.159 70.2826 337.062 70.196C335.469 68.7827 333.652 66.5844 334.039 64.136C334.259 62.7418 335.285 61.4305 336.782 60.6282C338.169 59.8855 339.736 59.6337 341.096 59.456C345.286 58.9091 349.686 58.725 353.479 61.0596C356.997 63.2246 359.502 66.8741 360.182 70.8214C360.358 71.8411 360.424 72.897 360.488 73.9176C360.61 75.8552 360.725 77.6863 361.516 79.3603C362.466 81.3746 364.283 82.841 366.041 84.2597C366.529 84.654 367.034 85.062 367.513 85.4753C369.581 87.2603 373.43 90.584 373.709 94.7596C374.051 99.8693 371.278 103.743 368.892 106.093C366.819 108.134 364.698 109.331 364.185 109.331Z" fill="#131313"/>
                                    <path d="M353.803 88.7935C353.774 88.7935 353.744 88.7881 353.716 88.7763C353.118 88.5399 352.337 88.215 351.606 87.8026C351.198 87.5734 350.79 87.3035 350.555 86.8884C350.273 86.3921 350.304 85.791 350.328 85.3525C350.45 83.0007 350.705 80.1805 351.028 77.6158C351.061 77.3496 351.358 77.2828 351.849 77.1727C352.734 76.9733 354.215 76.6384 354.413 75.2108C354.569 74.0881 354.472 73.3193 354.117 72.8581C353.737 72.3636 353.083 72.2814 352.451 72.2011C352.065 72.1524 351.701 72.1064 351.398 71.9692C350.032 71.3492 349.553 69.9116 349.09 68.5218C348.765 67.5472 348.43 66.5392 347.794 65.8136C346.823 64.7036 345.156 64.2217 342.702 64.339C341.213 64.4103 339.279 65.2749 338.631 66.7359C338.578 66.855 338.438 66.9092 338.319 66.8559C338.199 66.8036 338.145 66.6646 338.198 66.5455C338.931 64.894 341.008 63.9483 342.68 63.8679C345.29 63.7425 347.079 64.2777 348.151 65.5032C348.85 66.3 349.201 67.3541 349.54 68.3729C349.991 69.7266 350.417 71.0054 351.595 71.5405C351.831 71.6479 352.161 71.6894 352.511 71.7337C353.205 71.8212 353.993 71.9205 354.494 72.5711C354.929 73.137 355.057 74.0214 354.883 75.2749C354.64 77.0256 352.892 77.42 351.954 77.632C351.785 77.6699 351.582 77.716 351.489 77.7521C351.171 80.2852 350.922 83.0593 350.801 85.3768C350.776 85.8705 350.77 86.3082 350.968 86.6574C351.156 86.9886 351.517 87.2106 351.839 87.3929C352.546 87.7918 353.307 88.1076 353.891 88.3387C354.012 88.3865 354.071 88.5237 354.023 88.6446C353.986 88.7375 353.897 88.7935 353.803 88.7935Z" fill="#131313"/>
                                    <path d="M333.99 98.5445C333.97 98.5445 333.95 98.5418 333.93 98.5364C333.804 98.503 333.728 98.3739 333.762 98.2476C335.632 91.26 339.161 89.4181 339.311 89.3432C339.428 89.2845 339.57 89.3314 339.629 89.4469C339.688 89.5634 339.641 89.7041 339.525 89.7637C339.479 89.7872 336.027 91.6173 334.22 98.3685C334.191 98.475 334.095 98.5445 333.99 98.5445Z" fill="#131313"/>
                                    <path d="M313.315 86.9272C313.229 86.8099 309.183 81.601 309.183 81.601C309.183 81.601 310.079 78.687 308.756 75.0222C308.728 74.9418 308.28 70.213 307.328 69.9694C306.962 70.01 305.53 71.3086 305.696 75.5844C305.557 75.1106 303.468 66.6159 301.269 66.7873C301.287 67.4362 300.752 68.0183 301.775 71.2815C301.427 71.4999 299.404 66.217 297.483 66.7133C297.246 66.8081 296.53 67.2656 297.559 69.3169C297.527 69.2537 296.027 66.1268 295.331 68.6888C295.382 69.1454 297.597 75.07 297.597 75.07C297.597 75.07 295.034 71.1615 293.915 71.8934C293.915 71.8934 291.901 72.4962 299.244 82.3166C299.31 82.4105 306.975 92.2219 306.975 92.2219L313.315 86.9272Z" fill="white"/>
                                    <path d="M312.858 86.5121C312.858 86.5121 307.922 85.8732 306.312 91.8338C307.414 93.0476 318.037 105.33 330.687 109.887C335.251 111.486 346.394 110.227 355.87 104.962C356.261 104.569 350.793 93.4104 350.793 93.4104C350.793 93.4104 342.537 98.252 333.042 98.2141C333.042 98.2132 323.681 95.2658 312.858 86.5121Z" fill="white"/>
                                    <path d="M337.11 110.691C333.273 110.691 330.665 110.124 330.635 110.117C330.526 110.093 327.96 109.49 323.637 106.95C319.663 104.613 313.399 100.122 306.136 91.9908C306.093 91.9429 306.072 91.8789 306.077 91.8148C306.191 90.4395 306.959 89.1508 308.297 88.0877C309.867 86.8405 311.94 86.1447 312.891 86.2792C312.941 86.2864 312.987 86.309 313.022 86.3433C315.124 88.3729 323.172 93.8706 333.112 97.9875C335.651 98.5118 346.063 96.8847 350.645 93.2262C350.747 93.145 350.896 93.1612 350.978 93.2623C351.059 93.3643 351.043 93.5123 350.942 93.5935C348.125 95.8424 343.576 97.1049 341.116 97.6572C337.776 98.4071 334.36 98.7374 332.991 98.4432C332.978 98.4405 332.963 98.436 332.95 98.4306C322.461 94.0889 314.758 88.6364 312.752 86.7376C311.963 86.6799 310.072 87.28 308.592 88.455C307.751 89.1237 306.724 90.2346 306.559 91.7534C313.74 99.7762 319.923 104.214 323.851 106.526C328.118 109.039 330.714 109.651 330.74 109.657C330.772 109.664 334.196 110.408 338.972 110.174C343.37 109.958 349.849 108.846 355.734 104.768C355.841 104.694 355.989 104.72 356.063 104.826C356.138 104.933 356.111 105.08 356.004 105.155C350.021 109.301 343.444 110.43 338.979 110.646C338.331 110.678 337.706 110.691 337.11 110.691Z" fill="#131313"/>
                                    <path d="M309.034 81.64C308.989 81.64 308.943 81.6273 308.903 81.6003C308.795 81.5281 308.766 81.3828 308.838 81.2745C308.852 81.2519 309.905 79.5553 308.594 75.2588C308.242 74.4484 307.898 72.3294 307.672 70.6897C307.633 70.4045 307.419 70.2682 307.233 70.2349C307.046 70.2015 306.797 70.2565 306.661 70.511C306.128 71.5046 305.882 73.2102 305.93 75.5791C305.933 75.7091 305.829 75.8165 305.698 75.8192C305.57 75.8192 305.46 75.7181 305.457 75.5882C305.407 73.1371 305.672 71.3539 306.243 70.2881C306.455 69.8946 306.875 69.6916 307.316 69.7701C307.756 69.8486 308.08 70.1834 308.141 70.6247C308.459 72.9133 308.775 74.4962 309.034 75.081C309.037 75.0891 309.041 75.0981 309.044 75.1072C310.439 79.6681 309.282 81.4604 309.232 81.5344C309.186 81.6039 309.111 81.64 309.034 81.64Z" fill="#131313"/>
                                    <path d="M312.859 86.7475C312.787 86.7475 312.717 86.7159 312.67 86.6546C311.387 84.9796 308.871 81.5774 308.845 81.5431C308.767 81.4384 308.79 81.2904 308.895 81.2137C309 81.137 309.149 81.1587 309.226 81.2643C309.252 81.2986 311.766 84.6972 313.047 86.3694C313.125 86.4732 313.105 86.6212 313.002 86.6997C312.959 86.7322 312.909 86.7475 312.859 86.7475Z" fill="#131313"/>
                                    <path d="M306.29 91.8148C306.221 91.8148 306.153 91.785 306.106 91.7282C306.039 91.647 299.373 83.525 295.495 77.0544C293.992 74.5474 293.085 72.9691 293.365 72.1469C293.439 71.9276 293.599 71.7643 293.825 71.6741C293.839 71.6677 293.854 71.6641 293.871 71.6605C294.185 71.6046 294.477 71.6046 295.129 72.137C295.826 72.7083 296.895 73.8598 298.494 75.7603C298.577 75.8605 298.564 76.0085 298.464 76.0924C298.363 76.1754 298.214 76.1628 298.13 76.0626C294.798 72.0991 294.298 72.0666 293.981 72.119C293.894 72.1578 293.843 72.2137 293.814 72.2967C293.59 72.9546 294.765 74.9156 295.901 76.8117C299.761 83.2515 306.406 91.3465 306.472 91.4277C306.554 91.5288 306.54 91.6768 306.438 91.7589C306.395 91.7977 306.342 91.8148 306.29 91.8148Z" fill="#131313"/>
                                    <path d="M298.311 76.1486C298.224 76.1486 298.14 76.0998 298.098 76.0168L296.772 73.3293C295.38 70.5741 294.861 68.846 295.185 68.0473C295.281 67.81 295.455 67.6421 295.687 67.5609C296.187 67.3732 296.953 67.6033 297.437 68.5572C298.623 70.8927 300.581 74.8526 300.601 74.8923C300.659 75.0088 300.61 75.1504 300.493 75.2082C300.376 75.266 300.233 75.2172 300.175 75.1008C300.155 75.0611 298.199 71.1039 297.014 68.7702C296.677 68.1069 296.173 67.8821 295.848 68.004C295.739 68.0419 295.669 68.1114 295.624 68.2233C295.441 68.6745 295.565 69.891 297.197 73.119L298.523 75.8083C298.581 75.9247 298.532 76.0664 298.415 76.1233C298.382 76.1413 298.346 76.1486 298.311 76.1486Z" fill="#131313"/>
                                    <path d="M302.776 74.5286C302.694 74.5286 302.615 74.4871 302.571 74.4122C302.183 73.7543 301.777 72.8564 301.347 71.9061C300.433 69.8846 299.295 67.3686 298.125 66.9598C297.862 66.8677 297.609 66.8876 297.351 67.0184C297.129 67.1312 297.09 67.7025 297.445 68.577C297.494 68.6979 297.435 68.8351 297.315 68.8838C297.194 68.9325 297.055 68.8748 297.006 68.7538C296.566 67.6691 296.614 66.8632 297.136 66.5988C297.511 66.4084 297.896 66.3804 298.281 66.5149C299.643 66.9914 300.778 69.4993 301.779 71.713C302.203 72.6515 302.604 73.5386 302.979 74.1748C303.045 74.2867 303.007 74.4311 302.894 74.497C302.858 74.5178 302.816 74.5286 302.776 74.5286Z" fill="#131313"/>
                                    <path d="M305.856 76.394C305.752 76.394 305.657 76.3245 305.628 76.2198C304.993 73.8942 303.061 67.7161 301.753 67.0627C301.633 67.0032 301.563 67.0185 301.52 67.0356C301.511 67.0393 301.501 67.042 301.491 67.0447C301.398 67.0681 301.333 67.1196 301.283 67.2116C300.875 67.9597 301.745 70.4866 302.38 72.3312C302.62 73.0288 302.847 73.6885 303.003 74.2281C303.039 74.3536 302.966 74.4835 302.84 74.5196C302.714 74.5557 302.584 74.4835 302.547 74.3581C302.395 73.8302 302.17 73.1759 301.932 72.4837C301.011 69.8098 300.397 67.8506 300.867 66.9869C300.977 66.7857 301.147 66.6494 301.361 66.5916C301.497 66.542 301.71 66.5131 301.966 66.6413C303.699 67.5067 305.846 75.2199 306.085 76.0962C306.119 76.2216 306.045 76.3516 305.919 76.385C305.898 76.3913 305.877 76.394 305.856 76.394Z" fill="#131313"/>
                                    <path d="M336.71 91.72C336.642 91.72 336.574 91.6912 336.528 91.6343C335.204 90.0406 335.216 87.5228 336.555 85.7765C336.94 85.2757 337.417 84.8605 337.878 84.459C338.062 84.2983 338.254 84.1323 338.433 83.9644C339.194 83.256 339.607 82.6216 339.731 81.9673C339.755 81.8392 339.879 81.7552 340.008 81.7796C340.136 81.804 340.221 81.9267 340.196 82.0548C340.007 83.0502 339.284 83.8173 338.756 84.3082C338.57 84.4815 338.376 84.6503 338.189 84.8127C337.725 85.217 337.287 85.5978 336.931 86.0617C335.721 87.6383 335.705 89.9043 336.892 91.3329C336.975 91.4331 336.961 91.582 336.86 91.665C336.817 91.702 336.763 91.72 336.71 91.72Z" fill="#131313"/>
                                    <path d="M47.7621 63.7298C47.7439 63.7298 47.7258 63.728 47.7077 63.7235C47.5807 63.6937 47.5018 63.5665 47.5317 63.4401C47.8781 61.9827 48.2898 60.5144 48.7568 59.0777C48.7967 58.9541 48.9309 58.8855 49.0552 58.9261C49.1794 58.9658 49.2474 59.0994 49.2075 59.223C48.7441 60.648 48.3361 62.1027 47.9924 63.5484C47.967 63.6567 47.8691 63.7298 47.7621 63.7298ZM50.546 55.1521C50.5161 55.1521 50.4852 55.1466 50.4553 55.134C50.3347 55.0844 50.2767 54.9463 50.3265 54.8263C50.8987 53.4455 51.5362 52.0603 52.2209 50.7093C52.2798 50.5929 52.4222 50.5469 52.5391 50.6046C52.6561 50.6633 52.7024 50.805 52.6443 50.9214C51.9651 52.2615 51.3331 53.636 50.7645 55.0059C50.7273 55.097 50.6385 55.1521 50.546 55.1521ZM271.983 51.822C271.919 51.822 271.855 51.7968 271.809 51.7462C271.72 51.6506 271.726 51.5017 271.823 51.4132C272.669 50.6398 273.562 49.8502 274.554 49.001C274.773 48.8133 274.985 48.6138 275.184 48.4081C275.275 48.3142 275.424 48.3115 275.519 48.4018C275.613 48.492 275.616 48.6409 275.525 48.7348C275.316 48.9514 275.093 49.1607 274.863 49.3584C273.875 50.204 272.986 50.99 272.144 51.7607C272.098 51.8013 272.04 51.822 271.983 51.822ZM54.6212 47.1013C54.5795 47.1013 54.5378 47.0905 54.4997 47.068C54.3872 47.0012 54.351 46.8559 54.4181 46.7449C55.1889 45.4652 56.0222 44.1873 56.8928 42.9465C56.968 42.84 57.1158 42.8138 57.2228 42.8887C57.3298 42.9636 57.3561 43.1098 57.2809 43.2172C56.4158 44.4491 55.5897 45.717 54.8243 46.9876C54.7799 47.0607 54.7019 47.1013 54.6212 47.1013ZM277.638 44.9535C277.613 44.9535 277.588 44.9499 277.564 44.9418C277.439 44.9003 277.372 44.7676 277.414 44.644C277.838 43.3742 278.087 41.9033 278.152 40.2734C278.158 40.1435 278.266 40.0415 278.398 40.0478C278.528 40.0532 278.63 40.1624 278.625 40.2924C278.557 41.9664 278.3 43.4807 277.862 44.7929C277.829 44.8913 277.737 44.9535 277.638 44.9535ZM59.8082 39.7094C59.7565 39.7094 59.7039 39.6923 59.6603 39.6571C59.5588 39.5759 59.5425 39.4269 59.6241 39.3259C60.5635 38.1626 61.561 37.0075 62.5875 35.8921C62.6755 35.7964 62.826 35.7901 62.9221 35.8776C63.0183 35.9652 63.0255 36.115 62.9367 36.2106C61.9174 37.3179 60.9272 38.4658 59.9931 39.621C59.946 39.6796 59.8771 39.7094 59.8082 39.7094ZM278.192 36.0139C278.073 36.0139 277.971 35.9246 277.957 35.8045C277.894 35.236 277.817 34.6458 277.721 34.0005C277.603 33.1956 277.456 32.3328 277.273 31.3627C277.249 31.2345 277.334 31.1118 277.462 31.0874C277.591 31.064 277.714 31.1479 277.739 31.2752C277.923 32.2516 278.071 33.1198 278.189 33.932C278.285 34.5826 278.363 35.1782 278.427 35.7522C278.441 35.8812 278.347 35.9977 278.217 36.0121C278.209 36.013 278.201 36.0139 278.192 36.0139ZM65.9264 33.0575C65.8648 33.0575 65.8022 33.0331 65.7559 32.9853C65.6653 32.8914 65.668 32.7425 65.7623 32.6523C66.8441 31.6145 67.9776 30.592 69.1302 29.6119C69.2299 29.5271 69.3786 29.5389 69.4639 29.6381C69.5491 29.7374 69.5373 29.8863 69.4376 29.9702C68.2914 30.944 67.1651 31.961 66.0905 32.9916C66.0443 33.0358 65.9854 33.0575 65.9264 33.0575ZM268.082 30.4223C267.609 30.4223 267.135 30.4205 266.662 30.4178C266.531 30.4169 266.426 30.3104 266.426 30.1805C266.427 30.0505 266.535 29.9477 266.665 29.9459C267.137 29.9486 267.61 29.9504 268.082 29.9504C269.117 29.9504 270.164 29.9431 271.194 29.9296C271.195 29.9296 271.196 29.9296 271.198 29.9296C271.327 29.9296 271.433 30.0334 271.434 30.1624C271.436 30.2924 271.332 30.3998 271.201 30.4016C270.169 30.4151 269.119 30.4223 268.082 30.4223ZM262.131 30.3492C262.129 30.3492 262.127 30.3492 262.124 30.3492C260.624 30.3122 259.098 30.2617 257.588 30.1967C257.458 30.1913 257.356 30.0812 257.362 29.9513C257.367 29.8213 257.479 29.722 257.608 29.7257C259.115 29.7897 260.639 29.8412 262.135 29.8773C262.266 29.8809 262.369 29.9883 262.366 30.1182C262.364 30.2473 262.258 30.3492 262.131 30.3492ZM275.73 30.2987C275.603 30.2987 275.498 30.1985 275.493 30.0704C275.489 29.9404 275.591 29.8312 275.722 29.8276C277.228 29.7789 278.751 29.7139 280.247 29.6354C280.375 29.6282 280.489 29.7284 280.495 29.8583C280.503 29.9883 280.402 30.0993 280.271 30.1056C278.772 30.1841 277.246 30.2491 275.736 30.2978C275.735 30.2987 275.733 30.2987 275.73 30.2987ZM253.071 29.9639C253.066 29.9639 253.061 29.9639 253.056 29.9639C251.558 29.8737 250.035 29.7681 248.528 29.6508C248.398 29.6408 248.301 29.5271 248.311 29.3972C248.321 29.2672 248.435 29.1707 248.566 29.1806C250.069 29.297 251.59 29.4026 253.085 29.4928C253.216 29.5009 253.315 29.6129 253.307 29.7419C253.299 29.8673 253.195 29.9639 253.071 29.9639ZM284.785 29.8231C284.662 29.8231 284.559 29.7284 284.55 29.6047C284.541 29.4748 284.639 29.362 284.768 29.3529C286.273 29.2438 287.791 29.1174 289.281 28.9775C289.411 28.9658 289.527 29.0606 289.539 29.1905C289.551 29.3205 289.456 29.4351 289.325 29.4468C287.831 29.5867 286.31 29.713 284.802 29.8222C284.797 29.8231 284.791 29.8231 284.785 29.8231ZM244.031 29.2609C244.023 29.2609 244.015 29.2609 244.008 29.26C242.515 29.1183 240.997 28.9622 239.494 28.7943C239.364 28.7799 239.27 28.6635 239.285 28.5335C239.3 28.4045 239.418 28.3115 239.547 28.326C241.047 28.4929 242.563 28.6499 244.053 28.7907C244.184 28.8034 244.279 28.918 244.266 29.0479C244.255 29.1698 244.151 29.2609 244.031 29.2609ZM293.813 28.9775C293.694 28.9775 293.592 28.8891 293.578 28.7691C293.562 28.64 293.656 28.5227 293.786 28.5074C295.536 28.3025 296.957 28.0958 298.256 27.8576C298.385 27.8341 298.508 27.919 298.532 28.0462C298.555 28.1744 298.47 28.2971 298.342 28.3205C297.032 28.5606 295.602 28.7691 293.841 28.9748C293.831 28.9775 293.822 28.9775 293.813 28.9775ZM235.019 28.2574C235.009 28.2574 234.999 28.2565 234.988 28.2556C233.5 28.0652 231.987 27.8603 230.492 27.6446C230.362 27.6257 230.272 27.5065 230.292 27.3775C230.311 27.2484 230.429 27.1591 230.56 27.1781C232.053 27.3928 233.563 27.5977 235.049 27.7872C235.178 27.8034 235.27 27.9217 235.254 28.0507C235.238 28.1707 235.137 28.2574 235.019 28.2574ZM302.701 27.2566C302.601 27.2566 302.507 27.1925 302.476 27.0923C302.436 26.9687 302.505 26.836 302.63 26.7963C304.156 26.3153 305.509 25.7522 306.764 25.0745C306.879 25.0131 307.022 25.0546 307.085 25.1692C307.147 25.2838 307.105 25.4264 306.99 25.4887C305.707 26.1799 304.328 26.7548 302.773 27.2457C302.749 27.253 302.725 27.2566 302.701 27.2566ZM72.8164 27.1988C72.7447 27.1988 72.674 27.1663 72.6278 27.105C72.5489 27.0012 72.5697 26.8532 72.674 26.7747C73.8737 25.8704 75.1197 24.9869 76.3774 24.1485C76.4862 24.0763 76.6331 24.1052 76.7057 24.2135C76.7782 24.3218 76.7492 24.468 76.6404 24.5402C75.3908 25.3741 74.1521 26.2521 72.9596 27.151C72.917 27.1835 72.8662 27.1988 72.8164 27.1988ZM276.612 27.1311C276.502 27.1311 276.404 27.0544 276.38 26.9425C276.093 25.5383 275.794 24.0276 275.557 22.4944C275.537 22.3653 275.626 22.2453 275.755 22.2254C275.883 22.2047 276.005 22.294 276.025 22.4222C276.261 23.9455 276.558 25.4499 276.845 26.8478C276.871 26.975 276.788 27.0995 276.66 27.1257C276.644 27.1293 276.628 27.1311 276.612 27.1311ZM226.044 26.9678C226.031 26.9678 226.019 26.9669 226.006 26.9651C224.524 26.7286 223.018 26.4769 221.531 26.2169C221.402 26.1944 221.316 26.0726 221.339 25.9444C221.361 25.8163 221.484 25.7305 221.612 25.7531C223.097 26.013 224.6 26.2639 226.08 26.5003C226.209 26.5211 226.297 26.642 226.277 26.7701C226.259 26.8857 226.158 26.9678 226.044 26.9678ZM217.113 25.4066C217.098 25.4066 217.083 25.4047 217.068 25.402C215.597 25.1223 214.099 24.8272 212.618 24.5231C212.49 24.4969 212.407 24.3723 212.434 24.2451C212.46 24.1179 212.585 24.0357 212.713 24.0619C214.192 24.3651 215.687 24.6602 217.157 24.9391C217.286 24.9635 217.37 25.0871 217.346 25.2143C217.324 25.328 217.224 25.4066 217.113 25.4066ZM208.232 23.5881C208.214 23.5881 208.197 23.5863 208.181 23.5827C206.756 23.2705 205.309 22.9438 203.756 22.5837C203.629 22.5539 203.55 22.4276 203.58 22.3012C203.609 22.1749 203.736 22.0955 203.863 22.1253C205.414 22.4844 206.86 22.8102 208.282 23.1225C208.41 23.1504 208.491 23.2759 208.463 23.4031C208.438 23.5132 208.34 23.5881 208.232 23.5881ZM310.542 22.8851C310.479 22.8851 310.417 22.8608 310.371 22.8129C310.28 22.7191 310.283 22.5702 310.378 22.4799C311.476 21.4304 312.395 20.2545 313.112 18.9866C313.176 18.8728 313.32 18.8331 313.433 18.8963C313.548 18.9604 313.588 19.1039 313.524 19.2176C312.785 20.5261 311.837 21.7381 310.706 22.8201C310.66 22.8635 310.601 22.8851 310.542 22.8851ZM80.3456 22.1758C80.2649 22.1758 80.186 22.1343 80.1416 22.0603C80.0754 21.9484 80.1126 21.804 80.225 21.7372C81.5245 20.9728 82.8638 20.2364 84.2041 19.547C84.3202 19.4874 84.4635 19.5325 84.5233 19.648C84.5832 19.7636 84.5378 19.9061 84.4217 19.9657C83.0887 20.6516 81.7575 21.3834 80.4653 22.1433C80.4282 22.1659 80.3864 22.1758 80.3456 22.1758ZM199.398 21.5477C199.38 21.5477 199.361 21.5459 199.342 21.5414C197.995 21.2174 196.554 20.8654 194.937 20.4675C194.81 20.4359 194.733 20.3086 194.764 20.1823C194.795 20.056 194.923 19.9792 195.05 20.0099C196.666 20.4079 198.106 20.7599 199.453 21.0838C199.58 21.1145 199.658 21.2418 199.627 21.3681C199.602 21.4755 199.505 21.5477 199.398 21.5477ZM190.595 19.3827C190.576 19.3827 190.557 19.38 190.537 19.3755L189.193 19.0407C188.175 18.7871 187.157 18.5335 186.139 18.2799C186.012 18.2484 185.935 18.1202 185.967 17.9939C185.998 17.8675 186.126 17.7908 186.254 17.8224C187.272 18.0751 188.291 18.3296 189.309 18.5832L190.653 18.918C190.78 18.9496 190.857 19.0777 190.825 19.204C190.797 19.3105 190.701 19.3827 190.595 19.3827ZM275.365 18.205C275.237 18.205 275.132 18.1031 275.128 17.9749C275.122 17.7276 275.119 17.4777 275.119 17.2322C275.119 15.92 275.207 14.6431 275.381 13.4347C275.399 13.3057 275.52 13.2163 275.649 13.2353C275.779 13.2533 275.869 13.3733 275.85 13.5015C275.679 14.6873 275.593 15.9426 275.593 17.2322C275.593 17.4741 275.596 17.7195 275.602 17.9632C275.606 18.0931 275.502 18.2014 275.371 18.205C275.368 18.205 275.366 18.205 275.365 18.205ZM88.399 18.0354C88.3083 18.0354 88.2222 17.983 88.1823 17.8955C88.1288 17.7764 88.1823 17.6374 88.302 17.5842C88.9885 17.2791 89.6885 16.9795 90.3813 16.6952C91.0805 16.4083 91.7941 16.1258 92.5033 15.8551C92.6257 15.8081 92.7626 15.8695 92.8089 15.9904C92.856 16.1123 92.7943 16.2485 92.6728 16.2946C91.9673 16.5635 91.2573 16.8441 90.5618 17.1302C89.8726 17.4136 89.1771 17.7105 88.4952 18.0137C88.4643 18.0291 88.4308 18.0354 88.399 18.0354ZM181.795 17.2015C181.776 17.2015 181.757 17.1997 181.738 17.1943C180.145 16.8044 178.704 16.457 177.334 16.1321C177.207 16.1023 177.128 15.9751 177.159 15.8478C177.189 15.7215 177.316 15.643 177.444 15.6737C178.816 15.9995 180.258 16.3469 181.852 16.7368C181.979 16.7674 182.057 16.8956 182.026 17.0219C181.999 17.1293 181.902 17.2015 181.795 17.2015ZM172.975 15.1115C172.957 15.1115 172.939 15.1096 172.922 15.1051C171.399 14.7595 169.91 14.431 168.499 14.1296C168.371 14.1025 168.289 13.9771 168.316 13.8498C168.344 13.7226 168.47 13.6414 168.597 13.6684C170.011 13.9699 171.501 14.2993 173.027 14.6449C173.155 14.6738 173.235 14.8001 173.205 14.9274C173.18 15.0375 173.083 15.1115 172.975 15.1115ZM314.817 15.1042C314.805 15.1042 314.794 15.1033 314.782 15.1015C314.652 15.0826 314.563 14.9625 314.583 14.8335C314.66 14.3254 314.699 13.8137 314.699 13.3138C314.699 12.5638 314.612 11.8202 314.44 11.1028C314.389 10.8925 314.332 10.6813 314.269 10.4765C314.231 10.352 314.3 10.2202 314.426 10.1823C314.551 10.1444 314.683 10.2139 314.721 10.3384C314.787 10.5532 314.847 10.7734 314.901 10.9936C315.081 11.7462 315.173 12.5278 315.173 13.3138C315.173 13.8372 315.132 14.3723 315.052 14.903C315.033 15.0203 314.932 15.1042 314.817 15.1042ZM96.8614 14.8037C96.7616 14.8037 96.6692 14.7405 96.6365 14.6413C96.5957 14.5176 96.6637 14.385 96.7879 14.3444C98.2116 13.8814 99.6761 13.4437 101.141 13.0439C101.267 13.0097 101.397 13.0837 101.432 13.2091C101.466 13.3345 101.392 13.4645 101.266 13.4988C99.8085 13.8968 98.3513 14.3317 96.9348 14.7929C96.9104 14.8001 96.8859 14.8037 96.8614 14.8037ZM164.107 13.2235C164.092 13.2235 164.076 13.2217 164.061 13.219C162.546 12.9212 161.049 12.6406 159.609 12.3861C159.48 12.3635 159.394 12.2408 159.418 12.1126C159.44 11.9845 159.564 11.8996 159.693 11.9222C161.135 12.1776 162.636 12.4583 164.153 12.757C164.281 12.7822 164.364 12.9059 164.34 13.034C164.317 13.1459 164.218 13.2235 164.107 13.2235ZM105.602 12.4149C105.494 12.4149 105.396 12.3409 105.371 12.2308C105.342 12.1036 105.423 11.9782 105.55 11.9493C107.009 11.6217 108.507 11.3203 110.003 11.0532C110.132 11.0297 110.255 11.1154 110.278 11.2436C110.3 11.3717 110.215 11.4944 110.086 11.517C108.597 11.7832 107.106 12.0837 105.653 12.4095C105.637 12.4131 105.619 12.4149 105.602 12.4149ZM155.179 11.6479C155.168 11.6479 155.155 11.647 155.143 11.6452C153.647 11.4141 152.138 11.2012 150.66 11.0116C150.53 10.9954 150.439 10.8772 150.455 10.7481C150.471 10.6191 150.591 10.5279 150.72 10.5442C152.201 10.7337 153.714 10.9476 155.215 11.1795C155.344 11.1993 155.432 11.3203 155.412 11.4484C155.395 11.5648 155.295 11.6479 155.179 11.6479ZM114.523 10.8158C114.407 10.8158 114.306 10.7301 114.289 10.6119C114.271 10.4828 114.362 10.3637 114.492 10.3465C115.972 10.1444 117.49 9.96841 119.004 9.82312C119.135 9.81049 119.25 9.90524 119.262 10.0352C119.275 10.1651 119.18 10.2798 119.049 10.2924C117.542 10.4377 116.03 10.6128 114.556 10.814C114.545 10.8149 114.534 10.8158 114.523 10.8158ZM146.187 10.4981C146.178 10.4981 146.17 10.4981 146.162 10.4972C144.654 10.3456 143.137 10.2139 141.652 10.1074C141.521 10.0984 141.423 9.98556 141.432 9.85561C141.441 9.72566 141.555 9.62729 141.685 9.63722C143.175 9.74461 144.697 9.87636 146.209 10.028C146.339 10.0415 146.434 10.157 146.42 10.2861C146.409 10.407 146.306 10.4981 146.187 10.4981ZM123.546 9.94405C123.422 9.94405 123.318 9.84749 123.31 9.72205C123.303 9.59209 123.402 9.48019 123.533 9.47297C125.024 9.38543 126.55 9.32317 128.071 9.28797C128.204 9.28526 128.311 9.38814 128.313 9.51809C128.316 9.64805 128.213 9.75634 128.082 9.75905C126.568 9.79424 125.046 9.85651 123.561 9.94315C123.556 9.94405 123.551 9.94405 123.546 9.94405ZM137.143 9.84929C137.139 9.84929 137.137 9.84929 137.133 9.84929C135.618 9.78612 134.096 9.74551 132.608 9.73107C132.477 9.73017 132.372 9.62278 132.374 9.49283C132.375 9.36287 132.48 9.25999 132.613 9.25999C134.106 9.27534 135.633 9.31504 137.153 9.37912C137.283 9.38453 137.385 9.49463 137.38 9.62458C137.374 9.75002 137.269 9.84929 137.143 9.84929ZM276.728 9.34031C276.699 9.34031 276.67 9.3349 276.642 9.32407C276.52 9.27714 276.459 9.14087 276.506 9.01904C277.087 7.51918 277.849 6.18446 278.773 5.05009C278.856 4.94901 279.005 4.93367 279.106 5.01579C279.208 5.09792 279.223 5.24592 279.141 5.34699C278.247 6.44256 277.51 7.73486 276.947 9.1887C276.913 9.28346 276.823 9.34031 276.728 9.34031ZM312.272 6.75932C312.207 6.75932 312.142 6.73315 312.095 6.6808C311.174 5.65653 310 4.73784 308.608 3.95091C308.495 3.88683 308.455 3.74244 308.519 3.62964C308.584 3.51683 308.729 3.47712 308.842 3.5412C310.279 4.3534 311.492 5.30367 312.448 6.36585C312.535 6.46241 312.527 6.61222 312.43 6.69885C312.384 6.73946 312.328 6.75932 312.272 6.75932ZM282.393 2.53316C282.311 2.53316 282.231 2.49075 282.187 2.41404C282.123 2.30124 282.162 2.15685 282.276 2.09277C283.547 1.37262 284.954 0.853714 286.578 0.507174C286.706 0.480101 286.832 0.561321 286.859 0.688566C286.887 0.815811 286.806 0.941251 286.678 0.968324C285.102 1.30494 283.739 1.8067 282.511 2.50248C282.473 2.52324 282.432 2.53316 282.393 2.53316ZM304.568 2.20197C304.544 2.20197 304.52 2.19836 304.495 2.19024C303.15 1.75977 301.679 1.40511 300.121 1.13437C299.993 1.11181 299.907 0.989983 299.929 0.861836C299.952 0.733688 300.075 0.647956 300.203 0.670517C301.782 0.944861 303.274 1.30494 304.64 1.74172C304.764 1.78143 304.833 1.91409 304.793 2.03862C304.761 2.13789 304.667 2.20197 304.568 2.20197ZM295.659 0.607346C295.654 0.607346 295.648 0.607346 295.643 0.606443C294.255 0.513492 293.109 0.471077 292.035 0.471077C291.729 0.471077 291.425 0.474686 291.133 0.481906C291.002 0.483711 290.894 0.382637 290.89 0.252685C290.887 0.122733 290.99 0.0144391 291.12 0.0108293C291.417 0.00360978 291.724 0 292.034 0C293.119 0 294.275 0.0433174 295.674 0.137172C295.804 0.146196 295.903 0.258099 295.894 0.388052C295.887 0.512589 295.783 0.607346 295.659 0.607346Z" fill="#131313"/>
                                    <path d="M263.921 61.8112C263.83 61.8112 263.742 61.7579 263.704 61.6686C263.652 61.5486 263.708 61.4105 263.828 61.3591L267.996 59.5812C268.115 59.5298 268.255 59.5858 268.307 59.7049C268.358 59.8249 268.302 59.963 268.182 60.0144L264.015 61.7922C263.984 61.8058 263.952 61.8112 263.921 61.8112ZM263.79 58.8963C263.771 58.8963 263.751 58.8936 263.731 58.8891C263.604 58.8566 263.528 58.7284 263.56 58.6021L264.681 54.2297C264.714 54.1034 264.843 54.0276 264.969 54.0601C265.096 54.0926 265.173 54.2207 265.14 54.3471L264.019 58.7194C263.992 58.825 263.896 58.8963 263.79 58.8963ZM272.256 58.2564C272.164 58.2564 272.076 58.2032 272.038 58.1139C271.986 57.9938 272.043 57.8558 272.162 57.8043L276.33 56.0265C276.45 55.9751 276.589 56.031 276.641 56.1501C276.693 56.2702 276.637 56.4082 276.517 56.4597L272.349 58.2375C272.319 58.2501 272.287 58.2564 272.256 58.2564ZM266.032 50.1516C266.013 50.1516 265.993 50.1489 265.973 50.1444C265.846 50.1119 265.77 49.9837 265.803 49.8574L266.924 45.485C266.956 45.3587 267.085 45.2829 267.212 45.3154C267.339 45.3479 267.415 45.476 267.383 45.6024L266.262 49.9747C266.234 50.0812 266.137 50.1516 266.032 50.1516Z" fill="#131313"/>
                                    <path d="M40.885 211.22C40.8224 211.22 40.7607 211.196 40.7145 211.148C40.1876 210.602 39.668 210.043 39.1693 209.485C39.0822 209.387 39.0913 209.239 39.1883 209.152C39.2863 209.065 39.4359 209.074 39.5229 209.171C40.0181 209.724 40.5331 210.279 41.0564 210.821C41.147 210.914 41.1443 211.063 41.05 211.154C41.0038 211.199 40.9439 211.22 40.885 211.22Z" fill="#131313"/>
                                    <path d="M231.224 270C231.223 270 231.221 270 231.22 270C229.737 269.978 228.338 269.322 227.059 268.054C226.967 267.962 226.967 267.813 227.059 267.721C227.151 267.629 227.301 267.628 227.393 267.721C228.582 268.9 229.871 269.509 231.226 269.53C231.357 269.532 231.461 269.639 231.459 269.769C231.458 269.897 231.352 270 231.224 270ZM235.34 268.356C235.272 268.356 235.205 268.327 235.158 268.271C235.075 268.171 235.087 268.023 235.188 267.939C236.224 267.079 237.184 265.892 237.966 264.509C238.03 264.395 238.174 264.355 238.289 264.418C238.403 264.483 238.443 264.626 238.379 264.74C237.569 266.173 236.571 267.405 235.492 268.301C235.447 268.338 235.394 268.356 235.34 268.356ZM224.801 264.353C224.704 264.353 224.612 264.292 224.578 264.196C224.14 262.975 223.917 261.641 223.917 260.233C223.917 260.079 223.92 259.919 223.926 259.76L223.929 259.665C223.935 259.535 224.047 259.432 224.176 259.44C224.306 259.445 224.408 259.555 224.402 259.685L224.399 259.775C224.393 259.93 224.391 260.083 224.391 260.232C224.391 261.586 224.604 262.866 225.024 264.038C225.067 264.16 225.004 264.295 224.88 264.339C224.854 264.348 224.827 264.353 224.801 264.353ZM239.821 260.668C239.803 260.668 239.784 260.666 239.766 260.662C239.639 260.631 239.56 260.504 239.591 260.377C239.871 259.217 240.012 258.06 240.012 256.939C240.012 256.612 240 256.286 239.976 255.971C239.966 255.841 240.064 255.728 240.195 255.718C240.327 255.708 240.439 255.806 240.449 255.935C240.474 256.263 240.487 256.601 240.487 256.94C240.487 258.099 240.341 259.293 240.051 260.488C240.024 260.595 239.928 260.668 239.821 260.668ZM225.072 255.508C225.045 255.508 225.016 255.503 224.99 255.493C224.868 255.448 224.805 255.313 224.85 255.191C225.366 253.797 226.091 252.441 227.001 251.162C227.077 251.056 227.225 251.032 227.331 251.106C227.439 251.181 227.463 251.328 227.388 251.435C226.501 252.68 225.796 253.999 225.294 255.354C225.259 255.449 225.168 255.508 225.072 255.508ZM238.979 251.88C238.896 251.88 238.814 251.836 238.772 251.757C238.312 250.921 237.723 250.171 237.023 249.525C236.647 249.18 236.238 248.846 235.806 248.534C235.7 248.457 235.676 248.31 235.753 248.204C235.83 248.099 235.978 248.075 236.084 248.152C236.531 248.475 236.956 248.821 237.345 249.179C238.083 249.859 238.703 250.65 239.187 251.53C239.25 251.643 239.208 251.787 239.093 251.849C239.057 251.871 239.018 251.88 238.979 251.88ZM310.809 249.648C310.388 249.648 309.958 249.643 309.531 249.633C309.401 249.629 309.297 249.522 309.3 249.392C309.304 249.262 309.409 249.159 309.542 249.162C311.084 249.2 312.602 249.168 314.054 249.069C314.181 249.061 314.297 249.158 314.306 249.288C314.315 249.418 314.216 249.53 314.085 249.539C313.023 249.611 311.921 249.648 310.809 249.648ZM305.013 249.339C305.005 249.339 304.996 249.339 304.988 249.339C303.518 249.187 302.001 248.976 300.48 248.712C300.352 248.69 300.266 248.568 300.287 248.44C300.31 248.312 300.431 248.226 300.561 248.248C302.071 248.509 303.577 248.718 305.036 248.869C305.166 248.883 305.261 248.998 305.248 249.128C305.235 249.249 305.132 249.339 305.013 249.339ZM318.57 248.988C318.458 248.988 318.358 248.909 318.337 248.795C318.314 248.667 318.399 248.544 318.528 248.521C320.044 248.247 321.514 247.882 322.896 247.437C323.02 247.397 323.153 247.465 323.194 247.589C323.235 247.712 323.166 247.845 323.042 247.886C321.64 248.337 320.15 248.707 318.613 248.985C318.599 248.987 318.584 248.988 318.57 248.988ZM230.229 248.192C230.163 248.192 230.097 248.165 230.051 248.111C229.965 248.014 229.974 247.865 230.073 247.778C230.225 247.646 230.382 247.512 230.54 247.382C230.952 247.044 231.38 246.715 231.826 246.399C230.347 245.801 228.793 245.328 227.603 244.982C227.477 244.946 227.405 244.816 227.441 244.69C227.477 244.566 227.609 244.493 227.735 244.529C228.95 244.882 230.54 245.366 232.054 245.982C232.126 246.012 232.176 246.073 232.194 246.142C232.71 245.789 233.246 245.454 233.798 245.135C233.911 245.07 234.056 245.108 234.122 245.221C234.187 245.334 234.149 245.477 234.036 245.543C232.889 246.203 231.815 246.944 230.842 247.745C230.688 247.872 230.534 248.002 230.386 248.132C230.34 248.172 230.284 248.192 230.229 248.192ZM296.07 247.85C296.054 247.85 296.038 247.849 296.022 247.846C294.685 247.572 293.274 247.274 291.583 246.908C291.455 246.88 291.374 246.755 291.401 246.628C291.429 246.5 291.556 246.419 291.683 246.447C293.374 246.813 294.782 247.11 296.118 247.384C296.246 247.41 296.328 247.535 296.302 247.662C296.278 247.774 296.179 247.85 296.07 247.85ZM327.16 246.185C327.074 246.185 326.99 246.139 326.948 246.056C326.889 245.94 326.936 245.798 327.053 245.74C328.404 245.056 329.685 244.262 330.861 243.38C330.966 243.301 331.114 243.322 331.193 243.426C331.272 243.53 331.251 243.678 331.147 243.756C329.949 244.656 328.644 245.464 327.268 246.16C327.232 246.177 327.196 246.185 327.16 246.185ZM287.203 245.946C287.186 245.946 287.168 245.944 287.152 245.941C285.663 245.614 284.204 245.296 282.722 244.978C282.594 244.951 282.513 244.825 282.541 244.698C282.568 244.571 282.695 244.49 282.822 244.518C284.305 244.835 285.765 245.155 287.254 245.482C287.382 245.509 287.462 245.635 287.434 245.762C287.41 245.871 287.312 245.946 287.203 245.946ZM278.333 244.057C278.318 244.057 278.302 244.055 278.286 244.052C276.695 243.731 275.239 243.452 273.837 243.197C273.709 243.174 273.623 243.051 273.647 242.923C273.671 242.795 273.794 242.711 273.923 242.734C275.327 242.988 276.785 243.268 278.38 243.59C278.508 243.616 278.592 243.741 278.565 243.868C278.542 243.979 278.443 244.057 278.333 244.057ZM223.29 243.82C223.271 243.82 223.252 243.817 223.233 243.813C221.788 243.457 220.303 243.123 218.819 242.819C218.691 242.793 218.609 242.669 218.635 242.541C218.661 242.414 218.787 242.332 218.914 242.358C220.404 242.663 221.895 242.999 223.346 243.356C223.473 243.388 223.55 243.515 223.519 243.641C223.492 243.748 223.396 243.82 223.29 243.82ZM238.011 243.647C237.916 243.647 237.826 243.589 237.79 243.495C237.744 243.373 237.804 243.237 237.927 243.191C239.3 242.67 240.768 242.224 242.291 241.865C242.418 241.835 242.546 241.913 242.576 242.04C242.606 242.166 242.527 242.293 242.4 242.323C240.897 242.678 239.448 243.117 238.094 243.632C238.067 243.642 238.039 243.647 238.011 243.647ZM269.408 242.452C269.396 242.452 269.383 242.451 269.371 242.449C267.832 242.215 266.324 242.011 264.886 241.843C264.757 241.828 264.663 241.71 264.679 241.581C264.694 241.452 264.811 241.36 264.942 241.374C266.385 241.543 267.9 241.748 269.444 241.984C269.574 242.003 269.661 242.124 269.642 242.253C269.623 242.369 269.523 242.452 269.408 242.452ZM129.434 242.314C129.087 242.314 128.738 242.313 128.391 242.311C128.26 242.31 128.154 242.205 128.155 242.075C128.156 241.945 128.261 241.84 128.392 241.84H128.393C128.739 241.842 129.087 241.842 129.434 241.843C130.57 241.843 131.744 241.835 132.924 241.819C132.925 241.819 132.926 241.819 132.928 241.819C133.057 241.819 133.163 241.922 133.165 242.051C133.166 242.181 133.062 242.289 132.931 242.29C131.749 242.306 130.573 242.314 129.434 242.314ZM123.857 242.246C123.855 242.246 123.853 242.246 123.851 242.246C122.314 242.207 120.787 242.151 119.313 242.079C119.182 242.073 119.082 241.962 119.088 241.832C119.094 241.702 119.207 241.603 119.337 241.608C120.807 241.68 122.33 241.736 123.863 241.775C123.994 241.779 124.097 241.886 124.094 242.017C124.091 242.144 123.986 242.246 123.857 242.246ZM137.462 242.194C137.334 242.194 137.229 242.093 137.225 241.965C137.222 241.835 137.324 241.726 137.456 241.722C138.9 241.68 140.424 241.628 141.985 241.564C142.117 241.561 142.226 241.66 142.232 241.79C142.237 241.92 142.136 242.03 142.005 242.035C140.442 242.098 138.916 242.152 137.469 242.193C137.466 242.194 137.465 242.194 137.462 242.194ZM214.409 241.997C214.397 241.997 214.383 241.996 214.37 241.994C212.908 241.75 211.402 241.526 209.893 241.328C209.764 241.311 209.672 241.193 209.689 241.064C209.707 240.935 209.826 240.844 209.955 240.861C211.469 241.06 212.98 241.284 214.448 241.529C214.577 241.55 214.664 241.671 214.642 241.8C214.623 241.915 214.523 241.997 214.409 241.997ZM146.525 241.831C146.4 241.831 146.295 241.734 146.289 241.607C146.282 241.477 146.383 241.366 146.514 241.36C147.923 241.29 149.404 241.211 151.041 241.12C151.171 241.114 151.284 241.212 151.291 241.342C151.298 241.472 151.198 241.583 151.068 241.59C149.429 241.681 147.946 241.76 146.537 241.83C146.534 241.831 146.53 241.831 146.525 241.831ZM114.798 241.797C114.792 241.797 114.786 241.797 114.78 241.796C113.253 241.68 111.73 241.542 110.256 241.386C110.126 241.373 110.032 241.256 110.045 241.127C110.059 240.998 110.175 240.904 110.306 240.918C111.776 241.073 113.293 241.21 114.815 241.326C114.946 241.336 115.043 241.448 115.033 241.578C115.025 241.703 114.921 241.797 114.798 241.797ZM246.81 241.54C246.692 241.54 246.589 241.452 246.575 241.333C246.559 241.204 246.651 241.087 246.781 241.07C247.952 240.927 249.161 240.827 250.375 240.773C250.692 240.758 251.008 240.746 251.325 240.736C251.455 240.73 251.565 240.833 251.569 240.963C251.572 241.093 251.471 241.202 251.34 241.206C251.027 241.216 250.712 241.228 250.397 241.242C249.196 241.296 247.999 241.394 246.84 241.536C246.829 241.54 246.82 241.54 246.81 241.54ZM260.399 241.412C260.394 241.412 260.388 241.412 260.381 241.412C258.85 241.299 257.33 241.225 255.863 241.19C255.732 241.187 255.629 241.078 255.631 240.949C255.634 240.819 255.74 240.718 255.873 240.718C257.348 240.754 258.876 240.829 260.416 240.941C260.546 240.951 260.644 241.064 260.634 241.194C260.626 241.318 260.522 241.412 260.399 241.412ZM155.584 241.329C155.459 241.329 155.355 241.233 155.348 241.107C155.34 240.977 155.439 240.866 155.57 240.858C156.563 240.8 157.556 240.74 158.549 240.681L160.098 240.588C160.229 240.581 160.341 240.679 160.348 240.809C160.356 240.939 160.256 241.051 160.126 241.058L158.577 241.151C157.584 241.21 156.591 241.27 155.598 241.328C155.593 241.329 155.588 241.329 155.584 241.329ZM105.78 240.841C105.769 240.841 105.758 240.84 105.747 240.838C104.255 240.632 102.745 240.396 101.258 240.137C101.13 240.115 101.043 239.993 101.066 239.865C101.089 239.737 101.211 239.651 101.34 239.673C102.822 239.931 104.326 240.166 105.812 240.372C105.942 240.39 106.033 240.509 106.015 240.638C105.997 240.755 105.896 240.841 105.78 240.841ZM205.419 240.814C205.411 240.814 205.404 240.814 205.396 240.813C203.926 240.668 202.408 240.542 200.883 240.435C200.753 240.426 200.655 240.313 200.664 240.183C200.673 240.053 200.785 239.958 200.917 239.965C202.446 240.07 203.968 240.199 205.443 240.344C205.573 240.357 205.668 240.472 205.655 240.602C205.642 240.724 205.539 240.814 205.419 240.814ZM164.639 240.794C164.515 240.794 164.411 240.698 164.403 240.572C164.396 240.442 164.496 240.331 164.626 240.323C166.284 240.228 167.766 240.147 169.157 240.076C169.286 240.07 169.399 240.169 169.405 240.299C169.413 240.429 169.312 240.54 169.181 240.546C167.791 240.618 166.31 240.699 164.654 240.793C164.648 240.793 164.644 240.794 164.639 240.794ZM334.35 240.77C334.293 240.77 334.236 240.749 334.19 240.708C334.093 240.621 334.087 240.472 334.175 240.375C335.167 239.293 336.08 238.098 336.89 236.823C336.96 236.712 337.106 236.68 337.216 236.749C337.327 236.819 337.36 236.964 337.29 237.074C336.465 238.373 335.535 239.591 334.524 240.694C334.478 240.744 334.413 240.77 334.35 240.77ZM173.699 240.329C173.573 240.329 173.468 240.23 173.462 240.104C173.457 239.974 173.558 239.864 173.688 239.858C175.255 239.791 176.781 239.732 178.223 239.686C178.355 239.68 178.463 239.783 178.467 239.914C178.472 240.044 178.369 240.153 178.238 240.157C176.798 240.203 175.273 240.261 173.707 240.329C173.706 240.329 173.703 240.329 173.699 240.329ZM196.371 240.183C196.367 240.183 196.364 240.183 196.36 240.183C194.89 240.12 193.367 240.073 191.833 240.042C191.702 240.04 191.598 239.932 191.6 239.802C191.603 239.672 191.709 239.565 191.842 239.571C193.38 239.601 194.907 239.649 196.38 239.712C196.511 239.718 196.612 239.828 196.607 239.958C196.602 240.084 196.497 240.183 196.371 240.183ZM182.767 240.043C182.638 240.043 182.533 239.941 182.53 239.812C182.528 239.682 182.632 239.575 182.763 239.572C184.312 239.544 185.839 239.53 187.302 239.529C187.433 239.529 187.539 239.635 187.539 239.765C187.539 239.894 187.433 240 187.302 240C185.842 240.001 184.317 240.015 182.771 240.043C182.77 240.043 182.768 240.043 182.767 240.043ZM96.8458 239.285C96.8294 239.285 96.8131 239.284 96.7968 239.28C95.3223 238.969 93.8315 238.629 92.3679 238.268C92.241 238.237 92.1639 238.109 92.1947 237.983C92.2265 237.857 92.3543 237.779 92.4813 237.811C93.9394 238.171 95.4239 238.509 96.8938 238.819C97.0217 238.846 97.1033 238.97 97.077 239.098C97.0534 239.21 96.9555 239.285 96.8458 239.285ZM88.0424 237.115C88.0207 237.115 87.9989 237.112 87.9771 237.106C86.5262 236.694 85.0636 236.252 83.6299 235.791C83.5057 235.751 83.4367 235.619 83.4775 235.494C83.5174 235.371 83.6507 235.302 83.7759 235.343C85.2041 235.802 86.6614 236.242 88.1077 236.653C88.2338 236.689 88.3063 236.819 88.271 236.944C88.2401 237.047 88.1458 237.115 88.0424 237.115ZM79.4114 234.341C79.3851 234.341 79.3579 234.336 79.3307 234.326C77.9133 233.816 76.4851 233.273 75.0859 232.714C74.9644 232.665 74.9055 232.528 74.9544 232.407C75.0034 232.286 75.1412 232.227 75.2627 232.276C76.6565 232.834 78.0802 233.374 79.4921 233.882C79.6154 233.927 79.6789 234.062 79.6345 234.184C79.5991 234.281 79.5084 234.341 79.4114 234.341ZM339.19 233.19C339.16 233.19 339.13 233.185 339.1 233.172C338.979 233.123 338.921 232.984 338.971 232.864C339.564 231.437 339.906 229.992 339.987 228.568C339.994 228.438 340.103 228.341 340.236 228.346C340.367 228.353 340.466 228.465 340.459 228.594C340.376 230.07 340.022 231.568 339.409 233.044C339.372 233.136 339.284 233.19 339.19 233.19ZM70.9962 230.976C70.9644 230.976 70.9318 230.969 70.9001 230.956C69.5208 230.348 68.1343 229.707 66.7786 229.052C66.6607 228.995 66.6117 228.854 66.6689 228.737C66.726 228.619 66.8675 228.571 66.9854 228.627C68.3356 229.28 69.7167 229.919 71.0914 230.524C71.2111 230.577 71.2646 230.717 71.212 230.835C71.1739 230.923 71.0869 230.976 70.9962 230.976ZM62.8385 227.031C62.8013 227.031 62.7632 227.022 62.7279 227.004C62.1783 226.714 61.6234 226.416 61.0793 226.118C60.2922 225.687 59.5096 225.249 58.7524 224.813C58.6391 224.748 58.601 224.603 58.6663 224.491C58.7316 224.378 58.8766 224.34 58.99 224.405C59.7436 224.839 60.5234 225.277 61.3069 225.705C61.8492 226.002 62.4014 226.299 62.9491 226.588C63.0643 226.649 63.1087 226.792 63.0471 226.906C63.0054 226.986 62.9237 227.031 62.8385 227.031ZM339.669 224.362C339.568 224.362 339.473 224.296 339.443 224.194C339.044 222.878 338.418 221.52 337.583 220.157C337.515 220.046 337.55 219.901 337.662 219.833C337.773 219.765 337.919 219.801 337.987 219.912C338.843 221.309 339.486 222.704 339.897 224.057C339.935 224.182 339.864 224.314 339.738 224.351C339.715 224.358 339.692 224.362 339.669 224.362ZM54.9937 222.503C54.9501 222.503 54.9057 222.491 54.8667 222.466C53.5663 221.641 52.2959 220.792 51.0917 219.943C50.9847 219.868 50.9593 219.721 51.0354 219.615C51.1107 219.508 51.2585 219.484 51.3655 219.559C52.5634 220.403 53.8275 221.247 55.1215 222.068C55.2322 222.137 55.2639 222.283 55.1941 222.393C55.1487 222.464 55.0726 222.503 54.9937 222.503ZM47.6004 217.279C47.5487 217.279 47.4971 217.262 47.4535 217.228C46.2484 216.273 45.0804 215.288 43.9822 214.3C43.8852 214.213 43.878 214.064 43.965 213.967C44.053 213.871 44.2026 213.863 44.2996 213.95C45.3905 214.932 46.5503 215.91 47.7482 216.858C47.8507 216.939 47.8679 217.087 47.7863 217.189C47.7392 217.249 47.6703 217.279 47.6004 217.279Z" fill="#131313"/>
                                    <path d="M335.08 216.605C335.013 216.605 334.947 216.577 334.9 216.522C334.438 215.982 333.931 215.419 333.395 214.852C333.305 214.757 333.309 214.608 333.405 214.519C333.5 214.429 333.649 214.434 333.739 214.529C334.281 215.102 334.794 215.669 335.261 216.217C335.345 216.316 335.333 216.465 335.234 216.549C335.189 216.586 335.135 216.605 335.08 216.605Z" fill="#131313"/>
                                    <path d="M329.869 222.394C329.842 222.394 329.815 222.39 329.788 222.38C329.666 222.336 329.602 222.2 329.646 222.079C329.647 222.077 329.655 222.049 329.655 221.968C329.655 221.609 329.494 220.596 328.726 217.805C328.692 217.68 328.766 217.55 328.892 217.516C329.018 217.481 329.149 217.555 329.183 217.681C329.819 219.994 330.128 221.396 330.128 221.968C330.128 222.083 330.117 222.169 330.091 222.238C330.057 222.335 329.966 222.394 329.869 222.394ZM327.694 213.635C327.592 213.635 327.498 213.569 327.467 213.467C326.865 211.473 326.374 209.927 326.348 209.846C326.34 209.821 326.335 209.793 326.336 209.765C326.34 209.65 326.425 209.554 326.538 209.538C326.585 209.531 326.624 209.535 326.656 209.548L327.34 209.688C327.468 209.714 327.55 209.839 327.524 209.966C327.498 210.093 327.372 210.175 327.245 210.149L326.92 210.082C326.974 210.255 327.045 210.48 327.129 210.75C327.315 211.346 327.602 212.276 327.921 213.332C327.959 213.457 327.888 213.588 327.762 213.625C327.739 213.632 327.716 213.635 327.694 213.635ZM341.253 213.013C341.238 213.013 341.221 213.012 341.205 213.009L340.567 212.878C340.439 212.852 340.356 212.727 340.383 212.6C340.409 212.473 340.534 212.391 340.662 212.417L341.3 212.548C341.428 212.574 341.511 212.698 341.484 212.826C341.462 212.937 341.364 213.013 341.253 213.013ZM336.174 211.973C336.159 211.973 336.142 211.971 336.126 211.968L331.685 211.059C331.557 211.033 331.475 210.908 331.501 210.781C331.528 210.654 331.653 210.571 331.781 210.598L336.221 211.507C336.349 211.533 336.432 211.658 336.405 211.785C336.383 211.896 336.284 211.973 336.174 211.973Z" fill="#131313"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_309_2554">
                                    <rect width="382" height="270" fill="white"/>
                                    </clipPath>
                                    </defs>
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
