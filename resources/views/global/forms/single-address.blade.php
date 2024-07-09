<div class="row">
    <div class="offset-xl-3 offset-lg-4 col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $id !== null ? 'Update' : 'New' }} Address</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <div class="row">
                        <h5 class="mb-3">Customer Address</h5>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_province_id">Province: <span
                                    class="text-danger">*</span></label>
                            <select name="province_id" id="input_province_id" class="form-control">
                                @if ($province)
                                    <option value="{{ $province->id }}" selected>
                                        {{ $province->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_city_id">City: <span
                                    class="text-danger">*</span></label>
                            <select name="city_id" id="input_city_id" class="form-control">
                                @if ($city)
                                    <option value="{{ $city->id }}" selected>
                                        {{ $city->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_district_id">District: <span
                                    class="text-danger">*</span></label>
                            <select name="district_id" id="input_district_id" class="form-control">
                                @if ($district)
                                    <option value="{{ $district->id }}" selected>
                                        {{ $district->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_subdistrict_id">Subdistrict: <span
                                    class="text-danger">*</span></label>
                            <select name="subdistrict_id" id="input_subdistrict_id" class="form-control">
                                @if ($subdistrict)
                                    <option value="{{ $subdistrict->id }}" selected>
                                        {{ $subdistrict->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="input_address">Address: <span
                                    class="text-danger">*</span></label>
                            {{ Form::textarea('address', old('address', $address), ['id' => 'input_address', 'class' => 'form-control', 'rows' => '4', 'required']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
