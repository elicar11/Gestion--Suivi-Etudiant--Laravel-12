    <!-- MODAL 2 : MODIFIER (NOUVEAU) -->
    <div id="editDiplomeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: var(--primary);"><i class="fas fa-edit"></i> Modifier le Diplôme</h2>
                <span class="close-modal" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editDiplomeForm" method="POST" action="{{route('diplomes.update', $diplome->id)}}" >
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_libelle">Libellé</label>
                    <input type="text" id="edit_libelle" name="libelle_diplome" value="{{old('libelle_diplome', $diplome->libelle_diplome)}}">
                </div>
                <button type="submit" class="btn-submit" style="background: #00d2ff; color: #0f172a;">Mettre à jour</button>
            </form>
        </div>
    </div>
