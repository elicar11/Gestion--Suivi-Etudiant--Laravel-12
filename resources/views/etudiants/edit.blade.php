<!-- MODAL 2 : MODIFIER -->
<div class="modal" id="editStudentModal{{ $etudiant->id }}"> <!-- ID unique pour chaque modal -->
    <div class="modal-content">
        <div class="modal-header">
            <h2 style="color: var(--primary);"><i class="fas fa-user-edit"></i> Modifier l'étudiant</h2>
            <span class="close-modal" onclick="closeEditModal({{ $etudiant->id }})">&times;</span>
        </div>

        <form id="editStudentForm{{ $etudiant->id }}" method="POST" action="{{ route('etudiants.update', $etudiant->id) }}">
            @csrf
            @method('PUT') <!-- Ajout de la méthode PUT pour Laravel -->

            <div class="form-grid">
                <div class="form-group">
                    <label>Matricule</label>
                    <input type="text" name="matricule" value="{{ old('matricule', $etudiant->matricule) }}" required>
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" value="{{ old('nom', $etudiant->nom) }}" required>
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required>
                </div>
                <div class="form-group">
                    <label>Sexe</label>
                    <select name="sexe" required>
                        <option value="Masculin" {{ $etudiant->sexe == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                        <option value="Féminin" {{ $etudiant->sexe == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date de Naissance</label>
                    <input type="date" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}" required>
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required>
                </div>
                <div class="form-group">
                    <label>Année Académique</label>
                    <select name="annee_id" required>
                        <option value="">Sélectionner une année</option>
                        @foreach ($annees as $annee)
                            <option value="{{ $annee->id }}" {{ $etudiant->annee_id == $annee->id ? 'selected' : '' }}>
                                {{ $annee->libelle_annee }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group full">
                    <label>Adresse</label>
                    <input type="text" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Mettre à jour les informations</button>
        </form>
    </div>
</div>
