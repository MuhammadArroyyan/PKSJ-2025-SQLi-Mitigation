@extends('layouts.app')

@section('title', 'Kelola Prodi')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.users.index') }}">Kelola User</a>
    <a href="{{ route('admin.fakultas.index') }}">Kelola Fakultas</a>
    <a href="{{ route('admin.jurusan.index') }}">Kelola Jurusan</a>
    <a href="{{ route('admin.prodi.index') }}" class="active">Kelola Prodi</a>
    <a href="{{ route('admin.mahasiswa.index') }}">Kelola Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Kelola Prodi</h1>
        <div class="page-header-actions">
            <a href="{{ route('admin.prodi.create') }}" class="btn">Tambah Prodi</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Prodi</th>
                    <th>Kaprodi</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prodi as $p)
                    <tr>
                        <td>{{ $p->id_prodi }}</td>
                        <td>{{ $p->nama_prodi }}</td>
                        <td>{{ $p->kaprodi->nama_user }}</td>
                        <td>{{ $p->jurusan->nama_jurusan }}</td>
                        <td>
                            <a href="{{ route('admin.prodi.edit', $p->id_prodi) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.prodi.destroy', $p->id_prodi) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
