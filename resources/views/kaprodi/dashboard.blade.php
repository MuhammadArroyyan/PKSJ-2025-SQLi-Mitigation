@extends('layouts.app')

@section('title', 'Kaprodi Dashboard')

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}" class="active">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}">Jawaban Mahasiswa</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="{{ route('profile.change-password') }}" style="color: #e74c3c;">Ubah Password</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Dashboard Kaprodi</h1>
    </div>
    
    <div class="card">
        <h2>Selamat Datang</h2>
        <p>Anda login sebagai Kaprodi untuk Program Studi: <strong>{{ $prodi->nama_prodi ?? 'N/A' }}</strong></p>
    </div>
@endsection
