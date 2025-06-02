<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'device'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_device'; // Primary key sesuai dengan migrasi
    public $incrementing = true; // Menggunakan auto increment
    protected $keyType = 'int'; // Tipe data primary key adalah integer

    protected $fillable = [
        'id_user',
        'device_uid',
        'nama_device',
        'tipe_device',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke SmartHome
    public function smartHome()
    {
        return $this->hasOne(SmartHome::class, 'id_device', 'id_device');
    }

    // Relasi ke SmartAgriculture
    public function smartAgriculture()
    {
        return $this->hasOne(SmartAgriculture::class, 'id_device', 'id_device');
    }

    // Relasi ke SmartEnergy
    public function smartEnergy()
    {
        return $this->hasOne(SmartEnergy::class, 'id_device', 'id_device');
    }
}
