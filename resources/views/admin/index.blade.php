@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header">

            <h3>
                <i class="fa-solid fa-user-shield"></i>
                Admin Management
            </h3>

            <a href="/admin/create" class="btn-add">
                <i class="fa-solid fa-plus"></i>
                Tambah Admin
            </a>

        </div>


        <div class="table-wrapper">

            <table class="admin-table">

                <thead>

                    <tr>
                        <th width="70">ID</th>
                        <th>Name</th>
                        <th width="260">Email</th>
                        <th width="120">Status</th>
                        <th width="140">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($admins as $admin)
                        <tr>

                            <td>
                                <strong>#{{ $admin->id }}</strong>
                            </td>

                            <td>
                                <div class="admin-name">
                                    {{ $admin->name }}
                                </div>
                            </td>

                            <td class="wrap">
                                {{ $admin->email }}
                            </td>

                            <td>

                                @if ($admin->status == 1)
                                    <span class="badge badge-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            <td>

                                <div class="actions">

                                    <button class="btn-icon edit"
                                        onclick="openEditModal(
'{{ $admin->id }}',
'{{ $admin->name }}',
'{{ $admin->email }}',
'{{ $admin->status }}'
)">

                                        <i class="fa-solid fa-pen"></i>

                                    </button>


                                    <form id="delete-form-{{ $admin->id }}"
                                        action="{{ route('admin.destroy', $admin->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn-icon delete"
                                            onclick="deleteAdmin({{ $admin->id }})">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>



    {{-- ===========================
EDIT MODAL
=========================== --}}

    <div id="editModal" class="modal">

        <div class="modal-content">

            <h3>Edit Admin</h3>

            <form id="editForm" method="POST">

                @csrf

                <input type="text" name="name" id="edit_name" class="form-control" placeholder="Name" required>

                <input type="email" name="email" id="edit_email" class="form-control" placeholder="Email" required>

                <input type="password" name="password" class="form-control" placeholder="Password baru (opsional)">

                <select name="status" id="edit_status" class="form-control">

                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>

                <div class="modal-actions">

                    <button class="btn-update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update
                    </button>

                    <button type="button" onclick="closeModal()" class="btn-cancel">
                        Cancel
                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- ===========================
STYLE
=========================== --}}

    <style>
        .table-wrapper {
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            background: #1f2c40;
            color: #fff;
            padding: 14px;
            text-align: left;
        }

        .admin-table td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .wrap {
            word-break: break-word;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        .badge-success {
            background: #22c55e;
            color: #fff;
        }

        .badge-danger {
            background: #ef4444;
            color: #fff;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 6px;
            background: #f3f4f6;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon.edit {
            color: #f59e0b;
        }

        .btn-icon.delete {
            color: #ef4444;
        }

        .btn-add {
            background: #3b82f6;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
    </style>



    {{-- ===========================
SCRIPT
=========================== --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openEditModal(id, name, email, status) {

            document.getElementById('editModal').style.display = 'flex'

            document.getElementById('edit_name').value = name
            document.getElementById('edit_email').value = email
            document.getElementById('edit_status').value = status

            document.getElementById('editForm').action = "/admin/update/" + id

        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none'
        }


        function deleteAdmin(id) {

            Swal.fire({
                title: 'Delete Admin?',
                text: 'Data tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('delete-form-' + id).submit()

                }

            })

        }
    </script>
@endsection
