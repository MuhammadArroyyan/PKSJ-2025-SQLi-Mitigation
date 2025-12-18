@extends('layouts.app')

@section('title', 'Edit Fakultas')

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
        <h1>Edit Fakultas</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('admin.fakultas.update', $fakultas->id_fakultas) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_fakultas">Nama Fakultas</label>
                <input type="text" id="nama_fakultas" name="nama_fakultas" required value="{{ old('nama_fakultas', $fakultas->nama_fakultas) }}">
                @error('nama_fakultas')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.fakultas.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
