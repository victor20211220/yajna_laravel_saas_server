
<div class="card p-3">
    <div class="row">
        <div class="col-12">
            <div class="form-group col-md-12">
                <?php echo e(Form::label('whatsapp',__('Whatsapp Number'))); ?>

                <?php echo e(Form::text('whatsapp',null,array('class'=>'form-control','placeholder'=>__('Enter Your Whatsapp Number')))); ?>

                <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-name" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="col-12">
                    <span id="whatsappMessage" class=" text-danger"></div>
                </div>
            </div>
        </div>

        <small class="text-muted"><?php echo e(__('Note : Enter your WhatsApp number along with your country code (without the ‘+’ symbol). For instance, if your country code is +91 and your WhatsApp number is 7878787878, just type 917878787878.')); ?></small>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <button type="button" class="btn btn-primary" id="shareWhatsapp"><?php echo e(__('Share')); ?></button>
</div>

<script>
    document.getElementById('shareWhatsapp').addEventListener('click', function() {
        var whatsappNumber = document.getElementById('whatsapp').value;
        if (whatsappNumber.trim() === '') {
            document.getElementById('whatsappMessage').innerText = '*Please enter a WhatsApp number.';
            return;
        }
        var slug = '<?php echo e($business->slug); ?>';
        var url_link = `<?php echo e(route('get.vcard', ['slug' => '__SLUG__'])); ?>`.replace('__SLUG__', slug);
        var text = encodeURIComponent(url_link);
        var url = 'https://api.whatsapp.com/send?phone=' + whatsappNumber + '&text=' + text;
        window.open(url, '_blank');
    });
</script>

<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/business/whatsappShare.blade.php ENDPATH**/ ?>