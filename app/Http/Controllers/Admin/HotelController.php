<?php

namespace App\Http\Controllers\Admin;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class HotelController extends Controller
{
    public function index() {
        $hotels = Hotel::all();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'room_type' => 'required|string',
            'room_quantity' => 'required|integer',
            'room_facilities' => 'required|string',
            'hotel_facilities' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        Hotel::create($data);
        return redirect()->route('hotels.index')->with('success', 'Hotel berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $hotel = Hotel::findOrFail($id);
        $data = $request->validate([
            'room_type' => 'required|string',
            'room_quantity' => 'required|integer',
            'room_facilities' => 'required|string',
            'hotel_facilities' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $hotel->update($data);
        return redirect()->route('hotels.index')->with('success', 'Hotel berhasil diperbarui');
    }

    public function destroy($id) {
        $hotel = Hotel::findOrFail($id);
        if ($hotel->image) {
            Storage::disk('public')->delete($hotel->image);
        }
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel berhasil dihapus');
    }
    public function edit($id) {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotels.edit', compact('hotel'));
    }


}
