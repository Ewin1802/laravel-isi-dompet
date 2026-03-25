@extends('layouts.app')

@section('content')
    <div class="dashboard-grid">

        <!-- ADMIN CARD -->

        <div class="dashboard-card blue">

            <div class="card-icon">
                <i class="fa-solid fa-user-shield"></i>
            </div>

            <div>
                <p class="card-title">Total Admin</p>
                <h2>{{ \App\Models\Admin::count() }}</h2>
            </div>

        </div>


        <div class="dashboard-card green">

            <div class="card-icon">
                <i class="fa-solid fa-user-check"></i>
            </div>

            <div>
                <p class="card-title">Active Admin</p>
                <h2>{{ \App\Models\Admin::where('status', 1)->count() }}</h2>
            </div>

        </div>


        <div class="dashboard-card orange">

            <div class="card-icon">
                <i class="fa-solid fa-user-xmark"></i>
            </div>

            <div>
                <p class="card-title">Inactive Admin</p>
                <h2>{{ \App\Models\Admin::where('status', 0)->count() }}</h2>
            </div>

        </div>


        <!-- USER CARD -->

        <div class="dashboard-card purple">

            <div class="card-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>
                <p class="card-title">Total Users</p>
                <h2>{{ \App\Models\User::count() }}</h2>
            </div>

        </div>


        <div class="dashboard-card teal">

            <div class="card-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <p class="card-title">Member</p>
                <h2>{{ \App\Models\User::where('role', 'member')->count() }}</h2>
            </div>

        </div>


        <div class="dashboard-card pink">

            <div class="card-icon">
                <i class="fa-solid fa-user-gear"></i>
            </div>

            <div>
                <p class="card-title">User Role</p>
                <h2>{{ \App\Models\User::where('role', 'user')->count() }}</h2>
            </div>

        </div>

    </div>



    <!-- BOTTOM SECTION -->

    <div class="dashboard-bottom">

        <!-- RECENT ADMIN -->

        <div class="activity-card">

            <h3>
                <i class="fa-solid fa-user-shield"></i>
                Recent Admin
            </h3>

            <table class="table">

                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>

                @foreach (\App\Models\Admin::latest()->take(5)->get() as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                    </tr>
                @endforeach

            </table>

        </div>



        <!-- RECENT USER -->

        <div class="activity-card">

            <h3>
                <i class="fa-solid fa-users"></i>
                Recent Users
            </h3>

            <table class="table">

                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Role</th>
                </tr>

                @foreach (\App\Models\User::latest()->take(5)->get() as $user)
                    <tr>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->phone }}</td>

                        <td>

                            <span class="badge {{ $user->role == 'member' ? 'badge-success' : 'badge-primary' }}">
                                {{ ucfirst($user->role) }}

                            </span>

                        </td>

                    </tr>
                @endforeach

            </table>

        </div>

    </div>
@endsection
