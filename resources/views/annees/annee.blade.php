@extends('layouts.app')

@section('title', 'Année')

@section('content')
        <section class="welcome-card">
            <h1>Années</h1>
            <p>Gérez vos diplômes et suivez votre parcours académique en temps réel.</p>
        </section><br>

        <!-- ZONE ACTION -->
        <div class="action-bar">
            <h2>Liste des Années</h2>
            <button class="btn-add" onclick="openAddModal()">
                <i class="fas fa-plus"></i> Ajouter année
            </button>
        </div>

        <!-- TABLEAU -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>1</td>
                        <td>Année Académique 2023-2024</td>
                        <td>01/09/2023</td>
                        <td>30/06/2024</td>
                        <td>
                            <div class="actions">
                                <!-- Appel de la fonction de modification spécifique -->
                                <i class="fas fa-edit btn-icon btn-edit" onclick="openEditModal(this)"></i>
                                <i class="fas fa-trash btn-icon btn-delete"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- MODAL 1 : AJOUTER -->
    <div class="modal" id="modalAnnee">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter une année</h2>
            </div>
            <form id="formAnnee">
                <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" id="libelle" placeholder="Ex: 2024-2025" required>
                </div>
                <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" id="date_debut" required>
                </div>
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" id="date_fin" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">Annuler</button>
                    <button type="submit" class="btn-save">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2 : MODIFIER (NOUVEAU) -->
    <div class="modal" id="modalModifierAnnee">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: #00d2ff;"><i class="fas fa-edit"></i> Modifier l'année</h2>
            </div>
            <form id="formModifierAnnee">
                <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" id="edit_libelle" required>
                </div>
                <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" id="edit_date_debut" required>
                </div>
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" id="edit_date_fin" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Annuler</button>
                    <button type="submit" class="btn-save" style="background: #00d2ff;">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modalAjout = document.getElementById('modalAnnee');
        const modalModif = document.getElementById('modalModifierAnnee');


        // --- GESTION MODAL AJOUT ---
        function openAddModal() {
            modalAjout.classList.add('active');
            document.getElementById('formAnnee').reset();
        }

        function closeAddModal() {
            modalAjout.classList.remove('active');
        }

        // --- GESTION MODAL MODIFIER ---
        function openEditModal(btn) {
            // Récupérer la ligne (tr) correspondante
            const row = btn.closest('tr');

            // Extraire les données des colonnes
            const libelle = row.cells[1].innerText;
            const dateDebutStr = row.cells[2].innerText; // Format JJ/MM/AAAA
            const dateFinStr = row.cells[3].innerText;   // Format JJ/MM/AAAA

            // Remplir les champs du modal de modification
            document.getElementById('edit_libelle').value = libelle;
            document.getElementById('edit_date_debut').value = convertDateToInput(dateDebutStr);
            document.getElementById('edit_date_fin').value = convertDateToInput(dateFinStr);

            // Afficher le modal
            modalModif.classList.add('active');
        }

        function closeEditModal() {
            modalModif.classList.remove('active');
        }

        // Utilitaire pour convertir JJ/MM/AAAA en AAAA-MM-JJ (format requis par <input type="date">)
        function convertDateToInput(dateString) {
            const parts = dateString.split('/');
            if(parts.length === 3) {
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }
            return "";
        }

        // Fermer les modaux en cliquant à l'extérieur
        window.onclick = function(event) {
            if (event.target == modalAjout) closeAddModal();
            if (event.target == modalModif) closeEditModal();
        }
    </script>
@endsection

