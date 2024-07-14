<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex justify-content-end">
                <a href="{{ $backUrl }}" class="btn btn-gray me-2" role="button">Back</a>
                {{-- @can('daily-log-reject-' . $user_type)
                    <?php
                        $message = 'Are you sure you want to reject this daily log?';
                    ?>
                    <a class="btn btn-sm btn-icon btn-danger"
                        onclick="confirmAction({'text': '{{$message}}'}, function(){document.getElementById('user-activate-{{$id}}').submit()})"
                        data-bs-toggle="tooltip" title="Reject Log" href="#">
                        <div class="text-white mx-1" style="fill: white">
                            x
                        </div>
                    </a>
                @endcan --}}
                <button type="submit" class="btn btn-primary">
                    {{ $text }}
                </button>
            </div>
        </div>
    </div>
</div>


