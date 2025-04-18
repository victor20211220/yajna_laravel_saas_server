@php
    $category_path = \App\Models\Utility::get_file('category');
@endphp
{{ Form::model($categoryData, ['route' => ['category.update', $categoryData->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) }}
<div class="row">
    <div class="form-group col-12">
        {{ Form::label('name', __('Category Name'), ['class' => 'form-label']) }}<x-required></x-required>
        {!! Form::text('name', null, [
            'class' => 'form-control ',
            'required' => 'required',
            'placeholder' => __('Category Name'),
        ]) !!}
        @error('name')
            <small class="invalid-role" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
        @enderror
    </div>
    <div class="col-12 form-group img-validate-class">
        {{ Form::label('category_image', __('Category Logo'), ['class' => 'form-label']) }}<x-required></x-required>
        <div class="choose-files">
            <label for="cat_logo">
                <div class=" bg-primary company_logo_update" style="cursor: pointer;"> <i
                        class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                <input type="file" class="form-control file d-none file-validate" id="cat_logo"
                    name="category_image" data-filename="profiles"
                    onchange="document.getElementById('category_icon').src = window.URL.createObjectURL(this.files[0])">
            </label>
            <p class="file-error text-danger" style=""></p>
        </div>
        <div class="col-md-4 mt-2">

            <?php
            $imagePath = $category_path . '/' . $categoryData->logo;
            $headers = @get_headers($imagePath);
            ?>
            @if ($headers && strpos($headers[0], '200'))
                <div class="category-card-img border border-2 border-primary">
                    <img class="img_categorys_fix_size"
                        src="{{ !empty($categoryData->logo) ? $category_path . '/' . $categoryData->logo : asset('custom/img/placeholder-image21.jpg') }}"
                        id="category_icon" width="100%" height="100%" class="rounded" />
                </div>
            @elseif(empty($categoryData->logo))
                <div class="category-card-img border border-2 border-primary">

                    <img class="img_categorys_fix_size"
                        src="{{ !empty($categoryData->logo) ? $category_path . '/' . $categoryData->logo : asset('custom/img/placeholder-image21.jpg') }}"
                        id="category_icon" width="100%" height="100%" class="rounded" />
                </div>
            @else
                <div class="category-card-img border border-2 border-primary">
                    <img src="{{ asset('custom/category/category' . $categoryData->id . '.png') }}" class="rounded"
                        id="category_icon" />
                </div>
            @endif

        </div>
        {{-- <span class="profiles"></span> --}}
    </div>
</div>
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Update') }}">
</div>
{{ Form::close() }}
