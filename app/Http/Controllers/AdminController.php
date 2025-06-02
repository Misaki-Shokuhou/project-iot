<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unregistered; // pastikan ini ada, sesuaikan nama model kamu

class AdminController extends Controller
{
    public function index()
    {
        // Menampilkan semua device unregistered
        $devices = Unregistered::all(); // Ambil semua data perangkat yang belum terdaftar
        return view('other.dashboard-admin', compact('devices')); // Kirim data ke view
    }

    public function create()
    {
        // Menampilkan form untuk tambah device
        return view('other.new-device');
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'device_uid' => 'required|unique:unregistered,device_uid',
            'tipe_device' => 'required',
        ]);

        // Simpan ke database
        Unregistered::create([
            'device_uid' => $request->device_uid,
            'tipe_device' => $request->tipe_device,
        ]);

        // Setelah simpan, redirect kembali ke dashboard-admin
        return redirect()->route('admin.index')->with('success', 'Device berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        // Cari device berdasarkan id
        $device = Unregistered::findOrFail($id);
        // Tampilkan view edit dengan data device
        return view('other.edit-new-device', compact('device'));
    }
    
    public function update(Request $request, string $id)
    {
        // Validasi input form
        $request->validate([
            'device_uid' => 'required|unique:unregistered,device_uid,' . $id . ',id_unregistered',
            'tipe_device' => 'required',
        ]);
    
        // Cari device berdasarkan id
        $device = Unregistered::findOrFail($id);
    
        // Update data device
        $device->update([
            'device_uid' => $request->device_uid,
            'tipe_device' => $request->tipe_device,
        ]);
    
        // Redirect kembali ke dashboard-admin
        return redirect()->route('admin.index')->with('success', 'Device berhasil diupdate!');
    }    

    public function destroy(string $id)
    {
        // Proses untuk hapus device
        Unregistered::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Device berhasil dihapus!');
    }
}
