@extends('layouts.app')

@section('title', 'Pimpinan Dashboard')

@section('sidebar')
    <a href="{{ route('pimpinan.dashboard') }}" class="active">Dashboard</a>
    <a href="{{ route('pimpinan.summary.index') }}">Summary Pengisian</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="{{ route('profile.change-password') }}" style="color: #e74c3c;">Ubah Password</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Dashboard Pimpinan</h1>
    </div>
    
    <div class="card">
        <h2>Selamat Datang</h2>
        <p>Anda login sebagai Pimpinan. Gunakan menu di samping untuk melihat summary pengisian kuisioner oleh mahasiswa.</p>
    </div>
@endsection
