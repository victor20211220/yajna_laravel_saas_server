<?php $__env->startSection('contentCard'); ?>
<?php if($themeName): ?>
<div class="<?php echo e($themeName); ?>" id="view_theme13">
<?php else: ?>
<div class="<?php echo e($business->theme_color); ?>" id="view_theme13">
<?php endif; ?>
     <main id="boxes">
         <div class="card-wrapper <?php if(!isset($is_pdf)): ?> scrollbar <?php endif; ?>">
            <div class="salon-card">
                <section class="profile-sec pb">
                    <div class="profile-banner-wrp">
                        <div class="profile-banner img-wrapper">
                            <img src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme13/images/profile-banner.png')); ?>" alt="profile-banner-img" id="banner_preview"  class="profile-banner-img" loading="lazy">
                        </div>
                    </div>
                    <div class="container">
                        <div class="client-info-wrp">
                            <div class="client-image">
                                <img id="business_logo_preview"  src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme13/images/client-image.png')); ?>"   alt="client-image" loading="lazy">
                            </div>
                            <div class="client-info text-center">
                                <h2 id="<?php echo e($stringid . '_title'); ?>_preview"><?php echo e($business->title); ?></h2>
                                <p id="<?php echo e($stringid . '_designation'); ?>_preview"><?php echo e($business->designation); ?></p>
                                <span id="<?php echo e($stringid . '_subtitle'); ?>_preview"><?php echo e($business->sub_title); ?></span>
                            </div>
                        </div>
                        <div class="social-content">
                            <p id="<?php echo e($stringid . '_desc'); ?>_preview">
                                <?php echo nl2br(e($business->description)); ?></p>
                        </div>
                    </div>
                </section>
                <?php $j = 1; ?>
            <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($j == $order_value): ?>

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
                                                <img src="<?php echo e(asset('custom/theme7/icon/social/' . strtolower($social_key1) . '.svg')); ?>" alt="social-image" loading="lazy">
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
                <?php if($order_key == 'gallery'): ?>
                <section class="gallery-sec pb" id="gallery-div">
                    <div class="section-title common-title text-center">
                        <h2><?php echo e(__('Gallery')); ?></h2>
                    </div>
                         <?php $image_count = 0; ?>
                        <?php if(isset($is_pdf)): ?>
                          <div class="gallery-card edit-card">
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
                        <div class="container">
                            <div class="gallery-slider"  id="inputrow_gallery_preview">
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
                                                        class="gallery-popup-btn img-wrapper">
                                                        <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>" alt="images" class="imageresource">
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
                                                            class="video-popup-btn play-btn img-wrapper">
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
                                                            class="video-popup-btn play-btn img-wrapper">
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
                                                        class="gallery-popup-btn img-wrapper">
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
                            </div>
                        </div>
                        <?php endif; ?>
                </section>
                <?php endif; ?>
                <?php if($order_key == 'contact_info'): ?>
                <section class="contact-info-sec pb" id="contact-div">
                        <div class="section-title common-title text-center">
                            <h2><?php echo e(__('Contact')); ?></h2>
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
                                                        <img src="<?php echo e(asset('custom/theme13/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                    </div>
                                                        <a href="<?php echo e($href); ?>" target="_blank" class="contact-item">
                                                            <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($key2 == 'Address'): ?>
                                                                    <span id="<?php echo e($key1 . '_' . $nos); ?>_preview">
                                                                        <?php echo e($val2); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </a>
                                                <?php else: ?>
                                                    <div class="contact-image">
                                                        <img src="<?php echo e(asset('custom/theme13/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                    </div>
                                                        <?php if($key1 == 'Whatsapp'): ?>
                                                            <a href="https://wa.me/<?php echo e($href); ?>" target="_blank" class="contact-item">
                                                        <?php else: ?>
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
                                                    <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                    width="28" height="28"
                                                    src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                    class="img-fluid" alt="service-image">
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
                                                        class="btn"><?php echo e($content->link_title); ?>

                                                    </a>
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
                                                    <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                    width="28" height="28"
                                                    src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                    class="img-fluid" alt="service-image">
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
                                                        class="btn"><?php echo e($content->link_title); ?>

                                                    </a>
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
                    </div>

                        <?php endif; ?>
                </section>
                <?php endif; ?>
                <?php if($order_key == 'bussiness_hour'): ?>
                <section class="business-hour-sec pb" id="business-hours-div">
                        <div class="section-title common-title text-center">
                                <h2><?php echo e(__('Business Hours')); ?></h2>
                        </div>
                        <div class="container">
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
                        </div>
                </section>
                <?php endif; ?>
                <?php if($order_key=='product'): ?>
                <section class="product-sec pb" id="product-div">
                    <div class="section-title common-title text-center">
                        <h2><?php echo e(__('Product')); ?></h2>
                    </div>
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
                                                <h3  id="<?php echo e('product_title_' . $product_row_nos . '_preview'); ?>">
                                                <?php echo e($content->title); ?></h3>
                                                <p id="<?php echo e('product_description_' . $product_row_nos . '_preview'); ?>">
                                                    <?php echo e($content->description); ?></p>
                                            </div>
                                            <div class="product-content-bottom d-flex align-items-center justify-content-between">
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
                        <div class="container">
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
                                                    <h3  id="<?php echo e('product_title_' . $product_row_nos . '_preview'); ?>">
                                                    <?php echo e($content->title); ?></h3>
                                                    <p id="<?php echo e('product_description_' . $product_row_nos . '_preview'); ?>">
                                                        <?php echo e($content->description); ?></p>
                                                </div>
                                                <div class="product-content-bottom d-flex align-items-center justify-content-between">
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
                        </div>
                        <?php endif; ?>
                </section>
                <?php endif; ?>
                <?php if($order_key == 'appointment'): ?>
                <section class="appointment-sec pb" id="appointment-div">
                    <div class="section-title common-title text-center">
                        <h2><?php echo e(__('Appointment')); ?></h2>
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
                        <h2><?php echo e(__('Testimonials')); ?></h2>
                    </div>
                    <div class="container">
                        <?php if(isset($is_pdf)): ?>
                            <?php
                            $t_image_count = 0;
                            $rating = 0;
                            ?>
                            <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="testimonial-card edit-card"  id="testimonials_<?php echo e($testimonials_row_nos); ?>">
                                    <div class="testimonial-card-inner">
                                        <div class="testimonial-content">
                                            <p id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>">
                                                <?php echo e($testi_content->description); ?> </p>
                                            <div class="rating d-flex align-items-center justify-content-center">
                                                <?php
                                                if (!empty($testi_content->rating)) {
                                                    $rating = (int) $testi_content->rating;
                                                    $overallrating = $rating;
                                                } else {
                                                    $overallrating = 0;
                                                }
                                                ?>
                                                <span
                                                    id="<?php echo e('stars' . $testimonials_row_nos); ?>_star"
                                                    class="stars">
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
                                        <div class="testimonial-image">
                                            <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>" src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' .$testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" alt="image">
                                        </div>
                                        <h3  id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                            <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                        </h3>
                                    </div>
                                </div>
                                <?php
                                $t_image_count++;
                                $testimonials_row_nos++;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <div class="slider-wrapper">
                            <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                <?php
                                    $t_image_count = 0;
                                    $rating = 0;
                                ?>
                                <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="testimonial-card"  id="testimonials_<?php echo e($testimonials_row_nos); ?>">
                                    <div class="testimonial-card-inner">
                                            <div class="testimonial-content">
                                                <p id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>">
                                                    <?php echo e($testi_content->description); ?> </p>
                                                <div class="rating d-flex align-items-center justify-content-center">
                                                    <?php
                                                    if (!empty($testi_content->rating)) {
                                                        $rating = (int) $testi_content->rating;
                                                        $overallrating = $rating;
                                                    } else {
                                                        $overallrating = 0;
                                                    }
                                                    ?>
                                                    <span
                                                        id="<?php echo e('stars' . $testimonials_row_nos); ?>_star"
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
                                            <div class="testimonial-image">
                                                <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>" src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' .$testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" alt="image">
                                            </div>
                                            <h3  id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                            </h3>
                                        </div>
                                    </div>
                                    <?php
                                    $t_image_count++;
                                    $testimonials_row_nos++;
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
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
                                        class="d-flex align-items-center justify-content-center" target="_blank">
                                        <img src="<?php echo e(asset('custom/img/payments/stripe.png')); ?>"
                                            alt="payment-image" class="img-fluid" loading="lazy">
                                        <span><?php echo e(__('Stripe')); ?></span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(isset($cardPayment_content->paypal) && $cardPayment_content->paypal->status == 'on'): ?>
                                <li>
                                    <a href="<?php echo e(route('card.pay.with.paypal', $business->id)); ?>" class="d-flex align-items-center justify-content-center" target="_blank">
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
                    <div class="section-title text-center">
                        <h2><?php echo e(__('Download Here')); ?></h2>
                    </div>
                    <?php if(!is_null($appInfo)): ?>
                    <div class="container">
                        <ul class="d-flex align-items-center">
                            <?php if(!empty($appInfo->playstore_id ) && !empty($appInfo->appstore_id )): ?>
                            <li>
                                <a href="<?php echo e($appInfo->playstore_id); ?>" target="_blank"
                                    class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo e(asset('custom/icon/apps/playstore' . $appInfo->variant . '.png')); ?>"
                                        alt="play-store" loading="lazy">
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
                        <div class="thankyou-svg pt mb">
                            <?php if(empty($business->svg_text)): ?>
                                <svg width="515" height="338" viewBox="0 0 515 338" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                        <path d="M82.6609 292.453H74.4766V292.776H82.6609V292.453Z" fill="#EBEBEB" />
                                        <path d="M47.0954 277.252H25.7773V286.105H47.0954V277.252Z" fill="#E0E0E0" />
                                        <path d="M58.9411 268.467H37.623V277.319H58.9411V268.467Z" fill="#E6E6E6" />
                                        <path d="M418.23 8.78516H396.912V17.6377H418.23V8.78516Z" fill="#E0E0E0" />
                                        <path d="M430.078 0H408.76V8.85255H430.078V0Z" fill="#E6E6E6" />
                                        <path d="M234.67 17.6035H213.352V26.4561H234.67V17.6035Z" fill="#E0E0E0" />
                                        <path d="M246.517 8.81836H225.199V17.6709H246.517V8.81836Z" fill="#E6E6E6" />
                                        <path d="M396.949 187.023H375.631V195.876H396.949V187.023Z" fill="#E0E0E0" />
                                        <path d="M409.502 195.711H388.184V204.563H409.502V195.711Z" fill="#F0F0F0" />
                                        <path d="M365.291 112.031H343.973V120.884H365.291V112.031Z" fill="#E0E0E0" />
                                        <path d="M377.843 120.719H356.525V129.571H377.843V120.719Z" fill="#F0F0F0" />
                                        <path d="M43.1168 111.41H21.7988V120.263H43.1168V111.41Z" fill="#E0E0E0" />
                                        <path d="M55.6696 120.098H34.3516V128.95H55.6696V120.098Z" fill="#F5F5F5" />
                                        <path d="M178.131 290.316H156.812V299.169H178.131V290.316Z" fill="#E0E0E0" />
                                        <path d="M190.683 299.002H169.365V307.855H190.683V299.002Z" fill="#F5F5F5" />
                                        <path d="M502.181 67.4004H480.863V76.2529H502.181V67.4004Z" fill="#E0E0E0" />
                                        <path d="M514.734 76.0879H493.416V84.9404H514.734V76.0879Z" fill="#F5F5F5" />
                                        <path d="M274.47 244.916H253.152V253.769H274.47V244.916Z" fill="#E0E0E0" />
                                        <path d="M177.853 209.174H156.535V218.026H177.853V209.174Z" fill="#E0E0E0" />
                                        <path d="M506.332 273.869H485.014V282.722H506.332V273.869Z" fill="#E0E0E0" />
                                        <path d="M331.652 306.051H310.334V314.903H331.652V306.051Z" fill="#E0E0E0" />
                                        <path d="M285.963 236.727H264.645V245.579H285.963V236.727Z" fill="#E0E0E0" />
                                        <path d="M510.142 192.152H488.824V201.005H510.142V192.152Z" fill="#E0E0E0" />
                                        <path d="M118.804 9.42383H97.4863V18.2764H118.804V9.42383Z" fill="#E0E0E0" />
                                        <path
                                            d="M343.625 307.104C343.611 306.68 342.184 264.553 335.331 257.889C328.667 251.41 321.017 257.648 320.695 257.916L320.008 257.093C320.095 257.02 328.727 249.973 336.079 257.12C343.238 264.083 344.639 305.318 344.695 307.07L343.625 307.104Z"
                                            fill="#263238" />
                                        <path
                                            d="M344.213 315.384C344.164 314.88 339.531 264.81 357.816 243.824L358.624 244.528C340.642 265.166 345.233 314.781 345.28 315.279L344.213 315.384Z"
                                            fill="#263238" />
                                        <path
                                            d="M343.538 310.088L342.467 310.016C342.505 309.449 346.046 253.093 332.633 240.756L333.359 239.967C347.147 252.65 343.691 307.748 343.538 310.088Z"
                                            fill="#263238" />
                                        <path
                                            d="M345.281 310.056L344.209 310.047C344.222 308.495 344.651 271.982 355.023 266.038C357.329 264.716 359.586 264.496 361.734 265.384C368.006 267.978 371.114 279.14 371.243 279.613L370.208 279.896C370.178 279.785 367.109 268.767 361.323 266.375C359.499 265.622 357.559 265.821 355.556 266.968C345.714 272.608 345.284 309.682 345.281 310.056Z"
                                            fill="#263238" />
                                        <path
                                            d="M341.243 310.083L340.173 310.022C340.189 309.734 341.737 281.167 334.028 271.103C332.16 268.665 330.132 267.502 327.99 267.652C322.939 268.005 318.703 275.397 318.661 275.471L317.727 274.944C317.91 274.619 322.286 266.977 327.913 266.583C330.431 266.404 332.777 267.707 334.879 270.451C342.83 280.832 341.311 308.894 341.243 310.083Z"
                                            fill="#263238" />
                                        <path
                                            d="M342.933 313.968C342.723 311.197 337.893 245.97 346.391 234.477L347.253 235.113C338.99 246.29 343.951 313.212 344.002 313.886L342.933 313.968Z"
                                            fill="#263238" />
                                        <path
                                            d="M365.588 268.986C365.588 268.986 360.165 270.99 362.006 275.303C367.195 287.454 379.559 288.749 379.559 288.749C379.559 288.749 385.361 279.564 380.605 272.429C374.049 262.594 365.726 265.81 365.588 268.986Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M341.883 263.549C341.883 263.549 347.312 263.321 347.62 268C347.928 272.679 335.859 285.623 335.859 285.623C335.859 285.623 327.246 282.509 329.096 270.834C330.946 259.158 340.533 260.671 341.883 263.549Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M344.516 236.282C344.516 236.282 342.236 236.002 341.379 233.949C338.821 227.829 347.611 221.229 359.363 224.716C359.363 224.716 359.674 235.058 353.35 239.136C347.026 243.216 344.516 236.282 344.516 236.282Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M332.688 243.174C332.688 243.174 332.083 246.091 329.34 246.982C321.157 249.64 313.557 237.578 319.311 222.756C319.311 222.756 332.712 223.45 337.315 232.058C341.917 240.664 332.688 243.174 332.688 243.174Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M324.378 268.352C324.378 268.352 326.269 265.759 323.411 265.504C320.552 265.25 308.178 270.796 311.431 283.488C311.431 283.488 327.348 278.297 327.9 272.983C328.451 267.668 324.378 268.352 324.378 268.352Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M358.311 240.823C358.311 240.823 359.026 238.468 361.721 237.483C364.417 236.498 374.432 237.117 374.57 250.22C374.57 250.22 359.165 252.78 357.258 247.789C355.35 242.798 358.311 240.823 358.311 240.823Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M349.999 251.711C349.999 251.711 351.034 249.916 353.014 250.877C354.993 251.837 360.829 257.842 355.264 265.09C355.264 265.09 344.925 258.873 345.77 254.51C346.549 250.488 349.999 251.711 349.999 251.711Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M324.663 254.872C324.663 254.872 326.156 252.915 323.969 252.673C321.782 252.431 311.982 255.047 314.264 264.831C314.264 264.831 326.204 263.934 326.716 259.869C327.227 255.804 324.663 254.872 324.663 254.872Z"
                                            fill="#407BFF" />
                                        <path d="M356.669 329.742H330.772L322.82 296.996H364.458L356.669 329.742Z" fill="#263238" />
                                        <path d="M366.286 292.859H320.992V301.134H366.286V292.859Z" fill="#263238" />
                                        <path opacity="0.2" d="M323.814 301.111H363.464L362.489 305.209H324.81L323.814 301.111Z"
                                            fill="#111111" />
                                        <g opacity="0.2">
                                            <path
                                                d="M365.588 268.986C365.588 268.986 360.165 270.99 362.006 275.303C367.195 287.454 379.559 288.749 379.559 288.749C379.559 288.749 385.361 279.564 380.605 272.429C374.049 262.594 365.726 265.81 365.588 268.986Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M341.887 263.549C341.887 263.549 347.315 263.321 347.624 268C347.932 272.679 335.863 285.623 335.863 285.623C335.863 285.623 327.25 282.509 329.1 270.834C330.95 259.158 340.537 260.671 341.887 263.549Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M344.516 236.282C344.516 236.282 342.236 236.002 341.379 233.949C338.821 227.829 347.611 221.229 359.363 224.716C359.363 224.716 359.674 235.058 353.35 239.136C347.026 243.216 344.516 236.282 344.516 236.282Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M332.69 243.174C332.69 243.174 332.085 246.091 329.342 246.982C321.159 249.64 313.559 237.578 319.313 222.756C319.313 222.756 332.714 223.45 337.317 232.058C341.919 240.664 332.69 243.174 332.69 243.174Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M324.378 268.352C324.378 268.352 326.269 265.759 323.411 265.504C320.552 265.25 308.178 270.796 311.431 283.488C311.431 283.488 327.348 278.297 327.9 272.983C328.451 267.668 324.378 268.352 324.378 268.352Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M358.313 240.823C358.313 240.823 359.028 238.468 361.723 237.483C364.419 236.498 374.434 237.117 374.572 250.22C374.572 250.22 359.167 252.78 357.26 247.789C355.352 242.798 358.313 240.823 358.313 240.823Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M349.999 251.711C349.999 251.711 351.034 249.916 353.014 250.877C354.993 251.837 360.829 257.842 355.264 265.09C355.264 265.09 344.925 258.873 345.77 254.51C346.549 250.488 349.999 251.711 349.999 251.711Z"
                                                fill="white" />
                                        </g>
                                        <g opacity="0.2">
                                            <path
                                                d="M324.665 254.872C324.665 254.872 326.158 252.915 323.971 252.673C321.784 252.431 311.983 255.047 314.266 264.831C314.266 264.831 326.205 263.934 326.718 259.869C327.229 255.804 324.665 254.872 324.665 254.872Z"
                                                fill="white" />
                                        </g>
                                        <path
                                            d="M178.832 232.248C180.389 229.735 182.762 228.887 185.329 228.77C187.331 228.679 188.859 229.513 190.702 230.547C191.556 231.026 192.573 231.931 193.486 232.973C193.546 231.589 193.774 230.247 194.141 229.339C194.933 227.38 195.604 225.773 197.223 224.593C199.299 223.079 201.682 222.257 204.468 223.245C207.086 224.173 208.483 227.088 208.775 229.85C209.066 232.613 208.298 235.793 207.318 238.258C205.263 243.426 203.26 247.495 199.859 251.117C193.665 249.975 190.833 248.495 185.997 245.747C183.692 244.436 181.102 242.435 179.602 240.097C178.101 237.758 177.37 234.608 178.832 232.248Z"
                                            fill="#407BFF" />
                                        <g opacity="0.5">
                                            <path
                                                d="M178.832 232.248C180.389 229.735 182.762 228.887 185.329 228.77C187.331 228.679 188.859 229.513 190.702 230.547C191.556 231.026 192.573 231.931 193.486 232.973C193.546 231.589 193.774 230.247 194.141 229.339C194.933 227.38 195.604 225.773 197.223 224.593C199.299 223.079 201.682 222.257 204.468 223.245C207.086 224.173 208.483 227.088 208.775 229.85C209.066 232.613 208.298 235.793 207.318 238.258C205.263 243.426 203.26 247.495 199.859 251.117C193.665 249.975 190.833 248.495 185.997 245.747C183.692 244.436 181.102 242.435 179.602 240.097C178.101 237.758 177.37 234.608 178.832 232.248Z"
                                                fill="white" />
                                        </g>
                                        <path class="theme-color"
                                            d="M378.332 143.683C380.493 143.12 382.233 143.892 383.698 145.165C384.84 146.158 385.241 147.411 385.711 148.937C385.929 149.644 386.013 150.668 385.969 151.714C386.724 150.988 387.547 150.373 388.221 150.068C389.675 149.409 390.88 148.879 392.38 149.078C394.304 149.332 396.036 150.123 397.045 152.115C397.993 153.986 397.24 156.31 395.959 157.972C394.679 159.635 392.602 160.974 390.781 161.812C386.964 163.568 383.749 164.75 380.002 164.959C377.208 161.107 376.431 158.822 375.217 154.799C374.639 152.88 374.266 150.436 374.663 148.376C375.062 146.316 376.302 144.213 378.332 143.683Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M273.883 225.718C276.044 225.155 277.784 225.928 279.248 227.2C280.391 228.193 280.792 229.446 281.262 230.972C281.479 231.68 281.564 232.703 281.52 233.749C282.274 233.024 283.098 232.408 283.772 232.103C285.226 231.444 286.43 230.915 287.931 231.113C289.855 231.367 291.587 232.158 292.596 234.15C293.544 236.021 292.791 238.345 291.51 240.008C290.23 241.67 288.152 243.009 286.332 243.847C282.515 245.604 279.3 246.785 275.552 246.994C272.759 243.142 271.982 240.857 270.768 236.835C270.19 234.916 269.817 232.472 270.214 230.412C270.612 228.352 271.853 226.247 273.883 225.718Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M183.996 18.5403C184.626 16.7285 186.007 15.8544 187.615 15.4159C188.869 15.0733 189.955 15.3844 191.268 15.7769C191.877 15.9589 192.649 16.3867 193.375 16.9174C193.217 16.0326 193.17 15.1509 193.274 14.5242C193.496 13.1716 193.693 12.0587 194.551 11.0818C195.65 9.82909 197.041 8.96964 198.946 9.19929C200.735 9.41511 202.033 11.0618 202.61 12.7684C203.187 14.4758 203.152 16.5987 202.881 18.2976C202.314 21.8606 201.625 24.7208 199.987 27.4966C195.904 27.6532 193.9 27.1187 190.45 26.0657C188.804 25.5634 186.881 24.6648 185.599 23.3975C184.317 22.1317 183.406 20.2423 183.996 18.5403Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M16.7378 57.8764C18.0658 56.4924 19.6863 56.2758 21.33 56.5484C22.6126 56.7612 23.4698 57.497 24.499 58.4025C24.9759 58.8218 25.499 59.5338 25.9367 60.318C26.1625 59.4478 26.4882 58.6275 26.8438 58.1014C27.6111 56.9655 28.2547 56.0369 29.4414 55.5069C30.9636 54.8272 32.5858 54.6275 34.2202 55.6314C35.7555 56.5738 36.2486 58.6129 36.0596 60.4048C35.8707 62.1967 34.9529 64.1114 33.9974 65.5423C31.9951 68.5438 30.1733 70.8541 27.5258 72.6921C23.7501 71.1299 22.1533 69.808 19.4575 67.4102C18.1717 66.2666 16.7992 64.6467 16.1641 62.9609C15.5289 61.2735 15.4905 59.1759 16.7378 57.8764Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M480.148 27.0233C481.973 26.4296 483.503 27.0033 484.824 28.0194C485.854 28.812 486.263 29.8658 486.744 31.1492C486.966 31.7445 487.092 32.6177 487.108 33.5171C487.717 32.8566 488.392 32.2867 488.953 31.9902C490.166 31.3512 491.171 30.8359 492.468 30.9288C494.131 31.0478 495.655 31.6377 496.622 33.2936C497.531 34.8489 497.003 36.8797 495.991 38.3704C494.979 39.8612 493.266 41.1154 491.748 41.9265C488.566 43.6277 485.87 44.8052 482.668 45.1761C480.077 42.0171 479.293 40.0978 478.048 36.7115C477.454 35.0962 477.009 33.021 477.244 31.2337C477.479 29.448 478.436 27.5809 480.148 27.0233Z"
                                            fill="#B76E79" />
                                        <path
                                            d="M480.481 120.443C484.234 119.348 487.316 120.612 489.943 122.765C491.992 124.445 492.758 126.616 493.657 129.261C494.073 130.488 494.273 132.275 494.249 134.107C495.531 132.799 496.941 131.681 498.104 131.113C500.615 129.887 502.695 128.9 505.33 129.172C508.71 129.519 511.778 130.816 513.645 134.25C515.399 137.476 514.197 141.578 512.041 144.551C509.885 147.524 506.317 149.972 503.175 151.529C496.587 154.794 491.021 157.023 484.475 157.578C479.395 150.98 477.918 147.022 475.594 140.046C474.485 136.718 473.708 132.463 474.299 128.838C474.892 125.215 476.958 121.471 480.481 120.443Z"
                                            fill="#407BFF" />
                                        <g opacity="0.5">
                                            <path
                                                d="M480.481 120.443C484.234 119.348 487.316 120.612 489.943 122.765C491.992 124.445 492.758 126.616 493.657 129.261C494.073 130.488 494.273 132.275 494.249 134.107C495.531 132.799 496.941 131.681 498.104 131.113C500.615 129.887 502.695 128.9 505.33 129.172C508.71 129.519 511.778 130.816 513.645 134.25C515.399 137.476 514.197 141.578 512.041 144.551C509.885 147.524 506.317 149.972 503.175 151.529C496.587 154.794 491.021 157.023 484.475 157.578C479.395 150.98 477.918 147.022 475.594 140.046C474.485 136.718 473.708 132.463 474.299 128.838C474.892 125.215 476.958 121.471 480.481 120.443Z"
                                                fill="white" />
                                        </g>
                                        <path
                                            d="M0.320767 138.601C1.11186 135.752 3.15257 134.275 5.58422 133.444C7.48054 132.795 9.181 133.168 11.2401 133.645C12.1948 133.865 13.4229 134.45 14.5912 135.195C14.2617 133.849 14.105 132.497 14.2025 131.523C14.4145 129.42 14.6088 127.689 15.8331 126.103C17.403 124.069 19.4591 122.613 22.4107 122.781C25.1826 122.939 27.3416 125.346 28.3946 127.916C29.4476 130.487 29.5996 133.755 29.3492 136.396C28.8239 141.933 28.0397 146.399 25.7886 150.828C19.5228 151.466 16.3892 150.838 10.9782 149.553C8.39759 148.941 5.3515 147.745 3.25703 145.921C1.16178 144.095 -0.421938 141.276 0.320767 138.601Z"
                                            fill="#407BFF" />
                                        <g opacity="0.5">
                                            <path
                                                d="M0.320767 138.601C1.11186 135.752 3.15257 134.275 5.58422 133.444C7.48054 132.795 9.181 133.168 11.2401 133.645C12.1948 133.865 13.4229 134.45 14.5912 135.195C14.2617 133.849 14.105 132.497 14.2025 131.523C14.4145 129.42 14.6088 127.689 15.8331 126.103C17.403 124.069 19.4591 122.613 22.4107 122.781C25.1826 122.939 27.3416 125.346 28.3946 127.916C29.4476 130.487 29.5996 133.755 29.3492 136.396C28.8239 141.933 28.0397 146.399 25.7886 150.828C19.5228 151.466 16.3892 150.838 10.9782 149.553C8.39759 148.941 5.3515 147.745 3.25703 145.921C1.16178 144.095 -0.421938 141.276 0.320767 138.601Z"
                                                fill="white" />
                                        </g>
                                        <path
                                            d="M258.356 4.13882C261.3 3.87 263.405 5.25557 265.043 7.23483C266.321 8.77862 266.575 10.5014 266.858 12.5951C266.989 13.5659 266.879 14.9215 266.595 16.2779C267.737 15.4929 268.946 14.8677 269.892 14.6143C271.933 14.0674 273.62 13.6365 275.538 14.2203C277.996 14.9676 280.086 16.3754 280.974 19.1949C281.808 21.8432 280.321 24.7149 278.291 26.6097C276.26 28.5045 273.257 29.8048 270.698 30.5052C265.334 31.9745 260.88 32.8232 255.94 32.2856C253.125 26.6512 252.603 23.4991 251.888 17.9829C251.547 15.3524 251.588 12.0805 252.552 9.47524C253.516 6.87078 255.591 4.39151 258.356 4.13882Z"
                                            fill="#407BFF" />
                                        <g opacity="0.5">
                                            <path
                                                d="M258.356 4.13882C261.3 3.87 263.405 5.25557 265.043 7.23483C266.321 8.77862 266.575 10.5014 266.858 12.5951C266.989 13.5659 266.879 14.9215 266.595 16.2779C267.737 15.4929 268.946 14.8677 269.892 14.6143C271.933 14.0674 273.62 13.6365 275.538 14.2203C277.996 14.9676 280.086 16.3754 280.974 19.1949C281.808 21.8432 280.321 24.7149 278.291 26.6097C276.26 28.5045 273.257 29.8048 270.698 30.5052C265.334 31.9745 260.88 32.8232 255.94 32.2856C253.125 26.6512 252.603 23.4991 251.888 17.9829C251.547 15.3524 251.588 12.0805 252.552 9.47524C253.516 6.87078 255.591 4.39151 258.356 4.13882Z"
                                                fill="white" />
                                        </g>
                                        <path
                                            d="M77.6304 63.4339H59.0352V46.834H117.633V63.4339L99.0375 63.3309V110.227L77.6304 110.33V63.4339Z"
                                            fill="#263238" />
                                        <path
                                            d="M193.199 46.834V110.33H171.791V86.927H152.016V110.33H130.609V46.834H152.016V69.3294H171.791V46.834H193.199Z"
                                            fill="#263238" />
                                        <path
                                            d="M246.81 99.2634H222.682L218.419 110.33H196.648L224.406 46.834H245.45L273.208 110.33H251.075L246.81 99.2634ZM240.914 83.8425L234.746 67.8778L228.579 83.8425H240.914Z"
                                            fill="#263238" />
                                        <path
                                            d="M345.378 46.834V110.33H327.781L303.652 81.4846V110.33H282.789V46.834H300.387L324.516 75.6797V46.834H345.378Z"
                                            fill="#263238" />
                                        <path class="theme-color"
                                            d="M72.4293 63.4339H53.834V46.834H112.432V63.4339H93.8364V110.33H72.4293V63.4339Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M188.354 46.834V110.33H166.946V86.927H147.171V110.33H125.764V46.834H147.171V69.3294H166.946V46.834H188.354Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M241.967 99.2634H217.839L213.575 110.33H191.805L219.562 46.834H240.606L268.363 110.33H246.23L241.967 99.2634ZM236.071 83.8425L229.902 67.8778L223.735 83.8425H236.071Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M340.535 46.834V110.33H322.937L298.809 81.4846V110.33H277.945V46.834H295.543L319.672 75.6797V46.834H340.535Z"
                                            fill="#B76E79" />
                                        <path opacity="0.3"
                                            d="M99.0382 87.0052C99.0382 87.0052 93.284 86.6619 91.7394 89.0644C90.1949 91.4669 90.6987 95.6712 90.6987 95.6712C90.6987 95.6712 86.8861 98.3255 87.4253 102.533C87.9645 106.74 90.6987 110.267 90.6987 110.267H98.6158L99.0382 87.0052Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M99.0382 87.0052C99.0382 87.0052 93.284 86.6619 91.7394 89.0644C90.1949 91.4669 90.6987 95.6712 90.6987 95.6712C90.6987 95.6712 86.8861 98.3255 87.4253 102.533C87.9645 106.74 90.6987 110.267 90.6987 110.267H98.6158L99.0382 87.0052Z"
                                            fill="#111111" />
                                        <path
                                            d="M206.662 164.499C206.662 145.268 221.81 131.299 242.492 131.299C263.175 131.299 278.323 145.268 278.323 164.499C278.323 183.729 263.175 197.698 242.492 197.698C221.81 197.698 206.662 183.729 206.662 164.499ZM256.734 164.499C256.734 154.611 250.385 148.625 242.492 148.625C234.6 148.625 228.251 154.611 228.251 164.499C228.251 174.386 234.601 180.373 242.492 180.373C250.384 180.373 256.734 174.386 256.734 164.499Z"
                                            fill="#263238" />
                                        <path class="theme-color"
                                            d="M201.619 164.499C201.619 145.268 216.767 131.299 237.449 131.299C258.132 131.299 273.28 145.268 273.28 164.499C273.28 183.729 258.132 197.698 237.449 197.698C216.767 197.698 201.619 183.729 201.619 164.499ZM251.691 164.499C251.691 154.611 245.342 148.625 237.449 148.625C229.557 148.625 223.208 154.611 223.208 164.499C223.208 174.386 229.558 180.373 237.449 180.373C245.341 180.373 251.691 174.386 251.691 164.499Z"
                                            fill="#B76E79" />
                                        <path
                                            d="M286.992 167.468L290.434 132.715L311.736 134.825L308.358 168.945C307.402 178.604 310.746 182.581 316.702 183.171C322.66 183.761 326.72 180.517 327.676 170.859L331.054 136.738L351.995 138.812L348.554 173.564C346.677 192.521 334.221 202.316 314.815 200.395C295.407 198.472 285.114 186.424 286.992 167.468Z"
                                            fill="#263238" />
                                        <path class="theme-color"
                                            d="M282.828 167.055L286.27 132.303L307.571 134.413L304.193 168.533C303.237 178.191 306.581 182.169 312.537 182.759C318.495 183.349 322.555 180.105 323.511 170.446L326.889 136.326L347.83 138.4L344.389 173.152C342.512 192.109 330.056 201.904 310.65 199.983C291.243 198.06 280.951 186.012 282.828 167.055Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M380.797 92.4413L375.045 96.7631L372.011 112.159L351.363 108.091L363.638 45.793L384.286 49.8613L379.832 72.4666L404.756 53.8944L427.628 58.4005L397.308 80.9021L416.6 120.944L392.303 116.157L380.797 92.4413Z"
                                            fill="#263238" />
                                        <path
                                            d="M466.981 239.268L466.995 252.363L460.402 252.835L458.086 240.533C461.101 238.526 464.068 238.046 466.981 239.268Z"
                                            fill="#FDAD6D" />
                                        <path
                                            d="M466.762 250.911C467.41 252.639 467.453 259.709 467.453 259.709L453.48 259.725C452.65 257.168 453.935 255.422 455.565 255.191C456.265 255.093 457.089 254.374 457.689 253.746C457.693 253.665 458.548 249.737 459.076 249.549C459.076 249.549 459.44 249.14 459.75 249.548C460.06 249.956 460.329 251.283 460.329 251.283C462.509 248.579 464.646 248.94 466.762 250.911Z"
                                            fill="#263238" />
                                        <path
                                            d="M466.927 252.965C465.348 252.384 463.654 252.605 462.277 253.57C462.036 253.739 461.808 253.344 462.046 253.176C463.513 252.147 465.366 251.906 467.048 252.525C467.321 252.626 467.204 253.067 466.927 252.965Z"
                                            fill="white" />
                                        <path
                                            d="M453.525 258.692L467.292 258.677C467.418 258.677 467.52 258.575 467.52 258.449C467.52 258.323 467.418 258.221 467.292 258.221L453.525 258.235C453.399 258.235 453.297 258.337 453.297 258.463C453.297 258.589 453.399 258.692 453.525 258.692Z"
                                            fill="white" />
                                        <path
                                            d="M432.818 237.903L432.834 252.682L426.492 253.165L423.371 239.331C425.918 237.441 428.876 236.515 432.818 237.903Z"
                                            fill="#FDAD6D" />
                                        <path
                                            d="M433.093 251.286C433.741 253.014 433.784 260.085 433.784 260.085L417.732 260.102C416.902 257.546 418.637 256.029 420.266 255.797C420.966 255.699 423.42 254.748 424.02 254.121C424.024 254.039 424.879 250.112 425.407 249.924C425.407 249.924 425.771 249.516 426.08 249.923C426.39 250.331 426.659 251.658 426.659 251.658C428.841 248.953 430.978 249.315 433.093 251.286Z"
                                            fill="#263238" />
                                        <path
                                            d="M433.005 253.338C431.426 252.757 429.732 252.978 428.355 253.943C428.114 254.112 427.886 253.717 428.125 253.549C429.591 252.52 431.445 252.279 433.126 252.898C433.4 252.999 433.281 253.44 433.005 253.338Z"
                                            fill="white" />
                                        <path
                                            d="M417.724 259.067L433.614 259.05C433.74 259.05 433.843 258.948 433.843 258.822C433.843 258.696 433.74 258.594 433.614 258.594L417.724 258.611C417.598 258.611 417.496 258.713 417.496 258.839C417.496 258.965 417.598 259.067 417.724 259.067Z"
                                            fill="white" />
                                        <path class="theme-color"
                                            d="M376.977 91.6764L371.225 95.9983L368.191 111.395L347.543 107.326L359.817 45.0273L380.465 49.0957L376.012 71.701L400.936 53.1287L423.807 57.6349L393.488 80.1365L412.78 120.179L388.483 115.392L376.977 91.6764Z"
                                            fill="#B76E79" />
                                        <path opacity="0.3"
                                            d="M371.299 63.6309C371.299 63.6309 377.32 70.0633 377.478 72.124C377.636 74.1839 379.062 84.3252 381.757 91.2983C384.45 98.2707 389.997 105.085 396.335 105.085C402.673 105.085 407.793 102.663 407.793 102.663L393.007 84.0372L379.288 63.6408L371.299 63.6309Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M441.885 61.5874C440.853 62.3224 439.686 62.8431 438.451 63.1204C434.82 63.9637 432.336 63.3447 430.713 61.6765C432.886 62.2141 435.176 62.0252 437.232 61.1388C438.77 60.572 440.483 60.7364 441.885 61.5874Z"
                                            fill="#263238" />
                                        <path
                                            d="M429.951 50.1374C429.951 52.0022 429.126 53.5091 428.158 53.5091C427.189 53.5091 426.311 52.0022 426.311 50.1374C426.311 48.2718 427.135 46.7656 428.158 46.7656C429.18 46.7656 429.951 48.2718 429.951 50.1374Z"
                                            stroke="#263238" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M442.103 61.3991C442.037 61.4606 441.964 61.5151 441.888 61.5604C440.864 62.3407 439.698 62.9106 438.454 63.2371C434.822 64.0796 432.338 63.5781 430.715 61.9367C428.447 59.4705 427.882 55.1042 428.205 49.8315C428.262 47.7332 428.649 45.6571 429.352 43.6802C429.352 43.6802 429.352 43.5995 429.352 43.5819C429.352 43.5642 429.406 43.4298 429.442 43.3576C430.345 41.0918 432.338 39.4398 434.732 38.9728C435.754 38.7447 436.797 38.6272 437.844 38.6233C448.129 38.5427 449.976 55.5619 442.103 61.3991Z"
                                            fill="#FDAD6D" />
                                        <path
                                            d="M442.927 70.8674C443.563 73.7906 439.77 74.9833 439.77 74.9833C433.574 72.2929 432.426 69.0379 432.426 69.0379C437.599 66.3481 436.102 58.7168 436.102 58.7168L437.152 59.2368L444.531 60.6807C444.531 60.6807 442.486 64.6085 442.218 65.5048C440.819 70.213 442.927 70.8674 442.927 70.8674Z"
                                            fill="#FDAD6D" />
                                        <path
                                            d="M429.341 43.6348C429.341 43.6348 428.777 50.8084 435.618 53.9374C435.618 53.9374 438.55 61.4251 442.863 61.5235C448.754 61.6671 453.937 53.3007 451.901 44.773C449.239 33.7085 432.48 32.8122 429.341 43.6348Z"
                                            fill="#263238" />
                                        <path
                                            d="M441.885 35.9785C441.885 35.9785 435.017 34.2389 431.215 37.01C426.776 40.2381 425.09 43.5737 430.318 48.7566C430.318 48.7566 441.859 45.0177 445.696 45.8065C447.939 46.2588 450.14 46.8979 452.277 47.7166C453.112 40.0945 445.723 34.4178 441.885 35.9785Z"
                                            fill="#263238" />
                                        <path
                                            d="M432.138 50.136C432.138 50.136 433.931 58.4394 431.115 65.5231L433.273 65.9793L433.842 63.9432C434.234 64.0646 434.396 66.5461 434.889 66.6898C439.916 68.1567 448.993 70.3372 453.111 68.1061C458.787 65.0308 453.586 54.7097 453.344 48.7558C453.102 42.8019 450.519 34.0054 441.884 35.9777C433.249 37.9493 432.138 50.136 432.138 50.136Z"
                                            fill="#263238" />
                                        <path d="M426.568 49.6074H433.161" stroke="#263238" stroke-width="0.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M448.778 41.9009C448.122 40.066 448.426 37.8863 449.663 36.3809C450.901 34.8755 453.066 34.1589 454.923 34.7495C456.78 35.3409 458.155 37.271 457.985 39.2119C457.871 40.5099 457.119 41.7104 456.075 42.4892C455.03 43.2672 453.717 43.642 452.414 43.6697C454.341 45.0068 456.742 45.6451 459.078 45.4393C457.278 46.8264 454.87 47.3916 452.642 46.9523C453.899 47.8502 455.293 48.5552 456.761 49.036C455.162 49.7695 453.269 49.8325 451.625 49.2081C449.982 48.5837 448.609 47.2787 447.9 45.6689L448.778 41.9009Z"
                                            fill="#263238" />
                                        <path
                                            d="M457.327 190.079C462.339 199.836 464.88 225.079 467.596 244.183L458.268 245.682L447.276 209.697L435.67 167.844L432.191 155.093L431.276 190.468C435.187 203.161 433.988 223.483 434.244 243.434L423.601 244.517L413.163 167.807C405.093 120.399 418.893 109.199 418.893 109.199L443.489 114.149C454.625 133.087 451.98 155.093 451.98 155.093L457.327 190.079Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M436.325 167.764L435.671 167.845L432.191 155.094C432.191 155.094 439.652 142.352 437.32 135.717C437.652 136.183 445.686 148.1 436.325 167.764Z"
                                            fill="#263238" />
                                        <path opacity="0.2"
                                            d="M445.868 118.66L413.498 119.078C413.498 119.078 413.907 117.234 414.456 116.374C415.005 115.515 414.688 116.374 414.688 116.374L445.318 117.525L445.868 118.66Z"
                                            fill="#263238" />
                                        <path
                                            d="M422.356 70.2228C422.356 70.2228 430.56 67.2996 442.926 70.8687C455.291 74.4378 455.757 79.7013 455.757 79.7013C455.757 79.7013 447.92 97.4648 446.683 117.578L414.456 116.376C414.456 116.376 410.609 87.9862 422.356 70.2228Z"
                                            fill="#263238" />
                                        <path opacity="0.2"
                                            d="M455.758 79.7007C455.758 79.7007 447.921 97.4642 446.683 117.577L414.456 116.376C414.071 113.102 413.873 109.809 413.864 106.513C413.8 101.688 414.1 96.8651 414.761 92.0847C415.837 84.6423 418.052 76.6976 422.356 70.1876C422.356 70.1876 430.561 67.2644 442.926 70.8335C455.292 74.4011 455.758 79.7007 455.758 79.7007Z"
                                            fill="white" />
                                        <path opacity="0.2"
                                            d="M421.908 93.3296C421.908 93.3296 420.572 101.508 413.838 106.547C413.775 101.722 414.074 96.8995 414.736 92.1191L421.908 93.3296Z"
                                            fill="#263238" />
                                        <path
                                            d="M386.301 69.6575L382.238 63.6322C382.238 63.6322 381.62 61.0139 380.831 60.4217C380.042 59.8296 372.24 56.5031 371.299 56.5216C370.357 56.5392 370.402 62.6007 371.299 63.6322C372.195 64.6637 377.163 66.8695 378.473 67.093C379.781 67.3173 379.136 67.093 379.136 67.093L382.723 74.2666L386.301 69.6575Z"
                                            fill="#FDAD6D" />
                                        <path
                                            d="M422.357 70.2217C413.655 73.8661 405.258 78.2017 397.249 83.1879L384.131 65.2539C384.131 65.2539 380.598 66.3476 379.289 72.4989C379.289 72.4989 386.023 98.1534 394.774 100.699C403.526 103.246 421.927 93.2839 421.927 93.2839C421.927 93.2839 427.253 79.9598 422.357 70.2217Z"
                                            fill="#263238" />
                                        <path opacity="0.2"
                                            d="M422.357 70.2217C413.655 73.8661 405.258 78.2017 397.249 83.1879L384.131 65.2539C384.131 65.2539 380.598 66.3476 379.289 72.4989C379.289 72.4989 386.023 98.1534 394.774 100.699C403.526 103.246 421.927 93.2839 421.927 93.2839C421.927 93.2839 427.253 79.9598 422.357 70.2217Z"
                                            fill="white" />
                                        <path opacity="0.2"
                                            d="M444.515 91.9374C444.515 91.9374 440.857 93.2385 437.584 89.8837C434.31 86.5288 432.443 75.8867 432.443 75.8867L444.515 91.9374Z"
                                            fill="#263238" />
                                        <path
                                            d="M430.715 69.0595C430.715 69.0595 433.927 90.9935 444.305 91.9382C454.683 92.8822 459.332 75.5142 457.577 73.4612C455.822 71.4082 442.51 68.9052 430.715 69.0595Z"
                                            fill="#263238" />
                                        <path opacity="0.3"
                                            d="M430.715 69.0595C430.715 69.0595 433.927 90.9935 444.305 91.9382C454.683 92.8822 459.332 75.5142 457.577 73.4612C455.822 71.4082 442.51 68.9052 430.715 69.0595Z"
                                            fill="white" />
                                        <path
                                            d="M432.139 51.8668C432.139 50.7463 433.036 48.8538 434.829 49.1142C436.623 49.3745 437.645 53.84 433.197 54.8354C432.524 54.9782 432.139 54.2248 432.139 51.8668Z"
                                            fill="#FDAD6D" />
                                        <path d="M491.976 332.926L499.483 332.942L477.669 259.578L470.547 260.869L491.976 332.926Z"
                                            fill="#263238" />
                                        <path opacity="0.3"
                                            d="M491.976 332.926L499.483 332.942L477.669 259.578L470.547 260.869L491.976 332.926Z"
                                            fill="white" />
                                        <path d="M403.6 332.936H410.91V259.598H403.6V332.936Z" fill="#263238" />
                                        <path opacity="0.3" d="M403.6 332.936H410.91V259.598H403.6V332.936Z" fill="white" />
                                        <path d="M434.668 332.936H441.979V259.598H434.668V332.936Z" fill="#263238" />
                                        <path opacity="0.1" d="M434.668 332.936H441.979V259.598H434.668V332.936Z" fill="white" />
                                        <path d="M451.735 332.926L459.243 332.942L437.429 259.578L430.307 260.869L451.735 332.926Z"
                                            fill="#263238" />
                                        <path opacity="0.3"
                                            d="M451.735 332.926L459.243 332.942L437.429 259.578L430.307 260.869L451.735 332.926Z"
                                            fill="white" />
                                        <path d="M401.714 264.586H481.221V259.598H401.714V264.586Z" fill="#263238" />
                                        <path opacity="0.5" d="M401.714 264.586H481.221V259.598H401.714V264.586Z" fill="white" />
                                        <path opacity="0.3" d="M437.606 264.586H480.879V259.598H437.606V264.586Z" fill="white" />
                                        <path d="M425.247 289.889H490.92V284.901H425.247V289.889Z" fill="#263238" />
                                        <path opacity="0.5" d="M425.247 289.889H490.92V284.901H425.247V289.889Z" fill="white" />
                                        <path opacity="0.3" d="M490.922 289.888V284.9H453.748V289.888" fill="white" />
                                        <path d="M431.451 316.305H499.486V311.317H431.451V316.305Z" fill="#263238" />
                                        <path opacity="0.5" d="M431.451 316.305H499.486V311.317H431.451V316.305Z" fill="white" />
                                        <path opacity="0.3" d="M464.476 316.305H499.486V311.317H464.476V316.305Z" fill="white" />
                                        <path d="M147.705 325.383L140.079 326.837L133.084 310.813L143.041 307.266L147.705 325.383Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M139.092 325.561L141.492 324.781C142.035 324.604 142.627 324.715 143.09 325.049C145.089 326.489 145.897 325.437 146.824 323.17C147.745 322.748 148.36 323.761 148.534 324.032L152.451 329.976C152.784 330.47 152.654 331.141 152.159 331.474C152.072 331.533 151.975 331.579 151.873 331.61C148.959 332.558 147.579 333.006 143.952 334.186L132.856 337.794C129.832 338.778 128.214 335.933 129.368 335.247C134.568 332.187 137.999 329.248 139.201 327.056C139.429 326.665 139.03 326.559 139.092 325.561Z"
                                            fill="#263238" />
                                        <path
                                            d="M136.238 328.949C136.99 328.684 137.712 328.342 138.392 327.927C138.454 327.88 138.464 327.792 138.417 327.731C138.392 327.697 138.353 327.677 138.311 327.676C137.921 327.621 134.463 327.194 133.884 327.972C133.772 328.109 133.75 328.298 133.825 328.459C133.93 328.768 134.176 329.01 134.487 329.11C135.074 329.244 135.687 329.187 136.238 328.949ZM137.864 327.9C137.032 328.353 135.457 329.108 134.61 328.82C134.388 328.738 134.212 328.565 134.126 328.344C134.09 328.278 134.097 328.196 134.146 328.138C134.467 327.714 136.44 327.757 137.864 327.9Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M138.362 327.947C138.396 327.946 138.428 327.935 138.456 327.916C138.484 327.868 138.482 327.808 138.449 327.762C138.408 327.637 136.742 324.912 135.158 325.636C134.768 325.823 134.715 326.057 134.752 326.227C134.905 327.044 137.275 327.911 138.298 327.994L138.362 327.947ZM135.4 325.817C136.442 325.478 137.606 327.006 138.034 327.629C136.887 327.43 135.115 326.646 135.046 326.14C135.033 326.101 134.997 325.991 135.293 325.861L135.4 325.817Z"
                                            fill="#407BFF" />
                                        <path d="M138.029 327.956C138.893 327.8 139.82 328.045 140.495 328.607" stroke="#407BFF"
                                            stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M136.9 329.564C137.764 329.408 138.691 329.652 139.366 330.214" stroke="#407BFF"
                                            stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M135.352 331.111C136.215 330.955 137.143 331.2 137.817 331.761" stroke="#407BFF"
                                            stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M97.735 329.177L89.9761 328.888L86.7441 311.705L97.2419 310.475L97.735 329.177Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M89.2973 327.422L91.8111 327.199C92.3802 327.148 92.9317 327.389 93.3088 327.818C94.9347 329.669 95.9578 328.824 97.3695 326.822C98.3618 326.616 98.7335 327.742 98.8434 328.045L101.331 334.714C101.545 335.27 101.267 335.896 100.711 336.109C100.612 336.147 100.508 336.171 100.403 336.178C97.3495 336.45 95.9048 336.578 92.1052 336.916L80.4839 337.95C77.3157 338.232 76.3756 335.098 77.6536 334.686C83.4063 332.867 87.4078 330.77 89.0699 328.902C89.3794 328.574 89.0138 328.381 89.2973 327.422Z"
                                            fill="#263238" />
                                        <path
                                            d="M85.7576 330.085C86.5495 329.996 87.3298 329.824 88.0863 329.572C88.157 329.54 88.1869 329.456 88.1547 329.387C88.137 329.349 88.1032 329.321 88.0633 329.31C87.6954 329.168 84.4212 327.979 83.6823 328.608C83.5433 328.717 83.4788 328.896 83.5164 329.069C83.5495 329.395 83.7346 329.685 84.0164 329.852C84.5564 330.114 85.167 330.195 85.7576 330.085ZM87.5764 329.428C86.6639 329.683 84.9611 330.066 84.2 329.596C84.0018 329.467 83.869 329.259 83.8344 329.025C83.8129 328.952 83.839 328.874 83.8997 328.829C84.3075 328.486 86.2207 328.969 87.5764 329.428Z"
                                            fill="#407BFF" />
                                        <path
                                            d="M88.054 329.583C88.087 329.59 88.1208 329.587 88.1523 329.575C88.1907 329.534 88.2022 329.475 88.1799 329.424C88.1684 329.292 87.1546 326.264 85.448 326.614C85.0263 326.709 84.9211 326.925 84.9203 327.1C84.8865 327.93 87.0025 329.305 87.9818 329.615L88.054 329.583ZM85.6431 326.845C86.7345 326.748 87.5271 328.497 87.8051 329.2C86.7306 328.75 85.1799 327.589 85.226 327.08C85.2222 327.039 85.2122 326.924 85.5294 326.863L85.6431 326.845Z"
                                            fill="#407BFF" />
                                        <path d="M87.7246 329.518C88.601 329.559 89.4504 330.005 89.9819 330.703" stroke="#407BFF"
                                            stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M86.2676 330.834C87.1439 330.875 87.9934 331.321 88.5249 332.019" stroke="#407BFF"
                                            stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M84.4102 331.996C85.2865 332.038 86.136 332.483 86.6675 333.181" stroke="#407BFF"
                                            stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path class="theme-color"
                                            d="M130.424 252.177C126.661 222.376 126.056 190.951 121.586 184.292L98.1523 183.916C98.2691 184.388 108.611 241.697 112.142 257.339C116.888 277.977 136.884 323.068 136.884 323.068L147.708 320.555C147.708 320.555 137.444 275.226 130.424 252.177Z"
                                            fill="#B76E79" />
                                        <path class="theme-color"
                                            d="M84.8983 184.407C82.84 182.84 76.118 263.811 85.8369 323.497L98.9337 322.958C98.9337 322.958 98.5658 271.281 99.8884 247.933C101.211 224.584 109.09 184.407 109.09 184.407H84.8983Z"
                                            fill="#B76E79" />
                                        <path opacity="0.2"
                                            d="M100.437 240.799C100.437 240.799 99.5733 234.787 99.2039 227.176C98.8383 219.652 99.8153 212.122 102.01 204.916L103.821 214.688L100.437 240.799Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M83.457 190.968C83.457 190.968 87.6598 197.705 101.474 196.023C115.289 194.341 123.635 190.011 123.635 190.011L122.612 186.127L84.0162 187.711L83.457 190.968Z"
                                            fill="#111111" />
                                        <path
                                            d="M123.201 145.906C123.872 146.486 135.972 158.747 143.125 160.516C150.278 162.286 168.574 141.941 168.574 141.941L163.959 136.35C163.959 136.35 147.29 149.624 144.25 148.9C141.21 148.175 131.865 138.313 131.865 138.313L123.201 145.906Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M90.2748 140.927C88.7387 145.735 87.0567 150.481 85.2979 155.205C84.4223 157.571 83.5314 159.928 82.602 162.279C81.6727 164.629 80.7433 166.979 79.7602 169.329C79.5375 169.89 79.2226 170.566 78.9461 171.196C78.6696 171.826 78.3624 172.432 78.0628 173.031C77.7633 173.63 77.4484 174.222 77.1258 174.798C76.8032 175.374 76.496 175.958 76.1657 176.518C74.8908 178.822 73.4852 180.942 72.0951 183.093C69.2686 187.371 66.2732 191.449 63.0474 195.428L58.0566 192.161L65.4975 179.299C67.6872 175.03 69.6012 170.625 71.2272 166.111L75.8969 151.895C77.433 147.148 79.0843 142.394 80.751 137.693L90.2748 140.927Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M99.9679 123.47C99.9541 123.21 89.5854 123.74 88.4118 125.644C87.2382 127.548 82.0615 182.83 81.9379 187.8C81.8104 192.92 112.933 196.418 124.747 187.661C124.747 187.661 122.451 146.605 122.88 139.37C123.31 132.107 121.89 126.021 121.89 126.021L111.821 124.232L99.9679 123.47Z"
                                            fill="#263238" />
                                        <path
                                            d="M98.2612 130.26C96.6407 135.59 91.0416 148.901 91.0416 148.901L76.2305 145.921C76.2305 145.921 80.4655 131.281 85.5423 127.203C92.7466 121.42 100.35 123.386 98.2612 130.26Z"
                                            fill="#263238" />
                                        <path opacity="0.2"
                                            d="M118.624 137.771C118.079 140.214 120.229 154.484 122.879 157.226C123.087 153.67 122.411 146.796 122.879 142.994L118.624 137.771Z"
                                            fill="#111111" />
                                        <path
                                            d="M125.505 128.148C130.063 133.092 136.48 141.734 136.48 141.734L125.367 150.782C121.744 147.07 117.566 143.136 115.695 138.299C113.228 131.687 115.01 126.713 119.443 125.948C121.689 125.56 123.96 126.472 125.505 128.148Z"
                                            fill="#263238" />
                                        <path opacity="0.2" d="M85.5612 147.752L86.7071 135.014L80.916 146.817L85.5612 147.752Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M50.082 194.012C50.082 194.012 51.579 195.737 54.0705 196.293C56.5621 196.849 57.8232 196.732 57.8232 196.732L56.4223 194.012H50.082Z"
                                            fill="#263238" />
                                        <path
                                            d="M12.753 228.043C10.5671 222.793 11.8997 218.134 14.5909 213.989C16.69 210.757 19.7062 209.301 23.3867 207.577C25.0925 206.778 27.6447 206.202 30.2976 205.942C28.2008 204.297 26.3582 202.439 25.3498 200.848C23.1731 197.415 21.4128 194.567 21.3805 190.713C21.3398 185.771 22.7215 181.126 27.3867 177.875C31.7684 174.822 37.8928 175.9 42.5388 178.538C47.1839 181.177 51.2961 185.942 54.0526 190.234C59.8322 199.236 63.9505 206.923 65.8046 216.298C57.0818 224.704 51.5956 227.475 41.8828 231.957C37.2507 234.095 31.2215 235.902 25.8867 235.629C20.5502 235.356 14.806 232.973 12.753 228.043Z"
                                            fill="#407BFF" />
                                        <g opacity="0.4">
                                            <path
                                                d="M12.753 228.043C10.5671 222.793 11.8997 218.134 14.5909 213.989C16.69 210.757 19.7062 209.301 23.3867 207.577C25.0925 206.778 27.6447 206.202 30.2976 205.942C28.2008 204.297 26.3582 202.439 25.3498 200.848C23.1731 197.415 21.4128 194.567 21.3805 190.713C21.3398 185.771 22.7215 181.126 27.3867 177.875C31.7684 174.822 37.8928 175.9 42.5388 178.538C47.1839 181.177 51.2961 185.942 54.0526 190.234C59.8322 199.236 63.9505 206.923 65.8046 216.298C57.0818 224.704 51.5956 227.475 41.8828 231.957C37.2507 234.095 31.2215 235.902 25.8867 235.629C20.5502 235.356 14.806 232.973 12.753 228.043Z"
                                                fill="#111111" />
                                        </g>
                                        <path
                                            d="M62.9036 194.19C61.6732 192.34 60.0603 191.615 60.0603 191.615C60.0603 191.615 57.6309 190.627 55.6424 191.491C53.6539 192.357 51.836 192.518 50.402 193.264C48.9681 194.01 51.0902 194.513 52.2738 194.553C53.4566 194.592 56.7868 194.312 56.8836 195.102L60.8682 202.018C62.1225 200.008 64.134 196.041 62.9036 194.19Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M158.285 143.362L161.872 137.693L167.195 143.723C167.195 143.723 163.354 148.461 160.482 146.795L158.285 143.362Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M168.653 136.105L170.189 138.532C170.796 139.497 170.607 140.76 169.744 141.505L167.217 143.724L161.895 137.695L165.435 135.391C166.501 134.695 167.928 134.995 168.624 136.06C168.634 136.074 168.643 136.09 168.653 136.105Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M189.428 165.531L194.145 188.083L173.191 192.466L168.417 169.648L136.75 135.218L158.858 130.594L176.05 149.425L184.34 125.264L204.583 121.029L189.428 165.531Z"
                                            fill="#263238" />
                                        <path class="theme-color"
                                            d="M185.441 166.487L190.159 189.038L169.205 193.422L164.431 170.603L132.764 136.173L154.872 131.549L172.063 150.38L180.354 126.219L200.597 121.984L185.441 166.487Z"
                                            fill="#B76E79" />
                                        <path
                                            d="M167.692 141.397C167.692 141.397 163.257 142.379 162.234 141.657C161.21 140.936 162.801 140.123 162.801 140.123C162.801 140.123 160.995 140.91 160.558 140.188C160.032 139.322 161.703 138.478 161.703 138.478C161.703 138.478 160.202 139.06 159.856 138.392C159.496 137.699 161.315 136.611 161.315 136.611C161.315 136.611 160.181 136.822 160.203 136.221C160.225 135.62 164.039 133.239 165.606 133.31C167.173 133.381 170.083 138.377 170.455 139.608C170.561 139.962 170.638 140.596 169.5 141.853C169.262 142.117 168.856 142.157 168.574 141.942L167.824 141.369L167.692 141.397Z"
                                            fill="#FFB5AF" />
                                        <path opacity="0.2"
                                            d="M162.759 140.038C162.762 140.036 162.764 140.035 162.767 140.035L165.981 138.813C166.024 138.797 166.075 138.823 166.094 138.872C166.114 138.92 166.094 138.974 166.052 138.989L162.839 140.21C162.796 140.227 162.744 140.2 162.725 140.153C162.706 140.106 162.722 140.057 162.759 140.038Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M161.748 138.349C161.748 138.349 161.749 138.348 161.75 138.348L164.744 136.929C164.785 136.909 164.838 136.932 164.861 136.978C164.884 137.026 164.87 137.069 164.826 137.1L161.832 138.518C161.791 138.538 161.739 138.516 161.716 138.469C161.693 138.423 161.708 138.369 161.748 138.349Z"
                                            fill="#111111" />
                                        <path opacity="0.2"
                                            d="M161.371 136.475L163.565 135.358C163.607 135.337 163.659 135.358 163.683 135.404C163.706 135.451 163.693 135.506 163.651 135.527L161.457 136.644C161.416 136.665 161.363 136.644 161.339 136.597C161.316 136.551 161.33 136.496 161.371 136.475Z"
                                            fill="#111111" />
                                        <path
                                            d="M98.6119 123.408C102.162 120.461 101.278 112.284 100.348 107.654L111.228 116.005C111.01 116.548 110.829 117.104 110.687 117.672C110.396 118.688 110.371 119.762 110.616 120.79C110.853 121.637 112.109 125.018 112.109 125.018C112.109 125.018 110.608 129.23 104.053 129.355C97.5888 129.187 98.6119 123.408 98.6119 123.408Z"
                                            fill="#FFB5AF" />
                                        <path opacity="0.2"
                                            d="M102.486 112.295C102.191 117.78 107.809 120.094 110.622 120.8C110.378 119.772 110.402 118.698 110.693 117.682L102.486 112.295Z"
                                            fill="#111111" />
                                        <path
                                            d="M112.203 91.5151C117.632 90.9498 114.423 94.9621 120.202 96.3247C119.997 99.8999 115.546 103.507 114.224 101.17C112.771 98.6019 107.691 91.9391 112.203 91.5151Z"
                                            fill="#263238" />
                                        <path
                                            d="M98.3314 103.69C99.9919 110.052 100.797 113.673 104.789 116.312C110.795 120.283 118.239 115.889 118.57 109.143C118.867 103.071 116.101 93.6872 109.113 92.4169C102.226 91.1657 96.6709 97.3286 98.3314 103.69Z"
                                            fill="#FFB5AF" />
                                        <path
                                            d="M107.34 103.479C107.468 104.138 107.931 104.601 108.375 104.512C108.818 104.424 109.073 103.818 108.945 103.159C108.817 102.5 108.354 102.038 107.91 102.126C107.467 102.214 107.211 102.82 107.34 103.479Z"
                                            fill="#263238" />
                                        <path
                                            d="M114.039 102.692C114.167 103.351 114.63 103.814 115.074 103.725C115.517 103.637 115.773 103.031 115.644 102.372C115.516 101.713 115.053 101.251 114.61 101.339C114.166 101.427 113.911 102.033 114.039 102.692Z"
                                            fill="#263238" />
                                        <path
                                            d="M112.625 102.664C112.625 102.664 115.41 105.531 116.358 106.734C115.575 107.742 113.874 107.668 113.874 107.668L112.625 102.664Z"
                                            fill="#DE7E73" />
                                        <path
                                            d="M105.922 100.961C106.032 100.982 106.151 100.946 106.232 100.857C107.187 99.7949 108.369 99.9324 108.381 99.9339C108.558 99.9562 108.722 99.8356 108.748 99.6644C108.774 99.4931 108.651 99.3356 108.475 99.3126C108.413 99.3042 106.933 99.1313 105.747 100.449C105.629 100.581 105.641 100.779 105.775 100.892C105.819 100.928 105.869 100.951 105.922 100.961Z"
                                            fill="#263238" />
                                        <path
                                            d="M117.256 99.282C117.313 99.2582 117.363 99.219 117.4 99.1652C117.499 99.0193 117.46 98.8242 117.312 98.7282C115.832 97.7712 114.468 98.3488 114.403 98.3672C114.239 98.4379 114.163 98.6238 114.233 98.7827C114.302 98.9417 114.489 99.0139 114.652 98.9463C114.708 98.9202 115.765 98.4878 116.953 99.2559C117.047 99.3158 117.16 99.3219 117.256 99.282Z"
                                            fill="#263238" />
                                        <path
                                            d="M113.789 109.934C113.297 110.676 112.859 111.457 112.48 112.268C112.329 112.219 112.175 112.174 112.026 112.119C109.976 111.433 109.223 110.434 109.02 109.53C108.929 109.086 108.94 108.63 109.053 108.199C109.112 107.954 109.203 107.719 109.325 107.502C110.22 108.522 112.081 109.308 113.095 109.686C113.539 109.828 113.789 109.934 113.789 109.934Z"
                                            fill="#263238" />
                                        <path
                                            d="M113.098 109.686L112.693 110.364C110.769 109.715 109.491 109.003 109.057 108.199C109.115 107.954 109.206 107.719 109.329 107.502C110.228 108.531 112.084 109.308 113.098 109.686Z"
                                            fill="white" />
                                        <path
                                            d="M112.029 112.166C109.98 111.481 109.226 110.482 109.023 109.578C109.798 109.853 110.523 110.264 111.165 110.792C111.583 111.151 111.886 111.632 112.029 112.166Z"
                                            fill="#F54948" />
                                        <path
                                            d="M119.048 87.222C114.775 86.3702 113.27 86.6936 109.571 87.7496C109.571 87.7496 110.645 86.0131 110.498 83.8418C101.561 90.093 98.321 86.4102 93.9193 90.0607C91.1075 92.3925 93.278 95.9163 93.278 95.9163C93.278 95.9163 86.2119 99.5523 95.4554 108.015C95.6897 108.866 95.6943 109.665 95.3179 110.148C94.6221 111.041 93.4715 111.421 92.3901 111.755C94.0368 112.409 95.9093 112.476 97.599 111.942C97.1958 112.961 96.5314 113.876 95.6881 114.576C97.9201 114.949 100.319 114.089 101.806 112.384L100.607 107.707C100.995 107.704 101.404 107.745 101.844 107.863C102.298 106.371 102.541 104.823 102.565 103.265C102.466 102.034 102.203 100.822 101.785 99.6598C101.785 99.6598 105.697 97.8518 106.047 95.2328C106.047 95.2328 112.447 97.8411 116.268 95.2297C120.09 92.6191 117.113 88.3503 119.048 87.222Z"
                                            fill="#263238" />
                                        <path
                                            d="M96.761 109.554C97.6135 111.112 99.1304 112.129 100.569 112.514C102.733 113.094 103.061 110.853 102.479 108.86C101.955 107.066 100.973 104.946 98.7925 105.245C96.6442 105.54 95.7863 107.774 96.761 109.554Z"
                                            fill="#FFB5AF" />
                                        <path opacity="0.2"
                                            d="M97.9258 107.486C98.1178 107.051 98.6355 106.807 99.1201 106.83C99.6055 106.853 100.053 107.102 100.409 107.422C100.835 107.806 101.156 108.301 101.328 108.842"
                                            stroke="#111111" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                </svg>
                            <?php else: ?>
                            <img id="svg_text_preview"
                                src="<?php echo e(isset($business->svg_text) && !empty($business->svg_text) ? $svg_text . '/' . $business->svg_text :''); ?>">
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

<?php echo $__env->make('card.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/card/theme13/index.blade.php ENDPATH**/ ?>