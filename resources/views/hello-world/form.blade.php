@push('scripts')

@endpush

<x-app-layout :assets="$assets ?? []">
    <div>
        {!! Form::open(['id' => 'form_daily_log', 'route' => ['hello-world.index'], 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title text-capitalize">Employee Performance Calculator</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('hello-world.index') }}" class="btn btn-sm btn-gray" role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Sequence: <span class="text-danger">*</span></label>
                                {{ Form::number('n', old('n', $n), ['class' => 'form-control', 'min' => 1, 'required']) }}
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
                                <h4 class="card-title text-capitalize">Result</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($result as $items)
                                <p>
                                    @foreach ($items as $item)
                                        {{ $item }}
                                    @endforeach
                                </p>
                            @endforeach
                        </div>
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
