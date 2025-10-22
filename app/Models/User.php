<?php

namespace App\Models;

// ... (use statements lainnya biarkan saja)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <-- TAMBAHKAN INI
    ];

    // ... (biarkan bagian $hidden dan $casts)

    // TAMBAHKAN RELASI DI BAWAH INI

    // Relasi: Satu User bisa meminjam banyak Aset
    public function assignedAssets()
    {
        return $this->hasMany(Asset::class, 'assigned_to_user_id');
    }

    // Relasi: Satu User bisa membuat banyak Riwayat Aset
    public function assetHistories()
    {
        return $this->hasMany(AssetHistory::class);
    }
}
