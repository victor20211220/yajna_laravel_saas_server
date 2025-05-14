@php
    use App\Models\Business;
@endphp

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick Carousel JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
<script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('custom/js/socialSharing.js') }}"></script>
<script src="{{ asset('custom/js/custom-toast.js') }}"></script>
<script src="{{ asset('custom/js/vcard-section-border-color-util.js?v='.time()) }}"></script>
<script src="{{ asset('custom/' . $theme . '/js/new-custom.js?v='.time()) }}" defer="defer"></script>
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

        var google_review_enabled = "{{ $business->google_review_enabled }}";
        if (google_review_enabled) {
            $('#googleReviewPreview').show();
        } else {
            $('#googleReviewPreview').hide();
        }


        @if($business->is_auto_contact_popup_enabled)
        if (!isOnEditFormPage()) {
            const checkExist = setInterval(() => {
                const btn = $('#openShareContactModalBtn');
                if (btn.length && !isOnEditFormPage()) {
                    btn.trigger('click');
                    clearInterval(checkExist);
                }
            }, 50);
        }
        @endif

            @if($business->is_lead_direct_download_enabled)
        if (!isOnEditFormPage()) window.location.href = $('#businessCard #save-contact-on-vcard').attr('href');
        @endif
    });
</script>

<script id="vCardQrCodeManagementScript">
    $(function () {
        $('#openShareCardModalBtn').on('click', function () {
            if (isOnEditFormPage()) return;
            $('#shareCardModal').modal('show');
        })
        $(document).off('shown.bs.modal', '.share-card-modal').on('shown.bs.modal', '.share-card-modal', function () {
            const $container = $(this).find('.qr-code-container');
            const $image = $container.find('[data-name="qr_detail_image"]');
            const color = $container.find('[data-name="qrcode_foreground_color"]').val();
            const url = "{{ env('APP_URL').'/'.$business->slug }}";
            const qrCode = new QRCodeStyling({
                width: 162,
                height: 162,
                type: "svg",
                data: url,
                margin: 0,
                image: $image.attr('src'),
                imageOptions: {
                    imageSize: 0.4,
                    margin: 0,
                    hideBackgroundDots: true,
                    saveAsBlob: true,
                },
                dotsOptions: {
                    color: color,
                    type: "dots",
                    roundSize: true
                },
                backgroundOptions: {
                    color: "#ffffff"
                },
                cornersSquareOptions: {
                    type: "extra-rounded"
                },
                cornersDotOptions: {
                    type: "dot"
                },
            });

            const $code = $container.find('[data-name="generated"]');
            $code.empty();
            qrCode.append($code[0]);
            $container.find('[data-name="download-button"]').off('click').on('click', function () {
                qrCode.download({
                    name: "{{ $business->title }}",
                    extension: "svg"
                });
            });
        });
    })
</script>
<script id="analyticsManagementScript">
    function logClick(category) {
        $.post("{{ route('analytics.track') }}", {
            _token: '{{ csrf_token() }}',
            business_id: {{ $business->id }},
            category: category
        });
    }

    // Example usage:
    $(document).on('click', '#businessCard .card-social-link', function () {
        logClick('social')
    });
    $(function () {
        $('#businessCard #save-contact-on-vcard').click(function () {
            logClick('save_contact')
        });
        $('#businessCard #openShareContactModalBtn').click(function () {
            logClick('share_contact')
        });
    })
    $(document).on('click', '#businessCard #contact-section a', function () {
        logClick('contact_info')
    });
    $(document).on('click', '#businessCard .vcard-service-row', function () {
        logClick('services')
    });
    $(document).on('click', '#businessCard .gallery-slide-image', function () {
        logClick('gallery')
    });
    $(document).on('click', '#businessCard video', function () {
        logClick('video')
    });
    $(document).on('click', '#businessCard #vcard-google-review-section a', function () {
        logClick('google_review')
    });


</script>

@if (isset($is_slug))
    @include('components.custom-toast')
@endif
