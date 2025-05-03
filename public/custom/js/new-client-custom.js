const $sidebar = $('#sidebar');
const $mainContent = $('#mainContent');
const $openSidebar = $('#openSidebar');
const $closeSidebar = $('#closeSidebar');


$closeSidebar.on('click', () => {
    $sidebar.addClass('sidebar-hidden');
    $mainContent.addClass('collapsed');
});

$openSidebar.on('click', () => {
    $sidebar.removeClass('sidebar-hidden');
    $mainContent.removeClass('collapsed');
});

// Optional: Handle resizing (auto close on small screens)
$(window).on('resize', () => {
    sidebarToggle();
});


var exampleModal = document.getElementById('exampleModal')

exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    var url = button.getAttribute('data-url')

    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')
    modalTitle.textContent = recipient
    var size = button.getAttribute('data-size');
    $("#exampleModal .modal-dialog").addClass('modal-' + size);
    $.ajax({
        url: url,
        success: function (data) {
            $('#exampleModal .modal-body').html(data);
            $("#exampleModal").modal('show');
        },
        error: function (data) {
            data = data.responseJSON;
            toastrs('Error', data.error, 'error')
        }
    });
})

let cropper;
let currentTarget = '';
let fileInput = null;

$(document).on('click', '#myDropdown', function (e) {
    e.preventDefault();
    console.log('clicked');
    const $this = $(this);
    $this.toggleClass('show');
    const ariaExpanded = $this.attr('aria-expanded')
    $this.attr('aria-expanded', ariaExpanded === "false" ? "true" : "false");
    const $dropdownMenu = $(this).closest('.dropdown').find('.dropdown-menu')
    $dropdownMenu.toggleClass('show');
})
$(function () {
    sidebarToggle();
    $('body').fadeIn(300);


    $('#cropperModal').on('shown.bs.modal', function () {
        const image = document.getElementById('cropperTarget');
        cropper = new Cropper(image, {
            viewMode: 1,
            scalable: true,
            zoomable: true,
            dragMode: 'move'
        });

        $('#zoomSlider').on('input', function () {
            cropper.zoomTo(parseFloat(this.value));
        });
    });

    $('#cropperModal').on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $('#saveCropped').on('click', function () {
        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        });

        canvas.toBlob(function (blob) {
            // Preview
            const url = URL.createObjectURL(blob);
            $(`#${currentTarget}`).attr('src', url);
            $(`#${currentTarget}_preview`).attr('src', url).removeClass('d-none');

            // Convert blob to File and assign to input
            const file = new File([blob], 'cropped-image.jpg', {type: 'image/jpeg'});
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            $('#cropperModal').modal('hide');
        }, 'image/jpeg');
    });

    $('.dropzone').on('dragover', function (e) {
        e.preventDefault();
        $(this).addClass('drag-over');
    }).on('dragleave', function () {
        $(this).removeClass('drag-over');
    }).on('drop', function (e) {
        e.preventDefault();
        $(this).removeClass('drag-over');

        const files = e.originalEvent.dataTransfer.files;
        if (files.length && files[0].type.startsWith('image/')) {
            const targetId = $(this).data('target');
            const fileInput = $(`.${targetId}`)[0];

            // Put dropped file into input manually
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(files[0]);
            fileInput.files = dataTransfer.files;

            // Trigger the crop modal
            handleImageUpload(targetId, targetId);
        }
    });
})

const sidebarToggle = () => {
    if ($(window).width() < 768) {
        $sidebar.addClass('sidebar-hidden');
        $mainContent.addClass('collapsed');
    } else {
        $sidebar.removeClass('show');
    }
}

function handleImageUpload(inputClass, targetId) {
    fileInput = $(`.${inputClass}`)[0];
    currentTarget = targetId;

    const file = fileInput.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
        $('#cropperTarget').attr('src', e.target.result);
        $('#zoomSlider').val(1);
        $('#cropperModal').modal('show');
    };
    reader.readAsDataURL(file);
}

function selectFile(targetId) {
    $(`.${targetId}`).trigger('click').off('change').on('change', function () {
        if (this.files && this.files[0]) {
            handleImageUpload(targetId, targetId);
        }
    });
}
