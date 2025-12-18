@extends('layouts.app')

@section('title', 'Jawaban Mahasiswa')

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}" class="active">Jawaban Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Jawaban Mahasiswa</h1>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NIM Mahasiswa</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Periode</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jawaban as $j)
                    <tr>
                        <td>{{ $j->nim }}</td>
                        <td>{{ $j->pertanyaan->pertanyaan }}</td>
                        <td>{{ $j->pilihanJawaban->deskripsi_pilihan }}</td>
                        <td>{{ $j->periode->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
