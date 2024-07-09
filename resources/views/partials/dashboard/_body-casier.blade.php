<div id="loading">
    @include('partials.dashboard._body_loader')
</div>

<main class="main-content">
    <div class="container-fluid py-4 px-5">
        {{ $slot }}
    </div>
</main>

<!-- Toast -->
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

@include('partials.dashboard._scripts-casier')
@include('partials.dashboard._app_toast')