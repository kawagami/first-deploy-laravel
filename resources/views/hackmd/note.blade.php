@extends('layouts.base')

@section('css')
    <style>
        pre {
            background-color: #ddd;
            padding: 20px;
            border-radius: 20px;
        }
    </style>
@endsection

@section('main')
    <div class="container">
        {{-- {!! $test !!} --}}
        <x-markdown theme="github-dark">
            {{ $note }}
        </x-markdown>
    </div>
@endsection

@section('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
@endsection
