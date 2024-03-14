<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{ __('users.avatar') }}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $user->avatar_url }}" style="height: 8.0rem" alt="img" />
                            @if (getFilenameFromUrl($user->avatar_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i
                                        class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                <div>
                    <span class="btn btn-file btn-primary">
                        <span class="fileupload-new">{{ __('common.choose') }}</span>
                        <span class="fileupload-exists">{{ __('common.change') }}</span>
                        <input type="file" name="avatar" id="fileInput" class="upload_img"
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
        
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label ">{{__('common.role')}}</label>
                <select name="role_id[]" class="form-control select2-single select" {{Request::segment(3) == 'profile' ? 'disabled' : ''}} multiple>
                    @foreach ($roles as $item)
                        <option {{ isset($roleOfUser) ? $roleOfUser->contains('id', $item->id) ? 'selected' : '' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="control-label required">{{ __('users.full_name') }}</label>
                <input type="text" name="name" class="form-control rounded-0" id="exampleInputRounded0"
                    required />
            </div>
            <div class="form-group">
                <label for="name" class="control-label required">{{ __('users.email') }}</label>
                <input type="text" name="email" class="form-control rounded-0" id="exampleInputRounded0"
                    required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender" class="control-label">{{ __('users.gender') }}</label>
                <select name="gender" id="exampleSelectRounded0" class="custom-select rounded-0">
                    <option value="1">{{ __('users.male') }}</option>
                    <option value="0">{{ __('users.female') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label">{{ __('users.phone') }}</label>
                <input type="number" name="phone" class="form-control rounded-0" id="exampleInputRounded0" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="facebook" class="control-label">{{ __('users.facebook') }}</label>
                <input type="text" name="facebook" class="form-control rounded-0" id="exampleInputRounded0" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address" class="control-label">{{ __('users.address') }}</label>
                <input type="text" name="address" class="form-control rounded-0" id="exampleInputRounded0" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="password" class="control-label required">{{ __('common.password') }}</label>
                <input type="password" name="password" id="" class="form-control rounded-0"
                    id="exampleInputRounded0">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="confirm_password"
                    class="control-label required">{{ __('common.confirm_password') }}</label>
                <input type="password" name="password_confirmation" id="" class="form-control rounded-0"
                    id="exampleInputRounded0">
            </div>
        </div>
    </div>
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
    <button type="submit" class="btn btn-info"><i class="fa fa-save"> {{ __('common.create') }}</i></button>
    <a href="{{ route(\App\Models\User::LIST) }}" class="btn btn-default"><i class="fa fa-reply">
            {{ __('common.cancel') }}</i></a>
</div>

@section('script')
{{-- @include('admin.layout.partials._bootstrap_fileupload') --}}

@endsection
