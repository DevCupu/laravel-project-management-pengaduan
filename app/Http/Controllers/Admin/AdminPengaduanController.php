<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    /**
     * Tampilkan semua pengaduan dari semua user.
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with('user')->latest();

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kata kunci pada judul atau isi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('isi', 'like', '%' . $request->search . '%');
            });
        }

        $pengaduans = $query->paginate(10)->appends($request->query());

        return view('admin.pengaduan.index', compact('pengaduans'));
    }


    /**
     * Tampilkan detail pengaduan tertentu.
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Update status pengaduan (misal ditandai selesai).
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:terkirim,diproses,selesai',
        ]);


        $pengaduan->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Status pengaduan diperbarui.');
    }
}
