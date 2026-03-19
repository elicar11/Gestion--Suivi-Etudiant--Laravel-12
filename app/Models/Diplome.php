<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    protected $fillable = [
        'libelle_diplome',
    ];

    public function obtenirs()
    {
        return $this->hasMany(Obtenir::class);
    }
}
