@extends('app')

@section('content')
<div class="container">
    <h1>Edit Data Pengurusan Kartu Keluarga</h1>

    <!-- Notifikasi error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Data -->
    <form action="{{ route('pengurusankartukeluarga.update', $pengurusanKK->nik) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <select name="nik" id="nik" class="form-control" disabled>
                <option value="{{ $pengurusanKK->nik }}">{{ $pengurusanKK->nik }} - {{ $pengurusanKK->nama }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengurusanKK->nama }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tanggal_pengurusan" class="form-label">Tanggal Pengurusan</label>
            <input type="date" class="form-control" id="tanggal_pengurusan" name="tanggal_pengurusan" value="{{ $pengurusanKK->tanggal_pengurusan }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $pengurusanKK->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ $pengurusanKK->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $pengurusanKK->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="dokumen" class="form-label">Dokumen (Opsional)</label>
            <input type="file" class="form-control" id="dokumen" name="dokumen">
            @if ($pengurusanKK->dokumen)
                <p>Dokumen saat ini: <a href="{{ asset('storage/' . $pengurusanKK->dokumen) }}" target="_blank">Lihat</a></p>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="hapus_dokumen" name="hapus_dokumen" value="1">
                    <label for="hapus_dokumen" class="form-check-label">Hapus dokumen lama</label>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $pengurusanKK->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pengurusankartukeluarga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection