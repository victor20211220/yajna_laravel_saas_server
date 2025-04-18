@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme14">
@else
<div class="{{ $business->theme_color }}" id="view_theme14">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="marketing-agency-card">
                <section class="profile-sec pb">
                    <div class="profile-banner-wrp">
                        <div class="profile-banner img-wrapper">
                            <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme14/images/profile-banner-img.png') }}" alt="profile-banner-img" id="banner_preview"  class="profile-banner-img" loading="lazy">
                            <div class="profile-name">
                                <span id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</span>
                            </div>
                        </div>
                    <img src="{{ asset('custom/theme14/images/banner-bg.png')}}" alt="profile-banner" class="profile-banner-bg">
                    </div>
                    <div class="client-info-wrp">
                        <div class="container">
                            <div class="client-info-content d-flex align-items-center">
                                <div class="client-image">
                                    <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme13/images/client-image.png') }}"   alt="client-image" loading="lazy">
                                </div>
                                <div class="client-info text-center">
                                    <h2 id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</h2>
                                    <span id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="profile-content">
                            <p id="{{ $stringid . '_desc' }}_preview">
                                {!! nl2br(e($business->description)) !!}</p>
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
                                                <img src="{{ asset('custom/theme14/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Contact Us') }}</h2>
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
                                                        <img src="{{ asset('custom/theme14/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                            <img src="{{ asset('custom/theme14/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                        </div>
                                                            <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                    @else
                                                        <div class="contact-image">
                                                            <img src="{{ asset('custom/theme14/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                        <ul class="hours-list">
                            @foreach ($days as $k => $day)
                                <li class="d-flex justify-content-center">
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
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{__('More')}}</h2>
                        </div>
                        <ul class="d-flex justify-content-between">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}"  class="save-info d-flex align-items-center justify-content-center">
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
                    <div class="container">
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
                                        <div class="testimonial-content">
                                            <div class="testimonial-content-top">
                                                <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
                                            </div>
                                            <div class="testimonial-content-bottom">
                                                <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                    {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="testimonial-image-wrp">
                                            <div class="testimonial-image img-wrapper">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
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
                                        <div class="testimonial-content">
                                            <div class="testimonial-content-top">
                                                <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
                                            </div>
                                            <div class="testimonial-content-bottom">
                                                <h3 id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                    {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="testimonial-image-wrp">
                                            <div class="testimonial-image img-wrapper">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
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
                            <svg width="576" height="509" viewBox="0 0 576 509" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M466.37 266.498C449.22 241.448 417.741 227.001 387.566 230.333C394.964 245.059 408.862 257.77 422.847 262.104C436.83 266.439 451.73 266.486 466.37 266.498Z" fill="#E7E8E5"/>
                                <path d="M386.588 241.782C378.428 232.651 367.201 226.309 355.168 224.031C355.98 235.293 365.165 247.503 373.147 255.491C381.128 263.478 390.92 269.379 400.719 274.988C399.799 262.777 394.75 250.912 386.588 241.782Z" fill="#E7E8E5"/>
                                <path d="M433.539 251.705C400.857 232.321 364.748 218.739 327.392 211.783C327.075 211.723 326.771 211.932 326.713 212.249C326.654 212.564 326.862 212.868 327.179 212.928C364.398 219.859 400.382 233.393 432.945 252.708C433.222 252.871 433.579 252.78 433.743 252.504C433.907 252.227 433.816 251.87 433.539 251.705Z" fill="#DADBD8"/>
                                <path d="M346.792 217.572C363.449 230.494 377.825 245.17 391.04 261.614C391.242 261.865 391.608 261.905 391.859 261.704C392.11 261.502 392.15 261.136 391.948 260.885C378.686 244.383 364.245 229.637 347.506 216.652C347.252 216.455 346.886 216.501 346.688 216.755C346.491 217.01 346.538 217.375 346.792 217.572Z" fill="#DADBD8"/>
                                <path d="M377.574 213.821C367.864 216.985 357.114 216.856 347.484 213.458C352.786 205.678 364.523 200.721 373.623 198.306C382.724 195.89 392.255 195.737 401.671 195.797C395.892 204.217 387.282 210.656 377.574 213.821Z" fill="#E7E8E5"/>
                                <path d="M412.169 224.735C403.199 227.658 393.265 227.538 384.367 224.401C389.267 217.211 400.111 212.632 408.519 210.4C416.928 208.167 425.735 208.026 434.434 208.081C429.094 215.861 421.139 221.81 412.169 224.735Z" fill="#E7E8E5"/>
                                <path d="M340.062 215.508C357.579 213.157 373 208.726 389.474 202.384C389.774 202.268 389.924 201.932 389.809 201.631C389.692 201.331 389.356 201.182 389.055 201.297C372.638 207.618 357.321 212.015 339.907 214.354C339.588 214.397 339.365 214.691 339.408 215.009C339.451 215.328 339.744 215.551 340.062 215.508Z" fill="#DADBD8"/>
                                <path d="M409.558 217.053C398.949 220.175 388.228 222.918 377.423 225.276C377.109 225.344 376.91 225.655 376.978 225.97C377.047 226.283 377.357 226.482 377.671 226.415C388.503 224.05 399.25 221.301 409.886 218.17C410.195 218.079 410.371 217.755 410.28 217.447C410.19 217.138 409.866 216.962 409.558 217.053Z" fill="#DADBD8"/>
                                <path d="M133.391 284.943C153.114 280.752 169.955 265.075 175.547 245.702C164.631 246.517 153.306 251.835 147.106 259.326C140.904 266.816 137.102 275.956 133.391 284.943Z" fill="#E7E8E5"/>
                                <path d="M168.763 242.201C176.436 239.5 183.172 234.212 187.618 227.398C180.496 225.046 170.672 227.596 163.747 230.477C156.821 233.357 150.718 237.876 144.793 242.475C152.525 245 161.089 244.903 168.763 242.201Z" fill="#E7E8E5"/>
                                <path d="M150.901 268.68C171.096 253.502 188.593 234.746 202.334 213.547C202.509 213.277 202.432 212.916 202.162 212.741C201.893 212.566 201.532 212.643 201.357 212.913C187.691 233.997 170.287 252.653 150.201 267.748C149.944 267.942 149.893 268.307 150.086 268.564C150.279 268.821 150.644 268.874 150.901 268.68Z" fill="#DADBD8"/>
                                <path d="M193.605 223.721C181.467 230.671 168.831 235.779 155.399 239.73C155.09 239.82 154.913 240.144 155.004 240.453C155.095 240.761 155.419 240.937 155.728 240.848C169.231 236.876 181.956 231.733 194.184 224.732C194.462 224.571 194.559 224.216 194.399 223.937C194.24 223.658 193.883 223.562 193.605 223.721Z" fill="#DADBD8"/>
                                <path d="M188.216 243.74C188.73 236.977 191.531 230.407 196.054 225.353C199.49 230.578 199.564 239.042 198.744 245.241C197.924 251.442 195.605 257.334 193.185 263.102C189.478 257.421 187.701 250.503 188.216 243.74Z" fill="#E7E8E5"/>
                                <path d="M172.756 262.227C173.231 255.977 175.819 249.907 179.998 245.238C183.173 250.066 183.241 257.885 182.484 263.614C181.725 269.342 179.584 274.787 177.347 280.115C173.922 274.867 172.281 268.476 172.756 262.227Z" fill="#E7E8E5"/>
                                <path d="M196.485 220.228C193.492 231.598 192.306 242.208 192.031 253.941C192.024 254.262 192.279 254.529 192.601 254.537C192.922 254.544 193.189 254.29 193.196 253.969C193.47 242.296 194.645 231.794 197.611 220.525C197.693 220.214 197.508 219.895 197.197 219.814C196.886 219.732 196.567 219.917 196.485 220.228Z" fill="#DADBD8"/>
                                <path d="M178.33 262.588C179.096 255.287 180.125 248.013 181.412 240.785C181.468 240.468 181.257 240.167 180.94 240.11C180.623 240.054 180.32 240.265 180.265 240.581C178.973 247.836 177.941 255.137 177.171 262.466C177.137 262.786 177.37 263.072 177.69 263.106C178.01 263.14 178.296 262.908 178.33 262.588Z" fill="#DADBD8"/>
                                <path d="M89.9297 98.6344C101.885 119.404 125.773 132.711 149.725 131.945C144.809 119.9 134.652 109.042 123.914 104.77C113.175 100.498 101.451 99.544 89.9297 98.6344Z" fill="#E7E8E5"/>
                                <path d="M151.204 122.993C157.066 130.681 165.511 136.363 174.84 138.896C174.894 129.982 168.416 119.808 162.626 113.03C156.836 106.253 149.492 101.006 142.125 95.9889C142.097 105.657 145.341 115.305 151.204 122.993Z" fill="#E7E8E5"/>
                                <path d="M114.79 112.394C139.331 129.669 166.928 142.585 195.914 150.363C196.225 150.446 196.544 150.262 196.628 149.951C196.711 149.641 196.527 149.321 196.216 149.238C167.363 141.496 139.889 128.637 115.461 111.441C115.198 111.256 114.834 111.319 114.649 111.582C114.464 111.845 114.527 112.208 114.79 112.394Z" fill="#DADBD8"/>
                                <path d="M181.117 144.404C168.811 133.217 158.406 120.791 149.019 107.042C148.839 106.776 148.477 106.707 148.211 106.889C147.946 107.071 147.877 107.433 148.059 107.699C157.485 121.508 167.95 134.01 180.334 145.266C180.572 145.483 180.94 145.465 181.156 145.228C181.373 144.989 181.355 144.621 181.117 144.404Z" fill="#DADBD8"/>
                                <path d="M156.577 145.555C164.414 143.661 172.866 144.425 180.236 147.691C175.584 153.487 166.042 156.667 158.732 158.008C151.421 159.349 143.91 158.885 136.504 158.258C141.569 151.986 148.741 147.449 156.577 145.555Z" fill="#E7E8E5"/>
                                <path d="M130.02 134.836C137.261 133.086 145.071 133.791 151.88 136.809C147.582 142.165 138.766 145.102 132.01 146.342C125.255 147.581 118.316 147.151 111.473 146.572C116.153 140.778 122.78 136.585 130.02 134.836Z" fill="#E7E8E5"/>
                                <path d="M186.199 146.41C172.257 147.185 159.836 149.725 146.474 153.705C146.166 153.796 145.991 154.121 146.083 154.43C146.174 154.737 146.499 154.913 146.808 154.821C160.11 150.859 172.424 148.342 186.263 147.574C186.584 147.555 186.83 147.28 186.812 146.96C186.794 146.638 186.519 146.393 186.199 146.41Z" fill="#DADBD8"/>
                                <path d="M131.629 141.163C140.167 139.358 148.771 137.859 157.417 136.669C157.735 136.624 157.959 136.331 157.915 136.013C157.87 135.694 157.577 135.471 157.258 135.514C148.584 136.709 139.954 138.213 131.388 140.023C131.074 140.089 130.872 140.399 130.938 140.714C131.005 141.028 131.315 141.23 131.629 141.163Z" fill="#DADBD8"/>
                                <path d="M303.675 0.291901C300.071 0.291901 297.139 3.22449 297.139 6.82797V313.454C297.139 317.059 300.071 319.99 303.675 319.99H514.184C517.789 319.99 520.722 317.059 520.722 313.454V6.82797C520.722 3.22449 517.789 0.291901 514.184 0.291901H303.675ZM514.184 320.281H303.675C299.911 320.281 296.848 317.219 296.848 313.454V6.82797C296.848 3.06259 299.911 0.000732422 303.675 0.000732422H514.184C517.95 0.000732422 521.013 3.06259 521.013 6.82797V313.454C521.013 317.219 517.95 320.281 514.184 320.281Z" fill="#DADBD8"/>
                                <path d="M60.9246 0.291901C57.321 0.291901 54.3888 3.22449 54.3888 6.82797V313.454C54.3888 317.059 57.321 319.99 60.9246 319.99H271.435C275.038 319.99 277.971 317.059 277.971 313.454V6.82797C277.971 3.22449 275.038 0.291901 271.435 0.291901H60.9246ZM271.435 320.281H60.9246C57.1599 320.281 54.0977 317.219 54.0977 313.454V6.82797C54.0977 3.06259 57.1599 0.000732422 60.9246 0.000732422H271.435C275.199 0.000732422 278.262 3.06259 278.262 6.82797V313.454C278.262 317.219 275.199 320.281 271.435 320.281Z" fill="#DADBD8"/>
                                <path d="M579.499 391.697H-2.83594V391.406H579.499V391.697Z" fill="#DADBD8"/>
                                <path d="M57.3438 408.019H76.0484V408.311H57.3438V408.019Z" fill="#DADBD8"/>
                                <path d="M195.57 404.863H257.915V405.154H195.57V404.863Z" fill="#DADBD8"/>
                                <path d="M77.2148 418.84H119.434V419.131H77.2148V418.84Z" fill="#DADBD8"/>
                                <path d="M437.82 404.713H488.122V405.004H437.82V404.713Z" fill="#DADBD8"/>
                                <path d="M498.5 404.713H505.872V405.004H498.5V404.713Z" fill="#DADBD8"/>
                                <path d="M365.449 411.969H428.213V412.26H365.449V411.969Z" fill="#DADBD8"/>
                                <path d="M499.043 175.627H419.305V25.3019H499.043V175.627Z" fill="#E2E2E0"/>
                                <path d="M495.127 175.627H401.461V25.3019H495.127V175.627Z" fill="#EDEDEB"/>
                                <path d="M480.851 38.6551V162.275H415.703V38.6551H480.851Z" fill="white"/>
                                <path d="M445.378 67.3501C442.16 71.4485 439.618 75.9698 437.897 80.8963C436.159 85.8718 434.999 91.4855 435.754 96.7556C436.424 101.431 439.064 105.996 443.574 107.867C448.237 109.801 453.148 107.907 456.872 104.915C460.329 102.139 464.969 97.1621 463.566 92.2973C462.146 87.3696 456.222 86.5636 452.122 88.2885C442.525 92.3264 438.061 103.393 437.397 113.106C436.707 123.224 438.39 139.806 450.875 142.04C453.073 142.434 454.017 139.068 451.803 138.672C442.833 137.066 441.201 126.194 440.85 118.717C440.456 110.351 442.1 101.389 448.204 95.2276C450.593 92.8167 454.767 89.6057 458.343 91.2852C462.836 93.3956 458.464 98.5737 456.334 100.709C453.738 103.312 449.997 105.866 446.125 105.031C442.282 104.201 439.989 100.488 439.292 96.8616C438.386 92.1517 439.549 86.9957 441.031 82.5187C442.546 77.9439 444.871 73.6125 447.848 69.8215C449.221 68.0722 446.766 65.5833 445.378 67.3501Z" fill="#EDEDEB"/>
                                <path d="M467.22 452.215C467.2 451.587 465.088 389.276 454.954 379.421C445.096 369.837 433.781 379.064 433.306 379.46L432.289 378.242C432.417 378.135 445.187 367.711 456.06 378.283C466.65 388.582 468.722 449.573 468.805 452.165L467.22 452.215Z" fill="#DADBD8"/>
                                <path d="M468.092 464.459C468.02 463.715 461.166 389.655 488.212 358.614L489.408 359.655C462.809 390.181 469.599 463.567 469.672 464.304L468.092 464.459Z" fill="#DADBD8"/>
                                <path d="M467.09 456.625L465.506 456.519C465.562 455.68 470.8 372.324 450.961 354.076L452.035 352.908C472.43 371.668 467.318 453.164 467.09 456.625Z" fill="#DADBD8"/>
                                <path d="M469.672 456.58L468.086 456.567C468.105 454.272 468.74 400.264 484.082 391.473C487.492 389.516 490.831 389.191 494.008 390.504C503.283 394.341 507.882 410.851 508.073 411.551L506.542 411.97C506.497 411.804 501.958 395.508 493.4 391.97C490.701 390.855 487.833 391.15 484.87 392.848C470.313 401.191 469.677 456.027 469.672 456.58Z" fill="#DADBD8"/>
                                <path d="M463.701 456.617L462.118 456.528C462.142 456.101 464.432 413.848 453.029 398.962C450.266 395.356 447.267 393.635 444.098 393.857C436.627 394.38 430.361 405.313 430.299 405.423L428.918 404.643C429.189 404.162 435.663 392.857 443.985 392.275C447.709 392.011 451.179 393.939 454.289 397.998C466.05 413.351 463.802 454.859 463.701 456.617Z" fill="#DADBD8"/>
                                <path d="M466.203 462.365C465.893 458.266 458.749 361.788 471.318 344.788L472.593 345.729C460.371 362.261 467.71 461.247 467.784 462.244L466.203 462.365Z" fill="#DADBD8"/>
                                <path d="M497.427 400.281C497.427 400.281 489.885 403.061 492.127 409.624C494.369 416.187 518.214 426.988 518.214 426.988C518.214 426.988 528.201 417.835 519.029 402.948C509.858 388.063 497.63 395.584 497.427 400.281Z" fill="#E7E8E5"/>
                                <path d="M464.645 387.789C464.645 387.789 472.675 387.452 473.132 394.373C473.587 401.293 455.736 420.439 455.736 420.439C455.736 420.439 442.996 415.833 445.733 398.565C448.469 381.295 462.65 383.532 464.645 387.789Z" fill="#E7E8E5"/>
                                <path d="M457.85 354.662C457.85 354.662 463.204 354.087 462.773 350.827C462.342 347.566 441.962 339.174 429.938 352.744C429.938 352.744 437.637 365.97 448.767 366.143C459.896 366.316 457.85 354.662 457.85 354.662Z" fill="#E7E8E5"/>
                                <path d="M467.825 346.742C467.825 346.742 462.977 349.086 461.618 346.09C460.259 343.095 473.117 325.194 490.5 330.352C490.5 330.352 490.96 345.647 481.606 351.68C472.251 357.715 467.825 346.742 467.825 346.742Z" fill="#E7E8E5"/>
                                <path d="M442.474 397.644C442.474 397.644 446.169 394.66 442.182 393.204C438.195 391.748 418.63 392.162 418.426 411.543C418.426 411.543 441.213 415.329 444.033 407.946C446.854 400.565 442.474 397.644 442.474 397.644Z" fill="#E7E8E5"/>
                                <path d="M488.943 354.176C488.943 354.176 485.249 351.192 489.236 349.736C493.223 348.28 512.788 348.693 512.992 368.074C512.992 368.074 490.205 371.861 487.385 364.478C484.564 357.097 488.943 354.176 488.943 354.176Z" fill="#E7E8E5"/>
                                <path d="M476.897 369.787C476.897 369.787 476.572 366.161 479.5 367.582C482.428 369.004 492.627 380.007 482.054 390.449C482.054 390.449 467.823 379.909 470.387 374.42C472.953 368.931 476.897 369.787 476.897 369.787Z" fill="#E7E8E5"/>
                                <path d="M439.172 374.954C439.172 374.954 441.381 372.06 438.147 371.701C434.911 371.342 420.416 375.213 423.791 389.684C423.791 389.684 441.452 388.356 442.208 382.345C442.965 376.333 439.172 374.954 439.172 374.954Z" fill="#E7E8E5"/>
                                <path d="M484.519 484.533H448.898L439.422 440.83H493.094L484.519 484.533Z" fill="#EDEDEB"/>
                                <path d="M496.186 452.766H436.191V440.199H496.186V452.766Z" fill="#E2E2E0"/>
                                <path d="M78.6584 211.712C79.3785 209.446 81.0622 208.319 83.0404 207.724C84.5836 207.259 85.9388 207.608 87.5794 208.053C88.3397 208.258 89.3096 208.764 90.2259 209.397C90.0011 208.306 89.9151 207.216 90.023 206.436C90.2554 204.753 90.4633 203.368 91.4943 202.13C92.8154 200.541 94.511 199.432 96.8781 199.655C99.101 199.865 100.764 201.863 101.534 203.96C102.304 206.056 102.328 208.687 102.049 210.802C101.462 215.235 100.699 218.801 98.7589 222.293C93.7048 222.619 91.2058 222.021 86.8961 220.829C84.8407 220.259 82.4285 219.207 80.7997 217.679C79.1711 216.151 77.9818 213.839 78.6584 211.712Z" fill="#E7E8E5"/>
                                <path d="M473.845 195.525C476.196 195.172 477.95 196.185 479.357 197.698C480.455 198.877 480.738 200.249 481.064 201.917C481.214 202.689 481.189 203.783 481.025 204.885C481.905 204.202 482.845 203.644 483.593 203.396C485.207 202.862 486.541 202.437 488.107 202.816C490.115 203.302 491.858 204.333 492.703 206.556C493.496 208.643 492.436 211.017 490.894 212.633C489.352 214.249 487.002 215.433 484.981 216.114C480.744 217.543 477.208 218.433 473.218 218.231C470.695 213.841 470.129 211.334 469.298 206.94C468.902 204.845 468.782 202.216 469.434 200.08C470.086 197.944 471.636 195.857 473.845 195.525Z" fill="#E7E8E5"/>
                                <path d="M90.2204 46.3566C91.4915 42.3595 94.4624 40.3702 97.9532 39.3197C100.676 38.4998 103.067 39.1171 105.962 39.9009C107.303 40.2643 109.015 41.1564 110.632 42.2733C110.235 40.3493 110.084 38.4241 110.274 37.0474C110.684 34.0775 111.051 31.634 112.87 29.4491C115.202 26.6469 118.194 24.6903 122.37 25.0828C126.293 25.452 129.227 28.9786 130.586 32.6776C131.944 36.3777 131.988 41.0201 131.494 44.7505C130.458 52.5736 129.112 58.8664 125.688 65.0275C116.77 65.604 112.361 64.5488 104.756 62.4442C101.129 61.4403 96.8731 59.5838 93.9988 56.8876C91.1249 54.1914 89.0266 50.1115 90.2204 46.3566Z" fill="#E7E8E5"/>
                                <path d="M246.727 38.0811C248.541 37.2402 250.197 37.642 251.69 38.5295C252.856 39.2225 253.409 40.2613 254.066 41.5297C254.371 42.1178 254.609 43.0065 254.737 43.9347C255.285 43.1742 255.913 42.5022 256.457 42.1248C257.632 41.3119 258.608 40.6538 259.963 40.5886C261.697 40.5047 263.348 40.9252 264.556 42.5185C265.689 44.0151 265.397 46.1814 264.535 47.8503C263.673 49.5193 262.057 51.0299 260.588 52.0583C257.507 54.2152 254.864 55.7701 251.597 56.5527C248.522 53.6061 247.472 51.717 245.761 48.3686C244.945 46.7718 244.226 44.6789 244.247 42.8003C244.268 40.9229 245.025 38.8719 246.727 38.0811Z" fill="#E7E8E5"/>
                                <path d="M201.826 309.113C205.08 307.603 208.05 308.326 210.729 309.918C212.819 311.159 213.812 313.023 214.991 315.3C215.538 316.355 215.965 317.948 216.196 319.613C217.179 318.251 218.304 317.043 219.281 316.368C221.39 314.909 223.141 313.728 225.569 313.611C228.682 313.461 231.644 314.215 233.81 317.073C235.845 319.758 235.318 323.644 233.773 326.639C232.227 329.632 229.327 332.343 226.692 334.188C221.164 338.057 216.423 340.845 210.562 342.25C205.045 336.964 203.161 333.577 200.092 327.568C198.628 324.703 197.337 320.949 197.376 317.58C197.413 314.211 198.771 310.531 201.826 309.113Z" fill="#E7E8E5"/>
                                <path d="M446.375 498.842C446.375 504.452 376.149 509 289.519 509C202.89 509 132.664 504.452 132.664 498.842C132.664 493.231 202.89 488.683 289.519 488.683C376.149 488.683 446.375 493.231 446.375 498.842Z" fill="#F3F2F1"/>
                                <path d="M152.501 305.176C133.188 327.768 127.547 361.208 138.381 388.885C150.419 378.141 158.895 361.764 159.432 347.44C159.968 333.117 156.219 319.019 152.501 305.176Z" fill="#111111"/>
                                <path d="M149.13 391.494C142.576 401.536 139.44 413.763 140.35 425.719C150.791 422.084 159.995 410.29 165.513 400.711C171.032 391.131 174.117 380.371 176.924 369.678C165.614 373.659 155.682 381.453 149.13 391.494Z" fill="#111111"/>
                                <path d="M146.681 344.617C138.92 372.515 134.966 401.451 134.992 430.412C134.999 438.635 135.334 446.852 135.975 455.05C136.018 455.606 136.893 455.611 136.849 455.05C134.587 426.164 136.264 396.994 141.881 368.567C143.457 360.591 145.344 352.681 147.523 344.848C147.674 344.306 146.831 344.075 146.681 344.617Z" fill="#FF6600" class="theme-color"/>
                                <path d="M136.272 435.177C144.2 416.31 154.618 398.639 166.661 382.117C166.993 381.662 166.234 381.226 165.907 381.676C153.816 398.263 143.389 416.003 135.43 434.944C135.212 435.462 136.058 435.688 136.272 435.177Z" fill="#FF6600" class="theme-color"/>
                                <path d="M124.991 407.14C130.456 415.513 133.072 425.709 132.313 435.678C123.607 432.647 115.933 422.813 111.331 414.826C106.73 406.837 104.157 397.866 101.816 388.95C111.248 392.268 119.528 398.767 124.991 407.14Z" fill="#111111"/>
                                <path d="M136.037 442.275C129.532 426.802 120.941 412.463 111.067 398.917C110.739 398.467 109.981 398.903 110.313 399.358C120.137 412.836 128.721 427.11 135.195 442.507C135.41 443.017 136.255 442.793 136.037 442.275Z" fill="#FF6600" class="theme-color"/>
                                <path d="M136.333 447.45C148.618 434.812 161.162 422.426 173.447 409.787C173.84 409.383 173.222 408.765 172.83 409.169C160.545 421.809 148 434.193 135.715 446.833C135.323 447.236 135.94 447.854 136.333 447.45Z" fill="#FF6600" class="theme-color"/>
                                <path d="M173.885 403.953C163.226 414.232 153.514 425.493 144.914 437.547L146.865 437.549C154.977 437.168 162.852 433.166 167.943 426.837C173.033 420.508 175.253 411.957 173.885 403.953Z" fill="#111111"/>
                                <path d="M123.391 379.458C127.968 386.942 132.279 394.585 136.32 402.373C136.578 402.872 137.333 402.43 137.073 401.932C133.034 394.144 128.723 386.502 124.145 379.017C123.853 378.538 123.097 378.977 123.391 379.458Z" fill="#FF6600" class="theme-color"/>
                                <path d="M112.389 341.648C110.643 349.499 108.912 359.707 108.895 367.882C108.876 376.058 111.371 384.034 116.016 389.512C120.662 394.99 130.039 397.39 133.819 394.255L112.389 341.648Z" fill="#111111"/>
                                <path d="M112.148 459.701H158.711V451.072H112.148V459.701Z" fill="#17282F"/>
                                <path d="M151.171 490.443H122.258L117.004 457.724H155.322L151.171 490.443Z" fill="#17282F"/>
                                <path d="M154.578 463.566H117.939L117.344 459.863H155.048L154.578 463.566Z" fill="#111D23"/>
                                <path d="M240.336 79.1003L239.16 85.9252L239.217 86.1535L239.425 86.2653C239.426 86.2653 239.64 86.2816 240.02 86.3282C241.156 86.4691 243.733 86.8826 246.007 87.9005C246.154 87.9657 246.325 87.9005 246.392 87.7538C246.457 87.607 246.392 87.4346 246.245 87.3694C243.089 85.9602 239.486 85.6876 239.47 85.6842L239.447 85.9742L239.734 86.0242L240.911 79.2004C240.937 79.0409 240.831 78.8906 240.673 78.8638C240.515 78.8359 240.363 78.9419 240.336 79.1003Z" fill="#17282F"/>
                                <path d="M247.348 74.5545L246.172 81.3783L246.229 81.6066L246.436 81.7184C246.437 81.7184 246.652 81.7347 247.031 81.7813C248.168 81.9211 250.744 82.3357 253.019 83.3536C253.166 83.4188 253.338 83.3536 253.403 83.2069C253.469 83.0601 253.403 82.8877 253.257 82.8214C250.1 81.4133 246.498 81.1407 246.482 81.1373L246.458 81.4273L246.746 81.4773L247.922 74.6524C247.949 74.494 247.843 74.3437 247.685 74.3169C247.526 74.289 247.375 74.395 247.348 74.5545Z" fill="#17282F"/>
                                <path d="M233.751 84.3266L232.574 91.1515L232.642 91.3915L232.87 91.4916C232.871 91.4916 232.997 91.4881 233.23 91.4881C234.339 91.4846 237.802 91.5929 240.28 92.7052C240.426 92.7704 240.599 92.7052 240.665 92.5584C240.73 92.4117 240.665 92.2393 240.517 92.173C237.877 90.9978 234.377 90.9081 233.23 90.9058C232.99 90.9058 232.855 90.9093 232.851 90.9104L232.861 91.2004L233.148 91.2505L234.324 84.4256C234.352 84.2672 234.246 84.1169 234.087 84.089C233.929 84.0622 233.777 84.1682 233.751 84.3266Z" fill="#17282F"/>
                                <path d="M226.306 91.3221L226.847 98.3078L226.968 98.5221L227.209 98.5675C227.211 98.5675 227.34 98.5337 227.579 98.4813C228.295 98.3253 229.96 98.0108 231.713 98.012C232.943 98.0108 234.214 98.168 235.22 98.6188C235.367 98.6851 235.539 98.6187 235.606 98.472C235.671 98.3253 235.604 98.1529 235.458 98.0877C234.331 97.5857 232.991 97.4296 231.713 97.4296C229.286 97.4296 227.078 98.0003 227.065 98.0026L227.137 98.2845L227.427 98.2624L226.886 91.2767C226.873 91.1159 226.733 90.996 226.573 91.0088C226.413 91.0205 226.293 91.1614 226.306 91.3221Z" fill="#17282F"/>
                                <path d="M221.466 99.3107L222.007 106.296L222.154 106.527L222.426 106.535C222.426 106.535 222.614 106.443 222.947 106.301C223.945 105.872 226.227 105.019 228.286 105.021C229.042 105.021 229.763 105.135 230.381 105.412C230.528 105.478 230.7 105.411 230.766 105.265C230.832 105.118 230.766 104.945 230.619 104.88C229.9 104.56 229.099 104.439 228.286 104.439C225.339 104.445 222.189 106.008 222.169 106.013L222.298 106.274L222.588 106.252L222.047 99.2653C222.034 99.1057 221.894 98.9858 221.734 98.9986C221.574 99.0102 221.454 99.15 221.466 99.3107Z" fill="#17282F"/>
                                <path d="M216.531 120.878C221.074 109.288 225.982 97.2262 235.525 89.3903C240.441 85.3512 246.317 81.3518 252.093 78.7266C252.24 78.6602 252.305 78.4879 252.238 78.3411C252.172 78.1944 251.999 78.1303 251.852 78.1967C246.009 80.8533 240.102 84.8772 235.156 88.9408C225.461 96.9094 220.537 109.076 215.989 120.665C215.93 120.814 216.004 120.984 216.154 121.043C216.303 121.101 216.472 121.027 216.531 120.878Z" fill="#17282F"/>
                                <path d="M253.78 84.8981C254.619 84.5254 254.999 83.5435 254.629 82.7027C254.257 81.8618 253.273 81.4797 252.432 81.8513C251.59 82.2228 251.208 83.2058 251.58 84.0478C251.965 84.8771 252.936 85.2521 253.78 84.8981Z" fill="#17282F"/>
                                <path d="M245.964 74.5212C246.338 75.361 247.324 75.7395 248.165 75.3656C249.004 74.9906 249.383 74.0065 249.009 73.1656C248.635 72.3258 247.65 71.9473 246.809 72.3212C245.969 72.695 245.591 73.6803 245.964 74.5201V74.5212Z" fill="#17282F"/>
                                <path d="M254.316 79.1548C255.157 78.7809 255.534 77.7968 255.16 76.957C254.786 76.1161 253.802 75.7376 252.961 76.1115C252.12 76.4853 251.743 77.4707 252.117 78.3104C252.504 79.1373 253.475 79.51 254.316 79.1548Z" fill="#17282F"/>
                                <path d="M247.48 89.844C248.321 89.469 248.698 88.4849 248.324 87.6451C247.95 86.8042 246.966 86.4257 246.125 86.7996C245.286 87.1734 244.907 88.1588 245.281 88.9985C245.657 89.8371 246.64 90.2144 247.48 89.844Z" fill="#17282F"/>
                                <path d="M239.669 79.4747C240.041 80.3121 241.023 80.6895 241.86 80.3179L241.864 80.3168C242.706 79.9441 243.085 78.9599 242.713 78.1179C242.34 77.277 241.357 76.8973 240.515 77.27C239.674 77.6427 239.294 78.6257 239.666 79.4677L239.669 79.4747Z" fill="#17282F"/>
                                <path d="M242.343 93.4385C243.097 92.9144 243.285 91.879 242.763 91.1231C242.24 90.3661 241.202 90.1774 240.445 90.7004C239.688 91.2233 239.499 92.261 240.022 93.0181C240.549 93.7728 241.585 93.9614 242.343 93.4385Z" fill="#17282F"/>
                                <path d="M235.039 85.1319C235.792 84.6078 235.98 83.5724 235.458 82.8165C234.935 82.0594 233.897 81.8708 233.14 82.3937C232.383 82.9167 232.195 83.9544 232.718 84.7114C233.244 85.4661 234.281 85.6548 235.039 85.1319Z" fill="#17282F"/>
                                <path d="M234.252 99.0755C234.93 99.6974 235.984 99.652 236.605 98.973C237.227 98.2952 237.181 97.2423 236.504 96.6204L236.424 96.5435C235.747 95.9216 234.693 95.967 234.071 96.6448C233.449 97.3238 233.495 98.3767 234.173 98.9986L234.252 99.0755Z" fill="#17282F"/>
                                <path d="M226.586 92.7012C225.666 92.6965 224.924 91.9464 224.93 91.0263C224.934 90.1063 225.684 89.3644 226.605 89.369C227.525 89.3748 228.265 90.1237 228.261 91.0438C228.256 91.9639 227.506 92.7058 226.586 92.7012Z" fill="#17282F"/>
                                <path d="M232.34 105.702C232.896 104.971 232.754 103.926 232.024 103.369C231.293 102.81 230.247 102.951 229.689 103.684C229.131 104.415 229.272 105.46 230.003 106.018C230.736 106.573 231.781 106.433 232.34 105.702Z" fill="#17282F"/>
                                <path d="M222.831 100.048L222.834 100.043C223.392 99.3117 223.251 98.2658 222.519 97.7079C221.787 97.1501 220.741 97.2921 220.185 98.0235C219.627 98.7561 219.769 99.8008 220.5 100.359C221.23 100.914 222.272 100.776 222.831 100.048Z" fill="#17282F"/>
                                <path d="M135.382 126.838L139.143 131.549L139.371 131.368L139.211 131.124C139.198 131.135 136.564 132.856 134.742 135.261C134.646 135.389 134.671 135.572 134.799 135.67C134.927 135.767 135.11 135.741 135.207 135.613C136.076 134.463 137.16 133.457 138.025 132.744C138.457 132.387 138.836 132.103 139.105 131.908C139.374 131.714 139.53 131.611 139.53 131.611L139.658 131.413L139.599 131.186L135.836 126.475C135.736 126.349 135.553 126.328 135.427 126.429C135.301 126.53 135.28 126.712 135.382 126.838Z" fill="#17282F"/>
                                <path d="M128.131 126.313L131.894 131.024L132.121 130.842L131.961 130.599C131.949 130.609 129.313 132.331 127.493 134.737C127.396 134.865 127.42 135.048 127.55 135.145C127.678 135.241 127.861 135.216 127.957 135.087C128.826 133.938 129.91 132.933 130.776 132.219C131.208 131.862 131.586 131.578 131.855 131.383C132.124 131.188 132.28 131.087 132.28 131.086L132.409 130.889L132.348 130.661L128.586 125.949C128.486 125.825 128.303 125.804 128.177 125.904C128.052 126.004 128.031 126.188 128.131 126.313Z" fill="#17282F"/>
                                <path d="M142.601 128.059L146.363 132.77L146.59 132.588L146.458 132.328C146.443 132.341 142.976 134.089 141.13 136.521C141.032 136.649 141.058 136.832 141.186 136.929C141.315 137.027 141.497 137.001 141.595 136.873C142.449 135.738 143.736 134.723 144.807 134.001C145.341 133.639 145.822 133.35 146.168 133.152C146.514 132.953 146.721 132.848 146.723 132.847L146.875 132.65L146.818 132.406L143.056 127.695C142.955 127.569 142.772 127.548 142.646 127.65C142.52 127.75 142.501 127.933 142.601 128.059Z" fill="#17282F"/>
                                <path d="M151.146 130.151L153.667 135.707L153.931 135.585L153.859 135.304C153.838 135.321 149.371 136.427 147.473 138.906C147.376 139.034 147.401 139.217 147.529 139.314C147.658 139.411 147.84 139.386 147.938 139.258C148.768 138.152 150.289 137.286 151.602 136.719C152.258 136.433 152.861 136.22 153.299 136.078C153.737 135.937 154.003 135.868 154.005 135.868L154.194 135.712L154.197 135.465L151.676 129.91C151.61 129.764 151.438 129.699 151.291 129.766C151.144 129.832 151.08 130.004 151.146 130.151Z" fill="#17282F"/>
                                <path d="M158.192 134.212L160.711 139.767L160.977 139.648L160.964 139.356C160.952 139.358 159.7 139.415 158.212 139.773C156.725 140.136 154.988 140.781 154.016 142.055C153.919 142.183 153.945 142.366 154.073 142.463C154.201 142.559 154.384 142.535 154.48 142.405C155.287 141.326 156.914 140.679 158.348 140.339C159.063 140.167 159.727 140.067 160.211 140.009C160.694 139.952 160.99 139.939 160.991 139.939L161.225 139.799L161.242 139.528L158.722 133.972C158.656 133.825 158.483 133.76 158.337 133.827C158.19 133.893 158.126 134.066 158.192 134.212Z" fill="#17282F"/>
                                <path d="M171.852 147.944C163.517 141.015 154.651 133.799 143.898 131.789C139.65 130.997 134.97 130.465 130.483 130.465C129.182 130.465 127.897 130.509 126.644 130.606C126.483 130.618 126.363 130.758 126.376 130.918C126.388 131.078 126.529 131.198 126.688 131.187C127.925 131.091 129.196 131.047 130.483 131.047C134.923 131.047 139.572 131.575 143.791 132.362C154.347 134.328 163.149 141.46 171.48 148.391C171.604 148.495 171.786 148.477 171.89 148.354C171.993 148.23 171.976 148.046 171.852 147.944Z" fill="#17282F"/>
                                <path d="M129.309 134.991C129.239 134.193 128.536 133.603 127.738 133.673C126.94 133.743 126.35 134.447 126.42 135.244C126.491 136.042 127.192 136.632 127.988 136.563C128.78 136.479 129.364 135.785 129.309 134.991Z" fill="#17282F"/>
                                <path d="M129.595 125.369C129.528 124.57 128.825 123.978 128.028 124.045C127.229 124.113 126.637 124.815 126.704 125.613C126.772 126.411 127.474 127.004 128.272 126.936C129.07 126.869 129.663 126.166 129.595 125.369Z" fill="#17282F"/>
                                <path d="M126.492 130.843C126.425 130.044 125.723 129.453 124.925 129.52C124.127 129.588 123.535 130.29 123.603 131.088C123.67 131.885 124.372 132.478 125.169 132.411C125.96 132.328 126.545 131.636 126.492 130.843Z" fill="#17282F"/>
                                <path d="M136.192 136.122C136.124 135.325 135.422 134.733 134.624 134.801C133.826 134.868 133.235 135.57 133.302 136.368C133.37 137.166 134.071 137.758 134.869 137.69C135.666 137.62 136.257 136.92 136.192 136.122Z" fill="#17282F"/>
                                <path d="M136.473 126.497C136.403 125.699 135.701 125.108 134.903 125.177C134.106 125.246 133.514 125.949 133.584 126.747C133.652 127.545 134.355 128.137 135.154 128.067H135.157C135.952 127.998 136.542 127.298 136.473 126.504V126.497Z" fill="#17282F"/>
                                <path d="M141.89 136.981C141.971 136.184 141.391 135.471 140.595 135.391C139.797 135.309 139.085 135.889 139.004 136.686C138.923 137.481 139.501 138.192 140.296 138.276C141.093 138.356 141.806 137.777 141.89 136.981Z" fill="#17282F"/>
                                <path d="M143.976 127.578C144.057 126.781 143.477 126.069 142.679 125.987C141.883 125.907 141.171 126.486 141.09 127.284C141.008 128.079 141.587 128.79 142.381 128.873C143.179 128.954 143.891 128.375 143.976 127.578Z" fill="#17282F"/>
                                <path d="M148.864 139.086C149.12 138.327 148.712 137.504 147.954 137.248C147.195 136.992 146.372 137.399 146.116 138.158L146.088 138.25C145.832 139.009 146.24 139.831 146.998 140.087C147.757 140.344 148.581 139.936 148.837 139.178L148.864 139.086Z" fill="#17282F"/>
                                <path d="M150.032 130.537C149.642 129.838 149.892 128.954 150.592 128.564C151.292 128.175 152.175 128.425 152.565 129.125C152.955 129.824 152.703 130.708 152.005 131.098C151.305 131.487 150.422 131.237 150.032 130.537Z" fill="#17282F"/>
                                <path d="M154.988 142.688C155.312 141.955 154.98 141.099 154.248 140.775C153.515 140.451 152.659 140.783 152.335 141.516C152.011 142.247 152.342 143.103 153.074 143.427C153.806 143.75 154.662 143.419 154.988 142.688Z" fill="#17282F"/>
                                <path d="M159.863 134.38C160.187 133.648 159.856 132.792 159.124 132.467C158.391 132.143 157.535 132.474 157.21 133.206C156.886 133.939 157.217 134.795 157.95 135.12L157.956 135.122C158.687 135.442 159.54 135.11 159.863 134.38Z" fill="#17282F"/>
                                <path d="M205.079 104.822C198.807 99.5809 185.944 102.228 183.18 107.469C180.415 112.71 200.322 111.465 205.96 106.683L205.079 104.822Z" fill="#111111"/>
                                <path d="M205.948 106.269C205.897 106.382 205.769 106.438 205.651 106.4C197.669 103.941 185.936 107.983 185.815 108.028C185.688 108.07 185.55 108.007 185.499 107.884C185.454 107.757 185.518 107.618 185.643 107.569C185.765 107.524 197.653 103.424 205.797 105.942C205.927 105.981 206.003 106.117 205.966 106.248L205.948 106.269Z" fill="#FF6600" class="theme-color"/>
                                <path d="M202.566 100.504C210.817 98.0127 224.638 79.3186 217.758 78.7059C210.88 78.0933 200.143 89.0063 201.301 98.4622L202.566 100.504Z" fill="#111111"/>
                                <path d="M202.139 100.234C201.986 100.188 201.9 100.028 201.946 99.8749C204.637 90.3107 216.178 81.2705 216.298 81.1808C216.425 81.0888 216.603 81.1145 216.699 81.2391C216.786 81.3672 216.76 81.5407 216.639 81.6386C216.518 81.7283 205.133 90.6531 202.486 100.023C202.45 100.163 202.314 100.252 202.17 100.231L202.139 100.234Z" fill="#FF6600" class="theme-color"/>
                                <path d="M210.087 112.869C203.644 100.021 195.061 88.3058 184.738 78.3059C184.334 77.9146 183.716 78.5307 184.12 78.9232C194.393 88.8765 202.921 100.524 209.333 113.31C209.585 113.812 210.339 113.371 210.087 112.869Z" fill="#17282F"/>
                                <path d="M177.915 81.5602C167.177 87.3614 157.045 82.7831 161.551 74.9123C164.384 70.0183 171.165 70.5738 174.831 71.1294C176.336 71.3577 177.316 71.5859 177.284 71.4369C177.172 70.9256 164.228 59.2276 173.697 53.8585C183.164 48.4894 187.647 56.3195 186.376 67.9929C186.376 67.9929 194.071 54.2743 202.005 56.3358C209.94 58.3972 212.768 71.4695 192.728 76.4473C192.728 76.4473 209.692 76.6709 208.326 86.7301C206.959 96.7894 194.703 95.2404 185.993 83.3188C185.993 83.3188 190.939 100.616 178.515 100.49C164.42 100.394 177.915 81.5602 177.915 81.5602Z" fill="#406FBF"/>
                                <mask id="mask0_599_3533" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="160" y="52" width="49" height="49">
                                <path d="M178.651 100.49C178.606 100.49 178.56 100.49 178.515 100.49C173.677 100.458 172.089 98.2168 172.09 95.2877C172.094 89.6844 177.915 81.5609 177.915 81.5609C174.556 83.3766 171.254 84.1744 168.444 84.1744C163.77 84.1755 160.45 81.9685 160.453 78.5502C160.453 77.4519 160.798 76.229 161.551 74.9129C163.479 71.582 167.237 70.776 170.596 70.776C172.172 70.776 173.66 70.953 174.831 71.1301C176.001 71.3071 176.855 71.4853 177.161 71.4853C177.242 71.4853 177.284 71.4737 177.285 71.4446C177.285 71.4422 177.285 71.4399 177.284 71.4376C177.202 71.0637 170.236 64.6883 170.235 59.1934C170.234 57.1855 171.163 55.2964 173.697 53.8592C175.786 52.6747 177.632 52.132 179.228 52.132C184.059 52.132 186.589 57.1051 186.588 64.2574C186.588 65.4477 186.518 66.6962 186.376 67.9936C186.376 67.9936 193.034 56.1257 200.348 56.1257C200.897 56.1257 201.451 56.1921 202.005 56.3365C205.5 57.2449 208.004 60.2882 208.001 63.8358C207.995 68.3419 203.942 73.6621 192.728 76.448C192.728 76.448 208.392 76.6541 208.404 85.5965C208.405 85.9598 208.379 86.3384 208.326 86.7308C207.741 91.0355 205.162 93.2146 201.721 93.3648C201.594 93.3695 201.465 93.373 201.335 93.373C200.131 93.373 198.829 93.133 197.477 92.659C196.943 92.4715 196.402 92.2479 195.854 91.987C192.547 90.4123 189.052 87.5053 185.993 83.3195C185.993 83.3195 186.966 86.725 186.964 90.502C186.962 95.2073 185.446 100.49 178.651 100.49ZM181.334 82.5683C181.334 82.5683 174.947 95.7302 178.416 95.7291C178.432 95.7291 178.45 95.7279 178.467 95.7279C182.046 95.5998 184.228 83.4709 184.228 83.4709C184.228 83.4709 183.366 88.4464 184.851 88.4464C184.905 88.4464 184.965 88.4394 185.026 88.4254C186.753 88.0248 184.851 80.0352 184.851 80.0352C184.851 80.0352 188.016 84.094 189.162 84.094C189.244 84.094 189.315 84.073 189.373 84.03C190.267 83.3754 186.273 79.2362 186.273 79.2362C186.273 79.2362 194.754 86.6621 198.866 86.661C199.698 86.661 200.351 86.3582 200.719 85.6279C202.418 82.2608 193.555 79.5635 189.5 78.5234C189.995 78.6073 190.528 78.669 191.03 78.669C191.756 78.669 192.415 78.5409 192.792 78.1659C193.991 76.9744 187.384 75.9926 187.384 75.9926C187.384 75.9926 187.407 75.9926 187.45 75.9926C187.984 75.9926 191.573 75.9378 192.593 74.482C193.071 73.8007 192.153 73.6073 190.96 73.6073C189.396 73.6073 187.359 73.9393 187.359 73.9393C187.359 73.9393 201.99 66.2047 200.064 64.1502C199.876 63.9511 199.598 63.8614 199.245 63.8614C195.973 63.8614 186.44 71.6297 186.44 71.6297C186.44 71.6297 189.717 68.0658 189.021 67.3146C188.97 67.2587 188.9 67.2331 188.816 67.2331C187.766 67.2331 184.403 71.2465 184.403 71.2465C184.403 71.2465 185.481 66.8825 184.67 66.8825C184.649 66.8825 184.627 66.886 184.603 66.8919C183.668 67.1306 182.973 70.8145 182.925 71.0544C182.924 71.0567 182.924 71.0579 182.923 71.0579C182.878 71.0579 182.217 68.0903 181.241 65.1239C180.266 62.1563 178.977 59.1899 177.673 59.1899C177.525 59.1899 177.376 59.2283 177.228 59.3087C174.448 60.8274 180.504 71.1347 180.504 71.1347C180.504 71.1347 178.125 68.0134 176.727 68.0134C176.509 68.0134 176.315 68.0903 176.158 68.2662C174.991 69.5683 180.136 72.6686 180.584 73.1077C180.657 73.1788 180.558 73.2055 180.34 73.2055C179.992 73.2055 179.337 73.1368 178.578 73.0693C177.818 73.0006 176.953 72.9318 176.182 72.9318C175.211 72.9318 174.39 73.0402 174.119 73.3954C173.289 74.4902 179.178 74.8896 179.178 74.8896C179.178 74.8896 179.162 74.8896 179.132 74.8896C178.245 74.8896 164.649 74.949 166.018 78.6294C166.42 79.709 167.612 80.0957 169.115 80.0957C172.903 80.0957 178.658 77.6383 178.658 77.6383C178.658 77.6383 174.351 80.0666 175.526 80.8656C175.694 80.9797 175.921 81.0298 176.189 81.0298C177.79 81.0298 180.808 79.2688 180.808 79.2688C180.808 79.2688 176.781 84.1103 177.747 85.0933C177.866 85.2144 178.009 85.2668 178.171 85.2668C179.318 85.2668 181.334 82.5683 181.334 82.5683Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_599_3533)">
                                <path d="M160.449 100.49H208.404V52.1319H160.449V100.49Z" fill="#FF6600" class="theme-color"/>
                                </g>
                                <path d="M178.416 95.7285C174.948 95.7297 181.335 82.5678 181.335 82.5678C181.335 82.5678 179.319 85.2663 178.172 85.2663C178.01 85.2663 177.867 85.2139 177.748 85.0927C176.781 84.1098 180.809 79.2682 180.809 79.2682C180.809 79.2682 177.791 81.0292 176.19 81.0292C175.922 81.0292 175.695 80.9791 175.527 80.865C174.352 80.066 178.659 77.6377 178.659 77.6377C178.659 77.6377 172.904 80.0952 169.115 80.0952C167.613 80.0952 166.42 79.7085 166.019 78.6288C164.65 74.9485 178.245 74.8891 179.133 74.8891C179.163 74.8891 179.178 74.8891 179.178 74.8891C179.178 74.8891 173.29 74.4896 174.12 73.3948C174.39 73.0396 175.211 72.9313 176.183 72.9313C176.954 72.9313 177.819 73 178.578 73.0687C179.338 73.1363 179.992 73.205 180.341 73.205C180.558 73.205 180.657 73.1782 180.585 73.1071C180.137 72.6681 174.991 69.5677 176.158 68.2656C176.315 68.0897 176.51 68.0129 176.728 68.0129C178.125 68.0129 180.505 71.1342 180.505 71.1342C180.505 71.1342 174.448 60.8268 177.229 59.3081C177.376 59.2278 177.525 59.1894 177.673 59.1894C178.978 59.1894 180.267 62.1558 181.242 65.1233C182.218 68.0897 182.878 71.0573 182.924 71.0573C182.925 71.0573 182.925 71.0562 182.926 71.0538C182.974 70.8139 183.669 67.1301 184.603 66.8913C184.628 66.8855 184.65 66.882 184.671 66.882C185.481 66.882 184.404 71.246 184.404 71.246C184.404 71.246 187.766 67.2325 188.817 67.2325C188.901 67.2325 188.971 67.2582 189.022 67.3141C189.717 68.0653 186.441 71.6292 186.441 71.6292C186.441 71.6292 195.974 63.8608 199.245 63.8608C199.598 63.8608 199.877 63.9505 200.064 64.1497C201.991 66.2041 187.36 73.9387 187.36 73.9387C187.36 73.9387 189.397 73.6068 190.961 73.6068C192.154 73.6068 193.071 73.8001 192.594 74.4814C191.574 75.9373 187.984 75.992 187.451 75.992C187.408 75.992 187.384 75.992 187.384 75.992C187.384 75.992 193.992 76.9738 192.793 78.1653C192.416 78.5403 191.757 78.6684 191.031 78.6684C190.529 78.6684 189.996 78.6067 189.501 78.5229C193.556 79.5629 202.419 82.2603 200.72 85.6273C200.352 86.3576 199.698 86.6604 198.867 86.6604C194.754 86.6616 186.273 79.2356 186.273 79.2356C186.273 79.2356 190.268 83.3748 189.374 84.0294C189.315 84.0725 189.244 84.0935 189.163 84.0935C188.017 84.0935 184.851 80.0346 184.851 80.0346C184.851 80.0346 186.753 88.0242 185.027 88.4249C184.965 88.4388 184.906 88.4458 184.851 88.4458C183.366 88.4458 184.228 83.4704 184.228 83.4704C184.228 83.4704 182.047 95.5992 178.468 95.7273C178.45 95.7273 178.433 95.7285 178.416 95.7285Z" fill="white"/>
                                <path d="M179.225 76.4706C179.177 74.8726 179.897 74.3777 180.999 72.9789C182.102 71.5813 183.188 71.5254 184.267 71.9086C185.345 72.2917 186.129 73.4191 186.808 74.2577C187.487 75.0963 187.911 77.6539 187.007 77.9334C186.105 78.2129 185.409 79.2355 184.387 79.7631C183.364 80.2907 181.311 80.0659 180.839 79.2681C180.367 78.468 179.281 78.0685 179.225 76.4706Z" fill="#17282F"/>
                                <path d="M268.872 91.9812C263.815 89.5133 262.811 84.4866 266.97 84.0638C268.828 83.8821 270.183 85.211 271.086 86.5387C271.963 87.8269 272.418 89.115 272.497 89.0265C272.659 88.8471 273.568 80.8563 278.122 82.9632C282.676 85.0701 280.944 88.8529 276.228 91.5107C276.228 91.5107 283.435 90.7118 284.793 94.2384C286.15 97.765 282.01 102.335 274.766 96.1601C274.766 96.1601 279.234 102.577 275.098 104.766C270.961 106.954 268.252 101.945 270.382 95.4799C270.382 95.4799 265.226 101.978 261.938 97.2863C258.19 91.9789 268.872 91.9812 268.872 91.9812Z" fill="#406FBF"/>
                                <path d="M273.208 105.289C271.068 105.289 269.636 103.056 269.636 99.8128C269.637 98.5072 269.869 97.0362 270.381 95.4814C270.381 95.4814 267.598 98.9894 264.816 98.9894C263.814 98.9894 262.81 98.5328 261.937 97.2878C261.378 96.4958 261.141 95.8215 261.141 95.2485C261.141 91.9851 268.853 91.9827 268.872 91.9827C265.947 90.556 264.378 88.2744 264.38 86.5204C264.38 85.2416 265.216 84.2435 266.97 84.0653C267.085 84.0536 267.198 84.0478 267.309 84.0478C268.994 84.0478 270.238 85.294 271.086 86.5402C271.935 87.7864 272.387 89.0326 272.487 89.0326C272.49 89.0326 272.494 89.0315 272.496 89.028C272.639 88.8696 273.366 82.6106 276.675 82.6106C277.112 82.6106 277.592 82.7189 278.122 82.9647C279.971 83.8207 280.784 84.9528 280.78 86.1745C280.777 87.4755 279.848 88.8765 278.26 90.1519C278.166 90.2276 278.068 90.3044 277.969 90.379C277.448 90.7726 276.865 91.1523 276.228 91.5122C276.228 91.5122 276.929 91.4342 277.934 91.4342C280.153 91.4342 283.859 91.8127 284.793 94.2399C284.964 94.6871 285.048 95.1506 285.048 95.6072C285.049 97.4648 283.668 99.2025 281.234 99.2037C280.37 99.2037 279.375 98.9847 278.26 98.4746C278.163 98.4315 278.067 98.3849 277.969 98.336C276.985 97.8503 275.914 97.1411 274.765 96.1616C274.765 96.1616 276.853 99.1606 276.853 101.758C276.853 102.96 276.406 104.075 275.097 104.767C274.425 105.124 273.79 105.289 273.208 105.289ZM271.986 94.4903C271.986 94.4903 271.287 101.633 273.323 101.633C273.371 101.633 273.419 101.629 273.469 101.62C275.187 101.354 273.818 97.3076 273.119 95.5093C273.367 96.0171 273.728 96.5773 274.138 96.6472C274.156 96.6496 274.172 96.6519 274.187 96.6519C274.842 96.6519 273.5 94.036 273.5 94.036C273.5 94.036 274.573 95.5839 275.457 95.5827C275.459 95.5827 275.463 95.5827 275.465 95.5827C276.35 95.5746 274.263 93.4758 274.263 93.4758C274.263 93.4758 279.11 95.8949 280.786 95.8949C281.1 95.8949 281.302 95.8098 281.342 95.6095C281.595 94.3365 274.883 92.5115 274.883 92.5115C274.883 92.5115 275.528 92.5907 276.138 92.5907C276.656 92.5907 277.149 92.5336 277.192 92.3205C277.288 91.8581 274.48 91.645 274.48 91.645C274.48 91.645 276.506 90.8367 276.165 90.5513C276.109 90.5036 276.02 90.485 275.911 90.485C275.351 90.485 274.24 91.0009 274.155 91.0394C274.153 91.0394 274.153 91.0394 274.153 91.0394C274.094 91.0394 278.336 86.383 277.027 85.7517C276.949 85.7133 276.868 85.6958 276.784 85.6958C275.454 85.6958 273.474 90.153 273.474 90.153C273.474 90.153 274.184 87.8423 273.382 87.7538C273.37 87.7527 273.358 87.7527 273.345 87.7527C272.588 87.7527 272.8 90.4314 272.756 90.7132C272.754 90.7284 272.749 90.7354 272.741 90.7354C272.592 90.7354 271.513 88.385 270.913 88.3676C270.911 88.3676 270.909 88.3676 270.906 88.3676C270.29 88.3676 271.711 90.6643 271.711 90.6643C271.711 90.6643 268.727 86.4599 267.284 86.4599C267.079 86.4599 266.906 86.5437 266.776 86.7359C265.731 88.2872 270.541 91.2071 270.541 91.2071C270.541 91.2071 269.391 90.6725 268.813 90.6725C268.617 90.6725 268.486 90.7342 268.491 90.9007C268.506 91.5553 270.507 92.4509 270.507 92.4509C270.507 92.4509 270.042 92.4171 269.477 92.4171C268.633 92.4171 267.567 92.4917 267.502 92.8679C267.394 93.4933 269.412 93.5341 269.412 93.5341C269.412 93.5341 262.701 94.6848 263.71 95.9915C263.923 96.2687 264.32 96.377 264.815 96.377C266.655 96.377 269.836 94.8676 269.85 94.8606C269.84 94.8653 267.596 95.9519 268.208 96.49C268.26 96.5366 268.328 96.5575 268.406 96.5575C269.23 96.5575 271.305 94.1723 271.305 94.1723C271.305 94.1723 270.536 96.78 271.022 96.9396C271.036 96.9442 271.051 96.9466 271.065 96.9466C271.535 96.9466 271.986 94.4903 271.986 94.4903Z" fill="#FF6600" class="theme-color"/>
                                <path d="M273.326 101.633C271.29 101.633 271.989 94.4899 271.989 94.4899C271.989 94.4899 271.538 96.9462 271.068 96.9462C271.054 96.9462 271.038 96.9438 271.024 96.9392C270.539 96.7796 271.307 94.1719 271.307 94.1719C271.307 94.1719 269.233 96.5572 268.409 96.5572C268.331 96.5572 268.263 96.5362 268.211 96.4896C267.599 95.9515 269.842 94.8649 269.853 94.8602C269.839 94.8672 266.658 96.3766 264.818 96.3766C264.323 96.3766 263.926 96.2684 263.713 95.9912C262.704 94.6844 269.415 93.5337 269.415 93.5337C269.415 93.5337 267.396 93.4929 267.505 92.8675C267.57 92.4913 268.636 92.4168 269.48 92.4168C270.045 92.4168 270.51 92.4506 270.51 92.4506C270.51 92.4506 268.509 91.5549 268.494 90.9004C268.489 90.7338 268.619 90.6721 268.816 90.6721C269.394 90.6721 270.543 91.2067 270.543 91.2067C270.543 91.2067 265.733 88.2868 266.779 86.7355C266.908 86.5433 267.082 86.4595 267.287 86.4595C268.73 86.4595 271.714 90.664 271.714 90.664C271.714 90.664 270.293 88.3672 270.909 88.3672C270.911 88.3672 270.914 88.3672 270.916 88.3672C271.516 88.3847 272.594 90.735 272.743 90.735C272.752 90.735 272.756 90.728 272.759 90.7129C272.803 90.431 272.591 87.7523 273.348 87.7523C273.361 87.7523 273.372 87.7523 273.385 87.7535C274.187 87.842 273.477 90.1527 273.477 90.1527C273.477 90.1527 275.457 85.6955 276.787 85.6955C276.871 85.6955 276.951 85.7129 277.029 85.7514C278.339 86.3826 274.097 91.039 274.156 91.039C274.156 91.039 274.156 91.039 274.157 91.039C274.242 91.0006 275.353 90.4846 275.914 90.4846C276.023 90.4846 276.112 90.5032 276.168 90.551C276.509 90.8363 274.482 91.6446 274.482 91.6446C274.482 91.6446 277.29 91.8577 277.195 92.3201C277.152 92.5333 276.659 92.5903 276.141 92.5903C275.531 92.5903 274.885 92.5111 274.885 92.5111C274.885 92.5111 281.597 94.3362 281.345 95.6091C281.305 95.8095 281.102 95.8945 280.789 95.8945C279.113 95.8945 274.266 93.4755 274.266 93.4755C274.266 93.4755 276.353 95.5742 275.468 95.5824C275.465 95.5824 275.462 95.5824 275.459 95.5824C274.576 95.5835 273.503 94.0357 273.503 94.0357C273.503 94.0357 274.845 96.6515 274.19 96.6515C274.175 96.6515 274.159 96.6492 274.141 96.6469C273.731 96.577 273.37 96.0168 273.122 95.509C273.821 97.3072 275.189 101.353 273.471 101.62C273.421 101.628 273.374 101.633 273.326 101.633Z" fill="white"/>
                                <path d="M271.132 91.1071C271.718 90.6599 272.097 90.7973 272.917 90.8346C273.737 90.873 274.05 91.2655 274.195 91.7722C274.341 92.28 274.129 92.8751 273.998 93.3549C273.865 93.8348 273.02 94.6803 272.673 94.4171C272.326 94.1539 271.756 94.1679 271.284 93.9256C270.811 93.6845 270.344 92.8541 270.517 92.4628C270.69 92.0715 270.548 91.5567 271.132 91.1071Z" fill="#17282F"/>
                                <path d="M156.367 171.154C167.291 169.692 178.363 169.68 189.287 171.149C189.836 171.224 190.074 170.382 189.518 170.307C178.511 168.827 167.377 168.807 156.367 170.28C155.819 170.354 155.812 171.228 156.367 171.154Z" fill="#17282F"/>
                                <path d="M140.225 186.129C132.588 190.801 124.395 187.475 131.572 180.652C138.749 173.829 140.051 173.921 139.785 173.447C139.517 172.973 124.352 169.295 124.856 164.193C125.36 159.09 134.974 157.691 142.019 161.133C149.063 164.576 156.011 176.471 140.225 186.129Z" fill="#FF6600" class="theme-color"/>
                                <path d="M155.776 176.485C150.679 192.919 137.819 199.912 134.567 194.853C131.317 189.794 143.752 178.238 143.752 178.238C143.752 178.238 129.442 188.303 124.553 179.207C119.665 170.111 131.255 162.522 142.198 168.54C142.198 168.54 124.948 158.017 128.533 151.567C132.118 145.117 160.635 160.779 155.776 176.485Z" fill="#406FBF"/>
                                <path d="M146.618 191.918C147.632 190.955 148.641 189.841 149.612 188.586C149.636 188.56 149.659 188.533 149.682 188.507C148.69 189.797 147.657 190.936 146.618 191.918ZM127.18 168.371C127.29 168.296 127.403 168.224 127.517 168.153L127.519 168.154C127.403 168.224 127.29 168.296 127.18 168.371ZM138.094 151.592C138.093 151.594 138.093 151.595 138.091 151.595C135.756 150.62 133.588 150.077 131.878 150.077C130.504 150.077 129.424 150.428 128.79 151.186C129.414 150.428 130.491 150.075 131.87 150.075C133.58 150.075 135.752 150.616 138.094 151.592Z" fill="white"/>
                                <path d="M137.78 184.854C140.259 181.573 143.151 178.786 143.679 178.286C143.724 178.254 143.748 178.238 143.748 178.238C143.748 178.238 140.517 181.24 137.78 184.854ZM142.194 168.54C139.472 167.043 136.713 166.389 134.175 166.389C131.648 166.389 129.342 167.039 127.517 168.156L127.516 168.154C129.345 167.026 131.664 166.368 134.208 166.368C136.608 166.368 139.208 166.954 141.786 168.284C142.048 168.45 142.194 168.54 142.194 168.54Z" fill="#7DA6DD"/>
                                <path d="M137.836 196.436C136.419 196.436 135.279 195.907 134.587 194.826C132.986 192.367 135.152 188.332 137.782 184.853C140.519 181.239 143.75 178.238 143.75 178.238C143.75 178.238 143.727 178.254 143.681 178.285C143.737 178.233 143.766 178.205 143.766 178.205C143.766 178.205 136.969 182.992 131.147 182.992C128.521 182.992 126.092 182.018 124.575 179.193C122.198 174.766 123.725 170.692 127.18 168.372C127.291 168.297 127.404 168.225 127.519 168.155C129.344 167.038 131.65 166.388 134.177 166.388C136.715 166.388 139.474 167.043 142.196 168.539C142.196 168.539 142.051 168.45 141.789 168.283C141.932 168.358 142.075 168.433 142.218 168.513C142.218 168.513 124.963 157.997 128.547 151.547C128.618 151.418 128.7 151.298 128.791 151.187C129.424 150.429 130.504 150.078 131.878 150.078C133.588 150.078 135.757 150.621 138.092 151.596C134.893 155.857 151.044 167.804 151.044 167.804C151.044 167.804 144.765 163.92 142.565 163.92C142.123 163.92 141.846 164.078 141.818 164.456C141.655 166.714 150.165 170.296 150.571 170.47C149.868 170.487 134.462 170.552 135.396 174.685C135.669 175.895 137.13 176.324 139.061 176.324C143.723 176.323 151.121 173.827 151.121 173.827C151.121 173.827 144.069 178.167 145.889 180.03C146.111 180.252 146.39 180.35 146.71 180.35C147.884 180.35 149.608 179.032 151.012 177.737C147.511 181.419 141.572 188.247 143.017 190.902C143.413 191.627 143.976 191.976 144.669 191.976C145.945 191.975 147.667 190.792 149.613 188.587C148.641 189.842 147.633 190.956 146.618 191.919C143.471 194.892 140.253 196.434 137.836 196.436Z" fill="#F2F2F2"/>
                                <path d="M149.611 188.586C149.771 188.377 149.931 188.168 150.089 187.951C149.954 188.138 149.818 188.323 149.681 188.507C149.657 188.534 149.634 188.56 149.611 188.586ZM153.42 182.427C154.31 180.61 155.108 178.628 155.772 176.484C156.326 174.695 156.446 172.905 156.219 171.149C156.22 171.149 156.221 171.149 156.223 171.15C156.294 171.694 156.33 172.242 156.331 172.792C156.332 174.015 156.155 175.249 155.772 176.484C155.152 178.53 154.365 180.517 153.42 182.427ZM156.101 170.402C155.32 166.182 152.581 162.184 149.104 158.867H149.105C152.584 162.183 155.323 166.18 156.105 170.4C156.104 170.4 156.103 170.401 156.101 170.402ZM141.439 153.232C140.306 152.6 139.18 152.05 138.09 151.595C138.091 151.595 138.091 151.594 138.092 151.593C139.181 152.049 140.307 152.599 141.441 153.232C141.439 153.232 141.441 153.232 141.439 153.232Z" fill="#E0E1DE"/>
                                <path d="M149.106 158.867C146.762 156.632 144.083 154.707 141.441 153.233C141.443 153.233 141.441 153.233 141.443 153.233C144.085 154.708 146.764 156.633 149.107 158.867H149.106Z" fill="#D3D5D2"/>
                                <path d="M156.227 171.15C156.225 171.149 156.224 171.149 156.223 171.149C156.192 170.9 156.152 170.651 156.105 170.403C156.107 170.402 156.108 170.4 156.109 170.4C156.156 170.65 156.195 170.899 156.227 171.15Z" fill="#5E6D71"/>
                                <path d="M144.669 191.977C143.976 191.977 143.414 191.627 143.018 190.903C141.573 188.247 147.511 181.42 151.012 177.737C149.609 179.032 147.885 180.351 146.711 180.351C146.391 180.351 146.111 180.253 145.89 180.031C144.07 178.167 151.122 173.828 151.122 173.828C151.122 173.828 143.724 176.323 139.061 176.325C137.13 176.325 135.67 175.896 135.396 174.686C134.462 170.552 149.868 170.487 150.572 170.471C150.165 170.296 141.655 166.715 141.818 164.457C141.846 164.078 142.123 163.921 142.566 163.921C144.766 163.921 151.045 167.805 151.045 167.805C151.045 167.805 134.893 155.858 138.092 151.596C139.183 152.052 140.309 152.601 141.442 153.234C144.084 154.708 146.762 156.634 149.107 158.869C152.583 162.185 155.323 166.184 156.104 170.403C156.151 170.651 156.19 170.901 156.222 171.15C156.449 172.906 156.329 174.696 155.774 176.485C155.111 178.629 154.313 180.612 153.423 182.429C152.469 184.356 151.356 186.204 150.092 187.953C149.934 188.169 149.774 188.379 149.613 188.587C147.667 190.792 145.946 191.975 144.669 191.977Z" fill="#FF6600" class="theme-color"/>
                                <path d="M157.557 173.138C157.084 178.109 154.229 181.106 153.865 179.204C153.726 177.891 154.068 176.573 154.826 175.492C154.826 175.492 152.386 176.522 151.98 174.992C151.574 173.463 153.928 171.785 153.928 171.785C153.928 171.785 151.484 170.03 151.473 169.026C151.461 168.021 154.217 168.694 154.217 168.694C154.217 168.694 150.464 165.959 152.028 164.587C153.591 163.215 158.094 167.487 157.557 173.138Z" fill="#17282F"/>
                                <path d="M243.767 231.728C236.624 235.03 226.505 253.692 232.804 253.371C239.103 253.051 247.422 241.816 245.17 233.413L243.767 231.728Z" fill="#111111"/>
                                <path d="M244.189 231.918C244.332 231.94 244.431 232.074 244.409 232.218C243.192 241.208 233.907 250.851 233.809 250.947L233.441 250.945L233.443 250.577C233.54 250.48 242.699 240.961 243.902 232.152C243.916 232.021 244.028 231.922 244.161 231.925L244.189 231.918Z" fill="#FF6600" class="theme-color"/>
                                <path d="M263.056 258.43C271.364 259.392 275.256 265.944 269.633 268.593C266.856 269.886 264.032 268.297 262.061 266.71C260.514 265.464 259.493 264.218 259.432 264.363C259.295 264.694 261.967 276.349 254.541 275.643C247.114 274.938 247.674 268.781 252.973 262.725C252.973 262.725 243.262 267.405 239.617 263.13C235.972 258.854 239.52 250.403 252.729 255.481C252.729 255.481 243.291 248.691 248.011 243.58C252.73 238.467 259.004 244.154 259.21 254.269C259.21 254.269 263.229 242.613 270.157 247.566C278.033 253.158 263.056 258.43 263.056 258.43Z" fill="#406FBF"/>
                                <path d="M255.165 275.676C254.964 275.676 254.755 275.665 254.537 275.644C250.679 275.279 248.976 273.441 248.974 270.909C248.971 268.569 250.424 265.635 252.97 262.726C252.97 262.726 248.394 264.932 244.345 264.932C242.496 264.932 240.757 264.472 239.613 263.131C238.729 262.095 238.269 260.812 238.266 259.537C238.26 256.704 240.512 253.907 245.409 253.907C247.401 253.907 249.831 254.37 252.725 255.483C252.725 255.483 246.687 251.139 246.685 246.785C246.685 245.695 247.062 244.604 248.007 243.581C249.215 242.272 250.526 241.671 251.81 241.671C255.541 241.671 259.053 246.744 259.206 254.27C259.206 254.27 261.941 246.341 266.785 246.341C267.814 246.341 268.938 246.699 270.153 247.568C271.792 248.731 272.441 249.88 272.442 250.971C272.446 255.125 263.052 258.432 263.052 258.432C268.675 259.083 272.275 262.294 272.272 265.123C272.269 266.474 271.446 267.739 269.629 268.595C268.914 268.928 268.195 269.069 267.49 269.069C265.454 269.069 263.52 267.89 262.058 266.711C260.594 265.532 259.601 264.353 259.447 264.353C259.438 264.353 259.432 264.356 259.429 264.365C259.425 264.374 259.423 264.39 259.423 264.415C259.424 264.765 259.788 266.685 259.786 268.841C259.786 272.002 259.006 275.676 255.165 275.676ZM256.113 262.362C256.183 262.362 252.551 270.959 254.694 271.198C254.726 271.201 254.757 271.202 254.788 271.202C256.871 271.202 257.501 263.27 257.501 263.27C257.501 263.27 257.638 266.603 258.692 266.603C258.731 266.603 258.772 266.598 258.815 266.588C259.982 266.315 258.311 262.552 258.232 262.131C258.227 262.103 258.234 262.09 258.253 262.09C258.381 262.09 259.04 262.7 259.786 263.309C260.533 263.918 261.367 264.528 261.843 264.528C261.891 264.528 261.935 264.522 261.975 264.509C262.872 264.22 259.722 261.682 259.722 261.682C259.722 261.682 265.083 265.47 267.487 265.469C268.047 265.469 268.448 265.262 268.581 264.754C269.281 262.062 261.093 260.343 261.093 260.343C261.093 260.343 261.686 260.4 262.349 260.4C263.268 260.4 264.322 260.289 264.12 259.761C263.775 258.851 260.527 258.583 260.527 258.583C260.527 258.583 264.691 257.446 264.534 256.515C264.482 256.206 264.134 256.102 263.693 256.102C262.802 256.102 261.528 256.523 261.528 256.523C261.528 256.523 270.369 251.595 268.308 250.26C268.101 250.126 267.854 250.066 267.576 250.066C265.102 250.066 260.258 254.879 260.258 254.879C260.258 254.879 262.882 252.238 261.756 251.784C261.709 251.765 261.66 251.756 261.61 251.756C260.461 251.756 258.558 256.564 258.558 256.564C258.558 256.564 258.349 252.543 257.593 252.543C257.591 252.543 257.59 252.543 257.589 252.543C256.828 252.559 257.445 256.454 257.445 256.454C257.445 256.454 255.128 247.032 252.437 247.032C252.242 247.032 252.044 247.082 251.845 247.188C249.568 248.412 253.486 253.408 255.354 255.586C254.8 255.041 254.091 254.481 253.507 254.481C253.459 254.481 253.41 254.485 253.363 254.493C252.223 254.691 255.547 257.839 255.547 257.839C255.547 257.839 253.781 256.562 252.514 256.562C252.341 256.562 252.178 256.586 252.029 256.64C250.791 257.091 254.754 259.001 254.754 259.001C254.754 259.001 250.764 258.503 247.593 258.503C245.44 258.503 243.663 258.733 243.775 259.506C243.927 260.571 247.206 260.806 250.074 260.806C252.348 260.806 254.363 260.66 254.363 260.66C254.363 260.66 251.122 261.372 251.218 262.068C251.241 262.237 251.495 262.3 251.868 262.3C253.034 262.3 255.356 261.675 255.356 261.675C255.356 261.675 252.914 263.809 253.533 264.042C253.571 264.056 253.613 264.063 253.658 264.063C254.368 264.063 255.997 262.472 256.111 262.364C256.112 262.362 256.112 262.362 256.113 262.362Z" fill="#FF6600" class="theme-color"/>
                                <path d="M254.788 271.201C254.757 271.201 254.726 271.2 254.694 271.197C252.551 270.958 256.183 262.361 256.113 262.361C256.112 262.361 256.112 262.361 256.111 262.363C255.997 262.471 254.368 264.062 253.658 264.062C253.613 264.062 253.571 264.055 253.533 264.041C252.914 263.808 255.356 261.674 255.356 261.674C255.356 261.674 253.034 262.298 251.868 262.298C251.495 262.298 251.241 262.236 251.218 262.067C251.122 261.371 254.363 260.659 254.363 260.659C254.363 260.659 252.348 260.805 250.074 260.805C247.206 260.805 243.927 260.57 243.775 259.504C243.663 258.732 245.44 258.502 247.593 258.502C250.764 258.502 254.754 259 254.754 259C254.754 259 250.791 257.09 252.029 256.639C252.178 256.585 252.341 256.561 252.514 256.561C253.781 256.561 255.547 257.838 255.547 257.838C255.547 257.838 252.223 254.69 253.363 254.492C253.41 254.484 253.459 254.48 253.507 254.48C254.091 254.48 254.8 255.04 255.354 255.585C253.486 253.407 249.568 248.411 251.845 247.187C252.044 247.081 252.242 247.031 252.437 247.031C255.128 247.031 257.445 256.453 257.445 256.453C257.445 256.453 256.828 252.558 257.589 252.542C257.59 252.542 257.591 252.542 257.593 252.542C258.349 252.542 258.558 256.562 258.558 256.562C258.558 256.562 260.461 251.755 261.61 251.755C261.66 251.755 261.709 251.764 261.756 251.783C262.882 252.237 260.258 254.878 260.258 254.878C260.258 254.878 265.102 250.065 267.576 250.065C267.854 250.065 268.101 250.125 268.308 250.259C270.369 251.594 261.528 256.522 261.528 256.522C261.528 256.522 262.802 256.101 263.693 256.101C264.134 256.101 264.482 256.205 264.534 256.514C264.691 257.445 260.527 258.582 260.527 258.582C260.527 258.582 263.775 258.85 264.12 259.759C264.322 260.288 263.268 260.399 262.349 260.399C261.686 260.399 261.093 260.342 261.093 260.342C261.093 260.342 269.281 262.061 268.581 264.752C268.448 265.261 268.047 265.468 267.487 265.468C265.083 265.469 259.722 261.681 259.722 261.681C259.722 261.681 262.872 264.219 261.975 264.508C261.935 264.521 261.891 264.526 261.843 264.526C261.367 264.526 260.533 263.917 259.786 263.308C259.04 262.699 258.381 262.089 258.253 262.089C258.234 262.089 258.227 262.102 258.232 262.13C258.311 262.551 259.982 266.314 258.815 266.587C258.772 266.597 258.731 266.602 258.692 266.602C257.638 266.602 257.501 263.269 257.501 263.269C257.501 263.269 256.871 271.201 254.788 271.201Z" fill="white"/>
                                <path d="M260.317 260.774C259.716 261.691 259.117 261.686 257.949 262.038C256.781 262.39 256.149 261.995 255.693 261.356C255.239 260.716 255.241 259.776 255.19 259.038C255.138 258.3 255.905 256.698 256.521 256.896C257.139 257.093 257.931 256.792 258.712 256.898C259.493 257.003 260.559 257.936 260.509 258.57C260.46 259.205 260.913 259.856 260.317 260.774Z" fill="#17282F"/>
                                <path d="M390.676 16.2284C404.103 7.29185 422.231 10.9338 431.166 24.3601C440.102 37.7875 436.461 55.9156 423.035 64.851C412.668 71.7493 399.517 71.1239 389.939 64.3152L381.387 66.2614L382.831 57.1083C382.739 56.9743 382.634 56.8543 382.543 56.7181C373.607 43.2918 377.249 25.1625 390.676 16.2284Z" fill="#FF6600" class="theme-color"/>
                                <path d="M431.034 17.4587C425.622 11.0495 417.281 7.2865 408.914 7.28417C407.706 7.28417 406.498 7.36337 405.3 7.5241C405.14 7.54506 405.028 7.69179 405.049 7.85018C405.07 8.00974 405.217 8.12159 405.377 8.10063C406.55 7.9434 407.732 7.8665 408.914 7.8665C417.107 7.86534 425.297 11.5631 430.589 17.8349C430.693 17.9572 430.877 17.9723 430.999 17.8687C431.123 17.765 431.138 17.581 431.034 17.4587Z" fill="#406FBF"/>
                                <path d="M401.02 8.25138C399.534 8.33873 398.068 8.73707 396.741 9.41258C396.598 9.48596 396.541 9.66064 396.614 9.80389C396.687 9.94715 396.862 10.0043 397.005 9.93088C398.26 9.29264 399.649 8.91527 401.054 8.83258C401.215 8.82326 401.337 8.68581 401.327 8.52509C401.318 8.36436 401.181 8.24206 401.02 8.25138Z" fill="#406FBF"/>
                                <path d="M392.941 31.3882C395.134 29.3943 397.654 29.2289 400.162 29.8229C402.116 30.2853 403.36 31.5105 404.853 33.0141C405.545 33.7117 406.277 34.8624 406.869 36.1191C407.308 34.8007 407.897 33.5708 408.501 32.7963C409.803 31.125 410.892 29.76 412.779 29.0682C415.197 28.1807 417.719 28.0433 420.134 29.7623C422.403 31.3766 422.949 34.5724 422.469 37.3152C421.99 40.0592 420.373 42.9137 418.75 45.0206C415.347 49.4382 412.297 52.8088 408.02 55.3652C402.363 52.5595 400.04 50.3537 396.135 46.3728C394.271 44.4744 392.326 41.8329 391.523 39.1658C390.72 36.4999 390.882 33.2622 392.941 31.3882Z" fill="white"/>
                                <path d="M395.804 133.245C399.88 130.432 402.441 125.544 402.433 120.592C402.426 115.638 399.85 110.758 395.764 107.959C386.546 101.641 372.372 106.323 364.023 98.8939C361.24 96.4167 359.59 92.9401 358.059 89.5428C355.997 84.961 353.99 80.2173 353.729 75.1999C353.704 74.7084 353.703 74.2157 353.702 73.7219C357.98 76.3622 362.884 77.6969 367.445 76.0629C368.596 75.6518 369.87 74.9856 370.08 73.7825C365.66 74.7783 360.778 73.3958 357.536 70.2302C360.052 70.971 362.875 70.3036 364.97 68.729C367.067 67.1544 368.46 64.7505 369.075 62.2022C369.423 60.7545 369.528 59.1962 368.997 57.8055C368.111 55.4879 365.6 54.1124 363.132 53.8562C360.663 53.5999 359.051 53.7548 356.66 54.4152C355.421 54.7576 353.311 55.6136 352.231 56.3124C350.894 57.1755 349.948 58.5113 349.343 59.9975C347.61 58.2132 345.492 56.755 343.241 55.7196C341.99 55.1454 340.703 54.6807 339.388 54.3022C333.033 52.469 326.237 52.8953 320.013 55.1361L315.916 56.6118C307.018 62.3175 304.401 64.5012 301.97 81.8315C301.075 88.2081 296.363 94.5683 296.318 101.007C296.279 106.528 296.247 112.108 297.451 117.498C298.329 121.428 299.851 125.185 301.518 128.852C304.777 136.015 308.782 143.109 314.959 147.986C316.836 149.467 319.072 150.772 321.456 150.602C324.583 150.379 326.96 147.73 328.622 145.071C330.56 141.968 332.063 138.386 331.697 134.746C336.561 142.692 343.565 149.316 351.772 153.727C355.446 155.701 359.471 157.261 363.641 157.258C367.509 157.253 371.249 155.906 374.765 154.294C378.178 152.728 381.973 149.991 381.528 146.263C386.263 147.377 391.531 145.858 394.945 142.393C397.389 139.915 398.605 135.311 395.804 133.245Z" fill="#17282F"/>
                                <path d="M306.504 479.27L293.47 479.785L284.688 449.753L304.192 449.003L306.504 479.27Z" fill="#F89EAB"/>
                                <path d="M293.041 479.02L307.18 475.058C307.683 474.902 308.222 475.149 308.432 475.632L313.174 486.369C313.589 487.456 313.044 488.673 311.957 489.088L311.701 489.168C306.752 490.464 304.337 490.846 298.078 492.585C294.249 493.66 283.07 498.697 277.59 499.138C272.112 499.58 271.405 494.175 273.643 493.512C280.853 491.383 287.046 486.716 291.082 480.375C291.551 479.703 292.247 479.222 293.041 479.02Z" fill="#17282F"/>
                                <path d="M285.988 480.568C285.79 480.606 285.607 480.698 285.457 480.832C285.353 480.924 285.314 481.068 285.355 481.2C285.405 481.571 285.629 481.893 285.958 482.069C286.915 482.541 289.022 482.069 291.688 480.832C289.807 480.417 287.869 480.328 285.958 480.568H285.988ZM288.934 482.541C287.884 482.939 286.73 482.964 285.663 482.614C285.152 482.365 284.793 481.881 284.706 481.318C284.641 480.974 284.751 480.621 285.001 480.375C286.297 479.11 292.041 480.258 292.689 480.375C292.815 480.395 292.913 480.499 292.925 480.626C292.952 480.759 292.884 480.891 292.763 480.949C291.538 481.597 290.257 482.13 288.934 482.541Z" fill="#406FBF"/>
                                <path d="M288.343 476.738H288.166C287.636 476.945 287.651 477.18 287.665 477.253C287.769 478.137 290.376 479.713 292.173 480.198C291.65 478.804 290.709 477.606 289.478 476.767C289.115 476.619 288.712 476.609 288.343 476.738ZM292.762 480.994H292.644C290.95 480.73 287.209 478.859 287.047 477.357C287.047 477.003 287.135 476.517 287.931 476.207C288.504 475.957 289.155 475.957 289.728 476.207C291.687 477.091 292.924 480.391 292.968 480.537V480.832L292.762 480.994Z" fill="#406FBF"/>
                                <path d="M425.298 379.786L416.799 389.713L386.887 375.292L399.552 363.305L425.298 379.786Z" fill="#F89EAB"/>
                                <path d="M413.659 389.154L421.451 376.693C421.719 376.242 422.282 376.065 422.761 376.281L433.498 381.023C434.537 381.548 434.954 382.814 434.431 383.852L434.367 383.97C431.568 388.27 429.948 390.2 426.59 395.678C424.485 399.051 421.068 405.988 418.151 410.598C415.235 415.208 410.492 412.616 411.288 410.422C414.852 400.568 413.821 395.84 413.187 391.377C413.085 390.604 413.252 389.819 413.659 389.154Z" fill="#17282F"/>
                                <path d="M413.895 391.436C412.201 392.275 410.051 393.645 409.932 394.514C409.916 394.684 409.996 394.848 410.14 394.941C410.424 395.226 410.836 395.343 411.229 395.25C412.024 395.073 413.026 393.659 413.821 391.495L413.895 391.436ZM411.554 395.854H411.406C410.812 395.996 410.186 395.831 409.741 395.412C409.428 395.188 409.269 394.806 409.329 394.425C409.55 392.776 413.821 390.758 414.307 390.538H414.646C414.74 390.616 414.775 390.745 414.734 390.862C414.116 392.57 413.026 395.28 411.554 395.854Z" fill="#406FBF"/>
                                <path d="M409.464 389.712C409.209 389.806 409.003 389.997 408.89 390.244C408.728 390.612 408.89 390.773 408.89 390.876C409.552 391.496 412.144 391.363 413.646 390.876C412.542 390.273 410.598 389.404 409.508 389.712H409.464ZM414.074 391.348C412.6 391.922 409.493 392.246 408.507 391.348C408.144 390.996 408.071 390.442 408.329 390.007C408.525 389.569 408.911 389.243 409.375 389.124C411.202 388.579 414.397 390.596 414.53 390.596C414.627 390.656 414.684 390.763 414.678 390.876C414.675 390.988 414.613 391.089 414.515 391.142L414.074 391.348Z" fill="#406FBF"/>
                                <path d="M249.136 158.809L248.905 158.541C249.172 158.703 249.238 158.809 249.136 158.809ZM284.139 133.562L283.469 134.289L282.556 135.182C281.923 135.796 281.29 136.43 280.601 137.043C279.261 138.385 277.827 139.595 276.356 140.768C273.377 143.151 270.249 145.347 267.047 147.489C263.844 149.63 260.475 151.585 257.067 153.447L251.854 156.128L249.191 157.394L248.348 157.809C247.986 157.261 247.693 156.668 247.497 156.034C246.272 152.622 245.41 149.09 244.928 145.497C243.834 137.556 243.15 129.564 242.88 121.553L234.539 120.865C232.969 129.337 232.239 137.942 232.361 146.558C232.416 151.234 233.041 155.885 234.222 160.41C234.982 163.399 236.38 166.187 238.318 168.584C241.372 172.308 246.255 174.005 250.961 172.978C251.892 172.781 252.807 172.513 253.698 172.177L255.224 171.6L258.277 170.427C260.307 169.682 262.299 168.714 264.31 167.82C268.308 165.977 272.205 163.919 275.983 161.657C279.819 159.365 283.507 156.835 287.025 154.08C288.775 152.665 290.506 151.213 292.2 149.63C293.038 148.867 293.876 148.029 294.714 147.191C295.124 146.744 295.532 146.335 295.961 145.851C296.39 145.366 296.725 144.993 297.339 144.249L284.139 133.562Z" fill="#F89EAB"/>
                                <path d="M296.967 122.367C291.562 121.041 277.82 138.833 277.82 138.833L286.171 154.725C286.171 154.725 309.25 141.69 308.381 134.518C307.468 127.035 304.846 124.295 296.967 122.367Z" fill="#406FBF"/>
                                <path d="M241.634 127.1L245.573 111.814L228.855 113.586C228.855 113.586 230.146 124.103 235.137 128.758L241.634 127.1Z" fill="#F89EAB"/>
                                <path d="M290.15 127.801C288.883 135.165 287.675 153.87 293.095 197.348L346.117 200.617C346.529 180.293 347.59 163.915 358.592 124.634C359.607 121.05 357.526 117.321 353.941 116.306C353.479 116.174 353.003 116.092 352.524 116.062C348.488 115.827 343.407 115.665 338.223 115.885C330.056 116.065 321.913 116.802 313.847 118.095C306.969 119.333 299.443 121.247 295.068 122.411C292.513 123.085 290.588 125.194 290.15 127.801Z" fill="#FF6600" class="theme-color"/>
                                <path d="M293.096 197.348C293.096 197.348 271.102 295.225 269.496 335.065C267.832 376.509 284.418 472.781 284.418 472.781L312.226 467.312C312.226 467.312 303.199 382.792 307.279 342.245C311.698 298.06 331.919 199.734 331.919 199.734L293.096 197.348Z" fill="#111111"/>
                                <mask id="mask1_599_3533" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="314" y="289" width="1" height="3">
                                <path d="M314.605 291.656C314.732 290.911 314.859 290.165 314.986 289.418C314.987 289.421 314.986 289.414 314.986 289.419C314.859 290.165 314.732 290.912 314.605 291.656Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1_599_3533)">
                                <path d="M314.605 291.656H314.988V289.414H314.605V291.656Z" fill="#C3C5C2"/>
                                </g>
                                <path d="M310.738 315.615C307.797 300.471 302.081 263.978 308.949 237.628H309.968C311.282 253.768 312.993 272.58 314.982 289.417C314.855 290.165 314.728 290.91 314.601 291.656C313.203 299.899 311.888 308.001 310.738 315.615Z" fill="#111D23"/>
                                <path d="M307.102 198.201C307.102 198.201 314.466 317.853 323.597 334.407C338.134 360.653 393.913 389.029 393.913 389.029L411.348 368.622C411.348 368.622 372.79 336.557 352.435 318.339C347.59 285.244 364.719 233.018 346.205 200.616L307.102 198.201Z" fill="#111111"/>
                                <path d="M316.72 55.844C308.574 59.4649 305.239 66.206 304.424 71.3818C304.098 78.5131 307.516 84.1315 308.164 91.2383L331.524 53.5449C327.146 53.6253 325.4 52.3896 316.72 55.844Z" fill="#17282F"/>
                                <path d="M326.425 53.9109C334.104 51.8483 340.36 57.0951 343.927 60.5996C347.687 65.2583 349.315 71.3344 348.402 77.2987C347.424 82.8495 346.237 89.5801 342.431 91.8675C340.288 93.2045 337.694 93.5598 335.282 92.847L312.852 62.5679C316.581 58.5509 321.253 55.5706 326.425 53.9109Z" fill="#17282F"/>
                                <path d="M313.847 118.093C315.864 117.053 320.567 112.223 320.737 109.237L320.729 99.1182C320.751 99.0064 320.77 98.9075 320.789 98.8085L327.841 96.7516L327.847 96.7482C329.772 95.4041 332.401 95.9084 333.717 97.8732C334.217 98.5802 334.726 98.4369 334.737 99.3081C334.742 99.4991 334.388 100.653 334.367 100.843C333.278 107.37 333.519 112.351 336.508 115.93L318.975 128.521C312.244 121.478 312.624 118.808 313.847 118.093Z" fill="#F89EAB"/>
                                <path d="M320.73 109.312C320.734 109.106 320.698 108.908 320.709 108.691V108.658C320.721 108.539 320.729 108.368 320.735 108.19L320.736 109.238C320.734 109.262 320.733 109.288 320.73 109.312Z" fill="#111D23"/>
                                <path d="M320.711 109.535C320.725 109.459 320.731 109.386 320.732 109.313C320.734 109.288 320.735 109.263 320.738 109.238L320.737 108.19C320.744 107.945 320.745 107.687 320.735 107.525C320.74 107.192 320.742 106.851 320.745 106.501C321.201 106.541 321.662 106.562 322.126 106.562C324.72 106.562 327.412 105.936 330.006 104.609C327.291 106.858 324.233 108.558 320.711 109.535Z" fill="#DA8186"/>
                                <path d="M344.09 78.1827C341.544 90.9661 340.747 96.4168 333.545 102.289C322.704 111.104 308.133 105.543 306.886 92.3101C305.855 80.4119 310.121 61.5303 323.014 57.8185C335.907 54.1055 346.628 65.3807 344.09 78.1827Z" fill="#F89EAB"/>
                                <path d="M347.716 90.1996C345.955 92.7362 343.341 94.1851 341.033 94.5461C337.562 95.0888 336.323 89.354 337.8 85.9963C339.13 82.974 342.652 81.2269 345.89 82.2251C349.08 83.208 349.728 87.2984 347.716 90.1996Z" fill="#F89EAB"/>
                                <path d="M340.617 89.1055C340.601 89.1055 340.585 89.1043 340.57 89.102C340.412 89.0763 340.303 88.9273 340.328 88.7689C340.536 87.461 341.263 86.2555 342.316 85.4764C343.164 84.8498 344.205 84.5144 345.248 84.5144C345.502 84.5144 345.757 84.5342 346.009 84.5749C346.168 84.6005 346.276 84.7508 346.25 84.9092C346.227 85.0524 346.103 85.1538 345.964 85.1538C345.947 85.1538 345.932 85.1526 345.916 85.1503C345.696 85.1142 345.472 85.0967 345.248 85.0967C345.247 85.0967 345.247 85.0967 345.246 85.0967C344.328 85.0967 343.405 85.3948 342.663 85.9446C341.737 86.6271 341.085 87.7055 340.903 88.8597C340.881 89.003 340.756 89.1055 340.617 89.1055Z" fill="#DA8186"/>
                                <path d="M327.701 80.8296C327.511 82.2074 326.672 83.2731 325.828 83.2102C324.983 83.1474 324.453 81.9792 324.644 80.6014C324.834 79.2236 325.673 78.1579 326.517 78.2208C327.362 78.2837 327.892 79.4518 327.701 80.8296Z" fill="#17282F"/>
                                <path d="M315.234 79.6545C315.047 80.9892 314.213 82.0211 313.371 81.9582C312.53 81.8953 311.999 80.7621 312.186 79.4274C312.374 78.0926 313.208 77.0608 314.05 77.1237C314.89 77.1866 315.422 78.3198 315.234 79.6545Z" fill="#17282F"/>
                                <path d="M329.85 76.1367C329.685 76.139 329.524 76.0749 329.409 75.9433C327.606 73.8877 325.323 74.3302 325.297 74.3349C324.959 74.4013 324.643 74.18 324.599 73.8294C324.556 73.4789 324.799 73.14 325.141 73.0677C325.261 73.0444 328.126 72.4866 330.363 75.0384C330.585 75.2923 330.552 75.7011 330.289 75.9515C330.162 76.0714 330.005 76.1332 329.85 76.1367Z" fill="#17282F"/>
                                <path d="M310.454 72.476C310.329 72.419 310.23 72.3106 310.187 72.1616C310.098 71.8541 310.275 71.4919 310.582 71.3521C313.666 69.9534 315.718 71.4383 315.806 71.5047C316.048 71.6852 316.076 72.0626 315.867 72.3468C315.659 72.6321 315.293 72.716 315.05 72.5366C314.97 72.4772 313.359 71.3521 310.907 72.4656C310.749 72.5378 310.586 72.5354 310.454 72.476Z" fill="#17282F"/>
                                <path d="M317.595 79.1385C317.595 79.1385 315.139 83.8426 312.597 86.6774C312.153 87.1724 312.327 87.9749 312.92 88.2649C314.446 89.0114 316.348 88.6516 316.348 88.6516L317.595 79.1385Z" fill="#F3606F"/>
                                <path d="M327.14 78.3978L324.266 77.4067C324.266 77.4067 325.668 79.7989 327.14 78.3978Z" fill="#17282F"/>
                                <path d="M314.364 77.1864L311.488 76.1952C311.488 76.1952 312.891 78.5886 314.364 77.1864Z" fill="#17282F"/>
                                <path d="M316.547 92.3266C317.38 93.7126 318.356 96.3809 318.356 96.3809C318.608 96.3343 318.86 96.2865 319.11 96.2271C322.522 95.5073 323.871 94.0224 324.333 92.5945C324.582 91.813 324.557 91.0397 324.457 90.4271C324.349 89.7166 324.114 89.2356 324.114 89.2356C322.529 90.7206 319.398 91.6418 317.707 92.0623C317 92.2463 316.547 92.3266 316.547 92.3266Z" fill="#17282F"/>
                                <path d="M317.707 92.0632L318.27 93.2441C321.482 92.5582 323.653 91.6346 324.457 90.428C324.349 89.7175 324.114 89.2365 324.114 89.2365C322.529 90.7215 319.398 91.6427 317.707 92.0632Z" fill="white"/>
                                <path d="M319.109 96.2266C322.521 95.5068 323.871 94.0219 324.332 92.594C323.179 92.8851 321.82 93.3673 320.699 94.1604C319.84 94.7626 319.375 95.5115 319.109 96.2266Z" fill="#F04056"/>
                                <path d="M339.18 80.5106C339.18 80.5106 333.473 70.8125 334.514 63.6043C334.514 63.6043 309.839 53.0606 308.216 76.142C308.216 76.142 306.114 55.5378 327.677 56.1993C349.238 56.8609 348.636 85.6527 337.397 93.6621C337.378 93.5538 342.7 86.5762 339.18 80.5106Z" fill="#17282F"/>
                                <path d="M317.634 57.2494C314.392 59.4494 311.922 62.6453 310.58 66.3746C310.088 69.1674 313.457 71.8706 313.457 71.8706L319.079 66.6168L318.136 71.9661C325.733 72.5007 330.751 69.2548 334.328 63.895L331.51 55.5606C331.51 55.5606 320.492 55.5163 317.634 57.2494Z" fill="#17282F"/>
                                <path d="M164.746 237.627H325.501V111.348H164.746V237.627Z" fill="#406FBF"/>
                                <path d="M320.706 237.627H164.746V111.348H325.501H320.706V237.627Z" fill="#CFE0F5"/>
                                <path d="M320.707 237.627H325.502V111.348H320.707V237.627Z" fill="#9CBEE7"/>
                                <path d="M229.553 107.303C231.218 106.281 232.468 108.136 232.468 108.136C234.475 106.168 236.102 107.748 236.102 107.748C237.048 106.528 239.017 107.748 239.017 107.748C240.948 106.489 242.046 108.098 242.046 108.098C242.046 108.098 242.046 108.098 241.895 106.659C241.743 105.221 242.945 103.766 243.56 104.01C243.912 104.149 244.809 106.319 245.113 108.476C245.415 110.635 244.799 111.239 244.799 111.239L242.576 111.241C242.576 111.241 242.689 115.783 240.872 116.162C239.783 116.389 239.407 115.719 239.275 115.146C239.29 115.951 239.092 117.174 237.767 117.449C236.147 117.785 235.934 114.467 235.913 113.759V113.777C235.913 114.875 234.777 116.125 233.413 115.783C232.051 115.443 232.922 111.051 232.922 111.051C232.922 111.051 232.581 112.452 231.142 112.641C229.704 112.831 229.929 111.345 229.929 111.345C229.929 111.345 228.234 111.205 228.121 111.205C228.007 111.205 227.887 108.326 229.553 107.303Z" fill="#F89EAB"/>
                                <path d="M191.403 175.254C189.595 175.245 188.337 174.866 187.633 174.117C186.927 173.369 186.579 172.41 186.584 171.239C186.59 170.212 186.801 168.981 187.216 167.547C187.631 166.112 188.055 164.742 188.487 163.431C189.279 161.202 190.134 158.886 191.052 156.478C191.969 154.073 192.903 151.684 193.855 149.313C194.807 146.944 195.75 144.663 196.684 142.467C197.618 140.275 198.498 138.276 199.322 136.472C196.91 136.495 194.845 136.546 193.125 136.625C191.405 136.705 189.844 136.812 188.444 136.946C187.042 137.08 185.561 137.285 184 137.561C184.148 136.178 184.819 135.11 186.011 134.353C187.203 133.598 188.81 133.074 190.833 132.783C192.855 132.493 195.142 132.354 197.695 132.368C199.468 132.378 201.081 132.44 202.535 132.554C203.987 132.668 205.379 132.791 206.708 132.922C208.036 133.053 209.34 133.158 210.615 133.235C211.676 133.773 212.375 134.114 212.71 134.258C213.047 134.401 213.107 134.472 212.895 134.471C212.076 135.104 211.055 135.57 209.83 135.864C208.605 136.158 207.335 136.339 206.025 136.402C204.712 136.467 203.453 136.494 202.248 136.488C200.739 140.203 199.255 144.273 197.796 148.697C196.335 153.122 194.936 157.706 193.599 162.448C193.129 164.22 192.721 165.75 192.377 167.042C192.033 168.336 191.771 169.513 191.588 170.575C191.404 171.638 191.311 172.718 191.304 173.818C191.304 173.995 191.311 174.199 191.328 174.431C191.343 174.66 191.369 174.935 191.403 175.254Z" fill="#FF6600" class="theme-color"/>
                                <path d="M212.53 153.562C213.455 152.752 214.364 151.773 215.258 150.625C216.15 149.478 216.981 148.268 217.75 146.996C218.52 145.723 219.191 144.486 219.765 143.284C220.338 142.081 220.796 141.003 221.138 140.046C221.481 139.091 221.67 138.347 221.709 137.816L221.683 137.656L221.604 137.603C221.391 137.602 220.927 138.051 220.213 138.952C219.498 139.852 218.669 141.062 217.721 142.582C216.773 144.101 215.833 145.815 214.901 147.725C213.968 149.635 213.179 151.581 212.53 153.562ZM207.747 172.736C207.003 172.733 206.455 172.135 206.108 170.946C205.76 169.757 205.59 168.4 205.598 166.875C205.607 165.209 205.901 163.224 206.481 160.923C207.06 158.622 207.818 156.189 208.754 153.623C209.689 151.056 210.74 148.545 211.906 146.086C213.069 143.629 214.27 141.402 215.505 139.406C216.738 137.408 217.907 135.81 219.013 134.61C220.119 133.411 221.079 132.813 221.895 132.817C222.603 132.821 223.134 133.223 223.484 134.023C223.834 134.822 224.008 135.63 224.003 136.445C223.997 137.439 223.769 138.634 223.318 140.031C222.868 141.43 222.248 142.924 221.46 144.516C220.671 146.107 219.75 147.68 218.696 149.234C217.642 150.789 216.507 152.201 215.296 153.471C214.084 154.741 212.82 155.762 211.504 156.536C211.073 157.669 210.711 158.792 210.422 159.907C210.132 161.022 209.922 162.094 209.793 163.121C209.663 164.149 209.596 165.124 209.592 166.045C209.59 166.293 209.596 166.532 209.614 166.764C209.63 166.994 209.656 167.198 209.691 167.375C209.941 166.738 210.274 165.899 210.688 164.855C211.101 163.811 211.604 162.705 212.195 161.538C212.786 160.371 213.483 159.259 214.286 158.199C215.09 157.14 216.007 156.285 217.04 155.634C218.07 154.984 219.206 154.662 220.447 154.669C221.582 154.675 222.476 154.937 223.13 155.454C223.783 155.973 224.241 156.622 224.503 157.403C224.764 158.185 224.893 158.984 224.888 159.798C224.883 160.897 224.69 161.95 224.313 162.96C223.934 163.968 223.558 164.924 223.181 165.825C222.804 166.728 222.613 167.586 222.608 168.401C222.604 169.04 222.744 169.502 223.026 169.786C223.308 170.073 223.663 170.216 224.088 170.218C224.867 170.222 225.783 169.837 226.833 169.063C227.883 168.288 228.917 167.257 229.934 165.968C230.952 164.68 231.837 163.257 232.59 161.701L233.383 162.502C232.594 164.273 231.646 165.88 230.539 167.328C229.432 168.775 228.229 169.929 226.93 170.791C225.631 171.653 224.255 172.081 222.801 172.072C221.489 172.065 220.499 171.715 219.829 171.02C219.158 170.324 218.826 169.464 218.832 168.434C218.837 167.69 218.973 166.866 219.244 165.964C219.515 165.061 219.777 164.141 220.031 163.202C220.283 162.265 220.413 161.405 220.416 160.625C220.421 159.775 220.238 159.171 219.867 158.815C219.497 158.457 219.046 158.278 218.514 158.276C217.627 158.271 216.828 158.622 216.115 159.325C215.402 160.032 214.75 160.932 214.159 162.027C213.569 163.124 213.022 164.282 212.52 165.503C212.015 166.723 211.523 167.891 211.038 169.005C210.554 170.119 210.043 171.021 209.508 171.709C208.972 172.397 208.385 172.74 207.747 172.736Z" fill="#FF6600" class="theme-color"/>
                                <path d="M234.068 173.355C232.934 173.35 231.951 172.963 231.123 172.197C230.294 171.429 229.883 170.284 229.891 168.76C229.898 167.483 230.19 166.119 230.764 164.669C231.338 163.218 232.127 161.787 233.127 160.374C234.127 158.961 235.269 157.673 236.551 156.51C237.835 155.346 239.196 154.416 240.635 153.713C242.076 153.012 243.503 152.664 244.922 152.672C246.412 152.68 247.66 153.068 248.666 153.836C249.673 154.604 250.172 155.608 250.165 156.849C250.161 157.806 249.856 158.478 249.25 158.865C248.645 159.252 247.9 159.372 247.015 159.226C247.087 158.941 247.151 158.633 247.206 158.295C247.261 157.96 247.29 157.631 247.291 157.312C247.296 156.567 247.14 155.911 246.823 155.341C246.507 154.773 245.887 154.485 244.966 154.481C243.973 154.475 242.961 154.807 241.93 155.475C240.897 156.144 239.9 157.024 238.937 158.118C237.974 159.212 237.116 160.414 236.364 161.72C235.613 163.028 235.021 164.32 234.588 165.593C234.156 166.868 233.937 168.001 233.932 168.994C233.926 170.199 234.365 170.804 235.252 170.808C236.067 170.813 236.964 170.429 237.944 169.654C238.923 168.88 239.922 167.891 240.939 166.691C241.956 165.492 242.928 164.264 243.856 163.011C244.785 161.758 245.588 160.654 246.267 159.7C246.41 159.524 246.535 159.435 246.642 159.436C246.818 159.473 247.102 159.554 247.491 159.68C247.88 159.807 248.234 159.977 248.552 160.191C248.87 160.405 249.027 160.69 249.026 161.044C249.024 161.399 248.862 161.85 248.541 162.397C248.219 162.946 247.86 163.556 247.467 164.227C247.073 164.898 246.716 165.571 246.393 166.242C246.069 166.914 245.906 167.569 245.903 168.206C245.9 168.668 246.031 169.121 246.295 169.564C246.558 170.01 246.99 170.234 247.594 170.238C248.48 170.242 249.698 169.602 251.247 168.316C252.797 167.03 254.377 164.92 255.989 161.985L256.835 162.841C256.008 164.751 254.998 166.43 253.803 167.877C252.606 169.324 251.351 170.462 250.035 171.287C248.718 172.113 247.404 172.524 246.092 172.517C244.674 172.509 243.63 172.067 242.962 171.196C242.292 170.324 241.925 169.373 241.861 168.345C241.861 168.239 241.869 168.124 241.889 167.999C241.907 167.876 241.916 167.76 241.917 167.653C240.453 169.454 239.116 170.856 237.906 171.86C236.695 172.864 235.415 173.362 234.068 173.355Z" fill="#FF6600" class="theme-color"/>
                                <path d="M272.367 172.125C271.054 172.118 270.056 171.775 269.368 171.099C268.68 170.422 268.338 169.57 268.344 168.541C268.349 167.796 268.477 167.025 268.73 166.229C268.981 165.433 269.234 164.619 269.487 163.787C269.739 162.955 269.868 162.148 269.872 161.368C269.877 160.518 269.685 159.932 269.297 159.612C268.908 159.29 268.449 159.128 267.917 159.125C266.853 159.119 265.761 159.557 264.638 160.437C263.517 161.317 262.421 162.419 261.35 163.743C260.279 165.067 259.278 166.454 258.349 167.902C257.418 169.351 256.615 170.641 255.936 171.772C255.298 171.768 254.695 171.659 254.128 171.442C253.563 171.227 253.087 170.852 252.699 170.318C252.735 170.141 252.941 169.601 253.319 168.7C253.696 167.797 254.119 166.701 254.586 165.408C255.054 164.118 255.478 162.781 255.858 161.399C256.237 160.02 256.431 158.744 256.437 157.575C256.686 157.328 257.06 157.065 257.558 156.783C258.056 156.502 258.57 156.362 259.103 156.366C260.237 156.372 260.802 156.889 260.796 157.917C260.794 158.378 260.684 159.112 260.465 160.122C260.247 161.13 259.957 162.238 259.596 163.441C260.525 162.134 261.56 160.872 262.703 159.656C263.843 158.438 265.035 157.443 266.28 156.67C267.525 155.898 268.787 155.513 270.062 155.52C271.516 155.527 272.586 156.038 273.272 157.053C273.958 158.067 274.298 159.195 274.291 160.436C274.285 161.498 274.102 162.5 273.744 163.438C273.384 164.374 273.033 165.26 272.692 166.091C272.351 166.922 272.178 167.746 272.174 168.561C272.17 169.164 272.301 169.599 272.565 169.867C272.829 170.133 273.157 170.268 273.547 170.27C274.398 170.274 275.277 169.863 276.187 169.034C277.096 168.207 277.969 167.166 278.809 165.911C279.648 164.657 280.392 163.392 281.037 162.119L281.831 162.816C281.076 164.549 280.234 166.122 279.306 167.535C278.377 168.949 277.341 170.069 276.202 170.896C275.063 171.723 273.784 172.133 272.367 172.125Z" fill="#FF6600" class="theme-color"/>
                                <path d="M288.708 150.089C289.919 149.067 291.088 147.868 292.212 146.491C293.337 145.114 294.266 143.692 295.001 142.225C295.733 140.758 296.122 139.438 296.166 138.268C296.167 138.162 296.148 138.074 296.113 138.002C295.758 138.072 295.179 138.671 294.374 139.801C293.572 140.933 292.668 142.39 291.665 144.174C290.664 145.96 289.677 147.932 288.708 150.089ZM296.244 173.211C295.18 173.205 294.26 172.856 293.483 172.159C292.708 171.464 292.092 170.583 291.636 169.516C291.181 168.45 290.841 167.368 290.617 166.267C290.392 165.168 290.283 164.209 290.287 163.394C290.746 163.325 291.352 163.187 292.096 162.978C292.843 162.77 293.606 162.481 294.388 162.113C295.17 161.745 295.83 161.268 296.364 160.687C296.898 160.105 297.17 159.407 297.173 158.591C297.178 157.918 296.948 157.376 296.491 156.965C296.03 156.555 295.447 156.348 294.739 156.344C293.709 156.339 292.733 156.68 291.807 157.366C290.881 158.051 290.036 158.952 289.267 160.064C288.497 161.176 287.809 162.378 287.2 163.67C286.59 164.96 286.052 166.198 285.585 167.384C285.118 168.57 284.722 169.586 284.398 170.435C284.074 171.356 283.725 171.974 283.351 172.291C282.977 172.609 282.488 172.766 281.886 172.762C281.531 172.76 281.195 172.625 280.878 172.357C280.56 172.089 280.324 171.636 280.166 170.998C280.01 170.359 279.936 169.507 279.942 168.444C279.952 166.387 280.266 164.093 280.882 161.561C281.498 159.031 282.319 156.437 283.344 153.783C284.369 151.129 285.49 148.583 286.708 146.143C287.927 143.702 289.154 141.511 290.388 139.567C291.621 137.624 292.773 136.079 293.842 134.933C294.912 133.786 295.784 133.214 296.458 133.217C297.025 133.221 297.493 133.578 297.863 134.289C298.231 135 298.411 135.888 298.405 136.951C298.401 138.157 298.126 139.503 297.586 140.988C297.046 142.475 296.284 143.968 295.301 145.471C294.32 146.973 293.16 148.393 291.823 149.733C290.485 151.074 288.998 152.218 287.362 153.167C286.319 155.679 285.518 158.138 284.957 160.546C284.393 162.955 284.055 165.044 283.939 166.817C284.549 165.367 285.265 163.854 286.09 162.28C286.915 160.708 287.836 159.215 288.854 157.801C289.872 156.39 290.969 155.252 292.143 154.389C293.318 153.527 294.561 153.098 295.873 153.106C297.256 153.113 298.449 153.599 299.455 154.561C300.46 155.523 300.959 156.732 300.951 158.185C300.945 159.25 300.648 160.178 300.059 160.972C299.47 161.767 298.756 162.41 297.921 162.902C297.086 163.395 296.251 163.763 295.416 164.006C294.58 164.25 293.88 164.37 293.312 164.366C293.381 164.793 293.501 165.361 293.677 166.071C293.849 166.781 294.102 167.5 294.435 168.23C294.768 168.957 295.181 169.571 295.676 170.071C296.169 170.569 296.753 170.821 297.427 170.824C298.384 170.829 299.324 170.435 300.251 169.642C301.177 168.85 302.088 167.792 302.981 166.466C303.875 165.142 304.68 163.665 305.398 162.038L306.033 162.839C305.455 164.574 304.649 166.245 303.611 167.852C302.575 169.461 301.416 170.757 300.135 171.743C298.852 172.729 297.555 173.219 296.244 173.211Z" fill="#FF6600" class="theme-color"/>
                                <path d="M211.29 220.132C212.079 220.137 213.232 219.268 214.752 217.526C216.27 215.782 217.829 213.032 219.424 209.277C217.888 210.058 216.395 210.913 214.946 211.847C213.497 212.78 212.286 213.768 211.318 214.814C210.35 215.86 209.864 216.996 209.857 218.221C209.854 218.615 209.961 219.032 210.178 219.471C210.395 219.909 210.766 220.13 211.29 220.132ZM211.804 222.434C210.709 222.428 209.714 222.095 208.822 221.432C207.929 220.772 207.485 219.762 207.492 218.405C207.5 217.003 207.9 215.748 208.694 214.636C209.489 213.524 210.522 212.513 211.796 211.6C213.07 210.689 214.464 209.842 215.979 209.062C217.493 208.282 218.996 207.523 220.488 206.789C221.021 205.434 221.599 203.774 222.222 201.807C222.845 199.84 223.403 197.896 223.895 195.973C222.527 197.979 221.062 199.732 219.501 201.234C217.939 202.735 216.216 203.482 214.335 203.472C213.546 203.468 212.726 203.299 211.875 202.967C211.024 202.634 210.314 202.061 209.751 201.248C209.186 200.436 208.907 199.373 208.914 198.059C208.92 196.877 209.134 195.478 209.561 193.861C209.985 192.244 210.518 190.671 211.161 189.141C211.804 187.613 212.467 186.336 213.151 185.312C213.835 184.287 214.441 183.776 214.965 183.778C215.184 183.779 215.533 183.869 216.015 184.046C216.495 184.224 216.965 184.468 217.422 184.776C217.88 185.085 218.151 185.415 218.237 185.765C217.842 186.288 217.399 187.053 216.912 188.056C216.424 189.061 215.959 190.175 215.515 191.397C215.071 192.621 214.703 193.822 214.413 195.002C214.122 196.183 213.975 197.189 213.97 198.021C213.965 198.721 214.105 199.312 214.387 199.795C214.669 200.279 215.204 200.521 215.992 200.526C216.911 200.531 217.887 200.143 218.92 199.36C219.952 198.578 220.974 197.566 221.989 196.324C223.002 195.081 223.907 193.806 224.701 192.497C224.835 192.104 224.947 191.613 225.038 191.021C225.129 190.432 225.264 189.808 225.442 189.152C225.62 188.453 225.985 187.766 226.536 187.09C227.087 186.415 227.865 186.08 228.873 186.085C229.178 186.087 229.474 186.111 229.758 186.155C230.043 186.201 230.382 186.268 230.775 186.358C230.772 187.014 230.535 188.294 230.065 190.194C229.595 192.096 228.982 194.304 228.225 196.817C227.466 199.331 226.599 201.854 225.623 204.386C227.553 203.653 229.508 202.404 231.487 200.643C233.467 198.88 235.076 196.449 236.319 193.347L237.366 194.141C236.696 196.327 235.69 198.214 234.347 199.804C233.003 201.395 231.497 202.744 229.828 203.85C228.158 204.959 226.49 205.879 224.823 206.615C223.625 209.453 222.342 212.083 220.972 214.504C219.602 216.927 218.158 218.856 216.641 220.293C215.123 221.729 213.511 222.442 211.804 222.434Z" fill="#FF6600" class="theme-color"/>
                                <path d="M249.436 196.373C250.538 194.847 251.456 193.2 252.188 191.431C252.92 189.661 253.29 188.033 253.297 186.545C253.303 185.451 253.143 184.651 252.818 184.146C252.492 183.64 252.044 183.386 251.476 183.384C250.6 183.378 249.722 183.977 248.84 185.175C247.957 186.375 247.512 187.892 247.503 189.731C247.497 190.782 247.654 191.955 247.976 193.246C248.297 194.539 248.784 195.581 249.436 196.373ZM239.271 206.299C237.346 206.288 236.015 205.657 235.277 204.406C234.539 203.154 234.174 201.74 234.184 200.164C234.191 198.764 234.418 197.344 234.863 195.901C235.308 194.459 235.905 193.105 236.658 191.839C237.408 190.575 238.246 189.55 239.169 188.767C240.092 187.984 241.036 187.595 241.999 187.6C242.261 187.601 242.578 187.659 242.95 187.77C243.321 187.882 243.593 188.026 243.768 188.2C243.283 188.724 242.765 189.466 242.213 190.425C241.66 191.385 241.152 192.422 240.686 193.535C240.22 194.649 239.842 195.763 239.553 196.878C239.261 197.992 239.114 199.009 239.109 199.928C239.103 200.937 239.273 201.724 239.622 202.296C239.969 202.866 240.536 203.154 241.324 203.159C242.199 203.163 243.241 202.699 244.45 201.763C245.659 200.828 246.815 199.686 247.916 198.334C246.565 197.146 245.577 195.772 244.95 194.214C244.323 192.658 244.016 190.894 244.026 188.924C244.032 187.831 244.279 186.672 244.768 185.449C245.255 184.226 246.005 183.201 247.016 182.375C248.028 181.549 249.343 181.14 250.963 181.148C252.801 181.158 254.079 181.68 254.795 182.712C255.511 183.745 255.866 184.982 255.858 186.427C255.85 188.047 255.413 189.872 254.549 191.903C253.684 193.933 252.657 195.864 251.465 197.696C252.075 198.052 252.753 198.229 253.497 198.232C254.154 198.236 254.943 198.088 255.864 197.785C256.784 197.486 257.674 196.974 258.531 196.257C259.388 195.539 260.083 194.591 260.615 193.413L261.661 194.206C260.73 196.345 259.463 197.904 257.86 198.88C256.257 199.857 254.711 200.341 253.224 200.333C252.654 200.33 252.085 200.272 251.518 200.16C250.949 200.048 250.424 199.88 249.944 199.659C248.445 201.489 246.763 203.056 244.896 204.358C243.028 205.662 241.153 206.309 239.271 206.299Z" fill="#FF6600" class="theme-color"/>
                                <path d="M264.157 206.302C262.667 206.294 261.457 205.607 260.523 204.247C259.589 202.885 259.128 201.307 259.137 199.512C259.144 198.287 259.358 196.844 259.783 195.182C260.208 193.521 260.731 191.894 261.353 190.299C261.974 188.705 262.626 187.383 263.311 186.336C263.995 185.289 264.6 184.768 265.124 184.771C265.431 184.772 265.879 184.928 266.468 185.238C267.058 185.548 267.57 185.923 268.005 186.362C267.52 187.061 266.933 188.152 266.248 189.635C265.561 191.121 264.951 192.705 264.417 194.387C263.883 196.069 263.612 197.61 263.605 199.01C263.603 199.23 263.634 199.679 263.695 200.358C263.757 201.037 263.928 201.661 264.211 202.231C264.492 202.802 264.983 203.088 265.683 203.092C266.428 203.096 267.238 202.696 268.119 201.891C268.998 201.086 269.89 200.029 270.795 198.72C271.698 197.412 272.571 195.995 273.411 194.467C274.251 192.939 275.025 191.477 275.733 190.081C276.44 188.684 277.016 187.505 277.459 186.544C277.809 186.59 278.279 186.69 278.869 186.846C279.459 187.005 279.983 187.215 280.441 187.479C280.9 187.744 281.127 188.117 281.125 188.599C281.125 188.73 280.913 189.277 280.492 190.238C280.071 191.199 279.571 192.355 278.997 193.709C278.419 195.064 277.921 196.439 277.497 197.837C277.073 199.237 276.858 200.46 276.854 201.511C276.85 202.168 276.978 202.737 277.238 203.221C277.498 203.704 278 203.947 278.744 203.95C279.664 203.955 280.771 203.546 282.067 202.721C283.362 201.897 284.692 200.69 286.058 199.098C287.423 197.508 288.638 195.621 289.701 193.439L290.616 194.165C289.64 196.524 288.392 198.629 286.872 200.481C285.351 202.334 283.724 203.78 281.99 204.822C280.255 205.863 278.578 206.379 276.959 206.371C275.732 206.364 274.793 206.084 274.14 205.535C273.486 204.983 273.041 204.271 272.805 203.393C272.569 202.517 272.454 201.619 272.458 200.699C272.461 200.394 272.472 200.067 272.497 199.715C272.52 199.365 272.555 199.037 272.6 198.731C271.849 199.997 271.022 201.207 270.118 202.361C269.215 203.516 268.269 204.463 267.281 205.203C266.293 205.94 265.25 206.308 264.157 206.302Z" fill="#FF6600" class="theme-color"/>
                                <path d="M379.773 172.95C379.726 172.628 379.66 172.312 379.574 171.999L379.393 171.276L379.176 170.522L378.759 169.027C378.469 168.031 378.177 167.018 377.87 166.025C375.45 158.105 372.608 150.395 369.561 142.77C366.516 135.146 361.42 128.606 357.756 121.172L343.991 131.521C347.295 138.633 351.831 141.492 354.974 148.776C358.116 156.059 361.153 163.349 363.894 170.665C364.003 170.931 364.1 171.202 364.2 171.472C363.88 171.48 363.561 171.515 363.241 171.507C361.487 171.523 359.638 171.459 357.747 171.311C350.187 170.735 340.403 167.505 332.604 166.368L331.918 175.449C339.613 178.734 347.87 181.758 356.036 183.58C358.187 184.042 360.359 184.397 362.546 184.642C365.088 184.959 367.659 184.955 370.201 184.631C371.066 184.505 371.92 184.308 372.752 184.042C373.929 183.665 375.034 183.096 376.025 182.36C377.495 181.249 378.622 179.748 379.28 178.028C379.873 176.404 380.043 174.656 379.773 172.95Z" fill="#F89EAB"/>
                                <path d="M354.988 116.68C360.187 118.625 367.645 138.069 367.645 138.069L343.927 150.746C343.927 150.746 337.093 132.719 339.744 126.003C342.513 118.993 349.038 114.456 354.988 116.68Z" fill="#FF6600" class="theme-color"/>
                                <path d="M332.391 175.376C332.391 175.376 325.684 176.602 325.561 173.637C325.438 170.67 324.864 163.216 324.864 163.216C324.864 163.216 316.653 163.968 316.732 163.216C316.887 161.739 321.199 161.464 321.199 161.464C321.199 161.464 316.031 161.432 315.805 160.251C315.527 158.792 322.188 159.054 321.879 159.212C321.57 159.37 315.086 156.725 318.276 156.484C321.467 156.244 324.864 155.843 327.026 157.526C329.187 159.209 333.993 167.613 333.993 167.613L332.391 175.376Z" fill="#F89EAB"/>
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
