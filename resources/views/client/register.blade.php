@extends('layouts.client.index')
@section('title', 'Register')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="contact__form">
                <h5 class="text-center">Register</h5>
                <form action="{{route('client.handleRegister')}}" method="post">
                    @csrf
                    <div>
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" placeholder="Your full name" class="mb-0" name="full_name"
                            value="{{ old('full_name') }}" autofocus>
                        @error('full_name')
                        <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email">Email:</label>
                        <input type="text" id="email" placeholder="Your email address" class="mb-0" name="email"
                            value="{{ old('email') }}" autofocus>
                        @error('email')
                        <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="phone_number">Phone number:</label>
                        <input type="text" id="phone_number" placeholder="Your phone number " class="mb-0"
                            name="phone_number" value="{{ old('phone_number') }}" autofocus>
                        @error('phone_number')
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
                    <div class="mt-3">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="mb-0"
                            placeholder="&#42;&#42;&#42;&#42;&#42;">
                        @error('password_confirmation')
                        <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>




                    <button type="submit" class="site-btn w-100 mb-2 mt-3">Register</button>
                    <a href="{{route('client.login')}}" class="text-center d-block text-danger">Already have an
                        account?</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection