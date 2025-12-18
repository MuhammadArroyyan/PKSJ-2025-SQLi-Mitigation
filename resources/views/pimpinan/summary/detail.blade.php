@extends('layouts.app')

@section('title', 'Summary Detail')

@section('extra_styles')
    <style>
        .pertanyaan-summary {
            border: 2px solid #6366f1;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #0f1419;
        }
        
        .pertanyaan-summary h3 {
            color: #e4e6eb;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .pilihan-stat {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background: #1a1f2e;
            border-radius: 5px;
            border-left: 3px solid #6366f1;
        }
        
        .pilihan-stat-label {
            flex: 1;
            font-weight: 500;
            color: #e4e6eb;
        }
        
        .pilihan-stat-bar {
            flex: 2;
            height: 30px;
            background: #2d3748;
            border-radius: 5px;
            overflow: hidden;
            margin: 0 10px;
        }
        
        .pilihan-stat-fill {
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
            width: calc(var(--width) * 1%);
        }
        
        .pilihan-stat-count {
            font-weight: bold;
            min-width: 70px;
            text-align: right;
            color: #e4e6eb;
        }
    </style>
@endsection

@section('sidebar')
    <a href="{{ route('pimpinan.dashboard') }}">Dashboard</a>
    <a href="{{ route('pimpinan.summary.index') }}" class="active">Summary Pengisian</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Detail Summary Pengisian</h1>
        <a href="{{ route('pimpinan.summary.index') }}" class="btn">Kembali</a>
    </div>
    
    @forelse($summary as $item)
        <div class="pertanyaan-summary">
            <h3>{{ $item['pertanyaan'] }}</h3>
            
            @php
                $total = $item['jawaban']->sum();
                $max = $total > 0 ? $item['jawaban']->max() : 1;
            @endphp
            
            @foreach($item['pilihan'] as $pilihan)
                @php
                    $count = $item['jawaban'][$pilihan->id_pilihan_jawaban] ?? 0;
                    $percentage = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                @endphp
                <div class="pilihan-stat">
                    <div class="pilihan-stat-label">{{ $pilihan->deskripsi_pilihan }}</div>
                    <div class="pilihan-stat-bar">
                        <div class="pilihan-stat-fill" style="--width: {{ $percentage }}">
                            {{ $percentage }}%
                        </div>
                    </div>
                    <div class="pilihan-stat-count">{{ $count }} / {{ $total }}</div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="card">
            <p>Tidak ada data untuk ditampilkan. Silakan pilih periode dan program studi terlebih dahulu.</p>
        </div>
    @endforelse
@endsection
