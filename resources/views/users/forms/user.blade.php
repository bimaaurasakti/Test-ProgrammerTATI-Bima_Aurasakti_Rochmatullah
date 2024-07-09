@push('scripts')
    <script src="{{ asset('js/users/index.js') }}"></script>
@endpush

<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
            $id = $user->id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($user, [
                'id' => 'form_user',
                'route' => ['users.update', $id],
                'method' => 'patch',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open(['id' => 'form_user', 'route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif

        <x-user.form :id="$id" :type="$type" :user="$user" :role="$role"></x-user.form>
        <x-global.form-footer :id="$id" :backUrl="route('users.index', ['type' => $type])" :text="$id !== null ? 'Update' : 'Add'"></x-global.form-footer>

        {!! Form::close() !!}
    </div>
</x-app-layout>
