{{ Form::open(['url' => 'roles', 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}<x-required></x-required>
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Role Name'), 'required' => 'required']) }}
                @error('name')
                    <span class="invalid-name text-danger text-xs" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (!empty($permissions))
                <label for="permissions" class="col-form-label">{{ __('Assign Permission to Roles') }}</label>
                <div class="table-responsive">
                    <table class="table create-role-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input align-middle"
                                            name="checkall" id="checkall">
                                    </div>
                                </th>
                                <th width="10%" class="text-dark">{{ __('Module') }}</th>
                                <th class="text-dark ps-0">{{ __('Permissions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $modules = [
                                    'dashboard',
                                    'user',
                                    'business',
                                    'appointment',
                                    'contact',
                                    'company setting',
                                ];
                            @endphp
                            @foreach ($modules as $module)
                                <tr>
                                    <td width="5%">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input ischeck"
                                                name="checkall" data-id="{{ str_replace(' ', '', $module) }}">
                                        </div>
                                    </td>
                                    <td width="8%">
                                        <label class="ischeck"
                                            data-id="{{ str_replace(' ', '', $module) }}">{{ ucfirst($module) }}</label>
                                    </td>
                                    <td>
                                        <div class="row y-2">
                                            @if (in_array('manage ' . $module, (array) $permissions))
                                                @if ($key = array_search('manage ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Manage', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('create ' . $module, (array) $permissions))
                                                @if ($key = array_search('create ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Create', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('duplicate ' . $module, (array) $permissions))
                                                @if ($key = array_search('duplicate ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'duplicate', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('edit ' . $module, (array) $permissions))
                                                @if ($key = array_search('edit ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Edit', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('delete ' . $module, (array) $permissions))
                                                @if ($key = array_search('delete ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Delete', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('show ' . $module, (array) $permissions))
                                                @if ($key = array_search('show ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Show', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('view ' . $module, (array) $permissions))
                                                @if ($key = array_search('view ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'View', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('theme settings ' . $module, (array) $permissions))
                                                @if ($key = array_search('theme settings ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Theme settings', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('custom settings ' . $module, (array) $permissions))
                                                @if ($key = array_search('custom settings ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Custom settings', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('SEO settings ' . $module, (array) $permissions))
                                                @if ($key = array_search('SEO settings ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'SEO settings', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('block settings ' . $module, (array) $permissions))
                                                @if ($key = array_search('block settings ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Block settings', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('PWA settings ' . $module, (array) $permissions))
                                                @if ($key = array_search('PWA settings ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'PWA settings', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('pixel settings ' . $module, (array) $permissions))
                                                @if ($key = array_search('pixel settings ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Pixel settings', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('view analytics ' . $module, (array) $permissions))
                                                @if ($key = array_search('view analytics ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'View Analytics', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif

                                            @if (in_array('change password ' . $module, (array) $permissions))
                                                @if ($key = array_search('change password ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Change Password', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('buy ' . $module, (array) $permissions))
                                                @if ($key = array_search('buy ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[] isscheck isscheck_' . str_replace(' ', '', $module), $key, false, ['class' => 'form-check-input', 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Buy', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (in_array('calendar ' . $module, (array) $permissions))
                                                @if ($key = array_search('calendar ' . $module, $permissions))
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        {{ Form::checkbox('permissions[] isscheck isscheck_' . str_replace(' ', '', $module), $key, false, ['class' => 'form-check-input', 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'Calendar', ['class' => 'form-check-label']) }}<br>
                                                    </div>
                                                @endif
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="modal-footer p-0 border-0">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary ms-2">
</div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
        $("#checkall").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function() {
            var ischeck = $(this).data('id');
            $('.isscheck_' + ischeck).prop('checked', this.checked);
        });
    });
</script>
