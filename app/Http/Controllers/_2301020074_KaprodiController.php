<?php

namespace App\Http\Controllers;

use App\Models\_2301020106_PeriodeKuisioner as PeriodeKuisioner;
use App\Models\_2301020106_Pertanyaan as Pertanyaan;
use App\Models\_2301020106_PilihanJawabanPertanyaan as PilihanJawabanPertanyaan;
use App\Models\_2301020106_PertanyaanPeriodeKuisioner as PertanyaanPeriodeKuisioner;
use App\Models\_2301020002_Jawaban as Jawaban;
use App\Models\_2301020109_Prodi as Prodi;
use App\Models\_2301020109_User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class _2301020074_KaprodiController extends _2301020074_Controller
{
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        $prodi = $user ? $user->prodi()->first() : null;
        return view('kaprodi.dashboard', compact('prodi'));
    }

    // Periode Kuisioner Management
    public function indexPeriode()
    {
        /** @var User $user */
        $user = Auth::user();
        $prodi = $user ? $user->prodi()->first() : null;
        $periode = PeriodeKuisioner::all();
        return view('kaprodi.periode.index', compact('periode', 'prodi'));
    }

    public function createPeriode()
    {
        return view('kaprodi.periode.create');
    }

    public function storePeriode(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string',
            'status_periode' => 'required|in:draft,active,closed',
        ]);

        PeriodeKuisioner::create($validated);
        return redirect()->route('kaprodi.periode.index')->with('success', 'Periode Kuisioner berhasil ditambahkan');
    }

    public function editPeriode($id)
    {
        $periode = PeriodeKuisioner::findOrFail($id);
        return view('kaprodi.periode.edit', compact('periode'));
    }

    public function updatePeriode(Request $request, $id)
    {
        $periode = PeriodeKuisioner::findOrFail($id);
        $validated = $request->validate([
            'keterangan' => 'required|string',
            'status_periode' => 'required|in:draft,active,closed',
        ]);

        $periode->update($validated);
        return redirect()->route('kaprodi.periode.index')->with('success', 'Periode Kuisioner berhasil diperbarui');
    }

    public function destroyPeriode($id)
    {
        PeriodeKuisioner::findOrFail($id)->delete();
        return redirect()->route('kaprodi.periode.index')->with('success', 'Periode Kuisioner berhasil dihapus');
    }

    // Pertanyaan Management
    public function indexPertanyaan()
    {
        /** @var User $user */
        $user = Auth::user();
        $prodi = $user ? $user->prodi()->first() : null;
        $pertanyaan = Pertanyaan::where('id_prodi', $prodi->id_prodi ?? null)->get();
        return view('kaprodi.pertanyaan.index', compact('pertanyaan'));
    }

    public function createPertanyaan()
    {
        /** @var User $user */
        $user = Auth::user();
        $prodi = $user ? $user->prodi()->first() : null;
        return view('kaprodi.pertanyaan.create', compact('prodi'));
    }

    public function storePertanyaan(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $prodi = $user ? $user->prodi()->first() : null;
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan' => 'required|array|min:2',
            'pilihan.*' => 'required|string',
        ]);

        $pertanyaan = Pertanyaan::create([
            'pertanyaan' => $validated['pertanyaan'],
            'id_prodi' => $prodi->id_prodi,
        ]);

        foreach ($validated['pilihan'] as $pilihan) {
            PilihanJawabanPertanyaan::create([
                'deskripsi_pilihan' => $pilihan,
                'id_pertanyaan' => $pertanyaan->id_pertanyaan,
            ]);
        }

        return redirect()->route('kaprodi.pertanyaan.index')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    public function editPertanyaan($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $pilihan = PilihanJawabanPertanyaan::where('id_pertanyaan', $id)->get();
        return view('kaprodi.pertanyaan.edit', compact('pertanyaan', 'pilihan'));
    }

    public function updatePertanyaan(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan' => 'required|array|min:2',
            'pilihan.*' => 'required|string',
        ]);

        $pertanyaan->update(['pertanyaan' => $validated['pertanyaan']]);

        PilihanJawabanPertanyaan::where('id_pertanyaan', $id)->delete();
        foreach ($validated['pilihan'] as $pilihan) {
            PilihanJawabanPertanyaan::create([
                'deskripsi_pilihan' => $pilihan,
                'id_pertanyaan' => $id,
            ]);
        }

        return redirect()->route('kaprodi.pertanyaan.index')->with('success', 'Pertanyaan berhasil diperbarui');
    }

    public function destroyPertanyaan($id)
    {
        PilihanJawabanPertanyaan::where('id_pertanyaan', $id)->delete();
        Pertanyaan::findOrFail($id)->delete();
        return redirect()->route('kaprodi.pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus');
    }

    // Add pertanyaan to periode
    public function addPertanyaanToPeriode(Request $request)
    {
        $validated = $request->validate([
            'id_periode_kuisioner' => 'required|exists:periode_kuisioner,id_periode',
            'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
        ]);

        PertanyaanPeriodeKuisioner::create($validated);
        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan ke periode');
    }

    // Summary
    public function summarySummary()
    {
        $periode = PeriodeKuisioner::all();
        return view('kaprodi.summary.index', compact('periode'));
    }

    // Jawaban Mahasiswa
    public function indexJawaban()
    {
        /** @var User $user */
        $user = Auth::user();
        $prodi = $user ? $user->prodi()->first() : null;
        $jawaban = Jawaban::whereHas('pertanyaan', function ($query) use ($prodi) {
            $query->where('id_prodi', $prodi->id_prodi ?? null);
        })->get();

        return view('kaprodi.jawaban.index', compact('jawaban'));
    }
}
