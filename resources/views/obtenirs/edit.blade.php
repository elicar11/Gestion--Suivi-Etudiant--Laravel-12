<!-- MODAL 2 : MODIFIER -->
<div class="modal" id="modalModifierObtention">
    <div class="modal-content">
        <div class="modal-header">
            <h2 style="color: var(--primary);"><i class="fas fa-edit"></i> Modifier le Diplôme</h2>
            <span class="close-modal" onclick="closeEditModal()">&times;</span>
        </div>
        <form id="formModifierObtention" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id">
            <input type="hidden" name="etudiant_id" id="edit_etudiant_id">
            <input type="hidden" name="diplome_id" id="edit_diplome_id">

            <div class="form-group">
                <label>Matricule</label>
                <input type="text" id="edit_matricule" readonly>
            </div>

            <div class="form-group">
                <label>Nom & Prénom</label>
                <input type="text" id="edit_nom_prenom" readonly>
            </div>

            <div class="form-group">
                <label>Mention</label>
                <select name="mention" id="edit_mention" required>
                    <option value="Passable">Passable</option>
                    <option value="Assez-bien">Assez Bien</option>
                    <option value="Bien">Bien</option>
                    <option value="Très Bien">Très Bien</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date d'Obtention</label>
                <input type="date" name="date_obtention" id="edit_date" required>
            </div>

            <button type="submit" class="btn-save">Mettre à jour</button>
        </form>
    </div>
</div>
