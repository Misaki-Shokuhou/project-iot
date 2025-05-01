<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\SmartAgriculture;

class SmartAgricultureController extends Controller
{
    public function receive(Request $request)
    {
        // Validasi input
        $request->validate([
            'device_uid' => 'required|string',
            'level' => 'required|numeric',
            'temperature' => 'required|numeric',
        ]);

        // Cek apakah device ada
        $device = Device::where('device_uid', $request->device_uid)->first();

        if (!$device) {
            return response()->json(['message' => 'Device not registered.'], 404);
        }

        // Cek tipe device
        if ($device->tipe_device !== 'Smart Agriculture') {
            return response()->json(['message' => 'Incorrect device type.'], 400);
        }

        // Simpan data level dan suhu ke database smart_agriculture
        SmartAgriculture::create([
            'id_device' => $device->id_device,
            'id_user' => $device->id_user,
            'data1' => $request->level, // Level (dikirimkan ke data1)
            'data2' => $request->temperature, // Temperatur (dikirimkan ke data2)
        ]);

        return response()->json(['message' => 'Data received successfully.'], 200);
    }
}
