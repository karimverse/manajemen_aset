<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
    ];

    // Relasi: Satu Lokasi punya banyak Aset
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
