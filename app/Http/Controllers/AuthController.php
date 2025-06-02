<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel unregistered
        $unregisteredDevices = Unregistered::all();

        // Kirim data ke view
        return view('other.unregistered-list', compact('unregisteredDevices'));
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'max:255',
                Rule::unique('user', 'username'),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('user', 'email'),
            ],
            'password' => 'required|min:3',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email_username' => 'required|string',
            'password' => 'required|string|min:3',
        ]);

        // Cari user berdasarkan email atau username
        $user = User::where('email', $request->email_username)
                    ->orWhere('username', $request->email_username)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email_username' => 'Email/Username atau Password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}