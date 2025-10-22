<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'asset_code',
        'description',
        'image',
        'purchase_date',
        'purchase_price',
        'status',
        'category_id',
        'location_id',
        'assigned_to_user_id',
    ];

    // Relasi: Satu Aset dimiliki oleh satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Satu Aset berada di satu Lokasi
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Relasi: Satu Aset dipinjam oleh satu User
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    // Relasi: Satu Aset punya banyak Riwayat
    public function histories()
    {
        return $this->hasMany(AssetHistory::class);
    }
}
