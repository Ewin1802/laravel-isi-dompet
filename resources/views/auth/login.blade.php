<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="auth-container">

    <div class="auth-left">

        <div class="auth-left-content">

            <h1>Admin Panel</h1>

            <p>
                Kelola data admin dan sistem menggunakan dashboard modern.
            </p>

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

        </div>

    </div>

    <div class="auth-right">

        <div class="auth-card">

            <h2>Login Admin</h2>

            @if ($errors->any())
                <p style="color:red">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <input type="email" name="email" class="form-control" placeholder="Email" required>

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
