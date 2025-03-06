<?php

namespace App\Http\Controllers;

use App\Models\penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
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
        $penduduk = penduduk::all();
        return view('penduduk.index', compact('penduduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:penduduk',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        penduduk::create($request->all());
        return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penduduk = penduduk::where('nik', $id)->first();

    if (!$penduduk) {
        return redirect()->route('penduduk.index')->with('error', 'Data penduduk tidak ditemukan.');
    }

    return view('penduduk.edit', compact('penduduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penduduk = penduduk::where('nik', $id)->first();

    if (!$penduduk) {
        return redirect()->route('penduduk.index')->with('error', 'Data penduduk tidak ditemukan.');
    }

    // Validasi data
    $request->validate([
        'nama' => 'required',
        'nik' => 'required|unique:penduduk,nik,' . $penduduk->nik . ',nik',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
    ]);

    // Update data penduduk
    $penduduk->update($request->all());

    // Redirect dengan pesan sukses
    return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penduduk = penduduk::where('nik', $id)->first();

        if (!$penduduk) {
            return redirect()->route('penduduk.index')->with('error', 'Data penduduk tidak ditemukan.');
        }
    
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil dihapus.');
    }
}
