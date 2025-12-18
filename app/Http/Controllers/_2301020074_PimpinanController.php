<?php

namespace App\Http\Controllers;

use App\Models\_2301020106_PeriodeKuisioner as PeriodeKuisioner;
use App\Models\_2301020106_Pertanyaan as Pertanyaan;
use App\Models\_2301020002_Jawaban as Jawaban;
use App\Models\_2301020109_Prodi as Prodi;
use Illuminate\Http\Request;

class _2301020074_PimpinanController extends _2301020074_Controller
{
    public function dashboard()
    {
        return view('pimpinan.dashboard');
    }

    public function summary()
    {
        $periode = PeriodeKuisioner::all();
        $prodi = Prodi::all();

        return view('pimpinan.summary.index', compact('periode', 'prodi'));
    }

    public function getSummaryData(Request $request)
    {
        $id_periode = $request->query('id_periode');
        $id_prodi = $request->query('id_prodi');

        $pertanyaan = Pertanyaan::where('id_prodi', $id_prodi)->get();
        $summary = [];

        foreach ($pertanyaan as $p) {
            $jawaban = Jawaban::where('id_pertanyaan', $p->id_pertanyaan)
                ->where('id_periode', $id_periode)
                ->get()
                ->groupBy('id_pilihan_jawaban_pertanyaan')
                ->map->count();

            $jawabanArray = $jawaban instanceof \Illuminate\Support\Collection ? $jawaban->toArray() : $jawaban;
            $total = array_sum($jawabanArray);

            $summary[] = [
                'pertanyaan' => $p->pertanyaan,
                'pilihan' => $p->pilihanJawaban,
                'jawaban' => $jawaban,
                'total' => $total,
            ];
        }

        return view('pimpinan.summary.detail', compact('summary'));
    }
}
