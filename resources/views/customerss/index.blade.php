<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Modern Normalize CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@3.0.1/modern-normalize.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>SupirBook</title>
</head>

<body>
    <header>
        <div class="logo">
            <span class="supir">Supir</span><span class="book">Book</span><span class="by">by</span>
            <img src="{{ asset('img/Indosat Ooredoo Hutchison Logo.png') }}" alt="Indosat Ooredoo Hutchison Logo">
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('welcome') }}">Home</a></li> <!-- Assuming you have a route named 'welcome' -->

                @if (Route::has('customer.login')) <!-- Ensure the route exists -->
                    @auth('customer')
                        <!-- Check if the customer is authenticated -->
                        <li><a href="#">Hii, <span
                                    class="user-name">{{ Auth::guard('customer')->user()->name }}</span></a></li>
                        <li>
                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button type="submit" {{-- class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white" --}}
                                    style="background: none;border: none;padding: 0;font-family: inherit;font-size: inherit;cursor: pointer;text-decoration: none;color: #333;font-weight: 700;transition: color 0.3s;">
                                    Log out
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('customer.login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Log in
                            </a>
                        </li>

                        @if (Route::has('customer.register'))
                            <li>
                                <a href="{{ route('customer.register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Register
                                </a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>
    </header>

    <main>
        <h1>Book Your <span class="highlight">Driver</span></h1>

        <section class="drivers">
            <!-- Pak Hendro -->
            <article class="driver-card">
                <img src="{{ asset('img/hendro.jpg') }}" alt="Pak Hendro" class="driver-photo">
                <div class="driver-info">
                    <h2>Pak Hendro</h2>
                    <p>Available</p>
                    {{-- <button class="book-btn"> --}}
                    {{-- <i class="fas fa-arrow-right"></i> --}}
                    {{-- </button> --}}
                </div>
            </article>

            <!-- Pak Heri -->
            <article class="driver-card">
                <img src="{{ asset('img/heri.jpg') }}" alt="Pak Heri" class="driver-photo">
                <div class="driver-info">
                    <h2>Pak Heri</h2>
                    <p>Available</p>
                    {{-- <button class="book-btn"> --}}
                    {{-- <i class="fas fa-arrow-right"></i> --}}
                    {{-- </button> --}}
                </div>
            </article>

            <!-- Pak Sandy -->
            <article class="driver-card">
                <img src="{{ asset('img/sandy.jpg') }}" alt="Pak Sandy" class="driver-photo">
                <div class="driver-info">
                    <h2>Pak Sandy</h2>
                    <p>Available</p>
                    {{-- <button class="book-btn"> --}}
                    {{-- <i class="fas fa-arrow-right"></i> --}}
                    {{-- </button> --}}
                </div>
            </article>
        </section>
        {{-- <button class="book-btn">BOOK NOW!!!</button> --}}
        @auth('customer')
            <a href="{{ route('booking.index') }}" class="book-btn" style="text-decoration: none;">BOOK NOW!!!</a>
        @else
            <a href="{{ route('customer.login') }}" class="book-btn" style="text-decoration: none;">BOOK NOW!!!</a>
        @endauth
    </main>

    <footer>
        <p>SupirBook by Indosat Ooredoo Hutchison. &copy;2024</p>
    </footer>
</body>

</html>
