<link rel="stylesheet" href="<?php echo e(asset('custom/css/emojionearea.min.css')); ?>">
<?php
    $chatgpt_setting = \App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());

?>
<?php echo e(Form::open(['route' => ['contact.note.store', $contact->id],'class' => 'needs-validation', 'novalidate'])); ?>

<?php if($chatgpt_setting['enable_chatgpt'] == 'on'): ?>
    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
        data-bs-placement="top">
        <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
            data-url="<?php echo e(route('generate', ['Add Note on contact'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

        </a>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12 form-group mt-4">
        <div class="row gutters-xs">
            <div class="col-12">
                <h6 class=""><?php echo e(__('Status')); ?></h6>
            </div>
            <div class="col-6 ">
                <div class="form-check ">
                    <input type="radio" id="pending" class="form-check-input mt-1" name="status" value="pending"
                        <?php if($contact->status == 'pending'): ?> checked <?php endif; ?>>
                    <?php echo e(Form::label('pending', 'Pending', ['class' => 'custom-control-label ml-4 badge bg-warning p-2 px-3 rounded'])); ?>

                </div>

            </div>
            <div class="col-6 ">
                <div class=" form-check  ">
                    <input type="radio" id="completed" class="form-check-input mt-1" name="status" value="completed"
                        <?php if($contact->status == 'completed'): ?> checked <?php endif; ?>>
                    <?php echo e(Form::label('completed', 'Completed', ['class' => 'custom-control-label ml-4  badge bg-success p-2 px-3 rounded'])); ?>

                </div>

            </div>
        </div>
    </div>
    <div class="col-12 form-group mt-4">
        <div class="row gutters-xs">
            <div class="col-12">
                <h6 class="ml-2"><?php echo e(__('Add Note')); ?></h6>
            </div>
            <div class="col-12">
                <textarea class="summernote" row="10" cols="50" id="note" name="note" placeholder="<?php echo e(__('Enter your notes here...')); ?>"><?php echo $contact->note; ?></textarea>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Save')); ?>">
</div>
<?php echo e(Form::close()); ?>

<script src="<?php echo e(asset('custom/js/emojionearea.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#emojiarea").emojioneArea();
    });
</script>
<script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                ['list', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'unlink']],
            ],
            height: 250,
        });
    });
</script>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/contacts/add_note.blade.php ENDPATH**/ ?>