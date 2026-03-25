<!DOCTYPE html>
<html>

<head>

    <title>Admin Panel</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <div class="layout">

        <!-- SIDEBAR -->

        <div class="sidebar" id="sidebar">

            <div class="logo">
                <i class="fa-solid fa-layer-group"></i>
                Admin Panel
            </div>

            <ul>

                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">

                        <i class="fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>

                    </a>
                </li>

                <li>
                    <a href="/admin" class="{{ request()->is('admin*') ? 'active' : '' }}">

                        <i class="fa-solid fa-user-shield"></i>
                        <span>Admin</span>

                    </a>
                </li>

                <!-- USERS MENU -->
                <li>
                    <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">

                        <i class="fa-solid fa-users"></i>
                        <span>Users</span>

                    </a>
                </li>

                <li>

                    <form method="POST" action="/logout" class="logout-form">
                        @csrf

                        <button type="submit" class="logout-btn">

                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>

                        </button>

                    </form>

                </li>

            </ul>

        </div>


        <!-- MAIN -->

        <div class="main" id="main">

            <!-- NAVBAR -->

            <div class="navbar">

                <div class="menu-btn">
                    <i class="fa-solid fa-bars" id="menu-toggle"></i>
                </div>

                <div class="nav-user">
                    Admin
                </div>

            </div>


            <!-- CONTENT -->

            <div class="content">

                @yield('content')

            </div>

        </div>

    </div>


    <!-- TOGGLE SCRIPT -->

    <script>
        const toggleBtn = document.getElementById("menu-toggle");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", function() {

            sidebar.classList.toggle("sidebar-hide");

        });
    </script>


</body>

</html>
