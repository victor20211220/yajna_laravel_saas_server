{{Form::open(array('route' => ['pixel.update', $PixelField->id],'method'=>'put','class' => 'needs-validation', 'novalidate'))}}
<div class="modal-body pt-0">
    <div class="row">
        <div class="col-12">
            <div class="form-group col-md-12">
                {{ Form::label('platform', __('Platform'),['class'=>'form-label']) }}<x-required></x-required>
                {!! Form::select('platform', $pixals_platforms, $PixelField->platform,array('class' => 'form-control select2','required'=>'required')) !!}
                @error('platform')
                <small class="invalid-role" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group col-md-12">
                {{Form::label('pixel_id',__('Pixel ID'))}}<x-required></x-required>
                {{Form::text('pixel_id',$PixelField->pixel_id,array('class'=>'form-control','placeholder'=>__('Enter Pixel ID'),'required'=>'required'))}}
                @error('pixel_id')
                <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
        <input type="hidden" name="business_id" value="{{ $business_id }}">
    </div>
</div>

<div class="modal-footer pb-0">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
</div>
{{Form::close()}}

<script src="{{ asset('custom/js/custom.js') }}"></script>
