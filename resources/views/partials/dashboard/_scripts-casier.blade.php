<script>
    const base_url = "{{ url('') }}";
</script>

<!-- Backend Bundle JavaScript -->
<script src="{{ asset('js/libs.min.js') }}"></script>

<!-- settings JavaScript -->
<script src="{{ asset('js/plugins/setting.js') }}"></script>
<script src="{{ asset('js/plugins/circle-progress.js') }}"></script>

<!--aos javascript-->
<script src="{{ asset('vendor/aos/dist/aos.js') }}"></script>

<script src="{{ asset('js/plugins/sweetalert.js') }}"></script>
<script src="{{ asset('vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/plugins/flatpickr.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('vendor/slickjs/slick.min.js') }}"></script>

<!-- Custom JavaScript -->
<script src="{{asset('js/hope-ui.js') }}"></script>
<script src="{{asset('js/modelview.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

@stack('scripts')
