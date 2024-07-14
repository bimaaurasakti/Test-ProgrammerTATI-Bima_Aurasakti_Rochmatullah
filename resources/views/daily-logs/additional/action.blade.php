<div>
    <a class="btn btn-gray" href="{{ route('daily-logs.index') }}" role="button">All</a>
    <a class="btn btn-{{ getColorStatusBadge('pending') }}" href="{{ route('daily-logs.index', ['status' => 'pending']) }}" role="button">Pending</a>
    <a class="btn btn-{{ getColorStatusBadge('accepted') }}" href="{{ route('daily-logs.index', ['status' => 'accepted']) }}" role="button">Accepted</a>
    <a class="btn btn-{{ getColorStatusBadge('rejected') }}" href="{{ route('daily-logs.index', ['status' => 'rejected']) }}" role="button">Rejected</a>
</div>
