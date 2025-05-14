<!-- Modal -->
@props([
    'id',
    'class' => '',
])
@php
    $body = urlencode($url_link);
    $whatsapp_link = "https://wa.me/?text=" . $body;
    $email_link = "mailto:?body=".$body;
    $facebook_link = "https://www.facebook.com/sharer.php?u=".$body;
    $isProClient = \App\Models\Utility::isProClient($business->id);
    $siteLogo = asset('assets/images/logo.png');
@endphp
<div class="modal fade share-card-modal {{ $class }}" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Share your card') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <section>
                    <div class="section-title">Share card</div>
                    <div class="d-grid gap-2">
                        <a class="btn btn-secondary px-4 py-2 d-flex align-items-center justify-content-center"
                           href="{{ $whatsapp_link }}" target="_blank">
                            <div class="d-flex align-items-center gap-2 icon-container">
                                <img src="{{ asset('assets/images/icons/user_interface/socials/whatsapp.svg') }}"
                                     class="colored-social-icon" alt="">
                                <span>Share on Whatsapp</span>
                            </div>
                        </a>

                        <a class="btn btn-secondary px-4 py-2 d-flex align-items-center justify-content-center"
                           href="{{ $email_link }}">
                            <div class="d-flex align-items-center gap-2 icon-container">
                                <img src="{{ asset('assets/images/icons/user_interface/email.svg') }}"
                                     class="colored-social-icon" alt="">
                                <span>Share by Email</span>
                            </div>
                        </a>

                        <a class="btn btn-secondary px-4 py-2 d-flex align-items-center justify-content-center"
                           href="{{ $facebook_link }}" target="_blank">
                            <div class="d-flex align-items-center gap-2 icon-container">
                                <img src="{{ asset('assets/images/icons/user_interface/socials/facebook.svg') }}"
                                     class="colored-social-icon" alt="">
                                <span>Share on Facebook</span>
                            </div>
                        </a>

                    </div>
                </section>
                <section>
                    <div class="section-title">Copy card link</div>
                    @include('components.copy-card-link-container')
                </section>

                <section class="border-0">
                    <div class="section-title">Your QR code</div>
                    <div class="qr-code-container d-flex flex-column gap-4 justify-content-center align-items-center">
                        <div data-name="generated" class="mb-4"></div>
                        <button type="button" class="btn btn-secondary" data-name="download-button">Download QR Code
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
