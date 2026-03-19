<!-- MODAL 1 : AJOUTER -->
    <div id="diplomeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter un Diplôme</h2>
                <span class="close-modal" onclick="closeAddModal()">&times;</span>
            </div>
            <form id="diplomeForm" method="POST" action="{{route('diplomes.store')}}">
                @csrf
                <div class="form-group">
                    <label for="libelle">Libellé</label>
                    <input type="text" id="libelle" name="libelle_diplome" placeholder="BACC ou BEPC">
                </div>
                <button type="submit" class="btn-submit">Enregistrer</button>
            </form>
        </div>
    </div>
