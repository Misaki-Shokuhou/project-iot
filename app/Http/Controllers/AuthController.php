<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
use App\Models\Unregistered;
=======
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
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

<<<<<<< HEAD
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Anda sudah login.');
        }
    
        // Pastikan halaman login tidak dicache oleh browser
        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
    
=======
    public function showLoginForm()
    {
        return view('auth.login');
    }
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a

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
<<<<<<< HEAD
        session()->invalidate();
        session()->regenerateToken();
    
        return redirect('/login')->with('success', 'Berhasil logout.');
    }    
=======
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
}