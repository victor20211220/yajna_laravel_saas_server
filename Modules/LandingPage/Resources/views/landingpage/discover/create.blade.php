{{ Form::open(['route' => 'discover_store', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate']) }}
<div class="modal-body p-0">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}<x-required></x-required>
                {{ Form::text('discover_heading', null, ['class' => 'form-control ', 'placeholder' => __('Enter Heading'),'required'=>'required']) }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}<x-required></x-required>
                {{ Form::textarea('discover_description', null, ['class' => 'form-control summernote', 'placeholder' => __('Enter Description'), 'id' => 'mytextarea','required'=>'required']) }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('Logo', __('Logo'), ['class' => 'form-label']) }}<x-required></x-required>
                <input type="file" name="discover_logo" class="form-control" required="required">
            </div>
        </div>

    </div>
</div>
<div class="modal-footer p-0 pt-3">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
<script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>

<script>
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
</script>
