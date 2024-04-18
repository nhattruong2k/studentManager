@extends('admin.layout.layout')
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_users';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
        <li><a href="{{route(\App\Models\HocPhan::LIST)}}"> {{trans('hocPhan.list')}}</a></li>
        <li>{{__('common.create')}}</li>
    </ol>
@stop
@section('contents')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('hocphan.store') }}" id="form-hocPhan">
                @csrf
                @include('admin.hocphan._form')
            </form>
        </div>
    </div>
@endsection