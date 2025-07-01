<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class AdminKomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'isi_komentar' => 'required|string',
        ]);

        Komentar::create([
            'pengaduan_id' => $id,
            'user_id' => Auth::id(), // admin
            'isi_komentar' => $request->isi_komentar,
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return back()->with('success', 'Tanggapan berhasil dihapus.');
    }
}
