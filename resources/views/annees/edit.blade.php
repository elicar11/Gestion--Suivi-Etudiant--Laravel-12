<!-- MODAL 2 : MODIFIER (NOUVEAU) -->
    <div class="modal" id="modalModifierAnnee">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: #00d2ff;"><i class="fas fa-edit"></i> Modifier l'année</h2>
            </div>
            <form id="formModifierAnnee"  method="POST" action="{{route('annees.update', $annee->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" id="edit_libelle" name="libelle_annee" value="{{old('libelle_annee', $annee->libelle_annee)}}" required>
                </div>
                <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" id="edit_date_debut" name="date_debut" value="{{old('date_debut', $annee->date_debut)}}" required>
                </div>
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" id="edit_date_fin" name="date_fin" value="{{old('date_fin', $annee->date_fin)}}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Annuler</button>
                    <button type="submit" class="btn-save" style="background: #00d2ff;">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
