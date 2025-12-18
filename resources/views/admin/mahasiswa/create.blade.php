@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

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
        <h1>Tambah Mahasiswa</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" required value="{{ old('nim') }}">
                @error('nim')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required value="{{ old('nama_mahasiswa') }}">
                @error('nama_mahasiswa')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="id_prodi">Program Studi</label>
                <select id="id_prodi" name="id_prodi" required>
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->id_prodi }}" {{ old('id_prodi') == $p->id_prodi ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach
                </select>
                @error('id_prodi')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
