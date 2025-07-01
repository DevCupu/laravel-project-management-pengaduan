<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    public function index()
    {
        $kategoris = KategoriPengaduan::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kategori' => 'required|string|max:255'
        ]);

        KategoriPengaduan::create($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ditambahkan.');
    }

    public function edit(KategoriPengaduan $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriPengaduan $kategori)
    {
        $request->validate([
            'name_kategori' => 'required|string|max:255'
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori diperbarui.');
    }

    public function destroy(KategoriPengaduan $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori dihapus.');
    }
}
