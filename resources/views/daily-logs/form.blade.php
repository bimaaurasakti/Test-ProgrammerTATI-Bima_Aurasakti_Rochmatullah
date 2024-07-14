@push('scripts')
    <script src="{{ asset('js/daily-logs/index.js') }}"></script>
@endpush

<x-app-layout :assets="$assets ?? ['select2']">
    <div>
        <?php
            $id = $dailyLog->id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($dailyLog, [
                'id' => 'form_daily_log',
                'route' => ['daily-logs.update', $id],
                'method' => 'patch',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open(['id' => 'form_daily_log', 'route' => ['daily-logs.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif

        @if (auth()->user()->user_type == App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title text-capitalize">{{ $id !== null ? 'Update' : 'Add' }} User</h4>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('daily-logs.index') }}" class="btn btn-sm btn-gray" role="button">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-daily-log-info">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">User:</label>
                                        <select id="input_user_id" name="user_id" class="form-control">
                                            @if ($dailyLog->user)
                                                <option value="{{ $dailyLog->user->id }}" selected>
                                                    {{ $dailyLog->user->first_name }} {{ $dailyLog->user->last_name }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title text-capitalize">{{ $id !== null ? 'Update' : 'Add' }} Daily Log</h4>
                        </div>
                        @if (auth()->user()->user_type != App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
                            <div class="card-action">
                                <a href="{{ route('daily-logs.index') }}" class="btn btn-sm btn-gray" role="button">Back</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="new-daily-log-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="input_log_date">Log Date: <span class="text-danger">*</span></label>
                                    {{ Form::date('log_date', old('log_date') , ['id' => 'input_log_date', 'class' => 'form-control'.($errors->has('log_date') ? ' is-invalid' : ''), 'required']) }}
                                    @error('log_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @if (auth()->user()->user_type == App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_SUPER_ADMIN)
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Status:</label>
                                        <select name="status" class="select2">
                                            @php
                                                $statuses = App\Dictionaries\DailyLogStatusDictionary::list();
                                            @endphp
                                            @foreach ($statuses as $key => $value)
                                                <option value="{{ $key }}" {{ old('status', $dailyLog->status) == $key ? 'selected' : ''}}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group col-md-6"></div>
                                @endif
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="input_activity">Activity: <span class="text-danger">*</span></label>
                                    {{ Form::textarea('activity', old('activity') , ['id' => 'input_activity', 'class' => 'form-control'.($errors->has('activity') ? ' is-invalid' : ''), 'required']) }}
                                    @error('activity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="input_notes">Notes:</label>
                                    {{ Form::textarea('notes', old('notes') , ['id' => 'input_notes', 'class' => 'form-control'.($errors->has('notes') ? ' is-invalid' : ''), 'required']) }}
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-global.form-footer
            :id="$id"
            :backUrl="route('daily-logs.index')"
            :text="$id !== null ? 'Update' : 'Add'"
        >
        </x-global.form-footer>

        {!! Form::close() !!}
    </div>
</x-app-layout>
