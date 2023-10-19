@extends('layouts.base')

@section('css')
    <style>
        .container-lg {
            margin-top: 10px;
            height: calc(100vh - 70px);
        }
    </style>
@endsection

@section('main')
    @include('blog.components.show')
@endsection

@section('js')
@endsection
