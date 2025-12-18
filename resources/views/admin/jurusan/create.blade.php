@extends('layouts.app')

@section('title', 'Tambah Jurusan')

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
        <h1>Tambah Jurusan</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('admin.jurusan.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nama_jurusan">Nama Jurusan</label>
                <input type="text" id="nama_jurusan" name="nama_jurusan" required value="{{ old('nama_jurusan') }}">
                @error('nama_jurusan')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="id_fakultas">Fakultas</label>
                <select id="id_fakultas" name="id_fakultas" required>
                    <option value="">-- Pilih Fakultas --</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id_fakultas }}" {{ old('id_fakultas') == $f->id_fakultas ? 'selected' : '' }}>
                            {{ $f->nama_fakultas }}
                        </option>
                    @endforeach
                </select>
                @error('id_fakultas')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
