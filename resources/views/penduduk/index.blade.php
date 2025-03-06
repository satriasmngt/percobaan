@extends('app')

@section('content')
<div class="container">
    <h1>Data Penduduk</h1>
    <a href="{{ route('penduduk.create') }}" class="btn btn-primary">Tambah Penduduk</a>
    <table class="table">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penduduk as $penduduk)
            <tr>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->nama }}</td>
                <td>{{ $penduduk->tanggal_lahir }}</td>
                <td>{{ $penduduk->tempat_lahir }}</td>
                <td>{{ $penduduk->jenis_kelamin }}</td>
                <td>{{ $penduduk->alamat }}</td>
                <td>
                    <a href="{{ route('penduduk.edit', $penduduk->nik) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('penduduk.destroy', $penduduk->nik) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection