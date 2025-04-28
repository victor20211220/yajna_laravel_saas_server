function repeaterInput(element, element_type, rowno, divid, path, theme_type, assets) {
    // alert(color);
    var html = "";
    var preview_html = "";

    if (element_type === "social_links") {
        html = `
            <div class="col-lg-4 social-row">
                <div class="input-edits">
                    <div class="input-group">
                        <span class="input-group-text">
                        <img src="${assets}/white/${element}.svg" alt=""></span>
                        <input type="${element === "WhatsApp" ? "text" : "url"}" name="socials[${rowno}][${element}]" id="social_link_${rowno}" class="form-control social_href" required>
                    </div>
                    <h6 class="text-danger mt-2 text-xs"  id="social_link_${rowno}_error_href"></h6>
                    <a href="javascript:void(0)" class="close-btn remove-social-row" data-id="socials_${rowno}">
                        <i class="bi bi-trash3"></i>
                    </a>
                </div>
            </div>
        `;

        preview_html = `
            <div class="socials_${rowno} social-link" id="socials_${rowno}">
                <a href="#" id="social_link_${rowno}_href_preview" class="social_link_${rowno}_preview" target="_blank">
                    <img src="${path}/social/${element.toLowerCase()}.svg" class="img-fluid" alt="">
                </a>
            </div>
        `;
        rowno++;

        $("#socialsModal").modal('hide');
    }
    if (element_type === "service") {
        html = `
            <div class="col-md-6 service-row">
                <div class="services-setting-card">
                    <a href="javascript:void(0)" class="close-btn remove-service-row" data-id="services_${rowno}"">
                        <img src="${base_url}/assets/images/icons/delete.svg" alt=""/>
                    </a>
                    <div class="form-group">
                        <label class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title_${rowno}" name="services[${rowno}][title]" required>
                    </div>
                </div>
            </div>
        `;
        preview_html = `
            <div class="service-card" id="services_${rowno}">
                <div class="service-card-inner">
                    <div class="service-content-top">
                        <h5 id="title_${rowno}_preview"></h5>
                    </div>
                </div>
            </div>
        `;
        rowno++;
    }

    $(`#${divid}`).append(html);
    $(`#${divid}_preview`).append(preview_html);
    return rowno;
}

$(document).on('click', '.remove-social-row', function () {
    var this_id = $(this).data('id');
    $(`#${this_id}`).remove();
    $(this).closest('.social-row').remove();
});

$(document).on('click', '.remove-service-row', function () {
    var this_id = $(this).data('id');
    $(`#${this_id}`).remove();
    $(this).closest('.service-row').remove();
});


