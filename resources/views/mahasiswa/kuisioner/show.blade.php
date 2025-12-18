@extends('layouts.app')

@section('title', 'Isi Kuisioner')

@section('extra_styles')
    <style>
        .pertanyaan-item {
            border: 2px solid #6366f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #0f1419;
        }
        
        .pertanyaan-item h3 {
            color: #e4e6eb;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .pilihan-label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px 15px;
            background: #1a1f2e;
            border: 1px solid #6366f1;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            color: #e4e6eb;
            font-weight: 500;
        }
        
        .pilihan-label:hover {
            background: #6366f1;
            color: white;
            transform: translateX(5px);
        }
        
        .pilihan-label input {
            margin-right: 10px;
            accent-color: #6366f1;
        }
    </style>
@endsection

@section('sidebar')
    <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
    <a href="{{ route('mahasiswa.kuisioner.list') }}" class="active">Daftar Kuisioner</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>{{ $periode->keterangan }}</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('mahasiswa.kuisioner.store', $periode->id_periode) }}" method="POST">
            @csrf
            
            @forelse($pertanyaanPeriode as $pp)
                <div class="pertanyaan-item">
                    <h3>{{ $pp->pertanyaan->pertanyaan }}</h3>
                    
                    @foreach($pp->pertanyaan->pilihanJawaban as $pilihan)
                        <label class="pilihan-label">
                            <input type="radio" 
                                   name="jawaban[{{ $pp->pertanyaan->id_pertanyaan }}]" 
                                   value="{{ $pilihan->id_pilihan_jawaban }}"
                                   {{ (isset($jawaban[$pp->pertanyaan->id_pertanyaan]) && $jawaban[$pp->pertanyaan->id_pertanyaan]->id_pilihan_jawaban_pertanyaan === $pilihan->id_pilihan_jawaban) ? 'checked' : '' }}
                                   required>
                            {{ $pilihan->deskripsi_pilihan }}
                        </label>
                    @endforeach
                    
                    @error("jawaban.{$pp->pertanyaan->id_pertanyaan}")
                        <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror
                </div>
            @empty
                <p>Tidak ada pertanyaan dalam periode ini</p>
            @endforelse
            
            @if($pertanyaanPeriode->count() > 0)
                <button type="submit" class="btn btn-success">Simpan Jawaban</button>
                <a href="{{ route('mahasiswa.kuisioner.list') }}" class="btn">Batal</a>
            @endif
        </form>
    </div>
@endsection
