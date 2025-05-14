@props([
    'label',           // label to display above
])
<span class="position-absolute top-50 translate-middle-y more-info-icon ms-2 cursor-pointer d-inline-flex"
      data-bs-toggle="tooltip"
      data-bs-placement="top"
      title="{{ $label }}">
    {!! svg('user_interface/more_info.svg') !!}
</span>
