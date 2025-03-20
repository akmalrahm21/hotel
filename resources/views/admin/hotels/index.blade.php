@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Manajemen Hotel</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#hotelModal">Tambah Hotel</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis Kamar</th>
                <th>Jumlah</th>
                <th>Fasilitas Kamar</th>
                <th>Fasilitas Hotel</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
            <tr>
                <td>{{ $hotel->room_type }}</td>
                <td>{{ $hotel->room_quantity }}</td>
                <td>{{ $hotel->room_facilities }}</td>
                <td>{{ $hotel->hotel_facilities }}</td>
                <td>{{ $hotel->description }}</td>
                <td><img src="{{ asset('storage/' . $hotel->image) }}" width="100"></td>
                <td>
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Hotel -->
<div class="modal fade" id="hotelModal" tabindex="-1" aria-labelledby="hotelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hotelModalLabel">Tambah Hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Jenis Kamar</label>
                        <input type="text" name="room_type" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="room_quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Fasilitas Kamar</label>
                        <textarea name="room_facilities" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Fasilitas Hotel</label>
                        <textarea name="hotel_facilities" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
