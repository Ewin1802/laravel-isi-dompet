@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="dashboard-grid">

        {{-- ADMIN --}}
        <x-dashboard.card color="blue" icon="fa-user-shield" title="Total Admin" :value="$totalAdmin" />

        {{-- USER --}}
        <x-dashboard.card color="purple" icon="fa-users" title="Total Users" :value="$totalUser" />

    </div>

    {{-- BOTTOM --}}
    <div class="dashboard-bottom">

        {{-- ADMIN --}}
        <div class="activity-card">
            <h3><i class="fa-solid fa-user-shield"></i> Recent Admin</h3>

            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>

                @foreach ($recentAdmins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- USER --}}
        <div class="activity-card">
            <h3><i class="fa-solid fa-users"></i> Recent Users</h3>

            <table class="table">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Role</th>
                </tr>

                @foreach ($recentUsers as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default.png') }}"
                                class="avatar" alt="photo"
                                onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
                        </td>
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
