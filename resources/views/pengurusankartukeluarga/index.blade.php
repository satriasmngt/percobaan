@extends('app')

@section('content')
<div class="container">
    <h1>Daftar Pengurusan Kartu Keluarga</h1>

    <!-- Tombol Tambah Data -->
    <div class="mb-3">
        <a href="{{ route('pengurusankartukeluarga.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    <!-- Tabel data -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Pengurusan</th>
                <th>Status</th>
                <th>Dokumen</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengurusanKK as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tanggal_pengurusan }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>
                        @if($item->dokumen)
                            <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank">Lihat</a>
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('pengurusankartukeluarga.edit', $item->nik) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('pengurusankartukeluarga.destroy', $item->nik) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
