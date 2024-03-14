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
                <a href="{{ route(\App\Models\Roles::LIST) }}">{{ __('roles.list') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('roles.edit') }}</li>
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
            <form method="POST" action="{{ route('roles.update', [$role->id])}}" id="form-roles" >
                @csrf
                @include('admin.roles._form')
            </form>
        </div>
    </div>
@endsection
