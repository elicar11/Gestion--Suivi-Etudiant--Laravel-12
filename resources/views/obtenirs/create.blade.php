    <!-- MODAL 1 : AJOUTER -->
    <div class="modal" id="modalObtention">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter une Obtention</h2>
                <span class="close-modal" onclick="closeAddModal()">&times;</span>
            </div>
            <form id="formObtention" method="POST" action="{{route('obtenirs.store')}}">
                @csrf
                <div class="form-group">
                    <label>Matricule</label>
                    <select name="etudiant_id" id="select_etudiant" onchange="remplirChampsEtudiant()" required>
                        <option value="">Sélectionner</option>
                        @foreach ($etudiants as $etudiant)
                        <option value="{{$etudiant->id}}" data-nom="{{$etudiant->nom}}" data-prenom="{{$etudiant->prenom}}">
                            {{$etudiant->matricule}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" id="add_nom" readonly required>
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" id="add_prenom" readonly required>
                </div>
                <div class="form-group">
                    <label>Diplôme</label>
                    <select name="diplome_id" required>
                        <option value="">Sélectionner une diplôme</option>
                        @foreach ($diplomes as $diplome)
                            <option value="{{$diplome->id}}">
                                {{$diplome->libelle_diplome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mention</label>
                    <select name="mention" required>
                        <option value="">Sélectionner une mention</option>
                        <option value="Passable" {{old('mention') == 'Passable' ? 'selected' : ''}}>Passable</option>
                        <option value="Assez-bien" {{old('mention') == 'Assez-bien' ? 'selected' : ''}}>Assez Bien</option>
                        <option value="Bien" {{old('mention') == 'Bien' ? 'selected' : ''}}>Bien</option>
                        <option value="Très Bien" {{old('mention') == 'Très Bien' ? 'selected' : ''}}>Très Bien</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date d'Obtention</label>
                    <input type="date" name="date_obtention" value="{{old('date_obtention')}}" required></div>
                <button type="submit" class="btn-save">Enregistrer</button>
            </form>
        </div>
    </div>
