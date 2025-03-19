@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Manajemen Hotel</h2>
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
@endsection
