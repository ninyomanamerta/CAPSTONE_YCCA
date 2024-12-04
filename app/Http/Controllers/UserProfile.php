<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserProfile extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('user-profile', compact('user'));
    }
    
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed|min:8',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();
        
        // Mengecek apakah ada perubahan data
        $changes = false;

        // Cek perubahan pada nama
        if ($request->name != $user->name) {
            $user->name = $request->name;
            $changes = true;
        }

        // Cek perubahan pada email
        if ($request->email != $user->email) {
            $user->email = $request->email;
            $changes = true;
        }

        // Cek perubahan pada NIP
        if ($request->nip != $user->nip) {
            $user->nip = $request->nip;
            $changes = true;
        }

        // Cek perubahan pada jabatan
        if ($request->jabatan != $user->jabatan) {
            $user->jabatan = $request->jabatan;
            $changes = true;
        }

        // Cek jika password lama diberikan dan cocok, lalu update password baru
        if ($request->filled('current_password') && Hash::check($request->current_password, $user->password)) {
            if ($request->new_password) {
                $user->password = Hash::make($request->new_password);
                $changes = true;
            }
        }

        // Simpan perubahan jika ada yang berubah
        if ($changes) {
            $user->save();
            return back()->with('success', 'Profil berhasil diperbarui.');
        } else {
            // Jika tidak ada perubahan, beri pesan info
            return back()->with('info', 'Tidak ada data yang berubah.');
        }
    }
    
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
    
        $user = Auth::user();
    
        // Verifikasi password lama
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password yang Anda masukkan salah.');
        }
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Menghapus sesi pengguna
            $user->sessions()->delete(); // Menghapus sesi terkait jika ada
    
            // Menghapus akun pengguna
            $user->delete();
    
            // Logout pengguna
            Auth::logout();
    
            // Menghapus session dan menambahkan flash message
            session()->flush();
            session(['account_deleted' => true]);
    
            // Commit transaksi jika berhasil
            DB::commit();
    
            return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menghapus akun.');
        }
    }
    
    
}
