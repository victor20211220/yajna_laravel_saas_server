@if (Session::has('success'))
    <script>
        toastrs('{{ __('Success') }}', '{!! session('success') !!}', 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if (Session::has('error'))
    <script>
        toastrs('{{ __('Error') }}', '{!! session('error') !!}', 'error');
    </script>
    {{ Session::forget('error') }}
@endif
