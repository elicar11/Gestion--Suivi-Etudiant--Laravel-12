@extends('layouts.app')

@section('title', 'Obtention')

@section('content')
    <!-- CONTENU PRINCIPAL -->
        <section class="welcome-card">
            <div class="header-flex">
                <div>
                    <h1>Obtention du Diplôme</h1>
                    <p>Gérez vos diplômes et suivez votre parcours académique en temps réel.</p>
                </div>
            </div>
        </section><br>

        <button class="btn-add" onclick="openAddModal()"><i class="fas fa-plus"></i> Ajouter</button><br>

        <!-- TABLEAU -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matricule</th>
                        <th>Id Diplôme</th>
                        <th>Id Année</th>
                        <th>Mention</th>
                        <th>Date Obtention</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>1</td>
                        <td>ETU001</td>
                        <td>DIP-LIC</td>
                        <td>2023-2024</td>
                        <td><span class="badge-mention m-bien">Bien</span></td>
                        <td>15/07/2024</td>
                        <td class="action-icons">
                            <i class="fas fa-edit" onclick="openEditModal(this)"></i>
                            <i class="fas fa-trash"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>ETU002</td>
                        <td>DIP-LIC</td>
                        <td>2023-2024</td>
                        <td><span class="badge-mention m-tres-bien">Très Bien</span></td>
                        <td>15/07/2024</td>
                        <td class="action-icons">
                            <i class="fas fa-edit" onclick="openEditModal(this)"></i>
                            <i class="fas fa-trash"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>ETU003</td>
                        <td>DIP-LIC</td>
                        <td>2023-2024</td>
                        <td><span class="badge-mention m-assez-bien">Assez Bien</span></td>
                        <td>15/07/2024</td>
                        <td class="action-icons">
                            <i class="fas fa-edit" onclick="openEditModal(this)"></i>
                            <i class="fas fa-trash"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- MODAL 1 : AJOUTER -->
    <div class="modal" id="modalObtention">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter une Obtention</h2>
                <span class="close-modal" onclick="closeAddModal()">&times;</span>
            </div>
            <form id="formObtention">
                <div class="form-group"><label>Matricule</label><input type="text" required></div>
                <div class="form-group"><label>ID Diplôme</label><input type="text" required></div>
                <div class="form-group"><label>ID Année</label><input type="text" required></div>
                <div class="form-group">
                    <label>Mention</label>
                    <select required>
                        <option value="Passable">Passable</option>
                        <option value="Assez Bien">Assez Bien</option>
                        <option value="Bien">Bien</option>
                        <option value="Très Bien">Très Bien</option>
                        <option value="Excellent">Excellent</option>
                    </select>
                </div>
                <div class="form-group"><label>Date d'Obtention</label><input type="date" required></div>
                <button type="submit" class="btn-save">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- MODAL 2 : MODIFIER -->
    <div class="modal" id="modalModifierObtention">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: var(--primary);"><i class="fas fa-edit"></i> Modifier le Diplôme</h2>
                <span class="close-modal" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="formModifierObtention">
                <input type="hidden" id="edit_id">
                <div class="form-group"><label>Matricule</label><input type="text" id="edit_matricule" required></div>
                <div class="form-group"><label>ID Diplôme</label><input type="text" id="edit_diplome" required></div>
                <div class="form-group"><label>ID Année</label><input type="text" id="edit_annee" required></div>
                <div class="form-group">
                    <label>Mention</label>
                    <select id="edit_mention" required>
                        <option value="Passable">Passable</option>
                        <option value="Assez Bien">Assez Bien</option>
                        <option value="Bien">Bien</option>
                        <option value="Très Bien">Très Bien</option>
                        <option value="Excellent">Excellent</option>
                    </select>
                </div>
                <div class="form-group"><label>Date d'Obtention</label><input type="date" id="edit_date" required></div>
                <button type="submit" class="btn-save">Mettre à jour</button>
            </form>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-btn');
        const modalAdd = document.getElementById('modalObtention');
        const modalEdit = document.getElementById('modalModifierObtention');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        function openAddModal() {
            modalAdd.style.display = 'flex';
        }
        function closeAddModal() {
            modalAdd.style.display = 'none';
        }

        function openEditModal(btn) {
            const row = btn.closest('tr');
            document.getElementById('edit_id').value = row.cells[0].innerText;
            document.getElementById('edit_matricule').value = row.cells[1].innerText;
            document.getElementById('edit_diplome').value = row.cells[2].innerText;
            document.getElementById('edit_annee').value = row.cells[3].innerText;

            // On récupère juste le texte du badge pour le select
            const mention = row.cells[4].querySelector('.badge-mention').innerText;
            document.getElementById('edit_mention').value = mention;

            modalEdit.style.display = 'flex';
        }

        function closeEditModal() {
            modalEdit.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modalAdd) closeAddModal();
            if (event.target == modalEdit) closeEditModal();
        }
    </script>
@endsection
