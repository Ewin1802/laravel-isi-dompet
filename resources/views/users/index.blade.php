@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header">
            <h3>
                <i class="fa-solid fa-users"></i>
                User Management
            </h3>
        </div>


        <div class="table-wrapper">

            <table class="user-table">

                <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th>Name</th>
                        <th width="160">Phone</th>
                        <th width="200">Email</th>
                        <th width="120">Role</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $user)
                        <tr>

                            <td>
                                <strong>#{{ $user->id }}</strong>
                            </td>

                            <td>

                                <div class="user-name">

                                    <div class="name">
                                        {{ $user->name }}
                                    </div>

                                    <div class="member-id">
                                        <i class="fa-solid fa-id-card"></i>
                                        {{ $user->member_id ?? '-' }}
                                    </div>

                                </div>

                            </td>

                            <td class="wrap">
                                {{ $user->phone }}
                            </td>

                            <td class="wrap">
                                {{ $user->email ?? '-' }}
                            </td>

                            <td>

                                <span class="badge {{ $user->role == 'member' ? 'badge-success' : 'badge-primary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>

                            </td>

                            <td>

                                <div class="actions">

                                    <button class="btn-icon view"
                                        onclick="openViewModal(
'{{ $user->member_id }}',
'{{ $user->name }}',
'{{ $user->phone }}',
'{{ $user->email }}',
'{{ $user->role }}',
'{{ $user->photo }}'
)">

                                        <i class="fa-solid fa-eye"></i>

                                    </button>

                                    <button class="btn-icon edit"
                                        onclick="openEditModal(
'{{ $user->id }}',
'{{ $user->name }}',
'{{ $user->phone }}',
'{{ $user->email }}',
'{{ $user->role }}'
)">

                                        <i class="fa-solid fa-pen"></i>

                                    </button>

                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('users.delete', $user->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn-icon delete"
                                            onclick="deleteUser({{ $user->id }})">

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



    {{-- =================================
VIEW MODAL
================================= --}}

    <div id="viewModal" class="modal">

        <div class="modal-content profile-modal">

            <div class="profile-header">

                <img id="view_photo" class="profile-photo">

                <h3 id="view_name"></h3>

                <span id="view_role" class="badge"></span>

            </div>


            <div class="profile-body">

                <div class="info-row">
                    <i class="fa-solid fa-id-card"></i>
                    <label>Member ID</label>
                    <span id="view_member_id"></span>
                </div>

                <div class="info-row">
                    <i class="fa-solid fa-phone"></i>
                    <label>Phone</label>
                    <span id="view_phone"></span>
                </div>

                <div class="info-row">
                    <i class="fa-solid fa-envelope"></i>
                    <label>Email</label>
                    <span id="view_email"></span>
                </div>

            </div>


            <div class="modal-actions">

                <button onclick="closeViewModal()" class="btn-cancel">
                    Close
                </button>

            </div>

        </div>

    </div>



    {{-- =================================
EDIT MODAL
================================= --}}

    <div id="editModal" class="modal">

        <div class="modal-content">

            <h3>Edit User</h3>

            <form id="editForm" method="POST">

                @csrf

                <input type="text" name="name" id="edit_name" class="form-control" placeholder="Name" required>

                <input type="text" name="phone" id="edit_phone" class="form-control" placeholder="Phone" required>

                <input type="email" name="email" id="edit_email" class="form-control" placeholder="Email">

                <input type="password" name="password" class="form-control" placeholder="Password baru (opsional)">

                <select name="role" id="edit_role" class="form-control">

                    <option value="member">Member</option>
                    <option value="user">User</option>

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



    {{-- =================================
STYLE
================================= --}}

    <style>
        .table-wrapper {
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th {
            background: #1f2c40;
            color: #fff;
            padding: 14px;
            text-align: left;
        }

        .user-table td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .wrap {
            word-break: break-word;
        }

        .user-name .name {
            font-weight: 600;
        }

        .member-id {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }

        .member-id i {
            margin-right: 5px;
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

        .badge-primary {
            background: #3b82f6;
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

        .btn-icon.view {
            color: #0ea5e9
        }

        .btn-icon.edit {
            color: #f59e0b
        }

        .btn-icon.delete {
            color: #ef4444
        }

        .profile-modal {
            width: 360px;
            text-align: center;
        }

        .profile-header {
            margin-bottom: 20px;
        }

        .profile-photo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-body {
            margin-top: 25px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 40px 130px 1fr;
            align-items: start;
            gap: 12px;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row i {
            font-size: 18px;
            color: #555;
            margin-top: 3px;
        }

        .info-row label {
            font-weight: 600;
            color: #444;
            text-align: left;
        }

        .info-row span {
            text-align: left;
            color: #333;
            word-break: break-word;
            line-height: 1.5;
        }
    </style>



    {{-- =================================
SCRIPT
================================= --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openEditModal(id, name, phone, email, role) {

            document.getElementById('editModal').style.display = 'flex'

            document.getElementById('edit_name').value = name
            document.getElementById('edit_phone').value = phone
            document.getElementById('edit_email').value = email
            document.getElementById('edit_role').value = role

            document.getElementById('editForm').action = "/users/update/" + id

        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none'
        }

        function openViewModal(member_id, name, phone, email, role, photo) {

            document.getElementById('viewModal').style.display = 'flex'

            document.getElementById('view_member_id').innerText = member_id ?? '-'
            document.getElementById('view_name').innerText = name
            document.getElementById('view_phone').innerText = phone
            document.getElementById('view_email').innerText = email ?? '-'
            document.getElementById('view_role').innerText = role

            if (photo) {
                document.getElementById('view_photo').src = "/storage/" + photo
            } else {
                document.getElementById('view_photo').src = "https://ui-avatars.com/api/?name=" + name
            }

        }

        function closeViewModal() {
            document.getElementById('viewModal').style.display = 'none'
        }

        function deleteUser(id) {

            Swal.fire({
                title: 'Delete User?',
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
