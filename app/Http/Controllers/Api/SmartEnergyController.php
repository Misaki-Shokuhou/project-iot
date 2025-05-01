<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\SmartEnergy;

class SmartEnergyController extends Controller
{
    public function receive(Request $request)
    {
        // Validasi input
        $request->validate([
            'device_uid' => 'required|string',
            'volt' => 'required|numeric',
            'ampere' => 'required|numeric',
            'watt' => 'required|numeric',
        ]);

        // Cek apakah device ada
        $device = Device::where('device_uid', $request->device_uid)->first();

        if (!$device) {
            return response()->json(['message' => 'Device not registered.'], 404);
        }

        // Cek tipe device
        if ($device->tipe_device !== 'Smart Energy') {
            return response()->json(['message' => 'Incorrect device type.'], 400);
        }        

        // Simpan ke database smart_energy
        SmartEnergy::create([
            'id_device' => $device->id_device,
            'id_user' => $device->id_user,
            'data1' => $request->volt,
            'data2' => $request->ampere,
            'data3' => $request->watt,
        ]);

        return response()->json(['message' => 'Data received successfully.'], 200);
    }
}
