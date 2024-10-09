<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@3.0.1/modern-normalize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Form Booking Driver</title>
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
                                <button type="submit"
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
        <section class="booking-form-container">
            <div class="driver-photo-container">
                <img src="img/heri.jpg" alt="Driver Photo">
            </div>
            <form method="POST" action="{{ route('booking.store') }}" class="booking-form">
                @csrf
                <h2>Form Booking <span>Driver</span></h2>
                <div class="input-group">
                    <label for="name"></label>
                    <input type="text" id="name" placeholder="Nama" value="{{ auth('customer')->user()->name }}"
                        required>
                </div>
                <div class="input-group">
                    <label for="driver_id"></label>
                    <select id="driver_id" name="driver_id" required>
                        <option value="">Select a driver</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <label for="destination"></label>
                    <input type="text" id="destination" name="destination" placeholder="Tujuan" required>
                </div>
                <div class="input-group">
                    <label for="pickup_location"></label>
                    <input type="text" id="pickup_location" name="pickup_location" placeholder="Titik Jemput"
                        required>
                </div>
                <div class="input-group">
                    <label for="booking_datetime"></label>
                    <input type="datetime-local" id="booking_datetime" name="booking_datetime" required>
                </div>
                <div class="input-group">
                    <label for="customer_division"></label>
                    <input type="text" id="customer_division" name="customer_division" placeholder="Divisi"
                        value="{{ auth('customer')->user()->division }}" required>
                </div>
                <div class="input-group">
                    <label for="customer_phone"></label>
                    <input type="tel" id="customer_phone" name="customer_phone" placeholder="Nomor Telepone"
                        value="{{ auth('customer')->user()->phone }}" required>
                </div>
                <div class="input-group">
                    <label for="passenger"></label>
                    <input type="number" id="passenger" name="passenger" placeholder="Jumlah Penumpang" required>
                </div>
                <button type="submit" class="submit-button">Submit</button>
            </form>

        </section>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </main>

    <footer>
        <p>SupirBook by Indosat Ooredoo Hutchison. &copy;2024</p>
    </footer>
</body>

</html>
