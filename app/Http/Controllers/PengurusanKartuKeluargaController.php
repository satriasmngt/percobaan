<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengurusankartukeluarga;
use App\Models\penduduk;

class PengurusanKartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengurusanKK = pengurusankartukeluarga::with('penduduk')->get();
        return view('pengurusankartukeluarga.index', compact('pengurusanKK'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduk = penduduk::all();
        return view('pengurusankartukeluarga.create', compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:penduduk,nik',
            'nama' => 'required|string|max:255',
            'tanggal_pengurusan' => 'required|date',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('dokumen')) {
            $data['dokumen'] = $request->file('dokumen')->store('dokumen_pengurusan', 'public');
        }

        pengurusankartukeluarga::create($data);

        return redirect()->route('pengurusankartukeluarga.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengurusanKK = pengurusankartukeluarga::where('nik', $id)->first();
        return view('pengurusankartukeluarga.edit', compact('pengurusanKK'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengurusanKK = pengurusankartukeluarga::where('nik', $id)->first();

        $request->validate([
            'tanggal_pengurusan' => 'required|date',
            'status' => 'required|in:pending,proses,selesai',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);
    
        $data = $request->only('tanggal_pengurusan', 'status', 'keterangan');
    
        if ($request->has('hapus_dokumen') && $request->hapus_dokumen == '1') {
            if ($pengurusanKK->dokumen) {
                \Storage::disk('public')->delete($pengurusanKK->dokumen);
            }
            $data['dokumen'] = null;
        }
    
        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama jika ada
            if ($pengurusanKK->dokumen) {
                \Storage::disk('public')->delete($pengurusanKK->dokumen);
            }
    
            // Simpan dokumen baru
            $data['dokumen'] = $request->file('dokumen')->store('dokumen_pengurusan', 'public');
        }
    
        $pengurusanKK->update($data);
    
        return redirect()->route('pengurusankartukeluarga.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengurusanKK = pengurusankartukeluarga::where('nik', $id)->first();

        if ($pengurusanKK->dokumen) {
            \Storage::disk('public')->delete($pengurusanKK->dokumen);
        }

        $pengurusanKK->delete();

        return redirect()->route('pengurusankartukeluarga.index')->with('success', 'Data berhasil dihapus.');
    }
}
