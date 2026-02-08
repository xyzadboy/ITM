<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiLoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Ambil input
        $login = $request->login;

        // 3. Tentukan field (email atau username)
        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        // 4. Proses login (GUARD pegawai)
        if (Auth::guard('pegawai')->attempt([
            $field => $login,
            'password' => $request->password,
        ])) {
            // 5. Regenerate session (security)
            $request->session()->regenerate();

            return redirect('/tiket');
        }

        // 6. Jika gagal
        return back()->withErrors([
            'login' => 'Username / Email atau password salah',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::guard('pegawai')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
