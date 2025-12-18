@extends('layouts.app')

@section('title', 'Buat Periode Kuisioner')

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}" class="active">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}">Jawaban Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Buat Periode Kuisioner</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('kaprodi.periode.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" required value="{{ old('keterangan') }}">
                @error('keterangan')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="status_periode">Status</label>
                <select id="status_periode" name="status_periode" required>
                    <option value="draft" {{ old('status_periode') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="active" {{ old('status_periode') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="closed" {{ old('status_periode') == 'closed' ? 'selected' : '' }}>Ditutup</option>
                </select>
                @error('status_periode')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('kaprodi.periode.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
