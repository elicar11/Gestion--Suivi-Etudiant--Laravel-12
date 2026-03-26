<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Etudiant::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('matricule', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('date_naissance', [$request->date_debut, $request->date_fin]);
        }

        $etudiants = $query->with('annee')
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $totalEtudiants = Etudiant::count();


        $annees = Annee::all(); // Pour tes modals

        return view('etudiants.index', compact('etudiants', 'annees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $annees = Annee::all();
        return view('etudiants.create', compact('annees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule'     => 'required|unique:etudiants,matricule',
            'nom'           => [
                'required',
                'string',
                'max:50',
                Rule::unique('etudiants')->where(function ($query) use ($request) {
                    return $query->where('nom', $request->nom)
                        ->where('prenom', $request->prenom);
                }),
            ],
            'prenom'        => 'required|string|max:50',
            'date_naissance' => [
                'required',
                'date',
                'before:today',
                'before:-10 years',
                'after:2000-01-01',
            ],
            'sexe'          => 'required|in:Masculin,Féminin',
            'adresse'       => 'required|string',
            'telephone'     => 'required|numeric|digits:10',
            'annee_id'      => 'required|exists:annees,id',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')->with('success', 'Etudiant a été bien ajouté');
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
        $etudiant = Etudiant::findOrFail($id);
        $annees = Annee::all();

        return view('etudiants.edit', compact('etudiant', 'annees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'matricule'     => 'required|unique:etudiants,matricule,' . $id,
            'nom' => [
                'required',
                Rule::unique('etudiants')->where(function ($query) use ($request) {
                    return $query->where('nom', $request->nom)
                        ->where('prenom', $request->prenom);
                })->ignore($id),
            ],
            'prenom'        => 'required|string|max:50',
            'date_naissance' => 'required|date',
            'sexe'          => 'required|in:Masculin,Féminin',
            'adresse'       => 'required|string',
            'telephone'     => 'required|string',
            'annee_id'      => 'required|exists:annees,id',
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->update($validated);

        return redirect()->route('etudiants.index')->with('success', 'Etudiant a été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('success', 'Etudiant a été bien supprimer');
    }
}
