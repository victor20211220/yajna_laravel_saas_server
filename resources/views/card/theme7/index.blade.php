@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme17">
@else
<div class="{{ $business->theme_color }}" id="view_theme17">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="lawyer-card">
                <section class="profile-sec pb">
                    <div class="profile-banner">
                        <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme7/images/profile-banner.png') }}" class="profile-banner-img" alt="profile-banner-img" id="banner_preview" loading="lazy">
                        <div class="container">
                            <div class="section-title">
                            <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                            </div>
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme7/images/client-image.png') }}"   alt="client-image" loading="lazy">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="client-info text-center">
                            <h3 id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</h3>
                            <span id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</span>
                            <p id="{{ $stringid . '_desc' }}_preview">
                                {!! nl2br(e($business->description)) !!}</p>
                        </div>
                    </div>
                </section>
                @php $j = 1; @endphp
            @foreach ($card_theme->order as $order_key => $order_value)
                @if ($j == $order_value)
                @if ($order_key == 'social')
                <section class="social-link-sec pb"  id="social-div">
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
                                                <img src="{{ asset('custom/theme7/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Services') }}</h2>
                        </div>
                        <div class="slider-wrapper">
                            @if (isset($is_pdf))
                            @php $image_count = 0; @endphp
                                @foreach ($services_content as $k1 => $content)
                                    <div class="service-card edit-card" id="services_{{ $service_row_nos }}">
                                        <div class="service-card-inner">
                                            <div class="service-content">
                                                <h3 id="{{ 'title_' . $service_row_nos . '_preview' }}"> {{ $content->title }}</h3>
                                                <p id="{{ 'description_' . $service_row_nos . '_preview' }}">{{ $content->description }} </p>
                                            </div>
                                            <div class="service-card-image">
                                                <div class="img-wrapper">
                                                    <img id="{{ 's_image' . $image_count . '_preview' }}"
                                                    width="28" height="28"
                                                    src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    class="img-fluid" alt="service-image">
                                                </div>
                                                @if (!empty($content->purchase_link))
                                                <a href="{{ url($content->purchase_link) }}"
                                                    id="{{ 'link_title_' . $service_row_nos . '_preview' }}"
                                                    class="service-icon">
                                                    <div class="btn-svg">
                                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.75 0.999999C12.75 0.585786 12.4142 0.25 12 0.249999L5.25 0.25C4.83579 0.25 4.5 0.585786 4.5 1C4.5 1.41421 4.83579 1.75 5.25 1.75L11.25 1.75L11.25 7.75C11.25 8.16421 11.5858 8.5 12 8.5C12.4142 8.5 12.75 8.16421 12.75 7.75L12.75 0.999999ZM1.53033 12.5303L12.5303 1.53033L11.4697 0.469669L0.46967 11.4697L1.53033 12.5303Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </a>
                                            @endif
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
                                            <div class="service-content">
                                                <h3 id="{{ 'title_' . $service_row_nos . '_preview' }}"> {{ $content->title }}</h3>
                                                <p id="{{ 'description_' . $service_row_nos . '_preview' }}">{{ $content->description }} </p>
                                            </div>
                                            <div class="service-card-image">
                                                <div class="img-wrapper">
                                                    <img id="{{ 's_image' . $image_count . '_preview' }}"
                                                    width="28" height="28"
                                                    src="{{ isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    class="img-fluid" alt="service-image">
                                                </div>
                                                @if (!empty($content->purchase_link))
                                                <a href="{{ url($content->purchase_link) }}"
                                                    id="{{ 'link_title_' . $service_row_nos . '_preview' }}"
                                                    class="service-icon">
                                                    <div class="btn-svg">
                                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.75 0.999999C12.75 0.585786 12.4142 0.25 12 0.249999L5.25 0.25C4.83579 0.25 4.5 0.585786 4.5 1C4.5 1.41421 4.83579 1.75 5.25 1.75L11.25 1.75L11.25 7.75C11.25 8.16421 11.5858 8.5 12 8.5C12.4142 8.5 12.75 8.16421 12.75 7.75L12.75 0.999999ZM1.53033 12.5303L12.5303 1.53033L11.4697 0.469669L0.46967 11.4697L1.53033 12.5303Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </a>
                                            @endif
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                                        fill="none">
                                        <path
                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                            fill="#7E3AE3" />
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow service-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                                        fill="none">
                                        <path
                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                            fill="#7E3AE3" />
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif
                @if ($order_key == 'bussiness_hour')
                <section class="business-hour-sec pt pb mb" id="business-hours-div">
                    <div class="container">
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
                    </div>
                </section>
                @endif
                @if ($order_key == 'gallery')
                <section class="gallery-sec pb" id="gallery-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{__('Gallery')}}</h2>
                        </div>
                        <div class="slider-wrapper">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                                            fill="none">
                                            <path
                                                d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                fill="#7E3AE3" />
                                        </svg>
                                    </div>
                                    <div class="slick-next slick-arrow gallery-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                                            fill="none">
                                            <path
                                                d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                fill="#7E3AE3" />
                                        </svg>
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                </section>
                @endif
                @if ($order_key == 'appointment')
                <section class="appointment-sec pt pb mb" id="appointment-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Make An Appointment') }}</h2>
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
                </section>
                @endif
                @if ($order_key == 'testimonials')
                <section class="testimonial-sec pb" id="testimonials-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Testimonials') }}</h2>
                        </div>
                        <div class="slider-wrapper">
                            @if(isset($is_pdf))
                                @php
                                $t_image_count = 0;
                                $rating = 0;
                                @endphp
                                @foreach ($testimonials_content as $k2 => $testi_content)
                                    <div class="testimonial-card edit-card">
                                        <div class="testimonial-card-inner">
                                            <svg class="testimonial-quote" width="35" height="28" viewBox="0 0 35 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.6586 13.8253V27.0391H0.444824V13.1378C0.444824 6.42781 5.72482 0.927812 12.3386 0.570312V3.62281C7.40232 3.98031 3.49732 8.10531 3.49732 13.1378C3.49732 13.5228 3.79982 13.8253 4.18482 13.8253H13.6586Z" fill="#C69245"/>
                                                <path d="M34.2699 13.8253V27.0391H21.0562V13.1378C21.0562 6.42781 26.3362 0.927812 32.9637 0.570312V3.62281C28.0137 3.98031 24.1087 8.10531 24.1087 13.1378C24.1087 13.5228 24.4112 13.8253 24.7962 13.8253H34.2699Z" fill="#C69245"/>
                                            </svg>
                                            <div class="testimonial-content">
                                                <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                    {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                </h3>
                                                <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
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
                                            </div>
                                            <div class="testimonial-image">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                alt="testimonial image" loading="lazy">
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
                                        <div class="testimonial-card">
                                            <div class="testimonial-card-inner">
                                                <svg class="testimonial-quote" width="35" height="28" viewBox="0 0 35 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6586 13.8253V27.0391H0.444824V13.1378C0.444824 6.42781 5.72482 0.927812 12.3386 0.570312V3.62281C7.40232 3.98031 3.49732 8.10531 3.49732 13.1378C3.49732 13.5228 3.79982 13.8253 4.18482 13.8253H13.6586Z" fill="#C69245"/>
                                                    <path d="M34.2699 13.8253V27.0391H21.0562V13.1378C21.0562 6.42781 26.3362 0.927812 32.9637 0.570312V3.62281C28.0137 3.98031 24.1087 8.10531 24.1087 13.1378C24.1087 13.5228 24.4112 13.8253 24.7962 13.8253H34.2699Z" fill="#C69245"/>
                                                </svg>
                                                <div class="testimonial-content">
                                                    <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                        {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                    </h3>
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
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
                                                </div>
                                                <div class="testimonial-image">
                                                    <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                                        fill="none">
                                        <path
                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                            fill="#7E3AE3" />
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow testimonial-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                                        fill="none">
                                        <path
                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                            fill="#7E3AE3" />
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif
                @if ($order_key == 'contact_info')
                <section class="contact-info-sec pt pb mb" id="contact-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Contact') }}</h2>
                        </div>
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
                                        <li id="contact_{{ $loop->parent->index + 1 }}" class="d-flex align-items-center justify-content-center">
                                            @if ($key1 == 'Address')
                                                @foreach ($val1 as $key2 => $val2)
                                                    @if ($key2 == 'Address_url')
                                                        @php $href = $val2; @endphp
                                                    @endif
                                                @endforeach
                                                <div class="contact-image">
                                                    <img src="{{ asset('custom/theme7/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                        <img src="{{ asset('custom/theme7/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                @else
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme7/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                </section>
                @endif
                @if ($order_key == 'more')
                <section class="more-info-sec pb">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('More') }}</h2>
                        </div>
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}"
                                    class="save-info d-flex align-items-center justify-content-center">
                                    <h3>{{ __('Save') }}</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.545 5.28945C14.5941 5.02654 14.6189 4.75968 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C8.22526 0.00227634 6.53772 1.18703 5.89324 2.96474C4.73932 2.5054 3.4315 3.06844 2.97212 4.22236C2.93236 4.32224 2.89981 4.42482 2.87475 4.52935C1.03224 4.8049 -0.237997 6.52193 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7395 6.87066 15.3023 5.92967 14.545 5.28945Z" fill="#111111"/>
                                        <path d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659L8.99889 13.8173V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V13.8173L6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z" fill="#111111"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="share-info d-flex align-items-center justify-content-center">
                                    <h3>{{ __('Share') }}</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.28377 9.4228C6.04018 9.32536 5.89402 9.03304 5.99146 8.78945C7.30688 5.28165 10.3275 2.74824 13.9814 2.11489L11.8865 0.945621C11.6429 0.799463 11.5455 0.507147 11.6916 0.26355C11.8378 0.0199526 12.1301 -0.0774863 12.3737 0.0686719L15.5405 1.82257C15.7841 1.96873 15.8815 2.26105 15.7353 2.50464L14.0302 5.57397C13.9327 5.72012 13.7866 5.81756 13.5917 5.81756C13.4942 5.81756 13.3968 5.81756 13.3481 5.76884C13.1045 5.62268 13.0071 5.33037 13.1532 5.08677L14.3225 3.04056C10.9608 3.57647 8.13511 5.915 6.91713 9.08176C6.81969 9.27664 6.62481 9.4228 6.42993 9.4228H6.28377ZM14.8107 7.9125C14.8107 7.62019 15.0056 7.42531 15.2979 7.42531C15.5902 7.42531 15.7851 7.66891 15.7851 7.9125V11.7126C15.7851 14.0999 13.885 15.9999 11.4978 15.9999H4.2873C1.94877 15.9999 -3.22908e-06 14.0999 -3.22908e-06 11.7126V4.50214C-3.22908e-06 2.16361 1.90005 0.214836 4.2873 0.214836H7.94126C8.23358 0.214836 8.42846 0.409714 8.42846 0.70203C8.42846 0.994347 8.23358 1.18922 7.94126 1.18922H4.2873C2.48469 1.18922 0.974385 2.65081 0.974385 4.50214V11.7126C0.974385 13.564 2.43597 15.0255 4.2873 15.0255H11.4978C13.3004 15.0255 14.8107 13.564 14.8107 11.7126V7.9125Z" fill="#111111"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <h3>{{ __('Contact') }}</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M13.4595 2.09597C12.1078 0.744271 10.3106 -7.56008e-05 8.39908 5.7592e-09C8.08584 5.7592e-09 7.83203 0.253887 7.83203 0.567049C7.83203 0.880212 8.08592 1.1341 8.39908 1.1341C10.0077 1.13402 11.52 1.76042 12.6575 2.89792C13.7951 4.03543 14.4215 5.54786 14.4214 7.15654C14.4214 7.4697 14.6753 7.72359 14.9885 7.72359C15.3017 7.72359 15.5555 7.4697 15.5555 7.15662C15.5556 5.2449 14.8113 3.44766 13.4595 2.09597Z" fill="#111111"/>
                                        <path d="M11.1269 7.15651C11.1269 7.46967 11.3808 7.72356 11.694 7.72348C12.0072 7.72348 12.261 7.4696 12.261 7.15643C12.2608 5.02735 10.5284 3.29498 8.39916 3.29468C8.39908 3.29468 8.39923 3.29468 8.39916 3.29468C8.08599 3.29468 7.83211 3.54849 7.83203 3.86165C7.83203 4.17481 8.08584 4.4287 8.399 4.42878C9.90305 4.429 11.1267 5.65262 11.1269 7.15651Z" fill="#111111"/>
                                        <path d="M9.87051 10.0477C9.00618 10.0029 8.56585 10.6457 8.35468 10.9545C8.17783 11.213 8.24406 11.5659 8.50256 11.7427C8.76106 11.9195 9.11392 11.8533 9.29076 11.5948C9.54026 11.23 9.6533 11.1726 9.80663 11.1799C10.2974 11.2376 12.2303 12.654 12.4238 13.0969C12.4724 13.2273 12.4705 13.3552 12.4185 13.5107C12.2155 14.113 11.8796 14.5362 11.4468 14.7346C11.0357 14.9231 10.5316 14.906 9.98944 14.6854C7.96492 13.8602 6.19619 12.7086 4.73244 11.2626C4.73184 11.262 4.73123 11.2615 4.7307 11.2609C3.28768 9.79855 2.13823 8.03207 1.31442 6.01066C1.09372 5.46803 1.07664 4.96388 1.26512 4.55281C1.46352 4.12004 1.88676 3.78412 2.48851 3.58142C2.64457 3.5291 2.77219 3.52744 2.9014 3.57552C3.34589 3.76975 4.76223 5.70256 4.81939 6.1878C4.82756 6.34688 4.76972 6.45984 4.40522 6.70888C4.14664 6.8855 4.08018 7.23836 4.25688 7.49693C4.43349 7.75551 4.78627 7.82189 5.04492 7.64527C5.35385 7.43433 5.99651 6.99521 5.9519 6.12792C5.90276 5.22201 4.14052 2.82293 3.29849 2.51332C2.92401 2.37375 2.5301 2.37134 2.12727 2.50652C1.22089 2.81174 0.566293 3.35596 0.234229 4.08027C-0.0878549 4.78296 -0.077648 5.59822 0.264094 6.43836C1.14574 8.60162 2.37926 10.4944 3.93033 12.0644C3.93411 12.0683 3.93797 12.072 3.9419 12.0757C5.51074 13.6239 7.40135 14.8552 9.56174 15.7358C9.99436 15.9117 10.4204 15.9998 10.8278 15.9998C11.2115 15.9998 11.5788 15.9218 11.9195 15.7656C12.6438 15.4336 13.188 14.7791 13.4934 13.8721C13.6283 13.47 13.6261 13.0762 13.4876 12.7035C13.1769 11.8592 10.7779 10.097 9.87051 10.0477Z" fill="#111111"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif

                @if ($order_key == 'payment')
                <section class="payment-sec pb" id="payment-section">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Payment') }}</h2>
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
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Download Here') }}</h2>
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
                            <div class="thankyou-svg pb">
                                @if(empty($business->svg_text))
                                <svg xmlns="http://www.w3.org/2000/svg" width="430" height="399" viewBox="0 0 430 399" fill="none">
                                    <path d="M73.2788 135.488L77.3024 137.001L73.8086 137.992C72.6423 138.323 71.7174 139.211 71.3406 140.363L70.0763 144.226L68.5216 140.351C68.1361 139.39 67.3583 138.638 66.3843 138.284L62.8511 137.001L66.6785 135.428C67.6044 135.047 68.3332 134.302 68.6937 133.367L70.0772 129.774L71.0694 133.114C71.3934 134.209 72.2116 135.087 73.2788 135.488Z" fill="#E0E0E0"/>
                                    <path d="M268.06 147.382L272.566 149.076L268.654 150.185C267.348 150.555 266.312 151.552 265.89 152.841L264.474 157.168L262.733 152.828C262.301 151.751 261.43 150.909 260.339 150.513L256.38 149.076L260.667 147.314C261.705 146.889 262.521 146.054 262.924 145.007L264.473 140.983L265.583 144.724C265.949 145.949 266.865 146.933 268.06 147.382Z" fill="#E0E0E0"/>
                                    <path d="M251.999 46.1172L254.752 47.1517L252.362 47.8295C251.565 48.0555 250.931 48.6641 250.673 49.4515L249.808 52.0945L248.745 49.4438C248.48 48.7862 247.949 48.2718 247.282 48.0295L244.865 47.1517L247.484 46.0759C248.118 45.8153 248.616 45.3058 248.862 44.6664L249.808 42.209L250.487 44.4943C250.709 45.2414 251.268 45.8423 251.999 46.1172Z" fill="#E0E0E0"/>
                                    <path d="M84.1734 25.7071L86.926 26.7416L84.5359 27.4194C83.7388 27.6453 83.1053 28.2539 82.8476 29.0413L81.9833 31.6843L80.9199 29.0336C80.6565 28.376 80.1238 27.8616 79.4576 27.6194L77.0396 26.7416L79.6585 25.6657C80.2921 25.4052 80.7901 24.8956 81.0372 24.2563L81.9833 21.7988L82.662 24.0842C82.8841 24.8322 83.4437 25.4331 84.1734 25.7071Z" fill="#E0E0E0"/>
                                    <path d="M137.905 28.1696L144 30.4607L138.708 31.9615C136.942 32.4624 135.541 33.8084 134.971 35.5534L133.057 41.4047L130.702 35.5361C130.118 34.0795 128.941 32.9402 127.465 32.4047L122.113 30.4616L127.91 28.0802C129.313 27.5043 130.417 26.3755 130.962 24.9603L133.057 19.5195L134.56 24.5786C135.05 26.2323 136.289 27.5619 137.905 28.1696Z" fill="#E0E0E0"/>
                                    <path d="M234.368 18.0038L238.392 19.5162L234.898 20.5065C233.732 20.8372 232.807 21.7256 232.43 22.8774L231.166 26.7404L229.611 22.8658C229.225 21.9034 228.448 21.1516 227.474 20.7987L223.939 19.5152L227.767 17.9423C228.694 17.5616 229.422 16.8165 229.782 15.8819L231.166 12.2891L232.158 15.6301C232.484 16.7242 233.301 17.6029 234.368 18.0038Z" fill="#E0E0E0"/>
                                    <path d="M361.895 119.383L365.919 120.895L362.425 121.886C361.259 122.217 360.334 123.105 359.957 124.257L358.692 128.12L357.138 124.246C356.752 123.284 355.974 122.532 355.001 122.179L351.466 120.895L355.294 119.322C356.22 118.941 356.948 118.196 357.309 117.262L358.692 113.669L359.685 117.009C360.01 118.103 360.828 118.982 361.895 119.383Z" fill="#E0E0E0"/>
                                    <path d="M67.4602 158.745L68.9754 159.316L67.6592 159.689C67.2198 159.813 66.8718 160.148 66.7295 160.582L66.2536 162.036L65.6681 160.577C65.5229 160.215 65.2306 159.932 64.8633 159.798L63.5327 159.315L64.9739 158.722C65.3229 158.579 65.5969 158.298 65.7325 157.946L66.2536 156.594L66.6276 157.852C66.7506 158.264 67.0583 158.594 67.4602 158.745Z" fill="#E0E0E0"/>
                                    <path d="M194.138 23.8636L195.654 24.4338L194.338 24.8068C193.899 24.9318 193.551 25.2664 193.409 25.7L192.933 27.1556L192.347 25.6961C192.202 25.3337 191.909 25.051 191.543 24.9174L190.212 24.4338L191.653 23.8415C192.002 23.6983 192.276 23.4175 192.412 23.0656L192.933 21.7129L193.307 22.9714C193.429 23.3819 193.737 23.7127 194.138 23.8636Z" fill="#E0E0E0"/>
                                    <path d="M360.883 348.582L363.636 349.617L361.246 350.294C360.448 350.52 359.815 351.129 359.558 351.916L358.692 354.559L357.629 351.909C357.364 351.251 356.833 350.736 356.167 350.494L353.75 349.617L356.368 348.541C357.002 348.28 357.501 347.771 357.747 347.131L358.693 344.674L359.372 346.959C359.594 347.707 360.153 348.307 360.883 348.582Z" fill="#E0E0E0"/>
                                    <path d="M346.445 373.338L350.468 374.85L346.975 375.84C345.808 376.171 344.883 377.06 344.507 378.211L343.242 382.074L341.688 378.2C341.302 377.238 340.524 376.486 339.55 376.133L336.016 374.849L339.844 373.276C340.77 372.896 341.498 372.15 341.859 371.216L343.242 367.624L344.234 370.964C344.559 372.059 345.378 372.937 346.445 373.338Z" fill="#E0E0E0"/>
                                    <path d="M147.011 384.723L151.035 386.236L147.541 387.226C146.375 387.557 145.45 388.445 145.073 389.597L143.809 393.46L142.254 389.586C141.868 388.624 141.091 387.871 140.117 387.518L136.583 386.235L140.41 384.662C141.337 384.281 142.065 383.536 142.425 382.602L143.809 379.009L144.801 382.349C145.126 383.444 145.944 384.322 147.011 384.723Z" fill="#E0E0E0"/>
                                    <path d="M315.834 364.334L317.349 364.904L316.034 365.277C315.595 365.402 315.247 365.737 315.105 366.171L314.629 367.626L314.043 366.167C313.898 365.804 313.605 365.522 313.238 365.388L311.908 364.904L313.349 364.312C313.698 364.169 313.972 363.888 314.107 363.536L314.629 362.184L315.002 363.442C315.125 363.853 315.432 364.183 315.834 364.334Z" fill="#E0E0E0"/>
                                    <path d="M288.089 103.104L289.604 103.674L288.289 104.047C287.85 104.172 287.502 104.507 287.359 104.94L286.883 106.396L286.298 104.936C286.153 104.574 285.86 104.291 285.493 104.158L284.163 103.674L285.604 103.082C285.953 102.938 286.227 102.658 286.362 102.306L286.883 100.953L287.257 102.212C287.38 102.622 287.687 102.953 288.089 103.104Z" fill="#E0E0E0"/>
                                    <path d="M85.3063 67.7817L89.4818 69.3517L85.8563 70.3795C84.6458 70.7228 83.6863 71.6448 83.295 72.8408L81.9836 76.85L80.3703 72.8293C79.9703 71.8303 79.1627 71.0506 78.1523 70.6833L74.4854 69.3517L78.457 67.7192C79.4185 67.3241 80.1742 66.5511 80.5482 65.581L81.9836 61.8525L83.0133 65.3195C83.3498 66.454 84.1987 67.3654 85.3063 67.7817Z" fill="#E0E0E0"/>
                                    <path d="M46.6536 148.241L48.8745 149.076L46.9468 149.623C46.3036 149.806 45.7931 150.296 45.5845 150.931L44.8865 153.063L44.0289 150.925C43.8164 150.394 43.3876 149.979 42.8492 149.784L40.8994 149.076L43.0117 148.208C43.5232 147.997 43.9251 147.587 44.1231 147.07L44.8865 145.088L45.4335 146.931C45.6133 147.536 46.0652 148.02 46.6536 148.241Z" fill="#E0E0E0"/>
                                    <path d="M427.037 201.085C404.386 190.663 383.044 198.698 383.044 198.698C399.516 211.878 427.037 201.085 427.037 201.085Z" fill="#E0E0E0"/>
                                    <path d="M359.664 184.612C356.285 199.536 363.974 212.13 363.974 212.13C369.842 200.809 359.664 184.612 359.664 184.612Z" fill="#E0E0E0"/>
                                    <path d="M369.997 211.828C386.811 219.251 403.399 213.183 403.399 213.183C391.404 203.682 369.997 211.828 369.997 211.828Z" fill="#E0E0E0"/>
                                    <path d="M396.436 185.358C396.206 185.105 386.175 193.835 374.034 204.854C361.888 215.877 352.232 225.014 352.461 225.267C352.689 225.52 362.718 216.792 374.864 205.769C387.005 194.75 396.664 185.611 396.436 185.358Z" fill="#E0E0E0"/>
                                    <path d="M429.018 162.896C429.018 162.896 400.77 166.215 391.889 190.024C391.889 190.024 416.031 187.525 429.018 162.896Z" fill="#E0E0E0"/>
                                    <path d="M388.992 156.854C388.992 156.854 368.291 176.357 375.352 200.768C375.352 200.768 393.245 184.372 388.992 156.854Z" fill="#E0E0E0"/>
                                    <path d="M30.6715 234.527C25.9528 253.76 35.4307 269.194 35.4307 269.194C43.2298 254.366 30.6715 234.527 30.6715 234.527Z" fill="#E0E0E0"/>
                                    <path d="M27.9644 289.548C40.1111 289.937 48.7746 282.046 48.7746 282.046C39.0632 279.173 27.9644 289.548 27.9644 289.548Z" fill="#E0E0E0"/>
                                    <path d="M47.6332 277.393C50.8905 263.164 43.6625 251.141 43.6625 251.141C38.0592 261.924 47.6332 277.393 47.6332 277.393Z" fill="#E0E0E0"/>
                                    <path d="M23.0116 260.759C22.8491 260.977 31.1665 267.485 41.5866 275.295C52.0105 283.108 60.5894 289.264 60.7518 289.048C60.9143 288.832 52.5989 282.324 42.175 274.511C31.7549 266.699 23.1741 260.542 23.0116 260.759Z" fill="#E0E0E0"/>
                                    <path d="M0.592285 238.729C0.592285 238.729 7.43194 260.258 27.3356 263.601C27.3356 263.601 21.7525 245.151 0.592285 238.729Z" fill="#E0E0E0"/>
                                    <path d="M1.90479 270.854C1.90479 270.854 20.2298 284.063 38.2029 274.882C38.2029 274.882 22.7228 263.396 1.90479 270.854Z" fill="#E0E0E0"/>
                                    <path d="M412.024 398.647C412.024 398.786 324.658 398.897 216.91 398.897C109.126 398.897 21.7783 398.785 21.7783 398.647C21.7783 398.51 109.127 398.397 216.91 398.397C324.658 398.397 412.024 398.509 412.024 398.647Z" fill="#263238"/>
                                    <path d="M365.326 149.705C332.287 151.285 312.075 173.793 312.075 173.793C339.524 179.238 365.326 149.705 365.326 149.705Z" fill="#1A213B"/>
                                    <path d="M275.935 171.505C281.081 191.14 297.834 201.265 297.834 201.265C297.82 184.35 275.935 171.505 275.935 171.505Z" fill="#1A213B"/>
                                    <path d="M304.742 197.227C329.074 195.685 344.893 178.399 344.893 178.399C324.963 174.549 304.742 197.227 304.742 197.227Z" fill="#1A213B"/>
                                    <path d="M319.683 149.901C319.258 149.743 312.787 166.154 305.229 186.55C297.67 206.953 291.888 223.614 292.313 223.772C292.737 223.929 299.207 207.521 306.766 187.119C314.323 166.723 320.106 150.057 319.683 149.901Z" fill="#1A213B"/>
                                    <path d="M344.307 103.534C344.307 103.534 313.081 124.713 317.183 158.173C317.183 158.173 344.076 140.47 344.307 103.534Z" fill="#1A213B"/>
                                    <path d="M293.492 120.895C293.492 120.895 281.045 156.512 304.283 180.932C304.283 180.932 315.322 150.688 293.492 120.895Z" fill="#1A213B"/>
                                    <path d="M35.9375 234.183C59.7754 227.168 79.6636 238.166 79.6636 238.166C61.5223 248.79 35.9375 234.183 35.9375 234.183Z" fill="#1A213B"/>
                                    <path d="M104.749 227.645C105.931 242.848 96.5351 254.158 96.5351 254.158C92.3798 242.149 104.749 227.645 104.749 227.645Z" fill="#1A213B"/>
                                    <path d="M90.6379 252.993C72.9888 257.89 57.5049 249.518 57.5049 249.518C70.7016 241.876 90.6379 252.993 90.6379 252.993Z" fill="#1A213B"/>
                                    <path d="M68.3806 223.083C68.6431 222.866 77.2768 232.92 87.6622 245.535C98.0515 258.155 106.258 268.556 105.995 268.772C105.732 268.988 97.1007 258.936 86.7114 246.318C76.3269 233.703 68.1182 223.298 68.3806 223.083Z" fill="#1A213B"/>
                                    <path d="M39.4863 196.239C39.4863 196.239 66.8632 203.582 72.1905 228.339C72.1905 228.339 48.745 222.396 39.4863 196.239Z" fill="#1A213B"/>
                                    <path d="M79.8265 196.048C79.8265 196.048 97.4304 218.262 86.9508 241.316C86.9508 241.316 71.6687 222.569 79.8265 196.048Z" fill="#1A213B"/>
                                    <path d="M273.237 74.0109L277.448 61.6305C273.975 54.9639 272.243 47.2849 272.823 39.2377C274.489 16.094 294.601 -1.31761 317.745 0.348556C340.888 2.01472 358.3 22.127 356.634 45.2717C354.968 68.4154 334.855 85.827 311.711 84.1608C302.046 83.4647 293.39 79.5449 286.696 73.5388L286.71 73.559L273.237 74.0109Z" fill="white"/>
                                    <path d="M273.237 74.0105C273.237 74.0105 273.515 74.0124 274.086 73.9999C274.676 73.9855 275.528 73.9653 276.646 73.9384C278.943 73.8768 282.32 73.7855 286.712 73.6663L286.902 73.6615L286.8 73.4999L286.787 73.4798L286.624 73.6182C290.631 77.2294 296.694 81.2895 304.894 83.2729C306.932 83.7719 309.093 84.1238 311.345 84.3065C313.602 84.3786 315.947 84.5411 318.35 84.2575C323.155 83.8604 328.212 82.6019 333.069 80.256C337.922 77.9216 342.565 74.5056 346.446 70.0869C350.329 65.6796 353.436 60.2629 355.24 54.2232C357.081 48.1959 357.45 41.5389 356.324 34.9992C355.188 28.4653 352.507 21.9958 348.225 16.5502C347.684 15.8686 347.159 15.1763 346.608 14.5091C346.011 13.8823 345.414 13.2564 344.82 12.6324L343.928 11.6979L342.958 10.8499C342.309 10.2884 341.662 9.72788 341.017 9.16833C340.353 8.63377 339.636 8.1694 338.95 7.66849C338.248 7.19066 337.593 6.64648 336.839 6.25806C335.366 5.43219 333.947 4.51882 332.39 3.8987C326.317 1.10669 319.746 -0.156642 313.417 0.0154549C307.081 0.232739 301.023 1.88449 295.759 4.5544C290.485 7.2195 286.003 10.8826 282.518 15.0139C279.021 19.1471 276.525 23.7399 274.933 28.3048C274.078 30.5766 273.62 32.8831 273.149 35.0973C272.89 37.3471 272.543 39.5103 272.556 41.6149C272.442 50.0563 274.85 56.9363 277.352 61.681L277.345 61.5974C276.001 65.6392 274.966 68.7485 274.262 70.8647C273.922 71.8953 273.664 72.6808 273.484 73.2259C273.314 73.7518 273.237 74.0105 273.237 74.0105C273.237 74.0105 273.344 73.7288 273.533 73.1932C273.725 72.6452 274.002 71.8559 274.366 70.8195C275.092 68.7283 276.161 65.6575 277.549 61.6647L277.563 61.6224L277.542 61.581C275.091 56.8402 272.74 49.9938 272.89 41.6197C272.885 39.5314 273.24 37.3865 273.504 35.1569C273.98 32.9639 274.441 30.6785 275.295 28.4307C276.886 23.9129 279.372 19.3721 282.843 15.2888C286.303 11.2075 290.746 7.59254 295.967 4.96493C301.177 2.33348 307.169 0.709613 313.432 0.500981C319.69 0.337537 326.181 1.59125 332.18 4.35442C333.718 4.96781 335.119 5.87156 336.574 6.68782C337.319 7.07144 337.967 7.60984 338.66 8.08191C339.337 8.57705 340.045 9.03565 340.702 9.56444C341.339 10.1173 341.979 10.6711 342.619 11.2268L343.577 12.0642L344.458 12.9881C345.046 13.6044 345.635 14.2226 346.225 14.8427C346.769 15.5023 347.288 16.1868 347.822 16.8598C352.054 22.241 354.703 28.6307 355.829 35.0858C356.944 41.5466 356.587 48.1286 354.772 54.0876C352.997 60.0591 349.933 65.4181 346.1 69.785C342.269 74.1624 337.682 77.5524 332.883 79.8743C328.081 82.2077 323.077 83.4681 318.319 83.8767C315.938 84.1661 313.612 84.0113 311.374 83.9488C309.14 83.7758 306.996 83.4364 304.972 82.9489C296.83 81.0155 290.785 77.0188 286.769 73.4586L286.18 72.9365L286.606 73.598L286.618 73.6182L286.706 73.4519C282.347 73.6269 278.998 73.7624 276.719 73.8538C275.589 73.9028 274.727 73.9393 274.13 73.9653C273.545 73.9893 273.237 74.0105 273.237 74.0105Z" fill="#263238"/>
                                    <path d="M336.001 37.0909C335.75 34.3162 334.47 31.6934 332.663 29.5724C330.894 27.4948 328.559 25.8344 325.906 25.1902C323.088 24.5066 319.998 25.0373 317.571 26.6218C316.127 27.564 314.93 28.8716 314.089 30.3762C313.332 29.0062 312.28 27.7976 311.011 26.8804C308.66 25.1835 305.598 24.5076 302.751 25.0575C300.072 25.5748 297.66 27.1237 295.795 29.1158C293.891 31.1492 292.488 33.7085 292.106 36.4679C291.627 39.9242 292.208 43.7334 293.935 46.7658C295.759 49.9674 298.766 52.5902 301.876 54.565C307.106 57.8867 313.998 62.0536 313.998 62.0536C313.998 62.0536 320.007 57.7771 325.389 54.7063C328.59 52.8796 331.717 50.4029 333.689 47.2907C335.556 44.3439 336.316 40.5665 336.001 37.0909Z" fill="#1A213B"/>
                                    <path d="M263.944 183.45C263.944 183.45 284.084 182.69 293.965 208.15C303.845 233.611 313.725 286.812 313.725 286.812L375.783 248.757L395.95 272.277C395.95 272.277 303.844 341.533 295.104 345.332C286.364 349.132 276.484 340.012 272.304 334.692C268.124 329.373 263.944 183.45 263.944 183.45Z" fill="#AE7461"/>
                                    <path d="M53.6723 310.667L104.184 322.655C104.184 322.655 115.201 236.083 123.212 222.565C133.832 204.644 150.193 200.524 150.193 200.524L164.253 244.226C164.253 244.226 148.673 364.688 139.553 371.528C130.432 378.369 46.8701 338.633 46.8701 338.633L53.6723 310.667Z" fill="#AE7461"/>
                                    <path class="theme-color" d="M311.909 398.647C311.909 398.647 290.762 331.524 290.762 315.803C290.762 310.859 295.339 283.815 295.339 262.845C295.339 246.148 286.555 224.236 281.651 212.959C280.047 209.268 263.911 183.497 263.911 183.497L233.723 179.476L183.442 183.232L141.67 203.917L156.265 297.016L170.446 356.27L152.118 398.648H311.909V398.647Z" fill="#C69245"/>
                                    <path d="M236.277 326.787C248.582 314.708 261.695 303.452 275.498 293.117L236.277 326.787Z" fill="#263238"/>
                                    <path class="theme-color" d="M105.562 288.885L160.552 299.576C160.552 299.576 143.886 202.818 143.513 203.002C143.14 203.187 122.681 210.567 117.09 236.582C111.441 262.856 105.562 288.885 105.562 288.885Z" fill="#C69245"/>
                                    <path class="theme-color" d="M259.117 182.858C259.117 182.858 280.136 182.156 289.221 198.811C298.307 215.466 314.759 261.384 314.759 261.384L287.257 272.189L259.117 182.858Z" fill="#C69245"/>
                                    <path d="M279.773 224.012C279.786 223.999 279.92 224.117 280.165 224.353C280.445 224.633 280.793 224.98 281.218 225.403C281.679 225.857 282.227 226.427 282.811 227.136C283.401 227.839 284.112 228.61 284.782 229.553C285.131 230.018 285.493 230.503 285.87 231.007C286.244 231.516 286.585 232.078 286.965 232.642C287.742 233.762 288.44 235.038 289.202 236.365C290.641 239.066 292.024 242.144 293.137 245.5C294.216 248.868 294.914 252.171 295.345 255.201C295.512 256.723 295.7 258.165 295.732 259.527C295.759 260.207 295.815 260.863 295.812 261.494C295.804 262.124 295.798 262.73 295.791 263.31C295.805 264.468 295.684 265.509 295.623 266.425C295.57 267.343 295.463 268.126 295.358 268.765C295.265 269.356 295.188 269.841 295.127 270.234C295.068 270.568 295.029 270.742 295.012 270.739C294.995 270.736 295.001 270.558 295.027 270.218C295.063 269.824 295.109 269.337 295.165 268.741C295.24 268.102 295.318 267.32 295.344 266.405C295.379 265.493 295.475 264.456 295.437 263.307C295.433 262.731 295.43 262.129 295.427 261.504C295.42 260.877 295.353 260.227 295.319 259.553C295.269 258.202 295.067 256.773 294.889 255.265C294.437 252.264 293.732 248.995 292.663 245.656C291.56 242.331 290.201 239.275 288.797 236.585C288.052 235.263 287.374 233.989 286.618 232.868C286.249 232.303 285.919 231.74 285.555 231.229C285.19 230.721 284.838 230.234 284.502 229.767C283.854 228.816 283.165 228.035 282.599 227.318C282.04 226.595 281.515 226.009 281.078 225.536C280.682 225.088 280.358 224.721 280.095 224.425C279.871 224.165 279.761 224.024 279.773 224.012Z" fill="#263238"/>
                                    <path d="M145.073 253.11C145.089 253.105 145.165 253.271 145.296 253.594C145.441 253.971 145.622 254.441 145.843 255.015C146.311 256.251 146.957 258.052 147.726 260.288C149.266 264.757 151.261 270.979 153.211 277.925C155.158 284.874 156.688 291.228 157.696 295.846C158.201 298.156 158.586 300.03 158.829 301.328C158.939 301.933 159.028 302.429 159.1 302.826C159.157 303.17 159.178 303.352 159.162 303.355C159.145 303.359 159.091 303.183 159.002 302.847C158.906 302.454 158.786 301.966 158.64 301.369C158.32 300.014 157.883 298.171 157.352 295.925C156.256 291.33 154.673 285 152.729 278.061C150.782 271.124 148.843 264.894 147.39 260.4C146.676 258.205 146.09 256.403 145.661 255.08C145.475 254.493 145.324 254.013 145.202 253.629C145.102 253.295 145.057 253.117 145.073 253.11Z" fill="#263238"/>
                                    <path d="M170.534 125.797C161.711 109.617 159.816 89.584 165.441 71.9513L142.897 69.3525C127.437 70.2899 113.969 82.28 107.751 96.9054C101.533 111.531 101.639 128.292 104.617 143.963C105.741 149.878 107.139 156.493 103.958 161.549C101.267 165.824 95.9962 167.683 93.0081 171.745C88.5682 177.779 90.9372 187.258 96.8125 191.806C102.688 196.353 110.884 196.614 117.881 194.308C124.879 192.001 130.949 187.462 136.84 182.937C139.394 187.204 145.211 188.624 149.75 186.823C154.289 185.022 157.511 180.594 158.931 175.798C160.352 171.002 160.182 165.855 159.541 160.884C168.122 163.485 178.13 156.29 178.731 147.089C179.236 139.344 174.224 132.563 170.534 125.797Z" fill="#263238"/>
                                    <path d="M132.657 108.505C131.943 103.766 131.242 98.937 132.006 94.2048C132.77 89.4736 135.241 84.7731 139.462 82.5051C141.449 81.4369 143.993 80.9966 145.912 82.1811C147.831 83.3665 148.385 86.5787 146.523 87.8497L146.409 88.4698C145.308 95.0614 144.076 101.631 142.715 108.174C142.373 109.82 142.003 111.512 141.064 112.908C140.123 114.305 138.468 115.352 136.807 115.078C134.062 114.623 133.071 111.256 132.657 108.505Z" fill="#1A213B"/>
                                    <path d="M145.08 75.1787C153.321 59.5862 169.043 47.2144 188.273 43.3168C198.972 41.1487 203.833 42.7053 211.942 43.436C220.05 44.1657 227.764 47.0933 233.533 52.8379C240.385 59.6602 246.523 67.5709 249.221 76.8565C251.993 86.3949 253.785 95.9919 253.111 105.901C252.265 118.327 246.28 126.526 241.925 135.454L227.389 143.653C213.762 146.526 199.941 149.415 186.038 148.632C172.133 147.848 157.896 142.94 148.689 132.49C135.897 117.972 136.037 92.2846 145.08 75.1787Z" fill="#263238"/>
                                    <path d="M167.138 71.1395L197.922 52.178L206.743 51.6656C226.208 48.3207 243.388 67.4197 246.28 83.1517C249.494 100.63 252.727 122.096 252.211 135.485C251.171 162.408 229.41 168.452 229.41 168.452C229.41 168.452 230.326 172.571 232.02 181.253C228.354 195.596 206.063 199.207 184.388 187.328L183.539 186.398L159.95 81.5576C159.278 76.7456 162.401 72.2192 167.138 71.1395Z" fill="#AE7461"/>
                                    <path d="M238.556 106.366C238.832 108.148 237.552 109.852 235.696 110.175C233.844 110.498 232.116 109.319 231.839 107.538C231.562 105.756 232.843 104.051 234.693 103.728C236.549 103.403 238.279 104.584 238.556 106.366Z" fill="#263238"/>
                                    <path d="M241.887 92.9418C241.52 93.4331 238.726 91.8409 235.08 92.2861C231.432 92.6783 228.981 94.8742 228.532 94.4753C228.313 94.3012 228.648 93.4523 229.71 92.4649C230.756 91.4833 232.615 90.4286 234.888 90.1661C237.161 89.9075 239.171 90.5161 240.372 91.24C241.595 91.9649 242.07 92.7197 241.887 92.9418Z" fill="#263238"/>
                                    <path d="M223.648 125.34C223.606 125.136 225.826 124.473 229.443 123.565C230.362 123.357 231.221 123.067 231.303 122.413C231.442 121.714 230.933 120.757 230.352 119.728C229.207 117.579 228.008 115.326 226.751 112.966C221.722 103.328 217.961 95.3581 218.352 95.16C218.742 94.961 223.136 102.611 228.165 112.249C229.382 114.628 230.546 116.895 231.655 119.065C232.134 120.081 232.883 121.209 232.574 122.662C232.406 123.388 231.783 123.974 231.205 124.207C230.63 124.461 230.108 124.532 229.65 124.616C225.978 125.255 223.687 125.545 223.648 125.34Z" fill="#263238"/>
                                    <path d="M229.447 168.416C229.447 168.416 211.808 171.686 192.933 163.204C192.933 163.204 204.547 180.393 230.697 174.761L229.447 168.416Z" fill="#6F4439"/>
                                    <path d="M238.437 80.5099C237.932 81.4732 235.067 81.2117 231.838 81.8732C228.587 82.4299 226.008 83.7163 225.194 83C224.828 82.6462 225.081 81.7357 226.105 80.705C227.113 79.6802 228.94 78.6245 231.168 78.2044C233.395 77.7881 235.473 78.1082 236.776 78.6995C238.096 79.2889 238.652 80.0465 238.437 80.5099Z" fill="#263238"/>
                                    <path d="M198.622 112.148C198.839 113.938 200.534 115.23 202.408 115.036C204.278 114.844 205.622 113.24 205.405 111.45C205.186 109.66 203.49 108.367 201.621 108.559C199.748 108.751 198.404 110.358 198.622 112.148Z" fill="#263238"/>
                                    <path d="M192.765 100.122C193.252 100.496 195.508 98.2041 199.137 97.6407C202.754 97.0273 205.711 98.4743 206.034 97.9676C206.196 97.7407 205.644 97.0148 204.353 96.3524C203.08 95.6919 201.004 95.1814 198.746 95.5467C196.488 95.9159 194.718 97.0475 193.76 98.0705C192.78 99.1031 192.527 99.9568 192.765 100.122Z" fill="#263238"/>
                                    <path d="M192.906 88.1691C193.75 88.8806 196.415 87.5846 199.773 87.0135C203.113 86.3376 206.075 86.5866 206.595 85.6223C206.818 85.1589 206.238 84.4041 204.87 83.8196C203.52 83.237 201.368 82.9245 199.065 83.3514C196.763 83.7811 194.876 84.8435 193.839 85.8723C192.783 86.9068 192.528 87.8172 192.906 88.1691Z" fill="#263238"/>
                                    <path d="M172.162 124.747C171.923 122.78 169.095 118.412 167.115 118.341C161.83 118.153 152.525 119.686 154.012 132.875C156.046 150.904 173.728 145.144 173.701 144.624C173.681 144.216 172.99 131.54 172.162 124.747Z" fill="#AE7461"/>
                                    <path d="M167.984 138.599C167.898 138.55 167.694 138.855 167.191 139.158C166.699 139.452 165.828 139.717 164.847 139.471C162.864 138.987 160.92 136.145 160.466 132.904C160.234 131.267 160.402 129.666 160.837 128.307C161.239 126.926 161.988 125.909 162.928 125.631C163.857 125.303 164.6 125.801 164.879 126.281C165.178 126.759 165.103 127.132 165.202 127.151C165.258 127.192 165.555 126.806 165.326 126.078C165.211 125.728 164.952 125.327 164.489 125.028C164.017 124.725 163.361 124.617 162.701 124.765C161.321 125.019 160.214 126.438 159.735 127.93C159.182 129.438 158.954 131.241 159.213 133.079C159.738 136.698 161.981 139.888 164.673 140.348C165.978 140.535 166.993 140.034 167.491 139.546C168.001 139.039 168.05 138.624 167.984 138.599Z" fill="#6F4439"/>
                                    <path d="M166.396 118.52L171.753 122.425C191.504 104.605 219.601 48.5881 216.406 49.8149C216.406 49.8149 202.032 46.6537 187.915 51.6868C173.798 56.719 147.476 68.8465 150.911 85.9351C154.347 103.023 166.396 118.52 166.396 118.52Z" fill="#263238"/>
                                    <path d="M212.493 131.24C211.966 131.031 211.399 130.817 210.846 130.944C210.337 131.061 209.934 131.449 209.612 131.861C208.093 133.805 207.899 136.686 209.143 138.817C210.387 140.947 212.992 142.193 215.431 141.826C217.872 141.459 220.564 139.635 221.374 134.998C218.595 133.896 215.273 132.341 212.493 131.24Z" fill="#6F4439"/>
                                    <path d="M215.458 141.997C215.473 141.822 213.808 142.201 211.696 140.984C210.674 140.388 209.606 139.346 209.109 137.877C208.601 136.428 208.666 134.578 209.521 133.019C209.957 132.265 210.544 131.504 211.179 131.516C211.849 131.501 212.711 131.978 213.466 132.258C214.922 132.838 216.287 133.381 217.552 133.884C219.887 134.784 221.354 135.284 221.4 135.17C221.446 135.055 220.061 134.347 217.785 133.296C216.543 132.738 215.201 132.136 213.771 131.492C212.99 131.205 212.311 130.691 211.151 130.641C210.558 130.644 210.007 130.977 209.647 131.349C209.273 131.727 208.999 132.141 208.737 132.588C207.747 134.402 207.708 136.508 208.334 138.157C208.955 139.839 210.231 140.962 211.392 141.539C213.812 142.718 215.53 142.052 215.458 141.997Z" fill="#263238"/>
                                    <g opacity="0.3">
                                    <path d="M198.015 126.132C202.11 126.132 205.429 124.473 205.429 122.426C205.429 120.379 202.11 118.72 198.015 118.72C193.921 118.72 190.602 120.379 190.602 122.426C190.602 124.473 193.921 126.132 198.015 126.132Z" fill="#6F4439"/>
                                    </g>
                                    <g opacity="0.3">
                                    <path d="M249.809 119.731C249.809 121.778 247.164 123.437 243.901 123.437C240.638 123.437 237.993 121.778 237.993 119.731C237.993 117.684 240.638 116.024 243.901 116.024C247.164 116.024 249.809 117.684 249.809 119.731Z" fill="#6F4439"/>
                                    </g>
                                    <path d="M155.213 137.906C155.204 137.922 154.951 137.783 154.473 137.505C154.223 137.357 153.931 137.184 153.592 136.984C153.417 136.879 153.23 136.766 153.032 136.647C152.843 136.508 152.644 136.36 152.435 136.204C150.692 135.028 148.407 132.946 146.155 129.925C143.886 126.912 141.865 122.837 140.401 118.08C139.718 115.687 139.13 113.134 138.788 110.445C138.454 107.757 138.31 104.948 138.409 102.077C138.824 90.5846 141.988 80.4155 145.638 73.8498C147.431 70.5435 149.209 68.0582 150.551 66.4449C151.194 65.6142 151.781 65.0421 152.142 64.6258C152.516 64.2191 152.718 64.0115 152.731 64.024C152.743 64.0355 152.566 64.2663 152.217 64.6931C151.881 65.1306 151.32 65.7209 150.704 66.567C149.414 68.211 147.692 70.7127 145.951 74.0171C142.406 80.5809 139.322 90.6807 138.909 102.098C138.811 104.942 138.951 107.721 139.274 110.384C139.606 113.049 140.179 115.578 140.843 117.951C142.27 122.667 144.234 126.713 146.442 129.719C148.632 132.734 150.855 134.834 152.55 136.049C152.754 136.211 152.947 136.363 153.13 136.508C153.322 136.633 153.504 136.75 153.674 136.86C154.001 137.075 154.283 137.261 154.525 137.42C154.984 137.723 155.222 137.891 155.213 137.906Z" fill="#1A213B"/>
                                    <path d="M383.045 195.79L30.1138 260.227L53.7318 389.586L406.663 325.15L383.045 195.79Z" fill="#1A213B"/>
                                    <path d="M383.045 189.617L30.1143 254.054L53.7321 383.413L406.663 318.976L383.045 189.617Z" fill="white"/>
                                    <path d="M383.068 189.61C383.306 190.901 392.029 238.323 406.858 318.944L406.889 319.111L406.721 319.142C319.69 335.054 193.704 358.09 53.8167 383.666L53.7936 383.67L53.5475 383.715L53.5023 383.469C45.2647 338.342 37.2925 294.664 29.8885 254.103L29.8452 253.866L30.0827 253.823C234.051 216.718 380.809 190.021 383.068 189.61C380.811 190.024 234.088 216.919 30.1683 254.298L30.3625 254.017C37.7723 294.576 45.7503 338.252 53.9946 383.379L53.7032 383.178L53.7263 383.174C193.625 357.66 319.622 334.681 406.661 318.807L406.524 319.005C391.903 238.347 383.303 190.901 383.068 189.61Z" fill="#263238"/>
                                    <path d="M64.8828 286.585L93.7644 281.012L95.4036 289.506L85.6354 291.391L95.4699 342.357L86.1257 344.16L76.2912 293.194L66.5221 295.079L64.8828 286.585Z" fill="#1A213B"/>
                                    <path d="M118.657 337.881L109.313 339.684L97.8384 280.224L107.183 278.421L112.1 303.904L122.717 301.855L117.8 276.372L127.314 274.536L138.789 333.996L129.274 335.832L124.357 310.349L113.739 312.398L118.657 337.881Z" fill="#1A213B"/>
                                    <path d="M175.824 326.85L166.395 328.67L162.699 318.193L151.232 320.407L151.699 331.506L143.121 333.162L141.16 271.867L154.837 269.228L175.824 326.85ZM150.864 312.108L159.868 310.37L149.563 281.169L150.864 312.108Z" fill="#1A213B"/>
                                    <path d="M180.169 281.343L188.48 324.408L180.07 326.031L168.596 266.571L180.318 264.309L196.784 298.047L189.916 262.456L198.24 260.85L209.714 320.31L200.115 322.162L180.169 281.343Z" fill="#1A213B"/>
                                    <path d="M224.084 292.956L222.244 298.949L225.769 317.212L216.424 319.015L204.951 259.555L214.295 257.752L219.294 283.659L226.526 255.392L235.87 253.588L227.989 282.597L247.345 313.048L237.747 314.901L224.084 292.956Z" fill="#1A213B"/>
                                    <path d="M269.703 288.293L250.224 250.819L259.992 248.934L272.356 274.653L274.262 246.18L283.181 244.459L279.045 286.491L282.849 306.198L273.504 308L269.703 288.293Z" fill="#1A213B"/>
                                    <path d="M287.635 258.4C285.798 248.886 289.761 242.482 298.935 240.712C308.109 238.942 314.17 243.412 316.007 252.924L321.972 283.844C323.809 293.358 319.846 299.763 310.673 301.532C301.498 303.303 295.437 298.833 293.601 289.319L287.635 258.4ZM303.06 288.111C303.879 292.359 306.06 293.612 309.033 293.038C312.006 292.464 313.564 290.49 312.744 286.243L306.547 254.134C305.727 249.887 303.548 248.633 300.575 249.207C297.601 249.781 296.044 251.755 296.865 256.002L303.06 288.111Z" fill="#1A213B"/>
                                    <path d="M328.202 235.77L337.054 281.638C337.874 285.887 340.037 287.055 343.009 286.481C345.982 285.907 347.555 284.019 346.736 279.77L337.884 233.902L346.719 232.197L355.455 277.472C357.291 286.986 353.584 293.34 344.41 295.11C335.236 296.881 329.43 292.362 327.595 282.849L318.857 237.574L328.202 235.77Z" fill="#1A213B"/>
                                    <path d="M363.212 277.031L357.875 255.771L353.089 230.968L362.434 229.164L367.221 253.967L370.178 275.688L363.212 277.031ZM372.001 279.653L373.738 288.657L364.734 290.395L362.997 281.391L372.001 279.653Z" fill="#1A213B"/>
                                    <path d="M58.0575 310.622C57.9729 309.243 56.9894 308.027 55.7635 307.39C54.5377 306.752 53.1052 306.622 51.7265 306.714C53.2955 306.3 54.1214 304.35 53.6378 302.801C53.1542 301.252 51.6659 300.171 50.0901 299.785C48.5133 299.398 46.8539 299.603 45.2637 299.925C43.6735 300.248 40.6863 300.835 39.0653 300.921L29.0298 303.425C24.6976 305.743 27.7732 311.262 30.697 311.564C29.4423 312.486 28.5703 312.577 27.9982 314.025C27.4262 315.473 27.454 317.207 28.3107 318.506C29.1673 319.806 30.9267 320.521 32.3776 319.958C30.8335 321.793 30.6076 324.624 31.842 326.681C32.5843 327.918 33.8236 328.821 35.1984 329.234C35.8906 329.443 36.6069 329.518 37.327 329.472C37.5837 329.456 37.8962 329.468 38.1356 329.359C38.2539 329.306 38.3442 329.222 38.4327 329.13C38.8365 328.709 39.1595 328.226 39.596 327.828C39.7604 327.678 39.9306 327.535 40.1056 327.397C40.9026 326.772 41.7996 326.283 42.7361 325.902C43.1658 325.727 43.6754 325.633 44.0734 325.395C44.3426 325.234 44.5157 324.961 44.7503 324.759C46.2463 323.472 48.3518 322.967 50.1987 322.427C52.2831 321.817 54.4627 321.076 55.8703 319.422C57.2788 317.768 57.5018 314.921 55.7712 313.608C57.1432 313.444 58.1421 312.002 58.0575 310.622Z" fill="#AE7461"/>
                                    <path d="M37.8808 335.217C38.2519 336.505 38.9682 337.804 40.194 338.342C41.6477 338.98 43.9455 338.454 45.4127 337.847C45.1685 335.975 44.9368 335.041 44.6926 333.169C44.6416 332.774 44.4455 332.494 44.5637 332.114C44.8753 331.112 46.8635 330.607 47.699 329.971C49.1469 328.868 49.2604 326.514 48.1288 325.088C46.9971 323.662 44.9291 323.182 43.1745 323.666C41.4198 324.149 39.9787 325.463 39.0182 327.009C37.5174 329.426 37.0934 332.484 37.8808 335.217Z" fill="#AE7461"/>
                                    <path d="M31.8586 320.101C31.7673 319.765 37.0455 318.039 43.6448 316.247C50.247 314.454 55.6714 313.272 55.7628 313.609C55.8541 313.945 50.5768 315.669 43.9746 317.462C37.3753 319.256 31.9499 320.437 31.8586 320.101Z" fill="#6F4439"/>
                                    <path d="M30.325 311.631C30.2067 311.32 34.8706 309.317 40.9469 307.902C47.0203 306.468 52.0871 306.189 52.1198 306.52C52.163 306.881 47.226 307.713 41.2344 309.129C35.2408 310.524 30.4471 311.973 30.325 311.631Z" fill="#6F4439"/>
                                    <path d="M37.8729 332.405C37.7335 332.462 37.2643 331.668 37.423 330.266C37.5499 328.889 38.5084 327.048 40.1544 325.783C41.8206 324.521 43.3666 323.781 44.7453 323.389C46.2538 323.055 47.0248 323.976 46.8441 324.063C46.7412 324.199 46.049 323.791 44.9962 324.243C43.9886 324.731 42.3715 325.661 40.9447 326.764C39.4881 327.896 38.6267 329.307 38.296 330.444C37.9498 331.574 38.0614 332.362 37.8729 332.405Z" fill="#6F4439"/>
                                    <path d="M375.98 250.574C375.508 249.276 375.927 247.768 376.798 246.695C377.668 245.622 378.93 244.931 380.231 244.468C378.627 244.714 377.093 243.252 376.919 241.639C376.745 240.026 377.68 238.442 378.972 237.46C380.264 236.478 381.867 236.004 383.455 235.667C385.042 235.329 388.016 234.677 389.537 234.111L399.74 232.409C404.636 232.809 404.014 239.098 401.453 240.539C402.971 240.885 403.806 240.621 404.908 241.721C406.01 242.821 406.675 244.422 406.406 245.956C406.138 247.489 404.809 248.847 403.254 248.907C405.401 249.976 406.736 252.483 406.423 254.861C406.235 256.291 405.458 257.613 404.362 258.54C403.81 259.007 403.183 259.361 402.505 259.606C402.262 259.694 401.982 259.829 401.718 259.825C401.588 259.824 401.472 259.782 401.354 259.733C400.815 259.508 400.327 259.194 399.768 259.002C399.558 258.929 399.345 258.865 399.13 258.809C398.15 258.553 397.132 258.462 396.122 258.486C395.657 258.497 395.153 258.613 394.693 258.554C394.381 258.513 394.115 258.332 393.818 258.24C391.934 257.655 389.801 258.03 387.892 258.271C385.737 258.542 383.442 258.729 381.492 257.774C379.543 256.818 378.203 254.294 379.268 252.401C377.944 252.798 376.453 251.872 375.98 250.574Z" fill="#AE7461"/>
                                    <path d="M404.284 265.098C404.456 266.427 404.318 267.904 403.407 268.886C402.329 270.051 400.011 270.483 398.423 270.51C397.901 268.696 397.743 267.747 397.221 265.932C397.111 265.549 397.178 265.214 396.919 264.914C396.233 264.118 394.209 264.447 393.189 264.197C391.422 263.763 390.38 261.649 390.849 259.889C391.319 258.131 393.025 256.866 394.828 256.612C396.629 256.356 398.474 256.987 399.971 258.023C402.311 259.641 403.918 262.277 404.284 265.098Z" fill="#AE7461"/>
                                    <path d="M403.787 248.834C403.737 248.49 398.209 249.009 391.441 249.994C384.671 250.979 379.225 252.057 379.275 252.401C379.325 252.745 384.853 252.226 391.623 251.24C398.39 250.256 403.837 249.178 403.787 248.834Z" fill="#6F4439"/>
                                    <path d="M401.82 240.455C401.805 240.122 396.729 240.143 390.592 241.265C384.45 242.369 379.692 244.131 379.794 244.449C379.897 244.797 384.757 243.594 390.817 242.506C396.871 241.397 401.844 240.816 401.82 240.455Z" fill="#6F4439"/>
                                    <path d="M403.171 262.516C403.321 262.512 403.435 261.598 402.732 260.375C402.067 259.162 400.454 257.856 398.441 257.35C396.41 256.857 394.697 256.794 393.277 256.983C391.761 257.278 391.419 258.43 391.62 258.438C391.769 258.522 392.241 257.871 393.386 257.866C394.505 257.914 396.358 258.121 398.107 258.564C399.894 259.023 401.246 259.974 402.003 260.885C402.77 261.783 402.982 262.552 403.171 262.516Z" fill="#6F4439"/>
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
