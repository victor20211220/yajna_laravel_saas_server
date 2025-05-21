$(document).ready(function () {
    $('.gallery-slider').on('init', function () {
        $(this).show()
    }).slick({
        variableWidth: true,
        arrows: false,
        dots: false,
        infinite: false
    });

    $('.gallery-slide-image').on('click', function () {
        if (isOnEditFormPage()) return;
        const fullUrl = $(this).data('full');
        $('#imageViewerModalImg').attr('src', fullUrl);
        $('#imageViewerModal').modal('show');
    });

    $('.video-slider').on('init', function () {
        $(this).removeClass('invisible');
    }).slick({
        variableWidth: true,
        arrows: false,
        dots: false,
        infinite: false
    });

    // Optional: Play in modal
    $('.video-slide-thumb').on('click', function () {
        if (isOnEditFormPage()) return;
        const videoUrl = $(this).data('full');
        $('#modalVideoSource').attr('src', videoUrl);
        $('#modalVideoPlayer')[0].load();
        $('#videoViewerModal').modal('show');
    });

    $('.copy-card-link-container').each(function () {
        const _this = $(this);
        const $btn = _this.find('span');
        const $input = _this.find('input');

        // Initialize Bootstrap tooltip
        const tooltip = bootstrap.Tooltip.getOrCreateInstance($btn[0]);

        $btn.on('click', function () {
            navigator.clipboard.writeText($input.val()).then(() => {
                $btn.attr('data-bs-original-title', 'Copied');
                tooltip.show();

                setTimeout(() => {
                    tooltip.hide();
                    $btn.attr('data-bs-original-title', 'Copy');
                }, 1000);
            });
        });
    })

    $('#openShareCardModalBtn').on('click', function () {
        if (isOnEditFormPage()) return;
        $('#shareCardModal').modal('show');
    })

    $('#openShareContactModalBtn').on('click', function () {
        if (isOnEditFormPage()) return;
        $('#shareContactModal').modal('show');
    })

});

function isOnEditFormPage() {
    return $('#updateBusinessForm').length !== 0;
}
