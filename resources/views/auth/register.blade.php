<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="auth-container">

    <div class="auth-left">
        <div class="auth-left-content">

            <h1>Register Admin</h1>

            <p>
                Buat akun admin baru untuk mengelola sistem.
            </p>

            <img src="https://cdn-icons-png.flaticon.com/512/2922/2922510.png">

        </div>
    </div>

    <div class="auth-right">

        <div class="auth-card">

            <h2>Register</h2>

            @if ($errors->any())
                <p style="color:red">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <input type="text" name="name" placeholder="Name" class="form-control" required>

                <input type="text" name="phone" placeholder="Phone Number" class="form-control" required>

                <input type="email" name="email" placeholder="Email (optional)" class="form-control">

                <div style="position:relative">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        class="form-control"
                        required>

                    <span onclick="togglePassword('password')"
                        style="position:absolute; right:15px; top:12px; cursor:pointer;">
                        👁
                    </span>

                </div>

                <div style="position:relative">

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        class="form-control"
                        required>

                    <span onclick="togglePassword('password_confirmation')"
                        style="position:absolute; right:15px; top:12px; cursor:pointer;">
                        👁
                    </span>

                </div>

                <button class="btn btn-primary">
                    Register
                </button>

            </form>

            <div class="auth-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login</a>
            </div>

        </div>

    </div>

</div>

<script>
function togglePassword(id) {

    let input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }

}
</script>
