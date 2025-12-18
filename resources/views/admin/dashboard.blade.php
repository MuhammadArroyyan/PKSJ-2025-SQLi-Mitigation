@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
    <a href="{{ route('admin.users.index') }}">Kelola User</a>
    <a href="{{ route('admin.fakultas.index') }}">Kelola Fakultas</a>
    <a href="{{ route('admin.jurusan.index') }}">Kelola Jurusan</a>
    <a href="{{ route('admin.prodi.index') }}">Kelola Prodi</a>
    <a href="{{ route('admin.mahasiswa.index') }}">Kelola Mahasiswa</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="{{ route('profile.change-password') }}" style="color: #e74c3c;">Ubah Password</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Dashboard Admin</h1>
    </div>
    
    <div class="card">
        <h2>Selamat Datang</h2>
        <p>Anda login sebagai Admin. Gunakan menu di samping untuk mengelola aplikasi kuisioner.</p>
    </div>
@endsection
