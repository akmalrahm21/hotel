@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Edit Hotel</h2>
    <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Jenis Kamar</label>
            <input type="text" name="room_type" class="form-control" value="{{ $hotel->room_type }}" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="room_quantity" class="form-control" value="{{ $hotel->room_quantity }}" required>
        </div>
        <div class="mb-3">
            <label>Fasilitas Kamar</label>
            <textarea name="room_facilities" class="form-control" required>{{ $hotel->room_facilities }}</textarea>
        </div>
        <div class="mb-3">
            <label>Fasilitas Hotel</label>
            <textarea name="hotel_facilities" class="form-control" required>{{ $hotel->hotel_facilities }}</textarea>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $hotel->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
            <br>
            <img src="{{ asset('storage/' . $hotel->image) }}" width="100">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
