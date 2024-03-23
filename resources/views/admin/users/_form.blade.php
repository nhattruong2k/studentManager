<div class="card-body">
    @include('admin.layout.partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{ __('users.avatar') }}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $user->avatar_url }}" style="height: 8.0rem" alt="img" />
                            {{-- @if (getFilenameFromUrl($user->avatar_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i
                                        class="fa fa-trash-o"></i></a>
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                <div>
                    <span class="btn btn-file btn-primary">
                        <span class="fileupload-new">{{ __('common.choose') }}</span>
                        {{-- <span class="fileupload-exists">{{ __('common.change') }}</span> --}}
                        <input type="file" name="avatar" id="fileInput" class="upload_img" alt="image"
                            accept="image/x-png,image/jpeg" />
                    </span>
                    <a href="javascript:;" class="btn fileupload-exists"
                        data-dismiss="fileupload">{{ __('common.delete') }}</a>
                </div>
                {{-- <span class="upload_img_error error d-none">{{ trans('common.validation.mimes') }}</span> --}}
            </div>
        </div>
    </div>
    @if ($user->role != \App\Libs\Constants::$administrator)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('common.role') }}</label>
                    <select class="select2" name="role_id[]" multiple="multiple"
                        data-placeholder="{{ __('common.role') }}" style="width: 100%;"
                        {{ Request::segment(3) == 'profile' ? 'disabled' : '' }}>
                        @foreach ($roles as $item)
                            <option
                                {{ isset($roleOfUser) ? ($roleOfUser->contains('id', $item->id) ? 'selected' : '') : '' }}
                                value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="control-label required">{{ __('users.full_name') }}</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control rounded-0"
                    id="name" required />
            </div>
            <div class="form-group">
                <label for="name" class="control-label required">{{ __('users.email') }}</label>
                @if(!$user->id)
                <input type="text" name="email" value="{{ $user->email }}" class="form-control rounded-0"
                id="email" required />
                @else
                <span class="form-control  bg-light not-allowed" readonly="true">{{$user->email}}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender" class="control-label">{{ __('users.gender') }}</label>
                <select name="gender" id="exampleSelectRounded0" class="custom-select rounded-0">
                    <option value="1" {{ isset($user->gender) && $user->gender == '1' ? 'selected' : '' }}>
                        {{ __('users.male') }}</option>
                    <option value="0" {{ isset($user->gender) && $user->gender == '0' ? 'selected' : '' }}>
                        {{ __('users.female') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label">{{ __('users.phone') }}</label>
                <input type="number" name="phone" value="{{ $user->phone }}" class="form-control rounded-0"
                    id="phone" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="facebook" class="control-label">{{ __('users.facebook') }}</label>
                <input type="text" name="facebook" value="{{ $user->facebook }}" class="form-control rounded-0"
                    id="facebook" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address" class="control-label">{{ __('users.address') }}</label>
                <input type="text" name="address" value="{{ $user->address }}" class="form-control rounded-0"
                    id="address" />
            </div>
        </div>
    </div>
    @if (!$user->id)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="control-label required">{{ __('common.password') }}</label>
                    <input type="password" name="password" class="form-control rounded-0" id="input_password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="confirm_password"
                        class="control-label required">{{ __('common.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" id="input_password_confirmation"
                        class="form-control rounded-0" id="exampleInputRounded0">
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="checkbox" id="is_visible" name="is_visible" value="1"
                    @if ($user->is_visible ?? 1) checked @endif>
                <label for="is_visible">{{ __('users.verify') }}</label>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-info" id="btn_save"><i class="fa fa-save">
            {{ !$user->id ? __('common.create') : __('common.update') }}</i></button>
    <a href="{{ route(\App\Models\User::LIST) }}" class="btn btn-default"><i class="fa fa-reply">
            {{ __('common.cancel') }}</i></a>
</div>
<script type="text/javascript">
    mn_selected = 'mn_users';
</script>
@section('script')
    {{-- @include('admin.layout.partials._bootstrap_fileupload') --}}
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        var User = {
            init: function() {
                this.setUpEvent();
            },
            setUpEvent: function() {
                $("#form-user").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 4,
                            maxlength: 50,
                            remote: {
                                type: 'post',
                                url: '{{ route('name_exists') }}',
                                data: {
                                    'name': function() {
                                        return $('#name').val();
                                    },
                                    'id': function() {
                                        return '{{ $user->id }}';
                                    }
                                }
                            },
                        },
                        email: {
                            required: true,
                            email: true,
                            remote: {
                                type: 'post',
                                url: '{{ route('email_exists') }}',
                                data: {
                                    'email': function() {
                                        return $('#email').val();
                                    },
                                    'id': function() {
                                        return '{{ $user->id }}';
                                    }
                                }
                            },
                        },
                        facebook: {
                            check_exist_facebook: true,
                        },
                        phone: {
                            check_phone_VN: true,
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#input_password",
                            minlength: 6
                        },
                        address: {
                            maxlength: 100,
                        }
                    },
                    messages: {
                        name: {
                            required: "{{ __('users.name_empty') }}",
                            minlength: "{{ __('users.validation.name_min', ['amount' => 6]) }}",
                            maxlength: "{{ __('users.validation.name_max', ['amount' => 50]) }}",
                            remote: "{{ trans('users.name_exist') }}"
                        },
                        email: {
                            required: "{{ __('users.email_empty') }}",
                            email: "{{ __('users.email_format') }}",
                            remote: "{{ trans('users.validation.email_exist') }}",
                        },
                        facebook: {
                            check_exist_facebook: "{{ __('users.facebook_regex') }}",
                        },
                        phone: {
                            check_phone_VN: '{{ trans('users.validation.phone_format') }}',
                        },
                        address: {
                            maxlength: '{{ trans('users.validation.address_max') }}',
                        },
                        password: {
                            required: "{{ __('users.password_empty') }}",
                            minlength: "{{ __('users.validation.min_new_password', ['amount' => 6]) }}",
                        },
                        password_confirmation: {
                            required: "{{ __('users.validation.retry_pass_empty') }}",
                            equalTo: "{{ __('users.pass_and_repass_not_match') }}",
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                        $('#btn_save').attr('disabled', true)
                    }
                });
            }
        }

        $(function() {
            User.init();
            jQuery.validator.addMethod("check_phone_VN", function(value, element) {
                return this.optional(element) || /(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/.test(value);
            });
            $.validator.addMethod("check_exist_facebook", function is_valid_url(url, element) {
                return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(url);
            });
        });
    </script>
@endsection
