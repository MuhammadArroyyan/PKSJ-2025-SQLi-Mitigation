@extends('layouts.app')

@section('title', 'Summary')

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}" class="active">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}">Jawaban Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Summary Pengisian Kuisioner</h1>
    </div>
    
    <div class="card">
        <form method="GET" style="display: flex; gap: 10px; align-items: flex-end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="periode">Pilih Periode</label>
                <select id="periode" name="id_periode" required>
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periode as $p)
                        <option value="{{ $p->id_periode }}" {{ request('id_periode') == $p->id_periode ? 'selected' : '' }}>
                            {{ $p->keterangan }} ({{ $p->status_periode }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn">Lihat Summary</button>
        </form>
    </div>

    @if(request('id_periode'))
        @php
            $id_periode = request('id_periode');
            $prodi = Auth::user()->prodi()->first();
            $pertanyaan = \App\Models\_2301020106_Pertanyaan::where('id_prodi', $prodi->id_prodi)
                ->with('pilihanJawaban')
                ->whereHas('periode', function($query) use ($id_periode) {
                    $query->where('id_periode', $id_periode);
                })
                ->get();
            $periode = \App\Models\_2301020106_PeriodeKuisioner::find($id_periode);
        @endphp

        @if(!$prodi)
            <div class="alert alert-warning">
                Anda belum ditugaskan sebagai kaprodi untuk prodi manapun.
            </div>
        @elseif($pertanyaan->isEmpty())
            <div class="alert alert-warning">
                Tidak ada pertanyaan untuk prodi {{ $prodi->nama_prodi }}.
            </div>
        @else
            <div class="card">
                <h3>Periode: {{ $periode->keterangan }}</h3>
                <p style="color: #666;">Program Studi: <strong>{{ $prodi->nama_prodi }}</strong></p>
                
                <!-- DEBUG INFO -->
                <div style="background: #2d2d2d; padding: 10px; margin-bottom: 15px; border-left: 3px solid #6366f1; color: #a0aec0; font-size: 12px;">
                    <strong>Debug:</strong> Prodi ID: {{ $prodi->id_prodi }}, Periode ID: {{ $id_periode }}, Questions Found: {{ $pertanyaan->count() }}
                </div>
                
                @foreach($pertanyaan as $p)
                    @php
                        // Get all answers for this question and period
                        $allJawaban = \App\Models\_2301020002_Jawaban::where('id_pertanyaan', $p->id_pertanyaan)
                            ->where('id_periode', $id_periode)
                            ->get();
                        
                        // Group by choice
                        $jawabanGrouped = $allJawaban->groupBy('id_pilihan_jawaban_pertanyaan')
                            ->map(fn($group) => $group->count());
                        
                        $totalJawaban = $allJawaban->count();
                        
                        // Debug: Log jawaban count
                        // \Log::info("Q{$p->id_pertanyaan} Periode{$id_periode}: Total=" . $totalJawaban);
                    @endphp
                    
                    <div style="margin-bottom: 20px; padding: 15px; border: 2px solid #6366f1; border-radius: 8px; background: #0f1419;">
                        <h4 style="color: #e4e6eb; font-size: 16px; margin-bottom: 10px;">{{ $p->pertanyaan }}</h4>
                        <small style="color: #888; margin-bottom: 10px; display: block;">Total jawaban ditemukan: <strong>{{ $totalJawaban }}</strong></small>
                        
                        @if($totalJawaban == 0)
                            <p style="color: #a0aec0;">Belum ada jawaban untuk pertanyaan ini.</p>
                        @else
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #1a1f2e; border-bottom: 2px solid #6366f1;">
                                        <th style="padding: 10px; text-align: left; color: #e4e6eb; font-weight: 600;">Pilihan</th>
                                        <th style="padding: 10px; text-align: center; color: #e4e6eb; font-weight: 600;">Jumlah</th>
                                        <th style="padding: 10px; text-align: center; color: #e4e6eb; font-weight: 600;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($p->pilihanJawaban as $pilihan)
                                        @php
                                            $count = $jawabanGrouped[$pilihan->id_pilihan_jawaban_pertanyaan] ?? 0;
                                            $persentase = $totalJawaban > 0 ? round(($count / $totalJawaban) * 100, 2) : 0;
                                        @endphp
                                        <tr style="border-bottom: 1px solid #6366f1;">
                                            <td style="padding: 10px; color: #e4e6eb;">{{ $pilihan->deskripsi_pilihan }}</td>
                                            <td style="padding: 10px; text-align: center; color: #e4e6eb;">{{ $count }}</td>
                                            <td style="padding: 10px; text-align: center;">
                                                <div style="background-color: #6366f1; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                                                    {{ $persentase }}%
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p style="margin-top: 10px; color: #a0aec0;"><strong>Total Responden:</strong> {{ $totalJawaban }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endsection
