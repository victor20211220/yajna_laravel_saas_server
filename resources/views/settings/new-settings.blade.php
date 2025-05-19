@extends('layouts.new-client')
@section('page-title')
    {{ __('Settings') }}
@endsection
@section('title')
    <div class="mb-4">
        <h3 class="page-title">
            {{ __('Settings') }}
        </h3>
    </div>
@endsection
@section('content')
    {{-- Personal Info --}}
    <div class="card p-4 mb-4">
        <div class="mb-1 card-title">Personal Info</div>
        <p class="text-muted">Edit details about your personal information.</p>
        <form action="{{ route('new-settings.updateProfile') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" class="form-control bg-secondary" id="name" name="name"
                       value="{{ auth()->user()->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control bg-secondary" id="email" name="email"
                       value="{{ auth()->user()->email }}" required>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ url()->previous() }}" class="btn px-4 btn-light">Cancel</a>
                <button type="submit" class="btn px-4 btn-primary">Save</button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="card p-4 mb-4">
        <div class="mb-1 card-title">Change Password</div>
        <p class="text-muted">Edit details about your password</p>
        <form action="{{ route('new-settings.updatePassword') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Current Password *</label>
                <input type="password" class="form-control bg-secondary" name="current_password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password *</label>
                <input type="password" class="form-control bg-secondary" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Retype Password *</label>
                <input type="password" class="form-control bg-secondary" name="password_confirmation" required>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ url()->previous() }}" class="btn px-4 btn-light">Cancel</a>
                <button type="submit" class="btn px-4 btn-primary">Save</button>
            </div>
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="card p-4 d-flex flex-column flex-md-row justify-content-between">
        <div class="mb-3">
            <div class="card-title">Delete Account</div>
            <div>Note that deleting your account will also delete all information and links
                connected to this profile.
            </div>
        </div>
        <form action="{{ route('new-settings.deleteAccount') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn px-4 btn-danger">Delete</button>
        </form>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(function () {
            // Password match check
            $('form[action="{{ route('new-settings.updatePassword') }}"]').on('submit', function (e) {
                const newPass = $('input[name="password"]').val();
                const confirmPass = $('input[name="password_confirmation"]').val();

                if (newPass !== confirmPass) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'New password and confirmation do not match.'
                    });
                }
            });

            // Delete account confirm
            $('form[action="{{ route('new-settings.deleteAccount') }}"]').on('submit', function (e) {
                e.preventDefault();
                const form = this;

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Deleting your account is permanent.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
