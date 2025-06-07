<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\HistoryLocation; // Tambahkan ini
use App\Models\LocationHistory;
use Storage;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $appends = ['image_url_path'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'position',
        'department',
        'face_embedding',
        'image_url',
        'fcm_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke history_locations
    public function locationHistories()
    {
        return $this->hasMany(LocationHistory::class);
    }
    public function getImageUrlPathAttribute()
    {
        if ($this->image_url && Storage::disk('public')->exists($this->image_url)) {
            return Storage::disk('public')->url($this->image_url);
        }

        return asset('images/users/default.png');
    }
}
