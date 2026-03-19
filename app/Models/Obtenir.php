<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obtenir extends Model
{
    protected $fillable = [
        'mention',
        'date_obtention',
        'etudiant_id',
        'diplome_id',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function diplome()
    {
        return $this->belongsTo(Diplome::class);
    }
}
