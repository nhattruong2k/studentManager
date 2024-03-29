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
            <li class="breadcrumb-item active">{{ __('common.users') }}</li>
        </ol>
    </div>
@stop
@section('contents')
    {{-- <div class="card"> --}}
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <ul class="d-flex">
                        <li><a href="{{ route(\App\Models\User::CREATE) }}" class="btn btn-primary mr-1"><i
                                    class="fa fa-plus-square"></i> {{ __('common.create') }}</a></li>
                        <li><a href="{{ route(\App\Models\User::LIST) }}" class="btn btn-default"><i
                                    class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <div>
                        {!! Form::open(array('url' => route(\App\Models\User::LIST), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
                        {!! Form::text('search', Request::get('search'), array('class' => 'form-control form-inline', 'maxlength' => 50, 'id' => 'input_source', 'placeholder' => __('common.keyword'), 'autocomplete' => 'off')) !!}
                        <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>
                        {!!Form::hidden("numpaging", Request::get('numpaging'))!!}
                        {!!Form::hidden("paging", Request::get('paging'))!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body container-fluid">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="w_30">{{ __('common.stt') }}</th>
                        <th class="w_130 text-center">{{ __('users.avatar') }}</th>
                        <th>{{ __('users.name') }}</th>
                        <th>{{ __('users.email') }}</th>
                        <th class="text-center">{{ __('common.status') }}</th>
                        <th class="w_220 text-center">{{ __('common.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td class="text-center align-middle">{{ $key }}</td>
                            <td><img src="{{ $user->avatar_url }}" with="100%" height="80" alt=""></td>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="text-center w_100 align-middle">
                                @if ($user->is_visible)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input is_visible" type="checkbox" role="switch"
                                            id="is_visible_{{ $user->id }}" data-id="{{ $user->id }}"
                                            data-visible="{{ $user->is_visible }}" checked
                                            {{ $user->id != \Auth::user()->id && $user->role != \App\Libs\Constants::$administrator ? '' : 'disabled' }}>
                                    </div>
                                @else
                                    <div class="form-check form-switch">
                                        <input class="form-check-input is_visible" type="checkbox" role="switch"
                                            id="is_visible_{{ $user->id }}" data-id="{{ $user->id }}"
                                            data-visible="{{ $user->is_visible }}"
                                            {{ $user->id != \Auth::user()->id && $user->role != \App\Libs\Constants::$administrator ? '' : 'disabled' }}>
                                    </div>
                                @endif
                            </td>
                            <td class="action text-center align-middle">
                                <a href="{{ route('userPermission', $user->id) }}" class="btn btn-primary"><i class="fa fa-lock"></i></a>
                                <a href="{{ route(\App\Models\User::UPDATE, $user->id) }}" class="btn btn-primary"
                                    title="{{ trans('common.edit') }}"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('user.change_pass', $user->id)}}" class="btn btn-primary" title="{{ trans('users.change_password') }}"><i
                                        class="fa fa-key"></i></a>
                                <a href="javascript:;" onclick="deleteModal('{{ $user->id }}', 'users/destroy')"
                                    title="{{ trans('common.delete') }}" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="footer-table row">
                <div class="col-sm-6 d-flex">
                    <div class="box-numpaging">
                        {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get("numpaging"),array('class' => 'form-control select', 'id' => 'selectNumpaging')) !!}
                    </div>
                    <span class="total-record ml-2 mt-2">{!!__("common.total_data", ['total' => $users->total()])!!}</span>
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">
                        {{$users->links('vendor/pagination/bootstrap-4')}}
                    </div>

                </div>
            </div>
        </div>

    {{-- </div> --}}


    <!-- /.content-header -->
@endsection
@section('script')
@include("admin.layout.partials.numpaging")

    <script type="text/javascript">
        $(document).ready(function() {
            $(".is_visible").click(function(e) {
                let is_visible = $(this).data('visible');
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('users-active') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        is_visible: is_visible
                    },
                    success: function(data, success) {
                        showNotificationActive(data.message);
                    }
                });
            })
        });
    </script>

@endsection
