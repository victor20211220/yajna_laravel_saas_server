{{Form::open(array('url'=>'users','method'=>'post','class' => 'needs-validation', 'novalidate'))}}
<div class="form-group">
    {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
    <x-required></x-required>
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter ' . (Auth::user()->type === 'super admin' ? 'Company' : 'User') . ' Name'), 'required' => 'required']) }}
    @error('name')
    <small class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </small>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('Business', __('Business'), ['class' => 'form-control-label']) }}
    <x-required></x-required>
    {{ Form::text('business_title', null, ['class' => 'form-control mt-2','required'=>'required','placeholder' => __('Enter Business Title')]) }}
    @error('business_title')
    <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
    @enderror
</div>

{{ Form::hidden('theme', 'theme1', ['id' => 'themefile1']) }}

<div class="form-group">
    {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
    <x-required></x-required>
    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter ' . (Auth::user()->type === 'super admin' ? 'Company' : 'User') . ' Email'), 'required' => 'required']) }}
    @error('email')
    <small class="invalid-email" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </small>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('password', __('Password'), ['class' => 'form-label']) }}
    <x-required></x-required>
    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter ' . (Auth::user()->type === 'super admin' ? 'Company' : 'User') . ' Password'), 'minlength' => '6','autocomplete'=>"off",'id'=>'passwordInput', 'required' => 'required']) }}
    @error('password')
    <small class="invalid-password" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </small>
    @enderror
</div>


@if(\Auth::user()->type != 'super admin')
    <div class="form-group col-md-6">
        {{ Form::label('role', __('User Role'),['class'=>'form-label']) }}
        <x-required></x-required>
        {!! Form::select('role', $roles, null,array('class' => 'form-control select2','required'=>'required')) !!}
        @error('role')
        <small class="invalid-role" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </small>
        @enderror
    </div>
@endif
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Create') }}">
</div>
{{Form::close()}}
<script>
    /*
    $(document).ready(function(){
        // Initially hide the password field
        $('#password').hide();

        // Check the status of the checkbox when it's clicked
        $('#is_login').click(function(){
            if($(this).is(':checked')){
                // If checkbox is checked, show the password field
                $('#password').show();
                $('#passwordInput').prop('required', true);
            } else {
                // If checkbox is unchecked, hide the password field
                $('#password').hide();
                $('#passwordInput').prop('required', false);
            }
        });
    });

     */
</script>
