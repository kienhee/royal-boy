@extends('layouts.client.index')
@section('title', 'Login')
@section('content')
<div class="container mt-5 mb-5">

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="contact__form">
                <h5 class="text-center">Login</h5>
                <form action="{{route('client.handleLogin')}}" method="POST">
                    @csrf
                    <div>
                        <label for="email">Email:</label>
                        <input type="text" id="email" placeholder="Your email address" class="mb-0" name="email"
                            value="{{  old('email') ?? Session()->get('emailRegister') }}" autofocus>
                        @error('email')
                        <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="mb-0"
                            placeholder="&#42;&#42;&#42;&#42;&#42;">
                        @error('password')
                        <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex algin-items-center mb-3">
                            <input type="checkbox" id="remember" class="mb-0" name="remember"
                                style="width: 15px;height:auto">
                            <label for="remember" class="mb-0 ml-2">Remember me</label>
                        </div>
                        <a href="#" class="text-danger">Forgot your password?</a>
                    </div>

                    <button type="submit" class="site-btn w-100 mb-2">Login</button>
                    <a href="{{route('client.register')}}" class="text-center d-block text-danger">Don't have an
                        account?</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection