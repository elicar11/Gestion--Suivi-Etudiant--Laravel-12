{{-- @extends('layouts.app')

@section('content') --}}

{{-- @include('annees.index') --}}
<!-- MODAL 1 : AJOUTER -->
    <div class="modal" id="modalAnnee">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter une année</h2>
            </div>
            <form id="formAnnee" method="POST" action="{{ route('annees.store')}}">
                @csrf
                <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" id="libelle" name="libelle_annee" placeholder="Ex: 2024-2025" required>
                </div>
                <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" id="date_debut" name="date_debut" required>
                </div>
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" id="date_fin" name="date_fin" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">Annuler</button>
                    <button type="submit" class="btn-save">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Exemple simple pour synchroniser les inputs
        const inputDebut = document.querySelector('#date_debut');
        const inputFin = document.querySelector('#date_fin');

        inputDebut.addEventListener('change', function() {
            if (inputDebut.value) {
                inputFin.min = inputDebut.value; // Empêche de cliquer sur les dates précédentes dans le calendrier
            }
        });
    </script>
{{-- @endsection --}}
