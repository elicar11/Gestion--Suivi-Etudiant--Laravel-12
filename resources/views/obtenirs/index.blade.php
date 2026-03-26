@extends('layouts.app')

@section('title', 'Obtention')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Succès !</strong>
                <p>{{ session('success') }}</p>
            </div>
            <button class="alert-close" onclick="this.parentElement.style.display='none';">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <strong>Erreur !</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button class="alert-close" onclick="this.parentElement.style.display='none';">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    <!-- CONTENU PRINCIPAL -->
    <h1>Obtention du Diplôme</h1><br>
    <button class="btn-add" onclick="openAddModal()"><i class="fas fa-plus"></i> Ajouter</button><br>

    <!-- SECTION FILTRES -->
    <section class="filters-section"
        style="background: rgba(255, 255, 255, 0.03); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <form action="{{ route('obtenirs.index') }}" method="GET"
            style="display: flex; gap: 15px; align-items: flex-end;">

            <!-- Filtre Année -->
            <div class="filter-group">
                <label for="annee" style="display: block; margin-bottom: 5px; font-weight: bold;">Année :</label>
                <select name="annee" id="annee" class="form-control"
                    style="padding: 8px; border-radius: 4px; border: 1px solid;">
                    <option value="">Toutes les années</option>
                    @foreach ($annees as $annee)
                        <option value="{{ $annee }}" {{ request('annee') == $annee ? 'selected' : '' }}>
                            {{ $annee }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre Diplôme -->
            <div class="filter-group">
                <label for="diplome_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Diplôme :</label>
                <select name="diplome_id" id="diplome_id" class="form-control"
                    style="padding: 8px; border-radius: 4px; border: 1px solid;">
                    <option value="">Tous les diplômes</option>
                    @foreach ($diplomes as $diplome)
                        <option value="{{ $diplome->id }}" {{ request('diplome_id') == $diplome->id ? 'selected' : '' }}>
                            {{ $diplome->libelle_diplome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre Mention -->
            <div class="filter-group">
                <label for="mention" style="display: block; margin-bottom: 5px; font-weight: bold;">Mention :</label>
                <select name="mention" id="mention" class="form-control"
                    style="padding: 8px; border-radius: 4px; border: 1px solid;">
                    <option value="">Toutes les mentions</option>
                    @php
                        $mentions = ['Passable', 'Assez-bien', 'Bien', 'Très Bien'];
                    @endphp
                    @foreach ($mentions as $m)
                        <option value="{{ $m }}" {{ request('mention') == $m ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Boutons -->
            <div class="filter-actions">
                <button type="submit" class="btn-add" style="background-color: #3498db; margin-bottom: 0;">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('obtenirs.index') }}" class="btn-add"
                    style="background-color: #e74c3c; text-decoration: none; display: inline-block;">
                    <i class="fas fa-sync"></i> Réinitialiser
                </a>
            </div>

            <div class="filter-actions">
                <button type="submit" formaction="{{ route('obtenirs.pdf') }}" formmethod="GET" formtarget="_blank"
                    class="btn-add"
                    style="background-color: #27ae60; border: none; cursor: pointer; text-decoration: none; display: inline-block;">
                    <i class="fas fa-print"></i> Imprimer PDF
                </button>
            </div>
        </form>

    </section>

    <!-- TABLEAU -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Diplôme</th>
                    <th>Mention</th>
                    <th>Date Obtention</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($obtenirs as $obtenir)
                    <tr>
                        {{-- <td>{{ $obtenir->id }}</td> --}}
                        <td>{{ $obtenir->etudiant->matricule }}</td>
                        <td>{{ $obtenir->etudiant->nom }}</td>
                        <td>{{ $obtenir->etudiant->prenom }}</td>
                        <td>{{ $obtenir->diplome->libelle_diplome }}</td>
                        <td>
                            @php
                                // On définit la classe en fonction de la mention
                                $classe = 'm-passable'; // par défaut
                                if ($obtenir->mention == 'Assez-bien') {
                                    $classe = 'm-assez-bien';
                                }
                                if ($obtenir->mention == 'Bien') {
                                    $classe = 'm-bien';
                                }
                                if ($obtenir->mention == 'Très Bien') {
                                    $classe = 'm-tres-bien';
                                }
                            @endphp

                            <span class="badge-mention {{ $classe }}">
                                {{ $obtenir->mention }}
                            </span>
                        </td>
                        <td>{{ $obtenir->date_obtention }}</td>
                        <td class="action-icons">
                            <i class="fas fa-edit" onclick="openEditModal({{ json_encode($obtenir) }})"></i>

                            <i class="fas fa-trash" style="cursor:pointer; color: var(--danger);"
                                onclick="openDeleteModal({{ $obtenir->id }})"></i>
                        </td>
                    </tr>
                    @include('obtenirs.edit')
                    @include('obtenirs.delete')
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container" style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $obtenirs->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
    </main>
    @include('obtenirs.create')

    <script>
        // 1. Déclarations uniques (Une seule fois !)
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-btn');
        const modalAdd = document.getElementById('modalObtention');
        const modalEdit = document.getElementById('modalModifierObtention');

        // 2. Sidebar
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });
        }

        // 3. Fonctions Modal Ajout
        function openAddModal() {
            modalAdd.style.display = 'flex';
        }

        function closeAddModal() {
            modalAdd.style.display = 'none';
        }

        function remplirChampsEtudiant() {
            const select = document.getElementById('select_etudiant');
            const selectedOption = select.options[select.selectedIndex];
            if (selectedOption.value !== "") {
                document.getElementById('add_nom').value = selectedOption.getAttribute('data-nom') || '';
                document.getElementById('add_prenom').value = selectedOption.getAttribute('data-prenom') || '';
            }
        }

        // 4. Fonctions Modal Modifier (C'est ici que l'erreur "null" se produisait)
        function openEditModal(obtenir) {
            const form = document.getElementById('formModifierObtention');

            // On change l'URL de l'action
            form.action = '/obtenirs/' + obtenir.id;

            // On remplit les champs (les IDs doivent exister dans edit.blade.php)
            document.getElementById('edit_id').value = obtenir.id;
            document.getElementById('edit_etudiant_id').value = obtenir.etudiant_id;
            document.getElementById('edit_diplome_id').value = obtenir.diplome_id;

            document.getElementById('edit_matricule').value = obtenir.etudiant.matricule;
            document.getElementById('edit_nom_prenom').value = obtenir.etudiant.nom + ' ' + obtenir.etudiant.prenom;

            document.getElementById('edit_mention').value = obtenir.mention;
            document.getElementById('edit_date').value = obtenir.date_obtention;

            modalEdit.style.display = 'flex';
        }

        // 6. Fonctions Modal Suppression
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModalObtention' + id);
            if (modal) {
                modal.style.display = 'flex';
            }
        }

        function closeDeleteModal(id) {
            const modal = document.getElementById('deleteModalObtention' + id);
            if (modal) {
                modal.style.display = 'none';
            }
        }


        function closeEditModal() {
            modalEdit.style.display = 'none';
        }

        // 5. Fermeture au clic extérieur
        // window.onclick = function(event) {
        //     if (event.target == modalAdd) closeAddModal();
        //     if (event.target == modalEdit) closeEditModal();
        // }

        @if ($errors->any())
            window.onload = function() {
                openAddModal(); // Appelle ta fonction existante pour ouvrir le modal
            };
        @endif
    </script>

@endsection
