@extends('layouts.base')

@section('css')
@endsection

@section('main')
    @include('components.short-url')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
