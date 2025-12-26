<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'quantite',
        'prix_location',
        'description'
    ];

    protected $casts = [
        'prix_location' => 'decimal:2',
        'quantite' => 'integer'
    ];

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservation_equipement')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}
