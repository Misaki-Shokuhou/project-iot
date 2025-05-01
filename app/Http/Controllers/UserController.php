<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Unregistered;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function deviceList()
    {
        $devices = Device::where('id_user', Auth::id())->get();
        return view('dashboard.device', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_device' => 'required|string|max:255',
            'device_uid' => 'required|string|max:255',
            'tipe_device' => 'required|string',
        ]);

        $unregisteredDevice = Unregistered::where('device_uid', $request->device_uid)
            ->where('tipe_device', $request->tipe_device)
            ->first();

        if ($unregisteredDevice) {
            $unregisteredDevice->delete();

            Device::create([
                'id_user' => Auth::id(),
                'device_uid' => $request->device_uid,
                'nama_device' => $request->nama_device,
                'tipe_device' => $request->tipe_device,
            ]);

            return redirect()->route('device.list')->with('success', 'Device successfully added!');
        } else {
            return back()->with('error', 'Device UUID or Type is not available!');
        }
    }

    // Fungsi untuk menampilkan halaman edit
    public function edit($id)
    {
        $device = Device::where('id_device', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        return view('dashboard.edit-device', compact('device'));
    }

    // Fungsi untuk update nama device
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_device' => 'required|string|max:255',
        ]);

        $device = Device::where('id_device', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $device->update([
            'nama_device' => $request->nama_device,
        ]);

        return redirect()->route('device.list')->with('success', 'Device successfully updated!');
    }

    // Fungsi untuk menghapus device
    public function destroy($id)
    {
        // Cari device milik user
        $device = Device::where('id_device', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Simpan data ke tabel unregistered sebelum hapus
        Unregistered::create([
            'device_uid' => $device->device_uid,
            'tipe_device' => $device->tipe_device,
        ]);

        // Hapus device dari tabel device
        $device->delete();

        return redirect()->route('device.list')->with('success', 'Device successfully deleted and moved to unregistered!');
    }
}
