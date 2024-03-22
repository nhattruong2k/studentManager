@extends('admin.layout.layout')
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_users';
    </script>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin-home') }}"><i class="fa fa-home"> {{ __('common.home') }}</i></a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route(\App\Models\User::LIST) }}">{{ __('users.list') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('users.change_password') }}</li>
        </ol>
    </div>
@stop
@section('contents')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.save_change_pass', $user->id) }}" id="change-password-user">
                @csrf
                <div class="container-fluid">
                    {{-- @include('admin.layout.partials._showError') --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email" class="control-label">{{ __('users.email') }}</label>
                                <input type="text" name="email" value="{{ $user->email }}"
                                    class="form-control rounded-0" id="exampleInputRounded0" disabled />
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="control-label">{{ __('users.new_pass') }}</label>
                                <input type="password" name="new_password" class="form-control" id="new_password"
                                    autofocus="true" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_new_password"
                                    class="control-label">{{ __('users.retry_pass') }}</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                    autofocus="true" maxlength="50" required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    {{ __('common.save') }}</button>
                                <a href="{{ route(\App\Models\User::LIST) }}" class="btn btn-default"><i
                                        class="fa fa-reply"></i> {{ __('common.return') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    var ChangePassword = {
        GLOBAL: {
            msgDeleteSuc: '@Messages.SUC_DELETE',
        },
        CONSTS: {},
        SELECTORS: {
            frmChangePassword: '#change-password-user',
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(ChangePassword.SELECTORS.frmChangePassword).validate({
                rules: {
                    new_password: {
                        required: true,
                        minlength: 6,
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new_password",
                        minlength: 6,
                    }
                },
                messages: {
                    new_password: {
                        required: "{{__("users.validation.new_pass_empty")}}",
                        minlength: "{{__("users.validation.min_new_password", ['amount' => 6])}}",
                    },
                    confirm_password: {
                        required: "{{__("users.validation.confirm_new_pass")}}",
                        equalTo: "{{__('users.validation.password_incorrect')}}",
                    }
                }
            });
        }
    };

    /**
     * Page loaded
     */
    $(function () {
        ChangePassword.init();
    });
</script>

@endsection
