function toastrs(title, message, type) {
    var o, i;
    var icon = '';
    var cls = '';
    if (type === "success") {
        icon = 'fas fa-check-circle';
        cls = 'primary';
    } else {
        icon = 'fas fa-times-circle';
        cls = 'danger';
    }

    // console.log(type,cls);
    $.notify({icon: icon, title: " " + title, message: message, url: ""}, {
        element: "body",
        type: cls,
        allow_dismiss: !0,
        placement: {
            from: 'top',
            align: 'right'
        },
        offset: {x: 15, y: 15},
        spacing: 10,
        z_index: 1080,
        delay: 2500,
        timer: 2000,
        url_target: "_blank",
        mouse_over: !1,
        animate: {enter: o, exit: i},
        // danger
        template: '<div class="toast text-white bg-' + cls + ' fade show" role="alert" aria-live="assertive" aria-atomic="true">'
            + '<div class="d-flex">'
            + '<div class="toast-body"> ' + message + ' </div>'
            + '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'
            + '</div>'
            + '</div>'
        // template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    });
}
