@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme20">
@else
<div class="{{ $business->theme_color }}" id="view_theme20">
@endif
        <main id="boxes">
            <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
                <div class="gardening-card">
                    <section class="profile-sec pb">
                        <div class="profile-banner-wrp">
                            <div class="profile-banner img-wrapper">
                                <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme20/images/profile-banner-img.png') }}" class="profile-banner-image" alt="profile-banner" id="banner_preview" loading="lazy">
                                <div class="profile-name">
                                    <span id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                                </div>
                            </div>
                        <img src="{{ asset('custom/theme20/images/banner-bg.png')}}"  alt="profile-banner" class="profile-banner-bg">
                        </div>
                        <div class="client-info-content d-flex align-items-center">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme20/images/client-image.png') }}"   alt="client-image" loading="lazy">
                            </div>
                            <div class="client-info text-center">
                                <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                                <span id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</span>
                            </div>
                        </div>
                        <div class="container">
                            <div class="profile-content text-center">
                                <p id="{{ $stringid . '_desc' }}_preview"> {!! nl2br(e($business->description)) !!}</p>
                            </div>
                        </div>
                    </section>
                    @php $j = 1; @endphp
                    @foreach ($card_theme->order as $order_key => $order_value)
                        @if ($j == $order_value)
                            @if ($order_key == 'social')
                            <section class="social-link-sec pb" id="social-div">
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
                            @if ($order_key == 'service')
                            <section class="service-sec pb" id="services-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{ __('Services') }}</h2>
                                </div>
                                <div class="container">
                                    @if(isset($is_pdf))
                                        @php $image_count = 0; @endphp
                                        @foreach ($services_content as $k1 => $content)
                                            <div class="service-card edit-card" id="services_{{ $service_row_nos }}">
                                                <div class="service-card-inner">
                                                    <div class="service-card-image">
                                                        <div class="img-wrapper">
                                                            <img id="{{ 's_image' . $image_count . '_preview' }}" width="28" height="28" src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"  class="img-fluid" alt="service-image">
                                                        </div>
                                                    </div>
                                                    <div class="service-content">
                                                        <div class="service-content-top">
                                                            <h3 id="{{ 'title_' . $service_row_nos . '_preview' }}"> {{ $content->title }}</h3>
                                                            <p id="{{ 'description_' . $service_row_nos . '_preview' }}">{{ $content->description }} </p>
                                                        </div>
                                                        <div class="service-content-bottom">
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
                                                        <div class="img-wrapper">
                                                            <img id="{{ 's_image' . $image_count . '_preview' }}" width="28" height="28" src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"  class="img-fluid" alt="service-image">
                                                        </div>
                                                    </div>
                                                    <div class="service-content">
                                                        <div class="service-content-top">
                                                            <h3 id="{{ 'title_' . $service_row_nos . '_preview' }}"> {{ $content->title }}</h3>
                                                            <p id="{{ 'description_' . $service_row_nos . '_preview' }}">{{ $content->description }} </p>
                                                        </div>
                                                        <div class="service-content-bottom">
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
                            </section>
                            @endif
                            @if ($order_key == 'bussiness_hour')
                            <section class="business-hour-sec pb" id="business-hours-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{ __('Business Hours') }}</h2>
                                </div>
                                <ul class="hours-list">
                                    @foreach ($days as $k => $day)
                                        <li class="d-flex align-items-center justify-content-between">
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
                            </section>
                            @endif
                            @if ($order_key == 'gallery')
                            <section class="gallery-sec pb" id="gallery-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{__('Gallery')}}</h2>
                                </div>
                                <div class="container">
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
                                                                    class="gallery-popup-btn  img-wrapper">
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
                                                                        class="video-popup-btn  play-btn img-wrapper">
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
                                                                        class="video-popup-btn play-btn  img-wrapper">
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
                                                                    class="gallery-popup-btn  img-wrapper">
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
                                    <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                        <div class="slick-prev slick-arrow gallery-arrow">
                                            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 5L0 0.226497V11.7735L10 7V5ZM9 7H26V5H9V7Z" fill="#8B4513"/>
                                                </svg>
                                        </div>
                                        <div class="slick-next slick-arrow gallery-arrow">
                                            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 5L26 0.226497V11.7735L16 7V5ZM17 7H0V5H17V7Z" fill="#8B4513"/>
                                                </svg>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'contact_info')
                            <section class="contact-info-sec pb" id="contact-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{__('Contact us')}}</h2>
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
                                                        <li id="contact_{{ $loop->parent->index + 1 }}" class="d-flex align-items-center">
                                                            @if ($key1 == 'Address')
                                                                @foreach ($val1 as $key2 => $val2)
                                                                    @if ($key2 == 'Address_url')
                                                                        @php $href = $val2; @endphp
                                                                    @endif
                                                                @endforeach
                                                                <div class="contact-image">
                                                                    <img src="{{ asset('custom/theme20/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                                </div>
                                                                    <a href="{{ $href }}" target="_blank" class="contact-item" >
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
                                                                    <div class="contact-image">
                                                                        <img src="{{ asset('custom/theme20/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                                    </div>
                                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                                @else
                                                                    <div class="contact-image">
                                                                        <img src="{{ asset('custom/theme20/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                                        </div>
                                                                        <a href="{{ $href }}" class="contact-item">
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
                            @if ($order_key == 'product')
                            <section class="product-sec pb" id="product-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{__('Product')}}</h2>
                                </div>
                                <div class="container">
                                    @if(isset($is_pdf))
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
                                                            <a href="{{ url($content->purchase_link) }}"
                                                            class="btn btn-white">{{ $content->link_title }}</a>
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
                                                            <a href="{{ url($content->purchase_link) }}"
                                                            class="btn btn-white">{{ $content->link_title }}</a>
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
                                    <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                        <div class="slick-prev slick-arrow product-arrow">
                                            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 5L0 0.226497V11.7735L10 7V5ZM9 7H26V5H9V7Z" fill="#8B4513"/>
                                                </svg>
                                        </div>
                                        <div class="slick-next slick-arrow product-arrow">
                                            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 5L26 0.226497V11.7735L16 7V5ZM17 7H0V5H17V7Z" fill="#8B4513"/>
                                                </svg>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'appointment')
                            <section class="appointment-sec pb" id="appointment-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{ __('Make An Appointment') }}</h2>
                                </div>
                                <div class="container">
                                    <form class="appointment-form">
                                        <div class="date-picker">
                                            <div class="form-group">
                                                <label>{{__('Date :')}}</label>
                                                <input type="text" class="form-control datepicker_min" placeholder="Pick a date">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Hours :')}}</label>
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
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn appointment-btn">{{ __('Make An Appointment') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </section>
                            @endif

                            @if ($order_key == 'more')
                            <section class="more-info-sec pb">
                                <div class="section-title common-title text-center">
                                    <h2>{{__('More')}}</h2>
                                </div>
                                <div class="container">
                                    <ul class="d-flex justify-content-between">
                                        <li>
                                            <a href="{{ route('bussiness.save', $business->slug) }}"
                                                class="save-info d-flex align-items-center justify-content-center">
                                                <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.7867 0.318213C5.92135 0.0780268 7.2727 0 8.83546 0H11.0998C12.5039 0 13.8151 0.6684 14.5939 1.7812L15.7312 3.40627C15.9909 3.77717 16.4279 4 16.896 4H23.9725C26.2086 4 28.0211 5.68153 27.9998 7.84693C27.9743 10.4256 27.9958 13.0052 27.9958 15.584C27.9958 17.0725 27.9139 18.3597 27.6616 19.4405C27.406 20.5365 26.957 21.5001 26.1641 22.2553C25.3713 23.0105 24.3597 23.4383 23.209 23.6817C22.0744 23.922 20.723 24 19.1603 24H8.83546C7.2727 24 5.92135 23.922 4.7867 23.6817C3.63615 23.4383 2.62443 23.0105 1.83159 22.2553C1.03877 21.5001 0.589773 20.5365 0.334074 19.4405C0.0819157 18.3597 0 17.0725 0 15.584V8.416C0 6.92743 0.0819157 5.64024 0.334074 4.55945C0.589773 3.46352 1.03877 2.49984 1.83159 1.74464C2.62443 0.989453 3.63615 0.561773 4.7867 0.318213ZM15.3977 10.6667C15.3977 9.93027 14.771 9.33333 13.9979 9.33333C13.2248 9.33333 12.5981 9.93027 12.5981 10.6667V14.7811L11.4882 13.7239C10.9416 13.2032 10.0553 13.2032 9.50861 13.7239C8.96196 14.2445 8.96196 15.0888 9.50861 15.6095L12.9206 18.8595C12.9356 18.8737 12.9508 18.8877 12.9664 18.9013C13.2223 19.1668 13.5896 19.3333 13.9979 19.3333C14.4062 19.3333 14.7735 19.1668 15.0294 18.9013C15.0449 18.8877 15.0602 18.8737 15.0752 18.8595L18.4871 15.6095C19.0338 15.0888 19.0338 14.2445 18.4871 13.7239C17.9405 13.2032 17.0542 13.2032 16.5076 13.7239L15.3977 14.7811V10.6667Z" fill="white"/>
                                                    </svg>
                                            </a>
                                            <span>{{__('Save')}}</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="share-info d-flex align-items-center justify-content-center">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.68161 14.3394L13.9018 9.11828C14.2464 8.77363 14.8067 8.77363 15.1514 9.11828C15.496 9.46382 15.496 10.0232 15.1514 10.3688L9.9312 15.589L14.0291 23.3295C14.3596 23.9543 15.0321 24.322 15.7364 24.2636C16.4416 24.2053 17.0443 23.7325 17.2679 23.0609C18.8233 18.3957 22.7241 6.69245 24.1796 2.32683C24.3908 1.69143 24.2255 0.99152 23.7527 0.517842C23.279 0.0441633 22.5791 -0.121095 21.9437 0.0909994L1.20881 7.00264C0.538056 7.22622 0.0652546 7.82805 0.00604476 8.53327C-0.0522813 9.23848 0.315362 9.91012 0.941042 10.2415L8.68161 14.3394Z" fill="white"/>
                                                    </svg>
                                            </a>
                                            <span>{{__('Share')}}</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18.5133 10.3607C18.6413 10.3608 18.768 10.3356 18.8862 10.2866C19.0044 10.2377 19.1118 10.1659 19.2023 10.0755C19.2928 9.98498 19.3645 9.87756 19.4135 9.75935C19.4624 9.64113 19.4876 9.51443 19.4876 9.38648V1.59242C19.4876 1.33403 19.3849 1.08623 19.2022 0.903517C19.0195 0.720809 18.7717 0.618164 18.5133 0.618164C18.2549 0.618164 18.0071 0.720809 17.8244 0.903517C17.6417 1.08623 17.5391 1.33403 17.5391 1.59242V9.38648C17.539 9.51443 17.5642 9.64113 17.6132 9.75935C17.6621 9.87756 17.7339 9.98498 17.8243 10.0755C17.9148 10.1659 18.0222 10.2377 18.1404 10.2866C18.2587 10.3356 18.3854 10.3608 18.5133 10.3607Z" fill="white"/>
                                                    <path d="M14.6149 8.41195C14.7428 8.41198 14.8695 8.3868 14.9878 8.33785C15.106 8.28891 15.2134 8.21714 15.3039 8.12667C15.3943 8.03619 15.4661 7.92878 15.515 7.81056C15.564 7.69235 15.5892 7.56564 15.5891 7.43769V3.54066C15.5891 3.28227 15.4865 3.03447 15.3038 2.85176C15.1211 2.66905 14.8733 2.56641 14.6149 2.56641C14.3565 2.56641 14.1087 2.66905 13.926 2.85176C13.7433 3.03447 13.6406 3.28227 13.6406 3.54066V7.43769C13.6406 7.56564 13.6658 7.69235 13.7147 7.81056C13.7637 7.92878 13.8354 8.03619 13.9259 8.12667C14.0164 8.21714 14.1238 8.28891 14.242 8.33785C14.3602 8.3868 14.4869 8.41198 14.6149 8.41195Z" fill="white"/>
                                                    <path d="M22.4079 7.43804C22.5358 7.43808 22.6625 7.4129 22.7807 7.36395C22.8989 7.315 23.0064 7.24324 23.0968 7.15276C23.1873 7.06229 23.2591 6.95487 23.308 6.83666C23.357 6.71844 23.3821 6.59174 23.3821 6.46379V4.51527C23.3821 4.25688 23.2795 4.00908 23.0968 3.82637C22.914 3.64366 22.6662 3.54102 22.4079 3.54102C22.1495 3.54102 21.9017 3.64366 21.7189 3.82637C21.5362 4.00908 21.4336 4.25688 21.4336 4.51527V6.46379C21.4336 6.59174 21.4587 6.71844 21.5077 6.83666C21.5566 6.95487 21.6284 7.06229 21.7189 7.15276C21.8093 7.24324 21.9168 7.315 22.035 7.36395C22.1532 7.4129 22.2799 7.43808 22.4079 7.43804Z" fill="white"/>
                                                    <path d="M23.7146 18.7675L19.7595 14.8124C19.6224 14.6754 19.4477 14.5823 19.2575 14.5451C19.0673 14.508 18.8703 14.5283 18.6918 14.6037L14.5282 16.3608L7.63915 9.47182L9.39626 5.30827C9.47162 5.12971 9.49201 4.93274 9.45484 4.74253C9.41766 4.55232 9.32459 4.37752 9.18754 4.24048L5.23242 0.285371C5.14195 0.194898 5.03455 0.12313 4.91634 0.0741659C4.79813 0.0252018 4.67144 0 4.5435 0C4.41555 0 4.28886 0.0252018 4.17065 0.0741659C4.05245 0.12313 3.94504 0.194898 3.85457 0.285371L1.15366 2.98631C-1.93852 6.07856 1.58733 11.6658 6.96079 17.0392C12.3342 22.4127 17.9215 25.9385 21.0138 22.8463L23.7147 20.1454C23.8974 19.9627 24 19.7148 24 19.4564C24 19.1981 23.8973 18.9502 23.7146 18.7675Z" fill="white"/>
                                                    </svg>
                                            </a>
                                            <span>{{__('Contact')}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'testimonials')
                            <section class="testimonial-sec pb" id="testimonials-div">
                                <div class="section-title common-title text-center">
                                    <h2>{{__('Testimonial')}}</h2>
                                </div>
                                <div class="container">
                                    @if(isset($is_pdf))
                                        @php
                                        $t_image_count = 0;
                                        $rating = 0;
                                        @endphp
                                        @foreach ($testimonials_content as $k2 => $testi_content)
                                            <div class="testimonial-card" id="testimonials_{{ $testimonials_row_nos }}">
                                                <div class="testimonial-card-inner">
                                                    <div class="testimonial-content-top d-flex align-items-center">
                                                        <div class="testimonial-image">
                                                            <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
                                                        </div>
                                                        <div class="testimonial-img-content d-flex justify-content-between">
                                                            <div class="testimonial-name">
                                                                <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                                {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                                </h3>
                                                            </div>
                                                            <div class="rating d-flex align-items-center">
                                                                @php
                                                                if (!empty($testi_content->rating)) {
                                                                    $rating = (int) $testi_content->rating;
                                                                    $overallrating = $rating;
                                                                } else {
                                                                    $overallrating = 0;
                                                                }
                                                                @endphp
                                                                <span id="{{ 'stars' . $testimonials_row_nos }}_star" class="stars">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($overallrating < $i)
                                                                            @if (is_float($overallrating) && round($overallrating) == $i)
                                                                                <i class="star-color fas fa-star-half-alt"></i>
                                                                            @else
                                                                                <i class="fa fa-star"></i>
                                                                            @endif
                                                                        @else
                                                                            <i class="star-color fas fa-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-content-bottom">
                                                        <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">{{ $testi_content->description }} </p>
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
                                                    <div class="testimonial-content-top d-flex align-items-center">
                                                        <div class="testimonial-image">
                                                            <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
                                                        </div>
                                                        <div class="testimonial-img-content d-flex justify-content-between">
                                                            <div class="testimonial-name">
                                                                <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                                {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                                </h3>
                                                            </div>
                                                            <div class="rating d-flex align-items-center">
                                                                @php
                                                                if (!empty($testi_content->rating)) {
                                                                    $rating = (int) $testi_content->rating;
                                                                    $overallrating = $rating;
                                                                } else {
                                                                    $overallrating = 0;
                                                                }
                                                                @endphp
                                                                <span id="{{ 'stars' . $testimonials_row_nos }}_star" class="stars">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($overallrating < $i)
                                                                            @if (is_float($overallrating) && round($overallrating) == $i)
                                                                                <i class="star-color fas fa-star-half-alt"></i>
                                                                            @else
                                                                                <i class="fa fa-star"></i>
                                                                            @endif
                                                                        @else
                                                                            <i class="star-color fas fa-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-content-bottom">
                                                        <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">{{ $testi_content->description }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            $t_image_count++;
                                            $testimonials_row_nos++;
                                            @endphp
                                        @endforeach
                                    </div>
                                    <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                        <div class="slick-prev slick-arrow testimonial-arrow">
                                            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 5L0 0.226497V11.7735L10 7V5ZM9 7H26V5H9V7Z" fill="#8B4513"/>
                                                </svg>
                                        </div>
                                        <div class="slick-next slick-arrow testimonial-arrow">
                                            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 5L26 0.226497V11.7735L16 7V5ZM17 7H0V5H17V7Z" fill="#8B4513"/>
                                                </svg>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'payment')
                                <section class="payment-sec pb" id="payment-section">
                                    <div class="section-title common-title text-center">
                                        <h2>{{ __('Payment') }}</h2>
                                    </div>
                                    <div class="container">
                                                    @if (!is_null($cardPayment_content) && !empty($cardPayment_content))
                                                        <ul class="d-flex align-items-center justify-content-center">
                                                            @if (isset($cardPayment_content->stripe) && $cardPayment_content->stripe->status == 'on')
                                                                <li>
                                                                    <a href="{{ route('card.pay.with.stripe', $business->id) }}"
                                                                        class="d-flex align-items-center justify-content-center"
                                                                        target="_blank">
                                                                        <img src="{{ asset('custom/img/payments/stripe.png') }}"
                                                                            alt="payment-image" class="img-fluid" loading="lazy">
                                                                        <span>{{ __('Stripe') }}</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if (isset($cardPayment_content->paypal) && $cardPayment_content->paypal->status == 'on')
                                                                <li>
                                                                    <a href="{{ route('card.pay.with.paypal', $business->id) }}"
                                                                        class="d-flex align-items-center justify-content-center"
                                                                        target="_blank">
                                                                        <img src="{{ asset('custom/img/payments/paypal.png') }}"
                                                                            alt="payment-image" loading="lazy">
                                                                        <span>{{ __('Paypal') }}</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                    </div>
                                </section>
                            @endif
                            @if (!isset($is_pdf))
                                @if ($order_key == 'google_map')
                                    <section class="google-map-sec pb" id="google-map-div">
                                        <div class="map img-wrapper">
                                            <input type="hidden" id="mapLink" value="{{ $business->google_map_link }}">
                                            <div id="mapContainer">
                                            </div>
                                        </div>
                                    </section>
                                @endif
                            @endif
                            @if ($order_key == 'appinfo')
                                <section class="download-sec pb" id="app-section">
                                    <div class="section-title common-title text-center">
                                        <h2>{{ __('Download Here') }}</h2>
                                    </div>
                                    @if (!is_null($appInfo))
                                        <div class="container">
                                            <ul class="d-flex">
                                                @if (!is_null($appInfo->playstore_id) && !is_null($appInfo->appstore_id))
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
                                                @endif
                                            </ul>
                                        </div>
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
                                <section class="custom-text-sec" id="svg-div">
                                    <div class="container">
                                        <div class="thankyou-svg">
                                            @if (empty($business->svg_text))
                                            <svg width="466" height="630" viewBox="0 0 466 630" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M214.797 630C287.481 630 346.403 595.982 346.403 554.018C346.403 512.054 287.481 478.035 214.797 478.035C142.113 478.035 83.1914 512.054 83.1914 554.018C83.1914 595.982 142.113 630 214.797 630Z" fill="#F0F0F0"/>
                                                <path d="M118.215 357.128C123.028 367.124 122.284 379.673 123.276 390.501C124.317 401.871 126.666 412.855 129.492 423.9C135.455 447.204 143.194 470.639 145.413 494.699C146.596 507.532 145.037 519.788 143.638 532.504C143.606 532.798 144.149 533.298 144.277 532.866C151.03 510.042 146.243 485.267 140.994 462.713C135.563 439.373 127.364 416.45 124.929 392.518C124.251 385.836 123.826 379.129 123.072 372.454C122.458 367.021 121.831 361.505 118.814 356.81C118.556 356.405 117.992 356.665 118.215 357.128Z" fill="#E0E0E0"/>
                                                <path d="M114.201 361.848C116.316 362.778 119.333 365.897 117.114 368.349C116.235 369.055 115.268 369.423 114.212 369.454C113.457 369.403 113.457 369.545 114.215 369.883C114.285 370.449 114.354 371.016 114.424 371.583C111.467 372.665 110.167 374.671 110.522 377.601C110.005 378.466 108.925 379.082 108.141 379.65C107.862 379.852 108.141 380.483 108.472 380.318C110.942 379.088 114.254 375.891 111.562 373.132C110.726 372.274 108.468 371.506 107.935 373.081C107.132 375.455 111.621 375.913 112.934 375.587C115.829 374.872 116.309 371.628 115.373 369.168C114.576 367.074 111.641 364.963 109.509 366.949C108.102 368.26 109.229 369.746 110.807 370.388C113.549 371.505 118.175 370.65 119.042 367.459C119.931 364.189 117.051 361.75 114.187 361.122C113.745 361.027 113.944 361.734 114.201 361.848Z" fill="#E0E0E0"/>
                                                <path d="M77.2022 314.466C79.8536 321.937 81.775 329.644 84.3468 337.14C86.6247 343.776 89.8385 350.036 92.3095 356.6C97.8409 371.285 100.43 386.634 103.493 401.96C105.01 409.548 106.585 417.164 109.172 424.471C111.505 431.063 114.533 437.375 117.598 443.652C124.048 456.862 130.642 470.159 135.558 484.035C138.313 491.811 140.249 499.828 142.295 507.811C144.599 516.796 146.448 525.841 146.773 535.138C146.787 535.526 147.459 535.94 147.491 535.385C147.968 527.292 146.476 519.397 144.589 511.558C142.843 504.314 141.101 496.998 138.904 489.877C134.551 475.765 128.094 462.344 121.69 449.073C118.467 442.393 115.073 435.783 112.291 428.901C109.514 422.034 107.643 414.959 106.085 407.727C102.817 392.562 100.707 377.116 95.7661 362.36C93.0707 354.309 89.2136 346.782 86.291 338.838C83.303 330.718 81.339 322.274 77.8029 314.355C77.6225 313.952 77.019 313.949 77.2022 314.466Z" fill="#E0E0E0"/>
                                                <path d="M87.6259 431.487C90.486 436.145 92.0808 441.445 94.9125 446.12C96.9178 449.431 99.4626 452.38 102.037 455.253C109.592 463.681 118.153 471.391 124.441 480.872C130.974 490.722 134.382 502.185 137.185 513.553C138.571 519.174 139.813 524.832 141.253 530.44C141.869 532.842 142.485 535.243 143.614 537.467C144.773 539.748 146.271 541.81 147.288 544.17C147.612 544.92 149.073 544.59 148.703 543.731C147.683 541.369 146.178 539.323 145.027 537.035C143.762 534.519 143.123 531.764 142.438 529.048C141.031 523.459 139.791 517.829 138.387 512.24C135.851 502.148 132.799 492.03 127.439 483.035C122.111 474.092 114.614 466.844 107.537 459.313C102.98 454.465 98.0837 449.665 94.9296 443.739C92.6773 439.508 91.0129 435.099 88.228 431.156C87.9568 430.771 87.3475 431.036 87.6259 431.487Z" fill="#E0E0E0"/>
                                                <path d="M87.3976 436.108C87.8691 436.865 88.2568 437.559 88.4514 438.44C88.6573 439.374 88.4372 443.703 86.5385 443.952C85.5984 443.485 84.6596 443.018 83.7195 442.551C87.97 443.58 89.4483 445.686 88.1517 448.869C87.6334 449.387 87.115 449.906 86.5967 450.424C87.1335 452.737 86.3624 454.315 84.2847 455.157C83.7905 455.397 84.36 456.122 84.7946 455.988C92.8083 453.53 83.9027 444.742 81.5908 448.481C80.1848 450.755 83.8942 452.127 85.4847 451.962C88.2696 451.674 90.1811 449.153 89.7863 446.401C89.4185 443.839 87.2358 441.477 84.5503 441.437C82.6118 441.409 79.7702 442.971 81.5851 445.066C83.2722 447.011 86.8154 445.583 88.1958 444.056C90.4566 441.557 89.7707 438.16 87.8308 435.757C87.5581 435.42 87.1832 435.764 87.3976 436.108Z" fill="#E0E0E0"/>
                                                <path d="M80.8924 315.929C80.1369 313.415 72.8474 308.067 71.8547 308.365C70.8621 308.664 68.1865 316.825 68.9932 319.505C69.2587 320.388 70.1023 321.098 71.4613 321.425C74.178 322.078 77.9456 320.946 79.8756 318.896C80.8384 317.872 81.1566 316.814 80.8924 315.929Z" fill="#27DEBF"/>
                                                <path opacity="0.1" d="M80.8924 315.929C80.1369 313.415 72.8474 308.067 71.8547 308.365C70.8621 308.664 68.1865 316.825 68.9932 319.505C69.2587 320.388 70.1023 321.098 71.4613 321.425C74.178 322.078 77.9456 320.946 79.8756 318.896C80.8384 317.872 81.1566 316.814 80.8924 315.929Z" fill="#111111"/>
                                                <path d="M104.928 232.892C103.051 226.643 98.911 221.708 93.6153 218.574L93.6267 218.55L93.5145 218.482C87.3398 214.875 79.5675 213.753 72.0039 216.025C62.9079 218.745 56.9335 227.845 54.8587 237.361C54.1202 240.747 49.8939 242.016 47.4115 239.599C40.4344 232.803 30.4325 228.502 21.3451 231.247C13.7815 233.52 7.91639 238.74 4.75092 245.153L4.69412 245.273L4.71684 245.285C2.0257 250.82 1.29292 257.219 3.17033 263.469C8.98858 282.834 33.4602 296.431 52.9458 304.427L73.4637 312.787L85.9751 294.501C97.8232 277.091 110.746 252.257 104.928 232.892Z" fill="#8B4513" class="theme-color"/>
                                                <path opacity="0.1" d="M105.766 250.632C103.765 255.351 87.3426 287.602 63.3965 289.065C34.8917 290.807 2.8863 266.204 4.71684 245.285C2.0257 250.819 1.29292 257.218 3.17033 263.468C8.98858 282.833 33.4602 296.431 52.9458 304.426L73.4637 312.787L85.9751 294.501C94.4191 282.092 103.404 265.914 105.766 250.632Z" fill="#111111"/>
                                                <path d="M92.2396 430.758C90.8635 428.521 82.4464 425.224 81.5631 425.766C80.6812 426.309 80.1898 434.885 81.6553 437.268C82.1382 438.053 83.1365 438.523 84.5325 438.491C87.3259 438.424 90.6774 436.363 92.0166 433.887C92.6869 432.65 92.7224 431.545 92.2396 430.758Z" fill="#27DEBF"/>
                                                <path opacity="0.3" d="M92.2396 430.758C90.8635 428.521 82.4464 425.224 81.5631 425.766C80.6812 426.309 80.1898 434.885 81.6553 437.268C82.1382 438.053 83.1365 438.523 84.5325 438.491C87.3259 438.424 90.6774 436.363 92.0166 433.887C92.6869 432.65 92.7224 431.545 92.2396 430.758Z" fill="white"/>
                                                <path d="M94.1623 344.335C90.744 338.777 85.4768 335.07 79.5534 333.399L79.5577 333.373L79.4313 333.336C72.5366 331.434 64.7373 332.343 58.0101 336.482C49.9168 341.444 46.4787 351.774 46.9147 361.504C47.0695 364.966 43.3104 367.278 40.2912 365.579C31.8031 360.8 21.0343 359.211 12.9538 364.195C6.22664 368.334 1.89667 374.883 0.48506 381.894L0.460921 382.024L0.48648 382.031C-0.693645 388.071 0.23938 394.444 3.65762 400.001C14.2518 417.224 41.3918 424.086 62.2762 426.814L84.2526 429.631L91.6515 408.748C98.6385 388.876 104.756 361.558 94.1623 344.335Z" fill="#8B4513" class="theme-color"/>
                                                <path opacity="0.05" d="M99.5247 361.266C98.8018 366.341 91.2056 401.726 68.4367 409.286C41.3336 418.284 4.08508 402.719 0.486482 382.031C-0.693643 388.071 0.239371 394.444 3.65762 400.001C14.2518 417.224 41.3918 424.086 62.2762 426.814L84.2526 429.631L91.6515 408.748C96.6304 394.585 101.162 376.643 99.5247 361.266Z" fill="#111111"/>
                                                <path d="M124.335 357.828C123.45 355.356 115.895 350.391 114.92 350.74C113.944 351.09 111.693 359.377 112.636 362.013C112.947 362.882 113.826 363.547 115.199 363.802C117.947 364.315 121.651 362.989 123.472 360.843C124.382 359.771 124.645 358.696 124.335 357.828Z" fill="#27DEBF"/>
                                                <path opacity="0.1" d="M124.335 357.828C123.45 355.356 115.895 350.391 114.92 350.74C113.944 351.09 111.693 359.377 112.636 362.013C112.947 362.882 113.826 363.547 115.199 363.802C117.947 364.315 121.651 362.989 123.472 360.843C124.382 359.771 124.645 358.696 124.335 357.828Z" fill="#111111"/>
                                                <path d="M144.058 273.662C141.861 267.518 137.473 262.804 132.022 259.946L132.032 259.922L131.916 259.86C125.562 256.576 117.743 255.856 110.307 258.516C101.363 261.7 95.8672 271.097 94.2852 280.709C93.7228 284.128 89.5675 285.614 86.963 283.327C79.6437 276.9 69.4344 273.121 60.5004 276.33C53.0646 278.99 47.475 284.506 44.6461 291.074L44.5964 291.196L44.6191 291.209C42.2177 296.875 41.8144 303.304 44.0127 309.448C50.8222 328.487 75.9627 340.804 95.8346 347.784L116.756 355.075L128.307 336.169C139.244 318.167 150.869 292.701 144.058 273.662Z" fill="#455A64"/>
                                                <path opacity="0.1" d="M145.81 291.335C144.055 296.151 129.318 329.205 105.479 331.902C77.1017 335.112 43.8693 312.192 44.6191 291.207C42.2177 296.873 41.8144 303.302 44.0127 309.446C50.8222 328.485 75.9627 340.802 95.8346 347.782L116.756 355.073L128.307 336.167C136.101 323.339 144.24 306.719 145.81 291.335Z" fill="#111111"/>
                                                <path d="M341.852 368.798C338.752 373.358 337.207 378.783 335.842 384.072C334.314 389.997 332.943 395.988 331.824 402.004C329.375 415.18 328.136 428.542 326.267 441.804C324.408 455.006 321.73 467.946 317.296 480.538C313.113 492.419 308.029 504.043 305.217 516.361C301.999 530.457 302.218 545.719 305.041 559.875C305.119 560.266 305.712 560.51 305.691 559.962C305.191 546.869 303.379 534.171 305.729 521.111C307.817 509.512 312.222 498.52 316.317 487.522C320.549 476.156 323.943 464.707 326.047 452.748C328.186 440.591 329.403 428.302 331.089 416.08C332.036 409.212 333.114 402.353 334.586 395.575C336.514 386.705 338.309 377.46 342.542 369.382C342.738 369.009 342.132 368.385 341.852 368.798Z" fill="#E0E0E0"/>
                                                <path d="M346.291 373.277C343.171 373.862 340.264 376.752 341.753 380.117C342.909 382.727 346.815 383.442 349.333 382.781C351.027 382.336 352.602 380.666 350.997 379.236C348.864 377.336 346.008 379.005 345.122 381.209C344.126 383.685 344.633 386.891 347.472 387.734C348.793 388.127 352.718 387.914 352.521 385.824C352.343 383.959 349.908 384.233 348.86 385.188C345.917 387.868 349.638 391.3 351.934 392.568C352.306 392.774 352.353 392.151 352.109 391.979C349.256 389.965 352.018 391.015 349.255 386.641C346.683 385.983 345.652 384.762 346.161 382.972C346.096 382.434 346.262 381.997 346.659 381.66C346.291 381.62 345.923 381.582 345.557 381.542C342.99 380.731 342.121 379.205 342.951 376.965C343.567 375.443 345.237 374.612 346.627 373.996C346.962 373.85 346.6 373.219 346.291 373.277Z" fill="#E0E0E0"/>
                                                <path d="M394.204 306.991C391.306 315.29 386.648 322.827 384.467 331.393C382.138 340.538 380.715 349.891 378.579 359.082C374.747 375.569 369.754 391.869 362.942 407.379C356.185 422.762 346.238 436.3 340.117 451.983C333.781 468.216 329.319 485.15 320.646 500.388C316.086 508.399 311.092 516.138 308.478 525.063C305.549 535.067 303.994 545.609 305.235 556.006C305.278 556.356 305.962 556.652 305.945 556.153C305.607 546.668 306.675 537.156 309.108 527.982C311.442 519.179 315.784 511.537 320.338 503.727C328.756 489.288 333.683 473.648 339.369 458.025C342.363 449.799 345.687 441.649 350.135 434.085C354.185 427.199 358.358 420.518 361.801 413.287C369.195 397.76 374.585 381.295 378.708 364.618C381.17 354.656 382.808 344.53 385.111 334.536C387.296 325.052 392.411 316.794 394.828 307.438C394.913 307.102 394.362 306.539 394.204 306.991Z" fill="#E0E0E0"/>
                                                <path d="M373.432 442.169C368.129 451.87 358.613 457.815 351.482 465.979C344.015 474.529 338.823 484.74 333.631 494.751C330.877 500.059 328.111 505.369 324.973 510.463C321.851 515.531 318.237 520.273 315.155 525.369C308.417 536.515 305.54 548.752 304.067 561.589C303.97 562.431 305.494 562.667 305.589 561.825C307.039 549.144 309.885 536.98 316.547 525.954C322.039 516.863 328.178 508.388 333.128 498.95C337.934 489.789 342.459 480.406 348.54 471.995C353.425 465.239 359.692 459.929 365.607 454.154C369.082 450.761 372.097 447.189 374.139 442.748C374.315 442.364 373.672 441.729 373.432 442.169Z" fill="#E0E0E0"/>
                                                <path d="M371.298 448.345C369.192 450.753 368.746 454.21 370.975 456.705C372.27 458.156 375.971 459.848 377.558 457.858C379.238 455.754 376.087 454.167 374.32 454.15C371.127 454.119 368.776 457.388 369.192 460.407C369.536 462.901 371.858 464.83 374.397 464.709C376.067 464.629 378.54 463.106 377.171 461.211C375.657 459.116 372.176 461.041 371.296 462.753C369.996 465.281 371.79 467.901 374.194 468.694C374.827 468.903 374.759 468.114 374.32 467.89C372.302 466.858 370.11 461.455 370.404 459.166C370.593 458.608 370.781 458.051 370.97 457.493C371.474 455.945 372.131 455.707 372.937 456.776C374.208 457.753 374.068 457.644 372.518 456.447C371.178 455.796 370.509 454.677 370.512 453.092C370.392 451.612 371.023 450.167 371.781 448.931C371.956 448.654 371.578 448.024 371.298 448.345Z" fill="#E0E0E0"/>
                                                <path d="M388.511 307.582C389.198 305.049 396.341 299.506 397.341 299.777C398.341 300.048 401.236 308.135 400.504 310.836C400.262 311.726 399.439 312.459 398.089 312.821C395.391 313.547 391.594 312.517 389.61 310.52C388.617 309.522 388.271 308.473 388.511 307.582Z" fill="#27DEBF"/>
                                                <path opacity="0.1" d="M388.511 307.582C389.198 305.049 396.341 299.506 397.341 299.777C398.341 300.048 401.236 308.135 400.504 310.836C400.262 311.726 399.439 312.459 398.089 312.821C395.391 313.547 391.594 312.517 389.61 310.52C388.617 309.522 388.271 308.473 388.511 307.582Z" fill="#111111"/>
                                                <path d="M362.243 225.225C363.951 218.928 367.956 213.882 373.165 210.606L373.152 210.584L373.263 210.512C379.338 206.739 387.076 205.409 394.7 207.476C403.865 209.949 410.084 218.886 412.416 228.342C413.245 231.706 417.504 232.862 419.921 230.377C426.712 223.394 436.593 218.826 445.752 221.324C453.373 223.392 459.378 228.452 462.715 234.777L462.775 234.895L462.752 234.909C465.591 240.369 466.498 246.746 464.79 253.044C459.496 272.559 435.402 286.812 416.139 295.331L395.855 304.242L382.856 286.302C370.538 269.215 356.948 244.74 362.243 225.225Z" fill="#8B4513" class="theme-color"/>
                                                <path opacity="0.1" d="M361.883 242.982C364.01 247.645 381.299 279.441 405.275 280.257C433.816 281.228 465.146 255.77 462.75 234.908C465.589 240.369 466.496 246.745 464.788 253.043C459.494 272.559 435.4 286.811 416.137 295.33L395.852 304.242L382.852 286.301C374.076 274.125 364.658 258.195 361.883 242.982Z" fill="#111111"/>
                                                <path d="M367.046 443.332C368.466 441.124 376.947 437.993 377.819 438.552C378.691 439.112 379.014 447.695 377.5 450.049C377.001 450.825 375.994 451.275 374.599 451.215C371.807 451.095 368.498 448.967 367.207 446.465C366.562 445.214 366.548 444.109 367.046 443.332Z" fill="#27DEBF"/>
                                                <path opacity="0.1" d="M367.046 443.332C368.466 441.124 376.947 437.993 377.819 438.552C378.691 439.112 379.014 447.695 377.5 450.049C377.001 450.825 375.994 451.275 374.599 451.215C371.807 451.095 368.498 448.967 367.207 446.465C366.562 445.214 366.548 444.109 367.046 443.332Z" fill="#111111"/>
                                                <path d="M366.828 356.887C370.355 351.398 375.694 347.796 381.648 346.242L381.644 346.216L381.772 346.182C388.702 344.417 396.483 345.481 403.126 349.75C411.12 354.871 414.355 365.266 413.728 374.985C413.505 378.443 417.217 380.829 420.27 379.189C428.85 374.579 439.649 373.202 447.629 378.345C454.272 382.614 458.473 389.249 459.747 396.287L459.768 396.418L459.742 396.425C460.803 402.487 459.745 408.84 456.218 414.33C445.287 431.342 418.016 437.667 397.082 439.983L375.055 442.365L368.068 421.34C361.475 401.333 355.897 373.899 366.828 356.887Z" fill="#8B4513" class="theme-color"/>
                                                <path opacity="0.1" d="M361.132 373.711C361.754 378.799 368.653 414.327 391.268 422.333C418.188 431.864 455.736 417.036 459.741 396.423C460.802 402.486 459.744 408.838 456.216 414.328C445.286 431.34 418.015 437.665 397.081 439.981L375.053 442.363L368.066 421.338C363.368 407.081 359.19 389.053 361.132 373.711Z" fill="#111111"/>
                                                <path d="M333.139 371.304C333.89 368.789 341.171 363.428 342.164 363.725C343.157 364.022 345.846 372.179 345.045 374.86C344.781 375.743 343.939 376.455 342.581 376.784C339.865 377.442 336.096 376.316 334.163 374.271C333.196 373.247 332.876 372.189 333.139 371.304Z" fill="#27DEBF"/>
                                                <path opacity="0.3" d="M333.139 371.304C333.89 368.789 341.171 363.428 342.164 363.725C343.157 364.022 345.846 372.179 345.045 374.86C344.781 375.743 343.939 376.455 342.581 376.784C339.865 377.442 336.096 376.316 334.163 374.271C333.196 373.247 332.876 372.189 333.139 371.304Z" fill="white"/>
                                                <path d="M308.958 288.306C310.824 282.055 314.955 277.113 320.245 273.969L320.234 273.945L320.346 273.877C326.515 270.258 334.285 269.123 341.852 271.383C350.953 274.085 356.943 283.177 359.035 292.689C359.779 296.073 364.006 297.336 366.485 294.914C373.45 288.106 383.444 283.788 392.537 286.517C400.105 288.777 405.98 293.987 409.155 300.395L409.212 300.514L409.189 300.528C411.889 306.058 412.634 312.456 410.767 318.709C404.981 338.083 380.534 351.722 361.062 359.752L340.559 368.147L328.016 349.883C316.138 332.494 303.171 307.683 308.958 288.306Z" fill="#455A64"/>
                                                <path opacity="0.05" d="M308.152 306.049C310.162 310.766 326.64 342.988 350.589 344.41C379.096 346.103 411.06 321.445 409.193 300.529C411.893 306.059 412.638 312.457 410.771 318.71C404.985 338.085 380.538 351.723 361.066 359.753L340.562 368.149L328.02 349.884C319.553 337.491 310.541 321.327 308.152 306.049Z" fill="#111111"/>
                                                <path d="M332.653 54.679C332.132 55.7668 331.416 56.6061 330.506 57.194C329.597 57.782 328.41 58.1654 326.951 58.3415C324.974 58.5787 323.424 58.3188 322.296 57.5619C321.171 56.8049 320.477 55.3408 320.215 53.1722C320.143 52.5715 320.102 51.7791 320.093 50.8006L320.171 46.0205L317.534 46.3698L316.684 41.2091L320.25 40.7163L320.295 38.0948L326.22 37.0879L326.194 39.8685L329.537 39.4013L330.794 44.6756L326.126 45.2692L326.103 49.4217C326.098 49.5523 326.109 49.737 326.137 49.9727C326.217 50.6387 326.465 51.1642 326.882 51.549C327.299 51.9353 327.788 52.0944 328.346 52.0276C329.246 51.9197 329.938 51.3119 330.415 50.2084L332.653 54.679Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M354.384 54.6131L347.682 55.4198L346.182 46.7783C346.035 45.9234 345.728 45.2261 345.259 44.6822C344.791 44.1397 344.139 43.9182 343.301 44.0176C341.797 44.1993 341.125 45.5996 341.289 48.2155L342.297 56.0361L335.519 56.7547L332.051 30.9297L339.046 30.9354L340.232 39.9759C341.246 38.8086 342.753 38.1042 344.751 37.8627C345.889 37.7264 347.044 37.8826 348.22 38.3285C349.399 38.7745 350.412 39.5073 351.264 40.5255C352.116 41.5466 352.653 42.7835 352.871 44.2377L354.384 54.6131Z" fill="#8B4513"class="theme-color"/>
                                                <path d="M368.649 52.8933L368.502 51.6705C367.543 52.9416 365.989 53.7042 363.844 53.9626C362.425 54.133 361.077 53.8774 359.796 53.1929C358.515 52.507 357.447 51.5087 356.592 50.1965C355.735 48.8828 355.212 47.4201 355.017 45.8097C354.826 44.2206 355.016 42.6882 355.591 41.2156C356.165 39.7401 357.004 38.5173 358.108 37.546C359.211 36.5746 360.417 36.0094 361.728 35.8518C363.875 35.5933 365.48 35.9767 366.54 37.0035L366.397 35.812L371.937 35.1445L374.771 52.1576L368.649 52.8933ZM366.948 46.6419C367.419 46.0298 367.598 45.2516 367.485 44.3058C367.374 43.3841 366.999 42.6868 366.366 42.2168C365.732 41.7495 364.964 41.5692 364.062 41.6785C363.224 41.7794 362.555 42.1429 362.053 42.7706C361.55 43.3969 361.351 44.1297 361.451 44.9676C361.51 45.4632 361.699 45.9347 362.013 46.3877C362.331 46.8379 362.737 47.1915 363.237 47.4499C363.737 47.7055 364.277 47.7979 364.857 47.7283C365.782 47.6175 366.478 47.2568 366.948 46.6419Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M386.514 42.7668C386.413 41.7344 386.145 40.9604 385.712 40.4463C385.282 39.9322 384.709 39.7164 384.001 39.8016C383.227 39.8939 382.717 40.2134 382.465 40.7545C382.216 41.297 382.156 42.115 382.289 43.2113L382.257 43.2142L383.181 51.1754L376.482 51.982L374.297 34.6622L381.116 33.482L381.271 34.7715C382.538 33.5303 383.891 32.8231 385.328 32.6484C387.541 32.3814 389.298 32.9978 390.601 34.4974C391.904 35.9956 392.729 38.1841 393.077 41.0641L394.155 49.7581L387.292 50.5846L386.514 42.7668Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M415.039 47.3071L408.319 48.5085L402.836 42.3366L403.591 48.6193L396.834 49.4969L393.703 23.5015L400.496 22.3555L402.168 36.5354L404.908 30.7782L411.73 30.4488L407.785 38.6699L415.039 47.3071Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M383.21 56.9551L380.383 74.4553C379.853 77.4802 378.901 79.7907 377.524 81.3841C376.145 82.9761 374.461 83.8949 372.463 84.1363C371.667 84.2314 370.756 84.2045 369.723 84.0553C368.691 83.9062 367.69 83.6847 366.718 83.3893L368.437 76.7758C368.668 77.0527 369.164 77.3282 369.925 77.5938C370.686 77.8622 371.271 77.9701 371.68 77.9232C372.367 77.8395 372.909 77.5838 373.302 77.155C373.698 76.7261 373.995 76.1623 374.195 75.4622L364.266 59.7612L371.183 58.8623L375.469 67.0408L376.621 58.1437L383.21 56.9551Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M390.016 73.1478C388.462 72.4534 387.163 71.428 386.115 70.0732C385.071 68.7156 384.446 67.189 384.241 65.4919C384.053 63.9255 384.297 62.4202 384.971 60.9773C385.647 59.5345 386.667 58.3288 388.032 57.356C389.397 56.3861 390.98 55.7925 392.785 55.5752C394.525 55.365 396.135 55.5638 397.611 56.1702C399.09 56.7766 400.297 57.7054 401.23 58.9537C402.166 60.2034 402.732 61.6448 402.929 63.2765C403.132 64.9722 402.909 66.601 402.257 68.1603C401.607 69.7225 400.625 71.0148 399.312 72.0444C397.995 73.074 396.513 73.6889 394.86 73.8891C393.184 74.0908 391.569 73.8437 390.016 73.1478ZM396.004 66.5755C396.494 65.9393 396.689 65.1923 396.585 64.3331C396.492 63.5591 396.134 62.9116 395.516 62.3861C394.897 61.8607 394.16 61.6505 393.299 61.7541C392.399 61.8621 391.707 62.2285 391.226 62.8533C390.746 63.4782 390.558 64.2095 390.659 65.0488C390.758 65.8853 391.133 66.5584 391.784 67.0683C392.433 67.5781 393.177 67.7826 394.013 67.6818C394.851 67.5809 395.514 67.2117 396.004 66.5755Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M417.05 71.183L416.895 69.8936C415.627 71.1348 414.276 71.842 412.836 72.0167C410.625 72.2822 408.867 71.6673 407.565 70.1691C406.263 68.6694 405.439 66.481 405.091 63.6024L404.012 54.9084L410.874 54.0805L411.652 61.8983C411.754 62.9307 412.02 63.7047 412.454 64.2173C412.888 64.7314 413.457 64.9487 414.166 64.8635C414.94 64.7697 415.451 64.4516 415.701 63.9092C415.952 63.3695 416.012 62.5487 415.878 61.4538L415.911 61.4495L414.986 53.4883L421.688 52.6816L423.871 70.0029L417.05 71.183Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M425.722 60.6947L423.16 45.1188L430.215 44.2695L432.003 59.3825L425.722 60.6947ZM427.254 67.7144C426.482 67.0796 426.036 66.2758 425.919 65.3101C425.841 64.6668 425.949 64.0491 426.236 63.4597C426.524 62.8703 426.941 62.3832 427.483 61.9998C428.026 61.6192 428.618 61.3906 429.262 61.3125C430.207 61.1989 431.045 61.4133 431.776 61.9572C432.505 62.504 432.933 63.2992 433.061 64.353C433.185 65.384 432.952 66.3014 432.363 67.0995C431.772 67.9004 430.972 68.3634 429.963 68.4841C428.93 68.6091 428.027 68.3506 427.254 67.7144Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M435.933 59.4642L433.371 43.8897L440.425 43.0391L442.214 58.152L435.933 59.4642ZM437.465 66.4853C436.693 65.8505 436.247 65.0468 436.13 64.0811C436.052 63.4377 436.159 62.8214 436.447 62.2321C436.735 61.6413 437.15 61.1542 437.693 60.7722C438.235 60.3916 438.829 60.1615 439.473 60.0834C440.419 59.9698 441.256 60.1857 441.986 60.7296C442.715 61.2749 443.144 62.0702 443.272 63.1239C443.396 64.1549 443.163 65.0709 442.573 65.8718C441.983 66.6714 441.183 67.1343 440.173 67.255C439.141 67.3786 438.239 67.1216 437.465 66.4853Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M446.143 58.2324L443.582 42.6578L450.636 41.8086L452.424 56.9216L446.143 58.2324ZM447.676 65.2549C446.902 64.6187 446.456 63.8163 446.34 62.8492C446.262 62.2059 446.368 61.5881 446.658 60.9988C446.948 60.4094 447.361 59.9209 447.903 59.5403C448.446 59.1597 449.04 58.9282 449.684 58.8515C450.63 58.7365 451.465 58.9524 452.197 59.4963C452.926 60.043 453.355 60.8397 453.483 61.892C453.607 62.923 453.374 63.839 452.783 64.6385C452.194 65.4395 451.394 65.901 450.383 66.0232C449.352 66.1496 448.449 65.8925 447.676 65.2549Z" fill="#8B4513" class="theme-color"/>
                                                <path d="M296.603 89.0238C297.482 90.2664 299.438 90.647 300.852 91.0035C301.861 91.2577 302.877 91.4764 303.901 91.661C305.804 92.0032 307.741 92.2404 309.674 92.3057C313.402 92.4321 317.164 92.0387 320.799 91.2094C324.105 90.4567 327.37 89.3902 330.351 87.7585C333.25 86.1722 335.927 84.1514 338.291 81.8465C340.928 79.2732 343.676 76.2782 344.936 72.7648C345.142 72.1911 344.944 71.667 344.439 71.3163C344.034 71.0365 343.205 70.7979 342.814 71.2623C340.531 73.979 338.547 76.9357 336.023 79.4493C333.847 81.6164 331.425 83.5279 328.742 85.0262C323.201 88.1206 316.55 89.5251 310.232 89.4811C308.245 89.4669 306.27 89.359 304.3 89.0849C303.322 88.9485 302.348 88.7767 301.381 88.5722C299.966 88.274 298.491 87.7443 297.039 87.8252C296.44 87.8579 296.302 88.5978 296.603 89.0238Z" fill="#27DEBF"/>
                                                <path d="M409.298 17.9284C408.59 17.8333 408.063 17.2084 408.104 16.4828L408.953 1.30445C408.996 0.543265 409.647 -0.0404122 410.409 0.00219164C411.195 0.0433753 411.754 0.696636 411.711 1.45782L410.862 16.6361C410.819 17.3973 410.167 17.981 409.406 17.9384C409.369 17.937 409.332 17.9341 409.298 17.9284Z" fill="#27DEBF"/>
                                                <path d="M417.588 20.5989C417.389 20.5719 417.191 20.5009 417.011 20.383C416.375 19.9626 416.199 19.1063 416.619 18.4701L424.992 5.78125C425.413 5.14788 426.268 4.97037 426.905 5.3893C427.541 5.80966 427.717 6.666 427.297 7.30221L418.924 19.991C418.623 20.4469 418.098 20.667 417.588 20.5989Z" fill="#27DEBF"/>
                                                <path d="M422.977 26.5494C422.472 26.4812 422.024 26.1375 421.851 25.6234C421.605 24.8992 421.994 24.1153 422.716 23.8724L437.117 19.0028C437.843 18.7585 438.624 19.1462 438.868 19.8677C439.113 20.5905 438.725 21.3758 438.004 21.6187L423.601 26.4883C423.393 26.5593 423.18 26.5763 422.977 26.5494Z" fill="#27DEBF"/>
                                                <path d="M381.668 106.726C381.09 106.727 380.552 106.364 380.357 105.789L375.483 91.3887C375.239 90.6659 375.627 89.8819 376.348 89.6377C377.078 89.3877 377.858 89.7825 378.101 90.5025L382.974 104.903C383.219 105.625 382.831 106.409 382.11 106.654C381.962 106.702 381.814 106.725 381.668 106.726Z" fill="#27DEBF"/>
                                                <path d="M365.069 107.836C364.977 107.836 364.883 107.828 364.789 107.808C364.042 107.656 363.56 106.927 363.712 106.179L366.746 91.2832C366.897 90.5362 367.633 90.0547 368.375 90.2053C369.122 90.3572 369.605 91.0872 369.453 91.8342L366.418 106.731C366.286 107.386 365.711 107.836 365.069 107.836Z" fill="#27DEBF"/>
                                                <path d="M349.34 99.3189C348.951 99.3189 348.563 99.1556 348.289 98.836C347.793 98.2566 347.86 97.3847 348.44 96.889L359.987 86.9993C360.566 86.5065 361.435 86.569 361.934 87.1498C362.429 87.7292 362.362 88.6012 361.783 89.0968L350.236 98.9866C349.978 99.2081 349.659 99.3174 349.34 99.3189Z" fill="#27DEBF"/>
                                                <path d="M196.411 33.2186C194.15 30.8952 191.415 29.3288 188.075 28.518C177.895 26.0441 166.416 30.2676 160.267 38.7485C154.731 46.386 153.639 56.4206 154.415 65.8218C155.19 75.2231 157.626 84.4269 158.4 93.8281C159.087 102.171 150.328 109.009 144.484 113.679C143.417 114.531 142.223 115.798 142.743 117.06C143.081 117.881 144.014 118.261 144.864 118.514C154.541 121.387 165.779 117.976 172.226 110.209C172.29 112.548 172.354 114.889 172.416 117.228C176.232 116.755 179.52 114.061 181.474 110.749C183.428 107.437 184.21 103.565 184.585 99.7373C185.835 86.976 181.974 74.8325 181.656 62.2445C181.296 48.0845 186.142 37.4974 195.114 39.1121C198.77 39.7696 200.533 38.5242 198.17 35.3062C197.619 34.5535 197.033 33.8576 196.411 33.2186Z" fill="#263238"/>
                                                <path d="M193.548 35.7561C193.075 35.1242 190.145 20.3605 196.737 12.3098C203.33 4.26057 206.653 10.3529 206.032 17.4734C205.411 24.5954 200.492 32.4416 193.548 35.7561Z" fill="#27DEBF"/>
                                                <path d="M195.633 35.4315C194.94 35.8107 179.908 36.6003 172.882 28.9259C165.857 21.2516 172.363 18.8331 179.321 20.4634C186.28 22.0937 193.344 28.0838 195.633 35.4315Z" fill="#27DEBF"/>
                                                <path d="M326.638 168.506C321.283 163.15 308.581 148.009 305.93 144.405C302.59 139.866 293.43 128.951 287.896 124.845C282.362 120.74 270.762 118.697 261.44 119.373C260.702 130.669 270.993 148.539 270.993 148.539L294.326 171.897C307.992 184.101 324.715 191.107 343.776 194.132C341.991 188.874 331.995 173.861 326.638 168.506Z" fill="#FFA8A7"/>
                                                <path d="M294.324 171.896C297.045 172.412 306.045 171.823 312.161 172.974C318.277 174.128 329.414 178.821 335.281 186.889L294.324 171.896Z" fill="#F28F8F"/>
                                                <path d="M261.441 119.373C264.625 119.249 278.472 117.211 286.944 123.469C294.681 129.182 300.488 137.289 306.702 144.921C309.801 148.727 314.553 154.951 314.553 154.951C314.553 154.951 308.235 165.396 292.71 173.039L265.787 147.163L261.441 119.373Z" fill="#37474F"/>
                                                <path d="M253.06 522.723C252.506 522.879 252.076 523.224 251.89 523.856C251.175 526.282 251.202 529.049 250.708 531.539C249.936 535.436 249.105 541.045 249.742 544.174C250.381 547.302 254.609 550.343 262.543 552.592C267.325 553.949 275.857 558.078 279.761 561.627C284.543 565.974 294.769 569.603 301.681 569.811C309.784 570.056 318.234 567.893 320.189 562.056C321.01 559.603 321.65 555.4 310.068 550.848C304.032 548.477 301.664 547.243 298.762 545.534C293.386 542.367 285.304 538.171 280.837 534.003C279.182 532.456 274.161 526.343 274.245 518.57C271.158 517.527 267.555 518.166 265.016 520.211C262.477 522.256 261.084 525.638 261.446 528.878C260.895 529.182 260.204 528.659 260.01 528.061C259.814 527.462 259.913 526.809 259.811 526.188C259.59 524.842 258.426 523.804 257.144 523.335C256.028 522.923 254.257 522.385 253.06 522.723Z" fill="#37474F"/>
                                                <path d="M142.151 522.98C143.021 524.797 142.906 526.615 143.147 528.551C143.349 530.161 143.814 531.601 143.806 533.291C143.799 534.696 144.135 536.38 145.446 536.887C146.474 537.285 147.652 536.719 148.401 535.911C149.151 535.103 149.614 534.075 150.265 533.185C151.635 531.307 153.873 530.092 156.194 529.964C158.514 529.836 158.677 530.051 160.245 531.767C160.058 532.209 159.088 534.517 158.912 534.964C154.431 546.381 154.164 556.499 156.948 568.327C157.516 570.741 161.002 574.669 162.918 576.584C164.053 577.717 165.241 578.789 166.509 579.773C167.633 580.645 168.75 581.681 168.884 582.646C169.07 583.993 168.855 585.4 168.197 586.589C167.231 588.333 165.62 589.162 163.807 589.788C156.948 592.155 149.493 592.092 142.871 589.108C139.58 587.624 136.491 584.35 135.795 583.135C131.914 576.361 132.348 569.911 132.297 564.081C132.185 551.202 130.059 544.546 129.025 538.106C127.774 530.308 139.712 521.81 142.151 522.98Z" fill="#37474F"/>
                                                <path d="M279.59 529.983C274.818 524.826 273.903 519.852 274.558 510.286C275.213 500.72 279.992 416.096 281.944 395.22C285.225 360.154 286.879 261.572 283.969 237.242L190.46 244.601C183.666 261.58 178.675 282.486 179.729 315.291C180.533 340.311 179.946 408.173 179.946 408.173C179.946 408.173 168.536 418.145 160.384 437.839C153.181 455.24 144.889 515.357 144.889 515.357C143.617 519.345 142.59 522.384 142.15 522.979C140.183 525.647 138.781 528.504 138.781 531.752C138.783 542.138 139.889 552.523 142.077 562.674C143.209 567.93 146.491 571.313 151.734 573.399C152.896 573.862 154.154 574.098 155.401 574.005C156.037 573.957 156.72 573.804 157.175 573.346C158.059 572.457 157.253 570.354 157.085 569.299C156.814 567.599 156.666 565.882 156.617 564.162C156.517 560.784 156.622 556.661 156.845 553.293C157.429 544.474 158.716 537.319 160.479 530.889C160.481 530.886 161.201 529.168 162.297 526.557C162.297 526.557 202.884 444.718 214.411 424.771C223.578 409.117 229.667 348.353 236.165 315.132L247.137 394.533C247.137 394.533 242.323 408.876 241.056 419.846C239.355 434.579 249.757 492.31 252.869 512.838C253.447 516.649 253.491 520.512 253.003 524.336C254.101 533.232 260.777 535.974 267.68 541.013C271.114 543.518 286.209 552.688 295.325 554.537C302.739 556.041 308.428 551.599 303.871 548.743C295.224 542.885 284.361 535.139 279.59 529.983Z" fill="#FFA8A7"/>
                                                <path d="M232.355 340.37C233.299 331.442 235.877 319.233 235.877 319.233L240.052 353.647L243.404 393.16C243.404 393.16 241.884 399.048 240.471 409.212C238.996 419.834 239.696 436.903 241.637 448.309C243.578 459.716 247.617 480.181 247.617 480.181C264.573 489.034 277.43 479.964 277.43 479.964C277.43 479.964 279.081 457.147 282.241 423.693C285.402 390.239 286.503 356.798 286.735 329.006C286.735 329.006 290.752 259.698 279.046 212.939C265.289 222.623 224.418 224.561 207.919 211.549C207.919 211.549 201.307 222.48 186.875 246.869C175.544 266.019 178.872 296.782 178.674 322.499C178.37 362.174 178.583 406.978 178.583 406.978C178.583 406.978 171.816 414.111 164.585 425.765C157.354 437.418 153.645 463.3 153.645 463.3C153.645 463.3 160.945 478.828 185.876 479.493C185.876 479.493 210.095 435.396 216.183 425.389C222.274 415.381 231.409 349.3 232.355 340.37Z" fill="#27DEBF"/>
                                                <path opacity="0.15" d="M235.879 319.233L244.982 284.216C244.982 284.216 262.415 282.357 275.985 272.385C275.985 272.385 273.184 285.194 249.187 288.96L238.853 323.335L240.056 353.647L235.879 319.233Z" fill="#111111"/>
                                                <path d="M284.152 147.082C272.743 132.18 268.99 127.024 261.442 119.372L220.027 117.59C216.794 117.868 198.273 120.859 198.273 120.859C193.641 122.903 188.555 133.907 189.781 142.627C191.06 151.724 192.107 160.749 194.375 171.895C196.644 183.042 200.204 191.706 201.003 195.282C202.604 202.457 203.36 209.917 199.594 217.1C191.746 232.07 185.327 241.754 182.707 254.33C182.707 254.33 188.747 253.051 194.554 247.489C199.609 242.646 202.656 240.4 206.704 234.691C206.704 234.691 207.106 243.207 215.572 254.372C217.585 257.045 220.024 259.705 222.968 262.164C238.156 274.893 283.861 280.413 285.357 240.551C285.357 240.551 280.88 222.371 279.993 211.548C279.105 200.725 278.935 194.21 279.03 191.418C297.634 178.144 291.561 156.76 284.152 147.082Z" fill="#455A64"/>
                                                <path d="M112.777 182.042C117.793 173.336 124.286 171.124 132.547 164.928C140.809 158.732 157.812 145.162 168.282 138.048C180.164 129.973 189.504 122.733 198.363 122.798C198.363 122.798 199.804 122.523 202.308 129.577C204.811 136.63 204.553 153.872 198.838 158.452C193.122 163.032 146.768 188.742 146.768 188.742L112.777 182.042Z" fill="#FFA8A7"/>
                                                <path d="M169.012 176.253L165.659 169.619C162.506 171.772 157.352 173.722 148.971 174.208C140.588 174.695 125.608 174.352 117.295 179.33C116.16 180.009 115.747 181.17 115.846 182.647L146.767 188.743C146.767 188.743 157.342 182.877 169.012 176.253Z" fill="#F28F8F"/>
                                                <path d="M198.276 120.86C193.201 120.806 186.15 123.974 180.05 128.473C172.522 134.026 152.723 149.237 152.723 149.237C152.723 149.237 156.732 170.538 170.457 175.971C170.457 175.971 196.139 161.721 198.189 160.223C200.24 158.725 203.792 155.258 204.445 143.213C205.1 131.17 201.013 125.576 198.276 120.86Z" fill="#37474F"/>
                                                <path d="M254.02 185.013C254.02 185.013 242.77 194.959 228.951 191.034C222.272 189.137 218.183 185.426 215.742 182.099C215.055 181.162 213.612 182.002 214.068 183.07C216.012 187.63 220.224 192.946 229.341 195.136C246.114 199.166 254.02 185.013 254.02 185.013Z" fill="#37474F"/>
                                                <path d="M209.967 22.21C224.129 16.6062 234.527 17.6713 241.571 19.2377C270.921 5.97941 295 45.2331 268.728 64.7229C268.728 64.7229 267.501 95.2841 244.258 102.602L218.754 107.932C214.884 97.3219 192.558 93.8682 186.572 70.2103C179.521 47.8078 194.842 28.1944 209.967 22.21Z" fill="#263238"/>
                                                <path d="M255.157 33.2559C260.423 35.3562 268.269 46.5596 271.635 72.0793C274.486 93.7078 268.329 100.118 265.06 102.199C261.79 104.279 254.88 104.397 248.133 104.323L250.165 119.257C250.165 119.257 257.084 123.445 258.496 130.723C259.645 136.642 243.628 140.402 232.691 133.808C223.771 128.431 220.529 121.392 220.529 121.392L216.432 90.3123C216.432 90.3123 212.924 94.8382 206.43 91.5265C199.471 87.9776 197.993 79.9084 201.547 74.9678C205.102 70.0244 213.489 71.0128 216.106 76.6705C216.106 76.6705 225.349 74.6355 237.516 64.0513C250.699 52.5824 252.815 42.8872 255.157 33.2559Z" fill="#FFA8A7"/>
                                                <path d="M242.764 70.4921C243.084 72.0329 242.139 73.5283 240.657 73.8322C239.171 74.1361 237.71 73.1321 237.39 71.5912C237.071 70.0504 238.015 68.555 239.499 68.2511C240.983 67.9486 242.444 68.9512 242.764 70.4921Z" fill="#263238"/>
                                                <path d="M245.114 85.291L255.849 87.3672C255.341 90.429 252.526 92.447 249.561 91.8733C246.596 91.301 244.606 88.3528 245.114 85.291Z" fill="#B16668"/>
                                                <path d="M249.557 91.8731C250.47 92.0492 251.36 91.9555 252.182 91.6857C251.915 89.3978 250.004 87.6113 247.644 87.6113C246.824 87.6113 246.064 87.8428 245.398 88.2206C246.056 90.044 247.578 91.4911 249.557 91.8731Z" fill="#F28F8F"/>
                                                <path d="M265.242 59.0043L259.168 56.0561C259.925 54.3349 261.899 53.5993 263.576 54.4145C265.255 55.2268 266 57.2831 265.242 59.0043Z" fill="#263238"/>
                                                <path d="M264.965 65.5624C265.284 67.1032 264.34 68.5986 262.856 68.9011C261.372 69.205 259.91 68.201 259.589 66.6601C259.27 65.1193 260.214 63.6253 261.698 63.3214C263.184 63.0189 264.645 64.0215 264.965 65.5624Z" fill="#263238"/>
                                                <path d="M251.75 65.1602L254.718 81.4064L262.891 77.4116L251.75 65.1602Z" fill="#F28F8F"/>
                                                <path d="M248.133 104.321C241.061 104.49 226.165 102.61 223.066 97.3184C223.066 97.3184 224.357 100.745 229.184 103.734C234.011 106.724 248.72 108.635 248.72 108.635L248.133 104.321Z" fill="#F28F8F"/>
                                                <path d="M343.779 194.132C331.784 183.978 328.075 178.146 294.329 171.897C294.329 171.897 275.762 166.184 273.458 164.578C271.155 162.972 266.48 162.793 263.087 161.543C259.696 160.293 247.378 155.83 244.154 153.688C240.93 151.545 239.523 150.118 233.989 149.76C228.455 149.404 220.956 148.511 219.171 148.689C217.386 148.868 215.779 152.795 213.993 155.83C212.208 158.865 211.309 159.285 212.697 165.312C213.613 169.288 214.885 169.754 214.885 169.754C215.854 170.166 217.193 168.326 217.193 168.326C219.144 168.861 219.414 166.673 219.414 166.673C220.931 166.621 223.811 161.721 223.811 161.721L226.719 161.006C229.271 161.721 234.632 166.14 232.85 170.231C231.14 174.155 224.632 175.876 220.807 178.734C216.981 181.59 216.493 187.784 218.278 188.677C219.305 189.191 220.56 187.127 223.899 184.817C226.363 183.113 230.51 181.266 233.722 180.28C241.288 177.957 247.733 179.573 254.16 179.216C260.586 178.86 262.55 176.361 284.305 189.938C293.258 195.527 300.9 200.487 308.254 203.167C318.77 206.998 328.045 207.287 334.138 207.602C344.493 208.137 345.564 199.389 343.779 194.132Z" fill="#FFA8A7"/>
                                                <path d="M258.763 174.478C255.765 173.866 253.196 172.397 250.566 170.501C247.936 168.605 245.06 164.995 242.98 163.098C240.899 161.202 237.964 163.037 236.268 163.098C234.573 163.159 233.62 161.691 233.62 161.691C236.312 161.14 236.268 159.549 236.268 159.549C235.063 160.161 232.274 160.528 231.142 159.916C230.01 159.304 229.949 157.469 229.949 157.469C229.827 158.998 228.297 159.793 226.339 160.038C224.382 160.282 223.812 159.365 223.812 159.365C224.099 160.711 223.812 161.721 223.812 161.721L226.721 161.006C227.05 161.099 227.41 161.245 227.782 161.437C230.494 162.813 234.412 166.648 232.85 170.231C232.249 171.609 231.052 172.712 229.592 173.691L229.595 173.695C236.589 171.674 237.893 167.141 239.663 166.457C240.916 165.971 242.618 166.322 246.35 169.442C250.083 172.565 255.033 174.539 258.763 174.478Z" fill="#F28F8F"/>
                                                <path d="M234.84 154.39C231.879 154.344 227.788 154.484 226.614 154.72C225.439 154.954 221.16 157.963 220.408 158.433C219.655 158.904 219.299 161.856 218.671 163.752C218.076 165.548 218.314 166.017 219.113 166.564C219.113 166.564 217.326 166.325 218.137 163.564C218.924 160.886 219.185 158.196 220.078 157.468C220.971 156.741 225.578 154.108 226.472 153.92C227.366 153.733 234.84 154.39 234.84 154.39Z" fill="#F28F8F"/>
                                                <path d="M223.813 149.365C222.256 149.112 221.789 149.869 220.6 151.236C219.412 152.604 215.92 157.573 215.596 158.328C215.272 159.084 215.523 160.561 215.596 161.893C215.668 163.225 215.768 166.336 217.193 168.327C217.193 168.327 216.516 168.225 215.768 166.338C215.019 164.449 214.984 161.137 214.839 159.932C214.695 158.726 214.803 158.375 215.955 156.697C217.107 155.018 219.52 151.598 220.671 150.447C221.824 149.292 222.236 148.896 223.813 149.365Z" fill="#F28F8F"/>
                                                <path d="M265.09 179.824C264.171 178.891 263.593 176.657 263.639 174.478C263.691 171.898 263.429 171.323 262.953 173.327C262.479 175.329 260.005 178.818 257.941 178.871C259.896 178.719 261.94 178.784 265.09 179.824Z" fill="#F28F8F"/>
                                                <path d="M112.776 182.043C107.76 190.749 106.151 197.535 109.383 201.223C111.878 204.071 116.461 203.694 122.957 204.027C129.19 204.345 140.72 202.957 148.776 198.42C160.528 191.802 166.697 188.241 176.312 187.38C185.451 186.562 189.47 184.364 194.514 183.915C200.445 183.387 206.713 183.22 210.809 185.309C214.904 187.398 215.296 188.326 216.215 188.745C216.643 188.939 217.265 188.493 217.39 187.163C217.51 185.875 217.162 184.18 216.361 182.723C214.759 179.809 210.057 177.956 205.043 177.036C200.029 176.117 196.352 173.609 195.599 170.601C194.846 167.593 195.849 164.063 196.352 163.613C196.352 163.613 198.029 164.115 199.336 164.316C201.081 164.584 203.506 164.607 203.506 164.607C203.506 164.607 205.445 167.164 206.902 168.171C208.102 169.002 209.222 169.347 209.808 168.846C209.808 168.846 210.966 170.779 212.574 170.963C214.181 171.149 214.491 170.346 214.491 170.346C214.491 170.346 213.961 167.268 213.811 165.974C213.66 164.681 213.674 162.685 213.488 161.697C213.302 160.709 212.45 160.048 210.04 157.471C207.629 154.892 206.517 152.543 205.343 152.296C204.168 152.049 202.004 152.543 202.004 152.543C202.004 152.543 201.525 152.357 199.601 152.543C197.677 152.729 194.996 153.044 191.917 153.257C188.838 153.47 185.252 153.347 184.386 154.212C183.521 155.076 182.16 157.18 180.243 159.405C178.328 161.63 173.982 165.756 171.589 167.812C169.764 169.38 168.134 170.475 166.755 171.429C165.376 172.383 162.882 173.694 161.124 174.21C157.692 175.215 152.606 175.421 146.024 175.975C134.829 176.914 117.396 176.729 112.776 182.043Z" fill="#FFA8A7"/>
                                                <path d="M202.293 176.31C198.722 175.106 196.2 173.024 195.595 170.6C194.843 167.592 195.846 164.062 196.347 163.611C196.347 163.611 195.542 164.732 193.242 164.969C190.941 165.208 188.006 163.611 188.006 163.611C188.006 163.611 188.72 165.31 191.655 165.973C191.655 165.973 189.196 167.319 185.864 168.326C182.532 169.333 181.896 172.615 180.708 175.972C179.517 179.329 179.199 182.742 175.312 184.804C175.312 184.804 179.121 184.216 182.691 179.393C186.262 174.569 188.642 173.221 192.292 173.142C195.941 173.062 198.282 175.881 202.308 176.336L202.293 176.31Z" fill="#F28F8F"/>
                                                <path d="M209.806 168.846C210.623 168.111 210.978 167.883 209.961 166.565C208.944 165.247 207.481 163.307 206.741 162.475C206.002 161.643 205.032 161.12 203.229 160.227C201.427 159.334 200.689 158.594 198.84 158.456C198.84 158.456 200.642 158.317 201.889 158.964C203.136 159.611 206.094 161.183 206.832 161.644C207.571 162.106 209.286 164.615 209.795 165.355C210.303 166.093 211.314 167.373 211.176 167.836C211.039 168.296 209.806 168.846 209.806 168.846Z" fill="#F28F8F"/>
                                                <path d="M209.801 168.846C210.126 169.305 211.893 169.965 212.829 169.413C213.797 168.84 213.715 168.402 213.137 167.081C212.555 165.749 212.082 163.918 211.721 162.617C211.36 161.317 211.184 160.226 209.987 159.294C207.782 157.577 202.639 153.269 201.996 152.543C201.996 152.543 207.114 156.374 208.023 156.982C209.589 158.03 211.613 159.402 211.866 160.415C212.119 161.426 213.174 165.446 213.383 165.975C213.944 167.39 214.272 168.47 214.084 168.846C213.732 169.556 212.61 171.127 209.801 168.846Z" fill="#F28F8F"/>
                                                <path d="M175.826 187.433L175.831 187.426C172.872 187.195 171.374 184.966 170.077 184.238C168.781 183.509 170.239 185.535 170.077 186.79C169.915 188.045 168.883 188.737 168.883 188.737L168.887 188.744C171.077 188.121 173.335 187.685 175.812 187.435C175.816 187.435 175.82 187.435 175.826 187.433Z" fill="#F28F8F"/>
                                            </svg>
                                            @else
                                                <img id="svg_text_preview"
                                                    src="{{ isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text : '' }}">
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
