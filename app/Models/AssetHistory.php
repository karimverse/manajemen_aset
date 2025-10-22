<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'user_id',
        'action',
        'notes',
    ];

    // Relasi: Satu Riwayat dimiliki oleh satu Aset
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    // Relasi: Satu Riwayat dilakukan oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
