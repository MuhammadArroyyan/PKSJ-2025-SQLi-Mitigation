<?php

namespace App\Http\Controllers;

use App\Models\_2301020106_PeriodeKuisioner as PeriodeKuisioner;
use App\Models\_2301020106_PertanyaanPeriodeKuisioner as PertanyaanPeriodeKuisioner;
use App\Models\_2301020106_Pertanyaan as Pertanyaan;
use App\Models\_2301020002_Jawaban as Jawaban;
use App\Models\_2301020002_Mahasiswa as Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class _2301020074_MahasiswaController extends _2301020074_Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user_mahasiswa', $user->id_user)->first();
        $periode = PeriodeKuisioner::where('status_periode', 'active')->get();

        return view('mahasiswa.dashboard', compact('periode', 'mahasiswa'));
    }

    public function listKuisioner()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user_mahasiswa', $user->id_user)->first();
        $periode = PeriodeKuisioner::where('status_periode', 'active')->get();

        return view('mahasiswa.kuisioner.list', compact('periode', 'mahasiswa'));
    }

    public function showKuisioner($id_periode)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user_mahasiswa', $user->id_user)->first();
        $periode = PeriodeKuisioner::findOrFail($id_periode);

        $pertanyaanPeriode = PertanyaanPeriodeKuisioner::where('id_periode_kuisioner', $id_periode)
            ->with('pertanyaan.pilihanJawaban')
            ->get();

        $jawaban = Jawaban::where('nim', $mahasiswa->nim)
            ->where('id_periode', $id_periode)
            ->get()
            ->keyBy('id_pertanyaan');

        return view('mahasiswa.kuisioner.show', compact('periode', 'pertanyaanPeriode', 'jawaban', 'mahasiswa'));
    }

    public function storeJawaban(Request $request, $id_periode)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user_mahasiswa', $user->id_user)->first();

        $validated = $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|exists:pilihan_jawaban_pertanyaan,id_pilihan_jawaban',
        ]);

        foreach ($validated['jawaban'] as $id_pertanyaan => $id_pilihan_jawaban) {
            Jawaban::updateOrCreate(
                [
                    'nim' => $mahasiswa->nim,
                    'id_pertanyaan' => $id_pertanyaan,
                    'id_periode' => $id_periode,
                ],
                [
                    'id_pilihan_jawaban_pertanyaan' => $id_pilihan_jawaban,
                ]
            );
        }

        return redirect()->route('mahasiswa.kuisioner.list')->with('success', 'Jawaban berhasil disimpan');
    }

    public function editKuisioner($id_periode)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user_mahasiswa', $user->id_user)->first();
        $periode = PeriodeKuisioner::findOrFail($id_periode);

        $pertanyaanPeriode = PertanyaanPeriodeKuisioner::where('id_periode_kuisioner', $id_periode)
            ->with('pertanyaan.pilihanJawaban')
            ->get();

        $jawaban = Jawaban::where('nim', $mahasiswa->nim)
            ->where('id_periode', $id_periode)
            ->get()
            ->keyBy('id_pertanyaan');

        return view('mahasiswa.kuisioner.edit', compact('periode', 'pertanyaanPeriode', 'jawaban', 'mahasiswa'));
    }
}
