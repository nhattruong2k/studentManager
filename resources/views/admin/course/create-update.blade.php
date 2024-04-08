@extends('admin.layout.layout')
@section('contents')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <div class="card">

        @livewire('course.course-create-update', ['courseId' => $id ?? 0])

    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
