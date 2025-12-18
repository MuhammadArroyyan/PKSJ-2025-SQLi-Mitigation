@extends('layouts.app')

@section('title', 'Edit Prodi')

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
        <h1>Edit Prodi</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('admin.prodi.update', $prodi->id_prodi) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_prodi">Nama Prodi</label>
                <input type="text" id="nama_prodi" name="nama_prodi" required value="{{ old('nama_prodi', $prodi->nama_prodi) }}">
                @error('nama_prodi')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="id_jurusan">Jurusan</label>
                <select id="id_jurusan" name="id_jurusan" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan', $prodi->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
                @error('id_jurusan')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="id_user_kaprodi">Kaprodi</label>
                <select id="id_user_kaprodi" name="id_user_kaprodi" required>
                    <option value="">-- Pilih Kaprodi --</option>
                    @foreach($kaprodi as $k)
                        <option value="{{ $k->id_user }}" {{ old('id_user_kaprodi', $prodi->id_user_kaprodi) == $k->id_user ? 'selected' : '' }}>
                            {{ $k->nama_user }}
                        </option>
                    @endforeach
                </select>
                @error('id_user_kaprodi')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.prodi.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
