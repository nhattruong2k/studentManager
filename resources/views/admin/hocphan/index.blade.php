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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <ul class="d-flex">
                        <li><a href="{{ route(\App\Models\HocPhan::CREATE) }}" class="btn btn-primary mr-1"><i
                                    class="fa fa-plus-square"></i> {{ __('common.create') }}</a></li>
                        <li><a href="{{ route(\App\Models\HocPhan::LIST) }}" class="btn btn-default"><i
                                    class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <div>
                        {!! Form::open([
                            'url' => route(\App\Models\HocPhan::LIST),
                            'id' => 'form-search',
                            'method' => 'GET',
                            'class' => 'd-flex',
                        ]) !!}
                        {!! Form::text('search', Request::get('search'), [
                            'class' => 'form-control form-inline',
                            'maxlength' => 50,
                            'id' => 'input_source',
                            'placeholder' => __('common.keyword'),
                            'autocomplete' => 'off',
                        ]) !!}
                        <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>
                        {!! Form::hidden('numpaging', Request::get('numpaging')) !!}
                        {!! Form::hidden('paging', Request::get('paging')) !!}
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
                        <th class="text-center">{{ __('hocPhan.ma_hp') }}</th>
                        <th class="text-center">{{ __('hocPhan.ten_hp') }}</th>
                        <th class="text-center">{{ __('hocPhan.tinchi') }}</th>
                        <th class="w_220 text-center">{{ __('common.action') }}</th>
                    </tr>
                <tbody>
                    @foreach ($hocphans as $key => $hocphan)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="text-center align-middle">{{ $hocphan->Ma_hp }}</td>
                            <td class="text-center align-middle">{{ $hocphan->Ten_hp }}</td>
                            <td class="text-center align-middle">{{ $hocphan->So_tc }}</td>

                            <td class="action text-center align-middle">
                                <a href="{{ route(\App\Models\HocPhan::UPDATE, $hocphan->id) }}"
                                    class="btn btn-primary" title="{{ trans('common.edit') }}"><i
                                        class="fa fa-edit"></i></a>
                                <a href="javascript:;" onclick="deleteModal('{{ $hocphan->id }}', 'hocphan/destroy')"
                                    title="{{ trans('common.delete') }}" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
            <div class="footer-table row">
                <div class="col-sm-6 d-flex">
                    <div class="box-numpaging">
                        {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get('numpaging'), [
                            'class' => 'form-control select',
                            'id' => 'selectNumpaging',
                        ]) !!}
                    </div>
                    <span class="total-record ml-2 mt-2">{!! __('common.total_data', ['total' => $hocphans->total()]) !!}</span>
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">
                        {{ $hocphans->links('vendor/pagination/bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include("admin.layout.partials.numpaging")
@endsection