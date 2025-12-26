<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'terrain_id',
        'date',
        'heure_debut',
        'duree',
        'total',
        'statut',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'heure_debut' => 'datetime:H:i',
        'total' => 'decimal:2',
        'duree' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function terrain(): BelongsTo
    {
        return $this->belongsTo(Terrain::class);
    }

    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'reservation_equipement')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

    public function getHeureFinAttribute(): string
    {
        $heureDebut = strtotime($this->heure_debut);
        $heureFin = $heureDebut + ($this->duree * 3600);
        return date('H:i', $heureFin);
    }

    public function isDisponible(): bool
    {
        return $this->statut === 'confirmee' || $this->statut === 'terminee';
    }
}
