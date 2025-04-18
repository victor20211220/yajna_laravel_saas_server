<?php $__env->startSection('contentCard'); ?>
<?php if($themeName): ?>
    <div class="<?php echo e($themeName); ?>" id="view_theme11">
<?php else: ?>
    <div class="<?php echo e($business->theme_color); ?>" id="view_theme11">
<?php endif; ?>
 <main id="boxes">
            <div class="card-wrapper <?php if(!isset($is_pdf)): ?> scrollbar <?php endif; ?>">
                <div class="developer-card">
                    <section class="profile-sec pb">
                        <div class="profile-banner">
                            
                            <img class="profile-banner-img"
                                src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/theme1/images/developer-card-banner.png')); ?>"
                                id="banner_preview" alt="fs">

                            <img src="<?php echo e(asset('custom/theme1/images/developer-banner-bottom.png')); ?>" class="banner-bottom"
                                alt="banner-bottom-shape" loading="lazy">

                            <div class="container">
                                <div class="section-title text-center">
                                    <h2 id="<?php echo e($stringid . '_title'); ?>_preview"><?php echo e($business->title); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="client-info-wrp text-center">
                            <svg width="576" height="195" viewBox="0 0 576 195" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="460"
                                    y="92" width="7" height="7">
                                    <path
                                        d="M463.475 98.4276C461.886 98.4276 460.598 97.1365 460.598 95.5471C460.598 93.9577 461.886 92.6703 463.475 92.6703C465.064 92.6703 466.352 93.9577 466.352 95.5471C466.352 97.1365 465.064 98.4276 463.475 98.4276Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask0_287_94)">
                                    <path
                                        d="M463.475 98.4276C461.886 98.4276 460.598 97.1365 460.598 95.5471C460.598 93.9577 461.886 92.6703 463.475 92.6703C465.064 92.6703 466.352 93.9577 466.352 95.5471C466.352 97.1365 465.064 98.4276 463.475 98.4276Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask1_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="441" y="5"
                                    width="6" height="7">
                                    <path
                                        d="M444.105 11.5312C442.516 11.5312 441.225 10.2438 441.225 8.65074C441.225 7.06135 442.516 5.77364 444.105 5.77364C445.694 5.77364 446.982 7.06135 446.982 8.65074C446.982 10.2438 445.694 11.5312 444.105 11.5312Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask1_287_94)">
                                    <path
                                        d="M444.105 11.5312C442.516 11.5312 441.225 10.2438 441.225 8.65074C441.225 7.06135 442.516 5.77364 444.105 5.77364C445.694 5.77364 446.982 7.06135 446.982 8.65074C446.982 10.2438 445.694 11.5312 444.105 11.5312Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask2_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="512" y="0"
                                    width="7" height="6">
                                    <path
                                        d="M515.264 5.75388C513.672 5.75388 512.384 4.46616 512.384 2.87925C512.384 1.28739 513.672 -7.26602e-06 515.264 -7.26602e-06C516.854 -7.26602e-06 518.142 1.28739 518.142 2.87925C518.142 4.46616 516.854 5.75388 515.264 5.75388Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask2_287_94)">
                                    <path
                                        d="M515.264 5.75388C513.672 5.75388 512.384 4.46616 512.384 2.87925C512.384 1.28739 513.672 -7.26602e-06 515.264 -7.26602e-06C516.854 -7.26602e-06 518.142 1.28739 518.142 2.87925C518.142 4.46616 516.854 5.75388 515.264 5.75388Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask3_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="139"
                                    y="81" width="7" height="7">
                                    <path
                                        d="M142.765 87.2426C141.176 87.2426 139.888 85.9552 139.888 84.3658C139.888 82.7739 141.176 81.4862 142.765 81.4862C144.354 81.4862 145.645 82.7739 145.645 84.3658C145.645 85.9552 144.354 87.2426 142.765 87.2426Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask3_287_94)">
                                    <path
                                        d="M142.765 87.2426C141.176 87.2426 139.888 85.9552 139.888 84.3658C139.888 82.7739 141.176 81.4862 142.765 81.4862C144.354 81.4862 145.645 82.7739 145.645 84.3658C145.645 85.9552 144.354 87.2426 142.765 87.2426Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask4_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="92"
                                    y="115" width="10" height="10">
                                    <path
                                        d="M97.0162 124.58C94.6015 124.58 92.6431 122.622 92.6431 120.211C92.6431 117.796 94.6015 115.838 97.0162 115.838C99.4277 115.838 101.386 117.796 101.386 120.211C101.386 122.622 99.4277 124.58 97.0162 124.58Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask4_287_94)">
                                    <path
                                        d="M97.0162 124.58C94.6015 124.58 92.6431 122.622 92.6431 120.211C92.6431 117.796 94.6015 115.838 97.0162 115.838C99.4277 115.838 101.386 117.796 101.386 120.211C101.386 122.622 99.4277 124.58 97.0162 124.58Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask5_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="289"
                                    y="26" width="17" height="17">
                                    <path
                                        d="M297.551 42.7803C293.165 42.7803 289.611 39.227 289.611 34.8406C289.611 30.4557 293.165 26.8986 297.551 26.8986C301.939 26.8986 305.496 30.4557 305.496 34.8406C305.496 39.227 301.939 42.7803 297.551 42.7803Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask5_287_94)">
                                    <path
                                        d="M297.551 42.7803C293.165 42.7803 289.611 39.227 289.611 34.8406C289.611 30.4557 293.165 26.8986 297.551 26.8986C301.939 26.8986 305.496 30.4557 305.496 34.8406C305.496 39.227 301.939 42.7803 297.551 42.7803Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask6_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="44" y="58"
                                    width="12" height="12">
                                    <path
                                        d="M50.0178 69.4995C47.0476 69.4995 44.6392 67.0904 44.6392 64.1214C44.6392 61.1509 47.0476 58.7422 50.0178 58.7422C52.9911 58.7422 55.3964 61.1509 55.3964 64.1214C55.3964 67.0904 52.9911 69.4995 50.0178 69.4995Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask6_287_94)">
                                    <path
                                        d="M50.0178 69.4995C47.0476 69.4995 44.6392 67.0904 44.6392 64.1214C44.6392 61.1509 47.0476 58.7422 50.0178 58.7422C52.9911 58.7422 55.3964 61.1509 55.3964 64.1214C55.3964 67.0904 52.9911 69.4995 50.0178 69.4995Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask7_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="415"
                                    y="40" width="7" height="7">
                                    <path
                                        d="M418.503 46.6391C416.914 46.6391 415.626 45.3502 415.626 43.7608C415.626 42.1726 416.914 40.884 418.503 40.884C420.092 40.884 421.38 42.1726 421.38 43.7608C421.38 45.3502 420.092 46.6391 418.503 46.6391Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask7_287_94)">
                                    <path
                                        d="M418.503 46.6391C416.914 46.6391 415.626 45.3502 415.626 43.7608C415.626 42.1726 416.914 40.884 418.503 40.884C420.092 40.884 421.38 42.1726 421.38 43.7608C421.38 45.3502 420.092 46.6391 418.503 46.6391Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask8_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="551"
                                    y="69" width="7" height="7">
                                    <path
                                        d="M554.79 75.2687C553.197 75.2687 551.906 73.9776 551.906 72.3823C551.906 70.7939 553.197 69.5028 554.79 69.5028C556.385 69.5028 557.676 70.7939 557.676 72.3823C557.676 73.9776 556.385 75.2687 554.79 75.2687Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask8_287_94)">
                                    <path
                                        d="M554.79 75.2687C553.197 75.2687 551.906 73.9776 551.906 72.3823C551.906 70.7939 553.197 69.5028 554.79 69.5028C556.385 69.5028 557.676 70.7939 557.676 72.3823C557.676 73.9776 556.385 75.2687 554.79 75.2687Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask9_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="45"
                                    y="140" width="9" height="9">
                                    <path
                                        d="M49.6942 148.691C47.4564 148.691 45.647 146.879 45.647 144.647C45.647 142.41 47.4564 140.597 49.6942 140.597C51.9288 140.597 53.7413 142.41 53.7413 144.647C53.7413 146.879 51.9288 148.691 49.6942 148.691Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask9_287_94)">
                                    <path
                                        d="M49.6942 148.691C47.4564 148.691 45.647 146.879 45.647 144.647C45.647 142.41 47.4564 140.597 49.6942 140.597C51.9288 140.597 53.7413 142.41 53.7413 144.647C53.7413 146.879 51.9288 148.691 49.6942 148.691Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask10_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="14"
                                    y="110" width="7" height="7">
                                    <path
                                        d="M17.8431 116.141C16.254 116.141 14.9629 114.849 14.9629 113.26C14.9629 111.674 16.254 110.387 17.8431 110.387C19.4322 110.387 20.7202 111.674 20.7202 113.26C20.7202 114.849 19.4322 116.141 17.8431 116.141Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask10_287_94)">
                                    <path
                                        d="M17.8431 116.141C16.254 116.141 14.9629 114.849 14.9629 113.26C14.9629 111.674 16.254 110.387 17.8431 110.387C19.4322 110.387 20.7202 111.674 20.7202 113.26C20.7202 114.849 19.4322 116.141 17.8431 116.141Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask11_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="410"
                                    y="110" width="6" height="7">
                                    <path
                                        d="M412.908 116.141C411.319 116.141 410.031 114.852 410.031 113.264C410.031 111.674 411.319 110.387 412.908 110.387C414.501 110.387 415.789 111.674 415.789 113.264C415.789 114.852 414.501 116.141 412.908 116.141Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask11_287_94)">
                                    <path
                                        d="M412.908 116.141C411.319 116.141 410.031 114.852 410.031 113.264C410.031 111.674 411.319 110.387 412.908 110.387C414.501 110.387 415.789 111.674 415.789 113.264C415.789 114.852 414.501 116.141 412.908 116.141Z"
                                        fill="#7E3AE3" />
                                </g>
                                <mask id="mask12_287_94" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="517"
                                    y="137" width="7" height="7">
                                    <path
                                        d="M520.41 143.02C518.821 143.02 517.53 141.733 517.53 140.147C517.53 138.554 518.821 137.266 520.41 137.266C521.999 137.266 523.287 138.554 523.287 140.147C523.287 141.733 521.999 143.02 520.41 143.02Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask12_287_94)">
                                    <path
                                        d="M520.41 143.02C518.821 143.02 517.53 141.733 517.53 140.147C517.53 138.554 518.821 137.266 520.41 137.266C521.999 137.266 523.287 138.554 523.287 140.147C523.287 141.733 521.999 143.02 520.41 143.02Z"
                                        fill="#7E3AE3" />
                                </g>
                            </svg>

                            <div class="client-image">
                                <img id="business_logo_preview"
                                    src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/theme1/images/client-image.png')); ?>"
                                    alt="">
                            </div>
                            <div class="client-info">
                                <h3 id="<?php echo e($stringid . '_designation'); ?>_preview" class="text-black">
                                    <?php echo e($business->designation); ?></h3>
                                <span class="subtitle"
                                    id="<?php echo e($stringid . '_subtitle'); ?>_preview"><?php echo e($business->sub_title); ?></span>
                                <p class="text-wrap" id="<?php echo e($stringid . '_desc'); ?>_preview">
                                    <?php echo nl2br(e($business->description)); ?></p>
                            </div>
                        </div>
                    </section>
                    <?php $j = 1; ?>
                    <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($j == $order_value): ?>
                            <?php if($order_key == 'contact_info'): ?>
                                <section class="contact-info-sec pb" id="contact-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Contact Info')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
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
                                                            <li id="contact_<?php echo e($loop->parent->index + 1); ?>" class="d-flex align-items-center">
                                                                <?php if($key1 == 'Address'): ?>
                                                                    <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($key2 == 'Address_url'): ?>
                                                                            <?php $href = $val2; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <span>
                                                                        <img src="<?php echo e(asset('custom/theme1/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                    </span>
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
                                                                    <span>
                                                                        <img src="<?php echo e(asset('custom/theme1/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                    </span>
                                                                        <a href="<?php echo e(url('https://wa.me/' . $href)); ?>" target="_blank" class="contact-link">
                                                                    <?php else: ?>
                                                                        <span>
                                                                            <img src="<?php echo e(asset('custom/theme1/icon/color1/' . strtolower($key1) . '.svg')); ?>" class="img-fluid">
                                                                        </span>
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
                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'bussiness_hour'): ?>
                                <section class="business-hour-sec bg-light-color pt pb mb" id="business-hours-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Business Hours')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
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


                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'service'): ?>
                                <section class="service-sec pb" id="services-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Our Services')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <?php if(isset($is_pdf)): ?>
                                            <?php $image_count = 0; ?>
                                            <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="service-card edit-card" id="services_<?php echo e($service_row_nos); ?>">
                                                    <div class="service-card-inner">
                                                        <div class="service-content-top">
                                                            <h3 id="<?php echo e('title_' . $service_row_nos . '_preview'); ?>">
                                                                <?php echo e($content->title); ?></h3>
                                                            <p id="<?php echo e('description_' . $service_row_nos . '_preview'); ?>">
                                                                <?php echo e($content->description); ?> </p>
                                                        </div>
                                                        <div
                                                            class="service-content-bottom d-flex align-items-center justify-content-between">
                                                            <div class="service-icon">
                                                                <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                                    width="28" height="28"
                                                                    src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                    class="img-fluid" alt="image">
                                                            </div>
                                                            <?php if(!empty($content->purchase_link)): ?>
                                                                <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                    id="<?php echo e('link_title_' . $service_row_nos . '_preview'); ?>"
                                                                    class="btn"><?php echo e($content->link_title); ?></a>
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
                                                                <h3 id="<?php echo e('title_' . $service_row_nos . '_preview'); ?>">
                                                                    <?php echo e($content->title); ?></h3>
                                                                <p
                                                                    id="<?php echo e('description_' . $service_row_nos . '_preview'); ?>">
                                                                    <?php echo e($content->description); ?> </p>
                                                            </div>
                                                            <div
                                                                class="service-content-bottom d-flex align-items-center justify-content-between">
                                                                <div class="service-icon">
                                                                    <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                                        width="28" height="28"
                                                                        src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                        class="img-fluid" alt="image">
                                                                </div>
                                                                <?php if(!empty($content->purchase_link)): ?>
                                                                    <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                        id="<?php echo e('link_title_' . $service_row_nos . '_preview'); ?>"
                                                                        class="btn"><?php echo e($content->link_title); ?></a>
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
                                            <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                                <div class="slick-prev slick-arrow service-arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                        viewBox="0 0 18 12" fill="none">
                                                        <path
                                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                                                </div>
                                                <div class="slick-next slick-arrow service-arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                        viewBox="0 0 18 12" fill="none">
                                                        <path
                                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'appointment'): ?>
                                <section class="appointment-sec bg-light-color pt pb mb" id="appointment-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Make An Appointment')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="appointment-form">
                                            <div class="form-group date-picker">
                                                <input type="text" class="form-control datepicker_min"
                                                    placeholder="<?php echo e(__('Pick a Date')); ?>">
                                            </div>
                                            <span class="text-danger text-center h6 span-error-date"></span>
                                            <ul class="check-box-div d-flex" id="inputrow_appointment_preview">
                                                <?php $radiocount = 1; ?>
                                                <?php if(!is_null($appoinment_hours)): ?>
                                                    <?php $__currentLoopData = $appoinment_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="checkbox-custom"
                                                            id="<?php echo e('appointment_' . $appointment_nos); ?>">
                                                            <input type="radio" id="radio-<?php echo e($radiocount); ?>"
                                                                name="time" class="app_time"
                                                                data-id="<?php if(!empty($hour->start)): ?> <?php echo e($hour->start); ?> <?php else: ?> 00:00 <?php endif; ?>-<?php if(!empty($hour->end)): ?> <?php echo e($hour->end); ?> <?php else: ?> 00:00 <?php endif; ?>">
                                                            <label for="radio-<?php echo e($radiocount); ?>">
                                                                <span
                                                                    id="appoinment_start_<?php echo e($appointment_nos); ?>_preview">
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
                                            <span class="text-danger text-center h6 span-error-time"></span>
                                            <div class="text-center">
                                                <button type="button"
                                                    class="btn appointment-btn"><?php echo e(__('Make An Appointment')); ?></button>
                                            </div>
                                        </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'product'): ?>
                                <section class="product-sec pb" id="product-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Product')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <?php if(isset($is_pdf)): ?>
                                            <?php $pr_image_count = 0; ?>
                                            <?php $__currentLoopData = $products_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="product-card edit-card" id="product_<?php echo e($product_row_nos); ?>">
                                                    <div class="product-card-inner">
                                                        <div class="img-wrapper">
                                                            <img src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                alt="product-image" loading="lazy">
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="product-content-top">
                                                                <h3
                                                                    id="<?php echo e('product_title_' . $product_row_nos . '_preview'); ?>">
                                                                    <?php echo e($content->title); ?></h3>
                                                                <p
                                                                    id="<?php echo e('product_description_' . $product_row_nos . '_preview'); ?>">
                                                                    <?php echo e($content->description); ?></p>
                                                            </div>
                                                            <div
                                                                class="product-content-bottom d-flex align-items-center justify-content-between">
                                                                <div class="price">
                                                                    <ins
                                                                        id="<?php echo e('product_currency_select' . $product_row_nos . '_preview'); ?>"><?php echo e($content->currency); ?></ins>
                                                                    <ins
                                                                        id="<?php echo e('product_price_' . $product_row_nos . '_preview'); ?>"><?php echo e($content->price); ?></ins>
                                                                </div>
                                                                <?php if(!empty($content->purchase_link)): ?>
                                                                    <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                        class="btn"><?php echo e($content->link_title); ?></a>
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
                                                            <div class="img-wrapper">
                                                                <img src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                    alt="product-image" loading="lazy">
                                                            </div>
                                                            <div class="product-content">
                                                                <div class="product-content-top">
                                                                    <h3
                                                                        id="<?php echo e('product_title_' . $product_row_nos . '_preview'); ?>">
                                                                        <?php echo e($content->title); ?></h3>
                                                                    <p
                                                                        id="<?php echo e('product_description_' . $product_row_nos . '_preview'); ?>">
                                                                        <?php echo e($content->description); ?></p>
                                                                </div>
                                                                <div
                                                                    class="product-content-bottom d-flex align-items-center justify-content-between">
                                                                    <div class="price">
                                                                        <ins
                                                                            id="<?php echo e('product_currency_select' . $product_row_nos . '_preview'); ?>"><?php echo e($content->currency); ?></ins>
                                                                        <ins
                                                                            id="<?php echo e('product_price_' . $product_row_nos . '_preview'); ?>"><?php echo e($content->price); ?></ins>
                                                                    </div>
                                                                    <?php if(!empty($content->purchase_link)): ?>
                                                                        <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                            class="btn"><?php echo e($content->link_title); ?></a>
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
                                            <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                                <div class="slick-prev slick-arrow product-arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                        viewBox="0 0 18 12" fill="none">
                                                        <path
                                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                                                </div>
                                                <div class="slick-next slick-arrow product-arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                        viewBox="0 0 18 12" fill="none">
                                                        <path
                                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'testimonials'): ?>
                                <section class="testimonial-sec bg-light-color pt pb" id="testimonials-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Testimonials')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <?php if(isset($is_pdf)): ?>
                                            <?php
                                                $t_image_count = 0;
                                                $rating = 0;
                                            ?>
                                            <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="testimonial-card edit-card"
                                                    id="testimonials_<?php echo e($testimonials_row_nos); ?>">
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
                                                            <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                                src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                alt="image">
                                                        </div>
                                                        <div class="testimonial-content">
                                                            <div
                                                                class="testimonial-title-wrp d-flex align-items-center justify-content-between">
                                                                <h3
                                                                    id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                                    <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                                </h3>
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
                                                            <p
                                                                id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>">
                                                                <?php echo e($testi_content->description); ?> </p>
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
                                                    <div class="testimonial-card"  id="testimonials_<?php echo e($testimonials_row_nos); ?>">
                                                        <div class="testimonial-card-inner d-flex">
                                                            <svg class="testimonial-quote"
                                                                xmlns="http://www.w3.org/2000/svg" width="26"
                                                                height="20" viewBox="0 0 26 20" fill="none">
                                                                <path
                                                                    d="M10.57 9.85387V19.4639H0.959961V9.35387C0.959961 4.47387 4.79996 0.473867 9.60996 0.213867V2.43387C6.01996 2.69387 3.17996 5.69387 3.17996 9.35387C3.17996 9.63387 3.39996 9.85387 3.67996 9.85387H10.57Z"
                                                                    fill="#7E3AE3" />
                                                                <path
                                                                    d="M25.5602 9.85387V19.4639H15.9502V9.35387C15.9502 4.47387 19.7902 0.473867 24.6102 0.213867V2.43387C21.0102 2.69387 18.1702 5.69387 18.1702 9.35387C18.1702 9.63387 18.3902 9.85387 18.6702 9.85387H25.5602Z"
                                                                    fill="#7E3AE3" />
                                                            </svg>
                                                            <div class="testimonial-image">
                                                                <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                                    src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                    alt="image">
                                                            </div>
                                                            <div class="testimonial-content">
                                                                <div
                                                                    class="testimonial-title-wrp d-flex align-items-center justify-content-between">
                                                                    <h3
                                                                        id="<?php echo e('testimonial_name_' . $testimonials_row_nos . '_preview'); ?>">
                                                                        <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                                    </h3>
                                                                    <div class="rating d-flex align-items-center">

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
                                                                <p
                                                                    id="<?php echo e('testimonial_description_' . $testimonials_row_nos . '_preview'); ?>">
                                                                    <?php echo e($testi_content->description); ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        $t_image_count++;
                                                        $testimonials_row_nos++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            
                                            <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                                <div class="slick-prev slick-arrow testimonial-arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                        viewBox="0 0 18 12" fill="none">
                                                        <path
                                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                                                </div>
                                                <div class="slick-next slick-arrow testimonial-arrow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                        viewBox="0 0 18 12" fill="none">
                                                        <path
                                                            d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                            fill="#7E3AE3" />
                                                    </svg>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'gallery'): ?>
                                <section class="gallery-sec bg-light-color pt pb" id="gallery-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Gallery')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="inputrow_gallery_preview" class="gallery-slider">
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
                                                                        class="video-popup-btn play-btn gallery-margin img-wrapper">
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
                                    <!-- Arrow Navigation -->
                                    <div class="arrow-wrapper d-flex align-items-center justify-content-center">
                                        <div class="slick-prev slick-arrow gallery-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                viewBox="0 0 18 12" fill="none">
                                                <path
                                                    d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                    fill="#7E3AE3" />
                                            </svg>
                                        </div>
                                        <div class="slick-next slick-arrow gallery-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                viewBox="0 0 18 12" fill="none">
                                                <path
                                                    d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z"
                                                    fill="#7E3AE3" />
                                            </svg>
                                        </div>
                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php if($order_key == 'more'): ?>
                                <section class="more-info-sec pb">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('More')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <ul class="d-flex justify-content-between">
                                            <li>
                                                <a href="<?php echo e(route('bussiness.save', $business->slug)); ?>"
                                                    class="save-info">
                                                    <div
                                                        class="info-icon d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40"
                                                            height="34" viewBox="0 0 40 34" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M6.83814 0.69145C8.45908 0.361193 10.3896 0.253906 12.6221 0.253906H15.8569C17.8627 0.253906 19.7358 1.17296 20.8484 2.70306L22.4732 4.93752C22.8441 5.44752 23.4684 5.75391 24.1371 5.75391H34.2464C37.4409 5.75391 40.0301 8.06601 39.9997 11.0434C39.9633 14.5891 39.9939 18.1361 39.9939 21.6819C39.9939 23.7286 39.877 25.4985 39.5166 26.9846C39.1515 28.4916 38.51 29.8166 37.3773 30.855C36.2447 31.8934 34.7995 32.4815 33.1558 32.8163C31.5348 33.1467 29.6043 33.2539 27.3719 33.2539H12.6221C10.3896 33.2539 8.45908 33.1467 6.83814 32.8163C5.19449 32.4815 3.74919 31.8934 2.61656 30.855C1.48396 29.8166 0.842533 28.4916 0.477248 26.9846C0.117022 25.4985 0 23.7286 0 21.6819V11.8259C0 9.77912 0.117022 8.00924 0.477248 6.52315C0.842533 5.01625 1.48396 3.69119 2.61656 2.65279C3.74919 1.6144 5.19449 1.02634 6.83814 0.69145ZM21.9967 14.9206C21.9967 13.908 21.1014 13.0872 19.997 13.0872C18.8925 13.0872 17.9973 13.908 17.9973 14.9206V20.5779L16.4117 19.1242C15.6308 18.4083 14.3647 18.4083 13.5837 19.1242C12.8028 19.8401 12.8028 21.001 13.5837 21.7169L18.458 26.1857C18.4794 26.2053 18.5012 26.2245 18.5234 26.2432C18.8889 26.6083 19.4137 26.8372 19.997 26.8372C20.5803 26.8372 21.105 26.6083 21.4705 26.2432C21.4927 26.2245 21.5145 26.2053 21.5359 26.1857L26.4102 21.7169C27.1911 21.001 27.1911 19.8401 26.4102 19.1242C25.6293 18.4083 24.3631 18.4083 23.5822 19.1242L21.9967 20.5779V14.9206Z"
                                                                fill="#7E3AE3" />
                                                        </svg>
                                                    </div>
                                                </a>
                                                <h3><?php echo e(__('Save')); ?></h3>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="share-info">
                                                    <div
                                                        class="info-icon d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="38"
                                                            height="39" viewBox="0 0 38 39" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M13.593 22.7056L21.7663 14.5308C22.3059 13.9911 23.1832 13.9911 23.7228 14.5308C24.2624 15.0718 24.2624 15.9477 23.7228 16.4887L15.5495 24.6621L21.9656 36.7819C22.483 37.7601 23.536 38.3358 24.6388 38.2444C25.743 38.1531 26.6866 37.4128 27.0367 36.3612C29.472 29.0567 35.5795 10.7325 37.8584 3.89712C38.1891 2.90225 37.9303 1.80637 37.1901 1.06471C36.4484 0.323054 35.3526 0.0643024 34.3577 0.396388L1.89265 11.2182C0.842444 11.5683 0.10217 12.5106 0.00946439 13.6148C-0.0818578 14.719 0.493768 15.7706 1.47341 16.2894L13.593 22.7056Z"
                                                                fill="#247BDF" />
                                                        </svg>
                                                    </div>
                                                </a>
                                                <h3><?php echo e(__('Share')); ?></h3>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="contact-info">
                                                    <div
                                                        class="info-icon d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="36"
                                                            height="37" viewBox="0 0 36 37" fill="none">
                                                            <path
                                                                d="M35.572 28.4051L29.6392 22.4725C29.4337 22.2669 29.1715 22.1273 28.8862 22.0716C28.6009 22.0158 28.3055 22.0464 28.0377 22.1594L21.7923 24.795L11.4587 14.4616L14.0944 8.21629C14.2074 7.94846 14.238 7.65299 14.1823 7.36768C14.1265 7.08237 13.9869 6.82017 13.7813 6.61462L7.84863 0.681962C7.71293 0.546252 7.55182 0.438601 7.37451 0.365155C7.19721 0.291709 7.00717 0.253906 6.81525 0.253906C6.62333 0.253906 6.43329 0.291709 6.25598 0.365155C6.07867 0.438601 5.91757 0.546252 5.78186 0.681962L1.73049 4.73337C-2.90779 9.37172 2.381 17.7525 10.4412 25.8127C18.5014 33.8729 26.8823 39.1616 31.5206 34.5233L35.572 30.4719C35.8461 30.1978 36 29.8261 36 29.4385C36 29.0509 35.846 28.6792 35.572 28.4051Z"
                                                                fill="#EC2183" />
                                                        </svg>
                                                    </div>
                                                </a>
                                                <h3><?php echo e(__('Contact')); ?></h3>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                            <?php endif; ?>

                            <?php if($order_key == 'social'): ?>
                                <section class="social-link-sec pb" id="social-div">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Social')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="social-link-slider" id="inputrow_socials_preview">
                                            <?php if(!is_null($social_content) && !is_null($sociallinks)): ?>
                                                <?php $__currentLoopData = $social_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key => $social_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $social_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key1 => $social_val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($social_key1 != 'id'): ?>
                                                            <div class="social-link"
                                                                id="socials_<?php echo e($loop->parent->index + 1); ?>">
                                                                <?php if($social_key1 == 'Whatsapp'): ?>
                                                                    <?php
                                                                        $social_links = 'https://wa.me/' . $social_val1;
                                                                    ?>
                                                                <?php else: ?>
                                                                    <?php
                                                                        $social_links = url($social_val1);
                                                                    ?>
                                                                <?php endif; ?>
                                                                <a href="<?php echo e($social_links); ?>" target="_blank"
                                                                    id="<?php echo e('social_link_' . $social_nos . '_href_preview'); ?>">
                                                                    <img src="<?php echo e(asset('custom/theme1/icon/social/' . strtolower($social_key1) . '.svg')); ?>"
                                                                        alt="social" class="img-fluid">
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
                            <?php if($order_key == 'payment'): ?>
                                <section class="payment-sec bg-light-color pt pb mb" id="payment-section">
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Payment')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
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
                                                        <a href="<?php echo e(route('card.pay.with.paypal', $business->id)); ?>"
                                                            class="d-flex align-items-center" target="_blank">
                                                            <img src="<?php echo e(asset('custom/img/payments/paypal.png')); ?>"
                                                                alt="payment-image" class="img-fluid" loading="lazy">
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
                                    <div class="container">
                                        <div class="section-title common-title">
                                            <h2><?php echo e(__('Download Here')); ?></h2>
                                            <div class="line"></div>
                                            <div class="title-circle">
                                                <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="27.5" cy="27.5" r="25.5" stroke="#D8C4F7"
                                                        stroke-width="4" stroke-dasharray="1 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <?php if(!is_null($appInfo)): ?>
                                            <ul class="d-flex align-items-center">
                                                <?php if(!is_null($appInfo->playstore_id ) && !is_null($appInfo->appstore_id )): ?>
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
                                        <?php endif; ?>
                                    </div>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="331" height="332" viewBox="0 0 331 332"
                                                    fill="none">
                                                    <rect y="0.253906" width="331" height="331" rx="165.5" fill="#F9F4FD" />
                                                    <path d="M248.869 109.312H217.148V117.423H248.869V109.312Z" fill="#EBEBEB" />
                                                    <path
                                                        d="M235.456 125.966C235.453 125.963 235.45 125.913 235.446 125.818C235.444 125.71 235.44 125.573 235.436 125.402C235.43 125.02 235.422 124.488 235.412 123.806C235.4 122.406 235.381 120.393 235.358 117.855L235.456 117.95C228.213 117.964 216.695 117.986 203.737 118.011C203.809 117.942 203.575 118.167 203.897 117.855V117.858V117.862V117.87V117.886V117.919V117.984V118.115V118.375V118.895C203.897 119.241 203.897 119.586 203.897 119.93C203.897 120.618 203.897 121.3 203.897 121.977C203.896 123.331 203.895 124.662 203.894 125.966L203.736 125.814C212.768 125.842 220.672 125.866 226.341 125.883C229.164 125.902 231.43 125.917 233.013 125.927C233.782 125.935 234.386 125.942 234.817 125.946C235.011 125.951 235.167 125.954 235.289 125.956C235.396 125.959 235.453 125.963 235.456 125.966C235.46 125.969 235.41 125.973 235.31 125.976C235.192 125.978 235.044 125.981 234.857 125.986C234.434 125.99 233.842 125.997 233.087 126.006C231.513 126.016 229.26 126.031 226.452 126.049C220.755 126.066 212.813 126.091 203.737 126.119L203.579 126.119V125.966C203.578 124.662 203.577 123.33 203.576 121.977C203.576 121.3 203.576 120.617 203.576 119.93C203.576 119.586 203.576 119.241 203.576 118.895V118.375V118.114V117.984V117.919V117.886V117.87V117.861V117.858V117.855C203.899 117.543 203.666 117.769 203.74 117.699C216.697 117.724 228.215 117.746 235.458 117.76H235.557L235.556 117.855C235.533 120.417 235.515 122.449 235.502 123.862C235.492 124.535 235.484 125.061 235.478 125.437C235.474 125.601 235.47 125.732 235.467 125.836C235.463 125.926 235.46 125.969 235.456 125.966Z"
                                                        fill="#E0E0E0" />
                                                    <path d="M113.835 143.757H82.1143V151.868H113.835V143.757Z" fill="#EBEBEB" />
                                                    <path
                                                        d="M100.422 160.41C100.419 160.407 100.416 160.358 100.412 160.263C100.41 160.154 100.406 160.017 100.402 159.847C100.396 159.465 100.388 158.933 100.378 158.251C100.365 156.851 100.347 154.838 100.324 152.3L100.422 152.395C93.1786 152.409 81.6605 152.431 68.7033 152.456C68.7747 152.386 68.5405 152.612 68.8629 152.3V152.302V152.306V152.314V152.33V152.363V152.428V152.559V152.819V153.339C68.8629 153.685 68.8629 154.03 68.8629 154.374C68.8629 155.061 68.8624 155.744 68.8624 156.421C68.8614 157.775 68.8603 159.106 68.8598 160.41L68.7017 160.258C77.734 160.286 85.6376 160.31 91.3064 160.327C94.1299 160.346 96.396 160.361 97.9786 160.371C98.7483 160.38 99.3515 160.386 99.783 160.391C99.9771 160.395 100.133 160.398 100.255 160.4C100.362 160.404 100.419 160.407 100.422 160.41C100.426 160.413 100.376 160.417 100.276 160.42C100.158 160.423 100.009 160.426 99.8232 160.43C99.4 160.435 98.8083 160.442 98.0532 160.451C96.479 160.461 94.2259 160.476 91.4176 160.494C85.7211 160.511 77.7789 160.536 68.7027 160.563L68.5446 160.564V160.41C68.5436 159.106 68.5431 157.775 68.542 156.421C68.542 155.744 68.5415 155.062 68.5415 154.374C68.5415 154.03 68.5415 153.685 68.5415 153.339V152.819V152.559V152.428V152.363V152.33V152.314V152.306V152.302V152.3C68.865 151.987 68.6323 152.213 68.7048 152.143C81.6621 152.168 93.1807 152.19 100.423 152.204H100.522L100.521 152.299C100.498 154.861 100.48 156.893 100.467 158.306C100.457 158.98 100.449 159.505 100.443 159.881C100.439 160.045 100.435 160.177 100.433 160.28C100.428 160.37 100.425 160.413 100.422 160.41Z"
                                                        fill="#E0E0E0" />
                                                    <path d="M182.944 56.9924H149.334V65.2337H182.944V56.9924Z" fill="#EBEBEB" />
                                                    <path d="M170.823 228.86H137.213V237.101H170.823V228.86Z" fill="#EBEBEB" />
                                                    <path d="M110.999 224.494H77.3892V232.735H110.999V224.494Z" fill="#EBEBEB" />
                                                    <path
                                                        d="M89.1109 83.5915C89.1078 83.5878 89.1041 83.5341 89.1005 83.4308C89.0979 83.3123 89.0942 83.1636 89.0895 82.9773C89.0832 82.5615 89.0749 81.9817 89.0645 81.2382C89.0509 79.7125 89.0316 77.5188 89.0076 74.7538L89.1104 74.8571C81.5323 74.8723 69.4799 74.8968 55.9221 74.9239C55.9972 74.8483 55.7514 75.094 56.089 74.7538V74.7559V74.7601V74.769V74.7867V74.8222V74.8931V75.0351V75.3189V75.8856C56.089 76.2629 56.089 76.6386 56.089 77.0127C56.0885 77.762 56.0885 78.5055 56.088 79.2428C56.0869 80.718 56.0859 82.1686 56.0854 83.5899L55.92 83.4235C65.3713 83.4537 73.6407 83.4803 79.5725 83.4991C82.5269 83.5195 84.8979 83.5357 86.5541 83.5466C87.3597 83.556 87.9906 83.5633 88.442 83.5685C88.6449 83.5727 88.8077 83.5764 88.9356 83.579C89.0483 83.5842 89.1072 83.5878 89.1109 83.5915C89.1145 83.5951 89.0624 83.5988 88.957 83.6024C88.8343 83.6051 88.6783 83.6087 88.4837 83.6129C88.0407 83.6181 87.4218 83.6254 86.6313 83.6348C84.9845 83.6458 82.6265 83.6619 79.6883 83.6823C73.7278 83.7011 65.4177 83.7277 55.9205 83.7579L55.7551 83.7585V83.5915C55.754 82.1706 55.7535 80.7195 55.7525 79.2444C55.7525 78.5071 55.752 77.763 55.752 77.0142C55.752 76.6401 55.752 76.2639 55.752 75.8872V75.3205V75.0366V74.8947V74.8237V74.7883V74.7705V74.7617V74.7575V74.7554C56.0901 74.4147 55.8469 74.6609 55.9231 74.5848C69.4809 74.6119 81.5334 74.6359 89.1114 74.6516H89.2153L89.2147 74.7549C89.1902 77.5465 89.1709 79.7605 89.1579 81.3008C89.1469 82.0344 89.1391 82.6063 89.1328 83.017C89.1281 83.1954 89.125 83.3384 89.1219 83.4522C89.1177 83.5477 89.1145 83.5951 89.1109 83.5915Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M93.6114 74.7539C93.6072 74.7497 93.603 74.6928 93.5988 74.5858C93.5952 74.4591 93.591 74.3051 93.5858 74.1173C93.5785 73.6826 93.5686 73.0914 93.5555 72.3453C93.5399 70.7955 93.5174 68.6071 93.4898 65.9162L93.6114 66.0383C88.4456 66.0508 81.417 66.0675 73.6709 66.0863C73.5191 66.2382 73.875 65.8792 73.8384 65.9167V65.9188V65.9235V65.9329V65.9512V65.9872V66.0597V66.2048V66.4944V67.072C73.8384 67.456 73.8384 67.8385 73.8379 68.2184C73.8374 68.9781 73.8369 69.7285 73.8363 70.4678C73.8343 71.9461 73.8322 73.3795 73.8306 74.7528L73.6699 74.5911C79.4269 74.6219 84.3829 74.649 87.9353 74.6678C89.6869 74.6866 91.0911 74.7017 92.0908 74.7126C92.5579 74.721 92.9294 74.7278 93.2117 74.733C93.4674 74.7408 93.6046 74.7476 93.6114 74.7539C93.6181 74.7607 93.494 74.7669 93.2492 74.7737C92.9753 74.7789 92.6147 74.7857 92.1618 74.794C91.1714 74.805 89.7798 74.8201 88.0433 74.8389C84.4643 74.8582 79.4702 74.8848 73.6694 74.9156L73.5086 74.9167L73.5081 74.7539C73.506 73.3805 73.504 71.9471 73.5019 70.4689C73.5013 69.7295 73.5008 68.9792 73.5003 68.2194C73.5003 67.8396 73.5003 67.4576 73.4998 67.073V66.4954V66.2058V66.0607V65.9882V65.9522V65.9339V65.9246V65.9199V65.9178C73.4627 65.9538 73.8207 65.5948 73.6704 65.7466C81.4165 65.7654 88.4445 65.7821 93.6108 65.7946L93.734 65.7952L93.7324 65.9173C93.7048 68.6395 93.6829 70.8529 93.6672 72.4209C93.6542 73.1551 93.6442 73.7374 93.6369 74.1653C93.6281 74.5598 93.6197 74.7627 93.6114 74.7539Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M187.552 182.453C187.549 182.449 187.545 182.396 187.542 182.292C187.539 182.174 187.536 182.025 187.531 181.839C187.525 181.423 187.516 180.843 187.506 180.1C187.493 178.574 187.473 176.38 187.449 173.615L187.552 173.719C179.974 173.734 167.921 173.758 154.363 173.786C154.439 173.71 154.193 173.956 154.531 173.615V173.617V173.622V173.631V173.648V173.684V173.755V173.897V174.181V174.747C154.531 175.124 154.531 175.5 154.531 175.874C154.53 176.624 154.53 177.367 154.53 178.104C154.529 179.58 154.528 181.03 154.527 182.451L154.362 182.285C163.813 182.315 172.083 182.342 178.014 182.361C180.969 182.381 183.34 182.397 184.995 182.408C185.801 182.418 186.432 182.425 186.883 182.43C187.086 182.434 187.249 182.438 187.377 182.441C187.49 182.446 187.549 182.449 187.552 182.453C187.556 182.457 187.504 182.46 187.399 182.464C187.276 182.467 187.12 182.47 186.926 182.474C186.483 182.48 185.864 182.487 185.073 182.496C183.426 182.508 181.068 182.524 178.13 182.544C172.17 182.563 163.86 182.589 154.362 182.62L154.197 182.62V182.453C154.196 181.032 154.195 179.581 154.194 178.106C154.194 177.368 154.194 176.625 154.194 175.876C154.194 175.502 154.194 175.125 154.194 174.749V174.182V173.898V173.756V173.685V173.65V173.632V173.623V173.619V173.617C154.532 173.276 154.289 173.523 154.365 173.446C167.923 173.473 179.975 173.497 187.553 173.513H187.657L187.656 173.616C187.632 176.408 187.613 178.622 187.599 180.162C187.588 180.896 187.58 181.468 187.574 181.879C187.569 182.057 187.566 182.2 187.563 182.314C187.56 182.409 187.556 182.457 187.552 182.453Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M192.053 173.616C192.049 173.612 192.044 173.555 192.04 173.448C192.037 173.321 192.032 173.167 192.027 172.979C192.02 172.545 192.01 171.953 191.997 171.207C191.981 169.658 191.959 167.469 191.931 164.778L192.053 164.9C186.887 164.913 179.858 164.93 172.112 164.948C171.96 165.1 172.316 164.741 172.28 164.779V164.781V164.786V164.794V164.813V164.849V164.922V165.067V165.356V165.934C172.28 166.318 172.28 166.7 172.279 167.08C172.279 167.84 172.278 168.59 172.278 169.329C172.276 170.808 172.274 172.241 172.272 173.614L172.111 173.453C177.868 173.483 182.824 173.51 186.377 173.53C188.128 173.549 189.532 173.564 190.532 173.575C190.999 173.583 191.371 173.59 191.653 173.595C191.909 173.602 192.046 173.609 192.053 173.616C192.06 173.623 191.935 173.629 191.691 173.636C191.417 173.641 191.056 173.648 190.603 173.656C189.613 173.667 188.221 173.682 186.485 173.701C182.906 173.72 177.912 173.747 172.111 173.778L171.95 173.779L171.95 173.616C171.947 172.243 171.945 170.809 171.943 169.331C171.943 168.592 171.942 167.841 171.942 167.082C171.942 166.702 171.942 166.32 171.941 165.936V165.358V165.068V164.923V164.85V164.814V164.796V164.787V164.782V164.78C171.904 164.816 172.262 164.457 172.112 164.609C179.858 164.628 186.886 164.645 192.052 164.657L192.175 164.658L192.174 164.78C192.146 167.502 192.124 169.715 192.109 171.283C192.096 172.018 192.086 172.6 192.078 173.028C192.069 173.421 192.061 173.624 192.053 173.616Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M263.653 70.137C263.65 70.1333 263.647 70.0796 263.643 69.9763C263.64 69.8578 263.637 69.7091 263.632 69.5228C263.626 69.1069 263.618 68.5272 263.607 67.7837C263.594 66.2579 263.574 64.0643 263.55 61.2993L263.653 61.4026C256.075 61.4178 244.022 61.4423 230.464 61.4694C230.539 61.3937 230.294 61.639 230.631 61.2993V61.3014V61.3061V61.315V61.3327V61.3682V61.4391V61.5816V61.8655V62.4321C230.631 62.8094 230.631 63.1851 230.631 63.5592C230.631 64.3085 230.631 65.0521 230.631 65.7894C230.63 67.2645 230.629 68.7151 230.628 70.1364L230.462 69.97C239.914 70.0003 248.183 70.0269 254.115 70.0457C257.069 70.066 259.44 70.0822 261.097 70.0931C261.902 70.1025 262.533 70.1098 262.984 70.115C263.187 70.1192 263.35 70.1229 263.478 70.1255C263.591 70.1297 263.65 70.1333 263.653 70.137C263.657 70.1406 263.605 70.1443 263.5 70.1479C263.377 70.1505 263.221 70.1542 263.027 70.1584C262.584 70.1636 261.965 70.1709 261.174 70.1803C259.528 70.1912 257.17 70.2074 254.231 70.2278C248.271 70.2465 239.961 70.2732 230.463 70.3034L230.298 70.3039V70.137C230.297 68.7161 230.296 67.265 230.295 65.7899C230.295 65.0521 230.295 64.3085 230.295 63.5597C230.295 63.1856 230.295 62.8094 230.295 62.4326V61.866V61.5821V61.4397V61.3687V61.3332V61.3155V61.3066V61.3019V61.2998C230.633 60.9591 230.39 61.2054 230.466 61.1292C244.024 61.1563 256.076 61.1803 263.654 61.196H263.758L263.758 61.2993C263.733 64.0909 263.714 66.3049 263.701 67.8452C263.69 68.5789 263.682 69.1508 263.676 69.5614C263.671 69.7399 263.668 69.8828 263.665 69.9966C263.66 70.0931 263.656 70.1401 263.653 70.137Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M268.153 61.2993C268.149 61.2951 268.145 61.2383 268.141 61.1313C268.137 61.0045 268.133 60.8506 268.128 60.6627C268.12 60.2281 268.111 59.6369 268.098 58.8907C268.082 57.341 268.059 55.1526 268.032 52.4617L268.153 52.5838C262.988 52.5963 255.959 52.613 248.213 52.6318C248.061 52.7836 248.417 52.4246 248.38 52.4622V52.4643V52.469V52.4783V52.4966V52.5326V52.6057V52.7507V53.0408V53.6185C248.38 54.0025 248.38 54.3845 248.38 54.7649C248.379 55.5241 248.379 56.2749 248.378 57.0138C248.376 58.492 248.374 59.9254 248.373 61.2988L248.212 61.137C253.969 61.1678 258.925 61.195 262.477 61.2143C264.229 61.233 265.633 61.2482 266.633 61.2591C267.1 61.2675 267.471 61.2743 267.754 61.2795C268.01 61.2863 268.147 61.2925 268.153 61.2993C268.16 61.3061 268.036 61.3124 267.791 61.3191C267.517 61.3244 267.157 61.3311 266.704 61.3395C265.713 61.3504 264.322 61.3656 262.585 61.3844C259.006 61.4037 254.012 61.4303 248.211 61.4611L248.051 61.4621L248.05 61.2993C248.048 59.9259 248.046 58.4926 248.044 57.0143C248.043 56.2749 248.043 55.5246 248.042 54.7654C248.042 54.3855 248.042 54.0036 248.042 53.619V53.0414V52.7512V52.6062V52.5331V52.4971V52.4789V52.4695V52.4648V52.4627C248.005 52.4987 248.363 52.1397 248.212 52.2915C255.958 52.3103 262.987 52.327 268.153 52.3396L268.276 52.3401L268.274 52.4622C268.247 55.1844 268.225 57.3978 268.209 58.9653C268.197 59.6995 268.186 60.2818 268.179 60.7097C268.17 61.1052 268.162 61.3077 268.153 61.2993Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M270.87 224.435C270.867 224.431 270.863 224.377 270.86 224.274C270.857 224.156 270.853 224.007 270.849 223.821C270.842 223.405 270.835 222.825 270.824 222.081C270.811 220.556 270.791 218.362 270.767 215.597L270.87 215.7C263.292 215.716 251.239 215.74 237.681 215.767C237.756 215.692 237.511 215.937 237.848 215.597V215.599V215.604V215.613V215.631V215.666V215.737V215.879V216.163V216.729C237.848 217.107 237.848 217.482 237.848 217.856C237.848 218.606 237.848 219.349 237.848 220.087C237.847 221.562 237.846 223.012 237.845 224.434L237.679 224.267C247.131 224.298 255.4 224.324 261.332 224.343C264.286 224.363 266.657 224.379 268.313 224.39C269.119 224.4 269.75 224.407 270.201 224.412C270.404 224.417 270.567 224.42 270.695 224.423C270.808 224.428 270.866 224.432 270.87 224.435C270.874 224.438 270.822 224.442 270.717 224.446C270.594 224.448 270.438 224.452 270.243 224.456C269.8 224.461 269.182 224.469 268.391 224.478C266.744 224.49 264.386 224.505 261.448 224.526C255.488 224.544 247.177 224.571 237.68 224.601L237.515 224.602V224.435C237.514 223.014 237.513 221.563 237.512 220.088C237.512 219.35 237.512 218.606 237.512 217.858C237.512 217.483 237.512 217.107 237.512 216.73V216.164V215.88V215.738V215.667V215.632V215.614V215.605V215.6V215.598C237.85 215.257 237.607 215.504 237.683 215.428C251.241 215.455 263.293 215.479 270.871 215.494H270.975L270.975 215.598C270.95 218.389 270.931 220.603 270.918 222.144C270.907 222.877 270.899 223.449 270.893 223.86C270.888 224.038 270.885 224.181 270.882 224.295C270.877 224.391 270.873 224.438 270.87 224.435Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M275.37 215.597C275.366 215.593 275.362 215.536 275.358 215.429C275.354 215.303 275.35 215.149 275.345 214.961C275.337 214.526 275.327 213.935 275.314 213.189C275.299 211.64 275.276 209.451 275.249 206.76L275.37 206.882C270.204 206.895 263.176 206.912 255.43 206.93C255.278 207.082 255.634 206.723 255.597 206.761V206.763V206.768V206.776V206.795V206.831V206.904V207.049V207.339V207.917C255.597 208.301 255.597 208.683 255.597 209.063C255.596 209.822 255.596 210.573 255.595 211.312C255.593 212.791 255.591 214.224 255.589 215.597L255.429 215.436C261.186 215.466 266.142 215.494 269.694 215.513C271.446 215.532 272.85 215.547 273.85 215.558C274.317 215.566 274.688 215.573 274.97 215.578C275.227 215.584 275.363 215.591 275.37 215.597C275.377 215.604 275.253 215.61 275.008 215.617C274.734 215.622 274.374 215.629 273.921 215.638C272.93 215.649 271.539 215.664 269.802 215.682C266.223 215.702 261.229 215.728 255.428 215.759L255.267 215.76L255.267 215.597C255.265 214.224 255.263 212.791 255.261 211.312C255.26 210.573 255.26 209.823 255.259 209.063C255.259 208.683 255.259 208.301 255.259 207.917V207.339V207.049V206.904V206.831V206.795V206.776V206.768V206.763V206.761C255.222 206.797 255.579 206.438 255.429 206.59C263.175 206.608 270.204 206.625 275.37 206.638L275.493 206.638L275.492 206.76C275.464 209.482 275.442 211.696 275.426 213.263C275.414 213.998 275.404 214.58 275.396 215.008C275.387 215.403 275.379 215.606 275.37 215.597Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M128.59 62.6821C128.273 61.7737 127.626 61.0025 126.844 60.4431C126.078 59.8952 125.157 59.5341 124.215 59.5399C123.214 59.5461 122.224 59.9823 121.543 60.7155C121.138 61.1517 120.846 61.6891 120.69 62.2636C120.322 61.8681 119.869 61.5514 119.367 61.35C118.439 60.9779 117.356 61.0072 116.449 61.4288C115.595 61.8259 114.917 62.5459 114.458 63.3688C113.99 64.2089 113.735 65.1831 113.837 66.139C113.965 67.3365 114.478 68.5638 115.309 69.4352C116.187 70.3551 117.414 70.9823 118.62 71.3841C120.649 72.0598 123.305 72.8796 123.305 72.8796C123.305 72.8796 124.96 70.9458 126.506 69.4676C127.425 68.5889 128.266 67.4978 128.666 66.2909C129.046 65.1481 128.985 63.8196 128.59 62.6821Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M277.419 103.808C277.665 102.878 277.559 101.877 277.223 100.976C276.893 100.094 276.332 99.2796 275.547 98.7583C274.714 98.2047 273.649 98.0122 272.674 98.2402C272.094 98.3759 271.552 98.6587 271.102 99.0479C271.018 98.5141 270.819 97.9981 270.515 97.5509C269.953 96.7233 269.039 96.1431 268.051 95.9855C267.121 95.8373 266.156 96.056 265.316 96.4817C264.459 96.9169 263.702 97.5817 263.253 98.4317C262.691 99.4967 262.43 100.801 262.632 101.988C262.847 103.242 263.512 104.446 264.289 105.454C265.594 107.148 267.338 109.312 267.338 109.312C267.338 109.312 269.792 108.633 271.899 108.271C273.153 108.056 274.459 107.621 275.466 106.844C276.42 106.108 277.111 104.972 277.419 103.808Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M66.025 185.314C65.6759 184.418 65.0001 183.671 64.1981 183.141C63.4123 182.622 62.4794 182.295 61.538 182.335C60.5383 182.379 59.5641 182.85 58.9108 183.609C58.5221 184.059 58.2502 184.607 58.1161 185.187C57.7336 184.805 57.2692 184.505 56.7605 184.323C55.8186 183.985 54.7385 184.054 53.8473 184.509C53.0082 184.938 52.357 185.682 51.9292 186.521C51.4924 187.378 51.2722 188.361 51.41 189.312C51.5827 190.504 52.1394 191.712 53.0025 192.551C53.9141 193.438 55.1622 194.02 56.3827 194.377C58.4349 194.978 61.119 195.699 61.119 195.699C61.119 195.699 62.7022 193.706 64.1924 192.172C65.0789 191.26 65.8783 190.139 66.2347 188.918C66.5723 187.762 66.4622 186.437 66.025 185.314Z"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M274.348 250.501C274.348 250.576 225.453 250.637 165.152 250.637C104.829 250.637 55.9443 250.576 55.9443 250.501C55.9443 250.426 104.829 250.365 165.152 250.365C225.453 250.365 274.348 250.426 274.348 250.501Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M104.331 153.288H93.8423V86.5415H104.331V115.147H116.25V86.5415H126.93V153.288H116.25V124.682H104.331V153.288Z"
                                                        fill="#263238" />
                                                    <path class="fill-theme"
                                                        d="M193.434 165.871V217.361C193.434 222.129 195.532 223.845 198.869 223.845C202.206 223.845 204.304 222.129 204.304 217.361V165.871H214.221V216.693C214.221 227.373 208.881 233.475 198.583 233.475C188.285 233.475 182.945 227.373 182.945 216.693V165.871H193.434Z"
                                                        fill="#7E3AE3" />
                                                    <path
                                                        d="M171.133 150.981H160.549L158.738 138.872H145.865L144.053 150.981H134.423L145.102 84.2344H160.454L171.133 150.981ZM147.2 129.813H157.308L152.254 96.0588L147.2 129.813Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M185.219 102.59V150.933H175.779V84.1863H188.938L199.713 124.139V84.1863H209.057V150.933H198.282L185.219 102.59Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M236.685 120.238L234.54 126.509L237.648 145.923L227.715 147.513L217.595 84.3031L227.528 82.7127L231.937 110.255L240.531 80.6307L250.465 79.0403L241.159 109.426L260.585 142.251L250.381 143.884L236.685 120.238Z"
                                                        fill="#263238" />
                                                    <path class="fill-theme"
                                                        d="M146.241 181.889C146.241 171.21 151.867 165.107 162.164 165.107C172.463 165.107 178.089 171.21 178.089 181.889V216.598C178.089 227.278 172.463 233.38 162.164 233.38C151.867 233.38 146.241 227.278 146.241 216.598V181.889ZM156.729 217.266C156.729 222.033 158.827 223.845 162.164 223.845C165.502 223.845 167.599 222.033 167.599 217.266V181.223C167.599 176.454 165.502 174.643 162.164 174.643C158.827 174.643 156.729 176.455 156.729 181.223V217.266Z"
                                                        fill="#7E3AE3" />
                                                    <path class="fill-theme"
                                                        d="M121.883 212.035L108.628 167.41H119.594L127.604 197.827L135.613 167.41H145.625L132.371 212.035V234.157H121.883V212.035Z"
                                                        fill="#7E3AE3" />
                                                    <path
                                                        d="M218.88 154.93L215.59 136.595C214.623 132.06 216.456 127.719 221.016 126.877L221.442 126.824C225.728 126.29 229.706 129.135 230.583 133.364C231.4 137.299 232.251 141.657 232.491 143.792C232.986 148.214 228.657 149.451 228.657 149.451C228.647 149.452 229.075 152.123 229.292 153.41L230.824 156.247L227.07 155.97L218.88 154.93Z"
                                                        fill="#FFBF9D" />
                                                    <path
                                                        d="M228.657 149.451C228.657 149.451 225.894 149.961 222.697 148.468C222.697 148.468 224.493 151.615 228.849 150.668L228.657 149.451Z"
                                                        fill="#FF9A6C" />
                                                    <path
                                                        d="M228.93 137.658C228.983 137.989 228.747 138.308 228.401 138.37C228.057 138.431 227.734 138.214 227.681 137.882C227.628 137.551 227.864 137.232 228.208 137.17C228.553 137.108 228.877 137.326 228.93 137.658Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M229.888 135.431C229.821 135.523 229.299 135.229 228.62 135.316C227.942 135.392 227.488 135.803 227.404 135.729C227.363 135.697 227.424 135.539 227.621 135.354C227.815 135.17 228.16 134.972 228.583 134.921C229.005 134.871 229.381 134.982 229.604 135.116C229.833 135.249 229.922 135.389 229.888 135.431Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M222.734 138.421C222.787 138.753 222.551 139.071 222.206 139.133C221.861 139.195 221.538 138.978 221.485 138.646C221.432 138.314 221.669 137.995 222.013 137.933C222.358 137.871 222.68 138.09 222.734 138.421Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M223.258 136.417C223.19 136.509 222.667 136.215 221.99 136.302C221.311 136.378 220.857 136.789 220.773 136.715C220.732 136.683 220.793 136.525 220.99 136.34C221.184 136.156 221.529 135.958 221.951 135.907C222.374 135.857 222.749 135.968 222.974 136.102C223.202 136.235 223.291 136.375 223.258 136.417Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M226.341 141.326C226.333 141.288 226.746 141.162 227.418 140.99C227.589 140.95 227.749 140.896 227.763 140.774C227.788 140.644 227.693 140.466 227.584 140.275C227.369 139.877 227.143 139.458 226.907 139.02C225.961 137.231 225.254 135.75 225.326 135.713C225.398 135.676 226.224 137.096 227.169 138.885C227.398 139.327 227.617 139.748 227.826 140.151C227.916 140.34 228.056 140.549 228.001 140.819C227.97 140.955 227.854 141.065 227.747 141.109C227.641 141.156 227.543 141.17 227.458 141.186C226.775 141.308 226.349 141.365 226.341 141.326Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M223.213 134.268C223.142 134.452 222.461 134.352 221.658 134.435C220.852 134.501 220.202 134.725 220.098 134.557C220.052 134.476 220.168 134.303 220.433 134.128C220.695 133.952 221.112 133.789 221.594 133.744C222.076 133.699 222.515 133.783 222.805 133.908C223.098 134.031 223.244 134.18 223.213 134.268Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M229.671 133.432C229.551 133.605 228.978 133.523 228.314 133.609C227.648 133.674 227.105 133.883 226.953 133.74C226.885 133.67 226.952 133.504 227.177 133.324C227.398 133.145 227.786 132.97 228.244 132.918C228.701 132.866 229.115 132.951 229.368 133.076C229.623 133.201 229.722 133.348 229.671 133.432Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M216.358 139.819C216.279 139.796 213.213 139.3 213.686 142.305C214.159 145.312 217.079 144.217 217.071 144.13C217.062 144.043 216.358 139.819 216.358 139.819Z"
                                                        fill="#FFBF9D" />
                                                    <path
                                                        d="M215.973 143.136C215.959 143.128 215.927 143.18 215.844 143.235C215.764 143.288 215.62 143.338 215.454 143.304C215.118 143.237 214.771 142.775 214.671 142.236C214.621 141.964 214.637 141.694 214.7 141.463C214.757 141.229 214.875 141.053 215.031 140.999C215.184 140.938 215.313 141.015 215.363 141.094C215.416 141.172 215.406 141.235 215.423 141.238C215.433 141.244 215.479 141.177 215.436 141.057C215.414 140.999 215.367 140.934 215.288 140.888C215.207 140.84 215.096 140.827 214.986 140.856C214.757 140.909 214.582 141.155 214.513 141.408C214.431 141.665 214.406 141.969 214.463 142.275C214.578 142.878 214.976 143.396 215.431 143.453C215.651 143.475 215.818 143.383 215.897 143.298C215.979 143.209 215.984 143.14 215.973 143.136Z"
                                                        fill="#FF9A6C" />
                                                    <path
                                                        d="M224.294 142.097C224.397 142.073 224.516 142.762 225.189 143.149C225.862 143.538 226.583 143.336 226.604 143.431C226.622 143.473 226.464 143.593 226.155 143.654C225.853 143.717 225.392 143.696 224.981 143.458C224.569 143.22 224.347 142.847 224.275 142.568C224.199 142.285 224.247 142.1 224.294 142.097Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M235.982 128.404C235.907 128.235 235.755 128.109 235.583 128.04C235.207 127.89 234.814 127.979 234.43 128.032C233.473 128.165 232.489 128.068 231.571 127.768C231.845 127.572 232.093 127.346 232.293 127.075C232.703 126.514 232.868 125.729 232.544 125.114C232.484 124.999 232.393 124.882 232.263 124.863C232.059 124.833 231.917 125.052 231.805 125.225C231.435 125.795 231.054 126.074 230.376 126.11C229.954 126.132 229.538 126.102 229.18 125.949C229.165 125.938 229.151 125.925 229.136 125.913C228.954 125.776 228.778 125.646 228.605 125.52C228.604 125.519 228.603 125.519 228.603 125.519L228.605 125.52C227.299 124.573 226.205 123.947 225.141 123.699C223.581 123.336 221.089 123.478 219.62 124.117C218.152 124.756 216.97 126.211 217 127.813C216.029 127.22 214.741 127.426 213.761 128.009L213.733 128.001C212.633 128.597 212.162 129.93 212.003 131.171C211.995 131.239 211.988 131.307 211.981 131.375C211.684 132.06 211.232 132.678 210.651 133.148C210.549 133.231 210.432 133.332 210.439 133.464C210.445 133.594 210.57 133.684 210.687 133.742C210.997 133.899 211.342 133.98 211.689 133.988C211.627 134.287 211.544 134.58 211.431 134.866C211.334 135.109 211.219 135.4 211.37 135.613C211.486 135.779 211.725 135.817 211.919 135.757C212.112 135.697 212.27 135.561 212.423 135.428C212.341 135.759 212.259 136.09 212.178 136.422C212.61 136.43 213.041 136.328 213.431 136.141C213.851 137.213 214.356 139.24 214.759 139.949C215.559 139.838 215.74 139.722 216.163 139.793C216.71 139.885 216.655 140.838 217.291 140.47C217.616 140.284 217.942 138.894 218.003 138.525C218.407 136.074 218.274 133.537 217.619 131.141C218.021 130.552 218.538 130.042 219.132 129.647L219.087 129.702C220.25 129.084 221.576 128.448 222.832 128.844C223.806 129.151 224.484 130.007 225.277 130.652C226.779 131.873 228.348 132.405 230.272 132.191C230.65 133.492 231.039 135.655 231.296 136.884L231.969 134.24L231.972 134.25C232.035 134.091 232.082 133.934 232.128 133.777L232.144 133.729L232.143 133.723C232.215 133.47 232.282 133.218 232.382 132.964C232.387 132.967 232.391 132.97 232.396 132.973C233.159 133.461 234.008 132.402 233.366 131.763C233.239 131.636 233.094 131.528 232.933 131.445C233.285 131.685 233.764 131.752 234.147 131.566C234.53 131.38 234.778 130.925 234.678 130.51C234.61 130.228 234.366 130.004 234.09 129.931C234.638 129.888 235.174 129.684 235.605 129.341C235.889 129.116 236.148 128.778 235.982 128.404Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M218.464 128.103C218.474 128.113 218.298 128.248 218.085 128.575C217.875 128.901 217.667 129.443 217.636 130.141C217.619 130.488 217.634 130.871 217.697 131.277C217.759 131.682 217.859 132.111 217.96 132.564C218.061 133.017 218.169 133.494 218.218 134.002C218.242 134.255 218.251 134.515 218.236 134.779C218.22 135.038 218.196 135.32 218.041 135.565C217.917 135.764 217.677 135.881 217.452 135.87C217.226 135.866 217.012 135.779 216.844 135.641C216.51 135.355 216.374 134.947 216.246 134.588L216.34 134.585C216.241 134.94 216.137 135.293 215.948 135.59C215.763 135.889 215.477 136.111 215.164 136.189C215.008 136.228 214.845 136.227 214.698 136.18C214.549 136.134 214.43 136.035 214.343 135.925C214.258 135.811 214.202 135.681 214.189 135.549C214.176 135.417 214.208 135.285 214.277 135.185L214.33 135.219C214.051 135.658 213.725 135.921 213.495 136.075C213.379 136.152 213.284 136.202 213.219 136.234C213.154 136.265 213.12 136.279 213.119 136.276C213.117 136.273 213.149 136.254 213.212 136.218C213.273 136.181 213.364 136.127 213.476 136.047C213.697 135.886 214.011 135.619 214.277 135.185L214.33 135.22C214.206 135.4 214.241 135.676 214.402 135.878C214.483 135.977 214.591 136.065 214.722 136.103C214.853 136.144 215.001 136.144 215.144 136.107C215.431 136.033 215.697 135.824 215.87 135.54C216.047 135.257 216.148 134.914 216.245 134.558L216.287 134.408L216.34 134.555C216.467 134.913 216.605 135.304 216.91 135.562C217.06 135.685 217.255 135.763 217.453 135.766C217.652 135.774 217.846 135.679 217.954 135.508C218.09 135.295 218.118 135.027 218.133 134.772C218.148 134.515 218.139 134.26 218.116 134.012C218.07 133.513 217.965 133.037 217.867 132.585C217.767 132.132 217.67 131.701 217.612 131.289C217.552 130.879 217.541 130.489 217.563 130.137C217.602 129.428 217.826 128.877 218.051 128.553C218.279 128.226 218.464 128.103 218.464 128.103Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M232.743 130.272C232.744 130.273 232.734 130.285 232.712 130.307C232.686 130.334 232.654 130.365 232.614 130.404C232.572 130.448 232.517 130.499 232.446 130.553C232.377 130.609 232.299 130.675 232.201 130.736C231.822 130.994 231.197 131.288 230.37 131.367C229.551 131.448 228.532 131.311 227.561 130.798C226.584 130.303 225.668 129.491 224.871 128.522C224.469 128.039 224.123 127.534 223.757 127.073C223.393 126.613 223.006 126.195 222.566 125.886C222.131 125.574 221.65 125.369 221.179 125.313C220.943 125.281 220.714 125.301 220.498 125.34C220.283 125.385 220.084 125.461 219.905 125.553C219.545 125.739 219.272 125.996 219.073 126.248C218.873 126.501 218.753 126.756 218.676 126.969C218.539 127.405 218.568 127.666 218.551 127.664C218.549 127.664 218.548 127.648 218.548 127.618C218.548 127.58 218.548 127.535 218.548 127.48C218.551 127.359 218.576 127.18 218.638 126.957C218.71 126.737 218.827 126.475 219.027 126.212C219.226 125.951 219.502 125.684 219.871 125.488C220.055 125.392 220.259 125.311 220.482 125.262C220.705 125.219 220.945 125.197 221.189 125.228C221.678 125.282 222.175 125.492 222.622 125.809C223.073 126.123 223.47 126.547 223.838 127.011C224.208 127.474 224.553 127.978 224.953 128.457C225.743 129.418 226.647 130.221 227.606 130.713C228.56 131.223 229.556 131.363 230.364 131.294C231.178 131.226 231.798 130.947 232.179 130.702C232.562 130.454 232.733 130.26 232.743 130.272Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M232.843 128.275C232.848 128.281 232.798 128.329 232.702 128.41C232.608 128.493 232.462 128.6 232.272 128.72C232.083 128.841 231.844 128.964 231.569 129.078C231.293 129.187 230.98 129.285 230.643 129.35C230.305 129.412 229.977 129.435 229.68 129.433C229.383 129.426 229.116 129.399 228.896 129.355C228.675 129.313 228.5 129.266 228.382 129.222C228.264 129.181 228.2 129.155 228.202 129.148C228.208 129.13 228.47 129.217 228.908 129.282C229.126 129.316 229.389 129.336 229.68 129.337C229.972 129.332 230.292 129.307 230.623 129.247C230.954 129.183 231.261 129.09 231.534 128.988C231.805 128.88 232.043 128.767 232.234 128.656C232.618 128.437 232.831 128.26 232.843 128.275Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M224.826 199.37L226.966 224.643L226.241 229.036C226.241 229.036 217.478 254.206 217.664 264.628L227.915 264.139C227.915 264.139 237.92 235.64 238.704 232.489C239.488 229.339 243.526 208.286 243.526 208.286L250.175 224.937L250.36 228.82L246.53 252.976L258.438 253.596C258.438 253.596 263.31 226.178 262.829 222.621C262.348 219.063 254.484 191.261 254.484 191.261L250.423 187.719L227.258 191.626L224.826 199.37Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M257.338 246.23L256.972 256.363C256.972 256.363 266.614 260.169 266.719 262.049L248.066 261.985L248.022 246.172L257.338 246.23Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M251.206 255.491C250.845 255.594 250.595 256.021 250.678 256.406C250.761 256.791 251.171 257.064 251.533 256.968C251.896 256.872 252.212 256.369 252.088 255.995C251.965 255.623 251.467 255.33 251.136 255.515"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M248.066 261.985L248.121 260.391L265.984 261.048C265.984 261.048 266.814 261.432 266.719 262.049L248.066 261.985Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M257.275 256.263C257.272 256.359 256.816 256.402 256.367 256.709C255.911 257.004 255.679 257.419 255.595 257.381C255.511 257.362 255.648 256.788 256.198 256.426C256.744 256.059 257.295 256.175 257.275 256.263Z"
                                                        fill="white" />
                                                    <path
                                                        d="M259.229 257.124C259.249 257.217 258.855 257.379 258.544 257.785C258.223 258.18 258.144 258.62 258.053 258.615C257.968 258.63 257.906 258.067 258.301 257.571C258.691 257.071 259.227 257.032 259.229 257.124Z"
                                                        fill="white" />
                                                    <path
                                                        d="M260.335 259.597C260.252 259.617 260.126 259.137 260.361 258.612C260.593 258.085 261.023 257.878 261.061 257.958C261.112 258.038 260.836 258.319 260.649 258.753C260.452 259.183 260.426 259.589 260.335 259.597Z"
                                                        fill="white" />
                                                    <path
                                                        d="M257.115 253.944C257.076 254.032 256.659 253.898 256.144 253.933C255.628 253.957 255.227 254.138 255.18 254.055C255.127 253.985 255.519 253.631 256.127 253.599C256.733 253.562 257.16 253.869 257.115 253.944Z"
                                                        fill="white" />
                                                    <path
                                                        d="M226.921 256.894L226.993 268.53L229.703 277.717C229.898 278.38 229.492 279.069 228.818 279.219C228.441 279.303 228.049 279.201 227.762 278.942C225.938 277.291 219.257 271.185 219.299 270.333C219.348 269.346 218.409 258.064 218.409 258.064L226.921 256.894Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M228.818 279.218L219.277 269.547L219.291 270.04C219.303 270.466 219.465 270.875 219.75 271.191C220.514 272.037 222.674 274.329 227.727 278.943C228.022 279.211 228.432 279.315 228.818 279.218Z"
                                                        fill="#263238" />
                                                    <g opacity="0.6">
                                                        <path
                                                            d="M221.554 265.726C221.852 265.919 221.96 266.357 221.779 266.662C221.598 266.967 221.154 267.081 220.853 266.893C220.553 266.705 220.407 266.183 220.62 265.9C220.834 265.617 221.363 265.513 221.61 265.767"
                                                            fill="white" />
                                                    </g>
                                                    <path
                                                        d="M226.012 274.214C226.079 274.244 226.324 273.627 227.006 273.28C227.678 272.912 228.326 273.057 228.338 272.985C228.347 272.956 228.198 272.87 227.924 272.839C227.653 272.807 227.261 272.857 226.887 273.054C226.514 273.252 226.252 273.548 226.126 273.79C225.997 274.033 225.983 274.205 226.012 274.214Z"
                                                        fill="white" />
                                                    <path
                                                        d="M226.886 275.747C226.943 275.795 227.305 275.407 227.902 275.217C228.495 275.014 229.017 275.11 229.034 275.037C229.066 274.977 228.499 274.747 227.822 274.974C227.143 275.194 226.825 275.717 226.886 275.747Z"
                                                        fill="white" />
                                                    <path
                                                        d="M224.412 272.262C224.468 272.315 225.023 271.714 225.924 271.338C226.82 270.947 227.638 270.963 227.638 270.886C227.655 270.823 226.786 270.687 225.824 271.103C224.858 271.509 224.355 272.23 224.412 272.262Z"
                                                        fill="white" />
                                                    <path
                                                        d="M224.095 268.726C224.128 268.795 224.763 268.508 225.598 268.453C226.433 268.388 227.102 268.581 227.125 268.508C227.155 268.45 226.477 268.13 225.58 268.198C224.682 268.259 224.056 268.674 224.095 268.726Z"
                                                        fill="white" />
                                                    <path
                                                        d="M223.987 265.311C224.026 265.378 224.66 264.971 225.545 264.986C226.43 264.981 227.059 265.394 227.098 265.328C227.116 265.304 226.985 265.161 226.712 265.014C226.442 264.867 226.022 264.734 225.546 264.73C225.069 264.729 224.648 264.857 224.376 265.001C224.102 265.145 223.969 265.286 223.987 265.311Z"
                                                        fill="white" />
                                                    <path
                                                        d="M213.435 155.492C213.435 155.492 207.198 159.261 211.702 168.246C217.224 179.261 222.483 194.752 224.286 195.777C225.023 196.195 228.487 194.457 228.487 194.457L231.238 189.367L223.948 170.319L219.188 159.305L213.435 155.492Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M217.984 152.574L213.436 155.492L225.506 176.78L223.76 195.802L226.487 197.345L254.658 193.441L255.57 192.168L252.478 183.232L248.357 173.203C248.357 173.203 244.284 164.088 241.878 160.205C239.471 156.322 236.889 152.395 236.889 152.395L229.983 151.919L229.137 150.98C229.137 150.98 228.096 152.867 225.263 153.042C222.958 153.184 218.064 151.931 218.064 151.931L217.984 152.574Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M274.216 184.063C274.216 184.063 257.69 170.829 256.342 169.282C254.993 167.736 243.507 155.642 243.507 155.642C243.507 155.642 239.302 151.61 236.889 152.395C233.931 153.356 239.822 167.588 239.822 167.588C239.822 167.588 251.979 177.677 253.949 179.595C255.919 181.514 267.757 189.136 267.757 189.136L270.565 188.747L274.216 184.063Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M220.616 164.003C220.624 163.999 220.667 164.086 220.74 164.254C220.822 164.449 220.925 164.693 221.051 164.993C221.314 165.637 221.702 166.566 222.19 167.71C223.161 170 224.57 173.134 226.12 176.601C227.67 180.069 229.016 183.237 229.906 185.564C230.352 186.726 230.698 187.673 230.917 188.334C231.018 188.643 231.101 188.895 231.167 189.096C231.221 189.271 231.246 189.364 231.238 189.367C231.23 189.37 231.189 189.283 231.118 189.113C231.041 188.916 230.943 188.67 230.824 188.368C230.576 187.718 230.205 186.782 229.738 185.63C228.806 183.324 227.436 180.172 225.886 176.705C224.337 173.239 222.952 170.09 222.023 167.779C221.556 166.625 221.193 165.685 220.959 165.029C220.851 164.722 220.763 164.472 220.692 164.272C220.634 164.099 220.607 164.006 220.616 164.003Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M240.844 158.62C240.85 158.613 240.902 158.661 240.996 158.762C241.098 158.857 241.209 159.023 241.358 159.234C241.649 159.66 242.029 160.3 242.473 161.104C243.361 162.712 244.51 164.974 245.726 167.496C246.944 170.019 248.005 172.322 248.753 173.997C249.126 174.836 249.424 175.515 249.621 175.989C249.82 176.463 249.922 176.728 249.906 176.735C249.89 176.742 249.757 176.491 249.531 176.03C249.289 175.528 248.972 174.868 248.589 174.073C247.778 172.38 246.695 170.113 245.496 167.607C244.281 165.086 243.159 162.816 242.314 161.189C241.892 160.376 241.537 159.725 241.274 159.287C241.019 158.843 240.827 158.64 240.844 158.62Z"
                                                        fill="#263238" />
                                                    <path class="fill-theme"
                                                        d="M280.203 166.692C279.829 162.87 278.038 159.268 275.527 156.363C273.067 153.518 269.832 151.252 266.17 150.392C262.28 149.479 258.025 150.242 254.696 152.45C252.715 153.763 251.078 155.577 249.935 157.659C248.877 155.778 247.416 154.124 245.657 152.873C242.4 150.557 238.173 149.656 234.256 150.443C230.567 151.183 227.26 153.342 224.709 156.106C222.105 158.927 220.197 162.469 219.698 166.276C219.074 171.045 219.912 176.29 222.323 180.451C224.869 184.846 229.04 188.43 233.346 191.121C240.588 195.646 250.128 201.32 250.128 201.32C250.128 201.32 258.367 195.366 265.753 191.079C270.146 188.529 274.431 185.084 277.118 180.775C279.663 176.693 280.672 171.478 280.203 166.692Z"
                                                        fill="#7E3AE3" />
                                                    <path
                                                        d="M245.372 197.997L242.315 196.138C242.315 196.138 239.194 194.08 239.003 193.762C238.812 193.445 238.619 192.61 238.614 192.155C238.608 191.701 240.021 190.69 240.176 189.813C240.331 188.936 239.404 188.094 239.07 187.948C238.736 187.801 238.393 188.316 238.32 188.699C238.247 189.082 237.685 189.643 236.806 189.841C235.927 190.039 234.715 191.181 234.715 191.181L232.072 196.157C232.524 197.009 237.943 199.034 238.108 199.133C238.273 199.232 244.051 199.339 244.629 199.125C245.207 198.912 245.404 198.69 245.372 197.997Z"
                                                        fill="#FFBF9D" />
                                                    <path
                                                        d="M276.749 185.05C276.728 185.881 275.075 185.723 275.075 185.723C275.244 186.146 274.325 187.07 273.756 186.818C273.889 187.12 274.04 187.228 273.993 187.555C273.946 187.881 273.759 188.197 273.464 188.346C273.17 188.494 272.771 188.441 272.564 188.185C272.655 188.685 272.399 189.229 271.956 189.478C271.689 189.627 271.367 189.663 271.07 189.594C270.921 189.559 270.782 189.498 270.654 189.414C270.609 189.384 270.55 189.353 270.517 189.308C270.501 189.285 270.493 189.261 270.487 189.234C270.457 189.114 270.448 188.992 270.41 188.873C270.396 188.828 270.379 188.784 270.362 188.74C270.281 188.541 270.168 188.357 270.036 188.188C269.975 188.111 269.892 188.04 269.843 187.954C269.81 187.896 269.808 187.828 269.786 187.766C269.646 187.372 269.312 187.058 269.029 186.764C268.71 186.433 268.387 186.068 268.302 185.616C268.217 185.164 268.475 184.616 268.932 184.557C268.696 184.383 268.664 184.013 268.825 183.769C268.986 183.524 269.294 183.404 269.587 183.415C269.879 183.427 270.156 183.554 270.4 183.715C270.155 183.474 270.209 183.029 270.46 182.795C270.712 182.561 271.099 182.519 271.43 182.613C271.76 182.708 272.044 182.92 272.302 183.147C272.561 183.373 273.645 184.308 273.934 184.494L274.684 183.87L274.781 183.79C275.364 184.026 275.549 184.068 276.05 184.308C276.425 184.488 276.758 184.705 276.749 185.05Z"
                                                        fill="#FFBF9D" />
                                                    <path
                                                        d="M269.948 190.412C269.745 190.61 269.476 190.773 269.194 190.743C268.86 190.708 268.158 190.019 267.952 189.753C267.944 189.746 269.025 188.984 269.025 188.984C269.073 188.767 268.781 188.62 268.694 188.415C268.544 188.06 268.771 187.615 269.129 187.472C269.487 187.329 269.917 187.458 270.189 187.731C270.461 188.005 270.588 188.398 270.602 188.783C270.624 189.385 270.38 189.992 269.948 190.412Z"
                                                        fill="#FFBF9D" />
                                                    <path
                                                        d="M272.645 188.266C272.697 188.214 271.908 187.342 270.883 186.318C269.858 185.294 268.985 184.507 268.933 184.559C268.88 184.611 269.669 185.483 270.694 186.507C271.719 187.531 272.592 188.318 272.645 188.266Z"
                                                        fill="#FF9A6C" />
                                                    <path
                                                        d="M273.817 186.87C273.871 186.825 273.225 185.967 272.256 185.068C271.29 184.166 270.388 183.581 270.348 183.639C270.302 183.701 271.122 184.373 272.075 185.263C273.03 186.15 273.759 186.92 273.817 186.87Z"
                                                        fill="#FF9A6C" />
                                                    <path
                                                        d="M274.964 185.507C275.02 185.457 274.446 184.776 273.62 184.068C272.796 183.361 272.096 182.835 272.049 182.887C271.997 182.944 272.625 183.566 273.445 184.27C274.264 184.971 274.911 185.557 274.964 185.507Z"
                                                        fill="#FF9A6C" />
                                                    <path
                                                        d="M270.245 189.895C270.265 189.92 270.435 189.824 270.553 189.549C270.675 189.283 270.692 188.844 270.522 188.438C270.348 188.031 270.142 187.732 269.93 187.515C269.688 187.295 269.449 187.383 269.473 187.418C269.478 187.454 269.648 187.452 269.794 187.646C269.928 187.842 270.127 188.182 270.274 188.535C270.423 188.897 270.432 189.246 270.374 189.49C270.319 189.735 270.215 189.868 270.245 189.895Z"
                                                        fill="#FF9A6C" />
                                                    <path
                                                        d="M80.7852 141.66C81.0523 141.596 88.1691 145.138 87.7245 145.147C87.2794 145.155 81.4124 149.959 81.4124 149.959L80.7852 141.66Z"
                                                        fill="#7E3AE3" />
                                                    <path
                                                        d="M82.0695 249.34L82.896 257.951C82.896 257.951 73.5104 261.457 73.4087 263.192L91.1529 263.24L91.143 261.942L90.3989 257.512L89.3021 248.908L82.0695 249.34Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M88.2374 256.615C88.5891 256.71 88.8327 257.105 88.7524 257.46C88.6715 257.816 88.2723 258.067 87.9191 257.978C87.5658 257.889 87.2585 257.424 87.3785 257.08C87.4985 256.736 87.9833 256.467 88.3047 256.638"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M91.1525 263.24L91.1426 261.943L74.1232 262.269C74.1232 262.269 73.3154 262.623 73.4083 263.192L91.1525 263.24Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M82.6016 257.859C82.6047 257.948 83.0482 257.987 83.485 258.271C83.9296 258.543 84.1555 258.927 84.2369 258.892C84.3188 258.875 84.1852 258.345 83.6499 258.01C83.1182 257.671 82.5823 257.778 82.6016 257.859Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M80.699 258.652C80.6787 258.738 81.0632 258.888 81.3653 259.262C81.6784 259.627 81.7557 260.033 81.8438 260.028C81.9273 260.042 81.9873 259.523 81.6028 259.065C81.2224 258.603 80.7006 258.567 80.699 258.652Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M79.6223 260.934C79.7027 260.953 79.8253 260.51 79.5962 260.025C79.3703 259.538 78.9518 259.348 78.9148 259.422C78.8647 259.495 79.135 259.755 79.3166 260.156C79.5081 260.552 79.5347 260.926 79.6223 260.934Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M81.9719 255.789C82.0095 255.87 82.416 255.746 82.9169 255.779C83.4189 255.801 83.8092 255.969 83.8551 255.893C83.9062 255.829 83.5248 255.501 82.9336 255.471C82.3434 255.436 81.9281 255.72 81.9719 255.789Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M103.875 249.584L104.635 258.048C104.635 258.048 95.3933 261.436 95.2827 263.139L112.714 263.294L112.712 262.019L112.008 257.662L110.982 249.203L103.875 249.584Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M109.89 256.768C110.235 256.863 110.472 257.252 110.391 257.601C110.309 257.95 109.916 258.194 109.57 258.105C109.223 258.015 108.924 257.557 109.044 257.22C109.164 256.882 109.642 256.621 109.957 256.791"
                                                        fill="#E0E0E0" />
                                                    <path
                                                        d="M112.714 263.294L112.712 262.019L95.9897 262.237C95.9897 262.237 95.1945 262.58 95.2821 263.139L112.714 263.294Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M104.346 257.957C104.349 258.044 104.784 258.085 105.211 258.366C105.647 258.636 105.866 259.015 105.947 258.98C106.027 258.964 105.899 258.442 105.375 258.11C104.854 257.774 104.327 257.876 104.346 257.957Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M102.472 258.723C102.452 258.808 102.828 258.957 103.123 259.327C103.428 259.688 103.502 260.086 103.589 260.083C103.671 260.097 103.733 259.586 103.357 259.134C102.986 258.679 102.474 258.64 102.472 258.723Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M101.401 260.959C101.481 260.978 101.603 260.543 101.381 260.065C101.163 259.585 100.753 259.396 100.716 259.468C100.666 259.54 100.93 259.796 101.106 260.192C101.291 260.583 101.315 260.95 101.401 260.959Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M103.74 255.918C103.776 255.998 104.176 255.879 104.669 255.914C105.162 255.939 105.544 256.106 105.59 256.031C105.64 255.969 105.267 255.645 104.687 255.611C104.107 255.574 103.698 255.85 103.74 255.918Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M81.6856 174.455C81.6856 174.455 77.4799 186.636 77.3349 195.697C77.1898 204.759 77.0448 219.168 78.93 235.062C80.8153 250.957 81.6856 257.345 81.6856 257.345H91.2574C91.2574 257.345 92.2729 247.392 92.1278 238.479C91.9827 229.566 91.2861 226.744 92.1419 216.94C92.9976 207.136 94.3522 201.247 95.7783 198.276C95.7783 198.276 99.7293 193.58 100.019 187.137C100.31 180.694 98.0293 175.157 98.0293 175.157L81.6856 174.455Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M90.1914 191.544C90.3506 192.033 93.1912 212.004 95.2633 220.812C97.3353 229.621 99.6406 231.952 100.045 239.117C100.51 247.358 102.773 257.345 102.773 257.345H112.965C112.965 257.345 111.532 242.111 110.098 230.203C108.665 218.295 106.595 203.615 106.913 199.211C107.232 194.807 108.028 189.368 106.913 183.197C105.798 177.026 103.389 175.4 103.389 175.4L94.7415 175.008L90.1914 191.544Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M99.7851 180.122C99.7919 180.118 99.8456 180.224 99.9432 180.432C100.054 180.634 100.157 180.954 100.289 181.369C100.525 182.207 100.681 183.468 100.625 185.019C100.576 186.57 100.317 188.411 99.7872 190.393C99.5174 191.383 99.1657 192.408 98.6747 193.417C98.1858 194.428 97.508 195.379 96.8333 196.339C95.448 198.247 94.7639 200.421 94.2457 202.384C93.7417 204.359 93.4714 206.181 93.2783 207.712C93.09 209.245 92.9772 210.491 92.8927 211.351C92.851 211.766 92.8176 212.096 92.7931 212.342C92.768 212.568 92.7518 212.686 92.7445 212.686C92.7372 212.685 92.7393 212.566 92.7503 212.338C92.7649 212.092 92.7847 211.761 92.8098 211.344C92.8687 210.481 92.959 209.233 93.128 207.694C93.3029 206.157 93.558 204.326 94.0548 202.335C94.3037 201.341 94.6157 200.307 95.019 199.265C95.2251 198.744 95.4579 198.222 95.7302 197.711C96.0052 197.202 96.3209 196.705 96.657 196.218C97.3374 195.25 98.0032 194.318 98.4869 193.324C98.9727 192.332 99.3244 191.321 99.5968 190.341C100.133 188.377 100.406 186.55 100.473 185.012C100.548 183.474 100.416 182.224 100.208 181.389C100.089 180.976 99.9996 180.653 99.903 180.448C99.8196 180.238 99.7789 180.125 99.7851 180.122Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M108.539 117.28C108.539 117.28 107.907 117.078 106.336 116.727C104.764 116.376 102.945 114.62 99.818 114.646C97.7047 114.662 95.508 115.352 93.9875 116.803C92.3621 118.355 91.8674 120.709 91.5648 122.923C91.3393 124.574 91.1635 126.276 90.3907 127.756C89.7129 129.053 88.6244 130.085 87.6821 131.21C86.7397 132.335 85.9027 133.664 85.896 135.124C85.8918 136.118 86.2534 137.211 85.7076 138.046C85.3507 138.592 84.7877 139.449 84.3092 139.894C83.8307 140.339 83.719 141.809 83.8636 142.983C83.9173 143.419 83.108 147.072 88.8363 148.976C94.5651 150.88 108.539 117.28 108.539 117.28Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M109.287 122.605L109.56 121.071L100.599 117.856C97.7978 117.105 94.2668 119.474 93.6359 122.304C92.9346 125.448 92.202 129.315 92.2041 131.744C92.2088 136.629 95.7654 137.812 95.7654 137.812L95.0385 142.545L105.556 144.341L109.287 122.605Z"
                                                        fill="#AE7461" />
                                                    <path
                                                        d="M94.9529 126.805C94.8908 127.126 95.111 127.443 95.4449 127.515C95.7783 127.586 96.0992 127.384 96.1619 127.063C96.224 126.742 96.0043 126.425 95.6709 126.354C95.3369 126.282 95.0155 126.484 94.9529 126.805Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M94.324 124.488C94.3872 124.579 94.9043 124.31 95.5617 124.415C96.2197 124.511 96.6492 124.925 96.7332 124.856C96.7739 124.826 96.7196 124.67 96.5333 124.484C96.3502 124.299 96.0209 124.095 95.6108 124.032C95.2012 123.969 94.8323 124.066 94.61 124.189C94.383 124.312 94.2922 124.446 94.324 124.488Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M100.999 127.624C100.937 127.945 101.157 128.262 101.491 128.334C101.825 128.405 102.146 128.204 102.208 127.883C102.271 127.562 102.05 127.244 101.717 127.173C101.383 127.101 101.061 127.303 100.999 127.624Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M100.769 125.63C100.832 125.722 101.35 125.453 102.007 125.558C102.664 125.654 103.094 126.068 103.178 125.999C103.218 125.969 103.165 125.813 102.978 125.627C102.795 125.442 102.466 125.238 102.056 125.175C101.646 125.112 101.278 125.209 101.055 125.332C100.829 125.456 100.737 125.589 100.769 125.63Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M97.612 130.13C97.6209 130.093 97.2233 129.959 96.5742 129.769C96.4088 129.725 96.2554 129.667 96.2449 129.548C96.2246 129.42 96.3232 129.251 96.4359 129.068C96.6577 128.687 96.8904 128.287 97.1346 127.868C98.1114 126.156 98.8471 124.738 98.7777 124.7C98.7083 124.661 97.8604 126.017 96.8831 127.729C96.6462 128.151 96.4197 128.554 96.2042 128.94C96.1103 129.121 95.9668 129.32 96.0127 129.585C96.0383 129.718 96.1468 129.828 96.2502 129.874C96.3524 129.924 96.4469 129.94 96.5288 129.959C97.191 130.1 97.6037 130.167 97.612 130.13Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M95.7653 137.825C95.7653 137.825 99.1027 138.554 102.58 137.146C102.58 137.146 100.444 140.228 95.5806 139.014L95.7653 137.825Z"
                                                        fill="#6F4439" />
                                                    <path
                                                        d="M101.142 123.362C101.19 123.549 101.86 123.527 102.628 123.696C103.4 123.85 104.004 124.138 104.123 123.986C104.177 123.913 104.084 123.734 103.847 123.534C103.613 123.336 103.228 123.132 102.766 123.035C102.304 122.939 101.87 122.971 101.575 123.059C101.279 123.146 101.122 123.274 101.142 123.362Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M94.6422 122.865C94.733 123.033 95.211 122.954 95.7563 123.038C96.3042 123.102 96.744 123.306 96.8766 123.167C96.9355 123.099 96.8881 122.938 96.7101 122.763C96.5353 122.589 96.2228 122.418 95.8471 122.368C95.4714 122.317 95.1249 122.398 94.9099 122.52C94.6923 122.641 94.6031 122.784 94.6422 122.865Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M97.9359 131.781C98.1848 131.482 98.6033 131.331 99.0093 131.394C99.2905 131.438 99.5702 131.587 99.7314 131.826C99.8927 132.064 99.9135 132.393 99.7471 132.605C99.5598 132.844 99.1893 132.884 98.8825 132.781C98.5751 132.679 98.3174 132.462 98.0721 132.246C98.0043 132.186 97.9354 132.124 97.8947 132.044C97.8545 131.965 97.8498 131.863 97.9067 131.802"
                                                        fill="#6F4439" />
                                                    <path
                                                        d="M99.6304 130.738C99.5245 130.727 99.4905 131.434 98.8613 131.908C98.2335 132.384 97.4827 132.269 97.4728 132.368C97.4607 132.412 97.6345 132.513 97.9523 132.537C98.2638 132.562 98.7245 132.483 99.1096 132.193C99.4931 131.902 99.6716 131.498 99.7092 131.209C99.7499 130.915 99.6789 130.736 99.6304 130.738Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M107.797 118.155C107.511 117.695 105.126 116.371 104.596 116.224C104.596 116.224 102.608 114.78 99.2861 114.999C92.4709 115.449 93.2239 121.98 93.2239 121.98L97.4196 122.21C98.2055 122.591 100.688 122.282 101.494 121.944C102.301 121.606 102.941 120.909 103.199 120.09C102.997 120.86 104.621 123.833 105.058 124.502C106.026 125.984 106.496 125.676 107.464 127.158C107.839 124.806 108.539 122.112 107.92 119.691C107.789 119.182 108.076 118.604 107.797 118.155Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M50 102.135L81.625 94.8669L83.7628 104.168L73.0655 106.627L85.8923 162.436L75.6609 164.788L62.8341 108.978L52.1378 111.437L50 102.135Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M73.559 137.412C73.559 137.412 73.605 137.087 73.6775 136.569L73.738 136.554L73.7015 136.396C73.9499 134.615 74.4461 130.99 74.5583 129.685C74.599 129.21 74.7498 128.367 74.9115 127.951C75.3352 126.862 74.3866 126.752 73.7338 127.371C73.5491 127.545 73.1818 128.332 73.0811 128.665C72.7732 129.68 72.2806 130.207 72.2806 130.207C72.2806 130.207 66.1709 126.389 65.6679 127.025C65.1649 127.66 65.7691 129.103 65.7691 129.103C65.7691 129.103 65.0094 130.179 65.2458 131.216C65.4822 132.253 66.2195 132.859 66.2195 132.859C66.2195 132.859 65.814 134.21 66.1835 134.804C66.4506 135.233 69.0236 138.065 69.763 138.77L73.559 137.412Z"
                                                        fill="#AE7461" />
                                                    <path class="fill-theme"
                                                        d="M73.8586 137.026C73.8508 137.195 78.6555 149.366 78.6555 149.366C78.6555 149.366 85.263 145.375 88.0009 143.621C90.7387 141.868 94.6178 139.918 97.1793 140.259C99.7408 140.6 102.418 143.365 102.418 143.365L94.9752 150.308L86.9547 155.5C86.9547 155.5 78.5475 160.437 75.4303 160.497C72.3131 160.558 71.3347 157.536 70.648 155.897C69.9613 154.257 67.8267 138.721 67.8267 138.721L73.8586 137.026Z"
                                                        fill="#7E3AE3" />
                                                    <path class="fill-theme"
                                                        d="M109.376 142.256L93.3832 141.659C93.3832 141.659 84.604 146.821 84.2491 155.951C83.8808 165.444 81.4116 174.619 81.4116 174.619L97.5174 176.603C99.1944 176.81 100.892 176.786 102.562 176.534L104.24 176.28L102.642 170.235C104.395 164.228 105.968 161.49 107.84 155.879C110.708 147.283 109.376 142.256 109.376 142.256Z"
                                                        fill="#7E3AE3" />
                                                    <path
                                                        d="M102.596 170.852C102.602 170.877 102.19 171.017 101.502 171.166C100.815 171.316 99.8502 171.462 98.7758 171.505C97.7009 171.545 96.7272 171.474 96.0306 171.377C95.3335 171.281 94.9114 171.173 94.9161 171.148C94.9213 171.116 95.3512 171.171 96.0468 171.228C96.7418 171.286 97.7051 171.332 98.7674 171.292C99.8298 171.25 100.786 171.13 101.475 171.019C102.164 170.909 102.588 170.821 102.596 170.852Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M94.0611 151.89C94.0794 151.922 93.5461 152.271 92.6601 152.797C91.7746 153.322 90.5338 154.019 89.1411 154.747C87.7474 155.475 86.4664 156.095 85.5292 156.521C84.5921 156.948 84.0004 157.185 83.9847 157.152C83.9685 157.117 84.531 156.818 85.4452 156.348C86.4309 155.84 87.6582 155.207 89.0154 154.506C90.3652 153.793 91.5857 153.148 92.5662 152.629C93.4751 152.147 94.0418 151.857 94.0611 151.89Z"
                                                        fill="black" />
                                                    <path
                                                        d="M102.219 153.272C101.521 152.076 103.45 147.405 102.58 144.559C101.71 141.713 101.581 140.996 102.639 137.969C103.698 134.942 105.65 134.396 106.028 130.738C106.406 127.079 106.395 126.789 107.219 124.013C108.043 121.236 105.051 116.411 105.051 116.411C108.094 116.211 111.628 118.453 112.573 121.353C113.161 123.157 113.047 126.486 113.412 128.348C114.01 131.392 116.788 132.637 116.333 135.706C116.03 137.752 114.627 139.624 114.842 141.681C114.933 142.547 114.571 144.433 114.574 145.304C114.591 150.403 112.061 151.004 112.011 151.873C112.011 151.873 112.111 153.278 113.514 153.273C114.918 153.266 106.81 161.137 102.219 153.272Z"
                                                        fill="#263238" />
                                                    <path
                                                        d="M105.066 134.672L97.2148 140.299C101.348 140.92 103.022 145.146 103.022 145.146C103.022 145.146 108.344 132.507 105.066 134.672Z"
                                                        fill="#263238" />
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
                                <p id="<?php echo e($stringid . '_branding'); ?>_preview">
                                    <?php echo e($business->branding_text); ?></p>
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

<?php echo $__env->make('card.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/card/theme1/index.blade.php ENDPATH**/ ?>