<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Isidompet</title>

    {{-- FAVICON (icon di tab browser) --}}
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="auth-container">

        <div class="auth-left">

            <div class="auth-left-content">

                <h1>Admin Panel</h1>

                <p>
                    Kelola data admin dan sistem menggunakan dashboard modern.
                </p>

                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Illustration">

            </div>

        </div>

        <div class="auth-right">

            <div class="auth-card">

                {{-- LOGO DI ATAS FORM --}}
                <img src="{{ asset('logo.png') }}" class="logo" alt="Logo">

                <h2>Login Admin</h2>

                @if ($errors->any())
                    <p style="color:red">{{ $errors->first() }}</p>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <input type="text" name="login" class="form-control" placeholder="Email atau Nomor HP (08xxxx)"
                        required>

                    <input type="password" name="password" class="form-control" placeholder="Password" required>

                    <button class="btn btn-primary">
                        Login
                    </button>
                </form>

                <div class="auth-link">
                Belum punya akun? <a href="{{ route('register') }}">Register</a>
            </div>

            </div>

        </div>

    </div>

</body>

</html>
