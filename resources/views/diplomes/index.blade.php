@extends('layouts.app')

@section('title', 'Diplôme')

@section('content')
    <!-- CONTENU PRINCIPAL -->
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
                    <th>Libellé</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($diplomes as $diplome)
                    <tr>
                        {{-- <td>{{ $diplome->id }}</td> --}}
                        <td>{{ $diplome->libelle_diplome }}</td>
                        <td>
                            <div class="action-icons">
                                <i class="fas fa-edit" onclick="openEditModal(this)"><a
                                        href="{{ route('diplomes.edit', $diplome->id) }}"></a></i>

                                <!-- Suppression (Nouveau déclencheur) -->
                                <i class="fas fa-trash" onclick="openDeleteModal({{ $diplome->id }})"
                                    style="cursor:pointer; color: var(--danger);"></i>

                            </div>
                        </td>
                    </tr>
                    @include('diplomes.edit')
                    @include('diplomes.delete')
                @endforeach
            </tbody>
        </table>
    </div>
    </main>
    @include('diplomes.create')


    <script>
        const addModal = document.getElementById('diplomeModal');
        const editModal = document.getElementById('editDiplomeModal');

        // Modal AJOUT
        function openAddModal() {
            addModal.style.display = "flex";
            document.getElementById('diplomeForm').reset();
        }

        function closeAddModal() {
            addModal.style.display = "none";
        }

        // Modal MODIFIER
        function openEditModal(btn) {

            editModal.style.display = "flex";
        }

        function closeEditModal() {
            editModal.style.display = "none";
        }

        // Modal SUPPRESSION
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal' + id);
            if (modal) modal.classList.add('active');
        }

        function closeDeleteModal(id) {
            const modal = document.getElementById('deleteModal' + id);
            if (modal) modal.classList.remove('active');
        }

        // window.onclick = function(event) {
        //     if (event.target == addModal) {
        //         closeAddModal();
        //     }
        //     if (event.target == editModal) {
        //         closeEditModal();
        //     }
        // }
    </script>
@endsection
