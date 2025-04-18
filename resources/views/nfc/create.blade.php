
{{ Form::open(['url' => route('nfc.store'),'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate']) }}
<div class="row">

    <div class="col-sm-6 col-12 form-group">
        {{ Form::label('NFC Card Name', __('NFC Card Name'), ['class' => 'form-control-label']) }}<x-required></x-required>
        {{ Form::text('nfc_card_name', null, ['class' => 'form-control mt-2','required' => 'required','placeholder' => __('Enter NFC Card Name')]) }}
        @error('nfc_card_name')
            <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-sm-6 col-12 form-group">
        {{ Form::label('price', __('Price'), ['class' => 'form-label']) }}<x-required></x-required>
        {{ Form::number('price', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Price'), 'min' => '1', 'step' => '0.01']) }}
        @error('price')
            <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-12 form-group img-validate-class">
        {{ Form::label('card_images', __('Card Image'), ['class' => 'form-label']) }}
        <div class="choose-files">
            <label for="avatar">
                <div class=" bg-primary company_logo_update" style="cursor: pointer;"> <i
                        class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                <input type="file" class="form-control file d-none file-validate" id="avatar" name="nfc_image"
                    data-filename="profiles"
                    onchange="document.getElementById('nfc_image').src = window.URL.createObjectURL(this.files[0])">
            </label>

        </div>
        <p class="file-error text-danger" style=""></p>
        <div class="mt-2">
            <img src="{{asset('custom/img/placeholder-image21.jpg')}}" id="nfc_image" class="rounded border-2 border border-primary" style="max-width: 300px; width: 100%; height: 200px;"/>
        </div>
        {{-- <span class="profiles"></span> --}}
    </div>


</div>
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Create') }}">
</div>
{{ Form::close() }}
