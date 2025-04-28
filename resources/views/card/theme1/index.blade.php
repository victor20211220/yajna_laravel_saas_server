@php
    use App\Models\Utility;
@endphp
@extends('card.layouts')
@section('contentCard')
    <div id="card_preview"
         style="background-color: {{ $business->card_bg_color ?? '#ffffff' }};" class="position-absolute top-0 start-0 h-100 w-100 z-10 custom-rounded-34">
        <a href="javascript:void(0);" class="share-info position-absolute right top me-4 mt-4"
           style="z-index:4;">
            <div
                class="info-icon d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="38"
                     height="39" viewBox="0 0 38 39" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M13.593 22.7056L21.7663 14.5308C22.3059 13.9911 23.1832 13.9911 23.7228 14.5308C24.2624 15.0718 24.2624 15.9477 23.7228 16.4887L15.5495 24.6621L21.9656 36.7819C22.483 37.7601 23.536 38.3358 24.6388 38.2444C25.743 38.1531 26.6866 37.4128 27.0367 36.3612C29.472 29.0567 35.5795 10.7325 37.8584 3.89712C38.1891 2.90225 37.9303 1.80637 37.1901 1.06471C36.4484 0.323054 35.3526 0.0643024 34.3577 0.396388L1.89265 11.2182C0.842444 11.5683 0.10217 12.5106 0.00946439 13.6148C-0.0818578 14.719 0.493768 15.7706 1.47341 16.2894L13.593 22.7056Z"
                          fill="#247BDF"/>
                </svg>
            </div>
        </a>
        <section class="profile-sec pb">
            <div class="profile-banner">
                {{-- banner preview --}}
                <img class="profile-banner-img"
                     src="{{ $business->banner ? $banner . '/' . $business->banner : "/assets/images/white-blank.png" }}"
                     id="banner_preview" alt="">
            </div>
            <div class="client-info-wrp text-center">
                <svg width="576" height="195" viewBox="0 0 576 195" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="460"
                          y="92" width="7" height="7">
                        <path
                            d="M463.475 98.4276C461.886 98.4276 460.598 97.1365 460.598 95.5471C460.598 93.9577 461.886 92.6703 463.475 92.6703C465.064 92.6703 466.352 93.9577 466.352 95.5471C466.352 97.1365 465.064 98.4276 463.475 98.4276Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask0_287_94)">
                        <path
                            d="M463.475 98.4276C461.886 98.4276 460.598 97.1365 460.598 95.5471C460.598 93.9577 461.886 92.6703 463.475 92.6703C465.064 92.6703 466.352 93.9577 466.352 95.5471C466.352 97.1365 465.064 98.4276 463.475 98.4276Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask1_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="441" y="5"
                          width="6" height="7">
                        <path
                            d="M444.105 11.5312C442.516 11.5312 441.225 10.2438 441.225 8.65074C441.225 7.06135 442.516 5.77364 444.105 5.77364C445.694 5.77364 446.982 7.06135 446.982 8.65074C446.982 10.2438 445.694 11.5312 444.105 11.5312Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask1_287_94)">
                        <path
                            d="M444.105 11.5312C442.516 11.5312 441.225 10.2438 441.225 8.65074C441.225 7.06135 442.516 5.77364 444.105 5.77364C445.694 5.77364 446.982 7.06135 446.982 8.65074C446.982 10.2438 445.694 11.5312 444.105 11.5312Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask2_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="512" y="0"
                          width="7" height="6">
                        <path
                            d="M515.264 5.75388C513.672 5.75388 512.384 4.46616 512.384 2.87925C512.384 1.28739 513.672 -7.26602e-06 515.264 -7.26602e-06C516.854 -7.26602e-06 518.142 1.28739 518.142 2.87925C518.142 4.46616 516.854 5.75388 515.264 5.75388Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask2_287_94)">
                        <path
                            d="M515.264 5.75388C513.672 5.75388 512.384 4.46616 512.384 2.87925C512.384 1.28739 513.672 -7.26602e-06 515.264 -7.26602e-06C516.854 -7.26602e-06 518.142 1.28739 518.142 2.87925C518.142 4.46616 516.854 5.75388 515.264 5.75388Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask3_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="139"
                          y="81" width="7" height="7">
                        <path
                            d="M142.765 87.2426C141.176 87.2426 139.888 85.9552 139.888 84.3658C139.888 82.7739 141.176 81.4862 142.765 81.4862C144.354 81.4862 145.645 82.7739 145.645 84.3658C145.645 85.9552 144.354 87.2426 142.765 87.2426Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask3_287_94)">
                        <path
                            d="M142.765 87.2426C141.176 87.2426 139.888 85.9552 139.888 84.3658C139.888 82.7739 141.176 81.4862 142.765 81.4862C144.354 81.4862 145.645 82.7739 145.645 84.3658C145.645 85.9552 144.354 87.2426 142.765 87.2426Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask4_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="92"
                          y="115" width="10" height="10">
                        <path
                            d="M97.0162 124.58C94.6015 124.58 92.6431 122.622 92.6431 120.211C92.6431 117.796 94.6015 115.838 97.0162 115.838C99.4277 115.838 101.386 117.796 101.386 120.211C101.386 122.622 99.4277 124.58 97.0162 124.58Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask4_287_94)">
                        <path
                            d="M97.0162 124.58C94.6015 124.58 92.6431 122.622 92.6431 120.211C92.6431 117.796 94.6015 115.838 97.0162 115.838C99.4277 115.838 101.386 117.796 101.386 120.211C101.386 122.622 99.4277 124.58 97.0162 124.58Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask5_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="289"
                          y="26" width="17" height="17">
                        <path
                            d="M297.551 42.7803C293.165 42.7803 289.611 39.227 289.611 34.8406C289.611 30.4557 293.165 26.8986 297.551 26.8986C301.939 26.8986 305.496 30.4557 305.496 34.8406C305.496 39.227 301.939 42.7803 297.551 42.7803Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask5_287_94)">
                        <path
                            d="M297.551 42.7803C293.165 42.7803 289.611 39.227 289.611 34.8406C289.611 30.4557 293.165 26.8986 297.551 26.8986C301.939 26.8986 305.496 30.4557 305.496 34.8406C305.496 39.227 301.939 42.7803 297.551 42.7803Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask6_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="44" y="58"
                          width="12" height="12">
                        <path
                            d="M50.0178 69.4995C47.0476 69.4995 44.6392 67.0904 44.6392 64.1214C44.6392 61.1509 47.0476 58.7422 50.0178 58.7422C52.9911 58.7422 55.3964 61.1509 55.3964 64.1214C55.3964 67.0904 52.9911 69.4995 50.0178 69.4995Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask6_287_94)">
                        <path
                            d="M50.0178 69.4995C47.0476 69.4995 44.6392 67.0904 44.6392 64.1214C44.6392 61.1509 47.0476 58.7422 50.0178 58.7422C52.9911 58.7422 55.3964 61.1509 55.3964 64.1214C55.3964 67.0904 52.9911 69.4995 50.0178 69.4995Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask7_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="415"
                          y="40" width="7" height="7">
                        <path
                            d="M418.503 46.6391C416.914 46.6391 415.626 45.3502 415.626 43.7608C415.626 42.1726 416.914 40.884 418.503 40.884C420.092 40.884 421.38 42.1726 421.38 43.7608C421.38 45.3502 420.092 46.6391 418.503 46.6391Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask7_287_94)">
                        <path
                            d="M418.503 46.6391C416.914 46.6391 415.626 45.3502 415.626 43.7608C415.626 42.1726 416.914 40.884 418.503 40.884C420.092 40.884 421.38 42.1726 421.38 43.7608C421.38 45.3502 420.092 46.6391 418.503 46.6391Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask8_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="551"
                          y="69" width="7" height="7">
                        <path
                            d="M554.79 75.2687C553.197 75.2687 551.906 73.9776 551.906 72.3823C551.906 70.7939 553.197 69.5028 554.79 69.5028C556.385 69.5028 557.676 70.7939 557.676 72.3823C557.676 73.9776 556.385 75.2687 554.79 75.2687Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask8_287_94)">
                        <path
                            d="M554.79 75.2687C553.197 75.2687 551.906 73.9776 551.906 72.3823C551.906 70.7939 553.197 69.5028 554.79 69.5028C556.385 69.5028 557.676 70.7939 557.676 72.3823C557.676 73.9776 556.385 75.2687 554.79 75.2687Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask9_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="45"
                          y="140" width="9" height="9">
                        <path
                            d="M49.6942 148.691C47.4564 148.691 45.647 146.879 45.647 144.647C45.647 142.41 47.4564 140.597 49.6942 140.597C51.9288 140.597 53.7413 142.41 53.7413 144.647C53.7413 146.879 51.9288 148.691 49.6942 148.691Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask9_287_94)">
                        <path
                            d="M49.6942 148.691C47.4564 148.691 45.647 146.879 45.647 144.647C45.647 142.41 47.4564 140.597 49.6942 140.597C51.9288 140.597 53.7413 142.41 53.7413 144.647C53.7413 146.879 51.9288 148.691 49.6942 148.691Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask10_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="14"
                          y="110" width="7" height="7">
                        <path
                            d="M17.8431 116.141C16.254 116.141 14.9629 114.849 14.9629 113.26C14.9629 111.674 16.254 110.387 17.8431 110.387C19.4322 110.387 20.7202 111.674 20.7202 113.26C20.7202 114.849 19.4322 116.141 17.8431 116.141Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask10_287_94)">
                        <path
                            d="M17.8431 116.141C16.254 116.141 14.9629 114.849 14.9629 113.26C14.9629 111.674 16.254 110.387 17.8431 110.387C19.4322 110.387 20.7202 111.674 20.7202 113.26C20.7202 114.849 19.4322 116.141 17.8431 116.141Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask11_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="410"
                          y="110" width="6" height="7">
                        <path
                            d="M412.908 116.141C411.319 116.141 410.031 114.852 410.031 113.264C410.031 111.674 411.319 110.387 412.908 110.387C414.501 110.387 415.789 111.674 415.789 113.264C415.789 114.852 414.501 116.141 412.908 116.141Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask11_287_94)">
                        <path
                            d="M412.908 116.141C411.319 116.141 410.031 114.852 410.031 113.264C410.031 111.674 411.319 110.387 412.908 110.387C414.501 110.387 415.789 111.674 415.789 113.264C415.789 114.852 414.501 116.141 412.908 116.141Z"
                            fill="#7E3AE3"/>
                    </g>
                    <mask id="mask12_287_94" style="mask-type:luminance"
                          maskUnits="userSpaceOnUse" x="517"
                          y="137" width="7" height="7">
                        <path
                            d="M520.41 143.02C518.821 143.02 517.53 141.733 517.53 140.147C517.53 138.554 518.821 137.266 520.41 137.266C521.999 137.266 523.287 138.554 523.287 140.147C523.287 141.733 521.999 143.02 520.41 143.02Z"
                            fill="white"/>
                    </mask>
                    <g mask="url(#mask12_287_94)">
                        <path
                            d="M520.41 143.02C518.821 143.02 517.53 141.733 517.53 140.147C517.53 138.554 518.821 137.266 520.41 137.266C521.999 137.266 523.287 138.554 523.287 140.147C523.287 141.733 521.999 143.02 520.41 143.02Z"
                            fill="#7E3AE3"/>
                    </g>
                </svg>

                <div class="client-image">
                    <img id="business_logo_preview"
                         src="{{ $business->logo ? $logo . '/' . $business->logo : Utility::imagePlaceholderUrl() }}"
                         alt="">
                </div>
                <div class="client-image">
                    <img id="business_company_logo_preview"
                         class="{{ $business->company_logo ? "": "d-none" }}"
                         src="{{ $business->company_logo ? $company_logo . '/' . $business->company_logo : "" }}"
                         alt="">
                </div>

                <div class="container">
                    <div class="section-title text-center">
                        <h2 id="{{ $stringid . '_title' }}_preview"
                            class="text-black">{{ $business->title }}</h2>
                    </div>
                </div>
                <div class="client-info">
                    <h3 id="{{ $stringid . '_designation' }}_preview" class="text-black">
                        {{ $business->designation }}</h3>
                    <span class="subtitle"
                          id="{{ $stringid . '_subtitle' }}_preview">{{ $business->sub_title }}</span>
                    <p class="text-wrap" id="{{ $stringid . '_desc' }}_preview">
                        {!! nl2br(e($business->description)) !!}</p>
                </div>
            </div>
        </section>

        <section class="social-link-sec pb" id="social-div">
            <div class="container">
                <div class="section-title common-title">
                    <h2>{{ __('Social') }}</h2>
                    <div class="line"></div>
                    <div class="title-circle">
                        <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                    stroke-width="4" stroke-dasharray="1 2"/>
                        </svg>
                    </div>
                </div>
                <div class="social-link-slider" id="inputrow_socials_preview">
                    @if ($social_content)
                        @foreach ($social_content as $social_key => $social_val)
                            @foreach ($social_val as $social_key1 => $social_val1)
                                @if ($social_key1 != 'id')
                                    <div class="social-link"
                                         id="socials_{{ $social_key }}">
                                        @if ($social_key1 == 'Whatsapp')
                                            @php
                                                $social_links = 'https://wa.me/' . $social_val1;
                                            @endphp
                                        @else
                                            @php
                                                $social_links = url($social_val1);
                                            @endphp
                                        @endif
                                        <a href="{{ $social_links }}"
                                           target="_blank"
                                           id="{{ 'social_link_' . $social_key . '_href_preview' }}">
                                            <img
                                                src="{{ asset('custom/theme1/icon/social/' . strtolower($social_key1) . '.svg') }}"
                                                alt="social" class="img-fluid">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <section class="more-info-sec pb">
            <div class="container">
                <div class="section-title common-title">
                    <h2>{{ __('More') }}</h2>
                    <div class="line"></div>
                    <div class="title-circle">
                        <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                    stroke-width="4" stroke-dasharray="1 2"/>
                        </svg>
                    </div>
                </div>
                <ul class="d-flex justify-content-between">
                    <li>
                        <a href="{{ route('bussiness.save', $business->slug) }}"
                           class="save-info">
                            <div
                                class="info-icon d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40"
                                     height="34" viewBox="0 0 40 34" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M6.83814 0.69145C8.45908 0.361193 10.3896 0.253906 12.6221 0.253906H15.8569C17.8627 0.253906 19.7358 1.17296 20.8484 2.70306L22.4732 4.93752C22.8441 5.44752 23.4684 5.75391 24.1371 5.75391H34.2464C37.4409 5.75391 40.0301 8.06601 39.9997 11.0434C39.9633 14.5891 39.9939 18.1361 39.9939 21.6819C39.9939 23.7286 39.877 25.4985 39.5166 26.9846C39.1515 28.4916 38.51 29.8166 37.3773 30.855C36.2447 31.8934 34.7995 32.4815 33.1558 32.8163C31.5348 33.1467 29.6043 33.2539 27.3719 33.2539H12.6221C10.3896 33.2539 8.45908 33.1467 6.83814 32.8163C5.19449 32.4815 3.74919 31.8934 2.61656 30.855C1.48396 29.8166 0.842533 28.4916 0.477248 26.9846C0.117022 25.4985 0 23.7286 0 21.6819V11.8259C0 9.77912 0.117022 8.00924 0.477248 6.52315C0.842533 5.01625 1.48396 3.69119 2.61656 2.65279C3.74919 1.6144 5.19449 1.02634 6.83814 0.69145ZM21.9967 14.9206C21.9967 13.908 21.1014 13.0872 19.997 13.0872C18.8925 13.0872 17.9973 13.908 17.9973 14.9206V20.5779L16.4117 19.1242C15.6308 18.4083 14.3647 18.4083 13.5837 19.1242C12.8028 19.8401 12.8028 21.001 13.5837 21.7169L18.458 26.1857C18.4794 26.2053 18.5012 26.2245 18.5234 26.2432C18.8889 26.6083 19.4137 26.8372 19.997 26.8372C20.5803 26.8372 21.105 26.6083 21.4705 26.2432C21.4927 26.2245 21.5145 26.2053 21.5359 26.1857L26.4102 21.7169C27.1911 21.001 27.1911 19.8401 26.4102 19.1242C25.6293 18.4083 24.3631 18.4083 23.5822 19.1242L21.9967 20.5779V14.9206Z"
                                          fill="#7E3AE3"/>
                                </svg>
                            </div>
                        </a>
                        <h3>{{ __('Save') }}</h3>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="contact-info">
                            <div
                                class="info-icon d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36"
                                     height="37" viewBox="0 0 36 37" fill="none">
                                    <path
                                        d="M35.572 28.4051L29.6392 22.4725C29.4337 22.2669 29.1715 22.1273 28.8862 22.0716C28.6009 22.0158 28.3055 22.0464 28.0377 22.1594L21.7923 24.795L11.4587 14.4616L14.0944 8.21629C14.2074 7.94846 14.238 7.65299 14.1823 7.36768C14.1265 7.08237 13.9869 6.82017 13.7813 6.61462L7.84863 0.681962C7.71293 0.546252 7.55182 0.438601 7.37451 0.365155C7.19721 0.291709 7.00717 0.253906 6.81525 0.253906C6.62333 0.253906 6.43329 0.291709 6.25598 0.365155C6.07867 0.438601 5.91757 0.546252 5.78186 0.681962L1.73049 4.73337C-2.90779 9.37172 2.381 17.7525 10.4412 25.8127C18.5014 33.8729 26.8823 39.1616 31.5206 34.5233L35.572 30.4719C35.8461 30.1978 36 29.8261 36 29.4385C36 29.0509 35.846 28.6792 35.572 28.4051Z"
                                        fill="#EC2183"/>
                                </svg>
                            </div>
                        </a>
                        <h3>{{ __('Contact') }}</h3>
                    </li>
                </ul>
            </div>
        </section>
        <section>
            <h2>Contact</h2>
            <p>
                phone:
                <a id="{{ $stringid . '_phone' }}_preview" href="tel:{{ $business->phone }}">
                    {{ $business->phone }}
                </a>
            </p>

            <p>
                address:
                <a id="{{ $stringid . '_address' }}_preview"
                   href="https://www.google.com/maps/search/?api=1&query={{ urlencode($business->address) }}"
                   target="_blank">
                    {{ $business->address }}
                </a>
            </p>

            <p>
                email:
                <a id="{{ $stringid . '_email' }}_preview" href="mailto:{{ $business->email }}">
                    {{ $business->email }}
                </a>
            </p>

            <p>
                website:
                <a id="{{ $stringid . '_website' }}_preview"
                   href="{{ $business->website }}"
                   target="_blank">
                    {{ $business->website }}
                </a>
            </p>
        </section>


        {{--
        <section class="service-sec pb" id="servicesOnCard">
            <div class="container">
                <div class="section-title common-title">
                    <h2>{{ __('Services') }}</h2>
                    <div class="line"></div>
                </div>
                <div class="" id="inputrow_service_preview">
                    @foreach ($services_content as $k1 => $content)
                        @php $service_id = $content->id; @endphp
                        <div class="service-card"
                             id="services_{{ $service_id }}">
                            <div class="service-card-inner">
                                <div class="service-content-top">
                                    <h5 id="{{ 'title_' . $service_id . '_preview' }}">
                                        {{ $content->title }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if (!is_null($gallery_contents) && !is_null($gallery))
            <section class="gallery-sec bg-light-color pt pb" id="galleryOnCard">
                <div class="container">
                    <div class="section-title common-title">
                        <h2>{{ __('Gallery') }}</h2>
                        <div class="line"></div>
                        <div class="title-circle">
                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                        stroke-width="4" stroke-dasharray="1 2"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div id="inputrow_gallery_preview" class="gallery-slider">
                    @foreach ($gallery_contents as $gallery_content)
                        @if(in_array($gallery_content->type, ["image", "custom_image_link"]))
                            <div class="gallery-card">
                                <div class="gallery-card-inner">
                                    <a href="javascript:void(0)"
                                       tabindex="0"
                                       class="gallery-popup-btn gallery-margin img-wrapper">
                                        <img
                                            src="{{ ($gallery_content->type === "image" ? $gallery_path . "/" : "") . $gallery_content->value }}"
                                            alt="images"
                                            class="imageresource">
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Arrow Navigation -->
                <div
                    class="arrow-wrapper d-flex align-items-center justify-content-center">
                    <div class="slick-prev slick-arrow gallery-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                             viewBox="0 0 18 12" fill="none">
                            <path
                                d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                fill="#7E3AE3"/>
                        </svg>
                    </div>
                    <div class="slick-next slick-arrow gallery-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                             viewBox="0 0 18 12" fill="none">
                            <path
                                d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                fill="#7E3AE3"/>
                        </svg>
                    </div>
                </div>
            </section>

            <section class="gallery-sec bg-light-color pt pb" id="featuredVideosOnCard">
                <div class="container">
                    <div class="section-title common-title">
                        <h2>{{ __('Featured Video') }}</h2>
                        <div class="line"></div>
                        <div class="title-circle">
                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                        stroke-width="4" stroke-dasharray="1 2"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="featured-video-slider">
                    @foreach ($gallery_contents as $gallery_content)
                        @if (in_array($gallery_content->type, ["video", "custom_video_link"]))
                            <div class="gallery-card">
                                <div class="gallery-card-inner">
                                    <a href="javascript:void(0)"
                                       class="video-popup-btn play-btn gallery-margin img-wrapper">
                                        <video loop>
                                            <source class="videoresource"
                                                    src="{{ ($gallery_content->type === "video" ? $gallery_path . "/" : "") . $gallery_content->value }}"
                                                    type="video/mp4">
                                        </video>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Arrow Navigation -->
                <div
                    class="arrow-wrapper d-flex align-items-center justify-content-center">
                    <div class="slick-prev slick-arrow gallery-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                             viewBox="0 0 18 12" fill="none">
                            <path
                                d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                fill="#7E3AE3"/>
                        </svg>
                    </div>
                    <div class="slick-next slick-arrow gallery-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                             viewBox="0 0 18 12" fill="none">
                            <path
                                d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                fill="#7E3AE3"/>
                        </svg>
                    </div>
                </div>
            </section>

            <section class="mb-3" id="googleReviewPreview">
                <h2>Google Review</h2>
                <h3 id="{{ $stringid . '_google_review_link' }}_preview">
                    {{ $business->google_review_link }}</h3>
            </section>
        @endif

        --}}
    </div>
@endsection
