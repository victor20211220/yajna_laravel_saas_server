<div class="theme-preview-body">
    <!-- gallery-popup -->
    <div class="theme-popup gallery-popup d-flex align-items-center" id="gallerymodel">
        <div class="theme-popup-inner">
            <div class="theme-popup-content popup-scroll">
                <div class="popup-header d-flex align-items-center justify-content-between">
                    <div class="popup-title d-flex align-items-center">
                        <button type="button" class="gallery-close close-arrow-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="12"
                                 viewBox="0 0 17 12"
                                 fill="none">
                                <path
                                    d="M0.245743 5.66968C-0.0471496 5.96257 -0.0471497 6.43745 0.245743 6.73034L5.01871 11.5033C5.31161 11.7962 5.78648 11.7962 6.07937 11.5033C6.37227 11.2104 6.37227 10.7355 6.07937 10.4427L1.83673 6.20001L6.07937 1.95737C6.37227 1.66448 6.37227 1.1896 6.07937 0.89671C5.78648 0.603817 5.31161 0.603817 5.01871 0.89671L0.245743 5.66968ZM16.9761 5.45001L0.776074 5.45001L0.776073 6.95001L16.9761 6.95001L16.9761 5.45001Z"
                                    fill="#7E3AE3"/>
                            </svg>
                        </button>
                        <h2>{{ __('Gallary') }}</h2>
                    </div>
                    <button type="button" class="gallery-close close-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12"
                             fill="none">
                            <path
                                d="M7.59938 6.00986L12.2719 1.33715C12.576 1.03321 12.576 0.541783 12.2719 0.237843C11.968 -0.0660973 11.4766 -0.0660973 11.1726 0.237843L6.49993 4.91055L1.82737 0.237843C1.52329 -0.0660973 1.032 -0.0660973 0.728062 0.237843C0.423979 0.541783 0.423979 1.03321 0.728062 1.33715L5.40062 6.00986L0.728062 10.6826C0.423979 10.9865 0.423979 11.4779 0.728062 11.7819C0.879534 11.9335 1.0787 12.0096 1.27772 12.0096C1.47674 12.0096 1.67576 11.9335 1.82737 11.7819L6.49993 7.10917L11.1726 11.7819C11.3243 11.9335 11.5233 12.0096 11.7223 12.0096C11.9213 12.0096 12.1203 11.9335 12.2719 11.7819C12.576 11.4779 12.576 10.9865 12.2719 10.6826L7.59938 6.00986Z"
                                fill="black"/>
                        </svg>
                    </button>
                </div>
                <div class="popup-body">
                    <div class="gallery-wrp">
                        <div class="form-group">
                            <label>{{ __('Image preview:') }}</label>
                            <div class="img-wrapper">
                                <img src="" class="imagepreview">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="popup-footer text-center">
                    <button type="button" class="btn gallery-close">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Video modal --}}
    <div class="theme-popup video-popup d-flex align-items-center" id="videomodel">
        <div class="theme-popup-inner">
            <div class="theme-popup-content popup-scroll">
                <div class="popup-header d-flex align-items-center justify-content-between">
                    <div class="popup-title d-flex align-items-center">
                        <button type="button" class="video-close close-arrow-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="12"
                                 viewBox="0 0 17 12" fill="none">
                                <path
                                    d="M0.245743 5.66968C-0.0471496 5.96257 -0.0471497 6.43745 0.245743 6.73034L5.01871 11.5033C5.31161 11.7962 5.78648 11.7962 6.07937 11.5033C6.37227 11.2104 6.37227 10.7355 6.07937 10.4427L1.83673 6.20001L6.07937 1.95737C6.37227 1.66448 6.37227 1.1896 6.07937 0.89671C5.78648 0.603817 5.31161 0.603817 5.01871 0.89671L0.245743 5.66968ZM16.9761 5.45001L0.776074 5.45001L0.776073 6.95001L16.9761 6.95001L16.9761 5.45001Z"
                                    fill="#7E3AE3"/>
                            </svg>
                        </button>
                        <h2>{{ __('Gallary') }}</h2>
                    </div>
                    <button type="button" class="video-close close-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12"
                             fill="none">
                            <path
                                d="M7.59938 6.00986L12.2719 1.33715C12.576 1.03321 12.576 0.541783 12.2719 0.237843C11.968 -0.0660973 11.4766 -0.0660973 11.1726 0.237843L6.49993 4.91055L1.82737 0.237843C1.52329 -0.0660973 1.032 -0.0660973 0.728062 0.237843C0.423979 0.541783 0.423979 1.03321 0.728062 1.33715L5.40062 6.00986L0.728062 10.6826C0.423979 10.9865 0.423979 11.4779 0.728062 11.7819C0.879534 11.9335 1.0787 12.0096 1.27772 12.0096C1.47674 12.0096 1.67576 11.9335 1.82737 11.7819L6.49993 7.10917L11.1726 11.7819C11.3243 11.9335 11.5233 12.0096 11.7223 12.0096C11.9213 12.0096 12.1203 11.9335 12.2719 11.7819C12.576 11.4779 12.576 10.9865 12.2719 10.6826L7.59938 6.00986Z"
                                fill="black"/>
                        </svg>
                    </button>
                </div>
                <div class="popup-body">
                    <div class="gallery-wrp">
                        <div class="form-group">
                            <label>{{ __('Video preview:') }}</label>
                            <div class="img-wrapper">
                                <video width="400" id="previewVideo" controls>
                                    <source
                                        class="videopreview"
                                        src=""
                                        type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="popup-footer text-center">
                    <button type="button" class="btn video-close">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-popup -->
    <div class="theme-popup contact-popup d-flex align-items-center">
        <div class="theme-popup-inner">
            <div class="theme-popup-content popup-scroll">
                <div class="popup-header d-flex align-items-center justify-content-between">
                    <div class="popup-title d-flex align-items-center">
                        <button type="button"
                                class="contact-close close-arrow-btn contact-info close-search2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="12"
                                 viewBox="0 0 17 12" fill="none">
                                <path
                                    d="M0.245743 5.66968C-0.0471496 5.96257 -0.0471497 6.43745 0.245743 6.73034L5.01871 11.5033C5.31161 11.7962 5.78648 11.7962 6.07937 11.5033C6.37227 11.2104 6.37227 10.7355 6.07937 10.4427L1.83673 6.20001L6.07937 1.95737C6.37227 1.66448 6.37227 1.1896 6.07937 0.89671C5.78648 0.603817 5.31161 0.603817 5.01871 0.89671L0.245743 5.66968ZM16.9761 5.45001L0.776074 5.45001L0.776073 6.95001L16.9761 6.95001L16.9761 5.45001Z"
                                    fill="#7E3AE3"/>
                            </svg>
                        </button>
                        <h2>{{ __('Make Contact') }}</h2>
                    </div>
                    <button type="button" class="contact-close close-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12"
                             fill="none">
                            <path
                                d="M7.59938 6.00986L12.2719 1.33715C12.576 1.03321 12.576 0.541783 12.2719 0.237843C11.968 -0.0660973 11.4766 -0.0660973 11.1726 0.237843L6.49993 4.91055L1.82737 0.237843C1.52329 -0.0660973 1.032 -0.0660973 0.728062 0.237843C0.423979 0.541783 0.423979 1.03321 0.728062 1.33715L5.40062 6.00986L0.728062 10.6826C0.423979 10.9865 0.423979 11.4779 0.728062 11.7819C0.879534 11.9335 1.0787 12.0096 1.27772 12.0096C1.47674 12.0096 1.67576 11.9335 1.82737 11.7819L6.49993 7.10917L11.1726 11.7819C11.3243 11.9335 11.5233 12.0096 11.7223 12.0096C11.9213 12.0096 12.1203 11.9335 12.2719 11.7819C12.576 11.4779 12.576 10.9865 12.2719 10.6826L7.59938 6.00986Z"
                                fill="black"/>
                        </svg>
                    </button>
                </div>
                <form action="">
                    <div class="popup-body">
                        <div class="form-group">
                            <label>{{ __('Name:') }}</label>
                            <div class="form-input d-flex align-items-center">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.2427 7.75734C9.58915 7.10386 8.81131 6.62009 7.96263 6.32723C8.87159 5.7012 9.46875 4.65347 9.46875 3.46875C9.46875 1.55609 7.91266 0 6 0C4.08734 0 2.53125 1.55609 2.53125 3.46875C2.53125 4.65347 3.12841 5.7012 4.03739 6.32723C3.18872 6.62009 2.41088 7.10386 1.75737 7.75734C0.624117 8.89062 0 10.3973 0 12H0.9375C0.9375 9.20852 3.20852 6.9375 6 6.9375C8.79148 6.9375 11.0625 9.20852 11.0625 12H12C12 10.3973 11.3759 8.89062 10.2427 7.75734ZM6 6C4.60427 6 3.46875 4.8645 3.46875 3.46875C3.46875 2.073 4.60427 0.9375 6 0.9375C7.39573 0.9375 8.53125 2.073 8.53125 3.46875C8.53125 4.8645 7.39573 6 6 6Z"
                                        fill="#4D4D4D"/>
                                </svg>
                                <input type="text" name="name" class="form-control contact_name"
                                       placeholder="{{ __('Enter your name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Email:') }}</label>
                            <div class="form-input d-flex align-items-center">
                                <svg width="13" height="10" viewBox="0 0 13 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.3054 0H1.57471C0.706089 0 0 0.706089 0 1.57471V8.22528C0 9.0939 0.706089 9.79999 1.57471 9.79999H11.3028C12.1714 9.79999 12.8775 9.0939 12.8775 8.22528V1.57738C12.8801 0.708754 12.174 0 11.3054 0ZM12.1607 8.22528C12.1607 8.69689 11.777 9.08058 11.3054 9.08058H1.57471C1.1031 9.08058 0.719412 8.69689 0.719412 8.22528V1.57738C0.719412 1.10576 1.1031 0.722076 1.57471 0.722076H11.3028C11.7744 0.722076 12.1581 1.10576 12.1581 1.57738V8.22528H12.1607Z"
                                        fill="#4D4D4D"/>
                                    <path
                                        d="M8.1212 4.81742L11.2706 1.99306C11.4172 1.85984 11.4305 1.63336 11.2973 1.48415C11.164 1.3376 10.9376 1.32428 10.7883 1.4575L6.44523 5.35565L5.59793 4.59893C5.59526 4.59627 5.5926 4.59361 5.5926 4.59094C5.57395 4.57229 5.55529 4.5563 5.53398 4.54031L2.08613 1.45484C1.93692 1.32161 1.71044 1.33494 1.57721 1.48415C1.44399 1.63336 1.45731 1.85984 1.60652 1.99306L4.79325 4.8414L1.61984 7.81231C1.47596 7.9482 1.46797 8.17468 1.60386 8.32122C1.6758 8.39583 1.77172 8.4358 1.86764 8.4358C1.95557 8.4358 2.0435 8.40382 2.11278 8.33988L5.33414 5.32634L6.20809 6.10703C6.27737 6.16832 6.36263 6.19763 6.4479 6.19763C6.53316 6.19763 6.62109 6.16565 6.6877 6.10437L7.58563 5.29969L10.7883 8.34254C10.8576 8.40915 10.9482 8.44113 11.0361 8.44113C11.1321 8.44113 11.2253 8.40382 11.2973 8.32922C11.4332 8.18534 11.4278 7.95619 11.2839 7.8203L8.1212 4.81742Z"
                                        fill="#4D4D4D"/>
                                </svg>
                                <input type="email" name="email" class="form-control contact_email"
                                       placeholder="{{ __('Enter your email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ __('Phone:') }}
                            <div class="form-input d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                     viewBox="0 0 10 10" fill="none">
                                    <path
                                        d="M1.94804 6.35484C2.89097 7.482 4.02604 8.36946 5.32158 8.99741C5.81483 9.23116 6.47448 9.5085 7.20941 9.55604C7.25497 9.55802 7.29855 9.56 7.34411 9.56C7.83737 9.56 8.23355 9.38964 8.55645 9.03901C8.55843 9.03703 8.56239 9.03307 8.56437 9.02911C8.67926 8.89044 8.81001 8.76565 8.94669 8.63292C9.03979 8.54378 9.13488 8.45068 9.226 8.35559C9.64794 7.91582 9.64794 7.3572 9.22204 6.9313L8.0315 5.74075C7.82944 5.53078 7.58777 5.41984 7.33421 5.41984C7.08065 5.41984 6.83699 5.53078 6.62899 5.73877L5.91982 6.44795C5.85445 6.41031 5.7871 6.37664 5.72371 6.34494C5.64447 6.30532 5.57117 6.26768 5.5058 6.22608C4.86002 5.81603 4.27366 5.28118 3.71306 4.59379C3.42978 4.23524 3.23961 3.93414 3.10689 3.6271C3.2931 3.45872 3.46742 3.28241 3.6358 3.11007C3.69523 3.04866 3.75664 2.98725 3.81805 2.92584C4.03199 2.7119 4.14688 2.46429 4.14688 2.21271C4.14688 1.96113 4.03397 1.71351 3.81805 1.49957L3.22773 0.90925C3.15839 0.839917 3.09302 0.772565 3.02567 0.703233C2.89493 0.568529 2.75824 0.429863 2.62354 0.305064C2.4195 0.10499 2.17981 0 1.92625 0C1.67467 0 1.433 0.10499 1.22104 0.307045L0.480167 1.04792C0.21076 1.31732 0.0582277 1.64418 0.0265328 2.02254C-0.011105 2.49598 0.0760562 2.99914 0.301883 3.60729C0.648547 4.54823 1.17151 5.42182 1.94804 6.35484ZM0.509881 2.06414C0.533653 1.80067 0.63468 1.58079 0.82485 1.39062L1.56176 0.653709C1.67665 0.542777 1.80343 0.48533 1.92625 0.48533C2.04709 0.48533 2.16991 0.542777 2.28282 0.657671C2.41554 0.780489 2.54034 0.90925 2.67505 1.04593C2.7424 1.11527 2.81173 1.1846 2.88106 1.25591L3.47138 1.84623C3.5942 1.96905 3.65759 2.09385 3.65759 2.21667C3.65759 2.33949 3.5942 2.46429 3.47138 2.5871C3.40997 2.64851 3.34856 2.7119 3.28715 2.77331C3.10293 2.95952 2.93059 3.13582 2.74042 3.3042C2.73645 3.30816 2.73447 3.31015 2.73051 3.31411C2.56609 3.47852 2.59185 3.63502 2.63146 3.75388C2.63345 3.75982 2.63543 3.76378 2.63741 3.76972C2.78994 4.1362 3.0019 4.48484 3.33272 4.90084C3.927 5.63378 4.55297 6.20231 5.24234 6.6401C5.32752 6.69557 5.41864 6.73915 5.50382 6.78273C5.58306 6.82235 5.65635 6.85998 5.72172 6.90158C5.72965 6.90555 5.73559 6.90951 5.74352 6.91347C5.80889 6.94714 5.87228 6.96299 5.93567 6.96299C6.09414 6.96299 6.19715 6.86197 6.23083 6.82829L6.9717 6.08742C7.08659 5.97252 7.21139 5.91112 7.33421 5.91112C7.48476 5.91112 7.60758 6.00422 7.68483 6.08742L8.87934 7.27994C9.11705 7.51765 9.11507 7.77518 8.87339 8.02676C8.7902 8.1159 8.70303 8.20108 8.60993 8.29022C8.47126 8.42492 8.32666 8.56359 8.19592 8.72008C7.96811 8.96572 7.69672 9.08061 7.34609 9.08061C7.31242 9.08061 7.27676 9.07863 7.24308 9.07665C6.59334 9.03505 5.98915 8.78149 5.53552 8.56557C4.30337 7.96931 3.22178 7.12345 2.32442 6.04978C1.58553 5.16034 1.08831 4.33231 0.759479 3.44485C0.555443 2.90009 0.478186 2.4623 0.509881 2.06414Z"
                                        fill="#4D4D4D"/>
                                </svg>
                                <input type="tel" name="phone" class="form-control contact_phone"
                                       placeholder="{{ __('Enter your phone no') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Message:') }}</label>
                            <div class="form-input textarea d-flex align-items-center">
                                            <textarea name="message" class="form-control contact_message"
                                                      rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="popup-footer text-center">
                        <button type="button" class="btn" id="makecontact">{{ __('Make Contact') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- share-card-popup -->
    <div class="theme-popup share-card-popup d-flex align-items-center">
        <div class="theme-popup-inner">
            <div class="theme-popup-content popup-scroll">
                <div class="popup-header d-flex align-items-center justify-content-between">
                    <div class="popup-title d-flex align-items-center">
                        <button type="button" class="share-card-close close-arrow-btn share-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="12"
                                 viewBox="0 0 17 12" fill="none">
                                <path
                                    d="M0.245743 5.66968C-0.0471496 5.96257 -0.0471497 6.43745 0.245743 6.73034L5.01871 11.5033C5.31161 11.7962 5.78648 11.7962 6.07937 11.5033C6.37227 11.2104 6.37227 10.7355 6.07937 10.4427L1.83673 6.20001L6.07937 1.95737C6.37227 1.66448 6.37227 1.1896 6.07937 0.89671C5.78648 0.603817 5.31161 0.603817 5.01871 0.89671L0.245743 5.66968ZM16.9761 5.45001L0.776074 5.45001L0.776073 6.95001L16.9761 6.95001L16.9761 5.45001Z"
                                    fill="#7E3AE3"/>
                            </svg>
                        </button>
                        <h2>{{ __('Share This Card') }}</h2>
                    </div>
                    <button type="button" class="share-card-close close-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12"
                             fill="none">
                            <path
                                d="M7.59938 6.00986L12.2719 1.33715C12.576 1.03321 12.576 0.541783 12.2719 0.237843C11.968 -0.0660973 11.4766 -0.0660973 11.1726 0.237843L6.49993 4.91055L1.82737 0.237843C1.52329 -0.0660973 1.032 -0.0660973 0.728062 0.237843C0.423979 0.541783 0.423979 1.03321 0.728062 1.33715L5.40062 6.00986L0.728062 10.6826C0.423979 10.9865 0.423979 11.4779 0.728062 11.7819C0.879534 11.9335 1.0787 12.0096 1.27772 12.0096C1.47674 12.0096 1.67576 11.9335 1.82737 11.7819L6.49993 7.10917L11.1726 11.7819C11.3243 11.9335 11.5233 12.0096 11.7223 12.0096C11.9213 12.0096 12.1203 11.9335 12.2719 11.7819C12.576 11.4779 12.576 10.9865 12.2719 10.6826L7.59938 6.00986Z"
                                fill="black"/>
                        </svg>
                    </button>
                </div>
                <div class="popup-body">
                    <p>{{ __('Or check my social channels') }}</p>
                    <div class="social-list">
                        <ul class="d-flex align-items-center justify-content-center">
                            <li>
                                @php
                                    $whatsapp_link = url('https://wa.me/?text=' . urlencode($url_link));
                                @endphp
                                <a href="{{ $whatsapp_link }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                         viewBox="0 0 10 10" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.20676 1.71543C7.33708 0.844732 6.18048 0.365013 4.9483 0.364502C2.40928 0.364502 0.342882 2.43084 0.341861 4.97054C0.341521 5.7824 0.553607 6.57492 0.95673 7.27348L0.303223 9.66044L2.74517 9.01987C3.41802 9.38691 4.17553 9.58033 4.94643 9.58055H4.94836C7.48709 9.58055 9.55372 7.51405 9.55468 4.97423C9.55519 3.74336 9.07649 2.58607 8.20676 1.71543ZM4.9483 8.80262H4.94671C4.25973 8.80234 3.58596 8.61771 2.99805 8.26894L2.8583 8.18594L1.40921 8.56608L1.796 7.15325L1.70493 7.0084C1.32167 6.39881 1.11928 5.69423 1.11962 4.97083C1.12042 2.85989 2.83799 1.14249 4.94983 1.14249C5.97248 1.14283 6.93379 1.54159 7.65663 2.26528C8.37947 2.98897 8.77731 3.95091 8.77697 4.97395C8.77607 7.08505 7.05861 8.80262 4.9483 8.80262ZM7.0484 5.93514C6.93333 5.8775 6.36743 5.59914 6.2619 5.56067C6.15648 5.52226 6.07965 5.50314 6.003 5.61832C5.92623 5.7335 5.70569 5.99279 5.63852 6.06956C5.57134 6.14638 5.50427 6.15602 5.38915 6.09838C5.27403 6.04079 4.90319 5.9192 4.46353 5.52708C4.1214 5.22189 3.89042 4.84498 3.82324 4.7298C3.75618 4.61451 3.82268 4.55823 3.87374 4.49491C3.99834 4.34018 4.1231 4.17797 4.16146 4.1012C4.19987 4.02438 4.18063 3.95715 4.15181 3.89956C4.1231 3.84197 3.89292 3.27544 3.79703 3.04491C3.70353 2.82057 3.60872 2.85087 3.53802 2.84735C3.47096 2.84401 3.39419 2.84332 3.31742 2.84332C3.24071 2.84332 3.116 2.87209 3.01047 2.98738C2.905 3.10262 2.60769 3.38103 2.60769 3.94756C2.60769 4.51409 3.02012 5.06138 3.07765 5.1382C3.13518 5.21503 3.88929 6.37759 5.04385 6.87608C5.31846 6.99478 5.53281 7.06553 5.70002 7.11858C5.97577 7.20619 6.2266 7.19382 6.42496 7.1642C6.64612 7.13112 7.10587 6.88573 7.20187 6.61691C7.29776 6.34803 7.29776 6.11761 7.26894 6.06956C7.24023 6.02156 7.16346 5.99279 7.0484 5.93514Z"
                                              fill="#222222"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                @php
                                    $body = urlencode($url_link);
                                @endphp
                                <a href="mailto:?body={{ $body }}">
                                    <!-- Your email icon here -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="11" viewBox="0 0 14 11"
                                         fill="none">
                                        <path
                                            d="M1 1H13C13.55 1 14 1.45 14 2V9C14 9.55 13.55 10 13 10H1C0.45 10 0 9.55 0 9V2C0 1.45 0.45 1 1 1Z"
                                            stroke="#222222" fill="none"/>
                                        <path d="M0.5 1.5L7 6.5L13.5 1.5" stroke="#222222"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer.php?u={{ urlencode($url_link) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13"
                                         viewBox="0 0 7 13" fill="none">
                                        <path
                                            d="M4.68908 12.8808V7.44163H6.51403L6.78783 5.32127H4.68908V3.96774C4.68908 3.35404 4.8588 2.93581 5.73984 2.93581L6.8617 2.93535V1.03883C6.66769 1.01361 6.00172 0.955811 5.2266 0.955811C3.60803 0.955811 2.49993 1.94377 2.49993 3.75774V5.32127H0.669434V7.44163H2.49993V12.8808H4.68908Z"
                                            fill="#222222"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p>{{ __('Point your camera at the QR code,') }}</p>
                    <div class="qr-link text-center d-flex align-items-center justify-content-center">
                        <span></span>

                        <a href="javascript:void(0);" class="copy-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                 viewBox="0 0 12 12" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M11.4001 4.8C11.7314 4.8 12 4.53137 12 4.2V0.6C12 0.268632 11.7314 0 11.4001 0H7.79857C7.46725 0 7.19868 0.268626 7.19868 0.6C7.19868 0.931368 7.46725 1.2 7.79857 1.2H9.95196L4.78886 6.36396C4.55459 6.59826 4.55459 6.97818 4.78886 7.21248C5.02316 7.44684 5.40295 7.44684 5.63721 7.21248L10.8002 2.04862V4.2C10.8002 4.53137 11.0688 4.8 11.4001 4.8ZM1.79969 1.8C0.805749 1.8 0 2.60589 0 3.6V10.2C0 11.1941 0.805749 12 1.79969 12H8.39853C9.3925 12 10.1982 11.1941 10.1982 10.2V6.6C10.1982 6.26862 9.92964 6 9.59832 6C9.267 6 8.99842 6.26862 8.99842 6.6V10.2C8.99842 10.5314 8.72985 10.8 8.39853 10.8H1.79969C1.46837 10.8 1.19979 10.5314 1.19979 10.2V3.6C1.19979 3.26863 1.46837 3 1.79969 3H5.39906C5.73038 3 5.99895 2.73137 5.99895 2.4C5.99895 2.06863 5.73038 1.8 5.39906 1.8H1.79969Z"
                                      fill="#222222"/>
                            </svg>
                        </a>
                    </div>
                    <img id="shareQrCodeImageBuffer" alt=""
                         src="{{ $qr_detail && $qr_detail->image ? $qr_path.'/'.  $qr_detail->image: "" }}"
                         class="d-none">
                    <div class="qrcode-wrapper">
                        <div class="shareqrcode">
                        </div>
                        <div class="col-lg-6 offset-lg-3">
                            <button type="button"
                                    class="btn btn-outline-dark mt-2"
                                    id="downloadShareQrCodeBtn">{{__('Download QR Code')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    use App\Models\Business;
@endphp
<script src="{{ asset('custom/' . $theme . '/js/jquery.min.js') }}"></script>
<script src="{{ asset('custom/' . $theme . '/js/slick.min.js') }}" defer="defer"></script>


<script src="{{ asset('custom/js/jquery.qrcode.min.js') }}"></script>


<script src="{{ asset('custom/' . $theme . '/js/picker.js') }}"></script>
<script src="{{ asset('custom/' . $theme . '/js/picker.date.js') }}"></script>
<script src="{{ asset('custom/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('custom/js/socialSharing.js') }}"></script>
<script src="{{ asset('custom/js/socialSharing.min.js') }}"></script>
<script src="{{ asset('custom/' . $theme . '/js/custom.js?v='.time()) }}" defer="defer"></script>

<script id="galleryVideoPopupSCript">
    $(".gallery-popup-btn").on("click", function (e) {
        var imgsrc = $(this).children(".imageresource").attr("src");
        $('.imagepreview').attr('src',
            imgsrc); // here asign the image to the modal when the user click the enlarge link
        $(this).addClass("active");
        $("body").toggleClass("no-scroll");
        $('html').addClass('modal-open');
        $(this).css("background", 'rgb(0 0 0 / 50%)')
    });

    $(".video-popup-btn").on("click", function () {
        var videosrc = $(this).children('video').children(".videoresource").attr("src");
        $('.videopreview').attr('src',
            videosrc); // here asign the image to the modal when the user click the enlarge link
        const previewVideo = $(`#previewVideo`)[0];
        previewVideo.load();      // reload the new source
        $(this).addClass("active");
        $("body").toggleClass("no-scroll");
        $('html').addClass('modal-open');
        $(this).css("background",
            'rgb(0 0 0 / 50%)'
        ) // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });

    $(".close-model").on("click", function () {
        $('.gallery-popup-btn').removeClass("active").css("background", '');
        $("body").removeClass("no-scroll");
        $('html').removeClass('modal-open');
    });

    $(".close-model1").on("click", function () {
        $('.video-popup-btn').removeClass("active").css("background", '');
        $("body").removeClass("no-scroll");
        $('html').removeClass('modal-open');
    });
</script>
<script>
    $(function () {
        var is_enable_service = "{{ Business::EnableOrNot($services, $services_content) }}";
        if (is_enable_service) {
            $('#servicesOnCard').show();
        } else {
            $('#servicesOnCard').hide();
        }

        var is_enable_gallery = "{{ Business::EnableOrNot($gallery, $gallery_contents) }}";
        if (is_enable_gallery) {
            $('#galleryOnCard').show();
        } else {
            $('#galleryOnCard').hide();
        }

        var is_video_enabled = {{ $gallery && $gallery->is_video_enabled ? $gallery->is_video_enabled: 0 }};
        if (is_video_enabled) {
            $('#featuredVideosOnCard').show();
        } else {
            $('#featuredVideosOnCard').hide();
        }

        var google_review_enabled = {{ $business->google_review_enabled }};
        if (google_review_enabled) {
            $('#googleReviewPreview').show();
        } else {
            $('#googleReviewPreview').hide();
        }

        $(`.span-error-date`).text("");
        $(`.span-error-time`).text("");
        $(`.span-error-name`).text("");
        $(`.span-error-email`).text("");
        $(`.span-error-contactname`).text("");
        $(`.span-error-contactemail`).text("");
        $(`.span-error-contactphone`).text("");
        $(`.span-error-contactmessage`).text("");

        var slug = '{{ $business->slug }}';
        var url_link = `{{ route('get.vcard', ['slug' => '__SLUG__']) }}`.replace('__SLUG__', slug);

        $(`.qr-link span`).text(url_link); // share copy-link

        const qrcode_foreground_color = "{{$qr_detail && $qr_detail->foreground_color ? $qr_detail->foreground_color : "#000000"}}";
        const qrcode_type = "{{$qr_detail && $qr_detail->qr_type ? $qr_detail->qr_type : 0}}";
        $('.shareqrcode').empty().qrcode({
            render: 'image',
            size: 500,
            ecLevel: "H",
            minVersion: 3,
            quiet: 1,
            text: "{{ env('APP_URL').'/'.$business->slug }}",
            fill: qrcode_foreground_color,
            background: "#FFFFFF",
            radius: 26,
            mode: qrcode_type * 1,
            image: $(`#shareQrCodeImageBuffer`)[0],
            mSize: 0.32
        });
    });
    $(document).on('click', '#downloadShareQrCodeBtn', function (e) {
        e.preventDefault();
        var img = new Image();
        img.src = $('.shareqrcode').find('img').attr('src');
        img.onload = function () {
            var canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);
            var data = canvas.toDataURL('image/png');
            var a = document.createElement("a");
            a.download = "{{$business->title}}.png";
            a.href = data;
            a.click();
        };
    });
    $(`#makecontact`).click(function () {

        var name = $(`.contact_name`).val();
        var email = $(`.contact_email`).val();
        var phone = $(`.contact_phone`).val();
        var message = $(`.contact_message`).val();
        var business_id = '{{ $business->id }}';
        var emailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var phoneFormat = /^\+?([0-9\s-()]){10,15}$/;

        $(`.span-error-contactname`).text("");
        $(`.span-error-contactemail`).text("");
        $(`.span-error-contactphone`).text("");
        $(`.span-error-contactmessage`).text("");

        if (name == "") {
            $(`.span-error-contactname`).text("{{ __('*Please enter your name') }}");
        } else if (email == "") {

            $(`.span-error-contactemail`).text("{{ __('*Please enter your email') }}");
        } else if (email == "" || !emailFormat.test(email)) {
            $(`.span-error-contactemail`).text("{{ __('*Please enter a valid email address') }}");
        } else if (phone == "") {

            $(`.span-error-contactphone`).text("{{ __('*Please enter your phone no.') }}");
        } else if (phone == "" || !phoneFormat.test(phone)) {

            $(`.span-error-contactphone`).text("{{ __('*Please enter a valid phone no') }}");
        } else if (message == "") {
            $(`.span-error-contactmessage`).text("{{ __('*Please enter your message.') }}");
        } else {

            $(`.span-error-contactname`).text("");
            $(`.span-error-contactemail`).text("");
            $(`.span-error-contactphone`).text("");
            $(`.span-error-contactmessage`).text("");

            $.ajax({
                url: '{{ route('contacts.store') }}',
                type: 'POST',
                data: {
                    "name": name,
                    "email": email,
                    "phone": phone,
                    "message": message,
                    "business_id": business_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $(".close-search2").trigger({
                        type: "click"
                    });
                    show_toastr('Success', "{{ __('Your contact details has been noted.') }}",
                        'success');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);

                }
            });
        }
    });
</script>

@if (isset($is_slug))
    <script>
        function show_toastr(title, message, type) {
            var o, i;
            var icon = '';
            var cls = '';
            if (type == 'success') {
                icon = 'fas fa-check-circle';
                // cls = 'success';
                cls = 'theme-toaster-success';
            } else {
                icon = 'fas fa-times-circle';
                cls = 'theme-toaster-danger';
            }

            // console.log(type,cls);
            $.notify({
                icon: icon,
                title: " " + title,
                message: message,
                url: ""
            }, {
                element: "body",
                type: cls,
                allow_dismiss: !0,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 15,
                    y: 15
                },
                spacing: 10,
                z_index: 1080,
                delay: 2500,
                timer: 2000,
                url_target: "_blank",
                mouse_over: !1,
                animate: {
                    enter: o,
                    exit: i
                },
                template: '<div class="alert theme-toaster theme-toaster-success alert-{0} alert-icon theme-toaster-danger  theme-toaster-success  alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            });
        }
    </script>
    @if ($message = Session::get('success'))
        <script>
            show_toastr('Success', '{!! $message !!}', 'success');
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            show_toastr('Error', '{!! $message !!}', 'error');
        </script>
    @endif
@endif
