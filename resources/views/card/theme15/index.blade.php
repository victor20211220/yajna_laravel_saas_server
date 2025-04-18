@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme15">
@else
<div class="{{ $business->theme_color }}" id="view_theme15">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="surgeon-card">
                <section class="profile-sec pb">
                    <div class="profile-banner">
                        <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme15/images/profile-banner-img.png') }}" class="profile-banner-img" alt="profile-banner" id="banner_preview"
                                loading="lazy">
                            <div class="section-title">
                                <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                            </div>
                    </div>
                    <div class="container">
                        <div class="client-info-wrp text-center">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme15/images/client-image.png') }}"   alt="client-image" loading="lazy">
                            </div>
                            <div class="client-info">
                                <h2 id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</h2>
                                <span id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</span>
                                <p id="{{ $stringid . '_desc' }}_preview"> {!! nl2br(e($business->description)) !!}</p>
                            </div>
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
                                                <img src="{{ asset('custom/theme15/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                @if ($order_key == 'contact_info')
                <section class="contact-info-sec pb" id="contact-div">
                    <div class="section-title common-title text-center">
                        <h2>{{ __('Contact Us') }}</h2>
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
                                                        <img src="{{ asset('custom/theme15/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                            <img src="{{ asset('custom/theme15/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                        </div>
                                                            <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                    @else
                                                        <div class="contact-image">
                                                            <img src="{{ asset('custom/theme15/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                @if ($order_key == 'service')
                <section class="service-sec pb" id="services-div">
                    <div class="section-title common-title text-center">
                        <h2>{{ __('Services') }}</h2>
                    </div>
                    <div class="container">
                        @if (isset($is_pdf))
                            @php $image_count = 0; @endphp
                            @foreach ($services_content as $k1 => $content)
                                <div class="service-card edit-card" id="services_{{ $service_row_nos }}">
                                    <div class="service-card-inner">
                                        <div class="service-card-image">
                                            <div class="img-wrapper">
                                                <img id="{{ 's_image' . $image_count . '_preview' }}"
                                                    width="28" height="28"
                                                    src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    class="img-fluid" alt="service-image">
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
                        <div class="service-slider" id="inputrow_service_preview">
                            @php $image_count = 0; @endphp
                            @foreach ($services_content as $k1 => $content)
                                <div class="service-card" id="services_{{ $service_row_nos }}">
                                    <div class="service-card-inner">
                                        <div class="service-card-image">
                                            <div class="img-wrapper">
                                                <img id="{{ 's_image' . $image_count . '_preview' }}"
                                                    width="28" height="28"
                                                    src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    class="img-fluid" alt="service-image">
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
                               <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/>
                                </svg>
                            </div>
                            <div class="slick-next slick-arrow service-arrow">
                               <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/>
                                </svg>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                @endif
                @if ($order_key == 'bussiness_hour')
                <section class="business-hour-sec pb" id="business-hours-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Business Hours') }}</h2>
                        </div>
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
                </section>
                @endif
                @if ($order_key == 'gallery')
                <section class="gallery-sec pb" id="gallery-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
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
                               <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/>
                                </svg>
                            </div>
                            <div class="slick-next slick-arrow gallery-arrow">
                               <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/>
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
                                <button type="button" class="btn appointment-btn">{{__('Make An Appointment')}}</button>
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
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}" class="save-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.545 5.28945C14.5941 5.02654 14.6189 4.75968 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C8.22526 0.00227634 6.53772 1.18703 5.89324 2.96474C4.73932 2.5054 3.4315 3.06844 2.97212 4.22236C2.93236 4.32224 2.89981 4.42482 2.87475 4.52935C1.03224 4.8049 -0.237997 6.52193 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7395 6.87066 15.3023 5.92967 14.545 5.28945Z" fill="#111111"></path>
                                        <path d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659L8.99889 13.8173V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V13.8173L6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z" fill="#111111"></path>
                                    </svg>
                                    <span>{{ __('Save') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="share-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.28377 9.4228C6.04018 9.32536 5.89402 9.03304 5.99146 8.78945C7.30688 5.28165 10.3275 2.74824 13.9814 2.11489L11.8865 0.945621C11.6429 0.799463 11.5455 0.507147 11.6916 0.26355C11.8378 0.0199526 12.1301 -0.0774863 12.3737 0.0686719L15.5405 1.82257C15.7841 1.96873 15.8815 2.26105 15.7353 2.50464L14.0302 5.57397C13.9327 5.72012 13.7866 5.81756 13.5917 5.81756C13.4942 5.81756 13.3968 5.81756 13.3481 5.76884C13.1045 5.62268 13.0071 5.33037 13.1532 5.08677L14.3225 3.04056C10.9608 3.57647 8.13511 5.915 6.91713 9.08176C6.81969 9.27664 6.62481 9.4228 6.42993 9.4228H6.28377ZM14.8107 7.9125C14.8107 7.62019 15.0056 7.42531 15.2979 7.42531C15.5902 7.42531 15.7851 7.66891 15.7851 7.9125V11.7126C15.7851 14.0999 13.885 15.9999 11.4978 15.9999H4.2873C1.94877 15.9999 -3.22908e-06 14.0999 -3.22908e-06 11.7126V4.50214C-3.22908e-06 2.16361 1.90005 0.214836 4.2873 0.214836H7.94126C8.23358 0.214836 8.42846 0.409714 8.42846 0.70203C8.42846 0.994347 8.23358 1.18922 7.94126 1.18922H4.2873C2.48469 1.18922 0.974385 2.65081 0.974385 4.50214V11.7126C0.974385 13.564 2.43597 15.0255 4.2873 15.0255H11.4978C13.3004 15.0255 14.8107 13.564 14.8107 11.7126V7.9125Z" fill="#111111"></path>
                                    </svg>
                                    <span>{{ __('Share') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M13.4595 2.09597C12.1078 0.744271 10.3106 -7.56008e-05 8.39908 5.7592e-09C8.08584 5.7592e-09 7.83203 0.253887 7.83203 0.567049C7.83203 0.880212 8.08592 1.1341 8.39908 1.1341C10.0077 1.13402 11.52 1.76042 12.6575 2.89792C13.7951 4.03543 14.4215 5.54786 14.4214 7.15654C14.4214 7.4697 14.6753 7.72359 14.9885 7.72359C15.3017 7.72359 15.5555 7.4697 15.5555 7.15662C15.5556 5.2449 14.8113 3.44766 13.4595 2.09597Z" fill="#111111"></path>
                                        <path d="M11.1269 7.15651C11.1269 7.46967 11.3808 7.72356 11.694 7.72348C12.0072 7.72348 12.261 7.4696 12.261 7.15643C12.2608 5.02735 10.5284 3.29498 8.39916 3.29468C8.39908 3.29468 8.39923 3.29468 8.39916 3.29468C8.08599 3.29468 7.83211 3.54849 7.83203 3.86165C7.83203 4.17481 8.08584 4.4287 8.399 4.42878C9.90305 4.429 11.1267 5.65262 11.1269 7.15651Z" fill="#111111"></path>
                                        <path d="M9.87051 10.0477C9.00618 10.0029 8.56585 10.6457 8.35468 10.9545C8.17783 11.213 8.24406 11.5659 8.50256 11.7427C8.76106 11.9195 9.11392 11.8533 9.29076 11.5948C9.54026 11.23 9.6533 11.1726 9.80663 11.1799C10.2974 11.2376 12.2303 12.654 12.4238 13.0969C12.4724 13.2273 12.4705 13.3552 12.4185 13.5107C12.2155 14.113 11.8796 14.5362 11.4468 14.7346C11.0357 14.9231 10.5316 14.906 9.98944 14.6854C7.96492 13.8602 6.19619 12.7086 4.73244 11.2626C4.73184 11.262 4.73123 11.2615 4.7307 11.2609C3.28768 9.79855 2.13823 8.03207 1.31442 6.01066C1.09372 5.46803 1.07664 4.96388 1.26512 4.55281C1.46352 4.12004 1.88676 3.78412 2.48851 3.58142C2.64457 3.5291 2.77219 3.52744 2.9014 3.57552C3.34589 3.76975 4.76223 5.70256 4.81939 6.1878C4.82756 6.34688 4.76972 6.45984 4.40522 6.70888C4.14664 6.8855 4.08018 7.23836 4.25688 7.49693C4.43349 7.75551 4.78627 7.82189 5.04492 7.64527C5.35385 7.43433 5.99651 6.99521 5.9519 6.12792C5.90276 5.22201 4.14052 2.82293 3.29849 2.51332C2.92401 2.37375 2.5301 2.37134 2.12727 2.50652C1.22089 2.81174 0.566293 3.35596 0.234229 4.08027C-0.0878549 4.78296 -0.077648 5.59822 0.264094 6.43836C1.14574 8.60162 2.37926 10.4944 3.93033 12.0644C3.93411 12.0683 3.93797 12.072 3.9419 12.0757C5.51074 13.6239 7.40135 14.8552 9.56174 15.7358C9.99436 15.9117 10.4204 15.9998 10.8278 15.9998C11.2115 15.9998 11.5788 15.9218 11.9195 15.7656C12.6438 15.4336 13.188 14.7791 13.4934 13.8721C13.6283 13.47 13.6261 13.0762 13.4876 12.7035C13.1769 11.8592 10.7779 10.097 9.87051 10.0477Z" fill="#111111"></path>
                                    </svg>
                                    <span>{{ __('Contact') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif
                @if ($order_key == 'testimonials')
                <section class="testimonial-sec pb"  id="testimonials-div">
                    <div class="section-title common-title text-center">
                        <h2>{{ __('Testimonials') }}</h2>
                    </div>
                    @if (isset($is_pdf))
                        @php
                        $t_image_count = 0;
                        $rating = 0;
                        @endphp
                        @foreach ($testimonials_content as $k2 => $testi_content)
                            <div class="testimonial-card edit-card" id="testimonials_{{ $testimonials_row_nos }}">
                                <div class="testimonial-card-inner">
                                    <div class="testimonial-image img-wrapper">
                                        <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                            src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                            alt="testimonial image" loading="lazy">
                                    </div>
                                    <div class="testimonial-content">
                                        <div class="testimonial-content-top">
                                            <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                            </h3>
                                            <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
                                        </div>
                                        <div class="testimonial-content-bottom">
                                            <div class="testimonial-info-wrp d-flex align-items-center justify-content-between">
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
                                    </div>
                                </div>
                            </div>
                            @php
                            $t_image_count++;
                            $testimonials_row_nos++;
                            @endphp
                        @endforeach
                    @else
                    <div class="container">
                        <div class="slider-wrp">
                            <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                @php
                                $t_image_count = 0;
                                $rating = 0;
                                @endphp
                                @foreach ($testimonials_content as $k2 => $testi_content)
                                    <div class="testimonial-card" id="testimonials_{{ $testimonials_row_nos }}">
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-image img-wrapper">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
                                            </div>
                                            <div class="testimonial-content">
                                                <div class="testimonial-content-top">
                                                    <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                        {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                    </h3>
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
                                                </div>
                                                <div class="testimonial-content-bottom">
                                                    <div class="testimonial-info-wrp d-flex align-items-center justify-content-between">
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
                                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow testimonial-arrow">
                                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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
                    </div>
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
                    <section class="custom-text-sec pb" id="svg-div">
                        <div class="container">
                           <div class="thankyou-svg mb">
                        @if(empty($business->svg_text))
                        <svg width="569" height="429" viewBox="0 0 569 429" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M413.9 429.001C499.468 429.001 568.835 422.099 568.835 413.584C568.835 405.07 499.468 398.168 413.9 398.168C328.332 398.168 258.965 405.07 258.965 413.584C258.965 422.099 328.332 429.001 413.9 429.001Z" fill="#F7E8F1"/>
                                <path d="M131.538 179.264H106.215V18.1113H131.538V87.1767H160.316V18.1113H186.1V179.264H160.316V110.198H131.538V179.264Z" fill="#3F3131"/>
                                <path d="M253.856 212.422V336.739C253.856 348.249 258.921 352.395 266.978 352.395C275.036 352.395 280.1 348.25 280.1 336.739V212.422H304.043V335.127C304.043 360.911 291.151 375.646 266.288 375.646C241.424 375.646 228.531 360.912 228.531 335.127V212.422H253.856Z" fill="#68C8D8" class="theme-color"/>
                                <path d="M292.822 173.693H267.267L262.893 144.456H231.814L227.439 173.693H204.188L229.972 12.541H267.037L292.822 173.693ZM235.037 122.584H259.44L247.238 41.0878L235.037 122.584Z" fill="#3F3131"/>
                                <path d="M326.83 56.8554V173.576H304.039V12.4238H335.808L361.823 108.885V12.4238H384.384V173.576H358.369L326.83 56.8554Z" fill="#3F3131"/>
                                <path d="M451.084 99.4669L445.904 114.608L453.409 161.482L429.427 165.322L404.992 12.7069L428.975 8.86685L439.622 75.3635L460.371 3.84002L484.354 0L461.886 73.3635L508.787 152.615L484.152 156.559L451.084 99.4669Z" fill="#3F3131"/>
                                <path d="M139.91 251.097C139.91 225.312 153.494 210.578 178.356 210.578C203.22 210.578 216.802 225.312 216.802 251.097V334.896C216.802 360.681 203.219 375.415 178.356 375.415C153.493 375.415 139.91 360.681 139.91 334.896V251.097ZM165.234 336.508C165.234 348.019 170.299 352.393 178.356 352.393C186.414 352.393 191.478 348.019 191.478 336.508V249.486C191.478 237.975 186.414 233.601 178.356 233.601C170.299 233.601 165.234 237.975 165.234 249.486V336.508Z" fill="#68C8D8" class="theme-color"/>
                                <path d="M81.102 323.879L49.1016 216.137H75.5767L94.915 289.576L114.253 216.137H138.426L106.425 323.879V377.29H81.102V323.879Z" fill="#68C8D8" class="theme-color"/>
                                <path d="M0.367188 55.7611L76.7223 38.2129L81.8842 60.6708L56.0565 66.6062L87.0255 201.35L62.3226 207.029L31.3535 72.2837L5.52837 78.219L0.367188 55.7611Z" fill="#3F3131"/>
                                <path d="M377.225 406.899L376.125 401.017L386.618 398.586L387.929 404.338C388.629 406.15 393.95 409.125 396.582 410.507C398.157 410.849 399.566 411.19 400.803 411.546C402.138 411.931 404.549 411.396 405.463 411.84C406.408 412.299 406.475 413.746 406.305 414.31C402.698 415.173 397.227 416.352 397.227 416.352C393.781 417.176 392.73 417.872 386.953 414.013C381.161 410.146 377.225 406.899 377.225 406.899Z" fill="#F2AF91"/>
                                <path d="M377.228 406.898C379.628 407.933 387.019 415.429 392.313 416.511C392.736 414.959 394.758 411.288 396.585 410.506C398.159 410.849 399.568 411.19 400.805 411.545C397.958 412.603 397.229 416.351 397.229 416.351C397.229 416.351 402.533 415.213 406.307 414.309C406.596 414.664 406.728 415.277 406.501 415.55L398.178 417.542L391.346 419.177C389.707 418.815 386.88 415.641 385.176 416.532C383.472 417.422 384.221 420.882 384.221 420.882L380.453 421.783C380.453 421.783 378.056 413.74 377.053 410.79C376.478 409.103 377.228 406.898 377.228 406.898Z" fill="#111111"/>
                                <path d="M374.922 274.025L386.673 339.516L395.737 399.129L370.947 404.834C370.947 404.834 362.99 373.667 356.061 348.431C352.217 334.429 341.903 292.248 340.227 287.099L374.922 274.025Z" fill="#111111"/>
                                <path d="M358.068 321.974C358.089 321.974 358.111 321.971 358.132 321.966C358.281 321.931 358.373 321.782 358.338 321.633L358.147 320.826C358.113 320.678 357.968 320.586 357.814 320.621C357.666 320.656 357.574 320.804 357.609 320.953L357.8 321.761C357.829 321.888 357.942 321.974 358.068 321.974Z" fill="#F3E5CC"/>
                                <path d="M376.505 400.119C376.526 400.119 376.548 400.116 376.569 400.111C376.718 400.076 376.81 399.927 376.775 399.778L376.39 398.151C376.355 398.003 376.21 397.909 376.057 397.945C375.909 397.98 375.817 398.129 375.852 398.278L376.237 399.906C376.267 400.033 376.38 400.119 376.505 400.119ZM375.481 395.777C375.501 395.777 375.523 395.774 375.544 395.769C375.693 395.735 375.785 395.586 375.75 395.437L375.366 393.809C375.331 393.661 375.184 393.568 375.034 393.604C374.885 393.638 374.793 393.787 374.828 393.936L375.212 395.563C375.241 395.691 375.356 395.777 375.481 395.777ZM374.457 391.435C374.477 391.435 374.499 391.433 374.521 391.428C374.669 391.392 374.761 391.244 374.726 391.095L374.342 389.467C374.307 389.32 374.162 389.226 374.009 389.262C373.86 389.297 373.768 389.446 373.803 389.595L374.188 391.222C374.218 391.35 374.331 391.435 374.457 391.435ZM373.432 387.094C373.452 387.094 373.474 387.092 373.495 387.087C373.644 387.052 373.736 386.903 373.7 386.755L373.317 385.127C373.282 384.979 373.136 384.886 372.984 384.921C372.835 384.956 372.743 385.105 372.779 385.253L373.162 386.881C373.192 387.009 373.306 387.094 373.432 387.094ZM372.408 382.753C372.429 382.753 372.45 382.75 372.472 382.745C372.62 382.71 372.713 382.561 372.677 382.412L372.293 380.785C372.258 380.637 372.115 380.544 371.96 380.579C371.812 380.615 371.72 380.763 371.755 380.912L372.139 382.54C372.169 382.667 372.282 382.753 372.408 382.753ZM371.383 378.412C371.404 378.412 371.425 378.409 371.447 378.404C371.596 378.369 371.688 378.221 371.652 378.071L371.268 376.444C371.233 376.296 371.088 376.203 370.935 376.238C370.787 376.274 370.695 376.422 370.73 376.571L371.114 378.199C371.144 378.326 371.258 378.412 371.383 378.412ZM370.359 374.07C370.379 374.07 370.401 374.068 370.422 374.063C370.571 374.028 370.663 373.879 370.628 373.73L370.244 372.103C370.21 371.954 370.063 371.862 369.912 371.897C369.763 371.932 369.671 372.081 369.706 372.23L370.09 373.857C370.12 373.984 370.233 374.07 370.359 374.07ZM369.335 369.729C369.355 369.729 369.377 369.727 369.399 369.722C369.547 369.686 369.639 369.538 369.604 369.389L369.219 367.761C369.184 367.613 369.041 367.52 368.887 367.556C368.738 367.591 368.646 367.739 368.681 367.889L369.066 369.516C369.096 369.643 369.209 369.729 369.335 369.729ZM368.31 365.388C368.33 365.388 368.352 365.385 368.373 365.38C368.522 365.345 368.614 365.196 368.578 365.048L368.194 363.42C368.16 363.272 368.011 363.179 367.862 363.215C367.713 363.249 367.621 363.398 367.656 363.547L368.04 365.175C368.07 365.302 368.184 365.388 368.31 365.388ZM367.285 361.046C367.306 361.046 367.328 361.043 367.349 361.038C367.498 361.004 367.589 360.855 367.554 360.706L367.17 359.079C367.136 358.93 366.989 358.837 366.838 358.873C366.689 358.907 366.597 359.056 366.632 359.205L367.016 360.832C367.046 360.96 367.16 361.046 367.285 361.046ZM366.261 356.705C366.281 356.705 366.303 356.702 366.325 356.697C366.473 356.662 366.566 356.514 366.53 356.365L366.146 354.737C366.111 354.59 365.967 354.496 365.813 354.532C365.665 354.567 365.573 354.715 365.608 354.864L365.992 356.492C366.022 356.619 366.136 356.705 366.261 356.705ZM365.237 352.363C365.257 352.363 365.279 352.361 365.3 352.356C365.449 352.321 365.541 352.172 365.506 352.024L365.122 350.396C365.088 350.248 364.939 350.155 364.79 350.191C364.641 350.225 364.55 350.374 364.584 350.523L364.968 352.15C364.997 352.278 365.111 352.363 365.237 352.363ZM364.212 348.022C364.233 348.022 364.255 348.02 364.276 348.015C364.425 347.98 364.517 347.831 364.482 347.682L364.097 346.054C364.062 345.907 363.916 345.813 363.765 345.849C363.616 345.884 363.524 346.033 363.559 346.182L363.944 347.809C363.974 347.937 364.087 348.022 364.212 348.022ZM363.187 343.681C363.208 343.681 363.23 343.678 363.251 343.673C363.4 343.638 363.492 343.49 363.457 343.34L363.072 341.713C363.037 341.566 362.894 341.472 362.74 341.507C362.591 341.543 362.499 341.691 362.534 341.84L362.919 343.468C362.949 343.595 363.063 343.681 363.187 343.681ZM362.163 339.339C362.184 339.339 362.205 339.337 362.226 339.331C362.376 339.297 362.468 339.148 362.432 338.999L362.048 337.372C362.013 337.223 361.868 337.131 361.715 337.166C361.567 337.2 361.475 337.349 361.51 337.498L361.894 339.125C361.924 339.253 362.038 339.339 362.163 339.339ZM361.139 334.998C361.159 334.998 361.181 334.996 361.203 334.991C361.351 334.955 361.443 334.807 361.408 334.658L361.024 333.03C360.988 332.883 360.843 332.79 360.691 332.825C360.543 332.86 360.45 333.008 360.486 333.158L360.87 334.785C360.9 334.912 361.013 334.998 361.139 334.998ZM360.115 330.657C360.135 330.657 360.157 330.654 360.178 330.649C360.327 330.614 360.418 330.465 360.383 330.317L359.999 328.689C359.965 328.541 359.817 328.449 359.667 328.484C359.518 328.518 359.426 328.667 359.461 328.816L359.845 330.444C359.875 330.571 359.989 330.657 360.115 330.657ZM359.09 326.316C359.111 326.316 359.132 326.313 359.154 326.308C359.303 326.273 359.395 326.124 359.36 325.975L358.975 324.348C358.94 324.2 358.795 324.107 358.642 324.142C358.494 324.177 358.402 324.326 358.437 324.475L358.821 326.103C358.852 326.23 358.965 326.316 359.09 326.316Z" fill="#F3E5CC"/>
                                <path d="M377.341 403.638C377.361 403.638 377.383 403.635 377.404 403.63C377.553 403.596 377.646 403.447 377.61 403.298L377.42 402.491C377.386 402.342 377.238 402.25 377.088 402.285C376.939 402.319 376.848 402.468 376.882 402.617L377.072 403.424C377.102 403.552 377.216 403.638 377.341 403.638Z" fill="#F3E5CC"/>
                                <path d="M361.699 187.699C370.051 187.43 378.534 188.81 379.413 201.539C380.292 214.268 378.531 212.713 381.168 219.56C383.806 226.407 386.666 231.741 386.556 239.762C386.556 239.762 364.545 249.568 361.354 224.945C358.162 200.323 361.699 187.699 361.699 187.699Z" fill="#111111"/>
                                <path d="M375.269 229.54C377.608 232.718 382.484 252.009 388.713 258.362C394.18 263.939 413.614 271.326 418.28 273.048C420.059 270.075 426.706 269.371 427.792 269.941C429.124 270.639 425.477 272.782 425.477 272.782C426.273 272.786 426.587 273.436 432.243 273.852C434.983 274.053 435.042 275.718 433.349 276.063C435.635 275.878 436.03 278.884 432.694 278.335C434.973 278.683 434.371 280.644 431.971 280.53C431.15 280.491 430.59 280.493 430.186 280.399C432.331 280.802 432.349 282.507 429.869 282.222C428.203 282.031 425.249 281.861 417.01 279.04C412.981 278.11 393.637 273.412 381.843 266.323C370.774 259.671 366.177 236.855 366.177 236.855C364.305 229.871 370.083 222.495 375.269 229.54Z" fill="#FFB494"/>
                                <path d="M432.388 276.374C432.994 276.374 433.348 276.341 433.385 276.339C433.537 276.324 433.648 276.188 433.633 276.037C433.618 275.885 433.484 275.783 433.331 275.788C433.309 275.79 431.083 275.993 427.955 275.334C427.804 275.303 427.658 275.398 427.627 275.547C427.596 275.697 427.691 275.844 427.84 275.875C429.818 276.291 431.423 276.374 432.388 276.374Z" fill="#FF816E"/>
                                <path d="M432.988 278.616C433.126 278.616 433.206 278.614 433.222 278.613C433.375 278.609 433.496 278.481 433.491 278.329C433.487 278.176 433.362 278.06 433.206 278.06C433.181 278.059 430.815 278.121 427.673 277.459C427.522 277.428 427.377 277.523 427.346 277.672C427.314 277.822 427.41 277.969 427.559 278C430.23 278.563 432.308 278.616 432.988 278.616Z" fill="#FF816E"/>
                                <path d="M430.494 280.746C430.638 280.746 430.759 280.636 430.77 280.49C430.781 280.338 430.667 280.205 430.515 280.193C430.493 280.192 428.221 280.018 426.95 279.694C426.805 279.656 426.652 279.746 426.614 279.894C426.576 280.042 426.666 280.193 426.814 280.231C428.131 280.566 430.379 280.739 430.474 280.746C430.48 280.746 430.487 280.746 430.494 280.746Z" fill="#FF816E"/>
                                <path opacity="0.6" d="M383.101 261.454C385.635 261.802 387.407 264.139 387.059 266.674C386.963 267.372 386.617 268.155 386.256 268.71C384.706 267.948 383.22 267.153 381.841 266.324C380.635 265.6 379.522 264.683 378.492 263.624C378.514 263.607 378.534 263.589 378.556 263.573C379.496 262.085 381.244 261.198 383.101 261.454Z" fill="#FF816E"/>
                                <path d="M422.511 275.234C422.527 275.234 422.543 275.233 422.56 275.231C424.191 274.943 425.634 273.03 425.695 272.948C425.786 272.826 425.761 272.653 425.638 272.561C425.517 272.47 425.343 272.494 425.251 272.617C425.237 272.635 423.877 274.436 422.463 274.685C422.313 274.712 422.212 274.856 422.239 275.006C422.263 275.14 422.38 275.234 422.511 275.234Z" fill="#FF816E"/>
                                <path d="M355.82 206.136C355.82 208.94 354.564 211.568 355.82 213.642C357.622 216.615 362.554 219.382 365.765 219.382C371.215 219.382 375.555 212.961 375.555 206.136C375.555 199.312 371.137 193.779 365.688 193.779C360.238 193.779 355.82 199.312 355.82 206.136Z" fill="#FFB494"/>
                                <path d="M361.206 205.132L361.209 205.134C361.341 205.196 361.48 205.233 361.622 205.257C361.695 205.269 361.766 205.267 361.842 205.272C362.112 204.902 362.421 204.589 362.799 204.335C363.226 204.053 363.743 203.862 364.272 203.88C364.8 203.896 365.299 204.102 365.693 204.407C366.091 204.713 366.404 205.094 366.638 205.527C366.659 205.566 366.649 205.616 366.611 205.643C366.571 205.671 366.516 205.662 366.487 205.622L366.483 205.616C366.22 205.245 365.879 204.917 365.506 204.676C365.13 204.435 364.698 204.308 364.277 204.331C363.856 204.363 363.453 204.52 363.105 204.778C362.763 205.034 362.451 205.379 362.222 205.724L362.19 205.775C362.131 205.868 362.011 205.905 361.908 205.857C361.739 205.778 361.606 205.691 361.469 205.59C361.336 205.491 361.212 205.376 361.113 205.245C361.096 205.223 361.093 205.194 361.105 205.167C361.123 205.13 361.168 205.114 361.206 205.132Z" fill="#111111"/>
                                <path d="M371.48 204.792C371.873 204.487 372.374 204.281 372.901 204.265C373.43 204.247 373.948 204.438 374.374 204.72C374.752 204.975 375.062 205.287 375.332 205.657C375.407 205.652 375.479 205.654 375.552 205.642C375.694 205.619 375.833 205.581 375.965 205.519L375.968 205.518C375.993 205.506 376.023 205.509 376.046 205.526C376.079 205.551 376.085 205.598 376.06 205.631C375.96 205.762 375.836 205.876 375.703 205.976C375.566 206.077 375.433 206.164 375.264 206.242C375.165 206.289 375.043 206.255 374.982 206.16L374.95 206.109C374.722 205.764 374.41 205.419 374.067 205.163C373.719 204.905 373.317 204.747 372.896 204.716C372.474 204.692 372.043 204.819 371.667 205.061C371.294 205.302 370.953 205.63 370.69 206.001L370.685 206.006C370.66 206.043 370.61 206.055 370.57 206.033C370.527 206.01 370.511 205.955 370.534 205.912C370.77 205.479 371.081 205.097 371.48 204.792Z" fill="#111111"/>
                                <path d="M374.419 205.44C374.419 206.059 373.917 206.56 373.299 206.56C372.681 206.56 372.18 206.058 372.18 205.44C372.18 204.822 372.681 204.32 373.299 204.32C373.918 204.32 374.419 204.821 374.419 205.44Z" fill="#111111"/>
                                <path d="M365.919 205.139C365.919 205.758 365.417 206.259 364.799 206.259C364.181 206.259 363.68 205.757 363.68 205.139C363.68 204.52 364.181 204.02 364.799 204.02C365.417 204.019 365.919 204.52 365.919 205.139Z" fill="#111111"/>
                                <path d="M368.851 205.631C368.896 205.015 368.985 204.39 369.217 203.806C369.229 203.777 369.26 203.757 369.292 203.76C369.332 203.764 369.362 203.8 369.358 203.84C369.319 204.444 369.331 205.04 369.349 205.64C369.368 206.184 369.4 206.732 369.436 207.271C369.665 207.373 369.881 207.488 370.082 207.659C370.324 207.861 370.589 208.203 370.539 208.618C370.482 209.023 370.207 209.248 369.979 209.445C369.73 209.627 369.464 209.758 369.193 209.871C369.164 209.884 369.13 209.876 369.109 209.852C369.083 209.821 369.087 209.775 369.118 209.749L369.122 209.745C369.34 209.558 369.562 209.385 369.745 209.186C369.915 208.988 370.072 208.766 370.066 208.579C370.063 208.226 369.526 207.899 369.065 207.733L369.058 207.731C368.956 207.694 368.879 207.601 368.869 207.486C368.817 206.863 368.809 206.25 368.851 205.631Z" fill="#FF816E"/>
                                <path opacity="0.6" d="M360.881 208.507C360.362 210.742 364.883 211.614 365.362 209.547C365.915 207.165 361.434 206.126 360.881 208.507Z" fill="#FF816E"/>
                                <path opacity="0.6" d="M374.819 209.396C375.284 211.4 371.859 212.037 371.428 210.183C370.932 208.048 374.323 207.261 374.819 209.396Z" fill="#FF816E"/>
                                <path d="M362.2 208.423C361.944 208.665 361.735 208.941 361.538 209.226C361.34 209.51 361.152 209.8 360.989 210.11C360.97 210.146 360.984 210.191 361.02 210.21C361.05 210.226 361.086 210.219 361.109 210.196C361.35 209.942 361.566 209.671 361.771 209.393C361.977 209.115 362.173 208.829 362.32 208.509C362.337 208.471 362.32 208.427 362.283 208.409C362.254 208.396 362.222 208.402 362.2 208.423Z" fill="#FF816E"/>
                                <path d="M361.407 207.991C361.144 208.255 360.924 208.552 360.703 208.847C360.494 209.151 360.282 209.453 360.117 209.788C360.099 209.825 360.114 209.869 360.151 209.888C360.18 209.902 360.214 209.895 360.236 209.874C360.501 209.61 360.719 209.312 360.94 209.017C361.149 208.713 361.359 208.41 361.526 208.076C361.545 208.04 361.53 207.995 361.493 207.977C361.464 207.962 361.429 207.969 361.407 207.991Z" fill="#FF816E"/>
                                <path d="M373.672 209.58C373.708 209.836 373.793 210.071 373.889 210.302C373.984 210.534 374.09 210.762 374.221 210.978C374.24 211.01 374.28 211.02 374.312 211.001C374.337 210.986 374.347 210.957 374.342 210.93C374.291 210.682 374.214 210.443 374.126 210.209C374.039 209.974 373.941 209.744 373.794 209.532C373.773 209.502 373.731 209.495 373.701 209.516C373.679 209.531 373.669 209.556 373.672 209.58Z" fill="#FF816E"/>
                                <path d="M374.43 209.321C374.451 209.519 374.517 209.7 374.58 209.882C374.656 210.058 374.729 210.236 374.851 210.395C374.874 210.425 374.916 210.43 374.946 210.407C374.965 210.393 374.974 210.37 374.972 210.347C374.953 210.148 374.886 209.968 374.823 209.786C374.745 209.61 374.671 209.433 374.552 209.273C374.529 209.243 374.486 209.237 374.457 209.26C374.437 209.274 374.428 209.298 374.43 209.321Z" fill="#FF816E"/>
                                <path d="M367.697 201.841C367.414 201.238 366.906 200.877 366.401 200.656C365.889 200.426 365.34 200.343 364.802 200.348C364.265 200.368 363.734 200.476 363.26 200.711C362.786 200.936 362.363 201.26 362.061 201.688L362.056 201.696C361.979 201.804 362.005 201.954 362.113 202.03C362.162 202.064 362.219 202.078 362.274 202.073C362.744 202.027 363.168 202 363.571 201.976C363.974 201.96 364.363 201.97 364.74 202.009C365.487 202.075 366.232 202.265 366.794 202.527L366.943 202.596C367.227 202.729 367.565 202.605 367.697 202.321C367.77 202.164 367.764 201.988 367.697 201.841Z" fill="#111111"/>
                                <path d="M371.941 202.819C372.179 202.684 372.412 202.59 372.653 202.492C372.9 202.408 373.153 202.331 373.424 202.291C373.694 202.241 373.981 202.221 374.297 202.226C374.611 202.241 374.96 202.263 375.366 202.308L375.396 202.311C375.509 202.323 375.61 202.242 375.623 202.128C375.628 202.08 375.616 202.032 375.591 201.994C375.363 201.642 375.041 201.336 374.646 201.139C374.255 200.929 373.797 200.832 373.336 200.836C372.875 200.851 372.408 200.965 372.002 201.212C371.595 201.45 371.243 201.832 371.083 202.316C370.998 202.576 371.139 202.855 371.398 202.94C371.535 202.985 371.677 202.967 371.794 202.901L371.941 202.819Z" fill="#111111"/>
                                <path d="M368.785 214.512C368.295 214.292 367.812 214.173 367.331 214.077C366.849 213.989 366.366 213.917 365.894 213.805C365.421 213.695 364.958 213.56 364.499 213.403C364.045 213.236 363.608 213.036 363.163 212.798L363.155 212.794C363.071 212.749 362.967 212.781 362.922 212.864C362.889 212.927 362.899 213.001 362.94 213.053C363.623 213.896 364.629 214.424 365.64 214.739C366.152 214.886 366.671 215.011 367.198 215.06C367.727 215.098 368.261 215.065 368.789 214.849C368.882 214.811 368.926 214.705 368.888 214.612C368.87 214.567 368.836 214.534 368.795 214.515L368.785 214.512Z" fill="#FF816E"/>
                                <path d="M319.145 407.209L319.443 401.232L330.215 401.31L330.15 407.209C330.41 409.134 334.892 413.266 337.131 415.223C338.583 415.922 339.873 416.581 340.994 417.216C342.203 417.9 344.672 417.941 345.458 418.586C346.27 419.252 345.998 420.675 345.702 421.184C341.993 421.184 336.398 421.057 336.398 421.057C332.855 421.057 330.865 420.855 325.826 416.072C321.18 411.664 319.145 407.209 319.145 407.209Z" fill="#F2AF91"/>
                                <path d="M319.142 407.209C321.235 408.773 326.68 417.784 331.576 420.069C332.349 418.657 335.17 415.558 337.128 415.222C338.58 415.922 339.87 416.581 340.991 417.215C337.975 417.581 336.394 421.057 336.394 421.057C336.394 421.057 341.818 421.184 345.699 421.184C345.896 421.596 345.882 422.224 345.597 422.436H337.04H330.015C328.505 421.703 326.494 417.957 324.63 418.428C322.765 418.897 322.688 422.436 322.688 422.436H318.814C318.814 422.436 318.355 414.056 318.066 410.954C317.9 409.178 319.142 407.209 319.142 407.209Z" fill="#111111"/>
                                <path d="M351.181 225.921C351.909 225.88 352.914 225.87 354.083 225.881C354.507 225.15 357.556 219.679 356.634 214.829C356.629 214.803 356.629 214.783 356.625 214.758C358.823 217.273 362.939 219.382 365.743 219.382C366.072 219.382 366.397 219.358 366.717 219.312C366.379 220.48 365.601 223.589 365.994 226.342C368.363 226.479 370.142 226.606 370.5 226.661C371.586 227.708 372.268 230.968 372.507 232.859C373.107 237.618 379.175 243.308 379.331 248.111C379.42 250.853 378.008 253.052 375.464 255.297C373.294 261.55 374.495 272.327 374.495 272.327L348.201 268.636C348.201 268.636 342.206 247.667 342.195 239.162C342.178 226.556 348.567 226.071 351.181 225.921Z" fill="#FFB494"/>
                                <path d="M342.254 239.128C341.478 247.597 348.202 268.635 348.202 268.635L374.495 272.326C374.495 272.326 373.295 261.549 375.465 255.296C378.009 253.051 379.421 250.853 379.332 248.11C379.176 243.308 374.32 237.11 372.508 232.858C371.76 231.105 369.704 227.494 369.106 226.537C368.03 226.372 365.479 226.386 366.418 226.358C368.286 236.402 369.605 240.895 365.101 240.661C360.883 240.441 356.249 230.684 354.254 225.979C354.179 225.974 354.108 225.971 354.032 225.965C352.988 225.891 352.041 225.878 351.181 225.922C351.181 225.922 355.197 245.68 348.617 245.714C343.869 245.741 342.254 239.128 342.254 239.128Z" fill="#EF65EF"/>
                                <path d="M368.216 247.279C369.791 247.279 371.521 247.071 371.619 247.059C371.771 247.041 371.879 246.903 371.86 246.752C371.842 246.599 371.706 246.489 371.552 246.51C371.52 246.514 368.34 246.896 366.743 246.633C366.589 246.612 366.45 246.711 366.425 246.861C366.401 247.012 366.503 247.154 366.653 247.179C367.098 247.253 367.647 247.279 368.216 247.279Z" fill="#C0BCE6"/>
                                <path d="M369.274 249.594C369.555 249.594 369.824 249.57 370.179 249.539L370.652 249.499C370.804 249.487 370.918 249.354 370.905 249.201C370.893 249.049 370.756 248.928 370.608 248.948L370.13 248.988C369.401 249.053 369.101 249.08 368.31 248.949C368.157 248.926 368.016 249.026 367.992 249.176C367.968 249.327 368.069 249.469 368.22 249.494C368.663 249.567 368.975 249.594 369.274 249.594Z" fill="#C0BCE6"/>
                                <path d="M313.336 401.857C313.336 401.857 325.714 298.536 328.404 289.951C330.587 282.981 336.977 277.437 348.697 270.486L345.554 265.969L378.912 268.046L374.685 272.324L377.303 287.326C377.303 287.326 369.439 293.152 361.112 294.505C362.654 312.519 344.164 401.858 344.164 401.858L313.336 401.857Z" fill="#111111"/>
                                <path d="M318.03 401.004C318.048 400.852 318.181 400.741 318.338 400.762C318.49 400.78 318.597 400.918 318.579 401.07L318.481 401.891C318.465 402.032 318.345 402.135 318.207 402.135C318.196 402.135 318.184 402.134 318.173 402.133C318.022 402.115 317.914 401.977 317.932 401.826L318.03 401.004Z" fill="#F3E5CC"/>
                                <path d="M329.534 310.84L329.766 309.204C329.788 309.052 329.932 308.951 330.08 308.969C330.231 308.991 330.336 309.131 330.314 309.282L330.081 310.918C330.062 311.056 329.944 311.156 329.808 311.156C329.795 311.156 329.782 311.155 329.769 311.153C329.618 311.131 329.513 310.991 329.534 310.84Z" fill="#F3E5CC"/>
                                <path d="M330.163 306.474L330.402 304.838C330.425 304.687 330.57 304.582 330.716 304.605C330.867 304.626 330.972 304.767 330.949 304.918L330.71 306.553C330.69 306.691 330.572 306.79 330.437 306.79C330.424 306.79 330.411 306.788 330.397 306.786C330.246 306.766 330.141 306.625 330.163 306.474Z" fill="#F3E5CC"/>
                                <path d="M328.928 315.206L329.156 313.57C329.177 313.418 329.319 313.316 329.468 313.334C329.619 313.355 329.724 313.495 329.704 313.646L329.477 315.282C329.458 315.421 329.339 315.521 329.204 315.521C329.191 315.521 329.178 315.52 329.165 315.518C329.013 315.497 328.907 315.357 328.928 315.206Z" fill="#F3E5CC"/>
                                <path d="M327.733 323.939L327.953 322.303C327.973 322.151 328.112 322.044 328.263 322.065C328.415 322.085 328.521 322.225 328.501 322.376L328.281 324.013C328.262 324.152 328.143 324.253 328.007 324.253C327.995 324.253 327.983 324.252 327.97 324.25C327.819 324.23 327.713 324.09 327.733 323.939Z" fill="#F3E5CC"/>
                                <path d="M328.327 319.572L328.55 317.935C328.571 317.784 328.713 317.682 328.862 317.699C329.013 317.72 329.118 317.859 329.098 318.011L328.875 319.647C328.856 319.786 328.738 319.887 328.601 319.887C328.589 319.887 328.576 319.886 328.563 319.884C328.412 319.863 328.306 319.723 328.327 319.572Z" fill="#F3E5CC"/>
                                <path d="M330.808 302.111L331.057 300.476C331.081 300.326 331.224 300.225 331.373 300.245C331.524 300.268 331.628 300.409 331.604 300.56L331.354 302.193C331.334 302.33 331.216 302.428 331.082 302.428C331.068 302.428 331.054 302.427 331.039 302.426C330.889 302.403 330.785 302.262 330.808 302.111Z" fill="#F3E5CC"/>
                                <path d="M331.488 297.749C331.58 297.179 331.669 296.634 331.757 296.115C331.782 295.963 331.928 295.857 332.075 295.888C332.226 295.913 332.328 296.056 332.303 296.206C332.216 296.725 332.127 297.268 332.034 297.838C332.012 297.974 331.895 298.07 331.762 298.07C331.747 298.07 331.732 298.069 331.717 298.066C331.566 298.042 331.463 297.9 331.488 297.749Z" fill="#F3E5CC"/>
                                <path d="M338.527 282.038C338.473 282.095 338.4 282.123 338.328 282.123C338.259 282.123 338.19 282.098 338.136 282.046C338.026 281.941 338.022 281.766 338.128 281.655C338.501 281.266 338.898 280.871 339.307 280.484C339.418 280.379 339.593 280.384 339.698 280.495C339.803 280.606 339.799 280.781 339.688 280.886C339.284 281.266 338.894 281.654 338.527 282.038Z" fill="#F3E5CC"/>
                                <path d="M341.735 279.076C341.683 279.119 341.62 279.139 341.558 279.139C341.478 279.139 341.399 279.105 341.345 279.04C341.248 278.922 341.263 278.748 341.381 278.65C341.797 278.305 342.227 277.958 342.673 277.61C342.792 277.515 342.966 277.536 343.06 277.657C343.155 277.777 343.133 277.952 343.013 278.045C342.572 278.39 342.145 278.733 341.735 279.076Z" fill="#F3E5CC"/>
                                <path d="M335.784 285.41C335.73 285.49 335.643 285.532 335.553 285.532C335.501 285.532 335.447 285.516 335.4 285.485C335.273 285.4 335.239 285.228 335.324 285.101C335.628 284.648 335.958 284.194 336.305 283.751C336.4 283.63 336.574 283.61 336.694 283.703C336.813 283.798 336.835 283.971 336.741 284.092C336.402 284.523 336.081 284.967 335.784 285.41Z" fill="#F3E5CC"/>
                                <path d="M327.155 328.307L327.372 326.669C327.392 326.518 327.526 326.406 327.683 326.431C327.834 326.452 327.94 326.591 327.92 326.742L327.702 328.379C327.684 328.518 327.565 328.619 327.429 328.619C327.417 328.619 327.405 328.618 327.393 328.616C327.241 328.597 327.135 328.458 327.155 328.307Z" fill="#F3E5CC"/>
                                <path d="M332.231 293.391C332.344 292.783 332.45 292.237 332.549 291.757C332.58 291.607 332.728 291.515 332.877 291.542C333.026 291.573 333.122 291.72 333.091 291.869C332.991 292.345 332.886 292.887 332.775 293.491C332.75 293.624 332.634 293.717 332.504 293.717C332.486 293.717 332.47 293.715 332.453 293.713C332.303 293.686 332.204 293.541 332.231 293.391Z" fill="#F3E5CC"/>
                                <path d="M345.207 276.408C345.158 276.443 345.102 276.46 345.046 276.46C344.96 276.46 344.876 276.42 344.821 276.345C344.732 276.22 344.761 276.048 344.885 275.959C345.325 275.643 345.777 275.327 346.24 275.008C346.366 274.921 346.538 274.953 346.625 275.079C346.712 275.205 346.68 275.377 346.554 275.464C346.092 275.78 345.644 276.095 345.207 276.408Z" fill="#F3E5CC"/>
                                <path d="M349.926 272.59C350.054 272.508 350.225 272.547 350.307 272.676C350.389 272.805 350.35 272.976 350.221 273.057C349.748 273.355 349.286 273.651 348.833 273.944C348.787 273.974 348.734 273.989 348.684 273.989C348.593 273.989 348.504 273.945 348.451 273.863C348.368 273.734 348.404 273.563 348.532 273.48C348.986 273.185 349.452 272.889 349.926 272.59Z" fill="#F3E5CC"/>
                                <path d="M323.213 358.889L323.42 357.25C323.439 357.098 323.58 356.99 323.729 357.01C323.88 357.029 323.988 357.168 323.969 357.319L323.762 358.958C323.744 359.098 323.625 359.2 323.488 359.2C323.477 359.2 323.465 359.199 323.453 359.198C323.301 359.179 323.194 359.04 323.213 358.889Z" fill="#F3E5CC"/>
                                <path d="M320.494 380.754L320.696 379.114C320.716 378.962 320.851 378.855 321.005 378.873C321.156 378.892 321.264 379.031 321.245 379.182L321.043 380.821C321.026 380.961 320.906 381.064 320.769 381.064C320.758 381.064 320.746 381.064 320.735 381.063C320.583 381.043 320.476 380.906 320.494 380.754Z" fill="#F3E5CC"/>
                                <path d="M319.959 385.131L320.16 383.49C320.179 383.339 320.315 383.233 320.468 383.25C320.62 383.268 320.728 383.407 320.71 383.558L320.509 385.198C320.491 385.338 320.372 385.441 320.235 385.441C320.223 385.441 320.212 385.441 320.201 385.439C320.048 385.42 319.941 385.282 319.959 385.131Z" fill="#F3E5CC"/>
                                <path d="M321.037 376.38L321.24 374.741C321.259 374.589 321.399 374.482 321.548 374.5C321.7 374.519 321.808 374.658 321.789 374.809L321.586 376.448C321.57 376.588 321.45 376.691 321.312 376.691C321.301 376.691 321.289 376.69 321.278 376.689C321.126 376.67 321.019 376.532 321.037 376.38Z" fill="#F3E5CC"/>
                                <path d="M319.424 389.506L319.624 387.866C319.643 387.714 319.784 387.608 319.932 387.625C320.084 387.643 320.191 387.782 320.173 387.933L319.973 389.574C319.956 389.714 319.837 389.817 319.699 389.817C319.688 389.817 319.677 389.817 319.665 389.815C319.513 389.796 319.405 389.657 319.424 389.506Z" fill="#F3E5CC"/>
                                <path d="M326.581 332.674L326.796 331.036C326.815 330.885 326.959 330.774 327.106 330.798C327.258 330.818 327.364 330.957 327.344 331.108L327.129 332.746C327.11 332.885 326.991 332.987 326.856 332.987C326.844 332.987 326.831 332.986 326.819 332.984C326.667 332.965 326.56 332.826 326.581 332.674Z" fill="#F3E5CC"/>
                                <path d="M318.893 393.888L319.092 392.245C319.111 392.094 319.248 391.985 319.401 392.004C319.552 392.023 319.66 392.16 319.642 392.312L319.442 393.954C319.425 394.095 319.306 394.198 319.168 394.198C319.158 394.198 319.146 394.197 319.135 394.196C318.982 394.177 318.874 394.04 318.893 393.888Z" fill="#F3E5CC"/>
                                <path d="M321.576 372.007L321.78 370.368C321.799 370.216 321.935 370.108 322.088 370.127C322.24 370.146 322.347 370.285 322.329 370.436L322.125 372.074C322.107 372.214 321.989 372.317 321.851 372.317C321.84 372.317 321.828 372.316 321.817 372.315C321.665 372.296 321.558 372.159 321.576 372.007Z" fill="#F3E5CC"/>
                                <path d="M318.361 398.275L318.56 396.63C318.578 396.479 318.717 396.369 318.868 396.389C319.019 396.407 319.127 396.545 319.109 396.697L318.91 398.342C318.893 398.482 318.774 398.585 318.637 398.585C318.626 398.585 318.614 398.584 318.603 398.583C318.452 398.564 318.343 398.427 318.361 398.275Z" fill="#F3E5CC"/>
                                <path d="M324.877 345.782L325.088 344.144C325.107 343.992 325.245 343.886 325.397 343.904C325.548 343.924 325.656 344.062 325.637 344.214L325.427 345.853C325.408 345.992 325.29 346.094 325.153 346.094C325.141 346.094 325.129 346.093 325.117 346.092C324.966 346.073 324.858 345.934 324.877 345.782Z" fill="#F3E5CC"/>
                                <path d="M325.444 341.412L325.656 339.774C325.675 339.623 325.815 339.517 325.965 339.535C326.117 339.555 326.224 339.693 326.205 339.845L325.993 341.483C325.975 341.623 325.856 341.725 325.719 341.725C325.707 341.725 325.695 341.724 325.683 341.723C325.531 341.702 325.424 341.564 325.444 341.412Z" fill="#F3E5CC"/>
                                <path d="M324.323 350.155L324.531 348.516C324.551 348.365 324.69 348.26 324.841 348.277C324.992 348.296 325.099 348.435 325.081 348.587L324.871 350.224C324.854 350.364 324.735 350.466 324.598 350.466C324.586 350.466 324.574 350.465 324.562 350.464C324.411 350.445 324.303 350.307 324.323 350.155Z" fill="#F3E5CC"/>
                                <path d="M326.221 335.405C326.241 335.253 326.381 335.147 326.531 335.166C326.682 335.187 326.789 335.325 326.769 335.477L326.555 337.115C326.537 337.254 326.419 337.355 326.282 337.355L326.008 337.043L326.221 335.405Z" fill="#F3E5CC"/>
                                <path d="M322.666 363.26L322.872 361.622C322.89 361.47 323.03 361.362 323.18 361.381C323.332 361.4 323.44 361.538 323.421 361.689L323.215 363.329C323.198 363.469 323.078 363.571 322.941 363.571C322.93 363.571 322.918 363.57 322.906 363.569C322.755 363.55 322.647 363.412 322.666 363.26Z" fill="#F3E5CC"/>
                                <path d="M323.768 354.518L323.975 352.879C323.994 352.727 324.138 352.62 324.284 352.639C324.436 352.658 324.543 352.797 324.524 352.948L324.317 354.586C324.299 354.726 324.18 354.828 324.043 354.828C324.031 354.828 324.019 354.828 324.008 354.826C323.856 354.808 323.749 354.67 323.768 354.518Z" fill="#F3E5CC"/>
                                <path d="M322.123 367.633L322.328 365.994C322.347 365.843 322.489 365.737 322.636 365.754C322.788 365.773 322.896 365.911 322.877 366.062L322.672 367.701C322.655 367.841 322.536 367.943 322.398 367.943C322.387 367.943 322.375 367.943 322.364 367.941C322.212 367.923 322.104 367.784 322.123 367.633Z" fill="#F3E5CC"/>
                                <path d="M352.023 267.425C352 267.432 351.976 267.434 351.954 267.434C351.83 267.434 351.718 267.352 351.686 267.227L351.478 266.424C351.439 266.276 351.528 266.125 351.677 266.087C351.828 266.049 351.975 266.138 352.014 266.286L352.221 267.089C352.26 267.237 352.171 267.387 352.023 267.425Z" fill="#F3E5CC"/>
                                <path d="M358.943 292.294L361.292 294.293C361.408 294.392 361.423 294.566 361.323 294.683C361.269 294.747 361.191 294.78 361.113 294.78C361.05 294.78 360.986 294.758 360.934 294.715L358.586 292.715C358.469 292.616 358.455 292.442 358.554 292.326C358.653 292.209 358.828 292.196 358.943 292.294Z" fill="#F3E5CC"/>
                                <path d="M333.671 288.104C333.677 288.091 333.692 288.089 333.7 288.078C333.782 287.891 333.849 287.7 333.938 287.517C334.004 287.379 334.17 287.321 334.307 287.388C334.444 287.454 334.503 287.619 334.436 287.757C334.386 287.86 334.35 287.969 334.302 288.074C335.718 288.628 339.176 289.228 342.947 288.905C346.231 288.622 350.594 287.57 352.727 284.16C356.22 278.576 353.495 272.663 352.856 271.434L352.392 271.713C352.347 271.74 352.298 271.754 352.249 271.754C352.155 271.754 352.064 271.706 352.012 271.62C351.933 271.489 351.975 271.319 352.106 271.241L352.137 271.222C350.98 271.081 349.817 270.931 348.652 270.76C348.501 270.738 348.397 270.598 348.419 270.447C348.441 270.295 348.582 270.191 348.732 270.213C350.023 270.402 351.312 270.568 352.591 270.72L352.486 270.312C352.447 270.164 352.536 270.013 352.684 269.976C352.835 269.937 352.983 270.026 353.021 270.174L353.181 270.793C363.702 272.005 373.255 272.048 374.534 272.048C374.628 272.048 374.675 272.047 374.68 272.048C374.832 272.048 374.955 272.171 374.957 272.323C374.957 272.475 374.834 272.6 374.681 272.601C374.674 272.601 374.625 272.601 374.536 272.601C374.022 272.601 372.168 272.592 369.479 272.507L369.788 284.755C369.79 284.83 369.761 284.901 369.71 284.955C369.658 285.008 369.587 285.038 369.512 285.038C369.253 285.038 369.003 284.889 368.769 284.592C367.364 282.821 366.191 275.424 366.812 272.406C363.088 272.241 358.389 271.938 353.446 271.379C354.263 273.035 356.676 278.889 353.196 284.453C350.749 288.365 345.289 289.556 340.672 289.556C337.878 289.556 335.408 289.119 334.084 288.587C333.991 288.809 333.885 289.027 333.802 289.251C333.761 289.362 333.655 289.431 333.542 289.431C333.511 289.431 333.478 289.426 333.446 289.414C333.304 289.361 333.23 289.202 333.283 289.059C333.395 288.754 333.536 288.454 333.667 288.151C333.673 288.135 333.663 288.119 333.671 288.104ZM369.202 284.248C369.21 284.257 369.217 284.266 369.224 284.275L368.926 272.49C368.432 272.473 367.912 272.453 367.371 272.431C366.759 275.152 367.912 282.621 369.202 284.248Z" fill="#F3E5CC"/>
                                <path d="M365.757 219.381C365.76 219.381 365.764 219.381 365.767 219.381C366.087 219.381 366.404 219.357 366.716 219.314C366.493 220.084 366.082 221.687 365.936 223.479C360.756 223.746 358.491 218.831 357.578 215.715C359.877 217.785 363.305 219.381 365.743 219.381C365.748 219.381 365.753 219.381 365.757 219.381Z" fill="#FF816E"/>
                                <path d="M483.347 243.518C480.187 243.358 467.545 236.412 467.268 234.276L467.266 234.27C478.422 234.593 483.347 243.518 483.347 243.518Z" fill="#FF9147"/>
                                <path d="M413.571 270.659C411.494 270.585 411.235 268.597 414.447 267.817C421.076 266.207 421.32 265.373 422.263 265.211C422.263 265.211 417.512 263.39 418.954 262.297C420.174 261.373 428.732 261.822 430.724 265.631C430.724 265.631 453.165 258.254 458.426 250.961C463.688 243.668 471.226 226.586 473.997 221.277C476.96 215.6 479.273 214.867 482.172 216.906C484.558 218.583 485.478 224.857 484.871 228.355C483.561 235.912 478.279 248.983 469.175 257.611C457.863 268.333 432.767 272.561 432.767 272.561C423.407 276.513 420.856 276.723 418.917 277.28C416.03 278.108 415.715 276.081 418.18 275.179C417.72 275.371 417.055 275.479 416.089 275.687C413.263 276.297 412.162 274.089 414.797 273.226C410.948 274.536 410.822 270.891 413.571 270.659Z" fill="#FFB494"/>
                                <path d="M413.569 270.939C413.575 270.939 413.582 270.939 413.588 270.938C413.7 270.931 416.381 270.733 420.06 269.296C420.203 269.24 420.274 269.078 420.218 268.934C420.162 268.79 420 268.718 419.856 268.776C416.256 270.182 413.576 270.379 413.549 270.38C413.396 270.391 413.279 270.524 413.29 270.678C413.301 270.826 413.423 270.939 413.569 270.939Z" fill="#FF816E"/>
                                <path d="M414.182 273.61C414.195 273.61 414.207 273.609 414.22 273.608C414.249 273.604 417.137 273.199 420.806 271.764C420.95 271.708 421.021 271.546 420.964 271.402C420.909 271.258 420.746 271.187 420.602 271.244C416.999 272.652 414.172 273.05 414.144 273.054C413.991 273.075 413.884 273.215 413.905 273.368C413.925 273.508 414.044 273.61 414.182 273.61Z" fill="#FF816E"/>
                                <path d="M417.83 275.603C417.852 275.603 417.874 275.6 417.897 275.595C418.008 275.568 420.637 274.921 422.129 274.263C422.27 274.201 422.334 274.036 422.272 273.895C422.21 273.754 422.042 273.691 421.904 273.752C420.457 274.389 417.791 275.045 417.764 275.052C417.613 275.088 417.522 275.239 417.559 275.39C417.59 275.518 417.704 275.603 417.83 275.603Z" fill="#FF816E"/>
                                <path opacity="0.6" d="M466.877 254.613C468.412 254.16 469.987 254.539 471.142 255.477C470.536 256.222 469.886 256.938 469.175 257.612C467.709 259 466.011 260.28 464.167 261.456C463.979 261.139 463.822 260.8 463.712 260.43C462.98 257.949 464.397 255.345 466.877 254.613Z" fill="#FF816E"/>
                                <path d="M479.99 215.651C484.7 215.619 487.193 221.713 487.346 225.848C487.613 233.059 483.34 243.517 483.34 243.517C483.34 243.517 478.415 234.592 467.258 234.269C468.781 226.892 469.693 215.72 479.99 215.651Z" fill="#111111"/>
                                <path d="M466.986 234.213C467.154 233.152 467.385 232.104 467.635 231.06C467.879 230.015 468.14 228.973 468.429 227.939C468.439 227.9 468.478 227.873 468.519 227.878C468.566 227.884 468.599 227.926 468.593 227.972L468.592 227.976C468.464 229.046 468.308 230.109 468.136 231.168C467.985 232.123 467.812 233.074 467.599 234.017L468.489 234.086C468.896 234.123 469.305 234.13 469.705 234.219C470.509 234.362 471.319 234.483 472.098 234.734C473.68 235.146 475.19 235.814 476.603 236.63C478.02 237.441 479.333 238.436 480.503 239.573C481.542 240.578 482.472 241.677 483.27 242.9C483.734 241.658 484.171 240.398 484.583 239.134C485.047 237.695 485.491 236.249 485.866 234.784C486.248 233.322 486.586 231.848 486.837 230.359C487.077 228.869 487.254 227.367 487.264 225.853C487.265 225.809 487.299 225.771 487.343 225.768C487.389 225.765 487.428 225.8 487.431 225.847C487.523 227.372 487.428 228.903 487.242 230.419C487.055 231.936 486.741 233.431 486.403 234.919C486.047 236.402 485.627 237.869 485.164 239.322C484.696 240.775 484.186 242.207 483.601 243.624V243.624C483.579 243.678 483.54 243.726 483.486 243.759C483.354 243.838 483.183 243.796 483.103 243.664L483.097 243.653C482.292 242.319 481.255 241.074 480.116 239.975C478.976 238.868 477.7 237.901 476.322 237.113C474.95 236.321 473.485 235.672 471.949 235.273C471.192 235.028 470.405 234.912 469.623 234.773C469.235 234.686 468.835 234.679 468.44 234.643L467.252 234.55H467.251L467.217 234.547C467.065 234.523 466.96 234.379 466.984 234.226L466.986 234.213Z" fill="#FF9147"/>
                                <path d="M426.634 268.318C426.754 268.318 426.864 268.24 426.9 268.119C426.942 267.973 426.858 267.819 426.711 267.776C425.647 267.464 422.821 266.384 422.537 265.151C422.504 265.003 422.35 264.901 422.207 264.943C422.058 264.977 421.965 265.125 421.999 265.274C422.404 267.045 426.133 268.183 426.557 268.307C426.582 268.314 426.608 268.318 426.634 268.318Z" fill="#FF816E"/>
                                <path d="M478.086 404.199L478.918 392.54L466.77 391.424L465.682 402.969C465.071 409.136 477.405 411.068 478.086 404.199Z" fill="#111111"/>
                                <path d="M450.558 406.891C455.133 407.553 455.12 412.102 455.12 412.102L473.769 413.949C475.285 408.955 479.521 409.096 479.564 409.097C479.56 413.621 478.509 417.02 478.509 417.02L444.973 413.697C445.108 408.947 446.597 407.848 450.558 406.891Z" fill="#111111"/>
                                <path d="M473.766 413.95L455.116 412.102C455.116 412.102 455.13 407.553 450.555 406.891C453.768 406.114 461.623 406.55 465.68 402.971C473.654 406.499 477.45 404.582 478.084 404.2C478.084 404.2 479.506 406.589 479.56 408.608C479.564 408.774 479.561 408.935 479.561 409.098C479.518 409.095 475.282 408.955 473.766 413.95Z" fill="#111111"/>
                                <path d="M457.886 409.507C467.109 409.507 470.466 404.841 470.611 404.633C470.698 404.509 470.667 404.338 470.542 404.251C470.421 404.165 470.249 404.193 470.16 404.319C470.126 404.37 466.513 409.392 456.554 408.926C456.415 408.917 456.272 409.036 456.266 409.187C456.259 409.339 456.376 409.468 456.527 409.475C456.993 409.497 457.447 409.507 457.886 409.507Z" fill="#675FAD"/>
                                <path d="M467.968 408.222C468.013 408.222 468.059 408.212 468.101 408.188C468.234 408.115 468.282 407.948 468.21 407.815C466.213 404.183 463.63 404.107 463.52 404.106C463.377 404.096 463.245 404.225 463.242 404.376C463.24 404.527 463.361 404.652 463.512 404.655C463.609 404.658 465.895 404.747 467.728 408.079C467.778 408.171 467.872 408.222 467.968 408.222Z" fill="#111111"/>
                                <path d="M464.082 409.758C464.111 409.758 464.14 409.753 464.168 409.744C464.313 409.696 464.39 409.54 464.343 409.397C463.242 406.09 460.604 405.241 460.492 405.207C460.347 405.158 460.195 405.243 460.149 405.388C460.104 405.532 460.185 405.687 460.33 405.732C460.354 405.74 462.813 406.543 463.821 409.569C463.859 409.685 463.966 409.758 464.082 409.758Z" fill="#111111"/>
                                <path d="M459.272 410.433C459.287 410.433 459.302 410.432 459.318 410.43C459.467 410.405 459.568 410.263 459.543 410.113C459.126 407.627 456.466 405.955 456.353 405.884C456.226 405.806 456.056 405.844 455.975 405.973C455.895 406.102 455.935 406.272 456.063 406.351C456.089 406.368 458.625 407.966 459.001 410.204C459.023 410.338 459.14 410.433 459.272 410.433Z" fill="#111111"/>
                                <path d="M479.53 414.252C479.67 414.252 479.79 414.146 479.803 414.004C479.818 413.853 479.708 413.718 479.557 413.704L476.692 413.42C476.55 413.399 476.405 413.516 476.392 413.667C476.377 413.818 476.487 413.953 476.638 413.967L479.503 414.25C479.512 414.252 479.521 414.252 479.53 414.252Z" fill="#F4BD62"/>
                                <path d="M478.916 416.326C479.056 416.326 479.176 416.22 479.189 416.078C479.204 415.927 479.094 415.792 478.943 415.778L445.051 412.42C444.908 412.413 444.765 412.516 444.751 412.667C444.737 412.818 444.847 412.953 444.998 412.967L478.889 416.325C478.898 416.326 478.907 416.326 478.916 416.326Z" fill="#E25959"/>
                                <path d="M494.82 299.954L486.359 350.484L482.652 399.323L460.66 397.938L463.524 336.261L470.88 290.467L494.82 299.954Z" fill="#194A99"/>
                                <path d="M482.102 365.307L481.97 366.962C481.959 367.108 481.838 367.217 481.695 367.217C481.688 367.217 481.68 367.216 481.672 367.216C481.521 367.204 481.407 367.07 481.419 366.919L481.55 365.264C481.561 365.112 481.683 365.011 481.847 365.01C482 365.023 482.114 365.156 482.102 365.307Z" fill="#72A6CF"/>
                                <path d="M482.551 356.191C482.702 356.203 482.817 356.337 482.805 356.489L482.673 358.142C482.663 358.287 482.541 358.397 482.398 358.397C482.391 358.397 482.383 358.395 482.375 358.395C482.224 358.383 482.11 358.25 482.122 358.097L482.253 356.444C482.265 356.3 482.386 356.189 482.529 356.189C482.536 356.189 482.544 356.191 482.551 356.191Z" fill="#72A6CF"/>
                                <path d="M481.754 369.719L481.623 371.374C481.611 371.52 481.49 371.629 481.347 371.629C481.34 371.629 481.332 371.628 481.326 371.628C481.174 371.616 481.059 371.482 481.071 371.331L481.202 369.677C481.214 369.524 481.335 369.419 481.499 369.422C481.651 369.435 481.766 369.568 481.754 369.719Z" fill="#72A6CF"/>
                                <path d="M481.149 373.833C481.3 373.845 481.414 373.979 481.402 374.131L481.271 375.785C481.26 375.929 481.139 376.039 480.995 376.039C480.988 376.039 480.981 376.038 480.973 376.038C480.822 376.026 480.707 375.892 480.72 375.74L480.851 374.087C480.862 373.942 480.983 373.832 481.127 373.832C481.134 373.832 481.141 373.833 481.149 373.833Z" fill="#72A6CF"/>
                                <path d="M480.351 387.36L480.22 389.015C480.209 389.16 480.088 389.27 479.945 389.27C479.938 389.27 479.93 389.268 479.923 389.268C479.771 389.256 479.657 389.123 479.669 388.972L479.8 387.317C479.811 387.165 479.93 387.064 480.097 387.062C480.25 387.075 480.364 387.209 480.351 387.36Z" fill="#72A6CF"/>
                                <path d="M480.004 391.773L479.873 393.426C479.861 393.571 479.74 393.681 479.597 393.681C479.591 393.681 479.582 393.679 479.575 393.679C479.424 393.667 479.309 393.534 479.321 393.381L479.452 391.728C479.463 391.578 479.581 391.47 479.751 391.475C479.902 391.487 480.016 391.621 480.004 391.773Z" fill="#72A6CF"/>
                                <path d="M481.051 378.541L480.92 380.194C480.909 380.34 480.787 380.449 480.644 380.449C480.637 380.449 480.629 380.448 480.623 380.448C480.47 380.436 480.356 380.302 480.368 380.151L480.499 378.497C480.511 378.345 480.63 378.254 480.796 378.242C480.949 378.255 481.064 378.389 481.051 378.541Z" fill="#72A6CF"/>
                                <path d="M483.152 352.075L483.021 353.729C483.01 353.875 482.889 353.985 482.745 353.985C482.738 353.985 482.731 353.983 482.724 353.983C482.572 353.971 482.457 353.837 482.47 353.686L482.601 352.032C482.612 351.88 482.735 351.795 482.898 351.777C483.05 351.79 483.164 351.924 483.152 352.075Z" fill="#72A6CF"/>
                                <path d="M480.707 382.95L480.576 384.604C480.565 384.75 480.443 384.86 480.3 384.86C480.293 384.86 480.285 384.858 480.278 384.858C480.126 384.846 480.012 384.712 480.024 384.561L480.155 382.907C480.167 382.755 480.285 382.658 480.452 382.652C480.605 382.665 480.719 382.798 480.707 382.95Z" fill="#72A6CF"/>
                                <path d="M482.204 360.601C482.355 360.613 482.469 360.747 482.457 360.898L482.326 362.552C482.314 362.698 482.193 362.808 482.05 362.808C482.044 362.808 482.035 362.806 482.029 362.806C481.877 362.794 481.762 362.66 481.774 362.509L481.905 360.855C481.917 360.709 482.038 360.6 482.181 360.6C482.188 360.6 482.195 360.601 482.204 360.601Z" fill="#72A6CF"/>
                                <path d="M484.508 340.553L484.789 338.918C484.815 338.767 484.964 338.663 485.109 338.692C485.259 338.718 485.359 338.862 485.334 339.012L485.052 340.647C485.029 340.781 484.912 340.877 484.78 340.877C484.764 340.877 484.748 340.875 484.732 340.872C484.583 340.847 484.482 340.703 484.508 340.553Z" fill="#72A6CF"/>
                                <path d="M483.754 344.913L484.035 343.278C484.062 343.128 484.201 343.027 484.355 343.053C484.505 343.078 484.606 343.222 484.58 343.372L484.298 345.007C484.275 345.142 484.158 345.237 484.026 345.237C484.01 345.237 483.995 345.236 483.979 345.233C483.829 345.207 483.728 345.064 483.754 344.913Z" fill="#72A6CF"/>
                                <path d="M485.258 336.193L485.54 334.558C485.566 334.407 485.713 334.298 485.859 334.332C486.01 334.358 486.11 334.502 486.085 334.652L485.803 336.287C485.779 336.421 485.662 336.517 485.53 336.517C485.514 336.517 485.499 336.515 485.483 336.512C485.333 336.487 485.232 336.343 485.258 336.193Z" fill="#72A6CF"/>
                                <path d="M483.273 349.598C483.257 349.598 483.241 349.597 483.225 349.594C483.075 349.568 482.974 349.424 483 349.274L483.282 347.639C483.309 347.489 483.448 347.382 483.601 347.414C483.752 347.439 483.853 347.583 483.827 347.733L483.545 349.368C483.522 349.503 483.405 349.598 483.273 349.598Z" fill="#72A6CF"/>
                                <path d="M486.762 327.472L487.043 325.838C487.069 325.688 487.215 325.581 487.363 325.613C487.513 325.639 487.614 325.783 487.588 325.933L487.306 327.567C487.283 327.701 487.166 327.796 487.034 327.796C487.018 327.796 487.002 327.795 486.986 327.792C486.837 327.766 486.736 327.623 486.762 327.472Z" fill="#72A6CF"/>
                                <path d="M486.008 331.834L486.289 330.199C486.315 330.048 486.462 329.945 486.609 329.973C486.759 329.999 486.859 330.142 486.834 330.293L486.552 331.928C486.529 332.062 486.412 332.158 486.28 332.158C486.264 332.158 486.248 332.156 486.232 332.153C486.083 332.128 485.982 331.984 486.008 331.834Z" fill="#72A6CF"/>
                                <path d="M487.512 323.113L487.794 321.478C487.82 321.328 487.964 321.217 488.113 321.253C488.264 321.278 488.364 321.422 488.339 321.572L488.056 323.207C488.033 323.342 487.916 323.437 487.784 323.437C487.768 323.437 487.753 323.436 487.737 323.433C487.587 323.407 487.486 323.264 487.512 323.113Z" fill="#72A6CF"/>
                                <path d="M488.266 318.752L488.547 317.117C488.573 316.967 488.716 316.862 488.866 316.892C489.017 316.917 489.117 317.061 489.092 317.211L488.81 318.846C488.786 318.981 488.67 319.076 488.538 319.076C488.522 319.076 488.506 319.075 488.49 319.071C488.341 319.046 488.24 318.903 488.266 318.752Z" fill="#72A6CF"/>
                                <path d="M460.13 394.955L479.093 396.28L479.105 396.141C479.116 395.988 479.233 395.902 479.401 395.886C479.554 395.898 479.668 396.032 479.656 396.184L479.646 396.318L483.6 396.595L482.769 401.718L459.844 400.116L460.13 394.955Z" fill="#72A6CF"/>
                                <path d="M520.416 408.546L519.742 397.324L507.543 397.457L507.952 408.592C507.975 414.788 520.441 415.448 520.416 408.546Z" fill="#111111"/>
                                <path d="M493.308 414.038C497.927 414.229 498.378 418.755 498.378 418.755L517.119 418.685C518.116 413.562 522.344 413.269 522.387 413.266C522.846 417.765 522.148 421.254 522.148 421.254L488.448 421.379C488.096 416.641 489.465 415.396 493.308 414.038Z" fill="#111111"/>
                                <path d="M517.12 418.685L498.379 418.755C498.379 418.755 497.927 414.228 493.309 414.038C496.425 412.936 504.284 412.567 507.953 408.591C516.246 411.285 519.827 408.99 520.418 408.545C520.418 408.545 522.077 410.777 522.337 412.778C522.358 412.943 522.372 413.103 522.388 413.266C522.345 413.268 518.116 413.562 517.12 418.685Z" fill="#111111"/>
                                <path d="M499.497 415.997C499.501 415.997 499.507 415.997 499.512 415.997C509.762 415.434 512.899 409.973 513.028 409.741C513.101 409.607 513.053 409.441 512.921 409.368C512.788 409.296 512.622 409.341 512.548 409.474C512.518 409.528 509.407 414.902 499.483 415.448C499.331 415.457 499.215 415.585 499.223 415.737C499.23 415.885 499.352 415.997 499.497 415.997Z" fill="#675FAD"/>
                                <path d="M510.736 413.585C510.79 413.585 510.845 413.569 510.893 413.537C511.017 413.45 511.049 413.279 510.962 413.153C508.607 409.751 506.033 409.939 505.918 409.945C505.767 409.958 505.657 410.091 505.669 410.242C505.682 410.392 505.787 410.507 505.966 410.492C506.057 410.489 508.351 410.344 510.51 413.468C510.563 413.543 510.648 413.585 510.736 413.585Z" fill="#111111"/>
                                <path d="M507.028 415.507C507.067 415.507 507.104 415.5 507.142 415.484C507.28 415.421 507.341 415.258 507.28 415.12C505.846 411.944 503.134 411.369 503.019 411.346C502.87 411.32 502.726 411.413 502.697 411.562C502.667 411.71 502.763 411.855 502.911 411.885C502.937 411.89 505.467 412.438 506.778 415.346C506.823 415.448 506.924 415.507 507.028 415.507Z" fill="#111111"/>
                                <path d="M502.318 416.675C502.342 416.675 502.366 416.672 502.391 416.665C502.538 416.625 502.624 416.473 502.583 416.328C501.913 413.897 499.096 412.504 498.977 412.446C498.841 412.383 498.677 412.436 498.61 412.574C498.543 412.711 498.6 412.874 498.737 412.942C498.764 412.954 501.45 414.285 502.054 416.474C502.088 416.595 502.198 416.675 502.318 416.675Z" fill="#111111"/>
                                <path d="M519.974 418.411H519.975L522.854 418.4C523.006 418.4 523.129 418.277 523.127 418.125C523.127 417.974 523.004 417.852 522.853 417.852H522.851L519.972 417.862C519.821 417.862 519.698 417.985 519.699 418.138C519.699 418.289 519.822 418.411 519.974 418.411Z" fill="#F4BD62"/>
                                <path d="M488.399 420.65H488.401L522.458 420.524C522.609 420.524 522.733 420.4 522.731 420.248C522.731 420.096 522.608 419.975 522.457 419.975H522.456L488.398 420.101C488.247 420.101 488.124 420.225 488.125 420.377C488.125 420.528 488.248 420.65 488.399 420.65Z" fill="#E25959"/>
                                <path d="M522.818 403.385L501.113 403.656C500.434 400.36 492.158 350.194 492.158 350.194L486.858 301.257L470.461 292.746L472.957 275.723L509.528 276.556L514.086 292.933L517.164 349.098L522.818 403.385Z" fill="#29599C"/>
                                <path d="M488.362 315.381C488.372 315.381 488.381 315.381 488.391 315.38C488.543 315.363 488.651 315.227 488.636 315.077L487.156 301.382C487.146 301.293 487.095 301.215 487.018 301.171L481.402 298.004C481.27 297.931 481.102 297.975 481.027 298.109C480.953 298.242 481 298.409 481.133 298.483L486.626 301.581L488.09 315.135C488.104 315.277 488.223 315.381 488.362 315.381Z" fill="#72A6CF"/>
                                <path d="M486.257 293.173C486.307 293.173 486.356 293.16 486.401 293.132C486.483 293.083 486.534 292.993 486.534 292.896V283.547C486.534 283.394 486.41 283.27 486.257 283.27C486.104 283.27 485.98 283.394 485.98 283.547V292.36C485.091 291.614 483.037 289.275 482.929 283.541C482.926 283.391 482.802 283.27 482.652 283.27C482.651 283.27 482.649 283.27 482.646 283.27C482.494 283.273 482.373 283.399 482.375 283.552C482.52 291.207 485.983 293.067 486.131 293.143C486.17 293.163 486.214 293.173 486.257 293.173Z" fill="#72A6CF"/>
                                <path d="M511.891 320.822C511.885 320.824 511.879 320.824 511.874 320.824C511.728 320.824 511.607 320.71 511.598 320.564L511.497 318.915C511.486 318.763 511.603 318.632 511.755 318.623C511.893 318.605 512.037 318.729 512.048 318.882L512.149 320.531C512.16 320.682 512.043 320.813 511.891 320.822Z" fill="#72A6CF"/>
                                <path d="M511.352 312.026C511.346 312.028 511.34 312.028 511.335 312.028C511.189 312.028 511.068 311.914 511.059 311.768L510.958 310.118C510.947 309.966 511.064 309.834 511.217 309.825C511.35 309.8 511.5 309.933 511.509 310.085L511.611 311.735C511.62 311.886 511.504 312.017 511.352 312.026Z" fill="#72A6CF"/>
                                <path d="M511.617 316.424C511.612 316.425 511.606 316.425 511.601 316.425C511.455 316.425 511.334 316.312 511.325 316.165L511.223 314.515C511.213 314.363 511.33 314.232 511.482 314.223C511.618 314.216 511.766 314.329 511.775 314.482L511.877 316.132C511.886 316.284 511.77 316.415 511.617 316.424Z" fill="#72A6CF"/>
                                <path d="M512.973 338.418C512.967 338.419 512.962 338.419 512.956 338.419C512.81 338.419 512.689 338.306 512.68 338.159L512.579 336.509C512.569 336.357 512.685 336.226 512.838 336.217C512.984 336.187 513.12 336.323 513.13 336.476L513.232 338.126C513.242 338.278 513.125 338.409 512.973 338.418Z" fill="#72A6CF"/>
                                <path d="M512.699 334.018C512.694 334.019 512.688 334.019 512.683 334.019C512.537 334.019 512.416 333.906 512.407 333.76L512.305 332.111C512.295 331.959 512.412 331.828 512.564 331.819C512.709 331.798 512.847 331.925 512.857 332.078L512.959 333.726C512.968 333.878 512.852 334.009 512.699 334.018Z" fill="#72A6CF"/>
                                <path d="M512.43 329.621C512.424 329.623 512.418 329.623 512.413 329.623C512.267 329.623 512.146 329.509 512.138 329.363L512.036 327.713C512.026 327.561 512.142 327.429 512.295 327.42C512.437 327.411 512.577 327.527 512.587 327.68L512.689 329.33C512.699 329.481 512.582 329.612 512.43 329.621Z" fill="#72A6CF"/>
                                <path d="M512.16 325.222C512.155 325.223 512.149 325.223 512.144 325.223C511.998 325.223 511.877 325.11 511.868 324.964L511.766 323.314C511.756 323.161 511.873 323.03 512.025 323.021C512.165 322.993 512.308 323.129 512.318 323.28L512.419 324.93C512.429 325.082 512.313 325.213 512.16 325.222Z" fill="#72A6CF"/>
                                <path d="M511.082 307.627C511.076 307.628 511.071 307.628 511.066 307.628C510.92 307.628 510.799 307.515 510.79 307.368L510.688 305.719C510.678 305.567 510.794 305.436 510.947 305.427C511.078 305.412 511.231 305.533 511.24 305.686L511.341 307.335C511.352 307.487 511.235 307.618 511.082 307.627Z" fill="#72A6CF"/>
                                <path d="M509.111 290.184C509.086 290.19 509.061 290.194 509.037 290.194C508.916 290.194 508.804 290.114 508.77 289.992L508.322 288.4C508.282 288.253 508.367 288.1 508.514 288.059C508.665 288.019 508.814 288.104 508.856 288.251L509.303 289.843C509.344 289.988 509.258 290.142 509.111 290.184Z" fill="#72A6CF"/>
                                <path d="M507.92 285.94C507.894 285.947 507.869 285.95 507.845 285.95C507.724 285.95 507.613 285.871 507.578 285.749L507.131 284.158C507.091 284.012 507.176 283.858 507.322 283.817C507.474 283.776 507.623 283.861 507.664 284.009L508.111 285.599C508.152 285.746 508.067 285.899 507.92 285.94Z" fill="#72A6CF"/>
                                <path d="M510.303 294.426C510.278 294.433 510.253 294.436 510.228 294.436C510.107 294.436 509.996 294.356 509.961 294.235L509.514 292.643C509.474 292.496 509.559 292.342 509.705 292.301C509.862 292.26 510.006 292.346 510.047 292.493L510.494 294.085C510.535 294.231 510.45 294.385 510.303 294.426Z" fill="#72A6CF"/>
                                <path d="M510.808 303.23C510.802 303.231 510.797 303.231 510.792 303.231C510.646 303.231 510.525 303.118 510.516 302.971L510.415 301.321C510.404 301.169 510.521 301.038 510.674 301.029C510.802 300.994 510.957 301.136 510.966 301.288L511.067 302.938C511.078 303.089 510.961 303.221 510.808 303.23Z" fill="#72A6CF"/>
                                <path d="M510.539 298.829C510.533 298.83 510.527 298.83 510.522 298.83C510.376 298.83 510.255 298.717 510.246 298.57L510.145 296.92C510.135 296.768 510.251 296.637 510.404 296.628C510.531 296.604 510.688 296.735 510.697 296.887L510.798 298.537C510.808 298.689 510.692 298.82 510.539 298.829Z" fill="#72A6CF"/>
                                <path d="M517.841 386.639C517.831 386.64 517.821 386.641 517.811 386.641C517.673 386.641 517.552 386.537 517.537 386.395L517.353 384.753C517.337 384.602 517.445 384.465 517.598 384.448C517.743 384.425 517.886 384.54 517.902 384.693L518.086 386.334C518.102 386.485 517.994 386.622 517.841 386.639Z" fill="#72A6CF"/>
                                <path d="M517.349 382.259C517.339 382.26 517.329 382.261 517.319 382.261C517.18 382.261 517.06 382.157 517.045 382.015L516.861 380.373C516.844 380.222 516.953 380.085 517.105 380.068C517.262 380.052 517.393 380.159 517.41 380.312L517.594 381.954C517.61 382.105 517.501 382.242 517.349 382.259Z" fill="#72A6CF"/>
                                <path d="M513.238 342.817C513.233 342.818 513.227 342.818 513.222 342.818C513.076 342.818 512.955 342.705 512.946 342.558L512.844 340.908C512.834 340.756 512.951 340.625 513.103 340.616C513.253 340.604 513.386 340.722 513.396 340.875L513.498 342.525C513.507 342.677 513.391 342.808 513.238 342.817Z" fill="#72A6CF"/>
                                <path d="M516.367 373.501C516.356 373.503 516.346 373.503 516.336 373.503C516.197 373.503 516.077 373.399 516.062 373.258L515.877 371.615C515.86 371.462 515.969 371.325 516.12 371.309C516.284 371.29 516.409 371.4 516.426 371.552L516.611 373.195C516.628 373.347 516.519 373.484 516.367 373.501Z" fill="#72A6CF"/>
                                <path d="M518.336 391.019C518.325 391.02 518.315 391.021 518.305 391.021C518.166 391.021 518.046 390.916 518.03 390.775L517.845 389.133C517.829 388.981 517.938 388.844 518.089 388.827C518.258 388.814 518.379 388.918 518.394 389.07L518.579 390.712C518.596 390.865 518.487 391.001 518.336 391.019Z" fill="#72A6CF"/>
                                <path d="M518.826 397.892C518.809 397.739 518.918 397.602 519.069 397.586C519.231 397.559 519.358 397.678 519.375 397.829L519.55 399.385L523.42 399.322L523.872 404.174H500.531L499.691 399.707L518.995 399.395L518.826 397.892Z" fill="#72A6CF"/>
                                <path d="M518.828 395.398C518.817 395.4 518.807 395.4 518.797 395.4C518.658 395.4 518.538 395.296 518.523 395.155L518.338 393.513C518.321 393.361 518.43 393.224 518.581 393.208C518.755 393.187 518.87 393.3 518.887 393.451L519.071 395.092C519.088 395.245 518.979 395.381 518.828 395.398Z" fill="#72A6CF"/>
                                <path d="M516.86 377.88C516.848 377.881 516.838 377.883 516.828 377.883C516.689 377.883 516.57 377.778 516.554 377.637L516.369 375.995C516.352 375.843 516.46 375.706 516.612 375.689C516.781 375.662 516.901 375.781 516.918 375.932L517.103 377.574C517.12 377.726 517.011 377.863 516.86 377.88Z" fill="#72A6CF"/>
                                <path d="M513.906 351.603C513.895 351.604 513.885 351.605 513.875 351.605C513.736 351.605 513.616 351.501 513.601 351.36L513.416 349.718C513.399 349.566 513.507 349.429 513.659 349.412C513.832 349.394 513.948 349.503 513.965 349.655L514.15 351.297C514.166 351.449 514.057 351.586 513.906 351.603Z" fill="#72A6CF"/>
                                <path d="M515.879 369.122C515.868 369.123 515.858 369.124 515.848 369.124C515.709 369.124 515.589 369.02 515.573 368.879L515.388 367.236C515.372 367.084 515.481 366.947 515.632 366.931C515.809 366.918 515.921 367.023 515.937 367.174L516.122 368.815C516.139 368.968 516.031 369.105 515.879 369.122Z" fill="#72A6CF"/>
                                <path d="M514.4 355.984C514.39 355.985 514.38 355.986 514.37 355.986C514.231 355.986 514.111 355.882 514.095 355.74L513.912 354.097C513.895 353.945 514.004 353.809 514.156 353.792C514.316 353.767 514.444 353.884 514.461 354.037L514.644 355.68C514.661 355.83 514.552 355.966 514.4 355.984Z" fill="#72A6CF"/>
                                <path d="M513.508 347.216C513.502 347.217 513.497 347.217 513.491 347.217C513.345 347.217 513.225 347.104 513.216 346.957L513.114 345.309C513.104 345.156 513.22 345.025 513.373 345.016C513.524 344.994 513.655 345.124 513.665 345.275L513.767 346.924C513.777 347.076 513.66 347.207 513.508 347.216Z" fill="#72A6CF"/>
                                <path d="M514.892 360.363C514.882 360.365 514.872 360.366 514.862 360.366C514.723 360.366 514.603 360.262 514.588 360.12L514.404 358.478C514.387 358.327 514.496 358.19 514.648 358.173C514.796 358.157 514.938 358.264 514.953 358.418L515.137 360.06C515.153 360.21 515.044 360.347 514.892 360.363Z" fill="#72A6CF"/>
                                <path d="M515.383 364.742C515.371 364.743 515.362 364.744 515.352 364.744C515.213 364.744 515.093 364.64 515.077 364.498L514.892 362.855C514.876 362.703 514.984 362.566 515.135 362.549C515.307 362.528 515.425 362.642 515.441 362.793L515.626 364.436C515.643 364.588 515.535 364.725 515.383 364.742Z" fill="#72A6CF"/>
                                <path d="M510.545 296.422C510.459 296.434 509.756 296.522 508.714 296.522C506.459 296.522 502.616 296.106 500 293.595C497.918 291.595 497.038 288.654 497.387 284.854C497.402 284.703 497.531 284.609 497.688 284.604C497.839 284.618 497.952 284.753 497.938 284.905C497.606 288.529 498.428 291.317 500.382 293.194C504.012 296.682 510.406 295.883 510.473 295.873C510.618 295.866 510.762 295.96 510.783 296.111C510.802 296.263 510.696 296.403 510.545 296.422Z" fill="#72A6CF"/>
                                <path opacity="0.2" d="M477.5 217.73C480.656 214.376 488.857 214.225 495.509 214.225C502.873 214.225 515.73 214.225 513.65 233.543C513.134 238.34 510.242 254.943 510.084 260.326C509.682 274.08 512.76 286.133 512.76 286.133C505.489 289.586 492.328 283.546 470.781 284.069C470.781 284.069 472.707 255.633 471.17 244.299C470.348 238.239 470.179 225.508 477.5 217.73Z" fill="url(#paint0_linear_621_370)"/>
                                <path d="M477.5 217.73C480.656 214.376 488.857 214.225 495.509 214.225C502.873 214.225 515.73 214.225 513.65 233.543C513.134 238.34 510.242 254.943 510.084 260.326C509.682 274.08 512.76 286.133 512.76 286.133C505.489 289.586 492.328 283.546 470.781 284.069C470.781 284.069 472.707 255.633 471.17 244.299C470.348 238.239 470.179 225.508 477.5 217.73Z" fill="#111111"/>
                                <path d="M508.235 281.659C508.258 281.659 508.283 281.656 508.308 281.65C508.457 281.609 508.544 281.456 508.504 281.307C508.484 281.235 506.541 273.879 506.936 260.333C507.036 256.914 508.263 248.827 509.249 242.33C509.82 238.565 510.314 235.314 510.501 233.573C510.517 233.419 510.406 233.282 510.253 233.265C510.102 233.25 509.961 233.359 509.945 233.513C509.759 235.242 509.266 238.488 508.696 242.246C507.708 248.759 506.478 256.864 506.377 260.318C505.979 273.956 507.945 281.38 507.965 281.453C507.999 281.578 508.111 281.659 508.235 281.659Z" fill="#F3E5CC"/>
                                <path d="M475.901 243.072C475.909 243.072 475.918 243.071 475.927 243.071L482.12 242.497L490.794 243.071C490.929 243.087 491.081 242.965 491.09 242.811C491.101 242.657 490.984 242.524 490.83 242.513L482.112 241.939L475.875 242.514C475.721 242.528 475.608 242.664 475.622 242.819C475.636 242.964 475.758 243.072 475.901 243.072Z" fill="#F3E5CC"/>
                                <path d="M510.883 284.083C506.871 284.565 502.997 283.854 498.473 282.873" stroke="#F3E5CC" stroke-width="0.4819" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M485.145 222.955C492.465 222.955 497.935 214.47 497.987 214.385C498.066 214.254 498.024 214.085 497.893 214.005C497.765 213.926 497.593 213.968 497.513 214.097C497.463 214.181 492.167 222.401 485.145 222.401C483.145 222.401 482.147 221.49 481.662 220.726C480.381 218.705 481.329 216.915 481.784 216.054C481.843 215.943 481.894 215.848 481.931 215.768C481.996 215.63 481.938 215.465 481.798 215.4C481.66 215.335 481.495 215.393 481.43 215.532C481.396 215.605 481.35 215.693 481.295 215.795C480.829 216.674 479.741 218.729 481.195 221.021C481.754 221.904 482.894 222.955 485.145 222.955Z" fill="#FF9147"/>
                                <path d="M494.125 195.721C494.125 198.861 495.532 201.804 494.125 204.126C492.107 207.456 486.583 210.555 482.987 210.555C476.884 210.555 472.758 200.534 472.758 192.891C472.758 185.248 476.971 181.883 483.074 181.883C489.177 181.882 494.125 188.078 494.125 195.721Z" fill="#FFB494"/>
                                <path d="M473.98 195.195C473.98 195.888 474.542 196.449 475.234 196.449C475.927 196.449 476.488 195.888 476.488 195.195C476.488 194.503 475.927 193.941 475.234 193.941C474.542 193.941 473.98 194.503 473.98 195.195Z" fill="#141414"/>
                                <path d="M482.82 194.604C482.82 195.296 483.382 195.858 484.074 195.858C484.767 195.858 485.328 195.296 485.328 194.604C485.328 193.911 484.767 193.35 484.074 193.35C483.382 193.35 482.82 193.911 482.82 194.604Z" fill="#141414"/>
                                <path d="M479.605 200.424C479.256 200.37 478.911 200.297 478.65 200.114C478.381 199.947 478.236 199.677 478.17 199.373C478.049 198.755 478.193 198.052 478.351 197.376C478.515 196.693 478.727 196.01 478.906 195.31C478.997 194.96 479.079 194.604 479.138 194.24C479.18 193.876 479.242 193.493 479.118 193.113C479.105 193.073 479.062 193.051 479.023 193.065C478.991 193.075 478.97 193.105 478.971 193.137V193.148C478.98 193.48 478.884 193.821 478.769 194.154C478.662 194.489 478.538 194.823 478.418 195.161C478.176 195.835 477.938 196.521 477.768 197.238C477.616 197.952 477.461 198.714 477.692 199.505C477.804 199.894 478.091 200.274 478.473 200.434C478.849 200.595 479.239 200.617 479.605 200.575C479.646 200.571 479.676 200.533 479.671 200.491C479.668 200.457 479.641 200.43 479.607 200.425L479.605 200.424Z" fill="#FF816E"/>
                                <path d="M481.891 192.099L483.222 191.723C483.66 191.611 484.099 191.513 484.552 191.448C485.005 191.382 485.469 191.356 485.957 191.355C486.446 191.36 486.952 191.407 487.519 191.46L487.556 191.463C487.831 191.489 488.075 191.287 488.101 191.011C488.114 190.868 488.065 190.732 487.977 190.633C487.128 189.672 485.801 189.132 484.46 189.091C483.789 189.069 483.11 189.17 482.478 189.401C481.847 189.632 481.248 189.981 480.78 190.49C480.406 190.896 480.432 191.528 480.838 191.902C481.103 192.145 481.463 192.219 481.785 192.129L481.891 192.099Z" fill="#141414"/>
                                <path d="M477.667 190.982C477.316 190.522 476.841 190.213 476.33 190.007C475.816 189.801 475.249 189.71 474.672 189.752C474.099 189.793 473.511 189.97 473.027 190.304C472.541 190.629 472.167 191.092 472.001 191.607C471.914 191.878 472.063 192.169 472.335 192.255C472.439 192.288 472.546 192.287 472.643 192.257L472.706 192.238C473.534 191.984 474.065 192.013 474.649 192.11C474.937 192.161 475.229 192.234 475.532 192.31C475.836 192.387 476.14 192.476 476.481 192.536L476.701 192.574C477.246 192.669 477.763 192.304 477.858 191.76C477.908 191.476 477.829 191.195 477.667 190.982Z" fill="#141414"/>
                                <path d="M479.651 205.591C479.994 205.591 481.933 205.559 483.854 204.878C484.012 204.822 484.093 204.65 484.038 204.493C483.982 204.336 483.808 204.256 483.653 204.31C481.682 205.009 479.628 204.992 479.61 204.988C479.609 204.988 479.607 204.988 479.606 204.988C479.442 204.988 479.307 205.12 479.305 205.285C479.303 205.452 479.435 205.588 479.602 205.591C479.607 205.591 479.625 205.591 479.651 205.591Z" fill="#FF816E"/>
                                <path d="M483.48 212.15C487.951 212.38 490.844 209.01 492.439 206.16C493.12 205.509 493.704 204.823 494.127 204.125C494.368 203.725 494.523 203.306 494.62 202.871C493.597 207.405 494.767 212.741 495.335 214.221C495.335 214.221 491.312 220.876 485.146 220.876C480.617 220.876 483.448 214.862 483.448 214.862H483.449C483.582 213.794 483.545 212.682 483.433 211.652C483.45 211.816 483.467 211.982 483.48 212.15Z" fill="#FFB494"/>
                                <path d="M492.438 206.16C490.844 209.01 487.95 212.38 483.48 212.15C483.466 211.982 483.449 211.816 483.432 211.651C483.425 211.588 483.417 211.527 483.409 211.464C483.394 211.341 483.379 211.22 483.362 211.1C483.352 211.027 483.342 210.956 483.332 210.884C483.314 210.769 483.297 210.655 483.278 210.543C483.278 210.541 483.277 210.54 483.277 210.539C486.099 210.417 489.954 208.534 492.438 206.16Z" fill="#FF816E"/>
                                <path d="M471.69 180.243C471.332 177.378 472.496 174.782 479.032 176.035C485.568 177.288 488.433 174.334 493.716 176.035C494.289 176.22 494.815 176.451 495.319 176.702C495.327 175.454 495.616 174.211 496.781 174.371C499.05 174.684 497.418 178.056 497.418 178.056C499.884 176.378 503.231 178.173 499.209 180.015C505.014 188.144 500.605 205.438 495.11 204.593C494.702 204.531 492.558 199.957 492.971 196.218C493.214 194.012 491.982 190.758 491.066 190.979C490.407 191.137 490.016 191.743 489.901 194.366C488.496 194.849 487.235 186.522 487.235 186.522C487.235 186.522 481.181 189.824 475.54 190.808C469.9 191.793 467.303 189.824 466.318 184.362C465.334 178.9 471.69 180.243 471.69 180.243Z" fill="#141414"/>
                                <path d="M494.951 193.706C495.27 195.532 494.05 197.272 492.223 197.592C490.397 197.912 489.238 191.299 491.064 190.979C492.891 190.658 494.631 191.88 494.951 193.706Z" fill="#FFB494"/>
                                <path d="M490.791 192.663C490.905 192.585 491.029 192.527 491.153 192.461C491.284 192.416 491.416 192.362 491.557 192.34C491.837 192.284 492.141 192.294 492.432 192.374C493.02 192.543 493.497 193.068 493.513 193.661C493.514 193.681 493.506 193.703 493.49 193.719C493.459 193.749 493.41 193.749 493.379 193.719L493.371 193.71C493.066 193.407 492.779 193.184 492.462 193.033C492.4 193.199 492.34 193.371 492.295 193.539C492.232 193.795 492.173 194.051 492.169 194.308C492.155 194.565 492.188 194.818 492.263 195.067C492.324 195.325 492.475 195.55 492.624 195.8L492.629 195.809C492.644 195.833 492.644 195.863 492.629 195.888C492.607 195.924 492.56 195.935 492.524 195.913C492.265 195.754 492.011 195.543 491.851 195.256C491.69 194.975 491.583 194.651 491.56 194.325C491.545 194 491.567 193.674 491.653 193.368C491.701 193.188 491.764 193.019 491.841 192.852C491.759 192.84 491.678 192.827 491.592 192.82C491.475 192.811 491.353 192.817 491.227 192.806C491.101 192.805 490.976 192.818 490.839 192.807L490.83 192.806C490.807 192.804 490.786 192.793 490.772 192.772C490.747 192.736 490.756 192.687 490.791 192.663Z" fill="#FF816E"/>
                                <path d="M420.818 310.006C412.902 310.006 363.73 289.022 363.73 240.234C363.73 223.228 377.517 209.441 394.523 209.441C405.656 209.441 415.409 215.351 420.818 224.203C426.226 215.351 435.979 209.441 447.112 209.441C464.119 209.441 477.905 223.228 477.905 240.234C477.905 289.022 427.96 310.006 420.818 310.006Z" fill="#68C8D8"  class="theme-color"/>
                                <path d="M512.493 244.103C512.599 244.103 512.697 244.1 512.787 244.092C512.888 244.083 512.975 244.02 513.015 243.929C513.057 243.837 513.045 243.731 512.985 243.65C512.921 243.566 506.528 235.205 495.164 236.444C495.079 236.452 495.002 236.502 494.957 236.576C494.914 236.65 494.905 236.741 494.938 236.822C495.546 239.05 508.689 244.103 512.493 244.103Z" fill="#FF9147"/>
                                <path d="M445.983 281.078C443.872 281.294 443.331 279.32 446.471 278.079C452.951 275.519 453.081 274.641 454.013 274.344C454.013 274.344 448.949 273.169 450.255 271.861C451.36 270.755 460.082 270.007 462.632 273.581C462.632 273.581 483.362 260.675 488.6 254.848C492.9 246.73 498.128 228.388 500.185 222.627C502.385 216.467 512.305 224.636 512.182 228.261C511.918 236.091 508.409 250.058 500.41 260.066C490.47 272.503 473.88 277.917 464.652 280.747C463.725 283.434 454.207 286.189 452.323 287.025C449.518 288.269 448.915 286.261 451.282 285.002C450.844 285.261 450.186 285.463 449.237 285.81C446.465 286.824 445.04 284.745 447.585 283.501C443.874 285.369 443.234 281.698 445.983 281.078Z" fill="#FFB494"/>
                                <path d="M445.976 281.363C445.996 281.363 446.016 281.361 446.035 281.357C446.147 281.334 448.831 280.758 452.351 278.787C452.489 278.709 452.538 278.535 452.461 278.399C452.384 278.261 452.21 278.211 452.073 278.288C448.635 280.214 445.945 280.793 445.918 280.798C445.764 280.83 445.665 280.982 445.698 281.136C445.725 281.271 445.843 281.363 445.976 281.363Z" fill="#FF816E"/>
                                <path d="M446.977 283.979C447.002 283.979 447.028 283.976 447.054 283.969C447.082 283.961 449.947 283.146 453.458 281.179C453.596 281.102 453.645 280.928 453.568 280.791C453.491 280.654 453.318 280.604 453.18 280.681C449.727 282.614 446.928 283.41 446.9 283.419C446.748 283.462 446.659 283.619 446.702 283.771C446.737 283.897 446.852 283.979 446.977 283.979Z" fill="#FF816E"/>
                                <path d="M450.954 285.483C450.989 285.483 451.025 285.476 451.059 285.462C451.168 285.42 453.737 284.396 455.155 283.521C455.289 283.438 455.33 283.262 455.248 283.128C455.164 282.995 454.991 282.951 454.854 283.035C453.479 283.885 450.874 284.922 450.848 284.932C450.702 284.99 450.63 285.156 450.688 285.302C450.733 285.414 450.841 285.483 450.954 285.483Z" fill="#FF816E"/>
                                <path opacity="0.6" d="M497.663 257.354C499.153 256.68 500.799 256.842 502.1 257.629C501.591 258.468 501.033 259.285 500.409 260.065C499.121 261.677 497.583 263.209 495.882 264.658C495.647 264.364 495.44 264.043 495.278 263.684C494.189 261.277 495.257 258.444 497.663 257.354Z" fill="#FF816E"/>
                                <path d="M505.463 216.092C510.223 215.398 513.601 221.213 514.337 225.376C515.619 232.635 512.766 243.816 512.766 243.816C512.766 243.816 506.53 235.478 495.195 236.718C495.699 229.039 495.054 217.608 505.463 216.092Z" fill="#111111"/>
                                <path d="M494.911 236.699C494.932 235.602 495.019 234.509 495.125 233.417C495.226 232.326 495.343 231.236 495.49 230.149C495.496 230.108 495.53 230.076 495.573 230.074C495.621 230.074 495.659 230.111 495.661 230.158L495.661 230.163C495.682 231.263 495.673 232.36 495.647 233.456C495.629 234.444 495.588 235.429 495.504 236.413L496.414 236.358C496.83 236.339 497.246 236.289 497.663 236.322C498.497 236.353 499.332 236.362 500.157 236.506C501.815 236.701 503.437 237.165 504.981 237.792C506.529 238.413 507.996 239.236 509.341 240.221C510.533 241.093 511.629 242.075 512.607 243.2C512.902 241.877 513.167 240.541 513.407 239.205C513.674 237.683 513.92 236.158 514.093 234.623C514.274 233.09 514.408 231.552 514.453 230.009C514.487 228.468 514.455 226.923 514.253 225.39C514.247 225.346 514.276 225.302 514.321 225.293C514.367 225.284 514.412 225.313 514.422 225.36C514.728 226.89 514.848 228.453 514.873 230.012C514.896 231.573 514.789 233.131 514.655 234.683C514.504 236.235 514.285 237.778 514.021 239.313C513.751 240.848 513.437 242.369 513.043 243.884V243.885C513.028 243.943 512.995 243.997 512.945 244.037C512.823 244.136 512.644 244.117 512.545 243.996L512.536 243.986C511.534 242.749 510.311 241.634 509.004 240.683C507.694 239.724 506.267 238.924 504.763 238.321C503.263 237.711 501.69 237.261 500.08 237.072C499.279 236.931 498.467 236.925 497.657 236.893C497.251 236.859 496.846 236.909 496.442 236.928L495.227 237.001L495.192 237.002C495.033 236.999 494.907 236.868 494.91 236.71L494.911 236.699Z" fill="#FF9147"/>
                                <path d="M352.648 230.533C353.834 234.296 359.042 252.01 365.27 258.363C370.738 263.94 390.172 271.327 394.838 273.048C396.617 270.075 403.264 269.372 404.35 269.941C405.682 270.64 402.034 272.782 402.034 272.782C402.83 272.787 403.144 273.437 408.8 273.852C411.541 274.053 411.6 275.718 409.907 276.063C412.193 275.878 412.587 278.885 409.252 278.336C411.53 278.684 410.928 280.645 408.529 280.53C407.708 280.491 407.148 280.494 406.744 280.399C408.889 280.802 408.908 282.508 406.427 282.222C404.76 282.031 401.806 281.861 393.568 279.04C389.539 278.111 370.195 273.413 358.401 266.324C347.332 259.671 342.734 236.855 342.734 236.855C340.863 229.871 349.693 221.156 352.648 230.533Z" fill="#FFB494"/>
                                <path d="M409.91 276.064C409.91 276.064 407.664 276.282 404.449 275.605" stroke="#FF816E" stroke-width="0.4819" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M409.774 278.337C409.774 278.337 407.391 278.407 404.176 277.73" stroke="#FF816E" stroke-width="0.4819" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M407.047 280.47C407.047 280.47 404.743 280.298 403.434 279.963" stroke="#FF816E" stroke-width="0.4819" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path opacity="0.6" d="M359.664 261.456C362.199 261.804 363.97 264.141 363.622 266.676C363.526 267.374 363.18 268.157 362.819 268.712C361.269 267.95 359.783 267.155 358.403 266.326C357.198 265.602 356.084 264.685 355.055 263.626C355.076 263.609 355.096 263.591 355.119 263.575C356.059 262.087 357.807 261.2 359.664 261.456Z" fill="#FF816E"/>
                                <path d="M371.515 195.428C371.515 195.428 373.022 198.333 361.443 201.866C353.516 204.285 362.675 232.294 355.266 235.112C348.101 237.837 335.751 240.637 328.191 237.08C329.081 231.892 336.733 226.545 337.381 217.324C338.096 207.157 339.663 206.509 345.766 199.635C350.795 193.971 350.637 189.913 357.782 187.835C363.619 186.137 370.478 191.723 371.515 195.428Z" fill="#111111"/>
                                <path d="M334.002 238.995C334.066 238.995 334.13 238.974 334.184 238.931C334.262 238.869 341.978 232.596 342.477 223.229C342.486 223.068 342.363 222.931 342.202 222.923C342.024 222.908 341.904 223.038 341.896 223.198C341.411 232.299 333.896 238.416 333.82 238.476C333.695 238.577 333.674 238.76 333.774 238.885C333.832 238.957 333.916 238.995 334.002 238.995Z" fill="#675FAD"/>
                                <path d="M341.767 238.994C341.851 238.994 341.934 238.958 341.992 238.888C348.292 231.253 347.443 226.614 346.621 222.127C346.037 218.936 345.434 215.638 347.421 211.195C347.487 211.049 347.421 210.876 347.275 210.811C347.128 210.744 346.956 210.811 346.89 210.957C344.828 215.565 345.449 218.954 346.049 222.232C346.883 226.788 347.671 231.092 341.543 238.518C341.441 238.642 341.458 238.826 341.582 238.927C341.637 238.972 341.702 238.994 341.767 238.994Z" fill="#675FAD"/>
                                <path d="M350.669 237.261C350.733 237.261 350.798 237.239 350.852 237.197C353.46 235.102 354.255 229.108 353.151 219.864C353.133 219.705 352.992 219.591 352.827 219.609C352.668 219.629 352.554 219.774 352.573 219.933C353.936 231.346 352.191 235.374 350.488 236.743C350.362 236.843 350.342 237.027 350.443 237.152C350.5 237.223 350.584 237.261 350.669 237.261Z" fill="#675FAD"/>
                                <path d="M352.104 204.337C351.818 205.967 352.908 207.521 354.539 207.806C356.17 208.092 357.205 202.187 355.574 201.901C353.944 201.615 352.39 202.706 352.104 204.337Z" fill="#FFB494"/>
                                <path d="M354.348 203.128C354.611 203.055 354.885 203.048 355.136 203.101C355.263 203.122 355.381 203.172 355.499 203.215C355.609 203.276 355.72 203.329 355.82 203.402C355.839 203.416 355.851 203.437 355.852 203.462C355.853 203.504 355.82 203.539 355.778 203.54H355.774C355.533 203.548 355.312 203.547 355.102 203.565C355.037 203.571 354.983 203.59 354.921 203.6C354.983 203.739 355.033 203.881 355.073 204.031C355.151 204.306 355.168 204.6 355.155 204.892C355.132 205.186 355.034 205.478 354.888 205.73C354.74 205.987 354.51 206.176 354.275 206.314C354.254 206.327 354.225 206.328 354.201 206.315C354.166 206.295 354.153 206.249 354.174 206.214L354.179 206.205C354.308 205.977 354.439 205.776 354.49 205.547C354.554 205.326 354.581 205.103 354.566 204.876C354.563 204.648 354.508 204.423 354.453 204.196C354.414 204.054 354.365 203.909 354.313 203.768C354.044 203.899 353.795 204.087 353.52 204.345L353.511 204.353C353.498 204.366 353.479 204.373 353.459 204.373C353.417 204.373 353.383 204.339 353.383 204.297C353.385 203.759 353.816 203.28 354.348 203.128Z" fill="#FF816E"/>
                                <path d="M352.855 208.466C352.855 209.398 353.61 210.153 354.542 210.153C355.473 210.153 356.228 209.398 356.228 208.466C356.228 207.535 355.473 206.779 354.542 206.779C353.611 206.779 352.855 207.534 352.855 208.466Z" fill="#111111"/>
                                <defs>
                                <linearGradient id="paint0_linear_621_370" x1="492.143" y1="229.317" x2="492.499" y2="282.17" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E73B44"/>
                                <stop offset="1" stop-color="#EB7967" stop-opacity="0"/>
                                </linearGradient>
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
