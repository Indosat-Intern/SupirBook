<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@3.0.1/modern-normalize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Register - SupirBook</title>
</head>
<body>
    <header>
        <!-- Header remains consistent across pages -->
        <div class="logo">
            <span class="supir">Supir</span><span class="book">Book</span><span class="by">by</span>
            <img src="img/Indosat Ooredoo Hutchison Logo.png" alt="Indosat Ooredoo Hutchison Logo">
        </div>
        <nav>
            <ul>
                <li><a href="login.html">Log In</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="login-container">
            <h2>Sign Up</h2>
            <form class="login-box">
                <div class="input-group">
                    <input type="text" placeholder="Name" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="register-button">Register</button>
                <p class="login-link">Already Have an Account? <a href="login.html">Log in</a></p>
            </form>
        </div>
    </main>

    <footer>
        <p>SupirBook by Indosat Ooredoo Hutchison. &copy;2024</p>
    </footer>
</body>
</html>
