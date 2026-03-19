<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class AnneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annees = Annee::orderBy('id', 'asc')->get();
        return view('annees.index', compact('annees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('annees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle_annee'=> 'required',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after:date_debut',
        ]);

        Annee::create($validated);

        return redirect()->route('annees.index')->with('success', 'Année a été bien ajouté!');
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
        $annee = Annee::findOrFail($id);
        return view ('annees.edit', compact('annee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'libelle_annee'=> 'required',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after:date_debut',
        ]);

        $annee = Annee::findOrFail($id);
        $annee ->update($validated);

        return redirect()->route('annees.index')->with('success', 'Année a été bien modifié!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annee = Annee::withCount('etudiants')->findOrFail($id);
        if($annee->etudiants_count > 0)
            {
                return back()->with('error', "Impossible de suprrimer: Ce année est utiliser par <strong> " .$annee->etudiants_count. " </strong> etudiants");
            }
        $annee ->delete();

        return redirect()->route('annees.index')->with('success', 'Année a été bien supprimé!');
    }
}
