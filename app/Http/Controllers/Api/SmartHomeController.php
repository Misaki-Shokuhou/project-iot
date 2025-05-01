<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\SmartHome;

class SmartHomeController extends Controller
{
    public function receive(Request $request)
    {
        // Validasi input
        $request->validate([
            'device_uid' => 'required|string',
            'sensor_value' => 'required|numeric',
        ]);

        // Cek apakah device ada
        $device = Device::where('device_uid', $request->device_uid)->first();

        if (!$device) {
            return response()->json(['message' => 'Device not registered.'], 404);
        }

        // Cek tipe device
        if ($device->tipe_device !== 'Smart Home') {
            return response()->json(['message' => 'Incorrect device type.'], 400);
        }

        // Simpan ke database smart_home
        SmartHome::create([
            'id_device' => $device->id_device,
            'id_user' => $device->id_user,
            'data1' => $request->sensor_value,  // Menyimpan nilai sensor gas ke kolom data1
        ]);

        return response()->json(['message' => 'Data received successfully.'], 200);
    }
}
