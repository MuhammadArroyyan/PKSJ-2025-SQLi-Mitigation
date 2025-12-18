@extends('layouts.app')

@section('title', 'Kelola Fakultas')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.users.index') }}">Kelola User</a>
    <a href="{{ route('admin.fakultas.index') }}" class="active">Kelola Fakultas</a>
    <a href="{{ route('admin.jurusan.index') }}">Kelola Jurusan</a>
    <a href="{{ route('admin.prodi.index') }}">Kelola Prodi</a>
    <a href="{{ route('admin.mahasiswa.index') }}">Kelola Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Kelola Fakultas</h1>
        <div class="page-header-actions">
            <a href="{{ route('admin.fakultas.create') }}" class="btn">Tambah Fakultas</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Fakultas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fakultas as $f)
                    <tr>
                        <td>{{ $f->id_fakultas }}</td>
                        <td>{{ $f->nama_fakultas }}</td>
                        <td>
                            <a href="{{ route('admin.fakultas.edit', $f->id_fakultas) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.fakultas.destroy', $f->id_fakultas) }}" method="POST" style="display: inline;">
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
