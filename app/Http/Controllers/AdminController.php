<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Device;
use App\Models\Unregistered;

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
    
        Unregistered::create([
            'device_uid' => $request->device_uid,
            'tipe_device' => $request->tipe_device,
        ]);
    
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
        $device->update([
            'device_uid' => $request->device_uid,
            'tipe_device' => $request->tipe_device,
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Device berhasil diupdate!');
    } 

    public function destroy(string $id)
    {
        // Proses untuk hapus device
        Unregistered::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Device berhasil dihapus!');
    }
}
