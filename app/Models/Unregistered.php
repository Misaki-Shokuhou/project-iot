<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unregistered extends Model
{
    use HasFactory;

    protected $table = 'unregistered'; // Nama tabel di database

    protected $primaryKey = 'id_unregistered'; // Primary key khusus

    protected $fillable = [
        'device_uid',
        'tipe_device',
    ];

    // (Opsional) Kalau kamu tidak pakai auto-increment ID, tambah ini:
    // public $incrementing = true;

    // (Opsional) Kalau primary key bukan integer, tambah ini:
    // protected $keyType = 'string';
}
