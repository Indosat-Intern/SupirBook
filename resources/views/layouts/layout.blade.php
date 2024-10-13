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
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title', 'SupirBook')</title>
</head>

<body>
    <header>
        <div class="logo">
            <span class="supir">Supir</span><span class="book">Book</span><span class="by">by</span>
            <img src="{{ asset('img/Indosat Ooredoo Hutchison Logo.png') }}" alt="Indosat Ooredoo Hutchison Logo">
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('welcome') }}">Home</a></li>
                @auth('customer')
                    <li><a href="#">Hii, <span
                                class="user-name">{{ Auth::guard('customer')->user()->name }}</span></a></li>
                    <li>
                        <a href="{{ route('booking.history') }}">Booking</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('customer.logout') }}">
                            @csrf
                            <button type="submit"
                                style="background: none; border: none; padding: 0; font-family: inherit; font-size: inherit; cursor: pointer; color: #333; font-weight: 700;">
                                Log out
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('customer.login') }}">Log in</a></li>
                    <li><a href="{{ route('customer.register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        @yield('content') <!-- This is where individual page content will be inserted -->
    </main>

    <footer>
        <p>SupirBook by Indosat Ooredoo Hutchison. &copy;2024</p>
    </footer>
</body>

</html>
