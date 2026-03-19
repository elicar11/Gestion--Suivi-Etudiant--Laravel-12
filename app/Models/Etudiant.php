<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'adresse',
        'telephone',
        'annee_id'
    ];

    public function annee()
    {
        return $this->belongsTo(Annee::class, 'annee_id','id');
    }

    public function obtenirs()
    {
        return $this->hasMany(Obtenir::class);
    }
}
