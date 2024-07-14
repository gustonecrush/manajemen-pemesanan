<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mitra extends Authenticatable
{
    use Notifiable;

    use HasFactory;
    protected $guarded = ['id'];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'mitra_id');
    }
}
