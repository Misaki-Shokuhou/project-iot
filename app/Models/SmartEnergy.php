<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartEnergy extends Model
{
    use HasFactory;

    protected $table = 'smart_energy';
    protected $primaryKey = 'id_smart_energy';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_device',
        'id_user',
        'data1',
        'data2',
        'data3',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'id_device', 'id_device');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
