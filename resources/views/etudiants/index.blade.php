@extends('layouts.app')

@section('title', 'Etudiant')

@section('content')

    <!-- ZONE ACTIONS & TABLEAU -->
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
    <div class="action-header">
        <h1>Etudiants</h1>
        <button class="btn-add" id="openAddModal" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Ajouter Étudiant
        </button>
    </div>

    <div class="filters-card">
        <form action="{{ route('etudiants.index') }}" method="GET" class="filter-form">

            <!-- Recherche -->
            <div class="filter-group flex-2">
                <label>Recherche</label>
                <div class="input-with-icon">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Nom, matricule..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Date Début -->
            <div class="filter-group">
                <label>Depuis le</label>
                <input type="date" name="date_debut" value="{{ request('date_debut') }}">
            </div>

            <!-- Date Fin -->
            <div class="filter-group">
                <label>Jusqu'au</label>
                <input type="date" name="date_fin" value="{{ request('date_fin') }}">
            </div>

            <!-- Boutons -->
            <div class="filter-actions">
                <button type="submit" class="btn-filter-submit">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                @if (request()->anyFilled(['search', 'date_debut', 'date_fin']))
                    <a href="{{ route('etudiants.index') }}" class="btn-filter-reset" title="Réinitialiser">
                        <i class="fas fa-undo"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date Naissance</th>
                    <th>Sexe</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Année</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                @foreach ($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->matricule }}</td>
                        <td>{{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->prenom }}</td>
                        <td>{{ $etudiant->date_naissance }}</td>
                        <td>{{ $etudiant->sexe }}</td>
                        <td>{{ $etudiant->adresse }}</td>
                        <td>{{ $etudiant->telephone }}</td>
                        <td>{{ $etudiant->annee->libelle_annee ?? 'N/A' }}</td>
                        <td>
                            <div class="actions">
                                <i class="fas fa-edit btn-edit" title="Modifier"
                                    onclick="openEditModal({{ $etudiant->id }})"></i>

                                <i class="fas fa-trash btn-delete" title="Supprimer"
                                    onclick="openDeleteModal({{ $etudiant->id }})"></i>
                            </div>
                        </td>
                    </tr>
                    @include('etudiants.edit', ['etudiant' => $etudiant])
                    @include('etudiants.delete')
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- BLOC PAGINATION -->
    <div class="pagination-container">
        {{ $etudiants->links('pagination::bootstrap-4') }}
    </div>
    @include('etudiants.create')

    <!-- 1. Importer la bibliothèque Inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function() {
            // Appliquer le masque sur le champ téléphone
            // Masque pour 10 chiffres (ex: 06 12 34 56 78)
            $('#telephone').inputmask("99 99 99 99 99");

            // Si vous préférez sans espaces, utilisez :
            // $('#telephone').inputmask("9999999999");
        });
    </script>



    <script>
        const modalAdd = document.getElementById('studentModal');
        const openAddBtn = document.getElementById('openAddModal');

        // Modal Ajout
        function openAddModal() {
            modalAdd.classList.add('active');
        }

        function closeAddModal() {
            modalAdd.classList.remove('active');
        }

        // Modal Modification (Mis à jour avec ID)
        function openEditModal(id) {
            const modalEdit = document.getElementById('editStudentModal' + id);
            if (modalEdit) {
                modalEdit.classList.add('active');
            }
        }

        function closeEditModal(id) {
            const modalEdit = document.getElementById('editStudentModal' + id);
            if (modalEdit) {
                modalEdit.classList.remove('active');
            }
        }

        // Modal Suppression Étudiant
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteStudentModal' + id);
            if (modal) {
                modal.classList.add('active');
            }
        }

        function closeDeleteModal(id) {
            const modal = document.getElementById('deleteStudentModal' + id);
            if (modal) {
                modal.classList.remove('active');
            }
        }

        // Fermer en cliquant à côté du modal
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        @if ($errors->any())
            window.addEventListener('DOMContentLoaded', function() {
                openAddModal();
            });
        @endif
    </script>
@endsection

@push('styles')
    <style>
        /* CSS spécifique uniquement à cette page */
        .welcome-card {
            background: var(--sidebar-bg);
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* --- CONTENU --- */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
            transition: var(--transition);
        }

        .main-content.expanded {
            margin-left: 85px;
        }

        .toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
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
            border: 1px solid rgba(255, 255, 255, 0.05);
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

        .btn-add:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .table-container {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.9rem;
        }

        .btn-edit {
            color: var(--primary);
            margin-right: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete {
            color: var(--danger);
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            transform: scale(1.2);
        }

        /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #1e293b;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .close-modal {
            color: var(--text-muted);
            cursor: pointer;
            font-size: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary);
        }

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

        /* --- CONTAINER FILTRES --- */
        .filters-card {
            background: var(--sidebar-bg);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
        }

        .filter-form {
            display: flex;
            align-items: flex-end;
            /* Aligne le bas des inputs et du bouton */
            gap: 20px;
            flex-wrap: wrap;
        }

        /* --- GROUPES D'INPUTS --- */
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
            /* Distribue l'espace équitablement */
            min-width: 150px;
        }

        .flex-2 {
            flex: 2;
        }

        /* La barre de recherche est plus large */

        .filter-group label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* --- CHAMPS DE SAISIE --- */
        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            color: var(--primary);
        }

        .input-with-icon input {
            padding-left: 40px !important;
            /* Laisse de la place pour l'icône */
        }

        .filter-form input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            padding: 12px;
            border-radius: 10px;
            outline: none;
            height: 45px;
            /* Force une hauteur identique pour tous */
        }

        .filter-form input:focus {
            border-color: var(--primary) !important;
        }

        /* --- BOUTONS --- */
        .filter-actions {
            display: flex;
            gap: 10px;
            height: 45px;
            /* Même hauteur que les inputs */
        }

        .btn-filter-submit {
            background: var(--primary);
            color: #000;
            border: none;
            padding: 0 25px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .btn-filter-reset {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            width: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-filter-submit:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        .btn-filter-reset:hover {
            background: rgba(255, 77, 77, 0.2);
            color: var(--danger);
        }

        /* Inversion de l'icône calendrier pour le thème sombre */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        /* --- PAGINATION CUSTOM --- */
        .pagination-container {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            border-radius: 10px;
            overflow: hidden;
            gap: 5px;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            background: var(--sidebar-bg);
            color: var(--text-muted);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 18px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            display: block;
        }

        .page-item.active .page-link {
            background: var(--primary) !important;
            color: #000 !important;
            font-weight: bold;
            border-color: var(--primary);
        }

        .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            color: #444;
            cursor: not-allowed;
        }

        .page-link:hover:not(.disabled) {
            background: rgba(255, 255, 255, 0.1);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* Masquer les labels "Showing X to Y" si nécessaire (version simple) */
        .pagination-container nav div:first-child {
            display: none;
        }

        .pagination-container nav div:last-child {
            margin: 0 auto;
        }
    </style>
@endpush
