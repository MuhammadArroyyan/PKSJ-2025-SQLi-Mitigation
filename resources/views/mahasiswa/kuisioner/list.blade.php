@extends('layouts.app')

@section('title', 'Daftar Kuisioner')

@section('sidebar')
    <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
    <a href="{{ route('mahasiswa.kuisioner.list') }}" class="active">Daftar Kuisioner</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Daftar Kuisioner</h1>
    </div>
    
    <div class="card">
        @forelse($periode as $p)
            <div style="padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px;">
                <h3>{{ $p->keterangan }}</h3>
                <p>Status: <strong>{{ ucfirst($p->status_periode) }}</strong></p>
                @if($p->status_periode === 'active')
                    <a href="{{ route('mahasiswa.kuisioner.show', $p->id_periode) }}" class="btn">Isi Kuisioner</a>
                @else
                    <button class="btn" disabled>Tidak Aktif</button>
                @endif
            </div>
        @empty
            <p>Tidak ada periode kuisioner</p>
        @endforelse
    </div>
@endsection
