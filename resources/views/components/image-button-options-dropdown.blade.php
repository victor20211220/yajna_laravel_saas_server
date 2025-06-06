<!-- Modal -->
@props([
    'class' => '',
])
<div class="dropdown image-buttons-dropdown {{ $class }}">
    <button type="button"
            class="btn btn-icon btn-primary rounded-circle justify-content-center"
            data-bs-toggle="dropdown"
            aria-expanded="false">
        {!! svg('/user_interface/three_dots.svg') !!}
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="edit-image dropdown-item d-flex align-items-center gap-3"
               href="javascript:void(0)">
                {!! svg('/user_interface/edit.svg') !!}
                <span>Edit Picture</span>
            </a>
        </li>
        <li>
            <a class="upload-new-image dropdown-item d-flex align-items-center gap-3"
               href="javascript:void(0)">
                {!! svg('/user_interface/upload_new.svg') !!}
                <span>Upload New</span>
            </a>
        </li>
        <li>
            <a class="delete-image dropdown-item d-flex align-items-center gap-3"
               href="javascript:void(0)">
                {!! svg('/user_interface/delete.svg') !!}
                <span>Delete</span>
            </a>
        </li>
    </ul>
</div>
