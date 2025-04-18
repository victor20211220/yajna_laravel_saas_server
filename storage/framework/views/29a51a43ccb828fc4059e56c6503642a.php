<?php $__env->startSection('contentCard'); ?>
<?php if($themeName): ?>
<div class="<?php echo e($themeName); ?>" id="view_theme16">
<?php else: ?>
<div class="<?php echo e($business->theme_color); ?>" id="view_theme16">
<?php endif; ?>
        <main id="boxes">
            <div class="card-wrapper <?php if(!isset($is_pdf)): ?> scrollbar <?php endif; ?>">
                <div class="gym-card">
                    <section class="profile-sec pb">
                        <diTv class="profile-banner-wrp">
                            <div class="profile-banner img-wrapper">
                                <img src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme16/images/profile-banner.png')); ?>" class="profile-banner-image" alt="profile-banner" id="banner_preview" loading="lazy">
                            </div>
                        </div>
                        <div class="container">
                            <div class="client-info-wrp d-flex align-items-center">
                                <div class="client-image">
                                    <img id="business_logo_preview"  src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme16/images/client-image.png')); ?>"   alt="client-image" loading="lazy">
                                </div>
                                <div class="client-info">
                                    <h2 id="<?php echo e($stringid . '_subtitle'); ?>_preview"><?php echo e($business->sub_title); ?></h2>
                                    <span id="<?php echo e($stringid . '_title'); ?>_preview"><?php echo e($business->title); ?></span>
                                    <p id="<?php echo e($stringid . '_designation'); ?>_preview"><?php echo e($business->designation); ?></p>
                                </div>
                            </div>
                            <div class="profile-content text-center">
                                <p id="<?php echo e($stringid . '_desc'); ?>_preview"> <?php echo nl2br(e($business->description)); ?></p>
                            </div>
                        </div>
                    </section>
                    <?php $j = 1; ?>
                    <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($j == $order_value): ?>
                            <?php if($order_key == 'social'): ?>
                            <section class="social-link-sec" id="social-div">
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
                                                              <img src="<?php echo e(asset('custom/theme3/icon/social/' . strtolower($social_key1) . '.svg')); ?>" alt="social-image" loading="lazy">
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
                            <?php if($order_key == 'service'): ?>
                            <section class="service-sec pb" id="services-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Services')); ?></h2>
                                </div>
                                <div class="container">
                                    <?php if(isset($is_pdf)): ?>
                                        <?php $image_count = 0; ?>
                                        <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="service-card edit-card" id="services_<?php echo e($service_row_nos); ?>">
                                                <div class="service-card-inner">
                                                    <div class="service-card-image">
                                                        <div class="img-wrapper">
                                                            <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>" width="28" height="28" src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"  class="img-fluid" alt="service-image">
                                                        </div>
                                                    </div>
                                                    <div class="service-content">
                                                        <div class="service-content-top">
                                                            <h3 id="<?php echo e('title_' . $service_row_nos . '_preview'); ?>"> <?php echo e($content->title); ?></h3>
                                                            <p id="<?php echo e('description_' . $service_row_nos . '_preview'); ?>"><?php echo e($content->description); ?> </p>
                                                        </div>
                                                        <div class="service-content-bottom">
                                                            <?php if(!empty($content->purchase_link)): ?>
                                                            <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                id="<?php echo e('link_title_' . $service_row_nos . '_preview'); ?>"
                                                                class="btn"><?php echo e($content->link_title); ?></a>
                                                            <?php endif; ?>
                                                        </div>
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
                                                    <div class="service-card-image">
                                                        <div class="img-wrapper">
                                                            <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>" width="28" height="28" src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"  class="img-fluid" alt="service-image">
                                                        </div>
                                                    </div>
                                                    <div class="service-content">
                                                        <div class="service-content-top">
                                                            <h3 id="<?php echo e('title_' . $service_row_nos . '_preview'); ?>"> <?php echo e($content->title); ?></h3>
                                                            <p id="<?php echo e('description_' . $service_row_nos . '_preview'); ?>"><?php echo e($content->description); ?> </p>
                                                        </div>
                                                        <div class="service-content-bottom">
                                                            <?php if(!empty($content->purchase_link)): ?>
                                                            <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                id="<?php echo e('link_title_' . $service_row_nos . '_preview'); ?>"
                                                                class="btn"><?php echo e($content->link_title); ?></a>
                                                            <?php endif; ?>
                                                        </div>
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
                            </section>
                            <?php endif; ?>
                            <?php if($order_key == 'bussiness_hour'): ?>
                            <section class="business-hour-sec pb" id="business-hours-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Business Hours')); ?></h2>
                                </div>
                                <ul class="hours-list">
                                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="d-flex align-items-center justify-content-between">
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
                            </section>
                            <?php endif; ?>
                            <?php if($order_key == 'gallery'): ?>
                            <section class="gallery-sec pb" id="gallery-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Gallery')); ?></h2>
                                </div>
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
                                                                    class="gallery-popup-btn  gallery-margin img-wrapper"
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
                                                                class="gallery-popup-btn  img-wrapper">
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
                                                                    class="video-popup-btn  play-btn img-wrapper">
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
                                                                    class="video-popup-btn play-btn  img-wrapper">
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
                                                                class="gallery-popup-btn  img-wrapper">
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
                            </section>
                            <?php endif; ?>
                            <?php if($order_key == 'contact_info'): ?>
                            <section class="contact-info-sec pb" id="contact-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Contact us')); ?></h2>
                                </div>
                                <div class="container">
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
                                                        <li id="contact_<?php echo e($loop->parent->index + 1); ?>" class="d-flex align-items-center">
                                                            <?php if($key1 == 'Address'): ?>
                                                                <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($key2 == 'Address_url'): ?>
                                                                        <?php $href = $val2; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="contact-image">
                                                                    <img src="<?php echo e(asset('custom/theme16/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                </div>
                                                                    <a href="<?php echo e($href); ?>" target="_blank" class="contact-item" >
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
                                                                    <div class="contact-image">
                                                                        <img src="<?php echo e(asset('custom/theme16/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                    </div>
                                                                        <a href="<?php echo e(url('https://wa.me/' . $href)); ?>" target="_blank" class="contact-item">
                                                                <?php else: ?>
                                                                    <div class="contact-image">
                                                                        <img src="<?php echo e(asset('custom/theme16/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                        </div>
                                                                        <a href="<?php echo e($href); ?>" class="contact-item">
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
                                </div>
                            </section>

                            <?php endif; ?>
                            <?php if($order_key == 'product'): ?>
                            <section class="product-sec pb" id="product-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Product')); ?></h2>
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
                                    <div class="product-sec-slider"  id="inputrow_product_preview">
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
                            <?php if($order_key == 'appointment'): ?>
                            <section class="appointment-sec pb" id="appointment-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Make An Appointment')); ?></h2>
                                </div>
                                <div class="container">
                                    <form class="appointment-form">
                                        <div class="date-picker">
                                            <div class="form-group">
                                                <label><?php echo e(__('Date :')); ?></label>
                                                <input type="text" class="form-control datepicker_min" placeholder="Pick a date">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Hours :')); ?></label>
                                            <ul class="check-box-div d-flex" id="inputrow_appointment_preview">
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
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn appointment-btn"><?php echo e(__('Make An Appointment')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </section>
                            <?php endif; ?>

                            <?php if($order_key == 'more'): ?>
                            <section class="more-info-sec pb">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('More')); ?></h2>
                                </div>
                                <div class="container">
                                    <ul class="d-flex justify-content-center">
                                        <li>
                                            <a href="<?php echo e(route('bussiness.save', $business->slug)); ?>"
                                                class="save-info d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                                    fill="none">
                                                    <path
                                                        d="M14.545 5.28945C14.5941 5.02654 14.6189 4.75968 14.6192 4.49222C14.6162 2.00824 12.6002 -0.00299436 10.1162 3.34668e-06C8.22526 0.00227634 6.53772 1.18703 5.89324 2.96474C4.73932 2.5054 3.4315 3.06844 2.97212 4.22236C2.93236 4.32224 2.89981 4.42482 2.87475 4.52935C1.03224 4.8049 -0.237997 6.52193 0.0375616 8.36444C0.284691 10.0169 1.70429 11.2394 3.3751 11.2387H6.18613C6.49664 11.2387 6.74835 10.987 6.74835 10.6765C6.74835 10.366 6.49664 10.1143 6.18613 10.1143H3.3751C2.13309 10.1143 1.12626 9.10747 1.12626 7.86547C1.12626 6.62346 2.13309 5.61662 3.3751 5.61662C3.68561 5.61662 3.93732 5.36492 3.93732 5.05441C3.93834 4.43342 4.44258 3.93082 5.06357 3.93185C5.35724 3.93234 5.6391 4.0477 5.8488 4.25326C6.06994 4.4712 6.42591 4.4686 6.64386 4.24746C6.72568 4.16442 6.77967 4.05801 6.79835 3.94291C7.10353 2.10697 8.83923 0.866045 10.6752 1.17122C12.5111 1.47639 13.7521 3.2121 13.4469 5.04805C13.4287 5.15751 13.4051 5.26602 13.3762 5.37315C13.3116 5.60783 13.4053 5.85743 13.6084 5.99157C14.6433 6.67824 14.9256 8.07389 14.2389 9.10879C13.8232 9.73518 13.1221 10.1125 12.3704 10.1142H10.6838C10.3733 10.1142 10.1216 10.366 10.1216 10.6765C10.1216 10.987 10.3733 11.2387 10.6838 11.2387H12.3704C14.2334 11.2369 15.7422 9.72523 15.7405 7.86224C15.7395 6.87066 15.3023 5.92967 14.545 5.28945Z"
                                                        fill="#111111" />
                                                    <path
                                                        d="M11.6325 11.9659C11.4146 11.7555 11.0692 11.7555 10.8514 11.9659L8.99889 13.8173V5.61691C8.99889 5.3064 8.74718 5.05469 8.43667 5.05469C8.12616 5.05469 7.87446 5.3064 7.87446 5.61691V13.8173L6.02309 11.9659C5.79974 11.7502 5.44384 11.7564 5.22814 11.9797C5.0177 12.1976 5.0177 12.543 5.22814 12.7608L8.03917 15.5719C8.25843 15.7917 8.61443 15.7922 8.83425 15.5729C8.83458 15.5725 8.83491 15.5722 8.83527 15.5719L11.6463 12.7608C11.862 12.5375 11.8558 12.1816 11.6325 11.9659Z"
                                                        fill="#111111" />
                                                </svg>
                                                <h3><?php echo e(__('Save')); ?></h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="share-info d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.28377 9.4228C6.04018 9.32536 5.89402 9.03304 5.99146 8.78945C7.30688 5.28165 10.3275 2.74824 13.9814 2.11489L11.8865 0.945621C11.6429 0.799463 11.5455 0.507147 11.6916 0.26355C11.8378 0.0199526 12.1301 -0.0774863 12.3737 0.0686719L15.5405 1.82257C15.7841 1.96873 15.8815 2.26105 15.7353 2.50464L14.0302 5.57397C13.9327 5.72012 13.7866 5.81756 13.5917 5.81756C13.4942 5.81756 13.3968 5.81756 13.3481 5.76884C13.1045 5.62268 13.0071 5.33037 13.1532 5.08677L14.3225 3.04056C10.9608 3.57647 8.13511 5.915 6.91713 9.08176C6.81969 9.27664 6.62481 9.4228 6.42993 9.4228H6.28377ZM14.8107 7.9125C14.8107 7.62019 15.0056 7.42531 15.2979 7.42531C15.5902 7.42531 15.7851 7.66891 15.7851 7.9125V11.7126C15.7851 14.0999 13.885 15.9999 11.4978 15.9999H4.2873C1.94877 15.9999 -3.22908e-06 14.0999 -3.22908e-06 11.7126V4.50214C-3.22908e-06 2.16361 1.90005 0.214836 4.2873 0.214836H7.94126C8.23358 0.214836 8.42846 0.409714 8.42846 0.70203C8.42846 0.994347 8.23358 1.18922 7.94126 1.18922H4.2873C2.48469 1.18922 0.974385 2.65081 0.974385 4.50214V11.7126C0.974385 13.564 2.43597 15.0255 4.2873 15.0255H11.4978C13.3004 15.0255 14.8107 13.564 14.8107 11.7126V7.9125Z"
                                                        fill="#111111" />
                                                </svg>
                                                <h3><?php echo e(__('Share')); ?></h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="contact-info d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                                    fill="none">
                                                    <path
                                                        d="M13.4595 2.09597C12.1078 0.744271 10.3106 -7.56008e-05 8.39908 5.7592e-09C8.08584 5.7592e-09 7.83203 0.253887 7.83203 0.567049C7.83203 0.880212 8.08592 1.1341 8.39908 1.1341C10.0077 1.13402 11.52 1.76042 12.6575 2.89792C13.7951 4.03543 14.4215 5.54786 14.4214 7.15654C14.4214 7.4697 14.6753 7.72359 14.9885 7.72359C15.3017 7.72359 15.5555 7.4697 15.5555 7.15662C15.5556 5.2449 14.8113 3.44766 13.4595 2.09597Z"
                                                        fill="#111111" />
                                                    <path
                                                        d="M11.1269 7.15651C11.1269 7.46967 11.3808 7.72356 11.694 7.72348C12.0072 7.72348 12.261 7.4696 12.261 7.15643C12.2608 5.02735 10.5284 3.29498 8.39916 3.29468C8.39908 3.29468 8.39923 3.29468 8.39916 3.29468C8.08599 3.29468 7.83211 3.54849 7.83203 3.86165C7.83203 4.17481 8.08584 4.4287 8.399 4.42878C9.90305 4.429 11.1267 5.65262 11.1269 7.15651Z"
                                                        fill="#111111" />
                                                    <path
                                                        d="M9.87051 10.0477C9.00618 10.0029 8.56585 10.6457 8.35468 10.9545C8.17783 11.213 8.24406 11.5659 8.50256 11.7427C8.76106 11.9195 9.11392 11.8533 9.29076 11.5948C9.54026 11.23 9.6533 11.1726 9.80663 11.1799C10.2974 11.2376 12.2303 12.654 12.4238 13.0969C12.4724 13.2273 12.4705 13.3552 12.4185 13.5107C12.2155 14.113 11.8796 14.5362 11.4468 14.7346C11.0357 14.9231 10.5316 14.906 9.98944 14.6854C7.96492 13.8602 6.19619 12.7086 4.73244 11.2626C4.73184 11.262 4.73123 11.2615 4.7307 11.2609C3.28768 9.79855 2.13823 8.03207 1.31442 6.01066C1.09372 5.46803 1.07664 4.96388 1.26512 4.55281C1.46352 4.12004 1.88676 3.78412 2.48851 3.58142C2.64457 3.5291 2.77219 3.52744 2.9014 3.57552C3.34589 3.76975 4.76223 5.70256 4.81939 6.1878C4.82756 6.34688 4.76972 6.45984 4.40522 6.70888C4.14664 6.8855 4.08018 7.23836 4.25688 7.49693C4.43349 7.75551 4.78627 7.82189 5.04492 7.64527C5.35385 7.43433 5.99651 6.99521 5.9519 6.12792C5.90276 5.22201 4.14052 2.82293 3.29849 2.51332C2.92401 2.37375 2.5301 2.37134 2.12727 2.50652C1.22089 2.81174 0.566293 3.35596 0.234229 4.08027C-0.0878549 4.78296 -0.077648 5.59822 0.264094 6.43836C1.14574 8.60162 2.37926 10.4944 3.93033 12.0644C3.93411 12.0683 3.93797 12.072 3.9419 12.0757C5.51074 13.6239 7.40135 14.8552 9.56174 15.7358C9.99436 15.9117 10.4204 15.9998 10.8278 15.9998C11.2115 15.9998 11.5788 15.9218 11.9195 15.7656C12.6438 15.4336 13.188 14.7791 13.4934 13.8721C13.6283 13.47 13.6261 13.0762 13.4876 12.7035C13.1769 11.8592 10.7779 10.097 9.87051 10.0477Z"
                                                        fill="#111111" />
                                                </svg>
                                                <h3><?php echo e(__('Contact')); ?></h3>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <?php endif; ?>
                            <?php if($order_key == 'testimonials'): ?>
                            <section class="testimonial-sec pb" id="testimonials-div">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Testimonial')); ?></h2>
                                </div>
                                <div class="container">
                                    <?php if(isset($is_pdf)): ?>
                                        <?php
                                            $t_image_count = 0;
                                            $rating = 0;
                                        ?>
                                        <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="testimonial-card" id="testimonials_<?php echo e($testimonials_row_nos); ?>">
                                                <div class="testimonial-card-inner">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-content-top">
                                                            <h3 id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                            <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                            </h3>
                                                            <p id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>"><?php echo e($testi_content->description); ?> </p>
                                                        </div>
                                                        <div
                                                            class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="rating d-flex align-items-center">
                                                                <?php
                                                                if (!empty($testi_content->rating)) {
                                                                    $rating = (int) $testi_content->rating;
                                                                    $overallrating = $rating;
                                                                } else {
                                                                    $overallrating = 0;
                                                                }
                                                                ?>
                                                                <span id="<?php echo e('stars' . $testimonials_row_nos); ?>_star" class="stars">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <?php if($overallrating < $i): ?>
                                                                            <?php if(is_float($overallrating) && round($overallrating) == $i): ?>
                                                                                <i class="star-color fas fa-star-half-alt"></i>
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
                                                    <div class="testimonial-image img-wrapper">
                                                        <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>" src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" alt="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $t_image_count++;
                                            $testimonials_row_nos++;
                                            ?>
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
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-content-top">
                                                            <h3 id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                            <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                            </h3>
                                                            <p id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>"><?php echo e($testi_content->description); ?> </p>
                                                        </div>
                                                        <div
                                                            class="testimonial-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="rating d-flex align-items-center">
                                                                <?php
                                                                if (!empty($testi_content->rating)) {
                                                                    $rating = (int) $testi_content->rating;
                                                                    $overallrating = $rating;
                                                                } else {
                                                                    $overallrating = 0;
                                                                }
                                                                ?>
                                                                <span id="<?php echo e('stars' . $testimonials_row_nos); ?>_star" class="stars">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <?php if($overallrating < $i): ?>
                                                                            <?php if(is_float($overallrating) && round($overallrating) == $i): ?>
                                                                                <i class="star-color fas fa-star-half-alt"></i>
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
                                                    <div class="testimonial-image img-wrapper">
                                                        <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>" src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" alt="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $t_image_count++;
                                            $testimonials_row_nos++;
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </section>
                            <?php endif; ?>

                            <?php if($order_key == 'payment'): ?>
                            <section class="payment-sec pb" id="payment-section">
                                <div class="section-title common-title text-center">
                                    <h2><?php echo e(__('Payment')); ?></h2>
                                </div>
                                <div class="container">
                                    <?php if(!is_null($cardPayment_content) && !empty($cardPayment_content)): ?>
                                        <ul class="d-flex align-items-center justify-content-center">
                                            <?php if(isset($cardPayment_content->stripe) && $cardPayment_content->stripe->status == 'on'): ?>
                                                <li>
                                                    <a href="<?php echo e(route('card.pay.with.stripe', $business->id)); ?>"
                                                        class="d-flex align-items-center justify-content-center"
                                                        target="_blank">
                                                        <img src="<?php echo e(asset('custom/img/payments/stripe.png')); ?>"
                                                            alt="payment-image" class="img-fluid" loading="lazy">
                                                        <span><?php echo e(__('Stripe')); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($cardPayment_content->paypal) && $cardPayment_content->paypal->status == 'on'): ?>
                                                <li>
                                                    <a href="<?php echo e(route('card.pay.with.paypal', $business->id)); ?>"
                                                        class="d-flex align-items-center justify-content-center"
                                                        target="_blank">
                                                        <img src="<?php echo e(asset('custom/img/payments/paypal.png')); ?>"
                                                            alt="payment-image" loading="lazy">
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
                                            <input type="hidden" id="mapLink" value="<?php echo e($business->google_map_link); ?>">
                                            <div id="mapContainer">
                                            </div>
                                        </div>
                                    </section>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($order_key == 'appinfo'): ?>
                                <section class="download-sec pb" id="app-section">
                                    <div class="section-title common-title text-center">
                                        <h2><?php echo e(__('Download Here')); ?></h2>
                                    </div>
                                    <?php if(!is_null($appInfo)): ?>
                                        <div class="container">
                                            <ul class="d-flex">
                                                <?php if(!is_null($appInfo->playstore_id) && !is_null($appInfo->appstore_id)): ?>
                                                    <li>
                                                        <a href="<?php echo e($appInfo->playstore_id); ?>" target="_blank"
                                                            class="d-flex align-items-center justify-content-center">
                                                            <img src="<?php echo e(asset('custom/icon/apps/playstore' . $appInfo->variant . '.png')); ?>"
                                                                alt="app-store" loading="lazy">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e($appInfo->appstore_id); ?>" target="_blank"
                                                            class="d-flex align-items-center justify-content-center">
                                                            <img src="<?php echo e(asset('custom/icon/apps/appstore' . $appInfo->variant . '.png')); ?>"
                                                                alt="app-store" loading="lazy">
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
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
                                        <div class="thankyou-svg pb">
                                            <?php if(empty($business->svg_text)): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="460" height="589" viewBox="0 0 460 589" fill="none">
                                                <path d="M261.268 207.415L459.572 336.527L239.057 510.4L0.875 336.527L199.369 207.403C218.187 195.16 242.455 195.165 261.268 207.415Z" fill="#F2F2F2"/>
                                                <path d="M0.875 336.528H459.572L235.83 543.254L0.875 336.528Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M366.296 323.991L369.137 320.145C377.198 309.243 392.568 306.939 403.47 315C414.371 323.058 416.675 338.431 408.617 349.332L379.841 388.253C374.881 394.962 365.422 396.381 358.713 391.421L319.792 362.647C308.891 354.586 306.587 339.215 314.645 328.314C322.705 317.413 338.076 315.109 348.978 323.166L352.823 326.01C357.1 329.173 363.133 328.267 366.296 323.991Z" fill="#F2536D"/>
                                                <path d="M265.727 184.58L266.618 183.375C269.142 179.958 273.96 179.237 277.378 181.762C280.793 184.288 281.516 189.104 278.989 192.522L269.971 204.72C268.417 206.824 265.452 207.267 263.351 205.713L251.153 196.695C247.735 194.17 247.012 189.352 249.539 185.934C252.066 182.519 256.882 181.796 260.3 184.323L261.505 185.214C262.844 186.204 264.734 185.922 265.727 184.58Z" fill="#F2536D"/>
                                                <path d="M411.166 204.668L413.237 203.02C419.112 198.345 427.662 199.318 432.337 205.191C437.012 211.066 436.04 219.616 430.164 224.291L409.193 240.981C405.58 243.857 400.319 243.26 397.44 239.645L380.75 218.673C376.076 212.798 377.048 204.248 382.923 199.573C388.796 194.898 397.346 195.871 402.021 201.746L403.669 203.817C405.506 206.121 408.862 206.502 411.166 204.668Z" fill="#F2536D"/>
                                                <path d="M384.528 61.3759L385.948 60.2449C389.977 57.0376 395.845 57.7033 399.052 61.7347C402.259 65.7637 401.594 71.6314 397.562 74.8387L383.174 86.2895C380.694 88.2644 377.083 87.8536 375.111 85.3739L363.658 70.983C360.45 66.9541 361.119 61.0863 365.148 57.879C369.179 54.6717 375.047 55.3398 378.254 59.3688L379.385 60.7918C380.642 62.3732 382.946 62.6355 384.528 61.3759Z" fill="#F2536D"/>
                                                <path d="M146.148 15.229L147.425 13.2071C151.045 7.47054 158.631 5.75546 164.365 9.37854C170.101 12.9991 171.816 20.5819 168.196 26.3185L155.267 46.7949C153.04 50.3239 148.373 51.3782 144.844 49.1509L124.367 36.2251C118.631 32.602 116.918 25.0192 120.539 19.2826C124.159 13.5486 131.742 11.8335 137.479 15.4542L139.501 16.7312C141.75 18.1517 144.727 17.4785 146.148 15.229Z" fill="#F2536D"/>
                                                <path d="M342.577 270.321C348.883 270.937 355.154 268.069 358.433 262.649C359.876 260.258 362.459 259.12 365.1 259.12C369.589 259.12 373.23 262.758 373.23 267.25V269.591C373.23 272.746 376.187 275.067 379.251 274.317L381.926 273.664C384.319 273.08 386.626 274.892 386.626 277.352C386.626 279.45 384.925 281.15 382.829 281.15H342.047C340.184 281.15 338.451 280.193 337.457 278.616C335.051 274.798 338.085 269.88 342.577 270.321Z" fill="#B3DFF6"/>
                                                <path d="M76.6135 238.497L75.2979 234.022C72.301 223.834 79.9391 213.625 90.5592 213.625C99.3447 213.625 106.467 220.747 106.467 229.533V234.119C106.467 240.293 112.253 244.837 118.252 243.369L123.489 242.09C128.168 240.947 132.685 244.491 132.685 249.306C132.685 253.412 129.356 256.738 125.253 256.738H45.4485C41.8002 256.738 38.407 254.865 36.4631 251.779C31.7541 244.305 37.6936 234.685 46.484 235.547L76.6135 238.497Z" fill="#B3DFF6"/>
                                                <path d="M310.422 173.335L313.055 178.73C314.691 182.076 319.495 183.094 323.786 180.997L335.338 175.357C345.26 170.514 350.236 160.311 346.455 152.57C344.718 149.011 339.612 147.932 335.054 150.159L317.562 158.7C311.189 161.813 307.994 168.364 310.422 173.335Z" fill="#F684A5"/>
                                                <path d="M131.14 192.185L132.078 198.112C132.657 201.795 129.62 205.334 125.287 206.019L113.628 207.86C103.618 209.442 94.4139 203.826 93.0676 195.318C92.4514 191.405 95.6785 187.646 100.282 186.919L117.934 184.13C124.364 183.112 130.276 186.721 131.14 192.185Z" fill="#F684A5"/>
                                                <path d="M262.801 546.821L293.043 567.862C300.056 572.742 309.775 570.154 313.432 562.432C316.066 556.879 314.714 550.254 310.119 546.172L296.064 529.503C288.984 521.103 284.784 510.655 284.079 499.694L262.801 546.821Z" fill="#585398"/>
                                                <path d="M227.855 564.173L200.605 565.74L193.77 422.368L235.163 420.965L267.256 425.031C270.646 425.462 271.993 429.654 269.486 431.978C249.42 450.573 238.793 477.219 240.555 504.521L227.855 564.173Z" fill="#585398"/>
                                                <path d="M284.084 499.695L278.399 411.405C255.626 416.797 235.491 435.269 238.716 458.447C245.195 505.035 252.211 543.711 262.806 546.822C284.992 546.186 290.842 527.768 284.084 499.695Z" fill="#585398"/>
                                                <path d="M212.404 277.476C204.903 275.91 198.209 271.718 193.524 265.657L175.064 241.773C165.363 232.482 153.423 224.103 146.577 234.178C137.067 248.175 160.426 280.179 169.84 290.986C171.404 292.78 173.493 295.57 176.054 298.517C192.225 317.142 191.272 352.034 192.915 428.307C278.53 431.792 277.597 427.666 278.926 408.355C282.586 357.457 284.104 338.529 284.608 329.212C285.361 315.351 288.405 301.707 293.75 288.895C293.99 288.318 294.22 287.784 294.433 287.301C300.294 274.135 317.563 222.875 304.139 212.414C289.657 201.132 272.289 246.524 266.726 257.423L262.709 266.201C259.502 273.21 254.211 276.135 248.434 276.593L215.163 278.315L212.404 277.476Z" fill="#FBC425"/>
                                                <path d="M285.722 219.72C283.378 224.592 281.336 229.131 279.733 233.031C277.255 239.062 282.593 245.621 288.944 244.242C298.484 242.173 305.592 237.107 309.771 224.293L285.722 219.72Z" fill="white"/>
                                                <path d="M165.709 231.64C167.147 233.677 171.602 237.777 174.522 241.636C172.817 248.095 168.929 251.51 163.532 252.824C156.946 254.425 150.059 251.498 146.176 245.944L144.832 242.888L165.709 231.64Z" fill="white"/>
                                                <path d="M144.99 243.3L118.629 197.903L132.119 192.359C143.018 202.162 156.986 219.042 167.518 233.478C163.044 242.075 154.932 244.292 144.99 243.3Z" fill="#F684A5"/>
                                                <path d="M309.332 226.597L325.175 174.263L310.527 171.842C301.529 184.751 290.966 206.254 283.797 223.548C293.134 229.188 302.655 235.843 309.332 226.597Z" fill="#F684A5"/>
                                                <path d="M377.627 150.023L354.787 5.49588C354.225 1.94456 350.891 -0.478226 347.343 0.0810852L56.2347 46.0898C52.6848 46.6516 50.2623 49.9851 50.8228 53.534L73.6653 198.061C74.2261 201.613 77.5594 204.036 81.109 203.474L372.217 157.465C375.766 156.906 378.188 153.572 377.627 150.023Z" fill="#F2F2F2"/>
                                                <path d="M215.814 277.781C212.552 278.439 209.867 280.943 209.238 284.21C207.043 295.631 219.004 310.713 239.597 298.752C249.644 292.916 253.059 282.522 245.011 276.63C234.852 275.232 225.458 275.833 215.814 277.781Z" fill="white"/>
                                                <path d="M236.841 259.773C247.027 251.948 259.022 242.942 261.18 229.418C262.492 221.206 258.04 209.991 249.492 208.986C246.198 208.6 242.951 207.34 240.855 204.712L213.419 204.618C206.804 210.038 203.827 218.808 205.312 227.398L207.148 238.008L236.841 259.773Z" fill="#362B71"/>
                                                <path d="M238.706 290.46C242.198 287.676 244.096 283.355 244.094 278.843C244.091 273.005 244.049 266.576 244.148 262.982C244.403 253.707 238.13 252.467 228.654 254.276C224.026 255.159 218.034 259.146 216.027 263.814L216.589 286.391C216.705 291.744 224.239 301.985 238.706 290.46Z" fill="#F684A5"/>
                                                <path d="M248.519 245.36L252.755 233.137C257.831 217.754 216.326 205.162 211.691 217.185C207.509 226.423 197.54 247.682 200.758 258.472C202.44 264.112 206.769 267.705 211.907 269.888C219.205 272.989 237.627 277.023 241.265 262.946L248.519 245.36Z" fill="#F684A5"/>
                                                <path d="M235.91 270.352C229.515 273.107 220.886 272.443 216.23 271.394L216.327 275.336C217.879 275.648 219.566 275.908 221.393 276.052C226.587 276.46 232.574 276.039 237.504 273.923C238.353 273.559 238.843 272.673 238.65 271.76C238.392 270.523 237.058 269.857 235.91 270.352Z" fill="#F27170"/>
                                                <path d="M240.797 264.357C260.89 261.863 253.973 229.337 242.636 252.137L240.797 264.357Z" fill="#F684A5"/>
                                                <path d="M252.261 216.804L244.797 230.581C245.859 234.092 245.765 237.834 244.525 241.24L243.047 245.293C242.523 246.736 243.265 248.359 244.708 248.921C246.148 249.483 247.744 248.77 248.269 247.33L251.026 239.76C251.699 239.693 252.422 239.507 253.201 239.153C259.769 236.166 259.057 219.65 252.261 216.804Z" fill="#362B71"/>
                                                <path d="M252.706 224.088C250.043 222.994 248.35 221.613 245.405 221.145C242.213 220.641 238.951 220.225 235.729 220.019C229.935 219.651 224.04 219.844 218.314 218.376C213.453 217.129 205.012 213.174 205.437 207.064C205.732 202.81 209.367 200.624 213.139 199.476C221.373 196.969 229.354 198.318 237.191 202.077C245.799 206.205 252.951 213.528 252.706 224.088Z" fill="#362B71"/>
                                                <path d="M228.657 252.657C228.258 253.174 227.795 253.771 227.266 254.474C225.573 256.713 222.923 258.089 220.116 258.027C215.261 257.923 212.618 254.159 211.813 251.12C211.487 249.893 212.16 248.695 213.239 248.227L228.657 252.657Z" fill="#362B71"/>
                                                <path d="M213.562 249.734L213.238 248.226C213.55 248.093 213.894 248.016 214.26 248.021L226.516 248.182C228.797 248.212 230.064 250.835 228.669 252.639C228.664 252.644 228.661 252.651 228.656 252.656L216.938 252.5C215.305 252.481 213.904 251.332 213.562 249.734Z" fill="white"/>
                                                <path d="M234.268 237.521C234.743 237.494 235.201 237.256 235.498 236.84C236.018 236.11 235.844 235.096 235.114 234.578C232.993 233.074 230.647 232.509 228.083 232.913C227.2 233.051 226.596 233.881 226.735 234.766C226.873 235.652 227.682 236.249 228.588 236.118C230.283 235.855 231.808 236.212 233.238 237.224C233.55 237.444 233.914 237.541 234.268 237.521Z" fill="#362B71"/>
                                                <path d="M214.841 235.962C215.316 235.935 215.776 235.7 216.073 235.279C216.59 234.549 216.42 233.537 215.687 233.02C213.566 231.515 211.195 230.951 208.656 231.354C207.77 231.493 207.166 232.322 207.305 233.208C207.444 234.091 208.253 234.68 209.159 234.559C210.861 234.289 212.383 234.653 213.811 235.665C214.123 235.886 214.487 235.982 214.841 235.962Z" fill="#362B71"/>
                                                <path d="M326.888 157.118C325.453 156.559 323.846 157.046 322.805 158.358L318.063 164.347C316.192 166.708 316.994 170.457 319.585 171.452L322.349 172.516C324.371 173.293 326.586 171.982 327.249 169.616L329.227 162.565C329.865 160.288 328.831 157.878 326.888 157.118Z" fill="#F684A5"/>
                                                <path d="M112.853 193.618C112.185 195.009 112.551 196.647 113.784 197.781L119.401 202.958C121.619 205 125.418 204.478 126.6 201.971L127.868 199.291C128.793 197.33 127.65 195.026 125.341 194.188L118.456 191.69C116.234 190.884 113.751 191.737 112.853 193.618Z" fill="#F684A5"/>
                                                <path d="M125.587 51.3313C126.159 51.2398 126.686 51.3685 127.168 51.7199C127.648 52.0713 127.938 52.5316 128.027 53.1033L129.334 61.3691C129.425 61.9432 129.292 62.4679 128.943 62.9505C128.591 63.4306 128.131 63.7152 127.559 63.8068L113.837 65.9771L120.16 105.98C120.249 106.551 120.118 107.081 119.769 107.556C119.417 108.041 118.957 108.326 118.385 108.417L108.172 110.033C107.598 110.122 107.073 109.994 106.59 109.64C106.108 109.293 105.823 108.83 105.734 108.261L99.4111 68.2564L85.6859 70.4243C85.1142 70.5159 84.5871 70.3872 84.107 70.0358C83.6244 69.6868 83.3374 69.224 83.2483 68.6523L81.9416 60.3866C81.852 59.8149 81.9812 59.2903 82.3301 58.8077C82.6815 58.3251 83.1418 58.0405 83.7135 57.9489L125.587 51.3313Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M181.913 96.2174C182.003 96.7891 181.874 97.3162 181.522 97.7938C181.173 98.2789 180.713 98.5635 180.139 98.655L170.317 100.207C169.742 100.298 169.218 100.17 168.735 99.8158C168.253 99.4693 167.968 99.0065 167.876 98.4348L164.758 78.7083C164.407 76.4711 163.575 74.761 162.271 73.5855C160.964 72.405 159.145 71.9991 156.804 72.3704C154.466 72.7416 152.867 73.6845 152.016 75.204C151.164 76.7235 150.914 78.6019 151.268 80.8391L154.386 100.568C154.476 101.14 154.347 101.667 153.995 102.145C153.646 102.63 153.186 102.917 152.614 103.006L142.79 104.557C142.215 104.649 141.691 104.52 141.208 104.166C140.728 103.82 140.441 103.357 140.352 102.786L132.267 51.6341C132.175 51.06 132.304 50.5329 132.658 50.0503C133.007 49.5702 133.467 49.2831 134.039 49.194L143.864 47.6399C144.435 47.5508 144.962 47.6795 145.445 48.0284C145.925 48.3823 146.21 48.8426 146.301 49.4143L148.927 66.0226C149.637 64.7901 150.85 63.5205 152.56 62.2114C154.273 60.9022 156.349 60.0534 158.792 59.6673C161.289 59.2738 163.63 59.2639 165.822 59.6376C168.01 60.0088 169.963 60.8082 171.673 62.0282C173.385 63.2483 174.833 64.9114 176.018 67.015C177.204 69.121 178.038 71.7071 178.523 74.7734L181.913 96.2174Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M204.491 84.814C205.634 84.6334 206.671 84.2745 207.597 83.7276C208.52 83.1782 209.297 82.5125 209.916 81.7205C210.537 80.9311 210.982 80.0476 211.255 79.0701C211.527 78.095 211.581 77.0878 211.418 76.0483L204.417 78.2757C203.053 78.7558 201.992 79.3769 201.234 80.1342C200.474 80.894 200.173 81.77 200.328 82.755C200.484 83.7424 200.917 84.3809 201.63 84.6705C202.343 84.9575 203.296 85.0046 204.491 84.814ZM186.43 85.8312C185.886 82.4011 186.752 79.3621 189.024 76.7116C191.296 74.0586 195.312 71.7471 201.076 69.7698L209.95 66.7679C209.752 65.5206 209.253 64.548 208.453 63.8476C207.649 63.1522 206.414 62.9295 204.751 63.1943C203.556 63.3824 202.657 63.6991 202.063 64.1372C201.467 64.5802 201.034 64.9563 200.762 65.2632C200.361 65.7557 199.96 66.0848 199.559 66.2531C199.158 66.4214 198.673 66.5526 198.104 66.6442L188.2 68.2082C187.68 68.2924 187.224 68.2033 186.838 67.9459C186.452 67.6861 186.242 67.2926 186.212 66.7654C186.128 65.5503 186.45 64.2213 187.18 62.7736C187.912 61.3283 189.009 59.9276 190.474 58.5788C191.939 57.2276 193.746 56.01 195.891 54.9236C198.037 53.8371 200.435 53.0873 203.088 52.6691C206.258 52.1667 209.074 52.1197 211.537 52.5329C214.002 52.9438 216.105 53.7134 217.86 54.8493C219.607 55.9828 221 57.4454 222.025 59.2248C223.054 61.0091 223.75 63.0433 224.111 65.33L227.846 88.9593C227.935 89.531 227.806 90.0581 227.455 90.5358C227.103 91.0208 226.643 91.3054 226.074 91.397L216.246 92.9487C215.675 93.0402 215.147 92.9115 214.665 92.5576C214.185 92.2112 213.898 91.7484 213.809 91.1767L213.465 88.994C212.462 90.7486 211.111 92.2285 209.408 93.4288C207.708 94.629 205.35 95.468 202.333 95.9456C200.101 96.2995 198.062 96.302 196.22 95.953C194.379 95.6066 192.79 94.978 191.446 94.0698C190.105 93.164 189.004 92.0082 188.14 90.5951C187.279 89.1895 186.707 87.5982 186.43 85.8312Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M278.06 81.0223C278.149 81.594 278.021 82.1212 277.669 82.5988C277.32 83.0838 276.86 83.3684 276.286 83.46L266.464 85.0117C265.889 85.1033 265.365 84.9746 264.882 84.6207C264.4 84.2742 264.115 83.8115 264.023 83.2398L260.905 63.5107C260.551 61.2735 259.722 59.5684 258.418 58.3879C257.111 57.2099 255.292 56.8041 252.951 57.1753C250.612 57.5441 249.014 58.4894 248.165 60.0089C247.311 61.5285 247.061 63.4068 247.415 65.644L250.533 85.373C250.622 85.9422 250.494 86.4718 250.142 86.9495C249.793 87.4345 249.333 87.7191 248.761 87.8107L238.936 89.3624C238.362 89.454 237.838 89.3228 237.355 88.9689C236.875 88.6249 236.588 88.1621 236.499 87.5904L230.755 51.2507C230.663 50.679 230.794 50.1543 231.146 49.6718C231.495 49.1917 231.955 48.9046 232.527 48.8155L241.963 47.3232C242.535 47.2341 243.062 47.3603 243.542 47.7118C244.025 48.0632 244.312 48.5234 244.401 49.0951L244.683 50.8893C245.017 50.3028 245.45 49.6743 245.985 49.0036C246.517 48.3354 247.192 47.7068 248.007 47.1277C248.821 46.5436 249.788 46.019 250.914 45.5463C252.038 45.0786 253.379 44.7197 254.938 44.4722C257.435 44.0787 259.779 44.0689 261.969 44.4401C264.157 44.8138 266.11 45.6131 267.822 46.8307C269.532 48.0533 270.982 49.7163 272.165 51.8199C273.351 53.9259 274.185 56.5121 274.67 59.5759L278.06 81.0223Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M296.663 51.5463L305.181 38.6923C305.399 38.3904 305.745 38.0439 306.215 37.6479C306.683 37.252 307.284 36.9995 308.012 36.8857L319.473 35.0741C319.995 34.9924 320.465 35.1014 320.886 35.4082C321.306 35.7176 321.559 36.1309 321.641 36.6506C321.683 36.9104 321.678 37.1356 321.631 37.3311C321.581 37.5267 321.378 37.8632 321.032 38.3458L309.591 55.9761L328.862 71.7158C329.231 72.0301 329.481 72.2676 329.614 72.4359C329.748 72.6017 329.835 72.8121 329.877 73.0695C329.958 73.5917 329.844 74.0644 329.54 74.4851C329.233 74.9083 328.82 75.1582 328.3 75.2399L316.681 77.0762C315.902 77.1999 315.246 77.1826 314.716 77.0292C314.184 76.8708 313.704 76.6134 313.276 76.2546L298.672 64.2568L300.753 77.4375C300.845 78.0067 300.714 78.5363 300.362 79.0139C300.011 79.499 299.553 79.7836 298.981 79.8752L289.157 81.4268C288.585 81.5184 288.055 81.3872 287.575 81.0333C287.095 80.6893 286.808 80.2241 286.716 79.6549L278.634 28.5011C278.542 27.9294 278.673 27.4023 279.025 26.9197C279.371 26.4371 279.834 26.1525 280.406 26.061L290.231 24.5093C290.802 24.4177 291.327 24.5489 291.809 24.8978C292.292 25.2492 292.579 25.712 292.668 26.2837L296.663 51.5463Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M189.048 167.403C189.134 167.94 189.011 168.437 188.681 168.885C188.352 169.338 187.922 169.605 187.385 169.692L177.792 171.206C177.255 171.29 176.763 171.172 176.31 170.84C175.857 170.513 175.59 170.08 175.503 169.541L173.038 153.947L151.211 125.507C150.963 125.195 150.812 124.893 150.768 124.604C150.698 124.163 150.795 123.76 151.065 123.391C151.332 123.025 151.683 122.807 152.124 122.738L162.154 121.151C163.129 120.998 163.899 121.127 164.466 121.537C165.03 121.951 165.381 122.27 165.517 122.498L177.587 139.047L184.041 119.567C184.098 119.31 184.333 118.899 184.744 118.333C185.155 117.766 185.848 117.407 186.825 117.254L196.856 115.667C197.294 115.598 197.697 115.697 198.063 115.962C198.432 116.231 198.65 116.583 198.719 117.023C198.766 117.315 198.717 117.647 198.578 118.021L186.583 151.806L189.048 167.403Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M214.125 148.505C214.565 150.338 215.463 151.682 216.827 152.543C218.188 153.405 219.844 153.677 221.794 153.37C223.747 153.061 225.239 152.289 226.271 151.051C227.3 149.814 227.741 148.257 227.592 146.374C227.575 145.629 227.493 144.792 227.347 143.864C227.201 142.939 227.021 142.115 226.808 141.397C226.367 139.566 225.469 138.222 224.105 137.361C222.744 136.502 221.086 136.225 219.136 136.532C217.183 136.841 215.691 137.616 214.662 138.853C213.632 140.093 213.189 141.649 213.338 143.525C213.352 144.275 213.437 145.114 213.583 146.04C213.731 146.968 213.909 147.787 214.125 148.505ZM239.939 139.021C240.102 139.749 240.276 140.684 240.456 141.83C240.639 142.978 240.763 143.919 240.83 144.659C241.102 147.017 240.912 149.301 240.261 151.504C239.607 153.709 238.548 155.714 237.086 157.52C235.618 159.327 233.747 160.861 231.47 162.121C229.194 163.381 226.565 164.247 223.588 164.717C220.611 165.187 217.847 165.175 215.29 164.68C212.736 164.18 210.484 163.301 208.532 162.032C206.581 160.767 204.958 159.186 203.656 157.288C202.357 155.394 201.474 153.281 201.003 150.952C200.84 150.23 200.667 149.297 200.484 148.148C200.303 147.002 200.179 146.057 200.112 145.317C199.791 142.969 199.956 140.692 200.61 138.484C201.261 136.282 202.332 134.275 203.822 132.463C205.309 130.652 207.193 129.105 209.465 127.818C211.739 126.533 214.365 125.657 217.342 125.185C220.319 124.717 223.086 124.742 225.645 125.259C228.204 125.784 230.471 126.675 232.445 127.937C234.423 129.201 236.046 130.783 237.323 132.683C238.6 134.584 239.469 136.695 239.939 139.021Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M244.202 123.718C244.117 123.181 244.239 122.686 244.568 122.233C244.897 121.78 245.328 121.516 245.865 121.429L255.091 119.974C255.625 119.887 256.12 120.006 256.573 120.338C257.026 120.664 257.293 121.097 257.38 121.635L260.305 140.156C260.639 142.257 261.369 143.868 262.498 144.989C263.624 146.11 265.26 146.504 267.41 146.162C269.556 145.823 270.981 144.947 271.684 143.536C272.387 142.126 272.573 140.371 272.241 138.27L269.313 119.749C269.227 119.212 269.35 118.717 269.677 118.266C270.006 117.811 270.439 117.549 270.976 117.462L280.202 116.004C280.737 115.92 281.232 116.037 281.685 116.368C282.138 116.697 282.407 117.128 282.492 117.667L287.882 151.782C287.968 152.319 287.844 152.814 287.515 153.265C287.186 153.72 286.756 153.985 286.219 154.072L277.725 155.413C277.188 155.499 276.693 155.378 276.243 155.047C275.79 154.722 275.523 154.287 275.438 153.75L275.171 152.067C274.864 152.666 274.471 153.265 273.993 153.864C273.51 154.465 272.889 155.039 272.125 155.586C271.36 156.133 270.449 156.625 269.395 157.066C268.338 157.509 267.054 157.848 265.542 158.088C260.807 158.835 256.826 158.093 253.596 155.851C250.364 153.611 248.295 149.612 247.384 143.851L244.202 123.718Z" class="theme-color" fill="#FF9400"/>
                                                <path d="M167.601 370.943L170.188 366.919C177.518 355.515 192.706 352.214 204.109 359.547C215.513 366.877 218.817 382.065 211.484 393.469L185.308 434.186C180.797 441.205 171.452 443.234 164.434 438.725L123.719 412.549C112.315 405.216 109.011 390.029 116.344 378.625C123.674 367.221 138.862 363.92 150.268 371.25L154.29 373.836C158.764 376.712 164.723 375.417 167.601 370.943Z" fill="#F2536D"/>
                                                <path d="M292.361 400.716L296.219 397.553C307.163 388.587 323.301 390.186 332.27 401.129C341.238 412.07 339.637 428.211 328.696 437.177L289.629 469.195C282.898 474.714 272.966 473.729 267.448 466.996L235.429 427.928C226.463 416.988 228.061 400.847 239.005 391.881C249.946 382.912 266.086 384.514 275.053 395.455L278.215 399.313C281.735 403.606 288.068 404.235 292.361 400.716Z" fill="#F2536D"/>
                                                <path d="M256.382 316.392L258.042 315.031C262.752 311.171 269.699 311.861 273.557 316.571C277.417 321.278 276.729 328.224 272.02 332.085L255.206 345.862C252.308 348.238 248.034 347.815 245.661 344.917L231.881 328.103C228.021 323.396 228.711 316.449 233.418 312.589C238.128 308.731 245.074 309.419 248.933 314.128L250.294 315.789C251.808 317.637 254.536 317.907 256.382 316.392Z" fill="#F2536D"/>
                                                <path d="M83.4573 318.691L85.546 316.679C91.4681 310.975 100.895 311.153 106.601 317.075C112.306 323 112.128 332.426 106.205 338.131L85.056 358.498C81.4116 362.01 75.6115 361.901 72.1002 358.256L51.7315 337.106C46.0271 331.184 46.2038 321.758 52.128 316.053C58.0511 310.346 67.4773 310.525 73.183 316.447L75.1947 318.538C77.4337 320.862 81.1322 320.931 83.4573 318.691Z" fill="#F2536D"/>
                                                <path d="M37.7919 174.117L39.2682 172.696C43.451 168.667 50.1089 168.793 54.1372 172.976H54.1381C58.1664 177.161 58.0416 183.818 53.8587 187.847L38.9219 202.23C36.3477 204.71 32.2516 204.633 29.7722 202.059L15.3875 187.124C11.3583 182.939 11.4828 176.282 15.6669 172.253C19.8498 168.224 26.5074 168.348 30.5369 172.533L31.9569 174.008C33.5385 175.649 36.1504 175.698 37.7919 174.117Z" fill="#F2536D"/>
                                                <path d="M232.11 449.665L58.7743 347.068C47.1179 340.168 33.8226 336.527 20.2778 336.527H0.875V579.442C0.875 584.721 5.15366 589 10.4319 589H450.015C455.294 589 459.572 584.721 459.572 579.442V336.527H438.477C418.043 336.527 398.042 342.427 380.879 353.519L232.11 449.665Z" fill="#F2F2F2"/>
                                                <path d="M440.118 574.51C439.214 574.51 438.301 574.275 437.472 573.777L246.587 459.462C236.539 453.446 224.019 453.387 213.915 459.311L29.0916 567.65C26.6321 569.09 23.4701 568.266 22.0297 565.806C20.5884 563.349 21.413 560.186 23.8712 558.746L208.696 450.407C222.055 442.574 238.606 442.653 251.891 450.61L442.773 564.923C445.218 566.388 446.015 569.555 444.55 572C443.582 573.617 441.872 574.51 440.118 574.51Z" class="theme-color" fill="#FF9400"/>
                                            </svg>
                                            <?php else: ?>
                                                <img id="svg_text_preview"
                                                    src="<?php echo e(isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text : ''); ?>">
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

<?php echo $__env->make('card.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/card/theme16/index.blade.php ENDPATH**/ ?>