@extends('admin.layout.layout')
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_users';
    </script>
    <div class="row">
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin-home') }}"><i class="fa fa-home"> {{ __('common.home') }}</i></a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route(\App\Models\LopHocPhan::LIST) }}">{{ __('users.list') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('lophocphan.edit') }}</li>
            </ol>
        </div>
    </div>
@stop
@section('contents')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('lophocphan.update', $lophocphan->id) }}" id="form-lophocphan">
                @csrf
                @include('admin.lophocphan._form')
            </form>
        </div>
    </div>
@endsection
