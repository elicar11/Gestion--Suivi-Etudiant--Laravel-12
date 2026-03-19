@extends('layouts.app')

@section('title', 'Année')

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

    @if (session('error'))
        <div class="alert alert-danger">
            <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
            <div class="alert-content">
                <strong>Action impossible !</strong>
                <p>{!! session('error') !!}</p>
            </div>
            <button class="alert-close" onclick="this.parentElement.style.display='none';"><i
                    class="fas fa-times"></i></button>
        </div>
    @endif

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
                    <th>Libellé</th>
                    <th>Date Debut</th>
                    <th>Date Fin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($annees as $annee)
                    <tr>
                        {{-- <td>{{ $annee->id }}</td> --}}
                        <td>{{ $annee->libelle_annee }}</td>
                        <td>{{ $annee->date_debut }}</td>
                        <td>{{ $annee->date_fin }}</td>
                        <td>
                            <div class="actions">
                                <i class="fas fa-edit btn-icon btn-edit" onclick="openEditModal(this)"><a
                                        href="{{ route('annees.edit', $annee->id) }}"></a></i>

                                <i class="fas fa-trash btn-icon btn-delete"
                                    onclick="openDeleteModal({{ $annee->id }})"></i>
                            </div>
                        </td>
                    </tr>
                    @include('annees.edit')
                    @include('annees.delete')
                @endforeach
            </tbody>
        </table>
    </div>
    </main>
    @include('annees.create')


    <script>
        const modalAjout = document.getElementById('modalAnnee');
        const modalModif = document.getElementById('modalModifierAnnee');


        // MODAL AJOUT
        function openAddModal() {
            modalAjout.classList.add('active');
            document.getElementById('formAnnee').reset();
        }

        function closeAddModal() {
            modalAjout.classList.remove('active');
        }

        // MODAL MODIFIER
        function openEditModal(btn) {
            modalModif.classList.add('active');
        }

        function closeEditModal() {
            modalModif.classList.remove('active');
        }

        // Utilitaire pour convertir JJ/MM/AAAA en AAAA-MM-JJ (format requis par <input type="date">)
        function convertDateToInput(dateString) {
            const parts = dateString.split('/');
            if (parts.length === 3) {
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }
            return "";
        }

        // MODAL SUPPRIMER (Dynamique par ID)
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteAnneeModal' + id);
            if (modal) modal.classList.add('active');
        }

        function closeDeleteModal(id) {
            const modal = document.getElementById('deleteAnneeModal' + id);
            if (modal) modal.classList.remove('active');
        }

        // window.onclick = function(event) {
        //     if (event.target == modalAjout) closeAddModal();
        //     if (event.target == modalModif) closeEditModal();
        // }
    </script>
@endsection
