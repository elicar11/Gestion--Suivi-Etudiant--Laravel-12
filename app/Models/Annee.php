<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    protected $fillable = [
        'libelle_annee',
        'date_debut',
        'date_fin',
    ];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
