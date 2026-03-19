<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Obtenir;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEtudiants = Etudiant::count();

        // 2. Total BACC (Compte les lignes dans 'obtenirs' où le diplôme contient "BACC")
        // Note : On utilise 'libelle_diplome' car c'est le nom utilisé dans ton ObtenirController
        $totalBACC = Obtenir::whereHas('diplome', function ($query) {
            $query->where('libelle_diplome', 'LIKE', '%BACC%');
        })->count();

        // 3. Total BEPC
        $totalBEPC = Obtenir::whereHas('diplome', function ($query) {
            $query->where('libelle_diplome', 'LIKE', '%BEPC%');
        })->count();

        // 1. Évolution annuelle (ex: 2022: 5, 2023: 12, 2024: 8)
        $evolutionData = Obtenir::selectRaw('YEAR(date_obtention) as year, count(*) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // 2. Répartition par mentions
        $mentionsData = Obtenir::selectRaw('mention, count(*) as total')
            ->groupBy('mention')
            ->get();

        // 3. Top Diplômes (Les 5 les plus fréquents)
        $topDiplomes = Obtenir::with('diplome')
            ->selectRaw('diplome_id, count(*) as total')
            ->groupBy('diplome_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $homme = Etudiant::where('sexe', 'Masculin')->count();
        $femme = Etudiant::where('sexe', 'Féminin')->count();

        return view ('Authentification.tableauDeBord', compact('totalEtudiants', 'homme', 'femme', 'totalBACC', 'totalBEPC', 'evolutionData', 'mentionsData', 'topDiplomes'));
    }
}
