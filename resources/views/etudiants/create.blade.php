<!-- MODAL 1 : AJOUTER -->
<div class="modal" id="studentModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Ajouter un étudiant</h2>
            <span class="close-modal" onclick="closeAddModal()">&times;</span>
        </div>
        <form id="studentForm" method="POST" action="{{ route('etudiants.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Matricule</label>
                    <input type="text" name="matricule" value="{{ old('matricule') }}" placeholder="Ex: MAT-001"
                        required>
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom de l'étudiant"
                        required>
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Prénom de l'étudiant"
                        required>
                </div>
                <div class="form-group">
                    <label>Date de Naissance</label>
                    <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required>
                    {{-- Petit message d'erreur sous l'input --}}
                    @error('date_naissance')
                        <span style="color: #ef4444; font-size: 0.75rem; margin-top: 5px; display: block;">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Sexe</label>
                    <select name="sexe" required>
                        <option value="">Sélectionner</option>
                        <option value="Masculin" {{ old('sexe') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                        <option value="Féminin" {{ old('sexe') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" value="{{ old('telephone') }}" placeholder="+221..."
                        required>
                </div>
                <div class="form-group">
                    <label>Année</label>
                    <select name="annee_id" required>
                        <option value="">Sélectionner une année</option>
                        @foreach ($annees as $annee)
                            <option value="{{ $annee->id }}" {{ old('annee_id') == $annee->id ? 'selected' : '' }}>
                                {{ $annee->libelle_annee }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Adresse complète"
                        required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Enregistrer les informations</button>
        </form>
    </div>
</div>
