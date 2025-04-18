@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme21">
@else
<div class="{{ $business->theme_color }}" id="view_theme21">
@endif
        <main id="boxes">
            <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
                <div class="food-chef-card">
                    <section class="profile-sec pb">
                        <div class="profile-banner">
                               <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme21/images/profile-banner.png') }}" alt="profile-banner" id="banner_preview" loading="lazy">
                               <div class="profile-name">
                               <span id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                               </div>
                        </div>
                        <div class="client-info-wrp">
                            <div class="container">
                                <div class="client-info-content d-flex align-items-center">
                                <div class="client-image">
                                    <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme21/images/client-image.png') }}"   alt="client-image" loading="lazy">
                                </div>
                                <div class="client-info text-center">
                                        <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                                        <span id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</span>
                                </div>
                                </div>
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
                                    <div class="arrow-wrapper">
                                        <div class="slick-prev slick-arrow service-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                               <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                               </svg>
                                        </div>
                                        <div class="slick-next slick-arrow service-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                               <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                               </svg>
                                        </div>
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
                                    <div class="arrow-wrapper">
                                        <div class="slick-prev slick-arrow gallery-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                               <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                               </svg>
                                        </div>
                                        <div class="slick-next slick-arrow gallery-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                               <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                               </svg>
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
                                                                    <img src="{{ asset('custom/theme21/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                                        <img src="{{ asset('custom/theme21/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                                    </div>
                                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                                @else
                                                                    <div class="contact-image">
                                                                        <img src="{{ asset('custom/theme21/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                    <div class="arrow-wrapper">
                                        <div class="slick-prev slick-arrow product-sec-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                                <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                                </svg>
                                        </div>
                                        <div class="slick-next slick-arrow product-sec-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                                <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                                </svg>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'more')
                            <section class="more-info-sec">
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{__('More')}}</h2>
                                    </div>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="{{ route('bussiness.save', $business->slug) }}"
                                                class="save-info d-flex align-items-center justify-content-center">
                                                <svg width="28" height="24" viewBox="0 0 28 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.7867 0.318213C5.92135 0.0780268 7.2727 0 8.83546 0H11.0998C12.5039 0 13.8151 0.6684 14.5939 1.7812L15.7312 3.40627C15.9909 3.77717 16.4279 4 16.896 4H23.9725C26.2086 4 28.0211 5.68153 27.9998 7.84693C27.9743 10.4256 27.9958 13.0052 27.9958 15.584C27.9958 17.0725 27.9139 18.3597 27.6616 19.4405C27.406 20.5365 26.957 21.5001 26.1641 22.2553C25.3713 23.0105 24.3597 23.4383 23.209 23.6817C22.0744 23.922 20.723 24 19.1603 24H8.83546C7.2727 24 5.92135 23.922 4.7867 23.6817C3.63615 23.4383 2.62443 23.0105 1.83159 22.2553C1.03877 21.5001 0.589773 20.5365 0.334074 19.4405C0.0819157 18.3597 0 17.0725 0 15.584V8.416C0 6.92743 0.0819157 5.64024 0.334074 4.55945C0.589773 3.46352 1.03877 2.49984 1.83159 1.74464C2.62443 0.989453 3.63615 0.561773 4.7867 0.318213ZM15.3977 10.6667C15.3977 9.93027 14.771 9.33333 13.9979 9.33333C13.2248 9.33333 12.5981 9.93027 12.5981 10.6667V14.7811L11.4882 13.7239C10.9416 13.2032 10.0553 13.2032 9.50861 13.7239C8.96196 14.2445 8.96196 15.0888 9.50861 15.6095L12.9206 18.8595C12.9356 18.8737 12.9508 18.8877 12.9664 18.9013C13.2223 19.1668 13.5896 19.3333 13.9979 19.3333C14.4062 19.3333 14.7735 19.1668 15.0294 18.9013C15.0449 18.8877 15.0602 18.8737 15.0752 18.8595L18.4871 15.6095C19.0338 15.0888 19.0338 14.2445 18.4871 13.7239C17.9405 13.2032 17.0542 13.2032 16.5076 13.7239L15.3977 14.7811V10.6667Z"
                                                        fill="white" />
                                                </svg>
                                            </a>
                                            <span>{{__('Save')}}</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="share-info d-flex align-items-center justify-content-center">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.68161 14.3394L13.9018 9.11828C14.2464 8.77363 14.8067 8.77363 15.1514 9.11828C15.496 9.46382 15.496 10.0232 15.1514 10.3688L9.9312 15.589L14.0291 23.3295C14.3596 23.9543 15.0321 24.322 15.7364 24.2636C16.4416 24.2053 17.0443 23.7325 17.2679 23.0609C18.8233 18.3957 22.7241 6.69245 24.1796 2.32683C24.3908 1.69143 24.2255 0.99152 23.7527 0.517842C23.279 0.0441633 22.5791 -0.121095 21.9437 0.0909994L1.20881 7.00264C0.538056 7.22622 0.0652546 7.82805 0.00604476 8.53327C-0.0522813 9.23848 0.315362 9.91012 0.941042 10.2415L8.68161 14.3394Z"
                                                        fill="white" />
                                                </svg>
                                            </a>
                                            <span>{{__('Share')}}</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="contact-info d-flex align-items-center justify-content-center">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.5133 10.3607C18.6413 10.3608 18.768 10.3356 18.8862 10.2866C19.0044 10.2377 19.1118 10.1659 19.2023 10.0755C19.2928 9.98498 19.3645 9.87756 19.4135 9.75935C19.4624 9.64113 19.4876 9.51443 19.4876 9.38648V1.59242C19.4876 1.33403 19.3849 1.08623 19.2022 0.903517C19.0195 0.720809 18.7717 0.618164 18.5133 0.618164C18.2549 0.618164 18.0071 0.720809 17.8244 0.903517C17.6417 1.08623 17.5391 1.33403 17.5391 1.59242V9.38648C17.539 9.51443 17.5642 9.64113 17.6132 9.75935C17.6621 9.87756 17.7339 9.98498 17.8243 10.0755C17.9148 10.1659 18.0222 10.2377 18.1404 10.2866C18.2587 10.3356 18.3854 10.3608 18.5133 10.3607Z"
                                                        fill="white" />
                                                    <path
                                                        d="M14.6149 8.41195C14.7428 8.41198 14.8695 8.3868 14.9878 8.33785C15.106 8.28891 15.2134 8.21714 15.3039 8.12667C15.3943 8.03619 15.4661 7.92878 15.515 7.81056C15.564 7.69235 15.5892 7.56564 15.5891 7.43769V3.54066C15.5891 3.28227 15.4865 3.03447 15.3038 2.85176C15.1211 2.66905 14.8733 2.56641 14.6149 2.56641C14.3565 2.56641 14.1087 2.66905 13.926 2.85176C13.7433 3.03447 13.6406 3.28227 13.6406 3.54066V7.43769C13.6406 7.56564 13.6658 7.69235 13.7147 7.81056C13.7637 7.92878 13.8354 8.03619 13.9259 8.12667C14.0164 8.21714 14.1238 8.28891 14.242 8.33785C14.3602 8.3868 14.4869 8.41198 14.6149 8.41195Z"
                                                        fill="white" />
                                                    <path
                                                        d="M22.4079 7.43804C22.5358 7.43808 22.6625 7.4129 22.7807 7.36395C22.8989 7.315 23.0064 7.24324 23.0968 7.15276C23.1873 7.06229 23.2591 6.95487 23.308 6.83666C23.357 6.71844 23.3821 6.59174 23.3821 6.46379V4.51527C23.3821 4.25688 23.2795 4.00908 23.0968 3.82637C22.914 3.64366 22.6662 3.54102 22.4079 3.54102C22.1495 3.54102 21.9017 3.64366 21.7189 3.82637C21.5362 4.00908 21.4336 4.25688 21.4336 4.51527V6.46379C21.4336 6.59174 21.4587 6.71844 21.5077 6.83666C21.5566 6.95487 21.6284 7.06229 21.7189 7.15276C21.8093 7.24324 21.9168 7.315 22.035 7.36395C22.1532 7.4129 22.2799 7.43808 22.4079 7.43804Z"
                                                        fill="white" />
                                                    <path
                                                        d="M23.7146 18.7675L19.7595 14.8124C19.6224 14.6754 19.4477 14.5823 19.2575 14.5451C19.0673 14.508 18.8703 14.5283 18.6918 14.6037L14.5282 16.3608L7.63915 9.47182L9.39626 5.30827C9.47162 5.12971 9.49201 4.93274 9.45484 4.74253C9.41766 4.55232 9.32459 4.37752 9.18754 4.24048L5.23242 0.285371C5.14195 0.194898 5.03455 0.12313 4.91634 0.0741659C4.79813 0.0252018 4.67144 0 4.5435 0C4.41555 0 4.28886 0.0252018 4.17065 0.0741659C4.05245 0.12313 3.94504 0.194898 3.85457 0.285371L1.15366 2.98631C-1.93852 6.07856 1.58733 11.6658 6.96079 17.0392C12.3342 22.4127 17.9215 25.9385 21.0138 22.8463L23.7147 20.1454C23.8974 19.9627 24 19.7148 24 19.4564C24 19.1981 23.8973 18.9502 23.7146 18.7675Z"
                                                        fill="white" />
                                                </svg>
                                            </a>
                                            <span>{{__('Contact')}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'testimonials')
                            <section class="testimonial-sec pt pb" id="testimonials-div">
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{ __('Testimonials') }}</h2>
                                    </div>
                                    <div class="slider-wrapper">
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
                                                            <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                                {{ $testi_content->description }} </p>
                                                        </div>
                                                        <div
                                                            class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="rating d-flex align-items-center">
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
                                                            <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                                {{ $testi_content->description }} </p>
                                                        </div>
                                                        <div
                                                            class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="rating d-flex align-items-center">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                                    <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                                    </svg>
                                            </div>
                                            <div class="slick-next slick-arrow testimonial-arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none">
                                                    <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/>
                                                    </svg>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
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
                                <section class="custom-text-sec pb" id="svg-div">
                                    <div class="container">
                                        <div class="thankyou-svg">
                                            @if (empty($business->svg_text))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="552" height="556" viewBox="0 0 552 556" fill="none">
                                                <path d="M301.638 545.814C301.425 534.221 300.739 513.481 298.499 501.628C298.287 500.515 298.065 499.37 297.828 498.193C299.809 498.003 301.797 497.785 303.762 497.541C304.845 505.94 306.364 513.231 308.401 517.67C312.232 526.029 314.962 535.865 316.429 544.03C311.543 544.754 306.604 545.353 301.638 545.814ZM237.48 544.323C224.922 542.557 212.631 539.934 200.681 536.524C200.497 535.794 200.315 535.226 200.141 534.876C198.989 532.577 202.298 500.334 204.246 487.62C206.229 488.282 208.235 488.924 210.242 489.533C212.285 493.036 214.799 497.632 217.499 502.764C217.521 502.817 217.521 502.817 217.521 502.817C224.604 516.295 232.964 533.46 237.48 544.323ZM378.916 526.955C379.159 520.098 379.462 513.35 379.811 508.611V508.604C380.101 504.723 380.426 502.193 380.778 502.05C380.791 502.043 380.806 502.04 380.822 502.04C381.77 502.04 382.157 514.317 382.8 525.342C381.508 525.891 380.22 526.428 378.916 526.955ZM130.742 505.325C87.4723 478.167 52.3409 439.226 29.8528 393.005L85.3352 394.506C94.7739 409.341 105.899 423.006 118.438 435.217C118.793 446.067 119.86 462.721 123.015 475.306C124.877 482.744 127.799 493.769 130.742 505.325ZM462.593 473.413C460.923 455.698 455.66 425.136 453.33 413.122C455.52 410.345 457.645 407.512 459.704 404.633L515.187 406.134C501.232 431.254 483.436 453.942 462.593 473.413ZM539.749 345.924L542.426 246.935C542.47 245.319 541.197 243.974 539.581 243.931L512.394 243.197C511.986 242.087 511.745 241.5 511.745 241.5C511.302 237.005 510.176 229.373 509.081 226.132C508.86 225.483 508.373 224.984 507.771 224.737C507.693 224.703 507.612 224.675 507.531 224.65C507.331 224.591 507.119 224.56 506.9 224.553C506.089 220.678 505.091 213.578 506.713 206.964C509.103 197.227 509.284 185.73 508.526 180.295C507.771 174.861 509 166.893 509.883 158.875C510.498 153.3 507.989 150.757 505.765 150.757C504.791 150.757 503.871 151.247 503.294 152.183C502.037 154.223 501.085 160.366 500.458 165.08V165.086L500.449 165.164L500.442 165.189C500.137 167.538 499.909 169.516 499.765 170.434C499.731 170.668 499.684 170.899 499.631 171.126C499.279 172.608 498.602 173.869 498.199 173.869C498.112 173.869 498.037 173.806 497.981 173.672L497.971 173.644C497.872 173.369 497.844 172.82 497.94 171.925C498.355 168.088 496.901 149.955 496.889 144.283C496.886 140.733 494.83 139.223 492.889 139.223C491.729 139.223 490.605 139.766 489.991 140.733C489.12 142.106 488.702 145.403 488.503 148.189C488.5 148.236 488.5 148.277 488.496 148.317L488.49 148.376C488.49 148.42 488.484 148.464 488.481 148.511L488.478 148.545C488.325 150.841 488.322 152.71 488.322 152.71L488.319 152.694C488.259 152.385 487.305 147.372 486.303 140.518C485.798 137.064 483.452 134.846 481.324 134.846C479.096 134.846 477.106 137.279 477.727 143.272C478.098 146.86 478.56 150.177 479.031 153.203L479.034 153.209L479.037 153.237C480.107 160.079 481.243 165.429 481.546 169.039C481.574 169.382 481.586 169.669 481.586 169.9C481.586 170.312 481.542 170.543 481.461 170.615C481.446 170.63 481.427 170.64 481.405 170.64C481.337 170.64 481.246 170.546 481.137 170.365C480.319 168.999 478.591 162.631 477.717 154.794C476.573 144.558 474.953 141.825 472.866 141.825C472.67 141.825 472.467 141.85 472.261 141.897C469.874 142.414 468.208 145.169 469.179 151.524C469.416 153.084 469.703 155.421 470.002 158.126C456.964 136.247 440.336 116.76 420.924 100.478C415.683 91.6767 407.387 83.7336 395.226 80.5826C394.094 80.2894 392.992 80.0304 391.922 79.8027C360.378 60.8747 323.823 49.4312 284.728 47.9337C287.024 36.9425 277.431 31.9539 277.431 31.9539C281.596 36.749 279.162 41.7158 279.162 41.7158C279.197 37.1016 270.931 29.1148 270.931 29.1148C272.614 22.5413 269.809 19.0503 269.809 19.0503C268.898 25.2119 264.764 26.6376 264.764 26.6376C266.188 23.1871 265.077 21.3589 265.077 21.3589C261.729 24.3134 256.801 25.8203 250.037 25.8203C245.896 25.8203 241.066 25.2556 235.492 24.1138C234.17 23.8423 232.888 23.7175 231.641 23.7175C219.045 23.7175 210.174 36.384 202.76 38.4743C194.612 40.7705 193.737 48.673 193.737 48.673C195.731 44.4769 200.808 43.1104 200.808 43.1104C193.996 46.9789 191.897 57.499 192.27 63.7792C127.679 89.5708 77.7896 144.336 58.675 212.015C57.6274 211.54 56.8147 211.353 56.1508 211.353C54.95 211.353 54.2368 211.962 53.5074 212.567C52.7773 213.175 52.0314 213.784 50.7638 213.784C50.424 213.784 50.0465 213.74 49.6219 213.64C48.993 213.494 48.4096 213.428 47.862 213.428C46.0731 213.428 44.6648 214.108 43.2987 214.785C41.9325 215.465 40.6081 216.142 38.9871 216.142C38.8935 216.142 38.7986 216.142 38.7031 216.136C38.632 216.133 38.5618 216.133 38.4913 216.133C34.6726 216.133 31.5734 221.121 31.5734 221.121C31.5734 221.121 30.143 226.538 30.8849 230.172L18.7465 229.845C18.7197 229.841 18.6929 229.841 18.6661 229.841C18.0449 229.841 17.4668 230.038 16.9916 230.369L16.6906 230.362C16.6634 230.359 16.6366 230.359 16.6098 230.359C15.024 230.359 13.7174 231.623 13.6743 233.22L10.7654 340.764C5.32567 319.246 2.43359 296.709 2.43359 273.503C2.43359 122.451 124.885 0.000610352 275.936 0.000610352C426.989 0.000610352 549.439 122.451 549.439 273.503C549.439 298.571 546.064 322.859 539.749 345.924Z" fill="#F2F2F2"/>
                                                <path d="M297.829 498.193C295.439 486.272 291.745 471.048 286.707 452.937C291.783 452.638 296.796 452.126 301.751 451.415C301.744 451.589 301.735 451.767 301.729 451.939C301.298 464.037 301.832 482.551 303.763 497.541C301.797 497.785 299.81 498.003 297.829 498.193ZM210.243 489.533C208.235 488.924 206.23 488.282 204.247 487.62C204.644 485.025 204.985 483.243 205.219 482.697C205.252 482.619 205.302 482.585 205.369 482.585C205.941 482.585 207.739 485.24 210.243 489.533ZM118.438 435.217C105.9 423.006 94.7747 409.341 85.336 394.506L110.196 395.177C109.926 408.049 109.83 420.026 110.953 421.43C111.344 421.917 113.967 422.865 118.27 424.079C118.269 424.191 118.223 428.637 118.438 435.217ZM453.331 413.122C453 411.422 452.728 410.096 452.535 409.228C453.58 408.91 454.095 408.514 453.995 408.027C453.889 407.484 453.808 406.265 453.752 404.471L459.704 404.633C457.645 407.512 455.521 410.345 453.331 413.122ZM482.311 242.383L481.415 242.358C478.882 237.488 476.374 232.471 474.714 228.659C470.078 218.002 449.512 193.533 449.512 193.533C449.512 193.533 449.509 193.614 449.499 193.773C449.365 193.655 449.234 193.561 449.103 193.492C447.378 192.631 443.775 192.263 439.507 192.176C440.237 190.201 441.282 188.501 442.695 187.137C443.032 186.791 443.316 186.441 443.544 186.089C444.317 185.303 444.801 184.557 444.923 183.883C449.855 156.538 426.681 140.274 428.157 128.238C428.943 121.808 426.943 110.577 420.925 100.478C440.336 116.76 456.965 136.247 470.003 158.126C470.128 159.258 470.253 160.46 470.377 161.695L470.384 161.77C470.387 161.795 470.39 161.823 470.393 161.851C470.402 161.935 470.412 162.016 470.418 162.101C471.129 169.226 471.778 177.406 471.781 181.044C471.781 181.359 471.775 181.643 471.766 181.887C471.756 182.092 471.75 182.298 471.741 182.495C471.741 182.535 471.738 182.576 471.734 182.617C471.728 182.857 471.719 183.088 471.709 183.312C471.7 183.54 471.691 183.758 471.685 183.971C471.681 184.045 471.678 184.117 471.675 184.189C471.672 184.251 471.669 184.314 471.666 184.376C471.656 184.548 471.65 184.716 471.641 184.878C471.625 185.162 471.607 185.431 471.588 185.677C471.516 186.572 471.407 187.209 471.204 187.496L471.151 187.561L471.089 187.618L471.045 187.646C471.042 187.646 471.042 187.649 471.039 187.649L470.989 187.664C470.976 187.668 470.961 187.671 470.945 187.671C470.939 187.671 470.933 187.671 470.926 187.671C470.867 187.671 470.802 187.655 470.73 187.618C470.705 187.602 470.677 187.586 470.649 187.568C470.636 187.561 470.624 187.552 470.614 187.543C470.561 187.505 470.505 187.459 470.449 187.402L470.421 187.374L470.396 187.349L470.377 187.331L470.371 187.324H470.374C470.168 187.106 469.928 186.785 469.654 186.348C469.217 185.661 468.452 184.635 467.495 183.45C467.557 183.434 467.622 183.418 467.691 183.403C467.691 183.403 467.61 183.406 467.473 183.425C464.047 179.188 458.169 172.926 455.979 172.711C455.767 172.689 455.558 172.68 455.352 172.68C452.803 172.68 451.013 174.486 456.625 183.45C463.832 194.952 470.387 206.851 476.071 212.514C480.885 217.309 483.477 228.247 484.161 231.489C483.727 231.66 483.353 231.81 483.053 231.935C483.009 231.95 482.975 231.969 482.938 231.997C482.804 232.06 482.676 232.147 482.57 232.25C482.17 232.606 481.958 233.142 482.03 233.701C482.554 238.015 482.488 240.489 482.311 242.383ZM71.5994 227.165C72.0324 224.038 72.0112 221.437 71.258 220.086C68.3984 214.947 67.27 216.981 60.2151 212.823C59.651 212.489 59.1403 212.224 58.6758 212.015C77.7903 144.336 127.68 89.5708 192.271 63.7791C192.332 64.8181 192.461 65.7416 192.648 66.4966C193.812 71.22 194.153 76.7857 194.216 78.0056C193.265 78.5328 192.272 79.5749 191.267 81.3438C186.412 89.8828 192.749 106.901 198.587 106.901C199.285 106.901 199.975 106.658 200.638 106.131C200.787 107.435 200.973 108.717 201.197 109.981C183.181 118.226 166.767 129.364 152.542 142.798C137.721 146.249 119.686 152.336 106.51 163.168C106.51 163.168 85.4742 193.23 81.253 205.887C79.7399 210.424 77.3742 216.426 74.965 222.263H74.9635C74.8062 222.644 74.6477 223.028 74.4896 223.408C74.4184 223.58 74.347 223.751 74.2758 223.923C74.2755 223.923 74.2752 223.92 74.2749 223.92C74.2749 223.92 72.7322 226.597 71.5994 227.165ZM339.154 105.186C319.487 97.7947 298.188 93.7545 275.937 93.7545C274.465 93.7545 272.99 93.7701 271.526 93.8075C272.575 90.9061 274.249 86.6693 276.043 83.6649C279.029 78.6732 280.436 68.2842 280.436 68.2842C280.442 68.2842 280.445 68.2842 280.448 68.2842C284.407 68.2842 285.574 77.4752 285.574 77.4752C290.85 66.9052 281.097 59.4676 281.097 59.4676C281.412 57.3679 284.888 57.1027 284.888 57.1027C284.657 56.5068 284.173 56.2979 283.599 56.2979C282.202 56.2979 280.277 57.5583 280.277 57.5583C282.779 53.9455 284.142 50.7446 284.729 47.9336C323.823 49.4311 360.378 60.8746 391.923 79.8026C387.434 78.8448 383.484 78.4455 380.018 78.4455C365.261 78.4455 359.215 85.696 357.146 88.0951C352.273 88.1013 344.255 94.9743 339.154 105.186Z" fill="#F2F2F2"/>
                                                <path d="M286.704 452.938C284.598 445.369 282.258 437.295 279.681 428.749C280.948 427.595 280.449 426.7 280.449 426.088C280.449 424.925 276.839 411.643 274.595 399.626L301.052 400.34C299.598 405.519 298.756 410.848 299.866 412.845C301.885 416.473 302.849 415.724 306.796 417.649C304.537 428.522 302.159 441.85 301.748 451.415C296.793 452.126 291.78 452.638 286.704 452.938ZM319.103 211.076C314.211 203.049 301.423 183.384 286.857 171.551C271.011 158.675 258.955 152.536 255.696 150.985C255.549 150.916 255.393 150.882 255.24 150.882C254.885 150.882 254.542 151.063 254.342 151.381C254.332 151.397 254.323 151.412 254.313 151.428C250.628 149.4 250.349 146.598 250.338 146.467C250.338 146.464 250.338 146.464 250.338 146.461C250.334 144.758 250.379 143.479 250.361 141.544C250.357 140.986 250.349 140.378 250.334 139.685C250.323 139.167 250.319 138.518 250.319 137.888C250.319 136.637 250.334 135.445 250.334 135.405C259.55 127.636 267.229 114.633 269.952 98.912C270.089 98.1227 270.232 97.3333 270.378 96.5534C270.392 96.8841 270.406 97.0681 270.406 97.0681C270.406 97.0681 270.827 95.7297 271.523 93.8079C272.987 93.7705 274.462 93.7549 275.934 93.7549C298.185 93.7549 319.484 97.795 339.151 105.186C336.83 109.828 335.114 115.16 334.571 120.851C334.191 124.831 334.365 128.291 334.905 131.277C337.014 145.962 339.984 153.425 336.527 163.396C332.855 173.978 326.51 189.34 337.551 200.862C338.406 201.754 339.276 202.593 340.156 203.379C339.99 203.364 339.822 203.358 339.654 203.358C339.017 203.358 338.378 203.454 337.76 203.645C335.925 204.215 333.286 205.27 331.292 207.042C329.561 208.583 324.532 209.875 319.103 211.076ZM152.539 142.799C166.764 129.365 183.178 118.227 201.194 109.981C201.242 110.253 201.292 110.521 201.343 110.792C199.978 118.274 198.059 127.851 196.545 131.773C196.543 131.776 196.542 131.776 196.54 131.779C194.659 134.746 188.803 136.98 184.585 138.259C182.945 138.465 181.816 138.487 181.816 138.487C181.715 138.687 181.624 138.893 181.545 139.102C180.567 139.351 179.965 139.479 179.965 139.479V139.485C179.423 138.871 178.644 138.518 177.831 138.518C177.712 138.518 177.593 138.527 177.473 138.543C173.622 139.03 164.049 140.119 152.539 142.799Z" fill="#F2F2F2"/>
                                                <path d="M179.965 139.478C179.965 139.478 193.486 136.596 196.54 131.779C199.594 126.962 250.337 146.461 250.337 146.461C250.337 146.461 250.538 149.35 254.314 151.43C258.089 153.508 244.934 175.709 244.934 175.709L180.683 167.841L179.965 139.478Z" fill="#FABE93"/>
                                                <path d="M245.662 157.021C245.453 158.066 249.476 161.807 249.383 162.827L248.313 171.35L236.647 172.941L201.573 169.628C201.573 169.628 176.486 149.118 181.818 138.486C181.818 138.486 194.027 138.28 196.543 131.782C199.191 124.937 203.08 100.761 203.08 100.761L250.336 135.404C250.336 135.404 250.303 138.118 250.336 139.684C250.351 140.377 250.359 140.985 250.362 141.543C250.381 143.478 250.336 144.757 250.34 146.46C250.34 146.697 245.707 156.787 245.662 157.021Z" fill="#FABE93"/>
                                                <path d="M269.955 98.9116C265.118 126.837 244.653 146.18 227.694 142.857C208.355 139.07 196.456 114.13 201.293 86.2045C206.131 58.2789 213.155 35.3919 245.211 41.7282C286.161 49.8211 274.792 70.986 269.955 98.9116Z" fill="#FABE93"/>
                                                <path d="M233.503 145.881C210.696 145.881 203.38 118.788 203.145 117.809C205.813 125.973 210.195 132.753 215.843 137.27C217.249 138.421 218.68 139.364 220.121 140.122C222.485 141.407 225.018 142.334 227.692 142.858C228.965 143.107 230.256 143.229 231.561 143.229C237.066 143.229 242.781 141.061 248.094 137.17C248.985 136.553 249.735 135.954 250.32 135.417C250.325 135.414 250.33 135.411 250.335 135.404C250.334 135.445 250.32 136.637 250.32 137.888C250.32 138.518 250.324 139.167 250.335 139.685C250.35 140.377 250.358 140.986 250.361 141.544C250.354 141.579 250.343 141.613 250.335 141.644C243.963 144.642 238.377 145.881 233.503 145.881Z" fill="#E4AB82"/>
                                                <path d="M231.559 143.229C230.255 143.229 228.964 143.107 227.691 142.857C225.017 142.333 222.484 141.407 220.12 140.121C223.741 142.027 227.426 142.77 230.939 142.77C237.962 142.77 244.301 139.797 248.093 137.17C242.78 141.06 237.065 143.229 231.559 143.229ZM215.841 137.27C210.194 132.752 205.812 125.973 203.143 117.808C203.143 117.802 203.142 117.799 203.141 117.796C206.739 127.264 211.154 133.432 215.841 137.27ZM250.319 135.416C250.324 135.413 250.329 135.407 250.334 135.404C250.329 135.41 250.324 135.413 250.319 135.416Z" fill="#E4AB82"/>
                                                <path d="M215.052 80.6638C215.126 80.6014 215.202 80.5453 215.277 80.4922C219.446 77.4816 223.915 76.7671 228.176 78.508C228.545 78.6577 228.932 78.845 229.206 79.4159C229.726 80.5016 229.696 81.6653 229.485 83.3281C224.634 80.3144 219.434 79.9805 214.354 82.3859C214.252 81.8088 214.308 81.7745 214.521 81.3377C214.674 81.0195 214.86 80.8198 215.052 80.6638Z" fill="#1B1817"/>
                                                <path d="M263.528 86.569C263.468 86.4942 263.407 86.4224 263.345 86.3538C259.923 82.5164 255.713 80.8535 251.177 81.6366C250.784 81.7021 250.366 81.802 249.975 82.3011C249.233 83.2496 249.012 84.3914 248.859 86.0605C254.247 84.1637 259.396 84.9592 263.837 88.4004C264.061 87.8607 264.015 87.817 263.901 87.3428C263.82 86.9996 263.681 86.7656 263.528 86.569Z" fill="#1B1817"/>
                                                <path d="M225.56 88.9051C225.184 91.2824 223.283 92.9577 221.314 92.6489C219.344 92.3369 218.052 90.1561 218.428 87.7757C218.804 85.3984 220.706 83.7199 222.675 84.0319C224.644 84.3439 225.936 86.5246 225.56 88.9051Z" fill="#1B1817"/>
                                                <path d="M258.998 93.043C258.622 95.4235 256.721 97.0988 254.751 96.7868C252.782 96.4749 251.49 94.2941 251.866 91.9168C252.242 89.5363 254.143 87.861 256.113 88.173C258.082 88.485 259.374 90.6657 258.998 93.043Z" fill="#1B1817"/>
                                                <path d="M235.389 112.633C235.146 112.633 234.905 112.614 234.672 112.577C233.182 112.327 233.108 111.7 233.344 111.188C233.552 110.733 233.976 110.412 234.456 110.268L235.986 109.816C236.857 109.56 237.391 108.702 237.271 107.8C236.745 103.854 237.81 93.527 238.853 91.4929C239.226 90.766 239.506 90.5101 239.715 90.5101C240.013 90.5101 240.167 91.028 240.242 91.4367C240.295 91.7269 240.273 92.0201 240.188 92.3009C238.282 98.6154 239.648 105.488 240.302 108.093C240.911 110.524 237.968 112.633 235.389 112.633Z" fill="#E8AE86"/>
                                                <path d="M201.785 83.421C201.785 83.421 196.701 71.781 191.265 81.3432C185.829 90.9024 194.422 111.091 200.637 106.127C206.853 101.167 201.785 83.421 201.785 83.421Z" fill="#FABE93"/>
                                                <path d="M197.772 99.7539C197.669 99.7539 197.564 99.7352 197.461 99.6946L197.447 99.6884C196.932 99.4763 196.66 98.818 196.836 98.2158C197.268 96.7526 197.437 95.3799 197.438 94.1258C196.651 93.4176 195.227 93.2584 194.628 93.2584C194.594 93.2584 194.563 93.2584 194.534 93.2616C194.524 93.2616 194.513 93.2616 194.503 93.2616C194.395 93.2616 194.291 93.2397 194.194 93.2023C193.812 93.0556 193.531 92.6376 193.516 92.1415C193.498 91.502 193.923 90.9716 194.467 90.9529C194.496 90.9529 194.545 90.9497 194.612 90.9497C195.023 90.9497 196.092 90.9965 197.171 91.4177C196.568 88.3852 195.149 86.5321 195.126 86.5009C194.757 86.0298 194.782 85.2998 195.181 84.8692C195.369 84.6664 195.606 84.5666 195.844 84.5666C196.111 84.5666 196.377 84.6945 196.572 84.9441C196.758 85.1812 201.094 90.8406 198.698 98.9802C198.558 99.4544 198.178 99.7539 197.772 99.7539Z" fill="#E8AE86"/>
                                                <path d="M245.377 70.0625C237.799 70.0625 231.527 68.7709 231.527 68.7709C234.126 69.061 236.63 69.1827 239.016 69.1827C253.298 69.1827 263.285 64.7495 263.285 64.7495C263.643 65.0927 263.986 65.4358 264.315 65.7821C259.048 69.1484 251.75 70.0625 245.377 70.0625Z" fill="#E8AE86"/>
                                                <path d="M263.285 64.7481C263.285 64.7481 249.686 70.7881 231.528 68.7695C231.528 68.7695 238.189 63.8433 240.838 62.9667C240.838 62.9667 233.307 63.6624 228.206 67.0443C228.206 67.0443 228.449 64.642 231.596 62.7171C231.596 62.7171 217.211 65.4095 212.285 72.4416C212.285 72.4416 211.921 69.041 213.766 65.5374C213.766 65.5374 203.612 76.5067 203.531 92.8141C203.531 92.8141 203.021 77.3896 194.225 78.2476C194.225 78.2476 193.961 71.8364 192.645 66.4952C191.33 61.1572 192.867 47.6171 200.806 43.109C200.806 43.109 195.729 44.4755 193.735 48.6716C193.735 48.6716 194.61 40.7691 202.758 38.4729C210.906 36.1736 220.811 21.108 235.49 24.1124C250.169 27.1168 259.678 26.1215 265.075 21.3575C265.075 21.3575 266.186 23.1857 264.762 26.6363C264.762 26.6363 268.896 25.2105 269.807 19.0489C269.807 19.0489 272.612 22.5399 270.929 29.1134C270.929 29.1134 279.195 37.1002 279.16 41.7144C279.16 41.7144 281.594 36.7476 277.429 31.9525C277.429 31.9525 292.554 39.8207 280.274 57.5569C280.274 57.5569 284.093 55.0517 284.885 57.1014C284.885 57.1014 281.41 57.3666 281.095 59.4662C281.095 59.4662 290.847 66.9039 285.572 77.4739C285.572 77.4739 284.402 68.2673 280.433 68.2829C280.433 68.2829 279.026 78.6719 276.04 83.6636C273.056 88.6585 270.406 97.0664 270.406 97.0664C270.406 97.0664 270.051 92.3804 271.117 87.4074C272.184 82.4375 272.015 73.1217 263.285 64.7481Z" fill="#1B1817"/>
                                                <path d="M215.738 63.4375C215.719 63.4375 215.7 63.4312 215.685 63.4156C215.654 63.3875 215.652 63.3376 215.681 63.3064C215.683 63.3033 218.935 59.7654 223.95 56.2275C228.965 52.6896 235.744 49.1455 242.806 49.1455C243.845 49.1455 244.889 49.2235 245.934 49.3889C247.63 49.6541 249.204 49.7727 250.661 49.7727C261.521 49.7727 265.962 43.196 266.472 42.3849C266.505 42.3287 266.521 42.3007 266.521 42.3007C266.536 42.2757 266.562 42.2632 266.589 42.2632C266.602 42.2632 266.616 42.2663 266.628 42.2726C266.665 42.2944 266.678 42.3412 266.656 42.3787C266.651 42.3911 262.319 49.9286 250.661 49.9286C249.195 49.9286 247.614 49.8101 245.91 49.5418C244.873 49.3795 243.837 49.3015 242.806 49.3015C242.803 49.3015 242.801 49.3015 242.798 49.3015C229.658 49.3015 217.416 61.706 215.944 63.2534C215.846 63.3564 215.796 63.4125 215.795 63.4125H215.796C215.78 63.4281 215.759 63.4375 215.738 63.4375Z" fill="#413E3E"/>
                                                <path d="M235.086 61.5234C235.06 61.5234 235.034 61.5078 235.02 61.486C234.997 61.4485 235.008 61.4017 235.045 61.3768C235.047 61.3768 237.473 59.8762 240.817 58.3724C244.162 56.8687 248.424 55.3649 252.109 55.3649C252.683 55.3649 253.243 55.3992 253.784 55.4803C253.827 55.4865 253.856 55.524 253.85 55.5677C253.844 55.6082 253.811 55.6363 253.773 55.6363C253.769 55.6363 253.765 55.6332 253.761 55.6332C253.229 55.5552 252.677 55.5209 252.109 55.5209C252.107 55.5209 252.105 55.5209 252.103 55.5209C245.726 55.5209 237.505 60.107 235.556 61.252C235.278 61.4173 235.127 61.5109 235.127 61.5109C235.114 61.5172 235.1 61.5234 235.086 61.5234Z" fill="#413E3E"/>
                                                <path d="M243.605 62.4805H243.594C243.551 62.4805 243.516 62.443 243.516 62.4025C243.516 62.3588 243.551 62.3245 243.594 62.3245H243.605C243.848 62.3245 247.95 62.312 252.566 61.6444C257.182 60.9799 262.312 59.6477 264.595 57.0426C264.61 57.027 264.632 57.0177 264.653 57.0177C264.672 57.0177 264.69 57.0239 264.705 57.0364C264.737 57.0644 264.74 57.1144 264.712 57.1456C262.366 59.8099 257.217 61.1296 252.589 61.8004C247.96 62.468 243.853 62.4805 243.605 62.4805Z" fill="#413E3E"/>
                                                <path d="M266.351 63.2793C266.318 63.2793 266.287 63.2575 266.277 63.2232C266.264 63.1826 266.288 63.139 266.33 63.1265C266.33 63.1265 266.385 63.1108 266.49 63.0765C266.596 63.0422 266.752 62.9923 266.951 62.9205C267.35 62.7801 267.923 62.5649 268.619 62.2654C270.01 61.6663 271.894 60.7335 273.86 59.3951C277.792 56.7152 282.05 52.4223 283.37 45.9424C283.379 45.905 283.41 45.88 283.448 45.88C283.451 45.88 283.457 45.88 283.463 45.8832C283.504 45.8894 283.532 45.93 283.523 45.9736C282.191 52.5066 277.901 56.8338 273.948 59.5231C269.995 62.2155 266.378 63.2762 266.373 63.2762C266.366 63.2793 266.359 63.2793 266.351 63.2793Z" fill="#413E3E"/>
                                                <path d="M278.797 67.7187C278.788 67.7187 278.779 67.7188 278.769 67.7156C278.769 67.7156 278.735 67.7 278.654 67.6751C278.576 67.6501 278.457 67.6127 278.295 67.569C277.967 67.4816 277.471 67.3631 276.785 67.2477C275.413 67.0137 273.289 66.7766 270.285 66.7766C270.094 66.7766 269.901 66.7766 269.704 66.7797C269.703 66.7797 269.703 66.7797 269.703 66.7797C269.66 66.7797 269.625 66.7454 269.625 66.7017C269.624 66.6611 269.659 66.6237 269.702 66.6237C269.9 66.6206 270.094 66.6206 270.285 66.6206C276.311 66.6206 278.816 67.5659 278.825 67.569C278.866 67.5846 278.888 67.6283 278.872 67.6688C278.86 67.7 278.829 67.7187 278.797 67.7187Z" fill="#413E3E"/>
                                                <path d="M204.911 42.0312C204.39 42.0312 204.062 42.0094 204.061 42.0094C204.018 42.0063 203.985 41.9689 203.988 41.9283C203.991 41.8847 204.025 41.8534 204.066 41.8534C204.068 41.8534 204.07 41.8534 204.071 41.8534C204.071 41.8534 204.151 41.8597 204.297 41.8659C204.442 41.8722 204.653 41.8753 204.911 41.8753C204.918 41.8753 204.924 41.8753 204.931 41.8753C206.268 41.8753 208.86 41.7224 210.427 40.696C212.313 39.4637 225.787 30.2976 237.196 30.2945C239.269 30.2945 241.274 30.5971 243.13 31.3084C245.922 32.3785 248.452 32.7872 250.692 32.7872C250.693 32.7872 250.693 32.7872 250.693 32.7872C257.589 32.7872 261.737 28.8999 262.223 28.4195C262.256 28.3883 262.271 28.3727 262.271 28.3727C262.287 28.3571 262.307 28.3477 262.327 28.3477C262.347 28.3477 262.366 28.357 262.381 28.3695C262.413 28.4007 262.413 28.4507 262.384 28.4819C262.377 28.4881 258.114 32.9432 250.692 32.9432C248.433 32.9432 245.883 32.5314 243.074 31.455C241.24 30.7531 239.253 30.4505 237.196 30.4505C237.193 30.4505 237.192 30.4505 237.19 30.4505C225.858 30.4505 212.392 39.5947 210.512 40.8239C208.878 41.8909 206.255 42.0312 204.911 42.0312Z" fill="#413E3E"/>
                                                <path d="M201.512 76.8574C201.472 76.8574 201.438 76.8262 201.435 76.7856C201.435 76.7856 201.336 75.6999 201.336 73.9497C201.336 70.7675 201.661 65.3889 203.499 60.3286C205.336 55.2713 208.694 50.523 214.756 48.6355C214.764 48.6324 214.771 48.6292 214.779 48.6292C214.812 48.6292 214.843 48.6511 214.854 48.6854C214.866 48.7259 214.844 48.7696 214.802 48.7821C208.8 50.654 205.475 55.3493 203.646 60.3816C201.817 65.417 201.492 70.78 201.492 73.9497C201.492 74.8201 201.517 75.5284 201.541 76.0151C201.566 76.5049 201.59 76.7701 201.59 76.7732H201.59C201.594 76.8137 201.562 76.8512 201.519 76.8574C201.517 76.8574 201.514 76.8574 201.512 76.8574Z" fill="#413E3E"/>
                                                <path d="M252.867 39.4746C252.824 39.4746 252.79 39.4403 252.789 39.3998C252.788 39.3561 252.823 39.3186 252.866 39.3186H252.872C252.874 39.3186 252.875 39.3186 252.877 39.3186C262.311 39.3186 268.193 31.9777 268.886 31.0636C268.933 31.0012 268.955 30.97 268.955 30.97C268.971 30.9481 268.994 30.9388 269.019 30.9388C269.035 30.9388 269.051 30.9419 269.064 30.9513C269.099 30.9762 269.107 31.0261 269.082 31.0605C269.076 31.0667 263.031 39.4715 252.872 39.4746H252.868C252.868 39.4746 252.867 39.4746 252.867 39.4746Z" fill="#413E3E"/>
                                                <path d="M269.164 56.5527C269.131 56.5527 269.101 56.5309 269.09 56.4997C269.076 56.4592 269.098 56.4123 269.139 56.3999C271.944 55.4421 273.997 53.1054 275.417 50.7717C276.836 48.4381 277.622 46.1138 277.9 45.1966C277.978 44.9345 278.015 44.7879 278.015 44.7879C278.024 44.7536 278.056 44.7317 278.09 44.7317C278.096 44.7317 278.106 44.7317 278.112 44.7317C278.152 44.7442 278.177 44.7848 278.168 44.8285C278.165 44.8316 277.55 47.1995 276.124 49.8482C274.696 52.4969 272.456 55.4296 269.189 56.5465C269.181 56.5496 269.172 56.5527 269.164 56.5527Z" fill="#413E3E"/>
                                                <path d="M223.312 52.3516C223.292 52.3516 223.272 52.3422 223.257 52.3266C223.227 52.2985 223.227 52.2486 223.257 52.2174C223.259 52.2174 226.67 48.8293 231.13 45.3226C235.592 41.8128 241.094 38.1844 245.313 37.704C245.316 37.7009 245.319 37.7009 245.322 37.7009C245.361 37.7009 245.395 37.732 245.399 37.7726C245.404 37.8131 245.373 37.8537 245.331 37.8569C241.699 38.2687 237.031 41.0859 232.94 44.1308C228.849 47.1758 225.33 50.4453 223.969 51.7463C223.58 52.1176 223.368 52.3266 223.367 52.3266C223.352 52.3422 223.332 52.3516 223.312 52.3516Z" fill="#413E3E"/>
                                                <path d="M244.539 120.469C244.539 120.469 238.058 119.876 234.366 118.688C230.674 117.499 224.273 114.963 224.273 114.963C223.612 114.785 224.624 125.517 231.643 127.507C238.631 129.488 244.979 120.588 244.539 120.469Z" fill="white"/>
                                                <path d="M334.529 128.465C336.623 145.047 340.201 152.809 336.529 163.394C332.857 173.977 326.511 189.339 337.552 200.86C348.597 212.382 361.765 214.818 378.447 215.018C395.126 215.218 410.956 193.554 415.411 190.786C419.866 188.019 426.714 187.632 427.94 180.31C429.166 172.985 437.1 144.457 410.41 133.266C383.72 122.075 334.529 128.465 334.529 128.465Z" fill="#1B1817"/>
                                                <path d="M341.168 204.143C341.168 204.143 352.144 200.253 354.374 193.205C356.605 186.158 397.518 184.872 397.518 184.872C397.518 184.872 400.685 195.445 413.429 193.992L415.254 209.641C415.254 209.641 342.372 222.597 341.168 204.143Z" fill="#FABE93"/>
                                                <path d="M346.883 211.808C346.883 211.808 397.343 222.225 395.402 208.292C395.402 208.292 395.49 192.634 395.608 192.041C395.93 190.425 396.644 186.927 397.53 183.318V183.308C398.316 180.129 399.234 176.86 400.126 174.723C400.213 174.517 401.402 170.948 402.441 167.847C403.233 165.472 403.941 163.376 404.007 163.251C406.406 158.59 355.428 170.046 355.428 170.046C355.428 170.046 355.518 171.275 355.119 173.893C355.088 174.099 355.063 174.91 355.051 175.131C355.032 175.431 355.004 175.824 354.969 176.276V176.295C354.751 179.078 354.888 196.346 353.247 201.145C351.107 207.403 346.883 211.808 346.883 211.808Z" fill="#FABE93"/>
                                                <path d="M350.403 169.503C352.487 173.453 355.123 176.841 358.184 179.515L358.187 179.521C362.723 183.48 368.192 185.87 374.164 186.178C384.347 186.709 393.694 181.081 399.849 171.55C400.04 171.253 400.23 170.954 400.417 170.648C404.282 164.305 406.772 156.344 407.237 147.383C408.444 124.194 409.499 103.812 378.522 102.202C347.542 100.595 346.485 120.98 345.28 144.17C344.781 153.801 346.728 162.53 350.403 169.503Z" fill="#FABE93"/>
                                                <path d="M404.417 156.637C404.417 156.637 414.083 156.652 415.574 146.226C417.062 135.799 411.328 134.898 406.729 140.392C402.127 145.883 404.417 156.637 404.417 156.637Z" fill="#FABE93"/>
                                                <path d="M347.865 138.601C347.865 138.601 345.943 136.535 347.487 148.406C347.487 148.406 349.194 140.401 347.865 138.601Z" fill="#FABE93"/>
                                                <path d="M354.972 176.295C354.934 176.242 354.912 176.204 354.906 176.189C354.925 176.217 354.95 176.245 354.972 176.276V176.295Z" fill="#1B1917"/>
                                                <path d="M379.643 191.084C364.815 191.084 355.849 177.669 354.969 176.296V176.277C355.499 176.97 356.145 177.631 356.834 178.265C357.274 178.698 357.724 179.113 358.182 179.516L358.185 179.522C358.831 180.083 359.492 180.614 360.173 181.11C360.204 181.138 360.235 181.163 360.263 181.191L360.269 181.197C362.254 182.929 364.965 184.167 367.685 184.982C369.641 185.618 371.682 186.017 373.788 186.155C374.415 186.208 375.001 186.236 375.532 186.236C375.965 186.236 376.361 186.217 376.714 186.183C376.72 186.183 376.73 186.183 376.739 186.183C381.035 185.967 385.141 184.657 388.872 182.426C393.72 179.653 398.378 175.101 402.44 167.848C401.401 170.949 400.213 174.518 400.125 174.724C399.239 176.848 398.325 180.09 397.545 183.253C395.751 185.553 394.254 187.939 393.09 190.341C392.073 189.746 391.012 189.393 389.873 189.393C389.268 189.393 388.638 189.49 387.983 189.705C385.028 190.669 382.249 191.084 379.643 191.084Z" fill="#E8AE86"/>
                                                <path d="M376.74 186.182C380.759 185.792 384.88 184.712 388.873 182.425C385.142 184.656 381.036 185.966 376.74 186.182ZM373.789 186.154C371.683 186.016 369.643 185.617 367.687 184.981C369.83 185.623 371.98 186.001 373.789 186.154ZM360.174 181.109C359.494 180.613 358.833 180.082 358.187 179.521L358.184 179.515C357.725 179.112 357.276 178.697 356.836 178.264C357.94 179.281 359.157 180.226 360.174 181.109Z" fill="#E8AE86"/>
                                                <path d="M354.887 176.238C354.887 176.238 354.887 176.223 354.893 176.179C354.896 176.182 354.896 176.182 354.899 176.185C354.893 176.213 354.887 176.238 354.887 176.238Z" fill="#1B1917"/>
                                                <path d="M354.901 176.186C354.898 176.182 354.898 176.182 354.895 176.179C354.904 176.133 354.91 176.117 354.91 176.117C354.91 176.117 354.904 176.151 354.901 176.186Z" fill="#E8AE86"/>
                                                <path d="M396.129 135.584C396.066 135.525 396.004 135.472 395.941 135.422C392.422 132.548 388.522 131.681 384.673 132.991C384.339 133.104 383.989 133.25 383.718 133.737C383.203 134.667 383.169 135.693 383.265 137.172C387.702 134.77 392.304 134.751 396.653 137.138C396.774 136.638 396.728 136.604 396.562 136.205C396.444 135.921 396.291 135.734 396.129 135.584Z" fill="#1B1817"/>
                                                <path d="M353.867 135.491C353.933 135.432 353.998 135.382 354.061 135.332C357.651 132.552 361.576 131.791 365.389 133.198C365.719 133.32 366.066 133.476 366.325 133.972C366.814 134.914 366.824 135.94 366.686 137.416C362.316 134.898 357.717 134.758 353.302 137.029C353.196 136.527 353.243 136.496 353.418 136.099C353.546 135.819 353.702 135.635 353.867 135.491Z" fill="#1B1817"/>
                                                <path d="M385.771 142.161C385.715 144.285 387.094 146.048 388.854 146.095C390.613 146.142 392.089 144.457 392.145 142.332C392.204 140.204 390.822 138.442 389.063 138.395C387.303 138.348 385.83 140.033 385.771 142.161Z" fill="#1B1817"/>
                                                <path d="M357.361 142.204C357.305 144.332 358.684 146.095 360.443 146.142C362.206 146.188 363.679 144.504 363.735 142.379C363.794 140.251 362.412 138.489 360.652 138.442C358.893 138.395 357.42 140.08 357.361 142.204Z" fill="#1B1817"/>
                                                <path d="M374.861 162.193C374.833 162.193 374.801 162.19 374.773 162.19C372.349 162.147 369.601 159.595 370.608 157.392C371.597 155.233 373.89 149.486 373.254 143.699C373.226 143.44 373.254 143.181 373.348 142.938C373.472 142.613 373.675 142.214 373.915 142.214C374.106 142.214 374.324 142.467 374.546 143.212C375.123 145.147 374.38 154.285 373.288 157.626C373.039 158.387 373.363 159.22 374.078 159.585L375.332 160.225C375.728 160.424 376.043 160.771 376.149 161.201C376.268 161.672 376.115 162.193 374.861 162.193Z" fill="#E8AE86"/>
                                                <path d="M385.137 167.574C385.365 171.792 381.315 175.436 376.099 175.717C370.879 175.998 366.465 172.806 366.24 168.588C366.016 164.427 384.916 163.456 385.137 167.574Z" fill="#1B1817"/>
                                                <path d="M366.773 167.354C368.196 168.262 370.913 169.045 376.111 168.767C380.994 168.505 383.443 167.551 384.656 166.571C382.036 163.919 369.525 164.531 366.773 167.354Z" fill="white"/>
                                                <path d="M370.387 174.516C372.009 175.374 373.987 175.83 376.099 175.718C378.136 175.608 379.996 174.981 381.493 174.011C380.589 173.3 378.891 172.682 375.703 172.854C372.649 173.016 371.129 173.752 370.387 174.516Z" fill="white"/>
                                                <path d="M457.242 554.27H387.932C387.932 554.27 386.956 547.281 384.678 541.75C382.401 536.215 382.401 501.401 380.775 502.05C380.423 502.193 380.098 504.724 379.808 508.605V508.611C378.769 522.638 378.17 554.27 378.17 554.27H317.649C317.324 545.643 314.07 530.035 308.399 517.671C302.73 505.307 301.055 470.814 301.725 451.939C302.402 433.067 311.125 398.621 311.125 398.621C311.125 398.621 450.731 401.18 452.532 409.229C454.329 417.275 462.774 464.958 463.098 481.228C463.423 497.495 457.242 554.27 457.242 554.27Z" fill="#211E1D"/>
                                                <path d="M379.81 508.604C379.582 483.845 377.489 471.761 376.79 468.392C376.737 468.136 376.94 467.933 377.167 467.933C377.233 467.933 377.301 467.949 377.367 467.986C377.841 468.261 378.287 468.364 378.696 468.364C379.345 468.364 379.897 468.099 380.325 467.83C380.752 467.565 381.055 467.297 381.201 467.297C381.42 467.297 381.307 467.871 380.777 469.852C379.17 475.842 380.777 502.049 380.777 502.049C380.424 502.192 380.1 504.722 379.81 508.604Z" fill="#1D1B19"/>
                                                <path d="M378.632 449.256C377.686 449.256 376.96 447.905 376.414 445.138C374.776 436.858 374.701 413.556 374.716 406.48C374.966 406.502 375.212 406.524 375.465 406.545C375.45 413.677 375.528 436.802 377.147 444.991C377.702 447.805 378.348 448.507 378.654 448.507C378.657 448.507 378.66 448.507 378.663 448.507C379.892 448.376 382.176 440.832 381.973 427.467C381.811 416.719 381.855 410.339 381.908 407.101C382.16 407.123 382.404 407.144 382.656 407.163C382.6 410.405 382.56 416.766 382.722 427.458C382.9 439.223 381.115 449 378.741 449.25C378.703 449.253 378.669 449.256 378.632 449.256Z" fill="#1D1B19"/>
                                                <path d="M403.148 485.648C396.752 485.648 388.46 484.26 380.07 478.972C380.07 478.972 391.523 485.053 405.272 485.053C408.42 485.053 411.687 484.734 414.962 483.954C414.962 483.954 410.214 485.648 403.148 485.648Z" fill="#1D1B19"/>
                                                <path d="M346.367 506.932C346.373 506.932 346.38 506.932 346.386 506.932C346.373 506.932 346.367 506.932 346.367 506.932ZM346.386 506.932C347.125 506.9 366.871 505.93 379.409 493.735C379.409 493.735 371.479 505.89 346.386 506.932Z" fill="#1D1B19"/>
                                                <path d="M360.336 470.91C348.705 470.91 340.672 467.297 340.672 467.297C347.358 469.381 354.249 470.024 360.202 470.024C369.696 470.021 376.79 468.392 376.79 468.392C370.881 470.255 365.284 470.91 360.336 470.91Z" fill="#1D1B19"/>
                                                <path d="M301.725 554.27H240.772C240.772 549.718 227.801 522.382 217.518 502.817C217.518 502.817 217.518 502.817 217.496 502.764C211.098 490.6 205.747 481.459 205.216 482.698C203.832 485.927 198.751 532.106 200.138 534.877C201.522 537.647 203.368 554.27 203.368 554.27H140.829C141.091 542.726 128.101 495.626 123.012 475.307C117.919 454.987 118.267 424.076 118.267 424.076C118.267 424.076 270.327 397.729 279.68 428.749C289.034 459.767 295.261 484.545 298.496 501.629C301.725 518.713 301.725 554.27 301.725 554.27Z" fill="#1B1817"/>
                                                <path d="M214.89 465.154C214.349 465.154 213.846 464.955 213.453 464.571C212.573 463.716 212.347 462.091 212.848 460.222C213.923 456.216 212.84 444.825 212.137 438.676C212.389 438.683 212.646 438.692 212.897 438.701C213.611 444.919 214.684 456.266 213.571 460.415C213.141 462.019 213.292 463.37 213.975 464.034C214.228 464.281 214.537 464.409 214.882 464.409C215.035 464.409 215.196 464.384 215.362 464.334C216.625 463.956 218.309 462.063 219.248 457.869C220.425 452.609 219.797 444.66 219.045 438.826C219.303 438.826 219.558 438.829 219.815 438.829C220.571 444.688 221.186 452.638 219.978 458.035C219.12 461.86 217.475 464.484 215.575 465.051C215.343 465.12 215.113 465.154 214.89 465.154Z" fill="#171514"/>
                                                <path d="M217.496 502.764C211.488 491.342 206.403 482.585 205.366 482.585C205.299 482.585 205.248 482.619 205.216 482.697C205.216 482.697 206.203 474.401 200.852 471.484C196.455 469.085 190.253 463.566 192.23 463.566C192.659 463.566 193.472 463.825 194.772 464.433C201.253 467.457 205.851 471.441 208.913 471.441C209.298 471.441 209.658 471.378 209.995 471.241C210.095 471.203 210.213 471.182 210.347 471.182C212.249 471.182 217.564 475.041 224.672 478.903C231.778 482.762 240.677 486.622 249.746 486.622C250.391 486.622 251.037 486.603 251.684 486.562C251.684 486.562 250.604 487.158 247.639 487.158C242.416 487.158 231.34 485.308 209.995 475.094C209.995 475.094 206.499 475.662 212.01 489.239C216.658 500.695 217.384 502.483 217.496 502.764Z" fill="#171514"/>
                                                <path d="M280.449 426.087C280.449 427.837 284.527 431.912 239.679 437.736C194.83 443.564 113.281 424.34 110.951 421.429C108.622 418.515 111.535 370.17 110.371 362.599C109.206 355.027 115.03 330.561 115.03 323.573C115.03 319.358 114.184 294.178 113.513 274.85C113.477 273.839 113.44 272.847 113.407 271.874L113.404 271.802V271.793C113.012 260.527 112.7 251.932 112.7 251.932L109.378 204.295L109.285 202.982L106.508 163.167C129.917 143.921 168.663 139.656 177.474 138.542C178.469 138.414 179.458 138.823 180.076 139.615C223.647 195.922 250.501 157.56 254.343 151.38C254.629 150.921 255.209 150.753 255.697 150.984C258.956 152.534 271.012 158.674 286.858 171.55C305.499 186.693 321.226 214.653 321.226 214.653C321.226 214.653 273.461 373.081 272.877 384.15C272.296 395.216 280.449 424.34 280.449 426.087Z" fill="#292524"/>
                                                <path d="M461.145 260.112C460.237 260.673 459.369 265.865 458.561 273.998V274.001C455.286 274.585 452.35 275.156 450.933 275.468C447.602 276.21 447.973 280.831 450.933 280.74C451.969 280.706 454.771 280.7 457.966 280.7C454.79 320.009 452.84 402.248 453.994 408.026C455.501 415.557 310.972 401.627 309.465 397.865C307.961 394.099 244.601 234.367 304.988 214.403C311.901 212.116 327.906 210.054 331.294 207.04C333.288 205.268 335.927 204.214 337.762 203.643C339.025 203.253 340.376 203.262 341.637 203.671C349.658 206.264 384.646 215.664 414.098 193.491C414.098 193.491 443.081 190.483 449.102 193.491C455.123 196.502 463.815 258.471 461.145 260.112Z" fill="#E2AA1A"/>
                                                <path d="M390.301 205.135C389.995 202.935 390.007 200.848 390.391 199.385C390.192 201.338 390.276 203.235 390.666 205.032C390.541 205.066 390.422 205.1 390.301 205.135Z" fill="#D7A17B"/>
                                                <path d="M410.024 240.426L405.713 240.31C406.334 238.014 406.624 235.425 406.131 232.773C407.338 234.957 408.764 237.584 410.024 240.426ZM403.195 240.242L401.704 240.201C402.331 231.278 401.498 221.208 399.866 218.244C399.086 217.567 396.11 215.957 395.149 215.42C392.638 214.01 390.884 209.365 390.301 205.134C390.422 205.1 390.541 205.066 390.666 205.031C391.561 209.156 394.079 212.747 398.553 215.258C399.511 215.798 400.375 216.412 401.158 217.086C402.924 220.29 404.003 231.179 403.195 240.242Z" fill="#BE911B"/>
                                                <path d="M346.158 147.052C349.624 147.698 355.442 143.309 355.87 132.115C356.272 121.666 362.022 110.928 367.26 107.259C367.635 106.994 368.006 106.766 368.374 106.579C376.664 119.458 391.757 115.467 394.952 123.981C396.499 128.109 396.166 131.403 396.805 134.495C397.176 136.283 397.875 138.005 399.457 139.78L399.46 139.783C400.774 141.259 402.702 142.775 405.559 144.394C417.783 151.333 433.394 184.337 422.051 196.346C432.262 193.619 444.242 187.645 444.919 183.882C449.852 156.537 426.677 140.273 428.153 128.237C429.626 116.204 421.336 87.3483 395.223 80.5814C369.11 73.8144 359.813 84.9959 357.143 88.0939C350.055 88.1033 336.309 102.648 334.571 120.849C332.833 139.05 342.692 146.407 346.158 147.052Z" fill="#1B1817"/>
                                                <path d="M396.806 134.496C393.921 129.336 388.945 124.428 384.343 123.065C375.52 120.454 370.132 113.316 367.262 107.26C367.636 106.995 368.007 106.767 368.376 106.58C376.665 119.458 391.759 115.468 394.953 123.982C396.501 128.11 396.167 131.404 396.806 134.496Z" fill="#F4B68B"/>
                                                <path d="M403.7 176.755C417.702 164.456 452.142 177.51 442.695 187.137C434.661 194.884 438.489 213.646 445.11 230.609C454.993 255.933 421.496 268.718 405.834 266.25C419.633 257.976 411.063 241.697 406.134 232.774C407.669 241.035 401.604 248.691 401.604 248.691C404.677 239.759 403.544 221.415 401.161 217.088C400.378 216.414 399.513 215.799 398.556 215.259C384.576 207.41 389.698 189.05 403.7 176.755Z" fill="#1B1817"/>
                                                <path d="M368.175 105.865C368.094 105.865 368.029 105.806 368.019 105.725C368.019 105.725 368.016 105.675 368.004 105.581C367.991 105.488 367.976 105.347 367.947 105.166C367.898 104.804 367.81 104.283 367.682 103.647C367.42 102.371 366.974 100.624 366.241 98.752C364.778 95.002 362.163 90.7559 357.587 88.6999C357.505 88.6656 357.471 88.572 357.505 88.494C357.533 88.4379 357.59 88.4036 357.649 88.4036C357.671 88.4036 357.693 88.4067 357.714 88.416C362.4 90.5219 365.052 94.8491 366.534 98.6366C368.013 102.427 368.328 105.684 368.331 105.694C368.337 105.781 368.275 105.856 368.191 105.865C368.185 105.865 368.181 105.865 368.175 105.865Z" fill="#2C2928"/>
                                                <path d="M342.77 145.596C342.767 145.596 342.763 145.596 342.76 145.596C342.189 145.596 341.59 145.558 340.966 145.48C340.879 145.471 340.82 145.393 340.829 145.306C340.838 145.228 340.907 145.168 340.985 145.168C340.991 145.168 340.998 145.171 341.004 145.171C341.59 145.243 342.155 145.281 342.692 145.284C342.832 145.39 342.972 145.493 343.11 145.593C342.997 145.596 342.885 145.596 342.77 145.596Z" fill="#4B4A4A"/>
                                                <path d="M343.113 145.594C342.976 145.494 342.836 145.391 342.695 145.285C342.717 145.285 342.742 145.285 342.764 145.285C346.879 145.282 349.553 143.31 351.225 140.73C352.897 138.147 353.543 134.949 353.543 132.556C353.543 132.132 353.521 131.732 353.484 131.367C353.452 131.052 353.437 130.722 353.437 130.381C353.437 127.867 354.254 124.682 355.069 122.117C355.883 119.553 356.694 117.612 356.697 117.609C356.722 117.55 356.778 117.512 356.841 117.512C356.859 117.512 356.881 117.518 356.9 117.525C356.981 117.559 357.018 117.649 356.984 117.731C356.984 117.731 356.934 117.849 356.847 118.071C356.756 118.292 356.632 118.61 356.479 119.013C356.176 119.815 355.771 120.935 355.365 122.211C354.554 124.76 353.749 127.932 353.749 130.381C353.749 130.712 353.764 131.034 353.796 131.336C353.833 131.711 353.855 132.122 353.855 132.556C353.855 135.002 353.2 138.247 351.487 140.898C349.827 143.475 347.141 145.485 343.113 145.594Z" fill="#4B4A4A"/>
                                                <path d="M406.086 118.416C406.083 118.416 406.079 118.416 406.076 118.416C390.493 117.271 381.645 113.674 376.688 110.348C371.727 107.022 370.666 103.968 370.657 103.943C370.629 103.859 370.673 103.772 370.754 103.743C370.769 103.737 370.788 103.734 370.804 103.734C370.869 103.734 370.928 103.775 370.95 103.84L370.953 103.846L370.963 103.868C370.972 103.89 370.985 103.924 371.003 103.965C371.038 104.052 371.097 104.177 371.181 104.342C371.353 104.67 371.633 105.144 372.064 105.721C372.931 106.876 374.41 108.445 376.862 110.089C381.764 113.377 390.555 116.962 406.098 118.104C406.186 118.11 406.248 118.185 406.242 118.273C406.235 118.354 406.167 118.416 406.086 118.416Z" fill="#4B4A4A"/>
                                                <path d="M420.469 157.324C420.403 157.324 420.344 157.287 420.319 157.221C419.112 153.758 416.556 150.429 413.677 147.503C410.8 144.573 407.603 142.05 405.113 140.184C403.453 138.939 402.109 137.991 401.378 137.401C400.492 136.69 399.959 135.782 399.65 134.858C399.341 133.938 399.254 133.005 399.254 132.235C399.254 131.174 399.422 130.416 399.422 130.406C399.438 130.335 399.503 130.285 399.575 130.285C399.585 130.285 399.597 130.288 399.61 130.288C399.694 130.307 399.747 130.391 399.728 130.475L399.722 130.506C399.716 130.528 399.709 130.559 399.703 130.603C399.688 130.687 399.669 130.809 399.647 130.965C399.606 131.277 399.566 131.72 399.566 132.235C399.566 132.983 399.653 133.882 399.947 134.762C400.243 135.638 400.742 136.49 401.575 137.158C402.289 137.735 403.637 138.69 405.3 139.934C406.963 141.182 408.944 142.723 410.938 144.483C414.925 148.008 418.965 152.411 420.615 157.118C420.643 157.199 420.6 157.29 420.519 157.318C420.503 157.324 420.484 157.324 420.469 157.324Z" fill="#4B4A4A"/>
                                                <path d="M403.584 176.857C403.58 176.857 403.58 176.854 403.577 176.854C403.524 176.786 403.534 176.689 403.599 176.633C403.599 176.633 403.64 176.602 403.718 176.533C403.796 176.467 403.908 176.368 404.055 176.24C404.348 175.978 404.766 175.591 405.271 175.092C406.282 174.09 407.639 172.633 409.028 170.817C411.807 167.183 414.706 162.101 415.196 156.326C415.202 156.245 415.27 156.182 415.352 156.182C415.355 156.182 415.361 156.185 415.364 156.185C415.451 156.192 415.514 156.267 415.508 156.354C415.005 162.216 412.076 167.345 409.277 171.008C407.761 172.989 406.282 174.546 405.243 175.553C404.707 175.925 404.189 176.324 403.699 176.754C403.658 176.789 403.621 176.823 403.584 176.857Z" fill="#4B4A4A"/>
                                                <path d="M403.697 176.91C403.654 176.91 403.61 176.891 403.582 176.857C403.619 176.823 403.657 176.788 403.697 176.754C404.187 176.324 404.705 175.924 405.242 175.553C404.362 176.408 403.8 176.873 403.797 176.876C403.766 176.898 403.732 176.91 403.697 176.91Z" fill="#4B4A4A"/>
                                                <path d="M424.759 172.105C424.653 172.093 424.553 172.081 424.447 172.068C424.547 171.394 424.588 170.727 424.588 170.078C424.591 165.807 422.731 162.25 422.503 161.832L422.482 161.791C422.438 161.716 422.466 161.62 422.541 161.579C422.563 161.567 422.591 161.557 422.616 161.557C422.672 161.557 422.725 161.585 422.753 161.638C422.759 161.651 424.9 165.426 424.9 170.078C424.9 170.739 424.856 171.419 424.759 172.105Z" fill="#4B4A4A"/>
                                                <path d="M405.791 228.285C405.71 228.285 405.642 228.223 405.635 228.142C405.635 228.139 405.273 224.033 405.273 218.255C405.277 209.307 406.131 196.354 410.558 188.358C412.034 185.693 413.912 183.575 416.302 182.352C419.597 180.667 421.662 178.627 422.91 176.496C423.765 175.036 424.236 173.532 424.448 172.069C424.554 172.081 424.654 172.094 424.76 172.106C424.541 173.61 424.058 175.154 423.181 176.652C421.899 178.839 419.781 180.923 416.442 182.63C414.128 183.815 412.287 185.88 410.83 188.507C409.373 191.137 408.303 194.329 407.526 197.742C405.969 204.574 405.585 212.305 405.585 218.255C405.585 222.579 405.788 225.964 405.891 227.387C405.922 227.861 405.947 228.114 405.947 228.114C405.954 228.201 405.891 228.276 405.804 228.285C405.801 228.285 405.794 228.285 405.791 228.285Z" fill="#4B4A4A"/>
                                                <path d="M401.091 216.281C401.05 216.281 401.01 216.266 400.981 216.234C400.975 216.231 398.897 214.175 396.817 210.993C394.736 207.808 392.648 203.496 392.648 198.957C392.648 195.868 393.625 192.674 396.227 189.7C396.258 189.666 396.302 189.647 396.345 189.647C396.383 189.647 396.417 189.66 396.448 189.688C396.514 189.744 396.52 189.841 396.464 189.906C393.909 192.826 392.96 195.934 392.96 198.957C392.96 203.119 394.767 207.131 396.692 210.216C398.617 213.302 400.657 215.461 401.109 215.922C401.169 215.982 401.2 216.013 401.2 216.013C401.259 216.075 401.262 216.172 401.2 216.234C401.169 216.266 401.131 216.281 401.091 216.281Z" fill="#4B4A4A"/>
                                                <path d="M349.029 182.16C349.019 182.16 349.013 182.16 349.007 182.16C348.92 182.148 348.86 182.07 348.873 181.982C349.241 179.368 349.356 176.816 349.356 174.651C349.356 171.94 349.175 169.834 349.085 168.951C349.054 168.658 349.035 168.498 349.035 168.498C349.026 168.414 349.085 168.336 349.169 168.324C349.175 168.324 349.185 168.324 349.191 168.324C349.266 168.324 349.334 168.383 349.344 168.461C349.344 168.464 349.668 171.019 349.668 174.651C349.668 176.828 349.553 179.393 349.182 182.026C349.169 182.104 349.104 182.16 349.029 182.16Z" fill="#4B4A4A"/>
                                                <path d="M424.382 130.895C424.379 130.895 424.373 130.895 424.366 130.891C424.282 130.885 424.22 130.807 424.226 130.723C424.348 129.463 424.404 128.224 424.404 127.007C424.404 116.687 420.289 107.942 415.908 101.562C411.531 95.1819 406.889 91.1698 405.866 90.3212C405.728 90.2057 405.657 90.1496 405.657 90.1496C405.588 90.0965 405.579 89.9998 405.632 89.9312C405.663 89.8906 405.707 89.8719 405.753 89.8719C405.788 89.8719 405.822 89.8813 405.85 89.9062C405.856 89.9125 410.567 93.6375 415.284 100.136C419.995 106.632 424.716 115.907 424.716 127.007C424.716 128.233 424.66 129.484 424.538 130.751C424.529 130.832 424.463 130.895 424.382 130.895Z" fill="#4B4A4A"/>
                                                <path d="M340.359 109.641C340.338 109.641 340.319 109.637 340.297 109.628C340.219 109.594 340.182 109.503 340.216 109.422C346.181 95.7387 354.13 91.5643 354.155 91.5519C354.177 91.5394 354.202 91.5331 354.227 91.5331C354.283 91.5331 354.336 91.5643 354.364 91.6174C354.405 91.6922 354.374 91.789 354.299 91.8264L354.277 91.8389C354.264 91.8482 354.243 91.8576 354.215 91.8763C354.155 91.9075 354.068 91.9574 353.956 92.0261C353.731 92.1665 353.403 92.3786 352.988 92.6781C352.159 93.274 350.989 94.2131 349.635 95.5796C346.924 98.3094 343.47 102.743 340.503 109.547C340.478 109.606 340.419 109.641 340.359 109.641Z" fill="#4B4A4A"/>
                                                <path d="M444.919 183.883C444.919 183.883 437.934 205.36 444.342 232.924L443.288 231.735C443.288 231.735 437.513 203.697 443.44 184.754L444.919 183.883Z" fill="#141A24"/>
                                                <path d="M442.008 179.152C441.905 179.049 441.799 178.95 441.693 178.85C441.637 176.189 441.378 172.298 440.495 168.152C439.475 163.357 437.618 158.221 434.29 154.256C430.003 149.152 427.85 145.942 426.765 143.995C425.682 142.051 425.66 141.368 425.66 141.306C425.66 141.221 425.729 141.15 425.816 141.15C425.904 141.15 425.972 141.221 425.972 141.306V141.309V141.331C425.975 141.349 425.978 141.381 425.988 141.424C426.003 141.509 426.035 141.649 426.103 141.845C426.234 142.245 426.503 142.884 427.039 143.845C428.109 145.764 430.253 148.962 434.527 154.056C437.905 158.081 439.774 163.26 440.801 168.086C441.724 172.423 441.967 176.472 442.008 179.152Z" fill="#4B4A4A"/>
                                                <path d="M441.801 182.547C441.798 182.547 441.795 182.547 441.788 182.544C441.704 182.538 441.639 182.466 441.645 182.378C441.645 182.378 441.648 182.325 441.654 182.219C441.661 182.113 441.667 181.957 441.676 181.751C441.692 181.346 441.704 180.753 441.704 180.007C441.704 179.655 441.701 179.268 441.695 178.85C441.801 178.95 441.907 179.05 442.01 179.153C442.016 179.455 442.016 179.739 442.016 180.007C442.016 181.505 441.957 182.397 441.957 182.4C441.951 182.481 441.882 182.547 441.801 182.547Z" fill="#4B4A4A"/>
                                                <path d="M440.396 241.246L440.078 241.24C440.615 239.022 440.917 236.526 440.917 233.715C440.917 231.55 440.74 229.2 440.353 226.645C440.34 226.561 440.399 226.48 440.484 226.467C440.493 226.467 440.499 226.464 440.509 226.464C440.584 226.464 440.649 226.521 440.662 226.599C441.048 229.166 441.229 231.534 441.229 233.715C441.229 236.523 440.93 239.022 440.396 241.246Z" fill="#4B4A4A"/>
                                                <path d="M423.657 240.795L423.32 240.786C424.543 238.018 425.021 235.341 425.021 232.708C425.024 225.408 421.339 218.398 419.673 210.657C419.333 209.076 419.184 207.485 419.184 205.906C419.184 199.769 421.452 193.829 423.714 189.421C425.979 185.016 428.24 182.139 428.247 182.133C428.278 182.092 428.322 182.074 428.368 182.074C428.403 182.074 428.437 182.083 428.465 182.105C428.534 182.158 428.543 182.258 428.49 182.326C428.49 182.326 428.456 182.37 428.39 182.454C428.325 182.541 428.228 182.669 428.106 182.838C427.86 183.175 427.51 183.668 427.086 184.301C426.244 185.561 425.117 187.374 423.991 189.564C421.742 193.944 419.492 199.847 419.496 205.906C419.496 207.466 419.642 209.035 419.979 210.595C421.626 218.279 425.33 225.302 425.333 232.708C425.336 235.345 424.862 238.028 423.657 240.795Z" fill="#4B4A4A"/>
                                                <path d="M113.404 271.875C113.384 272.028 113.368 272.181 113.345 272.334C112.837 276.187 112.087 279.247 111.042 281.25C101.796 298.955 84.278 319.621 75.0692 323.177C65.8604 326.734 66.189 242.605 66.189 242.605C66.189 242.605 68.7241 236.983 71.8137 229.742C72.8261 227.371 73.8977 224.837 74.9597 222.263C77.3689 216.426 79.7349 210.424 81.2484 205.888C85.4695 193.23 106.505 163.168 106.505 163.168C106.505 163.168 110.73 193.942 112.93 224.416C114.237 242.508 114.831 260.497 113.404 271.875Z" fill="#292524"/>
                                                <path d="M70.4274 224.652C70.2249 230.941 74.2711 223.919 74.2711 223.919C74.589 225.394 74.8841 226.698 74.9602 228.533C75.5327 241.418 90.9768 290.131 90.0103 300.245C89.4281 306.304 85.9046 312.325 83.1669 316.191H83.1607C81.6997 318.256 80.5968 318.702 80.2115 318.796C80.112 318.821 80.0596 318.821 80.0596 318.821C80.0596 318.821 80.2745 323.65 60.1916 327.444C40.1011 331.238 33.2647 305.34 33.3564 275.767C33.4481 246.194 40.1174 225.734 40.1174 225.734C40.1704 220.549 38.452 222.44 39.3755 218.621C39.5627 217.857 40.069 217.239 40.7298 216.899C40.8168 216.849 40.9054 216.808 40.9953 216.774C41.3201 216.646 41.6726 216.581 42.0417 216.581C42.2342 216.587 42.4329 216.59 42.6407 216.606C49.4372 216.94 65.6029 219.878 69.8125 221.211C69.8621 221.226 69.9055 221.242 69.952 221.27C70.1117 221.329 70.2649 221.416 70.3965 221.523C70.8885 221.888 70.4527 224.006 70.4274 224.652Z" fill="#292524"/>
                                                <path d="M74.4883 223.408C74.6465 223.028 74.8049 222.644 74.9622 222.263H74.9637C74.9637 222.263 74.9634 222.263 74.9631 222.263C74.8049 222.647 74.6468 223.028 74.4883 223.408Z" fill="#D5D4D2"/>
                                                <path d="M75.9939 231.391L75.2423 231.372C75.0969 230.296 75.0024 229.344 74.9668 228.533C74.8857 226.698 74.5931 225.391 74.2773 223.919C74.3475 223.75 74.4184 223.579 74.4889 223.407C74.6474 223.026 74.8055 222.646 74.9637 222.262C74.964 222.262 74.9643 222.262 74.9643 222.262H74.9662C74.9662 222.262 76.0837 227.101 75.9886 231.2C75.9873 231.256 75.9892 231.319 75.9939 231.391Z" fill="#23201F"/>
                                                <path d="M113.843 232.414L113.462 232.405C113.304 229.756 113.127 227.089 112.934 224.415C113.262 226.961 113.571 229.637 113.843 232.414Z" fill="#23201F"/>
                                                <path d="M113.462 232.406L113.057 232.394C112.34 224.12 111.185 214.707 109.38 204.297C109.128 202.855 108.865 201.389 108.59 199.904C108.643 200.122 108.902 201.199 109.287 202.983C110.16 207.045 111.686 214.77 112.934 224.416C113.127 227.09 113.305 229.758 113.462 232.406Z" fill="#23201F"/>
                                                <path d="M507.619 227.491L484.342 232.408C484.342 232.408 481.752 218.179 476.068 212.513C470.383 206.851 463.829 194.952 456.622 183.449C450.557 173.765 453.137 172.433 455.976 172.71C458.784 172.985 467.654 183.202 469.65 186.347C469.925 186.784 470.165 187.105 470.371 187.324H470.368L470.374 187.33L470.393 187.349L470.418 187.373L470.446 187.405H470.449L470.508 187.464C470.558 187.505 470.602 187.539 470.646 187.567C470.777 187.657 470.889 187.689 470.986 187.664L471.039 187.648L471.085 187.617L471.148 187.561L471.201 187.495C471.404 187.208 471.513 186.572 471.585 185.676C471.603 185.43 471.622 185.162 471.638 184.878C471.647 184.687 471.656 184.488 471.666 184.285C471.672 184.179 471.675 184.076 471.681 183.97C471.688 183.758 471.697 183.539 471.706 183.311C471.716 183.087 471.725 182.856 471.731 182.616C471.744 182.379 471.753 182.135 471.762 181.886C471.887 178.838 471.188 169.843 470.415 162.1C470.408 162.016 470.399 161.934 470.39 161.85C470.387 161.822 470.383 161.794 470.38 161.769L470.374 161.694C469.953 157.511 469.513 153.739 469.176 151.524C468.206 145.168 469.872 142.414 472.258 141.896C474.642 141.378 476.461 143.593 477.715 154.793C478.589 162.63 480.317 168.998 481.134 170.364C481.275 170.598 481.387 170.686 481.459 170.614C481.587 170.501 481.624 169.999 481.543 169.038C481.24 165.429 480.105 160.078 479.035 153.236L479.032 153.208L479.029 153.202C478.557 150.176 478.096 146.859 477.724 143.272C476.514 131.56 485.265 133.441 486.301 140.517C487.302 147.371 488.257 152.385 488.316 152.693L488.319 152.709C488.319 152.709 488.322 150.84 488.475 148.544L488.478 148.51C488.482 148.463 488.488 148.419 488.488 148.376L488.494 148.316C488.497 148.276 488.497 148.235 488.5 148.188C488.7 145.402 489.118 142.105 489.988 140.732C491.629 138.149 496.88 138.604 496.886 144.282C496.899 149.954 498.353 168.087 497.938 171.924C497.841 172.819 497.869 173.369 497.969 173.643L497.978 173.671C498.281 174.42 499.198 172.938 499.629 171.125C499.682 170.898 499.729 170.667 499.763 170.433C499.906 169.516 500.134 167.538 500.44 165.188L500.446 165.163L500.455 165.085V165.079C501.083 160.365 502.034 154.222 503.291 152.182C505.185 149.109 510.767 150.856 509.88 158.874C508.998 166.892 507.768 174.86 508.523 180.295C509.281 185.729 509.101 197.226 506.711 206.963C504.321 216.7 507.619 227.491 507.619 227.491Z" fill="#FABE93"/>
                                                <path d="M489.712 170.336C489.637 170.336 489.562 169.968 489.503 169.113C489.238 165.316 488.32 152.709 488.32 152.709C488.32 152.709 488.323 150.84 488.476 148.544C488.361 150.959 489.281 157.542 489.796 162.246C490.205 166.009 489.964 170.336 489.712 170.336Z" fill="#F1B489"/>
                                                <path d="M488.047 201.74C485.511 193.838 473 188.665 473 188.665C485.386 192.453 488.047 201.74 488.047 201.74Z" fill="#D7A17B"/>
                                                <path d="M481.548 220.619C481.545 220.619 481.548 220.616 481.548 220.619V220.619ZM481.548 220.619C488.003 214.635 493.388 213.135 497.16 213.135C500.95 213.135 503.119 214.648 503.119 214.648C501.418 213.799 499.628 213.453 497.837 213.453C489.713 213.453 481.567 220.604 481.548 220.619Z" fill="#D7A17B"/>
                                                <path d="M467.585 187.439L467.578 187.436V187.433L467.585 187.439Z" fill="#D7A17B"/>
                                                <path d="M470.92 187.67C470.86 187.67 470.798 187.651 470.726 187.617C470.798 187.654 470.863 187.67 470.923 187.67C470.929 187.67 470.935 187.67 470.941 187.67C470.932 187.67 470.926 187.67 470.92 187.67ZM471.035 187.648C471.038 187.648 471.038 187.645 471.041 187.645L471.038 187.648H471.035ZM470.611 187.542C470.576 187.52 470.545 187.492 470.508 187.464L470.448 187.405H470.445V187.402C470.501 187.458 470.558 187.505 470.611 187.542ZM471.662 184.375C471.665 184.313 471.668 184.251 471.671 184.188C471.668 184.219 471.668 184.251 471.665 184.285C471.665 184.313 471.665 184.344 471.662 184.375ZM471.737 182.494C471.746 182.298 471.753 182.092 471.762 181.886C471.753 182.095 471.746 182.298 471.737 182.494Z" fill="#EFEEED"/>
                                                <path d="M471.532 187.977C470.983 187.977 470.437 187.399 470.375 187.331C470.4 187.356 470.425 187.381 470.447 187.403V187.406H470.45L470.509 187.465C470.547 187.493 470.578 187.521 470.612 187.543C470.653 187.574 470.69 187.599 470.728 187.618C470.799 187.652 470.862 187.671 470.921 187.671C470.927 187.671 470.933 187.671 470.943 187.671C470.974 187.668 471.005 187.661 471.036 187.649H471.04L471.043 187.646C471.458 187.456 471.579 186.217 471.663 184.376C471.667 184.345 471.667 184.314 471.667 184.286C471.67 184.251 471.67 184.22 471.673 184.189C471.695 183.668 471.717 183.1 471.738 182.495C471.748 182.299 471.754 182.096 471.763 181.887C471.773 181.643 471.779 181.359 471.779 181.044C471.776 177.407 471.127 169.226 470.416 162.101C471.052 167.882 472.821 180.511 472.696 185.119C472.634 187.393 472.082 187.977 471.532 187.977Z" fill="#F1B489"/>
                                                <path d="M481.845 170.744C481.714 170.744 481.577 170.685 481.458 170.613C481.54 170.541 481.583 170.31 481.583 169.899C481.583 169.668 481.571 169.381 481.543 169.038C481.24 165.428 480.104 160.077 479.034 153.236L479.031 153.208C479.115 153.566 481.78 165.069 482.257 168.504C482.51 170.304 482.201 170.744 481.845 170.744Z" fill="#F1B489"/>
                                                <path d="M500.445 165.164L500.455 165.086V165.08L500.458 165.07L500.445 165.164Z" fill="#D7A17B"/>
                                                <path d="M499.057 175.518C498.686 175.518 498.062 173.889 497.98 173.671C498.037 173.805 498.112 173.867 498.199 173.867C498.601 173.867 499.278 172.607 499.631 171.125C499.475 172.46 499.35 173.724 499.328 174.554C499.313 175.259 499.203 175.518 499.057 175.518Z" fill="#F1B489"/>
                                                <path d="M502.967 178.617C502.945 178.598 502.923 178.58 502.904 178.561C502.945 178.598 502.967 178.617 502.967 178.617ZM502.904 178.561C502.128 177.903 494.244 171.438 484.501 171.438C480.866 171.438 476.976 172.337 473.098 174.77C473.098 174.77 477.899 171.282 485.15 171.282C490.157 171.282 496.331 172.942 502.904 178.561Z" fill="#D7A17B"/>
                                                <path d="M470.512 153.689C470.512 153.689 470.521 153.674 470.543 153.643C470.53 153.658 470.521 153.674 470.512 153.689ZM470.543 153.643C471.7 151.886 473.288 151.462 474.555 151.462C475.741 151.462 476.639 151.833 476.639 151.833C475.99 151.69 475.397 151.627 474.861 151.627C472.034 151.627 470.749 153.34 470.543 153.643Z" fill="#E4AB82"/>
                                                <path d="M471.906 163.582C471.906 163.582 471.916 163.566 471.934 163.535C471.925 163.551 471.916 163.566 471.906 163.582ZM471.934 163.535C473.092 161.779 474.683 161.354 475.95 161.354C477.132 161.354 478.034 161.726 478.034 161.726C477.382 161.582 476.792 161.52 476.255 161.52C473.429 161.52 472.14 163.233 471.934 163.535Z" fill="#E4AB82"/>
                                                <path d="M489.008 150.457C489.008 150.457 489.023 150.441 489.052 150.413C489.036 150.429 489.023 150.441 489.008 150.457ZM489.052 150.413C490.362 149.044 491.8 148.629 493.06 148.629C494.998 148.629 496.517 149.605 496.517 149.605C495.232 149.062 494.106 148.86 493.142 148.86C490.699 148.86 489.307 150.151 489.052 150.413Z" fill="#E4AB82"/>
                                                <path d="M463.102 187.602C463.102 187.602 463.102 187.583 463.108 187.549C463.105 187.567 463.102 187.586 463.102 187.602Z" fill="#E4AB82"/>
                                                <path d="M467.491 183.449C467.484 183.443 467.478 183.434 467.469 183.424C467.606 183.406 467.687 183.402 467.687 183.402C467.619 183.418 467.553 183.434 467.491 183.449Z" fill="#E2E0DE"/>
                                                <path d="M463.109 187.549C463.568 184.183 466.625 183.54 467.471 183.424C467.48 183.434 467.486 183.443 467.493 183.449C463.718 184.417 463.172 187.137 463.109 187.549Z" fill="#E4AB82"/>
                                                <path d="M490.477 160.674C490.477 160.674 490.489 160.661 490.517 160.64C490.505 160.649 490.489 160.661 490.477 160.674ZM490.517 160.64C491.562 159.735 492.632 159.438 493.59 159.438C495.446 159.438 496.878 160.565 496.878 160.565C495.596 159.872 494.476 159.638 493.546 159.638C491.809 159.638 490.732 160.455 490.517 160.64Z" fill="#E4AB82"/>
                                                <path d="M508.749 161.588C507.342 160.68 506.103 160.396 505.099 160.396C503.611 160.396 502.646 161.023 502.434 161.173C503.411 160.455 504.365 160.206 505.227 160.206C507.248 160.206 508.749 161.588 508.749 161.588ZM502.391 161.204C502.391 161.204 502.406 161.192 502.434 161.173C502.422 161.182 502.406 161.195 502.391 161.204Z" fill="#E4AB82"/>
                                                <path d="M507.45 170.738C506.146 169.706 504.963 169.415 504.046 169.415C503.023 169.415 502.327 169.777 502.162 169.874C502.898 169.434 503.6 169.269 504.236 169.269C506.133 169.269 507.45 170.738 507.45 170.738ZM502.121 169.899C502.121 169.899 502.134 169.89 502.162 169.874C502.146 169.88 502.134 169.89 502.121 169.899Z" fill="#E4AB82"/>
                                                <path d="M479.332 147.674C479.332 147.674 479.345 147.655 479.373 147.624C479.357 147.64 479.345 147.658 479.332 147.674ZM479.373 147.624C480.652 146.111 482.146 145.68 483.428 145.68C485.11 145.68 486.427 146.417 486.427 146.417C485.36 146.042 484.414 145.896 483.594 145.896C480.998 145.896 479.616 147.343 479.373 147.624Z" fill="#E4AB82"/>
                                                <path d="M481.125 160.004C481.125 160.004 481.138 159.985 481.166 159.954C481.153 159.97 481.137 159.985 481.125 160.004ZM481.166 159.954C482.445 158.441 483.939 158.01 485.224 158.01C486.903 158.01 488.22 158.747 488.22 158.747C487.153 158.372 486.207 158.226 485.387 158.226C482.794 158.226 481.409 159.673 481.166 159.954Z" fill="#E4AB82"/>
                                                <path d="M451.886 288.39C451.914 288.521 451.942 288.652 451.973 288.783C452.709 292.087 453.595 294.686 454.656 296.343C464.04 310.996 480.831 327.581 489.096 329.959C497.36 332.336 490.606 259.36 490.606 259.36C490.606 259.36 487.973 254.674 484.734 248.631C483.674 246.653 482.55 244.535 481.43 242.385C478.891 237.506 476.376 232.477 474.713 228.658C470.077 218.001 449.511 193.532 449.511 193.532C449.511 193.532 448.214 220.559 448.647 247.174C448.903 262.97 449.774 278.625 451.886 288.39Z" fill="#E2AA1A"/>
                                                <path d="M482.029 233.7C482.69 239.141 482.412 241.652 482.153 243.767C481.991 245.074 481.838 246.229 481.913 247.823C482.406 259.048 472.75 302.507 474.366 311.209C475.34 316.425 478.859 321.376 481.532 324.518L481.539 324.521C482.964 326.199 483.957 326.502 484.297 326.552C484.384 326.567 484.431 326.561 484.431 326.561C484.431 326.561 484.615 330.77 502.335 332.52C520.059 334.264 524 311.268 521.647 285.613C519.292 259.956 511.745 241.499 511.745 241.499C511.302 237.003 510.176 229.372 509.081 226.131C508.859 225.482 508.372 224.983 507.77 224.736C507.692 224.702 507.611 224.674 507.53 224.649C507.24 224.565 506.928 224.533 506.61 224.565C506.441 224.583 506.27 224.602 506.092 224.63C500.22 225.444 486.602 230.452 483.052 231.934C483.008 231.949 482.974 231.968 482.936 231.996C482.802 232.058 482.674 232.146 482.568 232.249C482.169 232.604 481.957 233.141 482.029 233.7Z" fill="#E2AA1A"/>
                                                <path d="M509.278 243.113L508.785 243.098C509.784 242.614 510.772 242.084 511.746 241.5C511.746 241.5 510.882 242.177 509.278 243.113Z" fill="#BE911B"/>
                                                <path d="M449.416 241.49L448.941 241.478C449.316 235.669 449.821 231.039 450.161 228.293C450.358 226.715 450.501 225.763 450.529 225.57C450.405 226.877 450.289 228.169 450.183 229.441C449.831 233.653 449.581 237.675 449.416 241.49Z" fill="#BE911B"/>
                                                <path d="M243.777 400.143C243.777 400.143 252.303 396.053 253.486 398.637C254.669 401.22 254.153 405.076 253.486 406.982C252.82 408.888 243.777 400.143 243.777 400.143Z" fill="#FABE93"/>
                                                <path d="M241.643 399.197C241.699 400.114 240.88 401.527 239.84 402.884C239.717 403.043 239.586 403.209 239.455 403.371C238.476 404.578 237.376 405.68 236.658 406.263C235.05 407.564 229.898 399.927 229.898 399.927C229.898 399.927 229.685 396.42 232.717 396.348C235.75 396.276 241.531 397.346 241.643 399.197Z" fill="#FABE93"/>
                                                <path d="M217.163 400.655C217.163 400.655 216.864 400.78 216.311 400.917C215.851 401.035 215.212 401.157 214.423 401.232C213.959 401.276 213.439 401.304 212.874 401.301C210.197 401.272 208.406 398.412 208.406 398.412C208.406 398.412 209.528 394.843 214.411 396.346C219.299 397.853 217.163 400.655 217.163 400.655Z" fill="#FABE93"/>
                                                <path d="M235.177 402.518C234.452 402.227 233.575 400.976 233.018 400.081C232.85 399.803 232.663 399.482 232.468 399.136C232.466 399.133 232.465 399.129 232.465 399.129C232.465 399.129 232.495 398.771 232.537 398.487L232.711 398.493C232.716 398.537 232.72 398.583 232.724 398.637C232.83 399.987 235.177 402.518 235.177 402.518Z" fill="#D7A17B"/>
                                                <path d="M250.764 403.092C249.34 402.434 248.617 400.144 248.617 400.144C248.617 400.144 248.841 399.186 248.943 399.186C248.983 399.186 249.004 399.332 248.986 399.741C248.923 401.192 250.764 403.092 250.764 403.092Z" fill="#D7A17B"/>
                                                <path d="M210.989 399.725C210.943 399.725 210.914 399.715 210.914 399.715C211.626 399.397 211.265 397.915 211.265 397.915C211.265 397.915 211.265 397.915 211.265 397.912L211.654 397.921C211.629 399.559 211.173 399.725 210.989 399.725Z" fill="#D7A17B"/>
                                                <path d="M239.455 403.371C239.421 401.602 239.836 399.003 239.836 399.003C240.009 398.879 240.169 398.804 240.308 398.766C240.044 399.995 239.907 401.209 239.859 402.254C239.848 402.473 239.842 402.685 239.839 402.884C239.716 403.047 239.585 403.209 239.455 403.371Z" fill="#D7A17B"/>
                                                <path d="M214.422 401.23C214.578 401.215 214.729 401.199 214.874 401.181C214.874 401.181 214.874 401.181 214.874 401.181C214.732 401.199 214.579 401.215 214.422 401.23Z" fill="#23201F"/>
                                                <path d="M214.424 401.23C213.654 399.979 213.198 398.026 213.198 398.026C213.193 398.005 213.188 397.983 213.184 397.961L213.616 397.973C213.855 399.003 214.208 399.979 214.697 400.856C214.757 400.965 214.82 401.078 214.876 401.181C214.731 401.199 214.581 401.215 214.424 401.23Z" fill="#D7A17B"/>
                                                <path d="M334.024 399.937C334.024 399.937 334.651 409.773 332.28 411.998C329.912 414.222 326.676 412.946 326.676 412.946L324.23 397.846L334.024 399.937Z" fill="#FABE93"/>
                                                <path d="M40.406 232.133H29.3438C29.365 228.352 29.7216 222.854 31.5688 221.117C34.4703 218.396 38.4312 219.956 38.4312 219.956L40.406 232.133Z" fill="#FABE93"/>
                                                <path d="M534.734 406.661L12.3003 392.531C10.6783 392.488 9.39881 391.137 9.44249 389.514L13.6702 233.22C13.7138 231.598 15.0644 230.319 16.6864 230.363L539.121 244.492C540.743 244.536 542.022 245.887 541.979 247.509L538.107 401.532L537.917 403.828C537.873 405.451 536.357 406.705 534.734 406.661Z" fill="#4E4F51"/>
                                                <path d="M535.264 403.518L14.4281 389.432C12.8133 389.389 11.5394 388.044 11.5831 386.428L15.7415 232.689C15.7852 231.073 17.1299 229.8 18.7447 229.844L539.579 243.93C541.195 243.974 542.468 245.318 542.424 246.934L538.265 400.673C538.222 402.289 536.877 403.562 535.264 403.518Z" fill="#FBFCFC"/>
                                                <path d="M31.99 281.19L32.1738 274.392L79.6342 275.676L79.4503 282.474L59.5516 281.936L58.0237 338.418L50.3608 338.211L51.8887 281.728L31.99 281.19ZM89.749 339.276L91.4607 275.996L99.1236 276.203L98.3613 304.383L132.103 305.296L132.865 277.116L140.528 277.323L138.816 340.604L131.153 340.396L131.919 312.093L98.1774 311.181L97.4118 339.484L89.749 339.276ZM156.753 341.089L148.719 340.872L173.667 278.22L181.577 278.434L203.101 342.343L195.067 342.125L177.598 288.345L177.104 288.331L156.753 341.089ZM160.388 316.45L192.77 317.326L192.586 324.124L160.204 323.248L160.388 316.45ZM264.849 280.686L263.137 343.967L255.721 343.766L222.582 293.148L221.964 293.131L220.62 342.817L212.957 342.609L214.669 279.329L222.085 279.529L255.344 330.274L255.962 330.291L257.309 280.482L264.849 280.686ZM278.47 344.381L280.182 281.101L287.845 281.308L286.996 312.701L287.737 312.721L317.013 282.097L327.025 282.368L299.679 310.2L325.313 345.649L316.043 345.398L294.839 315.387L286.688 324.072L286.133 344.589L278.47 344.381Z" class="theme-color" fill="#E63946"/>
                                                <path d="M337.505 283.911L346.28 284.148L363.032 314.162L363.773 314.182L382.123 285.118L390.898 285.355L367.027 321.939L366.321 348.017L358.658 347.81L359.364 321.732L337.505 283.911ZM450.372 318.628C450.191 325.302 448.83 331.037 446.288 335.833C443.747 340.629 440.339 344.289 436.066 346.812C431.792 349.335 426.957 350.523 421.56 350.377C416.163 350.231 411.399 348.783 407.268 346.033C403.137 343.282 399.933 339.444 397.654 334.517C395.375 329.591 394.326 323.79 394.507 317.116C394.687 310.442 396.048 304.707 398.59 299.911C401.132 295.115 404.539 291.455 408.813 288.932C413.086 286.409 417.922 285.221 423.319 285.367C428.716 285.512 433.479 286.961 437.61 289.711C441.741 292.461 444.946 296.3 447.225 301.226C449.503 306.153 450.552 311.953 450.372 318.628ZM442.956 318.427C443.104 312.948 442.313 308.298 440.581 304.479C438.871 300.66 436.486 297.741 433.428 295.72C430.391 293.7 426.956 292.639 423.125 292.535C419.293 292.431 415.796 293.306 412.633 295.158C409.491 297.011 406.952 299.797 405.017 303.517C403.102 307.238 402.071 311.838 401.923 317.317C401.774 322.796 402.556 327.445 404.266 331.264C405.998 335.083 408.382 338.003 411.42 340.023C414.478 342.043 417.922 343.105 421.754 343.209C425.585 343.312 429.072 342.438 432.214 340.585C435.377 338.733 437.916 335.947 439.831 332.226C441.766 328.506 442.808 323.906 442.956 318.427ZM505.64 288.459L513.303 288.666L512.17 330.565C512.053 334.891 510.929 338.726 508.797 342.069C506.687 345.393 503.762 347.983 500.022 349.841C496.282 351.677 491.93 352.528 486.966 352.394C482.001 352.26 477.702 351.175 474.067 349.138C470.433 347.082 467.642 344.337 465.694 340.903C463.767 337.45 462.862 333.56 462.979 329.234L464.112 287.336L471.775 287.543L470.659 328.824C470.575 331.914 471.18 334.682 472.475 337.129C473.77 339.555 475.655 341.492 478.131 342.94C480.628 344.369 483.637 345.13 487.16 345.225C490.682 345.321 493.729 344.723 496.299 343.432C498.87 342.12 500.857 340.288 502.261 337.935C503.686 335.561 504.44 332.83 504.523 329.74L505.64 288.459Z" class="theme-color" fill="#E63946"/>
                                                <path d="M536.454 287.669L534.606 333.135L527.437 332.941L528.05 287.442L536.454 287.669ZM530.527 351.33C529.002 351.289 527.709 350.708 526.647 349.587C525.585 348.465 525.074 347.142 525.115 345.618C525.157 344.094 525.738 342.801 526.859 341.738C527.98 340.676 529.303 340.166 530.828 340.207C532.352 340.248 533.645 340.829 534.707 341.951C535.77 343.072 536.28 344.395 536.239 345.919C536.212 346.928 535.929 347.848 535.391 348.679C534.874 349.51 534.186 350.172 533.328 350.664C532.49 351.136 531.557 351.358 530.527 351.33Z" class="theme-color" fill="#E63946"/>
                                                <path d="M253.484 406.982C252.657 410.457 250.174 412.831 247.58 412.997C244.988 413.165 240.572 406.982 240.022 405.163C240.004 405.094 239.985 405.016 239.966 404.926C239.757 403.874 239.753 401.363 240.307 398.767C240.972 395.663 242.438 392.443 245.302 391.482C248.985 390.25 249.789 394.293 248.739 397.6C247.692 400.914 250.395 403.007 250.395 403.007L253.484 406.982Z" fill="#FABE93"/>
                                                <path d="M236.657 406.265C236.657 406.265 233.565 409.026 230.64 410.183C227.716 411.344 224.572 408.03 224.572 408.03C219.497 408.676 217.59 406.052 214.875 401.182C214.82 401.079 214.756 400.967 214.696 400.858C214.027 399.657 213.612 398.272 213.395 396.812C212.681 392.113 214.001 386.653 215.5 384.083C217.463 380.719 221.868 382.648 221.371 384.909C220.963 386.766 221.225 390.853 221.333 392.26C221.356 392.569 221.371 392.75 221.371 392.75L221.374 392.743C221.434 392.662 222.47 391.333 225.731 388.666C226.123 388.344 226.516 388.051 226.912 387.798C229.829 385.895 232.671 385.795 233.979 387.764C234.009 387.805 234.036 387.845 234.062 387.892C235.498 390.266 232.517 392.194 230.973 393.461C229.429 394.734 233.677 401.136 233.677 401.136L236.657 406.265Z" fill="#FABE93"/>
                                                <path d="M208.626 395.007C208.626 395.007 204.156 391.036 202.225 393.572C200.294 396.112 202.06 398.483 204.598 400.03C207.136 401.575 212.875 401.297 212.875 401.297C212.875 401.297 211.391 396.814 208.626 395.007Z" fill="#FABE93"/>
                                                <path d="M224.573 408.029C224.573 408.029 223.592 406.691 221.154 401.069C219.169 396.489 221.335 392.259 221.335 392.259C221.358 392.567 221.372 392.748 221.372 392.748C221.372 392.748 219.775 396.82 221.925 401.565C224.079 406.31 224.573 408.029 224.573 408.029Z" fill="#D7A17B"/>
                                                <path d="M230.668 394.006C230.693 393.884 230.732 393.778 230.786 393.681C230.903 393.547 230.972 393.46 230.972 393.46C230.868 393.663 230.767 393.844 230.668 394.006Z" fill="#D5D5D3"/>
                                                <path d="M229.116 395.297C228.927 395.297 228.82 395.228 228.82 395.228C229.459 395.144 230.394 394.136 230.788 393.681C230.733 393.778 230.694 393.884 230.669 394.005C229.999 395.094 229.438 395.297 229.116 395.297Z" fill="#D7A17B"/>
                                                <path d="M218.521 388.035C217.607 388.035 216.432 387.564 215.697 387.221C215.27 387.021 215.048 386.541 215.178 386.088C215.384 385.368 215.834 384.488 216.662 383.549C217.114 383.037 217.682 382.85 218.246 382.85C219.397 382.85 220.533 383.617 220.639 383.939C220.855 384.603 220.618 386.659 219.51 387.714C219.27 387.945 218.921 388.035 218.521 388.035Z" fill="#FDE6D6"/>
                                                <path d="M245.832 396.951C244.974 396.951 243.871 396.511 243.182 396.19C242.781 396.003 242.573 395.55 242.695 395.126C242.888 394.452 243.311 393.625 244.088 392.743C244.511 392.262 245.044 392.09 245.574 392.09C246.653 392.09 247.72 392.808 247.818 393.111C248.022 393.732 247.799 395.663 246.76 396.652C246.534 396.867 246.206 396.951 245.832 396.951Z" fill="#FDE6D6"/>
                                                <path d="M229.564 390.25C227.899 390.25 226.914 387.798 226.914 387.798C228.397 386.828 229.86 386.328 231.113 386.328C232.324 386.328 233.338 386.796 233.981 387.763C233.491 389.735 231.296 390.125 229.692 390.247C229.649 390.25 229.606 390.25 229.564 390.25Z" fill="#FDE6D6"/>
                                                <path d="M332.279 411.998C332.279 411.998 329.655 416.226 326.457 416.07C325.025 415.998 323.883 416.584 322.704 417.171C321.244 417.895 319.731 418.619 317.538 418.107C315.9 417.726 315.12 418.353 314.365 418.984C313.295 419.876 312.265 420.765 308.886 418.775C303.124 415.38 302.204 417.04 299.867 412.844C297.53 408.648 303.817 389.745 306.313 388.437C308.808 387.133 310.125 389.489 310.125 389.489C310.125 389.489 311.744 385.589 315.089 388.69C315.089 388.69 314.43 382.971 317.491 382.347C320.551 381.723 322.015 387.795 322.015 387.795C322.015 387.795 325.219 385.046 328.108 390.83C330.997 396.614 330.26 400.427 332.142 402.907C334.026 405.387 332.279 411.998 332.279 411.998Z" fill="#FABE93"/>
                                                <path d="M307.664 411.967C307.305 411.967 305.989 407.721 310.126 389.488C310.126 389.488 306.968 409.377 307.648 411.299C307.786 411.689 307.758 411.967 307.664 411.967Z" fill="#D7A17B"/>
                                                <path d="M315.926 408.385C315.589 408.385 315.623 397.362 315.957 393.391C316.307 389.238 315.09 388.689 315.09 388.689C315.09 388.689 316.906 388.936 316.506 393.263C316.107 397.59 316.363 407.202 315.973 408.313C315.957 408.36 315.942 408.385 315.926 408.385Z" fill="#D7A17B"/>
                                                <path d="M324.686 408.008C324.346 408.008 323.941 405.665 323.934 403.468C323.925 400.854 322.016 387.794 322.016 387.794C322.565 388.412 325.22 406.591 324.867 407.743C324.811 407.927 324.749 408.008 324.686 408.008Z" fill="#D7A17B"/>
                                                <path d="M317.141 388.045C316.717 388.045 316.386 387.954 316.274 387.705C315.8 386.66 315.447 383.796 316.811 383.384C317.285 383.24 317.725 383.137 318.13 383.137C318.879 383.137 319.509 383.49 320.033 384.582C320.477 385.512 320.608 386.026 320.629 386.497C320.645 386.9 320.395 387.265 320.018 387.402C319.363 387.639 318.037 388.045 317.141 388.045Z" fill="#FDE6D6"/>
                                                <path d="M313.135 392.412C312.128 392.412 310.933 392.287 310.845 391.754C310.68 390.737 311.054 388.172 312.33 388.138C312.412 388.135 312.496 388.135 312.574 388.135C313.725 388.135 314.555 388.4 314.836 389.935C315.001 390.843 314.995 391.32 314.898 391.732C314.82 392.085 314.517 392.34 314.156 392.372C313.897 392.393 313.532 392.412 313.135 392.412Z" fill="#FDE6D6"/>
                                                <path d="M308.247 392.037C308.197 392.037 308.147 392.031 308.097 392.022C307.401 391.856 305.717 391.354 305.804 390.777C305.916 390.044 306.69 388.437 307.557 388.437C307.623 388.437 307.692 388.446 307.757 388.468C308.705 388.746 309.348 389.104 309.177 390.387C309.083 391.095 308.964 391.444 308.796 391.728C308.677 391.925 308.468 392.037 308.247 392.037Z" fill="#FDE6D6"/>
                                                <path d="M323.903 391.551C323.725 391.551 323.582 391.507 323.504 391.395C323.001 390.69 322.331 388.621 323.279 388.122C323.719 387.891 324.121 387.723 324.511 387.723C324.958 387.723 325.388 387.944 325.834 388.546C326.296 389.17 326.468 389.532 326.549 389.875C326.617 390.172 326.486 390.478 326.224 390.634C325.706 390.946 324.555 391.551 323.903 391.551Z" fill="#FDE6D6"/>
                                                <path d="M327.835 402.779C327.289 402.779 326.702 402.67 326.109 402.38C326.109 402.38 326.649 402.558 327.535 402.558C328.346 402.558 329.454 402.408 330.705 401.84C330.705 401.84 329.444 402.779 327.835 402.779Z" fill="#D7A17B"/>
                                                <path d="M319.626 404.535C318.839 404.535 317.969 404.354 317.133 403.805C317.133 403.805 318.109 404.27 319.704 404.27C320.459 404.27 321.351 404.167 322.346 403.858C322.346 403.858 321.145 404.535 319.626 404.535Z" fill="#D7A17B"/>
                                                <path d="M310.958 408.098C310.172 408.098 309.302 407.917 308.469 407.368C308.469 407.368 309.445 407.829 311.036 407.829C311.791 407.829 312.684 407.726 313.679 407.421C313.679 407.421 312.478 408.098 310.958 408.098Z" fill="#D7A17B"/>
                                                <path d="M303.858 405.365C302.99 405.365 301.93 405.15 301.031 404.323C301.031 404.323 302.273 405.181 304.398 405.181C304.753 405.181 305.137 405.156 305.543 405.1C305.543 405.1 304.819 405.365 303.858 405.365Z" fill="#D7A17B"/>
                                                <path d="M31.5738 221.121C31.5738 221.121 34.7879 215.945 38.7036 216.136C40.4556 216.22 41.854 215.502 43.2991 214.785C45.0836 213.899 46.9399 213.013 49.6223 213.64C51.6302 214.108 52.5821 213.337 53.5078 212.566C54.8196 211.475 56.0779 210.386 60.2148 212.822C67.2696 216.981 68.3981 214.947 71.2577 220.085C74.1176 225.224 66.4217 248.366 63.3667 249.967C60.3118 251.564 58.6973 248.678 58.6973 248.678C58.6973 248.678 56.7168 253.455 52.6217 249.658C52.6217 249.658 53.4285 256.659 49.681 257.423C45.9338 258.188 44.1408 250.756 44.1408 250.756C44.1408 250.756 40.2179 254.119 36.6825 247.037C33.1468 239.955 34.0485 235.288 31.7423 232.253C29.4364 229.214 31.5738 221.121 31.5738 221.121Z" fill="#FABE93"/>
                                                <path d="M58.6953 248.678C58.6953 248.678 62.5645 224.327 61.7309 221.975C61.5615 221.495 61.598 221.158 61.7103 221.158C62.1515 221.158 63.761 226.355 58.6953 248.678Z" fill="#D7A17B"/>
                                                <path d="M52.6205 249.658C52.6205 249.658 50.3973 249.356 50.8868 244.055C51.3766 238.758 51.0621 226.99 51.5382 225.632C51.5591 225.573 51.5794 225.542 51.5985 225.542C52.0106 225.542 51.9657 239.038 51.5585 243.899C51.1327 248.984 52.6205 249.658 52.6205 249.658Z" fill="#D7A17B"/>
                                                <path d="M44.1383 250.756C43.4676 249.998 40.2164 227.738 40.6488 226.331C40.7171 226.106 40.7923 226.006 40.8703 226.006C41.285 226.006 41.781 228.873 41.7904 231.563C41.8013 234.764 44.1383 250.756 44.1383 250.756Z" fill="#D7A17B"/>
                                                <path d="M48.8962 256.457C47.9765 256.457 47.2053 256.027 46.5657 254.688C46.0226 253.549 45.8606 252.919 45.8369 252.345C45.8163 251.849 46.1211 251.406 46.5857 251.238C47.3878 250.944 49.0092 250.448 50.1048 250.448C50.6274 250.448 51.0302 250.561 51.1678 250.863C51.7506 252.145 52.1795 255.652 50.5123 256.154C49.9289 256.332 49.391 256.457 48.8962 256.457Z" fill="#FDE6D6"/>
                                                <path d="M55.6972 250.338C54.2907 250.338 53.2715 250.013 52.9292 248.132C52.7271 247.018 52.7355 246.435 52.8509 245.933C52.9498 245.499 53.3183 245.187 53.7601 245.15C54.0773 245.125 54.526 245.1 55.0095 245.1C56.2434 245.1 57.7069 245.253 57.8133 245.908C58.0155 247.153 57.5594 250.291 55.9982 250.332C55.8962 250.335 55.7957 250.338 55.6972 250.338Z" fill="#FDE6D6"/>
                                                <path d="M61.8397 249.967C61.7586 249.967 61.6772 249.954 61.5951 249.929C60.4345 249.589 59.6487 249.146 59.858 247.577C59.9737 246.71 60.1191 246.282 60.3241 245.939C60.4679 245.696 60.7253 245.558 60.9974 245.558C61.0579 245.558 61.1193 245.565 61.1802 245.577C62.0322 245.78 64.0938 246.395 63.9858 247.103C63.8489 247.998 62.9039 249.967 61.8397 249.967Z" fill="#FDE6D6"/>
                                                <path d="M41.0823 250.84C40.5351 250.84 40.0107 250.568 39.4644 249.832C38.8997 249.071 38.6894 248.628 38.5893 248.204C38.5035 247.842 38.6645 247.47 38.9839 247.277C39.6216 246.896 41.0308 246.154 41.827 246.154C42.0467 246.154 42.2198 246.21 42.3168 246.344C42.9311 247.208 43.7516 249.739 42.5917 250.35C42.052 250.634 41.5584 250.84 41.0823 250.84Z" fill="#FDE6D6"/>
                                                <path d="M33.5039 233.559C33.5039 233.559 35.0445 232.407 37.0159 232.407C37.6848 232.407 38.403 232.538 39.128 232.894C39.128 232.894 38.4688 232.679 37.3847 232.679C36.3894 232.679 35.0357 232.86 33.5039 233.559Z" fill="#D7A17B"/>
                                                <path d="M50.1102 231.15C50.1102 231.15 48.9153 230.579 46.9642 230.579C46.0401 230.579 44.9469 230.707 43.7305 231.085C43.7305 231.085 45.2002 230.255 47.0606 230.255C48.0224 230.255 49.0888 230.477 50.1102 231.15Z" fill="#D7A17B"/>
                                                <path d="M60.7277 226.789C60.7277 226.789 59.5325 226.221 57.5814 226.221C56.6573 226.221 55.5644 226.349 54.3477 226.724C54.3477 226.724 55.8177 225.894 57.6778 225.894C58.6399 225.894 59.706 226.115 60.7277 226.789Z" fill="#D7A17B"/>
                                                <path d="M69.8341 230.518C69.8341 230.518 68.3126 229.466 65.7135 229.466C65.2751 229.466 64.8062 229.497 64.3086 229.566C64.3086 229.566 65.194 229.238 66.3711 229.238C67.4331 229.238 68.7325 229.504 69.8341 230.518Z" fill="#D7A17B"/>
                                                <path d="M0 553.592H551.868L551.865 554.64C551.862 555.392 551.253 556 550.501 556H1.20363C0.538797 556 0 555.46 0 554.796V553.592Z" fill="#161413"/>
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
