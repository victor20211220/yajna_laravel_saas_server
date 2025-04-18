<?php
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
?>
<?php echo e(Form::open(['url' => route('nfc.order.store', $nfcCard->id), 'enctype' => 'multipart/form-data'])); ?>

<div class="row row-gap">
    <div class="col-12 form-group mb-0">
        <?php echo e(Form::label('business', __('Business'), ['class' => 'form-label'])); ?>

        <?php echo Form::select('business', $businessList, null, ['class' => 'form-control select2 businessList', 'required' => 'required']); ?>

        <?php $__errorArgs = ['platform'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-role" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="col-sm-6 col-12 form-group mb-0">
        <div class="row">
            <?php echo e(Form::label('Quantity', __('Quantity'), ['class' => 'form-label'])); ?>

            <div class="nfc-order-counter">
                <input id="minus" type="button" value="-" class="btn btn-sm btn-primary">
                <input id="quantity" type="text" value="1" min="1" name="quantity"
                    class="btn btn-sm btn-primary">
                <input id="plus" type="button" value="+" class="btn btn-sm btn-primary">

            </div>
        </div>
    </div>


    <div class="col-sm-6 col-12 form-group mb-0">
        <div class="row nfc-card-price">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?>

            <div class="price-best-price">
                <strong
                    id="skuBestPrice"><?php echo e(!empty($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?><?php echo e($nfcCard->price); ?></strong>
                    <span class="small"> <?php echo e(__('(Default price for 1 quantity)')); ?></span>
            </div>
            <span id="total-price"><?php echo e(!empty($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?> 0,00</span>
            <input id="total-price-hidden" type="hidden" value="<?php echo e($nfcCard->price); ?>" name="totalprice">

        </div>

        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Order')); ?>">
</div>
<?php echo e(Form::close()); ?>


<script>
    $('#plus').click(function add() {
        var $qtde = $("#quantity");
        var a = $qtde.val();

        a++;
        $("#minus").attr("disabled", !a);
        $qtde.val(a);
    });
    $("#minus").attr("disabled", !$("#quantity").val());

    $('#minus').click(function minusButton() {
        var $qtde = $("#quantity");
        var b = $qtde.val();
        if (b > 1) {
            b--;
            $qtde.val(b);
        } else {
            $("#minus").attr("disabled", true);
        }
    });

    /* On change */
    $(document).ready(function() {
        function updatePrice() {
            var priceProduct = '<?php echo e($nfcCard->price); ?>';
            var price = parseFloat($("#quantity").val());
            var total = ((priceProduct) * (price)).toFixed(2);
            var currency='<?php echo e(!empty($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?>';

            $("#total-price").text(currency+total);
            $("#total-price-hidden").val(total);
        }
        // On the click/keyup/change
        $(document).ready(function() {
            updatePrice();
        });
        //$(document).on("load", "input", updatePrice);
        $(document).on("click", "input", updatePrice);
        $(document).on("keyup", "input", updatePrice);
        $(document).on("change", "input", updatePrice);

        $('#quantity').on('change keyup focus', function() {
            var removeLetters = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(removeLetters);
        });

    });
</script>

<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/nfc/addtocart.blade.php ENDPATH**/ ?>