@extends('app')

@section('content')
<div class="container">
    <h1>Tambah Pengurusan KTP</h1>
    <form action="{{ route('pengurusanktp.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="penduduk_nik">NIK Penduduk</label>
            <select name="penduduk_nik" id="penduduk_nik" class="form-control" required>
                <option value="">-- Pilih Penduduk --</option>
                @foreach ($penduduk as $p)
                    <option value="{{ $p->nik }}">{{ $p->nik }} - {{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_pengurusan">Tanggal Pengurusan</label>
            <input type="date" name="tanggal_pengurusan" id="tanggal_pengurusan" class="form-control">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">-- Pilih Status --</option>
                <option value="Proses">Proses</option>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection