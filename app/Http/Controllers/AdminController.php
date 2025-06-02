<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Validator;
use App\Models\Device;
use App\Models\Unregistered;
=======
use App\Models\Unregistered; // pastikan ini ada, sesuaikan nama model kamu
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a

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
<<<<<<< HEAD
        $request->validate([
            'device_uid' => 'required',
            'tipe_device' => 'required',
        ]);
    
        // Cek manual apakah UID sudah ada di table device atau unregistered
        $uidExistsInDevices = \App\Models\Device::where('device_uid', $request->device_uid)->exists();
        $uidExistsInUnregistered = \App\Models\Unregistered::where('device_uid', $request->device_uid)->exists();
    
        if ($uidExistsInDevices || $uidExistsInUnregistered) {
            return back()
                ->withErrors(['device_uid' => 'Device UID telah digunakan. Silahkan gunakan UID lain.'])
                ->withInput();
        }
    
=======
        // Validasi input form
        $request->validate([
            'device_uid' => 'required|unique:unregistered,device_uid',
            'tipe_device' => 'required',
        ]);

        // Simpan ke database
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
        Unregistered::create([
            'device_uid' => $request->device_uid,
            'tipe_device' => $request->tipe_device,
        ]);
<<<<<<< HEAD
    
=======

        // Setelah simpan, redirect kembali ke dashboard-admin
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
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
<<<<<<< HEAD
        $device = Unregistered::findOrFail($id);
    
        $request->validate([
            'device_uid' => [
                'required',
                function ($attribute, $value, $fail) use ($id, $device) {
                    // Cek jika UID sudah ada di tabel devices
                    if (\DB::table('device')->where('device_uid', $value)->exists()) {
                        return $fail('Device UID telah digunakan. Silahkan gunakan UID lain.');
                    }
    
                    // Cek jika UID sudah ada di tabel unregistered
                    $existingUnregistered = \DB::table('unregistered')
                        ->where('device_uid', $value)
                        ->where('id_unregistered', '!=', $id)
                        ->first();
    
                    if ($existingUnregistered) {
                        return $fail('Device UID telah digunakan. Silahkan gunakan UID lain.');
                    }
                }
            ],
            'tipe_device' => 'required',
        ]);
    
        // Update data
=======
        // Validasi input form
        $request->validate([
            'device_uid' => 'required|unique:unregistered,device_uid,' . $id . ',id_unregistered',
            'tipe_device' => 'required',
        ]);
    
        // Cari device berdasarkan id
        $device = Unregistered::findOrFail($id);
    
        // Update data device
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
        $device->update([
            'device_uid' => $request->device_uid,
            'tipe_device' => $request->tipe_device,
        ]);
    
<<<<<<< HEAD
        return redirect()->route('admin.index')->with('success', 'Device berhasil diupdate!');
    } 
=======
        // Redirect kembali ke dashboard-admin
        return redirect()->route('admin.index')->with('success', 'Device berhasil diupdate!');
    }    
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a

    public function destroy(string $id)
    {
        // Proses untuk hapus device
        Unregistered::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Device berhasil dihapus!');
    }
}
