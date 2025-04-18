@extends('card.layouts')
@section('contentCard')
@if($themeName)
<div class="{{ $themeName }}" id="view_theme11">
@else
<div class="{{ $business->theme_color }}" id="view_theme11">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="modal-card">
                <section class="profile-sec pb">
                    <div class="profile-banner">
                        <div class="banner-image img-wrapper">
                            <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme11/images/profile-banner.png') }}" alt="profile-banner-img" id="banner_preview"  class="profile-banner-img" loading="lazy">
                        </div>
                    </div>
                    <div class="client-info-wrp d-flex align-items-center">
                        <div class="client-image">
                            <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme11/images/client-image.png') }}"   alt="client-image" loading="lazy">
                        </div>
                        <div class="client-info">
                            <h2 id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</h2>
                            <span id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</span>
                            <p id="{{ $stringid . '_designation' }}_preview">{{ $business->designation }}</p>

                        </div>
                    </div>
                    <div class="container">
                        <div class="profile-content text-center">
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
                @if ($order_key == 'bussiness_hour')
                <section class="business-hour-sec" id="business-hours-div">
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
                </section>
                @endif
                @if ($order_key == 'contact_info')
                <section class="contact-info-sec mb" id="contact-div">
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
                                            } elseif ($key1 == 'Email') {
                                                $href = 'mailto:' . $val1;
                                            }else {
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
                                                        <img src="{{ asset('custom/theme11/icon/' . $color . '/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                        <a href="{{ $href }}" target="_blank" class="contact-item">
                                                            @foreach ($val1 as $key2 => $val2)
                                                                @if ($key2 == 'Address')
                                                                    <span id="{{ $key1 . '_' . $nos }}_preview">
                                                                        {{ $val2 }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                @else
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme11/icon/' . $color . '/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                        @if ($key1 == 'Whatsapp')
                                                            <a href="https://wa.me/{{ $href }}" target="_blank" class="contact-item">
                                                        @else
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
                        @endif
                    </div>
                </section>
                @endif
                @if ($order_key == 'appointment')
                <section class="appointment-sec pb" id="appointment-div">
                    <div class="section-title common-title text-center">
                        <h2>{{__('Appointment')}}</h2>
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
                                <a href="{{ route('bussiness.save', $business->slug) }}"
                                    class="save-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.545 5.28945C14.5941 5.02654 14.6189 4.75968 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C8.22526 0.00227634 6.53772 1.18703 5.89324 2.96474C4.73932 2.5054 3.4315 3.06844 2.97212 4.22236C2.93236 4.32224 2.89981 4.42482 2.87475 4.52935C1.03224 4.8049 -0.237997 6.52193 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7395 6.87066 15.3023 5.92967 14.545 5.28945Z" fill="#111111"/>
                                        <path d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659L8.99889 13.8173V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V13.8173L6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z" fill="#111111"/>
                                    </svg>
                                    <span>{{__('Save')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="share-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.28377 9.4228C6.04018 9.32536 5.89402 9.03304 5.99146 8.78945C7.30688 5.28165 10.3275 2.74824 13.9814 2.11489L11.8865 0.945621C11.6429 0.799463 11.5455 0.507147 11.6916 0.26355C11.8378 0.0199526 12.1301 -0.0774863 12.3737 0.0686719L15.5405 1.82257C15.7841 1.96873 15.8815 2.26105 15.7353 2.50464L14.0302 5.57397C13.9327 5.72012 13.7866 5.81756 13.5917 5.81756C13.4942 5.81756 13.3968 5.81756 13.3481 5.76884C13.1045 5.62268 13.0071 5.33037 13.1532 5.08677L14.3225 3.04056C10.9608 3.57647 8.13511 5.915 6.91713 9.08176C6.81969 9.27664 6.62481 9.4228 6.42993 9.4228H6.28377ZM14.8107 7.9125C14.8107 7.62019 15.0056 7.42531 15.2979 7.42531C15.5902 7.42531 15.7851 7.66891 15.7851 7.9125V11.7126C15.7851 14.0999 13.885 15.9999 11.4978 15.9999H4.2873C1.94877 15.9999 -3.22908e-06 14.0999 -3.22908e-06 11.7126V4.50214C-3.22908e-06 2.16361 1.90005 0.214836 4.2873 0.214836H7.94126C8.23358 0.214836 8.42846 0.409714 8.42846 0.70203C8.42846 0.994347 8.23358 1.18922 7.94126 1.18922H4.2873C2.48469 1.18922 0.974385 2.65081 0.974385 4.50214V11.7126C0.974385 13.564 2.43597 15.0255 4.2873 15.0255H11.4978C13.3004 15.0255 14.8107 13.564 14.8107 11.7126V7.9125Z" fill="#111111"/>
                                    </svg>
                                    <span>{{__('Share')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M13.4595 2.09597C12.1078 0.744271 10.3106 -7.56008e-05 8.39908 5.7592e-09C8.08584 5.7592e-09 7.83203 0.253887 7.83203 0.567049C7.83203 0.880212 8.08592 1.1341 8.39908 1.1341C10.0077 1.13402 11.52 1.76042 12.6575 2.89792C13.7951 4.03543 14.4215 5.54786 14.4214 7.15654C14.4214 7.4697 14.6753 7.72359 14.9885 7.72359C15.3017 7.72359 15.5555 7.4697 15.5555 7.15662C15.5556 5.2449 14.8113 3.44766 13.4595 2.09597Z" fill="#111111"/>
                                        <path d="M11.1269 7.15651C11.1269 7.46967 11.3808 7.72356 11.694 7.72348C12.0072 7.72348 12.261 7.4696 12.261 7.15643C12.2608 5.02735 10.5284 3.29498 8.39916 3.29468C8.39908 3.29468 8.39923 3.29468 8.39916 3.29468C8.08599 3.29468 7.83211 3.54849 7.83203 3.86165C7.83203 4.17481 8.08584 4.4287 8.399 4.42878C9.90305 4.429 11.1267 5.65262 11.1269 7.15651Z" fill="#111111"/>
                                        <path d="M9.87051 10.0477C9.00618 10.0029 8.56585 10.6457 8.35468 10.9545C8.17783 11.213 8.24406 11.5659 8.50256 11.7427C8.76106 11.9195 9.11392 11.8533 9.29076 11.5948C9.54026 11.23 9.6533 11.1726 9.80663 11.1799C10.2974 11.2376 12.2303 12.654 12.4238 13.0969C12.4724 13.2273 12.4705 13.3552 12.4185 13.5107C12.2155 14.113 11.8796 14.5362 11.4468 14.7346C11.0357 14.9231 10.5316 14.906 9.98944 14.6854C7.96492 13.8602 6.19619 12.7086 4.73244 11.2626C4.73184 11.262 4.73123 11.2615 4.7307 11.2609C3.28768 9.79855 2.13823 8.03207 1.31442 6.01066C1.09372 5.46803 1.07664 4.96388 1.26512 4.55281C1.46352 4.12004 1.88676 3.78412 2.48851 3.58142C2.64457 3.5291 2.77219 3.52744 2.9014 3.57552C3.34589 3.76975 4.76223 5.70256 4.81939 6.1878C4.82756 6.34688 4.76972 6.45984 4.40522 6.70888C4.14664 6.8855 4.08018 7.23836 4.25688 7.49693C4.43349 7.75551 4.78627 7.82189 5.04492 7.64527C5.35385 7.43433 5.99651 6.99521 5.9519 6.12792C5.90276 5.22201 4.14052 2.82293 3.29849 2.51332C2.92401 2.37375 2.5301 2.37134 2.12727 2.50652C1.22089 2.81174 0.566293 3.35596 0.234229 4.08027C-0.0878549 4.78296 -0.077648 5.59822 0.264094 6.43836C1.14574 8.60162 2.37926 10.4944 3.93033 12.0644C3.93411 12.0683 3.93797 12.072 3.9419 12.0757C5.51074 13.6239 7.40135 14.8552 9.56174 15.7358C9.99436 15.9117 10.4204 15.9998 10.8278 15.9998C11.2115 15.9998 11.5788 15.9218 11.9195 15.7656C12.6438 15.4336 13.188 14.7791 13.4934 13.8721C13.6283 13.47 13.6261 13.0762 13.4876 12.7035C13.1769 11.8592 10.7779 10.097 9.87051 10.0477Z" fill="#111111"/>
                                    </svg>
                                    <span>{{__('Contact')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif
                @if ($order_key == 'gallery')
                <section class="gallery-sec mb" id="gallery-div">
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
                    <div class="container">
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
                    </div>
                    @endif
                </section>
                @endif
                @if ($order_key == 'testimonials')
                <section class="testimonial-sec pb" id="testimonials-div">
                    <div class="section-title common-title text-center">
                        <h2>{{ __('Testimonials') }}</h2>
                    </div>
                    <div class="testimonial-wrp">
                        @if(isset($is_pdf))
                            @php
                            $t_image_count = 0;
                            $rating = 0;
                            @endphp
                            @foreach ($testimonials_content as $k2 => $testi_content)
                                <div class="testimonial-card"  id="testimonials_{{ $testimonials_row_nos }}">
                                    <div class="testimonial-card-inner">
                                        <div class="testimonial-image">
                                            <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' .$testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
                                        </div>
                                        <div class="testimonial-content">
                                            <div class="testimonial-content-top">
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
                                                <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                    {{ $testi_content->description }} </p>
                                            </div>
                                            <div class="testimonial-content-bottom">
                                                <span  id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                </span>
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
                            <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                @php
                                    $t_image_count = 0;
                                    $rating = 0;
                                @endphp
                                @foreach ($testimonials_content as $k2 => $testi_content)
                                    <div class="testimonial-card"  id="testimonials_{{ $testimonials_row_nos }}">
                                        <div class="testimonial-card-inner">
                                            <div class="testimonial-image">
                                                <img id="{{ 't_image' . $t_image_count . '_preview' }}" src="{{ isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' .$testi_content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="image">
                                            </div>
                                            <div class="testimonial-content">
                                                <div class="testimonial-content-top">
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
                                                    <p id="{{ 'testimonial_description_' . $testimonials_row_nos . '_preview' }}">
                                                        {{ $testi_content->description }} </p>
                                                </div>
                                                <div class="testimonial-content-bottom">
                                                    <span  id="{{ 'testimonial_name_' . $testimonials_row_nos . '_preview' }}">
                                                    {{ isset($testi_content->name) ? $testi_content->name : '' }}
                                                    </span>
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
                            <svg width="438" height="426" viewBox="0 0 438 426" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M93.5339 78.0237L20.5625 87.9736L26.8726 134.251L99.844 124.301L93.5339 78.0237Z" fill="#EBEBEB"/>
                                <path d="M93.5394 78.0254C90.9764 81.2464 88.3414 84.3544 85.7504 87.5334C83.1284 90.6554 80.4964 93.7794 77.8484 96.8744C75.0854 100.107 72.3074 103.311 69.5274 106.5C69.4414 106.603 69.3654 106.704 69.2794 106.807C66.8164 109.619 64.3424 112.432 61.8684 115.246L61.4984 115.646L61.0464 115.358C57.9094 113.31 54.7834 111.26 51.6554 109.195C51.5464 109.134 51.4354 109.058 51.3254 108.982C47.7824 106.655 44.2474 104.311 40.7184 101.921C37.3514 99.6614 33.9794 97.3564 30.6174 95.0504C27.2694 92.6814 23.8984 90.3914 20.5664 87.9754C24.0304 89.9644 27.4554 92.0794 30.8944 94.1324C34.3284 96.2314 37.7624 98.3304 41.1804 100.477C44.9854 102.844 48.7974 105.256 52.6024 107.7C52.6134 107.699 52.6134 107.699 52.6264 107.712C55.4744 109.526 58.3244 111.355 61.1754 113.184C63.4214 110.66 65.6754 108.119 67.9354 105.624C67.9424 105.593 67.9424 105.593 67.9534 105.591C70.9674 102.233 73.9824 98.8904 77.0244 95.5744C79.7454 92.6054 82.4784 89.6504 85.2274 86.7234C88.0014 83.8234 90.7344 80.8684 93.5394 78.0254Z" fill="white"/>
                                <path d="M52.8537 108.74C52.8237 108.766 52.8067 108.802 52.7767 108.829C52.4377 109.21 52.0987 109.591 51.7587 109.961C50.1397 111.756 48.4667 113.491 46.7557 115.186C44.6747 117.278 42.5277 119.301 40.3697 121.314C38.1957 123.296 36.0087 125.268 33.7577 127.183C31.5077 129.097 29.2307 130.982 26.8477 132.746C28.7967 130.504 30.8517 128.383 32.9347 126.301C35.0267 124.207 37.1737 122.184 39.3217 120.173C41.5057 118.178 43.6917 116.206 45.9427 114.292C47.7327 112.764 49.5577 111.254 51.4377 109.814C51.8717 109.476 52.3067 109.149 52.7527 108.82C52.7837 108.794 52.8247 108.766 52.8537 108.74Z" fill="white"/>
                                <path d="M99.4713 122.844C96.7033 121.782 93.9943 120.577 91.3243 119.334C88.6433 118.092 86.0083 116.777 83.3723 115.451C80.7533 114.089 78.1433 112.715 75.5783 111.256C73.4863 110.079 71.4123 108.866 69.3823 107.569C68.9433 107.294 68.5143 107.018 68.0863 106.741C68.0503 106.724 68.0243 106.694 67.9883 106.676C68.0243 106.693 68.0713 106.709 68.1053 106.716C68.6253 106.924 69.1323 107.123 69.6403 107.333C71.8373 108.217 73.9893 109.185 76.1343 110.176C78.8153 111.418 81.4503 112.733 84.0773 114.071C86.6963 115.433 89.3063 116.807 91.8713 118.266C94.4453 119.712 96.9933 121.206 99.4713 122.844Z" fill="white"/>
                                <path d="M329.056 0.000354428L317.234 56.0449L405.609 74.6861L417.43 18.6416L329.056 0.000354428Z" fill="#EBEBEB"/>
                                <path d="M417.408 18.6458C413.118 21.3068 408.793 23.8078 404.488 26.4088C400.172 28.9318 395.842 31.4518 391.507 33.9328C386.982 36.5248 382.452 39.0788 377.925 41.6128C377.783 41.6958 377.654 41.7818 377.512 41.8648C373.507 44.0948 369.489 46.3228 365.47 48.5498L364.878 48.8588L364.474 48.3398C361.698 44.6798 358.934 41.0218 356.175 37.3458C356.075 37.2298 355.978 37.0968 355.881 36.9638C352.75 32.8138 349.636 28.6488 346.548 24.4318C343.593 20.4318 340.65 16.3778 337.72 12.3268C334.832 8.20884 331.885 4.17384 329.035 0.00683594C332.213 3.73284 335.295 7.58984 338.418 11.3798C341.517 15.2208 344.615 19.0628 347.676 22.9528C351.093 27.2578 354.498 31.6158 357.883 36.0088C357.896 36.0118 357.896 36.0118 357.906 36.0328C360.446 39.3038 362.982 42.5928 365.518 45.8818C369.153 43.8948 372.805 41.8918 376.446 39.9428C376.467 39.9098 376.467 39.9098 376.48 39.9128C381.346 37.2798 386.209 34.6638 391.09 32.0908C395.457 29.7858 399.834 27.5028 404.216 25.2578C408.619 23.0548 412.996 20.7718 417.408 18.6458Z" fill="white"/>
                                <path d="M357.751 37.3154C357.706 37.3334 357.671 37.3674 357.625 37.3864C357.077 37.6864 356.528 37.9864 355.982 38.2734C353.371 39.6774 350.724 40.9904 348.048 42.2414C344.781 43.7984 341.468 45.2474 338.143 46.6814C334.814 48.0724 331.475 49.4474 328.085 50.7284C324.696 52.0094 321.289 53.2454 317.809 54.2994C320.985 52.5154 324.234 50.9134 327.498 49.3704C330.778 47.8164 334.092 46.3674 337.403 44.9304C340.748 43.5294 344.087 42.1544 347.476 40.8724C350.173 39.8474 352.905 38.8564 355.67 37.9714C356.31 37.7594 356.948 37.5614 357.599 37.3664C357.647 37.3484 357.705 37.3334 357.751 37.3154Z" fill="white"/>
                                <path d="M405.759 72.8477C403.001 70.4777 400.37 67.9687 397.8 65.4307C395.217 62.8897 392.717 60.2837 390.22 57.6637C387.758 55.0097 385.312 52.3457 382.952 49.6017C381.023 47.3787 379.129 45.1217 377.32 42.7867C376.926 42.2877 376.546 41.7917 376.165 41.2957C376.131 41.2607 376.113 41.2157 376.078 41.1807C376.112 41.2157 376.16 41.2537 376.197 41.2747C376.711 41.7297 377.215 42.1687 377.715 42.6207C379.887 44.5477 381.973 46.5547 384.04 48.5847C386.623 51.1257 389.122 53.7317 391.603 56.3617C394.065 59.0157 396.511 61.6797 398.871 64.4237C401.248 67.1557 403.573 69.9337 405.759 72.8477Z" fill="white"/>
                                <path d="M390.748 260.598C389.389 265.038 389.105 269.833 389.785 274.422C391.23 284.111 398.523 291.783 400.101 301.323C399.904 302.468 399.666 303.623 399.361 304.777C399.362 304.796 399.351 304.82 399.344 304.836C399.34 304.844 399.337 304.852 399.341 304.863C399.338 304.871 399.338 304.871 399.338 304.871C399.334 304.879 399.334 304.879 399.339 304.89C399.345 304.94 399.386 304.977 399.425 304.995C399.493 304.864 399.553 304.729 399.609 304.603C399.726 304.361 399.832 304.124 399.929 303.883C400.08 303.543 400.213 303.203 400.34 302.852C400.38 302.869 400.418 302.697 400.42 302.65C403.973 292.852 400.71 281.984 399.055 272.041C398.104 266.356 398.505 260.617 397.656 254.958C397.452 253.606 397.464 251.042 395.517 251.56C393.33 252.151 391.302 258.777 390.748 260.598Z" fill="#455A64"/>
                                <path d="M392.182 268.954C391.566 280.741 402.436 291.049 399.911 302.821C399.829 303.154 399.751 303.48 399.661 303.81C399.598 304.038 399.534 304.266 399.463 304.49C399.463 304.49 399.463 304.49 399.459 304.498C399.428 304.589 399.397 304.679 399.363 304.778C399.364 304.797 399.353 304.821 399.346 304.837C399.342 304.845 399.339 304.853 399.343 304.864C399.34 304.872 399.34 304.872 399.34 304.872C399.336 304.88 399.336 304.88 399.341 304.891C399.347 304.941 399.388 304.978 399.427 304.996C399.443 305.003 399.462 305.002 399.47 305.006C399.509 305.004 399.547 304.983 399.568 304.936C399.704 304.589 399.823 304.234 399.932 303.884C400.215 303.014 400.412 302.144 400.532 301.278C400.544 301.274 400.536 301.27 400.536 301.27C401.675 296.087 401.396 290.938 400.301 285.491C398.952 278.803 397.248 272.318 396.027 265.555C395.877 264.72 395.872 261.428 394.53 261.864C392.833 262.416 392.256 267.593 392.182 268.954ZM392.762 267.202C392.868 266.538 393.719 262.109 394.822 262.571C395.478 262.844 395.56 266.199 395.663 266.671C396.055 268.496 396.444 270.309 396.836 272.133C397.672 275.966 398.531 279.79 399.359 283.62C400.372 288.356 401.008 293.086 400.669 297.791C400.064 287.471 391.046 277.902 392.762 267.202Z" fill="white"/>
                                <path d="M387.925 373.757C387.932 373.912 388.054 374.127 388.265 373.994C397.194 368.247 408.331 372.926 417.574 367.793C421.282 365.725 424.494 362.83 427.502 359.863C429.719 357.673 431.937 355.35 433.546 352.671C433.763 352.312 434.895 350.853 434.715 350.128C433.296 344.623 418.997 353.936 416.601 355.25C407.247 360.353 398.692 365.005 390.501 371.546C389.643 372.217 388.79 372.919 387.947 373.643C387.921 373.66 387.919 373.707 387.925 373.757Z" fill="#455A64"/>
                                <path d="M387.925 373.757C388.253 373.552 388.574 373.344 388.898 373.147C395.036 370.198 401.87 369.16 408.469 367.478C415.125 365.774 420.817 362.996 425.765 358.161C426.638 357.307 430.264 354.037 429.193 352.394C428.23 350.913 424.581 353.766 423.693 354.271C417.05 357.991 410.554 361.767 403.628 364.973C399.198 367.023 394.714 369.067 390.501 371.546C389.643 372.217 388.79 372.919 387.947 373.643C387.921 373.66 387.919 373.707 387.925 373.757ZM392.095 371.269C396.979 368.539 402.108 366.26 407.193 363.847C410.687 362.196 414.1 360.406 417.446 358.471C419.275 357.407 421.096 356.32 422.937 355.272C423.863 354.745 424.786 354.227 425.718 353.731C426.183 353.473 427.716 352.593 428.105 353.301C429.156 355.217 418.901 364.947 406.181 367.465C401.407 368.41 396.583 369.472 392.095 371.269Z" fill="white"/>
                                <path d="M402.776 356.847C402.739 356.887 402.753 356.941 402.789 356.967C402.821 357 402.876 357.006 402.924 356.961C403.11 356.778 403.292 356.603 403.477 356.42C404.153 355.753 404.805 355.076 405.441 354.392C405.555 354.263 405.674 354.145 405.789 354.016C405.831 354.006 405.862 354.001 405.892 353.976C413.025 346.681 423.831 344.452 429.915 335.998C432.623 332.234 434.342 327.878 435.64 323.449C436.198 321.535 438.944 315.702 436.537 314.186C434.661 313.01 431.732 315.566 430.509 316.653C426.623 320.102 423.87 324.927 421.166 329.299C418.512 333.58 416.097 337.987 413.575 342.336C411.232 346.367 408.505 349.961 405.596 353.494C404.673 354.609 403.73 355.726 402.776 356.847Z" fill="#455A64"/>
                                <path d="M402.776 356.847C402.739 356.887 402.753 356.941 402.789 356.967C403.374 356.355 403.959 355.743 404.549 355.142C404.188 355.569 403.827 355.997 403.478 356.42C404.154 355.753 404.806 355.076 405.442 354.392C405.755 354.029 406.069 353.665 406.39 353.306C410.477 349.34 414.891 345.728 419.535 342.408C421.845 340.753 423.816 338.885 425.46 336.529C428.449 332.244 433.086 322.16 432.191 320.633C431.245 319.008 429.434 322.329 428.915 323.027C424.765 328.691 421.393 334.843 416.93 340.292C413.926 343.953 410.879 347.585 407.839 351.221C407.073 351.961 406.32 352.717 405.595 353.494C404.673 354.609 403.73 355.726 402.776 356.847ZM431.513 321.002C432.3 321.33 431.102 324.037 430.793 324.753C429.281 328.196 427.634 331.683 425.777 334.962C423.809 338.448 421.004 340.747 417.778 343.01C415.131 344.867 412.536 346.927 410.065 349.137C413.083 345.72 416.069 342.269 418.859 338.683C421.172 335.701 423.185 332.519 425.229 329.351C426.247 327.765 427.27 326.191 428.353 324.653C428.644 324.233 430.807 320.707 431.513 321.002Z" fill="white"/>
                                <path d="M349.614 401.853C349.607 401.901 349.645 401.934 349.684 401.934C349.725 401.942 349.767 401.919 349.78 401.861C349.825 401.633 349.87 401.412 349.915 401.184C350.076 400.353 350.215 399.526 350.338 398.702C350.357 398.549 350.385 398.402 350.404 398.25C350.43 398.222 350.45 398.202 350.46 398.169C352.031 389.204 358.86 382.116 359.075 372.827C359.17 368.692 358.24 364.62 356.961 360.706C356.406 359.017 355.487 353.339 352.951 353.437C350.978 353.517 350.111 356.875 349.759 358.292C348.638 362.789 349.044 367.728 349.259 372.309C349.464 376.797 349.909 381.258 350.245 385.73C350.553 389.878 350.358 393.898 349.998 397.964C349.882 399.25 349.751 400.547 349.614 401.853Z" fill="#455A64"/>
                                <path d="M349.614 401.853C349.607 401.901 349.645 401.934 349.684 401.934C349.806 401.189 349.928 400.443 350.059 399.704C350.009 400.201 349.959 400.697 349.915 401.184C350.076 400.353 350.215 399.526 350.338 398.702C350.385 398.277 350.433 397.851 350.488 397.425C351.497 392.446 352.923 387.562 354.667 382.778C355.533 380.395 356.042 378.027 356.063 375.464C356.102 370.803 354.431 361.045 353.003 360.372C351.487 359.653 351.829 363.01 351.799 363.785C351.6 370.045 352.22 376.273 351.683 382.533C351.318 386.741 350.907 390.951 350.503 395.159C350.313 396.09 350.14 397.025 349.998 397.963C349.882 399.25 349.751 400.547 349.614 401.853ZM351.092 392.504C351.59 388.467 352.048 384.422 352.293 380.377C352.492 377.016 352.369 373.66 352.276 370.298C352.226 368.618 352.185 366.944 352.206 365.266C352.209 364.81 352.022 361.125 352.691 360.986C353.435 360.831 353.918 363.427 354.052 364.109C354.675 367.405 355.221 370.801 355.508 374.151C355.817 377.709 354.912 380.814 353.679 384.106C352.667 386.808 351.797 389.632 351.092 392.504Z" fill="white"/>
                                <path d="M348.582 409.29C348.741 409.295 348.979 409.229 349.277 409.049C358.408 405.554 368.396 405.398 377.574 401.904C381.582 400.377 385.378 398.131 388.237 394.88C389.462 393.49 393.706 388.703 392.768 386.484C389.973 379.807 359.157 400.842 349.023 408.404C348.814 408.511 348.664 408.614 348.56 408.72C348.251 409.01 348.298 409.268 348.582 409.29Z" fill="#455A64"/>
                                <path d="M348.582 409.289C349.259 408.917 349.94 408.537 350.626 408.169C352.843 407.278 355.078 406.432 357.361 405.713C360.979 404.572 364.702 403.896 368.376 402.97C374.121 401.524 379.427 398.783 383.775 394.743C384.721 393.874 387.537 391.552 386.924 389.924C386.361 388.441 384.061 389.902 383.244 390.288C371.66 395.822 360.385 402.175 349.148 408.422C348.943 408.521 348.749 408.615 348.56 408.72C348.251 409.009 348.298 409.267 348.582 409.289ZM353.961 406.343C358.363 403.949 362.763 401.563 367.175 399.212C370.633 397.365 374.091 395.537 377.566 393.717C379.283 392.821 380.982 391.899 382.716 391.03C383.399 390.689 386.037 389.34 386.286 390.295C386.523 391.169 384.71 393.027 384.38 393.363C379.172 398.718 372.494 401.474 365.336 403.069C361.465 403.926 357.649 404.959 353.961 406.343Z" fill="white"/>
                                <path d="M392.332 332.127C392.256 332.255 392.25 332.375 392.29 332.478C392.344 332.635 392.504 332.744 392.687 332.759C392.773 332.778 392.865 332.763 392.953 332.735C393.008 332.74 393.061 332.726 393.11 332.681C397.423 328.465 404.006 324.537 408.442 320.49C411.847 317.377 414.642 313.671 416.996 309.702C419.599 305.322 421.839 300.563 423.305 295.668C424.002 293.333 426.015 287.808 424.115 285.513C420.217 280.783 412.336 297.986 411.205 299.911C404.875 310.625 398.552 321.344 392.332 332.127Z" fill="#455A64"/>
                                <path d="M392.289 332.478C392.343 332.635 392.503 332.744 392.686 332.759C392.941 332.398 393.192 332.026 393.447 331.666C395.134 329.686 396.821 327.705 398.621 325.813C401.546 322.733 404.893 320.069 407.717 316.897C412.634 311.366 421.863 293.755 419.211 291.998C417.828 291.082 416.118 294.709 415.613 295.566C413.629 298.96 412.086 302.578 410.054 305.951C407.937 309.495 405.605 312.904 403.288 316.321C399.709 321.575 396.109 326.81 392.586 332.108C392.483 332.233 392.392 332.353 392.289 332.478ZM395.828 328.211C399.012 323.568 402.152 318.897 405.309 314.232C407.483 311.008 409.632 307.754 411.57 304.378C412.648 302.487 413.619 300.539 414.59 298.591C415.067 297.647 415.54 296.69 416.08 295.774C416.545 294.985 418.268 291.695 419.044 292.899C419.792 294.06 417.486 299.264 416.94 300.471C416.039 302.431 415.119 304.373 414.123 306.292C412.156 310.054 409.9 313.696 407.041 316.862C404.189 320.012 400.857 322.683 397.977 325.811C397.256 326.599 396.531 327.396 395.828 328.211Z" fill="white"/>
                                <path d="M340.632 340.704C348.564 349.325 361.362 351.718 366.031 366.824C366.041 366.885 366.119 366.882 366.145 366.846C366.167 366.837 366.177 366.813 366.169 366.79C365.879 365.267 365.539 363.751 365.13 362.241C362.976 354.124 359.191 346.239 354.164 339.593C351.13 335.607 347.538 331.999 343.452 329.1C341.361 327.62 336.84 323.844 334.228 324.428C328.595 325.686 339.185 339.14 340.632 340.704Z" fill="#455A64"/>
                                <path d="M341.104 335.396C344.3 341.663 350.638 345.725 355.485 350.603C358.825 353.966 361.864 357.641 364.258 361.703C364.916 363.399 365.54 365.109 366.142 366.846C366.165 366.837 366.175 366.813 366.167 366.79C365.877 365.267 365.537 363.751 365.128 362.241C365.078 362.162 365.039 362.078 364.989 361.999C363.306 357.362 360.968 352.899 358.402 348.818C354.795 343.07 350.378 337.824 345.322 333.308C344.449 332.521 341.568 329.106 340.072 329.977C338.64 330.81 340.658 334.524 341.104 335.396ZM340.569 330.531C341.66 330.121 346.75 335.176 348.743 337.239C353.039 341.672 356.762 346.666 359.794 352.045C361.126 354.401 362.25 356.798 363.276 359.245C361.571 356.704 359.637 354.317 357.538 352.065C353.165 347.379 347.694 343.627 343.732 338.593C342.695 337.278 341.785 335.85 341.103 334.313C340.834 333.702 339.575 330.905 340.569 330.531Z" fill="white"/>
                                <path d="M350.471 293.669C349.951 297.866 349.903 302.15 350.384 306.356C351.314 314.583 354.201 322.287 358.676 329.218C358.755 329.338 358.831 329.467 358.918 329.591C358.986 329.991 359.063 330.395 359.162 330.79C359.178 330.882 359.197 330.967 359.221 331.063C359.23 331.086 359.234 331.097 359.243 331.12L359.251 331.124C359.308 331.187 359.435 331.158 359.43 331.042C359.431 330.549 359.436 330.049 359.448 329.552C359.608 319.344 361.496 309.346 360.127 299.122C359.821 296.89 358.367 282.276 353.262 284.775C350.886 285.936 350.727 291.536 350.471 293.669Z" fill="#455A64"/>
                                <path d="M352.505 295.722C352.153 302.013 353.803 308.769 355.096 314.901C356.098 319.661 357.175 324.531 358.674 329.218C358.788 329.601 358.918 329.991 359.044 330.369C359.077 330.507 359.118 330.649 359.16 330.79C359.177 330.902 359.205 331.009 359.241 331.12L359.249 331.124C359.306 331.187 359.433 331.158 359.428 331.042C359.429 330.549 359.434 330.049 359.446 329.552C359.348 329.176 359.238 328.805 359.139 328.429C358.396 322.874 358.466 317.301 358.51 311.66C358.536 308.618 358.488 305.591 358.224 302.562C357.965 299.649 357.831 296.518 356.925 293.716C356.529 292.497 355.706 290.083 353.989 290.978C352.546 291.729 352.585 294.392 352.505 295.722ZM356.257 293.598C357.337 296.904 357.497 300.787 357.73 304.248C357.964 307.557 357.925 310.887 357.892 314.2C357.857 317.712 357.82 321.289 358.142 324.808C356.934 320.383 355.768 315.948 354.908 311.403C354.232 307.85 353.64 304.277 353.226 300.689C353.007 298.837 352.876 296.978 353.044 295.108C353.099 294.45 353.17 293.78 353.312 293.141C353.759 291.092 355.775 292.103 356.257 293.598Z" fill="white"/>
                                <path d="M413.161 267.147C413.124 267.311 413.098 267.471 413.061 267.635C413.011 267.889 413.248 268.016 413.441 267.971C413.549 267.944 413.631 267.868 413.662 267.739C413.73 267.446 413.801 267.145 413.868 266.852L413.872 266.844C413.926 266.602 413.984 266.371 414.037 266.129C414.256 265.734 414.491 265.346 414.749 264.969C417.454 260.872 422.147 257.408 425.33 253.911C428.234 250.734 430.973 247.395 433.191 243.694C435.436 239.957 437.195 235.865 437.752 231.508C437.898 230.336 438.452 227.379 436.988 226.642C435.138 225.709 432.313 229.256 431.317 230.182C427.88 233.401 424.949 237.138 422.485 241.145C417.532 249.196 414.999 257.974 413.161 267.147Z" fill="#455A64"/>
                                <path d="M413.987 265.115C413.673 265.781 413.389 266.461 413.161 267.147C413.124 267.311 413.098 267.471 413.061 267.635C413.011 267.889 413.248 268.016 413.441 267.971C413.476 267.854 413.511 267.736 413.553 267.622C413.661 267.366 413.76 267.107 413.868 266.851L413.872 266.843C414.145 266.206 414.438 265.587 414.75 264.968C415.842 262.791 417.164 260.737 418.717 258.656C421.316 255.187 424.042 251.813 426.513 248.247C427.751 246.46 437.266 232.693 433.523 231.379C432.82 231.124 432.14 232.07 431.761 232.459C430.436 233.834 429.364 235.468 428.344 237.069C425.959 240.799 423.71 244.628 421.587 248.516C418.669 253.871 416.075 259.391 413.987 265.115ZM420.793 250.899C422.61 247.452 424.537 244.076 426.548 240.747C427.528 239.128 428.507 237.489 429.577 235.921C430.105 235.143 432.78 231.652 433.513 232.111C434.587 232.784 432.04 238.221 431.264 239.686C430.375 241.356 429.411 242.983 428.404 244.579C426.37 247.793 424.122 250.87 421.814 253.892C419.778 256.571 417.343 259.411 415.437 262.492C417.011 258.534 418.817 254.672 420.793 250.899Z" fill="white"/>
                                <path d="M380.461 315.049C380.511 315.21 380.569 315.361 380.62 315.521C380.704 315.765 380.974 315.757 381.117 315.621C381.196 315.544 381.229 315.436 381.191 315.309C381.102 315.022 381.013 314.726 380.924 314.438L380.923 314.429C380.848 314.192 380.782 313.964 380.707 313.727C380.698 313.275 380.707 312.822 380.741 312.366C381.025 307.464 383.346 302.113 384.345 297.491C385.262 293.285 385.956 289.023 386.018 284.709C386.084 280.351 385.553 275.928 383.848 271.88C383.386 270.793 382.381 267.957 380.746 268.054C378.677 268.175 378.014 272.661 377.617 273.961C376.259 278.47 375.599 283.173 375.479 287.876C375.234 297.327 377.447 306.192 380.461 315.049Z" fill="#455A64"/>
                                <path d="M380.157 312.876C380.219 313.61 380.316 314.34 380.462 315.049C380.512 315.21 380.57 315.361 380.621 315.521C380.705 315.765 380.975 315.757 381.118 315.621C381.089 315.502 381.06 315.383 381.04 315.263C381.005 314.988 380.961 314.714 380.925 314.439L380.924 314.43C380.84 313.742 380.783 313.06 380.742 312.367C380.594 309.935 380.707 307.496 381.006 304.917C381.513 300.612 382.178 296.326 382.527 292.001C382.701 289.834 384.023 273.152 380.126 273.894C379.39 274.026 379.276 275.186 379.144 275.712C378.687 277.566 378.58 279.518 378.502 281.414C378.311 285.837 378.287 290.278 378.401 294.706C378.565 300.801 379.091 306.878 380.157 312.876ZM378.91 297.164C378.752 293.271 378.724 289.383 378.793 285.495C378.828 283.603 378.852 281.694 378.992 279.801C379.058 278.863 379.621 274.501 380.485 274.53C381.751 274.573 382.277 280.554 382.341 282.211C382.41 284.102 382.393 285.992 382.323 287.879C382.176 291.68 381.776 295.469 381.296 299.241C380.879 302.58 380.198 306.258 380.095 309.88C379.47 305.666 379.095 301.42 378.91 297.164Z" fill="white"/>
                                <path d="M358.182 321.904C359.543 330.775 361.216 339.443 363.561 348.11C365.367 354.789 367.193 361.567 367.452 368.518C367.762 376.825 365.359 386.05 361.14 394.018C363.576 391.296 365.985 388.536 368.375 385.732C373.234 380.032 378.064 374.18 381.514 367.489C381.854 366.829 382.164 366.156 382.474 365.485C382.448 365.439 382.429 365.388 382.443 365.324C384.428 356.254 384.911 347.392 384.185 338.419C382.662 333.687 380.79 329.436 378.325 324.955C375.888 320.526 373.554 316.224 372.259 311.298C372.185 311.018 372.58 310.849 372.689 311.133C375.171 317.643 380.276 323.979 383.279 330.73C383.108 329.617 382.926 328.503 382.721 327.383C380.764 316.7 377.067 305.962 380.978 295.281C381.109 294.923 381.618 295.168 381.51 295.517C377.826 307.414 383.621 320.521 385.337 332.343C386.614 341.136 387.044 350.608 384.915 359.369C386.556 354.549 387.714 349.558 388.829 344.587C395.552 314.601 403.331 284.782 417.908 257.53C418.05 257.264 418.479 257.448 418.341 257.723C403.418 287.295 397.502 319.44 389.729 351.308C389.641 351.67 389.544 352.03 389.453 352.392C392.035 348.184 395.456 344.335 398.825 341.06C398.996 340.894 399.272 341.103 399.118 341.301C394.845 346.779 391.579 352.771 387.728 358.491C386.312 362.942 384.546 367.261 382.153 371.323C379.299 376.169 375.836 380.597 372.228 384.899C378.315 379.792 384.458 374.756 390.184 369.195C398.83 360.798 407.074 351.889 414.531 342.414C414.64 342.276 414.841 342.445 414.74 342.586C407.381 352.837 399.471 362.58 390.512 371.491C382.935 379.027 374.816 386.708 365.72 392.492C357.028 402.502 347.73 412.556 336.733 419.886C336.209 420.235 335.716 419.51 336.172 419.105C338.192 417.312 340.163 415.486 342.112 413.644C344.01 409.403 346.638 405.516 348.327 401.127C350.314 395.964 351.645 390.654 352.361 385.174C352.414 384.77 353.001 384.873 352.977 385.267C352.522 392.732 350.846 401.922 346.861 409.051C349.64 406.3 352.367 403.508 355.041 400.662C362.185 389.755 366.837 376.792 365.275 363.742C364.473 357.038 362.546 350.557 360.972 344.01C359.219 336.718 358.311 329.421 357.684 321.958C357.658 321.636 358.134 321.585 358.182 321.904Z" fill="#455A64"/>
                                <path d="M94.9722 279.62C96.5122 283.866 96.1972 289.101 96.0082 293.528C95.7972 298.606 95.1512 303.638 94.2422 308.632C93.4022 313.284 92.3322 317.888 91.1822 322.462C91.1692 322.505 91.1572 322.547 91.1442 322.59C91.0722 322.894 90.9942 323.193 90.9172 323.492C90.8742 323.862 90.8262 324.238 90.7612 324.618C90.7402 324.73 90.6562 324.797 90.5642 324.809C90.4392 324.83 90.3132 324.76 90.3302 324.599C90.3502 324.395 90.3752 324.186 90.3882 323.987C91.1322 315.399 86.1792 307.56 85.8792 299.051C85.7162 294.389 86.8382 289.717 87.7062 285.163C88.1862 282.643 88.3092 279.374 89.2892 277.004C89.5482 276.373 89.6092 275.696 90.3142 275.359C92.4902 274.336 94.4372 278.136 94.9722 279.62Z" fill="#455A64"/>
                                <path d="M92.9377 282.803C91.5877 281.694 90.7927 284.772 90.5307 285.613C88.7627 291.282 87.7727 298.037 88.7857 303.906C89.8867 310.356 91.0567 316.814 90.5787 323.348C90.5157 323.561 90.4527 323.774 90.3897 323.987C90.3757 324.186 90.3507 324.395 90.3317 324.599C90.3137 324.76 90.4407 324.83 90.5657 324.809C90.5877 324.675 90.6087 324.552 90.6257 324.423C90.8137 323.816 90.9847 323.203 91.1467 322.59C91.1587 322.547 91.1717 322.505 91.1847 322.462C92.3097 318.087 92.8177 313.502 93.4437 309.078C94.3257 302.815 94.9577 296.46 94.4507 290.138C94.3327 288.612 94.1547 287.089 93.8787 285.583C93.7407 284.828 93.5997 283.344 92.9377 282.803ZM93.6967 286.628C93.9417 288.224 94.0997 289.828 94.1867 291.444C94.4897 297.002 93.9657 302.574 93.2187 308.082C92.5807 312.786 92.0597 317.683 90.8527 322.341C91.1567 318.626 90.9057 314.894 90.3797 311.176C89.9917 308.387 89.4067 305.643 88.9917 302.858C88.5157 299.714 88.8587 296.617 89.3267 293.486C89.7507 290.624 90.1367 287.517 91.2067 284.806C91.4247 284.254 92.0517 283.029 92.5297 283.114C93.3767 283.264 93.6047 285.998 93.6967 286.628Z" fill="white"/>
                                <path d="M56.4066 345.213C56.4176 345.203 56.4016 345.185 56.3906 345.195L56.4066 345.213Z" fill="#455A64"/>
                                <path d="M90.7933 404.537C90.8983 404.606 90.9213 404.699 90.8903 404.789V404.8C90.8703 404.88 90.8033 404.953 90.7163 404.971C90.6623 404.98 90.5973 404.977 90.5393 404.947C85.2853 402.29 80.2653 398.063 74.1773 397.755C69.4143 397.504 65.3213 398.095 60.7983 396.144C56.2433 394.181 52.0413 391.116 48.6963 387.461C47.1553 385.783 45.7773 383.944 44.5703 382.01C43.9953 381.079 42.1143 378.76 42.3813 377.563C43.6063 371.978 60.1803 381.914 62.3833 383.254C72.1313 389.183 82.0533 395.852 90.1843 403.907C90.2103 403.935 90.2193 403.968 90.2073 403.999C90.2003 404.037 90.1823 404.074 90.1493 404.094C90.3633 404.238 90.5783 404.382 90.7933 404.537Z" fill="#455A64"/>
                                <path d="M90.7942 404.537C90.5792 404.382 90.3642 404.238 90.1492 404.094C90.1822 404.074 90.2002 404.037 90.2072 403.999C84.8202 399.912 79.1032 396.2 73.3652 392.633C67.2012 388.805 60.8892 384.884 54.2632 381.893C53.3582 381.482 49.5922 379.229 48.8012 380.689C48.0402 382.091 51.9302 385.494 52.7612 386.241C57.6772 390.637 64.0912 392.652 70.2922 394.47C74.3192 395.656 78.2742 396.785 81.8802 399.01C84.9082 400.876 87.7102 403.083 90.7152 404.97C90.8022 404.952 90.8702 404.879 90.8892 404.799C89.3502 403.822 87.8642 402.744 86.3832 401.683C87.8872 402.713 89.3912 403.753 90.8902 404.788C90.9222 404.699 90.8992 404.606 90.7942 404.537ZM77.2142 396.239C71.1812 393.883 64.7092 392.852 58.8962 389.881C56.1142 388.462 53.4942 386.646 51.3922 384.312C50.9852 383.869 49.0222 381.897 49.4662 381.113C49.7632 380.587 51.3312 381.068 51.5592 381.159C53.2802 381.793 54.9412 382.565 56.5722 383.396C62.2532 386.292 67.7662 389.569 73.1792 392.929C76.1852 394.794 79.1292 396.737 82.0482 398.723C80.5202 397.766 78.9222 396.905 77.2142 396.239Z" fill="white"/>
                                <path d="M66.8195 288.916C67.4735 293.955 66.4555 299.214 65.0845 304.065C61.8985 315.279 55.7475 325.697 53.7975 337.266C53.7185 337.721 53.6505 338.177 53.5885 338.627C53.6925 339.225 53.6125 339.081 53.4215 338.377C53.4215 338.377 53.4105 338.376 53.4165 338.371C52.5715 335.298 49.6485 321.736 50.9855 312.003C51.8265 305.933 53.9165 300.196 56.0155 294.47C57.2175 291.204 58.3875 287.925 59.6105 284.671C60.0055 283.625 60.5585 280.644 62.1385 280.415C65.1945 279.957 66.5585 286.941 66.8195 288.916Z" fill="#455A64"/>
                                <path d="M61.5167 289.925C60.9617 289.648 60.5387 289.84 60.1587 290.283C59.7327 290.799 59.6517 291.669 59.4967 292.267C59.1867 293.462 58.8777 294.647 58.5727 295.836C56.4477 304.047 53.5927 312.432 52.8007 320.911C52.2757 326.526 52.5727 332.213 53.4067 337.821C53.4097 338.004 53.4127 338.188 53.4157 338.372C53.4097 338.377 53.4207 338.378 53.4207 338.378C53.6117 339.082 53.6917 339.226 53.5877 338.628C53.6497 338.178 53.7177 337.722 53.7967 337.267C53.7967 336.636 53.8177 336.006 53.8557 335.371C54.1237 330.986 55.3757 326.783 56.7237 322.628C59.2717 314.731 61.5297 306.688 62.5127 298.428C62.7197 296.603 62.9087 294.701 62.7017 292.864C62.6087 292.027 62.4037 290.373 61.5167 289.925ZM62.2557 292.579C62.3297 292.997 62.3617 293.382 62.3757 293.803C62.4197 294.673 62.3707 295.556 62.3127 296.427C62.1637 298.541 61.8317 300.625 61.4677 302.708C60.1577 310.15 57.9617 317.258 55.7237 324.456C54.6177 328.007 53.6977 331.625 53.4687 335.354C53.1597 332.234 52.9907 329.108 52.9987 325.996C53.0267 317.992 55.2597 310.417 57.2327 302.727C57.7237 300.827 58.2147 298.917 58.7057 297.018C58.9467 296.063 59.1917 295.113 59.4367 294.163L59.7997 292.733C60.0397 291.778 59.9007 291.378 60.9657 291.083C62.2807 290.724 62.0767 291.47 62.2557 292.579Z" fill="white"/>
                                <path d="M74.8049 335.804C76.1919 339.53 77.2129 343.395 77.8679 347.312C79.1749 355.181 77.9659 364.278 80.0329 372.116C80.2169 372.626 80.3819 373.152 80.5249 373.677C80.5849 373.874 80.6339 374.069 80.6829 374.266C80.7069 374.375 80.5389 374.431 80.4919 374.332C80.3289 374 80.1669 373.668 79.9929 373.336C79.9879 373.33 79.9939 373.325 79.9879 373.318C79.9039 373.143 79.8089 372.968 79.7249 372.794C75.8239 365.162 70.8179 358.185 69.1579 349.611C68.1339 344.338 66.5009 329.799 69.9809 328.693C71.5309 328.199 73.9549 333.543 74.8049 335.804Z" fill="#455A64"/>
                                <path d="M71.6399 336.576C70.8079 336.968 70.8389 338.595 70.7869 339.277C70.6549 341.039 70.8159 342.935 70.9799 344.698C71.2819 348.053 72.0309 351.347 72.9429 354.58C74.6869 360.757 76.8619 366.997 79.7229 372.794C79.8069 372.969 79.9019 373.144 79.9859 373.318C79.9919 373.324 79.9859 373.33 79.9909 373.336C80.1649 373.668 80.3279 374 80.4899 374.332C80.5369 374.431 80.7049 374.375 80.6809 374.266C80.6319 374.07 80.5839 373.874 80.5229 373.677C77.9579 366.952 76.8849 359.886 75.9919 352.73C75.7999 351.125 74.4989 335.22 71.6399 336.576ZM74.2399 343.028C74.4899 344.527 74.6989 346.03 74.8969 347.545C75.3689 351.061 75.7659 354.591 76.2779 358.103C76.8399 361.92 77.5599 365.754 78.6679 369.463C76.8989 365.213 75.2329 360.933 73.8939 356.496C73.0259 353.584 72.2389 350.642 71.7389 347.644C71.4719 346.019 71.2849 344.374 71.2359 342.724C71.2009 341.935 70.8689 337.381 71.8119 336.991C72.9849 336.506 74.1359 342.379 74.2399 343.028Z" fill="white"/>
                                <path d="M108.057 320.275C109.979 322.639 109.072 327.352 108.032 329.838C106.542 333.399 103.824 336.186 100.837 338.545C96.5048 341.975 91.6668 344.616 88.0178 348.846C84.3918 353.034 85.5628 351.773 83.0248 357.145C82.9768 357.251 82.8748 357.252 82.7918 357.162C82.6678 357.038 82.5678 356.737 82.6348 356.303C82.6368 356.26 82.6498 356.207 82.6568 356.158C84.9908 347.33 89.5218 340.376 95.5288 333.484C98.9368 329.578 100.993 324.627 104.541 320.862C105.859 319.469 106.735 318.643 108.057 320.275Z" fill="#455A64"/>
                                <path d="M106.02 324.919C104.719 324.303 103.086 326.941 102.419 327.894C100.494 330.655 98.6128 333.407 96.2138 335.786C94.0968 337.875 91.9818 339.91 90.1548 342.26C87.3698 345.842 85.1438 349.841 83.5768 354.084C83.2278 354.797 82.9158 355.539 82.6348 356.304C82.5678 356.738 82.6678 357.039 82.7918 357.163C82.8228 357.062 82.8538 356.972 82.8858 356.87C85.0048 351.199 88.6098 346.843 93.5878 343.069C98.5378 339.32 103.198 335.155 105.844 329.404C106.315 328.384 107.22 325.493 106.02 324.919ZM105.812 328.67C105.387 329.661 104.893 330.621 104.341 331.552C103.336 333.23 102.147 334.798 100.845 336.253C98.5178 338.835 95.8008 340.936 93.0418 343.025C89.7968 345.498 86.9668 348.365 84.8828 351.707C86.4918 348.129 88.5238 344.742 91.0228 341.671C93.2538 338.94 95.9808 336.725 98.2728 334.072C99.3288 332.844 100.264 331.53 101.199 330.216C101.699 329.498 102.199 328.781 102.698 328.074C103.14 327.44 104.558 325.186 105.505 325.372C106.73 325.602 105.985 328.272 105.812 328.67Z" fill="white"/>
                                <path d="M27.16 297.985C34.967 306.803 42.227 316.072 49.135 325.602C49.227 325.725 49.215 325.87 49.141 325.969C49.134 325.996 49.123 326.017 49.106 326.032C49.152 326.093 49.198 326.154 49.233 326.215C49.279 326.287 49.249 326.356 49.193 326.397C49.177 326.402 49.165 326.412 49.149 326.417C49.143 326.422 49.133 326.422 49.133 326.422C49.09 326.431 49.036 326.418 48.994 326.384C44.127 321.613 39.549 317.146 33.42 313.988C27.814 311.106 22.29 308.707 17.421 304.611C13.266 301.1 1.47799 283.789 3.39699 279.658C4.69199 276.874 20.942 290.977 27.16 297.985Z" fill="#455A64"/>
                                <path d="M17.491 292.097C16.475 291.115 13.485 287.239 11.58 288.026C9.66902 288.818 12.712 292.729 13.275 293.557C15.363 296.586 17.572 299.566 20.218 302.144C22.854 304.711 25.98 306.414 29.024 308.421C36.511 313.374 43.114 319.81 49.133 326.421C49.133 326.421 49.144 326.421 49.149 326.416C49.165 326.411 49.177 326.401 49.193 326.396C49.249 326.355 49.279 326.286 49.233 326.214C49.198 326.153 49.152 326.092 49.106 326.031C49.123 326.015 49.134 325.994 49.141 325.968C39.717 313.71 28.549 302.845 17.491 292.097ZM48.478 325.584C44.38 320.986 39.917 316.61 35.193 312.659C29.688 308.05 23.039 305.08 18.277 299.601C16.009 296.996 13.562 294.049 12.033 290.941C11.824 290.522 11.048 289.114 11.573 288.559C12.037 288.061 13.38 288.679 15.063 290.218C16.454 291.496 17.777 292.858 19.129 294.183C24.453 299.383 29.748 304.61 34.863 310.022C39.6 315.038 44.137 320.226 48.478 325.584Z" fill="white"/>
                                <path d="M59.6469 362.607C59.6559 362.65 59.6429 362.693 59.6199 362.735C59.5779 362.836 59.4779 362.907 59.3609 362.869C59.1169 362.783 58.8659 362.713 58.6159 362.632C58.5989 362.647 58.5829 362.652 58.5499 362.651C52.9649 361.933 48.4319 362.878 43.0599 364.251C39.0619 365.273 34.9819 365.212 30.9769 364.233C26.6309 363.174 22.5539 361.123 18.7939 358.729C17.2609 357.746 12.3539 355.547 13.1539 352.857C14.4699 348.43 29.3549 354.195 31.9309 355.028C36.5389 356.519 41.1099 357.847 45.8729 358.762C50.5379 359.662 55.2089 360.433 59.5519 362.457C59.6189 362.487 59.6489 362.542 59.6469 362.607Z" fill="#455A64"/>
                                <path d="M56.688 361.93C56.683 361.924 56.688 361.919 56.688 361.919C53.99 361.302 51.303 360.573 48.582 360.101C45.535 359.566 42.42 359.633 39.362 359.109C33.638 358.115 28.192 356.038 22.533 354.778C21.795 354.617 20.34 354.329 20.729 355.586C20.889 356.132 21.679 356.576 22.093 356.869C23.344 357.769 24.692 358.539 26.082 359.208C30.798 361.459 36.268 363.1 41.537 362.866C47.644 362.587 53.584 361.438 59.619 362.736C59.642 362.694 59.655 362.651 59.646 362.608C58.679 362.296 57.685 362.081 56.688 361.93ZM43.462 362.3C36.864 362.822 29.99 361.105 24.252 357.775C23.71 357.455 22.284 356.545 21.79 356.131C21.318 355.736 20.637 354.894 22.434 355.12C22.858 355.173 23.267 355.317 23.684 355.421C25.146 355.785 26.596 356.192 28.051 356.605C31.148 357.487 34.237 358.417 37.391 359.08C40.203 359.675 43.009 359.913 45.871 360.089C49.325 360.301 52.711 361.114 56.089 361.841C51.924 361.328 47.619 361.97 43.462 362.3Z" fill="white"/>
                                <path d="M43.5547 350.503C43.5797 350.584 43.5827 350.676 43.5597 350.762C43.5527 350.81 43.5367 350.848 43.5137 350.89C43.4907 350.943 43.4517 350.991 43.4137 351.028C43.4027 351.049 43.3917 351.06 43.3757 351.065C43.2767 351.138 43.1417 351.173 42.9817 351.104C42.1427 350.799 41.3527 350.436 40.6027 350.025C31.3527 346.496 21.8747 342.774 14.3487 336.239C10.5067 332.9 7.17766 329.017 4.28766 324.832C2.86866 322.783 -1.03234 318.478 0.257655 315.602C1.50766 312.806 4.07666 314.579 5.80666 315.751C10.2927 318.771 14.6817 321.977 18.7617 325.532C22.8207 329.065 26.4177 332.976 29.5957 337.308C33.3797 342.473 37.0077 347.829 43.2507 350.173C43.4257 350.236 43.5207 350.357 43.5547 350.503Z" fill="#455A64"/>
                                <path d="M26.4717 337.425C21.2787 331.888 15.5027 326.832 9.56273 322.113C8.79573 321.497 6.56773 319.915 6.21973 321.691C5.81573 323.784 8.90773 326.249 10.0857 327.494C14.5747 332.218 19.3507 336.7 24.5587 340.631C30.3657 345.023 36.6287 348.569 43.5137 350.89C43.5367 350.847 43.5537 350.81 43.5597 350.762C32.3617 346.606 22.6487 339.326 14.1767 331.028C12.1367 329.024 10.0697 327.003 8.20073 324.836C7.90173 324.489 6.18673 322.154 6.85373 321.517C7.43773 320.959 9.85273 322.869 10.1377 323.113C11.4867 324.228 12.8297 325.348 14.1737 326.478C19.2177 330.756 23.8627 335.311 28.4207 340.095C32.8107 344.692 37.7417 348.277 43.5597 350.762C43.5827 350.676 43.5797 350.585 43.5547 350.503C36.7727 347.517 31.5337 342.814 26.4717 337.425Z" fill="white"/>
                                <path d="M26.5454 254.292C29.6594 258.562 32.3704 263.047 33.8514 268.154C36.1074 275.964 35.9754 284.136 37.0964 292.13C37.0954 292.163 37.1044 292.195 37.1084 292.222C37.4094 294.387 37.8084 296.546 38.3764 298.674C38.4924 299.127 38.6184 299.58 38.7554 300.033C38.7884 300.148 38.7674 300.249 38.7114 300.312C38.6604 300.358 38.5994 300.394 38.5294 300.407C38.4694 300.421 38.3994 300.423 38.3354 300.399L38.3304 300.394C38.2404 300.363 38.1564 300.295 38.1134 300.18C37.8874 299.539 37.6884 298.894 37.4944 298.244C37.4514 298.231 37.4204 298.208 37.3954 298.159C32.6204 288.181 27.2024 278.1 21.7814 268.23C19.3834 263.861 17.1544 259.337 15.6144 254.584C14.6984 251.772 13.5834 247.436 15.6364 244.837C15.7624 244.67 15.9574 244.511 16.1824 244.542C20.6984 245.309 24.0784 250.918 26.5454 254.292Z" fill="#455A64"/>
                                <path d="M21.5628 254.926C19.4028 254.23 19.8438 256.784 20.1938 258.077C21.1208 261.499 22.6618 264.855 24.0038 268.154C25.5178 271.876 27.0858 275.578 28.7098 279.251C31.7748 286.184 36.0548 293.088 38.3238 300.359C38.3228 300.37 38.3338 300.381 38.3328 300.392L38.3378 300.397C38.4018 300.421 38.4718 300.419 38.5318 300.405C38.6028 300.392 38.6638 300.357 38.7138 300.31C38.6018 299.761 38.4908 299.222 38.3788 298.672C37.9468 296.523 37.5318 294.369 37.1108 292.22C37.1068 292.193 37.0968 292.16 37.0988 292.128C35.0528 281.776 32.8038 271.517 27.3668 262.023C26.0958 259.818 24.2178 255.779 21.5628 254.926ZM28.0218 263.978C31.2448 269.99 33.3998 276.382 34.8898 282.94C36.0748 288.174 36.8788 293.479 37.9658 298.731C36.4628 294.513 34.2598 290.503 32.3628 286.42C29.3828 280.009 26.5638 273.523 23.9298 266.97C23.2908 265.395 22.6668 263.815 22.0558 262.224C21.5118 260.82 20.3478 258.629 20.3438 257.091C20.3308 254.113 22.8178 256.134 23.6268 257.015C24.3328 257.784 24.8878 258.682 25.4438 259.558C26.3638 261 27.2228 262.477 28.0218 263.978Z" fill="white"/>
                                <path d="M92.5332 308.118C91.1692 317.929 89.2972 327.396 86.6302 336.939C84.2042 345.621 81.6812 354.305 80.5022 363.265C78.9362 375.164 80.0112 388.205 86.0752 398.552C75.9402 386.814 68.0052 373.231 62.1842 358.615C52.4092 334.069 43.5562 308.839 31.6892 285.193C31.4922 284.8 30.9482 285.106 31.0952 285.497C35.9592 298.408 41.6712 311 46.6482 323.873C51.5912 336.656 56.1772 349.601 61.3492 362.292C61.9092 363.665 62.4912 365.022 63.0912 366.366C55.5132 356.976 44.4042 350.059 33.5012 346.048C33.3622 345.997 33.3042 346.207 33.4352 346.264C41.1832 349.675 48.2492 354.511 54.4602 360.238C59.8882 365.244 64.0182 371.042 68.3882 376.904C78.2672 394.485 92.0572 409.067 109.638 419.953C109.821 420.066 109.993 419.79 109.815 419.67C102.821 414.968 96.4672 409.588 90.7362 403.654C80.9842 390.748 80.5272 373.515 83.4352 357.856C84.9602 349.643 87.1332 341.583 89.0782 333.464C91.0502 325.234 93.2052 316.659 92.9982 308.138C92.9902 307.836 92.5742 307.824 92.5332 308.118Z" fill="#455A64"/>
                                <path class="theme-color" d="M400.56 419.978H37.4219V135.429L218.964 20.1445L400.56 135.429V419.978Z" fill="#FFE1D2"/>
                                <path d="M389.31 419.977H48.6758V141.302L218.968 33.1631L389.31 141.302V419.977Z" fill="#455A64"/>
                                <path d="M380.078 46H57.8984V419.978H380.078V46Z" fill="white" stroke="#DBDBDB" stroke-miterlimit="10"/>
                                <path d="M364.745 61.8857H73.2305V404.091H364.745V61.8857Z" stroke="#FFC727" stroke-miterlimit="10"/>
                                <path d="M358.61 68.0176H79.3594V397.959H358.61V68.0176Z" stroke="#FFC727" stroke-miterlimit="10"/>
                                <path d="M79.3607 55.7549H67.0977V68.0179H79.3607V55.7549Z" stroke="#FFC727" stroke-miterlimit="10"/>
                                <path d="M79.3607 397.959H67.0977V410.222H79.3607V397.959Z" stroke="#FFC727" stroke-miterlimit="10"/>
                                <path d="M370.876 397.959H358.613V410.222H370.876V397.959Z" stroke="#FFC727" stroke-miterlimit="10"/>
                                <path d="M370.876 55.7549H358.613V68.0179H370.876V55.7549Z" stroke="#FFC727" stroke-miterlimit="10"/>
                                <path class="theme-color" d="M400.56 178.804V419.978H37.4219V178.804C37.4219 178.804 206.312 281.218 219.018 289.18C231.67 281.218 400.56 178.804 400.56 178.804Z" fill="#FFE1D2"/>
                                <g opacity="0.1">
                                <path d="M203.337 279.568L37.4258 419.978L193.557 273.606C197.114 275.771 200.389 277.762 203.337 279.568Z" fill="#111111"/>
                                <path d="M400.561 419.978L234.66 279.579C237.608 277.784 240.883 275.782 244.441 273.617L400.561 419.978Z" fill="#111111"/>
                                </g>
                                <path class="theme-color" d="M400.56 419.979H37.4258L197.719 281.182C203.64 276.095 211.188 273.298 218.994 273.298C226.8 273.298 234.347 276.095 240.268 281.182L400.56 419.979Z" fill="#FFE1D2"/>
                                <path d="M27.1406 419.977C150.051 419.365 287.929 419.36 410.839 419.977C287.929 420.593 150.051 420.589 27.1406 419.977Z" fill="#263238"/>
                                <path d="M120.056 164.026L119.97 164.96C119.995 165.132 120.096 165.278 120.274 165.399C120.452 165.52 120.656 165.564 120.886 165.531C121.115 165.498 121.285 165.357 121.396 165.107C124.856 158.819 127.682 153.319 129.875 148.601C132.068 143.885 133.671 140.415 134.684 138.193C135.697 135.971 136.505 134.203 137.107 132.888C138.72 129.439 140.365 126.322 142.045 123.536C134.583 126.593 128.658 128.435 124.272 129.062C119.885 129.689 116.692 129.861 114.691 129.576C112.69 129.292 111.339 128.841 110.636 128.225C109.934 127.608 109.53 126.935 109.425 126.204C109.32 125.473 109.247 124.759 109.207 124.063C109.116 122.614 109.816 121.314 111.305 120.165C112.793 119.016 114.069 118.365 115.129 118.214C116.19 118.062 116.743 118.144 116.788 118.459C116.833 118.775 116.657 119.232 116.259 119.829C115.862 120.428 115.678 120.826 115.706 121.027C115.837 121.945 119.214 121.93 125.837 120.983C132.459 120.036 139.947 118.074 148.297 115.095C152.654 110.377 156.624 107.761 160.208 107.248C162.587 106.908 164.261 107.356 165.228 108.593C165.859 109.322 166.231 110.088 166.346 110.891C166.461 111.694 166.11 112.564 165.293 113.499C164.476 114.435 163.319 115.303 161.826 116.102C159.106 117.544 155.84 118.845 152.027 120.004C150.692 122.331 148.842 125.916 146.478 130.759C144.113 135.603 142.496 138.876 141.628 140.581C140.759 142.285 139.397 145.288 137.54 149.591C135.683 153.894 134.072 157.613 132.707 160.749C131.341 163.884 129.855 167.001 128.251 170.097C124.979 176.475 121.738 179.893 118.527 180.352C117.179 180.545 115.966 180.352 114.89 179.774C113.812 179.197 113.158 178.098 112.926 176.479C112.694 174.859 113.301 172.71 114.747 170.031C116.192 167.353 117.281 165.609 118.015 164.802C118.748 163.996 119.258 163.571 119.545 163.53C119.832 163.487 120.003 163.653 120.056 164.026Z" fill="#37474F"/>
                                <path d="M187.713 155.362C188.102 156.652 188.352 157.677 188.46 158.436C188.569 159.196 188.526 159.875 188.334 160.473C188.141 161.071 187.652 161.946 186.866 163.096C186.079 164.248 185.115 165.431 183.973 166.647C181.175 169.592 178.129 171.301 174.832 171.772C170.101 172.448 167.437 170.694 166.838 166.508C166.318 162.867 168.448 155.161 173.231 143.389C173.403 142.955 173.519 142.646 173.581 142.461C171.594 144.325 167.977 149.151 162.727 156.937C157.477 164.725 154.025 170.199 152.371 173.36C152.236 173.643 151.847 173.99 151.204 174.405C150.561 174.818 150.046 175.053 149.659 175.108C149.272 175.163 148.839 175.1 148.36 174.921C147.881 174.74 147.584 174.659 147.469 174.675C147.097 174.728 146.893 174.633 146.858 174.389C146.823 174.146 147.144 172.754 147.819 170.215C148.493 167.676 149.409 164.509 150.564 160.716C153.72 150.259 158.677 136.533 165.433 119.534C167.799 113.578 169.707 109.327 171.157 106.778C172.184 104.964 174.189 103.843 177.171 103.417C177.802 103.327 178.187 103.463 178.327 103.823C178.466 104.183 178.566 104.578 178.628 105.009C178.689 105.439 178.665 105.881 178.555 106.336L174.98 114.176C167.896 129.7 162.714 142.465 159.435 152.471C163.128 146.385 166.871 141.563 170.663 138.007C173.006 135.77 174.829 134.559 176.134 134.373C177.439 134.187 178.651 134.225 179.771 134.489C180.891 134.754 181.565 135.674 181.79 137.251C181.872 137.824 181.243 140.079 179.904 144.015C175.887 155.824 173.966 162.337 174.141 163.556C174.315 164.775 174.903 165.312 175.907 165.169C177.369 164.96 179.417 163.219 182.05 159.946C184.036 157.467 185.287 155.884 185.803 155.196C186.111 154.889 186.407 154.715 186.694 154.674C187.238 154.596 187.578 154.825 187.713 155.362Z" fill="#37474F"/>
                                <path d="M214.443 131.133C216.622 130.822 217.818 131.411 218.031 132.902C218.146 133.705 218.043 134.32 217.724 134.745C217.404 135.171 216.786 136.525 215.869 138.806C214.952 141.088 213.99 143.976 212.983 147.469C211.976 150.963 211.423 153.901 211.325 156.285C211.28 156.584 211.294 156.992 211.368 157.508C211.593 159.085 212.137 159.812 212.996 159.689C213.856 159.566 214.816 159.012 215.874 158.026C216.933 157.041 217.854 156.018 218.638 154.954C219.422 153.891 220.182 152.81 220.917 151.71C221.652 150.61 222.096 149.977 222.247 149.808C222.399 149.64 222.647 149.531 222.99 149.482C223.535 149.404 223.924 149.773 224.157 150.588C224.391 151.403 224.571 152.255 224.698 153.144C224.825 154.033 224.827 154.661 224.705 155.03C224.106 156.783 222.56 159.008 220.064 161.705C217.567 164.402 215.165 165.917 212.858 166.247C210.55 166.577 208.751 166.117 207.461 164.868C206.17 163.619 205.404 162.142 205.16 160.436C204.916 158.73 204.988 157.191 205.377 155.819C203.44 159.256 201.085 162.269 198.31 164.86C195.535 167.451 193.174 168.886 191.224 169.165C189.274 169.444 187.599 169.083 186.199 168.084C184.413 166.847 183.335 164.932 182.964 162.337C182.593 159.743 182.8 157.05 183.586 154.261C184.372 151.471 185.556 148.86 187.139 146.424C188.722 143.989 190.519 141.721 192.529 139.619C196.755 135.212 200.875 132.722 204.89 132.148C206.438 131.927 207.736 132.004 208.785 132.38C209.833 132.757 210.542 133.314 210.911 134.051C211.452 132.921 211.939 132.186 212.373 131.846C212.807 131.506 213.497 131.268 214.443 131.133ZM209.406 136.724C204.504 137.425 199.818 140.874 195.35 147.072C193.765 149.288 192.386 151.87 191.213 154.817C190.04 157.764 189.526 159.74 189.669 160.743C189.812 161.747 190.17 162.207 190.744 162.125C191.546 162.01 193.557 160.107 196.773 156.414C199.99 152.722 202.094 150.044 203.085 148.381C204.166 146.529 206.273 142.643 209.406 136.724Z" fill="#37474F"/>
                                <path d="M243.671 153.548C243.851 154.81 244.802 155.317 246.522 155.071C247.439 154.94 248.528 154.316 249.787 153.2C251.046 152.084 252.157 150.902 253.119 149.652C255.678 146.273 257.159 144.554 257.56 144.497C258.306 144.39 258.832 145.412 259.139 147.563C259.446 149.713 258.984 151.287 257.752 152.282C254.181 156.567 251.334 159.27 249.213 160.393C248.012 161.003 246.651 161.402 245.128 161.592C243.604 161.78 242.004 161.336 240.329 160.259C238.653 159.182 237.684 157.719 237.42 155.87C237.156 154.021 237.343 151.851 237.981 149.361C238.619 146.871 239.328 144.714 240.106 142.891C240.884 141.068 241.86 138.939 243.032 136.504C244.205 134.07 244.796 132.573 244.805 132.016L244.707 131.942C243.773 132.163 241.696 134.362 238.475 138.538C235.254 142.714 232.618 146.324 230.566 149.367C228.514 152.411 226.119 156.426 223.379 161.41C222.609 162.778 221.923 163.505 221.321 163.591C220.719 163.677 219.881 163.6 218.809 163.357C217.736 163.116 217.072 162.925 216.818 162.786C216.564 162.647 216.413 162.405 216.364 162.061C216.315 161.717 216.355 161.28 216.483 160.75C216.612 160.22 216.746 159.777 216.885 159.42C217.025 159.064 217.259 158.511 217.591 157.761C217.922 157.011 218.567 155.435 219.525 153.031C220.483 150.627 221.965 147.028 223.972 142.236C225.978 137.444 227.174 134.552 227.559 133.561C228.378 131.513 229.07 130.009 229.635 129.051C230.691 127.232 232.753 126.104 235.821 125.665C236.509 125.567 236.915 125.947 237.038 126.808C237.231 128.156 236.346 130.871 234.385 134.954L232.966 137.922C237.138 131.708 240.826 127.627 244.029 125.677C245.589 124.723 247.037 124.15 248.37 123.959C249.703 123.768 250.814 123.976 251.706 124.579C252.597 125.183 253.105 125.922 253.23 126.797C253.355 127.672 253.204 128.761 252.776 130.065C252.348 131.37 251.894 132.547 251.415 133.595C250.935 134.644 250.299 135.971 249.505 137.577C248.71 139.182 248.28 140.056 248.212 140.197C248.144 140.338 247.972 140.715 247.693 141.325C247.414 141.935 247.207 142.382 247.072 142.664C246.937 142.947 246.715 143.44 246.406 144.142C246.096 144.845 245.851 145.428 245.669 145.893C245.487 146.358 245.261 146.932 244.993 147.614C244.724 148.296 244.516 148.882 244.367 149.371C244.217 149.861 244.067 150.394 243.915 150.972C243.658 152.029 243.577 152.888 243.671 153.548Z" fill="#37474F"/>
                                <path d="M257.41 159.395L254.571 159.187C253.728 159.22 252.964 158.789 252.279 157.891C252.099 157.653 251.983 157.509 251.932 157.458C251.881 157.407 251.849 157.338 251.837 157.252C251.825 157.166 251.836 157.04 251.871 156.874C251.906 156.709 251.961 156.481 252.036 156.192C252.113 155.904 252.172 155.61 252.217 155.31C252.528 153.189 256.191 142.893 263.204 124.425C270.218 105.956 273.909 96.4253 274.278 95.8313C274.646 95.2373 274.921 94.8033 275.101 94.5293C275.281 94.2553 275.495 94.0123 275.743 93.8003C275.99 93.5903 276.175 93.4463 276.296 93.3703C276.417 93.2943 276.661 93.1643 277.03 92.9803C277.398 92.7963 277.78 92.6023 278.176 92.3993C278.571 92.1973 278.981 91.9403 279.404 91.6313C279.828 91.3233 280.119 91.1053 280.277 90.9803C280.434 90.8563 280.649 90.7733 280.921 90.7343C281.194 90.6953 281.47 90.7873 281.75 91.0103C282.03 91.2333 282.2 91.5463 282.258 91.9473L282.301 92.2483C282.237 92.8143 279.473 100.143 274.013 114.234C268.553 128.327 265.582 136.036 265.098 137.363C267.208 136.155 270.191 133.49 274.048 129.369C277.906 125.248 279.774 122.612 279.653 121.459C279.532 120.306 279.807 119.418 280.479 118.796C281.15 118.173 281.923 117.799 282.798 117.674C283.673 117.549 284.46 117.737 285.161 118.236C285.861 118.735 286.291 119.654 286.454 120.991C286.614 122.329 286.113 124.127 284.943 126.386C283.774 128.645 282.297 130.795 280.511 132.834C276.657 137.189 273.355 140.176 270.602 141.799C273.822 147.746 276.937 150.504 279.947 150.074C281.548 149.611 283.364 147.991 285.396 145.213C286.157 144.198 286.889 143.179 287.592 142.156C288.294 141.134 288.727 140.524 288.888 140.325C289.049 140.127 289.302 140.003 289.647 139.954C290.191 139.876 290.581 140.245 290.815 141.06C291.049 141.875 291.229 142.727 291.356 143.616C291.483 144.505 291.484 145.133 291.361 145.502C290.76 147.227 289.219 149.443 286.739 152.153C284.259 154.862 281.758 156.398 279.235 156.759C277.429 157.017 275.946 156.878 274.787 156.341C273.628 155.805 272.714 155.351 272.047 154.978C271.379 154.606 270.674 154.07 269.93 153.372C269.187 152.674 268.57 152.096 268.08 151.639C267.591 151.183 267.015 150.534 266.354 149.692C265.692 148.851 265.219 148.253 264.934 147.898C264.649 147.544 264.222 146.962 263.653 146.15C263.083 145.34 262.764 144.895 262.695 144.817C262.331 145.952 261.921 147.181 261.467 148.504C261.012 149.827 260.603 151.056 260.238 152.19C259.874 153.325 259.539 154.36 259.234 155.296C258.929 156.232 258.681 157.006 258.491 157.618C258.3 158.23 258.192 158.553 258.168 158.585C258.036 159.071 257.782 159.341 257.41 159.395Z" fill="#37474F"/>
                                <path d="M201.1 236.02C200.976 236.184 200.643 236.97 200.099 238.379C199.554 239.787 198.962 241.219 198.321 242.671C197.68 244.123 196.837 245.539 195.791 246.917C194.744 248.295 193.82 249.093 193.018 249.311C192.215 249.528 191.699 249.653 191.47 249.686C188.832 250.063 187.322 248.918 186.941 246.251C186.494 243.127 187.591 239.239 190.233 234.591C191.24 232.837 192.545 230.917 194.149 228.83C195.752 226.743 196.622 225.564 196.76 225.296C196.897 225.028 198.472 220.7 201.486 212.311C199.164 215.715 196.962 218.525 194.879 220.738C192.796 222.952 190.682 224.33 188.536 224.871L188.235 224.914C187.117 225.074 185.961 224.867 184.767 224.291C183.572 223.716 182.844 222.51 182.582 220.675C182.193 217.952 182.547 215.21 183.644 212.449C184.033 211.487 184.714 209.854 185.686 207.549C186.658 205.246 187.548 203.026 188.355 200.893C189.161 199.168 189.96 197.181 190.75 194.933C191.54 192.685 192.157 191.068 192.602 190.083C193.046 189.098 193.526 188.569 194.042 188.495C194.558 188.421 195.271 188.648 196.18 189.177C197.09 189.705 197.608 190.414 197.735 191.302C197.862 192.192 196.535 196.316 193.755 203.676C190.974 211.037 189.652 215.19 189.788 216.136C189.821 216.366 189.951 216.464 190.181 216.431C190.955 216.32 192.512 214.979 194.85 212.406C197.188 209.833 199.717 206.597 202.436 202.698C205.474 198.372 207.786 194.488 209.371 191.043C209.572 190.604 209.736 190.267 209.863 190.029C209.989 189.792 210.15 189.478 210.342 189.083C210.534 188.691 210.695 188.383 210.824 188.159C210.953 187.936 211.105 187.673 211.281 187.369C211.457 187.066 211.621 186.831 211.772 186.663C211.924 186.495 212.089 186.325 212.269 186.153C212.544 185.822 212.875 185.627 213.261 185.572C213.648 185.517 214.248 185.519 215.061 185.578C215.874 185.637 216.374 185.756 216.56 185.934C216.746 186.112 216.938 186.275 217.135 186.422C217.466 186.697 217.652 186.97 217.691 187.242C217.73 187.515 217.666 187.888 217.501 188.365C217.334 188.843 216.327 191.305 214.476 195.754C209.038 208.877 205.369 218.413 203.47 224.359C207.303 220.066 212.662 213.756 219.546 205.429C219.824 205.126 220.122 204.952 220.437 204.907C221.325 204.78 221.965 206.078 222.354 208.802C222.469 209.604 222.4 210.155 222.151 210.454C214.522 218.275 207.505 226.795 201.1 236.02Z" fill="#37474F"/>
                                <path d="M244.905 181.749C245.765 181.626 246.702 181.887 247.716 182.532C248.73 183.177 249.35 184.296 249.578 185.886C249.805 187.477 249.542 189.621 248.786 192.319C248.03 195.016 246.865 197.815 245.291 200.717C243.717 203.62 241.926 206.392 239.919 209.033C237.912 211.676 235.66 213.929 233.162 215.793C230.664 217.656 228.311 218.746 226.104 219.062C223.896 219.378 222.027 218.935 220.495 217.736C218.963 216.537 218.02 214.697 217.665 212.216C217.31 209.737 217.526 206.904 218.315 203.72C219.103 200.535 220.293 197.652 221.883 195.069C223.473 192.487 225.256 190.118 227.23 187.963C231.366 183.54 235.198 181.076 238.724 180.571C240.301 180.346 241.546 180.563 242.459 181.222C242.782 181.439 242.959 181.648 242.987 181.848L243.024 182.106C243.418 181.991 244.045 181.872 244.905 181.749ZM241.379 188.089L241.078 188.132C240.074 188.275 239.468 187.616 239.259 186.154C237.264 187.142 235.243 188.66 233.196 190.708C231.148 192.755 229.389 195.085 227.919 197.694C224.921 202.92 223.626 207.157 224.031 210.405C224.261 212.011 224.962 212.729 226.138 212.561C227.313 212.393 228.952 211.369 231.053 209.489C233.154 207.61 235.139 205.074 237.008 201.88C238.877 198.687 240.227 195.955 241.059 193.687C241.89 191.417 242.251 189.903 242.142 189.143C242.035 188.383 241.78 188.032 241.379 188.089Z" fill="#37474F"/>
                                <path d="M287.139 195.372C287.683 195.294 288.072 195.663 288.306 196.477C288.539 197.293 288.72 198.144 288.847 199.033C288.974 199.923 288.976 200.55 288.853 200.919C288.251 202.644 286.71 204.861 284.231 207.57C281.751 210.279 279.249 211.815 276.727 212.176C275.179 212.397 273.678 212.136 272.227 211.393C270.775 210.651 269.883 209.117 269.551 206.795C269.219 204.473 269.509 202.105 270.423 199.693C264.587 209.626 259.649 214.882 255.606 215.46C254 215.69 252.621 215.301 251.468 214.296C250.315 213.291 249.651 212.179 249.477 210.96C249.303 209.742 249.295 208.456 249.452 207.102C249.61 205.749 249.809 204.528 250.048 203.441C250.287 202.354 250.678 200.997 251.221 199.368C251.763 197.74 252.172 196.554 252.446 195.814C252.72 195.072 253.167 193.948 253.785 192.441C254.403 190.933 255.211 188.909 256.208 186.367C257.205 183.827 258.06 181.927 258.773 180.669C259.485 179.412 260.256 178.717 261.086 178.583C261.916 178.45 262.694 178.682 263.424 179.28C264.152 179.878 264.548 180.392 264.609 180.822C264.67 181.252 263.986 183.325 262.558 187.039C258.349 198.115 256.365 204.499 256.607 206.189C256.669 206.62 256.856 206.812 257.172 206.766C258.548 206.569 261.547 203.099 266.171 196.351C270.794 189.605 273.416 185.332 274.037 183.532C274.657 181.732 275.294 180.2 275.947 178.937C276.6 177.673 277.109 176.884 277.474 176.568C278.591 175.59 280.121 174.932 282.063 174.595C282.378 174.55 282.624 174.53 282.8 174.534C282.976 174.538 283.211 174.753 283.507 175.179C283.801 175.605 283.967 175.947 284.004 176.205C283.861 177.045 283.027 179.343 281.501 183.101C279.976 186.859 279.132 188.985 278.967 189.476C276.584 196.955 275.545 201.756 275.848 203.877C276.02 205.081 276.564 205.617 277.482 205.486C279.112 205.02 280.928 203.399 282.931 200.626C283.664 199.615 284.387 198.589 285.102 197.551C285.816 196.513 286.263 195.9 286.441 195.714C286.619 195.527 286.852 195.413 287.139 195.372Z" fill="#37474F"/>
                                <path d="M291.276 208.667C291.016 206.848 291.54 205.091 292.849 203.396C294.156 201.703 295.65 200.735 297.327 200.495C299.004 200.255 299.962 200.968 300.2 202.63C300.438 204.293 299.905 206.051 298.606 207.905C297.306 209.759 295.824 210.803 294.162 211.041C292.497 211.279 291.536 210.488 291.276 208.667ZM324.226 137.714L327.599 137.67C328.315 137.568 328.706 137.747 328.772 138.205C328.784 138.291 328.754 138.486 328.68 138.789C321.657 153.105 313.961 169.872 305.592 189.09C305.134 190.18 304.63 190.851 304.081 191.105C304.052 191.109 304.026 191.128 304.001 191.161C303.976 191.194 303.931 191.237 303.866 191.289C303.801 191.343 303.712 191.392 303.603 191.437C303.197 191.671 302.708 191.829 302.134 191.911C301.561 191.993 301.172 192.136 300.967 192.341C300.762 192.545 300.33 192.694 299.671 192.788C298.61 192.94 298.002 192.472 297.847 191.382C297.572 189.462 299.328 184.2 303.116 175.598C306.903 166.997 310.678 158.968 314.439 151.511C318.2 144.054 320.666 139.716 321.837 138.495C322.168 138.155 322.963 137.895 324.226 137.714Z" fill="#37474F"/>
                                <path d="M349.061 421.575C346.105 422.745 259.94 425.147 256.548 423.252C256.178 423.04 256.243 419.235 254.879 409.408C254.811 408.939 252.828 407.133 249.735 404.589C238.116 395.039 210.836 374.939 210.836 374.939L253.481 337.156L295.555 377.718L306.499 388.263C306.499 388.263 341.894 406.934 345.405 409.411C348.892 411.901 352.017 420.405 349.061 421.575Z" fill="#D3766A"/>
                                <path d="M349.06 421.571C346.101 422.749 259.937 425.145 256.549 423.254C256.183 423.042 256.248 419.239 254.878 409.406C254.817 408.94 252.83 407.138 249.732 404.584C245.693 401.265 243.775 399.751 237.766 395.165L292.249 374.532L295.558 377.721L306.496 388.269C306.496 388.269 341.894 406.934 345.401 409.416C348.887 411.898 352.02 420.404 349.06 421.571Z" fill="#EBEBEB"/>
                                <path d="M355.011 422.705C352.027 423.775 260.216 425.671 256.89 423.668C256.108 423.198 255.344 417.872 254.704 410.571C254.624 409.656 245.251 402.311 243.965 400.947L300.048 381.45L307.218 388.067C307.218 388.067 348.813 406.933 352.224 409.521C355.617 412.111 357.994 421.636 355.011 422.705Z" fill="#FFC727"/>
                                <path opacity="0.4" d="M355.011 422.705C352.027 423.775 260.216 425.671 256.89 423.668C256.108 423.198 255.344 417.872 254.704 410.571C254.624 409.656 245.251 402.311 243.965 400.947L300.048 381.45L307.218 388.067C307.218 388.067 348.813 406.933 352.224 409.521C355.617 412.111 357.994 421.636 355.011 422.705Z" fill="#111111"/>
                                <path d="M353.701 419.291C339.273 419.245 275.289 420.479 261.023 421.531C260.907 421.539 260.91 421.618 261.026 421.621C275.325 421.978 339.298 420.273 353.706 419.527C354.011 419.511 354.006 419.292 353.701 419.291Z" fill="#263238"/>
                                <path d="M311.811 388.631C306.114 387.694 299.192 388.713 294.943 392.848C294.778 393.009 295.008 393.24 295.191 393.178C300.752 391.294 305.955 390.049 311.804 389.348C312.216 389.299 312.219 388.699 311.811 388.631Z" fill="#263238"/>
                                <path d="M315.96 391.012C310.263 390.075 303.342 391.094 299.092 395.23C298.927 395.39 299.157 395.622 299.34 395.56C304.901 393.675 310.104 392.431 315.953 391.729C316.365 391.681 316.368 391.08 315.96 391.012Z" fill="#263238"/>
                                <path d="M320.108 393.393C314.411 392.455 307.489 393.475 303.24 397.61C303.075 397.77 303.305 398.002 303.488 397.94C309.049 396.056 314.252 394.811 320.101 394.11C320.513 394.061 320.516 393.46 320.108 393.393Z" fill="#263238"/>
                                <path d="M324.257 395.774C318.56 394.836 311.638 395.856 307.389 399.991C307.224 400.151 307.454 400.383 307.637 400.321C313.198 398.437 318.401 397.192 324.25 396.491C324.662 396.442 324.665 395.841 324.257 395.774Z" fill="#263238"/>
                                <path d="M322.011 375.283C319.716 372.26 315.593 373.73 313.267 375.771C309.499 379.077 306.249 384.184 304.806 388.956C304.77 389.074 304.85 389.143 304.944 389.158C304.97 389.589 305.367 390.038 305.85 389.848C310.498 388.013 315.695 386.627 319.642 383.419C321.945 381.547 324.182 378.143 322.011 375.283ZM312.327 385.624C310.062 386.582 307.765 387.423 305.537 388.465C307.195 385.898 308.733 383.272 310.648 380.873C311.562 379.729 312.522 378.57 313.586 377.559C315.241 375.987 321.855 372.575 320.988 378.822C320.51 382.267 315.026 384.482 312.327 385.624Z" fill="#263238"/>
                                <path d="M290.35 387.784C295.07 389.677 300.444 389.462 305.428 389.838C305.945 389.877 306.191 389.33 306.088 388.911C306.173 388.869 306.229 388.779 306.16 388.678C303.366 384.547 298.749 380.632 294.172 378.592C291.345 377.332 286.972 377.15 285.676 380.717C284.449 384.091 287.594 386.678 290.35 387.784ZM287.702 383.794C285.023 378.084 292.351 379.382 294.397 380.394C295.712 381.044 296.973 381.865 298.185 382.688C300.725 384.412 302.972 386.463 305.316 388.425C302.879 388.09 300.435 387.967 297.988 387.723C295.073 387.431 289.179 386.941 287.702 383.794Z" fill="#263238"/>
                                <path d="M296.128 375.428L243.233 403.491C243.233 403.491 187.365 353.895 182.288 353.575C177.358 353.264 103.192 404.53 65.6856 405.051C26.8366 405.591 24.4766 364.907 24.4766 364.907L81.0226 351.342C121.68 330.811 163.882 294.237 191.746 297.34C222.008 300.711 296.128 375.428 296.128 375.428Z" fill="#263238"/>
                                <path d="M283.072 368.539C274.141 373.061 276.644 371.644 267.762 376.261C263.415 378.521 241.541 389.826 237.836 392.608C237.754 392.669 237.83 392.812 237.927 392.779C242.306 391.265 263.931 379.491 268.236 377.152C277.033 372.373 274.458 373.654 283.203 368.783C283.366 368.692 283.24 368.454 283.072 368.539Z" fill="#37474F"/>
                                <path d="M233.692 390.882C223.21 381.818 188.867 352.315 187.475 351.22C186.354 350.338 185.219 349.186 183.904 348.595C182.783 348.091 181.688 348.385 180.627 348.892C179.06 349.641 177.526 350.463 175.972 351.24C172.915 352.769 169.858 354.298 166.802 355.827C154.949 361.756 143.164 367.836 131.216 373.574C119.727 379.092 111.537 384.261 99.5233 388.535C87.5753 392.786 75.2163 396.052 62.6293 397.71C61.0783 397.914 59.5224 398.093 57.9654 398.253C57.8524 398.264 57.8564 398.437 57.9714 398.431C70.3464 397.709 82.5074 395.059 94.3004 391.308C106.207 387.521 114.264 382.676 125.555 377.347C137.257 371.824 148.786 365.925 160.317 360.054C166.405 356.955 172.478 353.826 178.584 350.762C179.968 350.067 181.935 348.572 183.531 349.287C184.22 349.596 184.799 350.148 185.378 350.62C186.064 351.179 186.749 351.738 187.434 352.297C190.085 354.459 232.174 390.007 233.553 391.03C233.655 391.108 233.793 390.97 233.692 390.882Z" fill="#37474F"/>
                                <path opacity="0.1" d="M287.988 379.748L243.228 403.492C243.228 403.492 187.364 353.899 182.29 353.573C177.362 353.266 103.195 404.527 65.6897 405.048C26.8397 405.592 24.4727 364.912 24.4727 364.912L81.0177 351.342C95.5747 343.991 110.341 334.582 124.56 325.669L287.988 379.748Z" fill="#111111"/>
                                <path d="M24.4613 358.165C24.4613 358.165 16.5673 403.049 35.3253 416.995C54.0833 430.942 188.635 425.613 208.882 418.469C229.129 411.324 228.89 378.351 206.36 371.31C184.933 364.613 94.4963 363.49 92.2433 362.659C91.6793 362.451 100.112 357.085 100.067 356.773L79.3433 351.039L24.4613 358.165Z" fill="#263238"/>
                                <path d="M52.7312 365.499C52.7012 365.343 52.4582 365.4 52.4622 365.55C52.5912 369.702 51.1682 374.113 48.5252 377.334C45.4942 381.028 40.9362 383.173 36.8132 385.398C36.4172 385.612 36.7382 386.233 37.1512 386.097C39.6772 385.265 42.1582 384.087 44.4452 382.721C46.5282 381.477 48.4422 379.935 49.8722 377.959C52.5112 374.315 53.5892 369.93 52.7312 365.499Z" fill="#37474F"/>
                                <path d="M90.6613 358.824C89.6973 357.658 88.6513 356.552 87.6473 355.42C85.2743 352.744 82.8893 350.056 80.4073 347.479C80.1723 347.235 79.7343 347.601 79.9523 347.869C81.6323 349.949 83.4063 351.959 85.1523 353.984C86.0473 355.022 86.9453 356.057 87.8493 357.087C88.6943 358.049 89.7333 358.998 90.3703 360.116C91.0313 361.276 90.2303 362.305 89.0133 362.467C87.9243 362.613 86.9023 362.083 86.0473 361.463C84.1043 360.056 82.5523 358.008 80.9213 356.268C79.9233 355.204 78.9263 354.141 77.9133 353.09C76.8373 351.973 75.6923 350.917 74.6193 349.802C74.5503 349.73 74.4233 349.837 74.4853 349.917C75.4313 351.141 76.3073 352.427 77.2543 353.655C78.2003 354.882 79.1593 356.097 80.1343 357.302C81.0573 358.442 82.0103 359.557 82.9903 360.649C83.8223 361.577 84.7643 362.477 85.8633 363.084C87.6383 364.065 90.6773 364.206 91.5463 361.924C91.9753 360.797 91.3713 359.682 90.6613 358.824Z" fill="#37474F"/>
                                <path d="M204.885 418.613C197.857 418.931 190.841 419.527 183.812 419.865C176.841 420.2 169.865 420.425 162.886 420.545C148.871 420.786 134.849 420.624 120.843 420.031C106.691 419.431 91.4173 418.43 77.3343 416.86C70.5953 416.109 63.7683 415.516 57.0943 414.265C51.0733 413.137 45.5773 410.795 40.9793 406.567C31.6563 397.995 29.2203 382.083 29.5413 363.112C29.5433 362.998 29.3743 363.006 29.3693 363.121C28.8013 375.893 28.6873 393.673 36.9453 403.667C40.5183 407.991 45.0103 411.491 50.2213 413.42C56.5723 415.771 63.5643 416.175 70.2223 416.898C84.3623 418.434 99.6983 419.502 113.897 420.224C128.186 420.95 142.498 421.258 156.803 421.088C171.106 420.918 185.413 420.335 199.677 419.252C201.419 419.12 203.156 418.971 204.892 418.772C204.992 418.762 204.986 418.609 204.885 418.613Z" fill="#37474F"/>
                                <path d="M160.32 365.835C155.877 365.304 151.442 364.786 146.979 364.441C142.472 364.093 137.96 363.81 133.448 363.549C124.523 363.032 115.577 362.593 106.639 362.412C101.56 362.309 96.4896 362.42 91.4146 362.619C91.2506 362.626 91.2716 362.858 91.4276 362.868C100.376 363.439 109.323 363.764 118.281 364.12C127.22 364.475 136.151 365.021 145.075 365.633C150.137 365.98 155.2 366.217 160.265 366.494C160.637 366.514 160.693 365.88 160.32 365.835Z" fill="#37474F"/>
                                <path d="M101.105 356.296C97.5521 357.875 94.2381 359.906 91.0051 362.055C87.8141 364.177 84.5581 366.389 81.6961 368.943C81.6141 369.016 81.7291 369.118 81.8111 369.077C85.2461 367.376 88.5341 365.273 91.7941 363.258C95.0681 361.234 98.3232 359.171 101.332 356.765C101.544 356.595 101.399 356.166 101.105 356.296Z" fill="#37474F"/>
                                <path d="M74.7828 286.68C75.9788 307.609 82.1138 340.92 92.6778 342.714C102.323 344.352 126.946 331.294 136.967 327.38C147.051 323.441 130.936 297.698 125.121 300.303C116.113 304.338 102.332 311.967 100.434 310.945C98.0678 309.671 96.0198 302.888 85.0708 281.973C80.5908 273.416 74.2738 277.771 74.7828 286.68Z" fill="#D3766A"/>
                                <path d="M136.361 293.617C140.875 292.907 145.996 291.733 150.686 292.697C155.376 293.662 158.127 300.603 157.796 302.382C157.465 304.161 153.624 314.927 148.917 314.051C144.211 313.175 148.639 305.179 148.643 304.169C148.647 303.159 148.702 301.877 147.797 301.803C146.892 301.73 129.98 306.208 129.98 306.208L136.361 293.617Z" fill="#D3766A"/>
                                <path d="M136.542 294.322C136.808 294.372 150.343 291.746 155.034 292.71C159.724 293.675 162.475 300.615 162.144 302.394C161.813 304.173 157.971 314.94 153.265 314.064C148.559 313.188 152.987 305.192 152.991 304.182C152.995 303.172 153.05 301.89 152.145 301.816C151.24 301.743 134.328 306.221 134.328 306.221L136.542 294.322Z" fill="#D3766A"/>
                                <path d="M151.777 313.171C151.335 312.319 151.443 311.181 151.511 310.244C151.585 309.221 151.857 308.218 152.241 307.27C152.575 306.446 153.099 305.662 153.294 304.788C153.474 303.979 153.359 302.958 153.101 302.177C152.86 301.449 152.127 301.546 151.494 301.645C150.561 301.791 149.626 302.068 148.719 302.325C147.737 302.603 146.76 302.904 145.782 303.199C144.777 303.502 143.729 303.762 142.77 304.192C142.698 304.224 142.719 304.344 142.804 304.331C143.68 304.198 144.535 303.924 145.391 303.702C146.363 303.449 147.336 303.203 148.313 302.969C149.225 302.751 150.127 302.484 151.042 302.282C151.365 302.21 152.025 302.001 152.351 302.141C152.696 302.289 152.709 303.204 152.735 303.506C152.819 304.455 152.51 305.188 152.099 306.019C151.703 306.819 151.364 307.645 151.132 308.508C150.918 309.303 150.785 310.172 150.872 310.997C150.955 311.79 151.353 312.491 151.617 313.23C151.656 313.337 151.827 313.267 151.777 313.171Z" fill="#263238"/>
                                <path d="M119.312 303.897C119.312 303.897 134.567 294.438 137.722 292.582C144.05 288.859 168.734 283.758 171.994 284.015C175.254 284.271 175.189 291.041 158.352 294.951C149.478 297.012 147.142 301.44 146.813 304.074C146.485 306.708 148.068 312.025 152.471 312.722C156.874 313.419 160.905 307.554 165.063 307.593C169.221 307.632 165.19 314.515 161.555 318.249C157.92 321.983 152.11 324.538 148.056 325.254C144.003 325.97 131.337 328.839 131.337 328.839L119.312 303.897Z" fill="#D3766A"/>
                                <path d="M158.48 310.654C156.593 311.625 154.416 312.932 152.23 312.61C149.97 312.277 148.783 310.548 148.081 308.525C147.374 306.486 147.155 304.269 148.059 302.253C148.873 300.437 150.318 298.968 151.975 297.898C154.025 296.574 156.316 295.734 158.645 295.053C158.749 295.022 158.691 294.869 158.584 294.894C156.4 295.42 149.652 296.82 147.367 302.125C146.433 304.292 146.737 306.437 147.439 308.526C148.085 310.45 149.185 312.395 151.277 312.963C153.827 313.655 156.447 311.965 158.598 310.739C158.693 310.684 158.579 310.603 158.48 310.654Z" fill="#263238"/>
                                <path d="M119.622 302.235L133.498 336.152C133.498 336.152 99.3164 347.734 91.0794 343.308C82.8424 338.883 74.2854 311.315 72.9374 288.272C71.5894 265.228 83.5424 276.183 87.5244 283.968C91.5064 291.753 99.9664 309.611 100.626 309.519C101.286 309.428 119.622 302.235 119.622 302.235Z" fill="#37474F"/>
                                <path d="M123.74 339.151C121.641 339.766 119.334 340.393 116.927 341.001L105.633 307.664C107.628 306.914 109.949 306.006 112.129 305.162C115.702 315.595 120.043 328.271 123.74 339.151Z" fill="#455A64"/>
                                <path d="M114.319 341.651C113.591 341.825 112.85 341.996 112.112 342.155L100.977 309.414C101.39 309.272 102.11 309.006 103.037 308.663C106.555 318.905 110.737 331.126 114.319 341.651Z" fill="#455A64"/>
                                <path d="M109.713 342.667C102.128 344.232 94.8136 345.036 91.3716 343.454C91.2646 343.408 91.1716 343.352 91.0766 343.309C82.8426 338.877 74.2866 311.32 72.9326 288.273C72.6916 284.169 72.8816 281.138 73.3596 278.984C73.3806 278.872 73.4116 278.775 73.4326 278.663C73.4776 278.491 73.5226 278.319 73.5796 278.149C73.5936 278.074 73.6176 278.014 73.6436 277.942C73.6866 277.782 73.7416 277.625 73.7936 277.48L109.713 342.667Z" fill="#263238"/>
                                <path d="M123.158 331.147C122.742 329.957 122.315 328.771 121.885 327.586C121.024 325.214 115.829 311.124 113.561 306.717C113.5 306.599 113.323 306.687 113.355 306.808C114.611 311.628 120.126 325.538 121.049 327.832C121.521 329.006 121.995 330.178 122.481 331.347C122.97 332.523 123.594 333.637 124.077 334.813C124.124 334.928 124.31 334.879 124.267 334.757C123.847 333.573 123.574 332.336 123.158 331.147Z" fill="#263238"/>
                                <path d="M100.426 361.653L20.9688 366.265C21.0658 364.643 34.5778 305.325 56.4538 277.808C62.3028 270.451 74.9797 264.989 81.0207 278C87.4007 291.746 101.511 360.645 100.426 361.653Z" fill="#455A64"/>
                                <path d="M76.0038 288.87C71.3548 288.961 65.2198 280.564 63.4018 274.438C63.2798 274.017 64.7098 270.183 66.2268 265.441C67.1358 262.56 68.0808 259.33 68.7298 256.321C68.8608 255.703 86.6138 264.978 86.6138 264.978C86.6138 264.978 83.3978 270.886 82.2978 276.139C82.2108 276.579 82.1658 276.996 82.1608 277.402C82.1548 277.46 82.1568 277.532 82.1438 277.612C82.0218 280.04 80.4978 288.779 76.0038 288.87Z" fill="#D3766A"/>
                                <path d="M69.8718 256.649C69.6498 261.925 70.1628 274.9 80.1848 277.3C80.8828 277.468 81.5338 277.572 82.1378 277.612C82.1608 277.529 82.1538 277.463 82.1578 277.4C82.1688 276.992 82.2068 276.579 82.2898 276.14C83.3938 270.878 86.6138 264.972 86.6138 264.972C86.6138 264.972 73.8068 258.281 69.8718 256.649Z" fill="#263238"/>
                                <path d="M98.1094 233.102C98.1094 233.102 102.197 235.542 102.857 239.78C103.881 246.356 99.2504 254.46 99.2504 254.46L98.1094 233.102Z" fill="#263238"/>
                                <path d="M71.4408 233.076C67.7308 239.197 66.3648 259.255 69.9978 264.728C75.2658 272.662 86.3158 276.1 93.6698 269.213C100.798 262.538 102.116 236.365 97.8308 231.143C91.5188 223.449 76.9218 224.034 71.4408 233.076Z" fill="#D3766A"/>
                                <path d="M87.2352 249.552C87.2262 249.5 87.1272 249.613 87.1272 249.668C87.1222 251.023 86.8892 252.574 85.6482 252.98C85.6102 252.993 85.6112 253.061 85.6572 253.056C87.1592 252.898 87.4482 250.836 87.2352 249.552Z" fill="#263238"/>
                                <path d="M86.0743 248.097C83.9033 247.855 83.5803 252.215 85.5913 252.439C87.5703 252.659 87.8943 248.3 86.0743 248.097Z" fill="#263238"/>
                                <path d="M94.7909 250.155C94.8049 250.104 94.8919 250.227 94.8859 250.282C94.7429 251.629 94.8058 253.196 95.9938 253.735C96.0308 253.752 96.0219 253.819 95.9769 253.81C94.5019 253.489 94.4399 251.408 94.7909 250.155Z" fill="#263238"/>
                                <path d="M96.1016 248.834C98.2856 248.831 98.1326 253.199 96.1096 253.202C94.1176 253.206 94.2716 248.837 96.1016 248.834Z" fill="#263238"/>
                                <path d="M84.7108 245.24C85.3158 245.137 85.8568 244.942 86.4458 244.779C87.1088 244.595 87.6568 244.516 88.1248 243.971C88.3758 243.679 88.3258 243.114 88.0648 242.844C87.4568 242.213 86.5878 242.237 85.7798 242.426C84.9028 242.631 84.2798 243.013 83.7308 243.725C83.1988 244.415 83.9118 245.375 84.7108 245.24Z" fill="#263238"/>
                                <path d="M98.3007 246.807C97.6947 246.71 97.1517 246.519 96.5627 246.361C95.8967 246.183 95.3487 246.109 94.8757 245.568C94.6217 245.278 94.6677 244.714 94.9257 244.44C95.5277 243.805 96.3967 243.821 97.2067 244.003C98.0847 244.201 98.7117 244.578 99.2667 245.284C99.8047 245.969 99.0997 246.935 98.3007 246.807Z" fill="#263238"/>
                                <path d="M83.635 261.433C83.8 261.856 83.915 262.387 84.345 262.627C84.758 262.858 85.349 262.892 85.812 262.917C85.858 262.919 85.879 262.979 85.837 263.004C85.303 263.333 84.495 263.324 83.968 262.965C83.454 262.615 83.396 262.007 83.491 261.435C83.504 261.355 83.61 261.371 83.635 261.433Z" fill="#263238"/>
                                <path d="M85.7654 257.996C86.4344 259.224 87.4984 259.948 88.6824 260.27C89.2104 260.417 89.7734 260.478 90.3314 260.468C90.4404 260.474 90.5494 260.47 90.6504 260.455C90.7494 260.45 90.8394 260.445 90.9494 260.432C91.1094 260.42 91.2054 260.297 91.2424 260.15V260.14C91.2454 260.091 91.2474 260.051 91.2394 260.001C91.2394 260.001 91.2394 260.001 91.2404 259.991L91.2464 259.872C91.3524 258.835 91.3684 257.246 91.3684 257.246C91.7344 257.465 93.6064 258.48 93.6164 257.934C93.6814 253.417 93.7544 248.394 92.8654 243.886C92.8434 243.736 92.6144 243.753 92.6164 243.902C92.3814 248.24 92.9114 252.591 92.7454 256.953C92.1444 256.672 91.1684 256.163 90.6244 256.133C90.4734 256.165 90.6474 259.204 90.5624 259.667C90.5624 259.667 90.5614 259.687 90.5494 259.716C88.7864 259.809 87.5084 259.184 85.8994 257.885C85.8064 257.8 85.6924 257.883 85.7654 257.996Z" fill="#263238"/>
                                <path d="M89.2335 260.283C89.2335 260.283 88.1405 261.234 86.8975 261.39C86.4385 261.449 85.9685 261.408 85.5165 261.175C84.5885 260.699 84.7635 259.79 85.1145 259.056C85.4015 258.452 85.8165 257.969 85.8165 257.969C85.8165 257.969 86.9585 259.632 89.2335 260.283Z" fill="#263238"/>
                                <path d="M86.8975 261.39C86.4385 261.449 85.9685 261.408 85.5165 261.175C84.5885 260.699 84.7635 259.79 85.1145 259.056C86.1465 259.397 87.0345 260.344 86.8975 261.39Z" fill="#FF9BBC"/>
                                <path d="M70.0704 252.112C71.9234 252.581 73.5984 243.313 73.5984 243.313C73.5984 243.313 80.2604 239.52 81.5784 233.101C81.5784 233.101 84.2524 236.441 88.8064 237.717C92.2124 238.672 101.594 235.836 102.42 235.109C103.016 234.583 100.474 224.427 92.9034 221.542C87.9224 219.644 82.5834 221.241 77.2434 225.565C77.2434 225.565 68.1644 227.356 66.0004 233.101C63.8364 238.847 66.8924 251.307 70.0704 252.112Z" fill="#263238"/>
                                <path d="M96.7843 237.921C93.1663 238.557 89.0123 239.644 85.7993 237.316C83.3963 235.575 81.8013 233.216 80.2463 230.743C80.0443 230.421 79.5183 230.676 79.6443 231.036C80.7063 234.074 83.1653 236.955 86.0173 238.486C89.3393 240.269 93.4753 238.881 96.9003 238.024C97.0293 237.993 96.9163 237.898 96.7843 237.921Z" fill="#263238"/>
                                <path d="M71.5698 249.738C71.5698 249.738 68.6648 242.495 65.4768 243.39C62.2888 244.285 63.4618 254.077 66.4928 256.085C69.5238 258.092 71.4368 255.324 71.4368 255.324L71.5698 249.738Z" fill="#D3766A"/>
                                <path d="M65.8826 246.189C65.8306 246.172 65.8026 246.244 65.8446 246.274C67.9516 247.758 68.6746 250.201 69.0116 252.637C68.5196 251.615 67.6876 250.924 66.3426 251.479C66.2716 251.508 66.3076 251.617 66.3766 251.618C67.3766 251.636 68.0266 251.961 68.4926 252.874C68.8226 253.52 68.9756 254.276 69.1566 254.976C69.2176 255.21 69.6186 255.186 69.5956 254.928C69.5936 254.909 69.5906 254.889 69.5886 254.87C70.3376 251.917 68.9986 247.229 65.8826 246.189Z" fill="#263238"/>
                                <path d="M53.6516 295.271C55.6906 316.223 70.2866 356.189 81.3456 360.646C94.1486 365.807 140.693 354.533 150.092 348.635C153.832 346.288 136.536 322.004 132 323.313C112.983 328.798 96.3076 331.116 94.0396 329.323C90.5556 326.57 77.1466 304.083 68.3866 290.101C57.3796 272.534 52.7366 285.87 53.6516 295.271Z" fill="#D3766A"/>
                                <path d="M148.874 349.174C150.95 348.598 165.616 339.484 170.064 335.031C172.902 332.19 177.791 327.275 181.972 319.188C186.797 309.856 189.248 302.948 188.48 299.719C187.588 295.969 187.3 295.349 176.516 310.639C170.414 319.29 165.144 319.933 160.641 319.524C142.185 317.848 128.113 324.383 128.113 324.383C128.113 324.383 140.892 351.39 148.874 349.174Z" fill="#D3766A"/>
                                <path d="M168.799 321.393C157.257 315.426 145.142 310.71 132.641 307.32C139.608 298.766 147.093 289.55 155.201 279.731C165.179 277.233 175.325 274.945 185.644 272.886C188.368 279.503 190.929 286.356 193.317 293.439C184.476 303.325 176.337 312.665 168.799 321.393Z" fill="#FFC727"/>
                                <path opacity="0.2" d="M168.799 321.393C157.257 315.426 145.142 310.71 132.641 307.32C139.608 298.766 147.093 289.55 155.201 279.731C165.179 277.233 175.325 274.945 185.644 272.886C188.368 279.503 190.929 286.356 193.317 293.439C184.476 303.325 176.337 312.665 168.799 321.393Z" fill="#111111"/>
                                <path d="M166.842 320.396C156.545 315.227 145.806 311.047 134.754 307.907C144.287 296.241 154.792 283.351 166.529 269.387C178.401 272.384 189.964 276.441 201.089 281.508C188.397 295.501 177.065 308.519 166.842 320.396Z" fill="white"/>
                                <path d="M166.848 320.469C156.521 315.281 145.748 311.086 134.66 307.939C144.216 296.244 154.748 283.319 166.519 269.314C178.431 272.317 190.033 276.387 201.193 281.474C188.461 295.507 177.097 308.562 166.848 320.469ZM134.845 307.873C145.862 311.006 156.567 315.173 166.834 320.321C177.031 308.474 188.331 295.492 200.982 281.541C189.893 276.493 178.368 272.449 166.536 269.458C154.833 283.38 144.356 296.235 134.845 307.873Z" fill="#DBDBDB"/>
                                <path d="M166.677 318.219C157.264 313.616 147.492 309.83 137.457 306.9C146.31 296.091 155.995 284.261 166.714 271.523C177.432 274.334 187.891 278.018 197.994 282.535C186.489 295.303 176.115 307.24 166.677 318.219ZM137.643 306.833C147.607 309.748 157.312 313.506 166.663 318.071C176.047 307.153 186.357 295.288 197.784 282.602C187.753 278.123 177.37 274.465 166.731 271.667C156.08 284.323 146.45 296.083 137.643 306.833Z" fill="#FFC727"/>
                                <path d="M166.593 317.341C157.55 312.966 148.18 309.343 138.566 306.504C147.143 296.043 156.5 284.634 166.816 272.382C177.061 275.112 187.067 278.641 196.746 282.935C185.706 295.218 175.713 306.725 166.593 317.341ZM138.752 306.438C148.295 309.261 157.598 312.857 166.578 317.194C175.645 306.639 185.574 295.204 196.536 283.003C186.928 278.746 176.998 275.243 166.832 272.527C156.584 284.698 147.283 296.035 138.752 306.438Z" fill="#FFC727"/>
                                <path d="M166.834 272.527C166.348 272.397 165.862 272.269 165.375 272.143C165.788 271.651 166.202 271.158 166.618 270.664C167.106 270.79 167.594 270.918 168.081 271.048C167.664 271.542 167.248 272.035 166.834 272.527ZM165.584 272.058C165.995 272.165 166.406 272.273 166.817 272.382C167.167 271.966 167.519 271.549 167.871 271.132C167.459 271.023 167.047 270.915 166.635 270.808C166.284 271.225 165.933 271.642 165.584 272.058Z" fill="#FFC727"/>
                                <path d="M137.721 307.695C137.266 307.56 136.811 307.426 136.355 307.295C136.696 306.878 137.039 306.459 137.383 306.039C137.84 306.17 138.296 306.303 138.752 306.438C138.407 306.858 138.063 307.277 137.721 307.695ZM136.54 307.228C136.925 307.339 137.31 307.452 137.695 307.566C137.984 307.213 138.275 306.859 138.566 306.504C138.181 306.39 137.795 306.278 137.409 306.166C137.118 306.522 136.828 306.875 136.54 307.228Z" fill="#FFC727"/>
                                <path d="M166.766 319.097C166.339 318.886 165.912 318.677 165.484 318.469C165.848 318.045 166.213 317.62 166.579 317.194C167.008 317.401 167.436 317.61 167.864 317.821C167.497 318.247 167.131 318.673 166.766 319.097ZM165.668 318.419C166.03 318.595 166.391 318.771 166.751 318.949C167.059 318.591 167.369 318.231 167.679 317.87C167.318 317.692 166.956 317.516 166.593 317.34C166.285 317.702 165.976 318.061 165.668 318.419Z" fill="#FFC727"/>
                                <path d="M197.91 283.618C197.453 283.411 196.994 283.206 196.535 283.003C196.978 282.51 197.423 282.016 197.869 281.52C198.329 281.723 198.789 281.928 199.248 282.135C198.8 282.63 198.354 283.125 197.91 283.618ZM196.744 282.935C197.132 283.107 197.519 283.28 197.906 283.455C198.282 283.038 198.659 282.62 199.037 282.202C198.649 282.027 198.261 281.854 197.872 281.682C197.495 282.101 197.119 282.518 196.744 282.935Z" fill="#FFC727"/>
                                <path class="theme-color" d="M190.124 297.02C182.506 305.587 175.42 313.726 168.799 321.394C157.257 315.427 145.142 310.711 132.641 307.321C138.761 299.807 145.281 291.782 152.272 283.286C152.381 283.092 161.342 299.11 161.838 300.609C163.718 300.118 190.039 296.859 190.124 297.02Z" fill="#FFE1D2"/>
                                <g opacity="0.1">
                                <path d="M161.054 299.044C151.378 301.728 141.916 304.494 132.641 307.32C141.73 304.217 151.025 301.127 160.558 298.077C160.739 298.428 160.906 298.752 161.054 299.044Z" fill="#111111"/>
                                <path d="M168.8 321.393C167.382 314.203 165.867 307.152 164.258 300.241C164.713 300.174 165.22 300.1 165.769 300.021C166.845 307.052 167.856 314.175 168.8 321.393Z" fill="#111111"/>
                                </g>
                                <path class="theme-color" d="M168.798 321.393C157.256 315.426 145.142 310.711 132.641 307.32C141.681 304.492 150.905 301.711 160.339 298.999C161.381 298.702 162.397 298.7 163.197 298.998C163.997 299.295 164.526 299.875 164.69 300.624C166.143 307.423 167.514 314.347 168.798 321.393Z" fill="#FFE1D2"/>
                                <path d="M163.13 283.33C163.099 283.362 163.068 283.395 163.037 283.427C163.024 283.446 163.022 283.465 163.03 283.484C163.038 283.503 163.056 283.514 163.083 283.518C163.11 283.522 163.141 283.512 163.175 283.489C164.11 282.927 164.91 282.428 165.573 281.99C166.236 281.553 166.725 281.23 167.037 281.023C167.349 280.816 167.598 280.651 167.783 280.528C168.273 280.207 168.737 279.922 169.174 279.674C168.091 279.76 167.285 279.768 166.755 279.696C166.226 279.624 165.866 279.541 165.676 279.447C165.486 279.353 165.382 279.262 165.363 279.173C165.343 279.084 165.362 278.998 165.417 278.915C165.473 278.832 165.53 278.752 165.59 278.675C165.713 278.514 165.908 278.395 166.174 278.316C166.44 278.238 166.638 278.207 166.767 278.223C166.895 278.24 166.948 278.267 166.923 278.302C166.899 278.338 166.838 278.382 166.74 278.435C166.642 278.488 166.586 278.525 166.57 278.548C166.5 278.652 166.866 278.756 167.666 278.866C168.467 278.976 169.453 279.006 170.627 278.96C171.534 278.59 172.206 278.437 172.639 278.504C172.926 278.548 173.064 278.655 173.052 278.824C173.051 278.926 173.019 279.022 172.956 279.114C172.893 279.206 172.774 279.289 172.599 279.363C172.424 279.437 172.219 279.492 171.985 279.528C171.559 279.592 171.088 279.623 170.572 279.621C170.213 279.83 169.682 280.159 168.983 280.605C168.284 281.052 167.811 281.352 167.562 281.508C167.313 281.663 166.893 281.943 166.303 282.345C165.713 282.747 165.204 283.094 164.776 283.385C164.347 283.676 163.908 283.961 163.459 284.24C162.538 284.814 161.89 285.073 161.506 285.019C161.345 284.997 161.233 284.937 161.17 284.842C161.106 284.746 161.134 284.609 161.254 284.43C161.374 284.251 161.63 284.041 162.024 283.8C162.418 283.56 162.691 283.408 162.842 283.345C162.993 283.282 163.085 283.253 163.12 283.258C163.154 283.265 163.157 283.289 163.13 283.33Z" fill="#37474F"/>
                                <path d="M171.11 284.696C171.033 284.848 170.965 284.968 170.907 285.053C170.849 285.138 170.782 285.21 170.707 285.267C170.632 285.324 170.5 285.4 170.312 285.495C170.124 285.59 169.914 285.683 169.683 285.772C169.119 285.987 168.643 286.061 168.252 285.996C167.691 285.902 167.568 285.623 167.884 285.154C168.16 284.746 169.084 283.995 170.676 282.891C170.734 282.85 170.775 282.821 170.799 282.803C170.416 282.935 169.587 283.33 168.319 283.986C167.052 284.642 166.192 285.109 165.732 285.39C165.692 285.415 165.62 285.44 165.514 285.462C165.409 285.484 165.333 285.492 165.287 285.485C165.241 285.478 165.201 285.457 165.166 285.421C165.131 285.386 165.107 285.367 165.094 285.365C165.05 285.358 165.037 285.341 165.055 285.314C165.073 285.287 165.232 285.149 165.533 284.901C165.834 284.653 166.217 284.345 166.684 283.977C167.968 282.962 169.749 281.651 172.055 280.029C172.863 279.461 173.467 279.061 173.861 278.832C174.142 278.668 174.462 278.615 174.821 278.673C174.897 278.685 174.926 278.714 174.907 278.758C174.888 278.802 174.861 278.85 174.828 278.899C174.794 278.948 174.75 278.996 174.695 279.042C174.321 279.287 173.949 279.531 173.577 279.775C171.366 281.225 169.64 282.427 168.378 283.392C169.327 282.863 170.169 282.471 170.901 282.218C171.357 282.057 171.663 281.99 171.819 282.016C171.975 282.042 172.101 282.089 172.195 282.157C172.289 282.225 172.276 282.349 172.154 282.528C172.11 282.593 171.834 282.815 171.329 283.193C169.815 284.326 169.021 284.955 168.928 285.092C168.835 285.229 168.849 285.307 168.968 285.327C169.142 285.356 169.516 285.242 170.094 284.985C170.53 284.79 170.808 284.664 170.926 284.609C170.987 284.587 171.034 284.579 171.068 284.585C171.13 284.597 171.145 284.634 171.11 284.696Z" fill="#37474F"/>
                                <path d="M176.18 283.057C176.439 283.105 176.51 283.214 176.393 283.384C176.33 283.475 176.261 283.538 176.188 283.573C176.114 283.607 175.922 283.731 175.613 283.944C175.303 284.157 174.933 284.433 174.503 284.773C174.073 285.113 173.743 285.408 173.513 285.661C173.481 285.692 173.444 285.736 173.405 285.794C173.283 285.972 173.274 286.07 173.375 286.089C173.477 286.108 173.628 286.085 173.831 286.019C174.033 285.953 174.224 285.877 174.405 285.793C174.586 285.708 174.766 285.62 174.945 285.53C175.124 285.44 175.23 285.388 175.261 285.375C175.293 285.363 175.329 285.36 175.369 285.368C175.433 285.381 175.44 285.435 175.389 285.532C175.338 285.629 175.278 285.728 175.209 285.828C175.14 285.929 175.082 285.996 175.035 286.031C174.81 286.197 174.442 286.377 173.931 286.572C173.421 286.767 173.03 286.839 172.757 286.787C172.485 286.736 172.338 286.62 172.317 286.438C172.296 286.256 172.351 286.07 172.482 285.877C172.613 285.685 172.762 285.522 172.93 285.389C172.409 285.687 171.885 285.923 171.356 286.1C170.827 286.276 170.447 286.344 170.217 286.303C169.986 286.262 169.843 286.163 169.786 286.006C169.71 285.809 169.771 285.566 169.969 285.275C170.167 284.984 170.435 284.702 170.774 284.43C171.113 284.158 171.479 283.919 171.871 283.712C172.263 283.506 172.663 283.325 173.071 283.171C173.927 282.847 174.597 282.726 175.075 282.812C175.26 282.845 175.389 282.902 175.466 282.981C175.542 283.061 175.564 283.148 175.535 283.242C175.698 283.139 175.818 283.078 175.896 283.057C175.972 283.037 176.067 283.037 176.18 283.057ZM175.125 283.477C174.542 283.371 173.724 283.573 172.679 284.08C172.306 284.261 171.923 284.49 171.528 284.765C171.133 285.04 170.898 285.233 170.822 285.346C170.745 285.459 170.741 285.521 170.809 285.533C170.904 285.55 171.29 285.418 171.969 285.139C172.648 284.859 173.117 284.648 173.376 284.505C173.66 284.344 174.242 284.002 175.125 283.477Z" fill="#37474F"/>
                                <path d="M177.16 286.605C177.061 286.748 177.114 286.84 177.316 286.881C177.424 286.903 177.596 286.879 177.831 286.808C178.067 286.738 178.293 286.654 178.51 286.558C179.094 286.295 179.409 286.168 179.457 286.178C179.545 286.196 179.504 286.328 179.334 286.573C179.165 286.818 178.969 286.969 178.747 287.027C177.974 287.346 177.426 287.523 177.101 287.56C176.919 287.578 176.74 287.567 176.564 287.527C176.388 287.487 176.262 287.377 176.187 287.196C176.112 287.015 176.146 286.82 176.29 286.61C176.434 286.401 176.655 286.174 176.954 285.93C177.253 285.686 177.529 285.481 177.781 285.314C178.033 285.147 178.335 284.955 178.687 284.736C179.039 284.518 179.242 284.379 179.296 284.318C179.295 284.314 179.294 284.31 179.293 284.306C179.174 284.293 178.749 284.451 178.018 284.779C177.288 285.106 176.674 285.395 176.176 285.644C175.678 285.894 175.054 286.234 174.307 286.665C174.1 286.783 173.961 286.834 173.89 286.821C173.819 286.808 173.738 286.767 173.648 286.701C173.558 286.635 173.506 286.589 173.492 286.565C173.478 286.54 173.484 286.509 173.511 286.47C173.537 286.431 173.582 286.386 173.644 286.334C173.707 286.282 173.762 286.239 173.809 286.206C173.856 286.173 173.932 286.123 174.036 286.054C174.14 285.986 174.353 285.841 174.677 285.618C175 285.395 175.49 285.063 176.148 284.621C176.806 284.179 177.204 283.91 177.337 283.817C177.616 283.626 177.83 283.489 177.98 283.406C178.262 283.249 178.586 283.205 178.951 283.276C179.033 283.292 179.039 283.349 178.971 283.448C178.864 283.602 178.515 283.864 177.925 284.231C177.782 284.32 177.64 284.409 177.498 284.498C178.519 283.985 179.293 283.684 179.814 283.597C180.068 283.554 180.275 283.549 180.433 283.581C180.591 283.613 180.688 283.68 180.725 283.781C180.761 283.882 180.744 283.983 180.675 284.083C180.605 284.183 180.486 284.296 180.318 284.421C180.15 284.546 179.991 284.656 179.842 284.751C179.693 284.846 179.501 284.965 179.267 285.108C179.033 285.251 178.906 285.328 178.885 285.341C178.865 285.354 178.811 285.388 178.725 285.443C178.639 285.498 178.575 285.538 178.534 285.564C178.493 285.589 178.424 285.634 178.326 285.698C178.228 285.762 178.148 285.815 178.085 285.858C178.022 285.901 177.945 285.954 177.853 286.017C177.761 286.08 177.684 286.135 177.623 286.182C177.561 286.229 177.496 286.28 177.426 286.337C177.3 286.441 177.211 286.53 177.16 286.605Z" fill="#37474F"/>
                                <path d="M178.048 287.779C177.956 287.733 177.864 287.688 177.772 287.643C177.681 287.613 177.642 287.536 177.654 287.412C177.657 287.379 177.659 287.359 177.658 287.352C177.657 287.344 177.661 287.336 177.667 287.326C177.674 287.316 177.687 287.303 177.706 287.287C177.725 287.271 177.752 287.248 177.787 287.22C177.822 287.192 177.855 287.163 177.888 287.132C178.12 286.915 179.455 285.955 181.945 284.225C184.438 282.492 185.758 281.587 185.853 281.538C185.949 281.488 186.02 281.451 186.066 281.428C186.111 281.405 186.158 281.387 186.204 281.374C186.25 281.361 186.284 281.353 186.304 281.349C186.324 281.346 186.363 281.341 186.419 281.336C186.476 281.331 186.535 281.325 186.596 281.319C186.657 281.313 186.725 281.302 186.8 281.285C186.875 281.268 186.926 281.256 186.955 281.249C186.984 281.242 187.014 281.242 187.047 281.249C187.08 281.256 187.1 281.278 187.107 281.314C187.115 281.35 187.102 281.392 187.069 281.439C187.061 281.451 187.053 281.462 187.044 281.474C186.983 281.533 185.975 282.231 184.051 283.552C182.128 284.872 181.094 285.586 180.917 285.711C181.251 285.665 181.815 285.497 182.609 285.207C183.403 284.917 183.851 284.706 183.949 284.575C184.047 284.444 184.16 284.358 184.29 284.318C184.42 284.278 184.536 284.269 184.64 284.291C184.743 284.314 184.808 284.367 184.833 284.451C184.858 284.535 184.815 284.653 184.704 284.806C184.592 284.959 184.368 285.134 184.03 285.332C183.692 285.53 183.333 285.702 182.954 285.85C182.139 286.164 181.513 286.352 181.073 286.416C180.848 287.191 180.913 287.617 181.265 287.695C181.475 287.711 181.815 287.612 182.289 287.396C182.464 287.318 182.636 287.238 182.806 287.157C182.975 287.076 183.078 287.028 183.114 287.013C183.15 286.998 183.188 286.996 183.228 287.005C183.292 287.019 183.297 287.076 183.244 287.174C183.191 287.272 183.129 287.372 183.058 287.474C182.987 287.576 182.928 287.644 182.88 287.678C182.655 287.84 182.285 288.014 181.774 288.203C181.262 288.392 180.859 288.453 180.564 288.387C180.352 288.34 180.212 288.264 180.142 288.159C180.072 288.054 180.02 287.967 179.985 287.9C179.951 287.832 179.927 287.746 179.916 287.64C179.904 287.534 179.894 287.447 179.886 287.378C179.878 287.309 179.879 287.215 179.889 287.098C179.899 286.98 179.906 286.896 179.909 286.847C179.912 286.797 179.923 286.717 179.94 286.606C179.957 286.495 179.965 286.434 179.965 286.423C179.821 286.531 179.662 286.647 179.491 286.772C179.319 286.897 179.162 287.013 179.018 287.12C178.874 287.228 178.742 287.326 178.623 287.414C178.504 287.503 178.406 287.576 178.329 287.634C178.252 287.692 178.211 287.723 178.205 287.725C178.143 287.769 178.091 287.788 178.048 287.779Z" fill="#37474F"/>
                                <path d="M165.261 293.708C165.234 293.72 165.13 293.79 164.95 293.916C164.77 294.042 164.583 294.168 164.389 294.295C164.195 294.422 163.984 294.537 163.756 294.641C163.527 294.745 163.362 294.793 163.26 294.787C163.158 294.78 163.094 294.774 163.067 294.769C162.761 294.712 162.704 294.539 162.896 294.25C163.122 293.911 163.575 293.549 164.258 293.162C164.517 293.017 164.821 292.864 165.172 292.706C165.523 292.547 165.718 292.456 165.756 292.433C165.794 292.41 166.339 292.017 167.401 291.248C166.855 291.52 166.377 291.733 165.964 291.888C165.551 292.043 165.209 292.11 164.938 292.089C164.926 292.087 164.915 292.085 164.903 292.083C164.773 292.059 164.67 291.996 164.596 291.893C164.522 291.79 164.552 291.638 164.687 291.437C164.887 291.138 165.166 290.864 165.526 290.614C165.652 290.527 165.868 290.38 166.175 290.173C166.482 289.966 166.773 289.764 167.048 289.568C167.287 289.415 167.548 289.234 167.833 289.025C168.118 288.816 168.328 288.667 168.463 288.579C168.599 288.491 168.696 288.452 168.757 288.463C168.818 288.474 168.872 288.524 168.92 288.613C168.968 288.702 168.958 288.797 168.891 288.895C168.825 288.994 168.313 289.382 167.364 290.056C166.415 290.73 165.91 291.117 165.84 291.22C165.823 291.245 165.828 291.26 165.855 291.265C165.946 291.281 166.227 291.198 166.7 291.013C167.173 290.828 167.725 290.582 168.359 290.271C169.064 289.927 169.655 289.603 170.132 289.297C170.193 289.258 170.24 289.228 170.275 289.208C170.31 289.188 170.355 289.16 170.411 289.126C170.467 289.091 170.511 289.065 170.545 289.046C170.579 289.027 170.618 289.005 170.664 288.979C170.71 288.953 170.748 288.934 170.779 288.922C170.81 288.91 170.843 288.898 170.877 288.887C170.936 288.862 170.988 288.854 171.034 288.862C171.08 288.871 171.142 288.893 171.222 288.93C171.301 288.967 171.343 288.998 171.346 289.024C171.349 289.05 171.354 289.074 171.362 289.098C171.372 289.14 171.366 289.176 171.346 289.206C171.325 289.236 171.285 289.274 171.224 289.318C171.163 289.362 170.834 289.586 170.24 289.987C168.488 291.17 167.261 292.031 166.536 292.581C167.315 292.275 168.432 291.815 169.896 291.199C169.952 291.177 169.999 291.171 170.036 291.178C170.14 291.199 170.089 291.36 169.885 291.661C169.825 291.75 169.769 291.805 169.716 291.827C168.223 292.359 166.737 292.987 165.261 293.708Z" fill="#37474F"/>
                                <path d="M174.682 289.674C174.783 289.695 174.856 289.76 174.902 289.868C174.948 289.977 174.91 290.12 174.788 290.299C174.666 290.477 174.442 290.694 174.118 290.95C173.794 291.206 173.419 291.456 172.992 291.7C172.566 291.944 172.13 292.166 171.685 292.365C171.239 292.564 170.804 292.713 170.378 292.812C169.953 292.91 169.612 292.934 169.355 292.882C169.098 292.83 168.944 292.713 168.892 292.529C168.84 292.345 168.907 292.117 169.092 291.843C169.277 291.569 169.554 291.28 169.922 290.974C170.29 290.668 170.674 290.409 171.074 290.196C171.473 289.984 171.874 289.8 172.275 289.647C173.108 289.336 173.733 289.222 174.146 289.306C174.331 289.343 174.44 289.416 174.475 289.521C174.489 289.557 174.488 289.586 174.473 289.608C174.466 289.618 174.46 289.627 174.453 289.637C174.505 289.641 174.582 289.653 174.682 289.674ZM173.736 290.21C173.724 290.208 173.713 290.205 173.701 290.203C173.584 290.179 173.581 290.085 173.693 289.922C173.396 289.949 173.047 290.032 172.648 290.169C172.249 290.307 171.855 290.485 171.466 290.705C170.682 291.142 170.166 291.539 169.917 291.895C169.797 292.073 169.805 292.175 169.942 292.202C170.079 292.229 170.341 292.185 170.727 292.069C171.114 291.953 171.548 291.763 172.03 291.499C172.512 291.235 172.9 290.999 173.193 290.791C173.486 290.583 173.661 290.437 173.719 290.352C173.778 290.267 173.783 290.219 173.736 290.21Z" fill="#37474F"/>
                                <path d="M177.792 292.838C177.855 292.853 177.861 292.908 177.81 293.004C177.759 293.1 177.699 293.198 177.631 293.297C177.563 293.396 177.505 293.463 177.459 293.497C177.239 293.654 176.878 293.823 176.378 294.005C175.877 294.187 175.481 294.244 175.19 294.178C175.011 294.137 174.881 294.048 174.799 293.91C174.717 293.772 174.764 293.574 174.941 293.316C175.118 293.058 175.363 292.82 175.677 292.602C174.17 293.412 173.191 293.763 172.722 293.662C172.536 293.622 172.429 293.526 172.401 293.374C172.373 293.223 172.404 293.08 172.496 292.944C172.588 292.809 172.703 292.673 172.842 292.537C172.981 292.401 173.112 292.28 173.235 292.175C173.358 292.07 173.522 291.942 173.726 291.792C173.93 291.642 174.08 291.533 174.176 291.465C174.272 291.397 174.42 291.296 174.622 291.161C174.824 291.026 175.092 290.843 175.428 290.613C175.764 290.383 176.027 290.215 176.217 290.11C176.406 290.005 176.55 289.962 176.649 289.981C176.747 290 176.807 290.056 176.827 290.15C176.847 290.243 176.841 290.314 176.808 290.362C176.775 290.41 176.513 290.604 176.024 290.94C174.573 291.946 173.792 292.538 173.663 292.726C173.63 292.774 173.632 292.802 173.669 292.81C173.829 292.844 174.451 292.6 175.544 292.074C176.637 291.548 177.302 291.202 177.532 291.035C177.762 290.869 177.969 290.732 178.153 290.624C178.337 290.516 178.463 290.453 178.53 290.434C178.736 290.376 178.955 290.369 179.187 290.413C179.224 290.422 179.251 290.429 179.269 290.437C179.287 290.445 179.291 290.477 179.282 290.535C179.273 290.593 179.258 290.636 179.238 290.665C179.145 290.749 178.846 290.959 178.342 291.296C177.838 291.633 177.556 291.823 177.494 291.869C176.561 292.564 176.017 293.028 175.855 293.264C175.763 293.398 175.77 293.477 175.876 293.501C176.086 293.519 176.42 293.424 176.879 293.214C177.047 293.138 177.215 293.059 177.383 292.979C177.552 292.899 177.654 292.853 177.689 292.841C177.725 292.832 177.759 292.83 177.792 292.838Z" fill="#37474F"/>
                                <path d="M176.998 294.417C177.137 294.215 177.351 294.051 177.641 293.928C177.93 293.805 178.172 293.765 178.365 293.811C178.559 293.857 178.591 293.973 178.463 294.159C178.335 294.345 178.119 294.508 177.817 294.648C177.515 294.788 177.268 294.835 177.077 294.789C176.885 294.743 176.858 294.619 176.998 294.417ZM187.012 288.246C187.129 288.294 187.246 288.342 187.364 288.39C187.447 288.41 187.471 288.447 187.433 288.5C187.426 288.51 187.404 288.53 187.368 288.559C185.274 289.802 182.897 291.273 180.262 292.955C180.114 293.051 180.001 293.101 179.921 293.104C179.918 293.103 179.913 293.104 179.908 293.107C179.902 293.109 179.894 293.112 179.882 293.115C179.871 293.118 179.857 293.119 179.841 293.119C179.778 293.127 179.713 293.122 179.647 293.106C179.581 293.09 179.528 293.089 179.488 293.102C179.448 293.115 179.39 293.112 179.314 293.094C179.191 293.065 179.172 292.989 179.257 292.867C179.406 292.651 180.071 292.168 181.262 291.411C182.453 290.654 183.597 289.954 184.691 289.312C185.785 288.67 186.455 288.307 186.693 288.226C186.758 288.203 186.865 288.21 187.012 288.246Z" fill="#37474F"/>
                                <path d="M162.896 319.61C158.235 319.345 174.048 310.988 174.659 305.705C175.269 300.422 169.986 301.718 165.699 304.417C150.822 313.785 140.193 312.512 132.314 321.921C124.435 331.33 162.896 319.61 162.896 319.61Z" fill="#D3766A"/>
                                <path d="M148.552 312.365C142.471 314.928 135.73 317.634 131.87 323.248L131.79 323.374C130.623 323.81 129.454 324.21 128.267 324.565C127.106 324.871 125.937 325.185 124.738 325.288C125.891 324.962 127.008 324.56 128.107 324.099C129.213 323.667 130.311 323.199 131.383 322.702L131.198 322.866C134.792 316.797 141.987 313.925 148.552 312.365Z" fill="#263238"/>
                                <path d="M95.1265 328.118C98.6755 329.36 124.395 324.255 124.395 324.255L136.107 359.547C136.107 359.547 91.4525 366.613 81.4555 362.327C71.4585 358.041 57.9985 322.059 54.2925 301.448C50.8075 282.07 58.1685 270.115 70.3375 290.805C70.3375 290.805 93.2715 327.469 95.1265 328.118Z" fill="#37474F"/>
                                <path d="M127.953 360.729C125.081 361.107 121.645 361.546 117.931 361.977L107.461 327.224C110.812 326.728 114.322 326.129 117.256 325.604C120.483 336.187 124.411 349.043 127.953 360.729Z" fill="#455A64"/>
                                <path d="M114.039 362.383C112.977 362.497 111.902 362.61 110.815 362.71L100.371 328.124C101.343 328.029 102.393 327.914 103.495 327.777C106.674 338.153 110.529 350.788 114.039 362.383Z" fill="#455A64"/>
                                <path d="M80.9872 361.234C72.7112 356.218 63.7722 332.43 62.0592 327.767C60.9622 324.781 59.9812 321.756 59.0232 318.722C57.1062 312.65 55.3792 306.522 53.7592 300.366C53.7312 300.261 53.5772 300.296 53.5952 300.403C54.3892 305.122 55.4212 309.814 56.6682 314.449C55.7452 312.692 54.9522 310.867 54.2402 309.014C54.2062 308.926 54.0562 308.98 54.0832 309.072C54.7552 311.284 55.7412 313.372 56.9142 315.358C58.1982 320.015 59.6992 324.613 61.4142 329.113C61.9092 330.412 72.1362 359.495 81.5472 362.806C84.8182 363.957 96.3002 363.954 98.7642 363.574C98.8712 363.558 98.9062 363.43 98.7882 363.419C95.4992 363.104 83.9442 363.026 80.9872 361.234Z" fill="#263238"/>
                                <path d="M126.915 354.717C126.576 353.503 126.227 352.291 125.874 351.081C125.167 348.658 120.888 334.264 118.909 329.72C118.856 329.598 118.673 329.675 118.697 329.798C119.641 334.689 124.25 348.924 125.023 351.273C125.418 352.475 125.817 353.675 126.226 354.872C126.638 356.077 127.19 357.229 127.596 358.434C127.636 358.552 127.824 358.515 127.789 358.39C127.447 357.182 127.253 355.931 126.915 354.717Z" fill="#263238"/>
                                <path d="M124.399 324.313C122.302 324.255 103.108 327.286 98.8738 327.924C97.8738 328.075 96.7678 328.36 95.7618 328.127C94.6888 327.879 94.0438 326.927 93.4208 326.1C92.1808 324.453 78.8228 303.877 77.8188 302.841C77.4408 302.45 77.1258 302.357 77.4648 303C78.0458 304.104 91.0148 324.405 92.2088 326.014C93.3188 327.511 94.3518 329.072 96.3938 329.135C97.2918 329.162 123.16 325.283 124.448 324.851C124.719 324.758 124.727 324.322 124.399 324.313Z" fill="#263238"/>
                                <path d="M165.985 214.841C165.985 230.014 153.678 242.321 138.505 242.321C132.373 242.321 126.712 240.31 122.134 236.902L108.672 240.339L114.276 227.804C112.194 223.939 111.025 219.519 111.025 214.842C111.025 199.669 123.332 187.362 138.505 187.362C153.678 187.362 165.985 199.668 165.985 214.841Z" fill="white"/>
                                <path d="M165.982 214.841C165.834 238.037 139.423 250.288 122.219 237.247L108.778 240.764L107.898 240.994L108.268 240.159L113.834 227.607L113.85 228.032C107.535 216.794 110.597 201.617 120.571 193.546C138.629 178.656 165.911 191.449 165.982 214.841ZM165.982 214.841C166.074 197.275 148.881 183.847 131.89 188.479C114.936 192.708 106.327 212.514 114.809 227.786L114.712 228L109.069 240.518L108.56 239.914L122.042 236.557C140.402 249.846 165.555 237.745 165.982 214.841Z" fill="#263238"/>
                                <path class="theme-color" d="M124.988 218.713C128.987 226.776 138.498 231.561 138.498 231.561C138.498 231.561 148.01 226.776 152.001 218.713C155.331 211.987 153.221 204.718 147.966 203.13C140.432 200.851 138.499 208.74 138.499 208.74C138.499 208.74 136.566 200.851 129.024 203.13C123.768 204.718 121.659 211.987 124.988 218.713Z" fill="#FFE1D2"/>
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
