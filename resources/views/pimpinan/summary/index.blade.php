@extends('layouts.app')

@section('title', 'Summary Pengisian')

@section('extra_styles')
    <style>
        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background: #0f1419;
            border: 2px solid #6366f1;
            border-radius: 8px;
        }
        
        .filter-form label {
            color: #e4e6eb;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }
        
        .filter-form select {
            padding: 10px;
            border: 2px solid #6366f1;
            border-radius: 5px;
            font-size: 14px;
            background: #1a1f2e;
            color: #e4e6eb;
        }
        
        .filter-form select option {
            background: #1a1f2e;
            color: #e4e6eb;
        }
        
        .chart-container {
            border: 2px solid #6366f1;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #0f1419;
        }
    </style>
@endsection

@section('sidebar')
    <a href="{{ route('pimpinan.dashboard') }}">Dashboard</a>
    <a href="{{ route('pimpinan.summary.index') }}" class="active">Summary Pengisian</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Summary Pengisian Kuisioner</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('pimpinan.summary.detail') }}" method="GET" class="filter-form">
            <div>
                <label for="periode">Pilih Periode</label>
                <select id="periode" name="id_periode" required>
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periode as $p)
                        <option value="{{ $p->id_periode }}" {{ request('id_periode') == $p->id_periode ? 'selected' : '' }}>
                            {{ $p->keterangan }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="prodi">Pilih Program Studi</label>
                <select id="prodi" name="id_prodi" required>
                    <option value="">-- Pilih Prodi --</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->id_prodi }}" {{ request('id_prodi') == $p->id_prodi ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn">Tampilkan Summary</button>
        </form>
    </div>
@endsection
