@extends('admin.layout.layout')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin-home') }}"><i class="fa fa-home"> {{ __('common.home') }}</i></a>
            </li>
            <li class="breadcrumb-item active">{{ __('common.course') }}</li>
        </ol>
    </div>
@stop
@section('contents')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <div class="card">
        @livewire('course.course-header')

        @livewire('course.course-search')

        @livewire('course.course-list')


    </div>
@endsection
{{-- @section('script')
    @include('admin.layout.partials.numpaging')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".is_visible").click(function(e) {
                let is_visible = $(this).data('visible');
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('roles-active') }}',
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
@endsection --}}

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
