@extends('layouts.base')

@section('css')
    <style>
        .container-lg {
            margin-top: 10px;
            height: calc(100vh - 70px);
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            font-size: 24px
        }
    </style>
@endsection

@section('main')
    @include('blog.components.show')
@endsection

@section('js')
@endsection
