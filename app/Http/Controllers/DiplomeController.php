<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diplomes = Diplome::all();
        return view('diplomes.index', compact('diplomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diplomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle_diplome' => 'required'
        ]);

        Diplome::create($validated);

        return redirect()->route('diplomes.index')->with('success', 'Diplôme a été bien ajouté');
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
        $diplome = Diplome::findOrFail($id);
        return view('diplomes.edit', compact('diplome'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'libelle_diplome' => 'required'
        ]);

        $diplome = Diplome::findOrFail($id);
        $diplome -> update($validated);

        return redirect()->route('diplomes.index')->with('success', 'Diplôme a été bien modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diplome = Diplome::withCount('obtenirs')->findOrFail($id);
        if($diplome->obtenirs_count > 0)
            {
                return back()->with('error', "Impossible de supprimer: Ce diplôme est utilisé par <strong> " .$diplome->obtenirs_count. " </strong> étudiants");
                }

        $diplome -> delete();
        return back()->with('success', 'Diplôme a été bien supprimé');
    }
}
