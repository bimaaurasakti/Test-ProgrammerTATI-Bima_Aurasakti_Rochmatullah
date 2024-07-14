@push('scripts')
    <script src="{{ asset('js/dynamic-form/index.js') }}"></script>
@endpush

<x-app-layout :assets="$assets ?? []">
    <div>
        {!! Form::model($dynamicForms, [
            'id' => 'form_daily_log',
            'route' => ['dynamic-form.update'],
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ]) !!}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title text-capitalize">Dynamic Form</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('dynamic-form.index') }}" class="btn btn-sm btn-gray" role="button">Back</a>
                        </div>
                    </div>
                    <div id="card_form" class="card-body p-0 pb-2">
                        <div class="table-responsive mt-4">
                            <table id="table_dynamic_forms" class="table table-striped mb-0" role="grid">
                               <thead>
                                  <tr>
                                     <th>No</th>
                                     <th>Nama</th>
                                     <th>No Hp</th>
                                     <th>Alamat</th>
                                     <th>Aksi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                    @foreach ($dynamicForms as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><input type="text" class="form-control" value="{{ $item->name }}" data-name="name[{{ $item->id}}]"></td>
                                            <td><input type="text" class="form-control" value="{{ $item->phone_number }}" data-name="phone_number[{{ $item->id}}]"></td>
                                            <td><input type="text" class="form-control" value="{{ $item->address }}" data-name="address[{{ $item->id}}]"></td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger button-delete-form" title="Delete" type="button" data-id="{{ $item->id }}">
                                                    <div class="text-white mx-1" style="fill: white">
                                                        x
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                               </tbody>
                            </table>
                            <div class="d-grid gap-2 p-4">
                                <button id="button_add_form" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Add New" type="button">+ Add</button>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>

        <x-global.form-footer
            :backUrl="route('dynamic-form.index')"
            :text="'Update'"
        >
        </x-global.form-footer>

        {!! Form::close() !!}
    </div>
</x-app-layout>
