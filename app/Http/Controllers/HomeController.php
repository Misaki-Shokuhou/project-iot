<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmartHome;
use App\Models\SmartAgriculture;
use App\Models\SmartEnergy;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil data terbaru dari setiap device milik user dari smart_energy
        $smartEnergyDevices = SmartEnergy::where('id_user', $userId)
            ->select('id_device')
            ->distinct()
            ->pluck('id_device');

        $smartEnergyData = collect();
        foreach ($smartEnergyDevices as $deviceId) {
            $data = SmartEnergy::where('id_user', $userId)
                ->where('id_device', $deviceId)
                ->latest()
                ->with('device')
                ->first();
            if ($data) {
                $smartEnergyData->push($data);
            }
        }

        // Ambil data terbaru dari setiap device milik user dari smart_agriculture
        $smartAgriDevices = SmartAgriculture::where('id_user', $userId)
            ->select('id_device')
            ->distinct()
            ->pluck('id_device');

        $smartAgriData = collect();
        foreach ($smartAgriDevices as $deviceId) {
            $data = SmartAgriculture::where('id_user', $userId)
                ->where('id_device', $deviceId)
                ->latest()
                ->with('device')
                ->first();
            if ($data) {
                $smartAgriData->push($data);
            }
        }

        // Ambil data terbaru dari setiap device milik user dari smart_home
        $smartHomeDevices = SmartHome::where('id_user', $userId)
            ->select('id_device')
            ->distinct()
            ->pluck('id_device');

        $smartHomeData = collect();
        foreach ($smartHomeDevices as $deviceId) {
            $data = SmartHome::where('id_user', $userId)
                ->where('id_device', $deviceId)
                ->latest()
                ->with('device')
                ->first();
            if ($data) {
                $smartHomeData->push($data);
            }
        }

        return view('dashboard.index', [
            'smartEnergyData' => $smartEnergyData,
            'smartAgriData' => $smartAgriData,
            'smartHomeData' => $smartHomeData,
        ]);
    }
}
