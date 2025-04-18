@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme19">
@else
<div class="{{ $business->theme_color }}" id="view_theme19">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
          <div class="photography-card">
            <section class="profile-sec pb">
                <div class="profile-banner-wrp">
                    <div class="profile-banner img-wrapper">
                        <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme19/images/profile-banner-img.png') }}" class="profile-banner-image" alt="profile-banner" id="banner_preview"
                        loading="lazy">
                    </div>
                </div>
                <div class="container">
                    <div class="client-info-wrp">
                        <div class="section-title text-center">
                            <h2 id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</h2>
                        </div>
                        <div class="client-image">
                            <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme19/images/client-image.png') }}"   alt="client-image" loading="lazy">
                        </div>
                        <div class="client-info text-center">
                            <h3 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h3>
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
                                                <img src="{{ asset('custom/theme19/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                     <div class="slider-wrapper">
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
                                                         class="btn btn-white">{{ $content->link_title }}</a>
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
                                                     class="btn btn-white">{{ $content->link_title }}</a>
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
                         <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                            <div class="slick-prev slick-arrow service-arrow">
                                <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                        fill="#8B4513" />
                                </svg>
                            </div>
                            <div class="slick-next slick-arrow service-arrow">
                                <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                        fill="#8B4513" />
                                </svg>
                            </div>
                        </div>
                         @endif
                     </div>
                 </div>
               </section>
              @endif
              @if ($order_key == 'bussiness_hour')
              <section class="business-hour-sec pb" id="business-hours-div">
                <div class="section-title common-title">
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
              </section>
              @endif
                @if ($order_key == 'gallery')
                <section class="gallery-sec pb" id="gallery-div">
                    <div class="section-title common-title">
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
                        <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                            <div class="slick-prev slick-arrow gallery-arrow">
                                <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                        fill="#8B4513" />
                                </svg>
                            </div>
                            <div class="slick-next slick-arrow gallery-arrow">
                                <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                        fill="#8B4513" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
                 @if ($order_key == 'contact_info')
                 <section class="contact-info-sec pb" id="contact-div">
                    <div class="section-title common-title">
                        <h2>{{__('Contact')}}</h2>
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
                                                        <img src="{{ asset('custom/theme19/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                            <img src="{{ asset('custom/theme19/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                        </div>
                                                            <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                    @else
                                                        <div class="contact-image">
                                                            <img src="{{ asset('custom/theme19/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                 @if(($order_key == 'product'))
                 <section class="product-sec pb" id="product-div">
                    <div class="section-title common-title">
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
                                                    <ins
                                                    id="{{ 'product_currency_select' . $product_row_nos . '_preview' }}">{{ $content->currency }}</ins>
                                                    <ins
                                                        id="{{ 'product_price_' . $product_row_nos . '_preview' }}">{{ $content->price }}</ins>
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
                                <div class="product-card " id="product_{{ $product_row_nos }}">
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
                                                    <ins
                                                    id="{{ 'product_currency_select' . $product_row_nos . '_preview' }}">{{ $content->currency }}</ins>
                                                    <ins
                                                        id="{{ 'product_price_' . $product_row_nos . '_preview' }}">{{ $content->price }}</ins>
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
                            <div class="slick-prev slick-arrow product-sec-arrow">
                                <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                        fill="#8B4513" />
                                </svg>
                            </div>
                            <div class="slick-next slick-arrow product-sec-arrow">
                                <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                        fill="#8B4513" />
                                </svg>
                            </div>
                        </div>
                        @endif
                    </div>
                 </section>
                 @endif
                 @if ($order_key == 'appointment')
                 <section class="appointment-sec pb" id="appointment-div">
                    <div class="section-title common-title">
                        <h2>{{ __('Appointment') }}</h2>
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
                    <div class="section-title common-title">
                        <h2>{{__('More')}}</h2>
                    </div>
                    <div class="container">
                        <ul class="d-flex justify-content-between">
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
                 <section class="testimonial-sec pb" id="testimonials-div">
                    <div class="section-title common-title">
                        <h2>{{__('Testimonial')}}</h2>
                    </div>
                    <div class="container">
                        @if(isset($is_pdf))
                            @php
                            $t_image_count = 0;
                            $rating = 0;
                             @endphp
                            @foreach ($testimonials_content as $k2 => $testi_content)
                                <div class="testimonial-card edit-card"  id="testimonials_{{ $testimonials_row_nos }}">
                                    <div class="testimonial-card-inner">
                                        <div class="testimonial-content">
                                            <div class="rating d-flex align-items-center ">
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
                                            <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">{{ $testi_content->description }} </p>
                                            <div class="testimonial-content-info d-flex align-items-center">
                                                <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="testimonial-image-wrp">
                                            <div class="testimonial-image img-wrapper">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
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
                                    <div class="testimonial-card"  id="testimonials_{{ $testimonials_row_nos }}">
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-content">
                                                <div class="rating d-flex align-items-center ">
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
                                                <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">{{ $testi_content->description }} </p>
                                                <div class="testimonial-content-info d-flex align-items-center">
                                                    <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                    {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="testimonial-image-wrp">
                                                <div class="testimonial-image img-wrapper">
                                                    <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
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
                            <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                <div class="slick-prev slick-arrow testimonial-arrow">
                                    <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                            fill="#8B4513" />
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow testimonial-arrow">
                                    <svg width="32" height="12" viewBox="0 0 32 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z"
                                            fill="#8B4513" />
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
                        <h2>{{__('Payment')}}</h2>
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
                        <h2>{{__('Download Here')}}</h2>
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
                        @if(empty($business->svg_text))
                        <svg width="562" height="562" viewBox="0 0 562 562" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M99.6847 293.993C-0.449053 351.804 -0.446806 445.537 99.6903 503.35C199.827 561.163 362.178 561.163 462.312 503.35C562.446 445.537 562.443 351.804 462.306 293.993C362.169 236.18 199.819 236.18 99.6847 293.993Z"
                                fill="#F5F5F5" />
                            <path
                                d="M345.887 62.3113C347.044 61.7876 348.421 61.7381 349.414 61.6606C350.556 61.5706 350.918 61.3436 351.137 61.0974C353.915 57.123 358.505 56.9712 361.245 58.1098C361.918 55.3751 365.226 53.0013 368.868 53.8015C368.744 50.2486 373.28 46.4303 377.357 45.5626C381.266 44.7309 384.674 45.0804 386.905 47.651C389.293 42.9875 398.653 41.6736 403.718 44.1408C406.631 45.5593 409.102 47.0148 410.31 49.6843C411.107 51.4468 411.393 52.6191 411.407 54.9907C413.381 53.2508 417.334 52.7798 419.97 53.8004C422.813 54.8997 423.028 57.042 423.169 59.2215C425.955 58.519 427.82 58.9731 428.344 59.1282C430.134 59.6587 431.167 61.0648 430.921 62.2012C432.337 62.1225 435.714 63.2679 435.325 64.7639C434.889 66.4432 431.035 66.2734 429.595 66.2206C428.403 66.1768 426.859 65.8576 425.564 65.5878C425.171 65.7823 424.125 65.9913 423.468 65.9857C421.013 65.9677 419.974 64.9168 419.58 64.003C418.382 66.5252 414.118 68.4473 411.105 69.2183C405.43 70.6717 397.399 69.7859 393.904 65.544C393.538 66.3072 392.925 67.0175 392.214 67.6031C390.827 68.7451 388.954 69.5443 386.963 69.7309C384.633 69.9489 378.376 70.2479 376.614 66.5421C375.366 69.0059 369.798 70.1288 365.563 69.5274C363.979 69.3026 362.201 68.753 360.821 68.0966C359.708 67.5672 359.076 67.0513 358.095 66.4623C357.261 65.9621 356.884 65.9677 355.77 66.3027C352.864 67.1783 349.491 67.5368 346.524 66.2926C344.161 65.2989 343.667 63.3173 345.887 62.3113Z"
                                fill="#F5F5F5" />
                            <path
                                d="M299.472 95.511C300.34 95.1176 301.372 95.0817 302.117 95.0232C302.973 94.9558 303.244 94.7861 303.409 94.6006C305.492 91.6197 308.935 91.5062 310.99 92.3605C311.493 90.3092 313.974 88.5299 316.706 89.129C316.613 86.4651 320.015 83.6011 323.073 82.9503C326.004 82.3265 328.56 82.5884 330.233 84.5161C332.023 81.0193 339.042 80.0335 342.84 81.8837C345.024 82.947 346.878 84.0395 347.784 86.0413C348.382 87.362 348.595 88.2421 348.607 90.0203C350.087 88.7153 353.051 88.3624 355.028 89.1278C357.159 89.9528 357.321 91.559 357.427 93.1933C359.516 92.6662 360.914 93.0079 361.307 93.1237C362.65 93.5215 363.423 94.5759 363.24 95.4279C364.302 95.3683 366.833 96.2281 366.543 97.3499C366.216 98.6088 363.325 98.4818 362.246 98.4424C361.353 98.4098 360.195 98.1704 359.224 97.9681C358.928 98.1142 358.145 98.2705 357.653 98.2671C355.811 98.2536 355.033 97.4657 354.737 96.78C353.839 98.6717 350.641 100.113 348.382 100.692C344.126 101.781 338.104 101.118 335.483 97.9366C335.209 98.5087 334.748 99.0415 334.215 99.481C333.174 100.337 331.77 100.937 330.278 101.077C328.53 101.24 323.839 101.465 322.517 98.6852C321.582 100.533 317.407 101.375 314.23 100.924C313.042 100.756 311.709 100.343 310.675 99.8508C309.841 99.454 309.367 99.0662 308.63 98.6256C308.004 98.2502 307.722 98.2547 306.887 98.5065C304.708 99.1629 302.179 99.4315 299.953 98.4986C298.177 97.7523 297.806 96.2664 299.472 95.511Z"
                                fill="#F5F5F5" />
                            <path
                                d="M139.872 523.376C188.103 523.376 227.201 500.802 227.201 472.956C227.201 445.111 188.103 422.537 139.872 422.537C91.6416 422.537 52.543 445.111 52.543 472.956C52.543 500.802 91.6416 523.376 139.872 523.376Z"
                                fill="#E0E0E0" />
                            <path
                                d="M483.806 423.629L470.9 424.953L479.025 420.587C479.46 416.188 479.86 410.278 474.515 408.975C472.672 408.526 470.74 408.707 468.851 408.891C471.439 405.697 473.994 402.475 476.517 399.23C476.912 398.723 477.322 398.171 477.349 397.53C477.386 396.645 476.695 395.918 476.051 395.31C473.424 392.834 471.232 388.596 467.804 387.117C464.156 385.543 458.282 387.872 455.277 389.914C455.947 388.005 456.617 386.096 457.288 384.187C452.976 382.053 448.179 380.908 443.368 380.864C442.961 380.861 442.532 380.858 442.181 380.652C441.654 380.341 441.475 379.683 441.254 379.113C439.965 375.785 435.897 374.02 432.541 374.123C424.788 374.364 417.763 379.211 413.029 385.353C409.606 389.793 407.185 394.892 405.083 400.06C402.947 405.313 400.462 410.254 397.946 415.348C393.841 423.66 389.072 432.827 379.774 436.127C377.857 436.808 373.128 438.173 371.148 438.625C364.193 440.211 360.571 441.375 353.657 443.053C341.181 446.082 331.374 449.702 320.255 453.35C316.947 454.434 295.693 463.554 290.657 466.008C287.528 467.533 284.977 468.312 283.848 471.606C293.814 467.3 306.458 461.436 321.806 456.077C323.69 456.437 325.72 457.262 327.001 457.71C334.045 460.173 339.917 465.069 346.635 468.239C355.422 472.386 365.776 474.92 375.471 474.286C385.165 473.651 395.49 471.571 403.314 466.461C395.452 465.842 388.773 460.795 381.792 457.126C368.715 450.253 353.964 448.551 339.564 450.557C343.454 449.496 347.466 448.492 351.632 447.581C360.027 445.746 368.502 444.25 377.05 443.354C382.715 442.76 388.392 442.059 394.099 442.098C399.586 442.136 404.734 443.651 410.002 445.051C416.081 446.668 422.463 446.371 428.633 447.394C435.068 448.46 441.609 448.968 448.132 448.862C464.682 448.59 473.25 446.004 478.864 438.88C484.477 431.754 483.806 423.629 483.806 423.629Z"
                                fill="#E0E0E0" />
                            <path
                                d="M207.399 474.654L501.838 304.659C503.905 303.466 503.905 301.531 501.838 300.338L491.034 294.143C488.967 292.95 485.617 292.95 483.55 294.143L189.109 464.139C187.042 465.332 187.042 467.267 189.109 468.461L199.914 474.654C201.981 475.848 205.332 475.848 207.399 474.654Z"
                                fill="#E0E0E0" />
                            <path
                                d="M174.279 411.852C173.347 423.496 172.745 432.137 172.916 434.135C173.535 441.38 177.299 445.866 180.206 448.845C186.295 455.083 190.611 457.561 198.179 462.943C197.174 465.823 181.601 466.112 177.124 464.052C169.972 460.761 160.722 455.29 158.266 453.56C152.048 449.176 150.551 446.473 150.279 439.569C150.24 438.709 149.611 433.093 149.667 432.71C149.581 431.092 148.606 422.346 147.344 411.578L174.279 411.852Z"
                                fill="#C8856A" />
                            <path
                                d="M82.6654 434.875L82.0742 407.451L111.466 410.216L105.22 436.473C105.22 436.473 102.132 473.604 100.68 479.637C95.9893 499.104 80.1938 491.248 78.3144 480.932C77.0657 474.066 82.6654 434.875 82.6654 434.875Z"
                                fill="#C8856A" />
                            <path
                                d="M210.59 473.906C210.992 473.932 211.311 478.429 209.001 480.18C206.333 482.201 198.69 485.307 188.981 483.394C179.272 481.481 174.168 478.092 170.464 474.542C166.76 470.993 161.57 465.989 157.205 464.717C153.149 463.537 146.605 460.77 145.371 459.406C144.137 458.043 144.69 452.377 144.69 452.377L210.59 473.906Z"
                                fill="#263238" />
                            <path
                                d="M149.668 432.709C149.668 432.709 148.306 433.24 147.968 434.537C147.565 436.081 147.421 438.085 146.606 440.611C145.475 444.122 144.397 451.398 144.747 454.344C145.096 457.289 153.871 460.35 158.051 462.27C162.32 464.232 167.159 468.014 171.365 471.986C175.718 476.097 185.15 480.553 191.525 481.065C201.259 481.846 207.74 479.605 209.917 476.217C212.61 472.024 211.704 467.434 200.848 461.491C198.792 460.366 191.634 455.454 189.202 453.684C186.63 451.814 184.184 449.761 181.953 447.491C180.825 446.342 179.753 445.137 178.757 443.87C177.88 442.756 176.631 441.395 176.157 440.049C176.049 439.743 175.984 439.39 175.89 439.075C175.622 438.164 175.451 437.33 175.332 436.392C175.212 435.446 175.188 434.076 174.338 433.458C173.364 432.747 159.404 434.68 158.325 436.17C157.5 437.312 157.287 438.809 157.138 440.182C157.067 440.837 157.038 441.499 156.989 442.155C156.969 442.435 157.054 442.947 156.671 442.805C156.306 442.67 155.954 441.661 155.835 441.318C155.572 440.562 155.425 439.763 155.131 439.018C154.796 438.166 154.546 437.175 153.893 436.546C152.131 434.852 150.309 435.04 149.807 434.468C149.81 434.47 149.69 433.27 149.668 432.709Z"
                                fill="#37474F" />
                            <path
                                d="M201.439 461.822C187.27 461.875 182.597 472.924 181.645 478.298C185.059 479.77 188.609 480.834 191.523 481.067C201.257 481.849 208.139 479.638 210.316 476.249C212.856 472.293 211.191 466.288 201.439 461.822Z"
                                fill="#FAFAFA" />
                            <path
                                d="M180.622 463.174C180.468 463.164 180.317 463.103 180.196 462.989C179.917 462.728 179.902 462.289 180.162 462.01C182.282 459.723 188.974 454.953 194.064 455.849C194.44 455.914 194.692 456.274 194.626 456.65C194.56 457.027 194.212 457.28 193.826 457.215C189.074 456.392 182.852 461.142 181.17 462.955C181.025 463.113 180.822 463.186 180.622 463.174Z"
                                fill="#F5F5F5" />
                            <path
                                d="M174.778 459.223C174.624 459.213 174.473 459.152 174.352 459.039C174.073 458.778 174.059 458.34 174.318 458.059C176.44 455.77 183.135 450.992 188.22 451.898C188.596 451.963 188.848 452.324 188.782 452.699C188.718 453.075 188.375 453.329 187.984 453.264C183.233 452.434 177.009 457.191 175.329 459.004C175.181 459.162 174.978 459.237 174.778 459.223Z"
                                fill="#F5F5F5" />
                            <path
                                d="M169.411 454.795C169.257 454.785 169.107 454.724 168.985 454.61C168.705 454.349 168.692 453.91 168.951 453.629C171.072 451.341 177.787 446.57 182.853 447.469C183.23 447.534 183.481 447.895 183.415 448.27C183.35 448.647 183.006 448.897 182.616 448.834C177.87 448.011 171.641 452.762 169.96 454.576C169.815 454.734 169.611 454.809 169.411 454.795Z"
                                fill="#F5F5F5" />
                            <path
                                d="M164.161 450.374C164.012 450.363 163.864 450.305 163.743 450.195C163.459 449.939 163.439 449.5 163.695 449.217C166.619 445.968 173.692 442.166 178.776 443.063C179.152 443.128 179.404 443.489 179.337 443.865C179.273 444.241 178.926 444.484 178.539 444.429C173.96 443.624 167.313 447.267 164.718 450.147C164.571 450.311 164.364 450.387 164.161 450.374Z"
                                fill="#F5F5F5" />
                            <path
                                d="M102.936 481.594C102.493 488.047 101.449 492.316 99.1266 496.078C96.8044 499.839 92.4883 500.98 88.1406 499.823C83.793 498.665 78.2416 495.638 77.0513 490.054C75.861 484.47 75.1731 480.645 76.2262 474.668L102.936 481.594Z"
                                fill="#263238" />
                            <path
                                d="M82.6655 434.875C80.8683 434.666 81.2538 443.56 80.1264 452.229C78.9181 461.521 77.5435 465.196 76.4712 472.814C75.246 481.517 76.6409 485.428 79.6262 490.732C82.6105 496.036 93.3233 501.327 98.7084 493.839C103.099 487.734 103.351 480.911 103.048 472.204C102.736 463.203 103.673 457.172 104.473 450.38C105.303 443.355 106.771 437.218 105.219 436.474C105.088 437.432 104.055 442.141 103.625 443.243C103.437 443.726 102.729 444.929 102.472 443.107C102.395 442.566 102.574 441.321 102.533 440.784C102.421 439.275 101.513 439.017 100.925 438.679C99.6559 437.952 96.7987 436.964 93.2896 436.907C89.7805 436.85 86.7479 436.698 84.7809 437.682C83.5973 438.275 83.6164 439.4 83.4771 440.499C83.3096 441.809 83.2804 442.62 82.9645 442.354C82.3283 441.819 82.6655 434.875 82.6655 434.875Z"
                                fill="#37474F" />
                            <path
                                d="M75.9186 477.86C75.5522 483.268 76.8009 486.99 79.1377 491.142C82.1231 496.447 93.7014 501.764 99.0876 494.276C101.767 490.55 102.523 486.118 102.933 481.593C99.8137 475.738 80.9867 472.964 75.9186 477.86Z"
                                fill="#FAFAFA" />
                            <path
                                d="M99.1136 472.07C99.0383 472.061 98.9653 472.04 98.8933 472.005C98.8214 471.971 90.5476 468.427 82.4391 470.215C82.0805 470.288 81.7265 470.065 81.6444 469.705C81.5657 469.344 81.7939 468.986 82.1536 468.908C90.7308 467.021 99.1676 470.651 99.4823 470.804C99.8116 470.968 99.9476 471.368 99.7869 471.7C99.6599 471.961 99.3856 472.1 99.1136 472.07Z"
                                fill="#F5F5F5" />
                            <path
                                d="M82.9097 463.725C82.6591 463.697 82.4331 463.525 82.3488 463.269C82.2364 462.916 82.4253 462.538 82.7748 462.423C90.8553 459.774 99.7484 463.986 100.083 464.167C100.408 464.341 100.53 464.745 100.354 465.071C100.179 465.395 99.7697 465.51 99.4527 465.342C99.3774 465.303 90.7103 461.221 83.1918 463.695C83.0985 463.728 83.003 463.736 82.9097 463.725Z"
                                fill="#F5F5F5" />
                            <path
                                d="M83.2562 457.602C83.0089 457.574 82.7886 457.407 82.701 457.157C82.5807 456.805 82.7639 456.425 83.1112 456.305C92.0009 453.218 100.435 457.805 100.748 458.001C101.06 458.197 101.157 458.609 100.961 458.922C100.767 459.235 100.349 459.333 100.044 459.135C99.9746 459.09 91.8222 454.698 83.5485 457.567C83.4518 457.603 83.3518 457.613 83.2562 457.602Z"
                                fill="#F5F5F5" />
                            <path
                                d="M83.7602 451.577C83.5174 451.55 83.2971 451.387 83.2083 451.141C83.0824 450.793 83.2611 450.41 83.6062 450.284C91.9384 447.256 101.02 451.963 101.361 452.169C101.678 452.355 101.782 452.766 101.596 453.084C101.411 453.403 101.003 453.514 100.684 453.319C100.606 453.273 91.7979 448.729 84.0614 451.541C83.9603 451.577 83.8591 451.588 83.7602 451.577Z"
                                fill="#EBEBEB" />
                            <path
                                d="M93.945 214.521C92.1062 232.748 91.4812 237.237 90.2032 277.739C88.9646 317.015 88.9511 322.769 88.7331 327.504C88.2318 338.364 82.0273 342.707 81.5316 368.303C81.0786 391.761 81.8935 420.489 81.8935 420.489C81.8935 420.489 86.1748 424.448 95.0837 424.931C103.302 425.378 109.108 422.145 109.108 422.145C109.108 422.145 121.03 369.569 124.774 353.407C129.182 334.381 136.336 301.264 136.336 301.264C136.336 301.264 139.93 330.81 141.279 340.327C142.565 349.409 139.455 352.949 141.407 373.29C142.963 389.5 147.587 416.605 147.587 416.605C147.587 416.605 153.899 420.129 160.906 419.804C171.098 419.331 174.314 415.836 174.314 415.836C174.314 415.836 180.022 355.204 180.076 332.008C180.133 307.46 178.629 247.67 176.008 211.637L93.945 214.521Z"
                                fill="#455A64" />
                            <path
                                d="M136.336 301.264L141.564 260.468C141.564 260.468 154.806 256.449 163.068 247.135C162.668 253.874 151.083 262.911 145.564 264.449L139.4 300.653L141.279 340.327L136.336 301.264Z"
                                fill="#37474F" />
                            <path
                                d="M117.937 219.959C115.959 223.36 114.514 227.048 113.301 230.781C112.077 234.517 111.151 238.338 110.359 242.178C109.612 246.029 109.017 249.906 108.651 253.809C108.274 257.707 108.068 261.637 108.292 265.566C109.089 261.719 109.823 257.904 110.553 254.085C111.301 250.272 111.993 246.456 112.773 242.662C113.507 238.858 114.317 235.075 115.146 231.291C115.997 227.511 116.903 223.749 117.937 219.959Z"
                                fill="#37474F" />
                            <path
                                d="M112.886 221.559C110.979 223.43 109.323 225.513 107.815 227.695C106.293 229.871 104.966 232.176 103.757 234.544C102.589 236.934 101.541 239.389 100.757 241.942C99.9615 244.485 99.3737 247.115 99.2422 249.793L102.547 242.645C103.67 240.302 104.781 237.962 105.958 235.651C107.094 233.319 108.298 231.018 109.459 228.681C110.634 226.349 111.816 224.011 112.886 221.559Z"
                                fill="#37474F" />
                            <path
                                d="M121.027 266.633C119.772 278.846 118.686 291.071 117.59 303.282C116.451 315.487 114.013 329.009 112.209 341.098C110.345 353.174 101.748 400.728 100.324 412.919C102.695 400.869 112.721 353.626 114.644 341.46C116.413 329.269 118.75 315.685 119.499 303.43C120.273 291.173 120.721 278.908 121.027 266.633Z"
                                fill="#37474F" />
                            <path
                                d="M166.707 266.105L167.977 298.139C168.15 303.476 168.371 308.81 168.492 314.143C168.614 319.467 168.808 324.822 168.601 330.081C168.373 335.362 166.886 386.435 167.36 397.143C168.88 385.264 170.457 340.929 171.06 330.178C171.272 319.365 170.601 308.724 169.889 298.037C169.145 287.365 168.109 276.712 166.707 266.105Z"
                                fill="#37474F" />
                            <path
                                d="M146.387 410.364L147.9 421.587C147.9 421.587 153.479 424.343 162.82 423.742C172.159 423.142 174.318 419.947 174.318 419.947L175.238 409.309C175.238 409.309 171.723 412.059 163.176 412.433C152.124 412.919 146.387 410.364 146.387 410.364Z"
                                fill="#37474F" />
                            <path
                                d="M81.3945 412.609L81.7418 423.821C81.7418 423.821 86.1592 427.405 95.4738 428.316C104.788 429.228 108.901 425.88 108.901 425.88L110.826 415.979C110.826 415.979 106.154 417.965 97.6318 417.213C89.1108 416.461 81.3945 412.609 81.3945 412.609Z"
                                fill="#37474F" />
                            <path
                                d="M284.466 207.002C283.19 205.959 282.695 206.051 282.695 206.051C283.094 205.106 282.459 202.483 279.057 201.63C279.057 201.63 280.616 199.429 275.53 197.459C269.76 195.225 263.314 195.473 259.777 195.517C258.423 195.47 257.18 194.694 258.747 193.97C260.845 193.001 263.313 192.545 264.995 190.86C265.47 190.382 265.874 189.817 266.076 189.174C266.278 188.531 266.183 187.841 265.948 187.209C265.442 185.849 263.15 186.444 261.836 186.751C256.612 187.97 251.695 187.629 246.914 190.306C245.384 191.162 242.826 192.466 241.111 192.104C230.843 189.934 204.535 180.37 197.688 177.119C187.254 164.47 181.604 151.982 174.41 140.276C168.316 130.36 161.874 127.997 156.44 126.725L151.137 162.775C151.137 162.775 165.989 182.036 174.112 192.929C177.562 197.556 181.293 199.755 190.273 201.961C205.046 205.588 217.246 207.176 231.977 209.879C241.096 211.552 243.822 213.33 246.112 214.347C248.403 215.363 250.055 215.883 252.1 215.892C257.221 215.914 260.889 214.769 265.332 214.662C272.606 214.488 273.91 215.108 275.897 215.258C278.857 215.481 280.077 214.701 280.457 213.191C280.838 211.68 277.269 210.693 277.269 210.693C277.269 210.693 281.019 211.269 282.594 210.637C284.565 209.847 285.741 208.044 284.466 207.002Z"
                                fill="#C8856A" />
                            <path
                                d="M270.932 214.893C272.793 215.07 273.148 214.974 274.998 215.31C276.794 215.616 278.755 216.037 280.076 214.422C280.38 214.019 280.603 213.589 280.678 213.048C280.729 212.441 280.298 212.004 279.931 211.708C279.61 211.465 279.27 211.271 278.923 211.098C279.6 211.124 280.287 211.117 280.894 211.127C282.041 211.195 283.265 210.797 284.146 210.035C284.597 209.661 285.014 209.188 285.186 208.551C285.374 207.903 285.062 207.027 284.552 206.706C283.833 206.162 283.026 205.798 283.026 205.798C283.229 205.1 283.024 204.452 282.739 203.898C282.424 203.313 281.964 202.831 281.45 202.447C280.565 201.785 279.876 201.617 279.36 201.482C279.694 200.578 279.151 199.661 278.571 199.129C277.91 198.486 277.125 198.034 276.333 197.63C274.735 196.815 271.83 196.02 270.083 195.774C266.571 195.276 263.03 195.423 259.516 195.521C263.035 195.522 266.569 195.577 270.039 196.086C271.768 196.352 274.621 197.161 276.163 197.97C276.931 198.37 277.684 198.822 278.28 199.419C278.886 199.968 279.264 200.869 278.884 201.49C278.191 202.368 277.459 202.618 276.288 202.522C275.679 202.485 272.635 202.013 272.012 201.957C268.757 201.662 265.9 201.782 263.435 202.075C265.907 201.878 269.254 202.034 272.016 202.365C272.625 202.438 275.612 202.891 276.247 202.95C277.456 203.085 278.239 202.881 279.182 201.895C279.727 202.05 280.306 202.179 281.158 202.833C281.625 203.19 282.027 203.629 282.291 204.135C282.554 204.624 282.69 205.245 282.521 205.689L282.517 205.698C282.314 206.31 281.581 206.612 280.858 206.694C280.128 206.788 279.362 206.73 278.611 206.618C277.116 206.31 275.539 206.086 273.998 205.996C272.449 205.895 270.896 205.852 269.344 205.924L264.707 206.236L269.348 206.068C270.893 206.045 272.438 206.135 273.975 206.283C275.524 206.425 277.011 206.681 278.539 207.043C279.314 207.182 280.105 207.271 280.917 207.195C281.544 207.144 282.299 206.901 282.757 206.325C282.757 206.325 283.628 206.704 284.202 207.155C285.123 207.725 284.645 208.991 283.804 209.621C282.989 210.318 281.984 210.677 280.897 210.629C279.816 210.626 278.57 210.56 277.327 210.469C275.136 210.384 274.672 210.32 272.49 210.39C270.311 210.474 268.128 210.567 265.964 210.848C268.136 210.662 270.316 210.665 272.493 210.677C274.667 210.703 275.118 210.751 277.271 210.93C278.117 211.186 278.981 211.522 279.672 212.039C280.013 212.301 280.319 212.65 280.277 213.017C280.232 213.4 280.031 213.846 279.771 214.182C278.647 215.62 276.816 215.277 275.052 214.988C273.219 214.667 272.824 214.793 270.952 214.695C269.081 214.585 267.206 214.583 265.338 214.66C267.204 214.651 269.074 214.717 270.932 214.893Z"
                                fill="#AF6152" />
                            <path
                                d="M244.625 204.271C248.326 206.471 254.209 204.045 257.49 201.258C254.403 205.617 249.717 208.182 244.625 204.271Z"
                                fill="#AF6152" />
                            <path
                                d="M186.77 177.614C189.634 174.627 191.654 170.855 192.078 167.885C188.273 160.981 181.834 150.832 178.274 145.252C171.599 134.788 168.148 127.785 156.065 126.078L150.453 162.773C150.453 162.773 162.021 178.409 168.47 187.1C176.34 185.521 181.218 183.402 186.77 177.614Z"
                                fill="#263238" />
                            <path
                                d="M132.964 241.096C114.931 241.095 97.9837 237.7 91.4926 232.811C91.7523 230.165 93.4653 212.134 93.1865 200.238C93.0224 193.228 91.9456 187.165 90.9048 181.301C89.9258 175.786 89.0007 170.578 88.9018 164.997C88.5006 142.631 93.49 132.744 94.2982 131.296L96.0527 130.806C102.966 128.867 114.537 125.622 126.052 124.43C128.482 124.178 131.063 124.051 133.722 124.051C140.741 124.051 148.174 124.913 155.821 126.611C159.569 129.268 168.058 138.417 171.031 150.365C173.173 158.968 174.684 172.266 175.179 186.85C175.872 207.311 176.404 226.761 176.465 228.975C170.605 236.57 154.378 241.097 132.972 241.097C132.968 241.096 132.967 241.096 132.964 241.096Z"
                                fill="#F5F5F5" />
                            <path
                                d="M133.724 124.641C140.663 124.641 148.014 125.49 155.577 127.163C159.31 129.86 167.55 138.82 170.459 150.508C172.59 159.072 174.095 172.325 174.588 186.871C175.264 206.786 175.785 225.743 175.868 228.779C170.014 236.13 154.039 240.507 132.965 240.507C115.288 240.507 98.6958 237.249 92.1159 232.536C92.461 228.958 94.0492 211.737 93.7805 200.226C93.6153 193.172 92.5351 187.085 91.4898 181.199C90.5153 175.708 89.5948 170.523 89.4947 164.989C89.1126 143.639 93.6614 133.766 94.6988 131.801C95.1754 131.669 95.6823 131.527 96.2174 131.376C103.112 129.443 114.651 126.206 126.115 125.019C128.525 124.767 131.085 124.641 133.724 124.641ZM133.724 123.459C130.982 123.459 128.397 123.593 125.993 123.841C113.232 125.163 100.401 128.996 93.9098 130.792C93.9098 130.792 87.8694 140.28 88.3123 165.008C88.5202 176.607 92.2811 186.724 92.5981 200.252C92.9004 213.162 90.8739 233.079 90.8739 233.079C97.528 238.357 115.161 241.687 132.965 241.687C151.6 241.687 170.423 238.042 177.062 229.166C177.062 229.166 176.513 208.71 175.771 186.828C175.217 170.502 173.523 157.919 171.606 150.22C168.513 137.79 159.691 128.575 156.066 126.059C147.92 124.241 140.361 123.459 133.724 123.459Z"
                                fill="#E0E0E0" />
                            <path
                                d="M110.357 66.7695C110.357 66.7695 106.145 66.9415 103.204 72.0343C101.728 74.5937 100.564 79.3122 103.865 93.0251C105.99 101.851 108.781 105.762 109.999 108.238C111.217 110.716 113.87 111.487 113.87 111.487L113.969 101.035L113.833 93.7455C113.833 93.7455 120.016 88.6223 120.72 83.4115C121.626 76.7057 119.081 72.8043 119.081 72.8043L110.357 66.7695Z"
                                fill="#37474F" />
                            <path
                                d="M108.895 67.0699C110.146 61.2352 117.999 54.4867 132.693 54.2124C144.732 53.9876 153.704 60.798 157.642 67.8005C161.58 74.8019 155.456 80.4815 155.456 80.4815L118.744 77.3837L108.895 67.0699Z"
                                fill="#37474F" />
                            <path
                                d="M104.115 103.764C109.547 106.58 112.221 102.385 112.221 102.385L113.021 127.279C123.129 141.537 151.5 135.166 140.265 124.364L140.134 118.44C140.134 118.44 141.647 118.484 144.595 118.121C149.514 117.528 154.019 114.496 155.663 109.357C156.503 106.725 157.081 104.577 157.382 100.666C157.801 95.2246 157.288 89.1404 156.685 85.1648C156.068 81.0971 156.223 78.9929 155.595 75.6648C155.116 73.1223 154.102 70.3314 151.778 69.1074C146.008 66.0681 140.431 69.983 132.139 72.8312C128.705 74.0102 120.47 74.3025 118.338 73.2347C121.081 76.4156 120.707 86.1596 116.361 89.9755C115.575 91.3221 114.773 92.0988 114.157 92.5911C112.313 94.0557 110.989 90.0733 109.541 88.4818C108.078 86.9025 102.489 85.3368 99.8782 90.3195C97.2357 95.3932 99.0813 101.155 104.115 103.764Z"
                                fill="#C8856A" />
                            <path
                                d="M133.153 98.4046C133.184 98.3068 133.29 98.1956 133.402 98.2315C133.763 98.3473 133.951 98.6238 134.172 98.9104C134.355 99.1465 134.546 99.3791 134.752 99.5961C135.181 100.047 135.68 100.412 136.232 100.7C136.821 101.008 137.488 101.215 138.143 101.317C138.525 101.376 138.914 101.438 139.3 101.459C139.607 101.475 140.002 101.444 140.291 101.55C140.526 101.635 140.309 102.014 140.174 102.083C139.822 102.263 139.358 102.305 138.968 102.331C138.538 102.36 138.125 102.342 137.7 102.267C136.893 102.124 136.115 101.873 135.393 101.486C134.804 101.169 134.263 100.726 133.819 100.227C133.591 99.9692 133.378 99.6927 133.219 99.387C133.037 99.0352 133.031 98.7733 133.153 98.4046Z"
                                fill="#AF6152" />
                            <path
                                d="M140.131 118.437C133.714 118.184 127.704 117.195 123.973 115.504C120.241 113.812 117.064 108.682 116.142 103.668C115.998 107.674 117.537 114.837 123.174 117.98C128.809 121.123 136.007 121.465 140.204 121.695L140.131 118.437Z"
                                fill="#AF6152" />
                            <path
                                d="M127.062 80.3863L132.413 77.9551C133.064 79.4545 132.393 81.2135 130.916 81.8846C129.436 82.5556 127.712 81.8857 127.062 80.3863Z"
                                fill="#37474F" />
                            <path
                                d="M147.018 76.9141L152.516 79.0924C151.951 80.6154 150.263 81.3617 148.744 80.7604C147.225 80.1579 146.451 78.4371 147.018 76.9141Z"
                                fill="#37474F" />
                            <path
                                d="M129.168 86.8779C129.169 88.2413 130.298 89.344 131.689 89.3417C133.081 89.3395 134.209 88.2335 134.208 86.8701C134.207 85.5067 133.077 84.404 131.686 84.4063C130.294 84.4085 129.167 85.5145 129.168 86.8779Z"
                                fill="#263238" />
                            <path
                                d="M146.832 86.1377C146.833 87.5011 147.962 88.6037 149.353 88.6015C150.745 88.5993 151.873 87.4932 151.872 86.1298C151.871 84.7664 150.741 83.6638 149.35 83.666C147.958 83.6694 146.831 84.7754 146.832 86.1377Z"
                                fill="#263238" />
                            <path
                                d="M138.352 82.8848L139.794 97.9014L147.964 95.2555C145.282 89.8873 142.079 85.7633 138.352 82.8848Z"
                                fill="#AF6152" />
                            <path
                                d="M93.7943 131.414C85.4823 133.807 75.744 140.016 78.1381 156.577C80.3906 172.156 89.3095 206.639 92.6725 215.253C96.4908 225.035 100.475 228.506 105.683 229.709C110.148 230.741 115.204 227.889 118.99 225.273C129.805 217.797 136.965 202.631 144.742 186.763C149.093 177.886 152.127 167.394 152.776 163.234C153.063 161.398 153.249 159.377 153.1 157.522C152.962 155.813 152.524 153.847 151.799 152.289C151.687 152.047 151.56 151.811 151.487 151.556C151.367 151.138 151.399 150.694 151.391 150.258C151.375 149.191 151.094 148.083 150.369 147.3C150.054 146.96 149.669 146.695 149.303 146.413C149.178 146.317 149.052 146.216 148.964 146.086C148.694 145.685 148.844 145.152 148.803 144.671C148.712 143.621 147.606 142.86 146.554 142.899C145.286 142.945 144.425 143.805 143.711 144.742C143.654 144.818 143.593 144.898 143.505 144.934C143.413 144.972 143.309 144.954 143.21 144.939C142.742 144.873 142.257 144.903 141.803 145.036C141.365 145.163 140.958 145.393 140.634 145.714C139.893 146.445 139.629 147.519 139.396 148.535C139.012 150.215 138.736 151.911 138.343 153.598C137.572 156.899 137.248 160.359 135.431 163.286C135.262 163.557 134.999 163.859 134.69 163.781C134.407 163.709 134.301 163.367 134.261 163.077C133.831 160.05 135.635 156.909 133.315 154.245C131.298 151.928 130.928 156.426 130.588 157.594C130.131 159.163 129.674 160.732 129.216 162.302C128.458 164.9 127.695 167.541 127.693 170.247C127.692 172.802 128.372 175.331 128.246 177.882C128.117 180.489 127.238 182.842 125.397 184.664C118.353 191.633 115.156 194.387 115.156 194.387L110.024 168.298C110.024 168.298 109.381 153.358 103.558 141.482C99.7279 133.679 93.7943 131.414 93.7943 131.414Z"
                                fill="#C8856A" />
                            <path
                                d="M143.852 145.252C144.578 146.53 144.28 148.125 144.269 149.531C144.003 153.834 143.215 158.15 141.941 162.274C142.362 159.821 142.89 156.25 143.29 153.756C143.615 151.65 143.85 149.488 144.041 147.355C144.077 146.651 144.151 145.912 143.852 145.252Z"
                                fill="#AF6152" />
                            <path
                                d="M148.758 146.264C148.768 152.089 148.26 158.043 146.328 163.568C147.606 157.956 147.946 151.963 148.758 146.264Z"
                                fill="#AF6152" />
                            <path
                                d="M151.483 151.742C151.8 156.099 151.235 160.554 149.922 164.718C150.4 160.886 151.104 155.537 151.483 151.742Z"
                                fill="#AF6152" />
                            <path
                                d="M118.988 225.273C131.124 216.228 137.05 201.623 143.731 188.529C147.093 181.872 149.693 174.846 151.623 167.652C152.568 164.071 153.287 160.341 152.823 156.662C152.638 154.765 151.89 153.083 151.241 151.32C151.249 149.407 151 147.632 149.201 146.585C148.746 146.266 148.532 145.761 148.602 145.21C148.834 143.806 147.36 142.814 146.08 143.15C145.084 143.362 144.366 144.186 143.736 144.99C143.629 145.122 143.38 145.165 143.263 145.133C142.602 145.025 141.918 145.108 141.33 145.419C139.677 146.348 139.637 148.571 139.21 150.241C138.447 153.474 137.79 158.061 136.645 161.148C136.289 162.029 135.914 162.869 135.322 163.669C134.066 164.721 133.995 162.556 134.044 161.753C134.177 159.073 135.148 155.917 132.808 153.957C131.16 152.813 131.018 157.057 130.599 157.982L129.812 160.667C128.794 164.22 127.512 167.829 127.846 171.574C128.215 175.22 129.016 179.206 127.053 182.577C126.156 184.26 124.627 185.426 123.333 186.751C120.648 189.342 117.952 191.924 115.148 194.387C117.93 191.899 120.604 189.296 123.266 186.683C124.553 185.343 126.064 184.165 126.926 182.507C127.816 180.877 128.176 179 128.156 177.153C128.141 175.296 127.779 173.458 127.635 171.59C127.287 167.817 128.563 164.169 129.577 160.598L130.356 157.911C130.783 156.59 130.757 155.072 131.57 153.868C132.785 152.491 134.215 155.12 134.47 156.156C134.944 158.049 134.371 159.932 134.338 161.76C134.27 165.518 135.722 162.715 136.356 161.035C137.469 158.013 138.134 153.343 138.876 150.162C139.293 147.987 139.724 144.766 142.582 144.725C142.846 144.672 143.308 144.839 143.48 144.726C144.115 143.9 144.884 143.028 145.999 142.781C147.472 142.355 149.269 143.621 148.992 145.221C148.94 145.705 149.073 145.99 149.439 146.273C150.209 146.803 150.985 147.527 151.273 148.461C151.629 149.341 151.541 150.372 151.612 151.261C152.257 152.911 153.003 154.775 153.178 156.613C153.641 160.378 152.896 164.138 151.938 167.733C149.98 174.944 147.35 181.981 143.963 188.641C137.268 201.73 131.223 216.342 118.988 225.273Z"
                                fill="#AF6152" />
                            <path
                                d="M115.151 194.389C109.99 196.742 105.581 201.519 104.713 204.268C104.713 204.268 104.346 195.965 114.481 191.354L115.151 194.389Z"
                                fill="#AF6152" />
                            <path
                                d="M94.056 130.574C81.2042 133.898 77.2421 140.28 77.2579 150.15C77.2792 163.822 83.5894 187.685 85.9025 195.934C99.3242 200.859 114.593 189.038 114.593 189.038L110.972 168.3C110.972 168.3 109.175 136.428 94.056 130.574Z"
                                fill="#263238" />
                            <path class="theme-color"
                                d="M209.49 229.436L474.217 76.6559C476.328 75.4374 478.232 75.3183 479.618 76.1051C480.934 76.8526 485.662 79.5783 486.968 80.3538C488.332 81.1642 489.174 82.8693 489.174 85.296L489.173 293.71C489.173 298.635 485.716 304.623 481.451 307.085L216.725 459.866C214.595 461.095 212.676 461.205 211.288 460.395C209.993 459.64 205.33 456.942 204.03 456.199C202.634 455.402 201.77 453.684 201.77 451.225V242.81C201.768 237.886 205.225 231.897 209.49 229.436Z"
                                fill="#8B4513" />
                            <path class="theme-color"
                                d="M209.01 246.999V455.415C209.01 457.605 209.688 459.204 210.818 460.108C209.132 459.135 205.203 456.876 204.021 456.198C202.631 455.399 201.762 453.678 201.762 451.227V242.811C201.762 240.343 202.631 237.631 204.021 235.215L211.269 239.386V239.404C209.861 241.819 209.01 244.532 209.01 246.999Z"
                                fill="#8B4513" />
                            <path class="theme-color"
                                d="M481.453 80.8381L216.726 233.617C212.461 236.079 209.004 242.067 209.004 246.992V455.407C209.004 460.331 212.461 462.327 216.726 459.864L481.453 307.085C485.718 304.622 489.174 298.634 489.174 293.71L489.176 85.2959C489.174 80.3716 485.717 78.3754 481.453 80.8381Z"
                                fill="#8B4513" />
                            <g opacity="0.5">
                                <path
                                    d="M466.305 134.153C459.472 134.153 453.204 128.688 453.204 121.053L243.342 242.171C243.342 255.024 236.484 266.901 225.352 273.325V413.358C227.459 412.142 229.694 411.587 231.87 411.587C238.702 411.587 244.97 417.052 244.97 424.687L454.832 303.57C454.832 292.146 462.928 278.127 472.823 272.417V132.382C470.715 133.598 468.482 134.153 466.305 134.153ZM469.553 270.606C460.033 277.011 452.42 290.196 451.63 301.643L247.401 419.509C245.23 413.012 239.088 408.317 231.87 408.317C230.779 408.317 229.691 408.431 228.621 408.652V275.159C239.23 268.32 245.944 256.693 246.565 244.086L450.773 126.231C452.945 132.728 459.086 137.423 466.305 137.423C467.395 137.423 468.483 137.31 469.553 137.088V270.606ZM231.317 261.026C234.611 259.124 237.282 254.021 237.282 249.629C237.282 245.236 234.611 243.217 231.317 245.119C228.022 247.021 225.352 252.124 225.352 256.516C225.352 260.909 228.022 262.928 231.317 261.026ZM466.787 126.869C470.081 124.967 472.752 119.864 472.752 115.471C472.752 111.079 470.081 109.06 466.787 110.962C463.492 112.864 460.822 117.967 460.822 122.359C460.822 126.752 463.492 128.77 466.787 126.869ZM466.787 283.722C463.492 285.624 460.822 290.727 460.822 295.119C460.822 299.512 463.492 301.53 466.787 299.629C470.081 297.727 472.752 292.624 472.752 288.231C472.752 283.839 470.081 281.819 466.787 283.722ZM231.317 417.879C228.022 419.781 225.352 424.884 225.352 429.276C225.352 433.669 228.022 435.688 231.317 433.786C234.611 431.884 237.282 426.781 237.282 422.389C237.282 417.996 234.611 415.976 231.317 417.879Z"
                                    fill="white" />
                            </g>
                            <path
                                d="M291.435 252.517C290.866 253.398 290.212 254.186 289.47 254.884C288.729 255.582 287.737 256.29 286.496 257.008C285.254 257.725 283.641 258.54 281.656 259.454C281.195 261.391 280.722 263.614 280.241 266.127L276.919 283.142C272.817 303.586 268.444 316.254 263.803 321.142C263.476 321.509 263.058 321.843 262.548 322.138C262.036 322.432 261.624 322.586 261.306 322.604C260.988 322.621 260.724 322.561 260.511 322.428C260.087 322.21 259.875 321.87 259.875 321.407C259.875 320.946 259.963 320.588 260.136 320.334L260.888 319.284C263.661 315.269 266.203 307.382 268.514 295.621L270.593 285.023C272.46 275.497 274.205 267.853 275.822 262.091C274.3 262.792 273.145 263.367 272.355 263.823C270.083 265.135 268.444 266.504 267.444 267.929C266.463 269.345 265.774 270.661 265.379 271.877C264.984 273.093 264.777 273.901 264.758 274.296C264.699 275.049 264.527 275.604 264.237 275.963C263.948 276.322 263.598 276.621 263.183 276.86C262.768 277.099 262.34 277.148 261.897 277.005C261.453 276.864 261.088 276.567 260.799 276.118C260.182 275.217 259.941 273.937 260.076 272.279C260.211 270.621 260.601 269.037 261.246 267.521C261.89 266.006 262.657 264.635 263.543 263.403C265.178 261.124 266.908 259.457 268.727 258.407C270.547 257.356 272.27 256.483 273.899 255.787C275.526 255.092 277.149 254.43 278.766 253.805C283.06 252.096 285.796 250.901 286.97 250.223C288.145 249.545 289.016 248.953 289.585 248.445C290.152 247.937 290.639 247.387 291.044 246.794C291.447 246.201 291.731 245.799 291.896 245.59C292.06 245.379 292.325 245.168 292.69 244.957C293.268 244.624 293.517 245.064 293.441 246.276C293.365 247.488 293.152 248.612 292.806 249.646C292.461 250.679 292.001 251.637 291.435 252.517Z"
                                fill="#FAFAFA" />
                            <path
                                d="M307.046 263.587C305.987 264.199 304.09 267.452 301.355 273.344L298.958 278.657L294.336 289.374C293.219 292.845 292.343 295.7 291.707 297.943L290.147 303.31C289.742 304.646 289.39 305.628 289.091 306.249C288.792 306.87 288.388 307.329 287.878 307.624C287.368 307.918 286.876 308.08 286.405 308.109C285.932 308.136 285.524 308.059 285.176 307.874C284.445 307.475 284.078 306.787 284.078 305.811C284.078 305.426 284.28 304.553 284.685 303.187L285.839 299.401C289.441 287.436 292.705 273.022 295.633 256.157C296.711 249.936 297.491 244.452 297.972 239.708C298.183 237.429 298.975 235.893 300.34 235.104C301.227 234.593 301.958 234.453 302.536 234.684C303.654 235.143 304.193 236.015 304.154 237.293C304.115 238.574 303.98 240.064 303.749 241.763C303.519 243.462 303.22 245.336 302.853 247.384C302.488 249.431 302.074 251.602 301.611 253.897C300.34 259.793 299.396 264.061 298.78 266.701C296.893 274.698 295.727 279.417 295.286 280.852C295.574 280.224 295.95 279.379 296.413 278.314C299.916 270.154 302.085 265.236 302.912 263.565C303.739 261.892 304.443 260.57 305.02 259.594C306.234 257.482 307.774 255.886 309.642 254.807C311.163 253.928 312.386 253.904 313.311 254.73C314.177 255.54 314.61 256.722 314.61 258.275C314.61 259.829 314.482 261.302 314.22 262.697C313.962 264.093 313.629 265.55 313.225 267.067C312.82 268.585 312.376 270.163 311.895 271.801L310.451 276.679C309.103 281.541 308.428 284.959 308.428 286.936C308.428 288.323 308.851 288.773 309.699 288.283C310.508 287.815 311.245 287.159 311.91 286.314C312.574 285.468 313.002 284.99 313.195 284.878C313.6 284.644 313.801 284.798 313.801 285.337C313.801 287.622 312.935 290.035 311.201 292.577C310.007 294.32 308.92 295.472 307.938 296.04C306.955 296.607 306.141 296.942 305.497 297.044C304.852 297.148 304.278 297.035 303.778 296.708C302.641 295.979 302.073 294.265 302.073 291.569C302.073 288.667 302.786 284.61 304.21 279.397L307.329 268.736C307.926 266.749 308.225 265.279 308.225 264.33C308.231 263.38 307.836 263.132 307.046 263.587Z"
                                fill="#FAFAFA" />
                            <path
                                d="M341.336 266.13C341.336 268.493 341.962 269.311 343.214 268.59C344.082 268.089 344.798 267.496 345.367 266.808C345.934 266.122 346.315 265.721 346.507 265.611C346.912 265.377 347.114 265.542 347.114 266.107C347.114 268.315 346.248 270.717 344.515 273.308C342.684 276.034 340.817 277.523 338.909 277.777C337.658 277.909 336.734 277.171 336.136 275.564C335.847 274.73 335.702 273.902 335.702 273.081C335.702 271.746 335.799 270.278 335.992 268.677C334.201 274.589 331.976 279.237 329.318 282.619C328.259 283.95 327.133 284.961 325.938 285.65C324.743 286.34 323.709 286.61 322.833 286.461C321.957 286.312 321.211 285.837 320.595 285.037C319.343 283.348 318.774 280.646 318.89 276.932C319.004 272.295 320.016 267.231 321.922 261.739C323.675 256.619 325.889 251.99 328.566 247.851C331.244 243.66 333.747 240.892 336.077 239.547C338.407 238.201 340.284 238.543 341.71 240.569C343.04 236.952 344.213 234.849 345.235 234.259C346.333 233.625 347.161 233.417 347.72 233.633C348.778 234.049 349.155 234.731 348.847 235.68C344.012 251.669 341.527 261.32 341.393 264.633C341.356 265.119 341.336 265.618 341.336 266.13ZM325.303 275.543C325.303 278.622 326.044 279.735 327.528 278.88C328.664 278.223 330.061 276.134 331.718 272.609C334.143 267.434 336.291 261.11 338.158 253.638C338.755 251.29 339.257 248.999 339.661 246.763C339.584 245.061 339.035 244.094 338.015 243.862C337.667 243.78 337.152 243.936 336.468 244.33C335.785 244.725 334.985 245.521 334.07 246.715C333.155 247.911 332.27 249.334 331.413 250.985C330.557 252.634 329.757 254.464 329.016 256.472C328.274 258.478 327.624 260.569 327.067 262.739C325.891 267.371 325.303 271.639 325.303 275.543Z"
                                fill="#FAFAFA" />
                            <path
                                d="M371.899 226.146C371.302 226.491 370.456 227.744 369.356 229.905C368.258 232.067 367.305 234.01 366.496 235.736L364.041 241.081L359.303 251.866C358.187 255.336 357.311 258.192 356.674 260.433L355.114 265.801C354.71 267.138 354.358 268.12 354.059 268.741C353.76 269.362 353.355 269.821 352.846 270.115C352.336 270.41 351.843 270.572 351.374 270.601C350.9 270.628 350.492 270.55 350.146 270.365C349.413 269.967 349.047 269.279 349.047 268.302C349.047 267.918 349.259 267.038 349.682 265.663L350.78 261.909C351.127 260.785 351.531 259.37 351.993 257.666L353.611 251.456C355.883 242.569 357.021 237.021 357.021 234.813C357.021 233.631 356.731 232.924 356.153 232.693L355.575 232.487C355.382 232.42 355.286 232.16 355.286 231.71C355.286 231.262 355.415 230.756 355.676 230.195C355.935 229.634 356.278 229.077 356.702 228.524C357.568 227.435 358.44 226.634 359.316 226.129C360.192 225.623 360.871 225.36 361.352 225.339C361.833 225.318 362.238 225.431 362.566 225.678C363.279 226.166 363.634 226.898 363.634 227.872C363.634 228.849 363.543 229.883 363.36 230.978C363.178 232.071 362.946 233.207 362.668 234.382C362.388 235.558 362.094 236.722 361.786 237.876C361.478 239.029 361.2 240.038 360.949 240.901L360.371 242.891C360.216 243.39 360.178 243.542 360.255 243.343C362.392 238.155 363.797 234.801 364.472 233.282L366.494 228.879C367.976 225.713 369.142 223.513 369.989 222.279C371.703 219.748 373.052 218.199 374.035 217.632C375.016 217.066 375.844 216.756 376.519 216.699C377.193 216.644 377.78 216.779 378.28 217.106C379.339 217.804 379.869 219.169 379.869 221.197C379.869 223.224 379.522 225.543 378.828 228.152C378.136 230.761 377.535 232.9 377.024 234.568C376.513 236.237 376.027 237.91 375.564 239.589C374.121 244.711 373.397 248.249 373.397 250.199C373.397 251.072 373.918 251.209 374.958 250.608C375.768 250.142 376.504 249.485 377.168 248.639C377.833 247.794 378.262 247.314 378.453 247.204C378.858 246.97 379.06 247.124 379.06 247.662C379.06 249.947 378.183 252.367 376.431 254.919C375.256 256.651 374.177 257.8 373.196 258.366C372.213 258.934 371.399 259.262 370.755 259.352C370.109 259.443 369.536 259.324 369.036 258.997C367.899 258.292 367.331 256.719 367.331 254.28C367.331 251.302 368.033 247.172 369.44 241.893C370.46 238.248 371.183 235.739 371.607 234.363L372.588 231.062C373.185 229.074 373.484 227.605 373.484 226.655C373.487 225.704 372.958 225.534 371.899 226.146Z"
                                fill="#FAFAFA" />
                            <path
                                d="M403.389 240.899C399.016 243.423 395.531 239.902 392.931 230.335C391.909 233.442 391.063 236.216 390.388 238.66L388.655 244.898C388.155 246.627 387.687 248.013 387.254 249.058C386.82 250.104 386.334 250.783 385.796 251.095C385.256 251.406 384.765 251.568 384.322 251.58C383.877 251.591 383.493 251.5 383.166 251.304C382.491 250.871 382.156 250.167 382.156 249.192C382.156 248.806 382.357 247.933 382.762 246.568L383.918 242.781C387.518 230.816 390.782 216.401 393.71 199.536C394.789 193.315 395.569 187.831 396.05 183.087C396.262 180.807 397.053 179.272 398.418 178.483C399.228 178.017 399.901 177.91 400.441 178.163C401.481 178.666 401.981 179.565 401.943 180.858C401.905 182.152 401.775 183.658 401.552 185.378C401.331 187.098 401.037 189.008 400.672 191.106C400.307 193.204 399.892 195.415 399.43 197.735C398.179 203.825 397.244 208.19 396.628 210.831L393.913 222.374C393.566 223.755 393.296 224.772 393.104 225.421C397.572 220.48 400.923 215.874 403.156 211.605C404.504 209.03 405.178 206.96 405.178 205.393C405.178 204.597 404.98 204.134 404.587 204.001C404.191 203.869 403.921 203.749 403.778 203.639C403.633 203.53 403.622 203.19 403.749 202.616C403.874 202.043 404.235 201.353 404.833 200.546C405.429 199.74 406.151 199.092 407 198.601C407.846 198.113 408.555 197.807 409.123 197.684C409.691 197.563 410.187 197.597 410.61 197.788C411.554 198.143 412.025 199.141 412.025 200.783C412.025 202.428 411.767 204.085 411.246 205.759C410.727 207.434 409.918 209.23 408.82 211.146C406.644 214.868 403.158 219.268 398.363 224.348C398.959 227.419 400.057 229.789 401.657 231.459C403.177 233.045 404.574 233.471 405.846 232.738C406.52 232.35 407.097 231.862 407.578 231.276L408.619 229.982C408.83 229.706 409.032 229.513 409.226 229.401C409.707 229.124 409.948 229.37 409.948 230.141C409.948 230.809 409.862 231.442 409.687 232.043C409.514 232.643 409.268 233.318 408.951 234.066C408.634 234.814 408.224 235.604 407.723 236.432C406.468 238.464 405.025 239.953 403.389 240.899Z"
                                fill="#FAFAFA" />
                            <path
                                d="M312.088 345.618C311.857 344.903 311.742 344.002 311.742 342.91C311.742 341.819 311.88 340.519 312.16 339.01C312.439 337.499 312.799 335.887 313.244 334.166C313.687 332.447 314.168 330.667 314.687 328.827L316.248 323.303C318.25 316.214 318.992 312.27 318.473 311.466C318.242 311.111 317.808 310.874 317.173 310.753C316.942 310.706 316.826 310.458 316.826 310.009C316.826 309.56 316.965 309.049 317.245 308.476C317.524 307.905 317.885 307.337 318.328 306.773C319.272 305.638 320.215 304.797 321.158 304.252C322.102 303.708 322.82 303.429 323.31 303.415C323.803 303.401 324.202 303.511 324.509 303.743C325.145 304.224 325.463 304.979 325.463 306.005C325.463 307.032 325.338 308.254 325.087 309.669C324.836 311.085 324.509 312.654 324.105 314.377C323.7 316.101 323.258 317.897 322.775 319.767C321.447 324.694 320.551 327.959 320.089 329.56L319.02 333.144C318.423 335.26 318.124 336.679 318.124 337.396C318.124 338.116 318.212 338.573 318.384 338.766C318.557 338.964 318.871 338.929 319.324 338.667C319.774 338.407 320.277 337.886 320.825 337.106C321.374 336.328 321.966 335.369 322.602 334.232C323.236 333.094 323.896 331.822 324.581 330.412C325.264 329.004 325.933 327.559 326.588 326.077C328.302 322.262 329.572 319.103 330.403 316.595C334.561 303.974 336.767 297.36 337.016 296.754C337.653 295.283 338.293 294.361 338.938 293.988C339.584 293.615 340.146 293.387 340.628 293.302C341.11 293.217 341.524 293.254 341.87 293.414C342.641 293.715 342.877 294.413 342.578 295.508C342.279 296.606 341.918 298.085 341.494 299.946C337.835 316.208 335.462 326.398 334.374 330.518C333.285 334.639 332.338 337.99 331.529 340.576C330.72 343.161 329.771 345.847 328.683 348.633C327.595 351.418 326.435 354.051 325.202 356.534C322.39 362.164 319.752 365.831 317.287 367.536C316.343 368.182 315.592 368.437 315.033 368.298C314.071 368.084 313.589 367.629 313.589 366.937C313.589 366.243 314.027 365.509 314.904 364.734C315.78 363.957 316.686 362.896 317.62 361.547C318.554 360.2 319.454 358.736 320.319 357.158C322.862 352.455 324.836 347.797 326.243 343.184C327.437 339.158 328.399 335.444 329.13 332.043L331.384 321.573C330.825 322.795 330.209 324.203 329.535 325.8L327.455 330.697C325.644 334.798 324.142 337.836 322.947 339.808C320.675 343.56 318.644 345.953 316.852 346.987C314.467 348.366 312.877 347.911 312.088 345.618Z"
                                fill="#FAFAFA" />
                            <path
                                d="M347.357 326.371C346.548 325.813 345.913 324.875 345.451 323.562C344.989 322.251 344.748 320.522 344.728 318.375C344.708 316.231 344.906 313.934 345.32 311.486C345.734 309.038 346.322 306.569 347.082 304.075C347.843 301.583 348.757 299.128 349.825 296.712C350.894 294.299 352.073 292.051 353.364 289.969C356.176 285.471 359.094 282.349 362.117 280.602C366.083 278.312 368.77 279.086 370.176 282.922C371.178 285.706 371.235 289.742 370.348 295.031C369.539 299.888 368.057 304.776 365.901 309.692C363.764 314.6 361.24 318.662 358.333 321.881C356.868 323.497 355.43 324.713 354.014 325.531C352.598 326.348 351.336 326.831 350.23 326.983C349.124 327.136 348.165 326.932 347.357 326.371ZM352.874 304.506C352.297 306.739 351.838 308.955 351.502 311.152C351.164 313.35 351.007 315.335 351.025 317.108C351.044 318.882 351.251 320.162 351.646 320.948C352.042 321.735 352.681 321.872 353.568 321.36C354.453 320.849 355.325 319.941 356.182 318.637C357.038 317.334 357.872 315.781 358.68 313.978C359.489 312.176 360.25 310.197 360.962 308.039C361.675 305.882 362.301 303.697 362.84 301.486C364.015 296.674 364.583 292.674 364.545 289.486C364.545 286.66 364.111 285.115 363.246 284.844C362.899 284.735 362.412 284.863 361.786 285.225C361.161 285.585 360.444 286.378 359.634 287.602C358.825 288.827 358.017 290.316 357.209 292.066C356.4 293.817 355.62 295.769 354.868 297.923C354.116 300.076 353.451 302.272 352.874 304.506Z"
                                fill="#FAFAFA" />
                            <path
                                d="M402.042 289.831C402.486 289.574 402.708 289.743 402.708 290.332C402.708 292.566 401.879 294.919 400.223 297.388C399.106 299.01 397.797 300.255 396.294 301.121C395.061 301.834 394.118 301.991 393.463 301.6C392.288 300.892 391.701 299.536 391.701 297.533C391.701 294.992 392.5 290.64 394.1 284.478C391.134 291.531 389.054 296.282 387.859 298.733C386.665 301.181 385.625 303.149 384.74 304.636C382.814 307.852 381.071 309.911 379.512 310.812C377.123 312.192 375.535 311.735 374.746 309.442C374.514 308.727 374.398 307.826 374.398 306.734C374.398 305.643 374.538 304.344 374.817 302.834C375.096 301.324 375.457 299.711 375.901 297.99C376.344 296.271 376.824 294.491 377.344 292.651L378.905 287.127C380.908 280.039 381.649 276.094 381.129 275.291C380.897 274.935 380.464 274.698 379.83 274.577C379.599 274.531 379.482 274.282 379.482 273.833C379.482 273.383 379.622 272.873 379.902 272.301C380.18 271.73 380.541 271.161 380.984 270.597C381.928 269.462 382.871 268.621 383.815 268.077C384.759 267.533 385.478 267.253 385.968 267.239C386.46 267.225 386.858 267.335 387.166 267.568C387.801 268.049 388.12 268.803 388.12 269.829C388.12 270.856 387.994 272.078 387.745 273.493C387.494 274.91 387.166 276.479 386.762 278.201C386.358 279.924 385.914 281.719 385.433 283.589C384.103 288.516 383.209 291.781 382.746 293.382L381.677 296.966C381.081 299.083 380.783 300.501 380.783 301.218C380.783 301.938 380.868 302.396 381.041 302.589C381.214 302.787 381.528 302.753 381.981 302.49C382.432 302.231 382.958 301.645 383.555 300.733C384.151 299.824 384.804 298.69 385.518 297.329C386.231 295.967 386.973 294.44 387.743 292.75C388.513 291.061 389.263 289.338 389.995 287.579C391.439 284.126 392.499 281.409 393.173 279.428C397.256 267.443 399.431 261.153 399.702 260.561C400.318 259.102 400.947 258.184 401.594 257.812C402.239 257.44 402.803 257.211 403.284 257.127C403.765 257.041 404.18 257.078 404.526 257.237C405.335 257.566 405.595 258.213 405.305 259.176C400.607 274.959 398.073 284.637 397.708 288.211C397.612 289.422 397.563 290.245 397.563 290.683C397.563 292.634 398.007 293.354 398.893 292.843C399.72 292.364 400.404 291.772 400.944 291.06C401.485 290.352 401.85 289.941 402.042 289.831Z"
                                fill="#FAFAFA" />
                            <path
                                d="M411.818 290.462C411.385 290.148 411.044 289.696 410.793 289.109C410.542 288.522 410.418 287.746 410.418 286.784C410.418 285.822 410.557 284.88 410.837 283.962C411.115 283.043 411.468 282.229 411.892 281.524C412.642 280.269 413.437 279.398 414.274 278.916C415.112 278.431 415.824 278.1 416.412 277.913C416.998 277.729 417.543 277.658 418.044 277.702C419.257 277.824 419.863 278.655 419.863 280.196C419.863 282.12 419.391 284.076 418.448 286.058C417.562 287.905 416.642 289.166 415.69 289.846C414.735 290.525 413.96 290.875 413.364 290.9C412.767 290.924 412.252 290.777 411.818 290.462ZM416.628 274.128C415.685 274.672 415.213 273.162 415.213 269.592C415.213 264.662 416.185 257.771 418.132 248.919C419.864 241.01 421.829 234.408 424.024 229.109C425.219 226.237 426.402 224.245 427.577 223.13C428.194 222.569 428.766 222.135 429.296 221.829C429.826 221.523 430.293 221.305 430.697 221.174C431.101 221.043 431.458 220.992 431.765 221.019C432.439 221.041 432.777 221.373 432.777 222.015C432.777 222.656 432.583 223.449 432.198 224.39C431.811 225.331 431.195 226.92 430.349 229.154C429.5 231.391 428.509 234.248 427.374 237.728C424.638 246.086 421.97 255.638 419.372 266.382C419.102 267.462 418.876 268.433 418.693 269.298C418.51 270.162 418.323 270.916 418.131 271.568C417.726 272.929 417.225 273.783 416.628 274.128Z"
                                fill="#FAFAFA" />
                            <path
                                d="M404.012 433.849C412.611 439.48 430.033 442.832 445.881 442.267C461.728 441.701 469.886 439.067 475.134 432.14C480.381 425.214 479.588 417.444 479.588 417.444L467.251 418.95L474.952 414.62C474.952 414.62 475.539 407.245 473.649 404.825C471.759 402.404 468.228 403.151 463.95 404.553C459.672 405.955 448.276 416.845 434.496 423.145C420.715 429.444 410.435 433.018 404.012 433.849Z"
                                fill="#BA68C8" />
                            <path opacity="0.2"
                                d="M404.012 433.849C412.611 439.48 430.033 442.832 445.881 442.267C461.728 441.701 469.886 439.067 475.134 432.14C480.381 425.214 479.588 417.444 479.588 417.444L467.251 418.95L474.952 414.62C474.952 414.62 475.539 407.245 473.649 404.825C471.759 402.404 468.228 403.151 463.95 404.553C459.672 405.955 448.276 416.845 434.496 423.145C420.715 429.444 410.435 433.018 404.012 433.849Z"
                                fill="white" />
                            <path opacity="0.65"
                                d="M464.484 413.341C464.259 416.305 463.036 419.287 460.725 421.157C461.672 421.316 462.634 421.533 463.44 422.053C464.246 422.575 464.877 423.457 464.858 424.417C464.848 424.966 464.631 425.489 464.382 425.979C462.174 430.301 457.422 432.648 452.836 434.235C445.384 436.814 437.541 438.165 429.673 438.698C424.289 439.063 418.741 439.026 413.685 437.137C412.332 436.632 410.96 435.94 410.175 434.729C410.056 434.545 409.949 434.332 409.989 434.117C410.036 433.867 410.267 433.7 410.479 433.56C411.673 432.775 412.903 432.048 414.144 431.341C419.708 429.525 426.51 426.795 434.495 423.145C447.512 417.193 458.393 407.158 463.164 404.881C464.069 407.612 464.701 410.475 464.484 413.341Z"
                                fill="#BA68C8" />
                            <path class="theme-color"
                                d="M419.641 411.045C429.819 409.507 452.496 407.948 463.067 400.979C473.638 394.011 472.559 391.398 470.063 387.579C467.566 383.759 462.244 375.357 460.59 374.3C458.935 373.244 449.322 379.71 449.322 379.71L454.303 370.249C454.303 370.249 451.114 366.792 443.533 365.399C435.952 364.008 430.19 363.824 426.136 365.718C422.082 367.612 413.605 386.959 412.109 394.833L419.641 411.045Z"
                                fill="#8B4513" />
                            <path opacity="0.15"
                                d="M422.856 369.321C426.193 368.449 429.645 368.278 432.935 369.256C436.028 370.175 438.747 372.039 441.322 373.984C444.01 376.016 446.77 378.432 447.448 381.732C448.131 385.059 446.512 388.274 444.787 391.009C443.847 392.5 442.945 393.989 442.033 395.5C441.382 396.577 440.072 399.557 438.927 400.093C443.726 397.848 448.554 395.592 453.663 394.192C455.043 393.813 456.546 393.505 457.876 394.033C459.157 394.542 460.028 395.733 460.724 396.922C461.518 398.281 462.152 399.727 462.67 401.214C451.946 407.976 429.701 409.526 419.642 411.046L412.109 394.835C413.266 388.73 418.618 375.739 422.856 369.321Z"
                                fill="black" />
                            <path
                                d="M419.748 425.247C429.314 426.474 456.294 421.168 458.853 419.05C461.413 416.932 461.83 404.177 461.011 402.286C460.193 400.393 447.268 404.822 447.268 404.822L458.735 398.331C458.735 398.331 456.122 391.889 453.856 392.171C451.59 392.453 436.464 401.377 435.265 401.276C434.066 401.175 445.715 386.967 445.679 383.48C445.642 379.993 442.803 376.494 435.682 373.599C428.562 370.705 422.888 371.896 418.343 372.524C413.8 373.153 405.108 376.782 402.561 389.511C400.015 402.241 403.903 413.738 419.748 425.247Z"
                                fill="#634468" />
                            <path opacity="0.15"
                                d="M424.827 384.591C425.09 384.853 425.111 385.265 425.112 385.637C425.127 388.905 424.928 392.175 424.517 395.417C427.818 392.494 430.631 389.054 433.116 385.411C433.486 384.869 434.047 384.247 434.67 384.453C435.089 384.591 435.307 385.08 435.279 385.521C435.251 385.962 435.033 386.364 434.82 386.751C432.196 391.522 429.572 396.294 426.948 401.066C428.639 399.829 430.654 398.889 432.748 398.959C432.2 400.893 430.941 402.615 429.266 403.723C435.207 403.316 440.422 399.509 446.302 398.563C442.225 403.19 436.554 406.044 431.03 408.787C434.112 408.889 437.193 408.991 440.275 409.095C439.065 410.677 437.102 411.492 435.168 411.972C433.233 412.452 431.225 412.67 429.369 413.395C431.992 414.215 434.81 414.026 437.552 413.827C443.209 413.416 448.865 413.006 454.522 412.596C453.164 414.545 451.075 415.858 448.937 416.893C446.404 418.119 443.73 419.027 441.009 419.731C437.002 420.767 432.88 421.471 428.755 421.788C424.55 422.112 420.406 422.82 416.245 421.7C415.672 421.546 415.11 421.342 414.563 421.104C413.181 419.885 411.946 418.663 410.811 417.44C410.554 416.846 410.354 416.222 410.217 415.59C409.44 412.014 410.224 408.291 411.234 404.773C413.195 397.948 416.115 391.23 420.985 386.063C421.82 385.176 422.851 384.282 424.068 384.322C424.344 384.332 424.632 384.398 424.827 384.591Z"
                                fill="black" />
                            <path
                                d="M445.224 411.462C445.522 411.419 445.804 411.332 446.057 411.157C446.618 410.77 446.857 410.011 446.717 409.344C446.576 408.677 446.102 408.111 445.52 407.756C444.992 407.436 444.353 407.271 443.749 407.4C442.551 407.657 442.665 408.539 442.29 409.428C441.883 410.395 440.868 411.061 439.927 411.428C438.68 411.914 437.314 412.075 436.111 412.66C434.749 413.323 433.669 414.496 432.263 415.058C429.741 416.065 426.518 414.982 424.392 416.672C424.179 415.91 424.923 415.247 425.579 414.803C427.226 413.688 428.87 412.567 430.521 411.456C431.79 410.603 433.57 410.205 434.403 408.803C434.676 408.342 434.802 407.793 435.146 407.383C435.924 406.459 437.416 406.628 438.432 405.976C439.184 405.494 439.597 404.61 440.324 404.09C441.207 403.458 442.436 403.44 443.263 402.736C444.025 402.088 444.251 400.89 443.776 400.008C443.302 399.127 442.178 398.654 441.217 398.933C440.764 399.064 440.349 399.352 440.11 399.758C439.905 400.105 439.838 400.514 439.735 400.904C439.308 402.544 438.194 403.993 436.72 404.828C435.559 405.486 434.151 405.807 433.279 406.817C432.952 407.195 432.719 407.654 432.352 407.993C431.941 408.374 431.398 408.573 430.869 408.763C429.896 409.113 428.923 409.464 427.949 409.814C426.268 410.419 424.69 409.475 425.384 407.54C425.687 406.696 426.355 406.042 427.023 405.443C427.691 404.844 428.394 404.247 428.808 403.451C429.287 402.531 429.341 401.406 429.967 400.578C430.664 399.658 431.976 399.236 432.39 398.158C432.843 396.977 432.011 395.457 432.789 394.46C433.181 393.956 433.861 393.783 434.365 393.389C435.173 392.756 435.422 391.526 434.958 390.61C434.495 389.694 433.39 389.166 432.379 389.339C431.367 389.513 430.514 390.349 430.278 391.348C429.856 393.133 431.237 395.076 430.528 396.769C429.974 398.091 428.388 398.642 427.513 399.778C426.93 400.536 426.704 401.501 426.303 402.37C425.651 403.778 424.501 404.95 423.105 405.627C422.793 405.779 422.387 405.894 422.129 405.662C422.002 405.548 421.948 405.376 421.903 405.21C421.364 403.25 421.302 401.161 421.722 399.172C421.803 398.788 421.907 398.398 422.129 398.073C422.464 397.585 423.034 397.299 423.371 396.812C424.207 395.609 423.297 393.797 424.064 392.548C424.612 391.655 425.824 391.387 426.469 390.561C427.35 389.434 426.6 387.492 425.2 387.197C421.047 386.323 423.177 393.055 422.111 394.795C421.518 395.765 420.363 396.243 419.63 397.112C418.214 398.793 418.736 401.382 417.815 403.378C417.288 404.521 416.323 405.395 415.599 406.424C414.188 408.431 414.795 411.056 415.513 413.219C417.137 418.107 422.636 422.147 427.684 419.056C428.347 418.649 428.956 418.131 429.691 417.874C430.588 417.562 431.589 417.672 432.492 417.381C434.024 416.888 435.025 415.339 436.544 414.808C437.768 414.381 439.22 414.658 440.311 413.957C441.263 413.347 441.738 412.103 442.789 411.683C443.544 411.381 444.438 411.574 445.224 411.462Z"
                                fill="#FAFAFA" />
                            <path
                                d="M395.054 422.986C392.226 430.055 388.657 411.487 392.93 391.263C395.374 379.701 402.219 365.755 405.711 361.306C409.205 356.856 417.811 350.066 421.254 356.715C421.254 356.715 432.735 352.634 433.564 359.057C434.395 365.481 432.508 369.19 432.508 369.19C432.508 369.19 414.584 375.199 406.377 385.579C410.666 382.757 416.656 380.009 422.568 379.062C422.568 379.062 420.028 385.457 419.633 396.393C411.707 399.706 400.85 408.495 395.054 422.986Z"
                                fill="#BA68C8" />
                            <path opacity="0.3"
                                d="M395.054 422.986C392.226 430.055 388.657 411.487 392.93 391.263C395.374 379.701 402.219 365.755 405.711 361.306C409.205 356.856 417.811 350.066 421.254 356.715C421.254 356.715 432.735 352.634 433.564 359.057C434.395 365.481 432.508 369.19 432.508 369.19C432.508 369.19 414.584 375.199 406.377 385.579C410.666 382.757 416.656 380.009 422.568 379.062C422.568 379.062 420.028 385.457 419.633 396.393C411.707 399.706 400.85 408.495 395.054 422.986Z"
                                fill="white" />
                            <path opacity="0.65"
                                d="M416.72 384.641C417.187 384.717 417.46 385.195 417.667 385.62C418.468 387.27 419.27 388.92 420.071 390.57C419.868 392.334 419.71 394.275 419.634 396.392C411.706 399.707 400.848 408.497 395.052 422.986C393.783 426.158 392.367 424.158 391.574 419.169C391.942 413.455 393.76 407.799 396.673 402.848C401.157 395.224 408.061 389.199 415.796 384.909C416.083 384.75 416.398 384.588 416.72 384.641Z"
                                fill="#BA68C8" />
                            <path
                                d="M405.674 435.463C418.034 439.179 436.282 436.27 448.55 431.224C460.819 426.179 463.072 423.884 460.24 422.794C457.407 421.704 454.059 420.996 448.93 417.706C443.801 414.416 441.848 412.004 441.848 412.004C441.848 412.004 423.474 420.077 421.794 419.188C420.113 418.299 431.552 407.896 431.552 407.896C431.552 407.896 427.555 405.202 423.503 399.531C419.452 393.859 417.405 388.749 416.078 388.038C414.751 387.326 408.508 395.067 403.761 401.502C399.015 407.937 395.055 422.984 395.055 422.984L405.674 435.463Z"
                                fill="#BA68C8" />
                            <path opacity="0.4"
                                d="M405.674 435.463C418.034 439.179 436.282 436.27 448.55 431.224C460.819 426.179 463.072 423.884 460.24 422.794C457.407 421.704 454.059 420.996 448.93 417.706C443.801 414.416 441.848 412.004 441.848 412.004C441.848 412.004 423.474 420.077 421.794 419.188C420.113 418.299 431.552 407.896 431.552 407.896C431.552 407.896 427.555 405.202 423.503 399.531C419.452 393.859 417.405 388.749 416.078 388.038C414.751 387.326 408.508 395.067 403.761 401.502C399.015 407.937 395.055 422.984 395.055 422.984L405.674 435.463Z"
                                fill="white" />
                            <path
                                d="M382.489 451.406C389.243 454.791 395.733 459.503 403.275 459.95C395.876 464.989 386.024 467.172 376.75 467.959C367.476 468.746 357.512 466.508 349.02 462.699C342.526 459.786 336.811 455.205 330.02 452.975C328.016 452.317 324.098 450.737 322.016 451.63C325.955 449.939 330.025 448.554 334.176 447.486C350.267 443.349 367.445 443.864 382.489 451.406Z"
                                fill="#37474F" />
                            <path
                                d="M371.955 433.883C373.844 433.414 378.347 432.018 380.171 431.331C382.622 430.409 385.213 428.919 386.85 426.829C389.403 423.57 389.578 420.358 389.422 416.425C389.243 411.929 389.591 408.466 391.099 405.041C391.102 407.884 391.551 411.024 392.938 413.506C394.743 416.736 395.988 420.278 396.601 423.926C396.545 423.594 406.308 422.128 407.14 421.999C407.116 425.374 405.469 428.701 402.801 430.768C406.324 431.947 409.911 433.148 413.06 435.166C415.253 436.573 417.892 439.782 421.112 440.153C416.382 440.867 413.164 440.271 409.291 439.32C404.218 438.075 399.26 436.719 394.003 436.785C388.537 436.854 383.113 437.629 377.697 438.301C369.526 439.316 361.435 440.906 353.428 442.819C325.363 449.523 303.969 460.244 288.945 467.08C289.967 463.906 292.395 463.111 295.364 461.594C300.144 459.152 320.333 450.025 323.481 448.924C334.064 445.226 343.391 441.577 355.285 438.446C361.874 436.711 365.323 435.53 371.955 433.883Z"
                                fill="#455A64" />
                            <path
                                d="M325.884 449.878C328.994 448.683 332.618 448.857 335.885 449.124C339.546 449.424 343.126 450.175 346.678 451.089C354.433 453.084 361.957 455.796 369.554 458.298C373.775 459.689 378.328 460.782 382.763 459.827C382.799 459.819 382.805 459.912 382.773 459.922C375.559 462.006 368.23 459.193 361.371 457.068C353.865 454.745 346.246 452.282 338.447 451.173C334.215 450.571 330.093 450.813 325.852 451.106C324.888 451.172 325.28 450.11 325.884 449.878Z"
                                fill="#455A64" />
                            <path
                                d="M248.758 123.508C241.047 127.235 232.578 127.616 224.98 125.253L221.501 123.945C214.699 120.942 208.879 115.611 205.394 108.404C197.603 92.2868 204.376 72.8349 220.493 65.0433C227.7 61.5589 235.574 60.9958 242.769 62.8672L246.308 64.0036C253.732 66.8709 260.133 72.4291 263.86 80.1398C271.655 96.2613 264.881 115.713 248.758 123.508Z"
                                fill="#FAFAFA" />
                            <path
                                d="M266.337 78.9408C257.883 61.4547 236.778 54.106 219.292 62.5596C203.604 70.1443 196.089 87.9092 200.813 104.11L193.349 112.11C192.074 113.476 193.146 115.696 195.009 115.545L205.915 114.664C215.679 128.426 234.268 133.569 249.954 125.986C267.44 117.532 274.79 96.4268 266.337 78.9408ZM248.757 123.508C241.047 127.236 232.578 127.617 224.979 125.253L221.5 123.946C214.699 120.942 208.878 115.611 205.393 108.404C197.602 92.2871 204.375 72.8352 220.492 65.0436C227.699 61.5592 235.572 60.9961 242.769 62.8676L246.307 64.0039C253.731 66.8712 260.132 72.4294 263.859 80.1401C271.654 96.2616 264.88 115.714 248.757 123.508Z"
                                fill="#455A64" />
                            <path class="theme-color"
                                d="M234.628 114.164C211.717 101.959 209.869 88.8632 216.53 82.4598C222.498 76.7229 233.414 80.5062 234.628 88.7047C235.842 80.5062 246.758 76.7229 252.727 82.4598C259.388 88.8632 257.54 101.959 234.628 114.164Z"
                                fill="#8B4513" />
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
