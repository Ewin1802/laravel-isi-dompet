@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <div class="card users-card">

        <div class="card-header">
            <h2>Users</h2>
            <span class="total">{{ $users->count() }} data</span>
        </div>

        <div class="table-wrapper">

            <table class="table-modern">

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="name">{{ $user->name }}</td>

                            <td class="email">{{ $user->email ?? '-' }}</td>

                            <td>
                                <span class="badge-role {{ $user->role }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <form action="/users/{{ $user->id }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn-delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {

            form.querySelector('.btn-delete').addEventListener('click', function() {

                Swal.fire({
                    title: 'Hapus user?',
                    text: "Data tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });

            });

        });
    </script>

    {{-- SUCCESS NOTIF --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

@endsection
