@extends('layouts.app')

@section('content')
    {{-- Create a login form --}}
    <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                        <div class="card-body">
                            <form method="POST" action="/authorization" enctype="multipart/form-data">
                                @csrf
                                {{-- Create a little window --}}
                                <div class="form-group">
                                    <ul style="list-style: none" class="col-md-6 offset-md-3">
                                        <li style="text-align: center">Email: test@gmail.com</li>
                                        <li style="text-align: center">Password: password</li>
                                    </ul>

                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-5 ml-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6 offset-md-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 ml-5  col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6 offset-md-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Create a submit button --}}
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

