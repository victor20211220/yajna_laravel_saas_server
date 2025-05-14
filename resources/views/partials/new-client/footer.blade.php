@php
    $setting_arr = \App\Models\Utility::file_validate();
@endphp

<script src="{{asset('custom/js/jquery.min.js')}}"></script>

<script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simple-datatables.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('custom/js/custom-toast.js') }}"></script>
@include('components.custom-toast')
<script>
    var base_url = "{{ url('/') }}";
    var file_size = "{{ $setting_arr['max_size'] }}";
    var file_types = "{{ $setting_arr['types'] }}";
    var type_err = "{{ __('Invalid file type. Please select a valid file (' . $setting_arr['types'] . ').') }}";
    var size_err = "{{ __('File size exceeds the maximum limit of ' . $setting_arr['max_size'] / 1024 . 'MB.') }}";
</script>
<script src="{{asset('custom/js/new-client-custom.js?v='.time())}}"></script>
@stack('custom-scripts')



