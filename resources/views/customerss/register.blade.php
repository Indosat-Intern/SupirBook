@extends('layouts.layout')

@section('title', 'SupirBook - Register')

@section('content')
    <div class="login-container">
        <h2>Sign Up</h2>
        <form class="login-box" method="POST" action="{{ route('customer.register') }}">
            @csrf
            <div class="input-group">
                <input id="name" type="text" name="name" required autofocus placeholder="Name">
            </div>
            <div class="input-group">
                <input id="email" type="email" name="email" required placeholder="Email">
            </div>
            <div class="input-group">
                <input id="password" type="password" name="password" required placeholder="Password">
            </div>
            <div class="input-group">
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm Password">
            </div>
            <div class="input-group">
                <input id="division" type="text" name="division" required placeholder="Division">
            </div>
            <div class="input-group">
                <input id="phone" type="text" name="phone" required placeholder="Phone">
            </div>
            <button type="submit" class="register-button">Register</button>
            <p class="login-link">Already Have an Account? <a href="{{ route('customer.login') }}">Log in</a></p>
        </form>
    </div>
@endsection
