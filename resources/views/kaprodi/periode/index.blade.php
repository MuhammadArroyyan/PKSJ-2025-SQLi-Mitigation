@extends('layouts.app')

@section('title', 'Periode Kuisioner')

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}" class="active">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}">Jawaban Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Periode Kuisioner</h1>
        <div class="page-header-actions">
            <a href="{{ route('kaprodi.periode.create') }}" class="btn">Buat Periode</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($periode as $p)
                    <tr>
                        <td>{{ $p->id_periode }}</td>
                        <td>{{ $p->keterangan }}</td>
                        <td>{{ ucfirst($p->status_periode) }}</td>
                        <td>
                            <a href="{{ route('kaprodi.periode.edit', $p->id_periode) }}" class="btn">Edit</a>
                            <form action="{{ route('kaprodi.periode.destroy', $p->id_periode) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
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
