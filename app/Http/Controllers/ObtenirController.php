<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use App\Models\Etudiant;
use App\Models\Obtenir;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class ObtenirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Initialiser la requête avec les relations
        $query = Obtenir::with(['etudiant', 'diplome']);

        // 2. Filtre par Année (Extraite de date_obtention)
        if ($request->filled('annee')) {
            $query->whereYear('date_obtention', $request->annee);
        }

        // 3. Filtre par Diplôme
        if ($request->filled('diplome_id')) {
            $query->where('diplome_id', $request->diplome_id);
        }

        // 4. Récupérer les résultats
        $obtenirs = $query->orderBy('date_obtention', 'desc')->get();

        // 5. Récupérer les données pour les menus déroulants des filtres
        $diplomes = Diplome::all();

        // Récupérer les années uniques de la table obtenirs pour le filtre
        $annees = Obtenir::selectRaw('YEAR(date_obtention) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $etudiants = Etudiant::all();
        $diplomes = Diplome::all();
        return view('obtenirs.index', compact('obtenirs', 'etudiants', 'diplomes', 'annees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obtenirs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mention'          => 'required|in:Passable,Assez-bien,Bien,Très Bien',
            'date_obtention'   => 'required|date',
            'etudiant_id'     => 'required|exists:etudiants,id',
            'diplome_id'      => 'required|exists:diplomes,id',
        ]);

        Obtenir::create($validated);
        return redirect()->route('obtenirs.index')->with('success', 'Diplôme a été attribué !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obtenir   = Obtenir::findOrFail($id);
        $etudiants = Etudiant::all();
        $diplomes  = Diplome::all();
        return view('obtenirs.edit', compact('obtenir', 'etudiants', 'diplomes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'mention'          => 'required|in:Passable,Assez-bien,Bien,Très Bien',
            'date_obtention'   => 'required|date',
            'etudiant_id'     => 'required',
            'diplome_id'      => 'required',
        ]);

        $obtenir = Obtenir::findOrFail($id);
        $obtenir->update($validated);

        return redirect()->route('obtenirs.index')->with('success', 'C\'est modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obtenir = Obtenir::findOrFail($id);
        $obtenir->delete();
        return redirect()->back()->with('success', 'Supprimé avec succès');
    }

    public function generatePdf(Request $request)
    {
        $annee = $request->input('annee');
        $diplome_id = $request->input('diplome_id');

        $query = Obtenir::with(['etudiant', 'diplome']);

        if ($request->filled('annee')) {
            $query->whereYear('date_obtention', $annee);
        }

        if ($request->filled('diplome_id')) {
            $query->where('diplome_id', $diplome_id);
        }

        $obtenirs = $query->orderBy('date_obtention', 'desc')->get();

        $filtre_annee = $annee ?? 'Toutes';
        $filtre_diplome = 'Tous';

        if ($request->filled('diplome_id')) {
            $d = \App\Models\Diplome::find($diplome_id);
            if ($d) {
                $filtre_diplome = $d->libelle_diplome;
            }
        }

        // Chargement de la vue
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('obtenirs.pdf', [
            'obtenirs' => $obtenirs,
            'filtre_annee' => $filtre_annee,
            'filtre_diplome' => $filtre_diplome,
            'date_edition' => now()->format('d/m/Y')
        ]);

        $pdf->setPaper('a4', 'portrait');

        // stream() affiche dans le navigateur, download() télécharge directement
        return $pdf->stream('liste_diplomes.pdf');
    }
}
