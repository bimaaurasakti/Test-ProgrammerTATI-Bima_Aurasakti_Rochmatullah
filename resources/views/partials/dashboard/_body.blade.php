<div id="loading">
    @include('partials.dashboard._body_loader')
</div>
@include('partials.dashboard._body_sidebar')
<main class="main-content">
    <div class="position-relative">
        @include('partials.dashboard._body_header')
        @include('partials.dashboard.sub-header')
    </div>

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        {{ $slot }}
    </div>
</main>

{{-- Toast --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 99">
    <div class="toast fade" id="toast-message" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>
            <strong class="me-auto toast-title"></strong>
            <small class="text-muted">1 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
    </div>
</div>

@include('partials.dashboard._scripts')
@include('partials.dashboard._app_toast')
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="main_form"></div>
            </div>
        </div>
    </div>
</div>
