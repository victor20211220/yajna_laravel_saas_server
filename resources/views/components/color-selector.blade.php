@props([
    'id',              // the HTML id & name of the input field (e.g., 'card_bg_color')
    'label',           // label to display above
    'tooltip_title' => '',           // label to display above
    'value' => '#ffffff', // initial value
    'colors' => [],    // array of hex colors like ['#000000', '#FF0000']
    'class' => '',
])
<div class="form-group">
    <div class="color-group mb-4" data-input-id="{{ $id }}">
        <div class="position-relative mb-3">
            <label class="mb-0 {{ $class }}">{{ __($label) }}</label>
            @if($tooltip_title)
                @include('components/more-info', ['label' => $tooltip_title])
            @endif
        </div>
        <div class="d-flex flex-wrap gap-3 align-items-center">
            @foreach ($colors as $color)
                <div class="color-swatch"
                     data-color="{{ strtolower($color) }}"
                     style="background-color: {{ $color }};"
                ></div>
            @endforeach

            <!-- Color picker input -->
            <div class="color-picker-swatch d-flex align-items-center justify-content-center position-relative">
                {!! svg('user_interface/color_picker.svg', ['class' => 'color-picker-icon']) !!}
                <input
                    type="color"
                    name="{{ $id }}"
                    id="{{ $id }}"
                    value="{{ $value }}"
                    class="color-input position-absolute opacity-0 pointer-events-none"
                />
                <div class="color-picker-trigger" data-input-id="{{ $id }}"></div>
            </div>
        </div>
    </div>
</div>
