<?php $__env->startSection('contentCard'); ?>
<?php
    $themeData = \App\Models\Utility::themeOne();
    $themeName = isset($themeData['theme2'][$business->theme_color]['theme_name'])
                 ? $themeData['theme2'][$business->theme_color]['theme_name']
                 : null;

?>

<?php if($themeName): ?>
    <div class="<?php echo e($themeName); ?>" id="view_theme12">
<?php else: ?>
    <div class="<?php echo e($business->theme_color); ?>" id="view_theme12">
<?php endif; ?>
      <main id="boxes">
          <div class="card-wrapper <?php if(!isset($is_pdf)): ?> scrollbar <?php endif; ?>">
             <div class="developer-card">
                <section class="profile-sec bg-light pb mb">
                    <div class="container">
                        <div class="profile-banner">
                            <img class="profile-banner-img"
                            src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme2/images/profile-banner.jpg')); ?>"
                            id="banner_preview" alt="profile-banner-img">

                            <div class="section-title text-center">
                                <h2 id="<?php echo e($stringid . '_title'); ?>_preview"><?php echo e($business->title); ?></h2>
                            </div>
                            <div class="client-info-wrp d-flex align-items-center">
                                <div class="client-image">
                                    <img id="business_logo_preview"  src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme2/images/client-image.png')); ?>"
                                alt="client-image" loading="lazy">
                                </div>
                                <div class="client-info">
                                    <h3 id="<?php echo e($stringid . '_designation'); ?>_preview">
                                        <?php echo e($business->designation); ?></h3>
                                    <span class="subtitle"
                                        id="<?php echo e($stringid . '_subtitle'); ?>_preview"><?php echo e($business->sub_title); ?></span>
                                </div>
                            </div>
                        </div>
                        <p class="text-wrap" id="<?php echo e($stringid . '_desc'); ?>_preview">
                            <?php echo nl2br(e($business->description)); ?></p>
                    </div>
                </section>
                <?php $j = 1; ?>
                <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($j == $order_value): ?>
                        <?php if($order_key == 'bussiness_hour'): ?>
                            <section class="business-hour-sec pb" id="business-hours-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Business Hours')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="business-hours pt pb">
                                    <svg class="top-svg" xmlns="http://www.w3.org/2000/svg" width="44" height="70" viewBox="0 0 44 70" fill="none">
                                        <path d="M3.86429 51.6276C1.74772 50.4056 -0.959751 51.131 -2.18175 53.2476C-3.40375 55.3641 -2.67828 58.0716 -0.561712 59.2936C1.55485 60.5156 4.26231 59.7902 5.48431 57.6736C6.70631 55.557 5.98085 52.8496 3.86429 51.6276ZM-0.0332119 58.3782C-1.64489 57.4477 -2.19686 55.3878 -1.26636 53.7761C-0.335856 52.1644 1.72411 51.6124 3.33579 52.5429C4.94746 53.4734 5.49943 55.5334 4.56893 57.1451C3.63843 58.7568 1.57846 59.3087 -0.0332119 58.3782Z" fill="#111111"/>
                                        <path d="M10.9989 54.2816L10.882 54.2141C9.62455 53.4881 9.17185 51.8942 9.86011 50.6161L25.3633 21.8058L18.8256 18.0313L1.6268 45.8626C0.86406 47.0977 -0.742644 47.5026 -2.00011 46.7766C-2.87826 46.2696 -4.002 46.5699 -4.5095 47.449L-6.4385 50.7901L-1.76889 53.4861C-0.677892 51.5964 1.73724 50.9493 3.62691 52.0403C5.51571 53.1308 6.16322 55.5473 5.07272 57.4361L9.74232 60.1321L11.6713 56.791C12.1775 55.9123 11.8771 54.7886 10.9989 54.2816Z" fill="white"/>
                                        <path d="M7.12682 50.0067L3.51981 47.9242C2.97249 47.6082 2.79392 46.9035 3.12464 46.3646L16.0741 25.2876L20.4527 27.8156L8.67413 49.5686C8.37372 50.125 7.67415 50.3227 7.12682 50.0067Z" fill="#111111"/>
                                        <path d="M42.1843 19.0476L12.8018 2.0836L8.91176 8.82128L38.2943 25.7853L42.1843 19.0476Z" fill="#7F7F7F"/>
                                        <path class="theme-color" d="M43.6478 17.416L13.4824 4.57764e-05L12.0734 2.44051L42.2388 19.8565L43.6478 17.416Z" fill="#FF8000"/>
                                        <path class="theme-color" d="M41.6254 20.9183L11.46 3.50226L10.9085 4.45748L41.0739 21.8735L41.6254 20.9183Z" fill="#FF8000"/>
                                        <path class="theme-color" d="M40.4623 22.9344L10.2969 5.51836L9.74537 6.47359L39.9108 23.8896L40.4623 22.9344Z" fill="#FF8000"/>
                                        <path d="M9.13281 7.53447L1.51881 20.7223L4.39921 22.3853C4.66162 22.5368 4.99766 22.4468 5.14916 22.1844L5.47966 21.6119C5.95466 20.7892 7.0065 20.5074 7.82922 20.9824L28.3047 32.8039C29.1274 33.2789 29.4092 34.3307 28.9342 35.1534L28.6037 35.7259C28.4522 35.9883 28.5414 36.3238 28.8038 36.4753L31.6842 38.1383L39.2982 24.9505L9.13281 7.53447Z" fill="#F5F5F5"/>
                                        <path d="M24.1799 23.2701C23.2179 24.9364 21.0883 25.507 19.422 24.545C17.7558 23.583 17.1857 21.4525 18.1472 19.7871C19.1092 18.1209 21.2388 17.5503 22.905 18.5123C24.5713 19.4743 25.1414 21.6048 24.1799 23.2701Z" fill="#7F7F7F"/>
                                        <path d="M23.7089 22.9986C22.8974 24.4042 21.0992 24.8867 19.6936 24.0752C18.2881 23.2637 17.8064 21.4661 18.6184 20.0596C19.4299 18.6541 21.2276 18.1724 22.6331 18.9839C24.0387 19.7954 24.5204 21.5931 23.7089 22.9986Z" fill="#B7B7B7"/>
                                        <path d="M22.7753 22.4592C22.2613 23.3494 21.1234 23.6543 20.2331 23.1403C19.3428 22.6263 19.0379 21.4884 19.5519 20.5982C20.0659 19.7079 21.2038 19.403 22.0941 19.917C22.9839 20.4319 23.2888 21.5698 22.7753 22.4592Z" fill="#111111"/>
                                        <path opacity="0.3" d="M16.3628 1.66299L14.8975 0.816986L2.93396 21.5384L4.39928 22.3844L16.3628 1.66299Z" fill="white"/>
                                        <path opacity="0.3" d="M13.374 9.9834L7.14952 20.7645C7.26259 20.7767 7.37549 20.7992 7.48672 20.8345C7.48981 20.8352 7.49292 20.8358 7.49601 20.8364C7.60984 20.8733 7.72076 20.9212 7.82815 20.9832L9.59744 22.0047L15.7469 11.3534L13.374 9.9834Z" fill="white"/>
                                        <path opacity="0.3" d="M16.9101 9.33679L14.5381 7.96729L13.9866 8.92252L16.3586 10.292L16.9101 9.33679Z" fill="white"/>
                                        <path opacity="0.3" d="M18.0742 7.32069L15.7021 5.95119L15.1507 6.90641L17.5227 8.27591L18.0742 7.32069Z" fill="white"/>
                                        <path opacity="0.3" d="M20.0967 3.81849L17.7246 2.44899L16.3156 4.88945L18.6877 6.25895L20.0967 3.81849Z" fill="white"/>
                                        <path opacity="0.3" d="M16.9893 12.0704L10.7648 22.8516C10.8354 22.8392 10.9032 22.8357 10.9677 22.844C10.9699 22.8442 10.9713 22.8438 10.9735 22.8439C11.0389 22.8528 11.1013 22.8727 11.1576 22.9052L12.0894 23.4432L18.2389 12.7919L16.9893 12.0704Z" fill="white"/>
                                        <path opacity="0.3" d="M19.403 10.7758L18.1533 10.0543L17.6018 11.0095L18.8515 11.731L19.403 10.7758Z" fill="white"/>
                                        <path opacity="0.3" d="M20.5671 8.75969L19.3174 8.03819L18.7659 8.99342L20.0156 9.71492L20.5671 8.75969Z" fill="white"/>
                                        <path opacity="0.3" d="M22.5885 5.25748L21.3389 4.53598L19.9299 6.97644L21.1795 7.69794L22.5885 5.25748Z" fill="white"/>
                                        <path d="M5.07176 57.4356C3.98076 59.3252 1.56476 59.9719 -0.32404 58.8814C-2.21371 57.7904 -2.86034 55.3744 -1.76984 53.4856L-6.43945 50.7896L-9.28695 55.7216L6.89386 65.0636L9.74136 60.1316L5.07176 57.4356Z" fill="white"/>
                                        <path d="M9.84181 59.9598L5.16699 57.2608L4.97549 57.5924L9.6503 60.2915L9.84181 59.9598Z" fill="#757575"/>
                                        <path d="M5.30518 65.2519L2.77552 63.7914C2.71489 63.7564 2.69403 63.6785 2.72903 63.6179L3.14453 62.8983L5.8803 64.4778L5.4573 65.2104C5.42667 65.2655 5.35887 65.2829 5.30518 65.2519Z" fill="#6D6D6D"/>
                                        <path d="M4.57674 64.8309L3.49335 64.2054C3.44572 64.1779 3.42924 64.1164 3.45674 64.0688L3.83574 63.4123C3.86324 63.3647 3.92472 63.3482 3.97235 63.3757L5.05574 64.0012C5.10337 64.0287 5.11985 64.0902 5.09235 64.1378L4.71335 64.7943C4.68535 64.8428 4.62437 64.8584 4.57674 64.8309Z" fill="#939292"/>
                                        <path d="M5.31731 65.2584L4.74834 64.9299C4.70071 64.9024 4.6846 64.8423 4.7121 64.7947L5.0921 64.1365C5.1191 64.0897 5.17971 64.0728 5.22734 64.1003L5.79631 64.4287C5.84308 64.4557 5.86006 64.5164 5.83256 64.564L5.45256 65.2222C5.42506 65.2698 5.36408 65.2854 5.31731 65.2584Z" fill="#B7B7B7"/>
                                        <path d="M3.31603 64.1034L2.75658 63.7804C2.70721 63.7519 2.69001 63.6877 2.71851 63.6383L3.09351 62.9888C3.12201 62.9394 3.18621 62.9222 3.23558 62.9507L3.79503 63.2737C3.84439 63.3022 3.8616 63.3664 3.8331 63.4158L3.4581 64.0653C3.4291 64.1156 3.36539 64.1319 3.31603 64.1034Z" fill="#B7B7B7"/>
                                    </svg>
                                    <svg class="bottom-svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M14.6906 6.69874C11.2095 5.5101 7.42558 7.36952 6.23694 10.8506C5.04831 14.3317 6.90773 18.1157 10.3888 19.3043C13.8699 20.4929 17.6539 18.6335 18.8425 15.1524C20.0311 11.6713 18.1717 7.88737 14.6906 6.69874ZM10.9143 17.7674C8.28261 16.8695 6.87745 14.0077 7.77536 11.376C8.67327 8.7444 11.5351 7.33924 14.1667 8.23715C16.7984 9.13506 18.2035 11.9969 17.3056 14.6285C16.4077 17.2601 13.5459 18.6653 10.9143 17.7674Z" fill="#111111"/>
                                        <path d="M22.5174 4.28052L9.97694 0.00146484L0 8.72163L2.56352 21.7209L15.104 25.9999L25.0809 17.2798L22.5174 4.28052ZM10.5735 18.7667C7.3892 17.6795 5.68879 14.2181 6.77597 11.0338C7.86315 7.84946 11.3246 6.14904 14.5089 7.23622C17.6932 8.3234 19.3936 11.7848 18.3064 14.9691C17.2193 18.1535 13.7563 19.8524 10.5735 18.7667Z" fill="white"/>
                                        <path d="M0 8.72169L2.56352 21.7209L8.83373 23.8604L10.572 18.7652C7.3877 17.6781 5.68726 14.2166 6.77444 11.0323C7.86162 7.84799 11.3231 6.14757 14.5074 7.23475L16.2456 2.13955L9.97542 0L0 8.72169Z" fill="#111111"/>
                                    </svg>
                                    <div class="container">
                                        <ul class="hours-list">
                                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="d-flex align-items-center justify-content-center">
                                                <span><?php echo e(__($day)); ?></span>
                                                <p class="days_<?php echo e($k); ?>">
                                                    <?php if(isset($business_hours->$k) && $business_hours->$k->days == 'on'): ?>
                                                        <?php echo e(!empty($business_hours->$k->start_time) && isset($business_hours->$k->start_time) ? date('h:i A', strtotime($business_hours->$k->start_time)) : '00:00'); ?>

                                                        -
                                                        <?php echo e(!empty($business_hours->$k->end_time) && isset($business_hours->$k->end_time)
                                                            ? date('h:i A', strtotime($business_hours->$k->end_time))
                                                            : '00:00'); ?>

                                                    <?php else: ?>
                                                        <?php echo e(__('closed')); ?>

                                                    <?php endif; ?>
                                                </p>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'contact_info'): ?>
                            <section class="contact-info-sec pb" id="contact-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Contact')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <ul class="contact-list" id="inputrow_contact_preview">
                                    <?php if(!is_null($contactinfo_content) && !is_null($contactinfo)): ?>
                                        <?php $__currentLoopData = $contactinfo_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    if ($key1 == 'Phone') {
                                                        $href = 'tel:' . $val1;
                                                    } elseif ($key1 == 'Email') {
                                                        $href = 'mailto:' . $val1;
                                                    } elseif ($key1 == 'Address') {
                                                        $href = '';
                                                    } else {
                                                        $href = $val1;
                                                    }
                                                ?>
                                                <?php if($key1 != 'id'): ?>
                                                    <li id="contact_<?php echo e($loop->parent->index + 1); ?>" class="d-flex align-items-center justify-content-center">
                                                        <?php if($key1 == 'Address'): ?>
                                                            <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($key2 == 'Address_url'): ?>
                                                                    <?php $href = $val2; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <img src="<?php echo e(asset('custom/theme2/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                            <a href="<?php echo e($href); ?>" target="_blank" class="contact-link" >
                                                                <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($key2 == 'Address'): ?>
                                                                    <span id="<?php echo e($key1 . '_' . $nos); ?>_preview">
                                                                        <?php echo e($val2); ?>

                                                                    </span>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </a>
                                                        <?php else: ?>
                                                            <?php if($key1 == 'Whatsapp'): ?>
                                                                <img src="<?php echo e(asset('custom/theme2/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                <a href="<?php echo e(url('https://wa.me/' . $href)); ?>" target="_blank" class="contact-link">
                                                            <?php else: ?>
                                                                    <img src="<?php echo e(asset('custom/theme2/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                <a href="<?php echo e($href); ?>" class="contact-link">
                                                            <?php endif; ?>

                                                            <span id="<?php echo e($key1 . '_' . $nos); ?>_preview">
                                                                <?php echo e($val1); ?>

                                                            </span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endif; ?>
                                                <?php $nos++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'service'): ?>
                            <section class="service-sec pb"  id="services-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Our Services')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="container">
                                    <?php if(isset($is_pdf)): ?>
                                        <?php $image_count = 0; ?>
                                        <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="service-card edit-card" id="services_<?php echo e($service_row_nos); ?>">
                                                <div class="service-card-inner">
                                                    <div class="service-content-top">
                                                        <div class="service-name-wrp d-flex align-items-center">
                                                            <div class="service-icon">
                                                                <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                                width="28" height="28"
                                                                src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                class="img-fluid" alt="image">
                                                            </div>
                                                            <h3 id="<?php echo e('title_' . $service_row_nos . '_preview'); ?>">
                                                                <?php echo e($content->title); ?></h3>
                                                        </div>
                                                        <p id="<?php echo e('description_' . $service_row_nos . '_preview'); ?>">
                                                        <?php echo e($content->description); ?> </p>
                                                    </div>
                                                    <div class="service-content-bottom text-right">
                                                        <?php if(!empty($content->purchase_link)): ?>
                                                            <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                id="<?php echo e('link_title_' . $service_row_nos . '_preview'); ?>"
                                                                class="readmore-btn"><?php echo e($content->link_title); ?></a>
                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                                <?php
                                                $image_count++;
                                                $service_row_nos++;
                                                ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="service-slider" id="inputrow_service_preview">
                                            <?php $image_count = 0; ?>
                                            <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="service-card" id="services_<?php echo e($service_row_nos); ?>">
                                                    <div class="service-card-inner">
                                                        <div class="service-content-top">
                                                            <div class="service-name-wrp d-flex align-items-center">
                                                                <div class="service-icon">
                                                                    <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                                    width="28" height="28"
                                                                    src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                    class="img-fluid" alt="image">
                                                                </div>
                                                                <h3 id="<?php echo e('title_' . $service_row_nos . '_preview'); ?>">
                                                                    <?php echo e($content->title); ?></h3>
                                                            </div>
                                                            <p id="<?php echo e('description_' . $service_row_nos . '_preview'); ?>">
                                                            <?php echo e($content->description); ?> </p>
                                                        </div>
                                                        <div class="service-content-bottom text-right">
                                                            <?php if(!empty($content->purchase_link)): ?>
                                                                <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                    id="<?php echo e('link_title_' . $service_row_nos . '_preview'); ?>"
                                                                    class="readmore-btn"><?php echo e($content->link_title); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <?php
                                                    $image_count++;
                                                    $service_row_nos++;
                                                    ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'appointment'): ?>
                            <section class="appointment-sec pb" id="appointment-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Appointment')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="aapointment-wrp bg-light pt pb">
                                    <svg class="top-svg" xmlns="http://www.w3.org/2000/svg" width="50" height="70" viewBox="0 0 50 70" fill="none">
                                        <path d="M39.9014 51.5598C37.7848 52.7818 37.0594 55.4893 38.2814 57.6059C39.5034 59.7224 42.2108 60.4479 44.3274 59.2259C46.444 58.0039 47.1694 55.2964 45.9474 53.1799C44.7254 51.0633 42.018 50.3378 39.9014 51.5598ZM43.7989 58.3105C42.1872 59.241 40.1273 58.689 39.1968 57.0774C38.2663 55.4657 38.8182 53.4057 40.4299 52.4752C42.0416 51.5447 44.1015 52.0967 45.032 53.7084C45.9625 55.32 45.4106 57.38 43.7989 58.3105Z" fill="#111111"/>
                                        <path d="M45.7678 46.7078L45.6509 46.7753C44.3935 47.5013 42.7868 47.0964 42.024 45.8613L24.8252 18.0301L18.2876 21.8046L33.7907 50.6148C34.479 51.8929 34.0263 53.4868 32.7688 54.2128C31.8907 54.7198 31.5889 55.8432 32.0964 56.7222L34.0254 60.0633L38.695 57.3673C37.604 55.4777 38.2511 53.0625 40.1408 51.9715C42.0296 50.881 44.4461 51.5285 45.5366 53.4173L50.2062 50.7213L48.2772 47.3802C47.7694 46.5026 46.646 46.2008 45.7678 46.7078Z" fill="white"/>
                                        <path d="M40.1289 47.924L36.5219 50.0065C35.9746 50.3225 35.275 50.1248 34.9737 49.5689L23.1952 27.8158L27.5738 25.2878L40.5232 46.3649C40.8548 46.9033 40.6762 47.608 40.1289 47.924Z" fill="#111111"/>
                                        <path d="M30.8464 2.08385L1.46387 19.0479L5.35387 25.7855L34.7364 8.82153L30.8464 2.08385Z" fill="#7F7F7F"/>
                                        <path class="theme-color" d="M30.1654 0.000141144L0 17.4161L1.409 19.8566L31.5744 2.4406L30.1654 0.000141144Z" fill="#FF8000"/>
                                        <path class="theme-color" d="M32.1879 3.50234L2.02246 20.9183L2.57396 21.8736L32.7393 4.45756L32.1879 3.50234Z" fill="#FF8000"/>
                                        <path class="theme-color" d="M33.3509 5.51845L3.18555 22.9344L3.73705 23.8897L33.9024 6.47368L33.3509 5.51845Z" fill="#FF8000"/>
                                        <path class="theme-color" d="M4.34961 24.9506L11.9636 38.1384L14.844 36.4754C15.1064 36.3239 15.1965 35.9879 15.045 35.7254L14.7145 35.153C14.2395 34.3303 14.5213 33.2784 15.344 32.8034L35.8195 20.9819C36.6422 20.5069 37.694 20.7888 38.169 21.6115L38.4995 22.1839C38.651 22.4464 38.9862 22.5369 39.2486 22.3854L42.129 20.7224L34.515 7.53456L4.34961 24.9506Z" fill="#FF8000"/>
                                        <path d="M25.5008 19.7874C26.4628 21.4536 25.8922 23.5833 24.2259 24.5453C22.5597 25.5073 20.4296 24.9358 19.4681 23.2704C18.5061 21.6042 19.0767 19.4745 20.7429 18.5125C22.4092 17.5505 24.5393 18.122 25.5008 19.7874Z" fill="#7F7F7F"/>
                                        <path d="M25.0307 20.0589C25.8422 21.4645 25.361 23.263 23.9554 24.0745C22.5499 24.886 20.7522 24.4043 19.9402 22.9979C19.1287 21.5923 19.6104 19.7946 21.0159 18.9831C22.4215 18.1716 24.2192 18.6533 25.0307 20.0589Z" fill="#B7B7B7"/>
                                        <path d="M24.0962 20.5985C24.6102 21.4887 24.3053 22.6266 23.415 23.1406C22.5248 23.6546 21.3869 23.3497 20.8729 22.4595C20.3589 21.5692 20.6638 20.4313 21.554 19.9173C22.4448 19.4041 23.5827 19.709 24.0962 20.5985Z" fill="#111111"/>
                                        <path opacity="0.3" d="M2.88036 15.7532L1.41504 16.5992L13.3785 37.3206L14.8439 36.4746L2.88036 15.7532Z" fill="white"/>
                                        <path opacity="0.3" d="M8.5918 22.5017L14.8163 33.2829C14.8834 33.191 14.9593 33.1045 15.0455 33.0258C15.0476 33.0235 15.0497 33.0211 15.0518 33.0187C15.1406 32.9386 15.2375 32.8665 15.3449 32.8045L17.1142 31.783L10.9647 21.1317L8.5918 22.5017Z" fill="white"/>
                                        <path opacity="0.3" d="M9.79978 19.1161L7.42773 20.4856L7.97924 21.4408L10.3513 20.0713L9.79978 19.1161Z" fill="white"/>
                                        <path opacity="0.3" d="M8.63572 17.1L6.26367 18.4695L6.81517 19.4247L9.18722 18.0552L8.63572 17.1Z" fill="white"/>
                                        <path opacity="0.3" d="M6.61424 13.5978L4.24219 14.9673L5.65119 17.4077L8.02324 16.0382L6.61424 13.5978Z" fill="white"/>
                                        <path opacity="0.3" d="M12.207 20.4147L18.4315 31.1958C18.4562 31.1285 18.487 31.0679 18.5265 31.0163C18.5277 31.0144 18.5281 31.0131 18.5293 31.0112C18.5696 30.959 18.6181 30.9149 18.6744 30.8824L19.6062 30.3444L13.4567 19.6932L12.207 20.4147Z" fill="white"/>
                                        <path opacity="0.3" d="M12.2926 17.6771L11.043 18.3986L11.5945 19.3538L12.8441 18.6323L12.2926 17.6771Z" fill="white"/>
                                        <path opacity="0.3" d="M11.1286 15.6609L9.87891 16.3824L10.4304 17.3377L11.6801 16.6162L11.1286 15.6609Z" fill="white"/>
                                        <path opacity="0.3" d="M9.10612 12.1587L7.85645 12.8802L9.26545 15.3207L10.5151 14.5992L9.10612 12.1587Z" fill="white"/>
                                        <path d="M45.5356 53.4178C46.6266 55.3075 45.9786 57.7231 44.0898 58.8136C42.2002 59.9046 39.7845 59.2566 38.694 57.3678L34.0244 60.0638L36.8719 64.9959L53.0527 55.6539L50.2052 50.7218L45.5356 53.4178Z" fill="white"/>
                                        <path d="M38.5996 57.1925L33.9248 59.8915L34.1163 60.2232L38.7911 57.5242L38.5996 57.1925Z" fill="#757575"/>
                                        <path d="M50.1065 50.549L45.4316 53.248L45.6231 53.5797L50.298 50.8807L50.1065 50.549Z" fill="#757575"/>
                                        <path d="M41.0024 63.7162L38.4728 65.1767C38.4122 65.2117 38.3343 65.1908 38.2993 65.1302L37.8838 64.4105L40.6196 62.831L41.0426 63.5637C41.0741 63.6182 41.0553 63.6857 41.0024 63.7162Z" fill="#6D6D6D"/>
                                        <path d="M40.273 64.1372L39.1896 64.7627C39.142 64.7902 39.0805 64.7737 39.053 64.7261L38.674 64.0696C38.6465 64.022 38.663 63.9605 38.7106 63.933L39.794 63.3075C39.8416 63.28 39.9031 63.2965 39.9306 63.3441L40.3096 64.0006C40.3368 64.0496 40.3206 64.1097 40.273 64.1372Z" fill="#939292"/>
                                        <path d="M41.0136 63.7097L40.4446 64.0382C40.397 64.0657 40.3369 64.0496 40.3094 64.002L39.9294 63.3438C39.9024 63.297 39.918 63.2361 39.9656 63.2086L40.5346 62.8801C40.5822 62.8526 40.6423 62.8687 40.6698 62.9163L41.0498 63.5745C41.0765 63.6226 41.0604 63.6827 41.0136 63.7097Z" fill="#B7B7B7"/>
                                        <path d="M39.0123 64.8652L38.4529 65.1882C38.4035 65.2167 38.3393 65.1995 38.3108 65.1501L37.9358 64.5006C37.9073 64.4512 37.9245 64.387 37.9739 64.3585L38.5333 64.0355C38.5827 64.007 38.6469 64.0242 38.6754 64.0736L39.0504 64.7231C39.0794 64.7733 39.0625 64.8362 39.0123 64.8652Z" fill="#B7B7B7"/>
                                        <path d="M52.4214 57.1232L49.8917 58.5837C49.8311 58.6187 49.7532 58.5978 49.7182 58.5372L49.3027 57.8175L52.0385 56.238L52.4615 56.9707C52.4939 57.0247 52.4751 57.0922 52.4214 57.1232Z" fill="#6D6D6D"/>
                                        <path d="M50.4322 58.2717L49.8728 58.5947C49.8234 58.6232 49.7592 58.606 49.7307 58.5566L49.3557 57.9071C49.3272 57.8577 49.3444 57.7935 49.3938 57.765L49.9532 57.442C50.0026 57.4135 50.0668 57.4307 50.0953 57.4801L50.4703 58.1296C50.4993 58.1798 50.4816 58.2432 50.4322 58.2717Z" fill="#B7B7B7"/>
                                    </svg>
                                    <svg class="bottom-svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M14.6906 6.69922C11.2095 5.51059 7.42558 7.37001 6.23694 10.8511C5.04831 14.3322 6.90773 18.1162 10.3888 19.3048C13.8699 20.4934 17.6539 18.634 18.8425 15.1529C20.0311 11.6718 18.1717 7.88786 14.6906 6.69922ZM10.9143 17.7679C8.28261 16.87 6.87745 14.0082 7.77536 11.3765C8.67327 8.74489 11.5351 7.33973 14.1667 8.23764C16.7984 9.13555 18.2035 11.9973 17.3056 14.629C16.4077 17.2606 13.5459 18.6658 10.9143 17.7679Z" fill="#111111"/>
                                        <path class="theme-color" class="theme-color" d="M22.5174 4.28077L9.97694 0.00170898L0 8.72188L2.56352 21.7211L15.104 26.0002L25.0809 17.28L22.5174 4.28077ZM10.5735 18.7669C7.3892 17.6798 5.68879 14.2183 6.77597 11.034C7.86315 7.8497 11.3246 6.14928 14.5089 7.23646C17.6932 8.32364 19.3936 11.7851 18.3064 14.9694C17.2193 18.1537 13.7563 19.8526 10.5735 18.7669Z" fill="#FF8000"/>
                                        <path d="M0 8.72194L2.56352 21.7212L8.83373 23.8607L10.572 18.7655C7.3877 17.6783 5.68726 14.2169 6.77444 11.0326C7.86162 7.84823 11.3231 6.14782 14.5074 7.235L16.2456 2.1398L9.97542 0.000244141L0 8.72194Z" fill="#111111"/>
                                    </svg>
                                    <div class="container">
                                        <form class="appointment-form">
                                            <div class="date-picker">
                                                <span><?php echo e(__('Date:')); ?></span>
                                                <div class="form-group">
                                                    <input type="text" class="form-control datepicker_min" placeholder="00-00-0000">
                                                </div>
                                            </div>
                                            <span class="text-danger text-center h6 span-error-date"></span>
                                            <ul class="check-box-div d-flex" id="inputrow_appointment_preview">
                                                <span><?php echo e(__('Hours:')); ?></span>
                                                <?php $radiocount = 1; ?>
                                                <?php if(!is_null($appoinment_hours)): ?>
                                                    <?php $__currentLoopData = $appoinment_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="checkbox-custom" id="<?php echo e('appointment_' . $appointment_nos); ?>">
                                                        <input type="radio" id="radio-<?php echo e($radiocount); ?>" name="time"  data-id="<?php if(!empty($hour->start)): ?> <?php echo e($hour->start); ?> <?php else: ?> 00:00 <?php endif; ?>-<?php if(!empty($hour->end)): ?> <?php echo e($hour->end); ?> <?php else: ?> 00:00 <?php endif; ?>">
                                                        <label for="radio-<?php echo e($radiocount); ?>">
                                                            <span  id="appoinment_start_<?php echo e($appointment_nos); ?>_preview">
                                                                <?php if(!empty($hour->start)): ?>
                                                                    <?php echo e($hour->start); ?>

                                                                <?php else: ?>
                                                                    00:00
                                                                <?php endif; ?>
                                                                </span>-
                                                                <span id="appoinment_end_<?php echo e($appointment_nos); ?>_preview">
                                                                    <?php if(!empty($hour->end)): ?>
                                                                        <?php echo e($hour->end); ?>

                                                                    <?php else: ?>
                                                                        00:00
                                                                    <?php endif; ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <?php
                                                    $radiocount++;
                                                    $appointment_nos++;
                                                ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                            <div class="text-center">
                                                <button type="button" class="btn appointment-btn"><?php echo e(__('Make An Appointment')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'social'): ?>
                            <section class="social-link-sec pb" id="social-div">
                                <div class="container">
                                    <div class="social-link-slider" id="inputrow_socials_preview">
                                        <?php if(!is_null($social_content) && !is_null($sociallinks)): ?>
                                            <?php $__currentLoopData = $social_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key => $social_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $social_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key1 => $social_val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($social_key1 != 'id'): ?>
                                                        <div class="social-link"  id="socials_<?php echo e($loop->parent->index + 1); ?>">
                                                            <?php if($social_key1 == 'Whatsapp'): ?>
                                                                <?php
                                                                    $social_links = 'https://wa.me/' . $social_val1;
                                                                ?>
                                                            <?php else: ?>
                                                                <?php
                                                                    $social_links = url($social_val1);
                                                                ?>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e($social_links); ?>" target="_blank"   id="<?php echo e('social_link_' . $social_nos . '_href_preview'); ?>">
                                                                <img src="<?php echo e(asset('custom/theme2/icon/social/' . strtolower($social_key1) . '.svg')); ?>" alt="social-image" loading="lazy">
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php
                                                        $social_nos++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'product'): ?>
                            <section class="product-sec pb" id="product-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Product')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="container">
                                    <?php if(isset($is_pdf)): ?>
                                        <?php $pr_image_count = 0; ?>
                                        <?php $__currentLoopData = $products_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="product-card edit-card" id="product_<?php echo e($product_row_nos); ?>">
                                                <div class="product-card-inner">
                                                    <div class="product-card-image">
                                                        <div class="img-wrapper">
                                                            <img src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" alt="product-image" loading="lazy">
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-content-top">
                                                        <h3 id="<?php echo e('product_title_' . $product_row_nos . '_preview'); ?>">
                                                            <?php echo e($content->title); ?></h3>
                                                        <p id="<?php echo e('product_description_' . $product_row_nos . '_preview'); ?>">
                                                            <?php echo e($content->description); ?></p>
                                                        </div>
                                                        <div
                                                            class="product-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="price">
                                                                <ins id="<?php echo e('product_currency_select' . $product_row_nos . '_preview'); ?>"><?php echo e($content->currency); ?></ins>
                                                                <ins id="<?php echo e('product_price_' . $product_row_nos . '_preview'); ?>"><?php echo e($content->price); ?></ins>
                                                            </div>
                                                            <?php if(!empty($content->purchase_link)): ?>
                                                            <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                class="btn btn-white"><?php echo e($content->link_title); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $pr_image_count++;
                                            $product_row_nos++;
                                             ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="product-sec-slider" id="inputrow_product_preview">
                                            <?php $pr_image_count = 0; ?>
                                            <?php $__currentLoopData = $products_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="product-card " id="product_<?php echo e($product_row_nos); ?>">
                                                    <div class="product-card-inner">
                                                        <div class="product-card-image">
                                                            <div class="img-wrapper">
                                                                <img src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" alt="product-image" loading="lazy">
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="product-content-top">
                                                            <h3 id="<?php echo e('product_title_' . $product_row_nos . '_preview'); ?>">
                                                                <?php echo e($content->title); ?></h3>
                                                            <p id="<?php echo e('product_description_' . $product_row_nos . '_preview'); ?>">
                                                                <?php echo e($content->description); ?></p>
                                                            </div>
                                                            <div
                                                                class="product-content-bottom d-flex align-items-center justify-content-between">
                                                                <div class="price">
                                                                    <ins id="<?php echo e('product_currency_select' . $product_row_nos . '_preview'); ?>"><?php echo e($content->currency); ?></ins>
                                                                    <ins id="<?php echo e('product_price_' . $product_row_nos . '_preview'); ?>"><?php echo e($content->price); ?></ins>
                                                                </div>
                                                                <?php if(!empty($content->purchase_link)): ?>
                                                                <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                    class="btn btn-white"><?php echo e($content->link_title); ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $pr_image_count++;
                                                $product_row_nos++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'gallery'): ?>
                            <section class="gallery-sec pb" id="gallery-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Gallery')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="gallery-sec-inner bg-light pt pb">
                                    <div class="container">
                                        <div class="gallery-slider" id="inputrow_gallery_preview">
                                        <?php $image_count = 0; ?>
                                        <?php if(isset($is_pdf)): ?>
                                            <div class="gallery-card">
                                                <div class="gallery-card-inner">
                                                    <?php if(!is_null($gallery_contents) && !is_null($gallery)): ?>
                                                        <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(isset($gallery_content->type)): ?>
                                                                <?php if($gallery_content->type == 'video'): ?>
                                                                    <!-- Handle video content -->
                                                                <?php elseif($gallery_content->type == 'image'): ?>
                                                                    <a href="javascript:void(0);" id="gallerymodel"
                                                                        class="gallery-popup-btn gallery-margin img-wrapper"
                                                                        tabindex="0">
                                                                        <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                            alt="gallery-image">
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php
                                                                $image_count++;
                                                            ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <?php if(!is_null($gallery_contents) && !is_null($gallery)): ?>
                                                <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($gallery_content->type)): ?>
                                                        <?php if($gallery_content->type == 'video'): ?>
                                                            <div class="gallery-card">
                                                                <div class="gallery-card-inner">
                                                                    <a href="javascript:;" id="videomodel"
                                                                        class="video-popup-btn play-btn img-wrapper">
                                                                        <video loop controls="true">
                                                                                <source class="videoresource"
                                                                                src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                type="video/mp4">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php elseif($gallery_content->type == 'image'): ?>
                                                            <div class="gallery-card">
                                                                <div class="gallery-card-inner">
                                                                    <a href="javascript:;" id="gallerymodel"
                                                                        tabindex="0"
                                                                        class="gallery-popup-btn gallery-margin img-wrapper">
                                                                        <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                            alt="images" class="imageresource">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php elseif($gallery_content->type == 'custom_video_link'): ?>
                                                            <?php if(str_contains($gallery_content->value, 'youtube') || str_contains($gallery_content->value, 'youtu.be')): ?>
                                                                <?php
                                                                    if (
                                                                        strpos($gallery_content->value, 'src') !== false
                                                                    ) {
                                                                        preg_match(
                                                                            '/src="([^"]+)"/',
                                                                            $gallery_content->value,
                                                                            $match,
                                                                        );
                                                                        $url = $match[1];
                                                                        $video_url = str_replace(
                                                                            'https://www.youtube.com/embed/',
                                                                            '',
                                                                            $url,
                                                                        );
                                                                    } elseif (
                                                                        strpos($gallery_content->value, 'src') ==
                                                                            false &&
                                                                        strpos($gallery_content->value, 'embed') !==
                                                                            false
                                                                    ) {
                                                                        $video_url = str_replace(
                                                                            'https://www.youtube.com/embed/',
                                                                            '',
                                                                            $gallery_content->value,
                                                                        );
                                                                    } else {
                                                                        $video_url = str_replace(
                                                                            'https://youtu.be/',
                                                                            '',
                                                                            str_replace(
                                                                                'https://www.youtube.com/watch?v=',
                                                                                '',
                                                                                $gallery_content->value,
                                                                            ),
                                                                        );
                                                                        preg_match(
                                                                            '/[\\?\\&]v=([^\\?\\&]+)/',
                                                                            $gallery_content->value,
                                                                            $matches,
                                                                        );
                                                                        if (count($matches) > 0) {
                                                                            $videoId = $matches[1];
                                                                            $video_url = strtok($videoId, '&');
                                                                        }
                                                                    }
                                                                ?>

                                                                <div class="gallery-card">
                                                                    <div class="gallery-card-inner">
                                                                        <a href="javascript:;" id="videomodel"
                                                                            tabindex="0"
                                                                            class="video-popup-btn gallery-margin play-btn img-wrapper">
                                                                            <video loop controls="true"
                                                                                poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                <source class="videoresource"
                                                                                    src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? 'https://www.youtube.com/embed/' . $video_url : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                    type="video/mp4">
                                                                            </video>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="gallery-card">
                                                                    <div class="gallery-card-inner">
                                                                        <a href="javascript:;" id="videomodel"
                                                                            tabindex="0"
                                                                            class="video-popup-btn play-btn gallery-margin img-wrapper">
                                                                            <video loop controls="true"
                                                                                poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                <source class="videoresource"
                                                                                    src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                    type="video/mp4">
                                                                            </video>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <!-- Handle YouTube or custom video link content -->
                                                        <?php elseif($gallery_content->type == 'custom_image_link'): ?>
                                                            <div class="gallery-card">
                                                                <div class="gallery-card-inner">
                                                                    <a href="javascript:;" id="gallerymodel"
                                                                        tabindex="0"
                                                                        class="gallery-popup-btn gallery-margin img-wrapper">
                                                                        <img class="imageresource"
                                                                            src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                            alt="images">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php
                                                        $image_count++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'more'): ?>
                            <section class="more-info-sec pb">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('More')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="container">
                                    <ul class="d-flex justify-content-between">
                                        <li>
                                            <a href="<?php echo e(route('bussiness.save', $business->slug)); ?>"
                                                class="save-info d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.7867 0.318213C5.92135 0.0780268 7.2727 0 8.83546 0H11.0998C12.5039 0 13.8151 0.6684 14.5939 1.7812L15.7312 3.40627C15.9909 3.77717 16.4279 4 16.896 4H23.9725C26.2086 4 28.0211 5.68153 27.9998 7.84693C27.9743 10.4256 27.9958 13.0052 27.9958 15.584C27.9958 17.0725 27.9139 18.3597 27.6616 19.4405C27.406 20.5365 26.957 21.5001 26.1641 22.2553C25.3713 23.0105 24.3597 23.4383 23.209 23.6817C22.0744 23.922 20.723 24 19.1603 24H8.83546C7.2727 24 5.92135 23.922 4.7867 23.6817C3.63615 23.4383 2.62443 23.0105 1.83159 22.2553C1.03877 21.5001 0.589773 20.5365 0.334074 19.4405C0.0819157 18.3597 0 17.0725 0 15.584V8.416C0 6.92743 0.0819157 5.64024 0.334074 4.55945C0.589773 3.46352 1.03877 2.49984 1.83159 1.74464C2.62443 0.989453 3.63615 0.561773 4.7867 0.318213ZM15.3977 10.6667C15.3977 9.93027 14.771 9.33333 13.9979 9.33333C13.2248 9.33333 12.5981 9.93027 12.5981 10.6667V14.7811L11.4882 13.7239C10.9416 13.2032 10.0553 13.2032 9.50861 13.7239C8.96196 14.2445 8.96196 15.0888 9.50861 15.6095L12.9206 18.8595C12.9356 18.8737 12.9508 18.8877 12.9664 18.9013C13.2223 19.1668 13.5896 19.3333 13.9979 19.3333C14.4062 19.3333 14.7735 19.1668 15.0294 18.9013C15.0449 18.8877 15.0602 18.8737 15.0752 18.8595L18.4871 15.6095C19.0338 15.0888 19.0338 14.2445 18.4871 13.7239C17.9405 13.2032 17.0542 13.2032 16.5076 13.7239L15.3977 14.7811V10.6667Z" fill="white"/>
                                                </svg>
                                            </a>
                                            <h3><?php echo e(__('Save')); ?></h3>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="share-info d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.18161 14.3394L14.4018 9.11828C14.7464 8.77363 15.3067 8.77363 15.6514 9.11828C15.996 9.46382 15.996 10.0232 15.6514 10.3688L10.4312 15.589L14.5291 23.3295C14.8596 23.9543 15.5321 24.322 16.2364 24.2636C16.9416 24.2053 17.5443 23.7325 17.7679 23.0609C19.3233 18.3957 23.2241 6.69245 24.6796 2.32683C24.8908 1.69143 24.7255 0.99152 24.2527 0.517842C23.779 0.0441633 23.0791 -0.121095 22.4437 0.0909994L1.70881 7.00264C1.03806 7.22622 0.565255 7.82805 0.506045 8.53327C0.447719 9.23848 0.815362 9.91012 1.44104 10.2415L9.18161 14.3394Z" fill="white"/>
                                                </svg>
                                            </a>
                                            <h3><?php echo e(__('Share')); ?></h3>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="contact-info d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M18.5114 10.3605C18.6393 10.3605 18.766 10.3353 18.8842 10.2864C19.0025 10.2374 19.1099 10.1657 19.2003 10.0752C19.2908 9.98473 19.3626 9.87732 19.4115 9.7591C19.4605 9.64089 19.4857 9.51418 19.4856 9.38623V1.59218C19.4856 1.33379 19.383 1.08598 19.2003 0.903273C19.0176 0.720565 18.7698 0.61792 18.5114 0.61792C18.253 0.61792 18.0052 0.720565 17.8225 0.903273C17.6398 1.08598 17.5371 1.33379 17.5371 1.59218V9.38623C17.5371 9.51418 17.5623 9.64089 17.6112 9.7591C17.6602 9.87732 17.7319 9.98473 17.8224 10.0752C17.9129 10.1657 18.0203 10.2374 18.1385 10.2864C18.2567 10.3353 18.3834 10.3605 18.5114 10.3605Z" fill="white"/>
                                                    <path d="M14.6139 8.41195C14.7419 8.41198 14.8686 8.3868 14.9868 8.33785C15.105 8.28891 15.2124 8.21714 15.3029 8.12667C15.3934 8.03619 15.4651 7.92878 15.5141 7.81056C15.563 7.69235 15.5882 7.56564 15.5882 7.43769V3.54066C15.5882 3.28227 15.4855 3.03447 15.3028 2.85176C15.1201 2.66905 14.8723 2.56641 14.6139 2.56641C14.3555 2.56641 14.1077 2.66905 13.925 2.85176C13.7423 3.03447 13.6396 3.28227 13.6396 3.54066V7.43769C13.6396 7.56564 13.6648 7.69235 13.7137 7.81056C13.7627 7.92878 13.8345 8.03619 13.9249 8.12667C14.0154 8.21714 14.1228 8.28891 14.241 8.33785C14.3593 8.3868 14.486 8.41198 14.6139 8.41195Z" fill="white"/>
                                                    <path d="M22.4079 7.4378C22.5358 7.43783 22.6625 7.41266 22.7807 7.36371C22.8989 7.31476 23.0064 7.24299 23.0968 7.15252C23.1873 7.06205 23.2591 6.95463 23.308 6.83641C23.357 6.7182 23.3821 6.59149 23.3821 6.46354V4.51503C23.3821 4.25664 23.2795 4.00883 23.0968 3.82612C22.914 3.64342 22.6662 3.54077 22.4079 3.54077C22.1495 3.54077 21.9017 3.64342 21.7189 3.82612C21.5362 4.00883 21.4336 4.25664 21.4336 4.51503V6.46354C21.4336 6.59149 21.4587 6.7182 21.5077 6.83641C21.5566 6.95463 21.6284 7.06205 21.7189 7.15252C21.8093 7.24299 21.9168 7.31476 22.035 7.36371C22.1532 7.41266 22.2799 7.43783 22.4079 7.4378Z" fill="white"/>
                                                    <path d="M23.7146 18.7675L19.7595 14.8124C19.6224 14.6754 19.4477 14.5823 19.2575 14.5451C19.0673 14.508 18.8703 14.5283 18.6918 14.6037L14.5282 16.3608L7.63915 9.47182L9.39626 5.30827C9.47162 5.12971 9.49201 4.93274 9.45484 4.74253C9.41766 4.55232 9.32459 4.37752 9.18754 4.24048L5.23242 0.285371C5.14195 0.194898 5.03455 0.12313 4.91634 0.0741659C4.79813 0.0252018 4.67144 0 4.5435 0C4.41555 0 4.28886 0.0252018 4.17065 0.0741659C4.05245 0.12313 3.94504 0.194898 3.85457 0.285371L1.15366 2.98631C-1.93852 6.07856 1.58733 11.6658 6.96079 17.0392C12.3342 22.4127 17.9215 25.9385 21.0138 22.8463L23.7147 20.1454C23.8974 19.9627 24 19.7148 24 19.4564C24 19.1981 23.8973 18.9502 23.7146 18.7675Z" fill="white"/>
                                                </svg>
                                            </a>
                                            <h3><?php echo e(__('Contact')); ?></h3>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'testimonials'): ?>
                            <section class="testimonial-sec pb" id="testimonials-div">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Testimonials')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="testimonial-wrp bg-light pt pb">
                                    <div class="container">
                                        <?php if(isset($is_pdf)): ?>
                                            <?php
                                            $t_image_count = 0;
                                            $rating = 0;
                                            ?>
                                            <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <div class="testimonial-card edit-card" id="testimonials_<?php echo e($testimonials_row_nos); ?>">
                                                <div class="testimonial-card-inner">
                                                    <div class="testimonial-image">
                                                        <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                        src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                        alt="testimonial-image">
                                                    </div>
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-content-top">
                                                            <p id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>">
                                                                    <?php echo e($testi_content->description); ?> </p>
                                                        </div>
                                                        <div class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="client-info">
                                                                <h3 id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                                <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                            </h3>
                                                            </div>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php
                                                                    if (!empty($testi_content->rating)) {
                                                                        $rating = (int) $testi_content->rating;
                                                                        $overallrating = $rating;
                                                                    } else {
                                                                        $overallrating = 0;
                                                                    }
                                                                ?>
                                                                <span id="<?php echo e('stars' . $testimonials_row_nos); ?>_star"
                                                                    class="stars">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <?php if($overallrating < $i): ?>
                                                                            <?php if(is_float($overallrating) && round($overallrating) == $i): ?>
                                                                                <i
                                                                                    class="star-color fas fa-star-half-alt"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa fa-star"></i>
                                                                            <?php endif; ?>
                                                                        <?php else: ?>
                                                                            <i class="star-color fas fa-star"></i>
                                                                        <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                            <?php
                                            $t_image_count = 0;
                                            $rating = 0;
                                            ?>
                                            <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <div class="testimonial-card" id="testimonials_<?php echo e($testimonials_row_nos); ?>">
                                                <div class="testimonial-card-inner">
                                                    <div class="testimonial-image">
                                                        <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                        src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                        alt="testimonial-image">
                                                    </div>
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-content-top">
                                                            <p id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>">
                                                                    <?php echo e($testi_content->description); ?> </p>
                                                        </div>
                                                        <div class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="client-info">
                                                                <h3 id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                                <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                            </h3>
                                                            </div>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php
                                                                    if (!empty($testi_content->rating)) {
                                                                        $rating = (int) $testi_content->rating;
                                                                        $overallrating = $rating;
                                                                    } else {
                                                                        $overallrating = 0;
                                                                    }
                                                                ?>
                                                                <span id="<?php echo e('stars' . $testimonials_row_nos); ?>_star"
                                                                    class="stars">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <?php if($overallrating < $i): ?>
                                                                            <?php if(is_float($overallrating) && round($overallrating) == $i): ?>
                                                                                <i
                                                                                    class="star-color fas fa-star-half-alt"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa fa-star"></i>
                                                                            <?php endif; ?>
                                                                        <?php else: ?>
                                                                            <i class="star-color fas fa-star"></i>
                                                                        <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'payment'): ?>
                            <section class="payment-sec pb" id="payment-section">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Payment')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <div class="container">
                                    <?php if(!is_null($cardPayment_content) && !empty($cardPayment_content)): ?>
                                    <ul class="d-flex align-items-center justify-content-center">
                                        <?php if(isset($cardPayment_content->stripe) && $cardPayment_content->stripe->status == 'on'): ?>
                                        <li>
                                            <a href="<?php echo e(route('card.pay.with.stripe', $business->id)); ?>"
                                                class="d-flex align-items-center" target="_blank">
                                                <img src="<?php echo e(asset('custom/img/payments/stripe.png')); ?>"
                                                    alt="payment-image" class="img-fluid" loading="lazy">
                                                <span><?php echo e(__('Stripe')); ?></span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if(isset($cardPayment_content->paypal) && $cardPayment_content->paypal->status == 'on'): ?>
                                        <li>
                                            <a href="<?php echo e(route('card.pay.with.paypal', $business->id)); ?>" class="d-flex align-items-center" target="_blank">
                                                <img src="<?php echo e(asset('custom/img/payments/paypal.png')); ?>" alt="payment-image"  loading="lazy">
                                                <span><?php echo e(__('Paypal')); ?></span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if(!isset($is_pdf)): ?>
                         <?php if($order_key == 'google_map'): ?>
                            <section class="google-map-sec pb" id="google-map-div">
                                <div class="map img-wrapper">
                                    <input type="hidden" id="mapLink"
                                        value="<?php echo e($business->google_map_link); ?>">
                                    <div id="mapContainer">
                                    </div>
                                </div>
                            </section>
                         <?php endif; ?>
                        <?php endif; ?>
                        <?php if($order_key == 'appinfo'): ?>
                            <section class="download-sec pb" id="app-section">
                                <div class="section-title text-center line-title">
                                    <h2><?php echo e(__('Download Here')); ?></h2>
                                    <div class="line"></div>
                                </div>
                                <?php if(!is_null($appInfo)): ?>
                                <div class="container">
                                        <ul class="d-flex align-items-center">
                                            <li>
                                                <a href="<?php echo e($appInfo->playstore_id); ?>" class="d-flex align-items-center justify-content-center" target="_blank">
                                                    <img src="<?php echo e(asset('custom/icon/apps/playstore' . $appInfo->variant . '.png')); ?>" alt="app-store" loading="lazy">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e($appInfo->appstore_id); ?>" class="d-flex align-items-center justify-content-center" target="_blank">
                                                    <img src="<?php echo e(asset('custom/icon/apps/appstore' . $appInfo->variant . '.png')); ?>" alt="app-store" loading="lazy">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'custom_html'): ?>
                            <section class="custom-text-sec pb custom_html_text">
                                <div class="container">
                                    <div class="custom-text">
                                        <h3 id="<?php echo e($stringid . '_chtml'); ?>_preview">
                                            <?php echo !empty($custom_html) ? stripslashes($custom_html) : 'hello'; ?>

                                        </h3>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'svg'): ?>
                            <section class="custom-text-sec pb" id="svg-div">
                                <div class="container">
                                    <div class="thankyou-svg">
                                        <?php if(empty($business->svg_text)): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="430" height="333" viewBox="0 0 430 333" fill="none">
                                            <rect width="430" height="333" fill="#F5F5F5"/>
                                            <path d="M382.102 161.63C378.409 161.69 369.091 161.838 365.521 161.876L359.932 161.9L359.663 161.902L359.661 161.63L359.636 154.66L359.635 154.363L359.932 154.364L371.017 154.404C373.777 154.427 379.342 154.484 382.102 154.52L382.244 154.522L382.241 154.66L382.102 161.63ZM382.102 161.63L381.963 154.66L382.102 154.799C379.337 154.836 373.782 154.892 371.017 154.915L359.932 154.955L360.228 154.66L360.202 161.63L359.932 161.36L365.428 161.385C368.942 161.423 378.467 161.572 382.102 161.63Z" fill="#3A2D57"/>
                                            <path d="M398.718 111.672C395.024 111.732 385.706 111.88 382.136 111.918L376.547 111.943L376.278 111.944L376.277 111.672L376.251 104.702L376.25 104.405L376.547 104.406L387.633 104.447C390.393 104.47 395.958 104.526 398.718 104.563L398.861 104.564L398.858 104.702L398.718 111.672ZM398.718 111.672L398.578 104.702L398.718 104.841C395.952 104.878 390.397 104.934 387.632 104.957L376.546 104.998L376.842 104.702L376.816 111.672L376.546 111.402L382.042 111.427C385.558 111.465 395.082 111.614 398.718 111.672Z" fill="#3A2D57"/>
                                            <path d="M56.0898 186.208C52.3959 186.267 43.0783 186.416 39.5083 186.453L33.9189 186.478L33.6499 186.479L33.6487 186.208L33.6233 179.238L33.6221 178.941L33.9189 178.942L45.0041 178.982C47.7641 179.005 53.3298 179.062 56.0898 179.098L56.232 179.1L56.229 179.238L56.0898 186.208ZM56.0898 186.208L55.9505 179.237L56.0898 179.376C53.3238 179.414 47.7688 179.469 45.0041 179.492L33.9189 179.533L34.2146 179.237L34.1891 186.207L33.9189 185.937L39.4147 185.962C42.9296 186 52.4546 186.149 56.0898 186.208Z" fill="#3A2D57"/>
                                            <path d="M43.7226 188.026H21.5518V194.997H43.7226V188.026Z" fill="#3A2D57"/>
                                            <path d="M194.84 218.87C198.534 218.811 207.851 218.662 211.421 218.625L217.011 218.6L217.28 218.599L217.282 218.87L217.307 225.84L217.308 226.137L217.011 226.136L205.926 226.096C203.166 226.072 197.6 226.016 194.84 225.979L194.698 225.978L194.701 225.84L194.84 218.87ZM194.84 218.87L194.979 225.841L194.84 225.702C197.606 225.664 203.161 225.609 205.926 225.585L217.011 225.545L216.715 225.841L216.741 218.871L217.011 219.141L211.515 219.116C208.001 219.077 198.476 218.928 194.84 218.87Z" fill="#3A2D57"/>
                                            <path d="M207.207 217.051H229.378V210.08H207.207V217.051Z" fill="#3A2D57"/>
                                            <path d="M369.206 160.552H347.035V167.522H369.206V160.552Z" fill="#3A2D57"/>
                                            <path d="M211.515 76.8743C207.821 76.9341 198.504 77.0822 194.934 77.1196L189.344 77.1445L189.075 77.1456L189.074 76.8743L189.048 69.9043L189.047 69.6074L189.344 69.6086L200.429 69.6489C203.189 69.672 208.755 69.7283 211.514 69.765L211.656 69.7668L211.653 69.9049L211.515 76.8743ZM211.515 76.8743L211.376 69.9037L211.515 70.0429C208.749 70.0803 203.194 70.136 200.43 70.1591L189.345 70.1994L189.641 69.9037L189.615 76.8737L189.345 76.6035L194.841 76.6284C198.355 76.6675 207.88 76.8162 211.515 76.8743Z" fill="#3A2D57"/>
                                            <path d="M199.147 78.6931H176.977V85.6637H199.147V78.6931Z" fill="#3A2D57"/>
                                            <path d="M245.147 48.8971C241.453 48.9569 232.136 49.1051 228.566 49.1424L222.976 49.1673L222.707 49.1685L222.705 48.8971L222.68 41.9265L222.679 41.6296L222.976 41.6308L234.061 41.6711C236.821 41.6942 242.386 41.7505 245.146 41.7873L245.289 41.789L245.286 41.9271L245.147 48.8971ZM245.147 48.8971L245.008 41.9265L245.147 42.0657C242.381 42.1031 236.826 42.1588 234.061 42.1819L222.976 42.2222L223.272 41.9265L223.246 48.8971L222.976 48.6269L228.472 48.6518C231.987 48.6903 241.512 48.839 245.147 48.8971Z" fill="#3A2D57"/>
                                            <path d="M126.184 210.361H104.013V217.332H126.184V210.361Z" fill="#3A2D57"/>
                                            <path d="M125.015 164.05C121.321 164.109 112.004 164.258 108.434 164.295L102.844 164.32L102.575 164.322L102.574 164.05L102.548 157.08L102.547 156.783L102.844 156.784L113.929 156.824C116.689 156.847 122.255 156.904 125.015 156.94L125.157 156.942L125.154 157.08L125.015 164.05ZM125.015 164.05L124.876 157.08L125.015 157.219C122.249 157.256 116.694 157.312 113.929 157.335L102.844 157.375L103.14 157.08L103.115 164.05L102.844 163.78L108.34 163.805C111.855 163.843 121.38 163.992 125.015 164.05Z" fill="#3A2D57"/>
                                            <path d="M402.843 46.0789H380.672V53.0494H402.843V46.0789Z" fill="#3A2D57"/>
                                            <path d="M52.941 44.2674C49.2471 44.3273 39.9295 44.4754 36.3595 44.5127L30.7701 44.5376L30.5005 44.5388L30.4993 44.2674L30.4738 37.2969L30.4727 37L30.7695 37.0012L41.8552 37.0415C44.6153 37.0646 50.1809 37.1209 52.9404 37.1576L53.0826 37.1594L53.0796 37.2975L52.941 44.2674ZM52.941 44.2674L52.8017 37.2969L52.941 37.4361C50.175 37.4734 44.62 37.5291 41.8558 37.5522L30.7701 37.5925L31.0658 37.2969L31.0403 44.2674L30.7701 43.9972L36.2659 44.0221C39.7808 44.0606 49.3058 44.2094 52.941 44.2674Z" fill="#3A2D57"/>
                                            <path class="theme-color" d="M161.483 47.018C161.766 46.7342 162.112 46.5914 162.519 46.5914H176.777C177.183 46.5914 177.527 46.7342 177.813 47.018C178.097 47.3036 178.239 47.6485 178.239 48.0538V130.433C178.239 130.84 178.097 131.185 177.813 131.468C177.527 131.754 177.183 131.895 176.777 131.895H162.519C162.112 131.895 161.766 131.754 161.483 131.468C161.198 131.185 161.057 130.84 161.057 130.433V97.1642C161.057 96.7589 160.852 96.5551 160.447 96.5551H148.261C147.854 96.5551 147.652 96.7589 147.652 97.1642V130.433C147.652 130.84 147.509 131.185 147.225 131.468C146.939 131.754 146.595 131.895 146.189 131.895H131.931C131.523 131.895 131.179 131.754 130.895 131.468C130.609 131.185 130.469 130.84 130.469 130.433V48.0532C130.469 47.6479 130.61 47.303 130.895 47.0174C131.179 46.7336 131.523 46.5908 131.931 46.5908H146.189C146.595 46.5908 146.939 46.7336 147.225 47.0174C147.508 47.303 147.652 47.6479 147.652 48.0532V81.1996C147.652 81.6072 147.854 81.8087 148.261 81.8087H160.447C160.853 81.8087 161.057 81.6072 161.057 81.1996V48.0532C161.057 47.6479 161.198 47.303 161.483 47.018Z" fill="#FF8000"/>
                                            <path d="M140.032 51.859C140.032 52.5452 139.475 53.1015 138.789 53.1015C138.103 53.1015 137.546 52.5452 137.546 51.859C137.546 51.1728 138.102 50.6165 138.789 50.6165C139.475 50.6159 140.032 51.1723 140.032 51.859Z" fill="#A6A6A6"/>
                                            <path d="M171.033 51.859C171.033 52.5452 170.476 53.1015 169.789 53.1015C169.103 53.1015 168.547 52.5452 168.547 51.859C168.547 51.1728 169.103 50.6165 169.789 50.6165C170.476 50.6159 171.033 51.1723 171.033 51.859Z" fill="#A6A6A6"/>
                                            <path class="theme-color" d="M282.978 47.018C283.261 46.7342 283.605 46.5914 284.014 46.5914H298.15C298.556 46.5914 298.9 46.7342 299.186 47.018C299.469 47.3036 299.612 47.6485 299.612 48.0538V130.433C299.612 130.84 299.469 131.185 299.186 131.468C298.9 131.754 298.556 131.895 298.15 131.895H282.064C281.251 131.895 280.723 131.489 280.48 130.677L265.368 83.5164C265.287 83.2728 265.143 83.1715 264.942 83.2118C264.737 83.2533 264.637 83.3943 264.637 83.6378L264.759 130.433C264.759 130.841 264.616 131.185 264.332 131.469C264.046 131.755 263.702 131.896 263.296 131.896H249.16C248.753 131.896 248.408 131.755 248.124 131.469C247.838 131.185 247.697 130.841 247.697 130.433V48.0532C247.697 47.6479 247.838 47.303 248.124 47.0174C248.408 46.7336 248.753 46.5908 249.16 46.5908H265.124C265.935 46.5908 266.465 46.9985 266.708 47.8091L281.94 94.9695C282.021 95.213 282.163 95.3161 282.367 95.274C282.569 95.2343 282.672 95.0915 282.672 94.848L282.55 48.0526C282.551 47.6479 282.692 47.303 282.978 47.018Z" fill="#FF8000"/>
                                            <path d="M258.852 51.859C258.852 52.5452 258.296 53.1015 257.61 53.1015C256.924 53.1015 256.367 52.5452 256.367 51.859C256.367 51.1728 256.924 50.6165 257.61 50.6165C258.296 50.6159 258.852 51.1723 258.852 51.859Z" fill="#A6A6A6"/>
                                            <path d="M292.805 51.859C292.805 52.5452 292.249 53.1015 291.562 53.1015C290.875 53.1015 290.319 52.5452 290.319 51.859C290.319 51.1728 290.876 50.6165 291.562 50.6165C292.248 50.6165 292.805 51.1723 292.805 51.859Z" fill="#A6A6A6"/>
                                            <path class="theme-color" d="M223.205 142.405L221.255 130.706C221.255 130.3 221.011 130.096 220.523 130.096H205.047C204.559 130.096 204.316 130.3 204.316 130.706L202.366 142.405C202.284 143.299 201.757 143.745 200.781 143.745H186.523C185.467 143.745 185.061 143.218 185.305 142.16L203.22 59.7822C203.381 58.8893 203.909 58.4419 204.804 58.4419H221.255C222.147 58.4419 222.675 58.8893 222.84 59.7822L240.631 142.161L240.752 142.649C240.752 143.38 240.305 143.746 239.412 143.746H224.788C223.814 143.745 223.285 143.299 223.205 142.405ZM207.241 116.814H218.209C218.615 116.814 218.776 116.612 218.697 116.205L212.969 82.9361C212.887 82.6925 212.765 82.5705 212.604 82.5705C212.44 82.5705 212.318 82.692 212.238 82.9361L206.754 116.205C206.753 116.612 206.916 116.814 207.241 116.814Z" fill="#FF8000"/>
                                            <path d="M214.238 65.1715C214.238 65.8577 213.681 66.4146 212.995 66.4146C212.309 66.4146 211.752 65.8582 211.752 65.1715C211.752 64.4853 212.308 63.929 212.995 63.929C213.681 63.9284 214.238 64.4848 214.238 65.1715Z" fill="#A6A6A6"/>
                                            <path class="theme-color" d="M310.762 143.318C310.476 143.035 310.335 142.69 310.335 142.283V59.9038C310.335 59.4985 310.476 59.1536 310.762 58.868C311.045 58.5842 311.39 58.4414 311.797 58.4414H326.055C326.461 58.4414 326.806 58.5842 327.092 58.868C327.375 59.1536 327.518 59.4985 327.518 59.9038V90.6131C327.518 90.9384 327.619 91.1215 327.822 91.1612C328.024 91.2032 328.167 91.0604 328.248 90.7351L343.969 59.5382C344.375 58.807 344.944 58.4414 345.675 58.4414H360.786C361.353 58.4414 361.74 58.5842 361.944 58.868C362.146 59.1536 362.127 59.5803 361.883 60.1473L343.848 95.2437C343.766 95.569 343.726 95.8131 343.726 95.9749L362.858 142.039C362.938 142.203 362.98 142.447 362.98 142.77C362.98 143.422 362.572 143.746 361.762 143.746H346.529C345.633 143.746 345.066 143.38 344.823 142.649L332.149 110.721C332.067 110.478 331.945 110.376 331.784 110.416C331.62 110.458 331.458 110.559 331.296 110.721L327.762 117.058C327.598 117.383 327.518 117.627 327.518 117.789V142.284C327.518 142.691 327.374 143.036 327.092 143.32C326.806 143.605 326.461 143.746 326.055 143.746H311.797C311.39 143.745 311.045 143.605 310.762 143.318Z" fill="#FF8000"/>
                                            <path d="M320.451 65.1715C320.451 65.8577 319.895 66.4146 319.208 66.4146C318.522 66.4146 317.966 65.8582 317.966 65.1715C317.966 64.4853 318.522 63.929 319.208 63.929C319.895 63.9284 320.451 64.4848 320.451 65.1715Z" fill="#A6A6A6"/>
                                            <path d="M352.375 65.1715C352.375 65.8577 351.818 66.4146 351.132 66.4146C350.446 66.4146 349.89 65.8582 349.89 65.1715C349.89 64.4853 350.446 63.929 351.132 63.929C351.818 63.929 352.375 64.4848 352.375 65.1715Z" fill="#A6A6A6"/>
                                            <path d="M151.612 245.308C151.326 245.024 151.186 244.679 151.186 244.271V212.587L151.064 211.856L134.004 162.259C133.922 162.096 133.881 161.893 133.881 161.649C133.881 160.918 134.326 160.552 135.222 160.552H150.211C151.104 160.552 151.673 160.96 151.916 161.772L159.472 190.897C159.552 191.14 159.674 191.262 159.837 191.262C159.999 191.262 160.121 191.14 160.202 190.897L167.758 161.772C168.002 160.961 168.569 160.552 169.464 160.552H184.453C184.94 160.552 185.306 160.696 185.55 160.979C185.793 161.265 185.833 161.691 185.671 162.259L168.488 211.857L168.367 212.588V244.273C168.367 244.68 168.225 245.025 167.94 245.309C167.655 245.595 167.31 245.735 166.905 245.735H152.646C152.24 245.734 151.896 245.593 151.612 245.308Z" fill="#111111"/>
                                            <path d="M145.564 166.922C145.564 167.608 145.008 168.165 144.322 168.165C143.635 168.165 143.079 167.608 143.079 166.922C143.079 166.236 143.635 165.679 144.322 165.679C145.008 165.679 145.564 166.235 145.564 166.922Z" fill="#A6A6A6"/>
                                            <path d="M176.894 166.922C176.894 167.608 176.338 168.165 175.652 168.165C174.966 168.165 174.409 167.608 174.409 166.922C174.409 166.236 174.966 165.679 175.652 165.679C176.338 165.679 176.894 166.235 176.894 166.922Z" fill="#A6A6A6"/>
                                            <path d="M196.763 252.101C192.294 247.714 190.061 241.864 190.061 234.553V195.557C190.061 188.245 192.294 182.396 196.763 178.009C201.229 173.622 207.201 171.429 214.676 171.429C222.15 171.429 228.142 173.622 232.651 178.009C237.16 182.397 239.415 188.245 239.415 195.557V234.553C239.415 241.864 237.16 247.714 232.651 252.101C228.142 256.488 222.15 258.682 214.676 258.682C207.201 258.681 201.23 256.488 196.763 252.101ZM220.16 241.559C221.541 239.975 222.232 237.884 222.232 235.283V194.825C222.232 192.227 221.541 190.133 220.16 188.549C218.778 186.966 216.95 186.173 214.676 186.173C212.401 186.173 210.594 186.966 209.253 188.549C207.913 190.133 207.243 192.226 207.243 194.825V235.283C207.243 237.884 207.914 239.975 209.253 241.559C210.594 243.144 212.4 243.936 214.676 243.936C216.95 243.936 218.778 243.144 220.16 241.559Z" fill="#111111"/>
                                            <path d="M215.981 178.044C215.981 178.73 215.424 179.286 214.738 179.286C214.052 179.286 213.495 178.73 213.495 178.044C213.495 177.358 214.052 176.801 214.738 176.801C215.424 176.801 215.981 177.357 215.981 178.044Z" fill="#A6A6A6"/>
                                            <path d="M27.8545 288.074C149.027 287.711 284.954 287.708 406.126 288.074C284.953 288.439 149.027 288.436 27.8545 288.074Z" fill="#263238"/>
                                            <path d="M368.906 196.101C369.145 192.604 369.573 189.103 370.386 185.689C371.12 182.608 372.161 179.456 374.106 176.908C375.882 174.581 378.433 172.728 381.397 172.365C384.253 172.015 386.934 173.288 389.071 175.087C391.717 177.316 393.744 180.267 395.646 183.127C397.774 186.326 399.584 189.652 401.326 193.069C401.383 193.182 401.21 193.277 401.155 193.164C399.718 190.276 397.95 187.469 396.075 184.845C394.303 182.366 392.41 179.896 390.225 177.763C388.265 175.85 385.775 174.06 382.934 173.97C380.108 173.88 377.5 175.466 375.799 177.645C373.897 180.08 372.929 183.121 372.204 186.084C371.408 189.337 371.011 192.664 370.739 195.997C370.181 202.856 370.03 209.754 369.875 216.631C369.787 220.523 369.734 224.415 369.699 228.308C369.681 230.28 369.665 232.253 369.651 234.224C369.637 236.125 369.736 238.051 369.423 239.929C369.359 240.312 368.732 240.275 368.667 239.91C368.354 238.133 368.43 236.307 368.406 234.505C368.38 232.636 368.356 230.766 368.34 228.897C368.307 225.263 368.289 221.628 368.299 217.994C368.32 210.701 368.408 203.378 368.906 196.101Z" fill="#263238"/>
                                            <path class="theme-color" d="M378.705 190.929C379.07 188.99 379.724 186.462 380.829 184.96C382.814 182.26 384.958 183.434 382.977 186.424C380.813 189.688 380.501 192.268 380.189 193.796C380.189 193.796 383.527 198.565 387.555 200.912C387.383 199.079 386.866 196.26 387.223 193.54C387.997 187.65 391.56 187.981 390.679 192.659C389.971 196.412 389.681 200.395 389.872 202.122C391.083 203.039 393.145 203.827 394.177 204.231C393.946 203.55 393.701 202.729 393.43 201.736C392 196.455 395.521 194.807 395.633 197.778C395.719 200.22 396.665 204.006 397.003 205.27C398.935 205.918 400.537 206.362 401.517 206.706C405.587 208.135 408.121 211.219 408.121 211.219C409.967 209.578 411.456 207.586 412.621 205.396C411.391 204.337 409.445 202.762 406.745 200.856C401.682 197.282 403.443 192.769 407.46 195.575C410.358 197.6 412.602 201.352 413.621 203.278C415.017 199.942 415.752 196.282 415.917 192.735C411.94 189.003 402.106 183.801 405.071 183.801C407.738 183.801 413.707 187.712 415.897 189.221C415.838 188.169 415.726 187.143 415.56 186.157C411.814 183.701 399.644 179.883 401.583 178.785C403.714 177.581 412.204 181.511 414.772 182.756C414.21 180.93 413.448 179.341 412.522 178.097C407.347 171.169 398.015 168.781 393.944 170.102C391.063 171.037 391.904 178.346 391.286 178.097C379.713 173.44 374.45 176.732 378.705 190.929ZM407.076 190.129C407.896 189.136 411.694 192.054 410.597 193.649C409.498 195.244 406.017 191.399 407.076 190.129ZM387.229 183.895C388.228 184.53 386.752 188.222 385.211 187.104C383.9 186.152 386.223 183.253 387.229 183.895Z" fill="#FF8000"/>
                                            <path d="M388.744 185.026C389.267 183.994 389.812 182.967 390.408 181.974C390.975 181.029 391.579 180.022 392.32 179.201C392.155 178.998 391.995 178.791 391.825 178.591C391.756 178.51 391.875 178.396 391.946 178.476C392.14 178.697 392.324 178.924 392.513 179.148C392.549 179.17 392.579 179.201 392.593 179.243C393.308 180.1 393.982 180.983 394.625 181.884C395.762 182.125 396.886 182.489 397.986 182.858C399.121 183.238 400.246 183.633 401.349 184.098C401.465 184.147 401.407 184.337 401.292 184.286C400.199 183.803 399.09 183.335 397.958 182.952C396.886 182.59 395.796 182.311 394.709 182.004C395.063 182.503 395.41 183.005 395.743 183.516C397.781 184.103 399.775 185.033 401.686 185.941C403.694 186.895 405.627 188.003 407.551 189.116C407.66 189.179 407.557 189.348 407.448 189.283C405.564 188.155 403.601 187.193 401.615 186.263C399.753 185.391 397.827 184.676 395.95 183.847C400.675 191.222 403.511 199.732 407.3 207.612C407.355 207.727 407.176 207.821 407.128 207.707C405.972 204.943 404.639 202.251 403.379 199.532C402.248 197.092 401.144 194.638 400.012 192.198C399.681 191.484 399.339 190.772 398.993 190.06C399.199 194 399.116 198.007 399.761 201.9C399.784 202.039 399.577 202.064 399.568 201.921C399.295 197.712 398.553 193.568 398.583 189.335C398.583 189.31 398.6 189.3 398.606 189.28C397.804 187.671 396.95 186.082 396.027 184.537C394.46 188.224 392.815 191.967 392.084 195.925C392.062 196.047 391.863 195.993 391.896 195.869C392.961 191.9 393.948 187.927 395.86 184.26C394.85 182.59 393.748 180.982 392.531 179.461C392.007 180.441 391.332 181.367 390.736 182.304C390.152 183.219 389.58 184.139 389.04 185.081C387.888 187.095 386.875 189.149 386.084 191.329C386.041 191.449 385.848 191.387 385.896 191.272C386.798 189.174 387.711 187.065 388.744 185.026Z" fill="#263238"/>
                                            <path d="M351.489 193.995C354.521 190.953 358.047 186.961 362.734 186.968C367.257 186.976 370.587 190.619 372.499 194.376C374.5 198.306 375.218 202.758 375.783 207.084C376.46 212.264 376.835 217.487 376.983 222.708C377.065 225.609 377.054 228.513 376.981 231.414C376.909 234.34 376.838 237.31 376.317 240.197C376.232 240.666 375.482 240.683 375.453 240.177C375.316 237.735 375.415 235.281 375.428 232.836C375.441 230.429 375.403 228.021 375.315 225.615C375.137 220.747 374.782 215.887 374.211 211.049C373.712 206.825 373.315 202.48 372.05 198.398C370.91 194.717 368.772 190.507 365.04 188.89C359.947 186.683 354.972 190.714 351.639 194.118C351.553 194.208 351.4 194.083 351.489 193.995Z" fill="#263238"/>
                                            <path class="theme-color" d="M336.016 200.791V200.797C336.04 201.419 336.076 202.033 336.117 202.634C337.502 201.66 339.242 200.776 341.087 200.575C345.392 200.117 345.118 203.39 342.242 203.527C339.499 203.658 337.66 204.124 336.336 204.711C337.038 210.395 338.601 214.964 338.836 215.026C339.07 215.081 344.333 214.704 350.209 213.589C349.139 211.308 346.702 208.277 347.942 208.032C349.216 207.779 350.544 210.486 351.232 213.381C354.067 212.808 356.986 212.059 359.505 211.104C357.611 209.465 354.685 207.425 355.803 206.557C356.92 205.682 359.244 208.559 360.636 210.646C362.019 210.057 363.246 209.395 364.211 208.653C361.66 204.906 355.443 204.143 356.254 201.434C357.083 198.672 362.883 202.482 365.494 207.499C368.563 204.318 369.461 199.816 369.138 195.969C366.467 195.659 361.325 196.223 361.697 194.303C362.048 192.478 365.784 192.75 368.826 193.87C368.451 192.126 367.817 190.639 367.04 189.643C364.224 186.027 355.632 190.624 355.632 190.624C355.632 190.624 356.551 181.988 353.273 180.494C351.384 179.637 348.052 179.644 344.707 181.613C346.583 181.768 348.851 182.362 349.761 183.663C350.927 185.324 349.088 186.226 347.919 185.46C347.097 184.917 345.559 183.208 342.785 182.983C341.708 183.875 340.655 185.012 339.682 186.417C339.365 186.862 339.07 187.334 338.776 187.845C341.479 186.722 345.056 186.147 348.836 188.027C352.561 189.877 350.48 193.745 347.275 192.242C344.103 190.757 341.017 189.261 337.619 190.112C336.372 192.988 335.958 196.393 335.986 199.744C337.26 198.822 339.142 197.718 341.504 197.095C345.207 196.124 346.327 198.336 342.259 198.749C339.674 199.012 337.5 199.957 336.016 200.791ZM340.522 194.844C340.266 193.644 342.893 193.3 343.331 194.273C343.695 195.103 340.772 196.045 340.522 194.844ZM362.995 201.49C363.242 200.835 365 201.579 364.84 202.395C364.62 203.486 362.754 202.144 362.995 201.49ZM350.587 205.7C351.868 205.188 353.869 208.372 352.472 209.101C351.076 209.83 349.541 206.12 350.587 205.7Z" fill="#FF8000"/>
                                            <path d="M339.338 214.37C341.268 211.143 343.176 207.899 345.202 204.73C346.146 203.254 347.135 201.808 348.161 200.389C348.006 200.358 347.852 200.313 347.701 200.281C347.447 200.227 347.19 200.178 346.933 200.133C346.34 200.03 345.742 199.944 345.144 199.883C344.58 199.826 344.015 199.796 343.449 199.789C342.86 199.781 342.216 199.761 341.638 199.884C341.565 199.899 341.554 199.785 341.623 199.788C342.225 199.812 342.843 199.733 343.448 199.724C344.034 199.716 344.621 199.731 345.206 199.766C345.756 199.799 346.304 199.853 346.848 199.937C347.149 199.983 347.45 200.036 347.748 200.095C347.926 200.131 348.114 200.156 348.29 200.21C349.336 198.772 350.421 197.363 351.543 195.983C348.158 194.428 344.677 193.147 340.977 192.611C340.914 192.602 340.938 192.506 341 192.516C344.687 193.105 348.384 194.058 351.72 195.767C352.337 195.01 352.958 194.256 353.582 193.505C354.28 192.666 355.027 191.846 355.658 190.954C355.7 190.896 355.785 190.96 355.737 191.011C354.86 191.946 354.068 192.979 353.287 194.01C353.293 194.012 353.299 194.009 353.305 194.013C354.699 194.945 355.98 196.057 357.233 197.168C358.517 198.307 359.771 199.483 360.988 200.692C361.033 200.737 360.966 200.808 360.921 200.763C359.717 199.567 358.469 198.426 357.164 197.341C355.86 196.257 354.488 195.262 353.176 194.189C353.169 194.184 353.171 194.175 353.166 194.17C352.866 194.566 352.568 194.962 352.267 195.352C352.115 195.548 351.965 195.747 351.813 195.945C351.806 195.963 351.794 195.974 351.78 195.987C351.278 196.641 350.778 197.296 350.282 197.954C350.889 198.768 351.339 199.73 351.773 200.645C352.206 201.556 352.582 202.497 352.929 203.443C353.647 205.403 354.129 207.447 354.539 209.49C354.552 209.552 354.457 209.58 354.446 209.518C354.059 207.484 353.421 205.522 352.688 203.59C352.313 202.602 351.886 201.64 351.446 200.681C351.045 199.808 350.56 198.969 350.184 198.086C349.751 198.662 349.32 199.239 348.896 199.822C348.773 199.991 348.655 200.164 348.533 200.334C348.552 200.372 348.54 200.421 348.491 200.423C348.485 200.424 348.478 200.422 348.471 200.423C347.144 202.274 345.882 204.169 344.655 206.087C344.739 206.21 344.774 206.362 344.823 206.506C344.902 206.739 344.976 206.974 345.045 207.209C345.182 207.683 345.294 208.161 345.382 208.646C345.464 209.101 345.529 209.56 345.574 210.02C345.624 210.528 345.576 211.088 345.69 211.583C345.707 211.661 345.582 211.666 345.595 211.585C345.671 211.124 345.553 210.587 345.488 210.128C345.418 209.629 345.325 209.134 345.21 208.644C345.106 208.2 344.987 207.759 344.855 207.323C344.789 207.104 344.719 206.886 344.643 206.671C344.604 206.558 344.548 206.437 344.509 206.315C343.934 207.216 343.365 208.12 342.805 209.03C341.694 210.835 340.593 212.645 339.484 214.451C339.427 214.541 339.282 214.463 339.338 214.37Z" fill="#263238"/>
                                            <path d="M369.107 239.154C369.156 237.324 369.446 235.483 369.643 233.664C369.841 231.837 370.049 230.011 370.244 228.183C370.62 224.661 370.83 221.061 371.659 217.607C372.371 214.637 373.68 211.792 375.961 209.698C377.115 208.639 378.583 207.771 380.181 207.684C381.815 207.596 383.321 208.161 384.661 209.065C386.186 210.095 387.363 211.555 388.428 213.035C389.527 214.562 390.498 216.138 391.366 217.806C391.398 217.869 391.299 217.908 391.266 217.848C389.662 215.069 387.453 212.671 384.91 210.726C383.739 209.83 382.395 209.158 380.903 209.056C379.424 208.955 378.105 209.661 377.018 210.606C374.885 212.46 373.651 215.187 372.915 217.866C372.044 221.04 371.762 224.381 371.327 227.635C371.068 229.571 370.821 231.507 370.566 233.442C370.312 235.367 370.151 237.342 369.742 239.24C369.655 239.65 369.095 239.564 369.107 239.154Z" fill="#263238"/>
                                            <path class="theme-color" d="M378.104 224.95C378.631 225.687 379.305 226.357 380.094 226.982C379.793 225.197 379.429 222.025 380.33 220.337C381.729 217.715 383.386 219.023 382.552 221.302C381.35 224.557 381.193 226.755 381.205 227.765C382.979 228.932 385.118 229.875 387.281 230.631C387.089 229.754 386.968 228.665 387.08 227.504C387.359 224.701 389.506 224.753 388.948 227.67C388.703 228.931 388.651 230.143 388.654 231.094C393.55 232.629 398.122 233.23 398.122 233.23C399.945 230.802 401.224 228.469 402.041 226.253C399.76 225.681 395.14 225.551 395.238 223.921C395.37 221.727 399.845 223.417 402.462 225.008C403.107 222.907 403.333 220.925 403.253 219.105C402.231 218.77 400.341 218.354 396.961 218.062C392.262 217.657 392.493 214.993 395.898 215.054C398.411 215.1 401.587 216.638 403.093 217.437C402.113 211.047 397.238 206.951 393.33 206.795C386.759 206.53 389.123 214.707 389.123 214.707C389.123 214.707 384.672 211.574 380.47 211.657C376.277 211.747 373.611 218.699 378.104 224.95ZM395.654 213.129C395.507 212.209 398.44 211.988 398.592 213.169C398.768 214.494 395.803 214.066 395.654 213.129ZM400.372 222.722C400.312 222.121 401.578 222.016 401.864 222.773C402.055 223.266 400.422 223.316 400.372 222.722ZM384.594 223.282C385.585 223.421 386.147 226.963 384.443 226.893C383.143 226.838 383.754 223.162 384.594 223.282Z" fill="#FF8000"/>
                                            <path d="M385.965 227.214C386.128 226.773 386.274 226.325 386.413 225.875C386.286 226.331 386.172 226.788 386.087 227.247C386.07 227.338 385.932 227.302 385.965 227.214Z" fill="#263238"/>
                                            <path d="M387.699 221.523C388.008 220.615 388.353 219.718 388.706 218.827C388.894 218.352 389.089 217.879 389.298 217.412C389.473 217.018 389.62 216.57 389.883 216.226C389.682 215.85 389.494 215.468 389.352 215.08C389.338 215.042 389.386 215.014 389.412 215.045C389.913 215.63 390.301 216.366 390.692 217.03C390.875 217.339 391.048 217.655 391.227 217.967C391.596 217.989 391.972 218.072 392.333 218.139C392.727 218.211 393.119 218.291 393.51 218.379C393.901 218.468 394.292 218.558 394.681 218.651C395.068 218.744 395.453 218.873 395.846 218.932C395.937 218.946 395.9 219.089 395.813 219.054C395.424 218.897 394.993 218.823 394.583 218.735C394.206 218.653 393.829 218.587 393.446 218.532C393.065 218.477 392.681 218.43 392.298 218.391C392.011 218.363 391.719 218.348 391.429 218.321C391.586 218.596 391.749 218.869 391.901 219.147C391.925 219.191 391.947 219.236 391.97 219.28C392.286 219.254 392.603 219.336 392.914 219.391C393.254 219.452 393.592 219.516 393.929 219.591C394.615 219.743 395.297 219.905 395.974 220.094C397.396 220.491 398.801 220.944 400.203 221.403C400.281 221.429 400.231 221.547 400.154 221.52C398.763 221.045 397.341 220.665 395.907 220.342C395.234 220.19 394.563 220.036 393.888 219.896C393.55 219.826 393.213 219.751 392.875 219.68C392.614 219.625 392.342 219.594 392.09 219.507C392.813 220.843 393.494 222.2 394.12 223.584C395.482 226.6 396.629 229.706 397.798 232.799C397.827 232.876 397.708 232.927 397.681 232.85C396.589 229.758 395.209 226.782 393.766 223.841C393.504 223.306 393.234 222.775 392.968 222.242C392.946 222.35 392.92 222.458 392.899 222.568C392.831 222.934 392.766 223.299 392.705 223.665C392.581 224.398 392.456 225.131 392.347 225.866C392.125 227.353 391.766 228.924 391.817 230.433C391.82 230.528 391.676 230.522 391.69 230.433C391.808 229.704 391.808 228.945 391.854 228.209C391.902 227.44 391.958 226.671 392.047 225.906C392.133 225.168 392.228 224.43 392.35 223.697C392.411 223.331 392.475 222.965 392.542 222.599C392.591 222.333 392.603 222.032 392.749 221.804C392.364 221.032 391.982 220.258 391.593 219.489C391.228 218.766 390.858 218.046 390.483 217.329C390.324 217.027 390.152 216.72 389.984 216.412C389.888 216.791 389.694 217.158 389.548 217.518C389.379 217.933 389.21 218.347 389.04 218.761C388.663 219.678 388.313 220.604 387.962 221.53C387.466 222.845 386.917 224.191 386.508 225.559C386.91 224.215 387.25 222.848 387.699 221.523Z" fill="#263238"/>
                                            <path d="M386.413 225.876C386.443 225.769 386.476 225.664 386.508 225.558C386.477 225.664 386.446 225.77 386.413 225.876Z" fill="#263238"/>
                                            <path d="M358.12 241.232L359.771 288.074H385.781L387.433 241.232H358.12Z" fill="#37474F"/>
                                            <path d="M358.12 241.232L358.365 248.205L387.218 247.32L387.433 241.232H358.12Z" fill="#263238"/>
                                            <path d="M356.437 245.187H389.114V237.278H356.437V245.187Z" fill="#37474F"/>
                                            <path d="M375.095 242.227H338.895V288.074H375.095V242.227Z" fill="#DBDBDB"/>
                                            <path d="M375.951 247.568H338.039V248.205H375.951V247.568Z" fill="#C7C7C7"/>
                                            <path d="M375.951 249.099H338.039V249.735H375.951V249.099Z" fill="#C7C7C7"/>
                                            <path d="M375.951 250.63H338.039V251.267H375.951V250.63Z" fill="#C7C7C7"/>
                                            <path d="M375.951 279.025H338.039V279.661H375.951V279.025Z" fill="#C7C7C7"/>
                                            <path d="M375.951 280.555H338.039V281.192H375.951V280.555Z" fill="#C7C7C7"/>
                                            <path d="M375.951 282.086H338.039V282.723H375.951V282.086Z" fill="#C7C7C7"/>
                                            <path d="M364.703 260.163C357.3 260.163 350.583 255.336 346.25 251.285C341.579 246.918 338.598 242.488 338.568 242.444L339.22 242.008C339.336 242.182 350.994 259.379 364.703 259.379C368.159 259.379 370.8 258.285 372.552 256.128C376.526 251.233 374.73 242.396 374.711 242.307L375.478 242.146C375.557 242.522 377.371 251.433 373.162 256.62C371.254 258.971 368.408 260.163 364.703 260.163Z" fill="#263238"/>
                                            <path class="theme-color" d="M348.188 242.227H366.888C366.888 242.227 366.433 243.856 364.446 244.539C362.459 245.223 362.588 250.999 358.729 250.999C354.87 250.999 353.046 245.451 352.134 244.474C351.222 243.497 348.188 242.227 348.188 242.227Z" fill="#FF8000"/>
                                            <path d="M123.373 242.227H87.1729V288.074H123.373V242.227Z" fill="#DBDBDB"/>
                                            <path d="M124.23 247.568H86.3174V248.205H124.23V247.568Z" fill="#C7C7C7"/>
                                            <path d="M124.23 249.099H86.3174V249.735H124.23V249.099Z" fill="#C7C7C7"/>
                                            <path d="M124.23 250.63H86.3174V251.267H124.23V250.63Z" fill="#C7C7C7"/>
                                            <path d="M124.23 279.025H86.3174V279.661H124.23V279.025Z" fill="#C7C7C7"/>
                                            <path d="M124.23 280.555H86.3174V281.192H124.23V280.555Z" fill="#C7C7C7"/>
                                            <path d="M124.23 282.086H86.3174V282.723H124.23V282.086Z" fill="#C7C7C7"/>
                                            <path d="M112.981 260.163C105.578 260.163 98.8609 255.336 94.5283 251.285C89.8573 246.918 86.8763 242.488 86.8467 242.444L87.4985 242.008C87.614 242.182 99.2727 259.379 112.981 259.379C116.437 259.379 119.079 258.285 120.83 256.128C124.805 251.233 123.008 242.396 122.989 242.307L123.756 242.146C123.836 242.522 125.649 251.433 121.44 256.62C119.532 258.971 116.686 260.163 112.981 260.163Z" fill="#263238"/>
                                            <path d="M260.475 288.337L260.791 285.256L163.287 275.258L162.971 278.34L260.475 288.337Z" fill="#263238"/>
                                            <path d="M164.961 276.707L157.315 275.923L158.764 261.835L148.674 260.801L148.059 266.804L148.638 266.863L149.193 261.439L158.126 262.354L156.677 276.443L164.901 277.286L164.961 276.707Z" fill="#C7C7C7"/>
                                            <path d="M174.285 280.107L174.719 275.87L162.135 274.581L161.701 278.818L174.285 280.107Z" fill="#455A64"/>
                                            <path class="theme-color" d="M152.274 288.283L154.825 263.404L143.863 262.28L141.312 287.159L152.274 288.283Z" fill="#FF8000"/>
                                            <path opacity="0.3" d="M152.274 288.283L154.825 263.404L143.863 262.28L141.312 287.159L152.274 288.283Z" fill="#111111"/>
                                            <path class="theme-color" d="M142.201 281.33C143.789 281.876 146.185 276.284 146.159 271.159C146.15 269.574 145.819 268.678 146.678 268.143C147.539 267.606 149.198 267.729 148.884 266.588C148.57 265.448 147.045 265.703 146.716 264.872C146.388 264.041 146.465 263.932 145.967 263.527C145.47 263.122 144.356 262.667 143.903 263.09C143.451 263.512 143.494 265.914 143.291 267.443C143.09 268.973 141.391 281.05 142.201 281.33Z" fill="#FF8000"/>
                                            <path class="theme-color" d="M122.849 246.478C122.849 246.478 125.016 253.706 127.591 261.091C130.165 268.475 132.452 285.434 131.973 285.873C131.494 286.313 125.778 269.823 124.129 262.289C122.48 254.756 121.297 247.026 121.297 247.026L122.849 246.478Z" fill="#FF8000"/>
                                            <path d="M122.885 246.296L124.605 251.206L121.87 251.87L121.046 246.812L122.885 246.296Z" fill="#DBDBDB"/>
                                            <path d="M122.884 246.296C123.178 245.256 123.223 244.02 122.235 242.606C121.041 240.899 121.389 239.573 121.389 239.573C121.389 239.573 118.313 243.515 121.046 246.812L122.884 246.296Z" fill="#455A64"/>
                                            <path class="theme-color" d="M121.418 239.375C121.573 239.625 121.256 240.864 121.832 241.834C122.374 242.748 119.582 244.253 119.813 242.795C120.077 241.139 121.132 238.917 121.418 239.375Z" fill="#FF8000"/>
                                            <path d="M136.335 250.709C136.335 250.709 134.24 256.56 131.804 262.522C129.367 268.483 126.754 282.331 127.129 282.713C127.504 283.096 132.917 269.781 134.599 263.657C136.28 257.533 137.588 251.227 137.588 251.227L136.335 250.709Z" fill="#A6A6A6"/>
                                            <path d="M136.313 250.558L134.686 254.522L136.906 255.187L137.802 251.062L136.313 250.558Z" fill="#DBDBDB"/>
                                            <path d="M136.313 250.558C136.549 247.295 139.139 244.638 139.139 244.638C139.139 244.638 140.193 248.468 137.804 251.062L136.313 250.558Z" fill="#455A64"/>
                                            <path d="M129.889 243.036C129.889 243.036 130.716 249.196 131.853 255.534C132.991 261.873 132.655 275.961 132.209 276.257C131.763 276.553 129.249 262.401 128.883 256.061C128.517 249.72 128.556 243.28 128.556 243.28L129.889 243.036Z" fill="#37474F"/>
                                            <path d="M129.942 242.892L130.706 247.109L128.395 247.295L128.38 243.074L129.942 242.892Z" fill="#DBDBDB"/>
                                            <path d="M128.38 243.074C128.38 243.074 129.86 242.926 129.942 242.892C130.024 242.858 131.132 238.615 131.039 238.496C130.947 238.377 126.058 239.062 126.084 239.524C126.111 239.986 128.38 243.074 128.38 243.074Z" fill="#455A64"/>
                                            <path d="M134.856 288.074H122.806C121.372 288.074 120.211 286.912 120.211 285.479V268.962C120.211 267.529 121.373 266.367 122.806 266.367H134.856C136.289 266.367 137.451 267.529 137.451 268.962V285.479C137.451 286.912 136.289 288.074 134.856 288.074Z" fill="#455A64"/>
                                            <path d="M135.275 262.94H122.386V266.367H135.275V262.94Z" fill="#455A64"/>
                                            <path d="M123.177 266.292C126.172 266.146 133.507 266.137 134.498 266.301C134.52 266.305 134.52 266.342 134.498 266.345C133.507 266.509 126.668 266.716 123.177 266.355C123.137 266.351 123.136 266.294 123.177 266.292Z" fill="#263238"/>
                                            <path d="M223.861 287.99C225.379 288.502 270.01 288.379 271.667 287.316C271.861 287.208 272.255 272.432 272.255 272.432C272.197 272.224 272.911 270.784 274.003 268.782C277.06 263.16 283.054 253.078 283.054 253.078L256.397 245.667L246.01 267.7L243.364 273.321C243.364 273.321 237.336 275.835 232.084 278.325C232.077 278.332 232.07 278.332 232.07 278.339C228.834 279.866 226.022 281.263 225.37 281.775C223.693 283.126 222.343 287.493 223.861 287.99Z" fill="#AD6359"/>
                                            <path d="M223.861 287.99C225.379 288.502 270.01 288.379 271.667 287.316C271.861 287.208 272.255 272.432 272.255 272.432C272.197 272.224 272.911 270.784 274.003 268.782L246.01 267.7L243.364 273.321C243.364 273.321 237.336 275.835 232.084 278.325C232.077 278.332 232.07 278.332 232.07 278.339C228.834 279.866 226.022 281.263 225.37 281.775C223.693 283.126 222.343 287.493 223.861 287.99Z" fill="#3A2D57"/>
                                            <path class="theme-color" d="M223.677 288.161C225.241 288.675 269.928 288.437 271.627 287.351C272.274 286.942 272.907 280.048 272.254 272.433L243.444 272.62C243.444 272.62 226.931 280.367 225.196 281.759C223.471 283.15 222.114 287.647 223.677 288.161Z" fill="#FF8000"/>
                                            <path opacity="0.1" d="M271.625 287.349C271.005 287.744 264.661 288.03 256.775 288.207L271.548 272.438L271.554 272.432L272.254 272.433C272.906 280.049 272.272 286.944 271.625 287.349Z" fill="#111111"/>
                                            <path d="M224.309 286.371C231.799 286.147 262.03 285.95 269.451 286.298C269.511 286.301 269.511 286.342 269.451 286.345C262.031 286.729 231.8 286.68 224.309 286.493C224.151 286.49 224.151 286.375 224.309 286.371Z" fill="#263238"/>
                                            <path d="M228.062 280.136C229.838 280.054 231.579 280.889 232.554 281.942C233.49 282.953 234.294 284.379 234.249 285.932C234.248 285.977 234.166 285.979 234.158 285.932C233.715 283.003 231.035 280.442 228.062 280.23C228.003 280.226 228.002 280.139 228.062 280.136Z" fill="#263238"/>
                                            <path d="M241.098 273.384C244.097 273.327 247.578 274.366 249.454 276.809C249.527 276.903 249.391 277.005 249.302 276.96C246.584 275.577 244.002 274.55 241.049 273.753C240.841 273.698 240.884 273.389 241.098 273.384Z" fill="#263238"/>
                                            <path d="M238.789 274.299C241.787 274.242 245.268 275.282 247.145 277.724C247.218 277.818 247.082 277.92 246.992 277.875C244.275 276.492 241.692 275.465 238.738 274.669C238.531 274.613 238.574 274.304 238.789 274.299Z" fill="#263238"/>
                                            <path d="M236.479 275.214C239.477 275.157 242.959 276.197 244.835 278.639C244.908 278.733 244.772 278.835 244.683 278.79C241.965 277.407 239.383 276.38 236.429 275.584C236.221 275.528 236.265 275.219 236.479 275.214Z" fill="#263238"/>
                                            <path d="M234.169 276.129C237.167 276.071 240.649 277.111 242.525 279.553C242.598 279.648 242.462 279.75 242.373 279.704C239.655 278.322 237.073 277.294 234.119 276.498C233.911 276.442 233.954 276.133 234.169 276.129Z" fill="#263238"/>
                                            <path d="M267.504 279.194C270.868 279.185 270.886 284.413 267.517 284.422C264.153 284.43 264.134 279.202 267.504 279.194Z" fill="#263238"/>
                                            <path d="M238.078 269.795C239.707 271.874 242.18 273.175 244.322 274.64C244.544 274.792 244.797 274.61 244.86 274.395C244.909 274.398 244.957 274.373 244.953 274.309C244.771 271.725 243.714 268.764 242.187 266.656C241.245 265.354 239.326 264.135 237.815 265.402C236.386 266.599 237.127 268.581 238.078 269.795ZM237.926 267.311C238.207 264.048 241.163 266.538 241.82 267.525C242.242 268.159 242.594 268.856 242.926 269.541C243.62 270.977 244.095 272.484 244.639 273.975C243.63 273.191 242.564 272.5 241.528 271.754C240.293 270.864 237.771 269.111 237.926 267.311Z" fill="#263238"/>
                                            <path d="M255.591 272.34C255.346 270.384 253.11 269.972 251.533 270.284C248.98 270.79 246.19 272.241 244.299 274.01C244.253 274.054 244.271 274.105 244.309 274.136C244.209 274.337 244.27 274.642 244.537 274.682C247.104 275.066 249.801 275.795 252.409 275.38C253.931 275.138 255.822 274.19 255.591 272.34ZM248.547 274.469C247.28 274.31 246.029 274.091 244.756 273.979C246.168 273.256 247.543 272.476 249.028 271.896C249.737 271.619 250.47 271.348 251.21 271.171C252.363 270.894 256.224 271.081 254.209 273.664C253.099 275.088 250.058 274.657 248.547 274.469Z" fill="#263238"/>
                                            <path d="M276.011 268.449L244.493 264.395C244.493 264.395 258.915 233.963 267.895 217.423C272.887 208.227 287.093 207.463 294.252 218.185C303.817 232.511 311.29 245.967 315.568 253.425L322.707 253.875L321.431 265.549L297.871 271.385C288.825 272.675 282.096 256.67 281.954 256.946C280.853 259.093 276.011 268.449 276.011 268.449Z" fill="#37474F"/>
                                            <path d="M281.789 257.022C282.642 255.172 283.295 253.215 284.046 251.322C284.773 249.491 285.505 247.663 286.226 245.83C287.685 242.125 289.199 238.438 290.61 234.716C291.402 232.626 292.126 230.513 292.862 228.403C292.88 228.352 292.958 228.373 292.943 228.425C292.382 230.416 291.794 232.399 291.177 234.373C291.345 234.031 291.512 233.689 291.689 233.356C292.173 232.443 292.673 231.54 293.176 230.637C293.196 230.602 293.247 230.633 293.23 230.669C292.768 231.574 292.306 232.478 291.825 233.374C291.587 233.82 291.324 234.261 291.07 234.706C289.33 240.233 287.34 245.679 284.918 250.948C283.965 253.02 282.84 255.009 281.886 257.078C281.856 257.144 281.759 257.087 281.789 257.022Z" fill="#263238"/>
                                            <path d="M275.184 262.881C276.646 260.511 280.093 253.356 281.33 250.882C283.832 245.877 286.109 240.776 288.255 235.61C289.467 232.691 290.596 229.748 291.713 226.792C291.721 226.772 291.753 226.78 291.746 226.801C290.086 232.118 288.082 237.335 285.897 242.457C283.708 247.586 276.585 261.429 275.281 262.938C275.234 262.993 275.146 262.944 275.184 262.881Z" fill="#263238"/>
                                            <path d="M293.969 230.65C296.784 235.422 299.658 240.16 302.484 244.925C303.913 247.333 305.341 249.742 306.755 252.159C307.42 253.296 308.067 254.447 308.756 255.57C309.408 256.633 310.178 257.507 311.297 258.089C312.528 258.73 313.935 259.018 315.266 259.376C316.804 259.788 318.332 260.235 319.877 260.622C319.947 260.64 319.917 260.747 319.846 260.73C318.469 260.395 317.081 260.111 315.698 259.803C314.442 259.523 313.152 259.292 311.932 258.877C310.827 258.502 309.865 257.928 309.113 257.023C308.307 256.053 307.723 254.909 307.096 253.821C304.269 248.918 301.47 243.999 298.689 239.069C297.108 236.267 295.541 233.456 293.944 230.664C293.935 230.648 293.96 230.634 293.969 230.65Z" fill="#263238"/>
                                            <path d="M276.626 264.026C274.737 263.726 272.805 263.605 270.902 263.404C268.994 263.202 267.085 263 265.177 262.794C261.37 262.383 248.403 260.615 247.42 260.314C247.358 260.295 247.377 260.195 247.438 260.191C248.362 260.141 256.849 261.078 258.753 261.315C262.561 261.788 266.346 262.376 270.143 262.929C271.228 263.087 272.308 263.268 273.391 263.435C274.472 263.602 275.554 263.81 276.642 263.924C276.708 263.931 276.692 264.036 276.626 264.026Z" fill="#263238"/>
                                            <path d="M257.409 293.962C257.943 292.452 285.617 257.437 287.47 256.79C287.683 256.704 299.54 265.523 299.54 265.523C300.023 266.196 323.005 261.841 323.005 261.841L322.655 289.448L280.993 287.688C280.993 287.688 275.294 290.88 270.088 293.468C270.08 293.469 270.075 293.474 270.071 293.47C266.867 295.074 264.032 296.422 263.227 296.614C261.131 297.105 256.865 295.464 257.409 293.962Z" fill="#AD6359"/>
                                            <path d="M263.226 296.614C264.034 296.425 266.865 295.076 270.068 293.469C270.075 293.476 270.081 293.469 270.088 293.469C275.291 290.881 280.991 287.686 280.991 287.686L290.263 288.08L305.277 264.951C302.078 265.449 299.694 265.737 299.539 265.522C299.539 265.522 287.687 256.704 287.472 256.792C285.619 257.437 257.947 292.451 257.41 293.961C256.866 295.464 261.13 297.108 263.226 296.614Z" fill="#3A2D57"/>
                                            <path class="theme-color" d="M257.162 294.004C257.724 292.457 285.519 257.465 287.422 256.8C288.143 256.544 293.955 260.305 299.54 265.523L281.594 288.062C281.594 288.062 265.3 296.26 263.134 296.765C260.975 297.263 256.6 295.551 257.162 294.004Z" fill="#FF8000"/>
                                            <path d="M258.96 294.614C263.764 288.863 282.595 265.212 286.906 259.162C286.941 259.113 286.909 259.087 286.869 259.133C281.983 264.729 263.345 288.531 258.864 294.538C258.77 294.665 258.859 294.736 258.96 294.614Z" fill="#263238"/>
                                            <path d="M266.182 295.514C267.344 294.168 267.763 292.283 267.537 290.867C267.32 289.506 266.696 287.993 265.447 287.068C265.411 287.041 265.359 287.105 265.391 287.139C267.42 289.298 267.778 292.987 266.108 295.455C266.075 295.506 266.142 295.56 266.182 295.514Z" fill="#263238"/>
                                            <path d="M279.544 289.434C281.442 287.112 282.775 283.732 282.014 280.748C281.984 280.633 281.821 280.676 281.801 280.774C281.209 283.766 280.422 286.431 279.223 289.245C279.138 289.443 279.408 289.6 279.544 289.434Z" fill="#263238"/>
                                            <path d="M277.398 290.685C279.296 288.363 280.629 284.983 279.868 281.999C279.838 281.883 279.674 281.927 279.655 282.025C279.063 285.016 278.275 287.681 277.077 290.496C276.992 290.695 277.262 290.852 277.398 290.685Z" fill="#263238"/>
                                            <path d="M275.252 291.937C277.15 289.614 278.483 286.235 277.722 283.251C277.692 283.135 277.528 283.179 277.509 283.277C276.917 286.268 276.13 288.934 274.931 291.748C274.846 291.946 275.116 292.103 275.252 291.937Z" fill="#263238"/>
                                            <path d="M273.106 293.187C275.003 290.866 276.337 287.485 275.576 284.501C275.546 284.386 275.382 284.43 275.363 284.527C274.771 287.519 273.984 290.184 272.785 292.998C272.7 293.197 272.97 293.354 273.106 293.187Z" fill="#263238"/>
                                            <path d="M291.29 265.082C293.375 262.442 289.276 259.198 287.187 261.842C285.103 264.482 289.202 267.727 291.29 265.082Z" fill="#263238"/>
                                            <path d="M283.793 296.948C285.723 296.542 285.949 294.28 285.508 292.734C284.794 290.231 283.118 287.57 281.199 285.832C281.152 285.789 281.101 285.811 281.074 285.852C280.866 285.768 280.566 285.855 280.549 286.123C280.377 288.713 279.873 291.461 280.501 294.026C280.868 295.524 281.969 297.331 283.793 296.948ZM281.092 290.103C281.145 288.828 281.261 287.562 281.267 286.284C282.104 287.633 282.995 288.938 283.696 290.371C284.03 291.054 284.36 291.762 284.598 292.486C284.968 293.612 285.1 297.475 282.361 295.68C280.849 294.691 281.029 291.624 281.092 290.103Z" fill="#263238"/>
                                            <path d="M284.963 279.308C283.025 281.103 281.932 283.674 280.648 285.929C280.515 286.163 280.717 286.4 280.937 286.445C280.937 286.495 280.967 286.541 281.03 286.531C283.59 286.138 286.454 284.841 288.429 283.146C289.649 282.099 290.706 280.086 289.32 278.685C288.008 277.359 286.094 278.26 284.963 279.308ZM287.425 278.952C290.701 278.963 288.462 282.114 287.533 282.85C286.936 283.323 286.27 283.732 285.614 284.118C284.241 284.927 282.778 285.526 281.337 286.191C282.035 285.121 282.636 284.001 283.294 282.907C284.079 281.603 285.619 278.945 287.425 278.952Z" fill="#263238"/>
                                            <path d="M309.443 255.176C309.443 255.176 345.01 249.584 356.756 252.466C373.138 256.487 375.445 276.007 363.072 283.735C347.395 293.526 292.154 289.507 292.154 289.507L306.957 263.226C306.957 263.226 329.952 258.403 350.689 259.607L309.042 265.713L309.443 255.176Z" fill="#37474F"/>
                                            <path d="M305.929 264.996C305.948 264.961 305.954 264.893 305.963 264.855C305.973 264.816 305.982 264.778 305.992 264.74C306.014 264.65 306.037 264.561 306.062 264.473C306.114 264.287 306.178 264.112 306.247 263.933C306.315 263.754 306.388 263.581 306.467 263.408C306.548 263.23 306.654 263.087 306.756 262.924C306.766 262.907 306.783 262.904 306.796 262.893C306.804 262.886 306.813 262.88 306.823 262.874C306.836 262.868 306.846 262.86 306.86 262.858C306.873 262.853 306.883 262.844 306.898 262.842C309.426 262.379 326.582 260.044 329.131 259.778C331.702 259.51 334.278 259.301 336.855 259.117C341.992 258.751 347.155 258.624 352.3 258.829C352.782 258.848 353.263 258.88 353.745 258.909C353.847 258.873 353.957 258.855 354.064 258.829C354.312 258.769 354.559 258.707 354.81 258.659C355.276 258.571 355.746 258.506 356.214 258.437C357.192 258.294 358.171 258.201 359.144 258.021C359.203 258.01 359.224 258.109 359.165 258.122C358.186 258.339 357.222 258.63 356.242 258.843C355.959 258.905 355.677 258.965 355.393 259.022C357.278 259.171 359.159 259.37 361.039 259.598C361.098 259.605 361.098 259.706 361.037 259.701C358.477 259.481 355.896 259.406 353.328 259.4C350.777 259.395 348.228 259.403 345.679 259.51C340.524 259.727 335.368 260.128 330.227 260.611C327.343 260.882 309.848 263.318 306.955 263.391C306.942 263.391 306.932 263.385 306.919 263.384C306.894 263.456 306.869 263.529 306.835 263.599C306.753 263.77 306.669 263.94 306.58 264.107C306.493 264.268 306.409 264.428 306.312 264.581C306.263 264.657 306.215 264.733 306.165 264.809C306.141 264.846 306.116 264.884 306.091 264.922C306.071 264.954 306.025 265.002 306.014 265.04C305.991 265.11 305.892 265.06 305.929 264.996Z" fill="#263238"/>
                                            <path d="M300.023 287.713C300.898 286.201 301.652 284.584 302.456 283.023C303.264 281.457 304.072 279.891 304.882 278.327C306.499 275.206 312.284 264.718 312.85 263.988C312.886 263.941 312.956 263.996 312.937 264.051C312.658 264.866 309.038 271.815 308.206 273.364C306.541 276.462 304.798 279.495 303.077 282.553C302.586 283.426 302.078 284.287 301.58 285.155C301.082 286.021 300.554 286.874 300.095 287.767C300.067 287.82 299.992 287.766 300.023 287.713Z" fill="#263238"/>
                                            <path d="M313.85 266.808C315.377 266.439 316.938 266.21 318.479 265.923C320.023 265.635 321.568 265.349 323.114 265.067C326.206 264.503 329.301 263.964 332.4 263.456C338.582 262.445 344.785 261.627 351.015 261.101C354.532 260.804 358.055 260.634 361.577 260.423C361.651 260.419 361.647 260.55 361.571 260.552C355.302 260.73 349.03 261.534 342.81 262.384C336.649 263.226 330.502 264.164 324.361 265.172C322.628 265.456 320.895 265.746 319.163 266.039C317.404 266.337 315.642 266.712 313.873 266.922C313.807 266.929 313.782 266.825 313.85 266.808Z" fill="#263238"/>
                                            <path d="M327.17 192.715C327.17 192.715 325.569 189.589 323.137 189.607C320.705 189.625 320.261 191.369 318.772 191.506C317.284 191.644 314.201 190.841 312.525 192.377C310.848 193.913 311.171 197.404 310.384 198.362C309.597 199.32 307.213 199.248 306.488 201.756C305.645 204.668 307.126 206.595 306.944 208.123C306.64 210.665 304.952 212.589 305.966 215.691C307.057 219.028 309.501 219.187 311.024 220.381C312.485 221.527 312.563 224.953 315.992 225.499C319.421 226.045 320.495 223.625 322.575 222.911C324.654 222.198 327.447 224.019 329.719 222.541C331.992 221.064 331.477 218.592 332.164 217.381C332.85 216.169 334.588 216.283 335.416 214.119C336.244 211.954 334.666 209.787 334.593 208.9C334.467 207.384 335.414 206.654 335.249 204.497C335.084 202.339 332.937 200.642 332.537 199.951C331.576 198.291 332.862 195.126 331.231 193.542C329.16 191.53 327.17 192.715 327.17 192.715Z" fill="#263238"/>
                                            <path d="M311.495 194.103C311.22 195.587 311.161 197.425 309.672 198.256C307.273 199.268 305.527 201.074 305.876 203.824C305.968 204.796 306.349 205.717 306.656 206.712C306.798 207.21 306.936 207.758 306.833 208.338C306.7 208.899 306.493 209.331 306.324 209.818C305.974 210.765 305.683 211.731 305.583 212.727C305.459 213.721 305.586 214.741 305.967 215.689C305.466 214.796 305.268 213.742 305.301 212.707C305.337 211.181 305.942 209.68 306.327 208.251C306.406 206.765 305.386 205.436 305.29 203.888C304.989 201.748 306.136 199.481 308.103 198.566C308.562 198.319 309.054 198.131 309.497 197.925C310.908 197.208 311.043 195.484 311.495 194.103Z" fill="#263238"/>
                                            <path d="M327.838 223.128C330.685 222.831 331.645 221.875 332.042 219.044C332.145 218.573 332.208 218.035 332.498 217.59C333.181 216.799 334.26 216.38 334.855 215.564C335.698 214.457 335.884 212.81 335.446 211.466C335.248 210.748 334.949 210.052 334.699 209.338C335.072 209.997 335.422 210.664 335.721 211.371C336.309 212.795 336.229 214.632 335.299 215.909C334.807 216.556 334.142 217.013 333.541 217.443C333.237 217.667 332.958 217.854 332.869 218.117C332.085 221.328 331.76 223.296 327.838 223.128Z" fill="#263238"/>
                                            <path d="M316.008 223.601C306.105 233.223 294.422 243.201 288.746 242.57C284.328 242.078 274.369 237.461 265.207 230.063C263.463 228.655 276.353 216.616 277.71 217.42C281.319 219.557 291.402 226.398 292.115 226.094C293.054 225.696 304.296 220.173 311.926 216.817C322.196 212.301 321.128 218.625 316.008 223.601Z" fill="#AD6359"/>
                                            <path d="M267.516 231.906C265.772 231.14 258.088 226.93 256.213 225.28C254.337 223.63 249.282 218.491 250.4 216.925C251.518 215.36 253.117 216.747 253.117 216.747C253.117 216.747 251.326 214.239 252.595 212.766C253.864 211.293 256.282 213.531 256.282 213.531C256.282 213.531 254.631 210.821 256.002 209.443C257.372 208.064 259.426 210.722 259.426 210.722C259.426 210.722 257.801 208.314 259.408 207.654C261.341 206.86 263.836 211.636 266.044 213.302C266.545 213.681 276.752 220.248 276.752 220.248L267.516 231.906Z" fill="#AD6359"/>
                                            <path d="M259.246 210.498C261.089 214.007 262.502 215.223 265.88 217.175C265.946 217.213 265.904 217.32 265.831 217.286C262.349 215.676 260.357 214.406 259.071 210.579C259.009 210.392 259.158 210.331 259.246 210.498Z" fill="#263238"/>
                                            <path d="M256.142 213.25C258.375 216.727 259.896 218.059 263.283 220.364C263.331 220.397 263.28 220.481 263.229 220.452C259.717 218.47 257.758 217.157 255.984 213.391C255.904 213.22 256.04 213.091 256.142 213.25Z" fill="#263238"/>
                                            <path d="M253.294 216.859C255.698 220.068 257.303 221.601 260.878 223.417C260.963 223.459 260.909 223.587 260.82 223.552C256.994 222.056 254.977 220.157 253.204 216.942C253.084 216.722 253.143 216.657 253.294 216.859Z" fill="#263238"/>
                                            <path d="M279.465 220.366C279.465 220.366 277.554 215.782 276.271 213.954C274.988 212.126 267.696 207.072 266.516 208.585C264.992 210.538 268.626 214.284 270.645 215.887C270.645 215.887 267.115 220.401 269.141 223.654C271.168 226.908 279.465 220.366 279.465 220.366Z" fill="#AD6359"/>
                                            <path d="M266.274 209.259C266.168 212.043 268.955 213.975 270.798 215.676C270.939 215.805 270.884 215.964 270.763 216.051C269.41 218.043 268.08 221.245 268.988 223.619C269.015 223.688 268.92 223.735 268.884 223.669C267.564 221.256 268.614 218.002 270.236 215.916C268.319 214.201 265.608 212.141 266.247 209.256C266.251 209.24 266.274 209.241 266.274 209.259Z" fill="#263238"/>
                                            <path d="M280.865 218.772L267.886 233.834C267.886 233.834 283.639 243.613 289.757 243.13C295.875 242.646 310.138 231.023 317.07 222.798C324.161 214.385 317.577 213.799 312.188 216.468C306.799 219.137 292.455 225.631 292.053 225.609C291.652 225.589 280.865 218.772 280.865 218.772Z" fill="#DBDBDB"/>
                                            <path d="M278.394 228.167C279.259 227.123 280.129 226.081 281.005 225.047C281.877 224.018 282.723 222.939 283.668 221.973C283.71 221.929 283.793 221.979 283.757 222.033C283.028 223.114 282.173 224.13 281.368 225.157C280.514 226.247 279.652 227.332 278.786 228.414C277.074 230.556 275.284 232.624 273.457 234.669C273.412 234.72 273.346 234.654 273.384 234.603C275.006 232.42 276.656 230.266 278.394 228.167Z" fill="#263238"/>
                                            <path opacity="0.1" d="M317.072 222.802C310.138 231.024 295.879 242.645 289.754 243.13C286.746 243.366 281.402 241.118 276.748 238.773L317.853 215.077C320.561 215.275 321.563 217.461 317.072 222.802Z" fill="#111111"/>
                                            <path d="M301.435 240.607L298.198 251.434C298.198 251.434 299.589 251.617 304.186 252.183L304.607 252.228L334.615 255.413C334.615 255.413 329.162 226.245 324.365 219.691C320.553 214.483 315.413 214.259 311.789 217.19C310.872 217.932 301.81 228.426 299.95 233.17C298.868 235.93 301.435 240.607 301.435 240.607Z" fill="#DBDBDB"/>
                                            <path d="M310.975 239.601C309.635 239.549 308.281 239.553 306.932 239.748C306.26 239.845 305.595 239.98 304.927 240.131C304.594 240.207 304.262 240.27 303.929 240.33C303.586 240.392 303.221 240.441 302.882 240.398C302.851 240.395 302.842 240.451 302.872 240.457C303.198 240.524 303.51 240.587 303.845 240.598C304.163 240.609 304.487 240.578 304.806 240.535C305.487 240.445 306.167 240.315 306.847 240.216C308.221 240.017 309.594 239.817 310.968 239.739C311.031 239.736 311.038 239.604 310.975 239.601Z" fill="#263238"/>
                                            <path d="M313.975 241.608C312.921 241.289 311.833 241.028 310.747 240.862C310.2 240.779 309.651 240.736 309.097 240.71C308.833 240.698 308.567 240.692 308.302 240.689C308.01 240.686 307.715 240.733 307.424 240.725C307.393 240.724 307.383 240.782 307.414 240.784C307.688 240.802 307.957 240.876 308.229 240.913C308.502 240.951 308.775 240.986 309.048 241.023C309.594 241.098 310.139 241.181 310.686 241.249C311.782 241.386 312.87 241.536 313.958 241.72C314.016 241.73 314.029 241.624 313.975 241.608Z" fill="#263238"/>
                                            <path d="M319.971 217.001C319.733 217.63 316.074 221.43 313.127 220.895C312.167 220.719 312.892 215.439 312.892 215.439L312.857 215.036L312.362 209.408L319.332 206.144L320.332 205.722C320.332 205.722 320.366 207.271 320.388 209.201C320.39 209.29 320.391 209.38 320.392 209.476C320.396 209.585 320.401 209.688 320.4 209.79C320.407 210.078 320.413 210.372 320.413 210.665C320.414 210.889 320.416 211.106 320.408 211.34C320.407 211.575 320.4 211.804 320.398 212.039C320.331 214.357 320.068 216.733 319.971 217.001Z" fill="#AD6359"/>
                                            <path d="M320.389 209.2C318.243 213.342 314.532 214.652 312.856 215.036L312.362 209.408L319.332 206.144L320.332 205.722C320.332 205.722 320.366 207.271 320.389 209.2Z" fill="#263238"/>
                                            <path d="M308.548 197.106C303.188 205.449 307.581 209.602 309.381 210.755C311.015 211.803 316.713 215.161 322.907 207.416C329.099 199.671 326.915 194.541 323.303 191.948C319.692 189.355 313.907 188.762 308.548 197.106Z" fill="#AD6359"/>
                                            <path d="M310.799 196.473C311.012 196.576 311.226 196.635 311.447 196.716C311.697 196.807 311.887 196.904 312.156 196.838C312.3 196.803 312.41 196.614 312.389 196.471C312.339 196.137 312.061 195.95 311.765 195.828C311.444 195.696 311.162 195.677 310.831 195.777C310.509 195.875 310.518 196.336 310.799 196.473Z" fill="#263238"/>
                                            <path d="M316.675 199.996C316.491 199.846 316.347 199.678 316.181 199.511C315.993 199.323 315.824 199.193 315.771 198.921C315.742 198.775 315.866 198.595 316.005 198.554C316.33 198.458 316.616 198.631 316.852 198.848C317.106 199.083 317.243 199.33 317.292 199.673C317.339 200.006 316.917 200.193 316.675 199.996Z" fill="#263238"/>
                                            <path d="M314.409 200.852C314.428 200.833 314.434 200.909 314.416 200.931C314.001 201.473 313.616 202.164 313.986 202.708C313.997 202.724 313.976 202.751 313.96 202.735C313.408 202.21 313.928 201.298 314.409 200.852Z" fill="#263238"/>
                                            <path d="M315.319 200.628C316.259 201.2 315.046 203.039 314.175 202.509C313.318 201.988 314.53 200.149 315.319 200.628Z" fill="#263238"/>
                                            <path d="M315.616 200.963C315.708 201.173 315.744 201.46 315.925 201.607C316.135 201.777 316.431 201.696 316.7 201.608C316.728 201.598 316.733 201.625 316.717 201.65C316.49 202.006 316.116 202.278 315.704 202.081C315.328 201.902 315.286 201.426 315.431 201.014C315.458 200.938 315.579 200.878 315.616 200.963Z" fill="#263238"/>
                                            <path d="M311.241 198.434C311.25 198.409 311.178 198.434 311.164 198.458C310.829 199.053 310.346 199.679 309.701 199.553C309.681 199.549 309.665 199.579 309.686 199.589C310.386 199.887 311.019 199.051 311.241 198.434Z" fill="#263238"/>
                                            <path d="M311.087 197.508C310.191 196.869 308.979 198.708 309.809 199.301C310.626 199.884 311.839 198.044 311.087 197.508Z" fill="#263238"/>
                                            <path d="M310.624 197.377C310.415 197.378 310.154 197.461 309.973 197.358C309.763 197.238 309.746 196.941 309.743 196.666C309.742 196.637 309.718 196.643 309.701 196.667C309.459 197.012 309.334 197.455 309.628 197.745C309.895 198.009 310.32 197.857 310.635 197.562C310.693 197.507 310.708 197.375 310.624 197.377Z" fill="#263238"/>
                                            <path d="M311.146 205.568C310.925 205.628 310.676 205.742 310.45 205.64C310.232 205.542 310.041 205.314 309.891 205.134C309.877 205.116 309.846 205.126 309.849 205.15C309.877 205.465 310.123 205.79 310.426 205.894C310.723 205.997 310.986 205.838 311.188 205.627C311.216 205.598 311.178 205.559 311.146 205.568Z" fill="#263238"/>
                                            <path d="M310.051 201.959C310.051 201.959 309.387 202.745 309.131 203.151C309.107 203.189 309.194 203.27 309.327 203.365C309.332 203.371 309.334 203.377 309.342 203.376C309.989 203.941 310.869 204.15 311.675 203.84C311.728 203.818 311.703 203.743 311.65 203.745C310.866 203.8 310.209 203.528 309.566 203.136C309.608 203.005 310.747 201.827 310.686 201.781C310.476 201.622 309.943 201.497 309.631 201.408C310.965 199.729 312.558 198.278 313.862 196.587C313.907 196.526 313.827 196.448 313.772 196.494C311.995 197.896 310.417 199.794 308.995 201.492C308.815 201.702 309.845 201.925 310.051 201.959Z" fill="#263238"/>
                                            <path d="M309.463 203.24C309.463 203.24 309.474 204.025 309.861 204.584C310.003 204.79 310.19 204.966 310.448 205.063C310.976 205.266 311.28 204.866 311.449 204.459C311.589 204.125 311.634 203.782 311.634 203.782C311.634 203.782 310.549 203.923 309.463 203.24Z" fill="#263238"/>
                                            <path d="M309.861 204.584C310.004 204.79 310.19 204.966 310.448 205.063C310.976 205.266 311.28 204.866 311.449 204.459C310.938 204.166 310.235 204.15 309.861 204.584Z" fill="#FF9CBD"/>
                                            <path d="M321.77 207.549C320.046 206.852 321.696 202.931 321.696 202.931C321.696 202.931 315.484 197.931 318.027 192.018C318.027 192.018 314.859 194.922 310.363 194.524C310.363 194.524 314.029 188.532 319.551 190.058C319.551 190.058 326.804 191.235 327.518 197.912C328.232 204.588 322.927 208.017 321.77 207.549Z" fill="#263238"/>
                                            <path d="M318.234 191.592C317.665 192.393 317.3 193.337 317.114 194.314C316.927 195.29 316.921 196.316 317.147 197.294C317.184 197.543 317.285 197.775 317.351 198.016L317.463 198.375C317.51 198.49 317.562 198.604 317.615 198.717C317.723 198.943 317.821 199.173 317.937 199.393C318.067 199.606 318.201 199.816 318.337 200.023C318.406 200.126 318.47 200.233 318.542 200.333L318.779 200.619L319.253 201.188C319.603 201.535 319.97 201.864 320.338 202.184C320.04 201.791 319.709 201.437 319.42 201.048L319.006 200.453L318.8 200.158C318.738 200.055 318.685 199.947 318.627 199.842C318.515 199.63 318.401 199.42 318.282 199.213C318.181 198.998 318.097 198.774 318.004 198.556L317.866 198.227L317.765 197.886C317.706 197.657 317.612 197.436 317.581 197.2C317.357 196.276 317.35 195.314 317.45 194.366C317.503 193.891 317.601 193.421 317.734 192.957C317.857 192.49 318.029 192.036 318.234 191.592Z" fill="#263238"/>
                                            <path d="M320.8 206.55C320.8 206.55 324.157 204.818 325.04 206.156C325.924 207.493 322.394 210.706 320.649 210.481C318.904 210.256 319.08 208.637 319.08 208.637L320.8 206.55Z" fill="#AD6359"/>
                                            <path d="M324.006 207.052C324.031 207.062 324.018 207.097 323.993 207.094C322.751 206.97 321.714 207.636 320.818 208.421C321.322 208.202 321.845 208.213 322.162 208.842C322.179 208.875 322.132 208.903 322.106 208.883C321.734 208.572 321.393 208.486 320.934 208.673C320.609 208.805 320.313 209.033 320.025 209.232C319.929 209.298 319.789 209.163 319.88 209.076C319.886 209.069 319.894 209.063 319.901 209.057C320.561 207.737 322.536 206.445 324.006 207.052Z" fill="#263238"/>
                                            <path d="M312.688 216.49C312.688 216.49 305.298 226.571 305.441 227.189C305.584 227.808 311.418 228.838 312.2 228.592C312.983 228.345 319.972 217.001 319.972 217.001L312.688 216.49Z" fill="#AD6359"/>
                                            <path d="M253.904 237.569C250.078 232.467 248.638 226.126 249.584 218.548L256.962 159.415C257.012 159.013 257.194 158.688 257.513 158.44C257.83 158.194 258.189 158.094 258.594 158.145L272.743 159.91C273.145 159.96 273.469 160.145 273.717 160.462C273.964 160.78 274.062 161.14 274.012 161.542L266.424 222.368C266.102 224.948 266.485 227.124 267.574 228.897C268.662 230.672 270.255 231.688 272.351 231.95C274.447 232.211 276.22 231.615 277.672 230.157C279.122 228.701 280.009 226.683 280.331 224.103L287.919 163.277C287.97 162.875 288.152 162.55 288.47 162.303C288.787 162.056 289.147 161.957 289.552 162.007L303.7 163.772C304.101 163.822 304.426 164.007 304.674 164.324C304.921 164.642 305.019 165.002 304.969 165.404L297.592 224.536C296.646 232.115 293.692 237.908 288.731 241.914C283.768 245.92 277.7 247.476 270.525 246.581C263.27 245.676 257.729 242.673 253.904 237.569Z" fill="#111111"/>
                                            <path d="M319.578 227.521C308.075 228.462 290.362 226.734 286.953 224.42C283.933 222.371 280.548 207.549 279.521 201.161C279.137 198.77 295.688 195.056 296.048 197.62C296.479 200.695 297.997 212.378 298.705 212.789C299.481 213.24 312.274 217.364 320.784 220.746C328.498 223.811 323.93 227.165 319.578 227.521Z" fill="#AD6359"/>
                                            <path d="M290.938 189.412C291.563 190.265 292.015 189.943 292.079 188.065C292.147 186.166 290.8 178.702 293.451 178.455C296.11 178.202 297.843 188.796 297.497 191.914C297.159 195.034 295.5 199.956 295.5 199.956C294.748 197.963 292.464 193.303 290.938 189.412Z" fill="#AD6359"/>
                                            <path d="M280.479 204.071C278.386 198.306 275.668 191.192 277.065 184.564C277.339 183.264 278.148 182.654 278.148 182.654C278.722 179.672 280.301 179.048 280.301 179.048C281.685 176.434 283.39 176.017 283.39 176.017C283.39 176.017 284.101 172.524 286.283 172.604C288.732 172.686 287.253 177.575 288.085 180.762C289.99 188.062 294.741 197.906 295.499 199.956L280.479 204.071Z" fill="#AD6359"/>
                                            <path d="M284.706 189.815C284.188 187.655 283.623 185.547 283.4 183.329C283.156 180.895 283.329 178.511 283.445 176.081C283.448 176.005 283.344 175.992 283.328 176.067C282.422 180.434 282.991 185.694 284.609 189.839C284.648 189.94 284.732 189.924 284.706 189.815Z" fill="#263238"/>
                                            <path d="M280.467 191.605C280.079 189.476 279.423 185.73 280.373 179.057C280.376 179.035 280.34 179.023 280.334 179.047C279.14 183.296 279.224 187.398 280.366 191.624C280.401 191.755 280.492 191.747 280.467 191.605Z" fill="#263238"/>
                                            <path d="M278.171 192.525C277.65 188.879 277.783 186.515 278.162 182.67C278.164 182.648 278.127 182.639 278.122 182.663C277.232 186.986 277.4 188.656 278.048 192.56C278.071 192.694 278.192 192.667 278.171 192.525Z" fill="#263238"/>
                                            <path d="M278.021 203.88L296.964 200.514L299.511 212.089C305.875 214.715 318.144 219.029 322.501 221.246C327.613 223.846 325.761 227.199 319.959 227.887C306.687 229.46 288.449 226.873 285.697 224.979C281.754 222.266 278.021 203.88 278.021 203.88Z" fill="#DBDBDB"/>
                                            <path d="M280.701 208.008C282.077 208.014 287.692 207.096 289.088 206.852C290.456 206.614 294.432 205.526 295.866 205.27C295.944 205.257 295.947 205.141 295.868 205.154C294.445 205.382 282.011 207.473 280.692 207.934C280.646 207.95 280.657 208.008 280.701 208.008Z" fill="#263238"/>
                                            <path d="M281.866 217.707C282.418 219.198 283.017 220.674 283.748 222.079C284.397 223.234 285.033 224.59 286.332 225.085C289.465 226.234 292.864 226.567 296.194 226.969C299.347 227.327 302.514 227.586 305.684 227.815C308.463 228.037 312.389 228.27 315.202 228.467C312.019 228.513 308.836 228.418 305.655 228.283C300.885 228.035 296.105 227.689 291.391 226.867C289.628 226.554 287.83 226.181 286.171 225.443C284.803 224.862 284.134 223.437 283.524 222.189C282.859 220.735 282.312 219.235 281.866 217.707Z" fill="#263238"/>
                                            <path d="M311.916 228.429C312.631 228.499 313.341 228.72 314.041 228.863C313.31 228.915 312.59 228.696 311.916 228.429Z" fill="#263238"/>
                                            <path d="M317.999 219.353C313.04 217.516 308.035 215.803 303.108 213.872C302.454 213.599 300.964 213.047 300.342 212.756C300.019 212.583 299.31 212.414 299.233 211.964C298.27 208.213 297.602 204.329 296.944 200.518L296.969 200.535L296.418 200.614L296.961 200.493C297.015 200.458 298.741 208.224 298.766 208.24C299.007 209.265 299.383 211.031 299.675 211.951C305.27 214.478 312.407 216.849 317.999 219.353Z" fill="#263238"/>
                                            <path d="M317.52 218.656C316.799 218.669 316.066 218.532 315.352 218.472C316.074 218.335 316.817 218.469 317.52 218.656Z" fill="#263238"/>
                                            <path d="M38.2558 222.02C38.2558 222.02 22.7853 241.7 22.7729 241.715C19.6099 245.896 16.9115 249.618 15.6956 251.674C15.6873 251.684 15.6796 251.694 15.6767 251.708C15.2169 252.483 14.9727 253.014 15.0083 253.232C15.0101 253.25 15.0071 253.264 15.013 253.278C15.6198 255.062 48.2969 281.312 49.7444 281.844C51.1932 282.384 52.8221 278.291 52.3664 276.261C51.9013 274.222 43.8902 258.581 43.8902 258.581L58.4588 238.294L38.2558 222.02Z" fill="#EB9481"/>
                                            <path d="M49.7453 281.845C48.2972 281.315 15.6189 255.063 15.0116 253.274C15.0039 253.265 15.0092 253.253 15.0062 253.232C14.9713 253.017 15.2154 252.484 15.677 251.709C15.6782 251.692 15.6876 251.684 15.6965 251.676C16.9083 249.618 19.6067 245.895 22.7726 241.716C22.7773 241.712 23.5328 240.747 24.7149 239.25L45.8097 255.9L43.8881 258.579C43.8881 258.579 51.8992 274.222 52.3643 276.258C52.8253 278.291 51.1929 282.382 49.7453 281.845Z" fill="#DBDBDB"/>
                                            <path class="theme-color" d="M49.7444 281.844C48.2938 281.312 15.6197 255.064 15.0118 253.275C14.7688 252.599 18.3157 247.615 22.7746 241.716C22.822 241.655 22.8688 241.594 22.9162 241.532L44.1852 258.23L43.8895 258.582C43.8895 258.582 51.9024 274.222 52.3646 276.261C52.8196 278.288 51.1913 282.382 49.7444 281.844Z" fill="#FF8000"/>
                                            <path opacity="0.3" d="M49.7444 281.844C48.2938 281.312 15.6197 255.064 15.0118 253.275C14.7688 252.599 18.3157 247.615 22.7746 241.716C22.822 241.655 22.8688 241.594 22.9162 241.532L44.1852 258.23L43.8895 258.582C43.8895 258.582 51.9024 274.222 52.3646 276.261C52.8196 278.288 51.1913 282.382 49.7444 281.844Z" fill="#111111"/>
                                            <path d="M50.3931 280.28C44.9939 275.721 22.7863 257.839 17.1027 253.742C17.0565 253.709 17.0322 253.739 17.0749 253.777C22.3277 258.414 44.6793 276.114 50.3208 280.371C50.4393 280.461 50.5068 280.377 50.3931 280.28Z" fill="#263238"/>
                                            <path d="M45.611 260.068C43.7688 257.923 40.8506 256.126 37.9537 256.34C37.8411 256.348 37.8548 256.507 37.943 256.542C40.6231 257.586 42.9671 258.757 45.3823 260.335C45.5524 260.447 45.7426 260.222 45.611 260.068Z" fill="#263238"/>
                                            <path d="M46.4177 262.268C44.5755 260.123 41.6573 258.326 38.7603 258.54C38.6478 258.548 38.6614 258.707 38.7497 258.742C41.4297 259.786 43.7738 260.957 46.1895 262.535C46.359 262.646 46.5492 262.422 46.4177 262.268Z" fill="#263238"/>
                                            <path d="M47.2251 264.468C45.3829 262.322 42.4641 260.525 39.5677 260.739C39.4558 260.748 39.4688 260.907 39.5571 260.941C42.2371 261.985 44.5812 263.157 46.9963 264.735C47.1664 264.846 47.3566 264.622 47.2251 264.468Z" fill="#263238"/>
                                            <path d="M22.7471 240.48L44.7159 258.144C44.7159 258.144 82.9207 211.548 84.1455 205.625C85.5373 198.891 89.4113 146.144 89.3219 143.516C89.2134 140.328 85.7021 126.318 85.7021 126.318H60.6622C60.6622 126.318 57.1597 195.296 56.4303 197.432C55.6446 199.73 22.7471 240.48 22.7471 240.48Z" fill="#263238"/>
                                            <path d="M46.6892 252.917C43.4611 249.801 30.8703 239.801 29.3048 238.982C29.2705 238.964 29.2219 239.024 29.2473 239.054C30.3856 240.405 41.0992 249.203 46.6068 253.019C46.6655 253.059 46.7407 252.966 46.6892 252.917Z" fill="#37474F"/>
                                            <path d="M86.9401 136.688C86.6059 136.543 86.2587 136.547 85.9221 136.45C85.5678 136.347 85.2152 136.222 84.8662 136.047C84.2073 135.715 83.5431 135.265 82.9369 134.68C82.3112 134.077 81.8639 133.239 81.4538 132.295C81.2358 131.792 80.2136 129.105 80.2042 129.086C80.1745 129.023 80.0993 129.06 80.1117 129.126C80.1816 129.497 80.8832 131.817 81.0906 132.397C81.4805 133.489 81.9581 134.472 82.6377 135.168C83.3019 135.848 84.0361 136.315 84.775 136.608C85.1554 136.758 85.5411 136.87 85.9227 136.915C86.2676 136.956 86.6533 137.017 86.9691 136.855C87.0242 136.827 86.9875 136.709 86.9401 136.688Z" fill="#37474F"/>
                                            <path d="M64.7918 127.54L64.265 141.393L63.6671 155.243L62.3345 182.937C62.0833 187.552 61.8374 192.165 61.5453 196.781C61.5133 197.352 61.4659 197.941 61.4096 198.537C61.4048 198.606 61.4025 198.681 61.3551 198.802C61.3183 198.882 61.2828 198.959 61.2443 199.024C61.169 199.16 61.0902 199.284 61.0102 199.409C60.8502 199.657 60.6849 199.897 60.5178 200.135C59.8471 201.085 59.1514 202.008 58.4517 202.929C57.0533 204.772 55.6146 206.581 54.1777 208.391C51.298 212.007 48.3946 215.602 45.4728 219.183L31.8652 237.026L45.2547 219.008C48.1238 215.386 50.9934 211.764 53.8281 208.116C55.2466 206.293 56.6521 204.46 58.0464 202.622C58.7408 201.701 59.4323 200.776 60.0906 199.836C60.2541 199.6 60.4159 199.364 60.5682 199.126C60.7045 198.884 60.9024 198.649 60.8893 198.447C60.9367 197.891 60.9806 197.329 61.0108 196.746C61.284 192.137 61.5121 187.521 61.7444 182.907L63.2056 155.221L63.9699 141.379L64.7918 127.54Z" fill="#37474F"/>
                                            <path d="M84.6459 201.95C84.4616 203.649 84.2957 204.913 84.147 205.626C83.4585 208.951 67.8339 230.005 58.4588 241.553L56.8057 193.959C57.9516 179.609 60.6589 126.317 60.6589 126.317H73.1389L84.6459 201.95Z" fill="#37474F"/>
                                            <path d="M68.6328 249.619C68.6328 249.619 73.475 274.18 73.478 274.199C74.5872 279.322 75.6514 283.795 76.4181 286.057C76.4205 286.069 76.4229 286.082 76.4312 286.094C76.7197 286.948 76.9632 287.48 77.1517 287.595C77.1665 287.605 77.1748 287.617 77.1884 287.621C78.937 288.323 120.144 280.651 121.49 279.899C122.844 279.153 120.802 275.249 118.965 274.271C117.116 273.296 100.032 269.176 100.032 269.176L94.142 244.904L68.6328 249.619Z" fill="#EB9481"/>
                                            <path d="M121.493 279.899C120.147 280.653 78.9384 288.325 77.1863 287.62C77.1744 287.62 77.1685 287.608 77.1501 287.596C76.9647 287.482 76.7194 286.95 76.4326 286.095C76.4207 286.083 76.4207 286.071 76.4207 286.059C75.6492 283.798 74.5851 279.325 73.4788 274.201C73.4788 274.195 73.2394 272.992 72.875 271.121L99.2511 265.974L100.03 269.178C100.03 269.178 117.115 273.298 118.964 274.273C120.806 275.246 122.845 279.152 121.493 279.899Z" fill="#DBDBDB"/>
                                            <path class="theme-color" d="M121.492 279.899C120.144 280.652 78.9406 288.325 77.1873 287.619C76.5166 287.363 75.0482 281.424 73.4804 274.198C73.465 274.122 73.449 274.047 73.4336 273.971L99.9608 268.724L100.034 269.177C100.034 269.177 117.119 273.294 118.966 274.273C120.8 275.25 122.843 279.153 121.492 279.899Z" fill="#FF8000"/>
                                            <path opacity="0.3" d="M121.492 279.899C120.144 280.652 78.9406 288.325 77.1873 287.619C76.5166 287.363 75.0482 281.424 73.4804 274.198C73.465 274.122 73.449 274.047 73.4336 273.971L99.9608 268.724L100.034 269.177C100.034 269.177 117.119 273.294 118.966 274.273C120.8 275.25 122.843 279.153 121.492 279.899Z" fill="#111111"/>
                                            <path d="M120.729 278.388C113.752 279.511 85.7153 284.698 78.9035 286.338C78.8478 286.351 78.8549 286.39 78.9118 286.382C85.8516 285.42 113.845 280.006 120.75 278.502C120.896 278.471 120.876 278.365 120.729 278.388Z" fill="#263238"/>
                                            <path d="M102.283 268.842C99.4552 268.841 96.1903 269.883 94.4648 272.219C94.3979 272.31 94.5276 272.403 94.6106 272.359C97.149 271.007 99.5654 269.992 102.337 269.189C102.532 269.133 102.486 268.842 102.283 268.842Z" fill="#263238"/>
                                            <path d="M104.478 269.663C101.649 269.662 98.3846 270.704 96.6592 273.04C96.5922 273.131 96.722 273.224 96.8049 273.18C99.3433 271.828 101.76 270.813 104.531 270.01C104.727 269.954 104.68 269.663 104.478 269.663Z" fill="#263238"/>
                                            <path d="M106.672 270.485C103.843 270.484 100.579 271.526 98.8525 273.862C98.7856 273.953 98.9153 274.046 98.9989 274.002C101.537 272.65 103.954 271.635 106.725 270.832C106.92 270.775 106.874 270.485 106.672 270.485Z" fill="#263238"/>
                                            <path d="M82.633 278.56C81.2156 275.472 76.4155 277.67 77.8346 280.762C79.252 283.85 84.0527 281.652 82.633 278.56Z" fill="#263238"/>
                                            <path d="M80.7183 126.318C80.7183 126.318 80.06 137.023 77.1044 144.65C77.1044 144.65 72.8417 147.306 72.3973 147.726L100.648 268.381L72.6575 273.505C72.6575 273.505 61.5326 211.7 60.6616 207.907C59.2662 201.812 48.2219 149.997 47.7319 147.053C46.7074 140.894 52.3928 126.317 52.3928 126.317L80.7183 126.318Z" fill="#263238"/>
                                            <path d="M96.6196 262.588C89.4659 263.66 75.7867 266.56 74.1033 267.256C74.066 267.271 74.0814 267.346 74.1217 267.345C75.9437 267.317 92.607 264.01 96.6463 262.717C96.7162 262.694 96.6925 262.577 96.6196 262.588Z" fill="#37474F"/>
                                            <path d="M55.593 136.692C56.1138 136.576 56.6691 136.613 57.1988 136.545C57.7558 136.474 58.3074 136.38 58.8502 136.234C59.8729 135.959 60.8932 135.564 61.8081 135.027C62.7526 134.473 63.3908 133.665 63.9578 132.746C64.26 132.256 65.6448 129.624 65.6578 129.606C65.6993 129.545 65.8231 129.589 65.8089 129.656C65.7307 130.026 64.8253 132.314 64.548 132.883C64.026 133.954 63.354 134.907 62.3319 135.55C61.3335 136.178 60.2023 136.584 59.0487 136.812C58.4544 136.93 57.8476 137.007 57.242 137.017C56.6945 137.027 56.0836 137.052 55.5634 136.859C55.471 136.825 55.5195 136.708 55.593 136.692Z" fill="#37474F"/>
                                            <path d="M77.7231 144.362C75.3512 145.155 73.0586 146.289 70.8651 147.481C70.7792 147.528 70.8343 147.661 70.9273 147.622C73.237 146.655 75.5911 145.731 77.8445 144.638C78.0217 144.552 77.905 144.301 77.7231 144.362Z" fill="#37474F"/>
                                            <path d="M78.5968 128.583C78.5914 128.504 78.4516 128.485 78.4516 128.571C78.4457 131.303 78.2495 133.704 77.9965 136.254C77.8792 137.438 76.8666 143.979 74.8158 143.483C74.4727 143.4 74.2997 143.059 74.2505 142.54C74.1913 141.916 74.433 141.153 74.5415 140.534C74.782 139.165 74.9776 137.792 75.1079 136.408C75.3509 133.825 75.3852 131.24 75.0949 128.66C75.0854 128.575 74.9628 128.58 74.9622 128.666C74.9325 132.245 74.8069 135.816 74.2399 139.355C73.9673 141.056 73.0862 143.613 74.865 143.891C76.6776 144.175 77.8899 139.89 78.1222 138.717C78.7692 135.443 78.8261 131.903 78.5968 128.583Z" fill="#37474F"/>
                                            <path d="M74.8695 143.659C74.6798 144.097 74.5264 144.553 74.3948 145.012C74.2929 145.368 74.1555 145.753 74.1928 146.126C74.1999 146.198 74.2959 146.206 74.335 146.157C74.5785 145.854 74.6846 145.437 74.8221 145.076C74.982 144.658 75.1515 144.242 75.2991 143.819C75.3974 143.539 74.9862 143.389 74.8695 143.659Z" fill="#37474F"/>
                                            <path d="M54.5252 126.318C53.8153 129.032 53.1451 131.757 52.5325 134.493C51.9269 137.23 51.345 139.979 51.0025 142.753L50.906 143.794C50.8763 144.14 50.8864 144.485 50.874 144.829L51.1815 146.888L51.966 151.019L53.6405 159.265L60.5163 192.219L67.3986 225.172L72.3255 247.939L75.697 264.431L72.0417 248L66.9524 225.267L59.9362 192.341C57.662 181.352 55.3672 170.367 53.1955 159.355L51.6004 151.09L50.855 146.945L50.5635 144.839C50.5676 144.124 50.6292 143.419 50.7181 142.719C51.1116 139.929 51.7408 137.191 52.3944 134.462C53.0515 131.733 53.7685 129.02 54.5252 126.318Z" fill="#37474F"/>
                                            <path d="M72.4616 95.7197C77.0052 97.8837 96.8504 100.365 101.625 97.0672C106.35 93.8041 105.946 65.2125 103.474 56.1124C102.606 52.9151 89.987 59.0395 88.6521 61.7243C87.5049 64.0322 89.3749 85.4701 88.4601 85.9394C86.9165 86.731 81.9137 87.3247 73.9376 88.4404C66.4344 89.4898 69.2608 94.1945 72.4616 95.7197Z" fill="#EB9481"/>
                                            <path d="M87.0225 69.8972L105.992 66.3284C105.992 66.3284 108.333 94.6728 102.131 98.753C100.16 100.05 84.4035 99.6815 73.4114 96.7716C69.5332 95.7447 63.9989 89.7471 74.9537 88.0163C85.9091 86.2855 87.9042 85.6705 88.1044 85.3979C88.3047 85.1259 87.0225 69.8972 87.0225 69.8972Z" fill="#455A64"/>
                                            <path d="M104.814 71.4311C103.447 71.5342 102.083 71.8317 100.734 72.0699C99.4038 72.3051 98.0748 72.5492 96.7469 72.8022C94.0686 73.3124 91.3584 73.7621 88.7169 74.4465C88.6546 74.4625 88.6659 74.552 88.7317 74.5461C91.4692 74.2996 94.1948 73.7675 96.8968 73.2703C98.2519 73.0209 99.6047 72.7513 100.953 72.4663C102.252 72.1913 103.581 71.9519 104.842 71.5324C104.902 71.5117 104.87 71.4264 104.814 71.4311Z" fill="#263238"/>
                                            <path opacity="0.1" d="M84.7844 98.8032C80.9093 98.3647 76.9215 97.701 73.4137 96.7708C69.5504 95.7516 64.0457 89.7966 74.8239 88.0427L84.7844 98.8032Z" fill="#111111"/>
                                            <path d="M88.8694 135.005L48.2529 135.863C47.7534 135.261 56.0347 101.224 65.2824 89.1528C67.4362 86.3418 73.5405 86.4586 75.695 88.1888C81.8532 93.134 89.3458 134.474 88.8694 135.005Z" fill="#455A64"/>
                                            <path class="theme-color" d="M122.644 46.5324C122.984 46.7469 123.201 47.0509 123.291 47.4461L125.936 58.9674C126.027 59.3644 125.965 59.7323 125.752 60.0724C125.538 60.4149 125.233 60.6294 124.838 60.7201L109.991 64.1283C109.594 64.2196 109.443 64.4631 109.533 64.8583L124.856 131.609C124.947 132.006 124.885 132.374 124.672 132.714C124.458 133.056 124.153 133.271 123.757 133.361L109.86 136.551C109.463 136.642 109.097 136.582 108.756 136.367C108.414 136.154 108.2 135.85 108.109 135.453L92.7866 68.7021C92.6959 68.3069 92.4518 68.154 92.0566 68.2447L77.8037 71.5161C77.4061 71.6073 77.0388 71.5469 76.6987 71.3318C76.3562 71.1197 76.1417 70.8151 76.0504 70.4175L73.406 58.8963C73.3153 58.501 73.3757 58.1337 73.5902 57.7912C73.803 57.4511 74.1069 57.2348 74.5039 57.1436L121.538 46.347C121.935 46.2575 122.302 46.3197 122.644 46.5324Z" fill="#FF8000"/>
                                            <path d="M63.6072 98.8738C64.9813 104.732 72.1237 127.653 79.7639 129.855C88.5974 132.401 97.5831 132.234 105.277 132.539C108.587 132.67 104.589 114.664 101.613 115.032C96.9183 115.613 89.2811 114.994 87.561 114.765C85.8415 114.536 75.8656 103.081 70.2934 96.781C65.2734 91.1063 62.7972 95.4217 63.6072 98.8738Z" fill="#EB9481"/>
                                            <path d="M122.803 111.272C123.9 112.787 122.745 114.342 122.745 114.342C122.745 114.342 124.144 114.864 124.758 116.161C125.461 117.646 123.44 119.4 123.44 119.4C123.44 119.4 124.747 120.221 125.258 121.657C125.787 123.147 124 125.207 124 125.207C124 125.207 124.797 126.641 124.349 128.198C123.581 130.86 119.513 132.022 116.934 132.787C114.355 133.552 104.502 132.809 103.534 132.067L99.002 116.701C99.002 116.701 106.92 110.296 113.488 109.715C116.168 109.477 121.572 109.571 122.803 111.272Z" fill="#EB9481"/>
                                            <path d="M122.55 114.112C119.619 113.852 116.771 114.474 113.893 114.932C113.829 114.942 113.846 115.042 113.91 115.031C116.767 114.542 119.684 114.626 122.555 114.252C122.634 114.241 122.629 114.118 122.55 114.112Z" fill="#263238"/>
                                            <path d="M123.321 119.201C122.656 119.162 121.981 119.343 121.335 119.478C120.639 119.625 119.946 119.784 119.256 119.954C117.874 120.293 116.499 120.664 115.137 121.075C115.076 121.094 115.089 121.191 115.154 121.175C116.532 120.839 117.915 120.524 119.306 120.246C120.002 120.107 120.699 119.974 121.397 119.846C122.047 119.726 122.742 119.654 123.353 119.393C123.443 119.353 123.421 119.206 123.321 119.201Z" fill="#263238"/>
                                            <path d="M123.942 125.219C123.366 125.162 122.719 125.417 122.167 125.565C121.541 125.733 120.913 125.897 120.284 126.058C119.028 126.38 117.771 126.701 116.505 126.979C116.442 126.993 116.458 127.092 116.522 127.078C117.811 126.803 119.103 126.545 120.389 126.257C121.02 126.116 121.651 125.972 122.281 125.824C122.817 125.699 123.501 125.602 123.96 125.282C123.987 125.264 123.971 125.222 123.942 125.219Z" fill="#263238"/>
                                            <path d="M99.0884 114.77L101.789 133.767C101.789 133.767 84.3983 133.801 78.2395 129.905C72.0801 126.009 65.9871 111.034 63.4054 102.487C60.8232 93.9407 64.3635 87.9502 73.3381 98.745C82.3132 109.539 86.82 113.91 87.5423 114.221C88.2652 114.531 99.0884 114.77 99.0884 114.77Z" fill="#455A64"/>
                                            <path d="M86.6587 132.553C85.1868 132.102 80.3026 131.293 76.905 128.857C74.4098 127.068 69.9273 118.883 66.73 112.059C65.3446 109.101 64.3735 106.229 62.9798 103.415C62.9626 103.38 62.9152 103.403 62.9253 103.439C63.4758 105.375 64.1507 107.279 64.889 109.158C64.8208 109.07 64.7533 108.982 64.6851 108.893C64.1033 108.134 63.4894 107.391 62.9857 106.576C62.9496 106.517 62.8613 106.584 62.9004 106.642C63.4295 107.429 63.8775 108.268 64.3847 109.069C64.63 109.458 64.8747 109.842 65.1503 110.209C65.254 110.348 65.3659 110.497 65.485 110.644C70.0185 120.886 74.2475 127.491 76.8564 129.342C79.3278 131.096 82.3646 132.081 86.6877 132.757C86.763 132.769 86.7345 132.576 86.6587 132.553Z" fill="#263238"/>
                                            <path d="M98.0044 132.991C97.9653 131.521 97.7182 130.046 97.5333 128.589C97.3508 127.153 97.1589 125.717 96.9574 124.283C96.5509 121.389 96.2114 118.465 95.6171 115.602C95.6035 115.535 95.5069 115.542 95.5098 115.613C95.6313 118.558 96.0585 121.502 96.4496 124.421C96.6457 125.885 96.8638 127.347 97.0984 128.805C97.3248 130.209 97.512 131.645 97.8948 133.017C97.9137 133.082 98.0062 133.051 98.0044 132.991Z" fill="#263238"/>
                                            <path d="M99.1775 114.604C97.4846 114.428 90.6284 114.35 88.9361 114.168C88.1462 114.083 87.4974 113.811 86.8978 113.286C86.2655 112.732 76.0716 101.969 74.9612 100.701C74.915 100.648 74.829 100.717 74.8758 100.768C76.0538 102.041 83.8433 110.985 85.0609 112.269C85.6072 112.845 86.1441 113.469 86.7733 113.956C87.3837 114.429 88.0426 114.618 88.8081 114.626C90.437 114.644 96.7901 114.759 99.0139 114.811C99.0572 114.812 99.2047 115.666 99.2444 115.666C99.3048 115.667 99.2817 115.667 99.3345 115.666C99.3671 115.665 99.2545 114.613 99.1775 114.604Z" fill="#263238"/>
                                            <path d="M84.0547 54.4276C85.9431 52.3525 87.7053 48.3553 89.5273 47.3397C91.1716 46.4224 92.3691 47.6093 92.3691 47.6093C92.3691 47.6093 92.5386 45.3073 94.3435 44.6579C95.272 44.3237 96.6217 45.5141 96.6217 45.5141C96.6217 45.5141 96.838 43.6748 98.4782 43.1967C99.7853 42.8157 100.942 44.0653 100.942 44.0653C100.942 44.0653 101.971 42.3979 103.428 42.4364C106.38 42.5153 110.816 53.3278 107.518 56.6324C105.981 58.1724 105.04 55.4722 105.04 55.4722C105.04 55.4722 105.455 59.681 103.249 60.6527C101.043 61.6239 100.034 58.0426 100.034 58.0426C100.034 58.0426 100.399 62.1246 98.0106 62.9014C95.5244 63.7096 95.128 59.9541 95.128 59.9541C95.128 59.9541 94.4839 63.027 92.5196 63.2024C89.2755 63.4927 91.0282 57.4548 89.4894 55.3098L85.033 55.6055L84.0547 54.4276Z" fill="#EB9481"/>
                                            <path d="M86.5719 50.8628C84.6123 52.6712 80.5825 50.9783 78.4601 52.4389C75.5892 54.4144 80.1328 56.6939 85.0324 55.6054L88.6878 54.0921L86.5719 50.8628Z" fill="#EB9481"/>
                                            <path d="M101.199 44.1822C101.182 44.1473 101.227 44.1159 101.251 44.1485C103.576 47.3499 105.15 51.5794 105.155 55.5601C105.155 55.6904 104.944 55.7473 104.916 55.6039C104.126 51.5018 103.098 47.9253 101.199 44.1822Z" fill="#263238"/>
                                            <path d="M96.6221 45.4524C96.6013 45.4122 96.6683 45.3766 96.6973 45.4169C99.0758 48.7286 100.717 53.5411 100.183 58.1297C100.165 58.2873 99.9906 58.41 99.9984 58.2269C100.122 55.1487 98.3481 48.8127 96.6221 45.4524Z" fill="#263238"/>
                                            <path d="M94.9834 60.2758C95.3253 55.856 94.2155 51.7717 92.4728 47.7401C92.4503 47.6874 92.5268 47.6607 92.5576 47.6998C93.9476 49.4395 94.7902 52.1254 95.2696 54.2698C95.7282 56.3247 95.7294 58.2706 95.1375 60.2876C95.1155 60.3658 94.9763 60.3706 94.9834 60.2758Z" fill="#263238"/>
                                            <path d="M74.5623 93.7877C72.6158 94.2339 68.5824 91.9165 67.2154 89.1298C67.123 88.9384 67.4969 86.986 67.8394 84.5916C68.0414 83.1381 68.2322 81.5146 68.2992 80.0208C68.3116 79.7139 77.5664 82.7174 77.5664 82.7174C77.5664 82.7174 76.5046 85.8075 76.4039 88.4129C76.3979 88.6309 76.4104 88.8342 76.4406 89.0285C76.4424 89.0569 76.4495 89.0913 76.4495 89.1304C76.587 90.3042 76.6444 93.3096 74.5623 93.7877Z" fill="#EB9481"/>
                                            <path d="M76.444 89.0285C76.4434 89.0587 76.4494 89.0949 76.4488 89.131C76.1543 89.1577 75.8355 89.16 75.4877 89.1381C69.9783 88.769 68.8329 81.8008 68.6309 80.0386C70.2846 80.352 77.5669 82.7174 77.5669 82.7174C77.5669 82.7174 76.5045 85.8105 76.4025 88.4158C76.4002 88.6321 76.4097 88.8359 76.444 89.0285Z" fill="#263238"/>
                                            <path d="M64.4919 70.1463C64.1601 73.6073 67.7964 82.6713 70.5411 84.299C74.5205 86.6584 80.0809 85.8301 81.8442 81.2652C83.5537 76.8401 78.6066 65.1115 75.6297 63.7303C71.245 61.6973 64.9819 65.0339 64.4919 70.1463Z" fill="#EB9481"/>
                                            <path d="M74.8218 73.9139C74.8076 73.8926 74.7857 73.9619 74.7963 73.9868C75.0577 74.5906 75.255 75.3265 74.7815 75.7484C74.7667 75.7615 74.7809 75.7917 74.8005 75.7804C75.4387 75.4184 75.1661 74.4442 74.8218 73.9139Z" fill="#263238"/>
                                            <path d="M74.023 73.4911C73.0097 73.8058 73.7131 75.8091 74.6516 75.5182C75.576 75.2308 74.8721 73.2275 74.023 73.4911Z" fill="#263238"/>
                                            <path d="M78.4503 72.7543C78.4468 72.7288 78.509 72.7667 78.5173 72.7922C78.7152 73.4197 79.0482 74.1053 79.6816 74.1142C79.7012 74.1142 79.7107 74.1462 79.6887 74.1509C78.97 74.2949 78.5374 73.3806 78.4503 72.7543Z" fill="#263238"/>
                                            <path d="M78.7773 71.9116C79.749 71.4856 80.53 73.4605 79.6299 73.8552C78.7435 74.2433 77.9625 72.2684 78.7773 71.9116Z" fill="#263238"/>
                                            <path d="M72.9106 72.8526C73.1595 72.6879 73.3615 72.4953 73.5908 72.3069C73.8492 72.0948 74.0773 71.9526 74.178 71.6178C74.232 71.4389 74.0992 71.1977 73.9298 71.129C73.5357 70.9684 73.1547 71.1497 72.833 71.3926C72.484 71.6563 72.2819 71.9484 72.1782 72.3727C72.0769 72.7833 72.5823 73.0695 72.9106 72.8526Z" fill="#263238"/>
                                            <path d="M79.1983 70.6307C78.9044 70.6828 78.6253 70.6822 78.3296 70.7036C77.9954 70.7279 77.7323 70.7818 77.4296 70.6088C77.2666 70.5163 77.1973 70.2503 77.2725 70.0832C77.4473 69.6957 77.8485 69.5641 78.249 69.5185C78.6839 69.4687 79.0312 69.5416 79.3991 69.7774C79.7547 70.0061 79.5852 70.5619 79.1983 70.6307Z" fill="#263238"/>
                                            <path d="M76.27 79.8767C76.4697 79.9697 76.6883 80.1178 76.92 80.0574C77.1422 79.9999 77.3614 79.8133 77.5321 79.6669C77.5493 79.6527 77.5765 79.6663 77.57 79.6894C77.4924 79.9839 77.2056 80.2524 76.9005 80.3027C76.6018 80.3519 76.3778 80.1581 76.2196 79.9253C76.1983 79.8927 76.241 79.8631 76.27 79.8767Z" fill="#263238"/>
                                            <path d="M76.2696 77.7889C76.8064 78.206 77.4203 78.321 78.0104 78.2344C78.2741 78.1971 78.5366 78.1148 78.7825 78.0022C78.8323 77.9832 78.8803 77.9607 78.9217 77.9346C78.965 77.9133 79.0041 77.8937 79.0503 77.8659C79.1191 77.8297 79.138 77.7563 79.1262 77.6834L79.1244 77.6786C79.1161 77.6561 79.109 77.6378 79.096 77.617C79.096 77.617 79.0959 77.617 79.0942 77.6123L79.074 77.5584C78.9194 77.076 78.6178 76.3656 78.6178 76.3656C78.8234 76.3917 79.8538 76.4799 79.7519 76.2352C78.9034 74.2117 77.9589 71.9613 76.6873 70.1268C76.6482 70.064 76.5498 70.1167 76.5795 70.1825C77.3183 72.1592 78.3997 73.9931 79.1736 75.9674C78.8512 75.9591 78.3179 75.9224 78.0697 76.0148C78.0086 76.0581 78.677 77.3776 78.7292 77.5998C78.7292 77.5998 78.7327 77.6087 78.7333 77.6241C77.9666 78.0087 77.2763 77.9785 76.3075 77.713C76.2494 77.6935 76.215 77.7527 76.2696 77.7889Z" fill="#263238"/>
                                            <path d="M78.4159 77.8592C78.4159 77.8592 78.1925 78.5797 77.6847 78.9897C77.498 79.1414 77.2782 79.2528 77.0145 79.273C76.473 79.3168 76.3011 78.8659 76.2555 78.4452C76.217 78.0992 76.2685 77.7715 76.2685 77.7715C76.2685 77.7715 77.2308 78.1946 78.4159 77.8592Z" fill="#263238"/>
                                            <path d="M77.685 78.9895C77.4984 79.1412 77.2786 79.2526 77.0149 79.2728C76.4733 79.3166 76.3015 78.8657 76.2559 78.445C76.8063 78.3123 77.4587 78.4882 77.685 78.9895Z" fill="#FF9BBC"/>
                                            <path d="M69.1458 82.388C69.1458 82.388 68.135 82.7014 67.6236 82.1771C67.1117 81.6533 67.0749 79.6766 65.0437 79.4875C64.3392 79.4218 63.8047 79.4437 63.3272 79.0455C62.4384 78.3048 62.628 77.3497 62.1954 76.8111C61.6615 76.1451 60.227 76.5492 59.4342 75.1383C58.3795 73.2624 59.8395 72.0222 59.8519 71.2211C59.8644 70.4206 59.0532 69.597 59.4644 67.974C59.8436 66.4779 61.4542 66.1946 62.1237 65.3692C62.8395 64.4869 61.8772 63.1626 63.1808 61.7411C64.1312 60.7042 66.0504 61.2031 66.7822 60.6284C67.9388 59.72 67.4216 58.4401 69.0196 57.4577C70.8038 56.3603 74.7026 58.4763 75.6003 59.5689C76.6035 60.7901 75.9825 62.0244 76.6213 62.7917C77.5373 63.892 78.6163 63.3511 79.146 64.4502C79.6704 65.5381 79.1727 66.3706 79.4476 67.0876C79.8203 68.0587 80.0734 68.1891 80.3827 69.037C80.7009 69.9104 80.2547 70.782 80.2547 70.782C80.2547 70.782 78.0996 66.6301 75.4374 64.3892C74.5509 63.6432 73.6159 63.2551 73.3285 63.4571C72.9541 63.7202 73.8263 65.1861 73.1715 65.5938C72.5174 66.0015 70.3451 64.9906 69.6074 65.973C68.6238 67.2825 70.0666 69.0992 68.9876 70.3548C67.9092 71.6104 67.0098 71.5292 66.8741 72.3528C66.7052 73.375 67.6965 73.6677 68.4004 75.0945C69.0362 76.3827 68.9349 76.9562 68.9349 76.9562L68.0408 77.5126C68.0408 77.5126 66.4937 77.054 66.1992 77.3639C65.9047 77.6726 69.1458 82.388 69.1458 82.388Z" fill="#263238"/>
                                            <path d="M59.6987 70.1228C60.2575 71.6622 58.5877 73.0659 58.9035 74.5964C59.2502 75.8171 60.2433 76.2739 61.4224 76.46C61.791 76.5471 62.281 76.6478 62.4167 77.0584C62.2022 76.7011 61.7643 76.6916 61.3922 76.6496C60.5982 76.5986 59.707 76.4286 59.1483 75.7851C58.5468 75.1457 58.3217 74.2451 58.6268 73.4268C58.9456 72.3021 59.8937 71.3434 59.6987 70.1228Z" fill="#263238"/>
                                            <path d="M77.1318 63.2549C77.8115 63.422 78.6209 63.2045 79.2229 63.6922C80.1739 64.4737 79.8717 65.4348 79.515 66.4208C79.4486 66.6359 79.3959 66.8551 79.4469 67.0868C79.3141 66.8853 79.3129 66.6199 79.3325 66.3852C79.4001 65.7542 79.6691 65.0183 79.3686 64.4548C79.1873 64.0791 78.865 63.7923 78.4544 63.675C78.0437 63.5506 77.5336 63.5162 77.1318 63.2549Z" fill="#263238"/>
                                            <path d="M68.4553 77.441C68.4553 77.441 65.6556 74.8854 64.4497 75.9502C63.2439 77.015 65.8238 81.0508 67.5736 81.2895C69.3233 81.5283 69.5758 79.9131 69.5758 79.9131L68.4553 77.441Z" fill="#EB9481"/>
                                            <path d="M65.2178 77.0885C65.1911 77.092 65.1947 77.1293 65.219 77.1335C66.4544 77.3379 67.2857 78.254 67.9476 79.2494C67.5168 78.9058 67.0066 78.7795 66.5356 79.3057C66.5113 79.3336 66.5498 79.3733 66.58 79.3596C67.0214 79.1564 67.374 79.1617 67.771 79.4627C68.0519 79.6761 68.2782 79.9747 68.5052 80.2425C68.581 80.332 68.7516 80.2366 68.6871 80.1288C68.6823 80.121 68.677 80.1128 68.6717 80.1045C68.376 78.6545 66.8004 76.8858 65.2178 77.0885Z" fill="#263238"/>
                                            <path d="M26.2852 55.2022C26.2852 62.0471 31.8372 67.5992 38.6822 67.5992C41.4487 67.5992 44.0025 66.692 46.0675 65.1544L52.1404 66.7051L49.6121 61.0499C50.5512 59.3067 51.0786 57.3122 51.0786 55.2022C51.0786 48.3572 45.5265 42.8052 38.6816 42.8052C31.8372 42.8052 26.2852 48.3572 26.2852 55.2022Z" fill="white"/>
                                            <path d="M26.2849 55.2021C26.3021 44.6248 38.6452 38.8168 46.834 45.5207C51.3882 49.1725 52.7996 56.0998 49.9146 61.2128L49.9259 60.9106L52.4264 66.5776L52.6871 67.169C50.4562 66.5989 48.2282 66.0005 46.0051 65.4008L46.2196 65.3582C44.3353 66.7281 42.073 67.5565 39.7645 67.7212C32.6055 68.2995 26.2049 62.3985 26.2849 55.2021ZM26.2849 55.2021C26.3625 65.2853 37.8565 71.0495 45.9162 64.9511L46.0098 64.8794L46.1307 64.9084C48.1619 65.3991 50.1931 65.8891 52.2184 66.4016L51.8557 66.8324L49.3001 61.1897L49.2314 61.038C53.0568 54.1978 49.245 45.3181 41.6482 43.3781C33.9997 41.258 26.2577 47.2859 26.2849 55.2021Z" fill="#263238"/>
                                            <path d="M30.1977 64.4345C27.5977 62.0093 26.1288 58.6437 26.1667 55.2022C26.1644 54.5096 26.2207 53.8258 26.3321 53.1556C26.9921 49.0837 29.5868 45.5978 33.4271 43.7823C37.9125 41.6628 43.0777 42.2933 46.9084 45.4284C51.5005 49.111 52.8912 55.9405 50.127 61.0731L52.7958 67.1211C52.8142 67.1625 52.8077 67.2111 52.7775 67.2455C52.7484 67.281 52.7022 67.2947 52.6578 67.284C50.4861 66.7288 48.334 66.1523 46.1411 65.5603C44.2574 66.89 42.0591 67.6769 39.7737 67.8398C39.4514 67.8659 39.129 67.8789 38.8073 67.8789C35.6674 67.8789 32.5738 66.6512 30.1977 64.4345ZM45.8869 65.3962C45.8886 65.3411 45.9283 65.2949 45.9829 65.2842L46.1974 65.2421C46.2519 65.2315 46.3064 65.2599 46.3289 65.3115C46.3366 65.3298 46.3396 65.3488 46.3384 65.3678C48.1444 65.8548 49.9232 66.3318 51.7085 66.7946L51.5047 66.3454C49.7484 65.9052 47.9702 65.4756 46.2448 65.0585L46.038 65.0087L45.9882 65.046C42.8928 67.3883 39.1207 68.1284 35.5211 67.1815C36.8934 67.5708 38.3279 67.7195 39.7565 67.6034C41.956 67.4464 44.0713 66.701 45.8952 65.4436C45.8892 65.4282 45.8863 65.4128 45.8869 65.3962ZM46.038 64.764L46.2999 64.8274C47.9667 65.2297 49.6815 65.6439 51.3791 66.0687L49.1233 61.0879C49.1073 61.0535 49.1097 61.0138 49.128 60.9806C50.9329 57.7531 51.1101 53.904 49.6151 50.4193C48.1189 46.9334 45.2043 44.4092 41.6171 43.4932C38.0417 42.5024 34.2525 43.2609 31.2211 45.5753C28.7016 47.4981 27.068 50.2024 26.5673 53.1924C26.4612 53.8477 26.4055 54.5196 26.4043 55.2016C26.4405 59.8513 29.0494 64.0138 33.2126 66.0652C37.3982 68.1266 42.1207 67.6751 45.8442 64.8576L45.9378 64.7859C45.9586 64.7699 45.984 64.761 46.0101 64.761C46.0196 64.7604 46.0285 64.7616 46.038 64.764ZM51.984 66.8657C52.1494 66.9083 52.3153 66.951 52.4806 66.9931L52.2726 66.5226L51.984 66.8657ZM51.7986 66.4183L51.8869 66.6121L52.006 66.4705C51.9366 66.4533 51.8673 66.4361 51.7986 66.4183ZM49.8823 61.3273C49.8296 61.3124 49.794 61.2639 49.7958 61.2088L49.8071 60.906C49.8094 60.8503 49.8491 60.8041 49.9037 60.794C49.9368 60.7857 49.9706 60.7958 49.9961 60.8147C52.6027 55.7977 51.222 49.1916 46.7597 45.6133C43.973 43.332 40.467 42.4005 37.0439 42.9208C38.5785 42.73 40.1482 42.8402 41.6775 43.265C45.3352 44.1989 48.308 46.7728 49.8331 50.3269C51.35 53.8607 51.1782 57.7638 49.3645 61.0452L51.673 66.1428C51.8353 66.1831 51.9971 66.224 52.1588 66.2649L49.9748 61.316C49.9481 61.3314 49.9155 61.3362 49.8823 61.3273Z" fill="#263238"/>
                                            <path d="M44.7788 56.9489C42.9751 60.5865 38.684 62.7457 38.684 62.7457C38.684 62.7457 34.3929 60.5871 32.5927 56.9489C31.0907 53.9145 32.0423 50.6349 34.413 49.9191C37.8118 48.891 38.684 52.4504 38.684 52.4504C38.684 52.4504 39.5562 48.8916 42.9585 49.9191C45.3293 50.6349 46.2809 53.9145 44.7788 56.9489Z" fill="#F5F5F5"/>
                                        </svg>
                                        <?php else: ?>
                                        <img id="svg_text_preview" src="<?php echo e(isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text :''); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>

                        <?php $j = $j + 1; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($plan->enable_branding == 'on'): ?>
                    <?php if($is_branding_enabled): ?>
                    <section class="footer-sec">
                        <p id="<?php echo e($stringid . '_branding'); ?>_preview"><?php echo e($business->branding_text); ?></p>
                    </section>
                    <?php endif; ?>
                <?php endif; ?>
             </div>
          </div>
      </main>
        <div id="previewImage"> </div>
        <a id="download" href="#" class="font-lg download mr-3 text-white">
            <i class="fas fa-download"></i>
        </a>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('card.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/card/theme2/index.blade.php ENDPATH**/ ?>