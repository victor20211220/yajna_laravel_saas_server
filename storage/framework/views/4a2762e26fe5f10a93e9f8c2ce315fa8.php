<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('card.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="tech-card-body theme-preview-body">
    <?php echo $__env->yieldContent('contentCard'); ?>
</body>

<?php echo $__env->make('card.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html>

<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/card/layouts.blade.php ENDPATH**/ ?>