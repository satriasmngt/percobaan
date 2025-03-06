<?php

namespace App\Http\Controllers;

use App\Models\pengurusanktp;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengurusanKTPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengurusanktp = pengurusanktp::with('penduduk')->get();
        return view('pengurusanktp.index', compact('pengurusanktp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penduduk = penduduk::all();
        return view('pengurusanktp.create', compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penduduk_nik' => 'required|exists:penduduk,nik',
            'tanggal_pengurusan' => 'required|date',
            'status' => 'required',
            'keterangan' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        pengurusanktp::create([
            'penduduk_nik' => $request->penduduk_nik,
            'tanggal_pengurusan' => $request->tanggal_pengurusan,
            'status' => $request->status,
            'keterangan' => $request->keterangan, // Berikan nilai default null jika kosong.
        ]);
    
        return redirect()->route('pengurusanktp.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengurusanktp = pengurusanktp::find($id);
        return view('pengurusanktp.show', compact('pengurusanktp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurusanktp = pengurusanktp::where('penduduk_nik', $id)->first();
        $penduduk = penduduk::all();
        return view('pengurusanktp.edit', compact('pengurusanktp', 'penduduk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengurusanktp = pengurusanktp::where('penduduk_nik', $id)->first();
        $validator = Validator::make($request->all(), [
            'penduduk_nik' => 'required|exists:penduduk,nik',
            'tanggal_pengurusan' => 'required|date',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pengurusanktp->update($request->all());
        return redirect()->route('pengurusanktp.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengurusanktp = pengurusanktp::where('penduduk_nik', $id)->first();
        $pengurusanktp->delete();
        return redirect()->route('pengurusanktp.index')->with('success', 'Data berhasil dihapus!');
    }
}
