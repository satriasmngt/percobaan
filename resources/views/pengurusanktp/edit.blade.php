@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Pengurusan KTP</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('pengurusanktp.update', $pengurusanktp->penduduk_nik) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="penduduk_nik" class="form-label">Penduduk NIK</label>
                            <select name="penduduk_nik" id="penduduk_nik" class="form-control">
                                <option value="">-- Pilih NIK --</option>
                                @foreach ($penduduk as $p)
                                    <option value="{{ $p->nik }}" {{ $pengurusanktp->penduduk_nik == $p->nik ? 'selected' : '' }}>{{ $p->nik }} - {{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pengurusan" class="form-label">Tanggal Pengurusan</label>
                            <input type="date" name="tanggal_pengurusan" id="tanggal_pengurusan" class="form-control" value="{{ old('tanggal_pengurusan', $pengurusanktp->tanggal_pengurusan) }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <option value="Proses" {{ $pengurusanktp->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $pengurusanktp->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak" {{ $pengurusanktp->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $pengurusanktp->keterangan) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('pengurusanktp.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection