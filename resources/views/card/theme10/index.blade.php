@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme10">
@else
<div class="{{ $business->theme_color }}" id="view_theme10">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
          <div class="actor-card">
            <section class="profile-sec pb">
                <div class="profile-banner-wrp">
                    <div class="profile-banner img-wrapper">
                        <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme10/images/profile-banner-img.png') }}" class="profile-banner-image" alt="profile-banner" id="banner_preview"
                        loading="lazy">
                    </div>
                    <img src="{{ asset('custom/theme10/images/banner-bg.png') }}" alt="profile-banner" class="profile-banner-bg">
                </div>
                <div class="container">
                    <div class="client-info-wrp text-center">
                        <div class="client-image">
                        <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme10/images/client-image.png') }}"   alt="client-image" loading="lazy">
                        </div>
                        <div class="client-info">
                        <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                            <p id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</p>
                            <span id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                        </div>
                    </div>
                    <div class="profile-content text-center">
                        <p id="{{ $stringid . '_desc' }}_preview">
                            {!! nl2br(e($business->description)) !!}</p>
                    </div>
                </div>
            </section>
                @php $j = 1; @endphp
            @foreach ($card_theme->order as $order_key => $order_value)
                @if ($j == $order_value)
                 @if ($order_key == 'gallery')
                  <section class="gallery-sec mb" id="gallery-div">
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
                  </section>
                 @endif
                 @if ($order_key == 'contact_info')
                 <section class="contact-info-sec pb" id="contact-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{__('Contact')}}</h2>
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
                                                    <img src="{{ asset('custom/theme10/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                        <img src="{{ asset('custom/theme10/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-item">
                                                @else
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme10/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                @if ($order_key == 'social')
                 <section class="social-link-sec mb" id="social-div">
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
                                               <img src="{{ asset('custom/theme10/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                 @if ($order_key == 'bussiness_hour')
                  <section class="business-hour-sec mb" id="business-hours-div">
                    <div class="container">
                        <div class="business-hours text-center">
                            <div class="section-title common-title text-center">
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
                 @if ($order_key == 'appointment')
                 <section class="appointment-sec pb" id="appointment-div">
                     <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Appointment') }}</h2>
                        </div>
                       <form class="appointment-form">
                           <div class="date-picker">
                               <div class="form-group">
                                   <span>{{__('Date :')}}</span>
                                   <input type="text" class="form-control datepicker_min" placeholder="Pick a date">
                               </div>
                           </div>
                           <ul class="check-box-div d-flex" id="inputrow_appointment_preview">
                            <span>{{__('Hours :')}}</span>
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
                            @endif
                        </div>
                    </div>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M15.0904 5.87467C14.7979 5.47452 14.6186 4.98789 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C9.44452 0.000810729 8.79851 0.150814 8.21579 0.423593C6.46511 1.24312 3.68708 2.42644 2.97212 4.22236C2.90007 4.40335 2.74762 4.54513 2.55854 4.59197C0.889394 5.00552 -0.221933 6.62934 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7398 7.14082 15.5082 6.44619 15.0904 5.87467Z" fill="#460B0D"/>
                                        <path d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659C10.1676 12.6493 8.99889 12.165 8.99889 11.1983V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V11.199C7.87446 12.1652 6.70629 12.6491 6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z" fill="#460B0D"/>
                                    </svg>
                                    <h3>{{__('Save')}}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="share-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                                        <mask id="path-1-outside-1_1322_212" maskUnits="userSpaceOnUse" x="0" y="0" width="17" height="18" fill="black">
                                        <rect fill="white" width="17" height="18"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.42994 10.4228C7.33338 10.4228 7.23347 10.4095 7.15813 10.3491C6.99398 10.2176 6.91227 9.98742 6.99146 9.78945C8.01915 7.04894 10.0876 4.90317 12.6858 3.79355C13.422 3.47911 13.5856 2.3358 12.8865 1.94562C12.6429 1.79946 12.5455 1.50715 12.6916 1.26355C12.8378 1.01995 13.1301 0.922514 13.3737 1.06867L16.5405 2.82257C16.7841 2.96873 16.8815 3.26105 16.7353 3.50464L15.0302 6.57397C14.9327 6.72012 14.7866 6.81756 14.5917 6.81756C14.4229 6.81756 14.2579 6.73633 14.1655 6.595C14.0674 6.44479 14.0527 6.25426 14.1532 6.08677C14.6236 5.26363 13.9357 4.32201 13.0661 4.69966C10.7273 5.71531 8.85033 7.65543 7.91713 10.0818C7.81969 10.2766 7.62481 10.4228 7.42994 10.4228ZM15.8107 8.9125C15.8107 8.62019 16.0056 8.42531 16.2979 8.42531C16.5902 8.42531 16.7851 8.66891 16.7851 8.9125V12.7126C16.7851 15.0999 14.885 16.9999 12.4978 16.9999H5.28731C2.94878 16.9999 1 15.0999 1 12.7126V5.50214C1 3.16361 2.90006 1.21484 5.28731 1.21484H8.94126C9.23358 1.21484 9.42846 1.40971 9.42846 1.70203C9.42846 1.99435 9.23358 2.18922 8.94126 2.18922H5.28731C3.48469 2.18922 1.97439 3.65081 1.97439 5.50214V12.7126C1.97439 14.564 3.43597 16.0255 5.28731 16.0255H12.4978C14.3004 16.0255 15.8107 14.564 15.8107 12.7126V8.9125Z"/>
                                        </mask>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.42994 10.4228C7.33338 10.4228 7.23347 10.4095 7.15813 10.3491C6.99398 10.2176 6.91227 9.98742 6.99146 9.78945C8.01915 7.04894 10.0876 4.90317 12.6858 3.79355C13.422 3.47911 13.5856 2.3358 12.8865 1.94562C12.6429 1.79946 12.5455 1.50715 12.6916 1.26355C12.8378 1.01995 13.1301 0.922514 13.3737 1.06867L16.5405 2.82257C16.7841 2.96873 16.8815 3.26105 16.7353 3.50464L15.0302 6.57397C14.9327 6.72012 14.7866 6.81756 14.5917 6.81756C14.4229 6.81756 14.2579 6.73633 14.1655 6.595C14.0674 6.44479 14.0527 6.25426 14.1532 6.08677C14.6236 5.26363 13.9357 4.32201 13.0661 4.69966C10.7273 5.71531 8.85033 7.65543 7.91713 10.0818C7.81969 10.2766 7.62481 10.4228 7.42994 10.4228ZM15.8107 8.9125C15.8107 8.62019 16.0056 8.42531 16.2979 8.42531C16.5902 8.42531 16.7851 8.66891 16.7851 8.9125V12.7126C16.7851 15.0999 14.885 16.9999 12.4978 16.9999H5.28731C2.94878 16.9999 1 15.0999 1 12.7126V5.50214C1 3.16361 2.90006 1.21484 5.28731 1.21484H8.94126C9.23358 1.21484 9.42846 1.40971 9.42846 1.70203C9.42846 1.99435 9.23358 2.18922 8.94126 2.18922H5.28731C3.48469 2.18922 1.97439 3.65081 1.97439 5.50214V12.7126C1.97439 14.564 3.43597 16.0255 5.28731 16.0255H12.4978C14.3004 16.0255 15.8107 14.564 15.8107 12.7126V8.9125Z" fill="#460B0D"/>
                                        <path d="M6.99146 9.78945L7.09596 9.83125L7.09682 9.82896L6.99146 9.78945ZM12.6916 1.26355L12.7881 1.32144L12.6916 1.26355ZM13.3737 1.06867L13.3158 1.16522L13.3192 1.1671L13.3737 1.06867ZM16.5405 2.82257L16.5984 2.72603L16.595 2.72414L16.5405 2.82257ZM16.7353 3.50464L16.6388 3.44672L16.637 3.45L16.7353 3.50464ZM15.0302 6.57397L15.1241 6.63659L15.1285 6.62861L15.0302 6.57397ZM7.91713 10.0818L8.01824 10.1323L8.02215 10.1222L7.91713 10.0818ZM12.6858 3.79355L12.6416 3.69007L12.6858 3.79355ZM7.15813 10.3491L7.08775 10.4369L7.15813 10.3491ZM6.88699 9.74766C6.78622 9.99957 6.89207 10.2801 7.08775 10.4369L7.2285 10.2613C7.09589 10.1551 7.03832 9.97527 7.09594 9.83124L6.88699 9.74766ZM12.6416 3.69007C10.015 4.81186 7.92451 6.98086 6.8861 9.74994L7.09682 9.82896C8.11379 7.11702 10.1603 4.99449 12.73 3.89703L12.6416 3.69007ZM12.5951 1.20566C12.4121 1.5108 12.5404 1.86917 12.8286 2.04211L12.9444 1.84913C12.7454 1.72976 12.6789 1.50349 12.7881 1.32144L12.5951 1.20566ZM13.4316 0.972185C13.1265 0.7891 12.7681 0.917422 12.5951 1.20566L12.7881 1.32144C12.9075 1.12248 13.1338 1.05593 13.3158 1.16516L13.4316 0.972185ZM16.595 2.72414L13.4282 0.970239L13.3192 1.1671L16.4859 2.921L16.595 2.72414ZM16.8318 3.56253C17.0149 3.25739 16.8866 2.89903 16.5984 2.72608L16.4826 2.91906C16.6815 3.03843 16.7481 3.2647 16.6389 3.44675L16.8318 3.56253ZM15.1285 6.62861L16.8337 3.55929L16.637 3.45L14.9318 6.51932L15.1285 6.62861ZM14.5917 6.93008C14.8302 6.93008 15.0091 6.80847 15.1238 6.63638L14.9365 6.51155C14.8564 6.63177 14.7429 6.70504 14.5917 6.70504V6.93008ZM14.0567 6.02888C13.9323 6.23624 13.9515 6.47318 14.0714 6.65655L14.2597 6.53345C14.1833 6.4164 14.1731 6.27229 14.2497 6.14466L14.0567 6.02888ZM8.02215 10.1222C8.94449 7.72408 10.7998 5.80654 13.1109 4.80286L13.0213 4.59645C10.6549 5.62408 8.75618 7.58678 7.81211 10.0414L8.02215 10.1222ZM7.42994 10.5353C7.67855 10.5353 7.90681 10.354 8.01777 10.1321L7.81649 10.0314C7.73257 10.1993 7.57108 10.3103 7.42994 10.3103V10.5353ZM16.2979 8.31279C16.1262 8.31279 15.9743 8.37052 15.8651 8.47972C15.7559 8.58892 15.6982 8.74077 15.6982 8.9125H15.9232C15.9232 8.79191 15.9629 8.70017 16.0242 8.63885C16.0856 8.57754 16.1773 8.53783 16.2979 8.53783V8.31279ZM16.8976 8.9125C16.8976 8.6142 16.6595 8.31279 16.2979 8.31279V8.53783C16.5209 8.53783 16.6726 8.72361 16.6726 8.9125H16.8976ZM16.8976 12.7126V8.9125H16.6726V12.7126H16.8976ZM12.4978 17.1124C14.9472 17.1124 16.8976 15.162 16.8976 12.7126H16.6726C16.6726 15.0377 14.8229 16.8874 12.4978 16.8874V17.1124ZM5.28731 17.1124H12.4978V16.8874H5.28731V17.1124ZM0.887478 12.7126C0.887478 15.1628 2.88747 17.1124 5.28731 17.1124V16.8874C3.01009 16.8874 1.11252 15.0369 1.11252 12.7126H0.887478ZM0.887478 5.50214V12.7126H1.11252V5.50214H0.887478ZM5.28731 1.10231C2.83708 1.10231 0.887478 3.1023 0.887478 5.50214H1.11252C1.11252 3.22492 2.96303 1.32736 5.28731 1.32736V1.10231ZM8.94126 1.10231H5.28731V1.32736H8.94126V1.10231ZM9.54098 1.70203C9.54098 1.5303 9.48324 1.37845 9.37404 1.26925C9.26484 1.16005 9.11299 1.10231 8.94126 1.10231V1.32736C9.06185 1.32736 9.1536 1.36706 9.21491 1.42838C9.27623 1.4897 9.31594 1.58144 9.31594 1.70203H9.54098ZM8.94126 2.30175C9.11299 2.30175 9.26484 2.24401 9.37404 2.13481C9.48324 2.02561 9.54098 1.87376 9.54098 1.70203H9.31594C9.31594 1.82262 9.27623 1.91436 9.21491 1.97568C9.1536 2.037 9.06185 2.0767 8.94126 2.0767V2.30175ZM5.28731 2.30175H8.94126V2.0767H5.28731V2.30175ZM2.08691 5.50214C2.08691 3.71402 3.54575 2.30175 5.28731 2.30175V2.0767C3.42362 2.0767 1.86187 3.58759 1.86187 5.50214H2.08691ZM2.08691 12.7126V5.50214H1.86187V12.7126H2.08691ZM5.28731 15.913C3.49811 15.913 2.08691 14.5018 2.08691 12.7126H1.86187C1.86187 14.6261 3.37383 16.1381 5.28731 16.1381V15.913ZM12.4978 15.913H5.28731V16.1381H12.4978V15.913ZM15.6982 12.7126C15.6982 14.5007 14.2393 15.913 12.4978 15.913V16.1381C14.3615 16.1381 15.9232 14.6272 15.9232 12.7126H15.6982ZM15.6982 8.9125V12.7126H15.9232V8.9125H15.6982ZM14.5917 6.70504C14.4571 6.70504 14.3294 6.64001 14.2597 6.53345L14.0714 6.65655C14.1864 6.83266 14.3886 6.93008 14.5917 6.93008V6.70504ZM14.2509 6.1426C14.508 5.69271 14.4515 5.20259 14.2016 4.87471C13.9491 4.54345 13.5047 4.3865 13.0213 4.59645L13.1109 4.80286C13.4971 4.63517 13.8314 4.7602 14.0226 5.01113C14.2165 5.26543 14.2688 5.65769 14.0555 6.03094L14.2509 6.1426ZM12.73 3.89703C13.1417 3.72121 13.3866 3.31763 13.4361 2.91159C13.4856 2.50469 13.3407 2.07024 12.9413 1.84737L12.8317 2.04387C13.1314 2.21118 13.2542 2.54348 13.2127 2.88439C13.1711 3.22616 12.9661 3.55146 12.6416 3.69007L12.73 3.89703ZM7.08775 10.4369C7.19439 10.5224 7.32761 10.5353 7.42994 10.5353V10.3103C7.33916 10.3103 7.27255 10.2967 7.2285 10.2613L7.08775 10.4369Z" fill="#460B0D" mask="url(#path-1-outside-1_1322_212)"/>
                                    </svg>
                                    <h3>{{__('Share')}}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M13.4556 2.09597C12.1039 0.744271 10.3067 -7.56008e-05 8.39517 5.7592e-09C8.08194 5.7592e-09 7.82812 0.253887 7.82812 0.567049C7.82812 0.880212 8.08201 1.1341 8.39517 1.1341C10.0038 1.13402 11.5161 1.76042 12.6536 2.89792C13.7912 4.03543 14.4176 5.54786 14.4175 7.15654C14.4175 7.4697 14.6714 7.72359 14.9846 7.72359C15.2978 7.72359 15.5516 7.4697 15.5516 7.15662C15.5517 5.2449 14.8074 3.44766 13.4556 2.09597Z" fill="#460B0D"/>
                                        <path d="M11.123 7.15675C11.123 7.46992 11.3769 7.7238 11.6901 7.72373C12.0033 7.72373 12.2571 7.46984 12.2571 7.15668C12.2569 5.0276 10.5245 3.29522 8.39525 3.29492C8.39517 3.29492 8.39533 3.29492 8.39525 3.29492C8.08209 3.29492 7.8282 3.54873 7.82812 3.8619C7.82812 4.17506 8.08194 4.42894 8.3951 4.42902C9.89914 4.42925 11.1228 5.65286 11.123 7.15675Z" fill="#460B0D"/>
                                        <path d="M9.87051 10.0471C9.00618 10.0023 8.56585 10.6451 8.35468 10.9539C8.17783 11.2124 8.24406 11.5652 8.50256 11.7421C8.76106 11.9189 9.11392 11.8527 9.29076 11.5942C9.54026 11.2294 9.6533 11.172 9.80663 11.1793C10.2974 11.237 12.2303 12.6534 12.4238 13.0963C12.4724 13.2267 12.4705 13.3545 12.4185 13.5101C12.2155 14.1124 11.8796 14.5356 11.4468 14.734C11.0357 14.9225 10.5316 14.9054 9.98944 14.6848C7.96492 13.8596 6.19619 12.708 4.73244 11.262C4.73184 11.2614 4.73123 11.2608 4.7307 11.2602C3.28768 9.79794 2.13823 8.03146 1.31442 6.01005C1.09372 5.46742 1.07664 4.96327 1.26512 4.5522C1.46352 4.11943 1.88676 3.78351 2.48851 3.58081C2.64457 3.52849 2.77219 3.52683 2.9014 3.57491C3.34589 3.76914 4.76223 5.70195 4.81939 6.18719C4.82756 6.34627 4.76972 6.45923 4.40522 6.70827C4.14664 6.88489 4.08018 7.23775 4.25688 7.49632C4.43349 7.7549 4.78627 7.82128 5.04492 7.64466C5.35385 7.43372 5.99651 6.9946 5.9519 6.12731C5.90276 5.2214 4.14052 2.82232 3.29849 2.51271C2.92401 2.37314 2.5301 2.37073 2.12727 2.50591C1.22089 2.81113 0.566293 3.35535 0.234229 4.07966C-0.0878549 4.78235 -0.077648 5.59761 0.264094 6.43775C1.14574 8.60101 2.37926 10.4938 3.93033 12.0638C3.93411 12.0676 3.93797 12.0714 3.9419 12.0751C5.51074 13.6233 7.40135 14.8546 9.56174 15.7352C9.99436 15.9111 10.4204 15.9992 10.8278 15.9992C11.2115 15.9992 11.5788 15.9212 11.9195 15.765C12.6438 15.433 13.188 14.7784 13.4934 13.8715C13.6283 13.4694 13.6261 13.0756 13.4876 12.7029C13.1769 11.8586 10.7779 10.0964 9.87051 10.0471Z" fill="#460B0D"/>
                                    </svg>
                                    <h3>{{__('Contact')}}</h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                  </section>
                 @endif
                 @if ($order_key == 'testimonials')
                  <section class="testimonial-sec bg-light pb" id="testimonials-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{__('testimonial')}}</h2>
                        </div>
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

                 @if ($order_key == 'payment')
                  <section class="payment-sec pb" id="payment-section">
                    <div class="section-title common-title text-center">
                        <h2>{{__('Payment')}}</h2>
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
                        <div class="section-title common-title text-center">
                            <h2>{{__('Download Here')}}</h2>
                        </div>
                        @if (!is_null($appInfo))
                        <ul class="d-flex">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="562" height="639" viewBox="0 0 562 639" fill="none">
                                <path d="M437.287 58.639C438.998 53.8071 439.728 50.2387 444.552 47.6243C445.453 47.1364 446.425 47.133 447.424 47.152L447.777 47.4954C447.183 48.0009 446.998 48.0383 446.297 48.2985C443.355 49.3886 441.514 52.3739 439.931 54.9318C443.22 52.5868 445.651 51.3233 449.532 50.2557C445.662 52.7553 441.778 55.4134 438.65 58.8295C438.164 58.8716 437.76 58.7433 437.287 58.639Z" fill="#881346"/>
                                <path d="M4.86556 541.495C5.70958 541.567 6.68038 541.665 7.47227 541.972C8.5827 542.402 9.43726 543.676 9.89847 544.733C10.4153 545.917 10.2602 547.387 9.69112 548.532C8.9437 550.037 7.7937 550.596 6.26869 551.103C5.57485 551.095 4.88808 551.103 4.21619 550.905C3.05984 550.563 2.12918 549.808 1.58624 548.727C0.99824 547.555 0.693558 545.989 1.16387 544.731C1.80832 543.007 3.29391 542.228 4.86556 541.495Z" fill="#F99B54"/>
                                <path  class="theme-color" d="M168.067 71.2551C168.873 71.2375 169.615 71.2706 170.405 71.4533C171.791 71.772 172.798 72.5906 173.492 73.8265C174.351 75.3551 174.456 76.7194 173.897 78.3679C173.324 80.0565 171.923 80.8638 170.422 81.633C169.732 81.7176 169.092 81.7345 168.405 81.6296C166.901 81.4004 165.67 80.4238 164.864 79.1498C164.152 78.0259 163.982 76.1229 164.319 74.8594C164.829 72.9459 166.44 72.1034 168.067 71.2551Z" fill="#460B0D"/>
                                <path d="M548.832 531.34C549.51 531.223 550.167 531.15 550.855 531.166C552.42 531.205 553.867 531.613 554.945 532.806C555.937 533.904 556.573 535.223 556.417 536.723C556.179 538.999 554.84 540.031 553.173 541.413C552.568 541.55 551.914 541.66 551.292 541.667C549.783 541.685 548.103 540.764 547.124 539.649C546.003 538.374 545.712 536.857 545.919 535.195C546.145 533.375 547.458 532.371 548.832 531.34Z" fill="#F86B7A"/>
                                <path d="M345.865 0C346.294 0.0132848 346.706 0.021082 347.126 0.116964C348.639 0.462079 350.271 1.4879 351.004 2.89233C351.611 4.05836 351.896 5.4716 351.477 6.73466C350.729 8.99077 349.417 10.0196 347.346 11.0516L346.92 11.0212C345.11 10.8374 343.53 10.5868 342.371 9.03539C341.384 7.71268 340.936 6.24371 341.274 4.6143L341.364 4.22124C341.452 3.81346 341.522 3.41982 341.695 3.03514C342.426 1.40718 344.336 0.65803 345.865 0Z" fill="#F99B54"/>
                                <path d="M70.3567 107.539C71.322 107.493 72.362 107.398 73.3188 107.548C74.55 107.741 75.6653 108.572 76.3922 109.56C77.337 110.844 77.7396 112.477 77.4033 114.051C76.9662 116.097 75.2684 117.237 73.5839 118.196C72.7991 118.352 72.0595 118.378 71.2636 118.414C69.8604 117.753 68.5942 117.119 67.6817 115.814C66.801 114.554 66.6072 112.853 66.9069 111.364C67.2557 109.625 68.9776 108.426 70.3567 107.539Z" fill="#F86B7A"/>
                                <path class="theme-color" d="M548.078 416.371C549.096 416.376 550.271 416.493 551.243 416.804C552.556 417.225 553.517 418.605 554.055 419.808C554.639 421.116 554.681 423.014 554.046 424.307C553.136 426.155 551.654 426.929 549.788 427.568L547.193 427.212C545.862 426.845 544.624 425.674 544.05 424.436C543.443 423.126 543.281 421.223 543.866 419.878C544.659 418.058 546.368 417.179 548.078 416.371Z" fill="#460B0D"/>
                                <path d="M497.283 334.267C498.537 336.473 499.477 338.473 500.205 340.909L500.373 341.451C501.013 343.595 501.165 346.08 501.043 348.311C499.906 349.339 498.007 350.888 496.43 351.026C497.092 349.804 497.864 348.367 497.611 346.934C497.495 346.274 497.128 346.261 496.603 345.937C494.45 346.752 492.87 348.437 490.786 349.345C489.792 349.778 488.766 349.756 487.792 349.281C486.967 348.879 486.706 348.425 486.391 347.608C486.809 345.447 488.442 343.94 489.851 342.348L497.283 334.267Z" fill="#F86B7A"/>
                                <path d="M443.992 58.9668C447.042 60.1619 449.089 62.9992 450.351 65.9415C452.576 71.128 453.645 77.8248 451.501 83.2186C450.243 86.3815 448.063 88.3939 445.469 90.4717C444.648 91.0442 443.801 91.5843 442.879 91.9805C441.672 92.4988 439.961 92.7208 438.732 92.1272C435.494 90.5641 433.947 84.9312 432.896 81.733C433.302 81.2909 434.016 81.0575 434.548 80.7784C438.893 78.4967 443.386 74.1408 444.784 69.3463L444.9 68.9253C445.553 66.631 445.799 63.8594 444.871 61.608C444.51 60.7344 444.254 59.8749 443.992 58.9668Z" fill="#881346"/>
                                <path d="M227.691 529.584C229.683 529.373 231.68 529.29 233.588 529.995C236.525 531.081 238.582 533.048 239.792 535.939C240.826 538.41 240.908 541.318 239.859 543.795C238.409 547.223 235.811 548.899 232.497 550.178C230.544 550.406 228.416 550.413 226.53 549.795C224.161 549.019 221.784 546.985 220.693 544.737C219.367 542.006 219.138 538.895 220.245 536.04C221.58 532.599 224.447 530.88 227.691 529.584Z" fill="#F98A84"/>
                                <path d="M495.603 319.707L503.95 323.181L516.149 328.902C518.846 330.158 521.758 331.333 524.124 333.159L520.517 339.777C519.983 340.818 519.453 342.463 518.459 343.114L516.968 342.789C515.666 341.151 512.19 339.894 510.323 338.963L498.207 332.869L491.908 329.618L495.603 319.707Z" fill="#373296"/>
                                <path  class="theme-color" d="M538.147 136.184C540.332 136.27 542.395 136.49 544.371 137.507C546.722 138.717 548.364 140.889 549.158 143.386C549.98 145.972 549.887 149.527 548.533 151.925C546.799 154.999 543.754 156.629 540.476 157.514C538.141 157.669 536.031 157.476 533.978 156.264C531.454 154.774 529.428 152.257 528.738 149.383C528.07 146.596 528.779 142.987 530.424 140.667C532.408 137.871 534.91 136.836 538.147 136.184Z" fill="#460B0D"/>
                                <path d="M498.205 332.869L510.322 338.963C512.189 339.894 515.664 341.152 516.967 342.789L516.702 343.266C515.451 345.615 514.802 348.493 513.998 351.025C511.158 359.955 507.525 370.806 497.581 373.904C495.467 374.563 492.788 374.698 490.784 373.63C488.289 372.299 486.629 370.223 485.941 367.481C485.181 364.455 485.904 362.36 487.566 359.832C489.147 357.426 491.27 355.645 493.371 353.72C494.307 352.862 495.341 351.666 496.428 351.026C498.005 350.889 499.904 349.34 501.041 348.312C501.163 346.081 501.011 343.595 500.371 341.452L500.203 340.91C499.475 338.474 498.535 336.473 497.281 334.267L498.205 332.869Z" fill="#F98A84"/>
                                <path d="M257.651 54.601C255.555 52.9532 253.638 51.3801 252.364 48.983C249.088 42.8156 248.641 34.8631 247.585 28.0739C247.035 24.5277 245.573 19.1058 246.639 15.692C247.35 14.9193 247.787 14.5139 248.77 14.0734C249.82 14.7983 250.088 16.2887 250.524 17.4784L253.429 25.0343C253.766 25.9596 253.841 27.0597 254.633 27.7093C255.332 25.3102 251.188 15.5828 250.526 12.4329C250.151 10.6467 249.952 9.12774 250.984 7.51191C251.41 7.42916 251.661 7.35754 252.119 7.38368C256.613 7.64071 257.786 20.6601 259.804 23.8004C260.082 22.777 259.601 21.7978 259.357 20.8038C258.478 17.2291 255.175 7.25271 257.055 4.12443C258.119 3.3968 258.169 3.27522 259.522 3.33586C262.475 5.23299 263.815 12.7012 264.684 15.9752L266.46 22.0378L266.853 21.8652C266.64 18.0197 264.774 14.4938 265.418 10.5202C265.607 9.35055 266.097 8.28069 267.151 7.66569C267.776 7.30022 267.911 7.50599 268.557 7.6797C270.515 9.83573 271.184 13.5402 272.028 16.2778L276.159 30.7912C276.893 30.7073 280.211 22.5269 283.276 21.7268C284.116 21.5073 284.904 21.7103 285.61 22.1761C286.375 23.6173 285.844 25.2329 285.569 26.7591C284.691 31.6309 283.637 36.8568 282.03 41.542C280.785 45.1704 278.096 49.3429 277.989 53.1638L277.986 53.5636L263.529 57.7779L257.237 59.399L257.651 54.601Z" fill="#F99B54"/>
                                <path d="M257.65 54.6016C259.33 54.9322 260.52 55.3786 261.753 56.6012C262.28 57.1229 262.884 57.4296 263.528 57.7787L257.236 59.3997L257.65 54.6016Z" fill="#ED7533"/>
                                <path  class="theme-color" d="M35.9153 414.9L59.8661 414.928L66.8217 414.899C68.0231 414.897 69.3205 414.708 70.4275 415.243L70.6884 415.225L70.6312 474.004L53.3737 461.729L35.8984 473.778L35.9253 428.845L35.9153 414.9Z" fill="#460B0D"/>
                                <path d="M35.916 414.9L59.8668 414.928L66.8223 414.899C68.0238 414.897 69.3212 414.708 70.4282 415.243L70.371 433.377L36.3587 433.514C36.3037 431.951 36.2551 430.38 35.9258 428.845L35.916 414.9Z" fill="#F86B7A"/>
                                <path d="M361.309 77.2525C359.388 75.102 357.844 70.9499 357.73 68.1351C357.619 65.3804 358.488 62.4535 360.469 60.4646C363.464 57.456 367.309 57.425 371.263 57.401C371.663 56.0233 372.155 54.6935 372.789 53.406C376.072 46.748 382.657 42.3427 389.56 40.1534C396.152 38.0615 401.753 39.6853 407.613 42.8208C408.317 40.5582 408.942 38.0488 410.483 36.191C411.999 34.362 414.439 33.5463 416.751 33.4165C421.303 33.1612 425.925 34.6714 429.372 37.6787C433.699 41.6899 436.126 46.9294 436.769 52.78C436.977 54.6697 436.859 56.811 437.285 58.6385C437.758 58.7429 438.162 58.8711 438.648 58.8288C440.486 58.6025 442.175 58.5546 443.992 58.967C444.254 59.8751 444.511 60.7346 444.871 61.6082C445.799 63.8596 445.553 66.6312 444.9 68.9255L444.784 69.3465C443.386 74.141 438.893 78.4969 434.548 80.7786C434.016 81.0579 433.302 81.2912 432.897 81.7332C431.716 77.5719 431.393 73.385 431.389 69.0637C413.752 69.7857 399.286 76.7871 384.074 85.1304C380.954 86.8417 377.688 88.2659 374.63 90.0941C369.729 86.2661 364.906 82.4066 361.309 77.2525Z" fill="#E2424F"/>
                                <path d="M429.371 37.6787C433.699 41.6898 436.126 46.9294 436.769 52.7801C436.976 54.6697 436.859 56.811 437.285 58.6385C437.757 58.7429 438.161 58.8711 438.648 58.8288C440.485 58.6025 442.175 58.5546 443.992 58.967C444.254 59.8751 444.51 60.7346 444.871 61.6082C445.799 63.8596 445.553 66.6312 444.9 68.9255L444.784 69.3465C443.386 74.141 438.893 78.4969 434.548 80.7786C434.016 81.0579 433.302 81.2912 432.896 81.7332C431.715 77.5719 431.393 73.385 431.389 69.0637C413.752 69.7857 399.285 76.7871 384.074 85.1304C380.954 86.8417 377.687 88.2659 374.63 90.0941C369.729 86.2662 364.906 82.4067 361.309 77.2525C362.352 76.7265 366.653 77.4859 368.034 77.5022C370.054 77.5247 372.026 77.376 374.027 77.1059C389.199 75.0556 405.291 67.5507 417.276 58.1239C420.639 55.4785 423.936 52.5601 426.359 49.0001C427.583 47.2 428.591 45.1658 428.89 42.9893C429.153 41.0864 428.214 39.2039 429.371 37.6787Z" fill="#AB2F46"/>
                                <path d="M374.632 90.0939C377.69 88.2656 380.957 86.8414 384.077 85.1301C399.288 76.787 413.755 69.7855 431.392 69.0635C431.396 73.3849 431.718 77.5717 432.899 81.733C433.949 84.9311 435.496 90.564 438.735 92.1272C439.963 92.7208 441.674 92.4987 442.881 91.9805C443.804 91.5842 444.65 91.0442 445.471 90.4716C448.597 91.8846 450.556 93.4154 451.765 96.7003C452.605 98.982 452.194 101.537 451.091 103.652C449.929 105.883 447.434 107.808 445.001 108.462C443.957 108.742 442.853 108.661 441.784 108.659L440.456 108.68C437.781 115.69 435.483 120.32 429.498 125.09C428.288 126.054 427.025 127.207 425.664 127.922L425.262 128.011C422.988 128.641 420.912 130.005 418.577 130.666C411.919 132.551 404.593 132.386 397.9 130.732C395.964 130.254 393.997 129.348 392.056 129.029L386.675 125.964C380.538 121.896 377.645 115.713 376.192 108.692C374.023 108.411 371.721 108.225 369.752 107.2C367.399 105.975 365.477 103.61 364.89 101.006C364.418 98.915 364.925 96.8547 365.988 95.0384C367.934 91.7127 371.221 91.069 374.632 90.0939Z" fill="#F99B54"/>
                                <path d="M393.6 88.8408L394.687 89.0911C395.512 89.3237 396.183 89.8793 396.561 90.662C397.033 91.6413 396.956 93.2842 396.609 94.3023C396.141 95.6737 395.219 96.2181 394.001 96.8836C392.939 96.4169 392.057 96.0792 391.453 95.0102C390.772 93.8088 390.719 92.0453 391.242 90.7833C391.738 89.5846 392.522 89.3477 393.6 88.8408Z" fill="#881346"/>
                                <path d="M420.917 89.1553C421.909 89.1567 422.996 89.1651 423.797 89.842C424.699 90.6035 425.091 91.829 425.055 92.9783C424.996 94.784 424.017 95.7725 422.791 96.9767C421.777 96.9916 421.203 96.8801 420.279 96.5296C419.331 95.4601 418.874 94.6358 418.865 93.1742C418.855 91.3284 419.654 90.4061 420.917 89.1553Z" fill="#881346"/>
                                <path d="M384.371 100.903C385.511 100.831 386.867 100.625 387.888 101.253C389.069 101.979 389.559 102.881 389.892 104.18C389.561 105.852 389.091 106.165 387.897 107.425C386.526 107.557 385.295 107.659 384.191 106.742C383.399 106.084 382.71 105.061 382.675 104.004C382.619 102.328 383.27 101.993 384.371 100.903Z" fill="#F98A84"/>
                                <path d="M427.001 99.9932C428.364 100.195 428.784 100.492 429.712 101.479C430.122 102.781 430.441 103.447 429.703 104.738C428.716 106.464 426.417 106.742 424.671 107.016C423.875 106.687 423.238 106.268 422.524 105.794C422.247 105.216 422.023 104.764 422.044 104.101C422.087 102.78 422.754 102.024 423.627 101.156C424.906 100.729 425.052 100.943 426.271 101.407L427.001 99.9932Z" fill="#F98A84"/>
                                <path d="M372.81 95.2559C373.846 95.387 374.637 95.3962 375.424 96.1654C376.09 98.1827 375.641 101.475 375.61 103.651C374.685 104.296 373.84 104.17 372.729 104.243C371.549 103.799 370.634 103.368 370.022 102.171C369.405 100.968 369.56 97.9957 370.217 96.8006C370.843 95.6621 371.675 95.5774 372.81 95.2559Z" fill="#F86B7A"/>
                                <path d="M442.928 94.7715L444.012 94.9838C445.244 95.2679 446.489 95.9525 447.115 97.1025C447.987 98.7052 447.413 100.432 447.021 102.064C446.663 103.559 445.993 104.286 444.975 105.447C443.689 105.416 442.789 105.334 441.857 104.332C440.631 103.014 440.607 101.218 440.69 99.5166C440.807 97.1264 441.172 96.42 442.928 94.7715Z" fill="#F86B7A"/>
                                <path d="M395.961 107.635L420.478 107.662C419.644 110.101 418.703 111.774 417.048 113.756C415.913 114.815 414.643 115.705 413.228 116.357C410.369 117.672 406.807 117.755 403.884 116.611C399.419 114.863 397.727 111.8 395.961 107.635Z" fill="white"/>
                                <path d="M453.458 585.804C455.987 585.173 459.212 585.334 461.839 585.147L478.561 583.768C477.826 586.325 476.742 589.178 476.755 591.868C476.77 594.847 477.901 598.287 478.564 601.214C481.005 602.727 483.314 604.385 485.486 606.27C488.052 608.497 490.602 611.279 493.833 612.516C502.662 615.898 517.695 606.339 520.873 620.207L521.385 623.837L548.72 626.064C552.494 626.504 557.949 626.759 561.294 628.601L561.399 629.22C559.569 630.546 556.63 630.906 554.416 631.274C541.62 633.401 528.483 633.686 515.554 634.46L496.734 635.878L450.144 637.603L292.174 639L184.839 636.92L140.653 634.801C132.999 634.445 88.8764 632.786 84.6953 629.759L84.7298 629.206C87.3887 627.305 97.6779 627.018 101.37 626.724L150.504 623.998L197.508 621.992L294.554 620.823C294.808 619.328 294.997 617.595 295.833 616.3C297.538 613.657 302.284 611.068 305.469 611.85C307.108 612.253 308.655 613.163 310.246 613.735C312.99 614.721 316.052 614.942 318.908 614.339C325.98 612.848 332.089 604.937 335.959 599.349L338.794 584.737L363.768 586.723L362.225 598.65C362.087 599.727 361.522 601.615 361.959 602.535C364.039 603.913 364.627 605.76 365.126 608.134L366.608 620.849L448.298 622.262L449.438 611.186C450.073 607.652 450.634 604.603 453.742 602.445C453.937 600.947 453.648 599.017 453.625 597.476L453.458 585.804Z" fill="#F5F5F5"/>
                                <path d="M453.456 585.804C455.985 585.173 459.209 585.334 461.836 585.147L478.558 583.768C477.823 586.325 476.739 589.178 476.753 591.868C476.768 594.847 477.899 598.287 478.561 601.214C481.002 602.727 483.311 604.385 485.483 606.27C488.049 608.497 490.599 611.279 493.83 612.516C502.659 615.898 517.692 606.339 520.87 620.207L521.382 623.837C521.351 626.113 520.628 627.783 519.514 629.738C519.436 629.782 454.245 630.901 449.537 629.732C447.86 628.076 448.312 624.467 448.296 622.262L449.435 611.186C450.071 607.651 450.632 604.603 453.74 602.444C453.935 600.947 453.646 599.017 453.622 597.475L453.456 585.804Z" fill="#2E1C6C"/>
                                <path d="M453.457 585.804C455.986 585.173 459.211 585.334 461.838 585.147L478.56 583.768C477.825 586.325 476.741 589.178 476.754 591.868C476.769 594.847 477.9 598.287 478.563 601.214L478.286 601.368C472.348 604.759 469.361 608.667 461.816 606.792C458.894 606.066 456.014 604.384 453.741 602.444C453.936 600.947 453.647 599.017 453.624 597.476L453.457 585.804Z" fill="#F86B7A"/>
                                <path d="M338.791 584.736L363.764 586.723L362.221 598.65C362.083 599.727 361.518 601.615 361.955 602.535C364.035 603.912 364.623 605.76 365.123 608.134L366.604 620.849C366.928 624.278 367.691 628.962 365.579 631.879C363.744 632.696 360.657 632.289 358.638 632.274L343.765 632.181L294.628 632.077L294.551 620.823C294.805 619.328 294.993 617.595 295.829 616.3C297.535 613.657 302.281 611.068 305.465 611.85C307.105 612.253 308.652 613.163 310.242 613.735C312.986 614.721 316.049 614.942 318.905 614.339C325.977 612.848 332.085 604.937 335.956 599.349L338.791 584.736Z" fill="#2E1C6C"/>
                                <path d="M338.792 584.736L363.765 586.723L362.223 598.65C362.084 599.727 361.52 601.615 361.957 602.535C359.765 604.352 357.044 605.706 354.267 606.312C346.074 608.098 342.186 603.349 335.957 599.349L338.792 584.736Z" fill="#F86B7A"/>
                                <path class="theme-color" d="M277.983 53.5646C279.999 52.9632 281.782 52.1883 283.787 53.1133C285.651 55.1622 286.074 57.2091 286.394 59.8764C287.333 64.3325 289.802 68.862 291.568 73.0677C295.565 82.5926 300.291 91.3482 305.649 100.171C315.1 115.735 326.157 129.893 341.59 139.984C348.405 144.439 356.171 146.734 363.908 148.966C369.488 146.757 374.795 145.44 380.558 143.914C378.086 149.586 377.118 155.78 379.491 161.699C380.912 165.245 383.717 168.524 387.314 169.938C389.498 170.797 392.225 170.124 394.25 169.137C397.28 167.662 400.026 165.339 402.65 163.253L403.195 163.467L403.882 189.473C404.288 201.054 405.041 212.732 404.348 224.308C403.269 242.365 399.946 259.982 395.589 277.503C389.754 276.272 383.015 276.597 377.021 276.113C363.921 275.055 349.835 272.639 337.444 268.284C340.848 244.157 343.93 220.02 344.783 195.655C345.05 188.016 345.444 180.123 344.802 172.503C344.445 168.431 345.677 165.169 347.195 161.494C345.615 160.5 344.106 159.611 342.245 159.273C337.813 158.467 332.344 159.021 327.807 159.016L301.069 159.034C296.087 159.047 290.978 159.303 286.009 158.985L285.68 158.962C270.633 138.351 261.068 112.13 257.173 87.0027C256.204 80.748 255.854 74.4445 255.442 68.1355L255.234 67.8386C254.021 65.8835 253.371 63.7788 253.829 61.5226C254.82 60.2437 255.734 59.9355 257.234 59.3996L263.526 57.7786L277.983 53.5646Z" fill="#460B0D"/>
                                <path d="M277.983 53.5646C280 52.9632 281.782 52.1883 283.787 53.1133C285.651 55.1622 286.074 57.2091 286.395 59.8764C280.942 62.211 274.606 63.3927 268.862 64.8825C264.494 66.0149 259.923 67.578 255.442 68.1357L255.234 67.8388C254.021 65.8836 253.371 63.779 253.829 61.5227C254.82 60.2438 255.734 59.9356 257.234 59.3998L263.526 57.7787L277.983 53.5646Z" fill="#373296"/>
                                <path d="M35.9174 414.901C34.6025 414.42 32.7178 414.689 31.3048 414.708C24.1849 414.803 13.8768 416.108 7.87304 411.717C4.27431 409.085 1.22068 404.697 0.558611 400.206L0.478902 399.607C0.0122019 396.293 0.215948 392.836 0.217248 389.493L0.236311 372.774L0.252484 317.176L0.172053 223.024L0.260857 177.217C0.492186 171.77 2.89645 167.472 6.83077 163.839C9.96843 160.942 13.8597 159.307 18.0788 158.833C21.6076 158.437 25.3932 158.669 28.9469 158.67L47.9867 158.706L108.919 158.741L218.436 158.693L285.681 158.963L286.009 158.986C290.979 159.304 296.087 159.047 301.069 159.035L327.808 159.016C332.344 159.022 337.814 158.468 342.246 159.274C344.106 159.611 345.616 160.5 347.195 161.495C345.678 165.169 344.445 168.431 344.803 172.504L122.991 172.642L59.4109 172.631L41.1022 172.703C37.9229 172.72 34.5005 172.497 31.351 172.891C26.7038 173.474 22.4106 175.672 19.1406 179.031C16.5092 181.733 14.504 185.537 14.0139 189.303C13.1806 195.704 13.7334 202.806 13.7319 209.262L13.6931 249.35L13.6021 334.975L13.6275 380.923C13.8002 386.984 16.8229 391.573 21.1726 395.55C23.9463 398.085 27.3843 399.611 31.0746 400.208L31.5696 400.292C34.6043 400.76 37.8886 400.509 40.9662 400.513L58.2998 400.518L118.311 400.526L255.245 400.585L337.254 400.589L337.938 399.675C337.041 405.585 337.813 412.097 336.601 417.859C336.584 416.971 336.832 415.568 336.197 414.954L270.859 414.896L138.736 414.927L92.9452 414.931L77.9496 414.891C75.7449 414.886 72.773 414.515 70.6901 415.226L70.4292 415.244C69.3223 414.709 68.025 414.898 66.8234 414.9L59.8678 414.929L35.9174 414.901Z" fill="#B5B2F4"/>
                                <path  class="theme-color" d="M392.055 129.029C393.997 129.348 395.964 130.254 397.9 130.732C404.593 132.386 411.919 132.551 418.577 130.666C420.911 130.005 422.987 128.641 425.262 128.011L425.664 127.922C425.875 130.332 425.86 133.082 426.405 135.422C431.07 136.562 435.159 141.093 437.807 144.918C443.848 146.687 449.898 148.571 455.69 151.051C477.237 160.276 498.69 175.903 513.258 194.418C517.575 199.905 521.398 206.125 524.782 212.232C540.811 241.16 543.764 274.876 534.501 306.45L524.126 333.158C521.759 331.332 518.847 330.158 516.15 328.901L503.951 323.18L495.604 319.706C499.583 304.473 502.218 288.895 500.242 273.122C498.282 257.474 489.753 244.212 477.44 234.664L479.749 258.37C480.413 260.834 480.294 263.554 480.655 266.091L483.928 322.709L484.69 335.743C482.41 336.445 480.192 336.889 477.834 337.247L466.679 339.811C460.409 341.032 454.232 342.708 447.896 343.553C428.119 346.189 407.914 346.375 388.021 345.191C372.48 344.266 357.342 342.833 342.661 337.333C341.322 336.888 340.004 336.037 338.842 335.234C334.795 332.438 332.286 329.157 331.388 324.254C331.01 316.502 332.059 308.386 332.961 300.692L337.445 268.283C349.836 272.638 363.923 275.055 377.023 276.112C383.016 276.596 389.756 276.271 395.591 277.503C399.948 259.981 403.27 242.364 404.35 224.307C405.042 212.732 404.289 201.053 403.884 189.472L403.196 163.466L402.651 163.253C400.028 165.338 397.281 167.662 394.252 169.137C392.227 170.123 389.5 170.796 387.316 169.938C383.719 168.523 380.914 165.244 379.492 161.698C377.12 155.78 378.088 149.585 380.56 143.913C383.161 139.916 386.325 137.178 390.736 135.323L391.13 135.203C391.654 133.18 391.822 131.1 392.055 129.029Z" fill="#460B0D"/>
                                <path d="M479.748 258.37L479.08 258.062L474.68 240.459C474.017 237.943 473.446 235.085 472.294 232.742C471.08 230.278 468.207 227.875 466.34 225.79C459.445 218.09 451.593 207.917 449.637 197.54C451.812 199.87 453.355 202.932 455.151 205.575C458.14 209.973 461.676 214.164 465.541 217.82C472.958 224.835 481.728 230.398 489.692 236.762C496.921 242.538 503.697 250.645 507.159 259.297C509.302 264.653 510.462 270.256 511.229 275.949C512.757 287.281 510.234 300.698 507.189 311.648C506.156 315.364 504.366 319.363 503.95 323.181L495.603 319.707C499.582 304.473 502.217 288.895 500.241 273.122C498.281 257.475 489.752 244.213 477.438 234.665L479.748 258.37Z" fill="#ED7533"/>
                                <path d="M392.055 129.029C393.996 129.348 395.963 130.254 397.9 130.732C404.592 132.386 411.919 132.551 418.577 130.666C420.911 130.005 422.987 128.641 425.261 128.011L425.663 127.922C425.875 130.332 425.86 133.082 426.405 135.422C431.07 136.562 435.159 141.093 437.807 144.918C440 150.89 440.692 156.284 437.846 162.22C436.217 165.615 433.45 168.981 429.744 170.132C428.493 170.52 427.547 170.578 426.271 170.378L425.722 170.298C418.957 169.206 413.884 164.173 407.853 161.505C407.512 163.093 407.078 164.711 406.943 166.33C406.004 166.394 404.873 166.293 404.036 165.834C403.451 165.512 403.352 164.117 403.196 163.466L402.651 163.252C400.027 165.338 397.281 167.661 394.251 169.136C392.226 170.123 389.499 170.796 387.316 169.937C383.718 168.523 380.913 165.244 379.492 161.698C377.119 155.779 378.087 149.585 380.56 143.913C383.16 139.916 386.325 137.178 390.735 135.322L391.13 135.202C391.653 133.18 391.822 131.1 392.055 129.029Z" fill="#373296"/>
                                <path d="M392.054 129.029C393.995 129.348 395.963 130.254 397.899 130.732C404.591 132.386 411.918 132.551 418.576 130.666C420.91 130.005 422.986 128.641 425.261 128.011L425.662 127.922C425.874 130.332 425.859 133.082 426.404 135.422L426.616 139.069L426.472 141.019C425.976 145.528 423.603 149.742 419.972 152.477C415.645 155.738 410.56 156.535 405.338 155.708C400.596 154.957 396.3 152.081 393.555 148.172C391.377 145.069 390.435 141.095 391.11 137.347C391.183 136.579 390.978 136.044 390.734 135.322L391.129 135.203C391.652 133.18 391.821 131.1 392.054 129.029Z" fill="#F99B54"/>
                                <path d="M392.054 129.029C393.995 129.348 395.963 130.254 397.899 130.732C404.591 132.386 411.918 132.551 418.576 130.666C420.91 130.005 422.986 128.641 425.261 128.011L425.662 127.922C425.874 130.332 425.859 133.082 426.404 135.422L426.616 139.069C420.596 140.639 414.168 139.69 408.081 139.035L391.11 137.347C391.183 136.579 390.978 136.045 390.734 135.323L391.129 135.203C391.652 133.18 391.821 131.1 392.054 129.029Z" fill="#F86B7A"/>
                                <path d="M403.197 163.467C403.352 164.118 403.452 165.513 404.037 165.834C404.873 166.294 406.004 166.395 406.943 166.331L408.787 230.559C410.032 245.945 411.397 261.913 415.518 276.831C420.79 277.251 426.299 276.869 431.574 276.524C448.631 275.407 464.695 272.312 480.655 266.091L483.928 322.709L484.69 335.743C482.41 336.446 480.192 336.89 477.834 337.248L466.679 339.812C460.409 341.033 454.232 342.709 447.896 343.553C428.119 346.19 407.914 346.376 388.021 345.191C372.48 344.266 357.342 342.834 342.661 337.334C341.322 336.888 340.004 336.037 338.842 335.235C334.795 332.439 332.286 329.158 331.388 324.255C331.01 316.502 332.059 308.386 332.961 300.692L337.445 268.284C349.836 272.639 363.923 275.055 377.023 276.113C383.017 276.597 389.756 276.272 395.591 277.503C399.948 259.981 403.27 242.365 404.35 224.308C405.042 212.732 404.289 201.054 403.884 189.473L403.197 163.467Z" fill="url(#paint0_linear_513_338)"/>
                                <path d="M466.678 339.811L466.124 337.897C464.984 336.875 460.938 336.845 459.383 336.632C457.2 336.333 455.046 335.923 452.906 335.399C437.192 331.555 426.405 318.417 418.375 305.168C410.589 292.318 409.559 275.574 408.462 260.91C408.284 258.535 407.423 254.787 408.063 252.563L408.221 252.069C407.764 251.082 407.942 250.092 407.753 249.052C407.504 247.693 407.613 246.404 407.456 245.06C407.134 242.319 406.751 239.135 407.23 236.384C407.632 234.08 407.243 231.718 407.679 229.487C407.838 228.675 407.883 227.881 407.935 227.056C408.231 227.318 408.045 229.626 408.115 230.212L408.786 230.558C410.031 245.944 411.396 261.912 415.517 276.83C419.225 291.544 426.792 308.753 440.302 316.958C451.706 323.883 466.555 327.21 479.68 323.957L483.927 322.709L484.689 335.743C482.41 336.445 480.191 336.889 477.834 337.247L466.678 339.811Z" fill="#881346"/>
                                <path d="M337.445 268.283C349.836 272.638 363.923 275.055 377.022 276.112C383.016 276.596 389.755 276.272 395.591 277.503C389.451 295.828 382.002 313.09 363.696 322.228C359.544 324.3 355.307 325.571 350.716 326.217C344.688 327.065 337.792 325.961 332.036 324.018L331.388 324.254C331.01 316.502 332.059 308.386 332.961 300.692L337.445 268.283Z" fill="#E2424F"/>
                                <path d="M466.678 339.812L477.833 337.248L478.081 347.342L486.126 517.864L487.627 582.656L478.56 583.768L461.837 585.147C459.21 585.334 455.986 585.173 453.457 585.804L453.623 597.476C453.646 599.017 453.936 600.947 453.741 602.445C450.633 604.603 450.072 607.651 449.436 611.186L448.297 622.262L366.606 620.849L365.125 608.134C364.625 605.76 364.037 603.913 361.957 602.535C361.52 601.615 362.085 599.727 362.223 598.65L363.766 586.723L338.793 584.737L332.696 584.139C331.621 583.994 330.818 584.089 330.004 583.348L336.601 417.859C337.813 412.096 337.041 405.585 337.938 399.675L341.822 348.313L342.66 337.334C357.34 342.834 372.479 344.267 388.02 345.192C407.913 346.376 428.118 346.19 447.895 343.554C454.231 342.709 460.408 341.033 466.678 339.812Z" fill="#263238"/>
                                <path d="M466.677 339.812L477.833 337.248L478.08 347.342L486.126 517.864L487.626 582.656L478.559 583.768L461.837 585.147C459.21 585.334 455.985 585.173 453.456 585.804L445.988 586.166L444.535 579.386C446.065 578.688 447.955 578.468 449.586 577.916C455.088 576.055 460.967 572.678 464.164 567.673C467.601 562.293 469.854 556.409 471.113 550.141C474.604 532.755 474.254 514.558 473.833 496.908L467.391 403.977L463.591 353.881C440.84 360.08 415.429 359.605 392.052 358.165C394.435 367.58 398.806 376.107 402.224 385.145C404.94 392.329 406.782 400.129 408.275 407.657L402.703 450.053C397.525 483.693 390.543 516.731 381.842 549.63C378.576 561.98 375.582 574.833 371.24 586.846L363.765 586.722L338.792 584.736L332.695 584.139C332.974 582.933 332.9 582.405 333.986 581.652C337.62 579.132 340.891 576.281 343.991 573.115C349.707 567.276 354.243 559.626 358.122 552.482C376.806 518.064 385.818 478.574 392.078 440.206C393.849 429.353 396.039 417.86 396.082 406.851C396.12 397.4 392.835 388.365 391.158 379.169C389.88 372.156 389.823 364.998 389.733 357.892C385.47 357.821 381.123 357.264 376.884 356.781C364.465 355.366 353.427 352.951 341.822 348.313L342.66 337.334C357.34 342.833 372.479 344.266 388.019 345.191C407.912 346.376 428.118 346.19 447.894 343.553C454.23 342.709 460.407 341.033 466.677 339.812Z" fill="#4E4E4E"/>
                                <path d="M478.082 347.342L486.128 517.864C484.253 516.022 483.978 510.964 483.436 508.38C479.63 490.25 477.752 472.002 475.46 453.651L465.225 353.492L477.742 349.016L478.082 347.342Z" fill="#263238"/>
                                <path d="M408.275 407.656C410.443 414.088 411.391 421.237 412.866 427.874L422.668 473.696L444.534 579.385L445.987 586.165L453.455 585.803L453.622 597.475C453.645 599.016 453.934 600.946 453.74 602.444C450.632 604.602 450.07 607.651 449.435 611.185L448.296 622.261L366.605 620.848L365.123 608.133C364.624 605.759 364.036 603.912 361.956 602.534C361.519 601.614 362.084 599.726 362.222 598.65L363.765 586.722L371.239 586.846C375.582 574.833 378.576 561.979 381.842 549.629C390.543 516.73 397.524 483.692 402.703 450.052L408.275 407.656Z" fill="white"/>
                                <path d="M341.823 348.312C353.427 352.951 364.465 355.366 376.885 356.781C381.123 357.264 385.47 357.821 389.733 357.892C389.824 364.998 389.881 372.156 391.159 379.169C392.835 388.365 396.12 397.4 396.083 406.851C396.039 417.86 393.849 429.353 392.079 440.206C385.818 478.574 376.806 518.064 358.122 552.482C354.244 559.626 349.708 567.276 343.991 573.115C340.892 576.281 337.62 579.132 333.987 581.652C332.901 582.405 332.975 582.933 332.696 584.139C331.621 583.994 330.818 584.089 330.004 583.348L336.601 417.858C337.813 412.096 337.041 405.584 337.938 399.675L341.823 348.312Z" fill="#263238"/>
                                <path d="M344.802 172.503C345.444 180.123 345.05 188.016 344.783 195.655C343.93 220.019 340.847 244.157 337.443 268.284L332.959 300.692C332.057 308.386 331.008 316.502 331.386 324.255C332.284 329.158 334.793 332.438 338.84 335.235C340.002 336.037 341.32 336.888 342.659 337.334L341.822 348.312L337.938 399.674L337.254 400.588L255.244 400.585L118.31 400.526L58.299 400.517L40.9654 400.512C37.8878 400.508 34.6034 400.759 31.5688 400.291L31.0738 400.208C27.3834 399.611 23.9455 398.085 21.1718 395.549C16.8221 391.573 13.7994 386.983 13.6267 380.922L13.6013 334.974L13.6923 249.349L13.7311 209.262C13.7326 202.805 13.1798 195.703 14.0131 189.302C14.5032 185.536 16.5084 181.733 19.1398 179.03C22.4098 175.671 26.7031 173.473 31.3502 172.891C34.4997 172.496 37.9223 172.72 41.1014 172.702L59.4101 172.63L122.99 172.642L344.802 172.503Z" fill="white"/>
                                <path class="theme-color" d="M53.9501 211.936L74.121 211.851C78.2288 211.856 82.7215 211.496 86.7764 211.997C87.9792 212.146 89.3239 212.542 90.3018 213.288C91.5738 214.258 92.4008 215.404 92.5431 217.015C92.7398 219.25 92.7906 221.686 91.2119 223.465C88.6461 226.356 82.8258 225.584 79.3024 225.699C78.7736 229.839 79.1889 234.492 79.1916 238.68L79.2185 265.554L79.1664 269.7C78.0939 271.27 76.6661 272.928 74.7116 273.368C72.1656 273.941 67.2047 273.8 65.0478 272.238C63.9853 271.468 63.1998 270.43 62.9417 269.127C62.4031 266.407 62.8317 262.924 62.8459 260.109L62.8628 237.925C62.8409 234.208 63.1518 230.105 62.511 226.445C59.6032 224.379 55.2254 226.718 51.9327 224.894C50.7623 224.246 49.967 223.254 49.6172 221.967L49.5192 221.575C48.9926 219.535 48.8254 216.335 49.9296 214.474C50.8958 212.844 52.2114 212.427 53.9501 211.936Z" fill="#460B0D"/>
                                <path class="theme-color" d="M264.025 212.659L265.865 212.476C268.398 212.354 270.857 212.758 272.762 214.557C275.591 217.229 274.504 226.572 274.496 230.461L274.954 229.743L280.485 221.622C282.145 219.1 283.891 215.882 286.218 213.949C287.093 213.222 288.318 212.819 289.43 212.625C291.728 212.224 294.481 212.505 296.379 213.943C297.827 215.04 299.031 216.806 299.202 218.641C299.508 221.937 296.949 224.87 295.167 227.44L287.506 238.137L297.393 256.311C298.651 258.714 300.483 261.508 301.166 264.143C301.746 266.38 300.89 267.986 299.816 269.887L297.662 271.695C295.843 272.922 293.348 273.384 291.222 272.836C286.972 271.742 284.61 265.651 282.767 262.082L277.451 252.068C276.851 252.704 274.719 254.517 274.496 255.202C274.251 255.953 274.508 257.882 274.511 258.735L274.47 268.363C273.517 270.097 272.425 271.794 270.638 272.779C268.551 273.928 265.792 274.039 263.573 273.204C261.571 272.452 260.025 271.425 259.249 269.367C258.252 266.728 258.62 263.199 258.606 260.397L258.589 245.371C258.586 236.614 258.068 227.505 258.647 218.786C258.716 217.761 258.949 216.678 259.416 215.758C260.356 213.91 262.189 213.302 264.025 212.659Z" fill="#460B0D"/>
                                <path class="theme-color" d="M134.115 211.982C135.704 211.857 137.442 211.913 138.961 212.435C140.792 213.063 142.368 214.373 143.182 216.133C143.669 217.187 144.019 218.471 144.063 219.635L144.045 253.453L144.025 263.242C144.024 264.975 144.263 267.172 143.601 268.792L143.433 269.167C143.088 269.954 142.759 270.677 142.169 271.317C140.476 273.15 138.647 273.46 136.248 273.531C133.408 273.617 130.057 273.608 127.955 271.351C125.924 269.17 126.452 265.544 126.447 262.794L126.474 251.367L116.301 251.367L116.265 262.835C116.254 264.778 116.466 267.183 115.861 269.034C115.526 270.062 114.859 271.056 114.089 271.806C111.711 274.124 108.37 273.684 105.335 273.551C104.174 273.227 102.989 272.931 102.035 272.156C100.282 270.731 99.6884 268.867 99.5015 266.694C99.2012 263.193 99.3719 259.545 99.3782 256.029L99.4424 237.908L99.5094 225.306C99.5242 222.959 99.3592 220.39 99.6779 218.073C99.84 216.894 100.664 215.55 101.439 214.679C102.743 213.214 104.759 212.265 106.711 212.176C109.269 212.06 112.371 212.448 114.274 214.347C117.124 217.191 116.248 223.427 116.244 227.124L116.219 238.188L126.292 238.256L126.174 225.308C126.146 222.542 125.515 217.871 127.174 215.545C128.902 213.123 131.323 212.421 134.115 211.982Z" fill="#460B0D"/>
                                <path class="theme-color" d="M240.881 212.357C243.2 212.505 245.503 212.764 247.253 214.472C248.114 215.312 248.875 216.468 249.075 217.671C249.388 219.552 249.177 221.774 249.178 223.685L249.18 235.641L249.146 255.973C249.135 259.39 249.348 262.956 249.094 266.347C248.918 268.69 247.758 270.549 245.927 271.988C244.378 273.207 241.793 274.126 239.816 273.771C235.257 272.95 231.378 264.705 229.116 261.067L220.564 247.225L220.719 260.605C220.743 263.029 220.949 265.702 220.542 268.09C220.359 269.167 219.856 270.193 219.14 271.009C217.025 273.415 215.041 273.637 212.004 273.859L211.701 273.818C209.468 273.498 207.442 272.686 206.1 270.78C205.244 269.563 204.73 268.36 204.566 266.878C204.293 264.412 204.479 261.731 204.469 259.247L204.445 244.138L204.457 226.805C204.468 224.013 204.202 220.797 204.736 218.05C205.07 216.329 206.282 214.883 207.713 213.934C209.483 212.76 211.78 212.226 213.875 212.701C215.095 212.977 216.158 213.582 217.005 214.499C219.707 217.426 221.755 221.84 223.855 225.273L233.649 240.892L233.562 224.839C233.561 222.461 233.296 219.619 233.677 217.299C233.809 216.494 234.243 215.694 234.762 215.074C236.438 213.07 238.402 212.673 240.881 212.357Z" fill="#460B0D"/>
                                <path class="theme-color" d="M171.35 211.928L171.8 211.884C177.632 211.372 182.929 212.324 187.504 216.188C192.454 220.369 195.426 226.173 195.919 232.629C196.485 240.041 196.119 247.754 196.141 255.206C196.153 259.147 196.687 263.787 195.983 267.605C195.723 269.013 195.042 270.354 194.068 271.399C192.451 273.136 190.463 273.605 188.17 273.612C185.666 273.618 183.267 272.913 181.498 271.053C179.46 268.909 179.974 265.253 180.006 262.513C180.015 261.68 180.079 261.24 179.671 260.462L178.5 260.32L169.26 260.308L169.019 269.575C167.907 271.434 166.564 272.886 164.378 273.421C162.009 274.001 158.628 273.89 156.505 272.643C154.961 271.738 153.725 270.217 153.32 268.462C152.266 263.891 152.938 257.755 152.934 253.015L152.95 239.798C152.96 236.715 152.835 233.536 153.322 230.485C153.768 227.691 154.949 224.693 156.425 222.28C159.897 216.603 164.917 213.39 171.35 211.928Z" fill="#460B0D"/>
                                <path d="M173.625 225.322C175.21 225.501 176.654 225.543 177.839 226.751C180.292 229.25 179.702 233.758 179.708 236.977L179.708 248.511L175.085 248.49L169.241 248.501L169.228 235.227C169.231 233.09 168.988 230.374 169.913 228.407C170.733 226.668 171.871 225.966 173.625 225.322Z" fill="white"/>
                                <path d="M86.6037 293.798C88.8515 293.709 91.6084 293.553 93.7609 294.249C98.6951 295.843 100.967 303.309 102.92 307.653L106.985 316.174C109.493 311.818 111.257 306.906 113.488 302.379C114.644 300.033 115.831 297.385 117.937 295.741C120.691 293.588 124.454 293.408 127.784 293.897L128.374 293.989L129.715 294.23C132.078 294.897 134.148 296.994 135.236 299.134C135.72 300.086 136.003 301.447 135.765 302.495C135.338 304.386 134.025 306.443 133.13 308.159L128.255 317.601L120.844 332.802C119.631 335.174 117.683 337.651 116.942 340.172L116.861 340.469L116.804 358.127C116.803 361.16 117.495 367.135 115.865 369.772C114.745 371.583 112.932 373.283 110.747 373.596C107.642 374.04 101.512 374.348 98.9446 372.424C97.8171 371.578 96.7666 370.2 96.3555 368.843C95.5799 366.282 95.9035 362.925 95.8986 360.262L95.9043 345.37C95.9043 343.564 96.1532 341.301 95.7245 339.571C94.8601 336.081 92.4459 332.133 90.8481 328.858L82.6537 312.002C81.118 309.019 78.1461 304.93 77.9 301.602C77.7802 299.969 78.6242 298.252 79.6324 297.025C81.638 294.584 83.6157 294.059 86.6037 293.798Z" fill="#F86B7A"/>
                                <path d="M212.864 292.342C216.148 292.116 222.701 291.524 225.187 293.701C225.854 294.285 226.787 295.38 227.139 296.205C227.476 296.995 227.401 298.708 227.42 299.571L227.504 308.124C227.518 320.679 226.906 333.498 227.603 346.022C227.76 348.828 229.211 352.001 231.365 353.819C232.503 354.779 234.282 355.634 235.807 355.319C238.48 354.765 241.183 351.442 241.978 348.974C243.252 345.018 242.758 340.138 242.76 336.005L242.757 309C242.754 305.153 242.279 300.729 242.841 296.963C242.965 296.135 243.412 295.231 243.936 294.585C245.409 292.77 247.107 292.478 249.297 292.345C252.538 292.148 258.028 291.628 260.463 293.958C261.177 294.64 261.737 295.522 261.973 296.485C262.442 298.4 262.173 300.851 262.178 302.822L262.155 314.998L262.144 332.617C262.125 341.861 262.263 351.278 257.521 359.569C254.08 365.585 248.455 370.189 241.703 371.948C235.075 373.677 227.32 373.22 221.373 369.629C213.928 365.133 210.5 358.285 208.516 350.073C207.303 345.052 207.606 340.072 207.593 334.954L207.554 317.27C207.546 311.197 206.98 304.531 207.616 298.516C207.745 297.293 207.946 296.132 208.613 295.079C209.666 293.417 211.003 292.791 212.864 292.342Z" fill="#F86B7A"/>
                                <path d="M162.489 293.406C166.032 293.09 169.978 292.829 173.443 293.782C176.312 294.571 178.984 295.43 181.596 296.872C188.924 300.916 193.731 309.48 196.001 317.244C199.86 330.449 198.953 345.988 192.183 358.108C187.926 365.728 181.733 369.786 173.505 372.148C170.379 372.673 167.203 372.911 164.051 372.45L163.453 372.357C159.552 371.786 156.131 370.347 152.849 368.188C144.968 363.002 140.84 354.963 139.002 345.926C136.435 333.298 136.856 315.974 144.261 304.985C148.682 298.424 154.821 294.939 162.489 293.406Z" fill="#F86B7A"/>
                                <path d="M165.597 310.613C166.963 310.543 168.299 310.566 169.623 310.956C171.448 311.493 173.001 312.948 173.904 314.586C174.919 316.43 175.466 318.412 175.775 320.48C176.301 324.014 176 327.937 175.978 331.514C175.942 337.175 176.569 343.876 174.817 349.281C173.823 352.347 172.38 353.886 169.516 355.327C168.166 355.516 166.292 355.693 164.985 355.261C163.352 354.722 162.031 353.288 161.232 351.803C158.245 346.25 158.873 338.494 158.868 332.382C158.865 327.364 158.468 321.893 160.101 317.078C161.143 314.004 162.591 312.037 165.597 310.613Z" fill="white"/>
                                <defs>
                                <linearGradient id="paint0_linear_513_338" x1="444.036" y1="353.311" x2="345.685" y2="206.12" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#CE6A22"/>
                                <stop offset="1" stop-color="#8C0550"/>
                                </linearGradient>
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
