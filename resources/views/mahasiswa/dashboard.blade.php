@extends('layouts.app')

@section('title', 'Mahasiswa Dashboard')

@section('sidebar')
    <a href="{{ route('mahasiswa.dashboard') }}" class="active">Dashboard</a>
    <a href="{{ route('mahasiswa.kuisioner.list') }}">Daftar Kuisioner</a>
    <hr style="margin: 10px 0; border: none; border-top: 1px solid #ddd;">
    <a href="{{ route('profile.change-password') }}" style="color: #e74c3c;">Ubah Password</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Dashboard Mahasiswa</h1>
    </div>
    
    <div class="card">
        <h2>Informasi Diri</h2>
        <p><strong>NIM:</strong> {{ $mahasiswa->nim ?? 'N/A' }}</p>
        <p><strong>Nama:</strong> {{ $mahasiswa->nama_mahasiswa ?? 'N/A' }}</p>
        <p><strong>Program Studi:</strong> {{ $mahasiswa->prodi->nama_prodi ?? 'N/A' }}</p>
    </div>
    
    <div class="card">
        <h2>Periode Pengisian Kuisioner</h2>
        @forelse($periode as $p)
            <div style="padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px;">
                <h3>{{ $p->keterangan }}</h3>
                <p>Status: <strong>{{ ucfirst($p->status_periode) }}</strong></p>
                <a href="{{ route('mahasiswa.kuisioner.show', $p->id_periode) }}" class="btn">Lihat Kuisioner</a>
            </div>
        @empty
            <p>Tidak ada periode kuisioner yang aktif</p>
        @endforelse
    </div>
@endsection
