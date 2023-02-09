@extends('layouts.base')

@section('css')
@endsection

@section('main')
    @include('components.irys')
@endsection

@section('js')
    <script src="{{ asset('js/pi.js') }}"></script>
@endsection
