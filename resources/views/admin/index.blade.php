@extends('layouts.app')

@section('title', 'Admin')

@section('content')

    <div class="card users-card">

        <div class="card-header">
            <h2>Admin</h2>

            <div class="header-actions">
                <span class="total">{{ $admins->count() }} data</span>

                <button class="btn-primary-add" id="openModal">
                    <i class="fa-solid fa-plus"></i> Tambah Admin
                </button>
            </div>
        </div>

        <div class="table-wrapper">

            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="name">{{ $admin->name }}</td>
                            <td class="email">{{ $admin->email }}</td>

                            <td>
                                <span class="badge-status {{ $admin->status ? 'active' : 'inactive' }}">
                                    {{ $admin->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <form action="/admin/{{ $admin->id }}" method="POST" class="form-delete">
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


    {{-- ================= MODAL ================= --}}
    <div class="modal" id="adminModal">

        <div class="modal-content">

            <div class="modal-header">
                <h3>Tambah Admin</h3>
                <button id="closeModal">&times;</button>
            </div>

            <form action="/admin" method="POST" class="modal-body">
                @csrf

                <input type="text" name="name" placeholder="Nama" required>

                <input type="email" name="email" placeholder="Email" required>

                <input type="password" name="password" placeholder="Password" required>

                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

                <button class="btn-submit">Simpan</button>
            </form>

        </div>

    </div>


    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // DELETE
        document.querySelectorAll('.form-delete').forEach(form => {

            form.querySelector('.btn-delete').addEventListener('click', function() {

                Swal.fire({
                    title: 'Hapus admin?',
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

        // MODAL
        const modal = document.getElementById('adminModal');
        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');

        openBtn.onclick = () => modal.classList.add('show');
        closeBtn.onclick = () => modal.classList.remove('show');

        window.onclick = (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        };
    </script>

    {{-- SUCCESS --}}
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
