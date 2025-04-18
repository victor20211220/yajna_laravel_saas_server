@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme18">
@else
<div class="{{ $business->theme_color }}" id="view_theme18">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="influencer-card">
                <section class="profile-sec pb">
                    <div class="profile-banner img-wrapper">
                        <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme8/images/profile-banner-img.png') }}" alt="profile-banner-img" id="banner_preview" loading="lazy">

                        <div class="profile-banner-bg">
                            <svg width="576" height="136" viewBox="0 0 576 136" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M576 135.5V122C576 122 548 47.5 284.5 61.5C21 75.5 0 0 0 0V10.6777C0 10.6777 21 87.9238 284.5 73.6006C548 59.2764 576 135.5 576 135.5Z"
                                    fill="#B9C8F3" class="theme-color" />
                                <path
                                    d="M206 75.5C59.6 73.1 7.66667 31.5 0 11V135L576 135.5C542 69.5 355 69.5 317 72.5C286.6 74.9 230.333 75.5 206 75.5Z"
                                    fill="#222222" />
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <div class="client-info-wrp text-center">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme8/images/client-image.png') }}"   alt="client-image" loading="lazy">
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
                <section class="gallery-sec pb" id="gallery-div">
                    <div class="container">
                        <div class="section-title common-title">
                        <h2>{{__('Gallery')}}</h2>
                        </div>
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
                </section>
                @endif
                @if ($order_key == 'service')
                <section class="service-sec pb" id="services-div">
                    <div class="container">
                        <div class="section-title common-title">
                            <h2>{{ __('Services') }}</h2>
                        </div>
                        <div class="service-slider-wrp">
                            @if(isset($is_pdf))
                                @php $image_count = 0; @endphp
                                @foreach ($services_content as $k1 => $content)
                                    <div class="service-card  edit-card" id="services_{{ $service_row_nos }}">
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
                                                        class="btn btn-white">{{ $content->link_title }}
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
                                                        class="btn btn-white">{{ $content->link_title }}
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
                                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                        </svg>

                                </div>
                                <div class="slick-next slick-arrow service-arrow">
                                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                        </svg>

                                </div>
                            </div>
                            @endif
                        </div>
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
                <section class="contact-info-sec pb" id="contact-div">
                    <div class="container">
                        <div class="section-title common-title">
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
                                            <li id="contact_{{ $loop->parent->index + 1 }}" class="flex align-items-center justify-content-center">
                                                @if ($key1 == 'Address')
                                                    @foreach ($val1 as $key2 => $val2)
                                                        @if ($key2 == 'Address_url')
                                                            @php $href = $val2; @endphp
                                                        @endif
                                                    @endforeach
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme8/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                                                        <img src="{{ asset('custom/theme8/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
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
                @if ($order_key == 'appointment')
                <section class="appointment-sec light-bg-section pt pb mb" id="appointment-div">
                    <div class="container">
                        <div class="section-title common-title">
                            <h2>{{__('Appointment')}}</h2>
                        </div>
                    </div>
                    <div class="appointment-form-wrp">
                        <div class="container">
                            <form class="appointment-form">
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
                            <h2>{{__('More')}}</h2>
                        </div>
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}" class="save-info d-flex align-items-center justify-content-center">
                                    <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.7867 0.318213C5.92135 0.0780268 7.2727 0 8.83546 0H11.0998C12.5039 0 13.8151 0.6684 14.5939 1.7812L15.7312 3.40627C15.9909 3.77717 16.4279 4 16.896 4H23.9725C26.2086 4 28.0211 5.68153 27.9998 7.84693C27.9743 10.4256 27.9958 13.0052 27.9958 15.584C27.9958 17.0725 27.9139 18.3597 27.6616 19.4405C27.406 20.5365 26.957 21.5001 26.1641 22.2553C25.3713 23.0105 24.3597 23.4383 23.209 23.6817C22.0744 23.922 20.723 24 19.1603 24H8.83546C7.2727 24 5.92135 23.922 4.7867 23.6817C3.63615 23.4383 2.62443 23.0105 1.83159 22.2553C1.03877 21.5001 0.589773 20.5365 0.334074 19.4405C0.0819157 18.3597 0 17.0725 0 15.584V8.416C0 6.92743 0.0819157 5.64024 0.334074 4.55945C0.589773 3.46352 1.03877 2.49984 1.83159 1.74464C2.62443 0.989453 3.63615 0.561773 4.7867 0.318213ZM15.3977 10.6667C15.3977 9.93027 14.771 9.33333 13.9979 9.33333C13.2248 9.33333 12.5981 9.93027 12.5981 10.6667V14.7811L11.4882 13.7239C10.9416 13.2032 10.0553 13.2032 9.50861 13.7239C8.96196 14.2445 8.96196 15.0888 9.50861 15.6095L12.9206 18.8595C12.9356 18.8737 12.9508 18.8877 12.9664 18.9013C13.2223 19.1668 13.5896 19.3333 13.9979 19.3333C14.4062 19.3333 14.7735 19.1668 15.0294 18.9013C15.0449 18.8877 15.0602 18.8737 15.0752 18.8595L18.4871 15.6095C19.0338 15.0888 19.0338 14.2445 18.4871 13.7239C17.9405 13.2032 17.0542 13.2032 16.5076 13.7239L15.3977 14.7811V10.6667Z" fill="#B9C8F3"/>
                                    </svg>
                                    <h3>{{__('Save')}}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="share-info d-flex align-items-center justify-content-center">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.68161 14.3394L13.9018 9.11828C14.2464 8.77363 14.8067 8.77363 15.1514 9.11828C15.496 9.46382 15.496 10.0232 15.1514 10.3688L9.9312 15.589L14.0291 23.3295C14.3596 23.9543 15.0321 24.322 15.7364 24.2636C16.4416 24.2053 17.0443 23.7325 17.2679 23.0609C18.8233 18.3957 22.7241 6.69245 24.1796 2.32683C24.3908 1.69143 24.2255 0.99152 23.7527 0.517842C23.279 0.0441633 22.5791 -0.121095 21.9437 0.0909994L1.20881 7.00264C0.538056 7.22622 0.0652546 7.82805 0.00604476 8.53327C-0.0522813 9.23848 0.315362 9.91012 0.941042 10.2415L8.68161 14.3394Z" fill="#B9C8F3"/>
                                    </svg>
                                    <h3>{{__('Share')}}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.9837 9.3855V9.38563C18.9837 9.4479 18.9714 9.50956 18.9476 9.56709C18.9238 9.62462 18.8889 9.6769 18.8448 9.72092C18.8008 9.76495 18.7485 9.79988 18.691 9.8237C18.6335 9.84752 18.5718 9.85977 18.5095 9.85976H18.5093C18.447 9.85977 18.3854 9.84752 18.3278 9.8237C18.2703 9.79988 18.218 9.76495 18.174 9.72092C18.13 9.6769 18.095 9.62462 18.0712 9.56709C18.0474 9.50956 18.0351 9.4479 18.0352 9.38563V9.3855V1.59144C18.0352 1.46566 18.0851 1.34503 18.1741 1.25609C18.263 1.16715 18.3836 1.11719 18.5094 1.11719C18.6352 1.11719 18.7558 1.16715 18.8448 1.25609C18.9337 1.34503 18.9837 1.46566 18.9837 1.59144V9.3855Z" stroke="#B9C8F3" class="theme-color-stroke"/>
                                        <path d="M15.0891 7.43769V7.43782C15.0892 7.50009 15.0769 7.56175 15.0531 7.61928L15.515 7.81056L15.0531 7.61928C15.0293 7.67681 14.9943 7.72909 14.9503 7.77312C14.9063 7.81715 14.854 7.85207 14.7965 7.87589C14.7389 7.89971 14.6773 7.91196 14.615 7.91195H14.6148C14.5525 7.91196 14.4908 7.89971 14.4333 7.87589C14.3758 7.85207 14.3235 7.81715 14.2795 7.77312C14.2354 7.72909 14.2005 7.67681 14.1767 7.61928L13.7174 7.80945L14.1767 7.61928C14.1529 7.56175 14.1406 7.50009 14.1406 7.43782V7.43769V3.54066C14.1406 3.41488 14.1906 3.29425 14.2795 3.20531C14.3685 3.11637 14.4891 3.06641 14.6149 3.06641C14.7407 3.06641 14.8613 3.11637 14.9502 3.20531C15.0392 3.29425 15.0891 3.41488 15.0891 3.54066V7.43769Z" stroke="#B9C8F3" class="theme-color-stroke"/>
                                        <path d="M22.8821 6.46379V6.46392C22.8821 6.52618 22.8699 6.58784 22.846 6.64538C22.8222 6.70291 22.7873 6.75518 22.7433 6.79921C22.6992 6.84324 22.647 6.87816 22.5894 6.90199C22.5319 6.92581 22.4702 6.93806 22.408 6.93804H22.4077C22.3455 6.93806 22.2838 6.92581 22.2263 6.90199C22.1687 6.87816 22.1165 6.84324 22.0724 6.79921C22.0284 6.75518 21.9935 6.70291 21.9697 6.64538C21.9458 6.58784 21.9336 6.52618 21.9336 6.46392V6.46379V4.51527C21.9336 4.38949 21.9836 4.26886 22.0725 4.17992C22.1614 4.09098 22.2821 4.04102 22.4079 4.04102C22.5336 4.04102 22.6543 4.09098 22.7432 4.17992C22.8321 4.26886 22.8821 4.38949 22.8821 4.51527V6.46379Z" stroke="#B9C8F3" class="theme-color-stroke"/>
                                        <path d="M23.7146 18.7675L19.7595 14.8124C19.6224 14.6754 19.4477 14.5823 19.2575 14.5451C19.0673 14.508 18.8703 14.5283 18.6918 14.6037L14.5282 16.3608L7.63915 9.47182L9.39626 5.30827C9.47162 5.12971 9.49201 4.93274 9.45484 4.74253C9.41766 4.55232 9.32459 4.37752 9.18754 4.24048L5.23242 0.285371C5.14195 0.194898 5.03455 0.12313 4.91634 0.0741659C4.79813 0.0252018 4.67144 0 4.5435 0C4.41555 0 4.28886 0.0252018 4.17065 0.0741659C4.05245 0.12313 3.94504 0.194898 3.85457 0.285371L1.15366 2.98631C-1.93852 6.07856 1.58733 11.6658 6.96079 17.0392C12.3342 22.4127 17.9215 25.9385 21.0138 22.8463L23.7147 20.1454C23.8974 19.9627 24 19.7148 24 19.4564C24 19.1981 23.8973 18.9502 23.7146 18.7675Z" fill="#B9C8F3"/>
                                    </svg>
                                    <h3>{{__('Contact')}}</h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif
                @if ($order_key == 'testimonials')
                <section class="testimonial-sec light-bg-section pt pb" id="testimonials-div">
                    <div class="container">
                        <div class="section-title common-title">
                        <h2>{{ __('Testimonials') }}</h2>
                        </div>
                    </div>
                    <div class="testimonial-slider-wrp">
                        <div class="container">
                            @if(isset($is_pdf))
                                @php
                                $t_image_count = 0;
                                $rating = 0;
                                @endphp
                                @foreach ($testimonials_content as $k2 => $testi_content)
                                    <div class="testimonial-card" id="testimonials_{{ $testimonials_row_nos }}" >
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-image-wrp">
                                                <div class="testimonial-image">
                                                    <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
                                                </div>
                                            </div>
                                            <div class="testimonial-content">
                                                <div class="testimonial-content-top">
                                                    <div class="rating d-flex align-items-center ">
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
                                                        <span class="total-rat">{{ $testi_content->rating }}.0  rating</span>
                                                    </div>
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
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
                                    <div class="testimonial-card" id="testimonials_{{ $testimonials_row_nos }}" >
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-image-wrp">
                                                <div class="testimonial-image">
                                                    <img id="{{ 't_image' . $t_image_count . '_preview' }}"
                                                    src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}"
                                                    alt="testimonial image" loading="lazy">
                                                </div>
                                            </div>
                                            <div class="testimonial-content">
                                                <div class="testimonial-content-top">
                                                    <div class="rating d-flex align-items-center ">
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
                                                        <span class="total-rat">{{ $testi_content->rating }}.0  rating</span>
                                                    </div>
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}"> {{ $testi_content->description }} </p>
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
                            <div class="arrow-wrapper">
                                <div class="slick-prev slick-arrow testimonial-arrow">
                                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                        </svg>

                                </div>
                                <div class="slick-next slick-arrow testimonial-arrow">
                                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/>
                                        </svg>

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
                            <div class="arrow-wrapper">
                                <div class="slick-prev slick-arrow social-link-arrow">
                                    <svg width="16" height="26" viewBox="0 0 16 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.89144 25.7391L16 12.8696L2.89144 0L0 2.83873L10.2171 12.8696L0 22.9004L2.89144 25.7391Z"
                                            fill="#222222" />
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow social-link-arrow">
                                    <svg width="16" height="26" viewBox="0 0 16 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.89144 25.7391L16 12.8696L2.89144 0L0 2.83873L10.2171 12.8696L0 22.9004L2.89144 25.7391Z"
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
                    <div class="payment-list-wrp">
                        <div class="payment-list">
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
                        </div>
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
                <section class="download-sec light-bg-section pt pb" id="app-section">
                    <div class="container">
                        <div class="section-title common-title">
                            <h2>{{ __('Download Here') }}</h2>
                        </div>
                    </div>
                    <div class="download-list-wrp">
                            @if (!is_null($appInfo))
                            <div class="container">
                                <ul class="d-flex">
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
                            <svg width="248" height="295" viewBox="0 0 248 295" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.78125 129.421L118.141 30.8508C119.802 29.4934 121.881 28.752 124.026 28.752C126.171 28.752 128.25 29.4934 129.911 30.8508L247.241 129.421H0.78125Z" fill="#B9C8F3" class="theme-color"/>
                                <path d="M247.281 129.42H0.78125V294.53H247.281V129.42Z" fill="#B9C8F3" class="theme-color"/>
                                <g opacity="0.3">
                                <path d="M17.7617 129.419L120.542 43.0992C121.527 42.2863 122.764 41.8418 124.042 41.8418C125.319 41.8418 126.556 42.2863 127.542 43.0992L230.322 129.419H17.7617Z" fill="black"/>
                                </g>
                                <g opacity="0.3">
                                <path d="M0.78125 129.42L116.781 213.16C118.934 214.619 121.475 215.4 124.076 215.4C126.677 215.4 129.218 214.619 131.371 213.16L247.241 129.42H0.78125Z" fill="black"/>
                                </g>
                                <path d="M131.32 213.16L131.86 212.75L133.45 211.58L139.67 207.03L163.24 189.88L247.1 129.12L247.23 129.53H123.36H0.670002L0.800003 129.12L84.91 190.99L108.61 208.46L114.85 213.1L116.45 214.29C116.81 214.56 116.99 214.71 116.99 214.71L116.43 214.32L114.81 213.15L108.52 208.58L84.75 191.21L0.570004 129.49L0 129.07H0.710003H123.4H247.27H247.99L247.41 129.49L163.41 190.1L139.73 207.15L133.49 211.66L131.88 212.8L131.32 213.16Z" fill="#263238"/>
                                <path d="M241.212 0.289062H14.9219V261.579H241.212V0.289062Z" fill="white"/>
                                <path d="M241.239 261.58C241.239 259.58 241.149 156.1 241.009 0.290001L241.239 0.520004H14.9691L15.2291 0.260002C15.2291 96.64 15.2291 186.49 15.2291 261.54L15.0091 261.33L241.299 261.55L15.0091 261.76H14.7891V261.54C14.7891 186.49 14.7891 96.64 14.7891 0.260002V0H15.0691H241.339H241.569V0.230003C241.299 156.1 241.239 259.58 241.239 261.58Z" fill="#263238"/>
                                <g opacity="0.2">
                                <path d="M193.461 23.1991C185.211 11.6991 168.021 9.08907 155.181 15.0191C142.341 20.9491 133.641 33.6591 129.331 47.1491C125.021 60.6391 124.501 74.9691 124.031 89.1491C123.551 75.0091 123.031 60.6591 118.721 47.1491C114.411 33.6391 105.721 20.9491 92.8706 15.0191C80.0206 9.08907 62.8706 11.6991 54.5906 23.1991C47.0106 33.7591 48.4906 48.1991 51.0206 60.8991C61.8406 115.309 94.5606 175.049 123.401 222.479V223.129C152.241 175.659 186.241 115.389 197.031 60.8991C199.561 48.1491 201.041 33.7591 193.461 23.1991Z" fill="#B9C8F3" class="theme-color"/>
                                </g>
                                <path d="M131.32 213.16C129.168 214.619 126.626 215.4 124.025 215.4C121.424 215.4 118.883 214.619 116.73 213.16L0.730469 129.42V294.53H247.24V129.42L131.32 213.16Z" fill="#B9C8F3" class="theme-color"/>
                                <path d="M0.78125 294.53L117.031 214.71C119.097 213.311 121.536 212.562 124.031 212.562C126.527 212.562 128.965 213.311 131.031 214.71L247.241 294.53" fill="#B9C8F3" class="theme-color"/>
                                <path d="M247.241 294.529L246.601 294.109L244.731 292.859L237.571 288.009L211.301 270.069L172.371 243.409L149.371 227.649L137.241 219.309L131.031 215.039C128.969 213.601 126.515 212.83 124.001 212.83C121.487 212.83 119.033 213.601 116.971 215.039L110.761 219.299L98.6312 227.659L75.6312 243.429L36.7213 270.069L10.4512 288.009L3.29125 292.859L1.42125 294.109L0.78125 294.529C0.78125 294.529 0.981251 294.359 1.39125 294.069L3.24125 292.779L10.3412 287.839L36.5212 269.769L75.3913 243.009L98.3912 227.219L110.541 218.879C112.595 217.459 114.665 216.036 116.751 214.609C118.896 213.106 121.452 212.299 124.071 212.299C126.691 212.299 129.247 213.106 131.391 214.609L137.601 218.879L149.751 227.229L172.751 243.009L211.611 269.759L237.791 287.839L244.901 292.779L246.741 294.069C247.071 294.359 247.241 294.529 247.241 294.529Z" fill="#263238"/>
                                <path d="M83.8831 108.15H75.7031V56.1504H83.8831V78.4504H93.1731V56.1504H101.503V108.15H93.1731V85.8504H83.8831V108.15Z" fill="#263238"/>
                                <path d="M147.103 115.199V156.419C147.103 160.229 148.773 161.609 151.453 161.609C154.133 161.609 155.803 160.229 155.803 156.419V115.199H163.733V155.879C163.733 164.429 159.463 169.319 151.223 169.319C142.983 169.319 138.703 164.429 138.703 155.879V115.199H147.103Z" fill="#263238"/>
                                <path d="M133.241 103.889H124.661L123.201 94.0793H112.721L111.241 103.889H103.441L112.101 49.7793H124.551L133.241 103.889ZM113.841 86.7293H122.041L117.941 59.3693L113.841 86.7293Z" fill="#263238"/>
                                <path d="M144.852 68.9591V108.149H137.242V54.0391H147.912L156.642 86.4291V54.0391H164.222V108.149H155.442L144.852 68.9591Z" fill="#263238"/>
                                <path d="M183.1 75.6598L181.36 80.7398L183.88 96.4798L175.88 97.7698L167.68 46.5198L175.73 45.2298L179.24 67.5598L186.24 43.5598L194.24 42.2598L186.7 66.8898L202.45 93.4998L194.24 94.8298L183.1 75.6598Z" fill="#263238"/>
                                <path d="M108.109 137.661C108.109 129.001 112.669 124.051 121.019 124.051C129.369 124.051 133.929 129.001 133.929 137.661V165.791C133.929 174.451 129.369 179.401 121.019 179.401C112.669 179.401 108.109 174.401 108.109 165.791V137.661ZM116.609 166.341C116.609 170.201 118.309 171.671 121.019 171.671C123.729 171.671 125.419 170.201 125.419 166.341V137.101C125.419 133.231 123.719 131.761 121.019 131.761C118.319 131.761 116.609 133.231 116.609 137.101V166.341Z" fill="#263238"/>
                                <path d="M89.0525 150.66L78.3125 114.48H87.2425L93.7325 139.14L100.222 114.48H108.343L97.5625 150.66V168.66H89.0525V150.66Z" fill="#263238"/>
                                <path d="M49.5938 41.8105H75.9038V49.5506H67.0038V95.9706H58.4938V49.5506H49.5938V41.8105Z" fill="#263238"/>
                                <path d="M181.333 146.54L179.863 153.39L173.023 151.91L174.493 145.07L181.333 146.54ZM175.943 142.07L178.563 125.53L182.623 106.66L189.723 108.19L185.663 127.05L181.243 143.21L175.943 142.07Z" fill="#263238"/>
                                <path d="M67.6136 111.91C65.0136 109.91 61.0136 110.46 58.5536 112.63C57.3747 113.779 56.4449 115.159 55.8221 116.683C55.1993 118.207 54.8969 119.843 54.9336 121.49C55.0167 124.778 55.5552 128.039 56.5336 131.18C55.622 128.009 54.2759 124.981 52.5336 122.18C50.6736 119.47 47.8936 117.18 44.6436 116.74C41.3936 116.3 37.7436 118 36.6436 121.1C35.6436 123.96 36.9336 127.1 38.3436 129.73C44.3436 141.12 55.6136 152.25 65.1836 160.89V161.03C68.4636 148.55 72.0036 132.89 70.8036 120.03C70.6336 117.05 70.0036 113.75 67.6136 111.91Z" fill="#B9C8F3" class="theme-color"/>
                                <path d="M227.473 124.13C227.343 122.938 226.806 121.828 225.951 120.987C225.096 120.147 223.976 119.628 222.783 119.52C221.568 119.457 220.354 119.641 219.213 120.06C218.071 120.48 217.027 121.126 216.142 121.96C214.356 123.654 212.802 125.577 211.522 127.68C212.847 125.606 213.893 123.367 214.633 121.02C214.989 119.865 215.109 118.649 214.985 117.447C214.861 116.244 214.497 115.079 213.913 114.02C213.291 112.995 212.334 112.217 211.204 111.818C210.073 111.419 208.84 111.423 207.712 111.83C205.662 112.71 204.552 114.97 203.712 117.07C200.242 126.07 199.392 137.78 199.122 147.34L199.062 147.44C207.542 143 217.922 137.12 224.482 130.05C226.042 128.35 227.583 126.36 227.473 124.13Z" fill="#B9C8F3" class="theme-color"/>
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
