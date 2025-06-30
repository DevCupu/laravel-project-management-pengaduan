<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\WargaTerdaftar;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'nik' => 'required|string|unique:users,nik',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
    ]);

    // Validasi NIK dan Nama harus cocok dengan tabel warga_terdaftar
    $warga = WargaTerdaftar::where('nik', $request->nik)
        ->where('nama', $request->name)
        ->first();

    if (!$warga) {
        return back()->withErrors([
            'nik' => 'NIK atau nama tidak cocok dengan data kelurahan',
        ]);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'nik' => $request->nik,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'is_verified' => false, // menunggu verifikasi admin
    ]);

    // Auth::login($user); Mencegah User Langsung Login Ketika Belum di Verifikasi

    return redirect()->route('login')->with([
        'status' => 'Pendaftaran berhasil. Silakan tunggu verifikasi dari admin.',
        'alert-class' => 'alert-success'
    ]);


    return redirect(RouteServiceProvider::HOME);
    }
}
