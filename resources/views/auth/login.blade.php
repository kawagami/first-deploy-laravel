@extends('layouts.base')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('main.login.title')</div>
                    <div class="card-body">

                        {{-- Login with Google --}}
                        <div class="flex items-center justify-end mt-4">
                            <a class="btn" href="{{ route('google.login') }}"
                                style="background: #4285F4; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                                @lang('main.login.login-with', ['login' => 'Google'])
                            </a>
                        </div>
                        {{-- Login with GitHub --}}
                        <div class="flex items-center justify-end mt-4">
                            <a class="btn" href="{{ url('auth/github') }}"
                                style="background: #313131; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                                @lang('main.login.login-with', ['login' => 'GitHub'])
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
