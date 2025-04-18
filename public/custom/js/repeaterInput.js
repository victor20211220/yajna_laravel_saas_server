    function checkcount(type) {
        if (type == "hide") {
            var count = document.querySelectorAll('.inputFormRow').length;
            if (count == 3) {
                $('.hideelement').hide();
            }
        } else {
            var count = document.querySelectorAll('.inputFormRow').length;
            if (count <= 3) {
                $('.hideelement').show();
            }
        }
    }
    var image_count = 0;
    var pr_image_count = 0;
    var testimonial_image_count = 0;
    var testimonial_rating_count = 0;
    var radio_count = 1;
    var ai_url=$('#url').val();
    var chatgpt=$('#chatgpt').val();




    function repeaterInput(element, element_type, rowno, divid, path, theme_type, color, assets) {
        // alert(color);
        var html = '';
        var preview_html = '';
        var social_preview_html = '';


        if (element_type == "contact") {

            html = `<div class="col-lg-4" id="inputFormRow">
                    <div class="input-edits inputFormRow mb-4">
                        `;
                        if(element == "Address"){
                            html += `
                            <div class="input-group">
                                <span class="input-group-text"><img  src="${assets}/${element.toLowerCase()}.svg" ></span>
                                <input type="text" id="${element}_${rowno}" name="contact[${rowno}][${element}][${element}]" class=" form-control" placeholder="Enter Address" required/>
                                <div class="input-group">
                                <input type="text"  name="contact[${rowno}][${element}][${element}_url]" class=" form-control" placeholder="Enter Address Url" required/>
                                </div>`;

                        }
                        else
                        {
                            html += `<div class="input-group">
                            <span class="input-group-text"><img  src="${assets}/${element.toLowerCase()}.svg" ></span>
                            <input type="text" id="${element}_${rowno}" name="contact[${rowno}][${element}]" class=" form-control" required/>
                            </div>`;
                        }


                html += `<input type="hidden" name="contact[${rowno}][id]" value=${rowno}>

                        <a href="javascript:void(0)" class="close-btn" id="removeRow_contact" data-id="contact_${rowno}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <path opacity="0.4" d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z" fill="#FF0F00" />
                                <path d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                                    fill="#FF0F00" />
                            </svg>
                        </a>
                        </div>
                    </div>`;            
            if (theme_type == 'theme15') {
                    preview_html = `<div class="calllink contactlink" id="contact_${rowno}">
                                        <a href="" target="_blank">
                                            <div class="contact-svg">
                                                <img src="${path}/${color}/${element.toLowerCase()}.svg"  class="img-fluid">
                                            </div>
                                            <span id="${element}_${rowno}_preview"></span>
                                        </a>
                                </div>`;
            }
            
            if (theme_type == 'theme1' || theme_type == 'theme4')  {
                preview_html = `<li class="d-flex align-items-center" id="contact_${rowno}">
                                            <span>
                                            <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                                            </span>
                                        <a href="" target="_blank" class="contact-item">
                                            <span id="${element}_${rowno}_preview"></span>
                                        </a>
                                </li>`;
            }
            if (theme_type == 'theme2')  {
                preview_html = `<li class="calllink contactlink d-flex align-items-center justify-content-center" id="contact_${rowno}">
                                        <a href="" target="_blank" class="contact-link">
                                            <span class="icon">
                                            <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                                            </span>
                                            <span id="${element}_${rowno}_preview"></span>
                                        </a>
                                </li>`;
            }
           
            if (theme_type == 'theme3') {
                preview_html = `<li class="d-flex align-items-center justify-content-center" id="contact_${rowno}">
                                    <span>
                                    <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                                    </span>
                                <a href="" target="_blank" class="contact-item">
                                    <span id="${element}_${rowno}_preview"></span>
                                </a>
                                </li>`;
            }
            if (theme_type == 'theme5' || theme_type == 'theme6'|| theme_type == 'theme12' ||theme_type == 'theme9' || theme_type == 'theme13' || theme_type == 'theme11' || theme_type == 'theme14'||theme_type == 'theme19' || theme_type == 'theme15' || theme_type == 'theme17' ||theme_type == 'theme16' || theme_type == 'theme18' ||theme_type == 'theme20' || theme_type == 'theme21') {
                preview_html = `<li class="d-flex align-items-center" id="contact_${rowno}">
                                    <div class="contact-image">
                                        <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                                    </div>
                                    <a href="" target="_blank" class="contact-link">
                                        <span id="${element}_${rowno}_preview"></span>
                                    </a>
                                </li>`;
            }
            if (theme_type == 'theme7' ||theme_type == 'theme10') {
                preview_html = `<li class="d-flex align-items-center justify-content-center" id="contact_${rowno}">
                                    <div class="contact-image">
                                        <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                                    </div>
                                    <a href="" target="_blank" class="contact-link">
                                        <span id="${element}_${rowno}_preview"></span>
                                    </a>
                                </li>`;
            }
            if ( theme_type == 'theme8' ||theme_type == 'theme9' ) {
                preview_html = `<li id="contact_${rowno}">
                                    <div class="contact-image">
                                        <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                                    </div>
                                    <a href="" target="_blank" class="contact-link">
                                        <span id="${element}_${rowno}_preview"></span>
                                    </a>
                                </li>`;
            }
            rowno++;
            $("#fieldModal").modal('hide');
        }

        if (element_type == "appointment") {
            var class_radio = '';
            if(radio_count % 2 == 0){
                class_radio = 'radio-left';
            }

                    html = `<div class="row mb-4" id="inputFormRow1">
                    <div class="col-lg-5">
                        <div class="form-group mb-0">
                            <input type="time"  class="form-control timepicker" name="hours[${rowno}][start]" id="appoinment_start_${rowno}" value="" onchange="changeTime(this.id)">
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="form-group mb-0">
                            <input type="time" class="form-control timepicker" name="hours[${rowno}][end]" id="appoinment_end_${rowno}" value="" onchange="changeTime(this.id)">
                        </div>
                    </div>
                    <div class="col-lg-2">

                            <a href="javascript:void(0)" class="close-btn appointment_${rowno}" id="removeRow_appointment" data-id="appointment_${rowno}">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <path
                                    opacity="0.4"
                                    d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                    fill="#FF0F00">
                                </path>
                                <path
                                    d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                    fill="#FF0F00">
                                </path>
                            </svg></a>

                    </div>
                </div>`;

            preview_html = `<div class="radio ${class_radio} " id="appointment_${rowno}">
                            <input id="radio-${radio_count}" name="time" type="radio"   class="app_time">
                            <label for="radio-${radio_count}" class="radio-label"><span id="appoinment_start_${rowno}_preview">00:00 </span> - <span id="appoinment_end_${rowno}_preview">00:00</span></label>
                    </div>`;
            if (theme_type == 'theme1' || theme_type == 'theme2' || theme_type == 'theme3'|| theme_type == 'theme4'|| theme_type == 'theme5'|| theme_type == 'theme6'|| theme_type == 'theme7'|| theme_type == 'theme8'|| theme_type == 'theme9'|| theme_type == 'theme10'|| theme_type == 'theme11' || theme_type == 'theme12' || theme_type == 'theme13'|| theme_type == 'theme14' || theme_type == 'theme15' || theme_type == 'theme16' || theme_type == 'theme17'||theme_type == 'theme18' || theme_type == 'theme19' ||theme_type == 'theme20' ||theme_type == 'theme21') {
                preview_html = `<li class="checkbox-custom" id="appointment_${rowno}">
                    <input type="radio" id="radio-${radio_count}" name="time" class="app_time" data-id="">
                    <label for="radio-${radio_count}">
                        <span id="appoinment_start_${rowno}_preview">00:00 </span>-
                        <span id="appoinment_end_${rowno}_preview">00:00 </span>
                    </label>
            </li>`;

                
            }

            radio_count++;
            rowno++;
        }

        if (element_type == "service") {

            if(chatgpt=="on")
            {
                html = `<div class="col-md-6" id="inputFormRow2">
                        <div class="services-setting-card" >
                                <a href="javascript:void(0)" class="close-btn" id="removeRow_services" data-id="services_${rowno}"">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                        <path opacity="0.4"
                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                            fill="#FF0F00">
                                        </path>
                                        <path
                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                            fill="#FF0F00">
                                        </path>
                                    </svg>
                                </a>
                                <div class="mb-5 services-img-setting">
                                    <div
                                        class="position-relative image-upload">
                                        <img id="service_image${image_count}" src="${path}/placeholder-image.jpg" alt="images" class="imagepreview">
                                        <div class="position-absolute top-50  end-0 start-0 text-center">
                                            <div class="choose-file">
                                                <input class="d-none service_image${image_count} file-validate " type="file" name="services[${rowno}][image]" data-multiple-caption="{count} files selected" multiple="" id="file-1">
                                                <span
                                                        class="btn btn-primary"
                                                        onclick="selectFile('service_image${image_count}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2"
                                                        onclick="selectFile('service_image${image_count}')">
                                                        <path
                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                        </path>
                                                        <polyline
                                                            points="17 8 12 3 7 8">
                                                        </polyline>
                                                        <line x1="12" y1="3" x2="12" y2="15">
                                                        </line>
                                                    </svg>
                                                    Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                                                                        data-bs-placement="top">
                                <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
                                    data-url="`+ai_url+`/generate_ai/service business/`+rowno+`" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Generate" data-title="Generate content with AI">
                                    <i class="fas fa-robot"></i>&nbsp;Generate with AI
                                </a>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Title:</label>
                                    <input type="text" data-name="service_title" class="form-control" id="title_${rowno}" name="services[${rowno}][title]" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description:</label>
                                        <textarea data-name="service_description" class="form-control" name="services[${rowno}][description]" id="description_${rowno}" placeholder="Enter Description" rows="3" cols="30"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Button Text:</label>
                                    <input type="text" id="link_title_${rowno}"  name="services[${rowno}][link_title]" class="form-control" placeholder="Enter Link Title">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Button link:</label>
                                    <input type="text" id="purchase_link_${rowno}"  name="services[${rowno}][purchase_link]" class="form-control" placeholder="Purchase link">
                                </div>
                            </div>
                        </div> `;
            }else
            {
                html = `<div class="col-md-6" id="inputFormRow2">
                        <div class="services-setting-card" >
                                <a href="javascript:void(0)" class="close-btn" id="removeRow_services" data-id="services_${rowno}"">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                        <path opacity="0.4"
                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                            fill="#FF0F00">
                                        </path>
                                        <path
                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                            fill="#FF0F00">
                                        </path>
                                    </svg>
                                </a>
                                <div class="mb-5 services-img-setting">
                                    <div
                                        class="position-relative image-upload">
                                        <img id="service_image${image_count}" src="${path}/placeholder-image.jpg" alt="images" class="imagepreview">
                                        <div class="position-absolute top-50  end-0 start-0 text-center">
                                            <div class="choose-file">
                                                <input class="d-none service_image${image_count} file-validate" type="file" name="services[${rowno}][image]" data-multiple-caption="{count} files selected" multiple="" id="file-1">
                                                <span
                                                        class="btn btn-primary"
                                                        onclick="selectFile('service_image${image_count}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2"
                                                        onclick="selectFile('service_image${image_count}')">
                                                        <path
                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                        </path>
                                                        <polyline
                                                            points="17 8 12 3 7 8">
                                                        </polyline>
                                                        <line x1="12" y1="3" x2="12" y2="15">
                                                        </line>
                                                    </svg>
                                                    Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Title:</label>
                                    <input type="text" data-name="service_title" class="form-control" id="title_${rowno}" name="services[${rowno}][title]" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description:</label>
                                        <textarea data-name="service_description" class="form-control" name="services[${rowno}][description]" id="description_${rowno}" placeholder="Enter Description" rows="3" cols="30"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Button Text:</label>
                                    <input type="text" id="link_title_${rowno}"  name="services[${rowno}][link_title]" class="form-control" placeholder="Enter Link Title">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Button link:</label>
                                    <input type="text" id="purchase_link_${rowno}"  name="services[${rowno}][purchase_link]" class="form-control" placeholder="Purchase link">
                                </div>
                            </div>
                        </div> `;
            }

            var sclass = '';
            preview_html = `<div class="col-lg-6" id="services_${rowno}">`;
            var desc = `<p id="description_${rowno}_preview"></p>`
            
            if(theme_type == 'theme17'){
                preview_html = `<div class="service-card" id="services_${rowno}">
                                    <div class="service-card-inner">
                                            <div class="service-icon testimonials_image">
                                                <img id="service_image${image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                            </div>
                                            <h5 id="title_${rowno}_preview"></h5>
                                            ${desc}
                                        </div>
                                </div>`;
            }

            if(theme_type == 'theme1'){
                preview_html = `<div class="service-card edit-card" id="services_${rowno}">
                                <div class="service-card-inner">
                                 <div class="service-content-top">
                                    <h5 id="title_${rowno}_preview"></h5>
                                    ${desc}
                                    </div>
                                 <div class="service-content-bottom d-flex align-items-center justify-content-between">
                                    <div class="service-icon">
                                        <img id="service_image${image_count}_preview" src="${path}/image.svg" alt="image">
                                    </div>
                                    </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme2'){
                preview_html = `<div class="service-card edit-card" id="services_${rowno}">
                                <div class="service-card-inner">
                                 <div class="service-content-top">
                                    <div class="service-name-wrp d-flex align-items-center">
                                        <div class="service-icon">
                                            <img id="service_image${image_count}_preview" src="${path}/image.svg" alt="image">
                                        </div>
                                        <h3 id="title_${rowno}_preview"></h3>
                                    </div>
                                    ${desc}
                                  <div class="service-content-bottom d-flex align-items-center justify-content-between">
                                 </div>
                                </div>
                            </div>`;
            }
            if( theme_type == 'theme9' ){
                preview_html = `<div class="service-card edit-card col-6" id="services_${rowno}">
                                <div class="service-card-inner">
                                <div class="service-card-image">
                                    <img id="service_image${image_count}_preview" src="${path}/image.svg" alt="image">
                                </div>
                                 <div class="service-content">
                                 <div class="service-content-top">
                                    <h3 id="title_${rowno}_preview"></h3>
                                    ${desc}
                                    </div>
                                 </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme3'|| theme_type == 'theme4' ){
                preview_html = `<div class="service-card col-6 edit-card" id="services_${rowno}">
                                    <div class="service-card-inner">
                                        <div class="service-card-image">
                                            <img id="service_image${image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                            </div>
                                        <div class="service-content">
                                            <div class="service-content-top">
                                                <h3 id="title_${rowno}_preview"></h3>
                                                ${desc} 
                                            </div>
                                            </div>
                                        </div>
                            </div>`;
            }
            if( theme_type == 'theme5' || theme_type == 'theme6' || theme_type == 'theme11' || theme_type == 'theme14' || theme_type == 'theme16'||theme_type == 'theme10' || theme_type == 'theme18' || theme_type == 'theme19'||theme_type == 'theme21'){
                preview_html = `<div class="service-card col-6 edit-card" id="services_${rowno}">
                                    <div class="service-card-inner">
                                        <div class="service-card-image">
                                            <div class="img-wrapper">
                                            <img id="service_image${image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                        </div>
                                            </div>
                                        <div class="service-content">
                                            <div class="service-content-top">
                                                <h3 id="title_${rowno}_preview"></h3>
                                                ${desc} 
                                            </div>
                                            </div>
                                        </div>
                            </div>`;
            }
            if(theme_type == 'theme7'){
                preview_html = `<div class="service-card edit-card col-6" id="services_${rowno}">
                                <div class="service-card-inner">
                                 <div class="service-content">
                                    <h3 id="title_${rowno}_preview"></h3>
                                    ${desc}
                                    </div>
                                 <div class="service-card-image">
                                    <div class="img-wrapper">
                                        <img id="service_image${image_count}_preview" src="${path}/image.svg" alt="image">
                                    </div>
                                    </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme8' ){
                preview_html = `<div class="col-sm-6 col-12 service-card edit-card" id="services_${rowno}">
                                    <div class="service-card-inner">
                                            <div class="service-card-image">
                                                <img id="service_image${image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                            </div>
                                            <h3 class="text-white" id="title_${rowno}_preview"></h3>
                                            ${desc}
                                    </div>
                            </div>`;
            }
            if(theme_type == 'theme12' || theme_type == 'theme13'|| theme_type == 'theme15' || theme_type == 'theme17' ||theme_type == 'theme20'){
                preview_html = `<div class="service-card edit-card" id="services_${rowno}">
                                <div class="service-card-inner">
                                <div class="service-card-image">
                                    <div class="img-wrapper">
                                        <img id="service_image${image_count}_preview" src="${path}/image.svg" alt="image">
                                    </div>
                                 </div>
                                 <div class="service-content">
                                    <div class="service-content-top">
                                    <h3 id="title_${rowno}_preview"></h3>
                                    ${desc}
                                    </div>
                                </div>
                                </div>
                            </div>`;
            }
            image_count++;
            rowno++;
        }
        if (element_type == "product") {
            var currencyData = getCurrency();
            var currencySelect = `<select name="product[${rowno}][currency]" id="product_currency_select${rowno}" class="form-control toggleCurrency" onchange="changeValue(this.id)">`;
            currencyData.forEach(currency => {
                currencySelect += `
                    <option value="${currency.symbol}">${currency.symbol} - ${currency.name}</option>
                `;
            });
            currencySelect += '</select>';

            if(chatgpt=="on")
            {
                html = `<div class="col-md-6" id="inputFormRow6">
                <div class="services-setting-card" >
                        <a href="javascript:void(0)" class="close-btn" id="removeRow_product" data-id="product_${rowno}"">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <path opacity="0.4"
                                    d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                    fill="#FF0F00">
                                </path>
                                <path
                                    d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                    fill="#FF0F00">
                                </path>
                            </svg>
                        </a>
                        <div class="mb-5 services-img-setting">
                            <div
                                class="position-relative image-upload">
                                <img id="product_image${pr_image_count}" src="${path}/placeholder-image.jpg" alt="images" class="imagepreview">
                                <div class="position-absolute top-50  end-0 start-0 text-center">
                                    <div class="choose-file">
                                        <input class="d-none product_image${pr_image_count} file-validate" type="file" name="product[${rowno}][image]" data-multiple-caption="{count} files selected" multiple="" id="file-1">
                                        <span
                                                class="btn btn-primary"
                                                onclick="selectFile('product_image${pr_image_count}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2"
                                                onclick="selectFile('product_image${pr_image_count}')">
                                                <path
                                                    d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                </path>
                                                <polyline
                                                    points="17 8 12 3 7 8">
                                                </polyline>
                                                <line x1="12" y1="3" x2="12" y2="15">
                                                </line>
                                            </svg>
                                            Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Title:</label>
                            <input type="text" data-name="product_title" class="form-control" id="product_title_${rowno}" name="product[${rowno}][title]" placeholder="Enter Title">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description:</label>
                                <textarea data-name="product_description" class="form-control" name="product[${rowno}][description]" id="product_description_${rowno}" placeholder="Enter Description" rows="3" cols="30"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Currency</label>
                            ${currencySelect}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Price:</label>
                            <input type="text" id="product_price_${rowno}"  name="product[${rowno}][price]" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Button Text:</label>
                            <input type="text" id="product_link_title_${rowno}"  name="product[${rowno}][link_title]" class="form-control" placeholder="Enter Link Title">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Button link:</label>
                            <input type="text" id="product_purchase_link_${rowno}"  name="product[${rowno}][purchase_link]" class="form-control" placeholder="Purchase link">
                        </div>


                    </div>
                </div> `;
            }else
            {
                html = `<div class="col-md-6" id="inputFormRow6">
                        <div class="services-setting-card" >
                                <a href="javascript:void(0)" class="close-btn" id="removeRow_product" data-id="product_${rowno}"">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                        <path opacity="0.4"
                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                            fill="#FF0F00">
                                        </path>
                                        <path
                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                            fill="#FF0F00">
                                        </path>
                                    </svg>
                                </a>
                                <div class="mb-5 services-img-setting">
                                    <div
                                        class="position-relative image-upload">
                                        <img id="product_image${pr_image_count}" src="${path}/placeholder-image.jpg" alt="images" class="imagepreview">
                                        <div class="position-absolute top-50  end-0 start-0 text-center">
                                            <div class="choose-file">
                                                <input class="d-none product_image${pr_image_count} file-validate " type="file" name="product[${rowno}][image]" data-multiple-caption="{count} files selected" multiple="" id="file-1">
                                                <span
                                                        class="btn btn-primary"
                                                        onclick="selectFile('product_image${pr_image_count}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2"
                                                        onclick="selectFile('product_image${pr_image_count}')">
                                                        <path
                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                        </path>
                                                        <polyline
                                                            points="17 8 12 3 7 8">
                                                        </polyline>
                                                        <line x1="12" y1="3" x2="12" y2="15">
                                                        </line>
                                                    </svg>
                                                    Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Title:</label>
                                    <input type="text" data-name="product_title" class="form-control" id="product_title_${rowno}" name="product[${rowno}][title]" placeholder="Enter Title">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description:</label>
                                        <textarea data-name="product_description" class="form-control" name="product[${rowno}][description]" id="product_description_${rowno}" placeholder="Enter Description" rows="3" cols="30"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Currency</label>
                                    ${currencySelect}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Price:</label>
                                    <input type="text" id="product_price_${rowno}"  name="product[${rowno}][price]" class="form-control" placeholder="Enter Price">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Button Text:</label>
                                    <input type="text" id="product_link_title_${rowno}"  name="product[${rowno}][link_title]" class="form-control" placeholder="Enter Link Title">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Button link:</label>
                                    <input type="text" id="product_purchase_link_${rowno}"  name="product[${rowno}][purchase_link]" class="form-control" placeholder="Purchase link">
                                </div>

                            </div>
                        </div> `;
            }

            var sclass = '';
            preview_html = `<div class="col-lg-6" id="product_${rowno}">`;
            var desc = `<p id="product_description_${rowno}_preview"></p>`

            if( theme_type == 'theme14'||theme_type == 'theme18'){
                preview_html = `<div class="service-card" id="product_${rowno}">
                                    <div class="service-card-inner">
                                        <div class="service-icon">
                                            <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                        </div>
                                        <h5 id="product_title_${rowno}_preview"></h5>
                                        ${desc}
                                        <div class="product-currency" >
                                            <span id="product_currency_select${rowno}_preview"></span>
                                            <span id="product_price_${rowno}_preview"></span>
                                        </div>
                                    </div>
                                </div>`;
            }
           
            if(theme_type == 'theme2'){
                preview_html = `<div class="product-card edit-card" id="product_${rowno}">
                                <div class="product-card-inner">
                                <div class="product-card-image">
                                    <div class="img-wrapper">
                                        <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image" >
                                    </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-content-top">
                                            <h3 id="product_title_${rowno}_preview"></h3>
                                            ${desc}
                                        </div>
                                        <div class="product-content-bottom d-flex align-items-center justify-content-between">
                                            <div class="price">
                                            <span id="product_currency_select${rowno}_preview"></span>
                                            <span id="product_price_${rowno}_preview"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>`;
            }

            if(theme_type == 'theme1' ||theme_type == 'theme9' ||theme_type == 'theme7'||theme_type == 'theme10'){
                preview_html = `<div class="product-card edit-card col-6" id="product_${rowno}">
                                <div class="product-card-inner">
                                    <div class="img-wrapper">
                                        <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                    </div>
                                     <div class="product-content">
                                        <div class="product-content-top">
                                            <h3 id="product_title_${rowno}_preview"></h3>
                                            ${desc}
                                        </div>
                                    <div class="price">
                                        <ins id="product_currency_select${rowno}_preview"></ins>
                                        <ins id="product_price_${rowno}_preview"></ins>
                                    </div>
                                    </div>

                                </div>
                            </div>`;
            }
            if(theme_type == 'theme19'){
                preview_html = `<div class="product-card edit-card" id="product_${rowno}">
                               <div class="product-card-inner">
                                    <div class="product-card-image">
                                        <div class="img-wrapper">
                                            <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-content-top">
                                            <h3 id="product_title_${rowno}_preview"></h3>
                                            ${desc}
                                        </div>
                                        <div
                                            class="product-content-bottom d-flex align-items-center justify-content-between">
                                            <div class="price">
                                                <ins id="product_currency_select${rowno}_preview"></ins>
                                                <ins id="product_price_${rowno}_preview"></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme3'|| theme_type == 'theme4' ||theme_type == 'theme5'){
                preview_html = `<div class="product-card edit-card" id="services_${rowno}">
                                <div class="product-card-inner">
                                <div class="product-card-image">
                                    <div class="img-wrapper">
                                    <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image">
                                    </div>
                                </div>
                                 <div class="product-content">
                                    <div class="product-content-top">
                                        <h3 id="product_title_${rowno}_preview"></h3>
                                        ${desc}
                                    </div>
                                     <div  class="product-content-bottom d-flex align-items-center justify-content-between">
                                        <div class="price">
                                            <span id="product_currency_select${rowno}_preview"></span>
                                            <span id="product_price_${rowno}_preview"></span>
                                        </div>
                                     </div>
                                 </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme5' || theme_type == 'theme6' || theme_type == 'theme16'||theme_type == 'theme21'){
                preview_html = `<div class="product-card edit-card" id="services_${rowno}">
                                <div class="product-card-inner">
                                <div class="product-card-image">
                                    <div class="img-wrapper">
                                    <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image">
                                    </div>
                                </div>
                                 <div class="product-content">
                                    <div class="product-content-top">
                                        <h3 id="product_title_${rowno}_preview"></h3>
                                        ${desc}
                                    </div>
                                     <div  class="product-content-bottom d-flex align-items-center justify-content-between">
                                        <div class="price">
                                            <ins id="product_currency_select${rowno}_preview"></ins>
                                            <ins id="product_price_${rowno}_preview"></ins>
                                        </div>
                                     </div>
                                 </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme12' || theme_type == 'theme13'|| theme_type == 'theme17' ||theme_type == 'theme20'){
                preview_html = `<div class="product-card edit-card col-6" id="services_${rowno}">
                                <div class="product-card-inner">
                                <div class="product-card-image">
                                    <div class="img-wrapper">
                                    <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image">
                                    </div>
                                </div>
                                 <div class="product-content">
                                    <div class="product-content-top">
                                        <h3 id="product_title_${rowno}_preview"></h3>
                                        ${desc}
                                    </div>
                                     <div  class="product-content-bottom d-flex align-items-center justify-content-between">
                                        <div class="price">
                                            <ins id="product_currency_select${rowno}_preview"></ins>
                                            <ins id="product_price_${rowno}_preview"></ins>
                                        </div>
                                     </div>
                                 </div>
                                </div>
                            </div>`;
            }
            if(theme_type == 'theme15'||theme_type == 'theme17'){
                preview_html = `<div class="service-card" id="product_${rowno}">
                                    <div class="service-card-inner">
                                        <div class="service-icon">
                                            <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                        </div>
                                        <h5 id="product_title_${rowno}_preview"></h5>
                                        ${desc}
                                        <div class="product-currency" style="color:white">
                                            <span id="product_currency_select${rowno}_preview"></span>
                                            <span id="product_price_${rowno}_preview"></span>
                                        </div>
                                    </div>
                                </div>`;
            }
            if(theme_type == 'theme8' ||theme_type == 'theme11'){
                preview_html = `<div class="col-sm-6 col-12 service-card" id="product_${rowno}">
                                    <div class="service-card-border">
                                        <div class="service-card-inner">
                                            <div class="service-icon">
                                                <img id="product_image${pr_image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                                            </div>
                                            <h5 class="text-white" id="product_title_${rowno}_preview"></h5>
                                            ${desc}
                                            <div class="product-currency">
                                                <span id="product_currency_select${rowno}_preview"></span>
                                                <span id="product_price_${rowno}_preview"></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>`;
            }
            pr_image_count++;
            rowno++;
        }

        if (element_type == "testimonial") {

            if(chatgpt=="on")
            {
                html = `<div class="col-md-6" id="inputFormRow3">
                                <div class="services-setting-card">
                                    <a href="javascript:void(0)" class="close-btn" id="removeRow_testimonials" data-id="testimonials_${rowno}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                            <path opacity="0.4"
                                                d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                fill="#FF0F00"></path>
                                            <path
                                                d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                fill="#FF0F00"></path>
                                        </svg>
                                    </a>
                                    <div class="mb-5 services-img-setting">
                                        <div class="position-relative">
                                                <img id="testimonial_image${testimonial_image_count}" src="${path}" class="imagepreview">
                                            <div
                                                class="position-absolute top-50  end-0 start-0 text-center">
                                                <div class="choose-file">
                                                    <input class="d-none testimonial_image${testimonial_image_count} file-validate" data-multiple-caption="{count} files selected" type="file" name="testimonials[${rowno}][image]" id="file-1">
                                                        <span class="btn btn-primary" onclick="selectFile('testimonial_image${testimonial_image_count}')">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                            <polyline points="17 8 12 3 7 8">
                                                            </polyline>
                                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                                        </svg>
                                                        Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                                                                        data-bs-placement="top">
                                <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
                                    data-url="`+ai_url+`/generate_ai_2/testimonial/`+rowno+`" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Generate" data-title="Generate content with AI">
                                    <i class="fas fa-robot"></i>&nbsp;Generate with AI
                                </a>
                                </div>


                                    <div class="form-group">
                                        <label class="form-label">Rate:</label>
                                        <div class="border p-3 rounded d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">
                                                <span class="stars${rowno}">0</span>/5
                                            </h6>
                                            <div class="rate testimonial-ratings" id='demo1'>
                                            <input class="stars${rowno}" type="radio" id="testimonials-5-${testimonial_rating_count}" name="testimonials[${rowno}][rating]"  value="5" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-5-${testimonial_rating_count}" title="Awesome - 5 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-4-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="4" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-4-${testimonial_rating_count}" title="Pretty good - 4 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-3-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="3" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-3-${testimonial_rating_count}" title="Meh - 3 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-2-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="2" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-2-${testimonial_rating_count}" title="Kinda bad - 2 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-1-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="1" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-1-${testimonial_rating_count}" title="Sucks big time - 1 star"></label>          </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-label">Name:</label>
                                    <input type="text" data-name="testimonial_name" class="form-control" id="testimonial_name_${rowno}" name="testimonials[${rowno}][name]" placeholder="Enter Name">
                                </div>
                                    <div class="form-group">
                                        <label class="form-label">Description:</label>
                                        <textarea class="form-control" name="testimonials[${rowno}][description]" id="testimonial_description_${rowno}" cols="30" rows="3"> </textarea>
                                    </div>
                                </div>
                            </div>`;

            }else
            {
                html = `<div class="col-md-6" id="inputFormRow3">
                                <div class="services-setting-card">
                                    <a href="javascript:void(0)" class="close-btn" id="removeRow_testimonials" data-id="testimonials_${rowno}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                            <path opacity="0.4"
                                                d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                fill="#FF0F00"></path>
                                            <path
                                                d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                fill="#FF0F00"></path>
                                        </svg>
                                    </a>
                                    <div class="mb-5 services-img-setting">
                                        <div class="position-relative">
                                                <img id="testimonial_image${testimonial_image_count}" src="${path}" class="imagepreview">
                                            <div
                                                class="position-absolute top-50  end-0 start-0 text-center">
                                                <div class="choose-file">
                                                    <input class="d-none testimonial_image${testimonial_image_count} file-validate" data-multiple-caption="{count} files selected" type="file" name="testimonials[${rowno}][image]" id="file-1">
                                                        <span class="btn btn-primary" onclick="selectFile('testimonial_image${testimonial_image_count}')">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                            <polyline points="17 8 12 3 7 8">
                                                            </polyline>
                                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                                        </svg>
                                                        Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Rate:</label>
                                        <div class="border p-3 rounded d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">
                                                <span class="stars${rowno}">0</span>/5
                                            </h6>
                                            <div class="rate testimonial-ratings" id='demo1'>
                                            <input class="stars${rowno}" type="radio" id="testimonials-5-${testimonial_rating_count}" name="testimonials[${rowno}][rating]"  value="5" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-5-${testimonial_rating_count}" title="Awesome - 5 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-4-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="4" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-4-${testimonial_rating_count}" title="Pretty good - 4 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-3-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="3" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-3-${testimonial_rating_count}" title="Meh - 3 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-2-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="2" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-2-${testimonial_rating_count}" title="Kinda bad - 2 stars"></label>
                                            <input class="stars${rowno}" type="radio" id="testimonials-1-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="1" onclick="getRadio(this)"/>
                                            <label class="full" for="testimonials-1-${testimonial_rating_count}" title="Sucks big time - 1 star"></label>          </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name:</label>
                                        <input type="text" data-name="testimonial_name" class="form-control" id="testimonial_name_${rowno}" name="testimonials[${rowno}][name]" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description:</label>
                                        <textarea class="form-control" name="testimonials[${rowno}][description]" id="testimonial_description_${rowno}" cols="30" rows="3"> </textarea>
                                    </div>
                                </div>
                            </div>`;

            }

            preview_html = `<div class="col-lg-6 pr-8 pl-0 res-pr-0" id="testimonials_${rowno}">
                            <div class="service-card testimonials-card">
                                <div class="service-card-img ">
                                    <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user" class="img-fluid">
                                </div>
                                <div class="service-card-heading">
                                    <h3>
                                        <span class="stars${rowno}">0</span>/5
                                    </h3>
                                    <span id="stars${rowno}_star" class="star-section d-flex align-items-center justify-content-center">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    </span>
                                    <h6 id="testimonial_name_${rowno}_preview"></h6>
                                    <p id="testimonial_description_${rowno}_preview">

                                    </p>
                                </div>
                            </div>
                        </div>`;
            if(theme_type == 'theme12'){
                preview_html = `<div class="testimonial-card edit-card" id="testimonials_${rowno}">
                                    <div class="testimonial-card-inner">
                                        <div class="testimonial-content-top">
                                            <div class="testimonial-img">
                                            <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" class="img-fluid" alt="image" width="200px" height="200px">
                                            </div>
                                            <div class="testimonial-img-content">
                                                <h3 id="testimonial_name_${rowno}_preview"></h3>                                         
                                                <div class="rating d-flex align-items-center">
                                                    <span id="stars${rowno}_star" class="stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="testimonial-content-bottom text-center">
                                            <p id="testimonial_description_${rowno}_preview"></p>
                                        </div>
                                    </div>
                                </div>  `;
            }
            if(theme_type == 'theme20'){
                preview_html = ` <div class="testimonial-card" id="testimonials_${rowno}"> 
                                <div class="testimonial-card-inner">
                                    <div class="testimonial-content-top d-flex align-items-center">
                                        <div class="testimonial-image">
                                            <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" class="img-fluid" alt="image" width="200px" height="200px">                                        </div>
                                        <div class="testimonial-img-content d-flex justify-content-between">
                                            <div class="testimonial-name">
                                                <h3 id="testimonial_name_${rowno}_preview"></h3> 
                                            </div>
                                            <div class="rating d-flex align-items-center">
                                                <span id="stars${rowno}_star" class="stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial-content-bottom">
                                        <p id="testimonial_description_${rowno}_preview"></p>
                                    </div>
                                </div>
                            </div> `;
            }
            if(theme_type == 'theme16'){
                preview_html = ` <div class="testimonial-card"  id="testimonials_${rowno}">
                    <div class="testimonial-card-inner">
                        <div class="testimonial-content">
                            <div class="testimonial-content-top">
                                <h3 id="testimonial_name_${rowno}_preview"></h3> 
                                <p id="testimonial_description_${rowno}_preview"></p>
                            </div>
                            <div
                                class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                
                                <div class="rating d-flex align-items-center">
                                    <span id="stars${rowno}_star" class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-image img-wrapper">
                            <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" class="img-fluid" alt="image" width="200px" height="200px">
                        </div>
                    </div>
                </div>`;
            }
            if(theme_type == 'theme14'){
                preview_html = `<div class="testimonial-card edit-card"  id="testimonials_${rowno}">
                    <div class="testimonial-card-inner">
                        <div class="testimonial-content">
                            <div class="testimonial-content-top">
                                <p id="testimonial_description_${rowno}_preview"></p>
                            </div>
                            <div class="testimonial-content-bottom">                                               
                                <h3 id="testimonial_name_${rowno}_preview"></h3>    
                            </div>
                        </div>
                        <div class="testimonial-image-wrp">
                            <div class="testimonial-image img-wrapper">
                                <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" class="img-fluid" alt="image" width="200px" height="200px">
                            </div>
                        </div>
                    </div>
                </div>`;
            }
            if(theme_type == 'theme19'){
                preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
                    <div class="testimonial-card-inner">
                        <div class="testimonial-content">
                            <div class="rating d-flex align-items-center ">
                                <span id="stars${rowno}_star" class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </div>
                            <p id="testimonial_description_${rowno}_preview">
                            <div class="testimonial-content-info d-flex align-items-center">
                                <h3 id="testimonial_name_${rowno}_preview"></h3>    
                            </div>
                        </div>
                        <div class="testimonial-image-wrp">
                            <div class="testimonial-image img-wrapper">
                                <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="image">
                            </div>
                        </div>
                    </div>`;
            }
            if(theme_type == 'theme18'){
                preview_html = `<div class="testimonial-card edit-card" id="testimonials_${rowno}">
                                    <div class="testimonial-card-inner">
                                        <div class="testimonial-image-wrp d-flex align-items-start justify-content-between">
                                            <div class="testimonial-image">
                                                <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                                            </div>
                                            <div class="rating d-flex align-items-center justify-content-center">
                                                <span id="stars${rowno}_star" class="stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    </span>                    
                                            </div>
                                        </div>
                                        <div class="testimonial-content">
                                            <h3 id="testimonial_name_${rowno}_preview"></h3>
                                            <p id="testimonial_description_${rowno}_preview"></p>

                                        </div>
                                    </div>
                                </div> `;
            }
            if(theme_type == 'theme2'){
                preview_html = `<div class="testimonial-card edit-card" id="testimonials_${rowno}">
                    <div class="testimonial-card-inner">
                        <div class="testimonial-image">
                            <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                        </div>
                        <div class="testimonial-content">
                            <div class="testimonial-content-top">
                            <p id="testimonial_description_${rowno}_preview"></p>
                        </div>
                        <div class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                            <div class="client-info">
                            <h3 id="testimonial_name_${rowno}_preview"></h3>
                            </div>
                            <div class="rating d-flex align-items-center">
                            <span id="stars${rowno}_star" class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>`;
                }
            if(theme_type == 'theme3' ||theme_type == 'theme10'){
                preview_html = ` <div class="testimonial-slider-wrp edit-testimonial" id="testimonials_${rowno}">
            <div class="testimonial-content-slider">
                <div class="testimonial-content">
                    <div class="testimonial-content-inner">
                    <p id="testimonial_description_${rowno}_preview">
                    </div>
                </div>
            </div>
            <div class="testimonial-image-wrp" id="inputrow_testimonials_preview">
                <div class="testimonial-img">
                    <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                </div>
                    <span class="edit-span" id="testimonial_name_${rowno}_preview"></span>

            </div>
                </div>
                `;
                }
                if(theme_type == 'theme17'){
                    preview_html = `
                     <div class="testimonial-slider-wrp d-flex" id="testimonials_${rowno}">
                        <div class="testimonial-image-slider">
                            <div class="testimonial-img-wrp">
                                <div class="testimonial-img-card">
                                    <div class="testimonial-img img-wrapper">
                                        <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div class="testimonial-content-wrp" id="inputrow_testimonials_preview">
                            <div class="testimonial-content">
                                <div class="testimonial-content-top">
                                    <h3 id="testimonial_name_${rowno}_preview"></h3>
                            </div>
                                <div class="testimonial-content-bottom">
                                    <p id="testimonial_description_${rowno}_preview"></p>
                                </div>
                            </div>
                        </div>
                     </div>
                    `;
                }
            if(theme_type == 'theme4'){
                preview_html = ` <div class="testimonial-card" id="testimonials_${rowno}">
            <div class="testimonial-card-inner">
                <div class="testimonial-image">
                    <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                </div>
                <div class="testimonial-content">
                    <div class="testimonial-content-top">
                        <div class="rating d-flex align-items-center justify-content-center">
                            <span id="stars${rowno}_star" class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                        </div>
                    <p id="testimonial_description_${rowno}_preview"></p>
                </div>
                <div class="testimonial-content-bottom">
                    <h3 id="testimonial_name_${rowno}_preview"></h3>
                </div>
            </div>
        </div>
                `;
                }
            if(theme_type == 'theme5'){
                preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
            <div class="testimonial-card-inner">
                <div class="testimonial-image">
                    <div class="testimonial-image">
                    <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                </div>
                </div>
                <div class="testimonial-content">
                    <div class="testimonial-content-top">
                    <h3 id="testimonial_name_${rowno}_preview"></h3>
                    <p id="testimonial_description_${rowno}_preview"></p>
                </div>
                <div class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                <div class="rating d-flex align-items-center justify-content-center">
                            <span id="stars${rowno}_star" class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                        </div>
                </div>
            </div>
        </div>
                `;
                }
            if(theme_type == 'theme6' || theme_type == 'theme15' || theme_type == 'theme21'){
                preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
            <div class="testimonial-card-inner">
                <div class="testimonial-image img-wrapper">
                    <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                </div>
                <div class="testimonial-content">
                    <div class="testimonial-content-top">
                    <h3 id="testimonial_name_${rowno}_preview"></h3>
                    <p id="testimonial_description_${rowno}_preview"></p>
                </div>
                <div class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                <div class="rating d-flex align-items-center">
                            <span id="stars${rowno}_star" class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                        </div>
                </div>
            </div>
        </div>
                `;
                }
                                
            if(theme_type == 'theme1' ||theme_type == 'theme11'){
                        preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
                        <div class="testimonial-card-inner d-flex">
                        <svg class="testimonial-quote" xmlns="http://www.w3.org/2000/svg"
                                                        width="26" height="20" viewBox="0 0 26 20"
                                                        fill="none">
                                                        <path
                                                            d="M10.57 9.85387V19.4639H0.959961V9.35387C0.959961 4.47387 4.79996 0.473867 9.60996 0.213867V2.43387C6.01996 2.69387 3.17996 5.69387 3.17996 9.35387C3.17996 9.63387 3.39996 9.85387 3.67996 9.85387H10.57Z"
                                                            fill="#7E3AE3" />
                                                        <path
                                                            d="M25.5602 9.85387V19.4639H15.9502V9.35387C15.9502 4.47387 19.7902 0.473867 24.6102 0.213867V2.43387C21.0102 2.69387 18.1702 5.69387 18.1702 9.35387C18.1702 9.63387 18.3902 9.85387 18.6702 9.85387H25.5602Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                            <div class="testimonial-image">
                                <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                            </div>
                            <div class="testimonial-content">
                            <div class="testimonial-title-wrp d-flex align-items-center justify-content-between">
                                <h3 id="testimonial_name_${rowno}_preview"></h3>
                                
                                <div class="rating d-flex align-items-center">
                                <span id="stars${rowno}_star" class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </span>
                                </div>
                                </div>
                                <p id="testimonial_description_${rowno}_preview">

                                </p>
                            </div>
                        </div>
                    </div>`;
                }
            if(theme_type == 'theme7'){
                preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
                <div class="testimonial-card-inner d-flex">
                <svg class="testimonial-quote" xmlns="http://www.w3.org/2000/svg"
                width="26" height="20" viewBox="0 0 26 20"
                fill="none">
                <path
                    d="M10.57 9.85387V19.4639H0.959961V9.35387C0.959961 4.47387 4.79996 0.473867 9.60996 0.213867V2.43387C6.01996 2.69387 3.17996 5.69387 3.17996 9.35387C3.17996 9.63387 3.39996 9.85387 3.67996 9.85387H10.57Z"
                    fill="#7E3AE3" />
                <path
                    d="M25.5602 9.85387V19.4639H15.9502V9.35387C15.9502 4.47387 19.7902 0.473867 24.6102 0.213867V2.43387C21.0102 2.69387 18.1702 5.69387 18.1702 9.35387C18.1702 9.63387 18.3902 9.85387 18.6702 9.85387H25.5602Z"
                    fill="#7E3AE3" />
                </svg>
                    
                    <div class="testimonial-content">
                        <h3 id="testimonial_name_${rowno}_preview"></h3>
                            <p id="testimonial_description_${rowno}_preview"></p>
                            <div class="rating d-flex align-items-center justify-content-center">
                            <span id="stars${rowno}_star" class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                            </div>
                    </div><div class="testimonial-image">
                        <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                    </div>
                </div>
            </div>`;
            }
            if(theme_type == 'theme8'){
                preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
            <div class="testimonial-card-inner">
                <div class="testimonial-image-wrp">
                    <div class="testimonial-image">
                        <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                    </div>
                    </div>
                <div class="testimonial-content">
                    <div class="testimonial-content-top">
                      <div class="rating d-flex align-items-center">
                            <span id="stars${rowno}_star" class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                           <span> <span class="stars${rowno}">0</span>.0 rating</span>
                        </div>
                        <p id="testimonial_description_${rowno}_preview"></p>
                    </div>
                    <div class="testimonial-content-bottom">
                        <h3 id="testimonial_name_${rowno}_preview"></h3>
               
                    </div>
            </div>
        </div>
                `;
                }
            if(theme_type == 'theme9'){
                preview_html = ` <div class="testimonial-card edit-card" id="testimonials_${rowno}">
                    <div class="testimonial-content">
                        <div class="testimonial-content-top">
                            <p id="testimonial_description_${rowno}_preview"></p>
                        </div>         
                        
                        <div class="testimonial-content-bottom d-flex align-items-center justify-content-center">
                            <div class="testimonial-image">
                                <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                            </div>
                            <div class="testimonial-info">
                                <h3 id="testimonial_name_${rowno}_preview"></h3>
                            </div>
                        </div>
                    </div>
                </div>`;
                }
            if(theme_type == 'theme13'){
                preview_html = ` 
                <div class="testimonial-card edit-card" id="testimonials_${rowno}"></div>
                    <div class="testimonial-card-inner">
                        <div class="testimonial-content">
                            <p id="testimonial_description_${rowno}_preview"></p>
                            <div class="rating d-flex align-items-center justify-content-center">
                                <div id="stars${rowno}_star" class="rating-star star-section">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-image">
                            <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user">
                        </div>
                        <h3 id="testimonial_name_${rowno}_preview"></h3>
                    </div>
                </div>
                `;
                }
            testimonial_rating_count++;
            testimonial_image_count++;
            rowno++;
        }

        if (element_type == "social_links") {

                html = `<div class="col-lg-4" id="inputFormRow4">
                            <div class="input-edits">
                                <div class="input-group">
                                    <span class="input-group-text">
                                    <img src="${assets}/black/${element.toLowerCase()}.svg"></span>
                                    <input type="text" name="socials[${rowno}][${element}]" id="social_link_${rowno}" class="form-control social_href" placeholder="Enter a link" required>
                                </div>
                                <h6 class="text-danger mt-2 text-xs"  id="social_link_${rowno}_error_href"></h6>
                                <a href="javascript:void(0)" class="close-btn" id="removeRow_socials" data-id="socials_${rowno}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                        <path opacity="0.4"
                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                            fill="#FF0F00"></path>
                                        <path
                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                            fill="#FF0F00"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>`;
           
          
            if (theme_type == 'theme1'||theme_type == 'theme2'||theme_type == 'theme3'||theme_type == 'theme4'||theme_type == 'theme5'||theme_type == 'theme6'||theme_type == 'theme7'||theme_type == 'theme8'||theme_type == 'theme9'||theme_type == 'theme10'||theme_type == 'theme11' || theme_type == 'theme12' || theme_type == 'theme13' || theme_type == 'theme14'|| theme_type == 'theme15'|| theme_type == 'theme16' ||  theme_type == 'theme17' || theme_type == 'theme18' || theme_type == 'theme19' ||  theme_type == 'theme20' ||  theme_type == 'theme21') {
                preview_html = `<div class="socials_${rowno} social-link" id="socials_${rowno}">
                    <a href="#" id="social_link_${rowno}_href_preview" class="social_link_${rowno}_href_preview" target="_blank">
                        <img src="${path}/social/${element.toLowerCase()}.svg" class="img-fluid">
                    </a>
            </div>`;

        $(".inputrow_socials_preview").append(preview_html);
    }

            rowno++;

            $("#socialsModal").modal('hide');

        }

        $(`#${divid}`).append(html);

        $(`#${divid}_preview`).append(preview_html);
        if (element_type == "contact") {
            checkcount('hide');
        }
        $("input").keyup(function() {
            var id = $(this).attr('id');

            var preview = $(`#${id}`).val();
            $(`#${id}_preview`).text(preview);
        });

        $("textarea").keyup(function() {
            var id = $(this).attr('id');

            var preview = $(`#${id}`).val();
            $(`#${id}_preview`).text(preview);
        });
        $(".social_href").keyup(function() {
            var id = $(this).attr('id');

            var preview = $(`#${id}`).val();
            var text = $(this).attr('name');
            var subtext = "Whatsapp";
            var isIncluded = text.includes(subtext);
            var h_preview = validURL(preview);

            if (h_preview == true) {
                $(`#${id}_error_href`).text("");
                $(`.${id}_href_preview`).attr("href", preview);
            } else {
                if(isIncluded==false)
                {
                    $(`#${id}_error_href`).text("Please enter valid link");
                    $(`#${id}_href_preview`).attr("href", "#");
                }

            }

        });
        $( ".textboxhover" ).mouseover(function() {
            $( this ).removeClass( "border-0" );
        }).mouseout(function() {
            $( this ).addClass("border-0");
        });



        return rowno;
    }

    function validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
            '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
        return !!pattern.test(str);
    }
    $(document).on('click', '#removeRow_contact', function() {
        var this_id = $(this).data('id');
        $(`#${this_id}`).remove();
        $(this).closest('#inputFormRow').remove();
        checkcount('show');

    });

    $(document).on('click', '#removeRow_appointment', function() {
        var this_id = $(this).data('id');
        $(`#${this_id}`).remove();
        $(this).closest('#inputFormRow1').remove();

    });

    $(document).on('click', '#removeRow_services', function() {
        var this_id = $(this).data('id');
        $(`#${this_id}`).remove();
        $(this).closest('#inputFormRow2').remove();
    });

    $(document).on('click', '#removeRow_product', function() {
        var this_id = $(this).data('id');
        $(`#${this_id}`).remove();
        $(this).closest('#inputFormRow6').remove();
    });



    $(document).on('click', '#removeRow_testimonials', function() {
        var this_id = $(this).data('id');
        $(`#${this_id}`).remove();
        $(this).closest('#inputFormRow3').remove();


    });


    $(document).on('click', '#removeRow_socials', function() {
        var this_id = $(this).data('id');
        $(`.${this_id}`).remove();
        $(this).closest('#inputFormRow4').remove();

    });

    $(".input-text-location").each(function () {
        var textarea = $(this);
        var text = textarea.text();
        var div = $('<div id="temp"></div>');
        div.css({
        "width":"530px"
        });
        div.text(text);
        $('body').append(div);
        var divHeight = $('#temp').height();
        div.remove();
        divHeight += 32;
        this.setAttribute("style", "height:" + divHeight + "px;overflow-y:hidden;");
    }).on("input", function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });

    function getCurrency() {
        // Here, you can make an AJAX request or fetch data from an API
        // For this example, we'll use a hardcoded array as a placeholder
        return [
            { code: 'INR', name: 'Indian', symbol: '₹' },
            { code: 'AFN', name: 'Afghani', symbol: '؋' },
            { code: 'ANG', name: 'Netherlands Antillian Guilder', symbol: 'f' },
            { code: 'AUD', name: 'Australian Dollar', symbol: '$' },
            { code: 'AWG', name: 'Aruban Guilder', symbol: '$' },
            {code : 'AZN', name: 'Azerbaijanian Manat', symbol: 'ман'},
            {code : 'BAM', name: 'Convertible Marks', symbol: 'KM'},
            {code : 'BBD', name: 'Barbados Dollar', symbol: '$'},
            {code : 'BGN', name: 'Bulgarian Lev', symbol: 'лв'},
            {code : 'BMD', name: 'Bermudian Dollar', symbol: '$'},
           {code:  'BND', name: 'Brunei Dollar', symbol: '$'},
           {code:  'BOB', name: 'BOV Boliviano Mvdol', symbol: '$b'},
           {code:  'BRL', name: 'Brazilian Real', symbol: 'R$'},
           {code:  'BSD', name: 'Bahamian Dollar', symbol: '$'},
           {code:  'BWP', name: 'Pula', symbol: 'P'},
           {code:  'BYR', name: 'Belarussian Ruble', symbol: 'p.'},
           {code:  'BZD', name: 'Belize Dollar', symbol: 'BZ$'},
           {code:  'CAD', name: 'Canadian Dollar', symbol: '$'},
           {code:  'CHF', name: 'Swiss Franc', symbol: 'CHF'},
           {code:  'CLP', name: 'CLF Chilean Peso Unidades de fomento', symbol: '$'},
           {code:  'CNY', name: 'Yuan Renminbi', symbol: '¥'},
           {code:  'COP', name: 'COU Colombian Peso Unidad de Valor Real', symbol: '$'},
           {code:  'CRC', name: 'Costa Rican Colon', symbol: '₡'},
           {code:  'CUP', name: 'CUC Cuban Peso Peso Convertible', symbol: '₱'},
           {code:  'CZK', name: 'Czech Koruna', symbol: 'Kč'},
           {code:  'DKK', name: 'Danish Krone', symbol: 'kr'},
           {code:  'DOP', name: 'Dominican Peso', symbol: 'RD$'},
           {code:  'EGP', name: 'Egyptian Pound', symbol: '£'},
           {code:  'EUR', name: 'Euro', symbol: '€'},
           {code:'FJD', name: 'Fiji Dollar', symbol: '$'},
           {code:'FKP', name: 'Falkland Islands Pound', symbol: '£'},
           {code:'GBP', name: 'Pound Sterling', symbol: '£'},
           {code:'GIP', name: 'Gibraltar Pound', symbol: '£'},
           {code:'GTQ', name: 'Quetzal', symbol: 'Q'},
           {code:'GYD', name: 'Guyana Dollar', symbol: '$'},
           {code:'HKD', name: 'Hong Kong Dollar', symbol: '$'},
           {code:'HNL', name: 'Lempira', symbol: 'L'},
           {code:'HRK', name: 'Croatian Kuna', symbol: 'kn'},
           {code:'HUF', name: 'Forint', symbol: 'Ft'},
           {code:'IDR', name: 'Rupiah', symbol: 'Rp'},
           {code:'ILS', name: 'New Israeli Sheqel', symbol: '₪'},
           {code:'IRR', name: 'Iranian Rial', symbol: '﷼'},
           {code:'ISK', name: 'Iceland Krona', symbol: 'kr'},
           {code:'JMD', name: 'Jamaican Dollar', symbol: 'J$'},
           {code:'JPY', name: 'Yen', symbol: '¥'},
           {code:'KGS', name: 'Som', symbol: 'лв'},
           {code:'KHR', name: 'Riel', symbol: '៛'},
           {code:'KPW', name: 'North Korean Won', symbol: '₩'},
           {code:'KRW', name: 'Won', symbol: '₩'},
           {code:'KYD', name: 'Cayman Islands Dollar', symbol: '$'},
           {code:'KZT', name: 'Tenge', symbol: 'лв'},
           {code:'LAK', name: 'Kip', symbol: '₭'},
           {code:'LBP', name :'Lebanese Pound', symbol: '£'},
            {code:'LKR', name :'Sri Lanka Rupee', symbol: '₨'},
            {code:'LRD', name :'Liberian Dollar', symbol: '$'},
            {code:'LTL', name :'Lithuanian Litas', symbol: 'Lt'},
            {code:'LVL', name :'Latvian Lats', symbol: 'Ls'},
            {code:'MKD', name :'Denar', symbol: 'ден'},
            {code:'MNT', name :'Tugrik', symbol: '₮'},
            {code:'MUR', name :'Mauritius Rupee', symbol: '₨'},
            {code:'MXN', name :'MXV Mexican Peso Mexican Unidad de Inversion (UDI)', symbol: '$'},
            {code:'MYR', name :'Malaysian Ringgit', symbol: 'RM'},
            {code:'MZN', name :'Metical', symbol: 'MT'},
            {code:'NGN', name :'Naira', symbol: '₦'},
            {code:'NIO', name :'Cordoba Oro', symbol: 'C$'},
            {code:'NOK', name :'Norwegian Krone', symbol: 'kr'},
            {code:'NPR', name :'Nepalese Rupee', symbol: '₨'},
            {code:'NZD', name :'New Zealand Dollar', symbol: '$'},
            {code:'OMR', name :'Rial Omani', symbol: '﷼'},
            {code:'PAB', name :'USD Balboa US Dollar', symbol: 'B/.'},
            {code:'PEN', name :'Nuevo Sol', symbol: 'S/.'},
            {code:'PHP', name :'Philippine Peso', symbol: 'Php'},
            {code:'PKR', name :'Pakistan Rupee', symbol: '₨'},
            {code:'PLN', name :'Zloty', symbol: 'zł'},
            {code:'PYG', name :'Guarani', symbol: 'Gs'},
            {code:'QAR', name :'Qatari Rial', symbol: '﷼'},
            {code:'RON', name :'New Leu', symbol: 'lei'},
            {code:'RSD', name :'Serbian Dinar', symbol: 'Дин.'},
            {code:'RUB', name :'Russian Ruble', symbol: 'руб'},
            {code:'SAR', name :'Saudi Riyal', symbol: '﷼'},
            {code:'SBD', name :'Solomon Islands Dollar', symbol: '$'},
            {code: 'SCR', name :'Seychelles Rupee', symbol: '₨'},
            {code: 'SEK', name :'Swedish Krona', symbol: 'kr'},
            {code: 'SGD', name :'Singapore Dollar', symbol: '$'},
            {code: 'SHP', name :'Saint Helena Pound', symbol: '£'},
            {code: 'SOS', name :'Somali Shilling', symbol: 'S'},
            {code: 'SRD', name :'Surinam Dollar', symbol: '$'},
            {code: 'SVC', name :'USD El Salvador Colon US Dollar', symbol: '$'},
            {code: 'SYP', name :'Syrian Pound', symbol: '£'},
            {code: 'THB', name :'Baht', symbol: '฿'},
            {code: 'TRY', name :'Turkish Lira', symbol: 'TL'},
            {code: 'TTD', name :'Trinidad and Tobago Dollar', symbol: 'TT$'},
            {code: 'TWD', name :'New Taiwan Dollar', symbol: 'NT$'},
            {code: 'UAH', name :'Hryvnia', symbol: '₴'},
            {code: 'USD', name :'United States Dollar', symbol: '$'},
            {code: 'UYU', name :'UYI Peso Uruguayo Uruguay Peso en Unidades Indexadas', symbol: '$U'},
            {code: 'UZS', name :'Uzbekistan Sum', symbol: 'лв'},
            {code: 'VEF', name :'Bolivar Fuerte', symbol: 'Bs'},
            {code: 'VND', name :'Dong', symbol: '₫'},
            {code: 'XCD', name :'East Caribbean Dollar', symbol: '$'},
            {code: 'YER', name :'Yemeni Rial', symbol: '﷼'},
            {code: 'ZAR', name :'Rand', symbol: 'R'},
            {code: 'XAF', name :'XAF', symbol: 'XAF'},
            {code: 'GHS', name: 'Ghana Cedis', symbol: 'GH₵'},
            {code: 'SLL', name: 'Leone Leones', symbol: 'Le'},
            {code: 'ZMW', name: 'Zambian Kwacha', symbol: 'ZK'},
            {code: 'LRD', name: 'Liberian Dollars', symbol: 'L$'},
            {code: 'NGN', name: 'Nigerian Naira', symbol: '₦'},


            // Add more currency options as needed
        ];
    }

