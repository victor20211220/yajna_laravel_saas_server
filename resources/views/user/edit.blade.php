{{Form::model($user,array('route' => array('users.update', $user->id), 'method' => 'PUT','class' => 'needs-validation', 'novalidate')) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group ">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}<x-required></x-required>
            {{Form::text('name',null,array('class'=>'form-control font-style','placeholder' => __('Enter ' . (Auth::user()->type === 'super admin' ? 'Company' : 'User') . ' Name'),'required'=>'required'))}}
            @error('name')
            <small class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('email',__('Email'),['class'=>'form-label'])}}<x-required></x-required>
            {{Form::text('email',null,array('class'=>'form-control','placeholder' => __('Enter ' . (Auth::user()->type === 'super admin' ? 'Company' : 'User') . ' Email'),'required'=>'required'))}}
            @error('email')
            <small class="invalid-email" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    @if(\Auth::user()->type != 'super admin')
        <div class="form-group col-md-12">
            {{ Form::label('role', __('User Role'),['class'=>'form-label']) }}<x-required></x-required>
            {!! Form::select('role', $roles, null,array('class' => 'form-control select2','required'=>'required')) !!}
            @error('role')
            <small class="invalid-role" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
    @endif
</div>
 <div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Update') }}">
</div>
{{Form::close()}}
