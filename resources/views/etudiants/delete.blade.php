<!-- MODAL DE SUPPRESSION ÉTUDIANT -->
<div id="deleteStudentModal{{ $etudiant->id }}" class="modal">
    <div class="modal-content" style="max-width: 480px; text-align: center;">
        <div class="modal-header" style="justify-content: center; border-bottom: none;">
            <div style="background: rgba(239, 68, 68, 0.1); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                <i class="fas fa-user-times" style="color: var(--danger); font-size: 2rem;"></i>
            </div>
        </div>

        <h2 style="color: #fff; margin-bottom: 10px;">Supprimer l'étudiant ?</h2>
        <p style="color: var(--text-muted); margin-bottom: 25px; line-height: 1.6;">
            Êtes-vous sûr de vouloir supprimer l'étudiant <br>
            <strong style="color: var(--primary);">{{ $etudiant->prenom }} {{ $etudiant->nom }}</strong> ? <br>
            <span style="font-size: 0.85rem; color: #ef4444; opacity: 0.8;">Ca impacterait sur l'enregistrement de diplôme</span>
        </p>

        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" class="btn-filter-resete" style="width: auto; padding: 0 30px; height: 46px;" onclick="closeDeleteModal({{ $etudiant->id }})">
                    Annuler
                </button>
                <button type="submit" class="btn-submit" style="background: var(--danger); color: #fff; margin: 0; width: auto; padding: 12px 30px;">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>
