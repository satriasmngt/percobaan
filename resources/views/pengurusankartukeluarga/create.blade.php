@extends('app')

@section('content')
<div class="container">
    <h1>Tambah Data Pengurusan Kartu Keluarga</h1>

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

    <!-- Form Tambah Data -->
    <form action="{{ route('pengurusankartukeluarga.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <select name="nik" id="nik" class="form-control" required>
                <option value="" disabled selected>Pilih NIK</option>
                @foreach ($penduduk as $p)
                    <option value="{{ $p->nik }}" {{ old('nik') == $p->nik ? 'selected' : '' }}>
                        {{ $p->nik }} - {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" readonly value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_pengurusan" class="form-label">Tanggal Pengurusan</label>
            <input type="date" class="form-control" id="tanggal_pengurusan" name="tanggal_pengurusan" value="{{ old('tanggal_pengurusan') }}" required>
        </div>

        <div class="mb-3">
            <label for="dokumen" class="form-label">Dokumen (Opsional)</label>
            <input type="file" class="form-control" id="dokumen" name="dokumen" accept=".pdf,.jpg,.png">
            <small class="form-text text-muted">Format yang diizinkan: PDF, JPG, PNG. Maksimal ukuran: 2MB.</small>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengurusankartukeluarga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    // Script untuk mengisi nama berdasarkan NIK yang dipilih
    document.getElementById('nik').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nama = selectedOption.text.split(' - ')[1] || '';
        document.getElementById('nama').value = nama;
    });
</script>
@endsection