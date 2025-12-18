@extends('layouts.app')

@section('title', 'Edit User')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.users.index') }}" class="active">Kelola User</a>
    <a href="{{ route('admin.fakultas.index') }}">Kelola Fakultas</a>
    <a href="{{ route('admin.jurusan.index') }}">Kelola Jurusan</a>
    <a href="{{ route('admin.prodi.index') }}">Kelola Prodi</a>
    <a href="{{ route('admin.mahasiswa.index') }}">Kelola Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Edit User</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_user">Nama User</label>
                <input type="text" id="nama_user" name="nama_user" required value="{{ old('nama_user', $user->nama_user) }}">
                @error('nama_user')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}">
                @error('email')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kaprodi" {{ old('role', $user->role) == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                    <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                </select>
                @error('role')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
