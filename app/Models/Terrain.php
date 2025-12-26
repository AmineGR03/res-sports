<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Terrain extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'prix_heure',
        'description',
        'image'
    ];

    protected $casts = [
        'prix_heure' => 'decimal:2'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            $path = public_path('storage/' . $this->image);
            if (file_exists($path)) {
                return asset('storage/' . $this->image);
            }
        }
        // Return default image with terrain name
        return 'data:image/svg+xml;base64,' . base64_encode('<svg width="800" height="400" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="#667eea"/>
            <text x="50%" y="40%" font-family="Arial, sans-serif" font-size="28" fill="white" text-anchor="middle" dominant-baseline="middle">' . htmlspecialchars($this->nom) . '</text>
            <text x="50%" y="60%" font-family="Arial, sans-serif" font-size="18" fill="white" text-anchor="middle" dominant-baseline="middle" opacity="0.8">' . htmlspecialchars(ucfirst($this->type)) . '</text>
        </svg>');
    }

    public function hasValidImage(): bool
    {
        if (!$this->image) {
            return false;
        }
        $path = public_path('storage/' . $this->image);
        return file_exists($path);
    }
}
