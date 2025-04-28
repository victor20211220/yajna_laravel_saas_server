{{Form::model(null, array('route' => array('testimonials_update', $key), 'method' => 'POST','enctype' => "multipart/form-data",'class' => 'needs-validation', 'novalidate')) }}

    <div class="modal-body p-0">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Title', __('Title'), ['class' => 'form-label']) }}<x-required></x-required>
                    {{ Form::text('testimonials_title',$testimonial['testimonials_title'], ['class' => 'form-control ', 'placeholder' => __('Enter Title'),'required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Star', __('Star'), ['class' => 'form-label']) }}<x-required></x-required>
                    {{ Form::number('testimonials_star',$testimonial['testimonials_star'], ['class' => 'form-control ', 'min'=>'1', 'max'=>'5','required'=>'required', 'placeholder' => __('Enter Star')]) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}<x-required></x-required>
                    {{ Form::textarea('testimonials_description', $testimonial['testimonials_description'], ['class' => 'summernote form-control', 'placeholder' => __('Enter Description'),'required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('User', __('User'), ['class' => 'form-label']) }}<x-required></x-required>
                    {{ Form::text('testimonials_user',$testimonial['testimonials_user'], ['class' => 'form-control ', 'placeholder' => __('Enter User Name'),'required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Designation', __('Designation'), ['class' => 'form-label']) }}<x-required></x-required>
                    {{ Form::text('testimonials_designation',$testimonial['testimonials_designation'], ['class' => 'form-control ', 'placeholder' => __('Enter Designation'),'required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('User Avtar', __('User Avtar'), ['class' => 'form-label']) }}
                    <input type="file" name="testimonials_user_avtar" class="form-control">
                </div>
            </div>


        </div>
    </div>
    <div class="modal-footer p-0 pt-3">
        <input type="button" value="{{__('Cancel')}}" class="btn  btn-secondary" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
    </div>

{{ Form::close() }}

<script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#commonModal').on('shown.bs.modal', function() {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['list', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'unlink']],
                ],
                height: 250,
                disableDragAndDrop: true,
            });
        });
    });
</script>
