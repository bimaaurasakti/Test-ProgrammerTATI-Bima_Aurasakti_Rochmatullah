@push('scripts')

@endpush

<x-app-layout :assets="$assets ?? ['select2']">
    <div>
        {!! Form::open(['id' => 'form_daily_log', 'route' => ['employee-performance.index'], 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title text-capitalize">Employee Performance Calculator</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('employee-performance.index') }}" class="btn btn-sm btn-gray" role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Work results: <span class="text-danger">*</span></label>
                                <select name="work_result" class="select2">
                                    <option selected disabled>select work result</option>
                                    @php
                                        $data = App\Dictionaries\EmployeePerformanceDictionary::workList();
                                    @endphp
                                    @foreach ($data as $value)
                                        <option value="{{ $value }}" {{ old('work_result', $work_result) == $value ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Behavior: <span class="text-danger">*</span></label>
                                <select name="behavior" class="select2">
                                    <option selected disabled>select behavior</option>
                                    @php
                                        $data = App\Dictionaries\EmployeePerformanceDictionary::behaviorList();
                                    @endphp
                                    @foreach ($data as $value)
                                        <option value="{{ $value }}" {{ old('behavior', $behavior) == $value ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($result)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title text-capitalize">Result: {{ $result }}</h4>
                            </div>
                        </div>
                        <div class="card-body"></div>
                    </div>
                </div>
            @endif
        </div>

        <x-global.form-footer
            :backUrl="route('employee-performance.index')"
            text="Submit"
        >
        </x-global.form-footer>

        {!! Form::close() !!}
    </div>
</x-app-layout>
