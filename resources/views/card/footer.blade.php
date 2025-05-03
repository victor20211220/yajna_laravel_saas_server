@php
    use App\Models\Business;
@endphp

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick Carousel JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('custom/js/jquery.qrcode.min.js') }}"></script>
<script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('custom/js/socialSharing.js') }}"></script>
<script src="{{ asset('custom/js/custom-toast.js') }}"></script>
<script src="{{ asset('custom/' . $theme . '/js/new-custom.js?v='.time()) }}" defer="defer"></script>
{{--<script src="{{ asset('custom/' . $theme . '/js/custom.js?v='.time()) }}" defer="defer"></script>--}}
<script>

    $(function () {

        @if($business->is_lead_direct_download_enabled)
        if (!isOnEditFormPage()) window.location.href = $('#save-contact-on-vcard').attr('href');
        @endif

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
    });
</script>

<script id="vCardQrCodeManagementScript">
    function generate_share_card_qr_code() {
        $container = $(".qr-code-container");
        $container.find('[data-name="generated"]').empty().qrcode({
            render: 'image',
            size: 162,
            ecLevel: "H",
            minVersion: 3,
            quiet: 1,
            text: "{{ env('APP_URL').'/'.$business->slug }}",
            fill: $container.find('[data-name="qrcode_foreground_color"]').val(),
            background: "#FFFFFF",
            radius: 26,
            mode: $container.find('[data-name="qrcode_type"]').val() * 1,
            image: $container.find('[data-name="qr_detail_image"]')[0],
            mSize: 0.32
        });
    }

    function download_share_qrcode(e) {
        e.preventDefault();
        var img = new Image();
        img.src = $(e.target).closest('.qr-code-container').find('[data-name="generated"] img').attr('src');
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
    }

    $(function () {
        $('#openShareCardModalBtn').on('click', function () {
            if (isOnEditFormPage()) return;
            $('#shareCardModal').modal('show');
        })
        generate_share_card_qr_code();
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
    $(document).on('click', '#businessCard .card-social-link', function(){
        logClick('social')
    });
    $(document).on('click', '#businessCard #save-contact-on-vcard', function(){
        logClick('save_contact')
    });
    $(document).on('click', '#businessCard #openShareContactModalBtn', function(){
        logClick('share_contact')
    });
    $(document).on('click', '#businessCard #contact-section a', function(){
        logClick('contact_info')
    });
    $(document).on('click', '#businessCard .vcard-service-row', function(){
        logClick('services')
    });
    $(document).on('click', '#businessCard .gallery-slide-image', function(){
        logClick('gallery')
    });
    $(document).on('click', '#businessCard video', function(){
        logClick('video')
    });
    $(document).on('click', '#businessCard #vcard-google-review-section a', function(){
        logClick('google_review')
    });


</script>

@if (isset($is_slug))
    @include('components.custom-toast')
@endif
