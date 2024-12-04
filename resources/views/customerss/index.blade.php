@extends('layouts.layout')

@section('title', 'SupirBook - Home')

@section('content')
    <h1>Book Your <span class="highlight">Driver</span></h1>
    @if ($drivers->isEmpty())
        <p>No drivers available.</p>
    @else
        <section class="drivers">
            @foreach ($drivers as $driver)
                <article class="driver-card">
                    <img src="{{ $driver->photo ? Storage::url($driver->photo) : asset('img/default-driver.jpg') }}"
                        alt="{{ $driver->name }}" class="driver-photo">
                    <div class="driver-info">
                        <h2>{{ $driver->name }}</h2>
                        <p>{{ ucfirst($driver->status) }}</p>
                        @auth('customer')
                            <a href="{{ route('booking.index', ['driver_id' => $driver->id]) }}" class="book-btn">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('customer.login') }}" class="book-btn">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endauth
                    </div>
                </article>
            @endforeach
        </section>
    @endif

@endsection
