<div class="position-relative copy-card-link-container">
    {{ Form::text('copy_card_link', route('get.vcard',[$business->slug]), [
        'class' => 'form-control pe-5',
        'readonly' => true
    ]) }}
    <span class="position-absolute top-50 translate-middle-y"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          title="Copy">
          {!! svg('user_interface/copy_to_clipboard.svg') !!}
    </span>
</div>
<style>
    .copy-card-link-container span {
        z-index: 5; /* ensures it's above input */
        color: #000; /* or any icon color you like */
        right: 20px;
        cursor: pointer;

        svg {
            width: 17px;
            height: 17px;
        }
    }
</style>
