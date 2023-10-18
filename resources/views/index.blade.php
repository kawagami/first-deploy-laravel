@extends('layouts.base')

@section('css')
    <style>
        .container {
            margin-top: 10px;
            height: calc(100vh - 70px);
        }
    </style>
@endsection

@section('main')
    @include('components.blog')
@endsection

@section('js')
@endsection
