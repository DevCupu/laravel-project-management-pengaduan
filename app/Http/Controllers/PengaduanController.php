<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    use AuthorizesRequests;
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $pengaduans = Pengaduan::where('user_id', Auth::user()->id)->latest()->get();
        return view('users.pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategori = KategoriPengaduan::all();
        return view('users.pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori_id' => 'nullable|exists:kategori_pengaduans,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('users.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('users.pengaduan.show', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $kategori = KategoriPengaduan::all();

        return view('users.pengaduan.edit', compact('pengaduan', 'kategori'));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($pengaduan->gambar) {
            Storage::disk('public')->delete($pengaduan->gambar);
        }

        $pengaduan->delete();

        return redirect()->route('users.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
