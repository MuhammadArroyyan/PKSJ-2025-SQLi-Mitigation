@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.users.index') }}">Kelola User</a>
    <a href="{{ route('admin.fakultas.index') }}">Kelola Fakultas</a>
    <a href="{{ route('admin.jurusan.index') }}">Kelola Jurusan</a>
    <a href="{{ route('admin.prodi.index') }}">Kelola Prodi</a>
    <a href="{{ route('admin.mahasiswa.index') }}" class="active">Kelola Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Kelola Mahasiswa</h1>
        <div class="page-header-actions">
            <a href="{{ route('admin.mahasiswa.create') }}" class="btn">Tambah Mahasiswa</a>
        </div>
    </div>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>User</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $m)
                    <tr>
                        <td>{{ $m->nim }}</td>
                        <td>{{ $m->nama_mahasiswa }}</td>
                        <td>{{ $m->user->nama_user }}</td>
                        <td>{{ $m->prodi->nama_prodi }}</td>
                        <td>
                            <a href="{{ route('admin.mahasiswa.edit', $m->nim) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.mahasiswa.destroy', $m->nim) }}" method="POST" style="display: inline;">
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
