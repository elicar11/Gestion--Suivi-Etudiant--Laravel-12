@extends('layouts.app')

@section('title', 'Etudiant')

@section('content')

    <!-- CONTENU PRINCIPAL -->
        <section class="welcome-card">
            <h1>Etudiants</h1>
            <p>Gérez les informations des étudiants et leur cursus académique.</p>
        </section>
        <br>
        <!-- ZONE ACTIONS & TABLEAU -->
        <div class="action-header">
            <h3>Liste des étudiants</h3>
            <button class="btn-add" id="openAddModal">
                <i class="fas fa-plus"></i> Ajouter Étudiant
            </button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date Naissance</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Id Année</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Exemple de ligne -->
                    <tr>
                        <td>MAT-2023-001</td>
                        <td>SARR</td>
                        <td>Moussa</td>
                        <td>2000-05-12</td>
                        <td>Dakar, Plateau</td>
                        <td>+221 77 000 00 00</td>
                        <td>2</td>
                        <td>
                            <i class="fas fa-edit btn-edit" title="Modifier" onclick="openEditModal(this)"></i>
                            <i class="fas fa-trash btn-delete" title="Supprimer"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    <!-- MODAL 1 : AJOUTER -->
    <div class="modal" id="studentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter un étudiant</h2>
                <span class="close-modal" onclick="closeAddModal()">&times;</span>
            </div>
            <form id="studentForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Matricule</label>
                        <input type="text" placeholder="Ex: MAT-001" required>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" placeholder="Nom de l'étudiant" required>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" placeholder="Prénom de l'étudiant" required>
                    </div>
                    <div class="form-group">
                        <label>Date de Naissance</label>
                        <input type="date" required>
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" placeholder="+221..." required>
                    </div>
                    <div class="form-group">
                        <label>Id Année (Combo)</label>
                        <select required>
                            <option value="">Sélectionner une année</option>
                            <option value="1">2022-2023</option>
                            <option value="2">2023-2024</option>
                            <option value="3">2024-2025</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Adresse</label>
                        <input type="text" placeholder="Adresse complète" required>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Enregistrer les informations</button>
            </form>
        </div>
    </div>

    <!-- MODAL 2 : MODIFIER (NOUVEAU) -->
    <div class="modal" id="editStudentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: var(--primary);"><i class="fas fa-user-edit"></i> Modifier l'étudiant</h2>
                <span class="close-modal" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editStudentForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Matricule</label>
                        <input type="text" id="edit_matricule" required>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" id="edit_nom" required>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" id="edit_prenom" required>
                    </div>
                    <div class="form-group">
                        <label>Date de Naissance</label>
                        <input type="date" id="edit_date" required>
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" id="edit_tel" required>
                    </div>
                    <div class="form-group">
                        <label>Id Année</label>
                        <select id="edit_annee" required>
                            <option value="1">2022-2023</option>
                            <option value="2">2023-2024</option>
                            <option value="3">2024-2025</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Adresse</label>
                        <input type="text" id="edit_adresse" required>
                    </div>
                </div>
                <button type="submit" class="btn-submit" style="background: var(--primary); font-weight: 700;">Mettre à jour les informations</button>
            </form>
        </div>
    </div>

    <script>

        // --- GESTION DES MODAUX ---
        const modalAdd = document.getElementById('studentModal');
        const modalEdit = document.getElementById('editStudentModal');
        const openAddBtn = document.getElementById('openAddModal');

        // Fonctions pour Modal Ajout
        function openAddModal() {
            modalAdd.classList.add('active');
        }
        function closeAddModal() {
            modalAdd.classList.remove('active');
        }

        // Fonctions pour Modal Modification
        function openEditModal(element) {
            // Récupérer la ligne du tableau
            const row = element.closest('tr');

            // Extraire les données des cellules (td)
            const matricule = row.cells[0].innerText;
            const nom = row.cells[1].innerText;
            const prenom = row.cells[2].innerText;
            const date = row.cells[3].innerText;
            const adresse = row.cells[4].innerText;
            const tel = row.cells[5].innerText;
            const annee = row.cells[6].innerText;

            // Remplir le formulaire de modification
            document.getElementById('edit_matricule').value = matricule;
            document.getElementById('edit_nom').value = nom;
            document.getElementById('edit_prenom').value = prenom;
            document.getElementById('edit_date').value = date;
            document.getElementById('edit_adresse').value = adresse;
            document.getElementById('edit_tel').value = tel;

            // Sélectionner la bonne année dans le select
            const selectAnnee = document.getElementById('edit_annee');
            for(let i=0; i<selectAnnee.options.length; i++){
                if(selectAnnee.options[i].text === annee || selectAnnee.options[i].value === annee){
                    selectAnnee.selectedIndex = i;
                    break;
                }
            }

            modalEdit.classList.add('active');
        }

        function closeEditModal() {
            modalEdit.classList.remove('active');
        }

        // Événements
        openAddBtn.addEventListener('click', openAddModal);

        // Fermer les modaux en cliquant à l'extérieur
        window.addEventListener('click', (e) => {
            if (e.target === modalAdd) closeAddModal();
            if (e.target === modalEdit) closeEditModal();
        });

        // Simulation de soumission
        document.getElementById('editStudentForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert("Informations de l'étudiant mises à jour !");
            closeEditModal();
        });
    </script>
@endsection

@push('styles')
<style>
    /* CSS spécifique uniquement à cette page */
    .welcome-card {
        background: var(--sidebar-bg);
        padding: 30px;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.05);
    }

    /* --- CONTENU --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px; transition: var(--transition); }
        .main-content.expanded { margin-left: 85px; }

        .toggle-btn {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .welcome-card {
            background: var(--sidebar-bg);
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        /* --- STYLES AJOUTÉS POUR LE TABLEAU ET MODAL --- */
        .action-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-add {
            background: var(--primary);
            color: #000;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .btn-add:hover { opacity: 0.9; transform: translateY(-2px); }

        .table-container {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 15px;
            color: var(--text-muted);
            font-weight: 500;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 0.9rem;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 0.9rem;
        }

        .btn-edit { color: var(--primary); margin-right: 15px; cursor: pointer; transition: 0.3s; }
        .btn-delete { color: var(--danger); cursor: pointer; transition: 0.3s; }
        .btn-edit:hover, .btn-delete:hover { transform: scale(1.2); }

        /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active { display: flex; }

        .modal-content {
            background: #1e293b;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .modal-header { margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;}
        .modal-header h2 { color: var(--primary); font-size: 1.5rem; }

        .close-modal { color: var(--text-muted); cursor: pointer; font-size: 1.5rem; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group { margin-bottom: 15px; }
        .form-group.full { grid-column: span 2; }

        .form-group label { display: block; margin-bottom: 5px; color: var(--text-muted); font-size: 0.85rem; }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: #fff;
            outline: none;
        }

        .form-group input:focus, .form-group select:focus { border-color: var(--primary); }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
</style>

@endpush

