<?php
$card_theme = json_decode($business->card_theme);
?>

<div class=" row">
    
    <iframe src="<?php echo e(route('get.vcard',[$business->slug])); ?>" width="100%" height="600" frameborder="0"></iframe>
</div>

<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/Modules/LandingPage/Resources/views/marketplace/view_business.blade.php ENDPATH**/ ?>