<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WargaTerdaftar;
use Illuminate\Http\Request;

class WargaTerdaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = WargaTerdaftar::query();

        // Filter kelurahan
        if ($request->filled('kelurahan')) {
            $query->where('kelurahan', $request->kelurahan);
        }

        // Pencarian nama/NIK
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $warga = $query->latest()->paginate(10)->withQueryString();

        // Ambil kelurahan unik untuk dropdown
        $kelurahanList = WargaTerdaftar::select('kelurahan')
            ->distinct()
            ->whereNotNull('kelurahan')
            ->orderBy('kelurahan')
            ->pluck('kelurahan');

        return view('admin.warga.index', compact('warga', 'kelurahanList'));
    }



    public function create()
    {
        return view('admin.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:warga_terdaftar,nik',
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
        ]);

        WargaTerdaftar::create($request->all());

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        $warga = WargaTerdaftar::findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = WargaTerdaftar::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:warga_terdaftar,nik,' . $warga->id,
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
        ]);

        $warga->update($request->all());

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy($id)
    {
        WargaTerdaftar::findOrFail($id)->delete();
        return back()->with('success', 'Data warga berhasil dihapus');
    }
}
