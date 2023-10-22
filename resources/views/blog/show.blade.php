@extends('layouts.base')

@section('css')
    <style>
        .container-lg {
            font-size: 24px
        }
    </style>
@endsection

@section('main')
    @include('blog.components.show')
@endsection

@section('js')
@endsection
