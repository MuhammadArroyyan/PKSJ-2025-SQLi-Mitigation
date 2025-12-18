<?php

namespace App\Http\Controllers;

use App\Models\_2301020109_User as User;
use App\Models\_2301020002_Fakultas as Fakultas;
use App\Models\_2301020002_Jurusan as Jurusan;
use App\Models\_2301020109_Prodi as Prodi;
use App\Models\_2301020002_Mahasiswa as Mahasiswa;
use Illuminate\Http\Request;

class _2301020109_AdminController extends _2301020074_Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // User Management
    public function indexUser()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,kaprodi,mahasiswa,pimpinan',
        ]);

        // Auto-generate email sesuai role
        $email = match($validated['role']) {
            'admin' => 'admin@admin.com',
            'kaprodi' => strtolower(substr($validated['nama_user'], 0, 2)) . '@umrah.co.id',
            'mahasiswa' => 'user' . time() . '@umrah.co.id', // Placeholder, nanti bisa di-edit
            'pimpinan' => 'pimpinan@umrah.co.id',
        };
        
        $validated['email'] = $email;
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'nama_user' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id . ',id_user',
            'role' => 'required|in:admin,kaprodi,mahasiswa,pimpinan',
        ]);

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        // Jika user adalah mahasiswa, delete mahasiswa dulu
        if ($user->role === 'mahasiswa') {
            Mahasiswa::where('id_user_mahasiswa', $id)->delete();
        }
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    // Fakultas Management
    public function indexFakultas()
    {
        $fakultas = Fakultas::all();
        return view('admin.fakultas.index', compact('fakultas'));
    }

    public function createFakultas()
    {
        return view('admin.fakultas.create');
    }

    public function storeFakultas(Request $request)
    {
        $validated = $request->validate([
            'nama_fakultas' => 'required|string|unique:fakultas',
        ]);

        Fakultas::create($validated);
        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil ditambahkan');
    }

    public function editFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('admin.fakultas.edit', compact('fakultas'));
    }

    public function updateFakultas(Request $request, $id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $validated = $request->validate([
            'nama_fakultas' => 'required|string|unique:fakultas,nama_fakultas,' . $id . ',id_fakultas',
        ]);

        $fakultas->update($validated);
        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil diperbarui');
    }

    public function destroyFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        
        // Delete all related jurusan (cascade)
        Jurusan::where('id_fakultas', $id)->delete();
        
        $fakultas->delete();
        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil dihapus');
    }

    // Jurusan Management
    public function indexJurusan()
    {
        $jurusan = Jurusan::with('fakultas')->get();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function createJurusan()
    {
        $fakultas = Fakultas::all();
        return view('admin.jurusan.create', compact('fakultas'));
    }

    public function storeJurusan(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string',
            'id_fakultas' => 'required|exists:fakultas,id_fakultas',
        ]);

        Jurusan::create($validated);
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function editJurusan($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $fakultas = Fakultas::all();
        return view('admin.jurusan.edit', compact('jurusan', 'fakultas'));
    }

    public function updateJurusan(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $validated = $request->validate([
            'nama_jurusan' => 'required|string',
            'id_fakultas' => 'required|exists:fakultas,id_fakultas',
        ]);

        $jurusan->update($validated);
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    public function destroyJurusan($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        
        // Delete all related prodi (cascade)
        Prodi::where('id_jurusan', $id)->each(function($prodi) {
            // Delete mahasiswa related to this prodi
            Mahasiswa::where('id_prodi', $prodi->id_prodi)->each(function($mahasiswa) {
                // Delete user if exists
                if ($mahasiswa->id_user_mahasiswa) {
                    User::where('id_user', $mahasiswa->id_user_mahasiswa)->delete();
                }
                $mahasiswa->delete();
            });
            $prodi->delete();
        });
        
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }

    // Prodi Management
    public function indexProdi()
    {
        $prodi = Prodi::with('kaprodi', 'jurusan')->get();
        return view('admin.prodi.index', compact('prodi'));
    }

    public function createProdi()
    {
        $jurusan = Jurusan::all();
        $kaprodi = User::where('role', 'kaprodi')->get();
        return view('admin.prodi.create', compact('jurusan', 'kaprodi'));
    }

    public function storeProdi(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string',
            'id_user_kaprodi' => 'required|exists:users,id_user',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);

        Prodi::create($validated);
        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil ditambahkan');
    }

    public function editProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $jurusan = Jurusan::all();
        $kaprodi = User::where('role', 'kaprodi')->get();
        return view('admin.prodi.edit', compact('prodi', 'jurusan', 'kaprodi'));
    }

    public function updateProdi(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $validated = $request->validate([
            'nama_prodi' => 'required|string',
            'id_user_kaprodi' => 'required|exists:users,id_user',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);

        $prodi->update($validated);
        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil diperbarui');
    }

    public function destroyProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        
        // Delete all related mahasiswa (cascade)
        Mahasiswa::where('id_prodi', $id)->each(function($mahasiswa) {
            // Delete user if exists
            if ($mahasiswa->id_user_mahasiswa) {
                User::where('id_user', $mahasiswa->id_user_mahasiswa)->delete();
            }
            $mahasiswa->delete();
        });
        
        $prodi->delete();
        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil dihapus');
    }

    // Mahasiswa Management
    public function indexMahasiswa()
    {
        $mahasiswa = Mahasiswa::with('user', 'prodi')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function createMahasiswa()
    {
        $prodi = Prodi::all();
        return view('admin.mahasiswa.create', compact('prodi'));
    }

    public function storeMahasiswa(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mahasiswa',
            'nama_mahasiswa' => 'required|string',
            'id_prodi' => 'required|exists:prodi,id_prodi',
        ]);

        // Auto-create user untuk mahasiswa dengan nama dari nim + nama
        $user = User::create([
            'nama_user' => $validated['nama_mahasiswa'],
            'email' => $validated['nim'] . '@umrah.ac.id',
            'password' => bcrypt($validated['nim']),
            'role' => 'mahasiswa',
        ]);

        // Tambah id_user_mahasiswa ke validated data
        $validated['id_user_mahasiswa'] = $user->id_user;

        Mahasiswa::create($validated);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan');
    }

    public function editMahasiswa($nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $prodi = Prodi::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    public function updateMahasiswa(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string',
            'id_prodi' => 'required|exists:prodi,id_prodi',
        ]);

        $mahasiswa->update($validated);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui');
    }

    public function destroyMahasiswa($nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        
        // Delete user yang terkait
        if ($mahasiswa->id_user_mahasiswa) {
            User::where('id_user', $mahasiswa->id_user_mahasiswa)->delete();
        }
        
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus');
    }
}
