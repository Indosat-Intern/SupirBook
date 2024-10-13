@extends('layouts.layout')

@section('title', 'SupirBook - Home')

@section('content')
    <h1>Book Your <span class="highlight">Driver</span></h1>
    <section class="drivers">
        <article class="driver-card">
            <img src="{{ asset('img/hendro.jpg') }}" alt="Pak Hendro" class="driver-photo">
            <div class="driver-info">
                <h2>Pak Hendro</h2>
                <p>Available</p>
            </div>
        </article>
        <article class="driver-card">
            <img src="{{ asset('img/heri.jpg') }}" alt="Pak Heri" class="driver-photo">
            <div class="driver-info">
                <h2>Pak Heri</h2>
                <p>Available</p>
            </div>
        </article>
        <article class="driver-card">
            <img src="{{ asset('img/sandy.jpg') }}" alt="Pak Sandy" class="driver-photo">
            <div class="driver-info">
                <h2>Pak Sandy</h2>
                <p>Available</p>
            </div>
        </article>
    </section>
    @auth('customer')
        <a href="{{ route('booking.index') }}" class="book-btn">BOOK NOW!!!</a>
    @else
        <a href="{{ route('customer.login') }}" class="book-btn">BOOK NOW!!!</a>
    @endauth
@endsection