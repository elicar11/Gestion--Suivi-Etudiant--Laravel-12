@extends('layouts.app')

@section('title', 'Diplôme')

@section('content')
    <!-- CONTENU PRINCIPAL -->
        <section class="welcome-card">
            <h1>Diplôme</h1>
            <p>Gérez vos diplômes et suivez votre parcours académique en temps réel.</p>
        </section><br>

        <!-- TABLEAU DES DIPLOMES -->
        <div class="header-actions">
            <h2>Liste des diplômes</h2>
            <button class="btn-add" onclick="openAddModal()">
                <i class="fas fa-plus"></i> Ajouter Diplôme
            </button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Type Diplôme</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#01</td>
                        <td>Licence Informatique</td>
                        <td>Bac +3 (Licence)</td>
                        <td>
                            <div class="action-icons">
                                <i class="fas fa-edit" onclick="openEditModal(this)"></i>
                                <i class="fas fa-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#02</td>
                        <td>Master Cybersécurité</td>
                        <td>Bac +5 (Master)</td>
                        <td>
                            <div class="action-icons">
                                <i class="fas fa-edit" onclick="openEditModal(this)"></i>
                                <i class="fas fa-trash"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- MODAL 1 : AJOUTER -->
    <div id="diplomeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter un Diplôme</h2>
                <span class="close-modal" onclick="closeAddModal()">&times;</span>
            </div>
            <form id="diplomeForm">
                <div class="form-group">
                    <label for="libelle">Libellé</label>
                    <input type="text" id="libelle" placeholder="Ex: Master Informatique">
                </div>
                <div class="form-group">
                    <label for="type">Type Diplôme</label>
                    <select id="type">
                        <option value="bac+2">Bac +2</option>
                        <option value="bac+3">Bac +3 (Licence)</option>
                        <option value="bac+5">Bac +5 (Master)</option>
                        <option value="bac+8">Bac +8 (Doctorat)</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- MODAL 2 : MODIFIER (NOUVEAU) -->
    <div id="editDiplomeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: var(--primary);"><i class="fas fa-edit"></i> Modifier le Diplôme</h2>
                <span class="close-modal" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editDiplomeForm">
                <!-- Champ caché pour stocker l'ID si nécessaire pour votre backend -->
                <input type="hidden" id="edit_id">

                <div class="form-group">
                    <label for="edit_libelle">Libellé</label>
                    <input type="text" id="edit_libelle">
                </div>
                <div class="form-group">
                    <label for="edit_type">Type Diplôme</label>
                    <select id="edit_type">
                        <option value="Bac +2">Bac +2</option>
                        <option value="Bac +3 (Licence)">Bac +3 (Licence)</option>
                        <option value="Bac +5 (Master)">Bac +5 (Master)</option>
                        <option value="Bac +8 (Doctorat)">Bac +8 (Doctorat)</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit" style="background: #00d2ff; color: #0f172a;">Mettre à jour</button>
            </form>
        </div>
    </div>

    <script>
        // Eléments des Modaux
        const addModal = document.getElementById('diplomeModal');
        const editModal = document.getElementById('editDiplomeModal');

        // --- Fonctions Modal AJOUT ---
        function openAddModal() {
            addModal.style.display = "flex";
            document.getElementById('diplomeForm').reset();
        }

        function closeAddModal() {
            addModal.style.display = "none";
        }

        // --- Fonctions Modal MODIFIER ---
        function openEditModal(btn) {
            // 1. Récupérer la ligne du tableau parente du bouton cliqué
            const row = btn.closest('tr');

            // 2. Extraire les données des cellules
            const id = row.cells[0].innerText;
            const libelle = row.cells[1].innerText;
            const type = row.cells[2].innerText;

            // On sélectionne la bonne option dans le select
            const selectType = document.getElementById('edit_type');
            for(let i=0; i < selectType.options.length; i++) {
                if(selectType.options[i].value === type) {
                    selectType.selectedIndex = i;
                    break;
                }
            }

            // 4. Afficher le modal
            editModal.style.display = "flex";
        }

        function closeEditModal() {
            editModal.style.display = "none";
        }

        // Fermer les modaux si on clique en dehors du contenu
        window.onclick = function(event) {
            if (event.target == addModal) {
                closeAddModal();
            }
            if (event.target == editModal) {
                closeEditModal();
            }
        }
    </script>

@endsection
