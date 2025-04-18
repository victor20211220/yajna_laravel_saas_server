@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme19">
@else
<div class="{{ $business->theme_color }}" id="view_theme19">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="event-management">
                <section class="profile-sec text-center">
                    <div class="profile-banner">
                            <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme9/images/profile-banner-img.png') }}" alt="profile-banner-img" id="banner_preview"  class="profile-banner-img" loading="lazy">
                        <div class="profile-content">
                            <p id="{{ $stringid . '_desc' }}_preview">
                                {!! nl2br(e($business->description)) !!}</p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="client-info-wrp">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme9/images/client-image.png') }}"   alt="client-image" loading="lazy">
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
                <section class="gallery-sec pt pb mb" id="gallery-div">
                    <div class="container">
                        <div class="section-title text-center">
                        <h2>{{__('Gallery')}}</h2>
                        </div>
                    @php $image_count = 0; @endphp
                        @if (isset($is_pdf))
                          <div class="gallery-card edit-card">
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
                        <div class="slider-wrapper">
                            <div class="gallery-slider"  id="inputrow_gallery_preview">
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
                                                        <img src="{{ isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png') }}" alt="images" class="imageresource">
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
                            </div>
                            <div class="arrow-wrapper">
                                <div class="slick-prev slick-arrow gallery-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow gallery-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                @endif
                @if ($order_key == 'service')
                <section class="service-sec pb" id="services-div">
                    <div class="container">
                        <div class="section-title text-center">
                            <h2>{{ __('Services') }}</h2>
                        </div>
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
                                                </a>
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
                        <div class="slider-wrapper">
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
                                                    </a>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow service-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                @endif
                @if ($order_key == 'bussiness_hour')
                <section class="business-hour-sec light-bg-section pt pb mb" id="business-hours-div">
                    <div class="business-hours text-center">
                        <div class="container">
                            <div class="section-title common-title">
                                <h2>{{ __('Business Hours') }}</h2>
                            </div>
                        </div>
                        <div class="hours-list-wrp">
                            <div class="container">
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
                            </div>
                        </div>
                    </div>
                </section>
                @endif
                @if ($order_key == 'contact_info')
                <section class="contact-info-sec pt pb mb" id="contact-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{__('Contact')}}</h2>
                        </div>
                        <ul class="contact-list" id="inputrow_contact_preview">
                            @if (!is_null($contactinfo_content) && !is_null($contactinfo))
                                @foreach ($contactinfo_content as $key => $val)
                                    @foreach ($val as $key1 => $val1)
                                        @php
                                            if ($key1 == 'Phone') {
                                                $href = 'tel:' . $val1;
                                                $label = 'Phone';
                                            } elseif ($key1 == 'Email') {
                                                $href = 'mailto:' . $val1;
                                                $label = 'Email';
                                            } elseif ($key1 == 'Address') {
                                                $label = 'Address'; // Store the label for address
                                            }elseif ($key1 == 'Web_url') {
                                                $label = 'Web Url'; // Store the label for web url
                                            } else {
                                                $href = $val1;
                                                $label = ucfirst($key1);
                                            }
                                        @endphp
                                        @if ($key1 != 'id')
                                            <li id="contact_{{ $loop->parent->index + 1 }}" >
                                                @if ($key1 == 'Address')
                                                    @foreach ($val1 as $key2 => $val2)
                                                        @if ($key2 == 'Address_url')
                                                            @php $href = $val2; @endphp
                                                        @endif
                                                    @endforeach
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme9/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                    <div class="contact-content text-center">
                                                        <span>{{ $label }}</span>
                                                        <a href="{{ $href }}" target="_blank" class="contact-item">
                                                            @foreach ($val1 as $key2 => $val2)
                                                                @if ($key2 == 'Address')
                                                                    <span id="{{ $key1 . '_' . $nos }}_preview">
                                                                        {{ $val2 }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme9/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                    <div class="contact-content text-center">
                                                        <span>{{ $label }}</span>
                                                        @if ($key1 == 'Whatsapp')
                                                            <a href="https://wa.me/{{ $href }}" target="_blank" class="contact-item">
                                                        @else
                                                            <a href="{{ $href }}" class="contact-item">
                                                        @endif
                                                            <span id="{{ $key1 . '_' . $nos }}_preview">
                                                                {{ $val1 }}
                                                            </span>
                                                        </a>
                                                    </div>
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
                @if($order_key=='product')
                <section class="product-sec pb" id="product-div">
                    <div class="container">
                        <div class="section-title text-center">
                            <h2>{{ __('Product') }}</h2>
                        </div>
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
                                                <h3  id="{{ 'product_title_' . $product_row_nos . '_preview' }}">
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
                                                        class="btn">{{ $content->link_title }}</a>
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
                        <div class="slider-wrapper">
                            <div class="product-sec-slider" id="inputrow_product_preview">
                                @php $pr_image_count = 0; @endphp
                                @foreach ($products_content as $k1 => $content)
                                    <div class="product-card " id="product_{{ $product_row_nos }}">
                                        <div class="product-card-inner">
                                            <div class="product-card-image">
                                                <div class="img-wrapper">
                                                    <img src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="product-image" loading="lazy">
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-content-top">
                                                    <h3  id="{{ 'product_title_' . $product_row_nos . '_preview' }}">
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
                                                            class="btn">{{ $content->link_title }}</a>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow product-sec-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                @endif
                @if ($order_key == 'appointment')
                <section class="appointment-sec  pb" id="appointment-div">
                    <div class="container">
                        <div class="appointment-wrp">
                            <div class="section-title text-center">
                                <h2>{{__('Appointment')}}</h2>
                            </div>
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
                                    <button type="button" class="btn appointment-btn">{{__('Make An Appointment')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </section>

                @endif
                @if ($order_key == 'more')
                <section class="more-info-sec pb">
                    <div class="container">
                        <div class="section-title text-center">
                            <h2>{{__('More')}}</h2>
                        </div>
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}"
                                    class="save-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.545 5.28945C14.5941 5.02654 14.6189 4.75968 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C8.22526 0.00227634 6.53772 1.18703 5.89324 2.96474C4.73932 2.5054 3.4315 3.06844 2.97212 4.22236C2.93236 4.32224 2.89981 4.42482 2.87475 4.52935C1.03224 4.8049 -0.237997 6.52193 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7395 6.87066 15.3023 5.92967 14.545 5.28945Z" fill="#111111"/>
                                        <path d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659L8.99889 13.8173V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V13.8173L6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z" fill="#111111"/>
                                    </svg>
                                    <h3>{{__('Save')}}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="share-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.28377 9.4228C6.04018 9.32536 5.89402 9.03304 5.99146 8.78945C7.30688 5.28165 10.3275 2.74824 13.9814 2.11489L11.8865 0.945621C11.6429 0.799463 11.5455 0.507147 11.6916 0.26355C11.8378 0.0199526 12.1301 -0.0774863 12.3737 0.0686719L15.5405 1.82257C15.7841 1.96873 15.8815 2.26105 15.7353 2.50464L14.0302 5.57397C13.9327 5.72012 13.7866 5.81756 13.5917 5.81756C13.4942 5.81756 13.3968 5.81756 13.3481 5.76884C13.1045 5.62268 13.0071 5.33037 13.1532 5.08677L14.3225 3.04056C10.9608 3.57647 8.13511 5.915 6.91713 9.08176C6.81969 9.27664 6.62481 9.4228 6.42993 9.4228H6.28377ZM14.8107 7.9125C14.8107 7.62019 15.0056 7.42531 15.2979 7.42531C15.5902 7.42531 15.7851 7.66891 15.7851 7.9125V11.7126C15.7851 14.0999 13.885 15.9999 11.4978 15.9999H4.2873C1.94877 15.9999 -3.22908e-06 14.0999 -3.22908e-06 11.7126V4.50214C-3.22908e-06 2.16361 1.90005 0.214836 4.2873 0.214836H7.94126C8.23358 0.214836 8.42846 0.409714 8.42846 0.70203C8.42846 0.994347 8.23358 1.18922 7.94126 1.18922H4.2873C2.48469 1.18922 0.974385 2.65081 0.974385 4.50214V11.7126C0.974385 13.564 2.43597 15.0255 4.2873 15.0255H11.4978C13.3004 15.0255 14.8107 13.564 14.8107 11.7126V7.9125Z" fill="#111111"/>
                                    </svg>
                                    <h3>{{__('Share')}}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M13.4595 2.09597C12.1078 0.744271 10.3106 -7.56008e-05 8.39908 5.7592e-09C8.08584 5.7592e-09 7.83203 0.253887 7.83203 0.567049C7.83203 0.880212 8.08592 1.1341 8.39908 1.1341C10.0077 1.13402 11.52 1.76042 12.6575 2.89792C13.7951 4.03543 14.4215 5.54786 14.4214 7.15654C14.4214 7.4697 14.6753 7.72359 14.9885 7.72359C15.3017 7.72359 15.5555 7.4697 15.5555 7.15662C15.5556 5.2449 14.8113 3.44766 13.4595 2.09597Z" fill="#111111"/>
                                        <path d="M11.1269 7.15651C11.1269 7.46967 11.3808 7.72356 11.694 7.72348C12.0072 7.72348 12.261 7.4696 12.261 7.15643C12.2608 5.02735 10.5284 3.29498 8.39916 3.29468C8.39908 3.29468 8.39923 3.29468 8.39916 3.29468C8.08599 3.29468 7.83211 3.54849 7.83203 3.86165C7.83203 4.17481 8.08584 4.4287 8.399 4.42878C9.90305 4.429 11.1267 5.65262 11.1269 7.15651Z" fill="#111111"/>
                                        <path d="M9.87051 10.0477C9.00618 10.0029 8.56585 10.6457 8.35468 10.9545C8.17783 11.213 8.24406 11.5659 8.50256 11.7427C8.76106 11.9195 9.11392 11.8533 9.29076 11.5948C9.54026 11.23 9.6533 11.1726 9.80663 11.1799C10.2974 11.2376 12.2303 12.654 12.4238 13.0969C12.4724 13.2273 12.4705 13.3552 12.4185 13.5107C12.2155 14.113 11.8796 14.5362 11.4468 14.7346C11.0357 14.9231 10.5316 14.906 9.98944 14.6854C7.96492 13.8602 6.19619 12.7086 4.73244 11.2626C4.73184 11.262 4.73123 11.2615 4.7307 11.2609C3.28768 9.79855 2.13823 8.03207 1.31442 6.01066C1.09372 5.46803 1.07664 4.96388 1.26512 4.55281C1.46352 4.12004 1.88676 3.78412 2.48851 3.58142C2.64457 3.5291 2.77219 3.52744 2.9014 3.57552C3.34589 3.76975 4.76223 5.70256 4.81939 6.1878C4.82756 6.34688 4.76972 6.45984 4.40522 6.70888C4.14664 6.8855 4.08018 7.23836 4.25688 7.49693C4.43349 7.75551 4.78627 7.82189 5.04492 7.64527C5.35385 7.43433 5.99651 6.99521 5.9519 6.12792C5.90276 5.22201 4.14052 2.82293 3.29849 2.51332C2.92401 2.37375 2.5301 2.37134 2.12727 2.50652C1.22089 2.81174 0.566293 3.35596 0.234229 4.08027C-0.0878549 4.78296 -0.077648 5.59822 0.264094 6.43836C1.14574 8.60162 2.37926 10.4944 3.93033 12.0644C3.93411 12.0683 3.93797 12.072 3.9419 12.0757C5.51074 13.6239 7.40135 14.8552 9.56174 15.7358C9.99436 15.9117 10.4204 15.9998 10.8278 15.9998C11.2115 15.9998 11.5788 15.9218 11.9195 15.7656C12.6438 15.4336 13.188 14.7791 13.4934 13.8721C13.6283 13.47 13.6261 13.0762 13.4876 12.7035C13.1769 11.8592 10.7779 10.097 9.87051 10.0477Z" fill="#111111"/>
                                    </svg>
                                    <h3>{{__('Contact')}}</h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif
                @if ($order_key == 'testimonials')
                <section class="testimonial-sec pb" id="testimonials-div">
                    <div class="container">
                        <div class="section-title text-center">
                            <h2>{{ __('Testimonials') }}</h2>
                        </div>
                    </div>
                    <div class="testimonial-wrp">
                        <div class="container">
                            @if(isset($is_pdf))
                                @php
                                    $t_image_count = 0;
                                    $rating = 0;
                                @endphp
                                @foreach ($testimonials_content as $k2 => $testi_content)
                                    <div class="testimonial-card edit-card"  id="testimonials_{{ $testimonials_row_nos }}">
                                        <div class="testimonial-content">
                                            <div class="testimonial-content-top">
                                                <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                   {{ $testi_content->description }} </p>
                                            </div>
                                            <div class="testimonial-content-bottom d-flex align-items-center justify-content-center">
                                                <div class="testimonial-image">
                                                    <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' .$testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
                                                </div>
                                                <div class="testimonial-info">
                                                    <h3  id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
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
                            <div class="slider-wrapper">
                                <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                    @php
                                        $t_image_count = 0;
                                        $rating = 0;
                                    @endphp
                                    @foreach ($testimonials_content as $k2 => $testi_content)
                                        <div class="testimonial-card"  id="testimonials_{{ $testimonials_row_nos }}">
                                            <div class="testimonial-content">
                                                <div class="testimonial-content-top">
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                       {{ $testi_content->description }} </p>
                                                </div>
                                                <div class="testimonial-content-bottom d-flex align-items-center justify-content-center">
                                                    <div class="testimonial-image">
                                                        <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' .$testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
                                                    </div>
                                                    <div class="testimonial-info">
                                                        <h3  id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
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
                                <div class="arrow-wrapper">
                                    <div class="slick-prev slick-arrow testimonial-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                            <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="slick-next slick-arrow testimonial-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                            <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif
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
                                                <img src="{{ asset('custom/theme9/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                    <div class="container">
                        <div class="section-title text-center">
                        <h2>{{ __('Payment') }}</h2>
                        </div>
                    </div>
                        @if (!is_null($cardPayment_content) && !empty($cardPayment_content))
                            <ul class="d-flex align-items-center">
                                @if (isset($cardPayment_content->stripe) && $cardPayment_content->stripe->status == 'on')
                                <li>
                                    <a href="{{ route('card.pay.with.stripe', $business->id) }}"
                                        class="d-flex align-items-center justify-content-center" target="_blank">
                                        <img src="{{ asset('custom/img/payments/stripe.png') }}"
                                            alt="payment-image" class="img-fluid" loading="lazy">
                                        <span>{{ __('Stripe') }}</span>
                                    </a>
                                </li>
                                @endif
                                @if (isset($cardPayment_content->paypal) && $cardPayment_content->paypal->status == 'on')
                                <li>
                                    <a href="{{ route('card.pay.with.paypal', $business->id) }}" class="d-flex align-items-center justify-content-center" target="_blank">
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
                        <div class="section-title text-center">
                            <h2>{{ __('Download Here') }}</h2>
                        </div>
                    </div>
                    <div class="download-list-wrp">
                            @if (!is_null($appInfo))
                            <div class="container">
                                <ul class="d-flex align-items-center">
                                    @if(!empty($appInfo->playstore_id ) && !empty($appInfo->appstore_id ))
                                    <li>
                                        <a href="{{ $appInfo->playstore_id }}" target="_blank"
                                            class="d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('custom/icon/apps/playstore' . $appInfo->variant . '.png') }}"
                                                alt="play-store" loading="lazy">
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
                        </div>
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
                           <div class="thankyou-svg pt">
                        @if(empty($business->svg_text))
                        <svg xmlns="http://www.w3.org/2000/svg" width="448" height="434" viewBox="0 0 448 434" fill="none">
                            <g clip-path="url(#clip0_555_32083)">
                            <path d="M72.9996 231.999C-6.70039 277.999 -6.70039 352.599 72.9996 398.499C152.7 444.499 281.8 444.499 361.5 398.499C441.2 352.499 441.2 277.899 361.5 231.999C281.8 186.099 152.7 186.099 72.9996 231.999Z" fill="#FAFAFA"/>
                            <path d="M186.3 17.1996L182.3 19.1996V9.99964C182.3 3.09964 176.8 1.39964 170.8 4.89964C164.8 8.39964 160 16.7996 160 23.6996V24.9996C158.6 24.4996 156.9 24.6996 155 25.7996C150.7 28.2996 147.2 34.2996 147.2 39.2996V39.8996L141.7 43.0996C138.9 44.6996 136.6 48.6996 136.6 51.9996C136.6 55.2996 138.9 56.5996 141.7 54.9996L186.4 29.1996C189.2 27.5996 191.5 23.5996 191.5 20.2996C191.5 16.9996 189.1 15.5996 186.3 17.1996Z" fill="#F0F0F0"/>
                            <path d="M255.399 5.40052L248.199 9.50052C248.199 9.20052 248.299 8.90052 248.299 8.50052V6.50052C248.299 2.80052 245.699 1.30052 242.499 3.10052C241.199 3.80052 239.999 5.00052 238.999 6.40052C238.499 1.70052 234.799 0.000519633 230.399 2.60052C225.599 5.40052 221.699 12.1005 221.699 17.6005V20.7005C221.699 22.1005 221.999 23.3005 222.399 24.3005L216.399 27.7005C214.599 28.7005 213.199 31.2005 213.199 33.3005C213.199 35.4005 214.599 36.2005 216.399 35.2005L255.299 12.7005C257.099 11.7005 258.499 9.20052 258.499 7.10052C258.699 5.20052 257.199 4.40052 255.399 5.40052Z" fill="#F0F0F0"/>
                            <path d="M132.2 354.801C142.252 354.801 150.4 350.1 150.4 344.301C150.4 338.502 142.252 333.801 132.2 333.801C122.148 333.801 114 338.502 114 344.301C114 350.1 122.148 354.801 132.2 354.801Z" fill="#E0E0E0"/>
                            <path d="M90.2996 340.2C97.3996 344.3 109 344.3 116.1 340.2C123.2 336.1 123.2 329.4 116.1 325.3C109 321.2 97.3996 321.2 90.2996 325.3C83.1996 329.4 83.1996 336.1 90.2996 340.2Z" fill="#E0E0E0"/>
                            <path d="M184.7 351.901C183.1 351.001 183.1 348.601 184.7 347.701L315 272.501C315.7 272.101 316.7 272.101 317.4 272.501C319 273.401 319 275.801 317.4 276.701L187.1 351.901C186.4 352.301 185.5 352.301 184.7 351.901Z" fill="#E0E0E0"/>
                            <path d="M349.9 279L342.7 283.2C341 284.2 338.8 284.2 337.1 283.2L308.8 266.8C307.2 265.9 307.2 263.5 308.8 262.6L316 258.4C317.7 257.4 319.9 257.4 321.6 258.4L349.9 274.8C351.5 275.7 351.5 278 349.9 279Z" fill="#E0E0E0"/>
                            <path d="M302.4 308.999L309.3 304.999C311.4 303.799 314.7 303.799 316.8 304.999L319.2 306.399L328.1 301.199C328.9 300.699 330.2 300.699 331 301.199H331.1C331.9 301.699 331.9 302.399 331.1 302.899L322.2 308.099L322.7 308.399C324.8 309.599 324.8 311.499 322.7 312.699L315.8 316.699L305.8 322.499L292.4 314.799L302.4 308.999Z" fill="#E0E0E0"/>
                            <path d="M401.201 329.9C426.551 329.9 447.101 318.036 447.101 303.4C447.101 288.765 426.551 276.9 401.201 276.9C375.851 276.9 355.301 288.765 355.301 303.4C355.301 318.036 375.851 329.9 401.201 329.9Z" fill="#E0E0E0"/>
                            <path d="M45.9 389.9C71.2499 389.9 91.8 378.036 91.8 363.4C91.8 348.765 71.2499 336.9 45.9 336.9C20.5501 336.9 0 348.765 0 363.4C0 378.036 20.5501 389.9 45.9 389.9Z" fill="#E0E0E0"/>
                            <path d="M118.8 306.601L88.3 306.201L88 331.001C88 333.301 89.4 335.501 92.4 337.301C98.3 340.801 108 340.901 113.9 337.501C116.9 335.801 118.4 333.501 118.4 331.301L118.8 306.601Z" fill="#37474F"/>
                            <path d="M92.7997 300C86.7997 303.4 86.7997 308.9 92.6997 312.4C98.5997 315.9 108.3 316 114.2 312.6C120.2 309.2 120.2 303.7 114.3 300.2C108.5 296.7 98.7997 296.6 92.7997 300Z" fill="#455A64"/>
                            <path d="M117.499 306.5C117.499 306.9 117.399 307.3 117.299 307.7C116.799 309.1 115.599 310.5 113.699 311.5C110.999 313 107.399 313.8 103.599 313.8C99.7988 313.8 96.1988 312.9 93.4988 311.3C91.5988 310.2 90.3988 308.8 89.9988 307.5C89.8988 307.1 89.7988 306.7 89.7988 306.2C89.7988 304.3 91.1988 302.6 93.6988 301.2C96.3988 299.7 99.9988 298.9 103.799 298.9C107.599 298.9 111.199 299.8 113.899 301.4C116.199 302.8 117.499 304.6 117.499 306.5Z" fill="#263238"/>
                            <path d="M117.2 307.7C116.7 309.1 115.5 310.5 113.6 311.5C110.9 313 107.3 313.8 103.5 313.8C99.7004 313.8 96.1004 312.9 93.4004 311.3C91.5004 310.2 90.3004 308.8 89.9004 307.5C90.4004 306.1 91.6004 304.7 93.5004 303.7C96.2004 302.2 99.8004 301.4 103.6 301.4C107.4 301.4 111 302.3 113.7 303.9C115.6 304.9 116.8 306.3 117.2 307.7Z" fill="#F5F5F5"/>
                            <path opacity="0.15" d="M113.6 311.5C114.1 311.2 114.6 310.9 115 310.6C109.4 313.6 99.9 312.3 96.9 310C93.9 307.7 93.5 303.7 98.4 301.9C96.6 302.3 94.9 302.9 93.6 303.7C91.7 304.8 90.4 306.1 90 307.5C90.4 308.9 91.7 310.2 93.5 311.3C96.2 312.9 99.7 313.8 103.6 313.8C107.3 313.8 110.9 313 113.6 311.5Z" fill="black"/>
                            <path d="M109.999 315.901C110.699 315.501 111.199 315.801 111.199 316.601C111.199 317.401 110.599 318.301 109.999 318.701C109.299 319.101 108.799 318.801 108.799 318.001C108.799 317.201 109.399 316.301 109.999 315.901Z" fill="#263238"/>
                            <path d="M88.2997 310.5C86.5997 313.8 83.2997 321.7 87.5997 324.9C87.7997 325 87.8997 325.1 88.0997 325.3V326.9C87.6997 326.6 87.1997 326.3 86.7997 326C80.2997 321.2 87.5997 308.9 87.8997 308.4C87.9997 308.3 88.0997 308.2 88.2997 308.1V310.5Z" fill="#E0E0E0"/>
                            <path d="M110.6 317.6C110.4 318 105.7 327 97.9996 328.8C97.0996 329 96.1996 329.1 95.2996 329.1C92.8996 329.1 90.4996 328.4 88.0996 326.8V325.2C91.2996 327.4 94.4996 328.2 97.6996 327.5C104.8 325.8 109.4 317.1 109.5 317C109.7 316.7 110.1 316.6 110.4 316.7C110.7 316.9 110.8 317.3 110.6 317.6Z" fill="#E0E0E0"/>
                            <path d="M147.8 318.201L117.3 317.801L117 342.701C117 345.001 118.4 347.201 121.4 349.001C127.3 352.501 137 352.601 142.9 349.201C145.9 347.501 147.4 345.201 147.4 343.001L147.8 318.201Z" fill="#37474F"/>
                            <path d="M121.899 311.6C115.899 315 115.899 320.5 121.799 324C127.699 327.5 137.399 327.6 143.299 324.2C149.299 320.8 149.299 315.3 143.399 311.8C137.499 308.3 127.899 308.2 121.899 311.6Z" fill="#455A64"/>
                            <path d="M146.499 318.1C146.499 318.5 146.399 318.9 146.299 319.3C145.799 320.7 144.599 322.1 142.699 323.1C139.999 324.6 136.399 325.4 132.599 325.4C128.799 325.4 125.199 324.5 122.499 322.9C120.599 321.8 119.399 320.4 118.999 319.1C118.899 318.7 118.799 318.3 118.799 317.8C118.799 315.9 120.199 314.2 122.699 312.8C125.399 311.3 128.999 310.5 132.799 310.5C136.599 310.5 140.199 311.4 142.899 313C145.199 314.4 146.499 316.2 146.499 318.1Z" fill="#263238"/>
                            <path d="M146.3 319.3C145.8 320.7 144.6 322.1 142.7 323.1C140 324.6 136.4 325.4 132.6 325.4C128.8 325.4 125.2 324.5 122.5 322.9C120.6 321.8 119.4 320.4 119 319.1C119.5 317.7 120.7 316.3 122.6 315.3C125.3 313.8 128.9 313 132.7 313C136.5 313 140.1 313.9 142.8 315.5C144.6 316.5 145.8 317.9 146.3 319.3Z"  class="theme-color" fill="#FF5722"/>
                            <path opacity="0.15" d="M142.6 323.1C143.1 322.8 143.6 322.5 144 322.2C138.4 325.2 128.9 323.9 125.9 321.6C122.9 319.3 122.5 315.3 127.4 313.5C125.6 313.9 123.9 314.5 122.6 315.3C120.7 316.4 119.4 317.7 119 319.1C119.4 320.5 120.7 321.8 122.5 322.9C125.2 324.5 128.7 325.4 132.6 325.4C136.3 325.4 139.9 324.6 142.6 323.1Z" fill="black"/>
                            <path d="M139.1 327.501C139.8 327.101 140.3 327.401 140.3 328.201C140.3 329.001 139.7 329.901 139.1 330.301C138.4 330.701 137.9 330.401 137.9 329.601C137.9 328.801 138.4 327.901 139.1 327.501Z" fill="#263238"/>
                            <path d="M117.3 322.099C115.6 325.399 112.3 333.299 116.6 336.499C116.8 336.599 116.9 336.699 117.1 336.899V338.499C116.7 338.199 116.2 337.899 115.8 337.599C109.3 332.799 116.6 320.499 116.9 319.999C117 319.899 117.1 319.799 117.3 319.699V322.099Z" fill="#E0E0E0"/>
                            <path d="M139.6 329.199C139.4 329.599 134.7 338.599 127 340.399C126.1 340.599 125.2 340.699 124.3 340.699C121.9 340.699 119.5 339.999 117.1 338.399V336.799C120.3 338.999 123.5 339.799 126.7 339.099C133.8 337.399 138.4 328.699 138.5 328.599C138.7 328.299 139.1 328.199 139.4 328.299C139.7 328.499 139.8 328.899 139.6 329.199Z" fill="#E0E0E0"/>
                            <path d="M314.299 273.699C314.099 273.699 313.999 273.599 313.899 273.499C313.799 273.299 313.899 272.999 314.099 272.899L319.699 269.699C319.899 269.599 320.199 269.699 320.299 269.899C320.399 270.099 320.299 270.399 320.099 270.499L314.499 273.699C314.499 273.699 314.399 273.699 314.299 273.699Z" fill="#37474F"/>
                            <path d="M315.1 271.001C316 271.501 316.7 272.801 316.7 273.901C316.7 274.401 316.5 274.801 316.2 275.001L186.4 349.901L184.1 345.901L314 270.901C314.3 270.701 314.7 270.701 315.1 271.001Z" fill="#455A64"/>
                            <path d="M186.999 348.802C186.999 349.802 186.299 350.302 185.299 349.702C184.399 349.202 183.699 347.902 183.699 346.802C183.699 345.802 184.399 345.302 185.399 345.902C186.299 346.502 186.999 347.702 186.999 348.802Z" fill="#37474F"/>
                            <path d="M307.898 261.401C307.698 261.401 307.598 261.301 307.498 261.201C307.398 261.001 307.498 260.701 307.698 260.601L315.398 256.101C315.598 256.001 315.898 256.001 315.998 256.301C316.098 256.501 315.998 256.801 315.798 256.901L308.098 261.401C307.998 261.401 307.998 261.401 307.898 261.401Z" fill="#37474F"/>
                            <path d="M313.099 249C310.199 250.7 307.799 254.7 307.799 258.1C307.799 259.8 308.399 261 309.399 261.5L340.499 279.4L347.999 266.6L316.899 248.7C315.899 248.1 314.599 248.2 313.099 249Z" class="theme-color" fill="#FF5722"/>
                            <path d="M338.898 276C338.898 272.6 341.298 268.6 344.198 266.9C347.098 265.2 349.498 266.6 349.498 269.9C349.498 273.3 347.098 277.3 344.198 279C341.198 280.8 338.898 279.4 338.898 276Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.25" d="M338.898 276C338.898 272.6 341.298 268.6 344.198 266.9C347.098 265.2 349.498 266.6 349.498 269.9C349.498 273.3 347.098 277.3 344.198 279C341.198 280.8 338.898 279.4 338.898 276Z" fill="black"/>
                            <path d="M342.799 273.8C342.799 272.9 343.399 271.9 344.199 271.4C344.999 271 345.599 271.3 345.599 272.2C345.599 273.1 344.999 274.1 344.199 274.6C343.399 275 342.799 274.7 342.799 273.8Z" fill="black"/>
                            <path d="M334.599 278.5C334.099 278.5 333.499 278.4 332.999 278.1L307.599 263.5C307.099 263.2 306.799 262.7 306.799 262.1C306.799 261.5 307.099 261 307.599 260.7C307.799 260.6 308.099 260.6 308.199 260.9C308.299 261.1 308.199 261.4 307.999 261.5C307.799 261.6 307.599 261.9 307.599 262.1C307.599 262.4 307.699 262.6 307.999 262.7L333.399 277.3C334.099 277.7 334.999 277.7 335.699 277.3L343.799 272.6C343.999 272.5 344.299 272.6 344.399 272.8C344.499 273 344.399 273.3 344.199 273.4L336.099 278.1C335.699 278.3 335.199 278.5 334.599 278.5Z" fill="#37474F"/>
                            <path d="M316.201 308.7L329.201 301.2C329.501 301.1 329.601 300.7 329.601 300.3C329.601 299.4 329.001 298.3 328.201 297.9C327.801 297.7 327.501 297.7 327.201 297.8L314.201 305.3L316.201 308.7Z" fill="#455A64"/>
                            <path d="M317.601 303.4L321.501 305.6L316.201 308.7L314.201 305.3L317.601 303.4Z" fill="#37474F"/>
                            <path d="M302.801 309.599L305.401 308.099L302.801 306.599L308.201 303.499C309.801 302.599 312.501 302.599 314.101 303.499L318.701 306.199C319.501 306.599 319.901 307.199 319.901 307.799C319.901 307.899 319.901 310.499 319.901 311.099C319.901 311.699 319.501 312.299 318.701 312.699L313.301 315.799L302.801 309.599Z" fill="#37474F"/>
                            <path d="M318.8 306.1L314.2 303.4C312.6 302.5 309.9 302.5 308.3 303.4L302.9 306.5L313.4 312.6L318.8 309.5C320.5 308.5 320.5 307 318.8 306.1Z" fill="#455A64"/>
                            <path d="M313.4 312.6L302.9 306.5L294.9 311.1L305.5 317.2L313.4 312.6Z" fill="#F0F0F0"/>
                            <path d="M313.4 312.6L305.5 317.2V320.2L313.4 315.7V312.6Z" fill="#EBEBEB"/>
                            <path d="M315.801 311.3L305.201 305.1L306.301 304.5L316.901 310.6L315.801 311.3Z" class="theme-color" fill="#FF5722"/>
                            <path d="M315.801 311.3V314.3L316.901 313.6V310.6L315.801 311.3Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M315.801 311.3V314.3L316.901 313.6V310.6L315.801 311.3Z" fill="black"/>
                            <path d="M307.9 318.8C307.9 318.8 309.3 316.9 308.6 315.4L305.5 317.2V320.2L307.9 318.8Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M307.9 318.8C307.9 318.8 309.3 316.9 308.6 315.4L305.5 317.2V320.2L307.9 318.8Z" fill="black"/>
                            <path d="M308.6 315.399C308.6 315.399 308.4 313.299 306.4 312.499C305 311.899 301.9 313.099 300.6 311.099C299.7 309.599 300.7 307.699 300.7 307.699L294.9 310.999L305.5 317.099L308.6 315.399Z" class="theme-color" fill="#FF5722"/>
                            <path d="M294.9 311.1V314.1L305.5 320.2V317.2L294.9 311.1Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.15" d="M294.9 311.1V314.1L305.5 320.2V317.2L294.9 311.1Z" fill="black"/>
                            <path d="M325.201 121.1L307.801 131.1V176.6L322.101 184.8V139.4L339.501 129.3L325.201 121.1Z" class="theme-color" fill="#FF5722"/>
                            <path d="M307.8 176.6C307.8 188.4 304.7 196.8 298.5 201.7C299.1 212.5 303 215.8 310.3 211.6C318.2 207.1 322.1 198.1 322.1 184.8L307.8 176.6Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M307.8 176.6C307.8 188.4 304.7 196.8 298.5 201.7C299.1 212.5 303 215.8 310.3 211.6C318.2 207.1 322.1 198.1 322.1 184.8L307.8 176.6Z" fill="black"/>
                            <path d="M284.2 144.799L266.6 154.999V201.099L280.8 209.299V163.199L298.5 152.999L284.2 144.799Z" class="theme-color" fill="#FF5722"/>
                            <path d="M288.5 233.5C283.4 229.7 280.8 221.7 280.8 209.3L266.5 201.1C266.5 213.5 269.1 221.5 274.2 225.3C274.6 225.6 275 225.9 275.4 226.1C277.6 227.3 287.1 232.9 289.2 234.1C289 233.9 288.8 233.7 288.5 233.5Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M288.5 233.5C283.4 229.7 280.8 221.7 280.8 209.3L266.5 201.1C266.5 213.5 269.1 221.5 274.2 225.3C274.6 225.6 275 225.9 275.4 226.1C277.6 227.3 287.1 232.9 289.2 234.1C289 233.9 288.8 233.7 288.5 233.5Z" fill="black"/>
                            <path opacity="0.5" d="M322.101 139.4L307.801 131.1L325.201 121.1L339.501 129.3L322.101 139.4Z" fill="white"/>
                            <path opacity="0.5" d="M280.8 163.199L266.6 154.999L284.2 144.799L298.5 152.999L280.8 163.199Z" fill="white"/>
                            <path d="M288.501 233.499C283.401 229.699 280.801 221.699 280.801 209.299V163.199L298.501 152.999V198.399C298.501 211.699 302.501 216.099 310.401 211.499C318.201 206.999 322.201 197.999 322.201 184.699V139.299L339.601 129.299V175.399C339.601 187.799 337.001 198.799 331.901 208.499C326.801 218.199 319.601 225.699 310.301 231.099C300.901 236.499 293.701 237.299 288.501 233.499Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.3" d="M288.501 233.499C283.401 229.699 280.801 221.699 280.801 209.299V163.199L298.501 152.999V198.399C298.501 211.699 302.501 216.099 310.401 211.499C318.201 206.999 322.201 197.999 322.201 184.699V139.299L339.601 129.299V175.399C339.601 187.799 337.001 198.799 331.901 208.499C326.801 218.199 319.601 225.699 310.301 231.099C300.901 236.499 293.701 237.299 288.501 233.499Z" fill="white"/>
                            <path d="M247.001 175.699C245.201 174.699 243.101 173.999 240.901 173.699C235.601 172.999 229.701 174.599 223.101 178.399C216.501 182.199 210.601 187.499 205.301 194.299L219.601 202.499C224.901 195.699 230.801 190.399 237.401 186.599C244.001 182.799 249.901 181.199 255.201 181.899C257.501 182.199 259.501 182.899 261.401 183.899C259.501 182.899 249.401 177.099 247.001 175.699Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.5" d="M247.001 175.699C245.201 174.699 243.101 173.999 240.901 173.699C235.601 172.999 229.701 174.599 223.101 178.399C216.501 182.199 210.601 187.499 205.301 194.299L219.601 202.499C224.901 195.699 230.801 190.399 237.401 186.599C244.001 182.799 249.901 181.199 255.201 181.899C257.501 182.199 259.501 182.899 261.401 183.899C259.501 182.899 249.401 177.099 247.001 175.699Z" fill="white"/>
                            <path d="M205.3 194.199C200 200.999 195.9 208.499 192.9 216.799L207.2 224.999C210.2 216.699 214.3 209.199 219.6 202.399L205.3 194.199Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.15" d="M205.3 194.199C200 200.999 195.9 208.499 192.9 216.799L207.2 224.999C210.2 216.699 214.3 209.199 219.6 202.399L205.3 194.199Z" fill="white"/>
                            <path d="M207.2 225.098L192.9 216.898C189.9 225.198 188.4 233.498 188.4 241.698C188.4 249.898 189.9 256.498 192.9 261.298L207.2 269.498C204.2 264.698 202.7 258.098 202.7 249.898C202.7 241.698 204.2 233.398 207.2 225.098Z" class="theme-color" fill="#FF5722"/>
                            <path d="M207.2 269.499L192.9 261.299C194.6 264.099 196.7 266.199 199.2 267.599C201 268.599 210.4 274.099 213.2 275.699C210.9 274.299 208.9 272.199 207.2 269.499Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M207.2 269.499L192.9 261.299C194.6 264.099 196.7 266.199 199.2 267.599C201 268.599 210.4 274.099 213.2 275.699C210.9 274.299 208.9 272.199 207.2 269.499Z" fill="black"/>
                            <path d="M238.801 205.399C239.001 205.299 239.101 205.299 239.301 205.199C239.201 205.199 239.001 205.299 238.801 205.399Z" fill="#37474F"/>
                            <path d="M246.001 204.099C244.001 203.699 241.801 203.999 239.401 205.099C239.801 207.099 240.101 209.299 240.101 211.899C240.101 216.599 239.401 221.199 237.901 225.599C236.401 230.099 234.401 233.999 231.801 237.499C229.201 240.999 226.401 243.599 223.201 245.399C222.501 245.799 221.901 246.099 221.301 246.399C221.701 248.099 222.201 249.499 222.901 250.799C224.401 253.599 226.401 255.199 229.001 255.699C231.601 256.199 234.401 255.499 237.601 253.699C240.701 251.899 243.601 249.199 246.201 245.799C248.801 242.299 250.801 238.399 252.301 233.899C253.801 229.399 254.501 224.899 254.501 220.199C254.501 215.499 253.801 211.799 252.301 209.099C250.501 206.299 248.501 204.699 246.001 204.099Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M246.001 204.099C244.001 203.699 241.801 203.999 239.401 205.099C239.801 207.099 240.101 209.299 240.101 211.899C240.101 216.599 239.401 221.199 237.901 225.599C236.401 230.099 234.401 233.999 231.801 237.499C229.201 240.999 226.401 243.599 223.201 245.399C222.501 245.799 221.901 246.099 221.301 246.399C221.701 248.099 222.201 249.499 222.901 250.799C224.401 253.599 226.401 255.199 229.001 255.699C231.601 256.199 234.401 255.499 237.601 253.699C240.701 251.899 243.601 249.199 246.201 245.799C248.801 242.299 250.801 238.399 252.301 233.899C253.801 229.399 254.501 224.899 254.501 220.199C254.501 215.499 253.801 211.799 252.301 209.099C250.501 206.299 248.501 204.699 246.001 204.099Z" fill="black"/>
                            <path d="M219.601 277.798C214.301 277.098 210.201 274.298 207.201 269.498C204.201 264.698 202.701 258.098 202.701 249.898C202.701 241.698 204.201 233.398 207.201 225.098C210.201 216.798 214.301 209.298 219.601 202.498C224.901 195.698 230.801 190.498 237.401 186.598C244.001 182.798 249.901 181.198 255.201 181.898C257.501 182.198 259.501 182.898 261.401 183.898C263.801 185.298 265.901 187.398 267.601 190.198C270.601 194.998 272.101 201.598 272.101 209.798C272.101 217.998 270.601 226.298 267.601 234.598C264.601 242.898 260.501 250.398 255.201 257.198C249.901 263.998 244.001 269.198 237.401 273.098C230.801 276.998 224.901 278.498 219.601 277.798ZM245.901 245.798C248.501 242.298 250.501 238.398 252.001 233.898C253.501 229.398 254.201 224.898 254.201 220.198C254.201 215.498 253.501 211.798 252.001 209.098C250.501 206.398 248.501 204.698 245.901 204.198C243.301 203.698 240.501 204.398 237.301 206.198C234.101 207.998 231.301 210.698 228.701 214.098C226.101 217.598 224.101 221.498 222.601 225.998C221.101 230.498 220.401 234.998 220.401 239.698C220.401 244.398 221.101 248.098 222.601 250.798C224.101 253.598 226.101 255.198 228.701 255.698C231.301 256.198 234.101 255.498 237.301 253.698C240.501 251.798 243.401 249.198 245.901 245.798Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.3" d="M219.601 277.798C214.301 277.098 210.201 274.298 207.201 269.498C204.201 264.698 202.701 258.098 202.701 249.898C202.701 241.698 204.201 233.398 207.201 225.098C210.201 216.798 214.301 209.298 219.601 202.498C224.901 195.698 230.801 190.498 237.401 186.598C244.001 182.798 249.901 181.198 255.201 181.898C257.501 182.198 259.501 182.898 261.401 183.898C263.801 185.298 265.901 187.398 267.601 190.198C270.601 194.998 272.101 201.598 272.101 209.798C272.101 217.998 270.601 226.298 267.601 234.598C264.601 242.898 260.501 250.398 255.201 257.198C249.901 263.998 244.001 269.198 237.401 273.098C230.801 276.998 224.901 278.498 219.601 277.798ZM245.901 245.798C248.501 242.298 250.501 238.398 252.001 233.898C253.501 229.398 254.201 224.898 254.201 220.198C254.201 215.498 253.501 211.798 252.001 209.098C250.501 206.398 248.501 204.698 245.901 204.198C243.301 203.698 240.501 204.398 237.301 206.198C234.101 207.998 231.301 210.698 228.701 214.098C226.101 217.598 224.101 221.498 222.601 225.998C221.101 230.498 220.401 234.998 220.401 239.698C220.401 244.398 221.101 248.098 222.601 250.798C224.101 253.598 226.101 255.198 228.701 255.698C231.301 256.198 234.101 255.498 237.301 253.698C240.501 251.798 243.401 249.198 245.901 245.798Z" fill="white"/>
                            <path d="M189.9 199.199L172.8 209.099L161.4 241.099L157.4 234.499L143.2 226.199L124.5 236.999L148.3 276.299V306.499L162.6 314.699L180.2 304.499V274.699L204.1 207.499L189.9 199.199Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.5" d="M189.9 199.199L172.8 209.099L161.4 241.099L157.4 234.499L143.2 226.199L124.5 236.999L148.3 276.299V306.499L162.6 314.699L180.2 304.499V274.699L204.1 207.499L189.9 199.199Z" fill="white"/>
                            <path d="M172.8 209.1L187 217.4L172.2 259L161.4 241.1L172.8 209.1Z" class="theme-color" fill="#FF5722"/>
                            <path d="M124.5 237L138.8 245.2L162.6 284.5L148.3 276.3L124.5 237Z" class="theme-color" fill="#FF5722"/>
                            <path d="M148.301 306.499L162.601 314.699V284.499L148.301 276.299V306.499Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.1" d="M148.301 306.499L162.601 314.699V284.499L148.301 276.299V306.499Z" fill="black"/>
                            <path d="M180.199 274.698V304.498L162.499 314.698V284.498L138.699 245.198L157.299 234.398L172.099 258.898L186.899 217.298L203.999 207.398L180.199 274.698Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.3" d="M180.199 274.698V304.498L162.499 314.698V284.498L138.699 245.198L157.299 234.398L172.099 258.898L186.899 217.298L203.999 207.398L180.199 274.698Z" fill="white"/>
                            <path d="M315 13.5996L297.7 23.5996V61.3996L284.4 47.6996L270.1 39.4996L255.6 47.8996V131.1L269.9 139.3L287.2 129.3V91.4996L300.5 105.2L314.7 113.4L329.2 105V21.7996L315 13.5996Z" fill="#37474F"/>
                            <path d="M329.2 21.7988V104.999L314.7 113.399L287.2 84.9988V129.299L269.9 139.299V56.0988L284.4 47.6988L312 76.0988V31.7988L329.2 21.7988Z" fill="#455A64"/>
                            <path d="M255.6 47.9L269.9 56.1L284.4 47.7L270.1 39.5L255.6 47.9Z" fill="#455A64"/>
                            <path opacity="0.2" d="M255.6 47.9L269.9 56.1L284.4 47.7L270.1 39.5L255.6 47.9Z" fill="white"/>
                            <path d="M297.699 23.5996L311.899 31.7996L329.199 21.7996L314.999 13.5996L297.699 23.5996Z" fill="#455A64"/>
                            <path opacity="0.2" d="M297.699 23.5996L311.899 31.7996L329.199 21.7996L314.999 13.5996L297.699 23.5996Z" fill="white"/>
                            <path d="M287.199 85L314.699 113.4L300.499 105.2L287.199 91.5V85Z" fill="#263238"/>
                            <path d="M237.2 74.8992L223 66.6992L205.6 76.6992L178 175.899L192.3 184.099L210.3 173.699L215.2 154.699L241.6 139.499L246.5 152.799L264.9 142.199L237.2 74.8992Z" fill="#37474F"/>
                            <path d="M241.601 139.5L215.201 154.7L210.301 173.7L192.301 184.1L219.801 85L237.201 75L264.801 142.3L246.401 152.9L241.601 139.5ZM236.401 125.1L228.401 103.1L220.401 134.4L236.401 125.1Z" fill="#455A64"/>
                            <path d="M205.6 76.6992L219.8 84.9992L237.2 74.8992L223 66.6992L205.6 76.6992Z" fill="#455A64"/>
                            <path opacity="0.2" d="M205.6 76.6992L219.8 84.9992L237.2 74.8992L223 66.6992L205.6 76.6992Z" fill="white"/>
                            <path d="M236.4 125.1L224.5 118.2L228.4 103.1L236.4 125.1Z" fill="#263238"/>
                            <path d="M172.999 95.5L155.399 105.7V137L145.599 142.7V127.9L131.299 119.6L113.699 129.8V213L127.899 221.3L145.599 211.1V178.6L155.399 173V188.9L169.599 197.2L187.299 187V103.8L172.999 95.5Z" fill="#37474F"/>
                            <path d="M187.299 103.801V187.001L169.599 197.201V164.701L145.499 178.601V211.101L127.799 221.301V138.001L145.499 127.801V159.101L169.599 145.201V114.001L187.299 103.801Z" fill="#455A64"/>
                            <path d="M113.699 129.8L127.899 138L145.599 127.9L131.299 119.6L113.699 129.8Z" fill="#455A64"/>
                            <path opacity="0.2" d="M113.699 129.8L127.899 138L145.599 127.9L131.299 119.6L113.699 129.8Z" fill="white"/>
                            <path d="M155.398 105.7L169.598 114L187.298 103.8L172.998 95.5L155.398 105.7Z" fill="#455A64"/>
                            <path opacity="0.2" d="M155.398 105.7L169.598 114L187.298 103.8L172.998 95.5L155.398 105.7Z" fill="white"/>
                            <path d="M155.4 137L169.6 145.2L145.6 159.1V142.7L155.4 137Z" fill="#455A64"/>
                            <path opacity="0.2" d="M155.4 137L169.6 145.2L145.6 159.1V142.7L155.4 137Z" fill="white"/>
                            <path d="M169.598 164.699V197.199L155.398 188.899V172.999L169.598 164.699Z" fill="#263238"/>
                            <path d="M393.7 288.2L394.2 278.4L383.1 279.7C383.1 279.7 383.6 285 383.9 288C384.1 289.8 381.9 293.2 381.9 293.2C381.9 293.2 387.3 295.7 390.1 294.6C392.9 293.5 394.2 289.9 394.1 289.1C393.9 288.3 393.7 288.2 393.7 288.2Z" fill="#FFA8A7"/>
                            <path d="M367.7 304.9C367.5 304.9 367.3 306.7 368.3 307.5C369.4 308.4 372.7 309.7 377 309C381.3 308.3 383.5 307 385.2 305.6C386.9 304.2 389.2 302.2 391.1 301.7C392.9 301.3 394.8 300.4 395.4 299.9C396 299.4 395.8 297 395.8 297L367.7 304.9Z" fill="#263238"/>
                            <path d="M393.7 288.201C393.7 288.201 394.2 288.201 394.4 288.701C394.6 289.301 394.8 291.201 395.1 292.201C395.5 293.601 395.9 296.601 395.7 297.801C395.5 299.001 392.6 299.901 390.8 300.701C388.9 301.501 386.7 302.901 384.9 304.501C382.9 306.101 378.8 307.901 376 308.001C372.7 308.101 368.9 307.201 368 305.801C366.9 304.101 366 302.001 370.8 299.701C371.7 299.301 374.9 297.301 376 296.601C378.9 294.701 381 293.001 382.3 289.801C382.4 289.401 382.6 289.001 383 288.801C383.3 288.601 383.6 288.701 384 288.701C384.8 288.801 388.1 289.101 388.9 289.401C389.6 289.701 390.5 290.001 390.5 290.801C390.5 291.101 390.4 291.301 390.3 291.601C390.2 291.801 390.2 292.001 390.4 292.101C390.5 292.201 390.7 292.101 390.9 292.001C391.4 291.601 391.8 291.001 392.2 290.501C392.4 290.201 392.7 290.001 392.9 289.701C393.2 289.501 393.5 289.401 393.7 289.201C393.8 288.901 393.7 288.601 393.7 288.201Z" fill="#455A64"/>
                            <path d="M384.901 304.501C385.701 303.801 386.601 303.101 387.501 302.501C387.501 302.501 381.901 306.001 379.501 304.601C378.001 303.701 378.601 302.501 378.701 302.101C378.701 301.701 373.301 299.301 371.901 299.201C371.501 299.401 371.201 299.601 371.001 299.701C366.201 302.001 367.001 304.001 368.201 305.801C369.101 307.201 371.801 308.201 376.101 308.101C378.701 308.001 382.901 306.101 384.901 304.501Z" fill="#37474F"/>
                            <path d="M378.9 301.101C375.9 302.401 377.2 302.801 378.1 302.901C379 303.001 384 300.001 387 297.601C390.2 295.101 392.1 292.301 393.3 291.401C393.7 291.101 394.2 290.601 394.6 290.201C394.5 289.601 394.4 289.001 394.3 288.701C394.2 288.201 393.6 288.201 393.6 288.201C393.6 288.601 393.7 288.901 393.4 289.201C393.2 289.401 392.8 289.501 392.6 289.701C392.3 289.901 392.1 290.201 391.9 290.501C391.5 291.001 391.1 291.601 390.6 292.001C388.2 295.301 382 299.801 378.9 301.101Z" fill="#37474F"/>
                            <path d="M378.3 302.499C378.4 302.499 378.4 302.499 378.5 302.399C378.6 302.299 378.6 302.099 378.5 301.999C377.6 300.999 373.4 298.899 371.2 299.199C371 299.199 370.9 299.399 370.9 299.499C370.9 299.699 371.1 299.799 371.2 299.699C373.3 299.399 377.2 301.599 378 302.299C378.1 302.399 378.2 302.499 378.3 302.499Z" fill="#263238"/>
                            <path d="M380.9 300.8C381 300.8 381 300.8 381.1 300.7C381.2 300.6 381.2 300.4 381.1 300.3C380.2 299.3 376 297.2 373.8 297.5C373.6 297.5 373.5 297.7 373.5 297.8C373.5 298 373.7 298.1 373.8 298C375.9 297.7 379.8 299.9 380.6 300.6C380.7 300.8 380.8 300.8 380.9 300.8Z" fill="#263238"/>
                            <path d="M383.5 299.3C383.6 299.3 383.6 299.3 383.7 299.2C383.8 299.1 383.8 298.9 383.7 298.8C382.8 297.8 378.6 295.7 376.4 296C376.2 296 376.1 296.2 376.1 296.3C376.1 296.5 376.3 296.6 376.4 296.5C378.5 296.2 382.4 298.4 383.2 299.1C383.3 299.3 383.4 299.3 383.5 299.3Z" fill="#263238"/>
                            <path d="M385.9 297.499C386 297.499 386 297.499 386.1 297.399C386.2 297.299 386.2 297.099 386.1 296.999C385.2 295.999 381 293.899 378.8 294.199C378.6 294.199 378.5 294.399 378.5 294.499C378.5 294.699 378.7 294.799 378.8 294.699C380.9 294.399 384.8 296.599 385.6 297.299C385.7 297.499 385.8 297.499 385.9 297.499Z" fill="#263238"/>
                            <path d="M388.3 295.8C388.4 295.8 388.4 295.8 388.5 295.7C388.6 295.6 388.6 295.4 388.5 295.3C387.3 293.9 382.9 292.2 380.7 292.5C380.5 292.5 380.4 292.7 380.4 292.8C380.4 293 380.6 293.1 380.7 293C382.7 292.7 386.9 294.4 388 295.6C388.1 295.8 388.2 295.8 388.3 295.8Z" fill="#263238"/>
                            <path d="M416.601 292.3L413.801 283.1L425.101 281.1L425.801 290C425.801 290 427.101 293.2 426.401 294.4C425.701 295.6 418.201 297.1 417.501 296.4C416.801 295.6 416.601 292.3 416.601 292.3Z" fill="#FFA8A7"/>
                            <path d="M418.201 312.399C418.601 315.299 419.301 317.099 420.601 318.599C421.901 320.099 424.101 320.299 426.301 319.399C428.501 318.599 431.201 316.799 431.601 314.199C432.001 311.599 431.701 309.899 431.001 307.299L418.201 312.399Z" fill="#263238"/>
                            <path d="M425.9 290C426.8 289.9 426.7 293.9 427.6 297.7C428.5 301.8 430.1 303.3 430.9 306.6C431.8 310.4 431.7 312.2 430.4 314.8C429.1 317.4 423.8 320.6 420.9 317.6C418.5 315.2 418.1 312.2 418 308.2C417.9 304.1 417.8 301.3 417.3 298.3C416.9 295.4 415.9 292.9 416.7 292.4C416.8 292.8 416.9 293.4 417 293.8C417.1 294.1 417.3 295.7 417.8 295.6C417.8 295.2 417.8 294.9 417.7 294.5C417.6 294.2 417.6 293.8 417.9 293.5C418.1 293.2 419 292.8 419.3 292.7C420.2 292.4 421.8 292 422.7 291.8C423.1 291.7 423.6 291.6 424.1 291.5C424.5 291.4 424.9 291.4 425.3 291.5C425.5 291.5 425.7 291.6 425.8 291.8C425.9 291.9 425.9 292.1 425.9 292.2C425.9 292.5 426 292.7 426.1 293C426.1 293.1 426.2 293.2 426.4 293.2C426.5 293.2 426.5 293 426.5 292.9C426.5 292.4 426.4 292.1 426.3 291.6C426.3 291.3 426.2 291 426.2 290.8C425.9 290.5 425.9 290.3 425.9 290Z" fill="#455A64"/>
                            <path d="M430.5 305.5C430.6 306 431.5 309.7 430.4 310.5C429.2 311.4 428.3 308.6 428.3 308.6C428.3 308.6 425.3 308.3 421.3 310.6C421.6 311.2 421.1 313.3 419.9 313C418.7 312.8 417.9 308.6 417.9 308.5C418 312.3 418.4 315.2 420.8 317.5C423.8 320.4 429 317.3 430.3 314.7C431.6 312.1 431.7 310.3 430.8 306.5C430.7 306.2 430.6 305.8 430.5 305.5Z" fill="#37474F"/>
                            <path d="M428 308.9C428.1 310.3 429.7 309.6 429.6 307.6C429.5 305.6 427.9 301.1 427.6 297.7C427.2 293 426.8 290 425.9 290V290.1L426.2 292.1C426.3 292.4 426.3 292.6 426.3 292.9C426.6 295.8 426.8 301.4 427.3 303.9C427.8 306.6 427.9 307.5 428 308.9Z" fill="#37474F"/>
                            <path d="M421.801 310.499C421.401 309.199 421.101 308.299 420.501 305.699C420.001 303.099 418.201 298.099 417.401 295.299C417.101 294.899 417.001 293.999 416.901 293.699C416.801 293.299 416.701 292.799 416.601 292.399V292.299C416.101 292.599 416.301 294.899 416.701 295.999C417.001 297.099 417.401 298.399 417.901 299.999C419.001 303.199 419.201 308.099 419.901 309.999C420.501 311.899 422.201 311.799 421.801 310.499Z" fill="#37474F"/>
                            <path d="M421.2 310.699C421.2 310.699 421.3 310.699 421.3 310.599C421.3 310.599 424.5 308.599 428.2 308.799C428.4 308.799 428.6 308.699 428.6 308.499C428.6 308.299 428.5 308.199 428.3 308.199C424.3 307.899 421 309.999 420.9 310.099C420.7 310.199 420.7 310.399 420.8 310.499C420.9 310.699 421.1 310.799 421.2 310.699Z" fill="#263238"/>
                            <path d="M420.2 307.8H420.3C420.3 307.8 423.9 305.6 428.1 305.8C428.3 305.8 428.5 305.7 428.5 305.5C428.5 305.3 428.4 305.2 428.2 305.2C423.8 305 420.2 307.2 420 307.3C419.8 307.4 419.8 307.6 419.9 307.7C419.9 307.8 420.1 307.8 420.2 307.8Z" fill="#263238"/>
                            <path d="M427.6 302.9C427.7 302.9 427.8 302.8 427.9 302.7C427.9 302.5 427.8 302.4 427.7 302.4C423.5 301.8 419.7 304.3 419.5 304.4C419.3 304.5 419.3 304.699 419.4 304.799C419.5 304.899 419.7 305 419.9 304.9C419.9 304.9 423.7 302.5 427.6 303C427.5 302.9 427.5 302.9 427.6 302.9Z" fill="#263238"/>
                            <path d="M427.1 300.2C427.2 300.2 427.3 300.1 427.4 300C427.4 299.8 427.3 299.7 427.2 299.6C422.6 298.9 419 301.5 418.8 301.6C418.6 301.7 418.6 301.9 418.7 302C418.8 302.1 419 302.1 419.2 302C419.2 302 422.7 299.5 427 300.1C427 300.2 427.1 300.2 427.1 300.2Z" fill="#263238"/>
                            <path d="M426.6 297.2C426.7 297.2 426.8 297.1 426.9 297C427 296.8 426.8 296.7 426.7 296.6C422.4 295.9 418.4 298.6 418.3 298.7C418.1 298.8 418.1 299 418.2 299.1C418.3 299.2 418.5 299.2 418.7 299.1C418.7 299.1 422.5 296.4 426.5 297.1C426.5 297.2 426.5 297.2 426.6 297.2Z" fill="#263238"/>
                            <path d="M415.799 191.1C419.199 213.6 420.399 246.1 420.399 246.1C420.699 247.8 422.299 252.9 423.899 261.3C425.299 268.8 425.899 284.5 425.899 285.5C425.899 285.5 419.999 289.5 414.999 288.2C414.999 288.2 407.599 265.2 404.299 254.9C401.199 245.1 396.899 229.3 396.899 229.3L395.799 245.7C395.799 245.7 396.599 252.2 396.799 256.8C396.999 262.1 394.399 283.2 394.399 283.2C394.399 283.2 388.599 286.9 383.199 283.2C383.199 283.2 378.399 252.7 377.799 246.4C376.599 234 375.099 208.5 375.699 193.2L415.799 191.1Z" fill="#455A64"/>
                            <path d="M396.799 229.199L393.099 213.299C393.099 213.299 386.999 212.799 383.799 210.199C383.799 210.199 386.099 213.799 391.799 214.899L395.399 229.399L395.799 245.599L396.799 229.199Z" fill="#263238"/>
                            <path d="M357.7 129.601C358.8 134.901 358.2 134.301 361.2 138.401C367.6 147.101 375.2 157.401 375.2 157.401C382 160.001 382.5 151.201 386.7 146.701C383 142.801 381.4 142.801 376.9 137.501C374.1 134.201 369.3 128.701 369.3 128.701C369.3 128.701 367.2 123.101 365.4 118.001C363.2 111.601 362.4 110.601 363.4 107.501C363.9 106.001 364.1 104.001 364.2 103.101C364.5 100.901 364.4 98.8009 364.6 96.6009C364.6 96.4009 364.6 96.3009 364.6 96.1009C364.4 95.6009 363.6 95.9009 363.3 96.2009C362.9 96.5009 362.6 97.1009 362.5 97.6009C362.3 98.3009 362.1 99.0009 361.9 99.7009C361.8 99.9009 361.7 100.501 361.5 100.501C361.2 100.501 361.3 99.8009 361.2 99.6009C361.2 98.9009 361.2 98.2009 361.2 97.5009C361.3 95.7009 361.3 93.9009 361.4 92.1009C361.4 91.9009 361.4 91.6009 361.4 91.4009C361.1 90.5009 360 90.6009 359.6 91.6009C359.5 91.9009 359.4 92.2009 359.3 92.4009C359.1 93.3009 359 94.2009 358.9 95.1009C358.9 95.5009 358.8 95.8009 358.8 96.2009C358.8 96.3009 358.7 96.8009 358.5 96.6009C358.5 96.5009 358.5 96.5009 358.5 96.4009C358.5 95.2009 358.6 94.0009 358.6 92.8009C358.6 92.2009 358.7 91.6009 358.6 91.0009C358.6 90.6009 358.7 89.8009 358.4 89.5009C358.3 89.4009 358.1 89.3009 358 89.3009C357.5 89.2009 357 89.4009 356.8 89.8009C356.6 90.0009 356.5 90.3009 356.4 90.5009C356.3 90.7009 356.3 91.0009 356.2 91.3009C355.9 90.6009 355 90.8009 354.6 91.4009C354.1 92.3009 354 93.2009 354 94.4009C353.9 95.7009 353.9 96.4009 353.9 98.4009C353.9 98.8009 353.7 99.0009 353.6 98.6009C353.5 98.2009 353.5 97.9009 353.5 97.5009C353.5 97.0009 353.5 96.9009 353.4 96.4009C353.4 95.7009 353.4 94.5009 353.2 94.2009C353 93.9009 352.5 94.1009 352.3 94.3009C352.1 94.4009 352 94.7009 351.9 94.9009C351.3 96.3009 351.4 97.8009 351.6 99.3009C351.7 100.501 351.8 101.701 351.9 102.901C352.1 105.101 352.3 107.401 353.4 109.301C353.8 109.901 354.2 110.801 354.4 111.601C355.1 114.301 355.5 117.301 356.1 120.501C356.5 123.001 356.9 125.601 357.7 129.601Z" fill="#FFA8A7"/>
                            <path d="M359.5 101.802C357.5 101.602 356.7 104.302 356.3 105.802C356.2 106.102 356.3 107.002 356.7 106.402C356.8 106.202 356.9 105.902 357 105.702C357.2 105.202 357.5 104.802 357.7 104.402C358.2 103.702 358.8 103.002 359.5 102.602C359.7 102.502 360 102.302 359.9 102.102C359.9 102.002 359.7 101.902 359.5 101.902C359.6 101.802 359.6 101.802 359.5 101.802Z" fill="#F28F8F"/>
                            <path d="M356.201 91.7012C356.201 94.1012 356.101 96.5012 355.701 98.8012C355.501 96.4012 355.601 94.0012 356.201 91.7012Z" fill="#F28F8F"/>
                            <path d="M384.9 144.6C382 142.2 378.8 139 376.3 136.2C373.7 133.5 369.7 128.8 369.7 128.8L364.3 114.9C364.3 114.9 363.6 116.4 360.3 117.4C357 118.3 355.5 117.3 355.5 117.3C355.5 117.3 356.3 124.3 357.3 129.4C358.3 134.5 358 134.6 361.2 139.3C364.4 143.9 372.8 155.4 375 158.1C377.2 160.8 379.7 166.4 379.7 166.2C379.8 166 384.9 144.6 384.9 144.6Z" fill="#37474F"/>
                            <path d="M402.401 147.4C404.701 147.8 411.801 150.4 414.501 151.8C414.501 151.8 417.501 158.3 416.101 173C415.901 175.4 415.401 181.7 415.101 186.7C414.801 193.3 415.101 195.2 415.401 198.7C415.401 198.7 409.301 204.2 393.101 203.2C380.401 202.4 376.501 197.3 376.501 197.3C376.501 197.3 376.301 180.2 376.501 170.8C376.801 158.5 380.401 151.4 383.101 149.2L391.401 147.7L402.401 147.4Z" fill="#F0F0F0"/>
                            <path d="M403.801 147.501V148.301C403.801 148.301 400.901 155.701 400.801 170.101C400.801 184.501 401.401 207.601 401.401 207.601C401.401 207.601 411.201 207.301 417.801 201.801C417.801 201.801 416.401 189.301 416.401 183.601C416.501 177.901 417.901 169.601 419.401 161.401C420.901 153.101 409.201 142.301 409.201 142.301C407.701 144.401 405.901 146.201 403.801 147.501Z" class="theme-color" fill="#FF5722"/>
                            <path d="M391.101 146.802C388.101 146.602 387.201 146.102 384.901 144.602C384.901 144.602 378.301 152.302 376.701 163.602C375.101 174.902 374.701 202.402 374.701 202.402C375.801 203.102 378.801 204.202 380.201 204.402C380.201 204.402 380.501 190.902 381.101 178.502C381.701 163.502 382.601 154.002 391.201 147.802L391.101 146.802Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.3" d="M406.202 172.201C404.802 173.601 403.402 175.101 402.002 176.601C403.602 175.201 405.102 173.801 406.602 172.401L406.702 172.301C406.102 171.101 405.502 169.801 404.802 168.601C404.802 168.601 403.402 166.001 403.202 165.401C404.502 164.901 405.802 164.401 407.102 163.801L407.302 163.701V163.501C407.402 159.001 407.402 154.401 407.302 149.901C407.002 154.301 406.802 158.801 406.602 163.201C405.102 163.801 403.602 164.301 402.202 164.901L402.402 165.201C403.602 167.401 405.102 170.201 406.202 172.201ZM377.102 168.201V168.301C378.002 170.201 378.802 172.101 379.802 173.901C379.102 172.001 378.402 170.101 377.602 168.201C378.702 166.601 379.802 164.901 380.902 163.201L381.002 163.001L380.902 162.801L379.302 160.401C379.602 159.401 380.002 158.401 380.502 157.401C381.902 154.301 383.802 151.501 385.802 148.701C382.702 152.101 380.002 156.001 378.602 160.501L378.702 160.601L380.302 162.901C379.302 164.601 378.202 166.201 377.202 167.901L377.102 168.201Z" fill="black"/>
                            <path d="M405.902 121.9C405.902 121.9 408.202 122 409.302 123.8C410.402 125.6 411.102 128.8 409.702 132.5C408.202 136.5 405.202 140.4 404.502 141.5C403.802 142.6 402.602 142.9 402.602 142.9L402.902 138L403.202 134.6C403.202 134.6 400.502 132 400.402 129.5C400.202 126.3 401.502 124.6 401.502 124.6L405.902 121.9Z" fill="#263238"/>
                            <path d="M388.801 126.9C390.201 126.3 391.901 126.2 393.301 126.1C394.701 126.1 396.101 126 397.401 126C398.901 126 400.401 125.9 401.801 125.9C401.801 125.9 406.601 125.3 406.701 122C406.801 120.4 406.001 119.2 405.801 119C405.201 118.1 404.301 117.1 403.501 116.6C401.501 115.2 399.601 114.4 397.101 114.1C395.301 113.9 393.501 114.1 391.701 114.3C390.501 114.5 389.201 114.7 388.001 114.5C387.101 114.3 386.201 113.8 386.101 112.9C385.101 114 384.901 115.7 385.501 117C384.301 116.9 383.201 117.8 382.801 118.9C382.401 120.2 382.901 121.2 383.701 122.2C383.601 122.1 383.101 123 383.101 123.1C382.801 123.6 382.701 124.3 382.801 124.9C382.901 125.8 383.701 126.4 384.401 126.8C385.901 127.5 387.401 127.5 388.801 126.9Z" fill="#263238"/>
                            <path d="M407.401 139.5C404.801 140.6 403.701 138.6 403.701 138.6L403.801 148.3C399.601 155.5 386.501 154.1 390.301 148.4L390.401 145.5C390.401 145.5 389.501 145.5 388.201 145.2C384.701 144.4 383.801 142.3 383.401 139.8C382.701 135.9 383.101 130.6 384.701 124.4C385.001 123.2 385.601 121.9 386.701 121.4C389.501 120.2 391.901 122.2 395.601 123.9C397.101 124.6 400.901 125 401.901 124.6C400.501 126 400.301 130.6 402.201 132.6C402.501 133.3 402.901 133.7 403.101 133.9C403.901 134.7 404.701 132.8 405.401 132.1C406.101 131.4 408.801 130.9 409.801 133.3C410.901 135.8 409.801 138.5 407.401 139.5Z" fill="#FFA8A7"/>
                            <path d="M390.4 145.5C393.4 145.6 395.9 145.4 398 144.4C399.7 143.6 402.2 141.2 402.8 138.9C402.6 142.7 401.1 144.4 398.4 145.7C395.7 147 392.3 147.1 390.4 147.1V145.5Z" fill="#F28F8F"/>
                            <path d="M395.201 127.2L397.401 128.8C397.801 128.2 397.701 127.3 397.101 126.8C396.401 126.4 395.601 126.6 395.201 127.2Z" fill="#263238"/>
                            <path d="M385.5 127.599L388 126.499C387.7 125.799 386.9 125.499 386.2 125.799C385.6 125.999 385.2 126.799 385.5 127.599Z" fill="#263238"/>
                            <path d="M396.201 130.799C396.201 131.399 395.601 131.899 395.001 131.799C394.401 131.799 393.901 131.199 394.001 130.599C394.001 129.999 394.601 129.499 395.201 129.599C395.801 129.599 396.301 130.199 396.201 130.799Z" fill="#263238"/>
                            <path d="M387.9 130.1C387.9 130.7 387.3 131.2 386.7 131.1C386.1 131.1 385.6 130.5 385.7 129.9C385.7 129.3 386.3 128.8 386.9 128.9C387.6 128.9 388 129.4 387.9 130.1Z" fill="#263238"/>
                            <path d="M391.601 128.799L390.401 135.799L386.701 134.299C388.101 131.899 389.801 129.999 391.601 128.799Z" fill="#F28F8F"/>
                            <path d="M394.2 136.6L389.6 137.7C389.9 139 391.3 139.8 392.5 139.5C393.8 139.2 394.5 137.9 394.2 136.6Z" fill="#B16668"/>
                            <path d="M391.4 139.499C391.8 138.299 392.9 137.399 394.2 137.199C394.2 138.299 393.5 139.199 392.5 139.499C392.1 139.599 391.8 139.599 391.4 139.499Z" fill="#F28F8F"/>
                            <path d="M388.8 59.8L414.3 8.2L400 0L380.6 11.2L369.8 32.9L356.4 25.2L338.9 35.3V118.5L353.2 126.7L370.6 116.6V95.8L374.8 87.6L380.8 94.3L395.1 102.5L415.6 90.7L388.8 59.8Z" fill="#37474F"/>
                            <path d="M377.2 82.6008L370.6 95.8008V116.601L353.1 126.701V43.5008L370.6 33.4008V68.0008L394.8 19.5008L414.2 8.30078L388.7 59.9008L415.5 90.8008L395 102.601L377.2 82.6008Z" fill="#455A64"/>
                            <path d="M338.9 35.2992L353.2 43.4992L370.6 33.3992L356.4 25.1992L338.9 35.2992Z" fill="#455A64"/>
                            <path opacity="0.2" d="M338.9 35.2992L353.2 43.4992L370.6 33.3992L356.4 25.1992L338.9 35.2992Z" fill="white"/>
                            <path d="M380.6 11.2L394.8 19.5L414.3 8.2L400 0L380.6 11.2Z" fill="#455A64"/>
                            <path opacity="0.2" d="M380.6 11.2L394.8 19.5L414.3 8.2L400 0L380.6 11.2Z" fill="white"/>
                            <path d="M377.201 82.5996L395.101 102.5L380.801 94.2996L374.801 87.5996L377.201 82.5996Z" fill="#263238"/>
                            <path d="M396.4 94.0996C396.4 93.7996 396.6 93.5996 396.8 93.3996C397.1 93.2996 397.4 93.2996 397.6 93.3996C397.9 93.4996 398.1 93.7996 398.2 93.9996C398.8 94.6996 399.4 95.3996 399.9 96.1996C400 96.3996 400.9 97.5996 400.9 96.8996C400.9 96.6996 400.7 96.2996 400.6 96.0996C399.5 93.8996 398.5 91.6996 397.6 89.4996C397.4 88.9996 397.3 88.1996 397.8 87.8996C398.3 87.5996 398.9 87.8996 399.2 88.1996C399.4 88.3996 399.6 88.5996 399.8 88.8996C400.3 89.6996 400.8 90.4996 401.2 91.2996C401.4 91.5996 401.5 91.9996 401.7 92.2996C401.7 92.3996 402 92.7996 402.1 92.4996C402.1 92.3996 402.1 92.3996 402.1 92.2996C401.7 91.1996 401.1 90.0996 400.6 88.9996C400.3 88.3996 400.1 87.8996 399.9 87.2996C399.7 86.8996 399.4 86.2996 399.5 85.7996C399.6 85.6996 399.7 85.5996 399.8 85.4996C400.2 85.2996 400.8 85.2996 401.1 85.4996C401.3 85.5996 401.5 85.7996 401.7 85.9996C401.8 86.0996 402 86.3996 402.2 86.6996C402.2 85.9996 403.1 85.7996 403.7 86.1996C404.5 86.7996 404.9 87.6996 405.4 88.7996C405.9 89.8996 406.3 90.8996 406.8 91.9996C407.2 92.7996 407.4 93.6996 407.8 94.4996C407.9 94.6996 408 94.7996 408.2 94.7996C408.2 93.1996 407.2 91.1996 408.8 89.9996C408.9 89.8996 409 89.8996 409.1 89.8996C409.7 89.7996 410.5 93.3996 410.6 93.9996C411 95.0996 411.2 96.1996 411.3 97.3996C411.4 98.3996 411.3 99.3996 411.6 100.4C411.9 101.3 412.2 102.1 412.7 102.9C413.4 104 414.3 105.2 415.8 106.8C417.4 108.5 418.8 109.7 420.8 112C419.6 112.9 418.3 113.7 416.9 114.5C415.1 115.4 413.3 115.9 411.4 116.3C409.9 113.8 408.7 111.9 407.1 109.4C407 109.3 406.9 109.2 406.9 109.1C406.8 109 406.7 108.8 406.6 108.7C405.1 107 403.2 105.8 401.7 104.1C400.4 102.5 399.6 101 398.7 99.4996C398.3 98.7996 398 98.0996 397.5 97.3996C397.1 96.6996 396.6 95.9996 396.4 95.2996C396.5 94.6996 396.4 94.4996 396.4 94.0996Z" fill="#FFA8A7"/>
                            <path d="M402.4 86.7988C403.3 88.9988 404.2 91.1988 405.5 93.1988C404.8 90.8988 403.8 88.6988 402.4 86.7988Z" fill="#F28F8F"/>
                            <path d="M409.301 142.2C411.201 138.9 413.001 134.8 414.401 131.3C415.801 127.8 416.501 125.6 416.501 125.6L407.201 109.5C407.201 109.5 408.501 109.8 411.501 108C414.501 106.2 414.301 104.6 414.301 104.6C414.301 104.6 424.201 113.7 427.901 117.8C431.301 121.7 431.001 123.2 429.601 128.7C428.301 134.2 423.901 146.7 422.801 150C421.701 153.3 419.601 161.4 419.601 161.4C414.801 162.6 407.901 152.7 409.301 142.2Z" fill="#37474F"/>
                            <path d="M82.2 364.4C82.7 364.3 82.8 365.7 82.7 366.4C82.6 367 80.9 369.3 77.5 370.4C74.1 371.5 69.2 371.4 67.2 371.5C65.1 371.6 62.1 373 60.1 373.6C55.5 375.1 52.7 373.7 51.3 372.7C50.8 372.3 50.7 371.6 50.6 371.1C50.5 369.7 50.6 369.4 50.7 369.4L82.2 364.4Z" fill="#37474F"/>
                            <path d="M50.9007 364.9C50.7007 365.8 50.5007 366.8 50.5007 367.8C50.4007 369 50.3007 370.5 51.2007 371.3C52.7007 372.7 54.3007 372.9 56.1007 372.9C58.2007 372.9 60.2007 372.4 62.1007 371.6C63.8007 370.8 65.2007 370.1 67.2007 370C69.3007 369.9 72.3007 369.9 74.4007 369.5C76.2007 369.1 77.9007 368.7 79.5007 367.8C80.8007 367 81.6007 366.1 82.4007 364.6C82.2007 361.9 80.7007 360.8 79.2007 360.1C77.6007 359.4 75.5007 359.4 73.7007 359.6C71.7007 359.8 70.2007 360.3 68.4007 360.4C67.2007 360.5 65.9007 360.4 64.8007 360C64.3007 359.8 63.8007 359 63.5007 358.5C63.1007 357.9 63.0007 357.4 62.4007 357.4C62.4007 357.4 53.0007 358.4 52.2007 358.6C51.2007 358.8 51.5007 360.1 51.5007 360.8C51.5007 361.4 51.5007 361.4 51.5007 362C51.5007 362.6 51.4007 363.5 51.2007 364C51.0007 364.4 51.0007 364.7 50.9007 364.9Z" fill="#455A64"/>
                            <path d="M69.8014 359.901C69.9014 359.801 70.1014 359.701 70.2014 359.701C71.0014 359.501 71.7014 360.201 72.1014 360.801C72.4014 361.201 72.5014 361.601 72.7014 362.001C72.9014 362.501 73.0014 363.001 72.9014 363.601C72.9014 363.701 72.8014 363.901 72.7014 363.901C72.6014 363.901 72.5014 363.701 72.5014 363.601C72.3014 362.901 72.0014 362.201 71.6014 361.501C71.4014 361.201 71.3014 361.001 71.0014 360.801C70.7014 360.601 70.4014 360.501 70.1014 360.401C70.0014 360.401 69.4014 360.401 69.5014 360.201L69.6014 360.101C69.7014 360.001 69.7014 360.001 69.8014 359.901Z" fill="#FAFAFA"/>
                            <path d="M67.4016 360.201C67.8016 360.101 68.2016 360.201 68.5016 360.401C68.9016 360.601 69.1016 361.001 69.3016 361.401C69.7016 362.201 70.1016 363.301 69.7016 364.101C69.6016 364.401 69.3016 364.301 69.2016 364.001C69.1016 363.801 69.1016 363.401 69.0016 363.201C68.8016 362.601 68.6016 362.001 68.3016 361.401C68.2016 361.201 68.1016 361.001 67.9016 360.801C67.8016 360.701 67.7016 360.601 67.5016 360.501C67.4016 360.501 67.3016 360.401 67.3016 360.401C67.2016 360.401 67.1016 360.401 67.1016 360.401C67.1016 360.301 67.2016 360.201 67.3016 360.201H67.4016Z" fill="#FAFAFA"/>
                            <path d="M65.0008 359.801C65.3008 359.901 65.5008 360.001 65.7008 360.201C65.9008 360.401 66.0008 360.601 66.1008 360.901C66.3008 361.501 66.5008 362.001 66.6008 362.601C66.7008 363.001 66.6008 363.501 66.4008 363.901C66.3008 364.101 66.2008 364.201 66.0008 364.201C65.8008 364.101 65.8008 363.901 65.8008 363.701C65.7008 363.401 65.7008 363.101 65.7008 362.801C65.6008 361.701 65.1008 360.801 64.4008 360.001L64.3008 359.901C64.3008 359.801 64.4008 359.801 64.5008 359.801C64.7008 359.801 64.8008 359.801 65.0008 359.801Z" fill="#FAFAFA"/>
                            <path d="M72.3004 359.9C73.1004 359.8 75.0004 360.7 76.1004 363.2C77.2004 365.6 77.1004 368.9 77.1004 368.9C77.1004 368.9 79.5004 368.5 81.5004 366.2C82.0004 365.6 82.3004 365.1 82.5004 364.6C82.5004 362.9 82.0004 361.6 81.2004 360.8C79.8004 359.5 77.9004 358.8 74.9004 358.9C71.6004 359.1 71.4004 360 71.4004 360L72.3004 359.9Z" fill="#FAFAFA"/>
                            <path d="M50.4004 344.101C50.4004 344.101 51.8004 357.201 52.1004 359.901C52.2004 361.001 54.7004 362.301 58.2004 362.001C60.7004 361.801 62.2004 360.301 62.4004 359.001C62.6004 357.701 63.3004 342.301 63.3004 342.301L50.4004 344.101Z" fill="#C8856A"/>
                            <path d="M14.7988 340.801L18.3988 327.301L31.1988 331.901L22.0988 347.501L14.7988 340.801Z" fill="#C8856A"/>
                            <path d="M10.1992 344.501C9.89918 345.701 10.1992 346.901 10.3992 348.001C10.5992 349.201 10.6992 350.301 10.7992 351.501C10.8992 352.201 10.8992 352.901 11.0992 353.601C11.2992 354.401 11.1992 355.301 11.1992 356.201C11.1992 357.101 11.1992 358.001 11.2992 358.901C11.2992 359.301 11.3992 359.701 11.2992 360.101C11.1992 360.501 16.9992 363.801 19.2992 365.101C19.3992 365.201 19.5992 365.201 19.6992 365.301C21.7992 366.101 23.4992 364.401 23.4992 364.401C25.0992 360.101 21.8992 357.301 21.8992 357.301C21.8992 357.301 21.5992 357.301 21.6992 355.001C21.6992 353.401 21.6992 351.701 21.8992 350.101C21.9992 349.101 22.3992 348.701 22.7992 347.801C23.1992 346.901 23.7992 346.001 23.7992 345.101C23.7992 344.301 23.0992 343.101 22.7992 342.501C21.8992 341.001 20.0992 339.801 18.5992 339.201C17.6992 338.801 16.2992 338.401 15.4992 338.901C14.9992 339.201 14.7992 339.701 14.4992 340.201C14.0992 340.701 13.4992 341.101 12.9992 341.501C11.8992 342.201 10.8992 343.101 10.4992 344.301C10.1992 344.301 10.1992 344.401 10.1992 344.501Z" fill="#455A64"/>
                            <path d="M21.9004 357.301C22.2004 357.701 22.4004 358.001 22.7004 358.401C23.7004 360.201 24.0004 362.201 23.5004 364.401C27.6004 364.001 28.7004 361.701 28.7004 361.701C28.7004 361.701 28.9004 359.701 26.6004 358.201C26.3004 358.001 26.0004 357.901 25.7004 357.701C23.6004 356.801 21.9004 357.301 21.9004 357.301Z" fill="#FAFAFA"/>
                            <path d="M9.19972 345.101C8.09972 345.501 8.39972 348.501 9.09972 351.301C9.79972 354.101 10.0997 355.101 9.79972 357.501C9.49972 359.901 9.29972 360.901 10.1997 361.801C11.1997 362.701 18.7997 366.201 18.7997 366.201C18.7997 366.201 17.2997 362.601 17.0997 357.301C16.8997 352.101 16.4997 348.701 14.0997 346.301C11.6997 344.001 9.19972 345.101 9.19972 345.101Z" fill="#263238"/>
                            <path d="M28.5992 361.601C28.5992 361.601 25.5992 364.001 22.1992 364.401C18.7992 364.801 18.5992 363.501 18.1992 359.401C17.7992 355.301 17.6992 349.701 16.0992 347.301C14.4992 344.801 11.7992 343.701 10.7992 344.001C10.5992 343.901 9.49922 344.701 9.19922 345.101C9.19922 345.101 11.4992 344.801 13.6992 346.901C15.7992 349.001 16.1992 353.401 16.2992 357.401C16.3992 361.401 16.5992 366.101 19.7992 366.501C22.9992 367.001 26.3992 365.601 28.4992 363.901C29.6992 362.901 28.5992 361.601 28.5992 361.601Z" fill="#37474F"/>
                            <path d="M21.6004 355.801C21.6004 355.801 22.0004 356.101 22.1004 356.501C22.1004 357.001 22.0004 358.001 20.9004 358.601C20.5004 358.801 20.1004 358.701 20.8004 357.901C21.5004 357.101 21.6004 355.801 21.6004 355.801Z" fill="#FAFAFA"/>
                            <path d="M21.7 353C21.7 353 22 353.2 22 353.6C22 354 21.3 355.5 20.6 355.8C19.8 356.1 20.3 355.3 20.6 354.9C20.9 354.5 21.7 353 21.7 353Z" fill="#FAFAFA"/>
                            <path d="M21.9001 349.9C21.9001 349.9 22.2001 350.1 22.3001 350.4C22.3001 350.7 20.8001 351.9 20.3001 351.8C19.8001 351.8 19.7001 351.6 20.3001 351.2C20.8001 350.8 21.9001 349.9 21.9001 349.9Z" fill="#FAFAFA"/>
                            <path d="M26.2004 340.7C26.2004 340.7 30.8004 333.4 39.1004 319.7C41.5004 315.8 42.8004 313 43.3004 310C43.9004 307.1 46.2004 298.1 46.2004 298.1L48.4004 313.4C47.8004 317.3 47.7004 323.3 48.6004 333.5C49.3004 342.5 50.9004 353.7 50.9004 353.7C51.7004 354.3 55.0004 354.8 57.1004 354.7C62.3004 354.3 63.2004 352.2 63.2004 352.2C63.2004 352.2 64.9004 334.2 65.5004 327.5C66.9004 311.7 67.3004 308 68.1004 289.8C68.8004 274.4 67.3004 264.9 63.0004 251.1C51.7004 256.2 36.4004 255.2 30.1004 249.6C30.1004 249.6 25.0004 258.2 24.9004 271.7C24.8004 283.1 25.8004 305.2 25.8004 305.2C23.3004 309 21.7004 312 20.3004 317.5C18.7004 323.8 17.6004 328.1 15.9004 335.2C22.5004 334.9 26.2004 340.7 26.2004 340.7Z" fill="#37474F"/>
                            <path d="M25.0988 336.299C25.8988 334.799 26.6988 333.199 27.5988 331.699C29.0988 328.799 32.5988 322.999 34.0988 320.099C37.0988 314.199 39.5988 308.199 41.1988 301.799C41.5988 300.099 41.9988 298.299 42.1988 296.499C42.2988 295.599 42.3988 294.599 42.4988 293.699C42.5988 292.199 42.4988 290.699 42.6988 289.199C42.6988 288.999 43.0988 288.599 43.1988 288.999C43.6988 290.599 43.4988 292.399 43.4988 294.099C43.3988 295.799 43.1988 297.499 42.9988 299.199C42.4988 302.499 41.5988 305.799 40.4988 308.899C38.1988 315.299 33.0988 324.399 29.7988 330.399C28.8988 332.099 27.9988 333.799 26.9988 335.499C26.3988 336.699 25.7988 337.899 25.0988 338.999C24.8988 338.699 24.5988 338.499 24.2988 338.199C24.3988 337.599 24.6988 336.899 25.0988 336.299Z" fill="#263238"/>
                            <path d="M61.0004 269.101C60.4004 263.701 59.3004 258.101 57.4004 253.001C57.7004 252.901 58.0004 252.801 58.3004 252.801C60.5004 258.001 61.6004 263.501 62.3004 269.101C65.1004 268.501 65.6004 264.501 65.5004 262.201C65.4004 260.801 65.2004 259.401 65.0004 258.001C64.8004 257.001 64.6004 256.101 64.4004 255.101C65.2004 257.901 65.9004 260.501 66.4004 263.101C66.4004 263.201 66.4004 263.301 66.4004 263.401C66.3004 265.901 65.1004 269.501 62.4004 270.101C63.0004 275.401 63.1004 280.801 63.2004 286.101C63.5004 300.301 63.2004 314.601 62.3004 328.701C61.9004 335.201 61.1004 347.701 60.2004 354.201C59.8004 354.301 59.4004 354.401 59.0004 354.501C59.4004 348.801 60.4004 337.301 60.8004 331.601C61.3004 324.601 61.6004 317.601 61.8004 310.501C62.0004 303.201 62.0004 295.901 61.9004 288.601C61.8004 282.101 61.7004 275.601 61.0004 269.101Z" fill="#263238"/>
                            <path d="M63.0992 251L62.1992 245.5C62.1992 245.5 54.7992 249.6 46.0992 249.1C37.2992 248.6 31.4992 244 31.4992 244L30.1992 249.5C30.1992 249.5 33.8992 255 46.0992 254.8C58.2992 254.6 63.0992 251 63.0992 251Z" fill="#263238"/>
                            <path d="M46.3004 298.2L42.7004 276.6C42.7004 276.6 38.7004 276.9 32.4004 271.4C32.4004 271.4 33.4004 276 40.1004 279.2L43.9004 300L43.4004 310.1L46.3004 298.2Z" fill="#263238"/>
                            <path d="M74.8984 160.1C74.2984 160.5 73.8984 161.1 73.4984 161.6C72.8984 162.4 72.2984 163.1 71.6984 163.8C71.5984 163.9 71.4984 164 71.3984 163.9V163.8C71.4984 163.3 71.7984 162.8 71.9984 162.3C72.6984 161 73.2984 159.7 73.8984 158.3C73.9984 158 74.1984 157.6 74.1984 157.3C74.1984 156.9 74.1984 156.5 73.8984 156.2C73.6984 156.1 73.3984 155.8 72.8984 156.1C73.0984 155.7 73.1984 155.3 73.0984 155C72.8984 154.3 72.0984 154 71.4984 154.5C71.2984 154.7 71.0984 154.9 70.9984 155.2C69.7984 157.1 68.7984 159 67.6984 161C67.4984 161.3 67.2984 161.3 67.2984 160.9C67.6984 159.3 68.4984 157.8 68.7984 156.1C68.8984 155.4 69.0984 154.8 68.4984 154.3C67.7984 153.8 67.2984 154.3 66.8984 154.9C65.7984 157.1 64.6984 159.4 63.7984 161.7C63.5984 162.2 62.5984 164.9 62.2984 163.2C62.1984 162.5 62.0984 161.9 61.8984 161.2C61.7984 160.7 61.5984 160.1 61.2984 159.8C60.9984 159.5 60.3984 159.1 60.0984 159.6C59.9984 159.7 59.9984 159.9 59.9984 160C59.9984 162.1 59.6984 164.1 59.7984 166.2C59.7984 167.1 59.7984 169 60.0984 170.4C60.3984 171.8 57.9984 177.7 55.3984 183.2C57.3984 185.7 60.0984 187.3 65.0984 186.4C66.2984 182.1 67.3984 177.9 67.5984 177.1C67.5984 177.1 68.2984 175.1 68.7984 174.1C69.1984 173.2 69.6984 172.4 70.0984 171.6C70.5984 170.7 70.9984 169.8 71.3984 169C72.2984 167.2 73.1984 165.5 74.2984 163.8C74.7984 163 75.2984 162.3 75.4984 161.4C75.8984 160.5 75.6984 159.5 74.8984 160.1Z" fill="#C8856A"/>
                            <path d="M66.3988 167.4C66.2988 166.5 65.7988 165.6 64.9988 165.2C64.8988 165.1 64.7988 165.4 64.8988 165.5C65.5988 166 65.9988 166.9 65.9988 167.7C65.9988 168.7 65.7988 169.5 65.3988 170.5C65.3988 170.6 65.3988 170.8 65.4988 170.6C66.1988 169.8 66.4988 168.5 66.3988 167.4Z" fill="#AF6152"/>
                            <path d="M70.3992 161.2C70.6992 160.7 70.9992 160.1 71.2992 159.6C71.5992 159.1 71.8992 158.5 72.1992 158C72.3992 157.5 72.9992 156.7 72.9992 156.1C72.9992 156 72.8992 156.3 72.7992 156.3C72.3992 157 71.3992 158.9 70.9992 159.5C70.3992 160.6 69.6992 161.7 69.1992 162.9C69.1992 163 69.2992 163 69.2992 163C69.7992 162.4 69.9992 161.8 70.3992 161.2Z" fill="#AF6152"/>
                            <path d="M55.5979 182.9C53.0979 188.4 50.0979 193.4 50.0979 193.4C50.0979 193.4 35.1979 207 31.3979 211C27.5979 214.9 24.5979 223.9 28.4979 230.6C30.1979 227 30.8979 225.5 35.3979 222.1C41.1979 217.8 52.1979 209.8 55.4979 206.6C58.5979 203.6 60.6979 201.8 62.3979 196.3C62.9979 194.4 64.0979 190.2 65.1979 186.2C61.1979 186.4 58.0979 185.2 55.5979 182.9Z" fill="#E0E0E0"/>
                            <path d="M54 190.301C54 190.301 58.1 193.801 57.9 194.201C57.7 194.701 56.3 195.501 56.3 195.501L54 190.301Z" fill="#AF6152"/>
                            <path d="M44.2999 181.7C46.5999 182.1 50.2999 182.2 53.3999 187.5C53.8999 188.4 53.9999 190 54.4999 191.2C55.0999 192.5 56.0999 193.9 56.3999 195C58.1999 200.7 57.0999 203.5 56.3999 204.7C55.7999 205.7 51.6999 207.1 49.3999 207.1C46.4999 207 39.7999 205.8 35.7999 202.2C31.0999 197.9 28.4999 191.1 31.3999 187.3C35.5999 181.9 42.0999 181.2 44.2999 181.7Z" fill="#C8856A"/>
                            <path d="M56.2996 204.9C55.4996 205.7 52.7996 206.7 50.5996 207L49.5996 205.4C49.5996 205.4 51.4996 205.6 53.1996 205.5C54.8996 205.5 56.2996 204.9 56.2996 204.9Z" fill="#AF6152"/>
                            <path d="M51.0004 205.2L50.3004 212.8C50.3004 212.8 44.5004 214.6 38.4004 212.8L39.1004 208.7C42.1004 204.6 46.5004 203.5 51.0004 205.2Z" fill="#C8856A"/>
                            <path d="M46.6994 178.2C46.8994 178.2 47.0994 178.2 47.2994 178.2C48.3994 178.3 49.4994 178.6 50.3994 179.2C51.7994 180.1 52.8994 181.4 53.5994 182.9C53.9994 183.9 54.2994 184.9 54.0994 186C53.8994 187.1 53.0994 188 52.2994 188.7C52.4994 187.6 51.9994 186.3 50.9994 185.7C51.4994 186.9 51.5994 188.2 51.0994 189.4C50.6994 190.6 49.7994 191.6 48.5994 192.2C49.1994 192.8 49.4994 193.7 49.5994 194.5C49.5994 194.7 49.5994 195 49.4994 195.2C49.1994 195.8 48.4994 195.5 48.0994 195.2C47.7994 195 47.5994 194.8 47.2994 194.5C46.4994 193.9 45.9994 193.6 44.6994 193.7C43.7994 193.8 42.6994 194.8 42.6994 195.7C42.5994 197.4 43.5994 199 44.2994 199.7C45.2994 200.6 46.2994 201 47.1994 200.8C47.5994 200.7 48.5994 200.2 48.7994 199.5C48.7994 199.5 50.5994 204.1 47.0994 206.7C47.0994 206.7 43.1994 209 38.8994 208.6C38.3994 208.6 37.3994 207.5 36.9994 207.2C36.1994 206.6 35.3994 206.1 34.5994 205.6C33.1994 204.7 32.1994 203.7 31.0994 202.6C28.6994 200.2 27.2994 197 26.4994 193.6C25.8994 191.1 26.9994 187.8 26.9994 187.8C27.3994 186.5 27.4994 185.3 28.2994 184C28.9994 182.8 29.9994 181.8 31.0994 180.9C33.3994 179 36.3994 178 39.2994 177.6C40.9994 177.4 42.6994 177.5 44.3994 177.8C44.7994 177.9 45.1994 178 45.5994 178.1C46.0994 178.3 46.3994 178.2 46.6994 178.2Z" fill="#263238"/>
                            <path d="M29.0992 217.3C29.9992 213.9 31.0992 211.6 37.6992 211.9H38.5992C40.8992 212.2 42.7992 212.3 48.1992 211.7C53.6992 211.2 55.1992 210.8 56.7992 211.3C56.7992 211.3 63.7992 218.3 66.0992 225.8C67.8992 231.6 65.0992 235.5 63.7992 237C63.9992 243.9 65.0992 255.9 65.0992 255.9C65.0992 255.9 59.6992 262.4 44.2992 261.8C34.2992 261.4 28.7992 256 27.6992 254.2C27.6992 254.2 30.5992 246.7 30.6992 241.9C29.7992 235.2 26.3992 227.4 29.0992 217.3Z" class="theme-color" fill="#FF5722"/>
                            <path d="M20.9988 190.5C20.0988 192.3 19.7988 194.4 20.0988 196.3C20.5988 199.4 22.3988 202.2 23.0988 205.3C23.7988 208.3 21.3988 211.4 20.6988 214.3C19.3988 219.1 21.3988 224.7 25.2988 227.7C24.8988 226.4 24.7988 225.1 24.9988 223.8C25.0988 225.6 26.1988 227.2 27.5988 228.4C28.9988 229.5 30.6988 230.2 32.3988 230.9C30.6988 229.6 30.2988 227.1 30.7988 225C31.2988 222.9 32.4988 221 33.4988 219.1C34.4988 217.2 35.0988 215.2 35.6988 213.2C36.3988 210.8 35.6988 208.2 34.5988 206C33.3988 203.5 32.1988 201.1 31.2988 198.6C30.3988 196 29.9988 193.2 30.5988 190.6C30.6988 190 30.8988 189.3 30.8988 188.7C30.8988 186.8 29.2988 185.8 27.5988 186C25.5988 186.2 23.5988 187.2 22.1988 188.8C21.7988 189.2 21.3988 189.8 20.9988 190.5Z" fill="#263238"/>
                            <path d="M107.599 84.5996L51.6992 116.9V135.5L65.9992 143.8L70.8992 140.9V189L85.0992 197.2L102.799 187.1V122.5L121.899 111.5V92.7996L107.599 84.5996Z" fill="#37474F"/>
                            <path d="M85.1 132.699L66 143.799V125.099L121.9 92.7988V111.499L102.8 122.499V187.099L85.1 197.299V132.699Z" fill="#455A64"/>
                            <path d="M51.6992 116.9L65.9992 125.1L121.899 92.7996L107.599 84.5996L51.6992 116.9Z" fill="#455A64"/>
                            <path opacity="0.2" d="M51.6992 116.9L65.9992 125.1L121.899 92.7996L107.599 84.5996L51.6992 116.9Z" fill="white"/>
                            <path d="M85.0984 132.699L70.8984 140.899V188.999L85.0984 197.199V132.699Z" fill="#263238"/>
                            <path d="M89.6997 200.9C86.6997 204.2 83.3997 207.7 83.3997 207.7C83.3997 207.7 69.8997 209.9 63.0997 210.5C61.0997 210.7 59.0997 211.1 56.6997 211.4C56.6997 211.4 54.6997 216.4 58.1997 222.7C59.5997 225.3 62.4997 226.6 63.6997 226.9C65.9997 223.7 74.6998 222.5 82.7998 220C88.0998 218.4 89.6998 217.5 91.2998 215.5C92.3997 214.2 95.1997 209.6 97.5997 205.8C94.4997 205.2 91.5997 204.3 89.6997 200.9Z" fill="#E0E0E0"/>
                            <path d="M106.699 188.1C106.299 187.4 106.199 187.1 106.299 186.3C106.299 185.7 106.199 184.8 105.899 184.3C105.799 184.1 105.599 183.9 105.499 183.8C105.199 183.3 105.299 182.5 105.299 181.9C105.299 181.2 105.199 180.8 104.699 180.3C104.299 179.9 104.199 179.5 104.099 178.9C103.999 178.5 103.999 177 103.199 177.2C102.799 177.3 102.399 177.9 102.199 178.3C101.799 178.9 101.599 179.7 101.399 180.4C101.199 181.2 101.199 182 101.099 182.8C100.799 184.6 100.099 186.5 99.0992 188C98.8992 188.2 98.5992 188.7 98.2992 188.6C98.1992 188.5 97.9992 188.4 97.9992 188.2C97.8992 187.9 97.7992 187.6 97.7992 187.2C97.6992 186.9 97.5992 186.5 97.4992 186.2C97.2992 185.5 96.8992 184.6 96.1992 184.3C95.6992 184 94.9992 184 94.9992 184.7C94.9992 185.4 95.1992 186 95.1992 186.7C95.1992 187.4 94.9992 188.2 94.8992 188.9C94.7992 190 94.7992 191.2 94.9992 192.3C95.1992 193.3 95.2992 194.2 94.8992 195.2C94.7992 195.4 92.3992 198.1 89.6992 201C91.5992 204.4 94.4992 205.3 97.5992 206C99.3992 203 100.999 200.4 101.199 200.2C101.599 199.6 102.099 199 102.599 198.5C103.099 197.8 103.499 197.1 103.999 196.5C104.899 195.3 105.699 194 106.299 192.5C106.799 191.1 107.399 189.3 106.699 188.1Z" fill="#C8856A"/>
                            <path d="M59.7996 85.7992L55.3996 77.5992L58.8996 67.3992V61.1992L48.0996 67.3992V73.5992L52.6996 81.5992C52.7996 81.6992 52.8996 81.7992 52.9996 81.8992L59.7996 85.7992Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.2" d="M59.7996 85.7992L55.3996 77.5992L58.8996 67.3992V61.1992L48.0996 67.3992V73.5992L52.6996 81.5992C52.7996 81.6992 52.8996 81.7992 52.9996 81.8992L59.7996 85.7992Z" fill="black"/>
                            <path d="M85.4996 11.7992C85.4996 9.69922 84.0996 7.19922 82.2996 6.19922L79.6996 4.69922C77.8996 3.69922 74.9996 3.69922 73.1996 4.69922L32.7996 27.9992C30.9996 28.9992 29.5996 31.4992 29.5996 33.5992V77.9992C29.5996 80.0992 30.9996 82.5992 32.7996 83.5992L35.3996 85.0992C37.1996 86.0992 40.0996 86.0992 41.8996 85.0992L54.8996 77.5992L59.4996 85.5992C59.7996 86.0992 60.5996 85.9992 60.6996 85.4992L65.5996 71.3992L82.1996 61.7992C83.9996 60.7992 85.3996 58.2992 85.3996 56.1992L85.4996 11.7992Z" class="theme-color" fill="#FF5722"/>
                            <path opacity="0.2" d="M29.6 78C29.6 80.1 31 82.6 32.8 83.6L35.4 85.1C37 86 39.5 86.1 41.3 85.4C39.8 86 38.6 85.1 38.6 83.3V38.9C38.6 37.9 39 36.7 39.5 35.7L30.4 30.5C29.8 31.5 29.5 32.7 29.5 33.7V78H29.6Z" fill="black"/>
                            <path opacity="0.3" d="M85.4 10.7996C85 9.49961 83.8 8.99961 82.3 9.89961L41.9 33.1996C41 33.6996 40.2 34.5996 39.6 35.5996L30.5 30.3996C31.1 29.3996 31.9 28.4996 32.8 27.9996L73.2 4.59961C75 3.59961 77.9 3.59961 79.7 4.59961L82.3 6.09961C83.8 6.99961 85.1 8.99961 85.4 10.7996Z" fill="white"/>
                            <path d="M49.9004 48.4006C49.9004 46.0006 50.5004 43.4006 51.4004 41.2006C52.5004 38.6006 54.2004 36.4006 56.0004 35.3006C59.1004 33.5006 61.8004 37.2006 62.2004 41.7006C62.6004 36.8006 65.1004 30.0006 68.3004 28.1006C70.1004 27.0006 71.8004 27.3006 72.9004 28.6006C73.9004 29.7006 74.5004 31.6006 74.5004 34.0006C74.5004 41.5006 70.0004 48.3006 66.3004 55.5006L62.2004 62.4006L58.3004 60.2006C54.5004 57.4006 50.0004 55.9006 49.9004 48.4006Z" fill="#FAFAFA"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_555_32083">
                            <rect width="447.2" height="433.1" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                         @else
                            <img id="svg_text_preview"
                                src="{{ isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text :'' }}">
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
