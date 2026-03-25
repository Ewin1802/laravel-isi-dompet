@extends('layouts.app')

@section('content')
    <div class="card">

        <h2>Tambah Admin</h2>

        <form method="POST" action="/admin/store">

            @csrf

            <input type="text" name="name" placeholder="Name" class="form-control">

            <input type="email" name="email" placeholder="Email" class="form-control">

            <input type="password" name="password" placeholder="Password" class="form-control">

            <select name="status" class="form-control">

                <option value="1">Active</option>
                <option value="0">Inactive</option>

            </select>

            <button class="btn btn-success">Simpan</button>

        </form>

    </div>
@endsection
