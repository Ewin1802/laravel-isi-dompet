<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .auth-wrapper {
            height: 100vh;
            display: flex;
        }

        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .auth-card h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #3b82f6;
            border: none;
            color: white;
            border-radius: 6px;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        @media(max-width:768px) {
            .auth-left {
                display: none;
            }
        }
    </style>

</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-left">

            <img src="{{ asset('logo.png') }}" class="auth-logo" alt="logo">

            <h1>ADMIN PANEL | JURNALDOI</h1>
            <p>Manage your system professionally</p>

        </div>

        <div class="auth-right">

            <div class="auth-card">
                <h2>Login</h2>

                <form method="POST" action="/login">
                    @csrf

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password">
                    </div>

                    <button type="submit">Login</button>
                </form>

            </div>

        </div>

    </div>

</body>

</html>
