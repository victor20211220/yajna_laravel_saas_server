@extends('card.layouts')
@section('contentCard')
@if($themeName)
    <div class="{{ $themeName }}" id="view_theme16">
@else
    <div class="{{ $business->theme_color }}" id="view_theme16">
@endif
     <main id="boxes">
         <div class="card-wrapper @if (!isset($is_pdf)) scrollbar @endif">
            <div class="photo-studio-card">
                <section class="profile-sec pb">
                    <div class="profile-banner img-wrapper">
                        <img class="profile-banner-img"
                            src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme6/images/profile-banner-img.png') }}"
                            id="banner_preview" alt="profile-banner-img">
                    </div>
                    <div class="container">
                        <div class="client-info-wrp">
                            <div class="client-info-content d-flex">
                                <div class="client-image">
                                    <img id="business_logo_preview"  src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme6/images/client-image.png') }}"
                                    alt="client-image" loading="lazy">
                                </div>
                                <div class="client-info">
                                    <h2 id="{{ $stringid . '_title' }}_preview">{{ $business->title }}</h2>
                                    <span id="{{ $stringid . '_designation' }}_preview">
                                        {{ $business->designation }}</span>
                                    <span class="subtitle"
                                        id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                                </div>
                            </div>
                            <p class="text-wrap" id="{{ $stringid . '_desc' }}_preview">
                                {!! nl2br(e($business->description)) !!}</p>
                        </div>
                    </div>
                </section>
                @php $j = 1; @endphp
            @foreach ($card_theme->order as $order_key => $order_value)
                @if ($j == $order_value)
                @if ($order_key == 'contact_info')
                <section class="contact-info-sec pb" id="contact-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Contact') }}</h2>
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
                                                    <img src="{{ asset('custom/theme6/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                </div>
                                                    <a href="{{ $href }}" target="_blank" class="contact-link" >
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
                                                        <img src="{{ asset('custom/theme6/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                    </div>
                                                        <a href="{{ url('https://wa.me/' . $href) }}" target="_blank" class="contact-link">
                                                @else
                                                    <div class="contact-image">
                                                        <img src="{{ asset('custom/theme6/icon/color1/' . strtolower($key1) . '.svg') }}" class="img-fluid">
                                                     </div>
                                                        <a href="{{ $href }}" class="contact-link">
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
                @if ($order_key == 'gallery')
                <section class="gallery-sec pt pb mb" id="gallery-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{__('Gallery')}}</h2>
                        </div>
                        <div class="slider-wrapper">
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
                            <div class="arrow-wrapper">
                                <div class="slick-prev slick-arrow gallery-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow gallery-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
                @if ($order_key == 'social')
                <section class="social-link-sec pb">
                    <div class="container">
                        <div class="social-link-slider">
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
                                                    <img src="{{ asset('custom/theme6/icon/social/' . strtolower($social_key1) . '.svg') }}" alt="social-image" loading="lazy">
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
                @if ($order_key == 'product')
                <section class="product-sec pb" id="product-div">
                    <div class="container">
                        <div class="section-title common-title text-center">
                            <h2>{{ __('Product') }}</h2>
                        </div>
                        <div class="slider-wrapper">
                            @if (isset($is_pdf))
                                @php $pr_image_count = 0; @endphp
                                @foreach ($products_content as $k1 => $content)
                                    <div class="product-card edit-card" id="product_{{ $product_row_nos }}">
                                        <div class="product-card-inner">
                                            <div class="product-card-image">
                                                <div class="img-wrapper">
                                                    <img id="{{ 'product_image'.$pr_image_count .'_preview' }}" src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="product-image" loading="lazy">
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
                                                        <a href="{{ url($content->purchase_link) }}" class="btn">{{ $content->link_title }}</a>
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
                                    @php $pr_image_counts = 0; @endphp
                                    @foreach ($products_content as $k1 => $content)
                                        <div class="product-card" id="product_{{ $product_row_nos }}">
                                            <div class="product-card-inner">
                                                <div class="product-card-image">
                                                    <div class="img-wrapper">
                                                        <img id="{{ 'product_image'.$pr_image_counts .'_preview' }}" src="{{ isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png') }}" alt="product-image" loading="lazy">
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
                                                            <a href="{{ url($content->purchase_link) }}" class="btn">{{ $content->link_title }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $pr_image_counts++;
                                        $product_row_nos++;
                                        @endphp
                                    @endforeach
                                </div>
                            <div class="arrow-wrapper">
                                <div class="slick-prev slick-arrow product-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow product-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
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
                        <ul class="d-flex justify-content-between">
                            <li>
                                <a href="{{ route('bussiness.save', $business->slug) }}"
                                    class="save-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.545 5.28945C14.5941 5.02654 14.6189 4.75968 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C8.22526 0.00227634 6.53772 1.18703 5.89324 2.96474C4.73932 2.5054 3.4315 3.06844 2.97212 4.22236C2.93236 4.32224 2.89981 4.42482 2.87475 4.52935C1.03224 4.8049 -0.237997 6.52193 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7395 6.87066 15.3023 5.92967 14.545 5.28945Z" fill="#111111"/>
                                        <path d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659L8.99889 13.8173V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V13.8173L6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z" fill="#111111"/>
                                    </svg>
                                    <h3>{{ __('Save') }}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="share-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.28377 9.4228C6.04018 9.32536 5.89402 9.03304 5.99146 8.78945C7.30688 5.28165 10.3275 2.74824 13.9814 2.11489L11.8865 0.945621C11.6429 0.799463 11.5455 0.507147 11.6916 0.26355C11.8378 0.0199526 12.1301 -0.0774863 12.3737 0.0686719L15.5405 1.82257C15.7841 1.96873 15.8815 2.26105 15.7353 2.50464L14.0302 5.57397C13.9327 5.72012 13.7866 5.81756 13.5917 5.81756C13.4942 5.81756 13.3968 5.81756 13.3481 5.76884C13.1045 5.62268 13.0071 5.33037 13.1532 5.08677L14.3225 3.04056C10.9608 3.57647 8.13511 5.915 6.91713 9.08176C6.81969 9.27664 6.62481 9.4228 6.42993 9.4228H6.28377ZM14.8107 7.9125C14.8107 7.62019 15.0056 7.42531 15.2979 7.42531C15.5902 7.42531 15.7851 7.66891 15.7851 7.9125V11.7126C15.7851 14.0999 13.885 15.9999 11.4978 15.9999H4.2873C1.94877 15.9999 -3.22908e-06 14.0999 -3.22908e-06 11.7126V4.50214C-3.22908e-06 2.16361 1.90005 0.214836 4.2873 0.214836H7.94126C8.23358 0.214836 8.42846 0.409714 8.42846 0.70203C8.42846 0.994347 8.23358 1.18922 7.94126 1.18922H4.2873C2.48469 1.18922 0.974385 2.65081 0.974385 4.50214V11.7126C0.974385 13.564 2.43597 15.0255 4.2873 15.0255H11.4978C13.3004 15.0255 14.8107 13.564 14.8107 11.7126V7.9125Z" fill="#111111"/>
                                    </svg>
                                    <h3>{{ __('Share') }}</h3>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M13.4595 2.09597C12.1078 0.744271 10.3106 -7.56008e-05 8.39908 5.7592e-09C8.08584 5.7592e-09 7.83203 0.253887 7.83203 0.567049C7.83203 0.880212 8.08592 1.1341 8.39908 1.1341C10.0077 1.13402 11.52 1.76042 12.6575 2.89792C13.7951 4.03543 14.4215 5.54786 14.4214 7.15654C14.4214 7.4697 14.6753 7.72359 14.9885 7.72359C15.3017 7.72359 15.5555 7.4697 15.5555 7.15662C15.5556 5.2449 14.8113 3.44766 13.4595 2.09597Z" fill="#111111"/>
                                        <path d="M11.1269 7.15651C11.1269 7.46967 11.3808 7.72356 11.694 7.72348C12.0072 7.72348 12.261 7.4696 12.261 7.15643C12.2608 5.02735 10.5284 3.29498 8.39916 3.29468C8.39908 3.29468 8.39923 3.29468 8.39916 3.29468C8.08599 3.29468 7.83211 3.54849 7.83203 3.86165C7.83203 4.17481 8.08584 4.4287 8.399 4.42878C9.90305 4.429 11.1267 5.65262 11.1269 7.15651Z" fill="#111111"/>
                                        <path d="M9.87051 10.0477C9.00618 10.0029 8.56585 10.6457 8.35468 10.9545C8.17783 11.213 8.24406 11.5659 8.50256 11.7427C8.76106 11.9195 9.11392 11.8533 9.29076 11.5948C9.54026 11.23 9.6533 11.1726 9.80663 11.1799C10.2974 11.2376 12.2303 12.654 12.4238 13.0969C12.4724 13.2273 12.4705 13.3552 12.4185 13.5107C12.2155 14.113 11.8796 14.5362 11.4468 14.7346C11.0357 14.9231 10.5316 14.906 9.98944 14.6854C7.96492 13.8602 6.19619 12.7086 4.73244 11.2626C4.73184 11.262 4.73123 11.2615 4.7307 11.2609C3.28768 9.79855 2.13823 8.03207 1.31442 6.01066C1.09372 5.46803 1.07664 4.96388 1.26512 4.55281C1.46352 4.12004 1.88676 3.78412 2.48851 3.58142C2.64457 3.5291 2.77219 3.52744 2.9014 3.57552C3.34589 3.76975 4.76223 5.70256 4.81939 6.1878C4.82756 6.34688 4.76972 6.45984 4.40522 6.70888C4.14664 6.8855 4.08018 7.23836 4.25688 7.49693C4.43349 7.75551 4.78627 7.82189 5.04492 7.64527C5.35385 7.43433 5.99651 6.99521 5.9519 6.12792C5.90276 5.22201 4.14052 2.82293 3.29849 2.51332C2.92401 2.37375 2.5301 2.37134 2.12727 2.50652C1.22089 2.81174 0.566293 3.35596 0.234229 4.08027C-0.0878549 4.78296 -0.077648 5.59822 0.264094 6.43836C1.14574 8.60162 2.37926 10.4944 3.93033 12.0644C3.93411 12.0683 3.93797 12.072 3.9419 12.0757C5.51074 13.6239 7.40135 14.8552 9.56174 15.7358C9.99436 15.9117 10.4204 15.9998 10.8278 15.9998C11.2115 15.9998 11.5788 15.9218 11.9195 15.7656C12.6438 15.4336 13.188 14.7791 13.4934 13.8721C13.6283 13.47 13.6261 13.0762 13.4876 12.7035C13.1769 11.8592 10.7779 10.097 9.87051 10.0477Z" fill="#111111"/>
                                    </svg>
                                    <h3>{{ __('Contact') }}</h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                @endif
                @if ($order_key == 'bussiness_hour')
                <section class="business-hour-sec pt mb" id="business-hours-div">
                    <div class="container">
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
                                            <div  class="service-content-bottom">
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
                                                <div  class="service-content-bottom">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow service-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>
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
                                <button type="button" class="btn appointment-btn">{{__('Make An Appointment')}}</button>
                            </div>
                        </form>
                    </div>
                </section>
                @endif

                @if ($order_key == 'testimonials')
                <section class="testimonial-sec pt pb mb" id="testimonials-div">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
                                    </svg>
                                </div>
                                <div class="slick-next slick-arrow testimonial-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                                        <path d="M7.02075 9.00374L0.286996 2.2697C0.101581 2.08472 -0.000418663 1.8374 -0.000418663 1.57369C-0.000418663 1.30984 0.101581 1.06267 0.286996 0.877402L0.877044 0.287646C1.06217 0.102085 1.30963 -6.10352e-05 1.57334 -6.10352e-05C1.83704 -6.10352e-05 2.08421 0.102085 2.26948 0.287646L10.2871 8.30511C10.4731 8.49096 10.5749 8.7393 10.5742 9.0033C10.5749 9.26847 10.4732 9.51652 10.2871 9.70252L2.27695 17.7122C2.09168 17.8978 1.84451 17.9999 1.58065 17.9999C1.31695 17.9999 1.06978 17.8978 0.884361 17.7122L0.294459 17.1225C-0.0893946 16.7386 -0.0893946 16.1137 0.294459 15.73L7.02075 9.00374Z" fill="#111111"/>
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
                            <div class="thankyou-svg">
                                @if(isset($business->svg_text))
                                <img id="svg_text_preview" src="{{ isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text :'' }}">
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="429" height="319" viewBox="0 0 429 319" fill="none">
                                    <path d="M428.11 280.335H0.046875V280.549H428.11V280.335Z" fill="#EBEBEB"/>
                                    <path d="M202.962 242.153H37.6446C34.9503 242.153 32.7578 239.961 32.7578 237.267V4.88676C32.7578 2.19254 34.9503 0 37.6446 0H202.962C205.655 0 207.847 2.19254 207.847 4.88676V237.267C207.847 239.961 205.655 242.153 202.962 242.153ZM37.6446 0.214887C35.0676 0.214887 32.9718 2.31068 32.9718 4.88762V237.267C32.9718 239.844 35.0676 241.94 37.6446 241.94H202.962C205.538 241.94 207.633 239.844 207.633 237.267V4.88676C207.633 2.31068 205.538 0.214031 202.962 0.214031L37.6446 0.214887Z" fill="#EBEBEB"/>
                                    <path d="M388.136 242.153H222.82C220.125 242.153 217.934 239.961 217.934 237.267V4.88676C217.934 2.19254 220.126 0 222.82 0H388.136C390.831 0 393.022 2.19254 393.022 4.88676V237.267C393.023 239.961 390.831 242.153 388.136 242.153ZM222.82 0.214887C220.243 0.214887 218.148 2.31068 218.148 4.88762V237.267C218.148 239.844 220.243 241.94 222.82 241.94H388.136C390.713 241.94 392.808 239.844 392.808 237.267V4.88676C392.808 2.31068 390.713 0.214031 388.136 0.214031L222.82 0.214887Z" fill="#EBEBEB"/>
                                    <path d="M66.2059 288.489H43.9492V288.703H66.2059V288.489Z" fill="#EBEBEB"/>
                                    <path d="M162.865 286.165H124.316V286.379H162.865V286.165Z" fill="#EBEBEB"/>
                                    <path d="M119.108 296.438H67.0625V296.653H119.108V296.438Z" fill="#EBEBEB"/>
                                    <path d="M384.21 295H367.742V295.214H384.21V295Z" fill="#EBEBEB"/>
                                    <path d="M360.118 295H312.781V295.214H360.118V295Z" fill="#EBEBEB"/>
                                    <path d="M283.866 291.386H220.113V291.6H283.866V291.386Z" fill="#EBEBEB"/>
                                    <path d="M374.989 169.387H344.438V280.335H374.989V169.387Z" fill="#E6E6E6"/>
                                    <path d="M344.439 169.387H231.516V280.335H344.439V169.387Z" fill="#F5F5F5"/>
                                    <path d="M338.523 280.335V175.302L237.429 175.302V280.335H338.523Z" fill="#E6E6E6"/>
                                    <path d="M338.522 175.302H279.355V280.336H338.522V175.302Z" fill="#E0E0E0"/>
                                    <path d="M340.492 209.243V173.482L234.226 173.482V209.243L340.492 209.243Z" fill="#F5F5F5"/>
                                    <path d="M332.474 205.437H242.242V177.289H332.474V205.437ZM244.021 203.658H330.694V179.068H244.021V203.658Z" fill="white"/>
                                    <path d="M319.674 140.833H291.828V169.322H319.674V140.833Z" fill="#E6E6E6"/>
                                    <path d="M255.23 169.322H291.828V140.833H255.23V169.322Z" fill="#F0F0F0"/>
                                    <path opacity="0.7" d="M319.675 137.318H255.23V141.594H319.675V137.318Z" fill="#E6E6E6"/>
                                    <path d="M321.079 136.882H291.828V140.833H321.079V136.882Z" fill="#E6E6E6"/>
                                    <path d="M253.825 140.834H291.828V136.882H253.825V140.834Z" fill="#F0F0F0"/>
                                    <path d="M353.074 156.632H330.293V169.322H353.074V156.632Z" fill="#EBEBEB"/>
                                    <path d="M300.352 169.321H330.293V156.631H300.352V169.321Z" fill="#F5F5F5"/>
                                    <path opacity="0.7" d="M353.074 153.755H300.352V157.252H353.074V153.755Z" fill="#E6E6E6"/>
                                    <path d="M354.223 153.398H330.293V156.631H354.223V153.398Z" fill="#EBEBEB"/>
                                    <path d="M299.203 156.632H330.293V153.399H299.203V156.632Z" fill="#F5F5F5"/>
                                    <path d="M262.576 133.764H350.598V16.9707L262.576 16.9707V133.764Z" fill="#E6E6E6"/>
                                    <path d="M255.904 133.764H347.68V16.9707L255.904 16.9707V133.764Z" fill="#F5F5F5"/>
                                    <path d="M337.439 126.934H266.148C264.268 126.934 262.738 125.404 262.738 123.524V27.2146C262.738 25.3346 264.268 23.8047 266.148 23.8047H337.439C339.32 23.8047 340.849 25.3346 340.849 27.2146V123.523C340.849 125.404 339.32 126.934 337.439 126.934ZM266.147 25.5169C265.211 25.5169 264.45 26.2789 264.45 27.2146V123.523C264.45 124.459 265.212 125.22 266.147 125.22H337.439C338.375 125.22 339.136 124.458 339.136 123.523V27.2146C339.136 26.278 338.374 25.5169 337.439 25.5169H266.147Z" fill="white"/>
                                    <path d="M56.0632 265.142H180.328L180.328 19.9001L56.0632 19.9001L56.0632 265.142Z" fill="#E6E6E6"/>
                                    <path d="M53.3068 265.142H179.039L179.039 19.9001L53.3068 19.9001L53.3068 265.142Z" fill="#F5F5F5"/>
                                    <path d="M189.92 17.7878H46.4701C45.8717 17.7878 45.3828 17.2981 45.3828 16.7006C45.3828 16.1021 45.8725 15.6133 46.4701 15.6133H189.919C190.517 15.6133 191.006 16.103 191.006 16.7006C191.007 17.2981 190.517 17.7878 189.92 17.7878Z" fill="#E6E6E6"/>
                                    <path d="M56.0632 269.286H180.328V265.143H56.0632V269.286Z" fill="#E6E6E6"/>
                                    <path d="M48.2254 269.286H167.93V265.143H48.2254V269.286Z" fill="#F5F5F5"/>
                                    <path d="M175.184 260.134L175.184 24.9092L57.1641 24.9092L57.1641 260.134H175.184Z" fill="#FAFAFA"/>
                                    <path d="M134.197 260.133L125.095 24.9082H108.723L117.823 260.133H134.197Z" fill="white"/>
                                    <path d="M113.19 260.133L104.089 24.9082H96.4922L105.593 260.133H113.19Z" fill="white"/>
                                    <path d="M57.6562 121.672L57.6562 24.2317H57.1665L57.1665 121.672H57.6562Z" fill="#E6E6E6"/>
                                    <path opacity="0.4" d="M65.7434 12.3052H47.8906V251.265H65.7434V12.3052Z" fill="#E0E0E0"/>
                                    <path opacity="0.4" d="M85.6457 12.3052H67.793V251.265H85.6457V12.3052Z" fill="#E0E0E0"/>
                                    <path opacity="0.4" d="M73.8801 14.4402H56.0273V253.4H73.8801V14.4402Z" fill="#E0E0E0"/>
                                    <path opacity="0.4" d="M165.884 12.3052H148.031V251.265H165.884V12.3052Z" fill="#E0E0E0"/>
                                    <path opacity="0.4" d="M185.782 12.3052H167.93V251.265H185.782V12.3052Z" fill="#E0E0E0"/>
                                    <path opacity="0.4" d="M174.017 14.4402H156.164V253.4H174.017V14.4402Z" fill="#E0E0E0"/>
                                    <path d="M214.079 319C305.755 319 380.072 314.66 380.072 309.306C380.072 303.952 305.755 299.612 214.079 299.612C122.404 299.612 48.0859 303.952 48.0859 309.306C48.0859 314.66 122.404 319 214.079 319Z" fill="#F5F5F5"/>
                                    <path d="M120.187 301.777L112.812 301.661L113.273 284.519L120.648 284.634L120.187 301.777Z" fill="#FFC3BD"/>
                                    <path d="M112.73 300.806L120.787 300.933C121.089 300.937 121.326 301.151 121.358 301.448L122.06 308.039C122.132 308.722 121.542 309.359 120.847 309.337C117.947 309.242 113.766 309.006 110.113 308.948C105.842 308.881 106.258 309.056 101.249 308.978C98.2199 308.93 97.7319 305.851 99.0315 305.593C104.948 304.419 105.545 304.358 110.887 301.356C111.467 301.028 112.093 300.796 112.73 300.806Z" fill="#263238"/>
                                    <path d="M111.023 81.0338C109.286 86.3889 107.436 91.6772 105.478 96.9492C104.501 99.5835 103.509 102.214 102.474 104.834C101.455 107.461 100.402 110.074 99.3049 112.69C99.0532 113.317 98.7082 114.068 98.3983 114.769C98.0858 115.494 97.7485 116.148 97.4103 116.82C97.0747 117.497 96.7237 118.146 96.3693 118.786C96.0157 119.429 95.6672 120.079 95.3008 120.701C93.8762 123.238 92.3146 125.637 90.7642 128.032C87.6145 132.796 84.2705 137.344 80.6722 141.778L76.0234 138.749L83.4084 123.822C85.8175 118.879 88.1984 113.902 89.7908 109.122L94.9995 93.2696C96.7477 87.9779 98.5489 82.6836 100.414 77.4407L111.023 81.0338Z" fill="#FFC3BD"/>
                                    <path d="M115.981 77.5966C114.175 83.5406 107.933 98.3773 107.933 98.3773L93.625 88.3974C93.625 88.3974 96.142 78.7395 101.804 74.1926C109.833 67.7426 118.307 69.9385 115.981 77.5966Z" fill="#263238"/>
                                    <path opacity="0.2" d="M107.472 82.4243C102.206 83.7 98.2133 89.0097 98.8622 92.0506L107.929 98.3757C107.929 98.3757 109.88 90.9231 113.314 85.9499C111.301 83.9474 108.994 82.0553 107.472 82.4243Z" fill="#111111"/>
                                    <path d="M105.16 95.9579C106.302 95.0358 106.586 94.6651 106.586 94.6651C106.586 94.6651 95.9553 87.2631 93.2825 87.1877C92.5265 88.0216 92.5 89.1825 92.5 89.1825C92.5 89.1825 101.783 96.0366 105.16 95.9579Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M78.627 136.203L71.5117 140.795L77.2075 146.989C77.2075 146.989 83.1533 144.184 82.1294 138.806L78.627 136.203Z" fill="#FFC3BD"/>
                                    <path d="M68.5 147.98L72.0144 149.762C72.6 150.059 73.3029 149.993 73.8234 149.593L77.2102 146.989L71.5144 140.795L67.9256 145.415C67.268 146.261 67.5446 147.496 68.5 147.98Z" fill="#FFC3BD"/>
                                    <path opacity="0.2" d="M113.277 284.523L113.039 293.359L120.417 293.475L120.655 284.639L113.277 284.523Z" fill="#111111"/>
                                    <path d="M146.632 73.9307C139.736 102.003 142.471 131.8 141.981 137.828C141.981 137.828 102.45 137.192 102.449 137.188C99.8459 106.055 102.407 85.6228 104.057 76.5753C104.657 73.2852 107.348 70.7956 110.672 70.4317C110.833 70.4137 110.997 70.3966 111.163 70.3795C112.24 70.2691 113.402 70.1715 114.614 70.1081C115.284 70.0679 115.963 70.0465 116.654 70.0328C121.111 69.96 128.421 70.668 133.461 71.2819C134.516 71.4128 135.593 71.5704 136.632 71.739C137.598 71.9025 138.546 72.0772 139.44 72.2544C143.495 73.0557 146.632 73.9307 146.632 73.9307Z" fill="#263238"/>
                                    <path opacity="0.2" d="M138.678 85.9729C138.072 88.6885 139.352 101.082 142.304 104.138C142.54 100.17 142.899 96.0264 143.419 91.7911L138.678 85.9729Z" fill="#111111"/>
                                    <path d="M132.482 52.2869C131.225 57.6 129.807 67.4 133.458 71.2783C130.413 73.9725 126.42 77.4561 120.02 76.802C114.807 76.2686 114.874 72.2303 116.655 70.0318C122.737 69.0438 122.743 64.5714 121.846 60.3045L132.482 52.2869Z" fill="#FFC3BD"/>
                                    <path opacity="0.2" d="M131.427 58.2199L127.042 56.3921L125.413 57.6215C125.579 58.2199 125.147 60.3988 125.413 61.0383C126.161 62.8575 129.184 63.807 131.137 63.4945C131.094 61.7668 131.211 59.9561 131.427 58.2199Z" fill="#111111"/>
                                    <path d="M128.493 29.3325C125.417 31.6047 125.412 31.894 122.192 31.2708C118.973 30.6475 109.87 27.3249 112.293 35.1824C104.644 35.6327 105.716 43.6855 109.143 48.2229C112.606 52.8066 115.96 53.1979 116.385 56.9203C116.885 61.2977 124.287 62.1469 125.325 59.689L135.896 50.6663C139.404 50.8752 136.015 45.1597 137.759 41.873C138.345 40.7704 138.279 39.588 137.806 38.5461C138.702 38.1215 139.532 37.4554 140.227 36.4281C143.742 31.2331 133.46 25.6632 128.493 29.3325Z" fill="#263238"/>
                                    <path d="M116.468 45.2591C117.393 52.5259 117.566 56.8296 121.5 60.3029C127.418 65.527 136.218 61.5126 137.484 54.096C138.624 47.4199 136.918 36.6576 129.577 34.2836C122.346 31.9455 115.542 37.9923 116.468 45.2591Z" fill="#FFC3BD"/>
                                    <path d="M117.206 36.636C121.036 35.7935 124.544 40.206 122.468 43.2932C120.391 46.3804 124.817 50.209 120.184 52.1952C116.952 53.5804 115.384 50.2158 113.815 47.9197C111.409 44.4002 113.132 37.5315 117.206 36.636Z" fill="#263238"/>
                                    <path d="M113.469 35.7012C118.14 38.2148 119.278 40.6676 126.222 38.2858C130.326 36.8784 131.367 40.1077 136.633 38.9656C137.653 32.7476 130.391 31.3624 126.73 32.055C123.068 32.7476 113.469 35.7012 113.469 35.7012Z" fill="#263238"/>
                                    <path d="M113.471 36.9478C113.338 36.9478 113.203 36.9264 113.071 36.8819C108.063 35.1842 108.136 31.389 108.141 31.228C108.165 30.5388 108.756 30.0226 109.43 30.0252C110.11 30.0491 110.645 30.6142 110.633 31.2931C110.634 31.4181 110.713 33.4505 113.871 34.5207C114.523 34.7424 114.872 35.4496 114.651 36.1011C114.475 36.6207 113.99 36.9478 113.471 36.9478Z" fill="#263238"/>
                                    <path d="M115.299 52.3254C116.365 53.9504 117.846 54.9666 119.112 55.3099C121.018 55.827 121.47 53.744 120.521 51.6397C119.668 49.7459 117.647 47.1947 115.936 47.6185C114.251 48.0371 114.081 50.4668 115.299 52.3254Z" fill="#FFC3BD"/>
                                    <path d="M125.368 210.545C125.07 173.38 133.295 137.688 133.295 137.688L102.477 137.191C102.477 137.191 106.021 190.869 107.253 213.351C108.531 236.729 110.324 291.609 110.324 291.609L122.836 291.8C122.836 291.8 127.098 239.874 125.368 210.545Z" class="theme-color" fill="#DC143C"/>
                                    <path opacity="0.2" d="M126.588 158.136C117.805 170.161 121.754 192.782 125.354 208.765C125.346 188.896 127.693 169.608 129.838 156.148L126.588 158.136Z" fill="#111111"/>
                                    <path d="M109.548 291.876L124.421 292.11L125.261 287.292L108.68 286.777L109.548 291.876Z" fill="#263238"/>
                                    <path d="M128.515 47.0296C128.554 47.6237 128.9 48.0826 129.289 48.0535C129.678 48.0244 129.962 47.5193 129.923 46.9251C129.884 46.331 129.537 45.8721 129.148 45.9012C128.76 45.9303 128.477 46.4354 128.515 47.0296Z" fill="#263238"/>
                                    <path d="M135.507 46.5293C135.546 47.1235 135.893 47.5824 136.282 47.5533C136.671 47.5242 136.955 47.019 136.916 46.4249C136.877 45.8307 136.53 45.3719 136.141 45.401C135.752 45.4301 135.469 45.9352 135.507 46.5293Z" fill="#263238"/>
                                    <path d="M133.457 46.6262C133.457 46.6262 135.034 49.9548 136.631 51.4984C135.643 52.5583 133.824 52.2424 133.824 52.2424L133.457 46.6262Z" fill="#ED847E"/>
                                    <path d="M129.878 53.9366C127.596 53.8005 126.444 52.3083 126.39 52.2381C126.332 52.161 126.349 52.0514 126.426 51.9932C126.503 51.935 126.612 51.9495 126.67 52.0257C126.684 52.0429 128.03 53.7748 130.633 53.5813C130.729 53.5745 130.812 53.6464 130.818 53.7431C130.824 53.8399 130.752 53.9238 130.655 53.9306C130.383 53.9503 130.125 53.9512 129.878 53.9366Z" fill="#263238"/>
                                    <path d="M126.822 44.7427C126.763 44.7393 126.705 44.7213 126.654 44.6871C126.492 44.5826 126.448 44.3652 126.554 44.2034C127.619 42.5767 129.235 42.551 129.304 42.551C129.497 42.5502 129.653 42.706 129.652 42.8995C129.651 43.0921 129.495 43.2496 129.302 43.2513C129.249 43.2522 127.989 43.2847 127.138 44.5835C127.067 44.6931 126.943 44.7504 126.822 44.7427Z" fill="#263238"/>
                                    <path d="M137.104 42.9629C136.991 42.9689 136.877 42.9201 136.805 42.8225C135.893 41.5828 134.634 41.6333 134.581 41.6359C134.388 41.6462 134.225 41.4989 134.215 41.3063C134.206 41.1137 134.353 40.9493 134.546 40.9373C134.615 40.9347 136.229 40.8508 137.371 42.4047C137.485 42.5597 137.451 42.7788 137.295 42.8944C137.237 42.9372 137.171 42.9595 137.104 42.9629Z" fill="#263238"/>
                                    <path d="M111.388 301.465C111.45 301.444 111.496 301.391 111.506 301.326C111.518 301.252 111.481 301.18 111.416 301.145C111.083 300.966 108.138 299.414 107.232 299.9C107.058 299.994 106.955 300.153 106.935 300.361C106.904 300.71 107.009 300.997 107.249 301.217C108.048 301.948 110.17 301.69 111.365 301.471C111.372 301.469 111.38 301.467 111.388 301.465ZM107.462 300.181C108.022 299.997 109.623 300.636 110.785 301.213C109.149 301.459 107.934 301.369 107.486 300.959C107.328 300.815 107.262 300.629 107.284 300.393C107.292 300.301 107.326 300.247 107.397 300.208C107.417 300.197 107.439 300.187 107.462 300.181Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M111.388 301.465C111.404 301.46 111.419 301.452 111.434 301.442C111.485 301.407 111.513 301.347 111.508 301.285C111.501 301.2 111.335 299.207 110.408 298.42C110.126 298.181 109.8 298.074 109.442 298.105C108.96 298.146 108.818 298.389 108.782 298.584C108.633 299.418 110.374 301.043 111.259 301.457C111.3 301.476 111.347 301.478 111.388 301.465ZM109.293 298.487C109.338 298.473 109.397 298.461 109.472 298.454C109.738 298.431 109.97 298.508 110.182 298.687C110.792 299.205 111.035 300.399 111.12 300.981C110.218 300.42 109.038 299.146 109.127 298.646C109.133 298.614 109.147 298.535 109.293 298.487Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M172.824 301.777L165.414 301.661L160.672 284.519L168.082 284.634L172.824 301.777Z" fill="#FFC3BD"/>
                                    <path d="M164.898 300.806L172.977 300.933C173.279 300.937 173.553 301.151 173.635 301.448L175.465 308.039C175.654 308.722 175.173 309.359 174.474 309.337C171.557 309.242 170.604 309.005 166.941 308.948C162.658 308.881 164.659 309.056 159.637 308.978C156.6 308.93 155.59 305.864 156.84 305.593C160.797 304.733 161.595 303.1 163.148 301.356C163.555 300.897 164.26 300.796 164.898 300.806Z" fill="#263238"/>
                                    <path opacity="0.2" d="M160.676 284.523L163.119 293.359L170.532 293.475L168.089 284.639L160.676 284.523Z" fill="#111111"/>
                                    <path d="M154.291 211.063C150.096 177.847 146.962 145.247 141.981 137.828L115.859 137.407C115.859 137.407 130.973 191.372 136.072 213.499C141.37 236.505 159.75 289.421 159.75 289.421L171.665 289.59C171.665 289.59 162.114 236.76 154.291 211.063Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M158.106 291.876L172.979 292.11L173.82 287.292L157.238 286.777L158.106 291.876Z" fill="#263238"/>
                                    <path d="M165.356 301.365C165.421 301.368 165.482 301.334 165.515 301.276C165.551 301.211 165.542 301.13 165.493 301.074C165.242 300.793 163.008 298.323 161.99 298.468C161.794 298.497 161.643 298.611 161.554 298.8C161.404 299.116 161.404 299.423 161.555 299.711C162.054 300.671 164.136 301.158 165.333 301.363C165.339 301.365 165.348 301.365 165.356 301.365ZM162.109 298.811C162.698 298.83 163.982 299.98 164.876 300.921C163.256 300.59 162.145 300.089 161.865 299.55C161.767 299.36 161.769 299.164 161.87 298.949C161.91 298.866 161.96 298.825 162.041 298.814C162.061 298.812 162.084 298.811 162.109 298.811Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M165.357 301.365C165.374 301.366 165.39 301.365 165.406 301.359C165.467 301.344 165.514 301.297 165.53 301.237C165.553 301.156 166.082 299.226 165.481 298.169C165.298 297.846 165.029 297.635 164.682 297.541C164.215 297.414 163.998 297.593 163.898 297.764C163.471 298.496 164.548 300.62 165.238 301.313C165.27 301.347 165.312 301.365 165.357 301.365ZM164.411 297.849C164.459 297.851 164.518 297.86 164.59 297.879C164.847 297.949 165.039 298.1 165.176 298.343C165.571 299.037 165.389 300.242 165.269 300.818C164.615 299.982 163.945 298.379 164.2 297.94C164.217 297.914 164.257 297.844 164.411 297.849Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M149.765 81.9355L150.065 82.6136L150.423 83.3841L151.166 84.9585C151.687 86.0099 152.231 87.056 152.808 88.0877C153.941 90.1621 155.168 92.1902 156.476 94.1482C157.797 96.0959 159.164 98.0144 160.668 99.7935C161.393 100.715 162.204 101.537 162.964 102.422L164.177 103.66L164.785 104.28L164.86 104.357L164.852 104.351C164.846 104.348 164.839 104.346 164.831 104.347C164.815 104.349 164.795 104.327 164.771 104.333C164.676 104.304 164.557 104.299 164.583 104.333C164.601 104.363 164.763 104.407 165.029 104.387C165.567 104.358 166.433 104.098 167.32 103.697C169.135 102.886 171.108 101.606 173.009 100.198C176.824 97.3638 180.587 93.9513 184.162 90.5679L188.505 94.0206C187.057 96.3253 185.517 98.416 183.861 100.514C182.199 102.592 180.429 104.607 178.471 106.535C176.492 108.451 174.386 110.313 171.69 111.926C170.319 112.712 168.806 113.47 166.826 113.924C165.838 114.14 164.709 114.276 163.457 114.161C162.214 114.05 160.846 113.663 159.651 112.976C159.363 112.801 159.062 112.623 158.796 112.426L158.399 112.124L158.204 111.969L158.103 111.884L157.303 111.201L155.708 109.826C154.7 108.864 153.657 107.918 152.728 106.887C150.79 104.881 149.039 102.733 147.408 100.507C145.761 98.291 144.288 95.9666 142.937 93.5703C142.269 92.3674 141.636 91.144 141.025 89.9018C140.729 89.2717 140.422 88.6527 140.143 88.0029L139.728 87.0184L139.297 85.9242L149.765 81.9355Z" fill="#FFC3BD"/>
                                    <path d="M146.632 73.9316C153.455 76.0436 156.622 91.3143 156.622 91.3143L146.196 100.477C146.196 100.477 140.145 94.6858 136.915 86.0269C133.396 76.5958 138.367 71.3735 146.632 73.9316Z" fill="#263238"/>
                                    <path d="M157.129 91.5918C156.644 90.2074 156.39 89.8145 156.39 89.8145C156.39 89.8145 145.844 97.3372 144.875 99.8294C145.406 100.822 146.491 101.237 146.491 101.237C146.491 101.237 156.067 94.7988 157.129 91.5918Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M182.895 92.2047L186.886 85.8813L192.825 92.6019C192.825 92.6019 188.516 97.8894 185.336 96.0538L182.895 92.2047Z" fill="#FFC3BD"/>
                                    <path d="M194.45 84.1091L196.134 86.8153C196.804 87.8923 196.596 89.2972 195.641 90.1336L192.826 92.6018L186.887 85.8813L190.834 83.3077C192.051 82.5141 193.682 82.8754 194.45 84.1091Z" fill="#FFC3BD"/>
                                    <path d="M311.693 41.0887C304.786 38.0427 296.792 36.3244 292.779 42.8729C290.153 47.1587 288.842 55.9031 284.213 60.611C283.293 61.5467 282.916 62.4765 282.942 63.3668C282.939 63.4319 282.932 63.4876 282.934 63.5663C283.013 66.2015 285.127 69.7321 290.562 71.0275C289.449 70.328 288.485 69.3101 287.845 68.3238C290.044 69.275 292.649 69.8426 294.932 69.8186C301.334 69.7493 306.256 70.2338 309.195 71.7569C312.135 73.2799 317.474 66.6458 317.229 63.5937C318.392 65.3308 319.776 63.5774 320.259 59.3773C321.496 48.5901 317.975 39.7164 311.693 41.0887Z" fill="#263238"/>
                                    <path d="M295.951 74.9854C292.863 74.9854 290.352 72.4735 290.352 69.3854C290.352 66.2974 292.863 63.7847 295.951 63.7847C299.04 63.7847 301.551 66.2965 301.551 69.3854C301.551 72.4735 299.04 74.9854 295.951 74.9854ZM295.951 64.199C293.092 64.199 290.766 66.526 290.766 69.3854C290.766 72.2449 293.092 74.571 295.951 74.571C298.811 74.571 301.137 72.2449 301.137 69.3854C301.136 66.526 298.811 64.199 295.951 64.199Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M290.159 94.4502C288.003 98.694 285.663 102.665 283.019 106.605C281.707 108.573 280.321 110.51 278.762 112.394C277.194 114.284 275.563 116.135 273.22 117.869C272.986 118.042 272.473 118.41 271.957 118.651C271.446 118.914 270.848 119.111 270.24 119.239C269.002 119.48 267.729 119.329 266.745 118.982C264.769 118.259 263.617 117.167 262.617 116.161C261.63 115.134 260.861 114.082 260.163 113.022C259.47 111.963 258.853 110.901 258.285 109.829C256.043 105.525 254.44 101.172 253.141 96.6179L256.886 95.2164C258.903 99.1606 261.1 103.144 263.511 106.697C264.704 108.457 266.041 110.15 267.349 111.306C267.979 111.877 268.668 112.243 268.873 112.24C268.975 112.24 268.874 112.183 268.756 112.2C268.702 112.19 268.652 112.216 268.642 112.203C268.639 112.194 268.591 112.222 268.804 112.045C270.073 110.973 271.435 109.323 272.687 107.637C273.943 105.927 275.154 104.106 276.334 102.251C277.515 100.395 278.624 98.4714 279.74 96.5485C280.858 94.6411 281.943 92.6437 282.979 90.7568L290.159 94.4502Z" fill="#B55B52"/>
                                    <path d="M287.791 83.1974C284.434 83.0801 278.492 95.2978 278.492 95.2978L284.885 109.613C284.885 109.613 297.434 93.1096 296.034 88.9728C294.577 84.6648 292.688 83.3686 287.791 83.1974Z" class="theme-color" fill="#DC143C"/>
                                    <path opacity="0.6" d="M287.791 83.1974C284.434 83.0801 278.492 95.2978 278.492 95.2978L284.885 109.613C284.885 109.613 297.434 93.1096 296.034 88.9728C294.577 84.6648 292.688 83.3686 287.791 83.1974Z"  fill="white"/>
                                    <path d="M256.331 89.4691L257.325 98.318L255 99.9438C251.802 99.2058 250.472 94.3122 250.472 94.3122L249.033 91.1651C248.399 89.7773 248.696 88.1421 249.778 87.066L250.424 86.4239C251.699 85.1226 253.843 85.2989 254.888 86.7912L255.822 88.1242C256.102 88.5223 256.277 88.9854 256.331 89.4691Z" fill="#B55B52"/>
                                    <path d="M304.024 302.649H296.127L295.41 284.361H303.307L304.024 302.649Z" fill="#B55B52"/>
                                    <path d="M295.396 301.734H304.268C304.59 301.734 304.83 301.959 304.844 302.274L305.146 309.293C305.177 310.021 304.482 310.71 303.738 310.697C300.65 310.644 299.178 310.463 295.276 310.463C292.875 310.463 287.351 310.712 284.036 310.712C280.794 310.712 280.877 307.434 282.287 307.137C288.61 305.806 291.765 303.971 294.027 302.22C294.434 301.904 294.923 301.734 295.396 301.734Z" fill="#263238"/>
                                    <g opacity="0.2">
                                    <path d="M295.414 284.366L295.782 293.792H303.683L303.314 284.366H295.414Z" fill="#111111"/>
                                    </g>
                                    <path d="M284.622 87.1096C284.447 92.1025 285.312 103.758 290.562 130.915L322.62 129.961C321.758 117.832 321.478 110.024 325.829 87.2637C326.396 84.2972 324.332 81.466 321.332 81.115C318.976 80.8393 316.107 80.5867 313.213 80.5337C307.811 80.4344 303.386 80.3933 298.656 80.9669C294.944 81.4172 290.945 82.1885 288.315 82.739C286.226 83.1765 284.697 84.9761 284.622 87.1096Z" class="theme-color" fill="#DC143C"/>
                                    <path opacity="0.7" d="M284.622 87.1096C284.447 92.1025 285.312 103.758 290.562 130.915L322.62 129.961C321.758 117.832 321.478 110.024 325.829 87.2637C326.396 84.2972 324.332 81.466 321.332 81.115C318.976 80.8393 316.107 80.5867 313.213 80.5337C307.811 80.4344 303.386 80.3933 298.656 80.9669C294.944 81.4172 290.945 82.1885 288.315 82.739C286.226 83.1765 284.697 84.9761 284.622 87.1096Z" fill="white"/>
                                    <path d="M311.282 64.1853C310.503 68.8966 309.842 77.5058 313.212 80.5339C313.212 80.5339 310.096 86.3675 302.094 88.4684C294.708 84.722 298.655 80.9679 298.655 80.9679C303.841 79.5656 303.591 75.6942 302.573 72.0814L311.282 64.1853Z" fill="#B55B52"/>
                                    <path d="M302.094 88.4684L303.049 86.5952L308.182 87.7561L302.094 88.4684Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M303.051 86.5953C304.699 85.8462 312.329 80.8764 312.628 79.3276C313.966 79.3276 316.959 80.474 316.959 80.474C316.959 80.474 315.585 86.5944 308.182 90.7843C307.227 88.8837 305.261 87.0953 303.051 86.5953Z" fill="white"/>
                                    <path d="M302.096 88.4684L301.666 86.5952L298.52 86.8195L302.096 88.4684Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M301.664 86.5953C299.117 84.9096 300.058 81.3755 300.307 79.8276C298.348 79.9903 296.565 80.7514 296.565 80.7514C296.565 80.7514 292.702 84.2915 296.447 90.7852C297.863 88.9377 299.111 87.7194 301.664 86.5953Z" fill="white"/>
                                    <path opacity="0.2" d="M307.733 67.4067L302.578 72.0769C302.822 72.9322 303.018 73.8003 303.104 74.6479C305.091 74.3003 307.766 72.0281 307.916 69.9323C307.991 68.887 307.917 67.887 307.733 67.4067Z" fill="#111111"/>
                                    <path d="M313.772 54.1806C313.427 62.0108 313.447 65.3317 309.566 69.4145C303.728 75.5555 294.186 73.4178 292.186 65.6425C290.386 58.6436 291.254 47.0149 298.856 43.771C306.346 40.5742 314.118 46.3505 313.772 54.1806Z" fill="#B55B52"/>
                                    <path d="M308.184 45.9009C305.551 50.3159 301.811 44.7006 298.834 48.0583C296.447 50.7508 292.532 47.9196 290.238 55.5939C291.025 48.9992 292.135 43.1707 298.869 41.2393C303.052 40.039 311.002 39.5869 308.184 45.9009Z" fill="#263238"/>
                                    <path d="M309.529 42.8728C307.222 44.4695 304.858 46.7776 305.14 49.5925C305.422 52.4075 309.467 51.1781 310.005 53.1549C310.545 55.1308 307.592 59.2924 311.883 59.6999C316.775 56.9766 318.148 56.3773 317.254 52.1772C316.36 47.9779 313.268 42.2915 309.529 42.8728Z" fill="#263238"/>
                                    <path d="M290.493 130.915C290.493 130.915 287.393 189.256 287.233 213.238C287.067 238.182 294.091 291.968 294.091 291.968H304.769C304.769 291.968 302.74 237.593 304.382 212.988C306.172 186.165 312.411 130.218 312.411 130.218L290.493 130.915Z" fill="#111111"/>
                                    <path d="M305.658 292.35H293.129L292.613 288.353L306.693 287.864L305.658 292.35Z" fill="#263238"/>
                                    <path opacity="0.2" d="M310.15 151.168C309 149.73 307.486 150.476 305.508 154.576C298.763 168.565 302.191 190.888 305.074 203.745C306.375 187.742 308.514 166.65 310.15 151.168Z" fill="white"/>
                                    <path d="M300.563 57.1744C300.574 57.8113 300.245 58.3336 299.829 58.3404C299.413 58.3473 299.066 57.837 299.055 57.2C299.044 56.5631 299.373 56.0409 299.789 56.034C300.205 56.0272 300.551 56.5374 300.563 57.1744Z" fill="#263238"/>
                                    <path d="M293.367 57.117C293.378 57.7539 293.05 58.2762 292.634 58.283C292.218 58.2899 291.871 57.7796 291.86 57.1427C291.849 56.5057 292.177 55.9835 292.593 55.9766C293.009 55.9698 293.356 56.48 293.367 57.117Z" fill="#263238"/>
                                    <path d="M292.78 56.0093L291.242 55.595C291.242 55.595 292.048 56.7756 292.78 56.0093Z" fill="#263238"/>
                                    <path d="M295.876 57.7043C295.876 57.7043 294.843 60.4645 293.676 61.8078C294.53 62.5783 295.953 62.1947 295.953 62.1947L295.876 57.7043Z" fill="#A02724"/>
                                    <path d="M299.771 64.2949C299.478 64.3454 299.167 64.3754 298.835 64.3814C298.731 64.3831 298.646 64.3009 298.645 64.1973C298.643 64.0937 298.734 64.0081 298.828 64.0073C301.632 63.9585 302.895 61.9842 302.907 61.9646C302.962 61.8772 303.077 61.8507 303.165 61.9055C303.252 61.9603 303.279 62.0758 303.224 62.1632C303.174 62.2419 302.112 63.8934 299.771 64.2949Z" fill="#263238"/>
                                    <path d="M316.001 61.5509C315.345 63.0372 314.063 64.0816 312.81 64.5431C310.925 65.2374 309.822 63.5911 310.21 61.7281C310.561 60.051 311.962 57.6692 313.918 57.7754C315.846 57.8798 316.752 59.8515 316.001 61.5509Z" fill="#B55B52"/>
                                    <path d="M312.691 74.9854C309.603 74.9854 307.09 72.4735 307.09 69.3854C307.09 66.2974 309.603 63.7847 312.691 63.7847C315.779 63.7847 318.291 66.2965 318.291 69.3854C318.291 72.4735 315.78 74.9854 312.691 74.9854ZM312.691 64.199C309.831 64.199 307.504 66.526 307.504 69.3854C307.504 72.2449 309.831 74.571 312.691 74.571C315.55 74.571 317.876 72.2449 317.876 69.3854C317.876 66.526 315.55 64.199 312.691 64.199Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M303.389 53.7362C303.233 53.7628 303.072 53.6891 302.995 53.5419C302.188 52.0111 299.98 51.7081 299.959 51.7046C299.754 51.6781 299.609 51.4906 299.636 51.2851C299.662 51.0805 299.849 50.9358 300.055 50.9624C300.162 50.9761 302.672 51.3219 303.658 53.1926C303.755 53.3749 303.685 53.6018 303.501 53.6977C303.465 53.7174 303.427 53.7302 303.389 53.7362Z" fill="#263238"/>
                                    <path d="M291.118 53.1497C290.992 53.1711 290.858 53.1283 290.769 53.0238C290.635 52.8663 290.654 52.6309 290.811 52.4964C292.385 51.154 294.047 51.6223 294.118 51.6429C294.316 51.7011 294.429 51.9091 294.371 52.1078C294.313 52.3047 294.107 52.4185 293.908 52.3612C293.853 52.3458 292.554 51.993 291.298 53.0658C291.244 53.1103 291.182 53.1385 291.118 53.1497Z" fill="#263238"/>
                                    <path d="M330.727 90.5967C332.173 94.7129 333.439 98.8189 334.587 103.025C335.167 105.123 335.72 107.237 336.19 109.406C336.427 110.492 336.653 111.588 336.852 112.721C337.038 113.868 337.214 114.997 337.278 116.395L337.294 116.939L337.276 117.57C337.254 117.95 337.218 118.178 337.19 118.489C337.134 119.084 337.056 119.626 336.984 120.184C336.825 121.29 336.649 122.368 336.465 123.442C336.108 125.59 335.678 127.707 335.252 129.821C334.371 134.045 333.376 138.226 332.23 142.394L328.284 141.743C328.516 137.465 328.836 133.191 329.181 128.945L329.693 122.605C329.775 121.555 329.845 120.508 329.898 119.485C329.926 118.978 329.964 118.457 329.97 117.983C329.974 117.761 329.993 117.457 329.985 117.302L329.973 117.131L329.943 116.873C329.858 116.137 329.656 115.154 329.428 114.204C329.204 113.239 328.948 112.251 328.677 111.259C328.118 109.275 327.531 107.264 326.918 105.254L323.082 93.1924L330.727 90.5967Z" fill="#B55B52"/>
                                    <path d="M321.333 81.1151C331.843 82.4216 333.924 95.2626 335.42 98.491L325.106 107.145C325.106 107.145 318.578 96.1581 317.627 91.8946C316.638 87.4556 317.529 80.6425 321.333 81.1151Z" class="theme-color" fill="#DC143C"/>
                                    <path opacity="0.7" d="M321.333 81.1151C331.843 82.4216 333.924 95.2626 335.42 98.491L325.106 107.145C325.106 107.145 318.578 96.1581 317.627 91.8946C316.638 87.4556 317.529 80.6425 321.333 81.1151Z" fill="white"/>
                                    <path d="M292.289 303.114C291.503 303.114 290.792 302.993 290.423 302.628C290.188 302.397 290.106 302.09 290.177 301.717C290.22 301.495 290.347 301.322 290.545 301.22C291.566 300.69 294.552 302.297 294.888 302.483C294.955 302.519 294.987 302.596 294.968 302.675C294.948 302.754 294.883 302.816 294.804 302.832C294.119 302.965 293.159 303.114 292.289 303.114ZM291.047 301.48C290.902 301.48 290.781 301.501 290.691 301.548C290.609 301.59 290.565 301.652 290.546 301.751C290.497 302.003 290.549 302.199 290.7 302.35C291.136 302.78 292.428 302.856 294.208 302.566C293.177 302.045 291.794 301.48 291.047 301.48Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M294.767 302.835C294.74 302.835 294.715 302.83 294.691 302.819C293.793 302.394 292.103 300.691 292.339 299.796C292.394 299.584 292.572 299.32 293.095 299.268C293.481 299.229 293.82 299.338 294.098 299.591C295.007 300.418 294.975 302.543 294.973 302.633C294.971 302.699 294.935 302.763 294.877 302.801C294.844 302.824 294.805 302.835 294.767 302.835ZM293.209 299.634C293.172 299.634 293.134 299.636 293.096 299.64C292.751 299.674 292.715 299.811 292.703 299.856C292.561 300.393 293.69 301.733 294.59 302.314C294.56 301.695 294.427 300.42 293.83 299.877C293.65 299.715 293.446 299.634 293.209 299.634Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M351.909 299.665L344.19 301.332L337.762 284.012L345.481 282.344L351.909 299.665Z" fill="#B55B52"/>
                                    <path d="M343.713 300.5L352.385 298.627C352.701 298.558 353.007 298.722 353.121 299.02L355.678 305.649C355.943 306.336 355.485 307.14 354.754 307.285C351.719 307.886 350.221 308.023 346.408 308.847C344.062 309.354 339.911 310.945 336.605 310.712C333.371 310.484 333.311 307.195 334.705 306.994C340.955 306.1 340.885 303.398 342.531 301.251C342.828 300.864 343.252 300.599 343.713 300.5Z" fill="#263238"/>
                                    <path d="M342.767 302.116C341.999 302.282 341.265 302.317 340.786 302.047C340.482 301.876 340.303 301.601 340.253 301.23C340.223 301.008 340.291 300.818 340.452 300.678C341.279 299.957 344.716 300.859 345.105 300.965C345.182 300.985 345.238 301.052 345.244 301.132C345.251 301.211 345.207 301.284 345.134 301.316C344.508 301.588 343.618 301.933 342.767 302.116ZM341.027 300.821C340.885 300.852 340.773 300.897 340.701 300.961C340.635 301.018 340.612 301.086 340.625 301.184C340.658 301.435 340.771 301.611 340.968 301.722C341.532 302.041 342.82 301.84 344.465 301.187C343.291 300.91 341.758 300.663 341.027 300.821Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M345.099 301.328C345.073 301.334 345.047 301.334 345.02 301.328C344.005 301.112 341.804 299.845 341.747 298.942C341.734 298.728 341.822 298.439 342.316 298.278C342.681 298.16 343.047 298.192 343.401 298.374C344.555 298.971 345.209 301.004 345.236 301.09C345.256 301.154 345.241 301.222 345.197 301.271C345.17 301.3 345.136 301.319 345.099 301.328ZM342.544 298.604C342.508 298.612 342.472 298.622 342.436 298.633C342.11 298.74 342.118 298.877 342.122 298.922C342.156 299.464 343.691 300.503 344.758 300.867C344.53 300.283 343.988 299.096 343.23 298.704C343.002 298.588 342.776 298.554 342.544 298.604Z" class="theme-color" fill="#DC143C"/>
                                    <g opacity="0.2">
                                    <path d="M337.766 284.016L341.078 292.944L348.8 291.276L345.488 282.347L337.766 284.016Z" fill="#111111"/>
                                    </g>
                                    <path d="M322.62 129.961C330.312 142.187 328.166 187.15 329.379 211.155C336.604 232.446 349.355 289.288 349.355 289.288L338.918 291.543C338.918 291.543 315.89 235.125 311.113 211.029C305.839 184.429 299.422 129.962 299.422 129.962C299.422 129.962 314.038 129.961 322.62 129.961Z" fill="#111111"/>
                                    <path d="M350.135 289.511L337.888 292.157L336.605 288.344L350.273 284.893L350.135 289.511Z" fill="#263238"/>
                                    <path d="M299.971 56.0667L298.434 55.6523C298.434 55.6523 299.24 56.8338 299.971 56.0667Z" fill="#263238"/>
                                    <path d="M323.046 128.066L323.951 130.911C324.07 131.13 323.813 131.365 323.442 131.376L290.448 132.357C290.159 132.365 289.916 132.231 289.892 132.05L289.517 129.188C289.492 128.99 289.737 128.814 290.053 128.805L322.518 127.839C322.756 127.833 322.97 127.925 323.046 128.066Z" fill="#263238"/>
                                    <path d="M318.796 131.825L319.666 131.799C319.839 131.794 319.968 131.701 319.953 131.592L319.435 127.876C319.419 127.767 319.265 127.682 319.092 127.687L318.222 127.713C318.049 127.718 317.92 127.812 317.935 127.92L318.454 131.637C318.468 131.746 318.622 131.83 318.796 131.825Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M292.901 132.596L293.771 132.57C293.944 132.565 294.073 132.472 294.059 132.363L293.54 128.646C293.525 128.538 293.371 128.453 293.198 128.458L292.328 128.484C292.155 128.489 292.026 128.582 292.04 128.691L292.559 132.407C292.574 132.516 292.729 132.601 292.901 132.596Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M305.848 132.21L306.717 132.185C306.89 132.18 307.02 132.086 307.004 131.978L306.485 128.261C306.47 128.152 306.316 128.068 306.143 128.073L305.273 128.098C305.1 128.104 304.971 128.197 304.985 128.306L305.504 132.022C305.521 132.131 305.675 132.216 305.848 132.21Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M328.818 140.436L323.035 146.709L331.058 147.066C331.023 147.158 333.669 142.813 332.035 139.906L328.818 140.436Z" fill="#B55B52"/>
                                    <path d="M325.13 153.301L327.453 153.279C328.51 153.269 329.436 152.569 329.735 151.556L331.057 147.066L323.035 146.709L322.711 150.705C322.598 152.112 323.717 153.314 325.13 153.301Z" fill="#B55B52"/>
                                    <path d="M264.322 97.7993C249.923 83.4002 226.579 83.4002 212.18 97.7993C197.781 83.4002 174.437 83.4002 160.038 97.7993C145.639 112.198 145.639 135.543 160.038 149.942L212.18 202.084L264.322 149.942C278.721 135.543 278.721 112.198 264.322 97.7993Z" class="theme-color" fill="#DC143C"/>
                                    <path opacity="0.2" d="M264.322 97.7993C249.923 83.4002 226.579 83.4002 212.18 97.7993C197.781 83.4002 174.437 83.4002 160.038 97.7993C145.639 112.198 145.639 135.543 160.038 149.942L212.18 202.084L264.322 149.942C278.721 135.543 278.721 112.198 264.322 97.7993Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M165.417 144.563C154.007 133.154 154.007 114.589 165.417 103.18C170.944 97.6524 178.292 94.6086 186.109 94.6086C193.925 94.6086 201.273 97.6524 206.8 103.18L212.18 108.56L217.56 103.18C223.087 97.6524 230.436 94.6086 238.252 94.6086C246.067 94.6086 253.417 97.6524 258.943 103.18C264.471 108.707 267.515 116.056 267.515 123.872C267.515 131.688 264.471 139.037 258.943 144.563L212.18 191.325L165.417 144.563Z" class="theme-color" fill="#DC143C"/>
                                    <path d="M176.001 117H188.856V120.38H184.543V130.687H180.314V120.38H176V117H176.001Z" fill="white"/>
                                    <path d="M190.789 117H195.018V121.79H199.64V117H203.888V130.687H199.64V125.151H195.018V130.687H190.789V117Z" fill="white"/>
                                    <path d="M215.111 128.428H210.309L209.642 130.687H205.324L210.468 117H215.081L220.224 130.687H215.796L215.111 128.428ZM214.234 125.468L212.723 120.548L211.228 125.468H214.234Z" fill="white"/>
                                    <path d="M221.598 117H225.546L230.7 124.572V117H234.686V130.687H230.7L225.575 123.172V130.687H221.598V117Z" fill="white"/>
                                    <path d="M237.516 117H241.745V122.172L246.175 117H251.8L246.806 122.166L252.024 130.687H246.816L243.931 125.058L241.746 127.347V130.687H237.517V117H237.516Z" fill="white"/>
                                    <path d="M191.023 139.944H195.721L198.478 144.561L201.241 139.944H205.914L200.592 147.898V153.63H196.354V147.898L191.023 139.944Z" fill="white"/>
                                    <path d="M205.594 146.796C205.594 144.562 206.216 142.822 207.461 141.577C208.705 140.332 210.439 139.71 212.661 139.71C214.939 139.71 216.694 140.321 217.926 141.544C219.159 142.767 219.775 144.48 219.775 146.683C219.775 148.283 219.505 149.595 218.967 150.619C218.429 151.642 217.651 152.439 216.633 153.008C215.615 153.577 214.347 153.862 212.829 153.862C211.286 153.862 210.008 153.616 208.997 153.125C207.986 152.634 207.165 151.856 206.537 150.791C205.908 149.728 205.594 148.395 205.594 146.796ZM209.823 146.815C209.823 148.197 210.079 149.189 210.593 149.793C211.106 150.397 211.805 150.698 212.689 150.698C213.598 150.698 214.301 150.403 214.799 149.811C215.297 149.22 215.545 148.159 215.545 146.627C215.545 145.34 215.286 144.398 214.766 143.804C214.246 143.21 213.542 142.912 212.652 142.912C211.798 142.912 211.115 143.214 210.598 143.817C210.081 144.421 209.823 145.421 209.823 146.815Z" fill="white"/>
                                    <path d="M230.961 139.944H235.18V148.098C235.18 148.907 235.054 149.671 234.802 150.389C234.55 151.108 234.155 151.736 233.616 152.273C233.078 152.811 232.513 153.189 231.922 153.407C231.1 153.712 230.113 153.865 228.962 153.865C228.296 153.865 227.569 153.818 226.782 153.724C225.995 153.631 225.337 153.446 224.808 153.169C224.279 152.893 223.795 152.499 223.356 151.989C222.917 151.479 222.616 150.954 222.454 150.413C222.193 149.541 222.062 148.771 222.062 148.098V139.944H226.282V148.292C226.282 149.039 226.489 149.621 226.902 150.042C227.317 150.462 227.891 150.672 228.625 150.672C229.353 150.672 229.924 150.465 230.338 150.051C230.752 149.638 230.959 149.051 230.959 148.293V139.944H230.961Z"  fill="white"/>
                                </svg>
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

     </main>
        <div id="previewImage"> </div>
        <a id="download" href="#" class="font-lg download mr-3 text-white">
            <i class="fas fa-download"></i>
        </a>
  </div>
@endsection
