<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
=======
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard/index');
// });

// Route::get('/device', function () {
//     return view('dashboard/device');
// });

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a

// Register routes tetap
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout route (tambahan jika perlu)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman setelah login
<<<<<<< HEAD
Route::get('/', [HomeController::class, 'index'])->middleware('auth');


=======
Route::get('/', function () {
    return view('dashboard/index'); // atau halaman utama kamu
})->middleware('auth');


// // Halaman Tambah Device
// Route::get('/add-device', function () {
//     return view('dashboard/add-device'); 
// })->middleware('auth');

>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
// Halaman Tambah Device
Route::get('/add-device', function () {
    return view('dashboard/add-device');
})->middleware('auth');

<<<<<<< HEAD
// Halaman Device User
=======
// Halaman Device
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
Route::get('/device', [UserController::class, 'deviceList'])->middleware('auth')->name('device.list');

// Menyimpan Device setelah validasi
Route::post('/add-device', [UserController::class, 'store'])->middleware('auth');

// Edit Device
Route::get('/edit-device/{id}', [UserController::class, 'edit'])->middleware('auth')->name('device.edit');

// Update Device
Route::post('/update-device/{id}', [UserController::class, 'update'])->middleware('auth')->name('device.update');

<<<<<<< HEAD
// Delete Device
Route::post('/device/delete/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('device.destroy');


=======
Route::post('/device/delete/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('device.destroy');




>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/new-device', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
    Route::post('/new-device', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::get('/edit-new-device/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('edit.device');
<<<<<<< HEAD
    Route::put('/edit-new-device/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::post('/delete-device/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('delete.device');
});


// // Halaman Tambah Device
// Route::get('/add-device', function () {
//     return view('dashboard/add-device'); 
// })->middleware('auth');

// Route::get('/', function () {
//     return view('dashboard/index');
// });

// Route::get('/device', function () {
//     return view('dashboard/device');
// });
=======
    Route::put('/edit-new-device/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update'); 
    Route::post('/delete-device/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('delete.device');
});
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
