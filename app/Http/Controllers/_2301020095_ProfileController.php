<?php

namespace App\Http\Controllers;

use App\Models\_2301020109_User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class _2301020095_ProfileController extends _2301020074_Controller
{
    public function changePassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if ($user) {
            $user->update(['password' => Hash::make($validated['password'])]);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        }
        
        return redirect()->back()->with('error', 'User tidak ditemukan');
    }
}
