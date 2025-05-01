<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SmartEnergy;
use App\Models\SmartAgriculture;
use App\Models\SmartHome;

class GetAllDataController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email_username' => 'required|string',
            'password' => 'required|string|min:3',
        ]);

        $user = User::where('email', $request->email_username)
            ->orWhere('username', $request->email_username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('sensor-access-token')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Login gagal'], 401);
    }

    // GetAllDataController.php
    public function getSensorData(Request $request)
    {
        // Mendapatkan ID user yang sedang login
        $userId = $request->user()->id_user;

        // Ambil data dari SmartEnergy
        $smartEnergyData = SmartEnergy::where('id_user', $userId)->get();

        // Ambil data dari SmartAgriculture
        $smartAgricultureData = SmartAgriculture::where('id_user', $userId)->get();

        // Ambil data dari SmartHome
        $smartHomeData = SmartHome::where('id_user', $userId)->get();

        // Mengirim data ke response dalam bentuk JSON
        return response()->json([
            'smart_energy' => $smartEnergyData,
            'smart_agriculture' => $smartAgricultureData,
            'smart_home' => $smartHomeData
        ]);
    }

}
