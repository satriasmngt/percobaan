@extends('app')

@section('content')
<div class="container">
    <h1>Edit Penduduk</h1>
    <form action="{{ route('penduduk.update', $penduduk->nik) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" name="nik" value="{{ $penduduk->nik }}" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $penduduk->nama }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" value="{{ $penduduk->tanggal_lahir }}" required>
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" value="{{ $penduduk->tempat_lahir }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" required>
                <option value="Laki-laki" {{ $penduduk->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $penduduk->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" name="alamat" required>{{ $penduduk->alamat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection