@extends('layouts.app')

@section('title', 'Pertanyaan')

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}" class="active">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}">Jawaban Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Pertanyaan</h1>
        <div class="page-header-actions">
            <a href="{{ route('kaprodi.pertanyaan.create') }}" class="btn">Buat Pertanyaan</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pertanyaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pertanyaan as $p)
                    <tr>
                        <td>{{ $p->id_pertanyaan }}</td>
                        <td>{{ $p->pertanyaan }}</td>
                        <td>
                            <a href="{{ route('kaprodi.pertanyaan.edit', $p->id_pertanyaan) }}" class="btn">Edit</a>
                            <form action="{{ route('kaprodi.pertanyaan.destroy', $p->id_pertanyaan) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
