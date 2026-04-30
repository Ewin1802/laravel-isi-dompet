<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="app">

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar">

            <div class="logo">
                <span class="logo-text">JurnalDoi</span>
            </div>

            <ul>

                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        data-title="Dashboard">
                        <i class="fa-solid fa-gauge"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}"
                        data-title="Users">
                        <i class="fa-solid fa-users"></i>
                        <span class="menu-text">Users</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}"
                        data-title="Admins">
                        <i class="fa-solid fa-user-shield"></i>
                        <span class="menu-text">Admins</span>
                    </a>
                </li>

            </ul>

        </aside>


        {{-- MAIN --}}
        <div class="main">

            {{-- HEADER --}}
            <header class="header">

                <div class="header-left">
                    <button id="toggleSidebar" class="menu-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h3>@yield('title')</h3>
                </div>

                <div class="header-right">

                    @php $user = auth()->user(); @endphp

                    <div class="user-dropdown" id="userDropdown">

                        <div class="user-trigger" id="dropdownTrigger">

                            <div class="user-info">
                                <span class="user-name">{{ $user->name }}</span>
                                <small class="user-role">{{ ucfirst($user->role ?? 'Admin') }}</small>
                            </div>

                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                        </div>

                        {{-- DROPDOWN --}}
                        <div class="dropdown-menu" id="dropdownMenu">

                            <div class="dropdown-header">
                                <strong>{{ $user->name }}</strong>
                                <small>{{ $user->email }}</small>
                            </div>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-user"></i> Profile
                            </a>

                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-gear"></i> Settings
                            </a>

                            <div class="dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item logout">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </header>

            <div class="content">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
