<div class="flex align-items-center list-user-action">
    @if ($manager_id == auth()->user()->id || auth()->user()->user_type == App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
        @can('daily-log-accept-' . $user_type)
            <?php
                $message = 'Are you sure you want to accept this daily log?';
            ?>
            <a class="btn btn-sm btn-icon btn-success"
                onclick="confirmAction({'text': '{{$message}}'}, function(){document.getElementById('daily-log-accept-{{$id}}').submit()})"
                data-bs-toggle="tooltip" title="Accept Log" href="#">
                <div class="text-white mx-1">
                    ✓
                </div>
            </a>
        @endcan

        @can('daily-log-reject-' . $user_type)
            <?php
                $message = 'Are you sure you want to reject this daily log?';
            ?>
            <a class="btn btn-sm btn-icon btn-danger"
                onclick="confirmAction({'text': '{{$message}}'}, function(){document.getElementById('daily-log-reject-{{$id}}').submit()})"
                data-bs-toggle="tooltip" title="Reject Log" href="#">
                <div class="text-white mx-1" style="fill: white">
                    x
                </div>
            </a>
        @endcan
    @endif

    @if (($user_id == auth()->user()->id && $status == App\Dictionaries\DailyLogStatusDictionary::STATUS_PENDING) || auth()->user()->user_type == App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
        <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit User" href="{{ route('daily-logs.edit', $id) }}">
            <span class="btn-inner">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
        </a>
    @endif

    @if (($manager_id == auth()->user()->id && $status == App\Dictionaries\DailyLogStatusDictionary::STATUS_PENDING) || auth()->user()->user_type == App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
        @can('daily-log-accept-' . $user_type)
            <form action="{{ route('daily-logs.accept', $id) }}" id="daily-log-accept-{{ $id }}" method="post">
                @method('post')
                @csrf()
            </form>
        @endcan
    @endif

    @if (($manager_id == auth()->user()->id && $status == App\Dictionaries\DailyLogStatusDictionary::STATUS_PENDING) || auth()->user()->user_type == App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
        @can('daily-log-reject-' . $user_type)
            <form action="{{ route('daily-logs.reject', $id) }}" id="daily-log-reject-{{ $id }}" method="post">
                @method('post')
                @csrf()
            </form>
        @endcan
    @endif
</div>
