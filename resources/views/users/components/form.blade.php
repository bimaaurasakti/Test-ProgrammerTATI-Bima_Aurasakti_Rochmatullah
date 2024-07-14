<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title text-capitalize">{{ $id !== null ? 'Update' : 'Add' }} User {{ str_replace("_"," ", $type ?? '') }}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="profile-img-edit position-relative">
                        <img src="{{ isset($user->photo_profile) ? getFileMedia($user->photo_profile) : asset('images/avatars/01.png') }}" alt="User-Profile"
                            class="replaceable-image profile-pic rounded avatar-100">
                        <div class="button-trigger-hidden-input-file upload-icone bg-primary">
                            <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                <path fill="#ffffff"
                                    d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </div>
                        <input class="file-upload d-none" type="file" accept="image/*" name="photo_profile_file">
                    </div>
                    <div class="img-extension mt-3">
                        <div class="d-inline-block align-items-center">
                            <small>
                                <span>Note: Only</span>
                                <a href="javascript:void();">.jpg</a>
                                <a href="javascript:void();">.png</a>
                                <a href="javascript:void();">.jpeg</a>
                                <span>allowed, max size 2048 byte</span>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status:</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="input_status" name="is_active"
                            data-active-text="Enabled"
                            data-inactive-text="Disabled"
                            {{ old('is_active') ? 'checked' : ($user->is_active ? 'checked' : '') }}>
                        <label class="form-check-label text-capitalize" for="input_status">
                            {{ $user->is_active ? 'Enabled' : 'Disabled' }}
                        </label>
                    </div>
                </div>
                @if ($type != App\Dictionaries\Users\UserTypeDictionary::USER_TYPE_DEPARTMENT_HEAD)
                    <div class="form-group">
                        <label class="form-label" for="input_manager_id">Manager: <span
                                class="text-danger">*</span></label>
                        <select name="manager_id" id="input_manager_id" class="form-control" data-type="{{ $type }}">
                            @if ($user->manager)
                                <option value="{{ $user->manager->id }}" selected>
                                    {{ $user->manager->first_name }} {{ $user->manager->last_name }}
                                </option>
                            @endif
                        </select>
                    </div>
                @endif
                <div class="form-group d-none">
                    <input type="hidden" class="form-control" name="user_type" value="{{ $role->name  }}" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $id !== null ? 'Update' : 'New' }} User Information</h4>
                </div>
                <div class="card-action">
                    <a href="{{ route('users.index', ['type' => $type]) }}" class="btn btn-sm btn-gray" role="button">Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_email">Email: <span
                                    class="text-danger">*</span></label>
                            {{ Form::text('email', old('email', $user->email), ['id' => 'input_email', 'class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_username">Username:</label>
                            {{ Form::text('username', old('username', $user->username), ['id' => 'input_username', 'class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_first_name">First Name:</label>
                            {{ Form::text('first_name', old('first_name', $user->first_name), ['id' => 'input_first_name', 'class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_last_name">Last Name:</label>
                            {{ Form::text('last_name', old('last_name', $user->last_name), ['id' => 'input_last_name', 'class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_phone_number">Phone Number:</label>
                            {{ Form::text('phone_number', old('phone_number', $user->phone_number), ['id' => 'input_phone_number', 'class' => 'form-control']) }}
                        </div>
                    </div>

                    <hr>
                    <h5 class="mb-3">{{ isset($id) ? 'Reset Password' : 'Security' }}</h5>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_password">Password: <span class="text-danger {{ isset($id) ? 'd-none' : '' }}">*</span></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control toggle-password" name="password" aria-label="Password">
                                <button class="btn btn-outline-primary toggle-password-btn" type="button">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input_password_confirmation">Password Confirmation: <span class="text-danger {{ isset($id) ? 'd-none' : '' }}">*</span></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control toggle-password" name="password_confirmation" aria-label="Password Confirmation">
                                <button class="btn btn-outline-primary toggle-password-btn" type="button">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary generate-new-password" type="button">Generate Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
