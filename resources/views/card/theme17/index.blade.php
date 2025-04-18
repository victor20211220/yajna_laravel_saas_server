@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme17">
@else
<div class="{{ $business->theme_color }}" id="view_theme17">
@endif
        <main id="boxes">
            <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
                <div class="health-wellness-card">
                    <section class="profile-sec pb">
                        <div class="profile-banner-wrp">
                            <div class="profile-banner img-wrapper">
                                <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme17/images/profile-banner-img.png') }}" class="profile-banner-image" alt="profile-banner" id="banner_preview" loading="lazy">
                                <div class="profile-label">
                                    <span id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="client-info-wrp">
                                <div class="client-image">
                                    <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme17/images/client-image.png') }}"   alt="client-image" loading="lazy">
                                </div>
                                <div class="client-info">
                                    <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                                    <span id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                                </div>
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
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{ __('Services') }}</h2>
                                    </div>
                                    @if(isset($is_pdf))
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
                            @if ($order_key == 'testimonials')
                            <section class="testimonial-sec pb" id="testimonials-div">
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{__('Testimonial')}}</h2>
                                    </div>
                                    @php
                                        $t_image_count = 0;
                                    @endphp
                                    <div class="testimonial-slider-wrp d-flex" id="testimonials_{{ $testimonials_row_nos }}">
                                        <div class="testimonial-image-slider">
                                            @foreach ($testimonials_content as $k2 => $testi_content)
                                                <div class="testimonial-img-wrp">
                                                    <div class="testimonial-img-card">
                                                        <div class="testimonial-img img-wrapper">
                                                            <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                                src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                                alt="testimonial-image" loading="lazy">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $t_image_count++;
                                                @endphp
                                            @endforeach
                                        </div>

                                        <div class="testimonial-content-slider">
                                            @php
                                                $testimonials_row_nos = 0;
                                            @endphp
                                            @foreach ($testimonials_content as $k2 => $testi_content)
                                                <div class="testimonial-content-wrp">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-content-top">
                                                            <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                                {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                            </h3>
                                                            <span>{{ isset($testi_content->title) ? $testi_content->title : '' }}</span>
                                                        </div>
                                                        <div class="testimonial-content-bottom">
                                                            <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                                {{ isset($testi_content->description) ? $testi_content->description : '' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $testimonials_row_nos++;
                                                @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id=inputrow_testimonials_preview> </div>

                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'bussiness_hour')
                            <section class="business-hour-sec pb" id="business-hours-div">
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
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'contact_info')
                            <section class="contact-info-sec pb" id="contact-div">
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{__('Contact us')}}</h2>
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
                                                                <div class="contact-image">
                                                                    <img src="{{ asset('custom/theme17/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                                        <img src="{{ asset('custom/theme17/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                                    </div>
                                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                                @else
                                                                    <div class="contact-image">
                                                                        <img src="{{ asset('custom/theme17/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                            <section class="product-sec pb"  id="product-div">
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{__('Product')}}</h2>
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
                                    @endif
                                </div>
                            </section>
                            @endif
                            @if ($order_key == 'appointment')
                            <section class="appointment-sec pb" id="appointment-div">
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{ __('Make An Appointment') }}</h2>
                                    </div>
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
                                <div class="container">
                                    <div class="section-title common-title text-center">
                                        <h2>{{__('More')}}</h2>
                                    </div>
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
                                        <ul class="d-flex align-items-center">
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
                                            <svg width="575" height="568" viewBox="0 0 575 568" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8008 66.5058L53.2233 2.59687C54.2885 0.778091 56.5584 0.0636145 58.4724 0.94367L125.769 31.8629L15.8008 66.5058Z" fill="#F5F5F5"/>
                                                <path d="M125.777 31.8577L15.8086 66.5039L40.8309 145.926L150.799 111.28L125.777 31.8577Z" fill="#F5F5F5"/>
                                                <path d="M23.3789 64.1187L56.1509 8.14981C56.7819 7.07288 58.1261 6.64785 59.2617 7.16936L118.197 34.2464L23.3789 64.1187Z" fill="#EBEBEB"/>
                                                <path d="M15.8008 66.5055L80.2182 90.4913C82.5194 91.3478 85.3356 90.4613 86.7306 88.4391L125.769 31.8613L15.8008 66.5055Z" fill="#EBEBEB"/>
                                                <path d="M86.7319 88.4392C86.7254 88.434 86.7801 88.3402 86.8949 88.1602C87.0252 87.9594 87.196 87.6987 87.4151 87.3623C87.9001 86.64 88.5898 85.61 89.4816 84.2815C91.3238 81.5722 93.994 77.6465 97.376 72.6752C104.216 62.6947 113.931 48.5186 125.503 31.6346L125.842 32.0936C109.487 37.2578 90.5963 43.2227 70.5649 49.5473C50.7591 55.7729 32.0694 61.6478 15.8438 66.7469L15.8607 66.1758C35.1255 73.5787 51.3106 79.7991 62.7096 84.1798C68.3668 86.3767 72.8348 88.112 75.9183 89.3102C77.4203 89.9047 78.5845 90.3649 79.4007 90.6883C79.7749 90.8421 80.0669 90.9621 80.2912 91.0533C80.4894 91.1381 80.5898 91.185 80.5858 91.1915C80.5832 91.1994 80.4776 91.1681 80.2729 91.099C80.0461 91.0181 79.7475 90.9138 79.3655 90.7782C78.5415 90.4758 77.3655 90.0442 75.8492 89.4862C72.7514 88.3258 68.2625 86.6439 62.5793 84.5149C51.1594 80.1902 34.9442 74.0494 15.643 66.7403L14.8281 66.4313L15.6599 66.1693C31.879 61.048 50.561 55.1497 70.359 48.898C90.3968 42.5995 109.296 36.6594 125.658 31.5173L126.497 31.2539L125.997 31.9762C114.342 48.8029 104.557 62.9307 97.668 72.8773C94.2273 77.8082 91.5103 81.7013 89.6341 84.3884C88.7097 85.6948 87.9939 86.7065 87.492 87.4171C87.256 87.7417 87.0722 87.9947 86.9327 88.1876C86.8075 88.3597 86.7384 88.4431 86.7319 88.4392Z" fill="#E0E0E0"/>
                                                <path d="M40.8164 145.927L80.5819 91.194C82.0043 89.237 84.5389 88.4378 86.827 89.2266L150.784 111.284" fill="#F5F5F5"/>
                                                <path d="M150.785 111.284C150.781 111.295 150.66 111.266 150.427 111.197C150.158 111.113 149.818 111.008 149.396 110.877C148.447 110.566 147.129 110.134 145.455 109.585C141.994 108.418 137.068 106.759 131.003 104.716C124.894 102.631 117.643 100.156 109.597 97.4106C105.57 96.0286 101.344 94.5775 96.9648 93.0742C94.7744 92.3206 92.5462 91.554 90.2842 90.7756C89.1538 90.3858 88.0143 89.9934 86.8683 89.5983C85.7809 89.198 84.5919 89.155 83.4863 89.5018C82.3806 89.8499 81.4289 90.567 80.7679 91.5162C80.0547 92.4966 79.3454 93.4719 78.6427 94.4393C77.2346 96.3741 75.8474 98.2802 74.4849 100.154C71.7574 103.897 69.1251 107.508 66.6166 110.949C61.597 117.812 57.0729 123.996 53.2619 129.206C49.464 134.357 46.3792 138.54 44.211 141.48C43.1537 142.889 42.3218 143.999 41.7221 144.797C41.4509 145.146 41.2332 145.426 41.0611 145.649C40.9085 145.84 40.8264 145.934 40.8173 145.926C40.8081 145.919 40.872 145.811 41.005 145.608C41.1628 145.374 41.3636 145.081 41.6113 144.716C42.1849 143.9 42.9829 142.765 43.9972 141.325C46.1237 138.355 49.1485 134.129 52.8734 128.924C56.6504 123.691 61.1342 117.477 66.1094 110.581C68.6074 107.133 71.2281 103.514 73.9451 99.7626C75.305 97.8878 76.6896 95.979 78.0951 94.0429C78.7978 93.0742 79.5058 92.099 80.219 91.1185C80.9426 90.0768 82.0377 89.2411 83.2829 88.8551C84.5241 88.4588 85.9009 88.5175 87.0886 88.9582C88.2346 89.3545 89.3741 89.7469 90.5045 90.1381C92.7653 90.919 94.9922 91.6896 97.1812 92.4458C101.557 93.9621 105.778 95.4249 109.801 96.8187C117.829 99.6166 125.064 102.138 131.159 104.262C137.196 106.391 142.097 108.121 145.541 109.336C147.197 109.936 148.502 110.408 149.441 110.748C149.854 110.905 150.187 111.031 150.449 111.132C150.676 111.222 150.789 111.274 150.785 111.284Z" fill="#E0E0E0"/>
                                                <path d="M508.463 27.1032L446.41 13.748L436.765 58.5636L498.818 71.9187L508.463 27.1032Z" fill="#F5F5F5"/>
                                                <path d="M446.422 13.7441L470.719 42.756C471.588 43.7925 473.177 44.1341 474.395 43.5474L508.476 27.0988L446.422 13.7441Z" fill="#F5F5F5"/>
                                                <path d="M474.388 43.5461C474.381 43.5317 474.589 43.4131 474.998 43.1967C475.45 42.9646 476.054 42.6569 476.815 42.2658C478.463 41.447 480.796 40.2866 483.736 38.8264C489.752 35.885 498.242 31.7338 508.342 26.7937L508.41 27.3596C499.17 25.3831 488.51 23.1014 477.204 20.6829C466.034 18.2657 455.497 15.9854 446.339 14.0023L446.637 13.5147C453.808 22.297 459.838 29.6829 464.113 34.9176C466.192 37.4978 467.843 39.5461 469.008 40.992C469.543 41.6712 469.967 42.2097 470.284 42.6126C470.568 42.9829 470.71 43.1797 470.697 43.1902C470.684 43.2006 470.518 43.0246 470.209 42.6739C469.874 42.2853 469.427 41.7664 468.862 41.1119C467.665 39.6908 465.971 37.6791 463.836 35.1445C459.516 29.9476 453.419 22.6164 446.171 13.898L445.613 13.2266L446.469 13.4091C455.632 15.37 466.174 17.6255 477.349 20.0167C488.649 22.4626 499.304 24.769 508.539 26.7677L509.401 26.9541L508.607 27.3335C498.462 32.1823 489.935 36.2579 483.894 39.1458C480.922 40.5422 478.565 41.6504 476.9 42.434C476.121 42.7886 475.505 43.0702 475.041 43.2814C474.617 43.4718 474.394 43.5617 474.388 43.5461Z" fill="#E0E0E0"/>
                                                <path d="M436.773 58.5599L470.701 43.1922C471.914 42.642 473.345 42.9497 474.225 43.951L498.827 71.9146" fill="#F5F5F5"/>
                                                <path d="M498.823 71.9134C498.806 71.929 498.608 71.7387 498.246 71.3606C497.84 70.9251 497.325 70.371 496.69 69.6891C495.302 68.152 493.394 66.0385 491.063 63.457C488.688 60.7895 485.886 57.6408 482.784 54.1558C481.23 52.3983 479.6 50.5574 477.912 48.6486C477.068 47.693 476.211 46.719 475.34 45.7321C474.904 45.2379 474.466 44.7399 474.024 44.2392C473.628 43.7712 473.106 43.4505 472.514 43.3214C471.922 43.1949 471.312 43.2718 470.759 43.5352C470.151 43.8103 469.547 44.0841 468.946 44.3553C467.745 44.8977 466.563 45.4309 465.4 45.9563C463.075 47.002 460.832 48.0111 458.692 48.9733C454.43 50.8742 450.581 52.59 447.317 54.045C444.131 55.4401 441.523 56.5809 439.625 57.4114C438.766 57.7725 438.068 58.0646 437.519 58.2954C437.034 58.4909 436.776 58.5822 436.766 58.5613C436.757 58.5405 436.997 58.4062 437.462 58.1702C437.997 57.9094 438.677 57.5783 439.516 57.1702C441.392 56.2914 443.968 55.0841 447.118 53.6082C450.363 52.1154 454.192 50.354 458.431 48.4035C460.565 47.4296 462.804 46.4087 465.122 45.3514C466.284 44.8233 467.465 44.2862 468.663 43.7412C469.263 43.4687 469.866 43.1949 470.475 42.9185C471.127 42.6056 471.92 42.4961 472.653 42.659C473.387 42.8129 474.065 43.2392 474.529 43.7933C474.969 44.2953 475.407 44.7933 475.842 45.2875C476.71 46.2771 477.565 47.2523 478.406 48.2106C480.084 50.1284 481.703 51.9785 483.248 53.7438C486.31 57.2654 489.075 60.4453 491.419 63.1402C493.683 65.7817 495.535 67.9421 496.883 69.5157C497.479 70.2328 497.963 70.8143 498.344 71.2719C498.677 71.6774 498.842 71.899 498.823 71.9134Z" fill="#E0E0E0"/>
                                                <path d="M57.5385 392.754L0.9375 426.127L25.0406 467.006L81.6417 433.633L57.5385 392.754Z" fill="#F5F5F5"/>
                                                <path d="M0.9375 426.131L39.7877 431.166C41.1762 431.346 42.626 430.492 43.1397 429.189L57.54 392.758L0.9375 426.131Z" fill="#F5F5F5"/>
                                                <path d="M43.1383 429.19C43.1227 429.183 43.1996 428.947 43.36 428.496C43.5412 428.005 43.785 427.346 44.0927 426.513C44.772 424.737 45.7355 422.217 46.9506 419.04C49.4656 412.583 53.0158 403.466 57.2414 392.617L57.6756 392.988C49.2557 397.965 39.5412 403.709 29.2374 409.8C19.0405 415.797 9.41855 421.454 1.05867 426.372L0.94655 425.812C12.5685 427.464 22.3417 428.853 29.2661 429.836C32.6611 430.341 35.3561 430.74 37.2544 431.023C38.1409 431.165 38.8398 431.277 39.3626 431.361C39.8398 431.443 40.0849 431.492 40.0823 431.509C40.0797 431.526 39.8306 431.508 39.3495 431.457C38.8241 431.396 38.1201 431.315 37.2283 431.212C35.3248 430.969 32.622 430.627 29.2165 430.194C22.2856 429.269 12.4994 427.964 0.864412 426.411L0 426.297L0.752289 425.852C9.10173 420.916 18.7093 415.237 28.8932 409.216C39.21 403.148 48.9389 397.427 57.3705 392.469L58.1306 392.021L57.8033 392.839C53.4839 403.651 49.8541 412.736 47.2844 419.171C46.0028 422.321 44.9871 424.821 44.27 426.582C43.9258 427.402 43.6547 428.048 43.4513 428.531C43.2596 428.971 43.1527 429.195 43.1383 429.19Z" fill="#E0E0E0"/>
                                                <path d="M25.0352 467.01L40.0769 431.508C40.6154 430.238 41.9192 429.468 43.2908 429.613L81.6377 433.637" fill="#F5F5F5"/>
                                                <path d="M81.6342 433.638C81.6316 433.661 81.3473 433.655 80.8076 433.619C80.1974 433.572 79.4164 433.511 78.4503 433.435C76.3212 433.239 73.3851 432.967 69.7958 432.636C66.1178 432.271 61.7762 431.841 56.9679 431.364C54.5519 431.116 52.02 430.858 49.3955 430.589C48.0826 430.454 46.7462 430.316 45.3902 430.175C44.7123 430.104 44.0291 430.033 43.342 429.961C42.711 429.883 42.0851 430.005 41.5415 430.323C40.9991 430.644 40.5884 431.133 40.3511 431.722C40.0812 432.359 39.8127 432.991 39.5467 433.618C39.0134 434.872 38.488 436.11 37.9704 437.325C36.9352 439.751 35.9352 442.093 34.9821 444.327C33.0721 448.765 31.3472 452.775 29.8856 456.168C28.4384 459.471 27.2546 462.17 26.3954 464.128C25.9938 465.009 25.6692 465.721 25.4149 466.279C25.1842 466.768 25.0525 467.02 25.0303 467.011C25.0095 467.001 25.0981 466.732 25.2885 466.226C25.5127 465.656 25.7983 464.926 26.1516 464.025C26.9612 462.046 28.0773 459.317 29.4423 455.981C30.8648 452.57 32.544 448.542 34.4045 444.082C35.3459 441.844 36.3328 439.497 37.3563 437.064C37.87 435.847 38.3928 434.61 38.9222 433.353C39.1881 432.725 39.4554 432.093 39.724 431.456C40.0004 430.763 40.5245 430.125 41.1947 429.737C41.8583 429.34 42.6705 429.19 43.4111 429.286C44.0982 429.359 44.7814 429.43 45.4593 429.502C46.814 429.645 48.1504 429.787 49.4633 429.927C52.0852 430.209 54.6171 430.481 57.0317 430.741C61.8336 431.272 66.1713 431.751 69.844 432.158C73.4242 432.579 76.3525 432.923 78.4764 433.172C79.436 433.299 80.213 433.402 80.8206 433.482C81.3565 433.562 81.6368 433.614 81.6342 433.638Z" fill="#E0E0E0"/>
                                                <path d="M14.5386 245.083C14.7094 240.545 16.566 236.167 19.3222 232.56C22.0224 229.025 25.6795 226.123 29.9402 224.847C34.467 223.492 39.5426 224.088 43.6287 226.458C46.0603 227.867 48.1202 229.891 49.6183 232.268C50.733 229.972 52.3406 227.916 54.3275 226.315C58.0068 223.35 62.9312 221.986 67.6105 222.635C72.016 223.247 76.0734 225.558 79.2807 228.639C82.5545 231.784 85.0591 235.828 85.9183 240.286C86.9952 245.869 86.3785 252.119 83.8296 257.201C81.1373 262.569 76.471 267.096 71.5792 270.578C63.355 276.435 52.4997 283.81 52.4997 283.81C52.4997 283.81 42.351 277.37 33.3301 272.836C27.965 270.14 22.6625 266.379 19.184 261.484C15.888 256.848 14.3261 250.765 14.5386 245.083Z" fill="#EBEBEB"/>
                                                <path d="M515.655 212.013C515.991 208.305 517.701 204.799 520.116 201.964C522.481 199.187 525.602 196.968 529.146 196.108C532.911 195.194 537.043 195.903 540.287 198.022C542.217 199.281 543.818 201.028 544.94 203.039C545.953 201.207 547.359 199.593 549.055 198.367C552.197 196.099 556.29 195.195 560.094 195.93C563.676 196.621 566.897 198.692 569.391 201.354C571.936 204.071 573.811 207.492 574.322 211.181C574.961 215.8 574.185 220.891 571.878 224.943C569.44 229.222 565.421 232.727 561.265 235.367C554.275 239.807 545.065 245.376 545.065 245.376C545.065 245.376 537.034 239.661 529.842 235.556C525.565 233.114 521.386 229.805 518.748 225.645C516.249 221.706 515.235 216.657 515.655 212.013Z" fill="#EBEBEB"/>
                                                <path d="M485.479 421.525C485.729 418.761 487.004 416.148 488.803 414.036C490.566 411.966 492.892 410.313 495.535 409.671C498.342 408.991 501.42 409.519 503.839 411.098C505.277 412.036 506.47 413.339 507.307 414.837C508.062 413.472 509.11 412.268 510.373 411.354C512.715 409.663 515.764 408.991 518.6 409.538C521.27 410.053 523.671 411.596 525.53 413.58C527.427 415.605 528.824 418.155 529.204 420.905C529.681 424.348 529.102 428.142 527.382 431.163C525.565 434.352 522.57 436.965 519.472 438.932C514.262 442.241 507.398 446.392 507.398 446.392C507.398 446.392 501.412 442.133 496.051 439.073C492.863 437.253 489.747 434.786 487.783 431.686C485.922 428.749 485.166 424.987 485.479 421.525Z" fill="#EBEBEB"/>
                                                <path d="M508.912 148.882C509.091 146.912 510 145.05 511.282 143.544C512.539 142.069 514.196 140.889 516.079 140.433C518.079 139.948 520.273 140.325 521.997 141.449C523.022 142.117 523.872 143.046 524.469 144.114C525.007 143.141 525.753 142.283 526.655 141.632C528.324 140.428 530.498 139.948 532.518 140.338C534.421 140.705 536.133 141.805 537.457 143.219C538.809 144.662 539.805 146.48 540.077 148.44C540.417 150.893 540.003 153.597 538.778 155.75C537.483 158.022 535.349 159.884 533.14 161.287C529.427 163.646 524.535 166.604 524.535 166.604C524.535 166.604 520.269 163.567 516.449 161.387C514.177 160.09 511.958 158.333 510.556 156.123C509.228 154.03 508.689 151.348 508.912 148.882Z" fill="#EBEBEB"/>
                                                <path d="M517.795 370.505C517.974 368.535 518.882 366.673 520.165 365.168C521.422 363.693 523.079 362.514 524.962 362.057C526.962 361.572 529.156 361.949 530.88 363.074C531.904 363.743 532.755 364.671 533.352 365.739C533.89 364.766 534.636 363.908 535.537 363.257C537.206 362.053 539.379 361.573 541.4 361.963C543.302 362.33 545.014 363.43 546.339 364.843C547.691 366.286 548.687 368.104 548.958 370.063C549.297 372.517 548.885 375.221 547.659 377.374C546.365 379.646 544.23 381.508 542.022 382.911C538.309 385.269 533.417 388.228 533.417 388.228C533.417 388.228 529.151 385.191 525.331 383.011C523.058 381.714 520.839 379.956 519.438 377.746C518.112 375.654 517.572 372.972 517.795 370.505Z" fill="#EBEBEB"/>
                                                <path d="M189.427 81.2045C189.616 79.1133 190.581 77.1367 191.943 75.5383C193.277 73.9724 195.037 72.7208 197.036 72.2358C199.16 71.7208 201.49 72.1211 203.319 73.3153C204.407 74.0259 205.31 75.0103 205.942 76.1446C206.513 75.112 207.306 74.2006 208.263 73.5096C210.035 72.2306 212.342 71.7208 214.488 72.1354C216.508 72.5252 218.325 73.6921 219.731 75.1941C221.166 76.726 222.224 78.6556 222.512 80.7352C222.873 83.3401 222.435 86.2111 221.134 88.4966C219.76 90.9099 217.492 92.8865 215.148 94.3754C211.207 96.8786 206.012 100.019 206.012 100.019C206.012 100.019 201.483 96.7965 197.427 94.4823C195.015 93.1055 192.658 91.2385 191.171 88.893C189.763 86.6713 189.19 83.8238 189.427 81.2045Z" fill="#EBEBEB"/>
                                                <path d="M346.654 33.2273C346.745 32.2234 347.208 31.2743 347.861 30.5063C348.501 29.7541 349.346 29.153 350.307 28.9209C351.327 28.6732 352.445 28.8662 353.324 29.4385C353.847 29.7801 354.28 30.2521 354.583 30.7971C354.857 30.3016 355.238 29.8636 355.698 29.5324C356.548 28.9183 357.656 28.6732 358.688 28.8727C359.658 29.0604 360.53 29.6198 361.205 30.3408C361.895 31.0761 362.402 32.0031 362.54 33.0018C362.714 34.2521 362.504 35.6315 361.878 36.728C361.218 37.8871 360.13 38.8362 359.005 39.5507C357.111 40.7528 354.617 42.2613 354.617 42.2613C354.617 42.2613 352.443 40.7137 350.495 39.6015C349.337 38.9405 348.204 38.0448 347.491 36.9184C346.814 35.8519 346.54 34.4855 346.654 33.2273Z" fill="#EBEBEB"/>
                                                <path d="M548.317 527.519C548.317 527.706 428.84 527.858 281.492 527.858C134.092 527.858 14.6406 527.705 14.6406 527.519C14.6406 527.332 134.092 527.18 281.492 527.18C428.839 527.18 548.317 527.332 548.317 527.519Z" fill="#263238"/>
                                                <path d="M60.6758 311.858L213.696 183.346C218.049 179.689 224.684 179.689 229.037 183.346L382.056 311.858H60.6758Z" fill="#FF725E"/>
                                                <path d="M382.056 311.857H60.6758V527.122H382.056V311.857Z" fill="#FF725E"/>
                                                <g opacity="0.3">
                                                <path d="M82.8125 311.859L216.819 199.315C219.4 197.148 223.331 197.148 225.911 199.315L359.918 311.859H82.8125Z" fill="black"/>
                                                </g>
                                                <g opacity="0.3">
                                                <path d="M60.6758 311.857L211.85 421.036C217.251 424.937 225.482 424.937 230.884 421.036L382.058 311.857H60.6758Z" fill="black"/>
                                                </g>
                                                <path d="M230.885 421.036C230.885 421.036 231.114 420.851 231.577 420.506C232.053 420.155 232.744 419.645 233.653 418.975C235.5 417.626 238.223 415.637 241.769 413.049C248.894 407.872 259.317 400.3 272.55 390.684C299.063 371.473 336.828 344.109 381.882 311.462L382.058 312.006C334.429 312.018 279.182 312.031 220.551 312.045C162.542 312.031 107.852 312.018 60.5884 312.007L60.7671 311.464C105.935 344.689 143.819 372.558 170.423 392.129C183.702 401.923 194.163 409.64 201.315 414.915C204.874 417.553 207.607 419.579 209.462 420.954C210.375 421.637 211.07 422.158 211.547 422.514C212.013 422.866 212.243 423.055 212.243 423.055C212.243 423.055 211.994 422.892 211.519 422.553C211.035 422.205 210.331 421.697 209.406 421.031C207.539 419.673 204.787 417.673 201.204 415.066C194.028 409.823 183.534 402.152 170.212 392.416C143.573 372.893 105.638 345.094 60.4098 311.949L59.668 311.405H60.5884C107.852 311.393 162.543 311.38 220.551 311.367C279.181 311.382 334.429 311.395 382.058 311.406H382.987L382.234 311.95C337.12 344.515 299.306 371.811 272.759 390.974C259.484 400.53 249.027 408.057 241.878 413.203C238.31 415.76 235.568 417.722 233.709 419.055C232.787 419.708 232.087 420.206 231.605 420.547C231.133 420.877 230.885 421.036 230.885 421.036Z" fill="#263238"/>
                                                <path d="M374.152 143.5H79.1133V484.161H374.152V143.5Z" fill="white"/>
                                                <path d="M374.153 484.162C374.15 481.556 374.031 346.64 373.853 143.501L374.153 143.801C287.16 143.813 186.243 143.826 79.1437 143.84H79.1137L79.4527 143.501C79.4332 269.168 79.4149 386.305 79.3993 484.162L79.1124 483.875C256.748 484.048 371.744 484.159 374.153 484.162C371.747 484.165 256.749 484.275 79.1137 484.449H78.8269V484.162C78.8112 386.305 78.793 269.166 78.7734 143.501V143.162H79.1124H79.1424C186.241 143.176 287.159 143.189 374.151 143.201H374.452V143.501C374.274 346.64 374.155 481.558 374.153 484.162Z" fill="#263238"/>
                                                <g opacity="0.2">
                                                <path d="M311.895 173.365C301.14 158.381 278.733 154.981 261.987 162.711C245.24 170.441 233.914 187.025 228.289 204.591C222.664 222.157 221.995 240.869 221.373 259.303C220.75 240.869 220.081 222.157 214.456 204.591C208.83 187.025 197.504 170.441 180.759 162.711C164.011 154.981 141.606 158.381 130.85 173.365C120.964 187.139 122.886 205.901 126.193 222.53C140.293 293.457 182.954 371.356 220.555 433.188L220.551 434.039C258.196 372.16 302.432 293.57 316.554 222.53C319.858 205.903 321.78 187.139 311.895 173.365Z" fill="#FF725E"/>
                                                </g>
                                                <path d="M230.884 421.038C225.482 424.939 217.251 424.939 211.85 421.038L60.6758 311.859V527.123H382.056V311.859L230.884 421.038Z" fill="#AFD977" class="theme-color"/>
                                                <path d="M60.6758 527.122L212.242 423.053C217.663 419.331 225.07 419.331 230.491 423.053L382.056 527.122" fill="#AFD977" class="theme-color"/>
                                                <path d="M382.056 527.122C382.056 527.122 381.764 526.95 381.213 526.585C380.647 526.206 379.835 525.662 378.776 524.953C376.625 523.494 373.484 521.362 369.442 518.622C361.336 513.087 349.639 505.1 335.188 495.233C320.735 485.335 303.533 473.554 284.434 460.473C274.886 453.925 264.865 447.052 254.477 439.928C249.284 436.363 243.998 432.737 238.635 429.056C235.953 427.215 233.251 425.361 230.533 423.494C227.886 421.624 224.654 420.602 221.376 420.603C218.099 420.598 214.863 421.617 212.215 423.486C209.495 425.353 206.792 427.208 204.11 429.049C198.745 432.731 193.458 436.359 188.263 439.924C177.872 447.05 167.848 453.924 158.299 460.473C139.198 473.555 121.994 485.337 107.542 495.236C93.0905 505.103 81.3929 513.09 73.2886 518.623C69.2482 521.364 66.1073 523.494 63.9561 524.953C62.8974 525.662 62.0852 526.206 61.5193 526.585C60.9678 526.95 60.6758 527.122 60.6758 527.122C60.6758 527.122 60.9417 526.911 61.4802 526.528C62.0369 526.135 62.8362 525.574 63.8792 524.841C66.0135 523.357 69.1295 521.191 73.1387 518.405C81.2143 512.83 92.8688 504.782 107.269 494.839C121.698 484.907 138.874 473.084 157.945 459.957C167.487 453.397 177.503 446.512 187.886 439.375C193.079 435.808 198.363 432.177 203.727 428.492C206.409 426.65 209.11 424.795 211.83 422.926C214.577 420.986 217.966 419.915 221.376 419.924C224.786 419.92 228.172 420.994 230.916 422.936C233.635 424.803 236.336 426.658 239.017 428.499C244.378 432.182 249.662 435.812 254.854 439.379C265.234 446.515 275.249 453.399 284.789 459.957C303.857 473.082 321.031 484.905 335.46 494.837C349.861 504.779 361.516 512.828 369.592 518.404C373.601 521.19 376.719 523.357 378.853 524.84C379.896 525.574 380.695 526.135 381.252 526.528C381.79 526.911 382.056 527.122 382.056 527.122Z" fill="#263238"/>
                                                <path d="M169.028 284.133H158.367V216.287H169.028V245.364H181.144V216.287H192V284.133H181.144V255.056H169.028V284.133Z" fill="#263238"/>
                                                <path d="M251.445 293.322V347.058C251.445 352.033 253.636 353.826 257.118 353.826C260.602 353.826 262.791 352.034 262.791 347.058V293.322H273.14V346.362C273.14 357.506 267.568 363.875 256.821 363.875C246.072 363.875 240.5 357.506 240.5 346.362V293.322H251.445Z" fill="#263238"/>
                                                <path d="M233.336 278.578H222.148L220.233 265.779H206.626L204.711 278.578H194.531L205.819 208.029H222.046L233.336 278.578ZM208.038 256.204H218.722L213.38 220.526L208.038 256.204Z" fill="#263238"/>
                                                <path d="M248.525 233.035V284.131H238.547V213.582H252.454L263.843 255.81V213.582H273.719V284.131H262.331L248.525 233.035Z" fill="#263238"/>
                                                <path d="M298.388 241.764L296.122 248.392L299.408 268.914L288.908 270.596L278.211 203.781L288.709 202.1L293.37 231.212L302.454 199.899L312.954 198.219L303.118 230.336L323.652 265.034L312.867 266.76L298.388 241.764Z" fill="#263238"/>
                                                <path d="M200.617 322.572C200.617 311.284 206.564 304.834 217.448 304.834C228.332 304.834 234.278 311.284 234.278 322.572V359.258C234.278 370.545 228.332 376.995 217.448 376.995C206.564 376.995 200.617 370.545 200.617 359.258V322.572ZM211.703 359.963C211.703 365.002 213.921 366.918 217.448 366.918C220.975 366.918 223.192 365.002 223.192 359.963V321.867C223.192 316.827 220.975 314.912 217.448 314.912C213.921 314.912 211.703 316.827 211.703 321.867V359.963Z" fill="#263238"/>
                                                <path d="M175.767 339.597L161.758 292.43H173.348L181.814 324.578L190.281 292.43H200.864L186.854 339.597V362.979H175.768L175.767 339.597Z" fill="#263238"/>
                                                <path d="M124.32 197.631H158.62V207.72H147.019V268.249H135.923V207.72H124.322L124.32 197.631Z" fill="#263238"/>
                                                <path d="M296.082 334.181L294.16 343.108L285.234 341.186L287.156 332.26L296.082 334.181ZM289.053 328.351L292.46 306.792L297.752 282.201L307.015 284.195L301.723 308.785L295.959 329.836L289.053 328.351Z" fill="#263238"/>
                                                <path d="M147.807 289.026C144.418 286.405 139.206 287.135 135.992 289.968C132.778 292.801 131.358 297.243 131.273 301.526C131.187 305.809 132.281 310.018 133.366 314.161C132.003 310.1 130.612 305.98 128.194 302.444C125.775 298.908 122.155 295.97 117.915 295.361C113.675 294.752 108.913 296.997 107.516 301.045C106.23 304.766 107.903 308.815 109.743 312.296C117.589 327.144 132.255 341.648 144.727 352.912L144.783 353.103C149.053 336.833 153.68 316.406 152.106 299.659C151.739 295.738 150.921 291.434 147.807 289.026Z" fill="#AFD977" class="theme-color"/>
                                                <path d="M356.238 304.957C356.089 301.79 353.215 299.297 350.12 298.95C347.025 298.604 343.885 300.043 341.467 302.135C339.048 304.227 337.228 306.928 335.44 309.593C337.051 306.817 338.679 303.997 339.498 300.906C340.317 297.815 340.233 294.361 338.563 291.733C336.893 289.104 333.392 287.615 330.481 288.869C327.805 290.023 326.349 292.962 325.288 295.709C320.759 307.426 319.649 322.71 319.301 335.175L319.223 335.3C330.28 329.515 343.816 321.85 352.371 312.624C354.373 310.465 356.375 307.867 356.238 304.957Z" fill="#AFD977" class="theme-color"/>
                                                <path d="M285.276 172.278C285.276 172.29 285.16 172.301 284.933 172.313C284.667 172.322 284.336 172.333 283.927 172.347C282.989 172.363 281.695 172.383 280.056 172.411C276.639 172.437 271.79 172.473 265.821 172.519C253.753 172.545 237.172 172.58 218.856 172.618C200.534 172.579 183.951 172.544 171.883 172.519C165.915 172.473 161.066 172.437 157.649 172.411C156.01 172.383 154.717 172.363 153.779 172.347C153.37 172.334 153.039 172.322 152.773 172.313C152.546 172.301 152.43 172.29 152.43 172.278C152.43 172.266 152.546 172.254 152.773 172.243C153.039 172.233 153.37 172.223 153.779 172.209C154.717 172.193 156.01 172.172 157.649 172.145C161.065 172.119 165.913 172.082 171.883 172.037C183.951 172.011 200.534 171.977 218.856 171.938C237.172 171.977 253.753 172.012 265.821 172.037C271.79 172.082 276.64 172.119 280.056 172.145C281.695 172.172 282.989 172.193 283.927 172.209C284.336 172.222 284.667 172.233 284.933 172.243C285.16 172.254 285.276 172.266 285.276 172.278Z" fill="#263238"/>
                                                <path d="M320.919 84.3201L316.219 73.3722C318.902 67.071 319.933 59.9745 318.838 52.7046C315.69 31.7997 296.192 17.4046 275.287 20.5532C254.382 23.7019 239.987 43.2 243.135 64.1062C246.284 85.0111 265.782 99.4062 286.687 96.2575C295.416 94.942 303.003 90.7699 308.658 84.8416L308.648 84.8612L320.919 84.3201Z" fill="white"/>
                                                <path d="M320.928 84.3197C320.928 84.3197 320.675 84.3406 320.156 84.3693C319.619 84.3979 318.843 84.4397 317.826 84.4944C315.735 84.6 312.662 84.7565 308.663 84.9586L308.491 84.9677L308.572 84.8139L308.582 84.7943L308.74 84.909C305.355 88.4723 300.135 92.5883 292.827 94.969C291.011 95.5662 289.074 96.0381 287.04 96.3628C284.995 96.587 282.877 96.9013 280.673 96.8139C276.282 96.7917 271.599 96.0069 267.021 94.2194C262.448 92.4423 257.989 89.6665 254.152 85.9273C250.313 82.1985 247.109 77.4983 245.043 72.1385C242.946 66.7942 242.14 60.7734 242.701 54.7525C243.272 48.7368 245.249 42.6716 248.754 37.4226C249.197 36.7655 249.625 36.0992 250.079 35.4538C250.577 34.8424 251.075 34.2322 251.57 33.622L252.315 32.7094L253.136 31.871C253.685 31.3143 254.234 30.7602 254.78 30.2074C255.346 29.6742 255.964 29.2022 256.552 28.6989C257.156 28.2152 257.714 27.6742 258.371 27.2687C259.651 26.4147 260.875 25.4851 262.246 24.811C267.565 21.8449 273.444 20.2348 279.205 19.944C284.976 19.6937 290.595 20.7667 295.565 22.8189C300.544 24.8671 304.874 27.8776 308.332 31.3834C311.8 34.8906 314.392 38.8867 316.16 42.9193C317.097 44.9219 317.675 46.9858 318.26 48.9637C318.655 50.9885 319.123 52.9298 319.259 54.8424C319.959 62.5022 318.257 68.9207 316.32 73.407V73.3314C317.827 76.9077 318.986 79.6587 319.775 81.5309C320.156 82.4436 320.447 83.1385 320.649 83.6209C320.839 84.0902 320.928 84.3197 320.928 84.3197C320.928 84.3197 320.81 84.072 320.6 83.5987C320.387 83.115 320.079 82.4162 319.676 81.5009C318.868 79.6535 317.681 76.939 316.138 73.4096L316.121 73.3718L316.138 73.3327C318.029 68.8529 319.681 62.4683 318.954 54.8724C318.81 52.9754 318.337 51.051 317.939 49.0445C317.351 47.0862 316.772 45.0432 315.836 43.0614C314.071 39.0706 311.493 35.1214 308.053 31.6572C304.621 28.1944 300.33 25.2243 295.402 23.2074C290.483 21.1852 284.928 20.1331 279.223 20.386C273.527 20.6794 267.719 22.2778 262.466 25.21C261.111 25.8749 259.904 26.7954 258.639 27.6403C257.99 28.0405 257.44 28.5764 256.843 29.0536C256.262 29.5516 255.651 30.0171 255.093 30.5438C254.553 31.0914 254.011 31.639 253.468 32.1892L252.658 33.0184L251.923 33.9206C251.433 34.5216 250.942 35.1253 250.449 35.7303C250.002 36.3678 249.578 37.0262 249.14 37.6755C245.676 42.862 243.721 48.8542 243.154 54.7968C242.598 60.7434 243.388 66.6978 245.457 71.982C247.492 77.2806 250.654 81.9325 254.444 85.6274C258.233 89.3328 262.639 92.0877 267.162 93.8582C271.689 95.6379 276.324 96.4293 280.675 96.4645C282.857 96.5597 284.959 96.2546 286.987 96.0394C289.006 95.7239 290.929 95.265 292.732 94.6796C299.991 92.3484 305.2 88.2911 308.596 84.7721L309.094 84.2558L308.754 84.8869L308.744 84.9064L308.652 84.7617C312.624 84.6131 315.676 84.4996 317.752 84.4214C318.782 84.3862 319.566 84.3588 320.111 84.3393C320.646 84.3223 320.928 84.3197 320.928 84.3197Z" fill="#AFD977" class="theme-color"/>
                                                <path d="M261.59 53.7064C261.82 51.1783 262.985 48.7885 264.631 46.8563C266.243 44.9632 268.37 43.4508 270.787 42.8641C273.354 42.2409 276.171 42.7246 278.382 44.1679C279.697 45.0271 280.789 46.2175 281.554 47.5877C282.245 46.3387 283.202 45.2383 284.36 44.4039C286.502 42.8576 289.29 42.2422 291.884 42.7429C294.326 43.2148 296.521 44.6255 298.221 46.4404C299.957 48.2931 301.234 50.6242 301.583 53.1392C302.018 56.2879 301.49 59.7586 299.916 62.5213C298.254 65.4378 295.515 67.8277 292.682 69.6269C287.916 72.653 281.639 76.4496 281.639 76.4496C281.639 76.4496 276.164 72.5539 271.26 69.756C268.344 68.0911 265.495 65.8355 263.698 62.9998C261.996 60.314 261.303 56.872 261.59 53.7064Z" fill="#AFD977" class="theme-color"/>
                                                <path d="M474.076 144.719C476.317 145.279 488.008 151.81 491.393 162.742C494.21 171.845 498.656 224.789 499.055 223.861C499.055 223.861 508.257 278.824 513.595 302.605C513.595 302.605 507.101 311.279 503.141 311.586C502.608 311.628 500.933 301.049 498.433 295.535C491.414 280.045 479.122 255.698 476.868 241.947C475.952 236.366 473.678 224.749 472.702 222.209C471.302 218.568 468.641 170.279 468.641 170.279L474.076 144.719Z" fill="#FFBF9D"/>
                                                <path d="M499.952 334.632C499.952 334.632 496.959 320.341 497.045 313.576C497.131 306.81 498.904 309.435 499.895 302.887C500.886 296.338 500.368 290.111 500.368 290.111L511.785 293.472L514.728 308.273L517.686 329.045C517.956 330.942 517.341 332.859 516.008 334.235C513.097 337.247 508.064 342.286 506.914 342.376C505.272 342.505 505.169 340.937 505.169 340.937C505.169 340.937 500.192 342.125 499.851 340.407C499.509 338.689 504.545 335.703 504.545 335.703L508.147 329.405L503.213 318.778C503.213 318.778 503.699 325.154 503.65 325.958C503.6 326.761 506.034 334.81 499.952 334.632Z" fill="#FFBF9D"/>
                                                <path d="M312.602 125.15C312.602 125.15 357.444 122.272 377.321 126.877C397.199 131.483 405.023 143.5 405.023 143.5L385.877 167.083L355.138 139.034L312.602 125.15Z" fill="#FFBF9D"/>
                                                <path d="M398.367 136.099C378.801 123.452 367.851 120.413 350.668 123.346L358.813 144.929L370.887 153.405L387.307 171.674L398.367 136.099Z" fill="#455A64"/>
                                                <path d="M389.463 500.307L394.641 528.775C394.641 528.775 363.937 540.82 363.695 546.535L423.461 545.409L418.941 501.593L389.463 500.307Z" fill="#263238"/>
                                                <path d="M413.099 525.451C414.262 525.746 415.084 527.03 414.839 528.205C414.593 529.378 413.293 530.229 412.125 529.953C410.958 529.68 409.921 528.167 410.297 527.028C410.672 525.89 412.254 524.976 413.322 525.522" fill="#E0E0E0"/>
                                                <path d="M423.761 546.149L422.971 540.197L366.045 543.073C366.045 543.073 363.231 545.067 363.567 546.935L423.761 546.149Z" fill="#455A64"/>
                                                <path d="M393.709 528.097C393.725 528.389 395.186 528.494 396.64 529.405C398.117 530.278 398.881 531.529 399.148 531.407C399.416 531.346 398.948 529.61 397.169 528.537C395.399 527.449 393.641 527.83 393.709 528.097Z" fill="white"/>
                                                <path d="M387.479 530.812C387.417 531.096 388.691 531.568 389.706 532.784C390.755 533.97 391.03 535.301 391.321 535.281C391.596 535.323 391.766 533.61 390.476 532.122C389.198 530.623 387.48 530.534 387.479 530.812Z" fill="white"/>
                                                <path d="M384.088 538.382C384.354 538.438 384.734 536.974 383.954 535.389C383.186 533.798 381.798 533.194 381.679 533.439C381.519 533.683 382.421 534.523 383.04 535.833C383.692 537.13 383.798 538.359 384.088 538.382Z" fill="white"/>
                                                <path d="M394.089 521.045C394.217 521.309 395.548 520.881 397.199 520.962C398.852 521.009 400.146 521.538 400.294 521.285C400.459 521.072 399.186 520.014 397.238 519.946C395.294 519.864 393.942 520.819 394.089 521.045Z" fill="white"/>
                                                <path d="M453.82 496.246L454.762 533.51L447.008 563.198C446.449 565.338 447.819 567.503 449.992 567.915C451.209 568.146 452.453 567.781 453.344 566.922C459.02 561.452 479.797 541.231 479.575 538.507C479.318 535.353 481.192 499.135 481.192 499.135L453.82 496.246Z" fill="#263238"/>
                                                <path d="M449.984 567.913L479.562 535.99L479.566 537.569C479.569 538.934 479.094 540.258 478.211 541.299C475.851 544.085 469.166 551.64 453.45 566.92C452.536 567.81 451.231 568.185 449.984 567.913Z" fill="#455A64"/>
                                                <path d="M471.884 523.985C470.951 524.633 470.649 526.046 471.258 527.004C471.868 527.963 473.303 528.282 474.246 527.65C475.189 527.019 475.604 525.333 474.892 524.449C474.179 523.565 472.475 523.282 471.709 524.122" fill="#E0E0E0"/>
                                                <path d="M458.457 551.609C458.246 551.712 457.401 549.762 455.182 548.717C452.994 547.606 450.935 548.136 450.888 547.906C450.856 547.814 451.326 547.524 452.199 547.399C453.063 547.27 454.324 547.388 455.542 547.981C456.757 548.578 457.625 549.5 458.054 550.262C458.489 551.028 458.549 551.579 458.457 551.609Z" fill="white"/>
                                                <path d="M455.838 556.606C455.661 556.768 454.462 555.559 452.533 555.012C450.616 554.421 448.953 554.784 448.891 554.551C448.783 554.361 450.576 553.566 452.765 554.227C454.961 554.863 456.031 556.504 455.838 556.606Z" fill="white"/>
                                                <path d="M463.397 545.196C463.223 545.373 461.388 543.505 458.463 542.39C455.554 541.23 452.939 541.363 452.931 541.113C452.869 540.915 455.637 540.39 458.76 541.627C461.893 542.831 463.576 545.09 463.397 545.196Z" fill="white"/>
                                                <path d="M464.077 533.845C463.978 534.068 461.917 533.212 459.238 533.122C456.559 532.995 454.436 533.68 454.355 533.45C454.252 533.267 456.393 532.174 459.272 532.304C462.15 532.408 464.196 533.671 464.077 533.845Z" fill="white"/>
                                                <path d="M464.041 522.899C463.926 523.114 461.852 521.877 459.023 522.013C456.19 522.086 454.213 523.474 454.084 523.266C454.023 523.189 454.428 522.72 455.286 522.221C456.138 521.721 457.469 521.255 458.993 521.195C460.517 521.141 461.879 521.509 462.765 521.944C463.657 522.38 464.096 522.817 464.041 522.899Z" fill="white"/>
                                                <path d="M459.079 519.932C459.032 519.933 458.946 519.432 459.024 518.521C459.105 517.618 459.363 516.289 460.136 514.827C460.537 514.133 460.955 513.241 461.994 512.748C462.51 512.499 463.282 512.593 463.725 513.086C464.165 513.566 464.304 514.177 464.318 514.768C464.286 517.134 462.26 519.428 459.6 519.773C456.929 520.073 454.504 518.553 453.441 516.512C453.208 515.983 453.046 515.335 453.334 514.705C453.617 514.069 454.374 513.815 454.908 513.905C456.016 514.068 456.715 514.703 457.367 515.175C458.654 516.205 459.451 517.288 459.917 518.064C460.385 518.846 460.535 519.33 460.493 519.351C460.363 519.448 459.547 517.523 457.016 515.635C456.378 515.201 455.642 514.652 454.845 514.58C454.457 514.542 454.123 514.697 453.985 515.012C453.843 515.313 453.922 515.781 454.124 516.196C455.022 517.866 457.242 519.249 459.496 518.961C461.741 518.692 463.518 516.673 463.562 514.769C463.566 514.31 463.444 513.849 463.197 513.578C462.955 513.31 462.588 513.237 462.245 513.378C461.521 513.671 461.036 514.456 460.639 515.108C459.077 517.85 459.244 519.969 459.079 519.932Z" fill="white"/>
                                                <path d="M432.68 90.273C424.508 67.5598 408.72 59.1777 408.72 59.1777L355.268 86.0096C353.515 97.8663 357.246 118.518 357.042 130.818C356.869 141.355 354.625 147.81 354.625 147.81L376.684 142.838C376.684 142.838 375.512 135.586 376.257 134.797C377.003 134.008 380.689 141.64 380.689 141.64L441.852 128.238C441.852 128.238 437.449 103.526 432.68 90.273Z" fill="#263238"/>
                                                <path d="M403.875 56.7218C393.268 52.6175 382.355 52.9813 372.371 58.4285C366.738 61.5015 365.086 63.9709 361.682 67.3347C358.278 70.6984 355.875 74.9109 355.407 79.6737C354.852 85.3308 355.026 91.2135 357.275 96.4325C359.586 101.795 362.773 106.516 366.042 110.041C370.011 114.323 377.69 119.955 383.004 122.375L392.159 118.558C399.414 114.764 406.761 110.906 412.774 105.349C418.785 99.7937 423.406 92.2422 423.673 84.0609C424.046 72.6932 414.483 60.8249 403.875 56.7218Z" fill="#263238"/>
                                                <path d="M392.355 63.1411L371.303 66.0564L367.111 69.1229C357.034 74.8856 356.386 89.973 360.958 98.1895C366.038 107.317 372.601 118.261 377.842 124.14C388.384 135.96 400.513 130.562 400.513 130.562C400.513 130.562 401.992 133.409 403.886 137.034C407.858 144.643 417.351 147.441 424.814 143.201C431.986 139.127 434.584 130.067 430.663 122.811L399.513 65.1789C398.017 62.7435 394.908 61.8582 392.355 63.1411Z" fill="#FFBF9D"/>
                                                <path d="M396.249 109.53C395.754 108.873 395.003 108.469 394.256 108.324C392.76 108.033 391.243 108.783 390.587 110.137C389.931 111.491 390.179 113.366 391.185 114.667C392.261 115.154 393.505 115.191 394.578 114.699C394.745 114.622 394.908 114.538 395.067 114.443C395.832 113.982 396.472 113.272 396.741 112.363C397.007 111.454 396.861 110.34 396.249 109.53Z" fill="#FF9A6C"/>
                                                <path d="M373.553 105.325C374.094 106.237 375.312 106.531 376.274 105.983C377.235 105.437 377.578 104.256 377.037 103.344C376.496 102.433 375.277 102.138 374.317 102.685C373.355 103.231 373.012 104.413 373.553 105.325Z" fill="#263238"/>
                                                <path d="M367.674 101.6C367.962 101.687 369.218 100.635 371.301 100.073C373.375 99.4931 375.111 99.7226 375.288 99.5075C375.378 99.4097 375.044 99.2024 374.285 99.0916C373.537 98.9794 372.33 99.0003 371.032 99.3562C369.738 99.7135 368.739 100.298 368.207 100.762C367.662 101.23 367.533 101.564 367.674 101.6Z" fill="#263238"/>
                                                <path d="M387.051 108.854C386.994 108.745 385.739 109.275 383.759 110.216C383.265 110.465 382.766 110.655 382.485 110.389C382.161 110.125 382.034 109.5 381.912 108.816C381.627 107.413 381.327 105.944 381.016 104.402C379.691 98.1508 378.416 93.1299 378.164 93.186C377.913 93.2408 378.782 98.3542 380.106 104.606C380.443 106.14 380.764 107.603 381.073 109.002C381.236 109.642 381.318 110.434 382.002 110.977C382.35 111.243 382.85 111.276 383.2 111.167C383.556 111.066 383.819 110.903 384.058 110.77C385.962 109.687 387.11 108.961 387.051 108.854Z" fill="#263238"/>
                                                <path d="M400.461 130.559C400.461 130.559 409.683 125.444 415.07 114.539C415.07 114.539 416.232 126.677 402.267 133.904L400.461 130.559Z" fill="#FF9A6C"/>
                                                <path d="M393.156 106.676C392.85 106.848 394.112 108.822 393.323 111.306C392.541 113.791 390.296 114.92 390.458 115.204C390.51 115.346 391.172 115.286 392.074 114.741C392.963 114.212 394.055 113.117 394.537 111.598C395.016 110.079 394.723 108.649 394.271 107.797C393.817 106.925 393.283 106.578 393.156 106.676Z" fill="#263238"/>
                                                <path d="M363.603 94.053C364.194 94.3008 365.395 93.1104 367.105 92.203C368.787 91.2395 370.439 90.8575 370.539 90.229C370.573 89.9318 370.118 89.6136 369.268 89.5289C368.429 89.4415 367.204 89.6462 366.037 90.2877C364.872 90.9318 364.049 91.8549 363.68 92.6097C363.302 93.3725 363.333 93.924 363.603 94.053Z" fill="#263238"/>
                                                <path d="M393.904 92.7301C394.475 93.6232 394.19 94.8436 393.268 95.4563C392.347 96.0691 391.139 95.8436 390.568 94.9505C389.997 94.0574 390.282 92.8357 391.201 92.2243C392.123 91.6102 393.333 91.837 393.904 92.7301Z" fill="#263238"/>
                                                <path d="M391.753 87.2122C391.697 87.499 390.285 88.2539 388.908 89.9149C387.521 91.5629 386.946 93.19 386.693 93.2722C386.573 93.3178 386.55 92.9488 386.792 92.2344C387.03 91.529 387.579 90.4586 388.439 89.4273C389.301 88.3973 390.218 87.7102 390.832 87.396C391.456 87.074 391.785 87.0753 391.753 87.2122Z" fill="#263238"/>
                                                <path d="M387.005 80.5025C386.888 81.14 385.196 81.5494 383.459 82.5468C381.691 83.4895 380.442 84.7111 379.845 84.4673C379.571 84.3408 379.551 83.7815 379.953 83.0045C380.347 82.2352 381.206 81.2887 382.409 80.6211C383.614 79.9562 384.867 79.7307 385.721 79.8102C386.589 79.8845 387.046 80.2013 387.005 80.5025Z" fill="#263238"/>
                                                <path d="M410.151 89.3274C409.524 88.3457 409.174 85.3078 410.044 84.5347C412.37 82.4721 417.163 79.6885 421.423 86.2257C427.244 95.1618 417.071 99.1632 416.888 98.9167C416.746 98.7238 412.317 92.7173 410.151 89.3274Z" fill="#FFBF9D"/>
                                                <path d="M417.198 94.0478C417.218 93.9943 417.424 94.0556 417.766 94.0048C418.1 93.9552 418.594 93.7479 418.946 93.2707C419.664 92.3098 419.483 90.2929 418.477 88.654C417.969 87.8261 417.295 87.1625 416.589 86.7075C415.89 86.2316 415.17 86.0504 414.64 86.2759C414.096 86.4741 413.945 86.9787 413.998 87.3007C414.041 87.6293 414.215 87.7701 414.177 87.8157C414.166 87.8548 413.887 87.7922 413.719 87.3763C413.64 87.1742 413.607 86.8952 413.706 86.5862C413.806 86.272 414.063 85.9787 414.419 85.7987C415.14 85.3972 416.173 85.6279 416.947 86.1247C417.762 86.6006 418.539 87.3346 419.109 88.2642C420.225 90.1025 420.401 92.3868 419.351 93.6032C418.83 94.1756 418.182 94.3281 417.774 94.2942C417.354 94.2538 417.177 94.0843 417.198 94.0478Z" fill="#FF9A6C"/>
                                                <path d="M410.408 84.3495L409.44 88.124C393.766 84.1618 360.102 71.0757 362.033 71.8971C362.033 71.8971 367.369 65.0874 375.653 62.09C383.938 59.0926 400.41 54.7471 405.243 63.781C410.076 72.8149 410.408 84.3495 410.408 84.3495Z" fill="#263238"/>
                                                <g opacity="0.3">
                                                <path d="M404.343 94.0681C405.928 95.3249 405.489 98.5205 403.361 101.206C401.233 103.892 398.221 105.05 396.636 103.793C395.05 102.536 395.49 99.3406 397.618 96.6548C399.745 93.969 402.756 92.8112 404.343 94.0681Z" fill="#FF9A6C"/>
                                                </g>
                                                <path d="M477.129 160.26C477.369 161.463 468.717 205.447 468.717 205.447L470.88 228.761C470.88 228.761 473.769 235.731 472.926 240.059C470.407 247.134 451.592 254.847 425.214 257.125C402.379 257.845 391.803 246.308 391.803 246.308C391.112 236.738 389.435 199.787 384.916 171.657C382.529 156.791 385.778 144.693 384.11 140.07L402.245 135.015C403.757 140.109 408.899 141.263 414.172 140.962C422.761 140.472 430.279 132.397 431.176 123.842L460.529 129.981L477.129 160.26Z" fill="#455A64"/>
                                                <path d="M454.281 129.254C470.249 131.374 488.911 135.653 494.704 177.807C494.807 178.559 468.215 188.589 468.215 188.589C468.215 188.589 463.655 165.307 463.414 164.586C463.174 163.867 454.281 129.254 454.281 129.254Z" fill="#455A64"/>
                                                <path d="M473.271 149.658C473.321 149.654 473.415 150.405 473.541 151.766C473.675 153.128 473.801 155.102 473.896 157.544C474.09 162.427 474.052 169.195 473.406 176.634C472.75 184.073 471.61 190.746 470.57 195.52C470.051 197.909 469.584 199.83 469.216 201.147C468.855 202.465 468.632 203.188 468.584 203.176C468.536 203.164 468.665 202.418 468.941 201.082C469.224 199.748 469.614 197.814 470.067 195.418C470.975 190.631 472.03 183.976 472.683 176.57C473.327 169.164 473.446 162.429 473.382 157.557C473.353 155.12 473.305 153.147 473.258 151.783C473.219 150.418 473.22 149.661 473.271 149.658Z" fill="#263238"/>
                                                <path d="M474.492 238.318C474.492 238.318 471.75 239.008 467.231 239.938C466.249 212.601 464.568 170.223 463.413 164.587C461.69 156.177 405.894 167.579 397.287 168.018C389.068 168.438 395.645 233.523 396.645 240.049C394.516 239.045 392.597 237.857 390.942 236.458C390.942 236.458 383.772 257.158 381.563 272.227C380.332 280.622 377.601 303.995 377.601 303.995C377.601 303.995 369.597 384.289 365.18 412.691C364.538 416.816 364.74 421.015 365.764 425.062L383.052 527.563L424.345 528.823L413.121 422.161L438.062 326.225L440.284 326.439L446.473 525.798L485.704 525.055L491.317 385.393C493.964 328.932 513.605 287.569 474.492 238.318Z" fill="#263238"/>
                                                <path d="M457.074 129.254C452.963 127.788 447.657 125.219 443.289 126.879C443.289 126.879 445.601 159.646 448.496 162.986C451.392 166.328 459.41 162.986 459.41 162.986L457.074 129.254Z" fill="#263238"/>
                                                <path d="M400.486 135.014C396.181 134.298 393.111 136.5 389.105 138.905C389.105 138.905 395.652 168.276 399.092 171.052C402.533 173.829 409.834 169.122 409.834 169.122L400.486 135.014Z" fill="#263238"/>
                                                <path d="M445.182 307.781C445.198 307.821 444.594 308.141 443.435 308.585C442.854 308.799 442.124 309.043 441.233 309.168C440.349 309.293 439.279 309.279 438.191 308.862C437.103 308.48 436.04 307.491 435.633 306.168C435.191 304.864 435.176 303.448 435.04 302.009C434.813 299.088 434.567 295.903 434.307 292.56C433.808 285.854 433.396 279.779 433.134 275.38C433.025 273.288 432.933 271.539 432.862 270.168C432.813 268.936 432.811 268.253 432.86 268.25C432.91 268.246 433.008 268.923 433.143 270.147C433.275 271.513 433.444 273.257 433.645 275.343C434.038 279.732 434.53 285.8 435.031 292.506C435.271 295.85 435.498 299.038 435.706 301.958C435.821 303.412 435.826 304.804 436.204 305.976C436.554 307.164 437.409 307.996 438.384 308.384C440.37 309.182 442.204 308.628 443.347 308.315C444.517 307.961 445.163 307.727 445.182 307.781Z" fill="#455A64"/>
                                                <path d="M396.535 241.063C396.584 241.055 396.683 241.48 396.822 242.259C396.974 243.037 397.084 244.181 397.116 245.598C397.161 247.017 397.048 248.711 396.769 250.569C396.457 252.421 395.957 254.434 395.198 256.469C394.416 258.497 393.455 260.335 392.46 261.93C391.437 263.506 390.398 264.848 389.424 265.88C388.459 266.919 387.618 267.704 386.988 268.184C386.368 268.675 386.012 268.928 385.981 268.889C385.893 268.788 387.237 267.672 389.038 265.542C389.947 264.485 390.921 263.138 391.892 261.578C392.833 259.999 393.755 258.194 394.519 256.214C395.26 254.226 395.767 252.265 396.11 250.458C396.417 248.645 396.582 246.991 396.603 245.597C396.668 242.808 396.402 241.081 396.535 241.063Z" fill="#455A64"/>
                                                <path d="M487.53 261.323C487.522 261.373 487.135 261.35 486.435 261.262C485.733 261.188 484.73 260.979 483.518 260.631C481.092 259.945 477.843 258.497 474.794 256.102C471.754 253.694 469.588 250.871 468.356 248.672C467.736 247.572 467.299 246.647 467.063 245.982C466.815 245.322 466.702 244.951 466.749 244.931C466.869 244.88 467.464 246.314 468.794 248.406C470.115 250.497 472.282 253.187 475.243 255.532C478.213 257.865 481.333 259.346 483.674 260.142C486.017 260.948 487.552 261.194 487.53 261.323Z" fill="#455A64"/>
                                                <path d="M450.767 194.134C450.779 194.133 450.801 194.253 450.831 194.489C450.861 194.767 450.899 195.111 450.946 195.535C451.036 196.512 451.16 197.858 451.316 199.561C451.611 203.12 452.029 208.167 452.544 214.377C452.607 215.159 452.671 215.96 452.737 216.778C452.862 217.566 452.775 218.615 452.198 219.363C451.92 219.742 451.556 220.068 451.13 220.292C450.696 220.527 450.213 220.605 449.796 220.699C448.924 220.885 448.036 221.074 447.131 221.267C443.51 222.016 439.617 222.687 435.505 223.287C431.393 223.881 427.059 224.394 422.555 224.794C421.428 224.885 420.291 224.979 419.145 225.072L417.418 225.193C416.871 225.226 416.205 225.325 415.56 225.112C414.93 224.918 414.363 224.527 413.959 224.003C413.544 223.499 413.351 222.769 413.261 222.226C413.02 221.068 412.778 219.904 412.534 218.731C411.56 214.042 410.611 209.463 409.692 205.04C409.3 202.832 408.57 200.681 408.791 198.37C408.914 197.231 409.397 196.123 410.133 195.278C410.856 194.411 411.787 193.798 412.724 193.299C414.629 192.323 416.641 191.859 418.54 191.372C420.453 190.894 422.323 190.484 424.136 190.123C427.765 189.4 431.178 188.901 434.304 188.562C437.431 188.219 440.272 188.035 442.767 187.95C445.211 187.829 447.581 187.837 449.037 189.06C449.749 189.641 450.128 190.39 450.346 191.035C450.563 191.69 450.643 192.263 450.697 192.725C450.748 193.186 450.765 193.54 450.772 193.777C450.783 194.01 450.78 194.133 450.767 194.134C450.737 194.137 450.696 193.651 450.556 192.742C450.384 191.883 450.204 190.374 448.864 189.278C447.497 188.177 445.242 188.189 442.788 188.352C440.302 188.476 437.475 188.695 434.366 189.068C431.256 189.438 427.864 189.965 424.259 190.708C422.456 191.081 420.599 191.501 418.699 191.987C416.801 192.482 414.835 192.954 413.036 193.888C411.25 194.782 409.669 196.359 409.482 198.447C409.276 200.506 409.984 202.684 410.39 204.896C411.313 209.317 412.268 213.894 413.247 218.583C413.491 219.755 413.733 220.921 413.973 222.077C414.083 222.692 414.208 223.134 414.535 223.561C414.849 223.967 415.289 224.27 415.774 224.42C416.253 224.584 416.772 224.51 417.373 224.473L419.096 224.355C420.239 224.263 421.372 224.173 422.496 224.084C426.988 223.694 431.311 223.197 435.414 222.622C439.517 222.042 443.401 221.394 447.015 220.674C447.917 220.489 448.804 220.306 449.675 220.128C450.125 220.031 450.527 219.967 450.868 219.784C451.217 219.605 451.516 219.34 451.746 219.031C452.224 218.382 452.314 217.643 452.204 216.815C452.147 215.996 452.091 215.194 452.036 214.412C451.617 208.194 451.277 203.141 451.037 199.578C450.938 197.87 450.86 196.521 450.802 195.541C450.786 195.115 450.771 194.769 450.759 194.49C450.752 194.257 450.756 194.134 450.767 194.134Z" fill="#455A64"/>
                                                <path d="M408.976 165.485C409.023 165.472 409.181 165.845 409.411 166.538C409.637 167.232 409.956 168.246 410.165 169.555C410.363 170.852 410.44 172.502 409.844 174.212C409.299 175.905 407.788 177.653 405.633 178.035C404.578 178.238 403.451 178.017 402.599 177.468C401.737 176.929 401.116 176.187 400.615 175.464C399.637 173.996 398.962 172.59 398.452 171.377C397.947 170.163 397.638 169.146 397.457 168.436C397.277 167.726 397.224 167.323 397.269 167.311C397.383 167.279 397.82 168.834 398.92 171.169C399.475 172.327 400.199 173.702 401.16 175.079C401.647 175.755 402.23 176.413 402.97 176.863C403.702 177.319 404.602 177.49 405.503 177.323C407.346 176.991 408.68 175.519 409.216 173.985C409.795 172.436 409.787 170.885 409.657 169.623C409.333 167.078 408.84 165.515 408.976 165.485Z" fill="#455A64"/>
                                                <path d="M459.15 160.633C459.199 160.624 459.322 160.982 459.491 161.646C459.652 162.31 459.882 163.281 459.959 164.526C460.032 165.756 459.913 167.327 459.08 168.825C458.29 170.331 456.548 171.587 454.534 171.65C453.536 171.698 452.528 171.406 451.751 170.862C450.972 170.32 450.408 169.604 449.968 168.902C449.115 167.477 448.568 166.123 448.161 164.958C447.372 162.619 447.253 161.087 447.334 161.076C447.449 161.051 447.746 162.536 448.641 164.779C449.094 165.889 449.695 167.218 450.53 168.542C450.956 169.191 451.479 169.819 452.149 170.274C452.819 170.728 453.641 170.963 454.504 170.924C456.253 170.86 457.761 169.814 458.498 168.49C459.276 167.166 459.45 165.72 459.444 164.539C459.373 162.151 459.011 160.651 459.15 160.633Z" fill="#455A64"/>
                                                <path d="M404.992 168.574C405.961 168.559 406.857 169.427 406.872 170.396C406.888 171.365 406.02 172.26 405.051 172.276C404.082 172.29 403.186 171.423 403.172 170.454C403.156 169.484 404.023 168.59 404.992 168.574Z" fill="#455A64"/>
                                                <path d="M453.996 161.219C454.965 161.205 455.86 162.072 455.876 163.04C455.892 164.009 455.024 164.905 454.055 164.919C453.086 164.935 452.19 164.066 452.176 163.098C452.159 162.129 453.027 161.235 453.996 161.219Z" fill="#455A64"/>
                                                <path d="M384.128 142.145C383.535 141.496 375.137 135.385 370.102 132.379C366.85 130.437 359.595 130.509 356.859 130.153C356.859 130.153 319.252 125.193 311.523 125.193C296.953 129.248 294.302 136.004 296.773 142.322C301.679 144.406 348.347 145.006 359.807 144.922C362.222 146.716 364.558 148.105 364.558 148.105L369.425 154.839C369.425 154.839 370.407 157.47 370.84 160.431C371.273 163.392 373.374 161.722 373.374 161.722C373.374 161.722 373.674 163.555 374.42 166.127C374.428 166.153 374.436 166.178 374.444 166.204C375.041 168.118 377.896 167.723 378.069 165.725L378.693 158.517C378.693 158.517 379.801 164.697 380.459 168.127C380.579 168.749 380.802 169.233 381.088 169.607C382.321 171.225 384.93 170.278 384.949 168.243L385.052 157.038L382.758 150.712L386.223 156.182C386.223 156.182 387.53 159.229 388.427 163.724C388.785 165.522 389.561 166.145 390.361 166.246C391.703 166.415 392.788 165.131 392.596 163.792L391.163 153.757C391.163 153.757 384.721 142.794 384.128 142.145Z" fill="#FFBF9D"/>
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
