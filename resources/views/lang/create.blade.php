{{ Form::open(array('route' => array('store.language'),'class' => 'needs-validation', 'novalidate')) }}
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('code', __('Language Code'), array('class' => 'form-label')) }}<x-required></x-required>
        {{ Form::text('code', '', array('class' => 'form-control','required'=>'required','placeholder'=>__('Enter Language Code'))) }}
        @error('code')
        <span class="invalid-code" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('fullName', __('Language Name'), array('class' => 'form-label')) }}<x-required></x-required>
        {{ Form::text('fullName', '', array('class' => 'form-control','required'=>'required','placeholder'=>__('Enter Language Name'))) }}
        @error('fullName')
        <span class="invalid-code" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
    <div class="modal-footer p-0 pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        <input class="btn btn-primary" type="submit" value="{{ __('Create') }}">
    </div>
{{ Form::close() }}
