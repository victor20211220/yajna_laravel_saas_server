function checkClamp($desc, $arrow) {
// Temporarily remove clamp to measure full height
    $desc.removeClass('collapsed expanded');
    const fullHeight = $desc[0].getBoundingClientRect().height;

    // Apply clamp to measure 3-line height
    $desc.addClass('collapsed');
    const clampHeight = $desc[0].getBoundingClientRect().height;

    // If more content exists, show arrow
    console.log(fullHeight, clampHeight)
    if (fullHeight > clampHeight + 10) {
        $arrow.show();
    } else {
        $arrow.hide();
    }

}

$(document).ready(function () {
    const $desc = $('.toggleable-description');
    const $arrow = $('.toggle-arrow');
    checkClamp($desc, $arrow);

    // Watch for content changes
    const observer = new MutationObserver(() => {
        checkClamp($desc, $arrow);
    });

    observer.observe($desc[0], {childList: true, subtree: true, characterData: true});

    $arrow.on('click', function () {
        $(this).toggleClass("up");
        $desc.toggleClass('collapsed expanded');
    });

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
    $('.video-play-overlay').on('click', function () {
        if (isOnEditFormPage()) return;
        const url = $(this).data('url');
        const isVideoFile = /\.(mp4|webm|ogg)$/i.test(url);
        if (isVideoFile) {
            $('#modalIframePlayer').hide().attr('src', '');
            $('#modalVideoPlayer')
                .attr('src', url)
                .show()
                .get(0)
                .load(); // force reload
        } else {
            const embedUrl = url.replace('watch?v=', 'embed/');
            $('#modalVideoPlayer').hide().attr('src', '');
            $('#modalIframePlayer').attr('src', embedUrl).show(); // iframe auto-loads
        }
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
