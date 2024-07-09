<div class="flex align-items-center list-user-action">
    @if ($is_active)
        @can('user-deactivate')
            <?php
                $message = 'Are you sure you want to deactivate this user?';
            ?>
            <a class="btn btn-sm btn-icon btn-danger"
                onclick="confirmAction({'text': '{{$message}}'}, function(){document.getElementById('user-deactivate-{{$id}}').submit()})"
                data-bs-toggle="tooltip" title="Deactivate User" href="#">
                <span class="btn-inner">
                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.4232 9.4478V7.3008C16.4232 4.7878 14.3852 2.7498 11.8722 2.7498C9.35925 2.7388 7.31325 4.7668 7.30225 7.2808V7.3008V9.4478"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.683 21.2497H8.042C5.948 21.2497 4.25 19.5527 4.25 17.4577V13.1687C4.25 11.0737 5.948 9.37671 8.042 9.37671H15.683C17.777 9.37671 19.475 11.0737 19.475 13.1687V17.4577C19.475 19.5527 17.777 21.2497 15.683 21.2497Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path d="M11.8628 14.2026V16.4236" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </a>
        @endcan
    @else
        @can('user-activate')
            <?php
                $message = 'Are you sure you want to activate this user?';
            ?>
            <a class="btn btn-sm btn-icon btn-success"
                onclick="confirmAction({'text': '{{$message}}'}, function(){document.getElementById('user-activate-{{$id}}').submit()})"
                data-bs-toggle="tooltip" title="Activate User" href="#">
                <span class="btn-inner">
                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.4242 5.56204C15.8072 3.78004 14.1142 2.50004 12.1222 2.50004C9.60925 2.49004 7.56325 4.51804 7.55225 7.03104V7.05104V9.19804"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.933 21.0005H8.292C6.198 21.0005 4.5 19.3025 4.5 17.2075V12.9195C4.5 10.8245 6.198 9.12646 8.292 9.12646H15.933C18.027 9.12646 19.725 10.8245 19.725 12.9195V17.2075C19.725 19.3025 18.027 21.0005 15.933 21.0005Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path d="M12.1128 13.9526V16.1746" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </a>
        @endcan
    @endif

    <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit User" href="{{ route('users.edit', $id) }}">
        <span class="btn-inner">
            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </a>

    @if ($is_active)
        @can('user-deactivate')
            <form action="{{ route('users.deactivate', $id) }}" id="user-deactivate-{{ $id }}" method="post">
                @method('post')
                @csrf()
            </form>
        @endcan
    @else
        @can('user-activate')
            <form action="{{ route('users.activate', $id) }}" id="user-activate-{{ $id }}" method="post">
                @method('post')
                @csrf()
            </form>
        @endcan
    @endif
</div>
