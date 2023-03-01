@extends('layouts.base')

@section('css')
@endsection

@section('main')
    @include('components.short-url')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire(
                "{{ session('success') }}",
                '',
                'success'
            )
        </script>
    @endif
@endsection

@section('js')
@endsection
