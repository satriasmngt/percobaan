@extends('app')

@section('content')
<div class="container">
    <h1>Daftar Pengurusan KTP</h1>
    <a href="{{ route('pengurusanktp.create') }}" class="btn btn-primary mb-3">Tambah Pengurusan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>NIK Penduduk</th>
                <th>Nama Penduduk</th>
                <th>Tanggal Pengurusan</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengurusanktp as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->penduduk->nik ?? 'Data Tidak Ada' }}</td>
                <td>{{ $item->penduduk->nama ?? 'Data Tidak Ada' }}</td>
                <td>{{ $item->tanggal_pengurusan }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>
                    <a href="{{ route('pengurusanktp.edit', $item->penduduk_nik) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pengurusanktp.destroy', $item->penduduk_nik) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data pengurusan KTP</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection