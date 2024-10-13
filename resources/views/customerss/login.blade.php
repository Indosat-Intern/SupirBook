@extends('layouts.layout')

@section('title', 'SupirBook - Login')

@section('content')
    <div class="login-container">
        <h2>Log in</h2>
        <form method="POST" action="{{ route('customer.login') }}" class="login-box">
            @csrf
            <div class="input-group">
                <input id="email" type="email" name="email" placeholder="Email" required autofocus>
            </div>
            <div class="input-group">
                <input id="password" name="password" type="password" placeholder="Password" required>
            </div>
            <button type="submit" class="login-button">Log in</button>
            <p class="register-link">Don't Have an Account? <a href="{{ route('customer.register') }}">Register</a></p>
        </form>
    </div>
@endsection
