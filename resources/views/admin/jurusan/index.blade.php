@extends('layouts.app')

@section('title', 'Kelola Jurusan')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.users.index') }}">Kelola User</a>
    <a href="{{ route('admin.fakultas.index') }}">Kelola Fakultas</a>
    <a href="{{ route('admin.jurusan.index') }}" class="active">Kelola Jurusan</a>
    <a href="{{ route('admin.prodi.index') }}">Kelola Prodi</a>
    <a href="{{ route('admin.mahasiswa.index') }}">Kelola Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Kelola Jurusan</h1>
        <div class="page-header-actions">
            <a href="{{ route('admin.jurusan.create') }}" class="btn">Tambah Jurusan</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jurusan</th>
                    <th>Fakultas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jurusan as $j)
                    <tr>
                        <td>{{ $j->id_jurusan }}</td>
                        <td>{{ $j->nama_jurusan }}</td>
                        <td>{{ $j->fakultas->nama_fakultas }}</td>
                        <td>
                            <a href="{{ route('admin.jurusan.edit', $j->id_jurusan) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.jurusan.destroy', $j->id_jurusan) }}" method="POST" style="display: inline;">
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
