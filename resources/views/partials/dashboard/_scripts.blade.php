<!-- Backend Bundle JavaScript -->
<script>
    const base_url = "{{ url('') }}";
</script>

<script src="{{ asset('js/libs.min.js')}}"></script>
@if(in_array('data-table',$assets ?? []))
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
@endif
@if(in_array('chart',$assets ?? []))
    <!-- apexchart JavaScript -->
    <script src="{{asset('js/charts/apexcharts.js') }}"></script>
    <!-- widgetchart JavaScript -->
    <script src="{{asset('js/charts/widgetcharts.js') }}"></script>
    <script src="{{asset('js/charts/dashboard.js') }}"></script>
@endif

<!-- mapchart JavaScript -->
<script src="{{asset('vendor/Leaflet/leaflet.js') }} "></script>
<script src="{{asset('js/charts/vectore-chart.js') }}"></script>


<!-- fslightbox JavaScript -->
<script src="{{asset('js/plugins/fslightbox.js')}}"></script>
<script src="{{asset('js/plugins/slider-tabs.js') }}"></script>
<script src="{{asset('js/plugins/form-wizard.js')}}"></script>

<!-- settings JavaScript -->
<script src="{{asset('js/plugins/setting.js')}}"></script>

<script src="{{asset('js/plugins/circle-progress.js') }}"></script>
@if(in_array('animation',$assets ?? []))
<!--aos javascript-->
<script src="{{asset('vendor/aos/dist/aos.js')}}"></script>
@endif

@if(in_array('calender',$assets ?? []))
<!-- Fullcalender Javascript -->
{{-- {{-- <script src="{{asset('vendor/fullcalendar/core/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/daygrid/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/timegrid/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/list/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/interaction/main.js')}}"></script> --}}
<script src="{{asset('vendor/moment.min.js')}}"></script>
<script src="{{asset('js/plugins/calender.js')}}"></script>
@endif

@if(in_array('ckeditor5',$assets ?? []))
    <!-- CKEditor Javascript -->
    <script src="{{asset('vendor/ckeditor5/ckeditor.js')}}"></script>
@endif

@if(in_array('select2',$assets ?? []))
    <script src="{{asset('vendor/select2/select2.full.min.js')}}"></script>
@endif

<script src="{{ asset('js/plugins/sweetalert.js') }}"></script>
<script src="{{ asset('vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/plugins/flatpickr.js') }}" defer></script>
{{-- <script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker-full.js')}}"></script> --}}
<script src="{{asset('js/plugins/prism.mini.js')}}"></script>

<!-- Custom JavaScript -->
<script src="{{asset('js/hope-ui.js') }}"></script>
<script src="{{asset('js/modelview.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

@stack('scripts')
